<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelWalkInDriveThru extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function getRegperiksa($now) {
		$btn = 'CONCAT(\'<button class="btn btn-block btn-success btn-sm" onclick="renderDetail(\', regperiksa.id, \')">Detail</button> <button class="btn btn-warning btn-block btn-sm" onclick="log(\', regperiksa.id, \')">Log</button> <button class="btn btn-danger btn-block btn-sm" onclick="renderHapusModal(\', regperiksa.id,\')">Hapus</button>\') AS btn';
		return $this->db->select('ROW_NUMBER() OVER() AS no, CONCAT(regperiksa.tanggalkunjungan, \'-\', regperiksa.jamkunjungan) AS waktuKunjungan, regperiksa.nomorregistrasi, regperiksa.nik, regperiksa.nama, CONCAT(regperiksa.tempatlahir, \', \', regperiksa.tanggallahir, \'/\', regperiksa.jeniskelamin) AS ttljk, regperiksa.carabayar, regperiksa.statushadir, tbl_cabang.nama AS cabang, jenispemeriksaandetail.detailketerangan, masterinstansi.instansi, CONCAT(hrm_staffprofile.first_name, \' \', hrm_staffprofile.last_name) AS picMarketing, '.$btn)
			->join('jenispemeriksaandetail', 'jenispemeriksaandetail.id = regperiksa.idjenispemeriksaandetail')
			->join('masterinstansi', 'masterinstansi.id = regperiksa.idinstansi')
			->join('hrm_staffprofile', 'hrm_staffprofile.id = regperiksa.pic_m')
			->join('tbl_cabang', 'tbl_cabang.id = regperiksa.idcabang')
			->where('regperiksa.tanggalkunjungan', $now)
			->where('idpayment !=', '')
			->where('regperiksa.trash !=', 1)
			->where('statustransaksi !=', 'Transakasi dibatalkan')
			->order_by('regperiksa.tanggalkunjungan', 'desc')
			->order_by('regperiksa.jamkunjungan', 'desc')
			->get('regperiksa')
			->result_array();
	}
	public function getAllLog($regperiksa, $userId) {
		return $this->db->select('ROW_NUMBER() OVER() AS no, logaktivitas.*')
			->like('logaktivitas.aktivitas', $regperiksa['nik'])
			->or_like('logaktivitas.aktivitas', $regperiksa['nama'])
			->or_like('logaktivitas.aktivitas', $regperiksa['nomorregistrasi'])
			->or_like('logaktivitas.aktivitas', $regperiksa['idpayment'])
			->where('logaktivitas.iduser', $userId)
			->get('logaktivitas')
			->result_array();
	}
	public function getRegperiksaFilter($form) {
		$btn = 'CONCAT(\'<button class="btn btn-block btn-success btn-sm" onclick="renderDetail(\', regperiksa.id, \')">Detail</button> <button class="btn btn-warning btn-block btn-sm" onclick="log(\', regperiksa.id, \')">Log</button> <button class="btn btn-danger btn-block btn-sm" onclick="renderHapusModal(\', regperiksa.id,\')">Hapus</button>\') AS btn';
		$this->db->select('ROW_NUMBER() OVER() AS no, CONCAT(regperiksa.tanggalkunjungan, \'-\', regperiksa.jamkunjungan) AS waktuKunjungan, regperiksa.nomorregistrasi, regperiksa.nik, regperiksa.nama, CONCAT(regperiksa.tempatlahir, \', \', regperiksa.tanggallahir, \'/\', regperiksa.jeniskelamin) AS ttljk, regperiksa.carabayar, regperiksa.statushadir, tbl_cabang.nama AS cabang, jenispemeriksaandetail.detailketerangan, masterinstansi.instansi, CONCAT(hrm_staffprofile.first_name, \' \', hrm_staffprofile.last_name) AS picMarketing, '.$btn)
			->join('jenispemeriksaandetail', 'jenispemeriksaandetail.id = regperiksa.idjenispemeriksaandetail')
			->join('masterinstansi', 'masterinstansi.id = regperiksa.idinstansi')
			->join('hrm_staffprofile', 'hrm_staffprofile.id = regperiksa.pic_m')
			->join('tbl_cabang', 'tbl_cabang.id = regperiksa.idcabang')
			->where('idpayment !=', '')
			->where('regperiksa.trash !=', 1)
			->where('statustransaksi !=', 'Transakasi dibatalkan');
		if($form['instansi']) $this->db->where('masterinstansi.id', $form['instansi']);
		if($form['picMarketing']) $this->db->where('hrm_staffprofile.id', $form['picMarketing']);
		if($form['paketPemeriksaan']) $this->db->where('jenispemeriksaandetail.id', $form['paketPemeriksaan']);
		if($form['cabang']) $this->db->where('tbl_cabang.id', $form['cabang']);
		if($form['statusHasil']) $this->db->where('regperiksa.statuskirimhasil', $form['statusHasil']);
		return $this->db->where('regperiksa.tanggalkunjungan BETWEEN \''.$form['from'].'\' AND \''.$form['to'].'\'')
			->order_by('regperiksa.tanggalkunjungan', 'desc')
			->order_by('regperiksa.jamkunjungan', 'desc')
			->get('regperiksa')
			->result_array();
	}
	public function getJenisPemeriksaan($idCabang) {
		return $this->db->select('jenispemeriksaandetail.*')
			->join('jenispemeriksaan', 'jenispemeriksaan.id = jenispemeriksaandetail.idjenispemeriksaan')
			->where('jenispemeriksaan.idcabang', $idCabang)
			->get('jenispemeriksaandetail')
			->result_array();
	}
	public function getJenisPemeriksaanSingle($idjenispemeriksaandetail){
        return $this->db->select('jpd.id, jpd.idjenispemeriksaan, jpd.detailcode, jpd.detailketerangan, jpd.hargadetail, jp.jenis, jp.keterangan')
        	->join('jenispemeriksaan AS jp', 'jp.id = jpd.idjenispemeriksaan')
        	->where('jpd.id', $idjenispemeriksaandetail)
        	->get('jenispemeriksaandetail AS jpd')
        	->row_array();
    }
    public function getTotHarga($noinvoice) {
    	return $this->db->select('SUM(detailharga) AS totharga')
    		->where('idpayment', $noinvoice)
    		->group_by('idpayment')
    		->get('regperiksa')
    		->row_array();
    }
    public function getMasterJam($jam, $idpemeriksaandetail){
        return $this->db->get_where('masterjam', [
        	'idpemeriksaandetail'	=> $idpemeriksaandetail,
        	'jam'					=> $jam
        ])->row();
    }
    public function getAntrian($tanggal, $jam, $idpemeriksaandetail){
        return $this->db->select('antrian_ke, kuota')
        	->where('jam', $jam)
        	->where('tanggal', $tanggal)
        	->where('idpemeriksaandetail', $idpemeriksaandetail)
        	->order_by('antrian_ke', 'desc')
        	->get('antrian')
        	->row();
    }
	public function checkAntrianReg($tanggalkunjungan, $jamkunjungan, $antrian_ke, $idjenispemeriksaandetail){
        return $this->db->where('tanggalkunjungan', $tanggalkunjungan)
        	->where('jamkunjungan', $jamkunjungan)
        	->where('antrian_ke', $antrian_ke)
        	->where('idjenispemeriksaandetail', $idjenispemeriksaandetail)
        	->where('statustransaksi !=', 'Transaksi dibatalkan')
        	->limit(1)
        	->get('regperiksa')
        	->row();
    }
    public function checkNoReg($nomorregistrasi){
        return $this->db->select('nomorregistrasi')
        	->where('nomorregistrasi', $nomorregistrasi)
        	->limit(1)
        	->get('regperiksa')
        	->row();
    }
    public function checkNoInv($noinvoice){
        return $this->db->select('noinvoice')
        	->where('noinvoice', $noinvoice)
        	->limit(1)
        	->get('regperiksa')
        	->row();
    }
    public function getRegperiksaSingle($id) {
    	return $this->db->select('regperiksa.*, payment.va_number, payment.harga, payment.remarks')
    		->join('payment', 'payment.transaction_id = regperiksa.idpayment')
    		->where('regperiksa.id', $id)
    		->get('regperiksa')
    		->row_array();
    }
    public function getRegperiksaIdpayment($idpayment) {
    	$btn = 'CONCAT(\'<button class="btn btn-primary btn-sm btn-block" onclick="renderCetakBarcode(\', regperiksa.id, \')">Barcode</button> <button class="btn btn-info btn-sm btn-block" onclick="renderEditModal(\', regperiksa.id, \')">Edit</button> <button class="btn btn-danger btn-sm btn-block" onclick="renderDeleteModal(\', regperiksa.id, \')">Hapus</button> <button class="btn btn-success btn-sm btn-block" onclick="renderHadirModal(\', regperiksa.id, \')">Hadir</button> <button class="btn btn-warning btn-sm btn-block" onclick="renderRescheduleModal(\', regperiksa.id, \')">Reschedule</button>\') AS btn';
    	return $this->db->select('regperiksa.nomorregistrasi, regperiksa.antrian_ke, regperiksa.tipekunjungan, regperiksa.nama, regperiksa.jeniskelamin, regperiksa.tanggallahir, regperiksa.nomorhp, regperiksa.carabayar, regperiksa.statushadir, ROW_NUMBER() OVER() AS no, CONCAT(jenispemeriksaan.keterangan, \' (\', regperiksa.pemeriksaandetail, \')\') AS jenis, CONCAT(regperiksa.tanggalkunjungan, \', \', regperiksa.jamkunjungan) AS waktuKunjungan, '.$btn)
    		->join('jenispemeriksaan', 'jenispemeriksaan.id = regperiksa.idpemeriksaan')
    		->where('regperiksa.idpayment', $idpayment)
    		->where('regperiksa.trash !=', 1)
    		->get('regperiksa')
    		->result_array();
    }
    public function getAntrianAkhir($tanggalkunjungan, $jamkunjungan, $idjenispemeriksaandetail) {
    	return $this->db->select('antrian_ke')
    		->where('tanggal', $tanggalkunjungan)
    		->where('jam', $jamkunjungan)
    		->where('idpemeriksaandetail', $idjenispemeriksaandetail)
    		->get('antrian')
    		->row_array();
    }
    public function getKuotaJam($jamkunjungan, $idjenispemeriksaandetail) {
		return $this->db->select('kuota')
			->where('jam', $jamkunjungan)
			->where('idpemeriksaandetail', $idjenispemeriksaandetail)
			->get('masterjam')
			->row_array();
    }
    public function getPasien($idpayment) {
    	return $this->db->select('COUNT(regperiksa.id) AS jumlah, SUM(regperiksa.detailharga) AS total, tbl_cabang.titimangsa,tbl_cabang.ttdfinance,tbl_cabang.ttdnonmaterai, tbl_cabang.namafinance')
    		->join('jenispemeriksaandetail', 'regperiksa.idjenispemeriksaandetail = jenispemeriksaandetail.id')
            ->join('tbl_cabang', 'regperiksa.idcabang = tbl_cabang.id')
    		->where('regperiksa.idpayment', $idpayment)
    		->group_by('regperiksa.idpayment')
    		->get('regperiksa')
    		->row_array();
    }
    public function getK($idpayment) {
    	return $this->db->select('nama,pemeriksaandetail,jenispemeriksaandetail.hargadetail,regperiksa.detailharga')
    		->join('jenispemeriksaandetail', 'regperiksa.idjenispemeriksaandetail = jenispemeriksaandetail.id')
    		->where('idpayment', $idpayment)
    		->get('regperiksa')
    		->result_array();
    }
    public function getListPemeriksaan($idpayment) {
    	return $this->db->select('COUNT(regperiksa.id) AS jumlah, regperiksa.pemeriksaandetail, jenispemeriksaandetail.detailketerangan')
    		->join('jenispemeriksaandetail', 'regperiksa.idjenispemeriksaandetail = jenispemeriksaandetail.id')
    		->where('idpayment', $idpayment)
    		->group_by('regperiksa.idjenispemeriksaandetail')
    		->get('regperiksa')
    		->result_array();
    }
    public function cekAntrian($idpasien) {
    	return $this->db->select('antrian_ke, tipekunjungan, idinstansi, carabayar')
    		->where('id', $idpasien)
    		->get('regperiksa')
    		->row_array();
    }
    public function getPaketPemeriksaan() {
    	return $this->db->select('jenispemeriksaandetail.id, CONCAT(jenispemeriksaandetail.detailketerangan, \' - \', tbl_cabang.nama, \' (\', tbl_cabang.tipecabang, \')\') AS namaPaket')
    		->join('jenispemeriksaan', 'jenispemeriksaan.id = jenispemeriksaandetail.idjenispemeriksaan')
    		->join('tbl_cabang', 'tbl_cabang.id = jenispemeriksaan.idcabang')
    		->get('jenispemeriksaandetail')
    		->result_array();
    }
    public function getCabang() {
    	return $this->db->select('id, CONCAT(nama, \' (\', tipecabang, \')\') AS namaCabang')
    		->get('tbl_cabang')
    		->result_array();
    }
}