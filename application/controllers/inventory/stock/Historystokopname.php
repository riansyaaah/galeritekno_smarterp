<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Historystokopname extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['form', 'url']);
		$this->load->library('pdf');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('inventory/transaction/ModelHistoryStokOpname', 'model');
	}
	protected $idMenu = '28EA73AD-9908-4633-89AB-04ED281A72EA ';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'Riwayat Stok Opname',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app')
		];
		$this->load->view('inventory/stock/historystokopname/index', $data);
	}
	public function getAllHistory() {
		cek_session($this->idMenu);
		$data = $this->model->getAllHistory();
		for($i=0; $i<count($data); $i++) {
			$data[$i]['tglOpname'] = date('Y-m-d', $data[$i]['tglOpname']);
		}
		json($data);
	}
}
