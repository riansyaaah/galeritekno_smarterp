<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leaves extends CI_Controller
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
		$this->load->model('hrm/form/ModelLeave', 'leave');
		$this->load->model('hrm/staffmanagement/ModelStaffProfile', 'staff');
		$this->load->model('hrm/payroll/ModelPeriod', 'period');
	}

	var $idMenu = "04f20332-cda8-4780-bfaf-49893af7ff90";


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
			'title'         => 'Leaves',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/form/v_leave', $data);
	}


	public function getLeaves()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$leaves = $this->leave->get_all();
		$no = 1;
		foreach ($leaves as $leave) {
			$staff = $this->staff->selectStaffProfile($leave['staff_id']);
			$kode = '"' . $leave['id'] . '"';
			$tanggal1 = new DateTime($leave['start_date']);
			$tanggal2 = new DateTime($leave['end_date']);

			$days = $tanggal2->diff($tanggal1)->format("%a");
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
			if ($leave['status'] == 1) {
				$action = "
				<div style='text-align:center'>	
					<a href='#' class='edit_record btn btn-warning btn-sm' onclick='return abort(" . $kode . ")'>
						<i class='fa fa-times'></i> Abort
					</a>
				<div>";
				$option = "";
			}

			$data[] = array(
				'no'	=> $no,
				'staff_name'	=> $staff['first_name'],
				'staff_id'		=> $staff['id_personel'],
				'department'	=> $staff['department'],
				'position'		=> $staff['position'],
				'id'	=> $leave['id'],
				'days' 	=> $days,
				'date'	=> $leave['start_date'] . " - " . $leave['end_date'],
				'description' 	=> $leave['description'],
				'action'		=> $action,
				'option'		=> $option
			);
			$no++;
		}
		if (count($leaves) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function getLeaveById()
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
			$check = $this->leave->get_by_id($code);
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

	public function getLeaveByPeriodId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$period_id  = $this->input->post('period_id');
		$leaves = $this->leave->getPeriodLeave($period_id);
		$no = 1;
		foreach ($leaves as $leave) {

			$staff = $this->staff->selectStaffProfile($leave['staff_id']);
			$kode = '"' . $leave['id'] . '"';
			$tanggal1 = new DateTime($leave['start_date']);
			$tanggal2 = new DateTime($leave['end_date']);

			$days = $tanggal2->diff($tanggal1)->format("%a");
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
			if ($leave['status'] == 1) {
				$action = "
				<div style='text-align:center'>	
					<a href='#' class='edit_record btn btn-warning btn-sm' onclick='return abort(" . $kode . ")'>
						<i class='fa fa-times'></i> Abort
					</a>
				<div>";
			}
			$data[] = array(
				'no'	=> $no,
				'staff_name'	=> $staff['first_name'],
				'staff_id'		=> $staff['id_personel'],
				'department'	=> $staff['department'],
				'position'		=> $staff['position'],
				'id'	=> $leave['id'],
				'days' 	=> $days,
				'date'	=> $leave['start_date'] . " - " . $leave['end_date'],
				'description' 	=> $leave['description'],
				'action'		=> $action,
				'option'		=> $option
			);
			$no++;
		}
		$response['data'] = (count($leaves) > 0) ? $data : [];
		echo json_encode($response);
	}


	public function saveLeave()
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
			$description = $this->input->post('description');
			$start_date = $this->input->post('start_date');
			$end_date = $this->input->post('end_date');
			$status = $this->input->post('status');
			$post = true;

			if ($post) {
				if ($status == 'tambah') {
					$check = $this->leave->getLeave(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'id'			=> $code,
							'staff_id'		=> $staff_id,
							'period_id'		=> $period_id,
							'start_date'	=> $start_date,
							'end_date'		=> $end_date,
							'description'	=> $description,
							'status'		=> 0,
							'is_half_day'	=> 0,
							'period_id'		=> $period_id,
							'created_at'	=> date("Y-m-d H:i:s"),
						);
						$this->leave->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert Leave of : ' . $staff_id);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->leave->getLeave(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'staff_id'		=> $staff_id,
							'period_id'		=> $period_id,
							'start_date'	=> $start_date,
							'end_date'		=> $end_date,
							'description'	=> $description,
							'status'		=> 0,
							'is_half_day'	=> 0,
							'period_id'		=> $period_id,
							'updated_at'        => date("Y-m-d H:i:s"),
						);
						$this->leave->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update Leave of : ' . $description);
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

	public function deleteLeave()
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
				$this->leave->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete Leave : ' . $code);
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

	public function approveLeave()
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
					'approved_by' => 'admin',
					'status' => 1,
				);
				$this->leave->update($code, $dataApprove);
				$this->ModelGeneral->LogActivity('Process Approve Leave : ' . $code);
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

	public function abortLeave()
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
					'aborted_by' => 'admin',
					'status' => 0,
				);
				$this->leave->update($code, $dataAbort);
				$this->ModelGeneral->LogActivity('Process Abort Leave : ' . $code);
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
