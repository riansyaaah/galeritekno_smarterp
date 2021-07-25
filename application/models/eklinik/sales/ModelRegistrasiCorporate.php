<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelRegistrasiCorporate extends CI_Model {
	public function __construct() {
		parent::__construct();
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
    public function getPayment($idinvoice) {
    	$this->db->where('id', $idinvoice)
    		->order_by('id', 'desc')
    		->limit(1)
    		->get('payment')
    		->result_array();
    }
    public function getTotHarga($noinvoice) {
    	$this->db->select('SUM(detailharga) as totharga')
    		->where('idpayment', $noinvoice)
    		->group_by('idpayment')
    		->get('regperiksa')
    		->result_array();
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
    public function InsertData($table_name,$data){
		return $this->db->insert($table_name, $data);
	}
	public function UpdateData($table, $data, $where){
		return $this->db->update($table, $data, $where);
	}
	function checkAntrianReg($tanggalkunjungan, $jamkunjungan, $antrian_ke, $idjenispemeriksaandetail){
        return $this->db->where('tanggalkunjungan', $tanggalkunjungan)
        	->where('jamkunjungan', $jamkunjungan)
        	->where('antrian_ke', $antrian_ke)
        	->where('idjenispemeriksaandetail', $idjenispemeriksaandetail)
        	->where('statustransaksi !=', 'Transaksi dibatalkan')
        	->limit(1)
        	->get('regperiksa')
        	->row();
    }
    function checkNoReg($nomorregistrasi){
        return $this->db->select('nomorregistrasi')
        	->where('nomorregistrasi', $nomorregistrasi)
        	->limit(1)
        	->get('regperiksa')
        	->row();
    }
    function checkNoInv($noinvoice){
        return $this->db->select('noinvoice')
        	->where('noinvoice', $noinvoice)
        	->limit(1)
        	->get('regperiksa')
        	->row();
    }
}
