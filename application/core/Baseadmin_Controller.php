<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Baseadmin_Controller extends MX_Controller {

    //protected var for current user login.
    protected $_currentUser;
    protected $_secure;

    //this one is for Dynamic_model
    protected $_dm;

	/**
	 * Base controller constructor.
	 * this parent is used for every admin controllers.
	 */
    function __construct() {
        parent::__construct();

        //for securing public access.
        $this->_secure = false;

        //get controller.
        $controller = $this->router->fetch_class();

        //save current user if he is already logged in.
        if ($this->session->has_userdata(ADMIN_SESSION)) {
            $this->_currentUser = $this->session->sess_login_admin;
        }

        if (!isset($this->_currentUser)) {
            $url = uri_string();
            if (empty($url)) {
                redirect("/manager/login");
            } else {
                redirect("/manager/login?goto=".$url);
            }

        }

        //load and prepare Dynamic_model
        $this->load->model('Dynamic_model');
        $this->_dm = new Dynamic_model();
    }

    protected function upload_file ($key, $file_name, $multiple = false, $upload_path, $id) {
        $message['is_error'] = true;
		$message['error_msg'] = "";
        $message['redirect_to'] = "";

        //load the uploader library.
        $this->load->library('Uploader');

        $config = array(
            "allowed_types"         =>  FILE_TYPE_UPLOAD,
            "file_ext_tolower"      =>  true,
            "overwrite"             =>  false,
            "max_size"              =>  MAX_UPLOAD_FILE_SIZE_IN_KB,
            "upload_path"           =>  $upload_path,
        );

        if (!empty($file_name)) {
            $config['filename_overwrite'] = $file_name;
        }

        //try to upload the image.
        $upload_result = $this->uploader->upload_files($key, $multiple, $config);

        if ($upload_result['is_error']) {
            if ($upload_result['is_error']) {
                if (($id == "" && $upload_result['result'][0]['error_code'] == 0) || $upload_result['result'][0]['error_code'] != 0) {
                    //file upload error of something.
                    //show the error.
                    $message['error_msg'] = $upload_result['result'][0]['error_msg'];

                    //encoding and returning.
                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;
                }

            }
        }

        return $upload_result['result'];
    }

    protected function upload_image ($file_name, $saving_path, $key, $data_image, $width, $height, $id, $preset2 = array()) {
        $message['is_error'] = true;
		$message['error_msg'] = "";
        $message['redirect_to'] = "";

        //after successfull image upload and cropping, this var will contain the path to the file.
        $final_upload_path = "";

        if ($data_image != "") {
            //validation success.
            //prepare upload config.
            $config = array(
                "allowed_types"         =>  FILE_TYPE_UPLOAD,
                "file_ext_tolower"      =>  true,
                "overwrite"             =>  false,
                "max_size"              =>  MAX_UPLOAD_IMAGE_SIZE_IN_KB,
                "upload_path"           =>  "upload/temp",
            );

            if (!empty($file_name)) {
                $config['filename_overwrite'] = $file_name;
            }

            //load the uploader library.
            $this->load->library('Uploader');

            //try to upload the image.
            $upload_result = $this->uploader->upload_files($key, false, $config);

            if ($upload_result['is_error']) {
                if (($id == "" && $upload_result['result'][0]['error_code'] == 0) || $upload_result['result'][0]['error_code'] != 0) {
                    //file upload error of something.
                    //show the error.
                    $message['error_msg'] = $upload_result['result'][0]['error_msg'];

                    //encoding and returning.
                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;
                }

            }

            //get first index because it's not multiple files.
            $uploaded = $upload_result['result'];

            //file upload success.
            if (!$upload_result['is_error']) {

                //creating config for image resizing.
                $config = array(
                    "image_targets"     =>  array(
                        "preset1"   =>  array(
                            "target_path"   =>  $saving_path,
                            "target_width"  =>  $width,
                            "target_height" =>  $height,
                            "crop_data"     =>  $data_image,
                        ),
                    )
                );

                if (!empty($preset2)) {
                    $config['image_targets']['preset2'] = $preset2;
                }

                $image_result = $this->uploader->crop_images($uploaded['uploaded_path'], true, $config);

                //if there is somekind of error, write it to log.
                if ($image_result['is_error'] ) {
                    foreach ($image_result['result'] as $key => $value) {
                        $message['error_msg'] .= $image_result['error_msg'];
                    }

                    //encoding and returning.
                    $this->output->set_content_type('application/json');
                    echo json_encode($message);
                    exit;
                } else {
                    //success cropping.

                    if (!empty($preset2)) {
                        $final_upload_path = array(
                            "/".$image_result['result'][0]['uploaded_path'],
                            "/".$image_result['result'][1]['uploaded_path'],
                        );
                    } else {
                        $final_upload_path = "/".$image_result['result'][0]['uploaded_path'];
                    }


                }

            } else if ($upload_result['is_error'] && $uploaded[0]['error_code'] == 0) {
                //if file upload error, but the error is because there is no new file.

            }
        } else {
            if ($id == "") {
                $message['error_msg'] = "Please upload image.";

                //encoding and returning.
                $this->output->set_content_type('application/json');
                echo json_encode($message);
                exit;
            }

        }

        return $final_upload_path;

    }


}
