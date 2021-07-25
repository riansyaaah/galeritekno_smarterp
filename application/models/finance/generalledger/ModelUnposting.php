<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelUnposting extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getPeriode()
	{
        return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
    }
    public function getDataUnposting($where = '')
    {
        return $this->db->query("SELECT fin_voucher.*,fin_cashbank.BankName,format(fin_voucher_detail.Amount,2) as Amount FROM fin_voucher left join fin_cashbank on fin_voucher.BankCode = fin_cashbank.BankCode left join (select VoucherNo, sum(Credit) as Amount from fin_voucher_detail group by VoucherNo) as fin_voucher_detail on fin_voucher.VoucherNo = fin_voucher_detail.VoucherNo $where ")->result_array();
    }
    
    public function QueriData($queri){
		return $this->db->query($queri);
	}

}