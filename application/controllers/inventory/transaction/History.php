<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller {
	function __Construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['form', 'url']);
		$this->load->library('pdf');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('inventory/transaction/ModelHistory', 'model');
	}
	protected $idMenu = '568534b2-da2c-4677-a639-8dbe7478867a';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'Riwayat Transaksi',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'PeriodeActive'	=> $this->mg->getWhere('periode', ['Active' => 1])->row_array()['ThnBln'],
			'level'			=> $this->_level()
		];
		$this->load->view('inventory/transaction/v_history', $data);
	}
	private function _level() {
		$session = $this->session->userdata('login');
		$user = $this->model->getUser($session['user_id']);
		$manager = $this->model->getManager($user['departement_id']);
		if($user['user_id'] == 1 || $user['position_id'] == 13) {
			$level = 1;
		} elseif($user['position_id'] == $manager['id']) {
			$level = 2;
		} else {
			$level = 3;
		}
		return $level;
	}
	private function _json($data, $statusJson = true, $remarks = '') {
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> $statusJson,
			'data'			=> $data,
			'remarks'		=> $remarks
		]);
	}
	public function getAllTransaction() {
		cek_session($this->idMenu);
		$level = $this->_level();
		if($level == 1) {
			$datas = $this->model->getAllTransaction();
		} elseif($level == 2) {
			$session = $this->session->userdata('login');
			$user = $this->model->getUser($session['user_id']);
			$datas = $this->model->getAllTransactionManager($user['departement_id']);
		} else {
			$session = $this->session->userdata('login');
			$user = $this->model->getUser($session['user_id']);
			$datas = $this->model->getAllTransactionStaff($user['id']);
		}
		for($i=0; $i<count($datas); $i++) {
			$datas[$i]['no'] = $i+1;
			$datas[$i]['option'] = '<button onclick="detail('.$datas[$i]['id'].', '.$datas[$i]['typeTransaction'].', '.$datas[$i]['ecommerce'].')" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</button>';
			$datas[$i]['typeTransaction'] = ($datas[$i]['typeTransaction'] == 1)? 'Keluar' : 'Masuk';
			$datas[$i]['tglTransaction'] = date('Y-m-d', $datas[$i]['tglTransaction']);
		}
        $this->_json($datas);
	}
	public function getTransactionById() {
		cek_session($this->idMenu);
		$input = $this->input;
		$id = $input->get('id');
		$type = $input->get('type');
		$ecommerce = $input->get('ecommerce');
		$data = $this->model->getTransactionById($id, $type, $ecommerce);
		$data['tglTransaction'] = date('Y-m-d', $data['tglTransaction']);
		$data['noPo'] = ($data['noPo'])? $data['noPo'] : '-';
		$data['typeTransaction'] = ($data['typeTransaction'] == 1)? 'Keluar' : 'Masuk';
		$data['details'] = $this->model->getTrDetailByTrId($id);
		$data['total'] = 0;
		foreach($data['details'] as $detail) {
			$data['total'] += ($detail['harga_satuan']*$detail['jumlah_act']);
		}
		$data['total'] = number_format($data['total'], 0, ',', '.');
        $this->_json($data);
	}
	public function getTrDetailByTrId() {
		cek_session($this->idMenu);
		$id = $this->input->get('idTransaction');
		$datas = $this->model->getTrDetailByTrId($id);
		for($i=0; $i<count($datas); $i++) {
			$datas[$i]['no'] = $i+1;
			$datas[$i]['total'] = $datas[$i]['harga_satuan']*$datas[$i]['jumlah_act'];
			$datas[$i]['harga_satuan'] = number_format($datas[$i]['harga_satuan'], 0, ',', '.');
			$datas[$i]['total'] = number_format($datas[$i]['total'], 0, ',', '.');
			$datas[$i]['jumlah'] = ($datas[$i]['jumlah'])? $datas[$i]['jumlah'] : '-';
			$datas[$i]['kondisimasuk'] = ($datas[$i]['kondisimasuk'])? $datas[$i]['kondisimasuk'] : '-';
		}
		$this->_json($datas);
	}
}