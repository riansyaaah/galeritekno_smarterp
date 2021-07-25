<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelPurchaseinvoice extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getPeriode()
	{
        return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
    }
    public function getSupplier($where = '')
	{
        return $this->db->query("SELECT * FROM tbl_spl  $where ")->result_array();
    }
    public function getInvSupplier($where = '')
	{
        return $this->db->query("SELECT fin_purchaseinvoice.*,tbl_spl.Kode_Spl,tbl_spl.Nama_Spl FROM fin_purchaseinvoice left join tbl_spl on fin_purchaseinvoice.supplier_id = tbl_spl.Kode_Spl $where ")->result_array();
    }
    public function getPurchaseinvoice($where = '')
	{
        return $this->db->query("SELECT * FROM fin_purchaseinvoice $where ")->result_array();
    }
    
    public function getPurchaseinvoicedetail($where = '')
	{
        return $this->db->query("SELECT * from fin_purchaseinvoice_detail $where ")->result_array();
    }

}