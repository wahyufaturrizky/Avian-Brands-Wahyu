<?php if (!defined("BASEPATH")) exit('No direct script access allowed');

class Product_model extends Base_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = 'dtb_product';
        $this->_table_alias = 'dp';
        $this->_pk_field = 'id';
    }

    /**
     * extending _get_row function in base class.
     * see base_model for more info.
     */
    protected function _extend_get_row($result)
    {
        return $result;
    }

    /**
     * extending _get_array function in base class.
     * see base_model for more info.
     */
    protected function _extend_get_array($result)
    {
        return $result;
    }

    /**
     * extending insert function in base class.
     * see base_model for more info.
     */
    protected function _extend_insert($datas)
    {
        //need to extend something?
    }

    /**
     * extending update function in base class.
     * see base_model for more info.
     */
    protected function _extend_update($datas, $condition)
    {
        //need to extend something?
    }

    /**
     * extending delete function in base class.
     * see base_model for more info.
     */
    protected function _extend_delete($condition)
    {

    }

    public function get_total_color ($product_id) {
        $query = "SELECT COUNT(DISTINCT color_id) as total_color
                    FROM mst_palette_product mpp , mst_palette_color mpc
                    WHERE mpp.palette_id = mpc.palette_id
                    and product_id = ?";

        return $this->db->query($query, array($product_id))->row_array()['total_color'];
    }

    public function getCategoryAndProduct() {

        $category = $this->Dynamic_model->set_model("dtb_product_category", "dpc", "id")->get_all_data(array(
            "conditions" => array(
                "is_show" => SHOW
            ),
            "order_by" => array("ordering" => "asc"),
        ))['datas'];

        if (count($category) > 0) {
            foreach ($category as $key => $model) {
                //get product by category id
                $category[$key]['product'] = $this->get_all_data(array(
                    "conditions" => array(
                        "is_show" => SHOW,
                        "product_category_id" => $model['id']
                    ),
                    "status" => STATUS_ACTIVE,
                    "order_by" => array("ordering" => "asc"),
                ))['datas'];
            }
        }

        return $category;
    }

    //get the first order number.
    public function getFirstOrdering() {
        $this->db->select("min(ordering) AS ordering");
        $this->db->from($this->_table);

        return $this->db->get()->row()->ordering;
    }

    //get last number of ordering
    public function getLastOrdering () {
        $this->db->select("max(ordering) AS ordering");
        $this->db->from($this->_table);

        return $this->db->get()->row()->ordering;
    }

    public function getAllOrdering () {
        $this->db->select('GROUP_CONCAT( DISTINCT ordering ORDER BY ordering SEPARATOR ",") as ordering');
        $this->db->from($this->_table);

        return $this->db->get()->row()->ordering;
    }

    public function getAllSlider () {
        return $this->get_all_data(array(
            "order_by" => array("ordering" => "asc"),
        ))['datas'];
    }

    //get all slide after ordering number
    public function getAllSliderAfterNumber($number) {
        return $this->get_all_data(array(
            "conditions" => array(
                "ordering >" => $number
            ),
            "order_by" => array("ordering" => "asc"),
        ))['datas'];
    }


    /**
     * API FUNCTION
     */
    public function getProductListAndDetail($product_version) {

		$this->db->select("id as product_id , product_category_id, name as product_name, description as product_desc, usability_feature, technical_data, surface_prep, how_to_use, cleaning_tools, how_to_store, safety_info, additional_information, image_url as product_image_url, code as product_code , packaging as size, file_url as pdf_datasheet_url, version, status , is_show, is_hot_item, image_url_hot, ordering");
        $this->db->from($this->_table);
        $this->db->where("version > ", $product_version);

        $result = $this->db->get()->result_array();

		$models = array();

		if (count($result) > 0) {
			foreach ($result as $model) {
				$model['product_desc'] = preg_replace("/[\n\r]/","",$model['product_desc']);
				$model['usability_feature'] = preg_replace("/[\n\r]/","",$model['usability_feature']);
				$model['technical_data'] = preg_replace("/[\n\r]/","",$model['technical_data']);
				$model['surface_prep'] = preg_replace("/[\n\r]/","",$model['surface_prep']);
				$model['how_to_use'] = preg_replace("/[\n\r]/","",$model['how_to_use']);
				$model['cleaning_tools'] = preg_replace("/[\n\r]/","",$model['cleaning_tools']);
				$model['how_to_store'] = preg_replace("/[\n\r]/","",$model['how_to_store']);
				$model['safety_info'] = preg_replace("/[\n\r]/","",$model['safety_info']);
				$model['additional_information'] = preg_replace("/[\n\r]/","",$model['additional_information']);

				array_push($models, $model);
			}
		}

		return $models;
    }
}
