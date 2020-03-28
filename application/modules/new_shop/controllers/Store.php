<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends Basepublic_Controller {

    private $_view_folder = "new_shop/front/";

    private $map= true;

    function __construct() {
        parent::__construct();
        $this->load->model("Store_model");

    }

    public function index() {
        $nama_product = urldecode($this->uri->segment(3, 0));

        if (!empty($nama_product)) {
            $this->session->set_userdata('uv_store_search', array(
                'lat' => 0,
                'long' => 0,
                'lat_user' => 0,
                'long_user' => 0,
                'distance' => 0,
                'cust_color' => 0,
                'search' => $nama_product,
                'search_by' => 3,
                'datas' => array(),
                // 'o_datas' => $o_datas,
                'category' => array(),
                'zoom' => false,
            ));
        }

        //get header page
		$page = get_page_detail('store');

        //get store data
        $model_store = new Store_model();

        $ss_search = $this->session->userdata('uv_store_search');

		//get product category
		$pcategory = $this->_dm->set_model("dtb_product_category" , "dpc", "id")->get_all_data(array(
            "conditions" => array(
                "is_show" => SHOW,
                "show_in_store_filter" => SHOW
            ),
        ))['datas'];

        if (count($pcategory) > 0) {
            foreach ($pcategory as $key => $model) {
                $pcategory[$key]['product'] = $this->_dm->set_model("dtb_product" , "dp", "id")->get_all_data(
                    array(
                    "conditions" => array(
                        "is_show" => SHOW,
                        "product_category_id" => $model['id']
                    ),
                    "status" => STATUS_ACTIVE,
                ))['datas'];
            }
        }

        $header = array(
            'header'        => $page,
            'ss_search'     => $ss_search,
            'pcategory'     => $pcategory,
            'scroll_hide'   => true
        );

        $footer = array(
            "script" => array(
                "/js/plugins/infobox.js",
                "/js/plugins/markerclusterer.js",
                "/js/plugins/markerwithlabel.min.js",
                "/js/front/gmaps.js",
            ),
           
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'index');
        $this->load->view(FRONT_FOOTER_2, $footer);


	}

    public function cabang(){

        $page = get_page_detail('store');


        $conditions['is_show']   = 1;
        $conditions['status']   = 1 ;


        $data['location'] = $this->_dm->set_model("dtb_branch", "db", "db.id")->get_all_data(array(
            "select" => array("province"),
            "conditions" => $conditions ,
            "group_by" => "province",
            "order_by" => ['province' => 'asc'],
        ))['datas'];


        $header = array(
            'header'    => $page,
            "lokasi"    => $data['location'],
             'scroll_hide'   => true
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder.'cabangnew');
        $this->load->view(FRONT_FOOTER_2);

    }

    public function read_cabang(){

        if (!$this->input->is_ajax_request()) {
            exit(' No Script Acces allowed');
        }
        $data                    = [];
        $conditions              = [];
        $conditions['is_show']   = 1;
        $conditions['status']    = 1;

        if ($this->input->post('filter_places') != "0") {   
            $conditions['province'] = $this->input->post('filter_places');
        }
        $data['result'] = $this->_dm->set_model("dtb_branch", "db", "db.id")->get_all_data(
            array(
                "select" => array("id" , "province" , "map_address" , "latitude", "longitude" , "email" ,"name" ,"telephone"),
                "conditions" => $conditions ,
            )
        )['datas'];
        $data['q'] = $this->db->last_query();

        if (count($data['result']) > 0) {
            $data['status'] = 200;
        }  else { 
            $data['status'] = 400;
        }
        echo json_encode($data);
    }

    function read_store(){

        if (!$this->input->is_ajax_request()) {
            exit(' No Script Acces allowed');
        }
        $data                    = [];
        $conditions              = [];
        $conditions['is_active']   = 1;
        // $conditions['status']    = 1;

        if ($this->input->post('filter_places') != "0") {   
            $conditions['province'] = $this->input->post('filter_places');
        }
        $data['result'] = $this->_dm->set_model("dtb_store_v2", "db", "db.customer_id")->get_all_data(
            array(
                "select" => array("customer_id" , "latitude", "longitude" , "nama_customer" ,"alamat" ,"telepon"),
                "conditions" => $conditions ,
                "limit" => 1000,
            )
        )['datas'];
        $data['q'] = $this->db->last_query();

        if (count($data['result']) > 0) {
            $data['status'] = 200;
        }  else { 
            $data['status'] = 400;
        }
        echo json_encode($data);



    }



    public function read_(){

        $maps = $this->_dm->set_model("dtb_store_v2", "a", "a.customer_id")->get_all_data(array(
            "conditions" => array(
                "is_active" => 1,
            ),
            "select" => "a.customer_id , a.latitude ,  a.longtitude"
        ))['datas'];

        echo "<pre>";
        print_r($maps);


    }



    public function detail() {
        $store_url = $this->uri->segment(3, 0);

        if (empty($store_url)) {
            show_404();
        }

		$store = $this->Dynamic_model->set_model("mst_store_addon","msa","msa.kode_customer")->get_all_data(array(
            "conditions" => array(
                "pretty_url" => $store_url,
                "is_show"    => SHOW,
            ),
            "left_joined"     => array(
                "dtb_store_v2 v2" => array("v2.kode_customer" => "msa.kode_customer")
            ),
            "row_array" => true,
        ))['datas'];

        $ss_search = $this->session->userdata('uv_store_search');

		if (!$store) {
			//return error not found
			show_404('page');
		}

        //get 8 random id from ss_search
        $datas = (($ss_search['datas']) ? $ss_search['datas'] : array());

        $rand_keys = array();

        if (count($datas) > 1) {
            //get random keys
            $total = count($datas);
            if ($total > 8) $total_rand = 8;
            else $total_rand = $total-1;

            for($i = 0; $i < $total_rand; $i++) {
                do {
                    $key = rand ( 0 , $total-1 );

                    $keyExist = array_search($key,$rand_keys);

                    if ($keyExist === false) {
                        $isExist = ($datas[$key]['pretty_url'] == $store_url);

                    } else {
                        $isExist = true;
                    }
                } while ($isExist == true);

                $rand_keys[] = $key;
            }

        }

		//get store likebox
        if (isset($this->data_login_user['id'])) {
            $is_like = find_like_by_member ($this->data_login_user['id'],LIKEBOX_STORE,$store['id']);
            $store_like = ($is_like) ? 1 : 0;
        } else {
            $store_like = 0;
        }

        // Ambil semua review untuk produk ini
        $all_review = $this->_dm->set_model("trs_store_review", "tsr", "id")->get_all_data(array(
            "select" => "tsr.*, dm.name",
            "conditions" => array(
                "ds.pretty_url" => $store_url,
            ),
            "left_joined" => array(
                "dtb_store ds" => array("ds.store_code" => "tsr.foreign_key"),
                "dtb_member dm" => array("dm.id" => "tsr.member_id")
            ),
            "order_by" => array("review_datetime" => "desc")
        ))['datas'];

        // Ambil semua comment untuk produk ini
        $all_comment = $this->_dm->set_model("trs_store_discussion", "tpd", "id")->get_all_data(array(
            "select" => "tpd.*, dm.name",
            "conditions" => array(
                "dp.pretty_url" => $store_url,
                "tpd.type" => 1
            ),
            "left_joined" => array(
                "dtb_store dp" => array("dp.store_code" => "tpd.foreign_key"),
                "dtb_member dm" => array("dm.id" => "tpd.member_id")
            ),
            "order_by" => array("discuss_datetime" => "desc")
        ))['datas'];

        // Ambil semua reply
        if($all_comment) {
            foreach($all_comment as $key => $value) {
                $all_comment[$key]['reply'] = $this->_dm->set_model("trs_store_discussion", "tpd", "id")->get_all_data(array(
                    "select" => "tpd.*, dm.name",
                    "conditions" => array("discussion_topic_id" => $value['id']),
                    "left_joined" => array(
                        "dtb_member dm" => array("dm.id" => "tpd.member_id")
                    ),
                ))['datas'];
            }
        }

        // Ambil view_store_rating
        $vsr = $this->_dm->set_model("view_store_rating", "vsr", "foreign_key")->get_all_data(array(
            "select" => array("vsr.*"),
            "conditions" => array("dp.pretty_url" => $store_url,),
            "left_joined" => array(
                "mst_store_addon dp" => array("dp.kode_customer" => "vsr.foreign_key"),
            ),
            "row_array" => true
        ))['datas'];

        // pr($vsr); exit;

        $distance_store = 0;

        //get distance store
        if (!empty($datas)) {
            $key_search = searchForId($store['kode_customer'], $datas, "kode_customer");

            if (isset ($datas[$key_search]['user_distance'])) {
                $distance_store = $datas[$key_search]['user_distance'];
            } else {
                $distance_store = 0;
            }


        }

		$page = array(
			"title" => $store['nama_customer'],
			"meta_desc" => $store['meta_desc'],
			"meta_keys" => $store['meta_keys'],
		);

        $header = array(
            'header'    => $page,
            'model'		=> $store,
			'datas'	    => $datas,
			'rand_keys'	=> $rand_keys,
			'store_like'=> $store_like,
            'all_review' => $all_review,
            'all_comment'   => $all_comment,
            'vsr'           => $vsr,
            'distance_store'    => $distance_store
        );

        $footer = array(
            "script" => array(
                "/js/front/store.js",
                "/js/plugins/sweetalert.min.js",
                "/js/plugins/jquery.form.min.js",
                "/js/plugins/jquery.validate.min.js",
                "//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ae74c4dc6f7454b",
            ),
            "css" => array(
                "/css/sweetalert.css",
            )
        );

        //load the views.
        $this->load->view(FRONT_HEADER, $header);
        $this->load->view($this->_view_folder . 'detail');
        $this->load->view(FRONT_FOOTER, $footer);


	}

    public function get_data () {
        if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

        $this->load->library("Cluster");

        $lat = $this->input->post('lat');
        $long = $this->input->post('lng');
        $lat_user = $this->input->post('lat_user');
        $long_user = $this->input->post('lng_user');
        $distance = $this->input->post('distance');
        $premium = null;
        $cust_color = $this->input->post('cust_color');
        $search = $this->input->post('search');
        $search_by = $this->input->post('search_by');
		$category = $this->input->post('category');
		$products = array();
		$zoom = $this->input->post('zoom');

        $model_store = new Store_model();

        $latitude_moved = "";
        $longitude_moved = "";

        $category_list = array();

        if (!empty($category)) {
            if (array_search("3",$category) !== FALSE) $category[] = 6;
            $category_ids = implode("','", $category);
            $category_list = $this->_dm->set_model("mst_store_product_search" , "msp", "store_column")->get_all_data (array(
                "conditions" => array(
                    "product_id in ('". $category_ids ."')" => NULL
                ),
                "select" => "store_column",
            ))['datas'];
        }

		if ($search_by == 3) {
			//get all product ids where name like this keywords
			$products = $this->_dm->set_model("mst_store_product_search" , "msp", "store_column")->get_all_data (array(
                "filter" => array("lower(product_name)" => strtolower($search)),
                "select" => "store_column",
            ))['datas'];

			$_product = $model_store->getLatLongByProductNameLimit1 ($products);
			// print_r($_product); exit;
			if (!empty($_product)) {
				$latitude_moved = $_product['latitude'];
				$longitude_moved = $_product['longitude'];
			}
		} else if ($search_by == 2) {
			$_store = $model_store->getLatLongByNameLimit1 ($search,$category_list,$lat_user,$long_user);
            if (!empty($_store)) {
				$latitude_moved = $_store['latitude'];
				$longitude_moved = $_store['longitude'];
			}
		}

        $s_datas = $model_store->getStoreByRadiusRAND ($lat_user,$long_user,$lat,$long,$distance,1000,$premium,$cust_color,$search,$search_by,$category_list,$products);


		$clusterPoint = $s_datas;

		$cluster = new Cluster;
		if ($zoom >= 19) {
			$jarak = 0;
		} else if ($zoom >= 15 && $zoom < 19) {
			$jarak = 50;
		} else if ($zoom >= 10 && $zoom < 15) {
			$jarak = 70;
		} else {
			$jarak = 100;
		}
		if (count($s_datas) > 0 && $zoom < 19) $clusterPoint = $cluster->createCluster($s_datas, $jarak , $zoom, 0);


        $message['datas'] = $clusterPoint;
        // $message['o_datas'] = $o_datas;
        $message['latitude_moved'] = $latitude_moved;
        $message['longitude_moved'] = $longitude_moved;

        //set store session
        $this->session->set_userdata('uv_store_search', array(
            'lat' => $lat,
            'long' => $long,
            'lat_user' => $lat_user,
            'long_user' => $long_user,
            'distance' => $distance,
            'cust_color' => $cust_color,
            'search' => $search,
            'search_by' => $search_by,
            'datas' => $s_datas,
            // 'o_datas' => $o_datas,
            'category' => $category,
            'zoom' => $zoom,
        ));

        echo json_encode($message);
        exit;

    }

    public function save_review () {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        // Declare variable here
        $message['is_error']    = true;
        $message['error_msg']   = "";
        $message['redirect_to'] = "";

        // Populate form fields
        $rating         = $this->input->post('rating');
        $review_title   = $this->input->post('review_title');
        $review_content = $this->input->post('review_content');
        $store_id       = $this->input->post('store_id');
        $now            = date("Y-m-d H:i:s");
        $user_id        = "";

        #pr($this->input->post());exit;

        // Kalo rating nya null, jadiin 0
        if(!$rating) {
            $rating = 0;
        }

        // Kalo belum login, ga bs kasih rating
        if (isset($this->data_login_user['id'])) {
            $user_id = $this->data_login_user['id'];
        }
        else {
            $message['error_msg']   = "Untuk memberikan rating, silahkan login terlebih dahulu.";
            echo json_encode($message);
            exit;
        }

        // Gagal jika ga dapet store id
        if(!$store_id) {
            $message['error_msg'] = "Invalid store id.";
            echo json_encode($message);
            exit;
        }

        $this->db->trans_begin();

        $arrayToDb = array(
            "foreign_key"       => $store_id,
            "review_datetime"   => $now,
            "member_id"         => $user_id,
            "rating_score"      => $rating,
            "review_title"      => $review_title,
            "review_content"    => $review_content,
        );

        $extra_params = array("is_direct" => true);

        // Cek apakah user ini sudah pernah kasih review di store ini apa belum
        // Kalo sudah ada : update
        // Belum ada : insert
        $check = $this->_dm->set_model('trs_store_review')->get_all_data(array(
            "conditions" => array("foreign_key" => $store_id, "member_id" => $user_id),
            "row_array" => true
        ))['datas'];

        if($check) {
            // Update
            $arrayToDb['status'] = 3;
            $conditions = array("id" => $check['id']);
            $this->_dm->set_model('trs_store_review')->update($arrayToDb, $conditions, $extra_params);
        }
        else {
            // Insert
            $arrayToDb['status'] = 0;
            $this->_dm->set_model('trs_store_review')->insert($arrayToDb, $extra_params);
        }

        // Check transaction status
        if ($this->db->trans_status() === FALSE) {
            // Failed, rollback
            $this->db->trans_rollback();
            $message['error_msg'] = 'Failed to review! Please try again.';
        }
        else {
            // Success
            $this->db->trans_commit();
            $message['is_error']        = false;
            $message['notif_title']     = "Success!";
            $message['notif_message']   = "Thanks for your review.";
        }

        echo json_encode($message);
        exit;
    }

    public function save_comment () {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        // Declare variable here
        $message['is_error']    = true;
        $message['error_msg']   = "";
        $message['redirect_to'] = "";

        // Populate form fields
        $comment    = $this->input->post('comment');
        $store_id  = $this->input->post('store_id');
        $now        = date("Y-m-d H:i:s");
        $user_id    = "";

        // Kalo belum login, ga bs kasih rating
        if (isset($this->data_login_user['id'])) {
            $user_id = $this->data_login_user['id'];
        }
        else {
            $message['error_msg']   = "Untuk memberikan komentar, silahkan login terlebih dahulu.";
            echo json_encode($message);
            exit;
        }

        // Gagal jika ga dapet store id
        if(!$store_id) {
            $message['error_msg']   = "Invalid store id.";
            echo json_encode($message);
            exit;
        }

        $this->db->trans_begin();

        $arrayToDb = array(
            "foreign_key" => $store_id,
            "discuss_datetime" => $now,
            "member_id" => $user_id,
            "discussion_content" => $comment
        );

        // Insert
        $params = array("is_direct" => true);
        $this->_dm->set_model('trs_store_discussion')->insert($arrayToDb, $params);

        // Check transaction status
        if ($this->db->trans_status() === FALSE) {
            // Failed, rollback
            $this->db->trans_rollback();
            $message['error_msg'] = 'Failed to comment! Please try again.';
        }
        else {
            // Success
            $this->db->trans_commit();
            $message['is_error']        = false;
            $message['notif_title']     = "Success!";
            $message['notif_message']   = "Thanks for your comment.";
        }

        echo json_encode($message);
        exit;
    }

    public function save_reply () {
        // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        // Declare variable here
        $message['is_error']    = true;
        $message['error_msg']   = "";
        $message['redirect_to'] = "";

        // Populate form fields
        $reply_content = $this->input->post('reply_content');
        $discussion_id = $this->input->post('discussion_id');
        $store_id = $this->input->post('store_id');
        $now        = date("Y-m-d H:i:s");
        $user_id = "";

        // Kalo belum login, ga bs kasih reply
        if (isset($this->data_login_user['id'])) {
            $user_id = $this->data_login_user['id'];
        }
        else {
            $message['error_msg']   = "Untuk memberikan balasan, silahkan login terlebih dahulu.";
            echo json_encode($message);
            exit;
        }

        // Gagal jika ga dapet produk id
        if(!$store_id) {
            $message['error_msg']   = "Invalid store id.";
            echo json_encode($message);
            exit;
        }

        $this->db->trans_begin();

        $arrayToDb = array(
            "foreign_key"           => $store_id,
            "discuss_datetime"      => $now,
            "member_id"             => $user_id,
            "type"                  => 2,
            "discussion_topic_id"   => $discussion_id,
            "discussion_content"    => $reply_content
        );

        // Insert
        $params = array("is_direct" => true);
        $this->_dm->set_model('trs_store_discussion')->insert($arrayToDb, $params);

        // Check transaction status
        if ($this->db->trans_status() === FALSE) {
            // Failed, rollback
            $this->db->trans_rollback();
            $message['error_msg'] = 'Failed to reply! Please try again.';
        }
        else {
            // Success
            $this->db->trans_commit();
            $message['is_error']        = false;
            $message['notif_title']     = "Success!";
            $message['notif_message']   = "Replied for this comment is successful.";
        }

        echo json_encode($message);
        exit;
    }
}
