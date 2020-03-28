<?php if (!defined("BASEPATH")) exit('No direct script access allowed');

class Awards_image_model extends Base_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = 'dtb_awards_image';
        $this->_table_alias = 'dai';
        $this->_pk_field = 'dai.id';
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

    //get the first order number.
	public function getFirstOrdering($awards_id) {
		$this->db->select("min(ordering) AS ordering");
        $this->db->from($this->_table);
		$this->db->where("status", STATUS_ACTIVE);
        $this->db->where("awards_id", $awards_id);

        return $this->db->get()->row()->ordering;
	}

    //get last number of ordering
    public function getLastOrdering ($awards_id) {
        $this->db->select("max(ordering) AS ordering");
        $this->db->from($this->_table);
        $this->db->where("status", STATUS_ACTIVE);
        $this->db->where("awards_id", $awards_id);

        return $this->db->get()->row()->ordering;
    }

    public function getAllOrdering ($awards_id) {
        return $this->get_all_data(array(
            "select" => "GROUP_CONCAT( DISTINCT ordering ORDER BY ordering SEPARATOR ',') as ordering",
            "order_by" => array("ordering" => "asc"),
            "conditions" => array("awards_id" => $awards_id),
            "status" => STATUS_ACTIVE,
            "row_array" => true,
        ))['datas']['ordering'];
    }

    public function getAllAwardsImage ($awards_id) {
        return $this->get_all_data(array(
            "conditions" => array("awards_id" => $awards_id),
            "order_by" => array("ordering" => "asc"),
            "status" => STATUS_ACTIVE
        ))['datas'];
    }

    //get all slide after ordering number
    public function getAllAwardsImageAfterNumber($number,$awards_id) {
        return $this->get_all_data(array(
            "conditions" => array(
                "ordering >" => $number,
                "awards_id" => $awards_id
            ),
            "order_by" => array("ordering" => "asc"),
            "status" => STATUS_ACTIVE
        ))['datas'];
	}

    public function getAllProductAwards () {
		$this->db->distinct("t_awards.product_id");
		$this->db->select("t_awards.product_id, t_prod.name");
		$this->db->from('dtb_awards_image as t_awards');
		$this->db->join('dtb_product as t_prod', 't_awards.product_id = t_prod.id', 'LEFT');
		$this->db->where(array(
            "t_awards.is_show" => SHOW,
            "t_awards.status" => STATUS_ACTIVE,
            "t_prod.is_show" => SHOW,
            "t_prod.status" => STATUS_ACTIVE
        ));
		$this->db->order_by("t_prod.name","ASC");
		return $this->db->get()->result_array();
	}

    public function getMinMaxYear () {
		$this->db->select("min(year) as min_year, max(year) as max_year");
		$this->db->where(array("is_show" => SHOW, "status" => STATUS_ACTIVE));
		return $this->db->get($this->_table)->row_array();
	}

    public function getAwardsImageForProduct ($product_id) {
        $this->db->select("id, file_url as image_url, ordering, file_alt_name as image_alt_name");
        $this->db->where("product_id", $product_id);
        if ($product_id == 3) $this->db->or_where("product_id", "6");
        if ($product_id == 6) $this->db->or_where("product_id", "3");

        $this->db->order_by('ordering','ASC');

        return $this->db->get($this->_table)->result_array();

    }
}
