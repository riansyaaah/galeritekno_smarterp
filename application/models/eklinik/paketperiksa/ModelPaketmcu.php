<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelPaketmcu extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }


  function getPaketmcu($where = "")
  {
    return $this->db->query("SELECT * FROM ekl_paketmcu $where ")->result_array();
  }
    
    public function getItemPeriksa($where = '')
    {
        return $this->db->query("SELECT * FROM ekl_itemperiksa $where ")->result_array();
    }
    
    public function getdetail($where = '')
    {
        return $this->db->query("SELECT * FROM ekl_paketmcu_detail $where ")->result_array();
    }
    
    public function getPaketmcudetail($id)
    {
        return $this->db->query("SELECT ekl_itemperiksa.*, ekl_paketmcu_detail.iddetail FROM ekl_itemperiksa left join (select * from ekl_paketmcu_detail where paketmcu_id = '$id') as ekl_paketmcu_detail on ekl_itemperiksa.id = ekl_paketmcu_detail.id order by ekl_itemperiksa.id asc")->result_array();
    }
}
