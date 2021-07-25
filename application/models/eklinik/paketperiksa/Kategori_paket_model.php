<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_paket_model extends CI_Model
{
  public $table = 'ekl_kategoripaket';
  public $id = 'id';
  public $cat = 'namakategori';
  public $order = 'DESC';


  // get all data
  function get_all()
  {
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($this->table)->result_array();
  }

  // get data based on id
  function get_by_id($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->get($this->table)->result_array();
  }

  function get_category_by_id($id)
  {
    $this->db->where($this->cat, $id);
    return $this->db->get($this->table)->result_array();
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
 * End Of "Kategori_paket_model.php"
 * Location: ./application/models/eklinik/Kategori_paket_model.php 
 * Edited by: Adist Vieri Alamsyah
 * Last Edited : 5 Mar 2021 - 18:30
 */
