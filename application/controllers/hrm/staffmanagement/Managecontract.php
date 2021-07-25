<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Managecontract extends CI_Controller
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
		$this->load->model('hrm/staffmanagement/ModelManageContract', 'contract');
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
			'title'         => 'Staff Management Contract',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/staffmanagement/v_managecontract', $data);
	}

	public function getManageContract()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$contracts = $this->contract->get_all();
		$no = 1;
		foreach ($contracts as $contract) {
			$kode = '"' . $contract['id'] . '"';
			$option = "
             <a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $kode . ")'><i class='fa fa-edit'></i> Edit</a>
             <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $kode . ")'><i class='fa fa-trash'></i> Delete</a>";
			$data[] = array(
				"no" 			=> $no,
				"id" 			=> $contract['id'],
				"duration" 		=> $contract['duration'] . ' Months',
				"days" 			=> $contract['days'],
				"description" 	=> $contract['description'],
				"option" 		=> $option,
			);
			$no++;
		}
		if (count($contracts) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function getManageContractbyid()
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
			$check = $this->contract->getContractById($code);
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

	public function saveManageContract()
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
			$duration = $this->input->post('duration');
			$days = $this->input->post('days');
			$description = $this->input->post('description');
			$status = $this->input->post('status');
			$post = true;

			if ($post) {
				if ($status == 'tambah') {
					$check = $this->contract->getManageContract(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'id'      		=> $code,
							'duration' 		=> $duration,
							'days' 			=> $days,
							'description' 	=> $description,
							'created_at'	=> date("Y-m-d H:i:s"),
						);
						// $this->ModelGeneral->InsertData('hrm_contracts', $dataInsert);
						$this->contract->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert New Contract : ' . $description);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->contract->getContractById($code);
					if (count(array($check)) > 0) {
						$dataUpdate = array(
							'id'      		=> $code,
							'duration' 		=> $duration,
							'days' 			=> $days,
							'description' 	=> $description,
							'updated_at'	=> date("Y-m-d H:i:s"),
						);
						// $this->ModelGeneral->UpdateData('hrm_manage_contracts', $dataUpdate, array('id' => $code));
						$this->contract->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update New Contract : ' . $description);
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

	public function deleteManageContract()
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
				// $this->ModelGeneral->DeleteData('hrm_contracts', array('id' => $code));
				$this->contract->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete Contract : ' . $code);
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
