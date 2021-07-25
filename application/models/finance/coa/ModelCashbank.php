<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelCashbank extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function getPeriode()
	{
		return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
	}
	public function getCashBank($where = '')
	{
		return $this->db->query("SELECT * FROM fin_cashbank $where")->result_array();
	}
	public function getCashBankbyId($where = '')
	{
		return $this->db->query("SELECT fin_cashbank.*,fin_mastercoa.AccountName FROM fin_cashbank left join fin_mastercoa on fin_cashbank.AccountNo = fin_mastercoa.AccountNo $where")->result_array();
	}

	public function getAccountNo($where = '')
	{
		return $this->db->query("SELECT * FROM fin_accountbalance  $where ")->result_array();
	}

	public function getCashbankSaldo($where = '')
	{
		return $this->db->query("SELECT fin_cashbank.*,fin_cashbank_saldo.saldo,fin_cashbank_saldo.ActivePeriode FROM fin_cashbank left join (select * from fin_cashbank_saldo $where) as fin_cashbank_saldo on fin_cashbank.BankCode = fin_cashbank_saldo.BankCode ")->result_array();
	}

	public function getValuta($where = "")
	{
		return $this->db->query("SELECT Valuta, Rate FROM tbl_valuta LEFT JOIN periode ON tbl_valuta.ActivePeriode = periode.ThnBln WHERE periode.active = 1 $where ")->result_array();
	}

	public function getRate($where = "")
	{
		return $this->db->query(
			"SELECT 
        Rate, ActivePeriode
      FROM tbl_valuta 
      LEFT JOIN periode 
      ON tbl_valuta.ActivePeriode = periode.ThnBln 
      WHERE periode.active = 1 
      $where "
		)->row()->Rate;
	}
	public function columnSelect()
	{
		return [
			'type' => ['CASH', 'BANK'],
			'currency' => ['IDR', 'SGD', 'USD', 'YEN']
		];
	}

	public function getTotalDebitByBankCode($BankCode)
	{
		// Jika ingin menggunakan perkalian dengan RATE
		// $this->db->select_sum('CONVERT(vd.Debit,signed) * CONVERT(vd.Rate,signed)', 'total_debit');

		$this->db->select_sum('vd.Debit', 'total_debit');
		$this->db->from('fin_voucher_detail vd');
		$this->db->join('fin_voucher v', 'v.VoucherNo=vd.VoucherNo', 'inner');
		$this->db->where('v.BankCode', $BankCode);
		$this->db->where('v.Posting', 1);
		return $this->db->get()->row_array();
	}

	public function getTotalCreditByBankCode($BankCode)
	{
		$this->db->select_sum('vd.Credit', 'total_kredit');
		$this->db->from('fin_voucher_detail vd');
		$this->db->join('fin_voucher v', 'v.VoucherNo=vd.VoucherNo', 'inner');
		$this->db->where('v.BankCode', $BankCode);
		$this->db->where('v.Posting', 1);
		return $this->db->get()->row_array();
	}
}
