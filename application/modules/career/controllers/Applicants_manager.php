<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Applicants Controller.
 */
class Applicants_manager extends Baseadmin_Controller  {

    private $_title         = "Applicants";
    private $_title_page    = '<i class="fa-fw fa fa-graduation-cap"></i> Applicants ';
    private $_breadcrumb    = "<li><a href='".MANAGER_HOME."'>Home</a></li>";
    private $_active_page   = "applicants";
    private $_back          = "/manager/career/applicants/lists";
    private $_js_path       = "/js/pages/career/manager/applicants/";
    private $_view_folder   = "career/manager/applicants/";
    private $_table         = "dtb_applicants";
    private $_table_aliases = "app";
    private $_pk            = "id";

    /**
	 * constructor.
	 */
    public function __construct() {
        parent::__construct();

    }

    //////////////////////////////// VIEWS //////////////////////////////////////

    /**
     * List visualizer_result
     */
    public function lists() {
        //set header attribute.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> List Applicants</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>Applicants</li>',
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
     * Detail an Applicants
     */
    public function detail ($id = null) {
        $this->_breadcrumb .= "<li><a href='/manager/career/applicants/lists'>Applicants</a></li>";

        //load the model.
        $data["item"] = null;

        //validate ID and check for data.
        if ( $id === null || !is_numeric($id) ) {
            show_404();
        }

        $params = array(
            "select" => array(
                "app.id","fullname","IFNULL((SELECT title FROM dtb_vacancy WHERE dtb_vacancy.id = vacancy_id),'All') AS vacancy","email","dob","address","file_path","app.created_date"
            ),
            "left_joined" => array(
                "dtb_vacancy job" => array("job.id" => "app.vacancy_id"),
            ),
            "conditions" => array("app.id" => $id),
            "row_array"  => TRUE,
        );
        //get the data.
        $data["item"] = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->get_all_data($params)["datas"];

        //if no data found with that ID, throw error.
        if (empty($data["item"])) {
            show_404();
        }

        //prepare header title.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . "<span>> Detail Applicants</span>",
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . "<li>Detail Applicants</li>",
            "back"          => $this->_back,
        );

        $footer = array(
            "script" => array(),
        );

        //load the view.
        $this->load->view(MANAGER_HEADER, $header);
        $this->load->view($this->_view_folder . "detail", $data);
        $this->load->view(MANAGER_FOOTER, $footer);
    }

    //////////////////////////////// RULES //////////////////////////////////////


    ////////////////////////////// AJAX CALL ////////////////////////////////////

    /**
     * Function to get visualizer_result
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

		$select = array('app.id','fullname','IFNULL((SELECT title FROM dtb_vacancy WHERE dtb_vacancy.id = vacancy_id),"All") AS vacancy','email','dob');

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
                            $data_filters['app.id'] = $value;
                        }
                        break;

                    case 'fullname':
                        if ($value != "") {
                            $data_filters['fullname'] = $value;
                        }
                        break;

                    case 'email':
                        if ($value != "") {
                            $data_filters['email'] = $value;
                        }
                        break;

                    case 'dob':
                        if ($value != "") {
                            $date = parse_date_range($value);
                            $conditions["cast(dob as date) <="] = $date['end'];
                            $conditions["cast(dob as date) >="] = $date['start'];
                        }
                        break;

                    case 'vacancy':
                        if ($value != "") {
                            $data_filters['job.title'] = $value;
                        }
                        break;

                    default:
                        break;
                }
            }
        }

        //get data
        $datas = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->get_all_data(array(
            'select' => $select,
            'left_joined' => array(
                "dtb_vacancy job" => array("job.id" => "app.vacancy_id"),
            ),
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

}
