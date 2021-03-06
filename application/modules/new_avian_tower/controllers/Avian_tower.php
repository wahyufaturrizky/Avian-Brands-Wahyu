<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Index Controller.
 */
class Avian_tower extends Basepublic_Controller  {

    private $_view_folder = "new_avian_tower/front/";

    /**
	 * constructor.
	 */
    public function __construct() {
        parent::__construct();
    }


    public function index() {
        //get header page
        $page = get_page_detail('tower');

        $header = array(
            'header' => $page,
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'index' );
        $this->load->view(FRONT_FOOTER_2);
    }
	
}
