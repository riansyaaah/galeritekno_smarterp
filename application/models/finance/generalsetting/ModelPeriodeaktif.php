<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelPeriodeAktif extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getPeriodeAktif($where = '')
	{
        return $this->db->query("SELECT * FROM periode $where;")->result_array();
    }
}
?>    