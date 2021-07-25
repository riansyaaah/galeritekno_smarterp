<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Salaries extends CI_Controller
{

	function __Construct()
	{
		parent::__Construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$this->load->helper(array('form', 'url'));
		$this->load->model('auth/ModelLogin');
		$this->load->model('ModelGeneral');
		$this->load->model('usermanagement/ModelUsers');
		$this->load->model('hrm/payroll/ModelSalary', 'salary');
		$this->load->model('hrm/payroll/ModelPeriod', 'period');
		$this->load->model('hrm/staffmanagement/ModelStaffProfile', 'staff');
	}

	var $idMenu = "e92d114f-0f6f-4a0a-9ebf-b0d4e6628386";

	public function index()
	{
		// $salaries = $this->salary->get_by_period_id('20215');
		// var_dump($salaries);
		// die;
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$periods = $this->period->select_period();

		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'periods'		=> $periods,
			'title'         => 'Salaries',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/payroll/v_salary', $data);
	}


	public function getSalary()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$salaries = $this->salary->get_all();
		$no = 1;
		foreach ($salaries as $salary) {
			$staff = $this->staff->selectStaffProfile($salary['staff_id']);
			$kode = '"' . $salary['id'] . '"';

			$option = "
				<a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $kode . ")'><i class='fa fa-edit'></i> Edit</a>
				<a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $kode . ")'><i class='fa fa-trash'></i> Delete</a>";

			$total_salary =
				$salary['basic_salary'] +
				$salary['job_incentive'] +
				$salary['transport'] +
				$salary['overtime'] +
				$salary['official'] +
				$salary['incentive'] +
				$salary['allowance'] +
				$salary['other_paid'];

			$total_cuts =
				$salary['cuts'] +
				$salary['bpjs_tk'] +
				$salary['bpjs_kes'];

			$data[] = array(
				"no" 			=> $no,
				'staff_name'	=> $staff['first_name'],
				'staff_id'		=> $staff['id_personel'],
				'department'	=> $staff['department'],
				'position'		=> $staff['position'],
				"basic_salary"  => number_format($salary['basic_salary']),
				"job_incentive"   => number_format($salary['job_incentive']),
				"transport"   => number_format($salary['transport']),
				"overtime"   => number_format($salary['overtime']),
				"official"   => number_format($salary['official']),
				"total_salary"   => number_format($total_salary),
				"incentive"   => number_format($salary['incentive']),
				"bpjs_perusahaan"   => number_format($salary['bpjs_perusahaan']),
				"allowance"   => number_format($salary['allowance']),
				"late"   => 0,
				"cuts"   => number_format($salary['cuts']),
				"bpjs_tk"   => number_format($salary['bpjs_tk']),
				"bpjs_kes"   => number_format($salary['bpjs_kes']),
				"other_paid"   => number_format($salary['other_paid']),
				"thp"   => number_format($total_salary - $total_cuts),
				"option"        => $option,
			);
			$no++;
		}
		if (count($salaries) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function getSalaryById()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$code = $this->input->post('code');
			$status = $this->input->post('status');
			$check = $this->salary->get_by_id($code);
			if ($check != null) {
				$response['data'] = $check;
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Item tidak ditemukan";
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	public function getSalaryByPeriodId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$period_id  = $this->input->post('period_id');
		$salaries = $this->salary->get_by_period_id($period_id);

		$no = 1;
		foreach ($salaries as $salary) {
			$staff = $this->staff->selectStaffProfile($salary['staff_id']);
			$kode = '"' . $salary['id'] . '"';

			$option = "
				<a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $kode . ")'><i class='fa fa-edit'></i> Edit</a>
				<a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $kode . ")'><i class='fa fa-trash'></i> Delete</a>";

			$total_salary =
				$salary['basic_salary'] +
				$salary['job_incentive'] +
				$salary['transport'] +
				$salary['overtime'] +
				$salary['official'] +
				$salary['incentive'] +
				$salary['allowance'] +
				$salary['other_paid'];

			$total_cuts =
				$salary['cuts'] +
				$salary['bpjs_tk'] +
				$salary['bpjs_kes'];

			$data[] = array(
				"no" 			=> $no,
				'staff_name'	=> $staff['first_name'],
				'staff_id'		=> $staff['id_personel'],
				'department'	=> $staff['department'],
				'position'		=> $staff['position'],
				"basic_salary"  => number_format($salary['basic_salary']),
				"job_incentive"   => number_format($salary['job_incentive']),
				"transport"   => number_format($salary['transport']),
				"overtime"   => number_format($salary['overtime']),
				"official"   => number_format($salary['official']),
				"total_salary"   => number_format($total_salary),
				"incentive"   => number_format($salary['incentive']),
				"bpjs_perusahaan"   => number_format($salary['bpjs_perusahaan']),
				"allowance"   => number_format($salary['allowance']),
				"late"   => 0,
				"cuts"   => number_format($salary['cuts']),
				"bpjs_tk"   => number_format($salary['bpjs_tk']),
				"bpjs_kes"   => number_format($salary['bpjs_kes']),
				"other_paid"   => number_format($salary['other_paid']),
				"thp"   => number_format($total_salary - $total_cuts),
				"option"        => $option,
			);
			$no++;
		}
		$response['data'] = (count($salaries) > 0) ? $data : [];
		echo json_encode($response);
	}
}
