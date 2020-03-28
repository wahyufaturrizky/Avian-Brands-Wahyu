<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Slider Controller.
 */
class Csr_artikel_manager extends Baseadmin_Controller  {

    private $_title = "CSR Artikel";
    private $_title_page = '<i class="fa-fw fa fa-heartbeat"></i> CSR Artikel';
    private $_breadcrumb = "<li><a href='".MANAGER_HOME."'>Home</a></li>";
    private $_active_page = "csr-artikel";
    private $_back = "/manager/csr/csr-artikel/lists";
    private $_js_path = "/js/pages/csr/manager/artikel/";
    private $_view_folder = "csr/manager/artikel/";
    private $_table         = "mst_csr_artikel";
    private $_table_aliases = "mca";
    private $_pk            = "mca.id";

    /**
	 * constructor.
	 */
    public function __construct() {
        parent::__construct();

    }

    //////////////////////////////// VIEWS //////////////////////////////////////

    /**
     * List csr
     */
    public function lists() {
        //set header attribute.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> List CSR Artikel</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>CSR Artikel</li>',
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
     * Create csr
     */
    public function create() {
        $this->_breadcrumb .= '<li><a href="/manager/csr">CSR Artikel</a></li>';

        //set header attribute.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> Create CSR Artikel</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>Create</li>',
        );

        //set footer attribute (additional script and css).
        $footer = array(
            "script" => array(
                "/js/plugins/tinymce/tinymce.min.js",
                $this->_js_path . "create.js",
            ),
        );

        //load the views.
        $this->load->view(MANAGER_HEADER , $header);
        $this->load->view($this->_view_folder . 'create');
        $this->load->view(MANAGER_FOOTER , $footer);
    }

    /**
     * Edit an csr
     */
    public function edit ($id = null) {
        if ($id == 0) show_error('Page is not existing', 404);
        $this->_breadcrumb .= '<li><a href="/manager/csr">CSR</a></li>';

        $data['item'] = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->get_all_data(array(
            "find_by_pk" => array($id),
            "row_array"  => TRUE
        ))['datas'];

        //prepare header title.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> CSR</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>Edit</li>',
            "back"          => "/manager/csr",
        );

        //set footer attribute (additional script and css).
        $footer = array(
            "script" => array(
                "/js/plugins/datatables/jquery.dataTables.min.js",
                "/js/plugins/datatables/dataTables.bootstrap.min.js",
                "/js/plugins/datatable-responsive/datatables.responsive.min.js",
                "/js/plugins/tinymce/tinymce.min.js",
                "/js/plugins/select2.min.js",
                $this->_js_path . "create.js",
            ),
            "script_http" => array(
                "https://maps.googleapis.com/maps/api/js?key=". GOOGLE_API_KEY ."&libraries=geometry",
            )
        );

        //load the view.
        $this->load->view(MANAGER_HEADER, $header);
        $this->load->view($this->_view_folder . 'create', $data);
        $this->load->view(MANAGER_FOOTER, $footer);
    }

    //////////////////////////////// RULES //////////////////////////////////////

    /**
     * Set validation rule for admin create and edit
     */
    private function _set_rule_validation($id) {

        //prepping to set no delimiters.
        $this->form_validation->set_error_delimiters('', '');

        //validates.
        $this->form_validation->set_rules("judul", "Judul", "trim|required");
        $this->form_validation->set_rules("pretty_url", "Pretty URL", "trim|required");
        $this->form_validation->set_rules("short_content", "Short Content", "trim|required");
        $this->form_validation->set_rules("content", "Content", "trim|required");
        $this->form_validation->set_rules("is_show", "IS SHOW", "trim|required");

    }

    ////////////////////////////// AJAX CALL ////////////////////////////////////

    /**
     * Function to get csr
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

        $select = array("id", "judul", "short_content", "is_show");

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
                            $data_filters['id'] = $value;
                        }
                        break;

                    case 'judul':
                        if ($value != "") {
                            $data_filters['judul'] = $value;
                        }
                        break;

                    case 'short_content':
                        if ($value != "") {
                            $data_filters['short_content'] = $value;
                        }
                        break;

                    case 'show':
                        if ($value != "") {
                            $data_filters['is_show'] = ($value == "active") ? 1 : 0;
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
            'order_by'        => array($column_sort => $sort_dir),
            'limit'           => $limit,
            'start'           => $start,
            'conditions'      => $conditions,
            'filter'          => $data_filters,
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

        //sanitize input (id is primary key, if from edit, it has value).
        $id         = $this->input->post('id');
        $judul      = $this->input->post('judul');
        $pretty_url      = $this->input->post('pretty_url');
        $short_content    = $this->input->post('short_content');
        $content    = $this->input->post('content');
        $meta_desc    = $this->input->post('meta_desc');
        $meta_keys    = $this->input->post('meta_keys');
        // $content_device = $this->input->post('content_device');
        $is_show    = $this->input->post('is_show');

        //server side validation.
        $this->_set_rule_validation($id);

        //checking.
        if ($this->form_validation->run($this) == FALSE) {

            //validation failed.
            $message['error_msg'] = validation_errors();

        } else {

            // Begin transaction.
            $this->db->trans_begin();

            $extra_param = array(
                "is_direct"  => FALSE,
                "is_version" => FALSE,
                "ordering"   => FALSE
            );

            $arrayToDB = array(
                "judul"         => $judul,
                "pretty_url"    => $pretty_url,
                "short_content" => $short_content,
                "content"       => $content,
                // "content_device"=> $content_device,
                "is_show"       => $is_show,
                "meta_desc"       => $meta_desc,
                "meta_keys"       => $meta_keys,
            );

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

                $model_csr = $this->_dm->set_model("mst_csr","mc","mc.id");
                $model_csr->update(
                    array(),
                    array("artikel_csr_id" => $id),
                    array("is_version" => true)
                );

            }
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
                $message['notif_message'] = "CSR Artikel has been added.";
            } else {
                $message['notif_message'] = "CSR Artikel has been updated.";
            }
            // redirected.
            $message['redirect_to'] = "/manager/csr/csr-artikel/lists";
        }

        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    public function get_list_artikel() {
        //must ajax and must get.
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "GET") {
            exit('No direct script access allowed');
        }

        //get ajax query and page.
        $select_q = ($this->input->get("q") != null) ? trim($this->input->get("q")) : "";
        $select_page = ($this->input->get("page") != null) ? trim($this->input->get("page")) : 1;

        //sanitazion.
        $select_q = sanitize_str_input($select_q);

        //page must numeric.
        $select_page = is_numeric($select_page) ? $select_page : 1;

        //for paging, calculate start.
        $limit = 50;
        $start = ($limit * ($select_page - 1));

        //filters.
        $filters = array();
        if ($select_q != "") {
            $filters["lower(judul)"] = strtolower($select_q);
        }

        //conditions.
        $conditions = array(
            "is_show" => SHOW,
        );

        //get data.
        $datas = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->get_all_data(array(
            "select"          => array("id" , "judul"),
            "conditions"      => $conditions,
            "filter_or"       => $filters,
            "count_all_first" => true,
            "limit"           => $limit,
            "start"           => $start,
        ));

        //prepare returns.
        $message["page"]        = $select_page;
        $message["total_data"]  = $datas['total'];
        $message["paging_size"] = $limit;
        $message["datas"]       = $datas['datas'];

        echo json_encode($message);
        exit;
    }
}
