<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Job Offers Controller.
 */
class Job_manager extends Baseadmin_Controller  {

    private $_title         = "Job Offers";
    private $_title_page    = '<i class="fa-fw fa fa-briefcase"></i> Job Offers ';
    private $_breadcrumb    = "<li><a href='".MANAGER_HOME."'>Home</a></li>";
    private $_active_page   = "job_offers";
    private $_back          = "/manager/career/job/lists";
    private $_js_path       = "/js/pages/career/manager/job_offers/";
    private $_view_folder   = "career/manager/job_offers/";
    private $_table         = "dtb_vacancy";
    private $_table_aliases = "job";
    private $_pk            = "id";

    /**
	 * constructor.
	 */
    public function __construct() {
        parent::__construct();

    }

    //////////////////////////////// VIEWS //////////////////////////////////////

    /**
     * List job_offers
     */
    public function lists() {
        //set header attribute.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> List Job Offers</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>Job Offers</li>',
        );

        //set footer attribute (additional script and css).
        $footer = array(
            "script" => array(
                "/js/plugins/datatables/jquery.dataTables.min.js",
                "/js/plugins/datatables/dataTables.bootstrap.min.js",
                "/js/plugins/datatable-responsive/datatables.responsive.min.js",
                $this->_js_path . "list.js",
            ),
        );

