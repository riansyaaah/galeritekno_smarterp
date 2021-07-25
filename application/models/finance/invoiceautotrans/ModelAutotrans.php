<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelAutotrans extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getPeriode()
	{
        return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
    }

    public function getAutotrans($where = '')
    {
        return $this->db->query("SELECT AutotransNo,AutotransDate, sum(Debit) as Debit, sum(Credit) as Credit FROM fin_autotrans group by AutotransNo,AutotransDate $where")->result_array();
    }
    
    public function getAutotransNoDetail($where = '')
    {
        return $this->db->query("SELECT fin_autotrans.*,fin_accountbalance.AccountName FROM fin_autotrans left join fin_accountbalance on fin_autotrans.AccountNo  = fin_accountbalance.AccountNo $where")->result_array();
    }
    
    public function getAutotransNo($AutotransNo)
    {
        return $this->db->query("SELECT max(SUBSTR(AutotransNo, 1, 3)) as AutotransNo FROM fin_autotrans where AutotransNo like '%$AutotransNo'")->result_array();
    }
    
    public function getAccountNo($where = '')
    {
        return $this->db->query("SELECT * FROM fin_mastercoa  $where ")->result_array();
    }
    public function getCountATNoDetail($AutotransNo) {
        return $this->db->select('COUNT(fin_autotrans.id) as jumlah')
            ->join('fin_accountbalance', 'fin_autotrans.AccountNo = fin_accountbalance.AccountNo')
            ->where('AutotransNo', $AutotransNo)
            ->get('fin_autotrans')
            ->row_array();
    }
}