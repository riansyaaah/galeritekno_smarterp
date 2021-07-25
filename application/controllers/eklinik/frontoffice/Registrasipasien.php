<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registrasipasien extends CI_Controller
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
	}

	var $idMenu = "40c66265-cf86-4eb3-bf3b-cc0cafe67997";

	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");

		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Registrasi Pasien Baru',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
            'getitem'         => $this->ModelItemperiksa->getItemperiksa(" where id_paren like '1%' order by id asc"),
		);
		$this->load->view('eklinik/frontoffice/v_registrasipasien', $data);
	}

	public function addPasien()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $response['remarks'] = "Berhasil menyimpan Data Pasien";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);


		try {
			$datennow = date('Y-m-d H:i:s');
			$tanggal_rm = $this->input->post('tanggal_rm');
			$norm = $this->input->post('norm');
			$nik = $this->input->post('nik');
			$nama_sebutan = $this->input->post('nama_sebutan');
			$nama = $this->input->post('nama');
			$jeniskelamin = $this->input->post('jeniskelamin');
			$tanggallahir = $this->input->post('tanggallahir');
			$tempatlahir = $this->input->post('tempatlahir');
			$umur = $this->input->post('umur');
			$golongan_darah = $this->input->post('golongan_darah');
			$email = $this->input->post('email');
			$nomorhp = $this->input->post('nomorhp');
			$alamat = $this->input->post('alamat');
			$StatusPasien = $this->input->post('StatusPasien');
            
			$nomorregistrasi = $this->input->post('nomorregistrasi');
			$tanggalregistrasi = $this->input->post('tanggalregistrasi');
			$jenis_registrasi = $this->input->post('jenis_registrasi');
			$jenis_layanan = $this->input->post('jenis_layanan');
			$tanggalkunjungan = $this->input->post('tanggalkunjungan');
			$jamkunjungan = $this->input->post('jamkunjungan');
			$poliklinik_select = $this->input->post('poliklinik_select');
			$dokter_select = $this->input->post('dokter_select');

            $mcu_select = $this->input->post('mcu_select');
            $elektromedis_select = $this->input->post('elektromedis_select');
            $radiologi_select = $this->input->post('radiologi_select');
            
            $dataiddetail = $this->input->post('data');
            $idpenjamin = $this->input->post('idpenjamin');
            $biaya_administrasi = $this->input->post('biaya_administrasi');
            $metodebayar = $this->input->post('metodebayar');
            $nokartu_jaminan = $this->input->post('nokartu_jaminan');
            
			$post = true;
			if ($post) {
                    $dataRM = array(
							'norm' => $norm,
							'tanggal_rm' => $tanggal_rm,
							'nik' => $nik,
							'nama_sebutan' => $nama_sebutan,
							'nama' => $nama,
							'jeniskelamin' => $jeniskelamin,
							'tanggallahir' => $tanggallahir,
							'tempatlahir' => $tempatlahir,
							'umur' => $umur,
							'golongan_darah' => $golongan_darah,
							'email' => $email,
							'nomorhp' => $nomorhp,
							'alamat' => $alamat,
							'created_date' => $datennow,
						);
                if ($StatusPasien == 'New') {
					$cekNoRef = $this->ModelRegisterPasien->getRekamMedik(" where norm = '$norm'");
                    
                    if (count($cekNoRef) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Data sudah ada!";
						$this->db->trans_rollback();
					} else {
						$this->ModelGeneral->InsertData('ekl_rekammedis', $dataRM);
						$response['remarks'] = "Berhasil Menyimpan Data Pasien";
						$this->ModelGeneral->LogActivity('Process Insert New Pasien : ' . $nama);
					}
				} else {
					$this->ModelGeneral->UpdateData('ekl_rekammedis', $dataRM, array('norm' => $norm));
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien : ' . $nama);
				}
                if ($nomorregistrasi != '') {
					$dataRegistrasi = array(
							'norm' => $norm,
							'nik' => $nik,
							'nama_sebutan' => $nama_sebutan,
							'nama' => $nama,
							'jeniskelamin' => $jeniskelamin,
							'tanggallahir' => $tanggallahir,
							'tempatlahir' => $tempatlahir,
							'umur' => $umur,
							'golongan_darah' => $golongan_darah,
							'email' => $email,
							'nomorhp' => $nomorhp,
							'alamat' => $alamat,
							'created_date' => $datennow,
							'nomorregistrasi' => $nomorregistrasi,
							'tanggalregistrasi' => $tanggalregistrasi,
							'jenis_registrasi' => $jenis_registrasi,
							'jenis_layanan' => $jenis_layanan,
                            'idpenjamin'=> $idpenjamin,
                            'biaya_administrasi'=> $biaya_administrasi,
                            'metodebayar'=> $metodebayar,
                            'nokartu_jaminan'=> $nokartu_jaminan,
                        
						);
                    $this->ModelGeneral->UpdateData('ekl_regpasien', $dataRegistrasi, array('nomorregistrasi' => $nomorregistrasi));
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien : ' . $nama);
                    
				} else {
                    
                    $cekNoReg = $this->ModelRegisterPasien->getRegisterPasien(" order by nomorregistrasi desc limit 1");
					
                if(count($cekNoReg)>0){
                    $nomorregistrasi = (intval(substr($cekNoReg[0]['nomorregistrasi'],-1)) + 1);
                    $nomorregistrasi = str_pad($nomorregistrasi,3,"0",STR_PAD_LEFT);
                }else{
                    $nomorregistrasi = str_pad("1",3,"0",STR_PAD_LEFT);
                }
                    $dataRegistrasi = array(
							'norm' => $norm,
							'nik' => $nik,
							'nama_sebutan' => $nama_sebutan,
							'nama' => $nama,
							'jeniskelamin' => $jeniskelamin,
							'tanggallahir' => $tanggallahir,
							'tempatlahir' => $tempatlahir,
							'umur' => $umur,
							'golongan_darah' => $golongan_darah,
							'email' => $email,
							'nomorhp' => $nomorhp,
							'alamat' => $alamat,
							'created_date' => $datennow,
							'nomorregistrasi' => $nomorregistrasi,
							'tanggalregistrasi' => $tanggalregistrasi,
							'jenis_registrasi' => $jenis_registrasi,
							'jenis_layanan' => $jenis_layanan,
							'jenis_pasien' => "umum",
                        'idpenjamin'=> $idpenjamin,
                            'biaya_administrasi'=> $biaya_administrasi,
                            'metodebayar'=> $metodebayar,
                            'nokartu_jaminan'=> $nokartu_jaminan,
						);
						$this->ModelGeneral->InsertData('ekl_regpasien', $dataRegistrasi);
						$response['remarks'] = "Berhasil Menyimpan Data Pasien";
						$this->ModelGeneral->LogActivity('Process Insert New Pasien : ' . $nama);
					
				}
				
                if($jenis_registrasi == '1'){
                    $dataRawatjalan = array(
							'noregistrasi' => $nomorregistrasi,
							'tanggalkunjungan' => $tanggalkunjungan,
							'jamkunjungan' => $jamkunjungan,
							'poliklinik_id' => $poliklinik_select,
							'dokter_id' => $dokter_select,
						);
						$this->ModelGeneral->InsertData('ekl_pasienrawatjalan', $dataRawatjalan);
						$response['remarks'] = "Berhasil Menyimpan Data Pasien";
						$this->ModelGeneral->LogActivity('Process Insert New Pasien : ' . $nomorregistrasi);
                }
                if($jenis_registrasi == '2'){
                    $paket_mcu = $this->db->query("select * from ekl_paketmcu_detail where paketmcu_id = '$mcu_select'")->result_array();
                        $dataMcu = array(
							'noregistrasi' => $nomorregistrasi,
							'tanggalkunjungan' => $tanggalkunjungan,
							'jamkunjungan' => $jamkunjungan,
							'paketmcu_id' => $mcu_select,
						);
                    $dataMcudetail = array(
							'noregistrasi' => $nomorregistrasi,
							'tanggalkunjungan' => $tanggalkunjungan,
							'jamkunjungan' => $jamkunjungan,
						);
                    	$this->ModelGeneral->InsertData('ekl_pasienmcu', $dataMcu);
                        $dataprem = array(
							'noregistrasi' => $nomorregistrasi,
						);
                    	$this->ModelGeneral->InsertData('ekl_pasienpremedcheck', $dataprem);
                    	$this->ModelGeneral->InsertData('ekl_pasienfisik', $dataprem);
                    	$this->ModelGeneral->InsertData('ekl_pasienfisikuraian', $dataprem);
                    
                        foreach($paket_mcu as $a){
                            $id = $a['id'];
                            if($id == '1'){
                                $this->ModelGeneral->InsertData('ekl_pasienlaboratorium', $dataMcudetail);
                                $id_pasienlab = $this->db->insert_id();
                                $this->db->query("insert into ekl_pasienlaboratorium_detail(id_pasienlab,id_item) select '$id_pasienlab' as id_pasienlab, id as id_item from ekl_paketmcu_detail where paketmcu_id = '$mcu_select' and id like '1.%'");
                            }
                            if($id == '2.1'){
                                $this->ModelGeneral->InsertData('ekl_pasienekg', $dataMcudetail);
                            }
                            if($id == '2.2'){
                                $this->ModelGeneral->InsertData('ekl_pasientreadmill', $dataMcudetail);
                            }
                            if($id == '2.3'){
                                $this->ModelGeneral->InsertData('ekl_pasienspirometri', $dataMcudetail);
                            }
                            if($id == '2.4'){
                                $this->ModelGeneral->InsertData('ekl_pasienaudiometri', $dataMcudetail);
                            }
                            if($id == '3.1'){
                                $this->ModelGeneral->InsertData('ekl_pasienthorax', $dataMcudetail);
                            }
                            if($id == '3.2'){
                                $this->ModelGeneral->InsertData('ekl_pasienusgabdomen', $dataMcudetail);
                            }
                        }
						$response['remarks'] = "Berhasil Menyimpan Data Pasien";
						$this->ModelGeneral->LogActivity('Process Insert New Pasien : ' . $nomorregistrasi);
                }
                if($jenis_registrasi == '3'){
                    $dataLaboratorium = array(
							'noregistrasi' => $nomorregistrasi,
							'tanggalkunjungan' => $tanggalkunjungan,
							'jamkunjungan' => $jamkunjungan,
						);
						$this->ModelGeneral->InsertData('ekl_pasienlaboratorium', $dataLaboratorium);
                    $id_pasienlab = $this->db->insert_id();
                                foreach($dataiddetail as $idlapab){

                                $check = $this->ModelRegisterPasien->getLabdetail("where id_item = '$idlapab' and id_pasienlab = '$id_pasienlab' limit 1");
                                if(count($check) > 0 ){

                                }else{

                                    $dataInsert = array(
                                       'id_pasienlab'      => $id_pasienlab,
                                       'id_item'      => $idlapab,
                                    );
                                    $this->ModelGeneral->InsertData('ekl_pasienlaboratorium_detail', $dataInsert);
                                    $this->ModelGeneral->LogActivity('Process Update New Item : '.$idlapab);

                                }
                                $this->db->trans_complete();
                                    $this->db->trans_commit();
                                    $response['remarks'] = "Successfully changed data"; 
                                }
						$response['remarks'] = "Berhasil Menyimpan Data Pasien";
						$this->ModelGeneral->LogActivity('Process Insert New Pasien : ' . $nomorregistrasi);
                }
                if($jenis_registrasi == '4'){
                    $dataElektromedis = array(
							'noregistrasi' => $nomorregistrasi,
							'tanggalkunjungan' => $tanggalkunjungan,
							'jamkunjungan' => $jamkunjungan,
						);
                   if($elektromedis_select == '2.1'){
                    	$this->ModelGeneral->InsertData('ekl_pasienekg', $dataElektromedis);
						$response['remarks'] = "Berhasil Menyimpan Data Pasien";
						$this->ModelGeneral->LogActivity('Process Insert New Pasien : ' . $nomorregistrasi);
                }
                    if($elektromedis_select == '2.2'){
                    	$this->ModelGeneral->InsertData('ekl_pasientreadmill', $dataElektromedis);
						$response['remarks'] = "Berhasil Menyimpan Data Pasien";
						$this->ModelGeneral->LogActivity('Process Insert New Pasien : ' . $nomorregistrasi);
                }
                    if($elektromedis_select == '2.3'){
                    	$this->ModelGeneral->InsertData('ekl_pasienspirometri', $dataElektromedis);
						$response['remarks'] = "Berhasil Menyimpan Data Pasien";
						$this->ModelGeneral->LogActivity('Process Insert New Pasien : ' . $nomorregistrasi);
                }
                    if($elektromedis_select == '2.4'){
                    	$this->ModelGeneral->InsertData('ekl_pasienaudiometri', $dataElektromedis);
						$response['remarks'] = "Berhasil Menyimpan Data Pasien";
						$this->ModelGeneral->LogActivity('Process Insert New Pasien : ' . $nomorregistrasi);
                }
                }
                if($jenis_registrasi == '5'){
                   $dataRadiologi = array(
							'noregistrasi' => $nomorregistrasi,
							'tanggalkunjungan' => $tanggalkunjungan,
							'jamkunjungan' => $jamkunjungan,
						);
                   if($elektromedis_select == '3.1'){
                    	$this->ModelGeneral->InsertData('ekl_pasienthorax', $dataRadiologi);
						$response['remarks'] = "Berhasil Menyimpan Data Pasien";
						$this->ModelGeneral->LogActivity('Process Insert New Pasien : ' . $nomorregistrasi);
                }
                    if($elektromedis_select == '3.2'){
                    	$this->ModelGeneral->InsertData('ekl_pasienusgabdomen', $dataRadiologi);
						$response['remarks'] = "Berhasil Menyimpan Data Pasien";
						$this->ModelGeneral->LogActivity('Process Insert New Pasien : ' . $nomorregistrasi);
                }
                }
                
				$this->db->trans_complete();
				$this->db->trans_commit();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}


	public function getPasien()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$datas = $this->ModelRegisterPasien->getRekamMedik("order by norm desc");
		$no = 1;
		foreach ($datas as $d) {
			$option = "<a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
			$data[] = array(
				"no" => $no,
				"norm" => $d['norm'],
				"tanggal_rm" => $d['tanggal_rm'],
				"nik" => $d['nik'],
				"nama" => $d['nama'],
				"jeniskelamin" => $d['jeniskelamin'],
				"option" => $option,
			);
			$no++;
		}
		if (count($datas) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}


	function getPasienbyid()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$norm  = $this->input->post('norm');

			$check = $this->ModelRegisterPasien->getRekamMedik(" WHERE norm = '" . $norm . "' ");
			if ($check != null) {
				$response['data'] = $check;
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Item tidak ditemukan";
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
    
    function getJenisRegistrasi()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->ModelRegisterPasien->getJenisRegistrasi();
        $response['data'] = $data; 
        echo json_encode($response);
    }
    function getPaketMcu()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->ModelRegisterPasien->getPaketMcu();
        $response['data'] = $data; 
        echo json_encode($response);
    }
    function getItemPeriksa()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $iditem = $this->input->get('iditem');
        $data = $this->ModelRegisterPasien->getItemPeriksa("where id_paren = '$iditem' and level = 'KELOMPOK'");
        $response['data'] = $data; 
        echo json_encode($response);
    }
    function getJenisPoliklinik()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->ModelRegisterPasien->getJenisPoliklinik();
        $response['data'] = $data; 
        echo json_encode($response);
    }
    
    function getDokterPoli()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $idpoli = $this->input->get('idpoli');
        $data = $this->ModelRegisterPasien->getDokterPoli("where poliklinik_id = '$idpoli'");
        $response['data'] = $data; 
        echo json_encode($response);
    }
    function getPenjamin()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $idpoli = $this->input->get('idpoli');
        $data = $this->ModelRegisterPasien->getPenjamin();
        $response['data'] = $data; 
        echo json_encode($response);
    }
}
