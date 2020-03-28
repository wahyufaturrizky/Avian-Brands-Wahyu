<?php if (!defined("BASEPATH")) exit('No direct script access allowed');

class Awards_model extends Base_Model {

    public function __construct() {
        parent::__construct();
        $this->_table = 'dtb_awards';
        $this->_table_alias = 'daw';
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
		$this->db->where("status", STATUS_ACTIVE);

        return $this->db->get()->row()->ordering;
	}

    //get last number of ordering
    public function getLastOrdering () {
        $this->db->select("max(ordering) AS ordering");
        $this->db->from($this->_table);
        $this->db->where("status", STATUS_ACTIVE);

        return $this->db->get()->row()->ordering;
    }

    public function getAllOrdering () {
        $this->db->select('GROUP_CONCAT( DISTINCT ordering ORDER BY ordering SEPARATOR ",") as ordering');
		$this->db->where("status", STATUS_ACTIVE);
        $this->db->from($this->_table);

        return $this->db->get()->row()->ordering;
    }

    public function getAllAwards () {
        return $this->get_all_data(array(
            "order_by" => array("ordering" => "asc"),
            "status" => STATUS_ACTIVE
        ))['datas'];
    }

    //get all slide after ordering number
    public function getAllAwardsAfterNumber($number) {
        return $this->get_all_data(array(
            "conditions" => array(
                "ordering >" => $number
            ),
            "order_by" => array("ordering" => "asc"),
            "status" => STATUS_ACTIVE
        ))['datas'];
	}

    //get all awards and images
    public function getAllAwardsAndImages ($ids = false, $conditions_image = false) {
        $this->db->save_queries = TRUE;
        $this->db->select("id, title, sub_title, description");
        $this->db->from($this->_table);
        $this->db->where('is_show', SHOW);
        $this->db->where('status', STATUS_ACTIVE);

        if ($ids) {
            $this->db->where_in('id',$ids);
        }

        $this->db->order_by('ordering','ASC');

        $result = $this->db->get()->result_array();
        
        $models = array();
        $MawardImages = new Awards_image_model();

        foreach ($result as $model) {
            $conditions_image["awards_id"] = $model['id'];

            $model['images'] = $MawardImages->get_all_data(array(
                "conditions" => $conditions_image,
                "status" => STATUS_ACTIVE,
                "order_by" => array("ordering" => "asc"),
            ))['datas'];

            array_push ($models,$model);


        }

        return $models;

    }
}
