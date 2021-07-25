<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelTahun extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getTahun($where = '')
	{
        return $this->db->query("SELECT * FROM tbl_thn $where;")->result_array();
    }
}
?>    