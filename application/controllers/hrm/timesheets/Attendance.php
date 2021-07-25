<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendance extends CI_Controller
{
	function __Construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$this->load->helper(array('form', 'url'));
		$this->load->model('auth/ModelLogin');
		$this->load->model('ModelGeneral');
		$this->load->model('hrm/timesheets/ModelAttendance', 'attendance');
		$this->load->model('hrm/staffmanagement/ModelStaffProfile', 'staff');
		$this->load->model('hrm/staffmanagement/ModelShifting', 'shifting');
		$this->load->model('hrm/timesheets/ModelManageShift', 'shift');
		$this->load->model('hrm/payroll/ModelPeriod', 'period');
		$this->load->model('hrm/master/ModelAllowance', 'allowance');
		$this->load->model('usermanagement/ModelUsers');
	}

	var $idMenu = "9389e2ab-0ad0-42c7-b27a-4da9e674479c";

	public function index()
	{
		// $today = date("Y-m-d");
		// $attendances = $this->attendance->getStaffProfile($today);
		// var_dump($attendances);
		// die;
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Attendence',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
			'shifts' 		=> $this->shift->get_all(),
		);
		$this->load->view('hrm/timesheets/v_attendance', $data);
	}

	public function test()
	{
		// Jumlah data di att_log
		$attendances = $this->attendance->getAttendanceLog();

		// jumlah shifting
		$staff_shift = $this->shifting->getStaffShifts();

		// Ulang sebanyak jumlah data shift
		for ($i = 0; $i < count($staff_shift); $i++) {

			// Validasi dengan log sidik jari. ID dan Tanggal
			$validasi = $this->attendance->getShiftByStaffId($staff_shift[$i]['id_personel'], $staff_shift[$i]['date']);

			// Validasi dengan isi tabel staff_attendances

			$validasi2 = $this->attendance->getStaffByStaffId2($staff_shift[$i]['id_personel'], $staff_shift[$i]['date']);

			if ($validasi) {
				if ($validasi2 == NULL) {
					$log	 = $this->attendance->getAttendanceLogById($staff_shift[$i]['id_personel'], $staff_shift[$i]['date']);

					$in 	= min($log)['scan_date'];
					$time1 	= new DateTime($in);
					$time_in = $time1->format('H:i:s');

					$out 	= max($log)['scan_date'];
					$time2 	= new DateTime($out);
					$time_out = $time2->format('H:i:s');


					// Mencari jam awal
					$start_time = $this->shift->get_time($staff_shift[$i]['shift_id'])['start_time'];
					$end_time = $this->shift->get_time($staff_shift[$i]['shift_id'])['end_time'];


					// menentukan jam masuk
					$time = new DateTime($start_time);
					$time->add(new DateInterval('PT' . 30 . 'M'));
					$start_time_plus = $time->format('H:i:s');

					// Status Telat
					if (strtotime($time_in) > strtotime($start_time_plus)) {
						$late = 1;
					} else {
						$late = 0;
					}

					// menentukan jam pulang
					$time2 = new DateTime($end_time);
					$end_time = $time2->format('H:i:s');

					// Status Pulang Cepat
					if (strtotime($time_out) < strtotime($end_time)) {
						$early_leaving = 1;
					} else {
						$early_leaving = 0;
					}

					// siapkan variabel penampungan
					$dataInsert = array(
						'staff_id'  => $staff_shift[$i]['id_personel'],
						'shift_id' => $staff_shift[$i]['shift_id'],
						'staff_shift_id' => $staff_shift[$i]['staff_shift_id'],
						'arrived_at' => $time_in,
						'left_at'	=> $time_out,
						'is_late'	=> $late,
						'is_early_leaving' => $early_leaving,
						'created_at' => date("Y-m-d H:i:s"),
					);
					// Simpan Ke DB
					$this->attendance->insert($dataInsert);
				}
			}
		}
	}

	public function getAttendance()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$attendances = $this->attendance->getAttendance("order by attendance_date ASC");
		$no = 1;
		foreach ($attendances as $attendance) {
			$id = '"' . $attendance['id'] . '"';
			$late_status 	= $attendance['late'] == 1 ? 'Ya' : 'Tidak';
			$early_leaving = $attendance['early_leaving'] == 1 ? 'Ya' : 'Tidak';
			$option = "
			<div class='text-center'> 
				<a href='#' class='edit_record btn btn-info btn-sm' onclick='return editAttendance(" . $id . ")'><i class='fa fa-edit'></i> Edit</a>
				<a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $id . ")'><i class='fa fa-trash'></i> Delete</a>
			</div>";
			$data[] = array(
				"no" => $no,
				"first_name" => $attendance['first_name'],
				"last_name" => $attendance['last_name'],
				"email" => $attendance['email'],
				"phone" => $attendance['phone'],
				"attendance_date" => $attendance['attendance_date'],
				"attendance_status" => $attendance['attendance_status'],
				"shift" => $attendance['shift_id'],
				"arrived_at" => $attendance['arrived_at'],
				"left_at" => $attendance['left_at'],
				"late" => $late_status,
				"early_leaving" => $early_leaving,
				"overtime" => $attendance['overtime'],
				"working_hours" => $attendance['working_hours'],
				// "total_rest" => $attendance['total_rest'],
				"overtime_paid" => $attendance['overtime_paid'],
				"daily_paid" => $attendance['daily_paid'],
				"transport_paid" => $attendance['transport_paid'],
				"option" => $option,

			);
			$no++;
		}
		if (count($attendances) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	public function saveAttendance()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;

		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$id = $this->input->post('id');
			$staff_id = $this->input->post('staff_id');
			$attendance_date = $this->input->post('attendance_date');
			$attendance_status = $this->input->post('attendance_status');
			$shift_id = $this->input->post('shift_id');
			$arrived_at = $this->input->post('arrived_at');
			$left_at = $this->input->post('left_at');
			// $late = $this->input->post('late');
			$early_leaving = $this->input->post('early_leaving');
			// $overtime = $this->input->post('overtime');
			$StatusAttendance = $this->input->post('StatusAttendance');
			$post = true;
			// Mencari total jam kerja

			// Mencari jumlah jam kerja dalam shift
			$shift = $this->shift->get_working_hours($shift_id);
			$shift_hours = date("H", strtotime($shift));

			// Mencari overtime
			$overtime = 0;

			// Apakah Shift 3 ?
			if ($shift_id == 3 || $shift_id == 6) {
				$working_hours = round(((strtotime($left_at) + 43200) - (strtotime($arrived_at) - 43200)) / 3600, 1) - 1;
			} else {
				$working_hours = round((strtotime($left_at) - strtotime($arrived_at)) / 3600, 1) - 1;
			}


			// Mencari jam awal
			$start_time = $this->shift->get_time($shift_id)['start_time'];
			$end_time = $this->shift->get_time($shift_id)['end_time'];

			// menentukan jam masuk
			$time = new DateTime($start_time);
			$time->add(new DateInterval('PT' . 30 . 'M'));
			$start_time_plus = $time->format('H:i:s');

			// Status Telat
			if (strtotime($arrived_at) >= strtotime($start_time_plus)) {
				$late = 1;
			} else {
				$late = 0;
			}

			// menentukan jam masuk
			$time2 = new DateTime($end_time);
			$end_time = $time2->format('H:i:s');


			// Status Pulang Cepat
			if (strtotime($left_at) < strtotime($end_time)) {
				$early_leaving = 1;
			} else {
				$early_leaving = 0;
			}

			// get periode aktif
			$period = $this->period->get_status()['id'];

			// Daily Paid
			$basic_salary = $this->staff->getStaffById($staff_id)['basic_salary'];
			$perhari = $basic_salary / 20;
			$perjam = $perhari / 8;

			if ($working_hours > $shift_hours) {
				$daily_paid = $perjam * $shift_hours;
			} else {
				$daily_paid = $perjam * $working_hours;
			}

			// get Overtime paid
			if ($working_hours > $shift_hours) {
				$overtime = $working_hours - $shift_hours;
				$overtime_paid = $overtime * $perjam;
				$working_hours = round($shift_hours, 1);
			} else {
				$overtime = 0;
				$overtime_paid = 0;
			}

			// Get Uang Transport ( + Makan)
			$transport_paid = $this->allowance->get_by_id(1)['amount'];


			if ($post) {
				if ($StatusAttendance == 'Tambah') {
					$dataInsert = array(
						'staff_id'  => $staff_id,
						'attendance_date'  => $attendance_date,
						'attendance_status' => $attendance_status,
						'shift_id' => $shift_id,
						'arrived_at'  => $arrived_at,
						'left_at' => $left_at,
						'late' => $late,
						'early_leaving' => $early_leaving,
						'overtime'    => $overtime,
						'overtime_paid' => $overtime_paid,
						'working_hours'    => $working_hours,
						'period_id' => $period,
						'daily_paid' => $daily_paid,
						'transport_paid' => $transport_paid,
						'created_at'    => date("Y-m-d H:i:s"),
					);
					$this->ModelGeneral->InsertData('hrm_attendance', $dataInsert);
					$this->ModelGeneral->LogActivity('Process Insert New Attendance ');
					$response['remarks'] = "Successfully saved new data";
					$this->db->trans_complete();
					$this->db->trans_commit();
				}
				if ($StatusAttendance == 'Edit') {
					$dataInsert = array(
						'id'  => $id,
						'staff_id'  => $staff_id,
						'attendance_date'  => $attendance_date,
						'attendance_status' => $attendance_status,
						'shift_id' => $shift_id,
						'arrived_at'  => $arrived_at,
						'left_at' => $left_at,
						'late' => $late,
						'early_leaving' => $early_leaving,
						'overtime'    => $overtime,
						'overtime_paid' => $overtime_paid,
						'working_hours'    => $working_hours,
						'period_id' => $period,
						'daily_paid' => $daily_paid,
						'transport_paid' => $transport_paid,
						'updated_at'    => date("Y-m-d H:i:s"),
					);
					$this->ModelGeneral->UpdateData('hrm_attendance', $dataInsert, array('id' => $id));
					$this->ModelGeneral->LogActivity('Process Update New Attendance ');
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

	function getAttendancebyid()
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
			$check = $this->attendance->getAttendance(" WHERE hrm_attendance.id = '" . $id . "' ");
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

	public function deleteAttendance()
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

				$this->ModelGeneral->DeleteData('hrm_attendance', array('id' => $id));
				$this->ModelGeneral->LogActivity('Process Delete Attendance : ');
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

	public function getStaffProfile()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $today = date("Y-m-d");
		// $attendances = $this->attendance->getStaffProfile($today);
		$attendances = $this->attendance->getStaffProfile();
		$no = 1;
		foreach ($attendances as $attendance) {
			$id = $attendance['id'];
			$option = "
             <a href='#' class='edit_record btn btn-info btn-sm'><i class='fa fa-check'></i></a>";
			$data[] = array(
				'id' => $id,
				"first_name" => $attendance['first_name'],
				"last_name" => $attendance['last_name'],
				"email" => $attendance['email'],
				"phone" => $attendance['phone'],
				"address" => $attendance['address'],
				"working_shift" => $attendance['working_shift'],
				"option" => $option,
			);
			$no++;
		}
		if (count($attendances) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}
}
