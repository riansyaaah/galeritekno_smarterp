<?php defined('BASEPATH') or exit('No direct script access allowed');
class Internalrequest extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['form', 'url']);
		$this->load->library('pdf');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('inventory/request/ModelInternalRequest', 'model');
	}
	protected $idMenu = '241d35a1-427e-4eb8-84dd-0e9a25b0b82a';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'Internal Request',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'periode'		=> $this->mg->getWhere('periode', ['Active' => 1])->row_array()['ThnBln']
		];
		$this->load->view('inventory/request/internalrequest/index', $data);
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
		json($data['noPO'].'/REQ/'.$periode);
	}
	public function getAllItem() {
		cek_session($this->idMenu);
		$data = $this->model->getAllItem();
		json($data);
	}
	public function searchItem() {
		cek_session($this->idMenu);
		$kata = $this->input->get('kata');
		$data = $this->model->getItem($kata);
		$data = array_merge([['id' => $kata, 'itemmaster' => $kata.' (Tambah Baru)']], $data);
		json($data);
	}
	public function getItem() {
		cek_session($this->idMenu);
		$id = $this->input->get('id');
		$data = $this->mg->getWhere('inv_itemmaster', ['id' => $id])->row_array();
		json($data);
	}
	public function getItemByName() {
		cek_session($this->idMenu);
		$nama = $this->input->get('nama');
		$data = $this->mg->getWhere('inv_itemmaster', ['itemmaster' => $nama])->row_array();
		json($data);
	}
	public function getDetail() {
		cek_session($this->idMenu);
		$idDetail = $this->input->get('id');
		$noReq = ($this->input->get('noReq'))? $this->input->get('noReq') : $this->input->post('noReq');
		if($idDetail) {
			$data = $this->model->getDetailById($idDetail);
		} else {
			$data = $this->model->getDetail($noReq);
			// for($i=0; $i<count($data); $i++) {
			// 	$data[$i]['namaItem'] = '<span ondblclick="renderInput('.$data[$i]['id'].')">'.$data[$i]['namaItem'].'</span>';
			// }
		}
		json($data);
	}
	public function getDetailDblClick() {
		cek_session($this->idMenu);
		$input = $this->input;
		$noReq = $input->get('noReq');
		$namaItem = $input->get('namaItem');
		$data = $this->mg->getWhere('inv_request_detail', [
			
		])->row_array();
	}
	private function _generateNoTransaction() {
		$periode = $this->ModelGeneral->getWhere('periode', ['Active' => 1])->row_array()['ThnBln'];
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
	public function saveReq() {
		cek_session($this->idMenu);
		$statusJson = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$session = $this->session->userdata('login');
			$user = $this->model->getUser($session['user_id']);
			$input = $this->input;
			$form = [
				'noReq'			=> $input->get('noReq'),
				'tglReq'		=> time(),
				'createdBy'		=> $user['id'],
				'idDepartment'	=> ($user['user_id'] == 1)? 9 : $user['departement_id']
			];
			$cek = $this->mg->getWhere('inv_request', ['noReq' => $form['noReq']])->row_array();
			if($cek) {
				$statusJson = false;
				$remarks = 'Request sudah ada!';
				$this->db->trans_rollback();
			} else {
				$level = level();
				if($level == 1) {
					$form['checkedBy'] = $user['id'];
					$form['approvedBy'] = $user['id'];
					$form['tglAcc'] = $form['tglReq'];
					$form['noTransaction'] = $this->_generateNoTransaction();
					$this->mg->InsertData('inv_request', $form);
					$this->mg->InsertData('inv_transaction', [
						'noTransaction'		=> $form['noTransaction'],
						'tglTransaction'	=> $form['tglReq'],
						'typeTransaction'	=> 1,
						'idDepartment'		=> $form['idDepartment'],
						'noRequest'			=> $form['noReq']
					]);
				} elseif($level == 2) {
					$form['checkedBy'] = $user['id'];
					$this->mg->InsertData('inv_request', $form);
				} else {
					$this->mg->InsertData('inv_request', $form);
				}
				$this->mg->LogActivity('Process Insert New Request : '.$form['noReq']);
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
		json('', $statusJson, $remarks);
	}
	public function saveDetail() {
		cek_session($this->idMenu);
		$statusJson = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$status = $input->get('status');
			$noReq = $input->get('noReq');
			if($status == 1) {
				$remarks = $this->_addDetail($input, $noReq);
			} else if($status == 2) {
				$remarks = $this->_editDetail($input, $noReq);
			} else {
				$remarks = $this->_deleteDetail($input, $noReq);
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
	private function _addDetail($input, $noReq) {
		$req = $this->mg->getWhere('inv_request', ['noReq' => $noReq])->row_array();
		$jumlah = $input->get('jumlah');
		$idItemMaster = $input->get('idItem');
		$level = level();
		$form = [
			'jumlah'		=> $jumlah,
			'jmlReview'		=> $jumlah,
			'jmlAktual'		=> $jumlah,
			'idRequest'		=> $req['id'],
			'note'			=> $input->get('ket'),
			'spek'			=> $input->get('spek')
		];
		$cek = $this->mg->getWhere('inv_request_detail', [
			'idItemMaster'	=> $idItemMaster,
			'idRequest'		=> $req['id']
		])->row_array();
		$cekItem = $this->mg->getWhere('inv_itemmaster', ['id' => $idItemMaster])->row_array();
		$level = level();
		if($cek) {
			$statusJson = false;
			$remarks = 'Item request sudah ada!';
			$this->db->trans_rollback();
		} elseif(!$cekItem) {
			$form['namaItem'] = $idItemMaster;
			$this->mg->InsertData('inv_request_detail', $form);
			$this->mg->LogActivity('Process Insert New Item Request : '.$noReq);
			$remarks = 'Berhasil menyimpan item request';
		} else {
			$form['namaItem'] = $cekItem['itemmaster'];
			$form['idItemMaster'] = $idItemMaster;
			$this->mg->InsertData('inv_request_detail', $form);
			if($level == 1) {
				$transaksi = $this->mg->getWhere('inv_transaction', ['noRequest' => $req['noReq']])->row_array();
				$this->mg->InsertData('inv_transaction_detail', [
					'idTransaction' => $transaksi['id'],
					'idItemMaster'	=> $idItemMaster,
					'jumlah_act'	=> $jumlah,
					'jumlah'		=> $jumlah,
					'note'			=> $form['note']
				]);
				$sisaStockKecil = $cekItem['stock']-$jumlah;
				$sisaStockBesar = ceil($sisaStockKecil/$cekItem['jumlahTerkecil']);
				$this->mg->UpdateData('inv_itemmaster', [
					'stock'			=> $sisaStockKecil,
					'stokTerbesar'	=> $sisaStockBesar
				], ['id' => $idItemMaster]);
			}
			$this->mg->LogActivity('Process Insert New Item Request : '.$noReq);
			$remarks = 'Berhasil menyimpan item request';
		}
		return $remarks;
	}
	private function _editDetail($input, $noReq) {
		$idDetail = $input->get('idDetail');
		$idItemMaster = $input->get('idItem');
		$jumlah = $input->get('jumlah');
		$form = [
			'jumlah'		=> $jumlah,
			'jmlReview'		=> $jumlah,
			'jmlAktual'		=> $jumlah,
			'note'			=> $input->get('ket'),
			'spek'			=> $input->get('spek')
		];
		$cek = $this->mg->getWhere('inv_request_detail', ['id' => $idDetail])->row_array();
		$cekItem = $this->mg->getWhere('inv_itemmaster', ['id' => $idItemMaster])->row_array();
		$level = level();
		if(!$cek) {
			$statusJson = false;
			$remarks = 'Item request tidak terdaftar!';
			$this->db->trans_rollback();
		} elseif(!$cekItem) {
			$form['namaItem'] = $idItemMaster;
			$form['idItemMaster'] = null;
			$this->mg->UpdateData('inv_request_detail', $form, ['id' => $idDetail]);
			$this->mg->LogActivity('Process Update Item Request : '.$noReq);
			$remarks = 'Berhasil menyimpan item request';
		} else {
			$form['namaItem'] = $cekItem['itemmaster'];
			$form['idItemMaster'] = $idItemMaster;
			$this->mg->UpdateData('inv_request_detail', $form, ['id' => $idDetail]);
			if($level == 1) {
				$transaksi = $this->mg->getWhere('inv_transaction', ['noRequest' => $noReq])->row_array();
				$transaksiDetail = $this->mg->getWhere('inv_transaction_detail', [
					'idTransaction' => $transaksi['id'],
					'idItemMaster'	=> $idItemMaster
				])->row_array();
				$this->mg->UpdateData('inv_transaction_detail', [
					'jumlah_act'	=> $jumlah,
					'jumlah'		=> $jumlah,
					'note'			=> $form['note']
				], ['id' => $idItemMaster]);
				// $this->mg->UpdateData('inv_itemmaster')
			}
			$this->mg->LogActivity('Process Update Item Request : '.$noReq);
			$remarks = 'Berhasil menyimpan item request';
		}
		return $remarks;
	}
	private function _deleteDetail($input, $noReq) {
		$idDetail = $input->get('idDetail');
		$cek = $this->mg->getWhere('inv_request_detail', ['id' => $idDetail])->row_array();
		if($cek) {
			$this->mg->DeleteData('inv_request_detail', ['id' => $idDetail]);
			$this->mg->LogActivity('Process Delete Item Request : '.$noReq);
			$remarks = 'Berhasil menghapus item request';
		} else {
			$statusJson = false;
			$remarks = 'Item request tidak terdaftar!';
			$this->db->trans_rollback();
		}
		return $remarks;
	}
}