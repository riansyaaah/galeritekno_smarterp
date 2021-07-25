<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelPosting extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getPeriode()
	{
		return $this->db->get_where('periode', ['Active' => 1])->result_array();
	}
	public function getDataPosting($where = '')
	{
		return $this->db->query("
            SELECT fin_voucher.*, fin_accountbalance.AccountName,fin_voucher_detail.AccountNo,fin_cashbank.BankName,fin_voucher_detail.Amount AS Amount FROM fin_voucher -- 
            LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode 
            LEFT JOIN (SELECT VoucherNo, sum(Credit) AS Amount, (SELECT AccountNo) AS AccountNo from fin_voucher_detail GROUP BY VoucherNo) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
            LEFT JOIN fin_accountbalance ON fin_accountbalance.AccountNo = fin_voucher_detail.AccountNo
            $where ")->result_array();
	}

	public function getDataPosting2($where = '')
	{
		return $this->db->query("
            SELECT fin_voucher.VoucherNo, fin_voucher.VoucherDate, IF(fin_voucher.VoucherType=2, 'Payment', 'Receipt') AS VoucherType, fin_accountbalance.AccountNo, fin_accountbalance.AccountName AS Account, fin_voucher.Description, fin_voucher_detail.Credit, fin_voucher_detail.Debit, fin_voucher.Posting FROM fin_voucher
						
            LEFT JOIN (SELECT VoucherNo, SUM(Credit) AS Credit, SUM(Debit) AS Debit, AccountNo FROM fin_voucher_detail GROUP BY VoucherNo) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
            LEFT JOIN (SELECT AccountNo, AccountName FROM fin_accountbalance GROUP BY AccountNo) AS fin_accountbalance ON fin_accountbalance.AccountNo = fin_voucher_detail.AccountNo
            UNION ALL
            SELECT fin_vouchermemo.VoucherMemoNo AS VoucherNo, fin_vouchermemo.VoucherMemoDate, 'Memo', fin_accountbalance.AccountNo, fin_accountbalance.AccountName, fin_vouchermemo.Description, SUM(fin_vouchermemo.Credit), SUM(fin_vouchermemo.Debit), fin_vouchermemo.Posting FROM fin_vouchermemo
            LEFT JOIN (SELECT AccountNo, AccountName FROM fin_accountbalance GROUP BY AccountNo) AS fin_accountbalance ON fin_accountbalance.AccountNo = fin_vouchermemo.AccountNo GROUP BY VoucherMemoNo
            $where ")->result_array();
	}

	// Get data untuk data Posting
	public function getAllDataPosting()
	{
		$this->db->select(
			"
			v.VoucherDate, 
			v.VoucherNo, 
			v.Posting, 
			IF(v.VoucherType=2, 'Payment', 'Receipt') AS VoucherType,
			cb.AccountNo AS AccountNoCB, 
			cb.BankName AS Account,  
			v.Description AS DescriptionV, 
			SUM(vd.Debit) AS Debit, 
			SUM(vd.Credit) AS Credit
			"
		);
		$this->db->join('fin_voucher_detail vd', 'vd.VoucherNo=v.VoucherNo', 'inner');
		$this->db->join('fin_cashbank cb', 'cb.BankCode=v.BankCode', 'inner');
		$this->db->join('fin_accountbalance ab', 'ab.AccountNo=vd.AccountNo', 'inner');
		$this->db->from('fin_voucher v');
		$this->db->group_by('v.VoucherNo');
		$this->db->order_by('v.VoucherDate', 'ASC');
		return $this->db->get()->result_array();
	}

	public function getDataMemo($where = '')
	{
		return $this->db->query("SELECT * FROM fin_vouchermemo $where")->result_array();
	}
}
