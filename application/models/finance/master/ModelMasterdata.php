<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelMasterdata extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getDepartement($where = '')
	{
        return $this->db->query("SELECT * FROM tbl_dep  $where ")->result_array();
    }
    
    
    
    public function getPaymentvoucherdetail($where = '')
	{
        return $this->db->query("SELECT * FROM tkas2 $where ")->result_array();
    }
    
    public function getPaymentvoucherbyid($where = '')
	{
        return $this->db->query("SELECT tkas1.*, format(tkas2.jumlah,2) as jumlah FROM tkas1 left join (select NoRef, sum(Kredit) as jumlah from tkas2 group by Noref) as tkas2 on tkas1.NoRef = tkas2.Noref  $where ")->result_array();
    }
    
    public function getReceiptvoucher($NoRef)
	{
        return $this->db->query("SELECT max(SUBSTR(NoRef, 1, 3)) as receiptno FROM tkas2 where NoRef like '%$NoRef'")->result_array();
    }
    public function getPaymentvoucher($NoRef)
	{
        return $this->db->query("SELECT max(SUBSTR(NoRef, 1, 3)) as paymentno FROM tkas1 where NoRef like '%$NoRef'")->result_array();
    }
    
    public function getCustomer($where = '')
	{
        return $this->db->query("SELECT * FROM tbl_client $where;")->result_array();
    }

    
    public function getPerson($where = '')
    {
        return $this->db->query("SELECT * FROM tbl_person  $where ")->result_array();
    }


    function getDetailPerson(){
        return $this->db->query("
        SELECT d.Kode_Dep,d.Nama_Dep,p.Company_Id,p.Kode_Person,p.Nama_Person,p.Inisial
            FROM  tbl_person p 
            INNER JOIN tbl_dep d ON d.Kode_Dep = p.Kode_Dep 
            ORDER BY d.Nama_Dep ASC
        ")->result_array();
    }

     function getAllDetailPerson($Kode_Dep){
        return $this->db->query("
        SELECT d.Kode_Dep,d.Nama_Dep,p.Company_Id,p.Kode_Person,p.Nama_Person,p.Inisial
            FROM  tbl_person p 
            LEFT JOIN tbl_dep d ON d.Kode_Dep = p.Kode_Dep 
            WHERE a.Kode_Dep = '".$Kode_Dep."'
           
        ")->result_array();
    }

    function getAllModuleDetailUser($user_id){
        return $this->db->query("
        SELECT md.modul_detail_id, md.nama_modul_detail, md.is_active md_active, md.url,
                m.modul_id, m.icon, m.nama_modul, m.is_active m_active, m.no_urut, u.user_id,
                rm.r, rm.w
            FROM  modul_detail md 
            INNER JOIN modul m ON m.modul_id = md.modul_id 
            LEFT JOIN role_menu rm ON rm.modul_detail_id = md.modul_detail_id AND rm.user_id = '".$user_id."'
            LEFT JOIN users u ON u.user_id = rm.user_id 
            ORDER BY u.user_id DESC
        ")->result_array();
    }
}
