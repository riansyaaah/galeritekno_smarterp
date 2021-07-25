<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelSalary extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getSalary()
	{
		$this->db->select(
			'
            staff.id,
            staff.first_name,
            staff.id_personel,
            position.position,
            position.incentive,
            salary.basic_salary,
            SUM(allowance.amount) AS allowances
			'
		);
		$this->db->join('hrm_staff_salary salary', 'salary.staff_id=staff.id', 'left');
		$this->db->join('hrm_staff_allowances allowance', 'allowance.staff_id=staff.id', 'left');
		$this->db->join('hrm_positions position', 'position.id=staff.position_id', 'left');
		$this->db->join('hrm_payroll_periods periods', 'periods.id=salary.period_id', 'left');
		$this->db->from('hrm_staffprofile staff');
		// $this->db->where('periods.is_opening', 1);
		$this->db->where('periods.id', '20215');
		$this->db->group_by('staff.id');
		return $this->db->get()->result_array();
	}

	function get_all()
	{
		$this->db->order_by('period_id', 'ASC');
		$this->db->where('deleted_at', NULL);
		return $this->db->get('hrm_staff_salary')->result_array();
	}

	// function get_all($where)
	// {
	// 	return $this->db->query("SELECT * FROM hrm_staff_salary $where ")->result_array();
	// }

	// insert data
	function insert($data)
	{
		$this->db->insert('hrm_staff_salary', $data);
	}

	function get_by_period_id($period_id)
	{
		$this->db->order_by('period_id', 'ASC');
		$this->db->where('deleted_at', NULL);
		$this->db->where('period_id', $period_id);
		return $this->db->get('hrm_staff_salary')->result_array();
	}

	// Get Basic Salary 
	// Basic Salary = Total Attendance
	// public function getBasicSalary($staff_id)
	// {
	// 	$this->db->select('SUM(attendance.daily_paid) AS basic_paid');
	// 	$this->db->join('hrm_payroll_periods periods', 'periods.id=attendance.period_id', 'left');
	// 	$this->db->from('hrm_attendance attendance');
	// 	$this->db->where('periods.is_opening', 1);
	// 	$this->db->where('attendance.staff_id', $staff_id);
	// 	$this->db->group_by('attendance.staff_id');
	// 	return $this->db->get()->row_array();
	// }

	// Basic Paid Mutlak
	public function getBasicSalary($staff_id)
	{
		$this->db->select('staff.basic_salary AS basic_paid');
		$this->db->from('hrm_staffprofile staff');
		$this->db->where('staff.id', $staff_id);
		return $this->db->get()->row_array();
	}


	// Get Allowance 
	// Allowance = Allowance Tetap
	public function getAllowanceAmount($staff_id)
	{
		$this->db->select('SUM(allowance.amount) AS total_allowance');
		$this->db->from('hrm_staff_allowances allowance');
		$this->db->where('allowance.staff_id', $staff_id);
		return $this->db->get()->row_array();
	}


	// Get Job Insentive 
	public function getJobIncentiveAmount($staff_id)
	{
		$this->db->select('incentive');
		$this->db->join('hrm_positions position', 'position.id=staff.position_id', 'left');
		$this->db->from('hrm_staffprofile staff');
		$this->db->where('staff.id', $staff_id);
		return $this->db->get()->row_array();
	}


	// Get Uang Makan
	public function getTransportAmount($staff_id)
	{
		$this->db->select('SUM(attendance.transport_paid) AS total_transport');
		$this->db->join('hrm_payroll_periods periods', 'periods.id=attendance.period_id', 'left');
		$this->db->from('hrm_attendance attendance');
		$this->db->where('attendance.staff_id', $staff_id);
		$this->db->where('periods.is_opening', 1);
		return $this->db->get()->row_array();
	}

	// get uang dinas
	public function getOfficialtAmount($staff_id)
	{
		$this->db->select('SUM(official.amount) AS total_official');
		$this->db->join('hrm_payroll_periods periods', 'periods.id=official.period_id', 'left');
		$this->db->from('hrm_payroll_others official');
		$this->db->where('official.staff_id', $staff_id);
		$this->db->where('official.type', "O");
		$this->db->where('periods.is_opening', 1);
		return $this->db->get()->row_array();
	}

	// get uang insentif
	public function getIncentiveAmount($staff_id)
	{
		$this->db->select('SUM(incentive.amount) AS total_incentive');
		$this->db->join('hrm_payroll_periods periods', 'periods.id=incentive.period_id', 'left');
		$this->db->from('hrm_payroll_others incentive');
		$this->db->where('incentive.staff_id', $staff_id);
		$this->db->where('incentive.type', "I");
		$this->db->where('periods.is_opening', 1);
		return $this->db->get()->row_array();
	}

	// Get uang lembur


	// get Cut
	public function getCutAmount($staff_id)
	{
		$this->db->select('SUM(cut.amount) AS total_cut');
		$this->db->join('hrm_payroll_periods periods', 'periods.id=cut.period_id', 'left');
		$this->db->from('hrm_payroll_others cut');
		$this->db->where('cut.staff_id', $staff_id);
		$this->db->where('cut.type', "C");
		$this->db->where('periods.is_opening', 1);
		return $this->db->get()->row_array();
	}

	// Other Income
	function getAdditionalAmount($staff_id)
	{
		$this->db->select('SUM(additional.amount) AS total_additional');
		$this->db->join('hrm_payroll_periods periods', 'periods.id=additional.period_id', 'left');
		$this->db->from('hrm_payroll_others additional');
		$this->db->where('additional.staff_id', $staff_id);
		$this->db->where('additional.type', "A");
		$this->db->where('periods.is_opening', 1);
		return $this->db->get()->row_array();
	}

	// Overtime Hours
	function getOvertimeHours($staff_id)
	{
		$this->db->select('SUM(attendance.overtime) AS total_overtime');
		$this->db->join('hrm_payroll_periods periods', 'periods.id=attendance.period_id', 'left');
		$this->db->from('hrm_attendance attendance');
		$this->db->where('attendance.staff_id', $staff_id);
		$this->db->where('periods.is_opening', 1);
		return $this->db->get()->row_array();
	}

	// get BPJS Data
	public function getBpjsData()
	{
		$this->db->select('*');
		$this->db->from('hrm_bpjs bpjs');
		$this->db->where('bpjs.id', 1);
		return $this->db->get()->row_array();
	}
}
