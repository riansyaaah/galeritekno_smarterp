<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelLaboratorium extends CI_Model
{
  public $table = 'ekl_pasienlaboratorium as lab';
  public $id = 'lab.id';
  public $order = 'DESC';

  public function __construct()
  {
    parent::__construct();
  }

  // get all data
  function get_all()
  { 
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result_array();
  }

  // get all data + Join With ekl_regpasien
  public function getLaboratorium()
  {
    $this->db->select('lab.id, reg.norm, reg.nomorregistrasi, reg.nama, reg.tempatlahir, reg.tanggallahir, reg.jeniskelamin,reg.alamat ');
    $this->db->from($this->table);
    $this->db->join('ekl_regpasien reg', 'reg.nomorregistrasi=lab.noregistrasi', 'left');
    $this->db->order_by('reg.tanggalregistrasi', $this->order);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }

  // get data based on id
  function get_by_id($id)
  {
    $this->db->select('reg.norm, reg.nomorregistrasi, reg.nik, reg.nama, reg.tempatlahir, reg.tanggallahir, reg.jeniskelamin,reg.alamat,reg.umur, lab.*, dok.nama as namadokterpemeriksa, per.nama as namapetugas');
    $this->db->join('ekl_regpasien reg', 'reg.nomorregistrasi=lab.noregistrasi', 'left');
    $this->db->join('ekl_dokter dok', 'lab.dokterpemeriksa=dok.id', 'left');
    $this->db->join('ekl_perawat per', 'lab.petugas=per.id', 'left');
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

  // delete data
  function delete($id)
  {
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
  }
    
    public function InsertData($table_name,$data){
		return $this->db->insert($table_name, $data);
	}
	
	public function UpdateData($table, $data, $where){
		return $this->db->update($table, $data, $where);
	}
}

/**
 * ==============================================================================================
 * End Of "ModelAudiometri.php"
 * Location: ./application/models/eklinik/ModelAudiometri.php 
 * Edited by: Adist Vieri Alamsyah
 * Last Edited : 12 Mar 2021 - 15:30
 */
