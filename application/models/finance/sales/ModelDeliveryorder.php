<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelDeliveryorder extends CI_Model {
	
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
    public function getDOClient($where = '')
	{
        return $this->db->query("SELECT fin_deliveryorder.*,tbl_client.ClientID,tbl_client.ClientName FROM fin_deliveryorder left join tbl_client on fin_deliveryorder.client_id = tbl_client.ClientID $where ")->result_array();
    }
    public function getDeliveryorder($where = '')
	{
        return $this->db->query("SELECT * FROM fin_deliveryorder $where ")->result_array();
    }
    
    public function getDeliveryorderdetail($where = '')
	{
        return $this->db->query("SELECT * from fin_deliveryorder_detail $where ")->result_array();
    }

}