<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Internalpo extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['form', 'url']);
		$this->load->library('pdf');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('inventory/purchasing/ModelInternalPO', 'mipo');
	}
	protected $idMenu = 'e281b154-070f-4f74-a7f2-160a6ae828d9';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'Internal Purchase Order',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'periode'		=> $this->mg->getWhere('periode', ['Active' => 1])->row_array()['ThnBln']
		];
		$this->load->view('inventory/purchasing/internalpo/index', $data);
	}
	public function generateNoPO() {
		$bulan = date('m');
		$tahun = date('Y');
		$noPO = '/SPLH/IPO/';
		$daftarBulanRomawi = $this->mipo->bulanRomawi();
		foreach($daftarBulanRomawi as $dbr) {
			if($bulan == $dbr[0]) {
				$noPO .= $dbr[1].'/'.$tahun;
			}
		}
		$cek = $this->mipo->getPurchaseOrder($noPO);
		if ($cek[0]['noPO'] == '') {
			$data['noPO'] = '001';
		} else {
			$nomor = intval($cek[0]['noPO']) + 1;
			$data['noPO'] = str_pad($nomor, 3, '0', STR_PAD_LEFT);;
		}
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> true,
			'data'			=> $data['noPO'].$noPO
		]);
	}
	public function getAllDepartment() {
		cek_session($this->idMenu);
		$deparments = $this->mg->getAll('hrm_departments')->result_array();
		for($i=0; $i<count($deparments); $i++) {
			$deparments[$i]['btn'] = '<button class="btn btn-info btn-sm"><i class="fa fa-check"></i></button';
		}
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> true,
			'data'			=> $deparments
		]);
	}
	public function getAllPO() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$po = ($session['user_id'] == 1)? $this->mipo->getAllPO() : '';
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> true,
			'data'			=> $po
		]);
	}
	public function savePO() {
		cek_session($this->idMenu);
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = 'Berhasil menyimpan Internal PO';
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$session = $this->session->userdata('login');
			$input = $this->input;
			$form = [
				'noPO'	=> $input->get('noPO'),
				'tglPO'	=> time()
			];
			$form['idDepartment'] = ($session['user_id'] == 1)? 9 : '';
			$form['createdBy'] = $session['user_id'];
			$cek = $this->mg->getWhere('inv_purchaseorder', ['noPO' => $form['noPO']])->row_array();
			if($cek) {
				$response['status_json'] = false;
				$response['remarks'] = 'Internal PO sudah ada!';
				$this->db->trans_rollback();
			} else {
				$this->mg->InsertData('inv_purchaseorder', $form);
				$this->mg->LogActivity('Process Insert New Internal PO : '.$form['noPO']);
			}
			$this->db->trans_complete();
			$this->db->trans_commit();
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->mg->LogError(current_url(),  $e->getMessage());
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	public function getAllUnit() {
		cek_session($this->idMenu);
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> true,
			'data'			=> $this->mg->getAll('inv_unit')->result_array()
		]);
	}
	public function getPO() {
		cek_session($this->idMenu);
		$input = $this->input;
		$noPO = ($input->post('noPO'))? $input->post('noPO') : $input->get('noPO');
		$res = [
			'status_json'	=> true,
			'data'			=> $this->mipo->getPODetail($noPO)
		];
		for($i=0; $i<count($res['data']); $i++) {
			$res['data'][$i]['btn'] = '<button '.(($res['data'][$i]['jmlAktual'])? 'disabled' : '').' onclick="renderEditItemModal('.$res['data'][$i]['id'].')" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm"  onclick="renderHapusItemModal('.$res['data'][$i]['id'].')" '.(($res['data'][$i]['jmlAktual'])? 'disabled' : '').'><i class="fa fa-trash"></i> Hapus</button>';
		}
		header('Content-Type: application/json');
		echo json_encode($res);
	}
	public function getItem() {
		cek_session($this->idMenu);
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> true,
			'data'			=> $this->mipo->getAllItem()
		]);
	}
	public function getDetail() {
		cek_session($this->idMenu);
		$id = $this->input->get('id');
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> true,
			'data'			=> $this->mipo->getDetail($id)
		]);
	}
	public function addItem() {
		cek_session($this->idMenu);
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = 'Berhasil menambahkan item';
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$input = $this->input;
			$noPO = $input->get('noPO');
			$status = $input->get('status');
			$idDetail = $input->get('idDetail');
			$form = [
				'namaItem'	=> $input->get('namaItem'),
				'jumlah'	=> $input->get('jumlah'),
				'idUnit'	=> $input->get('unit'),
				'note'		=> $input->get('ket')
			];
			$form['idPO'] = $this->mg->getWhere('inv_purchaseorder', ['noPO' => $noPO])->row_array()['id'];
			if($status == 'tambah') {
				$cek = $this->mg->getWhere('inv_purchaseorder_detail', [
					'namaItem'	=> $form['namaItem'],
					'idPO'		=> $form['idPO']
				])->num_rows();
				if($cek > 0) {
					$response['status_json'] = false;
					$response['remarks'] = 'Item telah terdaftar!';
					$this->db->trans_rollback();
				} else {
					$this->mg->InsertData('inv_purchaseorder_detail', $form);
					$this->mg->LogActivity('Process Insert New Internal PO Item : '.$noPO);
				}
			} else {
				$cek = $this->mg->getWhere('inv_purchaseorder_detail', ['id' => $idDetail])->num_rows();
				if($cek > 0) {
					$this->mg->UpdateData('inv_purchaseorder_detail', $form, ['id' => $idDetail]);
					$this->mg->LogActivity('Process Update Internal PO Item : '.$noPO);
					$response['remarks'] = 'Berhasil mengubah item';
				} else {
					$response['status_json'] = false;
					$response['remarks'] = 'Item tidak terdaftar!';
					$this->db->trans_rollback();
				}
			}
			$this->db->trans_complete();
			$this->db->trans_commit();
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->mg->LogError(current_url(),  $e->getMessage());
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	public function deleteItem() {
		cek_session($this->idMenu);
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = 'Berhasil menghapus item';
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$id = $this->input->get('id');
			$cek = $this->mg->getWhere('inv_purchaseorder_detail', ['id' => $id])->num_rows();
			if($cek > 0) {
				$this->mg->DeleteData('inv_purchaseorder_detail', ['id' => $id]);
				$this->mg->LogActivity('Process delete Internal PO Item : '.$id);
				$response['remarks'] = 'Berhasil menghapus item';
			} else {
				$response['status_json'] = false;
				$response['remarks'] = 'Item tidak terdaftar!';
				$this->db->trans_rollback();
			}
			$this->db->trans_complete();
			$this->db->trans_commit();
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->mg->LogError(current_url(),  $e->getMessage());
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
	public function print() {
		cek_session($this->idMenu);
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Internal Purchase Order');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Internal Purchase Order';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetAutoPageBreak(true, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$noPO  = $this->input->get('noPO');
		$po = $this->mipo->getPO($noPO);
		$po['details'] = $this->mipo->getPODetail($noPO);
		for($i=0; $i<count($po['details']); $i++) {
			$po['details'][$i]['no'] = $i+1;
		}
		$session = $this->session->userdata('login');
		$user = $this->mipo->getUser($session['user_id']);
		$po['namaLengkap'] = $user['nama_lengkap'];
		$po['position'] = $user['position'];
		$po['department'] = $user['department'];
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('inventory/purchasing/internalpo/print', [
			'i'		=> 1,
			'data'	=> $po
		], true);
		$pdf->writeHTML($content, true, true, true, true, '');
		$pdf->Output('Internal Purchase Order.pdf', 'I');
	}
}
