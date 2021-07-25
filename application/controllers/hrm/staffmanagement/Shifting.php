<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Shifting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('hrm/staffmanagement/ModelShifting', 'ms');
	}
	protected $idMenu = 'e172796d-c12b-42eb-813a-7944df8f8027';
	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$periode = $this->mg->getWhere('hrm_payroll_periods', ['is_opening' => 1])->row_array();
		$data = [
			'periode'	 	=> ($periode) ? $periode['id'] : 0,
			'title'         => 'Shifting',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'   => $this->session->userdata('current_app')
		];
		$this->load->view('hrm/staffmanagement/shifting/index', $data);
	}
	public function getBulanDepan()
	{
		cek_session($this->idMenu);
		$data = $this->ms->getPeriode();
		for ($i = 0; $i < count($data->data); $i++) {
			$data->data[$i]->btn = '<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button>';
		}
		json($data->data);
	}
	public function getAllShift()
	{
		cek_session($this->idMenu);
		$data = $this->mg->getWhere('hrm_shifts', ['deleted_at' => null])->result_array();
		json($data);
	}

	public function getShiftById()
	{
		cek_session($this->idMenu);
		$id = $this->input->get('id');
		$data = $this->ms->getShiftById($id);
		json($data);
	}
	public function getShift()
	{
		cek_session($this->idMenu);
		$input = $this->input;
		$form = [
			'start_date'	=> $input->post('start_date'),
			'end_date'		=> $input->post('end_date'),
			'shift_id'		=> $input->post('shift_id')
		];
		$datas = $this->ms->getShift($form);
		for ($i = 0; $i < count($datas); $i++) {
			$datas[$i]['no'] = $i + 1;
			$datas[$i]['nama'] = $datas[$i]['first_name'] . ' ' . $datas[$i]['last_name'];
			$datas[$i]['btn'] = '<button class="btn btn-success btn-sm" onclick="renderModalSwap(' . $datas[$i]['id'] . ')"><i class="fa fa-refresh"></i> Swap</button> <button class="btn btn-info btn-sm" onclick="renderModalEdit(' . $datas[$i]['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="renderModalDelete(' . $datas[$i]['id'] . ')"><i class="fa fa-trash"></i> Delete</button>';
		}
		json($datas);
	}
	public function getAllStaff()
	{
		cek_session($this->idMenu);
		$allStaff = $this->_setPeriode();
		for ($i = 0; $i < count($allStaff); $i++) {
			$allStaff[$i]['check'] = '<input class="form-check-input" type="checkbox" id="select' . $allStaff[$i]['id'] . '" name="select' . $allStaff[$i]['id'] . '">';
			$allStaff[$i]['nama'] = $allStaff[$i]['first_name'] . ' ' . $allStaff[$i]['last_name'];
		}
		json($allStaff);
	}
	private function _setPeriode()
	{
		$input = $this->input;
		$form = [
			'start_date'	=> $input->post('start_date'),
			'end_date'		=> $input->post('end_date')
		];
		$allShift = $this->ms->getShiftDate($form);
		$idStaffShift = [];
		foreach ($allShift as $as) {
			array_push($idStaffShift, $as['staff_id']);
		}
		return $this->ms->getAllStaffShift($idStaffShift);
	}
	public function getStaffHaveShift()
	{
		cek_session($this->idMenu);
		$idPersonel = $this->input->post('idPersonel');
		$staff = $this->mg->getWhere('hrm_staffprofile', ['hrm_staffprofile.id_personel' => $idPersonel])->row_array();
		$allStaff = $this->_setPeriodeEdit($staff['position_id']);
		for ($i = 0; $i < count($allStaff); $i++) {
			$allStaff[$i]['nama'] = $allStaff[$i]['first_name'] . ' ' . $allStaff[$i]['last_name'];
			$allStaff[$i]['btn'] = '<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button>';
		}
		json($allStaff);
	}
	private function _setPeriodeEdit($idPosition)
	{
		$date = $this->input->post('date');
		$allShift = $this->ms->getShiftDateEdit($date);
		$idStaffShift = [];
		foreach ($allShift as $as) {
			array_push($idStaffShift, $as['staff_id']);
		}
		return $this->ms->getStaffShift($idStaffShift, $idPosition);
	}
	public function saveAddShift()
	{
		cek_session($this->idMenu);
		$res = [];
		$res['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$start = $input->get('start_date');
			$end = $input->get('end_date');
			$rangeTanggal = $this->_getDatesFromRange($start, $end);
			$form = [
				'shift_id'		=> $input->get('shift_id'),
				'created_at'	=> date('Y-m-d H:i:s'),
				'period_id'		=> $input->get('period_id')
			];
			$post = true;
			if ($post) {
				$staffs = $this->mg->getWhere('hrm_staffprofile', ['status' => 1])->result_array();
				foreach ($staffs as $staff) {
					$on = $input->get('select' . $staff['id']);
					if ($on) {
						foreach ($rangeTanggal as $rt) {
							if (date('D', strtotime($rt)) != 'Sun') {
								$form['staff_id'] = $staff['id'];
								$form['date'] = $rt;
								$form['is_saturday'] = (date('D', strtotime($rt)) == 'Sat') ? 1 : 0;
								$this->mg->InsertData('hrm_staff_shifts', $form);
								$this->mg->LogActivity('Process Insert Staff Shift : ' . $form['staff_id']);
							}
						}
					}
				}
				$this->db->trans_complete();
				$this->db->trans_commit();
				$res['remarks'] = 'Successfully saved new data';
			} else {
				$res['status_json'] = false;
				$res['remarks'] = 'Unable to save new data';
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$res['status_json'] = false;
			$res['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->mg->LogError(current_url(),  $e->getMessage());
		}
		header('Content-Type: application/json');
		echo json_encode($res);
	}
	private function _getDatesFromRange($startDate, $endDate)
	{
		$return = [$startDate];
		$start = $startDate;
		$i = 1;
		if (strtotime($startDate) < strtotime($endDate)) {
			while (strtotime($start) < strtotime($endDate)) {
				$start = date('Y-m-d', strtotime($startDate . '+' . $i . ' days'));
				$return[] = $start;
				$i++;
			}
		}
		$libur = $this->mg->getAll('hrm_holidays')->result_array();
		for ($i = 0; $i < count($return); $i++) {
			foreach ($libur as $l) {
				if ($return[$i] == $l['date']) array_splice($return, $i, 1);
			}
		}
		return $return;
	}
	public function deleteShift()
	{
		cek_session($this->idMenu);
		$res = [];
		$res['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$id = $this->input->get('id');
			$post = true;
			if ($post) {
				$cek = $this->mg->getWhere('hrm_staff_shifts', ['id' => $id])->row_array();
				if ($cek) {
					$this->mg->UpdateData('hrm_staff_shifts', [
						'deleted_at' => date('Y-m-d H:i:s')
					], ['id' => $cek['id']]);
					$this->mg->LogActivity('Process Delete Staff Shift : ' . $cek['id']);
					$this->db->trans_complete();
					$this->db->trans_commit();
					$res['remarks'] = 'Successfully deleted data';
				} else {
					$res['status_json'] = false;
					$res['remarks'] = 'Data not found';
					$this->db->trans_rollback();
				}
			} else {
				$res['status_json'] = false;
				$res['remarks'] = 'Unable to delete data';
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$res['status_json'] = false;
			$res['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->mg->LogError(current_url(),  $e->getMessage());
		}
		header('Content-Type: application/json');
		echo json_encode($res);
	}
	public function saveSwap()
	{
		cek_session($this->idMenu);
		$res = [];
		$res['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$now = date('Y-m-d H:i:s');
			$input = $this->input;
			$id = $input->get('id');
			$idPersonel = $input->get('idPersonel');
			$cekShift = $this->mg->getWhere('hrm_staff_shifts', ['id' => $id])->row_array();
			$staff = $this->mg->getWhere('hrm_staffprofile', ['id_personel' => $idPersonel])->row_array();
			$cekStaffChange = $this->mg->getWhere('hrm_staff_shifts', [
				'staff_id'	=> $staff['id'],
				'date'		=> $cekShift['date']
			])->row_array();
			if ($cekShift && $cekStaffChange) {
				$this->mg->UpdateData('hrm_staff_shifts', [
					'staff_id'		=> $cekShift['staff_id'],
					'updated_at'	=> $now
				], ['id' => $cekStaffChange['id']]);
				$this->mg->UpdateData('hrm_staff_shifts', [
					'staff_id'		=> $cekStaffChange['staff_id'],
					'updated_at'	=> $now
				], ['id' => $cekShift['id']]);
				$this->mg->LogActivity('Process Swap Staff Shift : ' . $cekShift['id']);
				$this->db->trans_complete();
				$this->db->trans_commit();
				$res['remarks'] = 'Successfully swaped data';
			} else {
				$res['status_json'] = false;
				$res['remarks'] = 'Data not found';
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$res['status_json'] = false;
			$res['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->mg->LogError(current_url(),  $e->getMessage());
		}
		header('Content-Type: application/json');
		echo json_encode($res);
	}
	public function saveEdit()
	{
		cek_session($this->idMenu);
		$res = [];
		$res['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$now = date('Y-m-d H:i:s');
			$input = $this->input;
			$id = $input->get('id');
			$shift = $input->get('shift');
			$cek = $this->mg->getWhere('hrm_staff_shifts', ['id' => $id])->row_array();
			if ($cek) {
				$this->mg->UpdateData('hrm_staff_shifts', [
					'shift_id'		=> $shift,
					'updated_at'	=> $now
				], ['id' => $cek['id']]);
				$this->mg->LogActivity('Process Edit Staff Shift : ' . $cek['date']);
				$this->db->trans_complete();
				$this->db->trans_commit();
				$res['remarks'] = 'Successfully updated data';
			} else {
				$res['status_json'] = false;
				$res['remarks'] = 'Data not found';
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$res['status_json'] = false;
			$res['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->mg->LogError(current_url(),  $e->getMessage());
		}
		header('Content-Type: application/json');
		echo json_encode($res);
	}
	public function getWorkHour()
	{
		cek_session($this->idMenu);
		$input = $this->input;
		$periode = ($input->get('periode')) ? $input->get('periode') : $input->post('periode');
		$allStaff = $this->ms->getAllStaff();
		for ($i = 0; $i < count($allStaff); $i++) {
			$allStaff[$i]['nama'] = $allStaff[$i]['first_name'] . ' ' . $allStaff[$i]['last_name'];
			$allStaff[$i]['jamKerja'] = $this->ms->getWorkHour($periode, $allStaff[$i]['id']);
			if (!$allStaff[$i]['jamKerja']) {
				$allStaff[$i]['jamKerja'] = '0 Hour';
			} else {
				$total = 0;
				foreach ($allStaff[$i]['jamKerja'] as $jamKerja) {
					$mulai = date('H', strtotime($jamKerja['start_time']));
					$akhir = date('H', strtotime($jamKerja['end_time']));
					$total += ($jamKerja['shift'] == 3) ? ($akhir + 12) - ($mulai - 12) : $akhir - $mulai;
				}
				$allStaff[$i]['jamKerja'] = $total . ' Hour';
			}
		}
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> true,
			'data'			=> $allStaff
		]);
	}
}
