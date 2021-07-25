<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelThorax extends CI_Model
{
  public $table = 'ekl_pasienthorax as thor';
  public $id = 'thor.id';
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
  public function getThorax()
  {
    $this->db->select('thor.id, reg.norm, reg.nomorregistrasi, reg.nama, reg.tempatlahir, reg.tanggallahir, reg.jeniskelamin,reg.alamat ');
    $this->db->from($this->table);
    $this->db->join('ekl_regpasien reg', 'reg.nomorregistrasi=thor.noregistrasi', 'left');
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
    $this->db->select('reg.norm, reg.nomorregistrasi, reg.nik, reg.nama, reg.tempatlahir, reg.tanggallahir, reg.jeniskelamin,reg.alamat,reg.umur, thor.*, dok.nama as namadokterpemeriksa, per.nama as namapetugas');
    $this->db->join('ekl_regpasien reg', 'reg.nomorregistrasi=thor.noregistrasi', 'left');
    $this->db->join('ekl_dokter dok', 'thor.dokterpemeriksa=dok.id', 'left');
    $this->db->join('ekl_perawat per', 'thor.petugas=per.id', 'left');
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
 * End Of "ModelThorax.php"
 * Location: ./application/models/eklinik/radiologi/ModelThorax.php 
 * Edited by: Adist Vieri Alamsyah
 * Last Edited : 12 Mar 2021 - 16:50
 */
