<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelMcu extends CI_Model
{
  public $table = 'ekl_pasienmcu as mcu';
  public $id = 'mcu.id';
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
  public function getMcu()
  {
    $this->db->select('pkt.namapaket, mcu.id, reg.norm, reg.nomorregistrasi, reg.nama, reg.tempatlahir, reg.tanggallahir, reg.jeniskelamin,reg.alamat,reg.umur');
    $this->db->from($this->table);
    $this->db->join('ekl_regpasien reg', 'reg.nomorregistrasi=mcu.noregistrasi', 'left');
    $this->db->join('ekl_paketmcu pkt', 'pkt.id=mcu.paketmcu_id', 'left');
    $this->db->where('reg.jenis_pasien', 'umum');
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
    $this->db->select('reg.norm, reg.nomorregistrasi, reg.nik, reg.nama, reg.tempatlahir, reg.tanggallahir, reg.jeniskelamin,reg.alamat,reg.umur, mcu.*');
    $this->db->join('ekl_regpasien reg', 'reg.nomorregistrasi=mcu.noregistrasi', 'left');
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->row_array();
  }

  function getCorporate($where = "")
  {
    return $this->db->query("SELECT * FROM tbl_client $where;")->result_array();
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
 * End Of "ModelEkg.php"
 * Location: ./application/models/eklinik/ModelEkg.php 
 * Edited by: Adist Vieri Alamsyah
 * Last Edited : 12 Mar 2021 - 15:30
 */
