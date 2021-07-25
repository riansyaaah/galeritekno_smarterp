<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelPurchaseorder extends CI_Model {
	
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
    
    public function getPOSupplier($where = '')
	{
        return $this->db->query("SELECT fin_purchaseorder.*,tbl_spl.Kode_Spl,tbl_spl.Nama_Spl FROM fin_purchaseorder left join tbl_spl on fin_purchaseorder.supplier_id = tbl_spl.Kode_Spl $where ")->result_array();
    }
    
    public function getPurchaseOrder($where = '')
	{
        return $this->db->query("SELECT * FROM fin_purchaseorder $where ")->result_array();
    }
    
    public function getPurchaseorderdetail($where = '')
	{
        return $this->db->query("SELECT * from fin_purchaseorder_detail $where ")->result_array();
    }
}