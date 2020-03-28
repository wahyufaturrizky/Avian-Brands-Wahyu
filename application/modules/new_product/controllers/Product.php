<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Index Controller.
 */
class Product extends Basepublic_Controller  {

    private $_view_folder   = "new_product/front/";
    private $_table         = "dtb_product";
    private $_table_aliases = "dp";
    private $_pk            = "dp.id";

    /**
	 * constructor.
	 */
    public function __construct() {
        parent::__construct();
        $this->load->model("Product_model");
    }


    public function index() {
        //get header page
        $page = get_page_detail('product');

        //get product category
        $pcategory = $this->_dm->set_model("dtb_product_category", "dpc", "id")->get_all_data(array(
            "conditions" => array(
                "is_show" => SHOW,
            ),
            "order_by" => array("ordering" => "asc"),
        ))['datas'];

        $header = array(
            'header'    => $page,
            'pcategory' => $pcategory,
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'index' );
        $this->load->view(FRONT_FOOTER_2);
    } 


    public function listdetail($url) {
        $url = $this->uri->segment(3, 0);
        if (empty($url)) {
            show_404('page');
        }
        //load product model
        $this->load->model("Product_model");

        //check url if exist
        $pcategory = $this->_dm->set_model("dtb_product_category", "dpc", "id")->get_all_data(array(
            "conditions" => array(
                "is_show" => SHOW,
                "pretty_url" => $url,
            ),
            "row_array" => true,
        ))['datas'];

        if(empty($pcategory)) {
            show_404('page');
        }

        //get all product by this category
        $products = $this->Product_model->get_all_data(array(
            "select"      => array("vpr.*", "dp.*"),
            "left_joined" => array("view_product_rating vpr" => array("vpr.product_id" => "dp.id")),
            "conditions" => array(
                "is_show" => SHOW,
                "product_category_id" => $pcategory['id']
            ),
            "order_by" => array("ordering" => "asc"),
            "status" => STATUS_ACTIVE,
            // "limit" => "5"
        ))['datas'];

        // Ambil view_product_rating
        $vpr = $this->_dm->set_model("view_product_rating", "vpr", "product_id")->get_all_data(array(
            "select" => array("vpr.*", "dp.*"),
            "conditions" => array("dp.pretty_url" => $url,),
            "left_joined" => array(
                "dtb_product dp" => array("dp.id" => "vpr.product_id"),
            ),
            "row_array" => true
        ))['datas'];
        // pr($vpr);exit;

        //get slider product
        $slider = $this->_dm->set_model("dtb_product_slider", "dps", "id")->get_all_data (array(
            "conditions" => array(
                "is_show" => SHOW,
                "category_id" => $pcategory['id']
            ),
            "order_by" => array("ordering" => "asc"),
        ))['datas'];

        //get all product category with product
        $allcat = $this->Product_model->getCategoryAndProduct();

        $page = array(
            "title"      => $pcategory['name'],
            "meta_desc"  => $pcategory['meta_desc'],
            "meta_keys"  => $pcategory['meta_keys'],
        );

        $header = array(
            'header'    => $page,
            'products'  => $products,
            'pcategory' => $pcategory,
            'slider'    => $slider,
            'allcat'    => $allcat,
            'vpr'       => $vpr
        );

        $footer = array(
            "script" => array(
                "/js/plugins/lightbox/js/lightbox.min.js",
                "/js/front/product_list.js"
            ),
            "css" => array(
                "/js/plugins/lightbox/css/lightbox.min.css",
            ),
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'newitem');
        $this->load->view(FRONT_FOOTER_2, $footer);
    }

