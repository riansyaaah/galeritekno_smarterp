<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Audiometri extends CI_Controller
{
  function __Construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');
      $this->load->library('m_pdf');
      $this->load->helper('tgl_indo');
    $this->load->model('eklinik/elektromedis/ModelAudiometri');
  }

  var $idMenu = "7b419abf-3735-4d94-a671-36ecfb7b6f0d";
  var $jenisRegistrasi = "4";

  public function index()
  {
    cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Data Audiometri',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,

    );
    $this->load->view('eklinik/elektromedis/v_audiometri', $data);
  }

  public function getAudiometri()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->ModelAudiometri->getAudiometri();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/elektromedis/audiometri/proses/".$d['id']."' class='btn btn-primary' target='_blank'>PROSES</a>";
      $data[] = array(
        "no" => $no,
        "norm" => $d['norm'],
        "nomorregistrasi" => $d['nomorregistrasi'],
        "nama" => $d['nama'],
        "tempatlahir" => $d['tempatlahir'],
        "tanggallahir" => $d['tanggallahir'],
        "jeniskelamin" => $d['jeniskelamin'],
        "alamat" => $d['alamat'],
        "option" => $option,
      );
      $no++;
    }
    $response['data'] = (count($datas) > 0)? $data : [];
    echo json_encode($response);
  }
  public function proses($id)
    {
    cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

           
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Proses Input Audiometri',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'id'	=> $id,
    );
    $this->load->view('eklinik/elektromedis/v_prosesaudiometri', $data);
  }
    
    function getData()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
            $id  = $this->input->post('id');
			$check = $this->ModelAudiometri->get_by_id($id);
			if ($check != null) {
               $response['data'] = $check;
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "No Registrasi ".$id." tidak ditemukan";
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
    }
    
    function getDokter()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->db->query("select * from ekl_dokter")->result_array(); 
        $response['data'] = $data; 
        echo json_encode($response);
    }
    
    function getPetugas()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->db->query("select * from ekl_perawat")->result_array(); 
        $response['data'] = $data; 
        echo json_encode($response);
    }
    public function proses_act()
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
			$id 		= $this->input->post('id');
			$dokterpemeriksa 		= $this->input->post('dokterpemeriksa');
    $petugas 		= $this->input->post('petugas');
    $catatandokter 		= $this->input->post('catatandokter');
    $diagnosa 		= $this->input->post('diagnosa');
    $hasil 		= $this->input->post('hasil');
    $acmr250 		= $this->input->post('acmr250');
    $acmr500 		= $this->input->post('acmr500');
    $acmr1000 		= $this->input->post('acmr1000');
    $acmr1500 		= $this->input->post('acmr1500');
    $acmr2000 		= $this->input->post('acmr2000');
    $acmr3000 		= $this->input->post('acmr3000');
    $acmr4000 		= $this->input->post('acmr4000');
    $acmr6000 		= $this->input->post('acmr6000');
    $acmr8000 		= $this->input->post('acmr8000');
    
    $acml250 		= $this->input->post('acml250');
    $acml500 		= $this->input->post('acml500');
    $acml1000 		= $this->input->post('acml1000');
    $acml1500 		= $this->input->post('acml1500');
    $acml2000 		= $this->input->post('acml2000');
    $acml3000 		= $this->input->post('acml3000');
    $acml4000 		= $this->input->post('acml4000');
    $acml6000 		= $this->input->post('acml6000');
    $acml8000 		= $this->input->post('acml8000');
    
    $acnr250 		= $this->input->post('acnr250');
    $acnr500 		= $this->input->post('acnr500');
    $acnr1000 		= $this->input->post('acnr1000');
    $acnr1500 		= $this->input->post('acnr1500');
    $acnr2000 		= $this->input->post('acnr2000');
    $acnr3000 		= $this->input->post('acnr3000');
    $acnr4000 		= $this->input->post('acnr4000');
    $acnr6000 		= $this->input->post('acnr6000');
    $acnr8000 		= $this->input->post('acnr8000');
    
    $acnl250 		= $this->input->post('acnl250');
    $acnl500 		= $this->input->post('acnl500');
    $acnl1000 		= $this->input->post('acnl1000');
    $acnl1500 		= $this->input->post('acnl1500');
    $acnl2000 		= $this->input->post('acnl2000');
    $acnl3000 		= $this->input->post('acnl3000');
    $acnl4000 		= $this->input->post('acnl4000');
    $acnl6000 		= $this->input->post('acnl6000');
    $acnl8000 		= $this->input->post('acnl8000');
        
    $bcnr250 		= $this->input->post('bcnr250');
    $bcnr500 		= $this->input->post('bcnr500');
    $bcnr1000 		= $this->input->post('bcnr1000');
    $bcnr1500 		= $this->input->post('bcnr1500');
    $bcnr2000 		= $this->input->post('bcnr2000');
    $bcnr3000 		= $this->input->post('bcnr3000');
    $bcnr4000 		= $this->input->post('bcnr4000');
    $bcnr6000 		= $this->input->post('bcnr6000');
    $bcnr8000 		= $this->input->post('bcnr8000');
    $bcnl250 		= $this->input->post('bcnl250');
    $bcnl500 		= $this->input->post('bcnl500');
    $bcnl1000 		= $this->input->post('bcnl1000');
    $bcnl1500 		= $this->input->post('bcnl1500');
    $bcnl2000 		= $this->input->post('bcnl2000');
    $bcnl3000 		= $this->input->post('bcnl3000');
    $bcnl4000 		= $this->input->post('bcnl4000');
    $bcnl6000 		= $this->input->post('bcnl6000');
    $bcnl8000 		= $this->input->post('bcnl8000');
        
    $bcmr250 		= $this->input->post('bcmr250');
    $bcmr500 		= $this->input->post('bcmr500');
    $bcmr1000 		= $this->input->post('bcmr1000');
    $bcmr1500 		= $this->input->post('bcmr1500');
    $bcmr2000 		= $this->input->post('bcmr2000');
    $bcmr3000 		= $this->input->post('bcmr3000');
    $bcmr4000 		= $this->input->post('bcmr4000');
    $bcmr6000 		= $this->input->post('bcmr6000');
    $bcmr8000 		= $this->input->post('bcmr8000');
    $bcml250 		= $this->input->post('bcml250');
    $bcml500 		= $this->input->post('bcml500');
    $bcml1000 		= $this->input->post('bcml1000');
    $bcml1500 		= $this->input->post('bcml1500');
    $bcml2000 		= $this->input->post('bcml2000');
    $bcml3000 		= $this->input->post('bcml3000');
    $bcml4000 		= $this->input->post('bcml4000');
    $bcml6000 		= $this->input->post('bcml6000');
    $bcml8000 		= $this->input->post('bcml8000');    
    
    $acml250 		= $this->input->post('acml250');
    $acml500 		= $this->input->post('acml500');
    $acml1000 		= $this->input->post('acml1000');
    $acml1500 		= $this->input->post('acml1500');
    $acml2000 		= $this->input->post('acml2000');
    $acml3000 		= $this->input->post('acml3000');
    $acml4000 		= $this->input->post('acml4000');
    $acml6000 		= $this->input->post('acml6000');
    $acml8000 		= $this->input->post('acml8000');    
    $ullr250 		= $this->input->post('ullr250');
    $ullr500 		= $this->input->post('ullr500');
    $ullr1000 		= $this->input->post('ullr1000');
    $ullr1500 		= $this->input->post('ullr1500');
    $ullr2000 		= $this->input->post('ullr2000');
    $ullr3000 		= $this->input->post('ullr3000');
    $ullr4000 		= $this->input->post('ullr4000');
    $ullr6000 		= $this->input->post('ullr6000');
    $ullr8000 		= $this->input->post('ullr8000');
    $ulll250 		= $this->input->post('ulll250');
    $ulll500 		= $this->input->post('ulll500');
    $ulll1000 		= $this->input->post('ulll1000');
    $ulll1500 		= $this->input->post('ulll1500');
    $ulll2000 		= $this->input->post('ulll2000');
    $ulll3000 		= $this->input->post('ulll3000');
    $ulll4000 		= $this->input->post('ulll4000');
    $ulll6000 		= $this->input->post('ulll6000');
    $ulll8000 		= $this->input->post('ulll8000');
            
            
			$post = true;
			if ($post) {
                   
					$data = array(
           'dokterpemeriksa'		=> $dokterpemeriksa,
           'petugas'		=> $petugas,
           'diagnosa'		=> $diagnosa,
           'catatandokter'		=> $catatandokter,
           'hasil'		=> $hasil,
           'acmr250'		=> $acmr250,
           'acmr500'		=> $acmr500,
           'acmr1000'		=> $acmr1000,
           'acmr1500'		=> $acmr1500,
           'acmr2000'		=> $acmr2000,
           'acmr3000'		=> $acmr3000,
           'acmr4000'		=> $acmr4000,
           'acmr6000'		=> $acmr6000,
           'acmr8000'		=> $acmr8000,
           'acml250'		=> $acml250,
           'acml500'		=> $acml500,
           'acml1000'		=> $acml1000,
           'acml1500'		=> $acml1500,
           'acml2000'		=> $acml2000,
           'acml3000'		=> $acml3000,
           'acml4000'		=> $acml4000,
           'acml6000'		=> $acml6000,
           'acml8000'		=> $acml8000,
           'acnr250'		=> $acnr250,
           'acnr500'		=> $acnr500,
           'acnr1000'		=> $acnr1000,
           'acnr1500'		=> $acnr1500,
           'acnr2000'		=> $acnr2000,
           'acnr3000'		=> $acnr3000,
           'acnr4000'		=> $acnr4000,
           'acnr6000'		=> $acnr6000,
           'acnr8000'		=> $acnr8000,
           'acnl250'		=> $acnl250,
           'acnl500'		=> $acnl500,
           'acnl1000'		=> $acnl1000,
           'acnl1500'		=> $acnl1500,
           'acnl2000'		=> $acnl2000,
           'acnl3000'		=> $acnl3000,
           'acnl4000'		=> $acnl4000,
           'acnl6000'		=> $acnl6000,
           'acnl8000'		=> $acnl8000,
           'bcnr250'		=> $bcnr250,
           'bcnr500'		=> $bcnr500,
           'bcnr1000'		=> $bcnr1000,
           'bcnr1500'		=> $bcnr1500,
           'bcnr2000'		=> $bcnr2000,
           'bcnr3000'		=> $bcnr3000,
           'bcnr4000'		=> $bcnr4000,
           'bcnr6000'		=> $bcnr6000,
           'bcnr8000'		=> $bcnr8000,
           'bcnl250'		=> $bcnl250,
           'bcnl500'		=> $bcnl500,
           'bcnl1000'		=> $bcnl1000,
           'bcnl1500'		=> $bcnl1500,
           'bcnl2000'		=> $bcnl2000,
           'bcnl3000'		=> $bcnl3000,
           'bcnl4000'		=> $bcnl4000,
           'bcnl6000'		=> $bcnl6000,
           'bcnl8000'		=> $bcnl8000,
           'bcmr250'		=> $bcmr250,
           'bcmr500'		=> $bcmr500,
           'bcmr1000'		=> $bcmr1000,
           'bcmr1500'		=> $bcmr1500,
           'bcmr2000'		=> $bcmr2000,
           'bcmr3000'		=> $bcmr3000,
           'bcmr4000'		=> $bcmr4000,
           'bcmr6000'		=> $bcmr6000,
           'bcmr8000'		=> $bcmr8000,
           'bcml250'		=> $bcml250,
           'bcml500'		=> $bcml500,
           'bcml1000'		=> $bcml1000,
           'bcml1500'		=> $bcml1500,
           'bcml2000'		=> $bcml2000,
           'bcml3000'		=> $bcml3000,
           'bcml4000'		=> $bcml4000,
           'bcml6000'		=> $bcml6000,
           'bcml8000'		=> $bcml8000,
           'ullr250'		=> $ullr250,
           'ullr500'		=> $ullr500,
           'ullr1000'		=> $ullr1000,
           'ullr1500'		=> $ullr1500,
           'ullr2000'		=> $ullr2000,
           'ullr3000'		=> $ullr3000,
           'ullr4000'		=> $ullr4000,
           'ullr6000'		=> $ullr6000,
           'ullr8000'		=> $ullr8000,
           'ulll250'		=> $ulll250,
           'ulll500'		=> $ulll500,
           'ulll1000'		=> $ulll1000,
           'ulll1500'		=> $ulll1500,
           'ulll2000'		=> $ulll2000,
           'ulll3000'		=> $ulll3000,
           'ulll4000'		=> $ulll4000,
           'ulll6000'		=> $ulll6000,
           'ulll8000'		=> $ulll8000,
						);
                    $this->ModelAudiometri->update($id, $data);
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien');
                    
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
    
    public function cetakhasil($id){
        $editaudiometri 				= $this->db->query("select * from ekl_pasienaudiometri where id = '$id' ")->result_array();
        $noregistrasi = $editaudiometri[0]['noregistrasi'];
        $profil 			= $this->db->query("select * from ekl_regpasien where nomorregistrasi = '$noregistrasi' ")->result_array();
        
            $data = array(
				'tanggalregistrasi'		=> tgl_indo($edit[0]['tanggalkunjungan']),
       'tanggalperiksa'		=> date('d/m/Y', strtotime($edit[0]['tanggalperiksa'])),
       'tanggalperiksacover'		=> tgl_indo($edit[0]['tanggalperiksa']),
       'now'		=> date('d/m/Y H:i'),
       'noregistrasi'		=> $noregistrasi,
       'nik'		=> $profil[0]['nik'],
       'nama'			=> $profil[0]['nama'],
       'jeniskelamin'		=> $profil[0]['jeniskelamin'],
       'goldarah'		=> $profil[0]['golongan_darah'],
       'noregistrasi'		=> $profil[0]['noregistrasi'],
       'tempatlahir' 	=> $profil[0]['tempatlahir'],
       'tanggallahir' 	=> $profil[0]['tanggallahir'],
       'umur' 	=> $profil[0]['umur'],
       'agama' 		=> $profil[0]['agama'],
       'alamat' 		=> $profil[0]['alamat'],
                
				'dokterpemeriksaaudiometri'	=> $editaudiometri[0]['dokterpemeriksa'],
				'petugasaudiometri'	=> $editaudiometri[0]['petugas'],
				'diagnosaaudiometri'	=> $editaudiometri[0]['diagnosa'],
				'catatandokteraudiometri'	=> $editaudiometri[0]['catatandokter'],
				'hasilaudiometri'	=> $editaudiometri[0]['hasil'],
				'fileaudiometri'	=> $editaudiometri[0]['file'],
                'acmr125'		=> $editaudiometri[0]['acmr125'],
           'acmr250'		=> $editaudiometri[0]['acmr250'],
           'acmr500'		=> $editaudiometri[0]['acmr500'],
           'acmr750'		=> $editaudiometri[0]['acmr750'],
           'acmr1000'		=> $editaudiometri[0]['acmr1000'],
           'acmr1500'		=> $editaudiometri[0]['acmr1500'],
           'acmr2000'		=> $editaudiometri[0]['acmr2000'],
           'acmr3000'		=> $editaudiometri[0]['acmr3000'],
           'acmr4000'		=> $editaudiometri[0]['acmr4000'],
           'acmr6000'		=> $editaudiometri[0]['acmr6000'],
           'acmr8000'		=> $editaudiometri[0]['acmr8000'],
        'acml125'		=> $editaudiometri[0]['acml125'],
           'acml250'		=> $editaudiometri[0]['acml250'],
           'acml500'		=> $editaudiometri[0]['acml500'],
           'acml750'		=> $editaudiometri[0]['acml750'],
           'acml1000'		=> $editaudiometri[0]['acml1000'],
           'acml1500'		=> $editaudiometri[0]['acml1500'],
           'acml2000'		=> $editaudiometri[0]['acml2000'],
           'acml3000'		=> $editaudiometri[0]['acml3000'],
           'acml4000'		=> $editaudiometri[0]['acml4000'],
           'acml6000'		=> $editaudiometri[0]['acml6000'],
           'acml8000'		=> $editaudiometri[0]['acml8000'],
        'acnr125'		=> $editaudiometri[0]['acnr125'],
           'acnr250'		=> $editaudiometri[0]['acnr250'],
           'acnr500'		=> $editaudiometri[0]['acnr500'],
           'acnr750'		=> $editaudiometri[0]['acnr750'],
           'acnr1000'		=> $editaudiometri[0]['acnr1000'],
           'acnr1500'		=> $editaudiometri[0]['acnr1500'],
           'acnr2000'		=> $editaudiometri[0]['acnr2000'],
           'acnr3000'		=> $editaudiometri[0]['acnr3000'],
           'acnr4000'		=> $editaudiometri[0]['acnr4000'],
           'acnr6000'		=> $editaudiometri[0]['acnr6000'],
           'acnr8000'		=> $editaudiometri[0]['acnr8000'],
        'acnl125'		=> $editaudiometri[0]['acnl125'],
           'acnl250'		=> $editaudiometri[0]['acnl250'],
           'acnl500'		=> $editaudiometri[0]['acnl500'],
           'acnl750'		=> $editaudiometri[0]['acnl750'],
           'acnl1000'		=> $editaudiometri[0]['acnl1000'],
           'acnl1500'		=> $editaudiometri[0]['acnl1500'],
           'acnl2000'		=> $editaudiometri[0]['acnl2000'],
           'acnl3000'		=> $editaudiometri[0]['acnl3000'],
           'acnl4000'		=> $editaudiometri[0]['acnl4000'],
           'acnl6000'		=> $editaudiometri[0]['acnl6000'],
           'acnl8000'		=> $editaudiometri[0]['acnl8000'],
        'bcnr125'		=> $editaudiometri[0]['bcnr125'],
           'bcnr250'		=> $editaudiometri[0]['bcnr250'],
           'bcnr500'		=> $editaudiometri[0]['bcnr500'],
           'bcnr750'		=> $editaudiometri[0]['bcnr750'],
           'bcnr1000'		=> $editaudiometri[0]['bcnr1000'],
           'bcnr1500'		=> $editaudiometri[0]['bcnr1500'],
           'bcnr2000'		=> $editaudiometri[0]['bcnr2000'],
           'bcnr3000'		=> $editaudiometri[0]['bcnr3000'],
           'bcnr4000'		=> $editaudiometri[0]['bcnr4000'],
           'bcnr6000'		=> $editaudiometri[0]['bcnr6000'],
           'bcnr8000'		=> $editaudiometri[0]['bcnr8000'],
        'bcnl125'		=> $editaudiometri[0]['bcnl125'],
           'bcnl250'		=> $editaudiometri[0]['bcnl250'],
           'bcnl500'		=> $editaudiometri[0]['bcnl500'],
           'bcnl750'		=> $editaudiometri[0]['bcnl750'],
           'bcnl1000'		=> $editaudiometri[0]['bcnl1000'],
           'bcnl1500'		=> $editaudiometri[0]['bcnl1500'],
           'bcnl2000'		=> $editaudiometri[0]['bcnl2000'],
           'bcnl3000'		=> $editaudiometri[0]['bcnl3000'],
           'bcnl4000'		=> $editaudiometri[0]['bcnl4000'],
           'bcnl6000'		=> $editaudiometri[0]['bcnl6000'],
           'bcnl8000'		=> $editaudiometri[0]['bcnl8000'],
        'bcmr125'		=> $editaudiometri[0]['bcmr125'],
           'bcmr250'		=> $editaudiometri[0]['bcmr250'],
           'bcmr500'		=> $editaudiometri[0]['bcmr500'],
           'bcmr750'		=> $editaudiometri[0]['bcmr750'],
           'bcmr1000'		=> $editaudiometri[0]['bcmr1000'],
           'bcmr1500'		=> $editaudiometri[0]['bcmr1500'],
           'bcmr2000'		=> $editaudiometri[0]['bcmr2000'],
           'bcmr3000'		=> $editaudiometri[0]['bcmr3000'],
           'bcmr4000'		=> $editaudiometri[0]['bcmr4000'],
           'bcmr6000'		=> $editaudiometri[0]['bcmr6000'],
           'bcmr8000'		=> $editaudiometri[0]['bcmr8000'],
        'bcml125'		=> $editaudiometri[0]['bcml125'],
           'bcml250'		=> $editaudiometri[0]['bcml250'],
           'bcml500'		=> $editaudiometri[0]['bcml500'],
           'bcml750'		=> $editaudiometri[0]['bcml750'],
           'bcml1000'		=> $editaudiometri[0]['bcml1000'],
           'bcml1500'		=> $editaudiometri[0]['bcml1500'],
           'bcml2000'		=> $editaudiometri[0]['bcml2000'],
           'bcml3000'		=> $editaudiometri[0]['bcml3000'],
           'bcml4000'		=> $editaudiometri[0]['bcml4000'],
           'bcml6000'		=> $editaudiometri[0]['bcml6000'],
           'bcml8000'		=> $editaudiometri[0]['bcml8000'],
        'ullr125'		=> $editaudiometri[0]['ullr125'],
           'ullr250'		=> $editaudiometri[0]['ullr250'],
           'ullr500'		=> $editaudiometri[0]['ullr500'],
           'ullr750'		=> $editaudiometri[0]['ullr750'],
           'ullr1000'		=> $editaudiometri[0]['ullr1000'],
           'ullr1500'		=> $editaudiometri[0]['ullr1500'],
           'ullr2000'		=> $editaudiometri[0]['ullr2000'],
           'ullr3000'		=> $editaudiometri[0]['ullr3000'],
           'ullr4000'		=> $editaudiometri[0]['ullr4000'],
           'ullr6000'		=> $editaudiometri[0]['ullr6000'],
           'ullr8000'		=> $editaudiometri[0]['ullr8000'],
        'ulll125'		=> $editaudiometri[0]['ulll125'],
           'ulll250'		=> $editaudiometri[0]['ulll250'],
           'ulll500'		=> $editaudiometri[0]['ulll500'],
           'ulll750'		=> $editaudiometri[0]['ulll750'],
           'ulll1000'		=> $editaudiometri[0]['ulll1000'],
           'ulll1500'		=> $editaudiometri[0]['ulll1500'],
           'ulll2000'		=> $editaudiometri[0]['ulll2000'],
           'ulll3000'		=> $editaudiometri[0]['ulll3000'],
           'ulll4000'		=> $editaudiometri[0]['ulll4000'],
           'ulll6000'		=> $editaudiometri[0]['ulll6000'],
           'ulll8000'		=> $editaudiometri[0]['ulll8000'],
              
			);
    
    $html11 = $this->load->view('eklinik/elektromedis/v_cetakhasilaudiometri', $data, true);
        $this->mpdf = new mPDF();
	
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
				10, // margin_left
				10, // margin right
				30, // margin top
				10, // margin bottom
				18, // margin header
				10); // margin footer
		$this->mpdf->WriteHTML($html11);
        
        
		
        $this->mpdf->Output("cetakhasilaudiometri.pdf", 'I');
    }
}
