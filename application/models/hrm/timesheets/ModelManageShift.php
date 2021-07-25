<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelManageShift extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getManageShift($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_shifts $where ")->result_array();
	}

	// get all
	function get_all()
	{
		$this->db->order_by('shift', 'ASC');
		$this->db->where('deleted_at', NULL);
		return $this->db->get('hrm_shifts')->result();
	}

	// get data by id
	function get_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->where('deleted_at', NULL);
		return $this->db->get('hrm_shifts')->row_array();
	}

	// get working hours
	function get_working_hours($shift)
	{
		return $this->db->query("SELECT timediff(end_time, start_time) FROM hrm_shifts WHERE shift ='$shift.'")->row_array();
	}

	// get start and End Time
	function get_time($shift)
	{
		$this->db->select('*');
		$this->db->from('hrm_shifts');
		$this->db->where('shift', $shift);
		return $this->db->get()->row_array();
	}
}
