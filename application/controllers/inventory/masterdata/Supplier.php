<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller {
    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(['form', 'url']);
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral', 'mg');
        $this->load->model('inventory/masterdata/ModelSupplier', 'ms');
    }
    var $idMenu = 'accb9cda-b3bf-4d30-9a73-74db95a0711c';
    public function index() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date('Y-m-d');
        $data = [
            'datenow'       => date('d-m-Y', strtotime($date)),
            'title'         => 'Data Supplier',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp
        ];
        $this->load->view('inventory/masterdata/v_supplier', $data);
    }
    public function getAllSupplier() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ms->getAllSupplier();
        foreach ($datas as $d) {
            $data[] = [
                'kode'      => $d['kode'],
                'nama'      => $d['nama'],
                'alamat'    => $d['alamat'],
                'telp'      => $d['telp'],
                'email'     => $d['email'],
                'cp'        => $d['cp'],
                'edit'      => '<button class="btn btn-info btn-sm" onclick="return addEdit(\'Edit\', '. $d['id'].')"><i class="fa fa-edit"></i> Edit</a></button>',
                'hapus'     => '<button class="btn btn-danger btn-sm" onclick="return hapusModal(\''.$d['id'].'\')"> <i class="fa fa-trash"></i> Hapus</a></button>'
            ];
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    }
    public function simpan() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [];
        $response['status_json'] = true;
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
            $input = $this->input;
            $judul = $input->post('judul');
            $idSupplier = $input->post('idSupplier');
            $form = [
                'kode'      => $this->_kodeSupplier(),
                'nama'      => strtoupper(htmlspecialchars($input->post('nama'))),
                'alamat'    => strtoupper(htmlspecialchars($input->post('alamat'))),
                'telp'      => htmlspecialchars($input->post('telp')),
                'email'     => strtolower(htmlspecialchars($input->post('email'))),
                'cp'        => htmlspecialchars($input->post('cp'))
            ];
            $post = true;
            if($post) {
                if( $judul == 'Add') {
                    $check = $this->mg->getWhere('inv_supplier', [
                        'kode'  => $form['kode'],
                        'nama'  => $form['nama']
                    ])->row_array();
                    if($check) {
                        $response['status_json'] = false;
                        $response['remarks'] = 'Supplier sudah terdaftar'; 
                        $this->db->trans_rollback();
                    } else {
                        $this->mg->InsertData('inv_supplier', $form);
                        $this->mg->LogActivity('Process Insert New Supplier : '.$form['kode']);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully saved new data"; 
                    }
                } else {
                    $check = $this->mg->getWhere('inv_supplier', ['id' => $idSupplier])->row_array();
                    if($check) {
                        $this->mg->UpdateData('inv_supplier', $form, ['id' => $idSupplier]);
                        $this->mg->LogActivity('Process Update New Supplier : '.$form['kode']);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully changed data"; 
                    } else {
                        $response['status_json'] = false;
                        $response['remarks'] = "Sub Kategori tidak valid!"; 
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
            $this->mg->LogError(current_url(),  $e->getMessage());
        }
        echo json_encode($response);
    }
    private function _kodeSupplier() {
        $kodeSupplier = 'SP';
        $cek = $this->ms->getKodeSupplier($kodeSupplier);
        if ($cek[0]['kode'] == "") {
            $kode = "001";
        } else {
            $nomor = intval($cek[0]['kode']) + 1;
            $kode = str_pad($nomor, 3, "0", STR_PAD_LEFT);;
        }
        return 'SP'.$kode;
        
    }
    public function getSupplierById() {
        $id = $this->input->get('id');
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [
            'status_json'   => true,
            'data'          => $this->mg->getWhere('inv_supplier', ['id' => $id])->row_array()
        ];
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
                $this->mg->DeleteData('inv_supplier', ['id' => $code]);
                $this->mg->LogActivity('Process Delete Position : '.$code);
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
            $this->mg->LogError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }
}