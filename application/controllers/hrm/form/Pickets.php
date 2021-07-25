<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pickets extends CI_Controller
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
		$this->load->model('hrm/form/ModelPicket', 'picket');
		$this->load->model('hrm/payroll/ModelPeriod', 'period');
		$this->load->model('hrm/staffmanagement/ModelStaffProfile', 'staff');
	}

	var $idMenu = "3e99d02f-a847-40db-a81d-f9c6107fe310";


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
			'title'         => 'Pickets',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/form/v_picket', $data);
	}


	public function getPickets()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$pickets = $this->picket->get_all();
		$no = 1;
		foreach ($pickets as $picket) {
			$kode = '"' . $picket['id'] . '"';
			$staff = $this->staff->selectStaffProfile($picket['staff_id']);
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
			if ($picket['status'] == 1) {
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
				'id'	=> $picket['id'],
				'date'	=> $picket['date'],
				'description' 	=> $picket['description'],
				'action'		=> $action,
				'option'		=> $option
			);
			$no++;
		}
		if (count($pickets) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function getPicketById()
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
			$check = $this->picket->get_by_id($code);
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

	public function getPicketByPeriodId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$period_id  = $this->input->post('period_id');
		$pickets = $this->picket->getPeriodPicket($period_id);
		$no = 1;
		foreach ($pickets as $picket) {

			$kode = '"' . $picket['id'] . '"';

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
			if ($picket['status'] == 1) {
				$action = "
				<div style='text-align:center'>	
					<a href='#' class='edit_record btn btn-warning btn-sm' onclick='return abort(" . $kode . ")'>
						<i class='fa fa-times'></i> Abort
					</a>
				<div>";
			}

			$staff = "Adist";
			$position = "IT Administrator";
			$personel_id = "50416182";
			$data[] = array(
				'no'	=> $no,
				'staff'	=> $staff,
				'personel_id'	=> $personel_id,
				'position'	=> $position,
				'id'	=> $picket['id'],
				'date'	=> $picket['date'],
				'description' 	=> $picket['description'],
				'action'		=> $action,
				'option'		=> $option
			);
			$no++;
		}
		$response['data'] = (count($pickets) > 0) ? $data : [];
		echo json_encode($response);
	}


	public function savePicket()
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
			$description = $this->input->post('description');
			$date = $this->input->post('date');
			$status = $this->input->post('status');
			$post = true;

			if ($post) {
				if ($status == 'tambah') {
					$check = $this->picket->getPicket(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'id'			=> $code,
							'description'	=> $description,
							'period_id'		=> $period_id,
							'date'			=> $date,
							'created_at'	=> date("Y-m-d H:i:s"),
						);
						$this->picket->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert Picket of : ' . $description);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->picket->getPicket(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'description'    	=> $description,
							'period_id'    		=> $period_id,
							'date'            	=> $date,
							'updated_at'        => date("Y-m-d H:i:s"),
						);
						$this->picket->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update Picket of : ' . $description);
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

	public function deletePicket()
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
				$this->picket->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete Picket : ' . $code);
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

	public function approvePicket()
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
				$this->picket->update($code, $dataApprove);
				$this->ModelGeneral->LogActivity('Process Approve Picket : ' . $code);
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

	public function abortPicket()
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
				$this->picket->update($code, $dataAbort);
				$this->ModelGeneral->LogActivity('Process Abort Picket : ' . $code);
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
