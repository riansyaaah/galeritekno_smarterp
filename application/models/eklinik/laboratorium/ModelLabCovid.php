<?php defined('BASEPATH') or exit('No direct script access allowed');
class ModelLabcovid extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getAllLaboratorium($tanggal) {
        return $this->db->select('regperiksa.tanggalkunjungan, regperiksa.nik, regperiksa.nama, regperiksa.alamat, regperiksa.jenissample, regperiksa.ncov, regperiksa.antigen, regperiksa.catatan, ROW_NUMBER() OVER() AS no, tbl_cabang.nama as namacabang, CONCAT(regperiksa.nomorregistrasi, \'-\', regperiksa.tanggalregistrasi) AS nomorregistrasi, CONCAT(jenispemeriksaandetail.detailketerangan, \' (\', regperiksa.pemeriksaandetail, \')\') AS jenis, CONCAT(regperiksa.tanggalsampling, \' \', regperiksa.jamsampling) AS tanggalsampling, CONCAT(regperiksa.tanggalperiksa, \' \', regperiksa.jamperiksa) AS tanggalperiksa, CONCAT(regperiksa.tanggalselesai, \' \', regperiksa.jamselesai) AS tanggalselesai, CONCAT(regperiksa.lgg, \' - \', regperiksa.lgm) AS lgg, CONCAT(\'<button class="btn btn-primary btn-sm" onclick="renderProses(\',regperiksa.id, \')">Proses</button>\') AS btn')
        	->join('jenispemeriksaandetail', 'regperiksa.idjenispemeriksaandetail = jenispemeriksaandetail.id')
        	->join('tbl_cabang', 'regperiksa.idcabang = tbl_cabang.id')
        	->where('regperiksa.trash !=', 1)
        	->where('regperiksa.tanggalkunjungan !=', '')
        	->where('regperiksa.carabayar !=', 'Belum Lunas')
        	->where('regperiksa.statustransaksi !=', 'Transakasi dibatalkan')
        	->where('regperiksa.tanggalkunjungan', $tanggal)
        	->get('regperiksa')
        	->result_array();
    }
    public function getAllLaboratoriumFilter($form) {
        $this->db->select('regperiksa.tanggalkunjungan, regperiksa.nik, regperiksa.nama, regperiksa.alamat, regperiksa.jenissample, regperiksa.ncov, regperiksa.antigen, regperiksa.catatan, ROW_NUMBER() OVER() AS no, tbl_cabang.nama as namacabang, CONCAT(regperiksa.nomorregistrasi, \'-\', regperiksa.tanggalregistrasi) AS nomorregistrasi, CONCAT(jenispemeriksaandetail.detailketerangan, \' (\', regperiksa.pemeriksaandetail, \')\') AS jenis, CONCAT(regperiksa.tanggalsampling, \' \', regperiksa.jamsampling) AS tanggalsampling, CONCAT(regperiksa.tanggalperiksa, \' \', regperiksa.jamperiksa) AS tanggalperiksa, CONCAT(regperiksa.tanggalselesai, \' \', regperiksa.jamselesai) AS tanggalselesai, CONCAT(regperiksa.lgg, \' - \', regperiksa.lgm) AS lgg, CONCAT(\'<button class="btn btn-primary btn-sm" onclick="renderProses(\',regperiksa.id, \')">Proses</button>\') AS btn')
        	->join('jenispemeriksaandetail', 'regperiksa.idjenispemeriksaandetail = jenispemeriksaandetail.id')
        	->join('tbl_cabang', 'regperiksa.idcabang = tbl_cabang.id')
        	->where('regperiksa.trash !=', 1)
        	->where('regperiksa.tanggalkunjungan !=', '')
        	->where('regperiksa.carabayar !=', 'Belum Lunas')
        	->where('regperiksa.statustransaksi !=', 'Transakasi dibatalkan')
        	->where('regperiksa.tanggalkunjungan', $tanggal);
        // if($form['instansi']) $this->db->where('masterinstansi.id', $form['instansi']);
		// if($form['picMarketing']) $this->db->where('hrm_staffprofile.id', $form['picMarketing']);
		// if($form['paketPemeriksaan']) $this->db->where('jenispemeriksaandetail.id', $form['paketPemeriksaan']);
		// if($form['cabang']) $this->db->where('tbl_cabang.id', $form['cabang']);
		// if($form['statusHasil']) $this->db->where('regperiksa.statuskirimhasil', $form['statusHasil']);
        return $this->db->get('regperiksa')
        	->result_array();
    }
    public function geLaboratoriumSingle($id) {
        return $this->db->select('regperiksa.*, jenispemeriksaandetail.barcode')
            ->join('jenispemeriksaandetail', 'regperiksa.idjenispemeriksaandetail = jenispemeriksaandetail.id')
            ->where('regperiksa.id', $id)
            ->get('regperiksa')
            ->row_array();
    }
    public function getJenisPemeriksaanDetail($idcabang) {
    	return $this->db->select('jenispemeriksaandetail.id, jenispemeriksaandetail.detailketerangan, jenispemeriksaandetail.barcode')
    		->join('jenispemeriksaan', 'jenispemeriksaan.id = jenispemeriksaandetail.idjenispemeriksaan')
    		->where('jenispemeriksaan.idcabang', $idcabang)
    		->get('jenispemeriksaandetail')
    		->result_array();
    }
    public function getPaketPemeriksaan() {
        return $this->db->select('jenispemeriksaandetail.id, CONCAT(jenispemeriksaandetail.detailketerangan, \' - \', tbl_cabang.nama, \' (\', tbl_cabang.tipecabang, \')\') AS namaPaket')
            ->join('jenispemeriksaan', 'jenispemeriksaan.id = jenispemeriksaandetail.idjenispemeriksaan')
            ->join('tbl_cabang', 'tbl_cabang.id = jenispemeriksaan.idcabang')
            ->get('jenispemeriksaandetail')
            ->result_array();
    }
    public function getAllCabang() {
        return $this->db->select('id, CONCAT(nama, \' (\', tipecabang, \')\') AS namaCabang')
            ->get('tbl_cabang')
            ->result_array();
    }
}