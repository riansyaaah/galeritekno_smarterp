<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Treadmill extends CI_Controller
{
  function __Construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');
      $this->load->library('m_pdf');
      $this->load->helper('tgl_indo');
    $this->load->model('eklinik/elektromedis/ModelTreadmill');
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
      'title'         => 'Data Treadmill',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,

    );
    $this->load->view('eklinik/elektromedis/v_treadmill', $data);
  }

  public function getTreadmill()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->ModelTreadmill->getTreadmill();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/elektromedis/treadmill/proses/".$d['id']."' class='btn btn-primary' target='_blank'>PROSES</a>";
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
      'title'         => 'Proses Input Treadmill',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'id'	=> $id,
    );
    $this->load->view('eklinik/elektromedis/v_prosestreadmill', $data);
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
			$check = $this->ModelTreadmill->get_by_id($id);
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
    $indication 		= $this->input->post('indication');
    $respiration 		= $this->input->post('respiration');
    $preexercisebp_a 		= $this->input->post('preexercisebp_a');
    $preexercisebp_b 		= $this->input->post('preexercisebp_b');
    $restingecg 		= $this->input->post('restingecg');
    $heartrate 		= $this->input->post('heartrate');
    $exercisetime_a 		= $this->input->post('exercisetime_a');
    $exercisetime_b 		= $this->input->post('exercisetime_b');
    $aerobiccapacity 		= $this->input->post('aerobiccapacity');
    $maxheartrate 		= $this->input->post('maxheartrate');
    $targetheartrate 		= $this->input->post('targetheartrate');
    $endstage 		= $this->input->post('endstage');
    $maxbloodpressure_a 		= $this->input->post('maxbloodpressure_a');
    $maxbloodpressure_b 		= $this->input->post('maxbloodpressure_b');
    $maxheartrate_persen 		= $this->input->post('maxheartrate_persen');
    $reasonofend 		= $this->input->post('reasonofend');
    $sttsegmentchanges 		= $this->input->post('sttsegmentchanges');
    $classificationofphysicalfitness 		= $this->input->post('classificationofphysicalfitness');
    $bloodpressureresponse 		= $this->input->post('bloodpressureresponse');
    $functionalclassification 		= $this->input->post('functionalclassification');
   
    $prematurebeat 		= $this->input->post('prematurebeat');
    if($this->input->post('conclution') != ''){
    $conclution 			= implode(";",$this->input->post('conclution'));
        }else{
           $conclution = ''; 
        }
            
            
			$post = true;
			if ($post) {
                   
					$data = array(
            'dokterpemeriksa'		=> $dokterpemeriksa,
           'petugas'		=> $petugas,
           'diagnosa'		=> $diagnosa,
           'catatandokter'		=> $catatandokter,
           'hasil'		=> $hasil,
           'indication' 		=> $indication,
    'respiration' 		=> $respiration,
    'preexercisebp_a' 		=> $preexercisebp_a,
    'preexercisebp_b' 		=> $preexercisebp_b,
    'restingecg' 		=> $restingecg,
    'heartrate' 		=> $heartrate,
    'exercisetime_a' 		=> $exercisetime_a,
    'exercisetime_b' 		=> $exercisetime_b,
    'aerobiccapacity' 		=> $aerobiccapacity,
    'maxheartrate' 		=> $maxheartrate,
    'targetheartrate' 		=> $targetheartrate,
    'endstage' 		=> $endstage,
    'maxbloodpressure_a' 		=> $maxbloodpressure_a,
    'maxbloodpressure_b' 		=> $maxbloodpressure_b,
    'maxheartrate_persen' 		=> $maxheartrate_persen,
    'reasonofend' 		=> $reasonofend,
    'sttsegmentchanges' 		=> $sttsegmentchanges,
    'classificationofphysicalfitness' 		=> $classificationofphysicalfitness,
    'bloodpressureresponse' 		=> $bloodpressureresponse,
    'functionalclassification' 		=> $functionalclassification,
    'conclution' 		=> $conclution,
    'prematurebeat' 		=> $prematurebeat,
						);
                    $this->ModelTreadmill->update($id, $data);
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
        
        $edittreadmill 				= $this->db->query("select * from ekl_pasientreadmill where id = '$id' ")->result_array();
        $noregistrasi = $edittreadmill[0]['noregistrasi'];
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
                
				'dokterpemeriksatreadmill'	=> $edittreadmill[0]['dokterpemeriksa'],
				'petugastreadmill'	=> $edittreadmill[0]['petugas'],
				'diagnosatreadmill'	=> $edittreadmill[0]['diagnosa'],
				'catatandoktertreadmill'	=> $edittreadmill[0]['catatandokter'],
				'hasiltreadmill'	=> $edittreadmill[0]['hasil'],
				'filetreadmill'	=> $edittreadmill[0]['file'],
                'indication' 		=> $edittreadmill[0]['indication'],
    'respiration' 		=> $edittreadmill[0]['respiration'],
    'preexercisebp_a' 		=> $edittreadmill[0]['preexercisebp_a'],
    'preexercisebp_b' 		=> $edittreadmill[0]['preexercisebp_b'],
    'restingecg' 		=> $edittreadmill[0]['restingecg'],
    'heartrate' 		=> $edittreadmill[0]['heartrate'],
    'exercisetime_a' 		=> $edittreadmill[0]['exercisetime_a'],
    'exercisetime_b' 		=> $edittreadmill[0]['exercisetime_b'],
    'aerobiccapacity' 		=> $edittreadmill[0]['aerobiccapacity'],
    'targetheartrate' 		=> $edittreadmill[0]['targetheartrate'],
    'maxheartrate' 		=> $edittreadmill[0]['maxheartrate'],
    'endstage' 		=> $edittreadmill[0]['endstage'],
    'maxbloodpressure_a' 		=> $edittreadmill[0]['maxbloodpressure_a'],
    'maxbloodpressure_b' 		=> $edittreadmill[0]['maxbloodpressure_b'],
    'maxheartrate_persen' 		=> $edittreadmill[0]['maxheartrate_persen'],
    'reasonofend' 		=> $edittreadmill[0]['reasonofend'],
    'sttsegmentchanges' 		=> $edittreadmill[0]['sttsegmentchanges'],
    'classificationofphysicalfitness' 		=> $edittreadmill[0]['classificationofphysicalfitness'],
    'bloodpressureresponse' 		=> $edittreadmill[0]['bloodpressureresponse'],
    'functionalclassification' 		=> $edittreadmill[0]['functionalclassification'],
    'conclution' 		=> $edittreadmill[0]['conclution'],
    'prematurebeat' 		=> $edittreadmill[0]['prematurebeat'],
               
                
			);
    
    $html10 = $this->load->view('eklinik/elektromedis/v_cetakhasiltreadmill', $data, true);
    $this->mpdf = new mPDF();
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
				10, // margin_left
				10, // margin right
				30, // margin top
				10, // margin bottom
				18, // margin header
				10); // margin footer
		$this->mpdf->WriteHTML($html10);
        
        
		
        $this->mpdf->Output("cetakhasiltreadmill.pdf", 'I');
    }
}
