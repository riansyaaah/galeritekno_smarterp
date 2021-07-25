<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelkwitansiaps extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

    public function getKwitansiaps($where ='')
	{
        return $this->db->query(" select regperiksa.*,jenispemeriksaandetail.detailketerangan from regperiksa 
            left join jenispemeriksaandetail on regperiksa.idjenispemeriksaandetail = jenispemeriksaandetail.id
            $where ")->result_array();
    }
}
?>    