<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Officials extends CI_Controller
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
		$this->load->model('hrm/payroll/ModelOthers', 'official');
	}

	var $idMenu = "f79623cb-c986-474a-9d45-e8663e040079";


	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Staff Officials',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/payroll/v_official', $data);
	}


	public function getOfficialByStaffId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$period_id  = $this->input->post('period_id');
		$staff_id  	= $this->input->post('staff_id');
		$staff_officials = $this->official->getStaffOfficial($staff_id, $period_id);

		$no = 1;
		foreach ($staff_officials as $official) {
			$data[] = array(
				'no'		=> $no,
				'id'		=> $official['id'],
				'description'	=> $official['description'],
				'amount'		=> number_format($official['amount']),
				'staff_id'		=> $official['staff_id'],
				'period_id'		=> $official['period_id'],
				'option'	=> '<button class="btn btn-info btn-sm" onclick="edit(' . $official['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="hapus(' . $official['id'] . ')"><i class="fa fa-trash"></i> Delete</button>'
			);
			$no++;
		}
		$response['data'] = (count($staff_officials) > 0) ? $data : [];
		echo json_encode($response);
	}


	function getOfficialById()
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
			$check = $this->official->get_by_id($code);
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

	public function saveOfficial()
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
					$check = $this->official->getOfficial(" where id = '$code' order by id limit 1");
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
							'type'			=> 'O', //I = Official
							'amount'		=> $amount,
							'created_at'	=> date("Y-m-d H:i:s"),
						);
						$this->official->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert Official of : ' . $description);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->official->getOfficial(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'description'    	=> $description,
							'period_id'    		=> $period_id,
							'staff_id'   		=> $staff_id,
							'amount'            => $amount,
							'updated_at'        => date("Y-m-d H:i:s"),
						);
						$this->official->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update Official of : ' . $description);
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

	public function deleteOfficial()
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
				$this->official->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete Official : ' . $code);
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
