<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelAccountsetting extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}


	public function getCurrency($where ='')
	{
        return $this->db->query("
            SELECT tbl_valuta.*, instansi.nama_instansi, branch.nama_branch FROM tbl_valuta 
            LEFT JOIN instansi 
            on tbl_valuta.instansi_id =instansi.instansi_id
            LEFT JOIN branch
            on tbl_valuta.branch_id= branch.branch_id $where ")->result_array();
    }

    public function getCustomer($where = '')
    {
        return $this->db->query("SELECT tbl_client.*, tbl_bis.Nama_Bis FROM tbl_client LEFT JOIN tbl_bis ON tbl_client.Kode_Bis=tbl_bis.Kode_Bis  $where ")->result_array();
    }

    public function getInstansiSelect2($where = '')
    {
        return $this->db->query("SELECT * FROM instansi
          $where ")->result_array();
    }
    public function getBranchSelect2($where = '')
    {
        return $this->db->query("SELECT * FROM branch
          $where ")->result_array();

	}
}
   