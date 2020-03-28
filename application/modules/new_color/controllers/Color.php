<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Index Controller.
 */
class Color extends Basepublic_Controller  {

    private $_view_folder = "new_color/front/";

    /**
	 * constructor.
	 */
    public function __construct() {
        parent::__construct();
    }


    public function index() {
        //get header page
        $page = get_page_detail('colours');

        $condition  =   [
            'status'  => 1,
            'is_show' => 1,
            // 'debug' => true
        ];

        $colour      = $this->_dm->set_model("dtb_color", "c" , "id")->get_all_data($condition)['datas'];

        $header = array(
            'header' => $page,
            'color'  => $colour,
             'scroll_hide'   => true,
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'index' );
        $this->load->view(FRONT_FOOTER_2);
    }

    public function detail() {
        //get header page

        // $this->db->save_query = true;

        $page = get_page_detail('colours');
        $detail      = $this->_dm->set_model("dtb_color", "c" , "id")->get_all_data(
            [
               "conditions" =>  ['id' => $_GET['color_id'] ],
               'row_array' => true
            ]
        )['datas'];
        $palette     = $this->_dm->set_model("mst_palette_color", "d" , "id")->get_all_data( 
            [
                "conditions" => ['color_id' => $_GET['color_id'] ], 
            ]
        )['datas'];

        $return_data = [];


        foreach ($palette as $key) {
            # code...

            $product     = $this->_dm->set_model("mst_palette_product", "e" , "id")->get_all_data( 
                [
                    
                    "conditions" => ['palette_id' => $key['palette_id'] ],
                    "left_joined" => [
                        "dtb_product pr" => array("e.product_id" => "pr.id"),
                    ],
                    "order_by" => array("e.id" => "asc"),
                   
                ]
            )['datas'];

            $i = 0;
            foreach ($product as $dey) {
                $return_data[$i]['product_id']   = $dey['id'];
                $return_data[$i]['product_name'] = $dey['name'];
                $return_data[$i]['pretty_url']   = $dey['pretty_url'];
                $return_data[$i]['image_url']    = $dey['image_url'];
                $return_data[$i]['desc']    =      $dey['description'];
                $i++;
            }

            

        }
 

        $header = array(
            'header' => $page,
            'detail' => $detail,
            'data'   => $return_data,
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'detail' );
        $this->load->view(FRONT_FOOTER_2);
    }
	
}
