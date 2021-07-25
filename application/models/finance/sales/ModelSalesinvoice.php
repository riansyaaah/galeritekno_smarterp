<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelSalesinvoice extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getPeriode()
	{
        return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
    }
    public function getClient($where = '')
	{
        return $this->db->query("SELECT * FROM tbl_client  $where ")->result_array();
    }
    public function getInvClient($where = '')
	{
        return $this->db->query("SELECT fin_salesinvoice.*,tbl_client.ClientID,tbl_client.ClientName FROM fin_salesinvoice left join tbl_client on fin_salesinvoice.client_id = tbl_client.ClientID $where ")->result_array();
    }
    public function getSalesinvoice($where = '')
	{
        return $this->db->query("SELECT * FROM fin_salesinvoice $where ")->result_array();
    }
    
    public function getSalesinvoicedetail($where = '')
	{
        return $this->db->query("SELECT * from fin_salesinvoice_detail $where ")->result_array();
    }

}