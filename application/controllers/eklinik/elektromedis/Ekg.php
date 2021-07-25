<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ekg extends CI_Controller
{
  function __Construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');
      $this->load->library('m_pdf');
      $this->load->helper('tgl_indo');
    $this->load->model('eklinik/elektromedis/ModelEkg');
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
      'title'         => 'Data EKG',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,

    );
    $this->load->view('eklinik/elektromedis/v_ekg', $data);
  }

    public function getEkg()
    {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->ModelEkg->getEkg();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/elektromedis/ekg/proses/".$d['id']."' class='btn btn-primary' target='_blank'>PROSES</a>";
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
      'title'         => 'Proses Input EKG',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'id'	=> $id,
    );
    $this->load->view('eklinik/elektromedis/v_prosesekg', $data);
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
			$check = $this->ModelEkg->get_by_id($id);
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
    $qrsrate 		= $this->input->post('qrsrate');
    $qrsduration 		= $this->input->post('qrsduration');
    $axis 		= $this->input->post('axis');
    $pwave 		= $this->input->post('pwave');
    $printerval 		= $this->input->post('printerval');
    $qwave 		= $this->input->post('qwave');
    $twave 		= $this->input->post('twave');
    $sttchanges 		= $this->input->post('sttchanges');
    $remarks 		= $this->input->post('remarks');
     
        
			$post = true;
			if ($post) {
                   
					$data = array(
           'dokterpemeriksa'		=> $dokterpemeriksa,
           'petugas'		=> $petugas,
           'diagnosa'		=> $diagnosa,
           'catatandokter'		=> $catatandokter,
           'hasil'		=> $hasil,
           'qrsrate'		=> $qrsrate,
           'qrsduration'		=> $qrsduration,
           'axis'		=> $axis,
           'pwave'		=> $pwave,
           'printerval'		=> $printerval,
           'qwave'		=> $qwave,
           'twave'		=> $twave,
           'sttchanges'		=> $sttchanges,
           'remarks'		=> $remarks,
						);
                    $this->ModelEkg->update($id, $data);
                $this->upload_file($id,$_FILES["file"]['name'],'file','ekl_pasienekg','fileekg');
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
    
    public function upload_file($id,$file_POST,$namafield,$tabelname,$folderpath){
            
                
        
        $oldmask = umask(0);
       
        if (!is_dir('./uploads/'.$folderpath)) { 
            mkdir('./uploads/'.$folderpath, 0777, true);
        }
        umask($oldmask);
        
        if($file_POST ==''){
        $filename = '';
        }else{
           $file_ext = pathinfo($file_POST,PATHINFO_EXTENSION);
                $filename = genUuid().".".$file_ext;
        }
        
                $config=array(  
            'upload_path' 	=> './uploads/'.$folderpath, //lokasi gambar akan di simpan  
            'allowed_types' => '*', //ekstensi gambar yang boleh di uanggah  
            'max_size' 		=> '*', //batas maksimal ukuran gambar  
            'max_width' 	=> '*', //batas maksimal lebar gambar  
            'max_height'	=> '*', //batas maksimal tinggi gambar 
			'overwrite'		=> TRUE,
			'encrypt_name'		=> TRUE,
            'file_name' 	=> $filename //nama gambar  
            );   
				$this->load->library('upload', $config); 
				$this->upload->initialize($config);
                $this->upload->do_upload($namafield);
                if($this->upload->file_name != ''){
				    $insert=array(
					$namafield  => base_url()."uploads/".$folderpath.'/'.$this->upload->file_name,
				);
				$this->ModelGeneral->UpdateData($tabelname, $insert, array('id' => $id));
                  
                }
		}
    
    public function cetakhasil($id){
       $editekg 				= $this->db->query("select * from ekl_pasienekg where id = '$id' ")->result_array();
        $noregistrasi = $editekg[0]['noregistrasi'];
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
				
                
				'dokterpemeriksaekg'	=> $editekg[0]['dokterpemeriksa'],
				'petugasekg'	=> $editekg[0]['petugas'],
				'diagnosaekg'	=> $editekg[0]['diagnosa'],
				'catatandokterekg'	=> $editekg[0]['catatandokter'],
				'hasilekg'	=> $editekg[0]['hasil'],
				'fileekg'	=> $editekg[0]['file'],
                'qrsrate'		=> $editekg[0]['qrsrate'],
           'qrsduration'		=> $editekg[0]['qrsduration'],
           'axis'		=> $editekg[0]['axis'],
           'pwave'		=> $editekg[0]['pwave'],
           'printerval'		=> $editekg[0]['printerval'],
           'qwave'		=> $editekg[0]['qwave'],
           'twave'		=> $editekg[0]['twave'],
           'sttchanges'		=> $editekg[0]['sttchanges'],
           'remarks'		=> $editekg[0]['remarks'],
           	
			);
    
    $html7 = $this->load->view('eklinik/elektromedis/v_cetakhasilekg', $data, true);
        
        $this->mpdf = new mPDF();
	
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
				10, // margin_left
				10, // margin right
				30, // margin top
				10, // margin bottom
				18, // margin header
				10); // margin footer
		$this->mpdf->WriteHTML($html7);
       
        
		
        $this->mpdf->Output("cetakhasilekg.pdf", 'I');
    }
}
