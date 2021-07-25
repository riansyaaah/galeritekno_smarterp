<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manageallowance extends CI_Controller
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
		$this->load->model('hrm/staffmanagement/ModelManageAllowance', 'allowance');
	}

	var $idMenu = "0bcbf0a3-71ad-4bbb-adb0-90ee0b379944";


	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Staff Management Allowances',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/staffmanagement/v_manage_allowance', $data);
	}

	public function getManageAllowance()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$allowances = $this->allowance->get_all();
		$no = 1;
		foreach ($allowances as $allowance) {
			$kode = '"' . $allowance['id'] . '"';
			if ($allowance['id'] != 1) {
				$option = "
				<a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $kode . ")'><i class='fa fa-edit'></i> Edit</a>
				<a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $kode . ")'><i class='fa fa-trash'></i> Delete</a>";
			} else {
				$option = "
				<a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $kode . ")'><i class='fa fa-edit'></i> Edit</a>
				";
			}

			$data[] = array(
				"no"        => $no,
				"id"                => $allowance['id'],
				"allowance_name"    => $allowance['allowance_name'],
				"allowance_type"    => $allowance['allowance_type'],
				"amount"            => number_format($allowance['amount']),
				"set_date"          => $allowance['set_date'],
				"description"       => $allowance['description'],
				"option"            => $option,
			);
			$no++;
		}
		if (count($allowances) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function getManageAllowanceById()
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
			$check = $this->allowance->get_by_id($code);
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

	public function saveManageAllowance()
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
			$allowance_name = $this->input->post('allowance_name');
			$amount = $this->input->post('amount');
			$set_date = $this->input->post('set_date');
			$description = $this->input->post('description');
			$status = $this->input->post('status');
			$post = true;

			if ($post) {
				if ($status == 'tambah') {
					$check = $this->allowance->getManageAllowance(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'id'                => $code,
							'allowance_name'    => $allowance_name,
							'amount'            => $amount,
							'set_date'          => $set_date,
							'description'       => $description,
							'created_at'        => date("Y-m-d H:i:s"),
						);
						$this->allowance->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert Allowance : ' . $allowance_name);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->allowance->getManageAllowance(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'id'                => $code,
							'allowance_name'    => $allowance_name,
							'amount'            => $amount,
							'set_date'          => $set_date,
							'description'       => $description,
							'updated_at'        => date("Y-m-d H:i:s"),
						);
						$this->allowance->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update Allowance : ' . $allowance_name);
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

	public function deleteManageAllowance()
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
				$this->allowance->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete allowance : ' . $code);
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
