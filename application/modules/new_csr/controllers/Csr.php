<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Csr Controller.
 */
class Csr extends Basepublic_Controller  {

    private $_view_folder = "new_csr/front/";

    private $_table = "mst_csr";
    private $_table_aliases = "mc";
    private $_pk = "mc.id";


    public function index() {
        //get header page
        $page = get_page_detail('csr');

        $header = array(
            'header'            => $page,
        );

        // $footer = array(
        //     "script" => array(
        //         "/js/front/plugins/infobox.min.js",
        //         "/js/front/plugins/jquery-ui.min.js",
        //         "/js/front/plugins/jquery.selectBoxIt.min.js",
        //         "/js/front/csr.js"
        //     ),
        //     "css" => array(
        //         "/css/front/jquery-ui.min.css",
        //         "/css/front/jquery.selectBoxIt.css"
        //     ),
        //     "script_http" => array(
        //         "https://maps.googleapis.com/maps/api/js?key=". GOOGLE_API_KEY ."&libraries=geometry",
        //     )
        // );

        //get session search
        $data['ss_search']      = $this->session->userdata('uv_csr_search');
        $data['ss_search_type'] = $this->session->userdata('uv_csr_search_type');

        // Get all csr data
        $csr_list = $this->_dm->set_model("mst_csr", "mc", "mc.id")->get_all_data(array(
            "select" => array(
                "mc.id",
                "mc.type",
                "mc.latitude",
                "mc.longitude",
                "mc.image_landing",
                "mc.lokasi",
                "mc.ordering",
                "mca.pretty_url",
                "mc.judul",
                "mca.content",
                "mca.content_device",
                "mca.short_content",
            ),
            "order_by" => array("ordering" => "asc"),
            "count_all_first" => true,
            "left_joined" => array(
                "mst_csr_artikel mca" => array("mca.id" => "mc.artikel_csr_id"),
            ),
            "conditions" => array("mc.is_show" => 1),
        ));

        $csr = $csr_list['datas'];

        if($csr) {
            // Get all csr slider
            foreach($csr as $key => $value) {
                $csr_id = $value['id'];

                $slider = $this->_dm->set_model("trs_csr_slider", "tcs", "tcs.id")->get_all_data(array(
                    "conditions" => array("csr_id" => $csr_id, "is_show" => 1),
                    "order_by" => array("ordering" => "asc"),
                    
                    // 'debug' => true

                ))['datas'];

                $csr[$key]['slider'] = $slider;
            }
        }


        $data['location'] = $this->_dm->set_model("mst_csr", "mc", "mc.id")->get_all_data(array(
            "select" => array("lokasi"),
            "conditions" => array(
                "is_show" => SHOW,
                "lokasi != ''" => NULL,
            ),
            "order_by" => array("lokasi" => "asc"),
            "group_by" => "lokasi"
        ))['datas'];

        $data['csr'] = $csr;
        $data['csr_total'] = $csr_list['total'];
        // $data['scroll_hide'] = true;

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'index', $data);
        $this->load->view(FRONT_FOOTER_2);
	}

    public function read_csr(){
        $this->db->save_queries  = TRUE;
        $data                    = [];
        $conditions              = [];
       

        if ($_POST['filter_places'] == 0 && $_POST['filter_tipe'] == 0 ) {

            $conditions['is_show']   = SHOW;
            $conditions['lokasi != '] = NULL;

            
            $data['result'] = $this->_dm->set_model("mst_csr", "mc", "mc.id")->get_all_data(array(
                "select" => array("pretty_url","judul","short_content","latitude" , "longitude" , "type" , "id","lokasi"),
                "conditions" => $conditions ,
                "order_by" => array("lokasi" => "asc"),
            ))['datas'];
            $data['q'] = $this->db->last_query();


        } else {

            if ($_POST['filter_places'] != '0') {
                $conditions['lokasi'] = $_POST['filter_places'];        
            }
            if ($_POST['filter_tipe'] != '0') {
                $conditions['type']   = $_POST['filter_tipe'];  
            }

           

            $data['result'] = $this->_dm->set_model("mst_csr", "mc", "mc.id")->get_all_data(array(
                "select" => array("*"),
                "conditions" => $conditions ,
                "order_by" => array("lokasi" => "asc"),
            ))['datas'];
            $data['q'] = $this->db->last_query();

        }

        if (count($data['result']) > 0) {
            $data['status'] = 200;
        }  else { 
            $data['status'] = 400;
        }

        echo json_encode($data);

    }



    public function detail ($id = null) {
        $art_url = $this->uri->segment(2, 0);

        $page = get_page_detail('csr-detail');

        if (empty($art_url)) {
            show_404('page');
        }

        // Get all csr data
        $csr = $this->_dm->set_model("mst_csr", "mc", "mc.id")->get_all_data(array(
            "select" => array(
                "mc.id",
                "mc.type",
                "mc.latitude",
                "mc.longitude",
                "mc.image_landing",
                "mc.lokasi",
                "mc.ordering",
                "mca.pretty_url",
                "mca.judul",
                "mca.content",
                "mca.content_device",
                "mca.short_content",
                "mca.meta_keys",
                "mca.meta_desc",
                "(select image_slider from trs_csr_slider tcs where tcs.csr_id = mc.id and is_show = 1 order by ordering asc limit 1) as image_landing_big"
            ),
            "conditions" => array("mca.pretty_url" => $art_url, "mc.is_show" => 1),
            "row_array" => true,
            "left_joined" => array(
                "mst_csr_artikel mca" => array("mca.id" => "mc.artikel_csr_id"),
            )
        ))['datas'];

        if (empty($csr)) {
            show_404('page');
        }

        $data['csr'] = $csr;

        //get 4 random csr beside this id
        $data['r_csr'] = $this->_dm->set_model("mst_csr", "mc", "mc.id")->get_all_data(array(
            "conditions" => array(
                "is_show" => SHOW,
                "id != " => $csr['id'],
            ),
            "limit" => 4,
            "order_by" => array("rand()" => ""),
        ))['datas'];

        $header = array(
            "title"      => $csr['judul'],
            "header"     => array(
                "name" => $csr['judul'],
                "title" => $csr['judul'],
                "meta_keys" => $csr['meta_keys'],
                "meta_desc" => $csr['meta_desc'],
            )
        );

        $footer = array(
            "script" => array(
                "/js/front/csr_detail.js"
            )
        );

        //load the views.
        $this->load->view(FRONT_HEADER, $header);
        $this->load->view($this->_view_folder . 'detail' , $data);
        $this->load->view(FRONT_FOOTER, $footer);
    }

    public function get_data () {
        if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

        $search = sanitize_str_input($this->input->post('search'));
        $search_type = sanitize_str_input($this->input->post('search_type'));

        $conditions = array(
            "mc.is_show" => SHOW,
            "(latitude != '' AND latitude is not null)" => NULL,
            "(longitude != '' AND longitude is not null)" => NULL,
        );

        if (!empty($search)) {
            $conditions['lower(lokasi)'] = strtolower($search);
        }

        if (!empty($search_type)) {
            $conditions['type'] = $search_type;
        }

        //set model
        $model_csr = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk);
        $datas = $model_csr->get_all_data (array(
            "select" => array(
                "mc.id",
                "mc.type",
                "mc.latitude",
                "mc.longitude",
                "mc.image_landing",
                "mc.lokasi",
                "mc.ordering",
                "mca.pretty_url",
                "mc.judul",
                "mca.content",
                "mca.content_device",
                "mca.short_content",
            ),
            "status" => STATUS_ALL,
            "conditions" => $conditions,
            "order_by" => array($this->_table_aliases.".created_date" => "desc"),
            "left_joined" => array(
                "mst_csr_artikel mca" => array("mca.id" => "mc.artikel_csr_id"),
            )
        ))['datas'];


        $message['datas'] = $datas;

        //set store session
        $this->session->set_userdata('uv_csr_search', $search);
        $this->session->set_userdata('uv_csr_search_type', $search_type);

        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }
}
