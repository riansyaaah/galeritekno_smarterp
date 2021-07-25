<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periods extends CI_Controller
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
		$this->load->model('hrm/payroll/ModelPeriod', 'period');
		$this->load->model('hrm/payroll/ModelSalary', 'salary');
		$this->load->model('hrm/staffmanagement/ModelStaffProfile', 'staff');
		$this->load->model('hrm/timesheets/ModelAttendance', 'attendance');
	}

	var $idMenu = "a31d7dd1-a647-4c80-a798-1695c7ba4939";


	public function index()
	{
		// $basic_salary = $this->salary->getBasicSalary(1)['basic_paid'];
		// $total_overtime_hour 	= $this->salary->getOvertimeHours(1)['total_overtime'];
		// $overtime_paid_hour 	= ($basic_salary * 0.75) * 1 / 173;
		// $overtime_amount = $total_overtime_hour * $overtime_paid_hour;
		// var_dump($total_overtime_hour . " * " . $overtime_paid_hour . ' = ' . $overtime_amount);
		// die;

		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$status = $this->period->get_status();
		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Management Periods',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
			'status' 		=> $status
		);
		$this->load->view('hrm/payroll/v_period', $data);
	}

	public function getPeriod()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$periods = $this->period->get_all();
		$is_status = $this->period->get_status();
		$no = 1;
		$months = [
			"", "January", "February", "March", "April", "Mei", 'June', "July", "August", "September", "October", "November", "December"
		];
		foreach ($periods as $period) {
			$kode = '"' . $period['id'] . '"';

			$action = "";

			$option = "
             <a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $kode . ")'><i class='fa fa-edit'></i> Edit</a>
             <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $kode . ")'><i class='fa fa-trash'></i> Delete</a>";

			$status = "";
			if ($period['is_opening'] == 3) {
				$option = "";
				$status = "<span href='#' class='text-danger'><b>Closed</b></span>";
			} else if ($period['is_opening'] == 2) {
				$status = "<span href='#' class='text-warning'><b>PENDING</b></span>";
				$action = "<a href='#' class='edit_record btn btn-warning btn-sm' onclick='return fixed(" . $period['id'] . ")'><i class='fa fa-file'></i> FIXED DATA</a>";
				$option = "";
			} else if ($period['is_opening'] == 1) {
				$status = "<span href='#' class='text-success'><b>ACTIVE</b></span>";
				$action = "<a href='#' class='edit_record btn btn-success  btn-sm' onclick='return closing(" . $period['id'] . ")'><i class='fa fa-check'></i> Close Period</a>";
				$option = "";
			} else {
				$status = "<span href='#' class='text-danger'><b>Closed</b></span>";
				$action = "";
				if ($period['is_opening']  == 0) {
					if (!$is_status) {
						$action = "<a href='#' class='edit_record btn btn-info btn-sm' onclick='return opening(" . $period['id'] . ")'><i class='fa fa-check'></i> Open Period</a>";
					}
				}
			}


			$data[] = array(
				"no"		=> $no,
				"id"		=> $period['id'],
				"period"	=> $months[$period['month']] . ' - ' . $period['year'],
				"month"     => $months[$period['month']],
				"duration"	=> date('d M', strtotime($period['start_date'])) . ' - ' . date('d M', strtotime($period['end_date'])),
				"working_days"	=> $period['working_days'],
				"year"      => $period['year'],
				"status"  	=> $status,
				"action" 	=> $action,
				"option"    => $option,
			);
			$no++;
		}
		if (count($periods) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	public function selectPeriod()
	{
		// cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$periods = $this->period->select_period();
		$is_status = $this->period->get_status();
		$no = 1;
		$months = [
			"", "January", "February", "March", "April", "Mei", 'June', "July", "August", "September", "October", "November", "December"
		];
		foreach ($periods as $period) {
			$kode = '"' . $period['id'] . '"';
			$option = "
             <a href='#' class='edit_record btn btn-info btn-sm'><i class='fa fa-check'></i></a>";

			$data[] = array(
				"no"		=> $no,
				"id"		=> $period['id'],
				"period"	=> $months[$period['month']] . ' - ' . $period['year'],
				"month"     => $months[$period['month']],
				"year"      => $period['year'],
				"option"    => $option,
			);
			$no++;
		}
		if (count($periods) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	public function salaryPeriod()
	{
		// cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$periods = $this->period->get_all();
		$is_status = $this->period->get_status();
		$no = 1;
		$months = [
			"", "January", "February", "March", "April", "Mei", 'June', "July", "August", "September", "October", "November", "December"
		];
		foreach ($periods as $period) {
			$kode = '"' . $period['id'] . '"';
			$option = "
             <a href='#' class='edit_record btn btn-info btn-sm'><i class='fa fa-check'></i></a>";

			$data[] = array(
				"no"		=> $no,
				"id"		=> $period['id'],
				"period"	=> $months[$period['month']] . ' - ' . $period['year'],
				"month"     => $months[$period['month']],
				"year"      => $period['year'],
				"option"    => $option,
			);
			$no++;
		}
		if (count($periods) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function getPeriodById()
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
			$check = $this->period->getPeriodById($code);
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

	public function savePeriod()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;

		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$code = $this->input->post('code');
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$period = $year . $month;
			$status = $this->input->post('status');
			$post = true;

			// get days
			$date1 = new DateTime($start_date);
			$date2 = new DateTime($end_date);

			$days = $date2->diff($date1)->format("%a");

			if ($post) {
				if ($status == 'tambah') {
					$check = $this->period->getPeriod(" where id = '$period' order by id limit 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "The Period Already Exist!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'id'	=> $year . $month,
							'month'	=> $month,
							'year'	=> $year,
							'start_date'	=> $start_date,
							'end_date'		=> $end_date,
							'working_days'	=> $days,
							'is_opening' 	=> 0,
							'created_at'    => date("Y-m-d H:i:s"),
						);
						$this->period->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert New period : ' . $year . $month);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->period->getperiodById($code);
					if (count($check) > 0) {
						$dataUpdate = array(
							'id'	=> $year . $month,
							'month'	=> $month,
							'year'	=> $year,
							'start_date'	=> $start_date,
							'end_date'		=> $end_date,
							'working_days'	=> $days,
							'is_opening' 	=> 0,
							'created_at'    => date("Y-m-d H:i:s"),
						);
						$this->period->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update New period : ' . $year . $month);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully changed data";
					} else {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					}
				}
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Unable to save new data";
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	public function deletePeriod()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Successfully deleted data";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$code = $this->input->post('code_hapus');

			$post = true;

			if ($post) {
				$dataDelete = array(
					'deleted_at' => date("Y-m-d H:i:s"),
				);
				// $this->period->delete($code, $dataDelete); //SoftDelete
				$this->period->remove($code);
				$this->ModelGeneral->LogActivity('Process Delete Period : ' . $code);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "number or name is already exists";
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	public function openPeriod()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Successfully updated data";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$code = $this->input->post('code_open');

			$post = true;

			if ($post) {
				$dataUpdate = array(
					'is_opening' => 1,
					'closing_date' => date("Y-m-d H:i:s"),
					'updated_at' => date("Y-m-d H:i:s"),
				);

				$this->period->update($code, $dataUpdate);
				$this->ModelGeneral->LogActivity('Process Open Period : ' . $code);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "number or name is already exists";
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	public function closePeriod()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Successfully updated data";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$code = $this->input->post('code_close');

			$post = true;

			if ($post) {
				$dataUpdate = array(
					'is_opening' => 2,
					'updated_at' => date("Y-m-d H:i:s"),
					'closing_date' => date("Y-m-d H:i:s"),
				);

				// generate tabel staff_salary
				$staffs = $this->staff->getStaffProfile();

				for ($i = 0; $i < count($staffs); $i++) {
					$staff_id = $staffs[$i]['id'];

					// Get Basic Salary
					$basic_salary = $this->salary->getBasicSalary($staff_id)['basic_paid'];

					// Get Allowance
					$allowance = $this->salary->getAllowanceAmount($staff_id)['total_allowance'];

					// Get Job Incentive / Tunjangan Jabatan
					$job_incentive = $this->salary->getJobIncentiveAmount($staff_id)['incentive'];

					// Get Uang Makan
					$transport_amount = $this->salary->getTransportAmount($staff_id)['total_transport'];

					// Get Overtime Paid
					// rumus = 75% Gaji Pokok x 1 / 173
					$total_overtime_hour 	= $this->salary->getOvertimeHours($staff_id)['total_overtime'];
					$overtime_paid_hour 	= ($basic_salary * 0.75) * 1 / 173;
					$overtime_amount = $total_overtime_hour * $overtime_paid_hour;


					// Get Other Paid
					// Official 
					$official_amount = $this->salary->getOfficialtAmount($staff_id)['total_official'];


					// Insentive 
					$incentive_amount = $this->salary->getIncentiveAmount($staff_id)['total_incentive'];

					// BPJS
					$bpjs_data 	= $this->salary->getBpjsData();
					$bpjs_tk 	= $bpjs_data['bpjs_tk'] * $bpjs_data['bpjs_tk_percent'] / 100;
					$bpjs_kes	= $bpjs_data['bpjs_tk'] * $bpjs_data['bpjs_kes_percent'] / 100;
					$bpjs_perusahaan	= $bpjs_data['bpjs_perusahaan'] - $bpjs_tk;

					// cuts
					$cut_amount = $this->salary->getCutAmount($staff_id)['total_cut'];

					// Additional
					$additional_amount = $this->salary->getAdditionalAmount($staff_id)['total_additional'];

					$dataSalary = array(
						'staff_id' => $staffs[$i]['id'],
						'basic_salary' => $basic_salary,
						'allowance' => $allowance,
						'job_incentive' => $job_incentive,
						'period_id' => $code,
						'overtime' => $overtime_amount,
						'incentive' => $incentive_amount,
						'official' => $official_amount,
						'transport'	=> $transport_amount,
						'bpjs_perusahaan' => $bpjs_perusahaan,
						'bpjs_tk' => $bpjs_tk,
						'bpjs_kes' => $bpjs_kes,
						'other_paid' => $additional_amount,
						'cuts' => $cut_amount,

						'created_at' => date("Y-m-d H:i:s"),
					);
					$this->salary->insert($dataSalary);
				}

				$this->period->update($code, $dataUpdate);
				$this->ModelGeneral->LogActivity('Process Close Period : ' . $code);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "number or name is already exists";
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
}
