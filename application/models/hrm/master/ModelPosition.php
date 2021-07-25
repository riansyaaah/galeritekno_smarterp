<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelPosition extends CI_Model
{

	public $table = 'hrm_positions';
	public $id = 'id';
	public $order = 'ASC';

	function __construct()
	{
		parent::__construct();
	}

	public function getPosition($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_positions $where ")->result_array();
	}

	function getPositionById($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	// get all
	function get_all()
	{
		$this->db->order_by('position', $this->order);
		$this->db->where('deleted_at', NULL);
		return $this->db->get($this->table)->result_array();
	}

	// get data by id
	function get_by_id($id)
	{
		$this->db->where($this->id, $id);
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
