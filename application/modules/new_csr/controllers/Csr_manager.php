<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Slider Controller.
 */
class Csr_manager extends Baseadmin_Controller  {

    private $_title = "CSR";
    private $_title_page = '<i class="fa-fw fa fa-heartbeat"></i> CSR ';
    private $_breadcrumb = "<li><a href='".MANAGER_HOME."'>Home</a></li>";
    private $_active_page = "csr";
    private $_back = "/manager/csr";
    private $_js_path = "/js/pages/csr/manager/";
    private $_view_folder = "csr/manager/";
    private $_table         = "mst_csr";
    private $_table_aliases = "mc";
    private $_pk            = "mc.id";

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
    public function index() {
        //set header attribute.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> List CSR</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>CSR</li>',
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

        //get all ordering csr
        $this->load->model('Csr_model');
        $data['ordering_data'] = $this->Csr_model->getAllOrdering();

        //load the views.
        $this->load->view(MANAGER_HEADER , $header);
        $this->load->view($this->_view_folder . 'index', $data);
        $this->load->view(MANAGER_FOOTER , $footer);
    }

    /**
     * Create csr
     */
    public function create() {
        $this->_breadcrumb .= '<li><a href="/manager/csr">CSR</a></li>';

        //set header attribute.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> Create CSR</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>Create</li>',
        );

