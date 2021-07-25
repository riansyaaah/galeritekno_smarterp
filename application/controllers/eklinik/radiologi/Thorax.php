<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Thorax extends CI_Controller
{
  function __Construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');
      $this->load->library('m_pdf');
      $this->load->helper('tgl_indo');
    $this->load->model('eklinik/radiologi/ModelThorax');
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
      'title'         => 'Data Thorax',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,

    );
    $this->load->view('eklinik/radiologi/v_thorax', $data);
  }

  public function getThorax()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->ModelThorax->getThorax();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/radiologi/thorax/proses/".$d['id']."' class='btn btn-primary' target='_blank'>PROSES</a>";
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
      'title'         => 'Proses Input Thorax',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'id'	=> $id,
    );
    $this->load->view('eklinik/radiologi/v_prosesthorax', $data);
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
			$check = $this->ModelThorax->get_by_id($id);
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
    $cor 		= $this->input->post('cor');
    $pulmo 		= $this->input->post('pulmo');
    $sinusdiafragma 		= $this->input->post('sinusdiafragma');
    $tulangjaringanlunak 		= $this->input->post('tulangjaringanlunak');
    $hasil 		= $this->input->post('hasil');
            
            
			$post = true;
			if ($post) {
                   
					$data = array(
           'dokterpemeriksa'		=> $dokterpemeriksa,
           'petugas'		=> $petugas,
           'diagnosa'		=> $diagnosa,
           'catatandokter'		=> $catatandokter,
           'cor'		=> $cor,
           'pulmo'		=> $pulmo,
           'sinusdiafragma'		=> $sinusdiafragma,
           'tulangjaringanlunak'		=> $tulangjaringanlunak,
           'hasil'		=> $hasil,
						);
                    $this->ModelThorax->update($id, $data);
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
         $editradiologi 				= $this->db->query("select * from ekl_pasienthorax where id = '$id' ")->result_array();
        $noregistrasi = $editradiologi[0]['noregistrasi'];
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
                
				'dokterpemeriksaradiologi'	=> $editradiologi[0]['dokterpemeriksa'],
				'petugasradiologi'	=> $editradiologi[0]['petugas'],
				'diagnosaradiologi'	=> $editradiologi[0]['diagnosa'],
				'catatandokterradiologi'	=> $editradiologi[0]['catatandokter'],
				'hasilradiologi'	=> $editradiologi[0]['hasil'],
				'fileradiologi'	=> $editradiologi[0]['file'],
				'cor'	=> $editradiologi[0]['cor'],
				'pulmo'	=> $editradiologi[0]['pulmo'],
				'sinusdiafragma'	=> $editradiologi[0]['sinusdiafragma'],
				'tulangjaringanlunak'	=> $editradiologi[0]['tulangjaringanlunak'],
        	);
    
    $html9 = $this->load->view('eklinik/radiologi/v_cetakhasilthorax', $data, true);
        
        $this->mpdf = new mPDF();
	
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
				10, // margin_left
				10, // margin right
				30, // margin top
				10, // margin bottom
				18, // margin header
				10); // margin footer
		$this->mpdf->WriteHTML($html9);
        
		
        $this->mpdf->Output("cetakhasilthorax.pdf", 'I');
    }
}
