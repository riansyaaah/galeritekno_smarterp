<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Overtimes extends CI_Controller
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
		$this->load->model('hrm/form/ModelOvertime', 'overtime');
		$this->load->model('hrm/payroll/ModelPeriod', 'period');
		$this->load->model('hrm/staffmanagement/ModelStaffProfile', 'staff');
	}

	var $idMenu = "d5dd45a5-1ae2-4137-b2a8-592f60df7cff";


	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$periods = $this->period->select_period();

		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'periods'		=> $periods,
			'title'         => 'Overtimes',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/form/v_overtime', $data);
	}


	public function getOvertimes()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$overtimes = $this->overtime->get_all();
		$no = 1;
		foreach ($overtimes as $overtime) {
			$kode = '"' . $overtime['id'] . '"';
			$staff = $this->staff->selectStaffProfile($overtime['staff_id']);

			$option = "
				<div style='text-align:center'>	
				<a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $kode . ")'><i class='fa fa-edit'></i> Edit</a>
				<a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $kode . ")'><i class='fa fa-trash'></i> Delete</a><div>";
			$action = "
				<div style='text-align:center'>	
					<a href='#' class='edit_record btn btn-success btn-sm' onclick='return approve(" . $kode . ")'>
						<i class='fa fa-check'></i> Approve
					</a>
				<div>";
			if ($overtime['status'] == 1) {
				$action = "
				<div style='text-align:center'>	
					<a href='#' class='edit_record btn btn-warning btn-sm' onclick='return abort(" . $kode . ")'>
						<i class='fa fa-times'></i> Abort
					</a>
				<div>";
				$option = "";
			}
			$time = $overtime['start_time'] . ' - ' . $overtime['end_time'];
			$data[] = array(
				'no'	=> $no,
				'staff_name'	=> $staff['first_name'],
				'staff_id'		=> $staff['id_personel'],
				'department'	=> $staff['department'],
				'position'		=> $staff['position'],
				'id'	=> $overtime['id'],
				'start_time'	=> $overtime['start_time'],
				'date' 	=> $overtime['date'],
				'hours' 	=> $overtime['hours'],
				'time' => $time,
				'action'		=> $action,
				'option'		=> $option
			);
			$no++;
		}
		if (count($overtimes) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function getOvertimeById()
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
			$check = $this->overtime->get_by_id($code);
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

	public function getOvertimeByPeriodId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$period_id  = $this->input->post('period_id');
		$overtimes = $this->overtime->getPeriodOvertime($period_id);
		$no = 1;
		foreach ($overtimes as $overtime) {

			$kode = '"' . $overtime['id'] . '"';

			$option = "
				<div style='text-align:center'>	
				<a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $kode . ")'><i class='fa fa-edit'></i> Edit</a>
				<a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $kode . ")'><i class='fa fa-trash'></i> Delete</a><div>";
			$action = "
				<div style='text-align:center'>	
					<a href='#' class='edit_record btn btn-success btn-sm' onclick='return approve(" . $kode . ")'>
						<i class='fa fa-check'></i> Approve
					</a>
				<div>";
			if ($overtime['status'] == 1) {
				$action = "
				<div style='text-align:center'>	
					<a href='#' class='edit_record btn btn-warning btn-sm' onclick='return abort(" . $kode . ")'>
						<i class='fa fa-times'></i> Abort
					</a>
				<div>";
				$option = "";
			}

			$staff = "Adist";
			$position = "IT Administrator";
			$personel_id = "50416182";
			$time = $overtime['start_time'] . ' - ' . $overtime['end_time'];
			$data[] = array(
				'no'			=> $no,
				'time'			=> $time,
				'staff'			=> $staff,
				'personel_id'	=> $personel_id,
				'position'		=> $position,
				'id'			=> $overtime['id'],
				'date' 			=> $overtime['date'],
				'action'		=> $action,
				'option'		=> $option
			);
			$no++;
		}
		$response['data'] = (count($overtimes) > 0) ? $data : [];
		echo json_encode($response);
	}


	public function saveOvertime()
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
			$period_id = $this->input->post('period_id');
			$staff_id = $this->input->post('staff_id');
			$date = $this->input->post('date');
			$start_time = $this->input->post('start_time');
			$end_time = $this->input->post('end_time');
			$status = $this->input->post('status');
			$post = true;


			$start = new DateTime($start_time);
			$end = new DateTime($end_time);
			$hours = $end->diff($start)->format("%h");

			if ($post) {
				if ($status == 'tambah') {
					$check = $this->overtime->getOvertime(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'id'			=> $code,
							'period_id'		=> $period_id,
							'staff_id'		=> $staff_id,
							'date'			=> $date,
							'hours'			=> $hours,
							'start_time'	=> $start_time,
							'end_time'		=> $end_time,
							'status'		=> 0,
							'created_by'		=> '88776655',
							'created_at'	=> date("Y-m-d H:i:s"),
						);
						$this->overtime->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert Overtime of : ' . $staff_id);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->overtime->getOvertime(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'id'			=> $code,
							'period_id'		=> $period_id,
							'staff_id'		=> $staff_id,
							'date'			=> $date,
							'hours'			=> $hours,
							'start_time'	=> $start_time,
							'end_time'		=> $end_time,
							'status'		=> 0,
							'updated_at'	=> date("Y-m-d H:i:s"),
						);
						$this->overtime->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update Overtime of : ' . $staff_id);
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

	public function deleteOvertime()
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
				$this->overtime->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete Overtime : ' . $code);
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

	public function approveOvertime()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Successfully Approved data";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$code = $this->input->post('code_approve');

			$post = true;

			if ($post) {
				$dataApprove = array(
					'approved_at' => date("Y-m-d H:i:s"),
					'approved_by' => '11112222',
					'aborted_at' => NULL,
					'aborted_by' => NULL,
					'status' => 1,
				);
				$this->overtime->update($code, $dataApprove);
				$this->ModelGeneral->LogActivity('Process Approve Overtime : ' . $code);
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

	public function abortOvertime()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Successfully Aborted data";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$code = $this->input->post('code_abort');

			$post = true;

			if ($post) {
				$dataAbort = array(
					'aborted_at' => date("Y-m-d H:i:s"),
					'aborted_by' => '11112222',
					'approved_at' => NULL,
					'approved_by' => NULL,
					'status' => 0,
				);
				$this->overtime->update($code, $dataAbort);
				$this->ModelGeneral->LogActivity('Process Abort Overtime : ' . $code);
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