        //set footer attribute (additional script and css).
        $footer = array(
            "script" => array(
                "/js/plugins/tinymce/tinymce.min.js",
                "/js/plugins/select2.min.js",
                $this->_js_path . "create.js",
            ),
            "script_http" => array(
                "https://maps.googleapis.com/maps/api/js?key=". GOOGLE_API_KEY ."&libraries=geometry",
            ),
            "css" => array(
                "/css/select2.min.css",
            )
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
            "select" => array(
                "mc.*",
                "mca.judul as judul_artikel"
            ),
            "find_by_pk" => array($id),
            "row_array"  => TRUE,
            "left_joined" => array(
                "mst_csr_artikel mca" => array("mca.id" => "mc.artikel_csr_id"),
            )
        ))['datas'];

        if (empty($data['item'])) {
            show_404();
        }

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

    /**
     * Slider for csr
     */
    public function slider ($id = null) {
        if (!$id) show_error('Page is not existing', 404);
        $this->_breadcrumb .= '<li><a href="/manager/csr">CSR</a></li>';

        $data['csr'] = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->get_all_data(array(
            "conditions" => array("id" => $id),
            "row_array"  => TRUE
        ))['datas'];

        $data['slider'] = $this->_dm->set_model("trs_csr_slider", "tcs", "tcs.id")->get_all_data(array(
            "conditions" => array("csr_id" => $id),
            "row_array"  => TRUE
        ))['datas'];

        //get all ordering slider
        $this->load->model('Slider_model');
        $data['ordering_data'] = $this->Slider_model->getAllOrdering($id);

        //prepare header title.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> Slider</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li>Slider</li>',
            "back"          => "/manager/csr",
        );

        //set footer attribute (additional script and css).
        $footer = array(
            "script" => array(
                "/js/plugins/datatables/jquery.dataTables.min.js",
                "/js/plugins/datatables/dataTables.bootstrap.min.js",
                "/js/plugins/datatable-responsive/datatables.responsive.min.js",
                $this->_js_path . "slider-list.js",
            ),
        );

        //load the view.
        $this->load->view(MANAGER_HEADER, $header);
        $this->load->view($this->_view_folder . 'slider-list', $data);
        $this->load->view(MANAGER_FOOTER, $footer);
    }

    /**
     * Create Slider for csr
     */
    public function slider_create ($csr_id = null) {
        if ($csr_id == 0) show_error('Page is not existing', 404);
        $this->_breadcrumb .= '<li><a href="/manager/csr">CSR</a></li>';

        //prepare header title.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> Slider</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li><a href="/manager/csr/slider/'.$csr_id.'">Slider</a></li><li>Create</li>',
            "back"          => "/manager/csr/slider/".$csr_id,
        );

        //set footer attribute (additional script and css).
        $footer = array(
            "script" => array(
                $this->_js_path . "slider-create.js",
            ),
        );

        $data['csr'] = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->get_all_data(array(
            "conditions" => array("id" => $csr_id),
            "row_array"  => TRUE
        ))['datas'];

        //load the view.
        $this->load->view(MANAGER_HEADER, $header);
        $this->load->view($this->_view_folder . 'slider-create', $data);
        $this->load->view(MANAGER_FOOTER, $footer);
    }

    /**
     * Create Slider for csr
     */
    public function slider_edit ($slider_id = null) {
        if (!$slider_id) show_error('Page is not existing', 404);
        $this->_breadcrumb .= '<li><a href="/manager/csr">CSR</a></li>';

        $data['slider'] = $this->_dm->set_model("trs_csr_slider")->get_all_data(array(
            "conditions" => array("id" => $slider_id),
            "row_array"  => TRUE
        ))['datas'];

        $csr_id = $data['slider']['csr_id'];

        $data['csr'] = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->get_all_data(array(
            "conditions" => array("id" => $csr_id),
            "row_array"  => TRUE
        ))['datas'];

        //prepare header title.
        $header = array(
            "title"         => $this->_title,
            "title_page"    => $this->_title_page . '<span>> Slider</span>',
            "active_page"   => $this->_active_page,
            "breadcrumb"    => $this->_breadcrumb . '<li><a href="/manager/csr/slider/'.$csr_id.'">Slider</a></li><li>Edit</li>',
            "back"          => "/manager/csr/slider/".$csr_id,
        );

        //set footer attribute (additional script and css).
        $footer = array(
            "script" => array(
                $this->_js_path . "slider-create.js",
            ),
        );

        //load the view.
        $this->load->view(MANAGER_HEADER, $header);
        $this->load->view($this->_view_folder . 'slider-create', $data);
        $this->load->view(MANAGER_FOOTER, $footer);
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

        $select = array("id", "judul", "version", "is_show", "ordering", "image_landing");

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

                    case 'version':
                        if ($value != "") {
                            $data_filters['version'] = $value;
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
     * Function to get csr slider
     */
    public function list_slider($csr_id = null) {
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

        $select = array("id", "image_slider", "ordering", "is_show");

        $column_sort = $select[$sort_col];

        //initialize.
        $data_filters = array();
        $conditions = array("csr_id" => $csr_id);

        if (count ($filter) > 0) {
            foreach ($filter as $key => $value) {
                $value = sanitize_str_input($value);
                switch ($key) {
                    case 'id':
                        if ($value != "") {
                            $data_filters['id'] = $value;
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
        $datas = $this->_dm->set_model("trs_csr_slider", "tcs", "id")->get_all_data(array(
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

        $extra_param = array(
            "is_direct"  => TRUE,
            "is_version" => TRUE,
            "ordering"   => FALSE
        );

        //sanitize input (id is primary key, if from edit, it has value).
        $id         = $this->input->post('id');
        $judul      = $this->input->post('judul');
        // $pretty_url      = $this->input->post('pretty_url');
        $type      = $this->input->post('type');
        $lokasi      = $this->input->post('lokasi');
        $latitude      = $this->input->post('latitude');
        $longitude      = $this->input->post('longitude');
        // $short_content    = $this->input->post('short_content');
        // $content    = $this->input->post('content');
        // $content_device = $this->input->post('content_device');
        $is_show    = $this->input->post('is_show');
        $artikel_csr_id    = $this->input->post('artikel_csr_id');
        $image      = $this->input->post('data-image');
        $date      = $this->input->post('date');


        $arrayToDB = array(
            "judul"         => $judul,
            // "pretty_url"    => $pretty_url,
            "type"          => $type,
            "lokasi"        => $lokasi,
            "latitude"      => $latitude,
            "longitude"     => $longitude,
            // "short_content" => $short_content,
            // "content"       => $content,
            // "content_device"=> $content_device,
            "is_show"       => $is_show,
            "artikel_csr_id"       => $artikel_csr_id,
            "created_date"       => $date,
        );

        // Upload image
        $crop_web = $this->upload_image("device", "upload/csr/device", "image-file", $image, 600, 165, $id);

        if (!empty($crop_web)) {
            $arrayToDB['image_landing'] = $crop_web;
        }

        // Begin transaction.
        $this->db->trans_begin();

        // Insert or update?
        if ($id == "") {
            // Get last ordering
            $myslider = $this->_dm->set_model("mst_csr")->get_all_data(array(
                "order_by" => array("ordering" => "desc")
            ))['datas'];

            $lastOrder = 1;

            if($myslider) {
                $lastOrder = $myslider[0]['ordering'] + 1;
            }

            $arrayToDB['ordering'] = $lastOrder;

            // Insert to DB.
            $result = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->insert(
                $arrayToDB,
                $extra_param
            );

        } else {
            // hapus gambar lama jika ganti gambar baru
            $curr_data = $this->_dm->set_model($this->_table, $this->_table_aliases, $this->_pk)->get_all_data(array(
                "find_by_pk" => array($id),
                "row_array" => true,
            ))['datas'];

            if (!empty($image) && isset($curr_data['image_landing']) && !empty($curr_data['image_landing'])) {
                unlink( FCPATH . $curr_data['image_landing'] );
            }

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
                $message['notif_message'] = "CSR has been added.";
            } else {
                $message['notif_message'] = "CSR has been updated.";
            }
            // redirected.
            $message['redirect_to'] = "/manager/csr";
        }

        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    /**
     * Method to process adding or editing via ajax post.
     */
    public function process_slider() {
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
        $csr_id         = $this->input->post('csr_id');
        $slider_id      = $this->input->post('slider_id');
        $is_show        = $this->input->post('is_show');
        $image_slider     = $this->input->post('data-image');

        $arrayToDB = array(
            "csr_id"   => $csr_id,
            "is_show" => $is_show,
        );

        // Upload image
        $crop_slider = $this->upload_image("web", "upload/csr/slider", "image-file", $image_slider, 660, 410, $slider_id);

        // Begin transaction.
        $this->db->trans_begin();

        if (!empty($crop_slider)) {
            $arrayToDB['image_slider'] = $crop_slider;
        }

        // Insert or update?
        if (!$slider_id) {
            // Get last ordering
            $myslider = $this->_dm->set_model("trs_csr_slider")->get_all_data(array(
                "conditions" => array("csr_id" => $csr_id),
                "order_by" => array("ordering" => "desc")
            ))['datas'];

            $lastOrder = 1;

            if($myslider) {
                $lastOrder = $myslider[0]['ordering'] + 1;
            }

            $arrayToDB['ordering'] = $lastOrder;

            // Insert to DB.
            $result = $this->_dm->set_model("trs_csr_slider")->insert(
                $arrayToDB,
                $extra_param
            );

        } else {
            // hapus gambar lama jika ganti gambar baru
            $curr_data = $this->_dm->set_model("trs_csr_slider", "tcs", "tcs.id")->get_all_data(array(
                "find_by_pk" => array($slider_id),
                "row_array" => true,
            ))['datas'];

            if (!empty($image_slider) && isset($curr_data['image_slider']) && !empty($curr_data['image_slider'])) {
                unlink( FCPATH . $curr_data['image_slider'] );
            }

            // Condition for update.
            $condition = array("id" => $slider_id);

            // Update to DB.
            $result = $this->_dm->set_model("trs_csr_slider")->update(
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
            if ($slider_id == "") {
                $message['notif_message'] = "CSR slider has been added.";
            } else {
                $message['notif_message'] = "CSR slider has been updated.";
            }
            // redirected.
            $message['redirect_to'] = "/manager/csr/slider/".$csr_id;
        }

        //encoding and returning.
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    // Slider ordering
    public function ordering() {
        //check if ajax request
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $id = $this->input->post('id');
        $order = $this->input->post('val');
        $csr_id = $this->input->post('csr_id');

        $this->load->model("csr/Slider_model");

        $table = $this->Slider_model;
        $model = $table->get_all_data(array(
            "find_by_pk" => array($id),
            "row_array" => true,
        ))['datas'];

        $datas = $table->getAllSlider($csr_id);

        $min = $table->getFirstOrdering($csr_id);
        $max = $table->getLastOrdering($csr_id);

        $newkey = searchForIdInt($order, $datas, 'ordering');
        $oldkey = searchForIdInt($model['ordering'], $datas, 'ordering');

        $oldOrdering = $model['ordering'];

        $this->db->trans_begin();

        if ($oldOrdering > $order) {
            //smua image yg id nya mulai dari == $order ~sd~ $oldOrdering - 1 ==> harus ditambah 1.
            for ($i = $oldkey - 1 ; $i >= $newkey; $i--) {
                $table->update(array(
                    'ordering' =>  $datas[$i]['ordering']+1,
                ),array('id' => $datas[$i]['id']));
            }

            $table->update(array(
                'ordering' =>  $order,
            ),array('id' => $datas[$oldkey]['id']));

        } else if ($oldOrdering < $order) {
            //smua image yg id nya mulai dari == $oldOrdering + 1 ~sd~ $order ==> harus dikurang 1.
            for ($i = $oldkey+ 1 ; $i <= $newkey ; $i++) {
                $table->update(array(
                    'ordering' =>  $datas[$i]['ordering']-1,
                ),array('id' => $datas[$i]['id']));
            }

            $table->update(array(
                'ordering' =>  $order,
            ),array('id' => $datas[$oldkey]['id']));
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            $message["error_message"] = $this->db->error();
        } else {
            $this->db->trans_commit();

            $message["is_error"] = false;

            //growler.
            $message['notif_title'] = "Done!";
            $message['notif_message'] = "Slider Ordered Successfully.";
        }

        echo json_encode($message);
        exit;
    }

    // Csr ordering
    public function ordering_csr() {
        //check if ajax request
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $id = $this->input->post('id');
        $order = $this->input->post('val');

        $this->load->model("Csr_model");

        $table = $this->Csr_model;
        $model = $table->get_all_data(array(
            "find_by_pk" => array($id),
            "row_array" => true,
        ))['datas'];

        $datas = $table->getAllSlider();

        $min = $table->getFirstOrdering();
        $max = $table->getLastOrdering();

        $newkey = searchForIdInt($order, $datas, 'ordering');
        $oldkey = searchForIdInt($model['ordering'], $datas, 'ordering');

        $oldOrdering = $model['ordering'];

        $this->db->trans_begin();

        if ($oldOrdering > $order) {
            //smua image yg id nya mulai dari == $order ~sd~ $oldOrdering - 1 ==> harus ditambah 1.
            for ($i = $oldkey - 1 ; $i >= $newkey; $i--) {
                $table->update(array(
                    'ordering' =>  $datas[$i]['ordering']+1,
                ),array('id' => $datas[$i]['id']));
            }

            $table->update(array(
                'ordering' =>  $order,
            ),array('id' => $datas[$oldkey]['id']));

        } else if ($oldOrdering < $order) {
            //smua image yg id nya mulai dari == $oldOrdering + 1 ~sd~ $order ==> harus dikurang 1.
            for ($i = $oldkey+ 1 ; $i <= $newkey ; $i++) {
                $table->update(array(
                    'ordering' =>  $datas[$i]['ordering']-1,
                ),array('id' => $datas[$i]['id']));
            }

            $table->update(array(
                'ordering' =>  $order,
            ),array('id' => $datas[$oldkey]['id']));
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            $message["error_message"] = $this->db->error();
        } else {
            $this->db->trans_commit();

            $message["is_error"] = false;

            //growler.
            $message['notif_title'] = "Done!";
            $message['notif_message'] = "Slider Ordered Successfully.";
        }

        echo json_encode($message);
        exit;
    }

}
