<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Index Controller.
 */
class Index extends Basepublic_Controller  {

    private $_view_folder = "new_index/front/";

    /**
	 * constructor.
	 */
    public function __construct() {
        parent::__construct();
    }


    public function index() {
        //ambil title, seo meta dari db untuk page home
		$page = get_page_detail('home');

        
        //get slider data
        $sliders = array();
        $template;
        $page_active;

        $template = "index";

        if ( $this->user_choice == 2 ) {
           
            $page_active = 'index-pro';
            $limit = 2;

            $sliders = $this->_dm->set_model("dtb_slider", "ds", "id")->get_all_data(array(
                "conditions_or" => array("show_in" => SHOW_IN_PRO , "show_in" => SHOW_IN_ALL),
                "conditions" => array("is_show" => SHOW),
                "order_by" => array("ordering" => "asc"),
            ))['datas'];
        } else {
			$this->user_choice = 1;

          
            $page_active = 'index';
            $limit = 3;

            $sliders = $this->_dm->set_model("dtb_slider", "ds", "id")->get_all_data(array(
                "conditions_or" => array("show_in" => SHOW_IN_USER , "show_in" => SHOW_IN_ALL),
                "conditions"    => array("is_show" => SHOW),
                "order_by"      => array("ordering" => "asc"),
            ))['datas'];

        }

        //get article data
        

        $header = array(
            'header'        => $page,
            'page'          => $page_active,
            'sliders'       => $sliders,
            'scroll_hide'   => true,
        );

        $footer = array(
            "script" => array(
                "/js/front/article.js",
                "/js/plugins/slick/slick.min.js",
                "/js/front/home.js",
            ),
            "css" => array(
                "/js/plugins/slick/slick.css",
                "/js/plugins/slick/slick-theme.css",
            )
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . $template);
        $this->load->view(FRONT_FOOTER_2, $footer);
    }

	/**
	 * Logout function.
	 */
	public function logout() {
        //unset sessions and back to login.
        $this->session->unset_userdata(USER_SESSION);
		redirect('/');
	}


	/**
	 * Forgot password (reset password function).
	 * it will send the "reset password" email from here.
	 */
	public function forgot_password() {

		//load library and model.
		$this->load->library('form_validation');
        $this->load->model("user/User_model");

        //set validations rules.
        $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");

		$footer = array("script" => '/js/pages/login.js');
		$header = array("title"  => 'Forgot Password');

		//check for validation.
        if ($this->form_validation->run() == FALSE){

        	//send error message to view.
			$error_message = validation_errors();
			$this->session->set_flashdata('message', $error_message);
			$this->session->set_flashdata('alert', 'danger');

		} else {

            //get the posted values
            $email = $this->input->post("email");

			//check to the model if the email is correct.
			$result = $this->User_model->get_all_data(array(
                "row_array" => TRUE,
                "conditions" => array("email" => $email),
            ))['datas'];

			//validate result.
			if ($result) {
                //send email to reset password.

                //using transaction.
				$this->db->trans_begin();

                //create an url which the user can click to reset their password.
				$forgot_link = $this->User_model->send_forgot_pass($result);

                //end transaction.
				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();

                    //error something.
					$this->session->set_flashdata('message', 'There is something wrong. Please retry input your email.');
					$this->session->set_flashdata('alert', 'danger');

				} else {
                    //success and commiting.
					$this->db->trans_commit();

					//send email to user with the reset password link.
                    //get content from view
                    $content = $this->load->view('layout/email/forgot_password', '', true);
                    $content = str_replace('%NAME%',$result['name'],$content);
                    $content = str_replace('%LINK%',$forgot_link,$content);

					$mail = sendmail (array(
						'subject'	=> SUBJECT_RESET_PASSWORD,
						'message'	=> $content,
						'to'		=> array($result['email']),
					), "html");

					//success, info to check user email.
					$this->session->set_flashdata('message', 'Please check your email to reset your password.');
					$this->session->set_flashdata('alert', 'success');
				}

			} else {
				//invalid email.
				$this->session->set_flashdata('message', 'Email is wrong.');
				$this->session->set_flashdata('alert', 'danger');
            }
		}

        //load the views.
		$this->load->view(FRONT_HEADER_SIGNIN ,$header);
		$this->load->view($this->_view_folder . 'forgot-password');
		$this->load->view(FRONT_FOOTER_SIGNIN ,$footer);
	}

	/**
	 * function to reset password.
	 * from link in reset password email.
	 */
	public function reset_password($code) {

        //load model.
		$this->load->model('user/User_model');

        //check code.
		if (!$code) {
			show_404();
		}

		//decode code.
		$code_decoded = base64_decode(urldecode($code));

		//check code if exist.
		$user = $this->User_model->checkCode($code_decoded);
		if (!$user) {
			show_404();
		}

        if ($user['end_forgotpass_time'] < strtotime("now")) {
            show_404();
        }

        //begin transaction.
		$this->db->trans_begin();

		//reset passsword.
		$new_pass = $this->User_model->reset_password($user);

        //end transaction.
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();

            //some kind of DB problem?
			show_404();

		} else {
            //success and commiting.
			$this->db->trans_commit();

			//send email for the newly generated password.
            //get content from view
            $content = $this->load->view('layout/email/reset_password', '', true);
            $content = str_replace('%NAME%',$user['name'],$content);
            $content = str_replace('%NEW_PASS%',$new_pass,$content);

			$mail = sendmail (array(
				'subject'	=> SUBJECT_PASSWORD_INFO,
				'message'	=> $content,
				'to'		=> array($user['email']),
			), "html");

			//close window
			echo "<script>window.close();</script>";
		}
	}


    ///////////////////////////////AJAX CALL////////////////////////////

    public function set_choice () {
        if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

        $datachoice = $this->input->post('choice');

        if ($datachoice == "pro") {
            $this->session->set_userdata('user_choice', 2);
            $message['is_reload'] = "yes";
        } else {
            $this->session->set_userdata('user_choice', 1);
            $message['is_reload'] = "no";
        }

        $message['is_error'] = false;

        echo json_encode($message);
    }

    public function avianbrand_mobileapp()
    {
		/*
		*	Mobile device detection
		*/
		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		if( stristr($user_agent,'ipad') ) {
			redirect("https://itunes.apple.com/id/app/avian-brands/id1093348644?mt=8");
		} else if( stristr($user_agent,'iphone') || strstr($user_agent,'iPhone') ) {
			redirect("https://itunes.apple.com/id/app/avian-brands/id1093348644?mt=8");
		} else if( stristr($user_agent,'android') ) {
			redirect("https://play.google.com/store/apps/details?id=com.avian.brands");
		} else {
			redirect("https://avianbrands.com/download");
		}
    }

    public function beasiswajuara() {
        redirect("https://beasiswajuara.kompas.id");
    }

}
