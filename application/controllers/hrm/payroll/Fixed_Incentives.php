<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fixed_Incentives extends CI_Controller
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
		$this->load->model('hrm/payroll/ModelFixedIncentive', 'fixed_incentive');
		$this->load->model('hrm/staffmanagement/ModelStaffProfile', 'staff');
		$this->load->model('hrm/payroll/ModelPeriod', 'period');
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
			'title'         => 'Data Fixed Incetives',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/payroll/v_fixed_incentive', $data);
	}


	public function getFixedIncentives()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$fixed_incentives = $this->fixed_incentive->get_all();
		$no = 1;
		foreach ($fixed_incentives as $fixed_incentive) {
			$staff = $this->staff->selectStaffProfile($fixed_incentive['staff_id']);
			$kode = '"' . $fixed_incentive['id'] . '"';

			$option = "
				<div style='text-align:center'>	
				<a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $kode . ")'><i class='fa fa-edit'></i> Edit</a>
				<a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $kode . ")'><i class='fa fa-trash'></i> Delete</a><div>";

			$data[] = array(
				'no'			=> $no,
				'id'			=> $fixed_incentive['id'],
				'staff_name'	=> $staff['first_name'],
				'staff_id'		=> $staff['id_personel'],
				'department'	=> $staff['department'],
				'position'		=> $staff['position'],
				'description'	=> $fixed_incentive['description'],
				'amount' 		=> number_format($fixed_incentive['amount']),
				'updated_at'	=> $fixed_incentive['updated_at'],
				'option'		=> $option
			);
			$no++;
		}
		if (count($fixed_incentives) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function getFixedIncentiveById()
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
			$check = $this->fixed_incentive->get_by_id($code);
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

	public function getFixedIncentiveByPeriodId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$period_id  = $this->input->post('period_id');
		$fixed_incentives = $this->fixed_incentive->getPeriodFixedIncentive($period_id);
		$no = 1;
		foreach ($fixed_incentives as $fixed_incentive) {

			$staff = $this->staff->selectStaffProfile($fixed_incentive['staff_id']);
			$kode = '"' . $fixed_incentive['id'] . '"';

			$option = "
				<div style='text-align:center'>	
				<a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $kode . ")'><i class='fa fa-edit'></i> Edit</a>
				<a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $kode . ")'><i class='fa fa-trash'></i> Delete</a><div>";

			$staff = "Adist";
			$position = "IT Administrator";
			$personel_id = "50416182";
			$data[] = array(
				'no'			=> $no,
				'staff_name'	=> $staff['first_name'],
				'staff_id'		=> $staff['id_personel'],
				'department'	=> $staff['department'],
				'position'		=> $staff['position'],
				'id'			=> $fixed_incentive['id'],
				'description'	=> $fixed_incentive['description'],
				'amount' 		=> $fixed_incentive['amount'],
				'option'		=> $option
			);
			$no++;
		}
		$response['data'] = (count($fixed_incentives) > 0) ? $data : [];
		echo json_encode($response);
	}


	public function saveFixedIncentive()
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
			$staff_id = $this->input->post('staff_id');
			$description = $this->input->post('description');
			$amount = $this->input->post('amount');
			$status = $this->input->post('status');
			$post = true;

			if ($post) {
				if ($status == 'tambah') {
					$check = $this->fixed_incentive->getFixedIncentive(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'id'			=> $code,
							'staff_id'		=> $staff_id,
							'description'	=> $description,
							'amount'		=> $amount,
							'created_at'	=> $datennow,
							'updated_at'	=> $datennow,
						);
						$this->fixed_incentive->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert FixedIncentive of : ' . $staff_id);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->fixed_incentive->getFixedIncentive(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'id'			=> $code,
							'staff_id'		=> $staff_id,
							'description'	=> $description,
							'amount'		=> $amount,
							'updated_at'	=> $datennow,
						);
						$this->fixed_incentive->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update Fixed Incentive of : ' . $staff_id);
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

	public function deleteFixedIncentive()
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
				$this->fixed_incentive->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete FixedIncentive : ' . $code);
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

	public function approveFixedIncentive()
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
				$this->fixed_incentive->update($code, $dataApprove);
				$this->ModelGeneral->LogActivity('Process Approve FixedIncentive : ' . $code);
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


	public function abortFixedIncentive()
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
				$this->fixed_incentive->update($code, $dataAbort);
				$this->ModelGeneral->LogActivity('Process Abort FixedIncentive : ' . $code);
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
