<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Index Controller.
 */
class Award extends Basepublic_Controller  {

    private $_view_folder = "new_award/front/";

    /**
	 * constructor.
	 */
    public function __construct() {
        parent::__construct();

        $this->load->model("Awards_model");
        $this->load->model("Awards_image_model");
    }


    public function index() {

        if (!isset($_GET['y'])) {
             $_GET['y'] = 2017;
        } 
        $y = $_GET['y'];
        $conditions['year'] = $y;
        //get header page
        $page = get_page_detail('awards');

        //get awards list
        $model_awards = new Awards_model();

        $lists = $model_awards->getAllAwardsAndImages (null ,$conditions);
        //get avail product awards
        $prod_awd = $this->Awards_image_model->getAllProductAwards();
        $prod_awards = array();

        if (count($prod_awd) > 0) {
            foreach ($prod_awd as $model) {
                if ($model['product_id'] == 3) {
                    $model['name'] = "Avitex";
                }

                if ($model['product_id'] != 6) array_push($prod_awards,$model);
            }
        }

        $header = array(
            'header'            => $page,
            'models'            => $lists,
            'prod_awards'       => $prod_awards,
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'index' );
        $this->load->view(FRONT_FOOTER_2);
    }


	
}