        //load the views.
        $this->load->view(MANAGER_HEADER , $header);
        $this->load->view($this->_view_folder . 'index');
        $this->load->view(MANAGER_FOOTER , $footer);
    }

    /**
     * Create job_offers
     */
    public function create() {
        //set header attribute.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> Create Job Offers</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>Job Offers</li>',
        );

        //set footer attribute (additional script and css).
        $footer = array(
            "script" => array(
                "/js/plugins/tinymce/tinymce.min.js",
                $this->_js_path . "create.js"
            ),
        );

        //load the views.
        $this->load->view(MANAGER_HEADER , $header);
        $this->load->view($this->_view_folder . 'create');
        $this->load->view(MANAGER_FOOTER , $footer);
    }

    /**
     * Edit an job_offers
     */
    public function edit ($id = null) {
        if ($id == 0) show_error('Page is not existing', 404);
        $this->_breadcrumb .= '<li><a href="/manager/career/job/lists/">Vacancy</a></li>';

        $data['item'] = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->get_all_data(array(
            "conditions" => array("is_show" => 1),
            "find_by_pk" => array($id),
            "row_array"  => TRUE
        ))['datas'];

        //prepare header title.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> Vacancy</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>Vacancy</li>',
            "back"          => "/manager/career/job/lists",
        );

        //set footer attribute (additional script and css).
        $footer = array(
            "script" => array(
                "/js/plugins/tinymce/tinymce.min.js",
                $this->_js_path . "create.js"
            ),
        );

        //load the view.
        $this->load->view(MANAGER_HEADER, $header);
        $this->load->view($this->_view_folder . 'create', $data);
        $this->load->view(MANAGER_FOOTER, $footer);
    }

    //////////////////////////////// RULES //////////////////////////////////////

    /**
     * Set validation rule for create and edit
     */
    private function _set_rule_validation($id) {
        //prepping to set no delimiters.
        $this->form_validation->set_error_delimiters('', '');

        //validates.
        $this->form_validation->set_rules("title", "Title", "trim|required");
        $this->form_validation->set_rules("position", "Position", "trim|required");
        $this->form_validation->set_rules("detail", "Detail", "required");
        $this->form_validation->set_rules("requirement", "requirement", "required");
        $this->form_validation->set_rules("additional_info", "additional_info", "required");

    }

    ////////////////////////////// AJAX CALL ////////////////////////////////////

    /**
     * Function to get job_offers
     */
    public function list_all_data() {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
			exit('No direct script access allowed');
		}

        //sanitize and get inputed data
        $sort_col = sanitize_str_input($this->input->get("order")['0']['column'], "numeric");
        $sort_dir = sanitize_str_input($this->input->get("order")['0']['dir']);
        $limit    = sanitize_str_input($this->input->get("length"), "numeric");
        $start    = sanitize_str_input($this->input->get("start"), "numeric");
        $search   = sanitize_str_input($this->input->get("search")['value']);
        $filter   = $this->input->get("filter");

		$select = array('job.id','title','position','location','available_from_date','available_to_date','job.is_show','status');

        $column_sort = $select[$sort_col];

        //initialize.
        $data_filters = array();
        $conditions = array();

        if (count ($filter) > 0) {
            foreach ($filter as $key => $value) {
                $value = sanitize_str_input($value);
                switch ($key) {
                    case 'id':
                        if ($value != "") {
                            $data_filters['job.id'] = $value;
                        }
                        break;

                    case 'title':
                        if ($value != "") {
                            $data_filters['title'] = $value;
                        }
                        break;

                    case 'position':
                        if ($value != "") {
                            $data_filters['position'] = $value;
                        }
                        break;

                    case 'location':
                        if ($value != "") {
                            $data_filters['location'] = $value;
                        }
                        break;

                    case 'show':
                        if ($value != "") {
                            $data_filters['job.is_show'] = ($value == "active") ? 1 : 0;
                        }
                        break;

                    case 'start':
                        if ($value != "") {
                            $date = parse_date_range($value);
                            $conditions["cast(available_from_date as date) <="] = $date['end'];
                            $conditions["cast(available_from_date as date) >="] = $date['start'];
                        }
                        break;

                    case 'end':
                        if ($value != "") {
                            $date = parse_date_range($value);
                            $conditions["cast(available_to_date as date) <="] = $date['end'];
                            $conditions["cast(available_to_date as date) >="] = $date['start'];
                        }
                        break;

                    default:
                        break;
                }
            }
        }

        //get data
        $datas = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->get_all_data(array(
            'select'          => $select,
            'joined'          => array(),
            'order_by'        => array($column_sort => $sort_dir),
            'limit'           => $limit,
            'start'           => $start,
            'conditions'      => $conditions,
            'filter'          => $data_filters,
            'status'          => STATUS_ACTIVE,
            "count_all_first" => TRUE
		));

        //get total rows
        $total_rows = $datas['total'];

        $output = array(
            "data"            => $datas['datas'],
            "draw"            => intval($this->input->get("draw")),
            "recordsTotal"    => $total_rows,
            "recordsFiltered" => $total_rows,
		);

        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($output);
        exit;
    }

    /**
     * Method to process adding or editing via ajax post.
     */
    public function process_form() {
        //must ajax and must post.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //set secure to true
        $this->_secure = true;

        //load form validation lib.
        $this->load->library('form_validation');

        //initial.
        $message['is_error']    = true;
        $message['error_msg']   = "";
        $message['redirect_to'] = "";

        $extra_param = array(
            "is_direct"  => FALSE,
            "is_version" => FALSE,
            "ordering"   => FALSE
        );

        //sanitize input (id is primary key, if from edit, it has value).
        $id = $this->input->post('id');

        $title               = $this->input->post('title');
        $position            = $this->input->post('position');
        $available_from_date = validate_date_input($this->input->post('available_from_date'));
        $available_to_date   = validate_date_input($this->input->post('available_to_date'));
        $detail              = $this->input->post('detail');
        $requirement         = $this->input->post('requirement');
        $additional_info     = $this->input->post('additional_info');
        $meta_desc           = $this->input->post('meta_desc');
        $meta_keys           = $this->input->post('meta_keys');
        $location            = $this->input->post('location');
        $tipe_pegawai        = $this->input->post('tipe_pegawai');

        $arrayToDB = array(
            "title"               => $title,
            "position"            => $position,
            "detail"              => $detail,
            "requirement"         => $requirement,
            "additional_info"     => $additional_info,
            "available_from_date" => $available_from_date,
            "available_to_date"   => $available_to_date,
            "meta_keys"           => $meta_keys,
            "meta_desc"           => $meta_desc,
            "location"            => $location,
            "type_pekerjaan"      => $tipe_pegawai
        );

        // server side validation. not implement yet.
        $this->_set_rule_validation($id);

        //checking.
        if ($this->form_validation->run($this) == FALSE) {

            //validation failed.
            $message['error_msg'] = validation_errors();

        } else {
            // Begin transaction.
            $this->db->trans_begin();

            // Insert or update?
            if ($id == "") {

                // Insert to DB.
                $result = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->insert(
                    $arrayToDB,
                    $extra_param
                );

            } else {

                // Condition for update.
                $condition = array("id" => $id);
                // Update to DB.
                $result = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->update(
                    $arrayToDB,
                    $condition,
                    $extra_param
                );

            }

            // End transaction.
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $message['error_msg'] = 'database operation failed.';
            } else {
                $this->db->trans_commit();
                $message['is_error'] = false;
                // success.
                // growler.
                $message['notif_title']   = "Good!";
                if ($id == "") {
                    $message['notif_message'] = "Vacancy has been added.";
                } else {
                    $message['notif_message'] = "Vacancy has been updated.";
                }
                // redirected.
                $message['redirect_to'] = "/manager/career/job/lists";
            }

        }

        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * Delete an job_offers.
     */
    public function delete() {

        //must ajax and must post.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        //initial.
        $message['is_error']    = true;
        $message['redirect_to'] = "";
        $message['error_msg']   = "";

        //sanitize input (id is primary key).
        $id = sanitize_str_input($this->input->post('id'));

        $_model = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk);

        //check first.
        if (!empty($id)) {

            //get data admin
            $data = $_model->get_all_data(array(
                "find_by_pk" => array($id),
                "status"     => 1,
                "row_array"  => TRUE
            ))['datas'];

            //no data is found with that ID.
            if (empty($data)) {
                $message['error_msg'] = 'Invalid ID.';
            } else {

                //begin transaction
                $this->db->trans_begin();

                //delete the data (deactivate)
                $condition = array($this->_pk => $id);
                $delete = $_model->delete($condition);

                //end transaction.
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    //failed.
                    $message['error_msg'] = 'database operation failed';
                } else {
                    $this->db->trans_commit();
                    //success.
                    $message['is_error']  = false;
                    $message['error_msg'] = '';
                    //growler.
                    $message['notif_title']   = "Done!";
                    $message['notif_message'] = "Vacancy has been delete.";
                    $message['redirect_to']   = "";
                }
            }
        } else {
            //id is not passed.
            $message['error_msg'] = 'Invalid ID.';
        }

        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

}
