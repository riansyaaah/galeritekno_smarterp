<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelDesignation extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function getDesignation($where = '')
    {
        return $this->db->query("SELECT * FROM hrm_managedesignation  $where ")->result_array();
    }
 
}
