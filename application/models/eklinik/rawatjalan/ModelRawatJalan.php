<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelRawatJalan extends CI_Model
{
  public $table = 'ekl_pasienrawatjalan as rwj';
  public $id = 'rwj.id';
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
  public function getRawatjalan()
  {
    $this->db->select('pol.nama as namapoliklinik,dok.nama as namadokter, rwj.id, reg.norm, reg.nomorregistrasi, reg.nama, reg.tempatlahir, reg.tanggallahir, reg.jeniskelamin,reg.alamat ');
    $this->db->from($this->table);
    $this->db->join('ekl_regpasien reg', 'reg.nomorregistrasi=rwj.noregistrasi', 'left');
    $this->db->join('ekl_poliklinik pol', 'rwj.poliklinik_id=pol.id', 'left');
    $this->db->join('ekl_dokter dok', 'rwj.dokter_id=dok.id', 'left');
    $this->db->order_by('reg.tanggalregistrasi', $this->order);
    $query = $this->db->get();
    if ($query->num_rows() != 0) {
      return $query->result_array();
    } else {
      return false;
    }
  }
function getItemperiksa($where = ""){
        return $this->db->query("SELECT ekl_itemperiksa.*,REPLACE(id,concat(id_paren,'.'),'') as urut FROM ekl_itemperiksa $where ")->result_array();
    }
    public function getLabdetail($where = '')
    {
        return $this->db->query("SELECT * FROM ekl_pasienlaboratorium_detail $where ")->result_array();
    }
  // get data based on id
  function get_by_id($id)
  {
    $this->db->select('reg.norm, reg.nomorregistrasi, reg.nik, reg.nama, reg.tempatlahir, reg.tanggallahir, reg.jeniskelamin,reg.alamat,reg.umur, rwj.*, dok.nama as namadokter, per.nama as namapetugas,pol.nama as namapoliklinik, fisik.tinggibadan as f_tinggibadan, fisik.beratbadan as f_beratbadan, fisik.detakjantung as f_detakjantung, fisik.tekanandarah as f_tekanandarah, fisik.suhubadan as f_suhubadan, fisik.nafas as f_nafas, fisik.keluhan as f_keluhan, fisik.riwayatpenyakit as f_riwayatpenyakit, fisik.riwayatpenyakitkeluarga as f_riwayatpenyakitkeluarga, soap.tanggal as soap_tanggal, soap.subject as soap_subject, soap.object as soap_object, soap.assesment as soap_assesment, soap.plan as soap_plan');
    $this->db->join('ekl_regpasien reg', 'reg.nomorregistrasi=rwj.noregistrasi', 'left');
    $this->db->join('ekl_dokter dok', 'rwj.dokter_id=dok.id', 'left');
      $this->db->join('ekl_poliklinik pol', 'rwj.poliklinik_id=pol.id', 'left');
    $this->db->join('ekl_perawat per', 'rwj.petugas=per.id', 'left');
    $this->db->join('ekl_pasienrawatjalan_fisik fisik', 'rwj.noregistrasi=fisik.noregistrasi', 'left');
    $this->db->join('ekl_pasienrawatjalan_soap soap', 'rwj.noregistrasi=soap.noregistrasi', 'left');
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
 * End Of "ModelThorax.php"
 * Location: ./application/models/eklinik/radiologi/ModelThorax.php 
 * Edited by: Adist Vieri Alamsyah
 * Last Edited : 12 Mar 2021 - 16:50
 */
