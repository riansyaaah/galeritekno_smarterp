<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelJournal extends CI_Model
{

	public function __construct() {
		parent::__construct();
	}
	public function getPeriode() {
		return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
	}

	public function getDataCash($where = '')
	{
		return $this->db->query("SELECT * FROM (
			SELECT fin_voucher.VoucherNo AS Nourut, fin_voucher.VoucherDate as Date,fin_voucher.VoucherNo as ReffNo, AccountNoParrent AS Account, CONCAT(BankName,' - ',Description) AS Description, fin_voucher_detail.jumlahcredit AS Debit, fin_voucher_detail.jumlahdebit AS Credit FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo AS AccountNoParrent,fin_cashbank.BankName FROM `fin_voucher`  LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1 ) AS fin_voucher LEFT JOIN (SELECT VoucherNo, SUM(credit) AS jumlahcredit, SUM(debit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo 
			UNION ALL 
			SELECT CONCAT(fin_voucher.VoucherNo,'1',id)AS Nourut, '' AS DATE, fin_voucher_detail.VoucherNo as ReffNo, AccountNo AS Account, fin_voucher_detail.Description, fin_voucher_detail.debit AS Debit, fin_voucher_detail.credit AS Credit FROM fin_voucher_detail INNER JOIN (SELECT * FROM `fin_voucher` WHERE 1=1 ) AS fin_voucher ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo 
    UNION ALL 
			SELECT CONCAT(fin_voucher_detail.VoucherNo,'2') as Nourut, '' as Date, '' AS ReffNo, '' as Account, 'Sub Total' as Description, SUM(IFNULL(fin_voucher_detail.credit,fin_voucher_detail.debit)) AS Debit, SUM(IFNULL(fin_voucher_detail.debit,fin_voucher_detail.credit)) AS Credit FROM fin_voucher_detail INNER JOIN (SELECT * FROM `fin_voucher` WHERE 1=1 ) AS fin_voucher ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo 
				GROUP BY fin_voucher_detail.VoucherNo
    UNION ALL 
			SELECT CONCAT(VoucherMemoNo,NoUrut,'1') AS Nourut, VoucherMemoDate AS DATE, VoucherMemoNo as ReffNo, AccountNo AS Account, Description, Debit AS Debit, Credit AS Credit FROM fin_vouchermemo  
			UNION ALL 
			SELECT CONCAT(VoucherMemoNo,'2','2') as Nourut, '' as Date, '' AS ReffNo, '' as Account, 'Sub Total' as Description, SUM(Debit) AS Debit, SUM(Credit) AS Credit FROM fin_vouchermemo
				GROUP BY VoucherMemoNo
    
			UNION ALL
    select 'x' AS Nourut, '' as Date, '' as ReffNo, '' as Account, 'Grand Total' as Description, sum(Debit) as Debit, SUM(Credit) AS Credit from (
			SELECT 'x' AS Nourut, '' as Date, '' as ReffNo, '' as Account, 'Grand Total' as Description, SUM(IFNULL(fin_voucher_detail.credit,fin_voucher_detail.debit)) AS Debit, SUM(IFNULL(fin_voucher_detail.debit,fin_voucher_detail.credit)) AS Credit FROM `fin_voucher_detail` INNER JOIN (SELECT * FROM `fin_voucher` WHERE 1=1) AS fin_voucher ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo 
        UNION ALL
        SELECT 'x' AS Nourut, '' as Date, '' as ReffNo, '' as Account, 'Grand Total' as Description, SUM(Debit) AS Debit, SUM(credit) AS Credit FROM `fin_vouchermemo`
        ) as grandtotal group by Description
			) AS jurnal 
ORDER BY `jurnal`.`Nourut`  ASC ")->result_array();
	}
	public function getDataPreview1($form) {
		return $this->db->select('v.VoucherDate, v.VoucherNo, cb.AccountNo AS AccountNoCB, cb.BankName, v.Description AS DescriptionV, IFNULL(sum(vd.Debit), 0) AS Debit, IFNULL(sum(vd.Credit), 0) as Credit')
			->join('fin_voucher_detail AS vd', 'vd.VoucherNo = v.VoucherNo', 'inner')
			->join('fin_cashbank AS cb', 'cb.BankCode = v.BankCode', 'inner')
			->join('fin_accountbalance AS ab', 'ab.AccountNo = vd.AccountNo', 'inner')
			->where('v.VoucherDate BETWEEN \''.$form['from_date'].'\' AND \''.$form['to_date'].'\'')
			->where('v.Posting', 1)
			->like('v.VoucherNo', $form['typeJournal'], 'both')
			->order_by('v.VoucherDate', 'ASC')
			->group_by('v.VoucherNo')
			->get('fin_voucher AS v')
			->result_array();
	}
	public function getDataPreview2($form) {
		return $this->db->select('v.VoucherDate, v.VoucherNo, ab.AccountNo AS AccountNoAB, ab.AccountName, vd.Description AS DescriptionVD, IFNULL(vd.Debit, 0) AS Debit, IFNULL(vd.Credit, 0) AS Credit')
			->join('fin_voucher_detail AS vd', 'vd.VoucherNo = v.VoucherNo', 'inner')
			->join('fin_cashbank AS cb', 'cb.BankCode = v.BankCode', 'inner')
			->join('fin_accountbalance AS ab', 'ab.AccountNo = vd.AccountNo', 'inner')
			->where('v.VoucherDate BETWEEN \''.$form['from_date'].'\' AND \''.$form['to_date'].'\'')
			->where('v.Posting', 1)
			->like('v.VoucherNo', $form['typeJournal'], 'both')
			->order_by('v.VoucherDate', 'ASC')
			->get('fin_voucher AS v')
			->result_array();
	}
	public function getDataPreview3($form) {
		return $this->db->select_sum('Debit', 'total_debit')
			->join('fin_voucher AS v', 'v.VoucherNo=vd.VoucherNo', 'inner')
			->where('v.VoucherDate BETWEEN \''.$form['from_date'].'\' AND \''.$form['to_date'].'\'')
			->where('v.Posting', 1)
			->like('v.VoucherNo', $form['typeJournal'], 'both')
			->order_by('v.VoucherDate', 'ASC')
			->get('fin_voucher_detail AS vd')
			->row_array()['total_debit'];
	}
}
