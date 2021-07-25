<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelPerson extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getDepartement($where = '')
	{
        return $this->db->query("SELECT * FROM tbl_dep  $where ")->result_array();
    }

    public function getPerson($where = '')
    {
        return $this->db->query("SELECT * FROM tbl_person  $where ")->result_array();
    }


    function getDetailPerson($where =''){
        return $this->db->query("
        SELECT d.Kode_Dep,d.Nama_Dep,p.Company_Id,p.Kode_Person,p.Nama_Person,p.Inisial
            FROM  tbl_person p 
            INNER JOIN tbl_dep d ON d.Kode_Dep = p.Kode_Dep 
             $where
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
}