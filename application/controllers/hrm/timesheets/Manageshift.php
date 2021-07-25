<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manageshift extends CI_Controller
{
	function __Construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$this->load->helper(array('form', 'url'));
		$this->load->model('auth/ModelLogin');
		$this->load->model('ModelGeneral');
		$this->load->model('hrm/timesheets/ModelManageShift');
		$this->load->model('usermanagement/ModelUsers');
	}

	var $idMenu = "7bb7f899-fd61-4a66-83d9-4cab6f8834cc";


	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Data Shifts',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/timesheets/v_manageshift', $data);
	}

	public function getManageShift()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$datas = $this->ModelManageShift->getManageShift("order by id");
		$no = 1;
		foreach ($datas as $d) {
			$id = '"' . $d['id'] . '"';
			$option = "
			<div class='text-center'> 
             <a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $id . ")'><i class='fa fa-edit'></i> Edit</a>
             <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $id . ")'><i class='fa fa-trash'></i> Delete</a>
			</div>
			 ";
			$data[] = array(
				"no" => $no,
				"shift" => $d['shift'],
				"day" => $d['day'],
				"starttime" => $d['start_time'],
				"endtime" => $d['end_time'],
				"option" => $option,

			);
			$no++;
		}
		if (count($datas) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function getManageShiftbyid()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$id = $this->input->post('id');
			$status = $this->input->post('status');
			$check = $this->ModelManageShift->getManageShift(" WHERE id = '" . $id . "' ");
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

	public function saveManageShift()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;

		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			// $datennow = date('Y-m-d H:i:s');
			$id = $this->input->post('id');
			$shift = $this->input->post('shift');
			$day = $this->input->post('day');
			$starttime = $this->input->post('starttime');
			$endtime = $this->input->post('endtime');
			$branch_id = $this->input->post('branch_id');
			$instansi_id = $this->input->post('instansi_id');
			$status = $this->input->post('status');

			$post = true;


			if ($post) {
				if ($status == 'tambah') {
					$dataInsert = array(
						'shift'      => $shift,
						'day'        => $day,
						'start_time'  => $starttime,
						'end_time'    => $endtime,
						'created_at'    => date("Y-m-d H:i:s"),
					);
					$this->ModelGeneral->InsertData('hrm_shifts', $dataInsert);
					$this->ModelGeneral->LogActivity('Process Insert New Manage Shift ');
					$this->db->trans_complete();
					$this->db->trans_commit();
					$response['remarks'] = "Successfully saved new data";
				}
				if ($status == 'edit') {
					$dataInsert = array(
						'id'      => $id,
						'shift'      => $shift,
						'day'        => $day,
						'start_time'  => $starttime,
						'end_time'    => $endtime,
						'updated_at'    => date("Y-m-d H:i:s"),
					);
					$this->ModelGeneral->UpdateData('hrm_shifts', $dataInsert, array('id' => $id));
					$this->ModelGeneral->LogActivity('Process Update New Manage Shift : ' . $session['branch_id']);
					$this->db->trans_complete();
					$this->db->trans_commit();
					$response['remarks'] = "Successfully changed data";
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

	public function deleteManageShift()
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
			$id = $this->input->post('code_hapus');

			$post = true;

			if ($post) {
				$this->ModelGeneral->DeleteData('hrm_shifts', array('id' => $id));
				$this->ModelGeneral->LogActivity('Process Delete Manage Shift : ');
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
