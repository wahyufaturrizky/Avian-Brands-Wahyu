<?php if (!defined("BASEPATH")) exit('No direct script access allowed');

class Csr_model extends Base_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = 'mst_csr';
        $this->_table_alias = 'mc';
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
}
