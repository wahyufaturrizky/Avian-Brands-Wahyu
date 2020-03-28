<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Basepublic_Controller extends MX_Controller {

    //protected var for current user login.
    protected $_secure;
    protected $user_choice;
    protected $data_login_user;
    protected $_dm;

	/**
	 * Base controller constructor.
	 * this parent is used for every admin controllers.
	 */
    function __construct() {
        parent::__construct();

        //for securing public access.
        $this->_secure = false;

        //load dynamic model
        $this->load->model("Dynamic_model");
        $this->_dm = new Dynamic_model();

        //get user_agent
		$this->load->library('user_agent');

		$is_iphone = $this->agent->is_mobile('iphone');

        //get session login_admin
        $login_user = $this->session->userdata(USER_SESSION);
        $user_choice = $this->session->userdata('user_choice');


        //check faq
		$faq = $this->_dm->set_model("dtb_faq", "df", "id")->get_all_data(array(
            "count_all_first" => true
        ))['total'];

        $snippet = $this->_dm->set_model("mst_layout", "ml", "id")->get_all_data(array(
            "row_array" => true
        ))['datas'];

        $data = array(
            'login_user' => $login_user,
            'user_choice' => $user_choice,
            'is_iphone' => $is_iphone,
            'total_faq' => $faq,
            'snippet' => $snippet,
        );
        $this->data_login_user = $login_user;
        $this->user_choice = $user_choice;
        $this->load->vars($data);

        //get controller
        $controller = $this->router->fetch_class();
        $function = $this->router->fetch_method();

        if ($controller != "store") {
            $this->session->unset_userdata('uv_store_search');
        }

		if ($controller != "offices") {
            $this->session->unset_userdata('uv_office_search');
        }

		if ($controller != "colours") {
            $this->session->unset_userdata('color_search');
        } else if ($controller == "colours") {
			if ($function == "index") {
				$this->session->unset_userdata('color_search');
			}
		}

		if ($controller != "palette") {
            $this->session->unset_userdata('pallete_search');
            $this->session->unset_userdata('pallete_filter');
            $this->session->unset_userdata('palette_detail_search');
        } else if ($controller == "palette") {
			if ($function == "detail") {
				$this->session->unset_userdata('pallete_search');
				$this->session->unset_userdata('pallete_filter');
			}

			if ($function == "lists") {
				$this->session->unset_userdata('palette_detail_search');
			}
		}

        if ($controller != "csr") {
            $this->session->unset_userdata('uv_csr_search');
            $this->session->unset_userdata('uv_csr_search_type');
        }

        $allowed = array("logout","likebox","account");
        $logined = array("login","register","forgot_password");

        //guest
        if (!isset($login_user['id'])) {
            if (array_search($controller,$allowed) !== FALSE) {
                show_404('page');
            }
        } else if (isset($login_user['id'])) {
			if (array_search($controller,$logined) !== FALSE) {
                show_404('page');
            }
		}
    }


}
