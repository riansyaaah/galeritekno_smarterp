<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelBpjs extends CI_Model
{

	public $table = 'hrm_bpjs';
	public $id = 'id';
	public $order = 'ASC';


	function __construct()
	{
		parent::__construct();
	}


	// Bpjss
	public function getBpjs($where = '')
	{
		return $this->db->query("SELECT * FROM hrm_bpjs $where ")->result_array();
	}

	function getBpjsById($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	// get all
	function get_all()
	{
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->table)->result_array();
	}


	// get data by id
	function get_by_id($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row_array();
	}

	// update data
	function update($id, $data)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
	}
}
