<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelItemperiksa extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    function getItemperiksa($where = ""){
        return $this->db->query("SELECT ekl_itemperiksa.*,REPLACE(id,concat(id_paren,'.'),'') as urut FROM ekl_itemperiksa $where ")->result_array();
    }
    
}