    public function itemdetail($url) {

        $url = $this->uri->segment(3, 0);

        //load product model
        $this->load->model("Product_model");
        $this->load->model("awards/Awards_image_model");

        if (empty($url)) {
            show_404('page');
        }

        //check url if exist
        $product = $this->Product_model->get_all_data(array(
            "select" => array("dp.*", "dpc.pretty_url as category_pretty_url" , "dpc.name as category_name", "vpr.*"),
            "conditions" => array(
                "dp.is_show" => SHOW,
                "dp.pretty_url" => $url,
            ),
            "left_joined" => array(
                "dtb_product_category dpc" => array("dpc.id" => "dp.product_category_id"),
                "view_product_rating vpr" => array("vpr.product_id" => "dp.id")
            ),
            "status" => STATUS_ACTIVE,
            "row_array" => true,
        ))['datas'];

        if(empty($product)) {
            show_404('page');
        }

        //get hot item product
        $hot_items = $this->Product_model->get_all_data(array(
            "conditions" => array(
                "is_show" => SHOW,
                "is_hot_item" => HOT_ITEM_YES
            ),
            "status" => STATUS_ACTIVE,
        ))['datas'];

        $product_like = 0;

        //get product likebox
        if (isset($this->data_login_user['id'])) {
            $is_like = find_like_by_member ($this->data_login_user['id'], LIKEBOX_PRODUCT, $product['id']);
            $product_like = ($is_like) ? 1 : 0;
        }

        //get product awards
        $awards = $this->Awards_image_model->getAwardsImageForProduct($product['id']);

        //get product video
        $video = $this->_dm->set_model("dtb_product_video","dpv","id")->get_all_data(array(
            "conditions" => array(
                "product_id" => $product['id']
            ),
        ))['datas'];

        //get if exist avail color for this product
        $p_color = $this->_dm->set_model("mst_palette_product","mpp","mpp.id")->get_all_data(array(
            "conditions" => array(
                "product_id" => $product['id'],
                "dp.is_show" => SHOW,
                "dp.status" => STATUS_ACTIVE,
            ),
            "left_joined" => array(
                "dtb_pallete dp" => array("dp.id" => "mpp.palette_id"),
            ),
            "row_array" => true,
        ))['datas'];

        $color = (isset($p_color['id'])) ? 1 : 0;

        //get jumlah warna untuk product ini
        $total_color = $this->Product_model->get_total_color ($product['id']);

        // Ambil semua review untuk produk ini
        $all_review = $this->_dm->set_model("trs_product_review", "tpr", "id")->get_all_data(array(
            "select" => "tpr.*, dm.name",
            "conditions" => array(
                "dp.pretty_url" => $url,
            ),
            "left_joined" => array(
                "dtb_product dp" => array("dp.id" => "tpr.foreign_key"),
                "dtb_member dm" => array("dm.id" => "tpr.member_id")
            ),
            "order_by" => array("review_datetime" => "desc")
        ))['datas'];

        // Ambil semua comment untuk produk ini
        $all_comment = $this->_dm->set_model("trs_product_discussion", "tpd", "id")->get_all_data(array(
            "select" => "tpd.*, dm.name",
            "conditions" => array(
                "dp.pretty_url" => $url,
                "tpd.type" => 1
            ),
            "left_joined" => array(
                "dtb_product dp" => array("dp.id" => "tpd.foreign_key"),
                "dtb_member dm" => array("dm.id" => "tpd.member_id")
            ),
            "order_by" => array("discuss_datetime" => "desc")
        ))['datas'];

        // Ambil semua reply
        if($all_comment) {
            foreach($all_comment as $key => $value) {
                $all_comment[$key]['reply'] = $this->_dm->set_model("trs_product_discussion", "tpd", "id")->get_all_data(array(
                    "select" => "tpd.*, dm.name",
                    "conditions" => array("discussion_topic_id" => $value['id']),
                    "left_joined" => array(
                        "dtb_member dm" => array("dm.id" => "tpd.member_id")
                    ),
                ))['datas'];
            }
        }

        // Ambil view_product_rating
        $vpr = $this->_dm->set_model("view_product_rating", "vpr", "product_id")->get_all_data(array(
            "select" => array("vpr.*"),
            "conditions" => array("product_id" => $product['id']),
            "row_array" => true
        ))['datas'];

        #pr($all_comment);exit;

        // For more colors 
        $product_palette = $this->_dm->set_model("mst_palette_product", "product", "id")->get_all_data(array(
            "select" => array("*"),
            "conditions" => array("product_id" => $product['id']),
            'debug' => false,
        ))['datas'];

        $result_color_list = "";


        if ($product_palette) {
            foreach ($product_palette as $d) {
                $product_color = $this->_dm->set_model("mst_palette_color", "a", "id")->get_all_data(array(
                    "select" => array("`a`.* , `b`.name , `b`.code , `b`.red , `b`.green , `b`.blue , `b`.id as colid"),
                    "conditions" => array("a.palette_id" => $d['palette_id'] ),
                    "joined" =>  array(
                        "dtb_color b" => array("a.color_id" => "b.id"),
                    ),
                    "limit" => 5,
                    "order_by" => array("a.id" => "asc"),
                    // 'debug' => true,
                ))['datas'];

                if ($product_color) {
                    foreach ($product_color as $c) {
                        
                        $result_color_list .= '<div style="background-color: rgb('.$c['red'].','.$c['green'].','.$c['blue'].')" class="card-warna font-sofia-light swiper-slide">';
                        $result_color_list .= '<a href="/color/detail?color_id='.$c['colid'].'"><span>'.$c['name'].'</span></a>';
                        $result_color_list .= '</div>';

                    }
                }
            }
        }

        $page = array(
            "title"      => $product['name'],
            "meta_desc"  => $product['meta_desc'],
            "meta_keys"  => $product['meta_keys'],
        );

        $header = array(
            'header'        => $page,
            'hot_items'     => $hot_items,
            'model'         => $product,
            'product_like'  => $product_like,
            'awards'        => $awards,
            'video'         => $video,
            'color'         => $color,
            'all_review'    => $all_review,
            'all_comment'   => $all_comment,
            'vpr'           => $vpr,
            'total_color'   => $total_color,
            'scroll_hide'   => true,
            'result_color_list' => $result_color_list,
        );

        $footer = array(
            "script" => array(
                "/js/front/product.js",
                "/js/plugins/sweetalert.min.js",
                "/js/plugins/jquery.form.min.js",
                "/js/plugins/jquery.validate.min.js",
                "//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ae74c4dc6f7454b"
            ),
            "css" => array(
                "/css/sweetalert.css",
            )
        );

        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'item' );
        $this->load->view(FRONT_FOOTER_2);
    }


    

    public function hitung_produk(){

        $pretty_url  = $this->input->post('pretty_url');
        $product = $this->Product_model->get_all_data(array(
            "select" => array("dp.*"),
            "conditions" => array(
                "dp.is_show" => SHOW,
                "dp.pretty_url" => $pretty_url,
            ),
            "status" => STATUS_ACTIVE,
            "row_array" => true,
        ))['datas'];

        // Jika type perhitungan manual
        if ($_POST['type'] == '2') {
            $luas = $_POST['tinggi'] * $_POST['lebar'];
        // Jika type perhitungan sudah tau langsung luasnya
        } else if($_POST['type'] == '1') {
            $luas = $_POST['luas'];
        }

        $spread_rate = $product['spread_rate'];
        $sizes       = $product['packaging'];

        $kebutuhan_luas = $luas / $spread_rate;
        $kebutuhan_luas = ceil($kebutuhan_luas);

        $encode['after_calculate'] = $kebutuhan_luas;

        $sizes = explode(';' , $sizes);
        rsort($sizes);
        $count = [];
        $sisa = $kebutuhan_luas;       
        $encode['total_area']=  $luas;
        
        $hasil="<ul>";
        for ($i=0; $i < count($sizes) ; $i++) { 
            /* Inisialisasi declarasi tiap tanki berawal dari 0 */
            $count[ $sizes[$i] ] = 0;
            /* Testing untuk mengurangi dengan tangki ke $i 0 */
            $sisa = $sisa - $sizes[$i];
            // Apakah hasilnya lebih dari 0 setelah dikurangi ?
            if ( $sisa > 0 ) {
                //Jika tangki ke i memiliki sisa. kita butuh tangki ke i dan counter + 1
                $count[ $sizes[$i] ] = $count[ $sizes[$i] ] + 1;

                // Tes , dikurangi lagi
                $sisa = $sisa - $sizes[$i];
                if ($sisa < 0 ) {
                    $sisa = $sisa + $sizes[$i];
                } else {
                    while ($sisa > 0) {
                        $sisa = $sisa - $sizes[$i];
                        $count[ $sizes[$i] ] = $count[ $sizes[$i] ] + 1;
                    }
                    if ($sisa < 0) {
                        $sisa = $sisa + $sizes[$i];
                    } 
                    else  {
                        $count[ $sizes[$i] ] = $count[ $sizes[$i] ] + 1;
                    }
                }
            } else if( $sisa == 0 ) {
                $count[ $sizes[$i] ] = $count[ $sizes[$i] ] + 1;
            }  else if( $sisa < 0 )  {
                $sisa = $sisa + $sizes[$i];
            } 

            $hasil .= "<li> Ukuran " . $sizes[$i].' '.$product['satuan'].' x '.$count[ $sizes[$i] ].' </li>' ;
        }
        $hasil .= "<ul>";

        $encode['text'] = $hasil;
       

        echo json_encode($encode);

    }

	
}
