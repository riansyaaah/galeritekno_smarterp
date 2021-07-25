<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelTreadmill extends CI_Model
{
  public $table = 'ekl_pasientreadmill as trm';
  public $id = 'trm.id';
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
  public function getTreadmill()
  {
    $this->db->select('trm.id, reg.norm, reg.nomorregistrasi, reg.nama, reg.tempatlahir, reg.tanggallahir, reg.jeniskelamin,reg.alamat ');
    $this->db->from($this->table);
    $this->db->join('ekl_regpasien reg', 'reg.nomorregistrasi=trm.noregistrasi', 'left');
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
    $this->db->select('reg.norm, reg.nomorregistrasi, reg.nik, reg.nama, reg.tempatlahir, reg.tanggallahir, reg.jeniskelamin,reg.alamat,reg.umur, trm.*, dok.nama as namadokterpemeriksa, per.nama as namapetugas');
    $this->db->join('ekl_regpasien reg', 'reg.nomorregistrasi=trm.noregistrasi', 'left');
    $this->db->join('ekl_dokter dok', 'trm.dokterpemeriksa=dok.id', 'left');
    $this->db->join('ekl_perawat per', 'trm.petugas=per.id', 'left');
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
}

/**
 * ==============================================================================================
 * End Of "ModelTreadmill.php"
 * Location: ./application/models/eklinik/ModelTreadmill.php 
 * Edited by: Adist Vieri Alamsyah
 * Last Edited : 12 Mar 2021 - 15:30
 */
