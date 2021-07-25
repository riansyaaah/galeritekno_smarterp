<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Listrequeststaff extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['form', 'url']);
		$this->load->library('pdf');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('inventory/request/ModelListRequestStaff', 'model');
	}
	protected $idMenu = '241d35a1-427e-4eb8-84dd-0e9a25b0b82a';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'List Request Staff',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'periode'		=> $this->mg->getWhere('periode', ['Active' => 1])->row_array()['ThnBln'],
			'level'			=> level()
		];
		$this->load->view('inventory/request/listrequeststaff/index', $data);
	}
	public function getAllKategori() {
		cek_session($this->idMenu);
		$data = $this->mg->getAll('inv_kategori')->result_array();
		json($data);
	}
	public function getAllUnit() {
		cek_session($this->idMenu);
		$data = $this->mg->getAll('inv_unit')->result_array();
		json($data);
	}
	public function getTransaction() {
		cek_session($this->idMenu);
		$no = $this->input->get('noTransaction');
		$transaksi = $this->mg->getWhere('inv_transaction', ['noTransaction' => $no])->row_array();
		$transaksi['tglTransaction'] = date('Y-m-d', $transaksi['tglTransaction']);
		json($transaksi);
	}
	public function getAllItemMaster() {
		cek_session($this->idMenu);
		$data = $this->model->getAllItemMaster();
		json($data);
	}
	public function getSingleItem() {
		cek_session($this->idMenu);
		$id = $this->input->get('id');
		$data = $this->mg->getWhere('inv_itemmaster', ['id' => $id])->row_array();
		json($data);	
	}
	public function getRequest() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$user = $this->model->getUser($session['user_id']);
		$level = level();
		$manager = $this->model->getManager($user['departement_id']);
		$id = $this->input->get('id');
		if($id) {
			$data = $this->mg->getWhere('inv_request', ['id' => $id])->row_array();
		} else {
			if($level == 1) {
				$data = $this->model->getAllRequest();
			} else if($level == 2) {
				$data = $this->model->getRequestManager($user['departement_id']);
			} else {
				$data = $this->model->getRequestStaff($user['id']);
			}
			for($i=0; $i<count($data); $i++) {
				$data[$i]['tglReq'] = date('Y-m-d', $data[$i]['tglReq']);
			}
		}
		json($data);
	}
	public function generateNoTransaction() {
		$periode   = $this->ModelGeneral->getWhere('periode', ['Active' => 1])->row_array()['ThnBln'];
		$noTransaction = '/OUT/'.$periode;
		$cek = $this->model->getNoTransaction($noTransaction);
		if($cek[0]['noTransaction'] == '') {
			$data['noTransaction'] = '001';
		} else {
			$nomor = intval($cek[0]['noTransaction']) + 1;
			$data['noTransaction'] = str_pad($nomor, 3, '0', STR_PAD_LEFT);;
		}
		json($data['noTransaction'].$noTransaction);
	}
	public function generateNoTransactionIn() {
		$periode   = $this->ModelGeneral->getWhere('periode', ['Active' => 1])->row_array()['ThnBln'];
		$noTransaction = '/IN/'.$periode;
		$cek = $this->model->getNoTransaction($noTransaction);
		if ($cek[0]['noTransaction'] == '') {
			$data['noTransaction'] = '001';
		} else {
			$nomor = intval($cek[0]['noTransaction']) + 1;
			$data['noTransaction'] = str_pad($nomor, 3, '0', STR_PAD_LEFT);;
		}
		return $data['noTransaction'].$noTransaction;
	}
	public function getRequestDetail() {
		cek_session($this->idMenu);
		$idUser = $this->session->userdata('login')['user_id'];
		$input = $this->input;
		$idDetail = $input->get('idDetail');
		if($idDetail) {
			$data = $this->mg->getWhere('inv_request_detail', ['id' => $idDetail])->row_array();
		} else {
			$data = $this->_request($input);
			for($i=0; $i<count($data); $i++) {
				$idDetail = $data[$i]['id'];
				$data[$i]['checkbox'] = '<div class="pretty p-default text-center">
				    <input type="checkbox" id="cek'.$data[$i]['id'].'" name="cek'.$data[$i]['id'].'" class="keluar">
					<div class="state p-success">
						<label></label>
					</div>
				</div>';
				$idItemMaster = $data[$i]['idItemMaster'];
				$data[$i]['isMaster'] = ($idItemMaster)? 'Ada' : '<button class="btn btn-warning btn-sm" onclick="ubah('.$idDetail.')">Ubah</button> <button class="btn btn-primary btn-sm" onclick="tambah('.$idDetail.')">Tambah</button>';
				$data[$i]['btnValidasiManager'] = '<button class="btn btn-sm btn-info" onclick="renderModalValidasi('.$data[$i]['id'].')">
					<i class="fa fa-edit"></i> Edit
				</button>';
				$data[$i]['btnEditJumlah'] = '<button class="btn btn-info btn-sm" onclick="editJumlah('.$data[$i]['id'].')"><i class="fa fa-edit"></i> Edit</button>';
			}
		}
		json($data);
	}
	private function _request($input) {
		$noReq = ($input->post('noReq'))? $input->post('noReq') : $input->get('noReq');
		return $this->model->getAllRequestDetail($noReq);
	}
	public function confirm() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$session = $this->session->userdata('login');
			$user = $this->model->getUser($session['user_id']);
			$noReq = $this->input->get('noReq');
			$this->mg->UpdateData('inv_request', ['checkedBy' => $user['id']], ['noReq' => $noReq]);
			$this->mg->LogActivity('Process confirm request : '.$noReq);
			$remarks = 'Berhasil mengkonfirmasi request';
			$statusJson = true;
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
	public function keluar() {
		cek_session($this->idMenu);
		$statusJson = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$session = $this->session->userdata('login');
			$user = $this->model->getUser($session['user_id']);
			$input = $this->input;
			$noReq = $input->get('noReq');
			$tanggal = strtotime($input->get('tanggal'));
			$noTransaksi = $input->get('noTransaksi');
			$request = $this->mg->getWhere('inv_request', ['noReq' => $noReq])->row_array();
			$requestDetail = $this->mg->getWhere('inv_request_detail', ['idRequest' => $request['id']])->result_array();
			$transaksi = $this->mg->getWhere('inv_transaction', ['noTransaction' => $noTransaksi])->row_array();
			if(!$request) {
				$statusJson = false;
				$remarks = 'Internal Request tidak terdaftar';
				$this->db->trans_rollback();
			} elseif($transaksi) {
				$statusJson = false;
				$remarks = 'No Transaksi telah terdaftar';
				$this->db->trans_rollback();
			} else {
				$this->mg->InsertData('inv_transaction', [
					'noTransaction'		=> $noTransaksi,
					'tglTransaction'	=> $tanggal,
					'typeTransaction'	=> 1,
					'idDepartment'		=> $request['idDepartment'],
					'noRequest'			=> $request['noReq']
				]);
				$transaksi = $this->mg->getWhere('inv_transaction', ['noTransaction' => $noTransaksi])->row_array();
				$this->mg->UpdateData('inv_request', [
					'approvedBy'	=> $user['id'],
					'noTransaction'	=> $transaksi['noTransaction'],
					'tglAcc'		=> $tanggal
				], ['id' => $request['id']]);
				foreach($requestDetail as $detail) {
					$item = $this->mg->getWhere('inv_itemmaster', ['id' => $detail['idItemMaster']])->row_array();
					$this->mg->InsertData('inv_transaction_detail', [
						'idTransaction'	=> $transaksi['id'],
						'jumlah_act'	=> $detail['jmlAktual'],
						'idItemMaster'	=> $item['id']
					]);
					$transaksiDetail = $this->mg->getWhere('inv_transaction_detail', [
						'idTransaction'	=> $transaksi['id'],
						'idItemMaster'	=> $item['id']
					])->row_array();
					$sisaStockKecil = $item['stock']-$detail['jmlAktual'];
					$sisaStockBesar = ceil($sisaStockKecil/$item['jumlahTerkecil']);
					$this->mg->UpdateData('inv_itemmaster', [
						'stock'			=> $sisaStockKecil,
						'stokTerbesar'	=> $sisaStockBesar
					], ['id' => $item['id']]);
					$this->mg->InsertData('inv_rekapitulasi', [
						'idTransaksiDetail'	=> $transaksiDetail['id'],
						'jmlAwal'			=> $item['stock'],
						'jmlAkhir'			=> $sisaStockKecil
					]);
				}
				$statusJson = true;
				$remarks = 'Data berhasil disimpan';
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
	public function getDetailSwaber() {
		cek_session($this->idMenu);
		$input = $this->input;
		$noReq = ($input->get('noReq'))? $input->get('noReq') : $input->post('noReq');
		$transaction = $this->mg->getWhere('inv_transaction', ['noRequest' => $noReq])->row_array();
		$detail = $this->model->getTransactionDetail($transaction['id']);
		json($detail);
	}
	public function konfirmasiSwaber() {
		cek_session($this->idMenu);
		$statusJson = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$session = $this->session->userdata('login');
			$user = $this->model->getUser($session['user_id']);
			$input = $this->input;
			$noReq = $input->get('noReq');
			$transaksi = $this->mg->getWhere('inv_transaction', ['noRequest' => $noReq])->row_array();
			$request = $this->mg->getWhere('inv_request', ['noReq' => $transaksi['noRequest']])->row_array();
			$this->mg->UpdateData('inv_request', ['approvedBy' => $user['id']], ['id' => $request['id']]);
			$detailTransaksi = $this->model->getTransactionDetail($transaksi['id']);
			$noTransaksiIN = $this->generateNoTransactionIn();
			$this->mg->InsertData('inv_transaction', [
				'noTransaction'		=> $noTransaksiIN,
				'tglTransaction'	=> time(),
				'typeTransaction'	=> 2
			]);
			$transaction = $this->mg->getWhere('inv_transaction', ['noTransaction' => $noTransaksiIN])->row_array();
			foreach($detailTransaksi as $detail) {
				$form = $input->get('input'.$detail['id']);
				if($form) {
					$this->mg->UpdateData('inv_transaction_detail', ['jumlah' => $form], ['id' => $detail['id']]);
					$this->mg->InsertData('inv_transaction_detail', [
						'idTransaction'	=> $transaction['id'],
						'jumlah_act'	=> $form,
						'idItemMaster'	=> $detail['idItemMaster'],
						'jumlah'		=> $detail['jumlah_act']
					]);
					$item = $this->mg->getWhere('inv_itemmaster', ['id' => $detail['idItemMaster']])->row_array();
					$sisaStockKecil = $item['stock'] + $form;
					$sisaStockBesar = ceil($sisaStockKecil/$item['jumlahTerkecil']);
					$this->mg->UpdateData('inv_itemmaster', [
						'stock'			=> $sisaStockKecil,
						'stokTerbesar'	=> $sisaStockBesar
					], ['id' => $item['id']]);
					$this->mg->InsertData('inv_rekapitulasi', [
						'idTransaksiDetail'	=> $transaction['id'],
						'jmlAwal'			=> $item['stock'],
						'jmlAkhir'			=> $form
					]);
				} elseif($form === '0') {
					$this->mg->UpdateData('inv_transaction_detail', ['jumlah' => 0], ['id' => $detail['id']]);
					$item = $this->mg->getWhere('inv_itemmaster', ['id' => $detail['idItemMaster']])->row_array();
					$this->mg->InsertData('inv_transaction_detail', [
						'idTransaction'	=> $transaction['id'],
						'jumlah_act'	=> 0,
						'idItemMaster'	=> $detail['idItemMaster'],
						'jumlah'		=> $detail['jumlah_act']
					]);
				}
			}
			$statusJson = true;
			$remarks = 'Data berhasil disimpan';
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
	public function simpanValidasi() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$session = $this->session->userdata('login');
			$user = $this->model->getUser($session['user_id']);
			$input = $this->input;
			$noReq = $input->get('noReq');
			$nama = $input->get('nama');
			$jumlah = $input->get('jumlah');
			$request = $this->mg->getWhere('inv_request', ['noReq' => $noReq])->row_array();
			$detail = $this->mg->getWhere('inv_request_detail', [
				'idRequest'	=> $request['id'],
				'namaItem'	=> $nama
			])->row_array();
			if(!$request) {
				$statusJson = false;
				$remarks = 'Request tidak terdaftar';
				$this->db->trans_rollback();
			} elseif(!$detail) {
				$statusJson = false;
				$remarks = 'Item tidak terdaftar';
				$this->db->trans_rollback();
			} else {
				$this->mg->UpdateData('inv_request_detail', [
					'jmlReview' => $jumlah,
					'jmlAktual' => $jumlah
				], ['id' => $detail['id']]);
				$this->mg->LogActivity('Process edit request : '.$noReq);
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
	public function simpanUbah() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$idDetail = $input->get('idDetail');
			$idItem = $input->get('idItem');
			$detail = $this->mg->getWhere('inv_request_detail', ['id' => $idDetail])->row_array();
			$item = $this->mg->getWhere('inv_itemmaster', ['id' => $idItem])->row_array();
			if(!$detail) {
				$statusJson = false;
				$remarks = 'Request detail tidak terdaftar';
				$this->db->trans_rollback();
			} elseif(!$item) {
				$statusJson = false;
				$remarks = 'Item tidak terdaftar';
				$this->db->trans_rollback();
			} else {
				$this->mg->UpdateData('inv_request_detail', [
					'namaItem'		=> $item['itemmaster'],
					'idItemMaster'	=> $item['id']
				], ['id' => $detail['id']]);
				$this->mg->LogActivity('Process edit request detail : '.$detail['id']);
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
	public function simpanTambah() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$idDetail = $input->get('idDetail');
			$form = [
				'itemmaster'		=> $input->get('namaItem'),
				'idkategori'		=> $input->get('kategori'),
				'unit'				=> $input->get('unitTerkecil'),
				'jumlahTerkecil'	=> $input->get('jmlTerkecil'),
				'unitTerbesar'		=> $input->get('unitTerbesar'),
				'jumlahTerbesar'	=> $input->get('jmlTerbesar'),
				'stock'				=> 0,
				'stokTerbesar'		=> 0
			];
			$detail = $this->mg->getWhere('inv_request_detail', ['id' => $idDetail])->row_array();
			$item = $this->mg->getWhere('inv_itemmaster', [
				'idkategori'	=> $form['idkategori'],
				'itemmaster'	=> $form['itemmaster']
			])->row_array();
			if(!$detail) {
				$statusJson = false;
				$remarks = 'Request detail tidak terdaftar';
				$this->db->trans_rollback();
			} elseif($item) {
				$statusJson = false;
				$remarks = 'Item telah terdaftar';
				$this->db->trans_rollback();
			} else {
				$this->mg->InsertData('inv_itemmaster', $form);
				$item = $this->mg->getWhere('inv_itemmaster', [
					'idkategori'	=> $form['idkategori'],
					'itemmaster'	=> $form['itemmaster']
				])->row_array();
				$this->mg->UpdateData('inv_request_detail', [
					'namaItem'		=> $item['itemmaster'],
					'idItemMaster'	=> $item['id']
				], ['id' => $detail['id']]);
				$this->mg->LogActivity('Process edit request detail : '.$detail['id']);
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
	public function simpanEditJumlah() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$idDetail = $input->get('idEditJumlah');
			$jumlah = $input->get('jmlEditJumlah');
			$detail = $this->mg->getWhere('inv_request_detail', ['id' => $idDetail])->row_array();
			if(!$detail) {
				$statusJson = false;
				$remarks = 'Request detail tidak terdaftar';
				$this->db->trans_rollback();
			} else {
				$this->mg->UpdateData('inv_request_detail', ['jmlAktual' => $jumlah], ['id' => $detail['id']]);
				$this->mg->LogActivity('Process edit request detail : '.$detail['id']);
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