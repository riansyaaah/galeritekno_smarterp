<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posting extends CI_Controller
{

	function __Construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$this->load->helper(array('form', 'url'));
		$this->load->model('auth/ModelLogin');
		$this->load->model('ModelGeneral');
		$this->load->model('usermanagement/ModelUsers');
		$this->load->model('finance/generalledger/ModelPosting');
	}

	var $idMenu = "558f8570-b290-469a-97a9-a5224d1c9ab3";

	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$ThnActive   = $this->ModelPosting->getPeriode();
		$thn = $ThnActive[0]['ThnBln'];
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Posting',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
			'tahunaktif'    =>  $thn,
			'voucherType'   => ['Payment', 'Memo']
		);
		$this->load->view('finance/generalledger/v_posting', $data);
	}
	public function getDataPosting()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$mulai_tanggal  = $this->input->post('mulai_tanggal');
		$sampai_tanggal  = $this->input->post('sampai_tanggal');
		// $trNo = $this->input->post('trNo');
		$kode_bank = $this->input->post('kode_bank');
		$coba = ($kode_bank) ? "and fin_voucher.BankCode = '$kode_bank'" : "";
		$datas = $this->ModelPosting->getDataPosting(" where Posting = '0' and fin_voucher.VoucherDate between '$mulai_tanggal' and '$sampai_tanggal' $coba order by VoucherDate desc");
		// $datas = $this->ModelPosting->getDataPosting(" where VoucherNo = $trNo order by VoucherDate desc");
		$no = 1;
		foreach ($datas as $d) {
			$VoucherNo = '"' . $d['VoucherNo'] . '"';
			$VoucherType = $d['VoucherType'];
			$option = "<a href='#' class='edit_record btn btn-info btn-sm' onclick='return PostingItem(" . $VoucherNo . ")'>Posting</a><a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $VoucherNo . ")'>Hapus</a>";
			$transactype = ($VoucherType == '1') ? 'Payment' : 'Receipt';
			$data[] = array(
				"no" => $no,
				"VoucherNo" => $d['VoucherNo'],
				"VoucherDate" => $d['VoucherDate'],
				"transactype" => $transactype,
				// "BankCode" => $d['BankCode'],
				"BankName" => $d['BankName'],
				"Description" => $d['Description'],
				"Amount" => $d['Amount'],
				"option" => $option,

			);
			$no++;
		}
		$response['data'] = (count($datas) > 0) ? $data : [];
		echo json_encode($response);
	}
	public function getAllDataPosting()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $datas = $this->ModelPosting->getDataPosting2();
		$datas = $this->ModelPosting->getAllDataPosting();
		foreach ($datas as $d) {
			$VoucherNo = '"' . $d['VoucherNo'] . '"';
			$return = ($d['Posting'] == 1) ? 'UnpostingItem(' . $VoucherNo . ')' : 'PostingItem(' . $VoucherNo . ')';
			$tombol = ($d['Posting'] == 1) ? "Unposting" : "Posting";
			$post = "<a href='#' class='edit_record btn btn-info btn-sm' onclick='return $return'>$tombol</a>";
			$hapus = "<a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(" . $VoucherNo . ", " . $d['Posting'] . ")'>Hapus</a>";
			$data[] = [
				'VoucherNo'     => $d['VoucherNo'],
				'VoucherDate'   => $d['VoucherDate'],
				'transactype'   => $d['VoucherType'],
				'AccountNo'     => $d['AccountNoCB'],
				'Account'       => $d['Account'],
				'Description'   => $d['DescriptionV'],
				'Amount'        => number_format($d['Debit'] + $d['Credit'], 0, '', '.'),
				'post'          => $post,
				'hapus'         => $hapus
			];
		}
		$response['data'] = (count($datas) > 0) ? $data : [];
		echo json_encode($response);
	}
	function getDatavoucher()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$VoucherNo  = $this->input->post('VoucherNo');
			$check = $this->ModelPosting->getDataPosting(" WHERE fin_voucher.VoucherNo = '$VoucherNo' ");
			if ($check != null) {
				$response['data'] = $check;
			} else {
				$cek = $this->ModelPosting->getDataMemo(" WHERE fin_vouchermemo.VoucherMemoNo = '$VoucherNo' ");
				if ($cek != null) {
					$response['data'] = $cek;
				} else {
					$response['status_json'] = false;
					$response['remarks'] = "Item tidak ditemukan";
				}
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	function getVoucherbyid()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$VoucherNo_hapus = $this->input->post('VoucherNo_hapus');
			$check = $this->ModelPosting->getDataPosting(" WHERE fin_voucher.VoucherNo = '" . $VoucherNo_hapus . "' ");
			if ($check != null) {
				$response['data'] = $check;
			} else {
				$cek = $this->ModelPosting->getDataMemo(" WHERE fin_vouchermemo.VoucherMemoNo = '$VoucherNo_hapus' ");
				if ($cek != null) {
					$response['data'] = $cek;
				} else {
					$response['status_json'] = false;
					$response['remarks'] = "Item tidak ditemukan";
				}
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
	public function proses()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil Melakukan Posting ";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		$ThnActive   = $this->ModelPosting->getPeriode();
		$thn = $ThnActive[0]['ThnBln'];
		try {
			$datennow = date('Y-m-d H:i:s');
			$mulai_tanggal = $this->input->post('mulai_tanggal');
			$sampai_tanggal = $this->input->post('sampai_tanggal');
			$idtable = $this->input->post('idtable');

			if ($idtable == '1') {
				$tabel = 'fin_cashbank_saldo';
				$where = "where ActivePeriode ='$thn'";
			}
			if ($idtable == '2') {
				$tabel = 'fin_purchaseinvoice';
				$where = "where PurchaseInvoiceDate between $mulai_tanggal and $sampai_tanggal";
			}
			if ($idtable == '3') {
				$tabel = 'fin_salesinvoice';
				$where = "where SalesInvoiceDate between $mulai_tanggal and $sampai_tanggal";
			}
			if ($idtable == '4') {
				$tabel = 'fin_vouchermemo';
				$where = "where VoucherMemoDate between $mulai_tanggal and $sampai_tanggal";
			}
			$post = true;

			if ($post) {
				$this->db->query("UPDATE $tabel SET Posting = '1'");
				$this->ModelGeneral->LogActivity('Process Posting ');
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Nomor urut atau nama modul sudah ada!";
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	public function postingVoucher()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil Posting Voucher";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$VoucherNo = $this->input->post('VoucherNo');

			$post = true;
			if ($post) {
				$dataInsert = [
					'Posting' => 1
				];
				if (explode('/', $VoucherNo) == 'VM') {
					$this->ModelGeneral->UpdateData('fin_vouchermemo', $dataInsert, ['VoucherMemoNo' => $VoucherNo]);
				} else {
					$this->ModelGeneral->UpdateData('fin_voucher', $dataInsert, ['VoucherNo' => $VoucherNo]);
				}
				$this->ModelGeneral->LogActivity('Process Posting Voucher : ' . $VoucherNo);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Nomor urut atau nama modul sudah ada!";
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
	public function UnpostingVoucher()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil Unposting Voucher ";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$VoucherNo = $this->input->post('VoucherNo');
			$post = true;
			if ($post) {
				$dataInsert = [
					'Posting' => 0
				];
				if (explode('/', $VoucherNo)[1] == 'VM') {
					$this->ModelGeneral->UpdateData('fin_vouchermemo', $dataInsert, ['VoucherMemoNo' => $VoucherNo]);
				} else {
					$this->ModelGeneral->UpdateData('fin_voucher', $dataInsert, ['VoucherNo' => $VoucherNo]);
				}
				$this->ModelGeneral->LogActivity('Process Unposting Voucher : ' . $VoucherNo);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Nomor urut atau nama modul sudah ada!";
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	public function deletePosting()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Successfully deleted data";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$VoucherNo_hapus = $this->input->post('code_hapus');
			$post = true;

			if ($post) {
				// $this->ModelGeneral->DeleteData(['fin_voucher','fin_voucher_detail'], ['VoucherNo' => $VoucherNo_hapus]);
				// $this->ModelGeneral->LogActivity('Process Delete Posting : '.$VoucherNo_hapus);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "number or name is already exists";
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
}
