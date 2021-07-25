<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spirometri extends CI_Controller
{
  function __Construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');
       $this->load->library('m_pdf');
      $this->load->helper('tgl_indo');
    $this->load->model('eklinik/elektromedis/ModelSpirometri');
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
      'title'         => 'Data Spirometri',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,

    );
    $this->load->view('eklinik/elektromedis/v_spirometri', $data);
  }

  public function getSpirometri()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->ModelSpirometri->getSpirometri();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/elektromedis/spirometri/proses/".$d['id']."' class='btn btn-primary' target='_blank'>PROSES</a>";
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
      'title'         => 'Proses Input Spirometri',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'id'	=> $id,
    );
    $this->load->view('eklinik/elektromedis/v_prosesspirometri', $data);
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
			$check = $this->ModelSpirometri->get_by_id($id);
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
    $fvc 		= $this->input->post('fvc');
    $fev1 		= $this->input->post('fev1');
    $fev1_fvc 		= $this->input->post('fev1_fvc');
    $pef 		= $this->input->post('pef');
    $gigipalsu 		= $this->input->post('gigipalsu');
    $tinggibadan 		= $this->input->post('tinggibadan');
    $beratbadan 		= $this->input->post('beratbadan');
    $kebiasaanmerokok 		= $this->input->post('kebiasaanmerokok');
    $asma 		= $this->input->post('asma');
            
            
			$post = true;
			if ($post) {
                   
					$data = array(
           'dokterpemeriksa'		=> $dokterpemeriksa,
           'petugas'		=> $petugas,
           'diagnosa'		=> $diagnosa,
           'catatandokter'		=> $catatandokter,
           'hasil'		=> $hasil,
           'fvc'		=> $fvc,
           'fev1'		=> $fev1,
           'fev1_fvc'		=> $fev1_fvc,
           'pef'		=> $pef,
           'gigipalsu'		=> $gigipalsu,
           'tinggibadan'		=> $tinggibadan,
           'beratbadan'		=> $beratbadan,
           'kebiasaanmerokok'		=> $kebiasaanmerokok,
           'asma'		=> $asma,
						);
                    $this->ModelSpirometri->update($id, $data);
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
        $editspirometri 				= $this->db->query("select * from ekl_pasienspirometri where id = '$id' ")->result_array();
        $noregistrasi = $editspirometri[0]['noregistrasi'];
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
				
				'dokterpemeriksaspirometri'	=> $editspirometri[0]['dokterpemeriksa'],
				'petugasspirometri'	=> $editspirometri[0]['petugas'],
				'diagnosaspirometri'	=> $editspirometri[0]['diagnosa'],
				'catatandokterspirometri'	=> $editspirometri[0]['catatandokter'],
				'hasilspirometri'	=> $editspirometri[0]['hasil'],
				'filespirometri'	=> $editspirometri[0]['file'],
                'fvc'	=> $editspirometri[0]['fvc'],
				'fev1'	=> $editspirometri[0]['fev1'],
				'fev1_fvc'	=> $editspirometri[0]['fev1_fvc'],
				'pef'	=> $editspirometri[0]['pef'],
				'gigipalsu'	=> $editspirometri[0]['gigipalsu'],
			);
    
    $html8 = $this->load->view('eklinik/elektromedis/v_cetakhasilspirometri', $data, true);
        
        $this->mpdf = new mPDF();
	
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
				10, // margin_left
				10, // margin right
				30, // margin top
				10, // margin bottom
				18, // margin header
				10); // margin footer
		$this->mpdf->WriteHTML($html8);
       
        $this->mpdf->Output("cetakhasilspirometri.pdf", 'I');
    }
}
