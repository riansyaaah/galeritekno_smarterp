<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelTrialbalance extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }
    public function getPeriode() {
        return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
    }
    public function tahun() {
        return [2019, 2020, 2021];
    }
    public function bulan() {
        return [
            ['01', 'Januari'], ['02', 'Februari'], ['03', 'Maret'], ['04', 'April'], ['05', 'Mei'], ['06', 'Juni'], ['07', 'Juli'], ['08', 'Agustus'], ['09', 'September'], ['10', 'Oktober'], ['11', 'November'], ['12', 'Desember']
        ];
    }
    public function getDataCash($date, $where = '') {
        return $this->db->query("
SELECT fin_mastercoa.AccountNo AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,fin_mastercoa.AccountName,opendebit, opencredit,  mutasidebit, mutasicredit, fin_mastercoa.Level AS level FROM fin_mastercoa LEFT JOIN 
(SELECT AccountNo AS nourut,AccountParrent,AccountNo,AccountName,opendebit, opencredit,  mutasidebit, mutasicredit, 'MASTER' AS level FROM
(SELECT fin_accountbalance.AccountParrent AS nourut,fin_accountbalance.AccountParrent,fin_accountbalance.AccountNo,fin_accountbalance.AccountName,fin_accountbalance.Debit AS opendebit, fin_accountbalance.Credit AS opencredit,  sum(master.Debit) AS mutasidebit, sum(master.Credit) AS mutasicredit FROM fin_accountbalance
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Debit, fin_voucher_detail.jumlahdebit AS Credit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(credit) AS jumlahcredit, sum(debit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
UNION ALL
SELECT AccountNo AS AccountNo,  Credit AS Debit, Debit AS Credit 
FROM fin_voucher_detail
UNION ALL
SELECT AccountNo AS AccountNo,  Debit, Credit 
FROM fin_vouchermemo) AS master ON fin_accountbalance.AccountNo = master.AccountNo WHERE fin_accountbalance.Debit != 0 OR fin_accountbalance.Credit != 0 OR fin_accountbalance.Debit != 0 OR fin_accountbalance.Credit != 0 OR master.Debit IS NOT NULL OR master.Credit IS NOT NULL GROUP BY fin_accountbalance.AccountNo
) AS master
UNION ALL
SELECT concat(fin_mastercoa.AccountNo,'9') AS nourut, fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo AS AccountNo, concat('TOTAL ', fin_mastercoa.AccountName) AS AccountName,'' AS opendebit, '' AS opencredit,  '' AS mutasidebit, '' AS mutasicredit, 'CODE' AS level FROM
(SELECT * FROM fin_mastercoa WHERE Level = 'CODE') AS fin_mastercoa
LEFT JOIN
(SELECT fin_accountbalance.AccountParrent AS nourut,fin_accountbalance.AccountParrent,fin_accountbalance.AccountNo,fin_accountbalance.Debit AS opendebit, fin_accountbalance.Credit AS opencredit,  sum(master.Debit) AS mutasidebit, sum(master.Credit) AS mutasicredit FROM fin_accountbalance
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Debit, fin_voucher_detail.jumlahdebit AS Credit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(credit) AS jumlahcredit, sum(debit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
UNION ALL
SELECT AccountNo AS AccountNo,  Credit AS Debit, Debit AS Credit 
FROM fin_voucher_detail
UNION ALL
SELECT AccountNo AS AccountNo,  Debit, Credit 
FROM fin_vouchermemo) AS master ON fin_accountbalance.AccountNo = master.AccountNo WHERE fin_accountbalance.Debit != 0 OR fin_accountbalance.Credit != 0 OR master.Debit IS NOT NULL OR master.Credit IS NOT NULL GROUP BY fin_accountbalance.AccountNo
) AS code ON fin_mastercoa.AccountNo = code.AccountParrent WHERE code.mutasidebit IS NOT NULL OR code.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
UNION ALL
SELECT RPAD(concat(SUBSTR(fin_mastercoa.AccountNo,1,2),'99'),5,'0') AS AccountNo, fin_mastercoa.AccountParrent, fin_mastercoa.AccountNo, concat('TOTAL ', fin_mastercoa.AccountName) AS AccountName,'' AS opendebit, '' AS opencredit,  '' AS mutasidebit, '' AS mutasicredit, 'SGROUP' AS level FROM fin_mastercoa LEFT JOIN
(SELECT concat(fin_mastercoa.AccountNo,'_1') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'CODE' AS level FROM
(SELECT * FROM fin_mastercoa WHERE Level = 'CODE') AS fin_mastercoa
LEFT JOIN
(SELECT fin_accountbalance.AccountParrent AS nourut,fin_accountbalance.AccountParrent,fin_accountbalance.AccountNo,fin_accountbalance.Debit AS opendebit, fin_accountbalance.Credit AS opencredit,  sum(master.Debit) AS mutasidebit, sum(master.Credit) AS mutasicredit FROM fin_accountbalance
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Debit, fin_voucher_detail.jumlahdebit AS Credit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(credit) AS jumlahcredit, sum(debit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
UNION ALL
SELECT AccountNo AS AccountNo,  Credit AS Debit, Debit AS Credit 
FROM fin_voucher_detail
UNION ALL
SELECT AccountNo AS AccountNo,  Debit, Credit 
FROM fin_vouchermemo) AS master ON fin_accountbalance.AccountNo = master.AccountNo WHERE fin_accountbalance.Debit != 0 OR fin_accountbalance.Credit != 0 OR master.Debit IS NOT NULL OR master.Credit IS NOT NULL GROUP BY fin_accountbalance.AccountNo
) AS code ON fin_mastercoa.AccountNo = code.AccountParrent WHERE code.mutasidebit IS NOT NULL OR code.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
) AS sgroup ON fin_mastercoa.AccountNo = sgroup.AccountParrent WHERE sgroup.mutasidebit IS NOT NULL OR sgroup.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
UNION ALL
SELECT RPAD(concat(SUBSTR(fin_mastercoa.AccountNo,1,2),'99'),5,'0') AS AccountNo, fin_mastercoa.AccountParrent, fin_mastercoa.AccountNo, concat('TOTAL ', fin_mastercoa.AccountName) AS AccountName,'' AS opendebit, '' AS opencredit,  '' AS mutasidebit, '' AS mutasicredit, 'GROUP' AS level FROM fin_mastercoa LEFT JOIN 
(SELECT concat(fin_mastercoa.AccountNo,'x') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'SGROUP' AS level FROM fin_mastercoa LEFT JOIN
(SELECT concat(fin_mastercoa.AccountNo,'_1') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'CODE' AS level FROM
(SELECT * FROM fin_mastercoa WHERE Level = 'CODE') AS fin_mastercoa
LEFT JOIN
(SELECT fin_accountbalance.AccountParrent AS nourut,fin_accountbalance.AccountParrent,fin_accountbalance.AccountNo,fin_accountbalance.Debit AS opendebit, fin_accountbalance.Credit AS opencredit,  sum(master.Debit) AS mutasidebit, sum(master.Credit) AS mutasicredit FROM fin_accountbalance
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Debit, fin_voucher_detail.jumlahdebit AS Credit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(credit) AS jumlahcredit, sum(debit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
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
SELECT RPAD(concat(SUBSTR(fin_mastercoa.AccountNo,1,1),'999'),5,'0') AS AccountNo, fin_mastercoa.AccountParrent, fin_mastercoa.AccountNo, concat('TOTAL ', fin_mastercoa.AccountName) AS AccountName,'' AS opendebit, '' AS opencredit,  '' AS mutasidebit, '' AS mutasicredit, 'TYPE' AS level FROM fin_mastercoa LEFT JOIN 
(SELECT concat(fin_mastercoa.AccountNo,'x') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'GROUP' AS level FROM fin_mastercoa LEFT JOIN 
(SELECT concat(fin_mastercoa.AccountNo,'x') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'SGROUP' AS level FROM fin_mastercoa LEFT JOIN
(SELECT concat(fin_mastercoa.AccountNo,'_1') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'CODE' AS level FROM
(SELECT * FROM fin_mastercoa WHERE Level = 'CODE') AS fin_mastercoa
LEFT JOIN
(SELECT fin_accountbalance.AccountParrent AS nourut,fin_accountbalance.AccountParrent,fin_accountbalance.AccountNo,fin_accountbalance.Debit AS opendebit, fin_accountbalance.Credit AS opencredit,  sum(master.Debit) AS mutasidebit, sum(master.Credit) AS mutasicredit FROM fin_accountbalance
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Debit, fin_voucher_detail.jumlahdebit AS Credit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(credit) AS jumlahcredit, sum(debit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
UNION ALL
SELECT AccountNo AS AccountNo,  Credit AS Debit, Debit AS Credit 
FROM fin_voucher_detail
UNION ALL
SELECT AccountNo AS AccountNo,  Debit, Credit 
FROM fin_vouchermemo) AS master ON fin_accountbalance.AccountNo = master.AccountNo WHERE fin_accountbalance.Debit != 0 OR fin_accountbalance.Credit != 0 OR master.Debit IS NOT NULL OR master.Credit IS NOT NULL GROUP BY fin_accountbalance.AccountNo
) AS code ON fin_mastercoa.AccountNo = code.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR code.mutasidebit IS NOT NULL OR code.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
)as sgroup ON fin_mastercoa.AccountNo = sgroup.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR sgroup.mutasidebit IS NOT NULL OR sgroup.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
) AS groups ON fin_mastercoa.AccountNo = groups.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR groups.mutasidebit IS NOT NULL OR groups.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo
) AS type ON fin_mastercoa.AccountNo = type.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR type.mutasidebit IS NOT NULL OR type.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo  
 )as trial ON fin_mastercoa.AccountNo = trial.AccountNo WHERE nourut IS NOT NULL 
 
 UNION ALL

SELECT RPAD(concat(SUBSTR(fin_mastercoa.AccountNo,1,3),'9'),7,'0')  AS nourut, fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo, concat('TOTAL ', fin_mastercoa.AccountName) AS AccountName,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'CODE' AS level FROM
(SELECT * FROM fin_mastercoa WHERE Level = 'CODE') AS fin_mastercoa
LEFT JOIN
(SELECT fin_accountbalance.AccountParrent AS nourut,fin_accountbalance.AccountParrent,fin_accountbalance.AccountNo,fin_accountbalance.Debit AS opendebit, fin_accountbalance.Credit AS opencredit,  sum(master.Debit) AS mutasidebit, sum(master.Credit) AS mutasicredit FROM fin_accountbalance
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Debit, fin_voucher_detail.jumlahdebit AS Credit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(credit) AS jumlahcredit, sum(debit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
UNION ALL
SELECT AccountNo AS AccountNo,  Credit AS Debit, Debit AS Credit 
FROM fin_voucher_detail
UNION ALL
SELECT AccountNo AS AccountNo,  Debit, Credit 
FROM fin_vouchermemo) AS master ON fin_accountbalance.AccountNo = master.AccountNo WHERE fin_accountbalance.Debit != 0 OR fin_accountbalance.Credit != 0 OR master.Debit IS NOT NULL OR master.Credit IS NOT NULL GROUP BY fin_accountbalance.AccountNo
) AS code ON fin_mastercoa.AccountNo = code.AccountParrent WHERE opendebit != 0 OR opencredit != 0 OR code.mutasidebit IS NOT NULL OR code.mutasicredit IS NOT NULL GROUP BY fin_mastercoa.AccountNo

UNION ALL

SELECT RPAD(concat(SUBSTR(fin_mastercoa.AccountNo,1,2),'9'),5,'0') AS nourut, fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo, concat('TOTAL ', fin_mastercoa.AccountName) AS AccountName,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'SGROUP' AS level FROM fin_mastercoa LEFT JOIN
(SELECT concat(fin_mastercoa.AccountNo,'_1') AS nourut,fin_mastercoa.AccountParrent,fin_mastercoa.AccountNo,sum(opendebit) AS opendebit, sum(opencredit) AS opencredit,  sum(mutasidebit) AS mutasidebit, sum(mutasicredit) AS mutasicredit, 'CODE' AS level FROM
(SELECT * FROM fin_mastercoa WHERE Level = 'CODE') AS fin_mastercoa
LEFT JOIN
(SELECT fin_accountbalance.AccountParrent AS nourut,fin_accountbalance.AccountParrent,fin_accountbalance.AccountNo,fin_accountbalance.Debit AS opendebit, fin_accountbalance.Credit AS opencredit,  sum(master.Debit) AS mutasidebit, sum(master.Credit) AS mutasicredit FROM fin_accountbalance
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Debit, fin_voucher_detail.jumlahdebit AS Credit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(credit) AS jumlahcredit, sum(debit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
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
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Debit, fin_voucher_detail.jumlahdebit AS Credit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(credit) AS jumlahcredit, sum(debit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
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
LEFT JOIN (SELECT AccountNo AS AccountNo, fin_voucher_detail.jumlahcredit AS Debit, fin_voucher_detail.jumlahdebit AS Credit 
FROM (SELECT fin_voucher.*,fin_cashbank.AccountNo,fin_cashbank.BankName FROM `fin_voucher` LEFT JOIN fin_cashbank ON fin_voucher.BankCode = fin_cashbank.BankCode WHERE 1=1) AS fin_voucher LEFT JOIN (SELECT VoucherNo, sum(credit) AS jumlahcredit, sum(debit) AS jumlahdebit FROM `fin_voucher_detail` GROUP BY VoucherNo ORDER BY  VoucherNo asc) AS fin_voucher_detail ON fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo
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
ORDER BY  nourut ASC")->result_array();
    }
    // public function getType() {
    //     return $this->db->select('mastercoa.AccountNo AS nourut, mastercoa.AccountParrent, mastercoa.AccountName, IF(accountbalance.Debit IS NULL, 0, accountbalance.Debit) AS opendebit, IF(accountbalance.Credit IS NULL, 0, accountbalance.Credit) AS opencredit, 0 as mutasidebit, 0 as mutasicredit, mastercoa.Level as level')
    //         ->join('fin_accountbalance AS accountbalance', 'mastercoa.AccountNo = accountbalance.AccountNo', 'left')
    //         ->where('mastercoa.AccountNo', 1000)
    //         ->or_where('mastercoa.AccountNo', 2000)
    //         ->or_where('mastercoa.AccountNo', 3000)
    //         ->or_where('mastercoa.AccountNo', 4000)
    //         ->or_where('mastercoa.AccountNo', 7000)
    //         ->order_by('mastercoa.AccountNo', 'asc')
    //         ->get('fin_mastercoa AS mastercoa')
    //         ->result_array();
    // }
    // public function getGroup($AccountParrent) {
    //     return $this->db->select('mastercoa.AccountNo AS nourut, mastercoa.AccountParrent, mastercoa.AccountName, IF(accountbalance.Debit IS NULL, 0, accountbalance.Debit) AS opendebit, IF(accountbalance.Credit IS NULL, 0, accountbalance.Credit) AS opencredit, 0 as mutasidebit, 0 as mutasicredit, mastercoa.Level as level')
    //         ->join('fin_accountbalance AS accountbalance', 'mastercoa.AccountNo = accountbalance.AccountNo', 'left')
    //         // ->where('mastercoa.Level', 'GROUP')
    //         ->where('mastercoa.AccountParrent', $AccountParrent)
    //         ->order_by('mastercoa.AccountNo', 'asc')
    //         ->get('fin_mastercoa AS mastercoa')
    //         ->result_array();
    // }
}
