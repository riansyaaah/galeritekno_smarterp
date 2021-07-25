<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelPaymentvoucher extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getPeriode()
	{
		return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
	}
	public function getPaymentvoucherdetail($where = '')
	{
		return $this->db->query("SELECT * FROM fin_voucher_detail $where ")->result_array();
	}
	public function getItemVoucherbyid($where = '')
	{
		return $this->db->query("SELECT fin_voucher_detail.*,fin_accountbalance.AccountName FROM fin_voucher_detail left join fin_accountbalance on fin_voucher_detail.AccountNo = fin_accountbalance.AccountNo  $where ")->result_array();
	}
	public function getPaymentvoucherbyid($where = '')
	{
		return $this->db->query("SELECT fin_voucher.*, format(fin_voucher_detail.Amount,2) as Amount FROM (select * from fin_voucher where VoucherType = '2') as fin_voucher left join (select VoucherNo, sum(Credit) as Amount from fin_voucher_detail group by VoucherNo) as fin_voucher_detail on fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo  $where ")->result_array();
	}

	public function getPYCashbank($where = '')
	{
		return $this->db->query("SELECT fin_voucher.*,fin_cashbank.BankName,format(fin_voucher_detail.Amount,2) as Amount FROM fin_voucher 
        left join fin_cashbank on fin_voucher.BankCode = fin_cashbank.BankCode 
        left join (select VoucherNo, sum(Credit) as Amount from fin_voucher_detail group by VoucherNo) as fin_voucher_detail on fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo $where ")->result_array();
	}

	public function getPaymentvoucher($VoucherNo)
	{
		return $this->db->query("SELECT max(SUBSTR(VoucherNo, 1, 3)) as VoucherNo FROM fin_voucher where VoucherNo like '%$VoucherNo' and VoucherType = '2'")->result_array();
	}

	public function getCashbank($where = '')
	{
		return $this->db->query("SELECT fin_cashbank.*,format((fin_accountbalance.Debit - fin_accountbalance.Credit),2) as Saldo FROM fin_cashbank left join fin_accountbalance on fin_cashbank.AccountNo = fin_accountbalance.AccountNo $where")->result_array();
	}
	public function getAccountNo($where = '')
	{
		return $this->db->query("SELECT * FROM fin_mastercoa  $where ")->result_array();
	}

	public function getPaymentvoucherForPrint($id)
	{
		$this->db->select('*');
		$this->db->from('fin_voucher');
		$this->db->where('VoucherNo', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function getPaymentvoucherdetailForPrint($id)
	{
		$this->db->select('*');
		$this->db->from('fin_voucher_detail');
		$this->db->where('VoucherNo', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getTotalAmountById($id)
	{
		// Harusnya "kredit" saya rasa, tapi di table masuk ke Debit :D
		$this->db->select_sum('Debit', 'Debit_total');
		$this->db->where('VoucherNo', $id);
		$query = $this->db->get('fin_voucher_detail');
		return $query->row();
	}
}
