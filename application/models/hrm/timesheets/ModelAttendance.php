<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelAttendance extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database();
	}

	public function getAttendance($where = '')
	{
		return $this->db->query("SELECT hrm_attendance.*,hrm_staffprofile.first_name, hrm_staffprofile.last_name, hrm_staffprofile.email, hrm_staffprofile.phone, hrm_staffprofile.address FROM hrm_attendance LEFT JOIN hrm_staffprofile ON hrm_attendance.staff_id = hrm_staffprofile.id $where;")->result_array();
	}

	public function getStaffProfile()
	{
		$this->db->select('staff.*, shift.id as shift, shift.shift AS working_shift, staff_shift.date, staff_shift.id as staff_shift_id');
		$this->db->join('hrm_staffprofile staff', 'staff.id=staff_shift.staff_id', 'left');
		$this->db->join('hrm_shifts shift', 'shift.id=staff_shift.shift_id', 'left');
		$this->db->from('hrm_staff_shifts staff_shift');
		$this->db->group_by('staff.id');
		return $this->db->get()->result_array();
	}

	function getAttendanceLog()
	{
		$this->db2->order_by('scan_date', 'ASC');
		return $this->db2->get('att_log')->result_array();
	}


	function getShiftByStaffId($id, $date)
	{
		$this->db2->select('*');
		$this->db2->from('att_log');
		$this->db2->where('pin', $id);
		$this->db2->like('scan_date', $date, 'after');
		return $this->db2->get()->row_array();
	}

	function getStaffByStaffId2($id, $date)
	{
		$this->db->select('*');
		$this->db->from('hrm_staff_attendances staff_attendance');
		$this->db->join('hrm_staff_shifts staff_shift', 'staff_shift.id=staff_attendance.staff_shift_id', 'left');
		$this->db->where('staff_attendance.staff_id', $id);
		$this->db->like('staff_shift.date', $date, 'after');
		return $this->db->get()->result_array();
	}


	function getAttendanceLogById($id, $date)
	{
		$this->db2->select('scan_date');
		$this->db2->from('att_log');
		$this->db2->where('pin', $id);
		$this->db2->like('scan_date', $date, 'after');
		return $this->db2->get()->result_array();
	}


	// insert data
	function insert($data)
	{
		$this->db->insert('hrm_staff_attendances', $data);
	}
}
