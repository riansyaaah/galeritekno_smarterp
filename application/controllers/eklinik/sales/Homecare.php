<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homecare extends CI_Controller
{

	function __Construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$this->load->helper(array('form', 'url'));
		$this->load->model('auth/ModelLogin');
		$this->load->model('ModelGeneral');
		$this->load->model('usermanagement/ModelUsers');
		$this->load->model('eklinik/frontoffice/ModelRegisterPasien');
		$this->load->model('eklinik/paketperiksa/ModelItemperiksa');
		$this->load->model('eklinik/sales/ModelRegistrasiCorporate');
		$this->load->model('eklinik/sales/ModelHomecare');
	}

	var $idMenu = "2325AC81-7D7F-4218-9A13-348367B47786";

	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');

		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$k = $this->ModelHomecare->getCorporate();
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Data Homecare',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
			'getitem' 		=> $this->ModelHomecare->getHomecare("order by id asc"),
			'instansi'      => $k,
			'pemerisaan_data'	=> $this->ModelHomecare->getCares(),
			'instansi_data' 	=> $this->ModelHomecare->getAgencies(),
			'faskes_data'		=> $this->ModelHomecare->getMedicalFacilities(),
			'marketer_data'		=> $this->ModelHomecare->getMarketers(),
		);
		$this->load->view('eklinik/sales/v_homecare', $data);
	}

	public function detail($id)
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$k = $this->ModelHomecare->getCorporate();
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Detail Homecare',
			'subtitle'      => 'Data Peserta Homecare',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
			'getitem'         => $this->ModelHomecare->getHomecare("order by id asc"),
			'instansi'        => $k,
		);
		$this->load->view('eklinik/sales/v_homecare_detail', $data);
	}


	public function getHomecare()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$instansi_id = $this->ModelGeneral->getUser($session['instansi_id']);
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $datas = $this->ModelHomecare->getHomecare("where reservasi.idcabang = '$instansi_id' order by id asc");
		// $detail = $this->ModelHomecare->getDetailPeserta("order by id asc");
		$datas = $this->ModelHomecare->get_all();
		$no = 1;
		foreach ($datas as $d) {
			$id = '"' . $d['id'] . '"';
			$option = "<div class='text-center'>
            <a href='#' class='edit_record btn btn-info btn-sm' onclick='return editHomecare(" . $id . ")'><i class='fa fa-edit'></i> Edit</a>
            <a href='#' class='edit_record btn btn-success btn-sm' onclick='return detail(" . $id . ")'><i class='fa fa-search'></i> Detail</i></a>
            </div>
			";
			$data[] = array(
				'option'				=> $option,
				'no'					=> $no,
				'created_date'			=> $d['created_date'],
				'tanggal'				=> $d['tanggalkunjungan'] . ' - ' . $d['jamkunjungan'],
				'tipe'					=> $d['tipe'],
				'nama'					=> $d['nama'],
				'nomorhp'				=> $d['nomorhp'],
				'email'					=> $d['email'],
				'alamat'				=> $d['alamat'],
				'jumlahpasienpcr'		=> $d['jumlahpasienpcr'],
				'jumlahpasienrapid'		=> $d['jumlahpasienrapid'],
				'jumlahpasienantigen'	=> $d['jumlahpasienantigen'],
				'totalharga'			=> $d['totalharga'],
				'statustransaksi'		=> $d['statustransaksi'],
				'isproses'				=> ($d['isproses'] == 1) ? 'Konfirmasi OK' : 'Belum Konfirmasi'
			);
			$no++;
		}
		if (count($datas) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		header("Content-Type: application/json");
		echo json_encode($response);
	}

	public function getSingleHomecare()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$id = $this->input->post('id');
			// $check = $this->ModelHomecare->getSingleHomecareJoin("ORDER BY r.id");
			$check = $this->ModelHomecare->getHomecareById($id);
			if ($check != null) {
				$response['data'] = $check;
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "User tidak ditemukan";
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	public function saveHomecare()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$session = $this->session->userdata('login');
			$user = $this->ModelGeneral->getUser($session['user_id']);
			$instansi_id = $this->ModelGeneral->getUser($session['instansi_id']);
			$datennow = date('Y-m-d H:i:s');
			$date = date('Y-m-d');

			$id = $this->input->post('id');
			$tipe  = $this->input->post('tipe');
			$idperusahaan  = $this->input->post('idperusahaan');
			$tanggalkunjungan = $this->input->post('tanggalkunjungan');
			$jamkunjungan = $this->input->post('jamkunjungan');
			$nama = $this->input->post('nama');
			$nomorhp = $this->input->post('nomorhp');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');
			$jumlahpasienpcr = $this->input->post('jumlahpasienpcr');
			$jumlahpasienrapid = $this->input->post('jumlahpasienrapid');
			$jumlahpasienantigen = $this->input->post('jumlahpasienantigen');
			$isproses = $this->input->post('isproses');
			// $tanggal_lahir = date('Y-m-d', strtotime($this->input->post('tanggal_lahir')));

			$post = true;


			if ($post) {
				if ($id == "" or $id == null) {
					$datax = array(
						'id'                      => $id,
						'tipe'      	          => $tipe,
						'idperusahaan'                => $idperusahaan,
						'tanggalkunjungan'        => $tanggalkunjungan,
						'jamkunjungan'         	  => $jamkunjungan,
						'nama'        	          => $nama,
						'nomorhp'                 => $nomorhp,
						'email'                   => $email,
						'alamat'                  => $alamat,
						'jumlahpasienpcr'         => $jumlahpasienpcr,
						'jumlahpasienrapid'       => $jumlahpasienrapid,
						'jumlahpasienantigen'     => $jumlahpasienantigen,
						'isproses'                => $isproses,
						'created_by'                => $user['id'],
						'idcabang'                => $user['instansi_id'],

					);
					$this->ModelGeneral->InsertData('reservasi', $datax);
					$this->ModelGeneral->LogActivity('Process Add Homecare ' . $id);
					$response['remarks'] = "Success Insert Homecare!";
				} else {
					$datax = array(
						'id'                      => $id,
						'tipe'                    => $tipe,
						'idperusahaan'             => $idperusahaan,
						'tanggalkunjungan'        => $tanggalkunjungan,
						'jamkunjungan'            => $jamkunjungan,
						'nama'                    => $nama,
						'nomorhp'                 => $nomorhp,
						'email'                   => $email,
						'alamat'                  => $alamat,
						'jumlahpasienpcr'         => $jumlahpasienpcr,
						'jumlahpasienrapid'       => $jumlahpasienrapid,
						'jumlahpasienantigen'     => $jumlahpasienantigen,
						'isproses'                => $isproses,
						'created_by'              => $user['id'],
						'idcabang'                => $user['instansi_id'],
					);
					$this->ModelGeneral->UpdateData('reservasi', $datax, array('id' => $id));
					$this->ModelGeneral->LogActivity('Process Edit Homecare ID ' . $id);
					$response['remarks'] = "Success Edit Homecare!";
				}
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Error";
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	public function getDetailByHomecareId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$id  	= $this->input->post('id');
		$details = $this->ModelHomecare->getDetailHomecare($id);
		$no = 1;
		foreach ($details as $detail) {
			$data[] = array(
				'no'				=> $no,
				'id'				=> $detail['id'],
				'tanggal_kunjungan'	=> $detail['tanggalkunjungan'],
				'instansi'			=> $this->ModelHomecare->getInstansiById($detail['idinstansi'])['instansi'],
				'nama'				=> $detail['nama'],
				'tanggal_lahir'		=> $detail['tanggallahir'],
				'nik'				=> $detail['nik'],
				'paket_pemeriksaan'	=> $detail['idpemeriksaan'],
				'pic_marketing'		=> $this->ModelHomecare->getUserById($detail['idpetugas'])['nama'],
				'status_bayar'		=> ($detail['statusbayar']) == 1 ? "Sudah Lunas" : "Belum Lunas",
				'catatan'			=> $detail['catatan'],
				'option'			=> '<button class="btn btn-info btn-sm" onclick="edit(' . $detail['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="hapus(' . $detail['id'] . ')"><i class="fa fa-trash"></i> Delete</button>'
			);
			$no++;
		}
		$response['data'] = (count($details) > 0) ? $data : [];
		echo json_encode($response);
	}

	// Person
	public function saveHomecarePerson()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$session 		= $this->session->userdata('login');
			$user 			= $this->ModelGeneral->getUser($session['user_id']);
			$instansi_id 	= $this->ModelGeneral->getUser($session['instansi_id']);
			$datennow 		= date('Y-m-d H:i:s');
			$date 			= date('Y-m-d');

			$user_id        	= $session['id'];
			$id 				= $this->input->post('id');
			$tanggal_registrasi	= $this->input->post('tanggal_registrasi');
			$nomor_registrasi  	= $this->input->post('nomor_registrasi');
			$paket_pemeriksaan 	= $this->input->post('paket_pemeriksaan');
			$nik 				= $this->input->post('nik');
			$nomor_pegawai 		= $this->input->post('nomor_pegawai');
			$nama_lengkap 		= $this->input->post('nama_lengkap');
			$jenis_kelamin 		= $this->input->post('jenis_kelamin');
			$email 				= $this->input->post('email');
			$fakses_asal 		= $this->input->post('fakses_asal');
			$instansi 			= $this->input->post('instansi');
			$pic_marketing 		= $this->input->post('pic_marketing');
			$cara_bayar 		= $this->input->post('cara_bayar');
			$status_homecare 	= $this->input->post('status_homecare');

			$post = true;

			// get nomor Registrasi
			$noFirstNoReg = "SPA" . date('dmY', strtotime($this->input->post('tanggal_registrasi')));

			$ceknoreg   = $this->ModelHomecare->getNoReg($noFirstNoReg);
			if (isset($ceknoreg['nomorregistrasi'])) {
				$noregistrasi2 = substr($ceknoreg['nomorregistrasi'], -4) + 1;
				$noregistrasi = $noFirstNoReg . str_pad($noregistrasi2, 4, "0", STR_PAD_LEFT);
			} else {
				$noregistrasi = $noFirstNoReg . '0001';
			}

			// get Detail periksa
			$idjenispemeriksaandetail = $this->input->post('idjenispemeriksaandetail');
			$hargapemeriksaan	= $this->ModelHomecare->getJenisPemeriksaanDetailById($idjenispemeriksaandetail);
			$idpemeriksaan 		= $hargapemeriksaan['idjenispemeriksaan'];
			$pemeriksaandetail	= $hargapemeriksaan['detailcode'];
			$detailharga 		= $hargapemeriksaan['hargadetail'];




			if ($post) {
				if ($status_homecare == 'tambah') {
					$check = $this->ModelHomecare->getHomecare(" WHERE id = '$id' ORDER BY id LIMIT 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					} else {
						$dataInsert = array(
							'id'			=> $id,
							'idinstansi'	=> '4',
							'tanggalregistrasi' 		=> $tanggal_registrasi,
							'nomorregistrasi' 			=> $noregistrasi,
							'iduser' 					=> $user_id,
							'idpemeriksaan' 			=> $idpemeriksaan,
							'idjenispemeriksaandetail' 	=> $pemeriksaandetail,
							'tipekunjungan'             => "Home Service",
							'pemeriksaandetail' 		=> $pemeriksaandetail,
							'detailharga' 				=> $detailharga,
							'tanggalkunjungan' 			=> '',
							'jamkunjungan' => '',
							'actualjamkunjungan' => '',
							'nama' => $nama_lengkap,
							'jeniskelamin' => $jenis_kelamin,
							'tanggallahir' => '',
							'tempatlahir' => '',
							'nomorhp' => '',
							'email' => $email,
							'nik'         	  		=> $nik,
							'alamat' => '',
							'map_alamat' => '',
							'map_lat' => '',
							'map_long' => '',
							'jenissample' => '',
							'tanggalsampling' => '',
							'jamsampling' => '',
							'tanggalperiksa' => '',
							'jamperiksa' => '',
							'tanggalselesai' => '',
							'jamselesai' => '',
							'ncov' => '',
							'fam' => '',
							'uraianfam' => '',
							'rox' => '',
							'uraianrox' => '',
							'vic' => '',
							'lgm' => '',
							'lgg' => '',
							'antigen' => '',
							'mcr' => '',
							'iddokter' => '',
							'idpetugas' => '',
							'idpayment' => '',
							'noinvoice' => '',
							'harga' => '',
							'created_date' => '',
							'modified_date' => '',
							'created_by' => '',
							'modified_by' => '',
							'statustransaksi' => '',
							'antrian_ke' => '',
							'url_invoice' => '',
							'url_hasil' => '',
							'url_hasil_afiliasi' => '',
							'idalat' => '',
							'statushadir' => '',
							'titimangsa' => '',
							'idfaskes' => '8',
							'well' => '',
							'rpt_id' => '',
							'exp_name' => '',
							'result' => '',
							'ct_ch1' => '',
							'gene_ch1' => '',
							'ct_ch2' => '',
							'gene_ch2' => '',
							'ct_ch4' => '',
							'gene_ch4' => '',
							'trash' => '',
							'bagian' => '46',
							'pic_m' =>  $pic_marketing,
							'idadmin' => '',
							'statuskirimhasil' => '',
							'carabayar' => $cara_bayar,
							'statusbayar' => '',
							'catatan' => '',
							'panggil' => '',
							'nopassport' => '',
							'remarkkirimhasil' => '',
							'nationality' => '',
							'nomorpegawai' => $nomor_pegawai,
							'idhomecare' => '',
							'metodebayar' => '',
							'idpaket' => '',
							'idcabang'				=> $user['instansi_id'],
							'idbillingcor' => '',
							'hargacor' => '',
							// 'fakses_asal'         	=> $fakses_asal,
							// 'created_by'			=> $user['id'],
							'created_at'    		=> date("Y-m-d H:i:s"),
						);
						var_dump($dataInsert);
						die;
						$this->ModelHomecare->insert($dataInsert);
						$this->ModelGeneral->LogActivity('Process Add Homecare ID ' . $id);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->ModelHomecare->getHomecare(" WHERE id = '$id' ORDER BY id LIMIT 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'tanggal_registrasi'	=> $tanggal_registrasi,
							'nomor_registrasi' 		=> $nomor_registrasi,
							'paket_pemeriksaan' 	=> $paket_pemeriksaan,
							'nik'         	  		=> $nik,
							'nomor_pegawai'			=> $nomor_pegawai,
							'nama_lengkap'			=> $nama_lengkap,
							'jenis_kelamin' 		=> $jenis_kelamin,
							'email'					=> $email,
							'fakses_asal'         	=> $fakses_asal,
							'instansi'				=> $instansi,
							'pic_marketing'			=> $pic_marketing,
							'cara_bayar'			=> $cara_bayar,
							'created_by'			=> $user['id'],
							'idcabang'				=> $user['instansi_id'],
							'updated_at'    		=> date("Y-m-d H:i:s"),
						);
						var_dump($dataUpdate);
						die;
						$this->ModelHomecare->update($id, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Edit Homecare Personal. ID : ' . $id);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully changed data";
					} else {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					}
				}
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Unable to save new data";
				$this->db->trans_rollback();
			}

			// if ($post) {
			// 	if ($id == "" or $id == null) {
			// 		$datax = array(
			// 			'id'					=> $id,
			// 			'tanggal_registrasi'	=> $tanggal_registrasi,
			// 			'nomor_registrasi' 		=> $nomor_registrasi,
			// 			'paket_pemeriksaan' 	=> $paket_pemeriksaan,
			// 			'nik'         	  		=> $nik,
			// 			'nomor_pegawai'			=> $nomor_pegawai,
			// 			'nama_lengkap'			=> $nama_lengkap,
			// 			'jenis_kelamin' 		=> $jenis_kelamin,
			// 			'email'					=> $email,
			// 			'fakses_asal'         	=> $fakses_asal,
			// 			'instansi'				=> $instansi,
			// 			'pic_marketing'			=> $pic_marketing,
			// 			'cara_bayar'			=> $cara_bayar,
			// 			'created_by'			=> $user['id'],
			// 			'idcabang'				=> $user['instansi_id'],

			// 		);
			// 		$this->ModelGeneral->InsertData('reservasi', $datax);
			// 		$this->ModelGeneral->LogActivity('Process Add Homecare Person ' . $id);
			// 		$response['remarks'] = "Success Insert Homecare!";
			// 	} else {
			// 		$datax = array(
			// 			'id'                      => $id,
			// 			'tipe'                    => $tipe,
			// 			'idperusahaan'             => $idperusahaan,
			// 			'tanggalkunjungan'        => $tanggalkunjungan,
			// 			'jamkunjungan'            => $jamkunjungan,
			// 			'nama'                    => $nama,
			// 			'nomorhp'                 => $nomorhp,
			// 			'email'                   => $email,
			// 			'alamat'                  => $alamat,
			// 			'jumlahpasienpcr'         => $jumlahpasienpcr,
			// 			'jumlahpasienrapid'       => $jumlahpasienrapid,
			// 			'jumlahpasienantigen'     => $jumlahpasienantigen,
			// 			'isproses'                => $isproses,
			// 			'created_by'              => $user['id'],
			// 			'idcabang'                => $user['instansi_id'],
			// 		);
			// 		$this->ModelGeneral->UpdateData('reservasi', $datax, array('id' => $id));
			// 		$this->ModelGeneral->LogActivity('Process Edit Homecare ID ' . $id);
			// 		$response['remarks'] = "Success Edit Homecare!";
			// 	}
			// 	$this->db->trans_complete();
			// 	$this->db->trans_commit();
			// } else {
			// 	$response['status_json'] = false;
			// 	$response['remarks'] = "Error";
			// 	$this->db->trans_rollback();
			// }
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
}
