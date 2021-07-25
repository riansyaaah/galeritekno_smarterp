<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelBalancesheet extends CI_Model {
    public function tahun() {
        return [2019, 2020, 2021];
    }
    public function bulan() {
        return [
            ['01', 'Januari'], ['02', 'Februari'], ['03', 'Maret'], ['04', 'April'], ['05', 'Mei'], ['06', 'Juni'], ['07', 'Juli'], ['08', 'Agustus'], ['09', 'September'], ['10', 'Oktober'], ['11', 'November'], ['12', 'Desember']];
    }
    public function __construct() {
        parent::__construct();
    }
    public function getPeriode()
	{
        return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
    }
    public function getDataCash($where = '')
	{
        return $this->db->query("SELECT * from  fin_mastercoa $where ")->result_array();
    }
    public function getType() {
        return $this->db->where('Level', 'TYPE')
            ->where('AccountNo', 1000)
            ->or_where('AccountNo', 2000)
            ->or_where('AccountNo', 3000)
            ->get('fin_mastercoa')
            ->result_array();
    }
    public function getGroup() {
        return $this->db->where('Level', 'Group')
            ->where('AccountNo !=', 1500)
            ->where('AccountNo !=', 3100)
            ->get('fin_mastercoa')
            ->result_array();
    }
    public function getSgroup() {
        return $this->db->where('Level', 'SGroup')
            ->or_where('AccountParrent !=', 1500)
            ->or_where('AccountParrent !=', 3100)
            ->get('fin_mastercoa')
            ->result_array();
    }
    
    public function getBalanceData($where = '')
	{
        return $this->db->query("select fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo, fin_mastercoa.AccountName, fin_mastercoa.Level as level,opendebit,opencredit,mutasidebit,mutasicredit from fin_mastercoa left join (SELECT RPAD(concat(SUBSTR(fin_mastercoa.AccountNo,1,2),'9'),5,'0') AS nourut, fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo, concat('TOTAL ', fin_mastercoa.AccountName) AS AccountName,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'SGROUP' AS level FROM fin_mastercoa LEFT JOIN
(SELECT concat(fin_mastercoa.AccountNo,'_1') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'CODE' AS level FROM
(SELECT * FROM fin_mastercoa WHERE Level = 'CODE') AS fin_mastercoa
LEFT JOIN
(SELECT fin_accountbalance.AccountParrent AS nourut,fin_accountbalance.AccountParrent,fin_accountbalance.AccountNo,fin_accountbalance.Debit AS opendebit, fin_accountbalance.Credit AS opencredit,  sum(master.Debit) AS mutasidebit, sum(master.Credit) AS mutasicredit FROM fin_accountbalance
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Credit, fin_voucher_detail.jumlahdebit AS Debit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(debit) AS jumlahcredit, sum(credit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
UNION ALL
SELECT AccountNo AS AccountNo,  Credit AS Debit, Debit AS Credit 
FROM fin_voucher_detail
UNION ALL
SELECT AccountNo AS AccountNo,  Debit, Credit 
FROM fin_vouchermemo) AS master ON fin_accountbalance.AccountNo = master.AccountNo WHERE fin_accountbalance.Debit != 0 OR fin_accountbalance.Credit != 0 OR master.Debit IS NOT NULL OR master.Credit IS NOT NULL GROUP BY fin_accountbalance.AccountNo
) AS code ON fin_mastercoa.AccountNo = code.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR code.mutasidebit IS NOT NULL OR code.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
)as sgroup ON fin_mastercoa.AccountNo = sgroup.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR sgroup.mutasidebit IS NOT NULL OR sgroup.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo

UNION ALL

SELECT RPAD(concat(SUBSTR(fin_mastercoa.AccountNo,1,2),'99'),5,'0') AS nourut, fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo, concat('TOTAL ', fin_mastercoa.AccountName) AS AccountName,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'GROUP' AS level FROM fin_mastercoa LEFT JOIN 
(SELECT concat(fin_mastercoa.AccountNo,'x') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'SGROUP' AS level FROM fin_mastercoa LEFT JOIN
(SELECT concat(fin_mastercoa.AccountNo,'_1') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'CODE' AS level FROM
(SELECT * FROM fin_mastercoa WHERE Level = 'CODE') AS fin_mastercoa
LEFT JOIN
(SELECT fin_accountbalance.AccountParrent AS nourut,fin_accountbalance.AccountParrent,fin_accountbalance.AccountNo,fin_accountbalance.Debit AS opendebit, fin_accountbalance.Credit AS opencredit,  sum(master.Debit) AS mutasidebit, sum(master.Credit) AS mutasicredit FROM fin_accountbalance
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Credit, fin_voucher_detail.jumlahdebit AS Debit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(debit) AS jumlahcredit, sum(credit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
UNION ALL
SELECT AccountNo AS AccountNo,  Credit AS Debit, Debit AS Credit 
FROM fin_voucher_detail
UNION ALL
SELECT AccountNo AS AccountNo,  Debit, Credit 
FROM fin_vouchermemo) AS master ON fin_accountbalance.AccountNo = master.AccountNo WHERE fin_accountbalance.Debit != 0 OR fin_accountbalance.Credit != 0 OR master.Debit IS NOT NULL OR master.Credit IS NOT NULL GROUP BY fin_accountbalance.AccountNo
) AS code ON fin_mastercoa.AccountNo = code.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR code.mutasidebit IS NOT NULL OR code.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
)as sgroup ON fin_mastercoa.AccountNo = sgroup.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR sgroup.mutasidebit IS NOT NULL OR sgroup.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
) AS groups ON fin_mastercoa.AccountNo = groups.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR groups.mutasidebit IS NOT NULL OR groups.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo

UNION ALL

SELECT RPAD(concat(SUBSTR(fin_mastercoa.AccountNo,1,1),'999'),5,'0') AS nourut, fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo, concat('TOTAL ', fin_mastercoa.AccountName) AS AccountName,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'TYPE' AS level FROM fin_mastercoa LEFT JOIN 
(SELECT concat(fin_mastercoa.AccountNo,'x') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'GROUP' AS level FROM fin_mastercoa LEFT JOIN 
(SELECT concat(fin_mastercoa.AccountNo,'x') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'SGROUP' AS level FROM fin_mastercoa LEFT JOIN
(SELECT concat(fin_mastercoa.AccountNo,'_1') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'CODE' AS level FROM
(SELECT * FROM fin_mastercoa WHERE Level = 'CODE') AS fin_mastercoa
LEFT JOIN
(SELECT fin_accountbalance.AccountParrent AS nourut,fin_accountbalance.AccountParrent,fin_accountbalance.AccountNo,fin_accountbalance.Debit AS opendebit, fin_accountbalance.Credit AS opencredit,  sum(master.Debit) AS mutasidebit, sum(master.Credit) AS mutasicredit FROM fin_accountbalance
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Credit, fin_voucher_detail.jumlahdebit AS Debit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(debit) AS jumlahcredit, sum(credit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
UNION ALL
SELECT AccountNo AS AccountNo,  Credit AS Debit, Debit AS Credit 
FROM fin_voucher_detail
UNION ALL
SELECT AccountNo AS AccountNo,  Debit, Credit 
FROM fin_vouchermemo) AS master ON fin_accountbalance.AccountNo = master.AccountNo WHERE fin_accountbalance.Debit != 0 OR fin_accountbalance.Credit != 0 OR master.Debit IS NOT NULL OR master.Credit IS NOT NULL GROUP BY fin_accountbalance.AccountNo
) AS code ON fin_mastercoa.AccountNo = code.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR code.mutasidebit IS NOT NULL OR code.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
) AS sgroup ON fin_mastercoa.AccountNo = sgroup.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR sgroup.mutasidebit IS NOT NULL OR sgroup.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
) AS groups ON fin_mastercoa.AccountNo = groups.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR groups.mutasidebit IS NOT NULL OR groups.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
) AS type ON fin_mastercoa.AccountNo = type.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR type.mutasidebit IS NOT NULL OR type.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo  
ORDER BY `AccountNo` ASC) as akun on fin_mastercoa.AccountNo = akun.AccountNo WHERE (fin_mastercoa.Level = 'TYPE' or fin_mastercoa.Level = 'Group' or fin_mastercoa.Level = 'SGROUP') 
$where order by fin_mastercoa.AccountNo asc")->result_array();
    }
}
