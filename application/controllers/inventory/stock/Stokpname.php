<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Stokpname extends CI_Controller {
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper(['form', 'url']);
        $this->load->model('ModelGeneral', 'mg');
        $this->load->model('inventory/stock/ModelStokPname', 'model');
    }
    protected $idMenu = 'f8832de4-35f9-4674-abb2-48c428142a47';
    public function index() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $data = [
            'title'         => 'Stok Opname',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $this->session->userdata('applications'),
            'current_app'   => $this->session->userdata('current_app'),
            'sekarang'		=> date('Y-m-d')
        ];
        $this->load->view('inventory/stock/stokpname/index', $data);
    }
    public function getAllItem() {
        cek_session($this->idMenu);
        $data = $this->model->getAllItem();
        json($data);
    }
    public function getItem() {
    	cek_session($this->idMenu);
    	$id = $this->input->get('id');
        $data = $this->mg->getWhere('inv_itemmaster', ['id' => $id])->row_array();
        json($data);	
    }
    public function saveOpname() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$idItem = $input->get('idItem');
			$tanggal = $input->get('tanggal');
			$realStock = $input->get('realStock');
			$item = $this->mg->getWhere('inv_itemmaster', ['id' => $idItem])->row_array();
			if(!$item) {
				$statusJson = false;
				$remarks = 'Item tidak terdafar';
				$this->db->trans_rollback();
			} elseif(!is_numeric($realStock)) {
				$statusJson = false;
				$remarks = 'Input harus berupa angka';
				$this->db->trans_rollback();
			} else {
				$form = [
					'tglOpname'		=> strtotime($tanggal),
					'idItemMaster'	=> $item['id'],
					'jmlLama'		=> $item['stock'],
					'jmlBaru'		=> $realStock
				];
				$this->mg->InsertData('inv_stock_opname', $form);
				$this->mg->UpdateData('inv_itemmaster', [
					'stock'			=> $form['jmlBaru'],
					'stokTerbesar'	=> ceil($form['jmlBaru']/$item['jumlahTerkecil'])
				], ['id' => $item['id']]);
				$this->mg->LogActivity('Process Stock Opname : '.$item['id']);
				$statusJson = true;
				$remarks = 'Berhasil menyimpan data';
			}
			$this->db->trans_complete();
			$this->db->trans_commit();
		} catch (\Throwable $e) {
			$statusJson = false;
			$remarks = $e->getMessage();
			$this->db->trans_rollback();
			$this->mg->LogError(current_url(),  $e->getMessage());
		}
		json('', $statusJson, $remarks);
	}
}