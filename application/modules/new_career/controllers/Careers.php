<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Index Controller.
 */
class Careers extends Basepublic_Controller  {

    private $_view_folder = "new_career/front/";

    private $_table = "dtb_vacancy";
    private $_table_aliases = "dv";
    private $_pk = "id";

    public function __construct() {
        parent::__construct();
    }

    public function index($act="") {

        if ($act == "") {
            $like = "avian";
        } else {
            $like = "tirta";
        }

        //get header page
        $page = get_page_detail('career');

        $model_vac = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk);
        $lists = $model_vac->get_all_data (array(
            "status" => STATUS_ACTIVE,
            "conditions" => array(
                "is_show" => SHOW,
                "available_to_date >=" => date('Y-m-d'),
            ),
            "filter" => array(
                "title" => $like,
            ),
            // "debug" => true,
        ))['datas'];

        $position = $model_vac->get_all_data (array(
            "select" => "position",
            "status" => STATUS_ACTIVE,
            "conditions" => array(
                "is_show" => SHOW,
                "available_to_date >=" => date('Y-m-d'),
            ),
            "group_by" => "position",
            // "debug" => true,
        ))['datas'];

        $penempatan = $model_vac->get_all_data (array(
            "select" => "location",
            "conditions" => array("location !=" => ''),
            "group_by" => "location",
            // "debug" => true,
        ))['datas'];

        $pt = $model_vac->get_all_data (array(
            "select" => "title",
         
            "group_by" => "title",
            // "debug" => true,
        ))['datas'];

        $header = array(
            'header'    => $page,
            'models'    => $lists,
            "position"  => $position,
            "location"  => $penempatan,
            "pt" => $pt
        );


        // $data

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'index');
        $this->load->view(FRONT_FOOTER_2);
    }

    public function filter_career(){

        $title          =  isset($_GET["title"]) ? $_GET["title"] : NULL;
        $position       =  isset($_GET["position"]) ? $_GET["position"] : NULL;
        $location       =  isset($_GET["location"]) ? $_GET["location"] : NULL;
        $type_pekerjaan =  isset($_GET["type_pekerjaan"]) ? $_GET["type_pekerjaan"] : NULL;
        $created_at     =  isset($_GET["created_at"]) ? $_GET["created_at"] : NULL;


        $conditions['is_show'] =  SHOW;


        $conditions['title']                =  $title;
        $conditions['position']             =  $position;
        $conditions['location']             =  $location;
        $conditions['type_pekerjaan']       =  $type_pekerjaan;
        $conditions['available_to_date >='] =  $created_at;

        $model_vac = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk);
        $lists = $model_vac->get_all_data (array(
            "status" => STATUS_ACTIVE,
            "conditions" => $conditions,
            
            "debug" => true,
        ))['datas'];        






    }


    public function detail($id){
        if (!$id || $id == 0 || $id == "") {
            show_404('page');
        }

        $model_vac = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk);
        $data_vac = $model_vac->get_all_data(array(
            "find_by_pk" => array($id),
            "status" => STATUS_ACTIVE,
            "row_array" => true,
        ))['datas'];

        if (empty($data_vac) || (!empty($data_vac) && $data_vac['available_to_date'] < date('Y-m-d'))) {
            show_404('page');
        }

        $page = array(
            "title"      => $data_vac['title'],
            "meta_desc"  => $data_vac['meta_desc'],
            "meta_keys"  => $data_vac['meta_keys'],
        );

        $header = array(
            'header'    => $page,
            'model'     => $data_vac,
        );

        $footer = array(
            "script" => array(
                "/js/front/plugins/jqui.datepicker.min.js",
                "/js/plugins/jquery.validate.min.js",
                "/js/plugins/jquery.form.min.js",
                "/js/front/career.js"
            ),
            "css" => array(
                "/css/front/datepicker.min.css",
            ),
        );

        //load the views.
        $this->load->view(FRONT_HEADER_2, $header);
        $this->load->view($this->_view_folder . 'detail');
        $this->load->view(FRONT_FOOTER_2, $footer);
    }

    /////////////////////SET RULES//////////////////////////

    public function setRuleValidation () {

        $this->form_validation->set_rules("name", "Fullname", "required");
        $this->form_validation->set_rules("dob", "Date of Birth", "required");
        $this->form_validation->set_rules("email", "Email Address", "required");
        $this->form_validation->set_rules("address", "Address", "required");
    }

    /////////////////////PROCESSS//////////////////////////

    function lamar(){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        //load form validation lib.
        $this->load->library('form_validation');

        $message = array();
        $message['is_error'] = true;
        $message['is_redirect'] = false;
        $message['error_count'] = 1;
        $data = array();

        $this->setRuleValidation();

        $file_error = false;

        //load the uploader library.
        $this->load->library('Uploader');

        $config = array(
            "allowed_types"         =>  FILE_TYPE_UPLOAD,
            "file_ext_tolower"      =>  true,
            "overwrite"             =>  false,
            "max_size"              =>  MAX_UPLOAD_IMAGE_SIZE_IN_KB,
            "upload_path"           =>  "upload/career/one-apply",
        );

        //try to upload the image.
        $upload_result = $this->uploader->upload_files('inputfile', false, $config);

        //check file
        if ($upload_result['is_error']) {
            if ($upload_result['result'][0]['error_code'] == 0) {
                //file upload error of something.
                //show the error.
                $data = "CV must be filled.";
            } else {
                $data = $upload_result['result'][0]['error_msg'];
            }

            //encoding and returning.
            $this->output->set_content_type('application/json');
            echo json_encode($message);
            exit;
        }

        if ($this->form_validation->run() == FALSE) {
            $message['is_redirect'] = false;
            $data = validation_errors();
            $count = count($this->form_validation->error_array());
            $message['error_count'] = $count;
        } else {
            $name   = sanitize_str_input($this->input->post('name'));
            $dob    = date("Y-m-d" ,strtotime($this->input->post('dob')));
            $email  = sanitize_str_input($this->input->post('email'));
            $address= sanitize_str_input($this->input->post('address'));
            $apply_for= sanitize_str_input($this->input->post('apply_for'), "numeric");

            $datas = array (
                "fullname"  => $name,
                "email"     => $email,
                "dob"       => $dob,
                "address"   => $address,
                "vacancy_id"=> $apply_for,
                "type"      => TYPE_APPLICANT_ONE,
                "file_path" => $upload_result['result']['uploaded_path'],
            );

            $model_app = $this->_dm->set_model("dtb_applicants", "dap", "id");

            $this->db->trans_begin();

            $insert = $model_app->insert($datas);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $data = "database operation failed.";

            } else {
                $this->db->trans_commit();

                $message['is_error'] = false;
                $message['is_redirect'] = true;
                $message['error_count'] = 0;

                $this->send_tomail ($datas,$apply_for);

            }
        }

        $message['data'] = $data;
        $this->output->set_content_type('application/json');
        echo json_encode($message);

        exit;

    }


	
}
