<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Swaberrequest extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['form', 'url']);
		$this->load->library('pdf');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('inventory/request/ModelSwaberRequest', 'model');
	}
	protected $idMenu = '7cfb6011-7d65-4fba-bc6d-e3e94fc2e2e4';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'Swaber Request',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'periode'		=> $this->mg->getWhere('periode', ['Active' => 1])->row_array()['ThnBln']
		];
		$this->load->view('inventory/request/swaberrequest/index', $data);
	}
	private function _json($data, $statusJson = true, $remarks = '') {
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> $statusJson,
			'data'			=> $data,
			'remarks'		=> $remarks
		]);
	}
	public function generateNoReq() {
		cek_session($this->idMenu);
		$periode   = $this->ModelGeneral->getWhere('periode', ['Active' => 1])->row_array()['ThnBln'];
		$noReq = '/REQ/'.$periode;
		$cek = $this->model->getRequest($noReq);
		if ($cek[0]['noReq'] == '') {
			$data['noPO'] = '001';
		} else {
			$nomor = intval($cek[0]['noReq']) + 1;
			$data['noPO'] = str_pad($nomor, 3, '0', STR_PAD_LEFT);;
		}
		$this->_json($data['noPO'].'/REQ/'.$periode);
	}
	public function generateNoTransaction() {
		$periode   = $this->ModelGeneral->getWhere('periode', ['Active' => 1])->row_array()['ThnBln'];
		$noTransaction = '/OUT/'.$periode;
		$cek = $this->model->getNoTransaction($noTransaction);
		if ($cek[0]['noTransaction'] == '') {
			$data['noTransaction'] = '001';
		} else {
			$nomor = intval($cek[0]['noTransaction']) + 1;
			$data['noTransaction'] = str_pad($nomor, 3, '0', STR_PAD_LEFT);;
		}
		return $data['noTransaction'].$noTransaction;
	}
	public function getAllItemLab() {
		cek_session($this->idMenu);
		$data = $this->model->getAllItemLab();
		$this->_json($data);
	}
	public function getTransactionDetail() {
		cek_session($this->idMenu);
		$input = $this->input;
		$noReq = ($input->get('noReq'))? $input->get('noReq') : $input->post('noReq');
		$transaction = $this->mg->getWhere('inv_transaction', ['noRequest' => $noReq])->row_array();
		$transactionDetail = $this->model->getTransactionDetail($transaction['id']);
		$this->_json($transactionDetail);
	}
	public function coba() {
		$data = $this->mg->getWhere('inv_request', ['id' => 140])->row_array();
		var_dump(date('Y-m-d H:i', $data['jamAmbil']));die;
	}
	public function buatRequest() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$session = $this->session->userdata('login');
			$user = $this->model->getUser($session['user_id']);
			$input = $this->input;
			$noReq = $input->get('noReq');
			$request = $this->mg->getWhere('inv_request', ['noReq' => $noReq])->row_array();
			if($request) {
				$statusJson = false;
				$remarks = 'No request telah terdaftar';
				$this->db->trans_rollback();
			} else {
				$form = [
					'idDepartment'	=> $user['departement_id'],
					'createdBy'		=> $user['id'],
					'noReq'			=> $noReq,
					'tglReq'		=> time(),
					'jamAmbil'		=> strtotime($input->get('tanggal').' '.$input->get('jamAmbil')),
					'lokasi'		=> $input->get('lokasi'),
					'totalPasien'	=> $input->get('totalPasien'),
					'keperluan'		=> $input->get('keperluan')
				];
				$this->mg->InsertData('inv_request', $form);
				$this->mg->InsertData('inv_transaction', [
					'noTransaction'		=> $this->generateNoTransaction(),
					'tglTransaction'	=> $form['tglReq'],
					'typeTransaction'	=> 1,
					'idDepartment'		=> $user['departement_id'],
					'noRequest'			=> $form['noReq']
				]);
				$this->mg->LogActivity('Process Create Swaber Request : '.$form['noReq']);
				$statusJson = true;
				$remarks = 'Berhasil membuat request';
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
	public function saveRequest() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$noReq = $input->get('noReq');
			$request = $this->mg->getWhere('inv_request', ['noReq' => $noReq])->row_array();
			$transaction = $this->mg->getWhere('inv_transaction', ['noRequest' => $noReq])->row_array();
			if(!$request) {
				$statusJson = false;
				$remarks = 'No request tidak terdaftar';
				$this->db->trans_rollback();
			} else {
				$itemAll = $this->model->getAllItemLab();
				foreach($itemAll as $item) {
					$jumlah = $input->get('jumlah'.$item['id']);
					$form = [
						'idRequest'		=> $request['id'],
						'idItemMaster'	=> $item['id'],
						'jumlah'		=> $jumlah
					];
					$this->mg->InsertData('inv_request_detail', $form);
					$sisaStockKecil = $item['stock']-$jumlah;
					$sisaStockBesar = ceil($sisaStockKecil/$item['jumlahTerkecil']);
					$this->mg->UpdateData('inv_itemmaster', [
						'stock'			=> $sisaStockKecil,
						'stokTerbesar'	=> $sisaStockBesar
					], ['id' => $item['id']]);
					$this->mg->InsertData('inv_transaction_detail', [
						'idTransaction'		=> $transaction['id'],
						'jumlah_act'		=> $jumlah,
						'idItemMaster'		=> $item['id']
					]);
					$transaksiDetail = $this->mg->getWhere('inv_transaction_detail', [
						'idTransaction'		=> $transaction['id'],
						'idItemMaster'		=> $item['id']
					])->row_array();
					$this->mg->InsertData('inv_rekapitulasi', [
						'idTransaksiDetail'	=> $transaksiDetail['id'],
						'jmlAwal'			=> $item['stock'],
						'jmlAkhir'			=> $sisaStockKecil
					]);
				}
				$statusJson = true;
				$remarks = 'Berhasil menyimpan request';
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