<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelShifting extends CI_Model
{
	public function getShift($form)
	{
		return $this->db->select('hrm_staff_shifts.staff_id, hrm_staff_shifts.id, hrm_staff_shifts.date, hrm_shifts.shift, hrm_staffprofile.id_personel, hrm_staffprofile.first_name, hrm_staffprofile.last_name, hrm_positions.position, hrm_departments.department')
			->join('hrm_shifts', 'hrm_shifts.id = hrm_staff_shifts.shift_id')
			->join('hrm_staffprofile', 'hrm_staffprofile.id = hrm_staff_shifts.staff_id')
			->join('hrm_positions', 'hrm_positions.id = hrm_staffprofile.position_id')
			->join('hrm_departments', 'hrm_departments.id = hrm_staffprofile.departement_id')
			->where('hrm_staff_shifts.deleted_at', null)
			->where('hrm_staff_shifts.shift_id', $form['shift_id'])
			->where('hrm_staff_shifts.date BETWEEN \'' . $form['start_date'] . '\' AND \'' . $form['end_date'] . '\'')
			->get('hrm_staff_shifts')
			->result_array();
	}
	public function getAllStaffShift($id)
	{
		return $this->db->select('hrm_staffprofile.*, hrm_departments.department, hrm_positions.position')
			->join('hrm_departments', 'hrm_departments.id = hrm_staffprofile.departement_id')
			->join('hrm_positions', 'hrm_positions.id = hrm_staffprofile.position_id')
			->where_not_in('hrm_staffprofile.id', ($id) ? $id : 0)
			->where('hrm_staffprofile.status', 1)
			->get('hrm_staffprofile')
			->result_array();
	}
	public function getStaffShift($id, $idPosition)
	{
		return $this->db->select('hrm_staffprofile.*, hrm_positions.position, hrm_departments.department')
			->join('hrm_positions', 'hrm_positions.id = hrm_staffprofile.position_id')
			->join('hrm_departments', 'hrm_departments.id = hrm_staffprofile.departement_id')
			->where_in('hrm_staffprofile.id', ($id) ? $id : 0)
			->where('hrm_staffprofile.status', 1)
			->where('hrm_positions.id', $idPosition)
			->get('hrm_staffprofile')
			->result_array();
	}
	public function getShiftDate($form)
	{
		return $this->db->select('hrm_staff_shifts.staff_id')
			->join('hrm_shifts', 'hrm_shifts.id = hrm_staff_shifts.shift_id')
			->where('hrm_staff_shifts.deleted_at', null)
			->where('hrm_staff_shifts.date BETWEEN \'' . $form['start_date'] . '\' AND \'' . $form['end_date'] . '\'')
			->get('hrm_staff_shifts')
			->result_array();
	}
	public function getShiftDateEdit($date)
	{
		return $this->db->select('hrm_staff_shifts.staff_id')
			->join('hrm_shifts', 'hrm_shifts.id = hrm_staff_shifts.shift_id')
			->where('hrm_staff_shifts.deleted_at', null)
			->where('hrm_staff_shifts.date', $date)
			->get('hrm_staff_shifts')
			->result_array();
	}
	public function getShiftById($id)
	{
		return $this->db->select('hrm_staffprofile.id_personel, hrm_staffprofile.first_name, hrm_staffprofile.last_name, hrm_staff_shifts.*, hrm_shifts.shift')
			->join('hrm_shifts', 'hrm_shifts.id = hrm_staff_shifts.shift_id')
			->join('hrm_staffprofile', 'hrm_staffprofile.id = hrm_staff_shifts.staff_id')
			->where('hrm_staff_shifts.id', $id)
			->get('hrm_staff_shifts')
			->row_array();
	}
	public function getPeriode()
	{
		return json_decode(file_get_contents(base_url('hrm/payroll/periods/selectperiod')));
	}
	public function getWorkHour($periode, $idStaff)
	{
		return $this->db->query("SELECT hrm_staff_shifts.date, hrm_shifts.shift, hrm_shifts.start_time, hrm_shifts.end_time FROM hrm_staff_shifts JOIN hrm_shifts ON hrm_shifts.id = hrm_staff_shifts.shift_id WHERE hrm_staff_shifts.staff_id = $idStaff AND hrm_staff_shifts.period_id = $periode AND hrm_staff_shifts.deleted_at IS NULL")
			->result_array();
	}
	public function getAllStaff()
	{
		return $this->db->select('hrm_staffprofile.*, hrm_positions.position, hrm_departments.department')
			->join('hrm_positions', 'hrm_positions.id = hrm_staffprofile.position_id')
			->join('hrm_departments', 'hrm_departments.id = hrm_staffprofile.departement_id')
			->where('hrm_staffprofile.status', 1)
			->get('hrm_staffprofile')
			->result_array();
	}

	function getShiftByStaffId($staff_id, $date)
	{
		$this->db->select('*');
		$this->db->from('hrm_staff_shifts');
		$this->db->where('staff_id', $staff_id);
		$this->db->where('date', $date);
		return $this->db->get()->row_array();
	}

	public function getStaffShifts()
	{
		$this->db->select("staff_shift.*, profile.id_personel, staff_shift.id as staff_shift_id");
		$this->db->from('hrm_staffprofile profile');
		$this->db->join('hrm_staff_shifts staff_shift', 'staff_shift.staff_id = profile.id');
		return $this->db->get()->result_array();
	}
}
