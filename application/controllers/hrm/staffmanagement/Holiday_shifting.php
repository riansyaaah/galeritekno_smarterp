<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Holiday_shifting extends CI_Controller
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
		$this->load->model('hrm/timesheets/ModelManageShift', 'shift');
		$this->load->model('hrm/staffmanagement/ModelHolidayShifting', 'holiday_shifting');
		$this->load->model('hrm/staffmanagement/ModelStaffProfile', 'staff');
		$this->load->model('hrm/timesheets/ModelHoliday', 'holiday');
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
			'title'         => 'Staff Holiday Shiftings',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
			'shifts' 		=> $this->shift->get_all(),
		);
		$this->load->view('hrm/staffmanagement/v_holiday_shifting', $data);
	}


	public function getHolidayShifting()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$staff_holiday_shiftings = $this->holiday_shifting->get_all();
		$this->staff->selectStaffProfile(1);

		$no = 1;
		foreach ($staff_holiday_shiftings as $holiday_shifting) {
			$staff = $this->staff->selectStaffProfile($holiday_shifting['staff_id']);
			$day = $this->holiday_shifting->getDate($holiday_shifting['holiday_id']);
			$data[] = array(
				'no'			=> $no,
				'id'			=> $holiday_shifting['id'],
				'staff_name'	=> $staff['first_name'],
				'staff_id'		=> $staff['id_personel'],
				'department'	=> $staff['department'],
				'position'		=> $staff['position'],
				'date'			=> $day['date'],
				'shift'			=> $holiday_shifting['shift_id'],
				'option'		=> '<button class="btn btn-info btn-sm" onclick="edit(' . $holiday_shifting['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="hapus(' . $holiday_shifting['id'] . ')"><i class="fa fa-trash"></i> Delete</button>'
			);
			$no++;
		}
		$response['data'] = (count($staff_holiday_shiftings) > 0) ? $data : [];
		echo json_encode($response);
	}

	public function getHolidayShiftByHolidayId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$holiday_id  	= $this->input->post('holiday_id');
		$holiday_shifts = $this->holiday_shifting->getHolidayShiftByHolidayId($holiday_id);

		$no = 1;
		foreach ($holiday_shifts as $holiday_shifting) {
			$staff = $this->staff->selectStaffProfile($holiday_shifting['staff_id']);
			$day = $this->holiday_shifting->getDate($holiday_shifting['holiday_id']);
			$data[] = array(
				'no'			=> $no,
				'id'			=> $holiday_shifting['id'],
				'staff_name'	=> $staff['first_name'],
				'staff_id'		=> $staff['id_personel'],
				'department'	=> $staff['department'],
				'position'		=> $staff['position'],
				'date'			=> $day['date'],
				'shift'			=> $holiday_shifting['shift_id'],
				'option'		=> '<button class="btn btn-info btn-sm" onclick="edit(' . $holiday_shifting['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="hapus(' . $holiday_shifting['id'] . ')"><i class="fa fa-trash"></i> Delete</button>'
			);
			$no++;
		}
		$response['data'] = (count($holiday_shifts) > 0) ? $data : [];
		echo json_encode($response);
	}


	function getHolidayShiftingById()
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
			$check = $this->holiday_shifting->get_by_id($code);
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

	public function saveHolidayShifting()
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
			$holiday_id = $this->input->post('holiday_id');
			$shift_id = $this->input->post('shift_id');
			$status = $this->input->post('status');
			$post = true;

			if ($post) {
				if ($status == 'tambah') {
					$check = $this->holiday_shifting->getHolidayShifting(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					}
					$staff = $this->holiday_shifting->getHolidayShifting(" where staff_id = '$staff_id' AND holiday_id = '$holiday_id'  order by id limit 1");
					if (count($staff) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "The Staff Already Has The Shift!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'id'			=> $code,
							'holiday_id'    => $holiday_id,
							'staff_id'    	=> $staff_id,
							'shift_id'		=> $shift_id,
							'created_at'	=> $datennow,
						);
						$this->holiday_shifting->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert Holiday Shifting of : ' . $staff_id);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->holiday_shifting->getHolidayShifting(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'holiday_id'    => $holiday_id,
							'staff_id'    	=> $staff_id,
							'shift_id'		=> $shift_id,
							'updated_at'        => $datennow,
						);
						$this->holiday_shifting->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update HolidayShifting of : ' . $staff_id);
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

	public function deleteHolidayShifting()
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
				$this->holiday_shifting->delete($code, $dataDelete);
				$this->ModelGeneral->LogActivity('Process Delete HolidayShifting : ' . $code);
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
