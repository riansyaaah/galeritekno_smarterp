<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelProject extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getPeriode()
	{
        return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
    }

    public function getAccount()
	{
        return $this->db->query("SELECT CONCAT_WS('-', SUBSTRING(accountsaldo.AccountNo, 1,1), SUBSTRING(accountsaldo.AccountNo, 2, 5)) as AccountNoCol, accountsaldo.ThnBln, accountsaldo.AccountNo, accountsaldo.Company_Id, accountsaldo.SaldoDebet, accountsaldo.SaldoKredit, accountsaldo.SaldoDebet, accountsaldo.SaldoKredit, accountmaster.AccountName FROM accountsaldo INNER JOIN accountmaster ON accountsaldo.AccountNo=accountmaster.AccountNo order by AccountNo")->result_array();
    }

    public function getDataproject($where = '')
	{
        return $this->db->query("SELECT * FROM tbl_project $where;")->result_array();
    }

    public function getCustomer($where = '')
	{
        return $this->db->query("SELECT * FROM tbl_client $where;")->result_array();
    }
    
    public function getOpeningbalancebyid($AccountNo,$periodeaktif)
	{
        return $this->db->query("SELECT CONCAT_WS('-', SUBSTRING(accountsaldo.AccountNo, 1,1), SUBSTRING(accountsaldo.AccountNo, 2, 5)) as AccountNoCol, accountsaldo.ThnBln, accountsaldo.AccountNo, accountsaldo.Company_Id, accountsaldo.SaldoDebet, accountsaldo.SaldoKredit, accountsaldo.SaldoDebet, accountsaldo.SaldoKredit, accountmaster.AccountName FROM accountsaldo INNER JOIN accountmaster ON accountsaldo.AccountNo=accountmaster.AccountNo where accountsaldo.AccountNo = '$AccountNo' and accountsaldo.ThnBln = '$periodeaktif'  order by AccountNo limit 1")->result_array();
    }
    public function getSumofdebit($periodeaktif)
	{
        return $this->db->query("SELECT sum(accountsaldo.SaldoDebet) as jumlah FROM accountsaldo INNER JOIN accountmaster ON accountsaldo.AccountNo=accountmaster.AccountNo where accountsaldo.ThnBln = '$periodeaktif'")->result_array();
    }
    public function getSumofkredit($periodeaktif)
	{
        return $this->db->query("SELECT sum(accountsaldo.SaldoKredit) as jumlah FROM accountsaldo INNER JOIN accountmaster ON accountsaldo.AccountNo=accountmaster.AccountNo where accountsaldo.ThnBln = '$periodeaktif'")->result_array();
    }

}