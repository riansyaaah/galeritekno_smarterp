<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Stockout extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pdf');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('inventory/transaction/ModelStockout', 'ms');
	}
	protected $idMenu = '0337f320-ed75-4934-8cb4-3611db0bc61b';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'Barang Keluar',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'periode'		=> $this->mg->getWhere('periode', ['Active' => 1])->row_array()['ThnBln'],
		];
		$this->load->view('inventory/transaction/stockout/index', $data);
	}
	private function _json($data, $statusJson = true, $remarks = '') {
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> $statusJson,
			'data'			=> $data,
			'remarks'		=> $remarks
		]);
	}
	public function getAllDetail() {
		cek_session($this->idMenu);
		$id = $this->input->post('id');
		$data = $this->ms->getAllDetail($id);
		$this->_json($data);
	}
	public function getAllOutgoing() {
		cek_session($this->idMenu);
		$data = $this->ms->getAllOutgoing();
		for($i=0; $i<count($data); $i++) {
			$data[$i]['tglTransaction'] = date('Y-m-d', $data[$i]['tglTransaction']);
		}
		$this->_json($data);
	}
}