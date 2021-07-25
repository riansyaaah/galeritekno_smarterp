<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelBusinessLine extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function getBusinessLine($where = '')
    {
        return $this->db->query("SELECT * FROM tbl_bis  $where ")->result_array();
    }
 
   
}
