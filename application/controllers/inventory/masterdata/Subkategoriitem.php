<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subkategoriitem extends CI_Controller {
    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(['form', 'url']);
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('inventory/masterdata/ModelSubKategoriItem', 'mski');
    }
    var $idMenu = '765a0558-59e6-4c73-a71e-cdc768dbf2e7';
    public function index() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date('Y-m-d');
        $data = [
            'datenow'       => date('d-m-Y', strtotime($date)),
            'title'         => 'Sub Kategori Item',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'allKategori'   => $this->mski->getAllKategori()
        ];
        $this->load->view('inventory/masterdata/v_subkategoriitem', $data);
    }
    public function getAllSubKategori() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [];
        $response['status_json'] = true;
        $datas = $this->mski->getAllSubKategori();
        $no = 1;
        foreach ($datas as $d) {
            $data[] = [
                'no'            => $no++,
                'kategori'      => $d['kategori'],
                'subkategori'   => $d['subkategori'],
                'edit'          => '<button type="button" class="edit_record btn btn-info btn-sm" onclick="return addEdit(\'Edit\','. $d['idkategori'].','. $d['id'].', \''.$d['subkategori'].'\')"><i class="fa fa-edit"></i>&nbsp;Edit</a></button>',
                'hapus'         => '<button type="button" class="edit_record btn btn-danger btn-sm" onclick="return hapusModal(\''.$d['id'].'\')"> <i class="fa fa-trash"></i>&nbsp;Hapus</a></button>'
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
            $judul = $this->input->post('judul');
            $subKategori = $this->input->post('subKategori');
            $idKategori = $this->input->post('idKategori');
            $idSubKategori = $this->input->post('idSubKategori');
            $post = true;
            if($post) {
                if( $judul == 'Add') {
                    $check = $this->mski->getSubKategori([
                        'idkategori'    => $idKategori,
                        'subkategori'   => $subKategori
                    ]);
                    if($check) {
                        $response['status_json'] = false;
                        $response['remarks'] = "Sub Kategori sudah ada!"; 
                        $this->db->trans_rollback();
                    } else {
                        $this->ModelGeneral->InsertData('inv_subkategori', [
                            'idkategori'    => $idKategori,
                            'subkategori'   => $subKategori
                        ]);
                        $this->ModelGeneral->LogActivity('Process Insert New Category : '.$subKategori);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully saved new data"; 
                    }
                } else {
                    $check = $this->mski->getSubKategori(['id' => $idSubKategori]);
                    if($check) {
                        $this->ModelGeneral->UpdateData('inv_subkategori', [
                            'idkategori'    => $idKategori,
                            'subkategori'   => $subKategori
                        ], ['id' => $idSubKategori]);
                        $this->ModelGeneral->LogActivity('Process Update New Category : '.$subKategori);
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
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        }
        echo json_encode($response);
    }
    public function getSubKategoriById() {
        $id = $this->input->get('id');
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [
            'status_json'   => true,
            'data'          => $this->mski->getSubKategori(['id' => $id])
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
                $this->ModelGeneral->DeleteData('inv_subkategori', ['id' => $code]);
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