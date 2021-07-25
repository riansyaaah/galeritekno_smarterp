<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelMastercoa extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    public function getPeriode()
	{
        return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
    }
    function getMasterCOA($where = ""){
        return $this->db->query("SELECT * from  fin_mastercoa $where")->result_array();
    }
    
    function getActivePeriodeOB($where = ""){
        return $this->db->query("SELECT * from  fin_accountbalance $where")->result_array();
    }
    
    function GenerateAccountBalance($thn){
        return $this->db->query("insert into fin_accountbalance(ActivePeriode, AccountNo, AccountParrent, AccountName, Level, Debit, Credit, instansi_id, branch_id) SELECT '$thn' as ActivePeriode, AccountNo, AccountParrent, AccountName, Level, '0' as Debit, '0' as Credit, instansi_id, branch_id FROM fin_mastercoa WHERE Level = 'MASTER'");
    }
    
}