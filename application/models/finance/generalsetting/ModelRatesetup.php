<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelRatesetup extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getRatesetup($where = '')
	{
        return $this->db->query("SELECT * FROM tbl_rate $where;")->result_array();
    }
}
?>    