<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelUnit extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getUnit($where = '')
	{
        return $this->db->query("SELECT * FROM tbl_unit $where;")->result_array();
    }
}
?>    