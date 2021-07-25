<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Listinternalpo extends CI_Controller {
	public function __Construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pdf');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('inventory/purchasing/ModelListInternalPO', 'model');
	}
	protected $idMenu = '6d2117ad-864f-4964-b768-e733ff77415c';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'List Internal PO',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'periode'		=> $this->ModelGeneral->getWhere('periode', ['Active' => 1])->row_array()['ThnBln'],
			'level'			=> $this->_level($session)
		];
		$this->load->view('inventory/purchasing/listinternalpo/index', $data);
	}
	private function _json($data, $statusJson = true, $remarks = '') {
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> $statusJson,
			'data'			=> $data,
			'remarks'		=> $remarks
		]);
	}
	private function _level($session) {
		cek_session($this->idMenu);
		$user = $this->model->getUser($session['user_id']);
		$manager = $this->model->getManager($user['departement_id']);
		if($user['position_id'] == 13 || $user['user_id'] == 1) {
			$level = 1;
		} elseif($user['position_id'] == $manager['id']) {
			$level = 2;
		} else {
			$level = 3;
		}
		return $level;
	}
	public function getAllItem() {
		cek_session($this->idMenu);
		$data = $this->model->getAllItem();
		$this->_json($data);
	}
	public function getPO() {
		cek_session($this->idMenu);
		$id = $this->input->get('id');
		$data = ($id)? $this->mg->getWhere('inv_purchaseorder', ['id' => $id])->row_array() : $this->model->getAllPO();
		$this->_json($data);
	}
	public function getPODetail() {
		cek_session($this->idMenu);
		$input = $this->input;
		$noPO = ($input->post('noPO'))? $input->post('noPO') : $input->get('noPO');
		$data = $this->model->getAllPODetail($noPO);
		$this->_json($data);
	}
	public function getAllSupplier() {
		cek_session($this->idMenu);
		$data = $this->model->getAllSupplier();
		$this->_json($data);
	}
	public function konfirmasi() {
		cek_session($this->idMenu);
		$statusJson = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$idUser = $this->session->userdata('login')['user_id'];
			$input = $this->input;
			$noPO = $input->get('noPO');
			$detail = $this->model->getAllPODetail($noPO);
			foreach($detail as $d) {
				$jml = $input->get('jmlReview'.$d['id']);
				if($jml) {
					$this->mg->UpdateData('inv_purchaseorder_detail', ['jmlReview' => $jml], ['id' => $d['id']]);
				} elseif($jml === '0') {
					$this->mg->UpdateData('inv_purchaseorder_detail', ['jmlReview' => 0], ['id' => $d['id']]);
				}
			}
			$this->mg->UpdateData('inv_purchaseorder', ['checkedBy' => $idUser], ['noPO' => $noPO]);
			$this->mg->LogActivity('Process confirm PO : '.$noPO);
			$remarks = 'Berhasil mengkonfirmasi request';
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