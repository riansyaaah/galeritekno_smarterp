<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelInventaris extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getFixedassets()
	{
        return $this->db->query("SELECT * FROM `accountmaster` WHERE AccountNo LIKE '17%' ")->result_array();
    }
}
?>    