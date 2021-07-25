<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelInvoiceCorporate extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getPeriode()
	{
        return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
    }

    public function getInvoiceCor($where = '')
    {
        return $this->db->query("SELECT InvoiceCorNo,InvoiceCorDate, sum(Debit) as Debit, sum(Credit) as Credit FROM fin_invoicecorporate group by InvoiceCorNo,InvoiceCorDate $where")->result_array();
    }
    
    public function getInvoiceCorNoDetail($where = '')
    {
        return $this->db->query("SELECT fin_invoicecorporate.*,fin_accountbalance.AccountName FROM fin_invoicecorporate left join fin_accountbalance on fin_invoicecorporate.AccountNo  = fin_accountbalance.AccountNo $where")->result_array();
    }
    
    public function getInvoiceCorNo($InvoiceCorNo)
    {
        return $this->db->query("SELECT max(SUBSTR(InvoiceCorNo, 1, 3)) as InvoiceCorNo FROM fin_invoicecorporate where InvoiceCorNo like '%$InvoiceCorNo'")->result_array();
    }
    
    public function getAccountNo($where = '')
    {
        return $this->db->query("SELECT * FROM fin_mastercoa  $where ")->result_array();
    }
    public function getCountICNoDetail($InvoiceCorNo) {
        return $this->db->select('COUNT(fin_invoicecorporate.id) as jumlah')
            ->join('fin_accountbalance', 'fin_invoicecorporate.AccountNo = fin_accountbalance.AccountNo')
            ->where('InvoiceCorNo', $InvoiceCorNo)
            ->get('fin_invoicecorporate')
            ->row_array();
    }
}