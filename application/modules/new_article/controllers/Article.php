<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Index Controller.
 */
class Article extends Basepublic_Controller  {

    private $_view_folder = "new_article/front/";

    /**
	 * constructor.
	 */
    public function __construct() {
        parent::__construct();
    }


    public function index() {

        $page = get_page_detail('article');

        $limit = 6;
        $start = 0;
        $data = $this->_dm->set_model("dtb_article", "da", "id")->get_all_data(array(
            "order_by" => array("date" => "desc"),
            "count_all_first" => true,
        ));

        $articles = $data['datas'];
        $total_page = ceil($data['total']/$limit);

        //get all stickies
        $stickies = $this->_dm->set_model("dtb_article", "da", "id")->get_all_data(array(
            "order_by" => array("date" => "desc"),
            "conditions" => array(
                "is_show" => SHOW,
                "sticky_flag" => STICKIE_FLAG_YES,
            ),
            // "filter_or" => array( "da.judul NOT" => "%CSR%"  ), 
            "status" => STATUS_ACTIVE,
            // "debug" => true
        ))['datas'];

        $header = array(
            'header'        => $page,
            'models'        => $articles,
            'stickies'      => $stickies,
            'article_page'  => $total_page,

        );

        $footer = array(
            "script" => array(
                "/js/front/article.js",
            ),
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'index' );
        $this->load->view(FRONT_FOOTER_2);
    }

     public function test_notfound() {

        $page = get_page_detail('article');
$header = array(
            'header'        => $page,);
       //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'blank' );
        $this->load->view(FRONT_FOOTER_2);
    }


    function artikel(){
        $page = get_page_detail('article');

       
        $header = ['header' => $page , 'scroll_hide' => true];
        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'artikel' );
        $this->load->view(FRONT_FOOTER_2);
    }

    function detail_article(){
        $art_url = $this->uri->segment(3, 0);

        //union csr ke artikel
        if (strtolower($art_url) == "csr") {
            $art_url = $this->uri->segment(4, 0);
        }

        if (empty($art_url)) {
            show_404('page');
        }

        //check store url
        $article = $this->_dm->set_model("dtb_article", "va", "id")->get_all_data(array(
            "conditions" => array(
                "pretty_url" => $art_url,
            ),
            "row_array" => true,

        ))['datas'];

        //get 4 random article beside this id
        $r_article = $this->_dm->set_model("dtb_article", "va", "id")->get_all_data(array(
            "conditions" => array(
                "pretty_url != " => $art_url,
            ),
            "limit" => 4,
            "order_by" => array("rand()" => "")
        ))['datas'];

        $page = array(
            "title" =>     $article['title'],
            "meta_desc" => $article['meta_desc'],
            "meta_keys" => $article['meta_keys'],
        );

        $header = array(
            "title"      => $article['title'],
            "meta_desc"  => $article['meta_desc'],
            "meta_keys"  => $article['meta_keys'],
            'model'      => $article,
            'r_article'  => $r_article,
            'header'     => $page,
            'scroll_hide' => true
        );
        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'artikel_detail' );
        $this->load->view(FRONT_FOOTER_2);
    }


	
}
