<?php defined('BASEPATH') or exit('No direct script access allowed');
class Labcovid extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('m_pdf');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('eklinik/laboratorium/ModelLabCovid', 'model');
	}
	protected $idMenu = 'D4346A89-EF1D-4318-81F9-C73887874959';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'			=> 'Data Laboratorium',
			'count_ms'		=> 99,
			'sess'			=> $session,
			'menus'			=> getMenu($session['user_id']),
			'apps'			=> $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'sekarang'		=> date('Y-m-d')
		];
		$this->load->view('eklinik/laboratorium/laboratoriumcovid/index', $data);
	}
	public function getLaboratorium() {
		cek_session($this->idMenu);
		$tanggal = date('Y-m-d');
		$id = $this->input->get('id');
		$data = (!$id)? $this->model->getAllLaboratorium($tanggal) : $this->model->geLaboratoriumSingle($id);
		json($data);
	}
	public function getLaboratoriumFilter() {
		cek_session($this->idMenu);
		$input = $this->input;
		$form = [
			'from'				=> $input->post('from'),
			'to'				=> $input->post('to'),
			'instansi'			=> $input->post('instansi'),
			'picMarketing'		=> $input->post('picMarketing'),
			'paketPemeriksaan'	=> $input->post('paketPemeriksaan'),
			'cabang'			=> $input->post('cabang'),
			'statusHasil'		=> $input->post('statusHasil')
		];
		$data = $this->model->getAllLaboratoriumFilter($form);
		json($data);
	}
	public function getCabang() {
		cek_session($this->idMenu);
		$data = $this->mg->getAll('tbl_cabang')->result_array();
		json($data);
	}
	public function getInstansi() {
		cek_session($this->idMenu);
		$idcabang = $this->input->get('idcabang');
		$data = $this->mg->getWhere('masterinstansi', ['idcabang' => $idcabang])->result_array();
		json($data);
	}
	public function getFaskes() {
		cek_session($this->idMenu);
		$idcabang = $this->input->get('idcabang');
		$data = $this->mg->getWhere('regfaskes', ['idcabang' => $idcabang])->result_array();
		json($data);
	}
	public function getJenisPemeriksaan() {
		cek_session($this->idMenu);
		$idcabang = $this->input->get('idcabang');
		$data = $this->model->getJenisPemeriksaanDetail($idcabang);
		json($data);
	}
	public function getJenisSample() {
		cek_session($this->idMenu);
		$data = ['Orofaring & Nasofaring', 'Sputum', 'Saliva'];
		json($data);
	}
	public function getAntigen() {
		cek_session($this->idMenu);
		$data = ['Negatif', 'Positif'];
		json($data);
	}
	public function getNcov() {
		cek_session($this->idMenu);
		$data = ['Negatif', 'Positif'];
		json($data);
	}
	public function getNGene() {
		cek_session($this->idMenu);
		$data = ['Undetection', 'Detection'];
		json($data);
	}
	public function getORF1ab() {
		cek_session($this->idMenu);
		$data = ['Undetection', 'Detection'];
		json($data);
	}
	public function getDokter() {
		cek_session($this->idMenu);
		$idcabang = $this->input->get('idcabang');
		$data = $this->mg->getWhere('dokterfaskes', ['idcabang' => $idcabang])->result_array();
		json($data);
	}
	public function getPetugas() {
		cek_session($this->idMenu);
		$idcabang = $this->input->get('idcabang');
		$data = $this->mg->getWhere('petugasfaskes', ['idcabang' => $idcabang])->result_array();
		json($data);
	}
	public function getStatusPemeriksaan() {
		cek_session($this->idMenu);
		$data = ['Pemeriksaan Sample', 'Selesai'];
		json($data);
	}
	public function getStatusKirimHasil() {
		cek_session($this->idMenu);
		$data = [
			['id' => 0, 'status' => 'Belum Dikirim'],
			['id' => 1, 'status' => 'Sudah Dikirim']
		];
		json($data);
	}
	public function getAllInstansi() {
		cek_session($this->idMenu);
		$data = $this->mg->getAll('masterinstansi')->result_array();
		json($data);
	}
	public function getAllPicMarketing() {
		cek_session($this->idMenu);
		$data = $this->mg->getWhere('hrm_staffprofile', ['position_id' => 25])->result_array();
		for($i=0; $i < count($data); $i++) {
			$data[$i]['nama'] = $data[$i]['first_name'].' '.$data[$i]['last_name'];
		}
		json($data);
	}
	public function getAllPaketPemeriksaan() {
		cek_session($this->idMenu);
		$data = $this->model->getPaketPemeriksaan();
		json($data);
	}
	public function getAllCabang() {
		cek_session($this->idMenu);
		$data = $this->model->getAllCabang();
		json($data);
	}
	public function getAllStatus() {
		cek_session($this->idMenu);
		$data = [
			['id' => 0, 'status' => 'Belum Selesai'],
			['id' => 1, 'status' => 'Selesai'],
		];
		json($data);
	}
	public function actionEditHasil() {
        cek_session($this->idMenu);
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
        	$form = (array)json_decode(file_get_contents('php://input'));
        	$this->mg->UpdateData('regperiksa', $form, ['id' => $form['id']]);
			$this->mg->LogActivitas('Merubah/Menginput Hasil Laboratorium atas nama : '.$form['nama']." dengan NIK : ".$form['nik']);
        	$status = true;
        	$remarks = 'Berhasil mengubah data';
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $status = false;
            $remarks = $e->getMessage();
            $this->db->trans_rollback();
            $this->mg->LogError(current_url(),  $e->getMessage());
        }
        json($form, $status, $remarks);
	}
	public function hapus() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = 'Successfully deleted data'; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try { 
            $datennow = date('Y-m-d H:i:s');
            $id = $this->input->get('id');
            $post = true;
            if($post) {
                $this->ModelGeneral->DeleteData('inv_ecommerce', ['id' => $id]);
                $this->ModelGeneral->LogActivity('Process Delete E-Commerce : '.$id);
                $this->db->trans_complete();
                $this->db->trans_commit();  
            }else{
                $response['status_json'] = false;
                $response['remarks'] = 'number or name is already exists'; 
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
	public function action_edithasil(){
        $this->cek_session();
        $session 		= $this->session->userdata('login');
		$user_id		= $session['id'];
		$level_user		= $session['level'];
		$nama_user		= $session['nama'];
		$email_user		= $session['email'];
		$phone_user		= $session['phone'];
		$foto_user		= $session['foto'];
        
        $waktukirim = date('is');
        
		$id = $this->input->post('id');
        
       if($this->input->post('barcode') == 'SS' or $this->input->post('barcode') == 'SB' or $this->input->post('barcode') == 'S04' or $this->input->post('barcode') == 'S10' or $this->input->post('barcode') == 'S20'){
            $ncov		     = $this->input->post('ncov');
            
			$fam		= $this->input->post('fam');
			$rox		= $this->input->post('rox');
            $uraianfam		= $this->input->post('uraianfam');
			$uraianrox		= $this->input->post('uraianrox');
			$vic	        = $this->input->post('vic');
            
            $lgm	      = '';
			$lgg		= '';
			$antigen		= '';
            $mcr		= '';
			
        }else if($this->input->post('barcode') == 'RA'){
            $ncov		     = '';
			$fam		= '';
			$rox		= '';
            $uraianfam		= '';
			$uraianrox		= '';
			$vic	        = '';
            $lgm	      = $this->input->post('lgm');
			$lgg		= $this->input->post('lgg');
            $antigen		= '';
            $mcr		= '';
			
        }else if($this->input->post('barcode') == 'SA'){
            $ncov		     = '';
			$fam		= '';
			$rox		= '';
            $uraianfam		= '';
			$uraianrox		= '';
			$vic	        = '';
            $lgm	      = '';
			$lgg		= '';
            $antigen		= $this->input->post('antigen');
            $mcr		= '';
			
        }else if($this->input->post('barcode') == 'SM'){
            $ncov		     = '';
			$fam		= '';
			$rox		= '';
            $uraianfam		= '';
			$uraianrox		= '';
			$vic	        = '';
            $lgm	      = '';
			$lgg		= '';
            $antigen		= '';
            $mcr		= $this->input->post('mcr');
			
        }else {
            $ncov		     = '';
			$fam		= '';
			$rox		= '';
            $uraianfam		= '';
			$uraianrox		= '';
			$vic	        = '';
            $lgm	      = '';
			$lgg		= '';
			$antigen		= '';
			$mcr		= '';
        }
        
        $nik = $this->input->post('nik');
        $nama = trim($this->RemoveSpecialChar($this->input->post('nama')));
        $nama = str_replace(" ","_",$nama);
        $urlhasil = base_url()."filehasilm/".$waktukirim.$id."-".$nama.".pdf";
        $urlhasil2 = '';
            
        if($this->input->post('idfaskes') == '31' or $this->input->post('idinstansi') == '699'){
            $urlhasil2 = base_url()."filehasilm/".'2'.$waktukirim.$id."-".$nama.".pdf";
        }
        
        $datahasil=array( 
            'nik' => $this->input->post('nik'),
            'nopassport' => $this->input->post('nopassport'),
            'nationality' => $this->input->post('nationality'),
            'nama' => trim($this->RemoveSpecialChar($this->input->post('nama'))),
            'jeniskelamin' => $this->input->post('jeniskelamin'),
            'tempatlahir' => $this->input->post('tempatlahir'),
            'tanggallahir' => $this->input->post('tanggallahir'),
            'nomorhp' => $this->input->post('nomorhp'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
			'tanggalsampling'		=> $this->input->post('tanggalsampling'),
			'tanggalperiksa'		=> $this->input->post('tanggalperiksa'),
			'tanggalselesai'		=> $this->input->post('tanggalselesai'),
            'jamsampling'		=> $this->input->post('jamsampling'),
			'jamperiksa'		=> $this->input->post('jamperiksa'),
			'jamselesai'		=> $this->input->post('jamselesai'),
			'jenissample'		=> $this->input->post('jenissample'),
			'iddokter'		=> $this->input->post('iddokter'),
			'idpetugas'		=> $this->input->post('idpetugas'),
			'ncov'		=> $ncov,
			'fam'		=> $fam,
			'rox'		=> $rox,
            'uraianfam'		=> $uraianfam,
			'uraianrox'		=> $uraianrox,
			'vic'		=> $vic,
            
            'lgm'		=> $lgm,
			'lgg'		=> $lgg,
			'antigen'		=> $antigen,
			'mcr'		=> $mcr,
			
			'url_hasil'		=> $urlhasil,
			'url_hasil_afiliasi'		=> $urlhasil2,
			'statustransaksi'		=> $this->input->post('statustransaksi'),
            'idinstansi' => $this->input->post('idinstansi'),
            'idfaskes' => $this->input->post('idfaskes'),
            'statuskirimhasil' => $this->input->post('statuskirimhasil'),
            'statushadir' => 'Hadir',
            'modified_date' => date('Y-m-d H:i:s'),
            'modified_by' => $user_id,
		);  
        
		$this->m_registrasi->UpdateData('regperiksa', $datahasil, ['id' => $id]);
        $log = [ 
			'waktu'		=> date('Y-m-d H:i:s'),
			'aktivitas'	=> 'Merubah/Menginput Hasil Laboratorium atas nama : '.$nama." dengan NIK : ".$nik,
			'iduser'	=> $user_id,
		];
        $this->m_registrasi->InsertData('logaktivitas',$log);
		$this->execHasilSwabn($id,$waktukirim,$nama);
        if($this->input->post('idfaskes') == '31' or $this->input->post('idinstansi') == '699') {
			$this->execHasilSwabn2($id,$waktukirim,$nama);
        }
        echo "<script>alert('Data Berhasil Tersimpan');window.location='".base_url()."laboratorium/inputhasil/".$id."';</script>";
	}
}
