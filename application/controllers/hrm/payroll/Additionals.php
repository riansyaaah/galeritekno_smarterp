<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Additionals extends CI_Controller
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
		$this->load->model('hrm/payroll/ModelOthers', 'additional');
	}

	var $idMenu = "4884bfa2-3742-4a19-81b4-519ef9547406";


	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Staff Additionals',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/payroll/v_additional', $data);
	}


	public function getAdditionalByStaffId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$period_id  = $this->input->post('period_id');
		$staff_id  	= $this->input->post('staff_id');
		$staff_additionals = $this->additional->getStaffAdditional($staff_id, $period_id);

		$no = 1;
		foreach ($staff_additionals as $additional) {
			$data[] = array(
				'no'		=> $no,
				'id'		=> $additional['id'],
				'description'	=> $additional['description'],
				'amount'		=> number_format($additional['amount']),
				'staff_id'		=> $additional['staff_id'],
				'period_id'		=> $additional['period_id'],
				'option'	=> '<button class="btn btn-info btn-sm" onclick="edit(' . $additional['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="hapus(' . $additional['id'] . ')"><i class="fa fa-trash"></i> Delete</button>'
			);
			$no++;
		}
		$response['data'] = (count($staff_additionals) > 0) ? $data : [];
		echo json_encode($response);
	}


	function getAdditionalById()
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
			$check = $this->additional->get_by_id($code);
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

	public function saveAdditional()
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
			$amount = $this->input->post('amount');
			$status = $this->input->post('status');
			$post = true;

			if ($post) {
				if ($status == 'tambah') {
					$check = $this->additional->getAdditional(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'id'			=> $code,
							'description'	=> $description,
							'period_id'		=> $period_id,
							'staff_id'    	=> $staff_id,
							'type'			=> 'A', //A = Additional
							'amount'		=> $amount,
							'created_at'	=> date("Y-m-d H:i:s"),
						);
						$this->additional->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert Additional of : ' . $description);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->additional->getAdditional(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'description'    	=> $description,
							'period_id'    		=> $period_id,
							'staff_id'   		=> $staff_id,
							'amount'            => $amount,
							'updated_at'        => date("Y-m-d H:i:s"),
						);
						$this->additional->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update Additional of : ' . $description);
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

	public function deleteAdditional()
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
				$this->additional->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete Additional : ' . $code);
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
