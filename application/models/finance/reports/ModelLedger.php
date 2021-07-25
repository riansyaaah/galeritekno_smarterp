<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelLedger extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function getPeriode()
    {
        return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
    }
    public function getKepalaAccount1($where)
    {
        return $this->db->query("SELECT fin_accountbalance.AccountNo, fin_accountbalance.AccountName, fin_accountbalance.Debit, fin_accountbalance.Credit,sumDebit,sumCredit FROM fin_accountbalance LEFT JOIN (SELECT AccountNo, SUM(Debit) AS sumDebit,SUM(Credit) AS sumCredit FROM (SELECT CONCAT(AccountNoParrent,'2') AS Nourut, AccountNoParrent AS AccountNo, fin_voucher.VoucherDate AS DATE,fin_voucher.VoucherNo AS ReffNo, CONCAT(BankName,' - ',Description) AS Description, fin_voucher.BankCode AS source, fin_voucher_detail.jumlahcredit AS Debit, fin_voucher_detail.jumlahdebit AS Credit FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo AS AccountNoParrent,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode $where) AS fin_voucher LEFT JOIN (SELECT VoucherNo, SUM(credit) AS jumlahcredit, SUM(debit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY VoucherNo ASC) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
UNION ALL
SELECT CONCAT(AccountNo,'2') AS Nourut,AccountNo ,'' AS DATE,VoucherNo AS ReffNo, Description, '' AS source, Debit, Credit FROM fin_voucher_detail
UNION ALL
SELECT CONCAT(AccountNo,'2') AS Nourut, AccountNo,'' AS DATE,VoucherMemoNo AS ReffNo, Description, '' AS source, Debit, Credit FROM fin_vouchermemo) AS awal GROUP BY AccountNo) AS awallagi ON fin_accountbalance.AccountNo = awallagi.AccountNo WHERE Debit != 0 OR Credit != 0 OR sumDebit IS NOT NULL OR sumCredit IS NOT NULL")->result_array();
    }
    
    public function getDataReportall($AccountNo = '')
    {
        return $this->db->query("SELECT * from (SELECT concat(fin_accountbalance.AccountNo,'1') as Nourut, '' as Date, '' as ReffNo, 'Opening Balance' as Description, '' as source, fin_accountbalance.Debit as Debit, fin_accountbalance.Credit as Credit FROM fin_accountbalance where AccountNo = '$AccountNo'
UNION ALL
SELECT concat(AccountNoParrent,'2') as Nourut, fin_voucher.VoucherDate as Date,fin_voucher.VoucherNo as ReffNo, concat(BankName,' - ',Description) as Description, fin_voucher.BankCode as source, fin_voucher_detail.jumlahcredit as Debit, fin_voucher_detail.jumlahdebit as Credit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo as AccountNoParrent,fin_cashbank.BankName from `fin_voucher` left join fin_cashbank on fin_voucher.BankCode = fin_cashbank.BankCode where 1=1) as fin_voucher left join (SELECT VoucherNo, sum(credit) as jumlahcredit, sum(debit) as jumlahdebit FROM `fin_voucher_detail` group by VoucherNo order by VoucherNo asc) as fin_voucher_detail on fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
UNION ALL
SELECT concat(AccountNo,'2') as Nourut, '' as Date,VoucherNo as ReffNo, Description, '' as source, Debit, Credit 
FROM fin_voucher_detail
UNION ALL
SELECT concat(AccountNo,'2') as Nourut, '' as Date,VoucherMemoNo as ReffNo, Description, '' as source, Debit, Credit 
FROM fin_vouchermemo
) as ledger where Nourut like '$AccountNo%' order by Nourut asc ")->result_array();
    }
    
    public function getKepalaAccount($where = '')
    {
        return $this->db->query("SELECT fin_accountbalance.AccountNo, fin_accountbalance.AccountName, fin_accountbalance.Debit, fin_accountbalance.Credit FROM fin_voucher 
        left join fin_cashbank on fin_voucher.BankCode = fin_cashbank.BankCode 
        left join fin_accountbalance on fin_cashbank.AccountNo = fin_accountbalance.AccountNo 
        group by fin_voucher.BankCode
        
        $where")->result_array();
    }

    public function getKepalaAccount2($where = '')
    {
        return $this->db->query("SELECT fin_accountbalance.AccountNo, fin_accountbalance.AccountName, fin_accountbalance.Debit, fin_accountbalance.Credit FROM fin_voucher_detail 
        left join fin_accountbalance on fin_voucher_detail.AccountNo = fin_accountbalance.AccountNo 
        group by fin_voucher_detail.AccountNo
        
        $where")->result_array();
    }
    public function getDataCash($where = '')
    {
        return $this->db->query("SELECT fin_voucher.VoucherDate,fin_voucher_detail.VoucherNo, fin_voucher_detail.AccountNo,fin_voucher_detail.Description,fin_voucher_detail.Debit,fin_voucher_detail.Credit FROM fin_voucher_detail left join fin_voucher on fin_voucher_detail.VoucherNo = fin_voucher.VoucherNo $where ")->result_array();
    }

    public function getDataReport($AccountNo = '')
    {
        return $this->db->query("select * from (SELECT concat(fin_accountbalance.AccountNo,'1') as Nourut, '' as Date, '' as ReffNo, 'Opening Balance' as Description, '' as source, fin_accountbalance.Debit as Debit, fin_accountbalance.Credit as Credit FROM fin_accountbalance where AccountNo = '$AccountNo'
UNION ALL
SELECT concat(AccountNoParrent,'2') as Nourut, fin_voucher.VoucherDate as Date,fin_voucher.VoucherNo as ReffNo, concat(BankName,' - ',Description) as Description, fin_voucher.BankCode as source, fin_voucher_detail.jumlahcredit as Debit, fin_voucher_detail.jumlahdebit as Credit 
FROM (select fin_voucher.*,fin_cashbank.AccountNo as AccountNoParrent,fin_cashbank.BankName from `fin_voucher` left join fin_cashbank on fin_voucher.BankCode = fin_cashbank.BankCode where 1=1) as fin_voucher left join (SELECT VoucherNo, sum(credit) as jumlahcredit, sum(debit) as jumlahdebit FROM `fin_voucher_detail` group by VoucherNo order by VoucherNo asc) as fin_voucher_detail on fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo) as ledger where Nourut like '$AccountNo%' order by Nourut asc ")->result_array();
    }
    public function getDataReport2($AccountNo = '')
    {
        return $this->db->query("select * from (
SELECT concat(fin_accountbalance.AccountNo,'1') as Nourut, '' as Date, '' as ReffNo, 'Opening Balance' as Description, '' as source, fin_accountbalance.Credit as Debit, fin_accountbalance.Debit as Credit FROM fin_accountbalance where AccountNo = '$AccountNo'
UNION ALL
SELECT concat(AccountNo,'2') as Nourut, '' as Date,VoucherNo as ReffNo, Description, '' as source, Debit, Credit 
FROM fin_voucher_detail
) as ledger where Nourut like '$AccountNo%' order by Nourut asc ")->result_array();
    }
    public function getCashbank($where = '') {
        return $this->db->query("SELECT fin_cashbank.*,format((fin_accountbalance.Debit-fin_accountbalance.Credit),2) as Saldo FROM fin_cashbank left join fin_accountbalance on fin_cashbank.AccountNo = fin_accountbalance.AccountNo $where")->result_array();
    }
    public function daftarTahun() {
        return [2019, 2020, 2021];
    }
    public function daftarBulan() {
        return [
            ['01', 'Januari'],['02', 'Februari'], ['03', 'Maret'], ['04', 'April'], ['05', 'Mei'], ['06', 'Juni'], ['07', 'Juli'], ['08', 'Agustus'], ['09', 'September'], ['10', 'Oktober'], ['11', 'November'], ['12', 'Desember']
        ];
    }
}
