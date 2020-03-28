<?php if (!defined("BASEPATH")) {
    exit('No direct script access allowed');
}

class Dynamic_model extends Base_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->_table = '';
        $this->_table_alias = '';
        $this->_pk_field = '';
    }

    /**
     * set up this dynamic model before use, HIGHLY REQUIRED the TABLE_NAME.
     */
    public function set_model($table_name = null, $table_alias = null, $table_pk = null) {
        $this->_table = $table_name;
        $this->_table_alias = $table_alias;
        $this->_pk_field = $table_pk;

        return $this;
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
        //need to extend something?
    }
}
