<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelLatenessPosition extends CI_Model
{

	public $table = 'hrm_late_positions';
	public $id = 'id';
	public $order = 'ASC';


	function __construct()
	{
		parent::__construct();
	}

	public function getLatePosition($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_late_positions $where ")->result_array();
	}

	function getLatePositionById($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where($this->id, $id);
		$this->db->where('deleted_at', NULL);
		return $this->db->get()->row_array();
	}

	function getPositionByDurationId($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('duration_id', $id);
		$this->db->where('deleted_at', NULL);
		return $this->db->get()->result_array();
	}

	// get all
	function get_all()
	{
		$this->db->order_by($this->id, $this->order);
		$this->db->where('deleted_at', NULL);
		return $this->db->get($this->table)->result_array();
	}

	// get data by id
	function get_by_id($id)
	{
		$this->db->where($this->id, $id);
		$this->db->where('deleted_at', NULL);
		return $this->db->get($this->table)->row_array();
	}

	// insert data
	function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	// update data
	function update($id, $data)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
	}

	// (soft) delete data
	function delete($id, $data)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
	}
}
