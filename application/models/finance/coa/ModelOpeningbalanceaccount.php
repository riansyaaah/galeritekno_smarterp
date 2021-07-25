<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelOpeningbalanceaccount extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    public function getPeriode()
	{
        return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
    }
    public function getOpeningbalanceaccount($where = '')
	{
        return $this->db->query("SELECT * FROM fin_accountbalance $where ")->result_array();
    }
    
    public function getSumofdebit($periodeaktif)
	{
        return $this->db->query("SELECT sum(Debit) as jumlah FROM fin_accountbalance where ActivePeriode = '$periodeaktif'")->result_array();
    }
    public function getSumofkredit($periodeaktif)
	{
        return $this->db->query("SELECT sum(Credit) as jumlah FROM fin_accountbalance where ActivePeriode = '$periodeaktif'")->result_array();
    }
    public function getAccountNoById($AccountNo) {
        return $this->db->get_where('fin_accountbalance', ['AccountNo' => $AccountNo])->row_array();
    }

}