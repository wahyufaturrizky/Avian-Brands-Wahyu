<?php defined('BASEPATH') or exit('No direct script access allowed');

class Baseapi_Controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();

        //load and prepare Dynamic_model
        $this->load->model('Dynamic_model');
        $this->_dm = new Dynamic_model();
    }

    /**
     * Check API KEY if it is valid (exists in DB) or not.
     */
    public function check_api_key($type)
    {
        if (empty($type)) {
            $this->response($this->_result_NG(ERROR_CODE_3, 3), REST_Controller::HTTP_OK);
        }

        if ($type == "post") {
            $api_key = ($this->post("api_key")) ? $this->post("api_key") : "";
        } elseif ($type == "get") {
            $api_key = ($this->get("api_key")) ? $this->get("api_key") : "";
        } elseif ($type == "put") {
            $api_key = ($this->put("api_key")) ? $this->put("api_key") : "";
        } elseif ($type == "delete") {
            $api_key = ($this->delete("api_key")) ? $this->delete("api_key") : "";
        } else {
            $this->response($this->_result_NG(ERROR_CODE_3, 3), REST_Controller::HTTP_OK);
        }

        if (empty(trim($api_key))) {
            $this->response($this->_result_NG(ERROR_CODE_3, 3), REST_Controller::HTTP_OK);
        }

        $check_apikey = $this->_dm->set_model("dtb_push_device", "dpd", "dpd.id")->get_all_data(array(
            "select" => array(
                "dpd.id as device_id",
                "dpd.member_id",
                "dpd.device_token",
                "dpd.api_key",
                "dpd.push_setting",
                "dpd.push_article as push_new_article_is_on",
                "dpd.push_event as push_new_event_is_on",
                "dpd.push_promo as push_new_promo_is_on",
                "dpd.push_voucher as push_new_voucher_is_on",
                "dpd.push_reminder as push_almost_expired_voucher_reminder_is_on",
                "dpd.type",
                "dm.*"
            ),
            'conditions' => array( 'api_key'   => $api_key, "dpd.status" => STATUS_ACTIVE ),
            'row_array' => true,
            "joined" => array(
                "dtb_member dm" => array("dm.id" => "dpd.member_id")
            )
        ))['datas'];

        if (empty($check_apikey)) {
            $this->response($this->_result_NG(ERROR_CODE_3, 3), REST_Controller::HTTP_OK);
        }

        return $check_apikey;
    }

    //**
    //** Result NG and OK
    //**
    protected function _result_NG($message, $error_code)
    {
        return array(
            "result" => "NG",
            "message" => $message,
            "error_code" => $error_code,
        );
    }

    protected function _result_OK($datas = false)
    {
        if (!$datas) {
            return array(
                "result" => "OK"
            );
        } else {
            return array(
                "result" => "OK",
                "datas" => $datas,
            );
        }
    }

    protected function upload_file($key, $file_name, $multiple = false, $upload_path)
    {
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
            return $upload_result['result'][0]['error_msg'];
        }

        return $upload_result['result'];
    }

    public function parameter_invalid($fields)
    {
        return $this->response($this->_result_NG(sprintf(ERROR_CODE_12, $fields), 12), 200);
    }
}
