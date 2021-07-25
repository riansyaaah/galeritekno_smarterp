<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelRegisterPasien extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }


  function getRekamMedik($where = "")
  {
    return $this->db->query("SELECT * FROM ekl_rekammedis $where ")->result_array();
  }
    
    function getRegisterPasien($where = "")
  {
    return $this->db->query("SELECT * FROM ekl_regpasien $where ")->result_array();
  }
    
    public function getJenisRegistrasi($where = '')
    {
        return $this->db->query("SELECT * FROM ekl_jenis_registrasi $where ")->result_array();
    }
    public function getJenisPoliklinik($where = '')
    {
        return $this->db->query("SELECT * FROM ekl_poliklinik $where ")->result_array();
    }
    public function getDokterPoli($where = '')
    {
        return $this->db->query("SELECT * FROM ekl_dokter $where ")->result_array();
    }
    public function getPaketMcu($where = '')
    {
        return $this->db->query("SELECT * FROM ekl_paketmcu $where ")->result_array();
    }
    public function getItemPeriksa($where = '')
    {
        return $this->db->query("SELECT * FROM ekl_itemperiksa $where ")->result_array();
    }
    
    public function getLabdetail($where = '')
    {
        return $this->db->query("SELECT * FROM ekl_pasienlaboratorium_detail $where ")->result_array();
    }
    public function getPenjamin($where = '')
    {
        return $this->db->query("SELECT * FROM ekl_masterpenjamin $where ")->result_array();
    }
}
