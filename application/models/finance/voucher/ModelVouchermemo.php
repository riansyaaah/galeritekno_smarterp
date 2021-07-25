<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelVouchermemo extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getPeriode()
	{
		return $this->db->query("SELECT * FROM periode WHERE Active='1' ")->result_array();
	}

	public function getVoucherMemo($where = '')
	{
		return $this->db->query("SELECT VoucherMemoNo,VoucherMemoDate, sum(Debit) as Debit, sum(Credit) as Credit FROM fin_vouchermemo group by VoucherMemoNo,VoucherMemoDate $where")->result_array();
	}

	public function getVoucherMemoNoDetail($where = '')
	{
		return $this->db->query("SELECT fin_vouchermemo.*,fin_accountbalance.AccountName FROM fin_vouchermemo left join fin_accountbalance on fin_vouchermemo.AccountNo  = fin_accountbalance.AccountNo $where")->result_array();
	}

	public function getVoucherMemoNo($VoucherMemoNo)
	{
		return $this->db->query("SELECT max(SUBSTR(VoucherMemoNo, 1, 3)) as VoucherMemoNo FROM fin_vouchermemo where VoucherMemoNo like '%$VoucherMemoNo'")->result_array();
	}

	public function getAccountNo($where = '')
	{
		return $this->db->query("SELECT * FROM fin_mastercoa  $where ")->result_array();
	}
	public function getCountVMNoDetail($voucherMemoNo)
	{
		return $this->db->select('COUNT(fin_vouchermemo.id) as jumlah')
			->join('fin_accountbalance', 'fin_vouchermemo.AccountNo = fin_accountbalance.AccountNo')
			->where('VoucherMemoNo', $voucherMemoNo)
			->get('fin_vouchermemo')
			->row_array();
	}

	// function getVoucherMemoNoById($VoucherMemoNo)
	// {

	// 	$this->db->select('*');
	// 	$this->db->from('fin_vouchermemo ');
	// 	$this->db->where('v.VoucherDate BETWEEN "' . date('Y-m-d', strtotime($from_date)) . '" and "' . date('Y-m-d', strtotime($to_date)) . '"');
	// 	$this->db->like('v.VoucherNo', $type_journal, 'both');
	// 	$this->db->order_by('v.VoucherDate', 'ASC');
	// 	$this->db->group_by('v.VoucherNo');
	// 	return $this->db->get()->result_array();
	// }

}
