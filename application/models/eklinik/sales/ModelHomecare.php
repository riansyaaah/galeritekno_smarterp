<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelHomecare extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function getHomecare($where = "")
	{
		return $this->db->query("SELECT id, tipe, noinvoice, nama, idperusahaan, nomorhp, email, alamat,latitude, longitude, jumlahpasienpcr, jumlahpasienrapid,  jumlahpasienantigen, jumlahpasienpaket, tanggalkunjungan, jamkunjungan, totalharga, isproses, idpayment, statustransaksi,created_date, confirm_date, idcabang, idpaket FROM reservasi  $where ")->result_array();
	}

	function get_all()
	{
		$this->db->select('*');
		$this->db->from('reservasi');
		return $this->db->get()->result_array();
	}

	function getHomecareById($id)
	{
		$this->db->select('*');
		$this->db->from('reservasi');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getDetailHomecare($id)
	{
		$this->db->select('*');
		$this->db->from('regperiksa');
		$this->db->where('idhomecare', $id);
		return $this->db->get()->result_array();
	}

	function getInstansiById($id)
	{
		$this->db->select('*');
		$this->db->from('masterinstansi');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getUserById($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getCares()
	{
		$this->db->select('*');
		$this->db->from('jenispemeriksaan');
		$this->db->order_by('keterangan', 'ASC');
		return $this->db->get()->result_array();
	}

	function getNoReg($noReg)
	{
		$this->db->select('nomorregistrasi');
		$this->db->from('regperiksa');
		$this->db->like('nomorregistrasi', $noReg, 'both');
		return $this->db->get()->row_array();
	}

	function getJenisPemeriksaanDetailById($id)
	{
		$this->db->select('*');
		$this->db->from('jenispemeriksaandetail');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}

	function getAgencies()
	{
		$this->db->select('*');
		$this->db->from('masterinstansi');
		$this->db->order_by('instansi', 'ASC');
		return $this->db->get()->result_array();
	}

	function getMedicalFacilities()
	{
		$this->db->select('*');
		$this->db->from('regfaskes');
		$this->db->order_by('namafaskes', 'ASC');
		return $this->db->get()->result_array();
	}

	function getMarketers()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('level', 'Marketing');
		$this->db->order_by('nama', 'ASC');
		return $this->db->get()->result_array();
	}

	// =======================================================


	function getCorporate($where = "")
	{
		return $this->db->query("SELECT id, tanggalregistrasi, instansi, alamat, no_telp, pic_m,pic_nama, pic_nomorhp, pic_email, hargasm, hargass, hargasb, hargasa, hargara, limitbiaya FROM masterinstansi  $where ")->result_array();
	}

	function getSingleHomecareJoin($where)
	{
		return $this->db->query("SELECT * FROM `reservasi` r LEFT JOIN masterinstansi m ON m.id = r.idperusahaan $where ")->row();
	}

	function getInstansiSelect2($where, $orderby)
	{
		return $this->db->query("SELECT id as user_id, nama
                                    FROM `users` 
                                    $where ORDER BY $orderby")->result_array();
	}

	function getMarketing($where)
	{
		return $this->db->query(" SELECT m.user_id,m.staff_id,s.first_name,s.last_name,m.username,m.email,m.password,m.is_active, s.departement_id, d.department
                FROM users_smarterp m 
                LEFT JOIN hrm_staffprofile s ON m.staff_id = s.id
                LEFT JOIN hrm_departments d ON s.departement_id = d.id  
                $where ORDER BY m.user_id ASC")->result_array();
	}
}
