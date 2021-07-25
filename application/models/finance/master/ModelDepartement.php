<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelDepartement extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getDepartement($where = '')
	{
        return $this->db->query("SELECT * FROM tbl_dep  $where ")->result_array();
    }

}

