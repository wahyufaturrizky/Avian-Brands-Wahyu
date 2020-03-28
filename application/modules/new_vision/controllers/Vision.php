<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Index Controller.
 */
class Vision extends Basepublic_Controller  {

    private $_view_folder = "new_vision/front/";

    /**
	 * constructor.
	 */
    public function __construct() {
        parent::__construct();
    }


    public function index() {
        //get header page
        $page = get_page_detail('about');

        $condition['head'] =  [
            'select' => '*',
            'conditions' => ['id' => 1],
        ];

        $condition['his'] =  [
            'select' => '*',
            'order_by' => ['year' => 'asc'],
        ];


        $history_head = $this->_dm->set_model("dtb_new_timeline_header", null , "id")->get_all_data($condition['head'])['datas'];
        $history      = $this->_dm->set_model("dtb_new_timeline", null , "id")->get_all_data($condition['his'])['datas'];


        $header = array(
            'header'       => $page,
            'history'      => $history,
            'history_head' => $history_head,
            'scroll_hide' => true
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'index' );
        $this->load->view(FRONT_FOOTER_2);
    }
	
}
