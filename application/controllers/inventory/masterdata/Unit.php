<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller {
	function __construct() {
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(['form', 'url']);
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('inventory/masterdata/ModelUnit', 'mu');
	}
	var $idMenu = '631ca6b2-60c9-4dd1-a069-bf6b25256596';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
        $date = date('Y-m-d');
        $data = [
            'datenow'       => date('d-m-Y', strtotime($date)),
            'title'         => 'Unit Satuan',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp
        ];
        $this->load->view('inventory/masterdata/v_unit', $data);
	}
    public function getAllUnit() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [];
        $response['status_json'] = true;
        $datas = $this->mu->getAllUnit();
        $no = 1;
        foreach($datas as $d) {
            $data[] = [
                'no'    => $no++,
                'unit'  => $d['unit'],
                'edit'  => '<button type="button" class="btn btn-info btn-sm" onclick="addEdit(\'Edit\', '.$d['id'].')"><i class="fa fa-edit"></i> Edit</button>',
                'hapus' => '<button type="button" class="btn btn-danger btn-sm" onclick="hapusModal('.$d['id'].')"><i class="fa fa-trash"></i> Hapus</button>'
            ];
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    }
    public function getUnitById() {
        $id = $this->input->get('id');
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [];
        $response['status_json'] = true;
        $datas = $this->mu->getUnit(['id' => $id]);
        $response['data'] = (count($datas) > 0)? $datas : [];
        echo json_encode($response);
    }
    public function simpan(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
            $input = $this->input;
            $judul = $input->post('judul');
            $unit = $input->post('unit');
            $idUnit = $input->post('idUnit');
            $post = true;
            if($post) {
                if($judul == 'Add') {
                    $check = $this->mu->getUnit(['unit' => $unit]);
                    if($check) {
                        $response['status_json'] = false;
                        $response['remarks'] = "Unit sudah ada!"; 
                        $this->db->trans_rollback();
                    } else {
                        $this->ModelGeneral->InsertData('inv_unit', ['unit' => $unit]);
                        $this->ModelGeneral->LogActivity('Process Insert New Unit : '.$unit);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully saved new data"; 
                    }
                } else {
                    $check = $this->mu->getUnit(['id' => $idUnit]);
                    if($check) {
                        $this->ModelGeneral->UpdateData('inv_unit', ['unit' => $unit], ['id' => $idUnit]);
                        $this->ModelGeneral->LogActivity('Process Update Unit : '.$unit);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully changed data"; 
                    } else {
                        $response['status_json'] = false;
                        $response['remarks'] = "Unit tidak valid!"; 
                        $this->db->trans_rollback();
                    }
                }
            } else {
                $response['status_json'] = false;
                $response['remarks'] = "Unable to save new data"; 
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
    public function hapus() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Successfully deleted data"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try { 
            $datennow = date('Y-m-d H:i:s');
            $code = $this->input->post('idHapus');
            $post = true;
            if($post) {
                $this->ModelGeneral->DeleteData('inv_unit', ['id' => $code]);
                $this->ModelGeneral->LogActivity('Process Delete Position : '.$code);
                $this->db->trans_complete();
                $this->db->trans_commit();  
            } else {
                $response['status_json'] = false;
                $response['remarks'] = "number or name is already exists"; 
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
}