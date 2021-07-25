<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lateness extends CI_Controller
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
		$this->load->model('hrm/timesheets/ModelLateness', 'late');
		$this->load->model('hrm/timesheets/ModelLatenessPosition', 'latePosition');
		$this->load->model('hrm/master/ModelPosition', 'position');
		$this->load->model('hrm/master/ModelDepartment', 'department');
	}

	var $idMenu = "DEBA3D8B-A1F4-4F3A-BEF8-D9F46A63C473";


	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$positions = $this->position->get_all();
		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Lateness',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
			'positios'		=> $positions
		);
		$this->load->view('hrm/timesheets/v_lateness', $data);
	}

	public function getLateDurations()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$lateDurations = $this->late->get_all();
		$no = 1;
		foreach ($lateDurations as $lateDuration) {
			$chose = "<div style='text-align:center'><a href='#' class='edit_record btn btn-info btn-sm'><i class='fa fa-check'></i></a></div>";
			$data[] = array(
				'no'			=> $no,
				'duration'		=> $lateDuration['duration'],
				'chose'			=> $chose,
				'option'		=> '
				<div style="text-align:center">
					<button class="btn btn-info btn-sm" onclick="editDuration(' . $lateDuration['duration'] . ')"><i class="fa fa-edit"></i> Edit</button> 
					<button class="btn btn-danger btn-sm" onclick="hapusDuration(' . $lateDuration['duration'] . ')"><i class="fa fa-trash"></i> Delete</button>
				</div>'
			);
			$no++;
		}
		$response['data'] = (count($lateDurations) > 0) ? $data : [];
		echo json_encode($response);
	}

	function getLateDurationById()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$duration = $this->input->post('duration');
			$status = $this->input->post('status');
			$check = $this->late->get_by_id($duration);
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

	public function saveLateDuration()
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
			$duration = $this->input->post('duration');
			$new_duration = $this->input->post('new_duration');
			$status = $this->input->post('status');
			$post = true;

			if ($post) {
				if ($status == 'tambah') {
					$check = $this->late->getLateDuration(" where duration='$duration' order by duration limit 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Durasi sudah ada!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'duration'		=> $duration,
							'created_at'	=> $datennow,
							'updated_at'	=> $datennow,
						);
						$this->late->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert duration : ' . $duration . " minute(s)");
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->late->getLateDuration(" WHERE duration=$duration ORDER BY duration LIMIT 1");
					if (count($check) >= 0) {
						$dataUpdate = array(
							'duration'		=> $new_duration,
							'updated_at'	=> $datennow,
						);
						$this->late->update($duration, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Insert duration : ' . $duration . " minute(s)");
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully changed data";
					} else {
						$response['status_json'] = false;
						$response['remarks'] = "Durasi sudah ada!";
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

	public function deleteLateDuration()
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
			$code = $this->input->post('kode_hapus_duration');

			$post = true;

			if ($post) {
				$dataDelete = array(
					'deleted_at' => date("Y-m-d H:i:s"),
				);
				$this->late->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete Late Duration : ' . $code);
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

	public function saveLatePosition()
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
			$id = $this->input->post('id');
			$duration = $this->input->post('duration');
			$position = $this->input->post('position');
			$type_penalty = $this->input->post('type_penalty');
			$value = $this->input->post('amount');
			$status = $this->input->post('status');
			$post = true;

			if ($type_penalty  == '1') {
				$amount = 0;
				$percent = $value;
			} else {
				$amount = $value;
				$percent = 0;
			}
			if ($post) {
				if ($status == 'tambah') {
					$check = $this->latePosition->getLatePosition(" WHERE id = '$id' OR duration_id = '$duration' AND position_id = '$position' AND deleted_at=NULL ORDER BY id LIMIT 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Penalty sudah ada!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'duration_id'	=> $duration,
							'position_id'	=> $position,
							'type'			=> $type_penalty,
							'percent'		=> $percent,
							'amount'		=> $amount,
							'created_at' 	=> $datennow,
							'updated_at' 	=> $datennow,
							'created_by' 	=> '',
						);
						$this->latePosition->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert Penalty Position : ' . $position);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->latePosition->getLatePosition("WHERE id = '$id' ORDER BY id LIMIT 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'duration_id'	=> $duration,
							'position_id'	=> $position,
							'type'			=> $type_penalty,
							'percent'		=> $percent,
							'amount'		=> $amount,
							'updated_at' 	=> $datennow,
							'updated_by' 	=> '',
						);
						// var_dump($dataUpdate);
						// die;
						$this->latePosition->update($id, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Insert Penalty Position : ' . $position);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully changed data";
					} else {
						$response['status_json'] = false;
						$response['remarks'] = "Durasi sudah ada";
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

	public function getPositionByDurationId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$duration  	= $this->input->post('duration');
		$positions 	= $this->latePosition->getPositionByDurationId($duration);

		$no = 1;
		foreach ($positions as $position) {
			$posDep	=	$this->position->getPositionById($position['position_id']);
			$dep	=	$this->department->getDepartmentPositionId($posDep['department_id']);

			if ($position['type']  == '1') {
				$amount = $position['percent'] . ' %';
			} else {
				$amount = 'Rp. ' . number_format($position['amount']);
			}

			$data[] = array(
				'no'			=> $no,
				'id'			=> $position['id'],
				'position'		=> $posDep['position'],
				'department'	=> $dep['department'],
				'duration'		=> $position['duration_id'],
				'amount' 		=> $amount,
				'last_update'	=> $position['updated_at'],
				'option'		=> '<button class="btn btn-info btn-sm" onclick="editPosition(' . $position['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="hapusPosition(' . $position['id'] . ')"><i class="fa fa-trash"></i> Delete</button>'
			);
			$no++;
		}
		$response['data'] = (count($positions) > 0) ? $data : [];
		echo json_encode($response);
	}

	function getLatePositionById()
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
			$check = $this->latePosition->get_by_id($id);
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

	public function deleteLatePosition()
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
			$code = $this->input->post('kode_hapus_position');

			$post = true;

			if ($post) {
				$dataDelete = array(
					'deleted_at' => date("Y-m-d H:i:s"),
				);
				$this->latePosition->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete Late Position : ' . $code);
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
