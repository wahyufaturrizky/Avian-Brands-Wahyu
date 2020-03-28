<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

	function MY_Exceptions(){
        parent::__construct();
    }

    public function show_404($page='', $log_error = TRUE)
    {
        $CI =& get_instance();
		$CI->output->set_status_header('404');

        $page = $CI->uri->segment(1,0);

        if ($page == "manager") {

            $header = array(
                "title" => "Error",
                "breadcrumb" => "<li>Home</li><li>Error</li>",
            );

            $footer = array("css" => '/css/error_manager.css');
            if ($CI->session->has_userdata(ADMIN_SESSION)) {
                $CI->load->view(MANAGER_HEADER,$header);
                $CI->load->view('error/manager/error_manager');
                $CI->load->view(MANAGER_FOOTER,$footer);
            } else {
                $CI->load->view(MANAGER_HEADER_SIGNIN,$header);
                $CI->load->view('error/manager/error_manager');
                $CI->load->view(MANAGER_FOOTER_SIGNIN,$footer);
            }
        } else {
            $CI->load->library('user_agent');
            $CI->load->model('Dynamic_model');

            $is_iphone = $CI->agent->is_mobile('iphone');

            $faq = $CI->Dynamic_model->set_model("dtb_faq", "df", "id")->get_all_data(array(
                "count_all_first" => true
            ))['total'];


            $header = array(
                "header" => array(
                    "title" => "Error 404",
                    "meta_desc" => "Page Not Found",
                    "meta_keys" => "Error",
                    "is_iphone" => $is_iphone,
                )
            );

            $footer = array(
                "total_faq" => $faq,
            );

            $CI->load->view(FRONT_HEADER,$header);
            $CI->load->view('error/front/error');
            $CI->load->view(FRONT_FOOTER, $footer);
        }

        echo $CI->output->get_output();
        exit;
    }

}
