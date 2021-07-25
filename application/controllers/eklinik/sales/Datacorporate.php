<?php defined('BASEPATH') or exit('No direct script access allowed');
class Datacorporate extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['form', 'url']);
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('eklinik/sales/ModelDataCorporate', 'model');
	}
	protected $idMenu = '2325AC81-7D7F-4218-9A13-348367B47786';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'			=> 'Data Corporate',
			'count_ms'		=> 99,
			'sess'			=> $session,
			'menus'			=> getMenu($session['user_id']),
			'apps'			=> $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
            // 'getitem'		=> $this->ModelRegistrasiCorporate->getCorporate("order by id asc"),
            // 'marketing'		=> $this->ModelRegistrasiCorporate->getMarketing(" WHERE is_active='1' AND s.departement_id ='7'")
		];
		$this->load->view('eklinik/sales/v_data_corporate', $data);
	}
	public function getCorporate() {
		cek_session($this->idMenu);
		$id = $this->input->get('id');
		$data = (!$id)? $this->model->getAllMasterInstansi() : $this->mg->getWhere('masterinstansi', ['id' => $id])->row_array();
		json($data);
	}
	public function getAllMarketing() {
		cek_session($this->idMenu);
		$data = $this->mg->getWhere('hrm_staffprofile', [
			'status'			=> 1,
			'departement_id'	=> 7
		])->result_array();
		json($data);
	}
	public function getAllKota() {
		cek_session($this->idMenu);
		$data = $this->model->getAllKota();
		json($data);
	}
	public function simpanDataCorporate(){
        cek_session($this->idMenu);
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
            $input = $this->input;
            $id = $input->get('id');
            $form = [
            	'pic_m'				=> $input->get('picMarketing'),
				'kota'				=> $input->get('kota'),
				'instansi'			=> $input->get('namaInstansi'),
				'no_telp'			=> $input->get('nomorTelepon'),
				'pic_nama'			=> $input->get('namaPIC'),
				'pic_nomorhp'		=> $input->get('nomorHP'),
				'pic_email'			=> $input->get('email'),
				'alamat'			=> $input->get('alamat'),
				'hargasm'			=> $input->get('hargaSwabMolekular'),
				'hargass'			=> $input->get('hargaSwabSameday'),
				'hargasb'			=> $input->get('hargaSwabBasic'),
				'hargara'			=> $input->get('hargaRapidTest'),
				'limitbiaya'		=> $input->get('limitPembayaran'),
				'tanggalregistrasi'	=> date('Y-m-d')
            ];
            $cek = $this->mg->getWhere('masterinstansi', ['instansi' => $form['instansi']])->row_array();
            if(!$id) {
            	if($cek) {
            		$status = false;
	            	$remarks = 'Instansi telah terdaftar';
	            	$this->db->trans_rollback();
            	} else {
            		$form['created_date'] = date('Y-m-d');
            		$this->mg->InsertData('masterinstansi', $form);
	            	$instansi = $this->mg->getWhere('masterinstansi', $form)->row_array();
	            	$this->ModelGeneral->LogActivity('Process Add Instansi : '.$instansi['id']);
	            	$status = true;
	            	$remarks = 'Berhasil menambahkan data';
            	}
            } else {
            	if(!$cek) {
            		$status = false;
	            	$remarks = 'Instansi belum terdaftar';
	            	$this->db->trans_rollback();
            	} else {
            		$form['modified_date'] = date('Y-m-d');
            		$this->mg->UpdateData('masterinstansi', $form, ['id' => $id]);
            		$this->ModelGeneral->LogActivity('Process Edit Instansi : '.$id);
	            	$status = true;
	            	$remarks = 'Berhasil mengubah data';
            	}
            }
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $status = false;
            $remarks = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        } 
        json('', $status, $remarks);
    }
}
