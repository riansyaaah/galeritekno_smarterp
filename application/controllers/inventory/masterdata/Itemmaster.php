<?php defined('BASEPATH') or exit('No direct script access allowed');
class Itemmaster extends CI_Controller {
	function __construct() {
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper(['form', 'url']);
        $this->load->model('ModelGeneral', 'mg');
        $this->load->model('inventory/masterdata/ModelItemMaster', 'model');
	}
	protected $idMenu = 'a2c92e9f-074c-4873-8258-57b1a605ef84';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
        $data = [
            'title'         => 'Item Master',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $this->session->userdata('applications'),
            'current_app'   => $this->session->userdata('current_app'),
            'allKategori'   => $this->mg->getAll('inv_kategori')->result_array(),
            'allUnit'       => $this->mg->getAll('inv_unit')->result_array()
        ];
        $this->load->view('inventory/masterdata/itemmaster/index', $data);
	}
    private function _json($data, $statusJson = true, $remarks = '') {
        header('Content-Type: application/json');
        echo json_encode([
            'status_json'   => $statusJson,
            'data'          => $data,
            'remarks'       => $remarks
        ]);
    }
    public function getFixed() {
    	cek_session($this->idMenu);
    	$data = [[1, 'Fixed'], [2, 'Non Fixed']];
    	json($data);
    }
    public function getAllAccount() {
    	cek_session($this->idMenu);
    	$data = $this->mg->getAll('fin_accountbalance')->result_array();
    	for($i=0; $i<count($data); $i++) {
    		$data[$i]['btn'] = '<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button>';
    	}
    	json($data);
    }
    public function getSifat() {
    	cek_session($this->idMenu);
    	$data = [[1, 'BHP'], [2, 'Non BHP']];
    	json($data);
    }
    public function getItemMaster() {
        cek_session($this->idMenu);
        $id = $this->input->get('id');
        $data = $this->mg->getWhere('inv_itemmaster', ['id' => $id])->row_array();
        $this->_json($data);
    }
    public function getAllItemMaster() {
        cek_session($this->idMenu);
        $data = $this->model->getAllItemMaster();
        for($i=0; $i<count($data); $i++) {
        	$data[$i]['fixed'] = ($data[$i]['fixed'] == 1)? 'Fixed' : 'Non Fixed';
        	$data[$i]['bhp'] = ($data[$i]['bhp'] == 0)? '-' : (($data[$i]['bhp'] == 1)? 'BHP' : 'Non BHP');
        }
        $this->_json($data);
    }
    public function getAllKategori() {
        cek_session($this->idMenu);
        $data = $this->mg->getAll('inv_kategori')->result_array();
        $this->_json($data);
    }
    public function getAllUnit() {
        cek_session($this->idMenu);
        $data = $this->mg->getAll('inv_unit')->result_array();
        $this->_json($data);
    }
    public function saveItem() {
        cek_session($this->idMenu);
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
            $input = $this->input;
            $status = $input->get('status');
            $form = [
                'idkategori'        => $input->get('kategori'),
                'itemmaster'        => $input->get('namaItem'),
                'unitTerbesar'      => $input->get('unitTerbesar'),
                'unit'              => $input->get('unitTerkecil'),
                'jumlahTerkecil'    => $input->get('jmlTerkecil'),
                'fixed'				=> $input->get('fixed'),
                'bhp'				=> $input->get('bhp'),
                'accountNo'			=> $input->get('accountNo')
            ];
            $cek = $this->mg->getWhere('inv_itemmaster', [
                'idkategori'    => $form['idkategori'],
                'itemmaster'    => $form['itemmaster']
            ])->row_array();
            if($status == 1) {
                if($cek) {
                    $statusJson = false;
                    $remarks = 'Data telah terdaftar';
                    $this->db->trans_rollback();
                } else {
                	$form['jumlahTerbesar'] = 1;
                	$form['stokTerbesar'] = 0;
                	$form['stock'] = $form['stokTerbesar']*$form['jumlahTerkecil'];
                    $this->mg->InsertData('inv_itemmaster', $form);
                    $this->mg->LogActivity('Process Insert Item : '.$form['idkategori']);
                    $statusJson = true;
                    $remarks = 'Data berhasil ditambahkan';
                }
            } else {
                if(!$cek) {
                    $statusJson = false;
                    $remarks = 'Data tidak terdaftar';
                    $this->db->trans_rollback();
                } else {
                    $this->mg->UpdateData('inv_itemmaster', $form, ['id' => $cek['id']]);
                    $this->mg->LogActivity('Process Edit Item : '.$form['idkategori']);
                    $statusJson = true;
                    $remarks = 'Data berhasil diubah';
                }
            }
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $statusJson = false;
            $remarks = $e->getMessage();
            $this->db->trans_rollback();
            $this->mg->LogError(current_url(),  $e->getMessage());
        }
        $this->_json('', $statusJson, $remarks);
    }
    public function hapusItem() {
        cek_session($this->idMenu);
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
            $id = $this->input->get('id');
            $cek = $this->mg->getWhere('inv_itemmaster', ['id' => $id])->row_array();
            if(!$cek) {
                $statusJson = false;
                $remarks = 'Data tidak terdaftar';
                $this->db->trans_rollback();
            } else {
                $this->mg->DeleteData('inv_itemmaster', ['id' => $cek['id']]);
                $this->mg->LogActivity('Process Delete Item : '.$cek['id']);
                $statusJson = true;
                $remarks = 'Data berhasil dihapus';
            }
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $statusJson = false;
            $remarks = $e->getMessage();
            $this->db->trans_rollback();
            $this->mg->LogError(current_url(),  $e->getMessage());
        }
        $this->_json('', $statusJson, $remarks);
    }
}