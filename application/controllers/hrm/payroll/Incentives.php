<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Incentives extends CI_Controller
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
		$this->load->model('hrm/payroll/ModelOthers', 'incentive');
	}

	var $idMenu = "8f5ebac2-ac02-4ed2-b44f-f91e5ac1f0fa";


	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Staff Incentives',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/payroll/v_incentive', $data);
	}


	public function getIncentiveByStaffId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$period_id  = $this->input->post('period_id');
		$staff_id  	= $this->input->post('staff_id');
		$staff_incentives = $this->incentive->getStaffIncentive($staff_id, $period_id);

		$no = 1;
		foreach ($staff_incentives as $incentive) {
			$data[] = array(
				'no'		=> $no,
				'id'		=> $incentive['id'],
				'description'	=> $incentive['description'],
				'amount'		=> number_format($incentive['amount']),
				'staff_id'		=> $incentive['staff_id'],
				'period_id'		=> $incentive['period_id'],
				'option'	=> '<button class="btn btn-info btn-sm" onclick="edit(' . $incentive['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="hapus(' . $incentive['id'] . ')"><i class="fa fa-trash"></i> Delete</button>'
			);
			$no++;
		}
		$response['data'] = (count($staff_incentives) > 0) ? $data : [];
		echo json_encode($response);
	}


	function getIncentiveById()
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
			$check = $this->incentive->get_by_id($code);
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

	public function saveIncentive()
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
					$check = $this->incentive->getIncentive(" where id = '$code' order by id limit 1");
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
							'type'			=> 'I', //I = Incentive
							'amount'		=> $amount,
							'created_at'	=> date("Y-m-d H:i:s"),
						);
						$this->incentive->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert Incentive of : ' . $description);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->incentive->getIncentive(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'description'    	=> $description,
							'period_id'    		=> $period_id,
							'staff_id'   		=> $staff_id,
							'amount'            => $amount,
							'updated_at'        => date("Y-m-d H:i:s"),
						);
						$this->incentive->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update Incentive of : ' . $description);
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

	public function deleteIncentive()
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
				$this->incentive->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete Incentive : ' . $code);
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
