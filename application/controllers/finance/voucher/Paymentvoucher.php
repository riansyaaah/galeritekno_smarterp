<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paymentvoucher extends CI_Controller
{

	function __Construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$this->load->helper(array('form', 'url'));
		$this->load->model('auth/ModelLogin');
		$this->load->library('pdf');
		$this->load->model('ModelGeneral');
		$this->load->model('usermanagement/ModelUsers');
		$this->load->model('finance/voucher/ModelPaymentvoucher');
		$this->load->model('finance/coa/ModelCashbank');
	}

	var $idMenu = "2E5DEE60-F15F-4D6D-BC3C-E0624200178F";

	public function index()
	{
		$ThnActive   = $this->ModelPaymentvoucher->getPeriode();
		$thn = $ThnActive[0]['ThnBln'];

		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Payment Voucher',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
			'PeriodeActive'   => $thn,
		);
		$this->load->view('finance/voucher/v_paymentvoucher', $data);
	}
	public function getCashbank()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$datas = $this->ModelPaymentvoucher->getCashbank("group by BankCode order by BankCode");
		$no = 1;
		foreach ($datas as $d) {

			$totalDebit = $this->ModelCashbank->getTotalDebitByBankCode($d['BankCode']);
			$debit_total = $totalDebit['total_debit'];

			$option = "
             <a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
			$data[] = array(
				"no" => $no,
				"BankCode" => $d['BankCode'],
				"BankName" => $d['BankName'],
				"BankAccount" => $d['BankAccount'],
				"AccountNo" => $d['AccountNo'],
				"Valuta" => $d['Valuta'],
				"Saldo" => number_format($d['AvailableSaldo'] - $debit_total),
				// "Saldo" => number_format($debit_total), // jumlah pengurangan
				// "Saldo" => number_format($d['AvailableSaldo']),  // Saldo Semua = Tanpa pengurangan 
				"option" => $option,

			);
			$no++;
		}
		if (count($datas) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	public function getPYCashbank()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$BankCode  = $this->input->post('BankCode');

		$datas = $this->ModelPaymentvoucher->getPYCashbank(" where fin_voucher.BankCode = '$BankCode' and fin_voucher.VoucherType = '2' order by VoucherNo desc");
		$no = 1;
		foreach ($datas as $d) {
			$option = "<a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
			$data[] = array(
				"no" => $no,
				"VoucherNo" => $d['VoucherNo'],
				"VoucherDate" => $d['VoucherDate'],
				"BankCode" => $d['BankCode'],
				"BankName" => $d['BankName'],
				"Description" => $d['Description'],
				"option" => $option,

			);
			$no++;
		}
		if (count($datas) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}
	public function getAccountNo()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$datas = $this->ModelPaymentvoucher->getAccountNo(" where Level = 'MASTER' order by AccountNo");
		$no = 1;
		foreach ($datas as $d) {
			$option = "
             <a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
			$data[] = array(
				"no" => $no,
				"AccountNo" => $d['AccountNo'],
				"AccountName" => $d['AccountName'],
				"option" => $option,

			);
			$no++;
		}
		if (count($datas) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function getPaymentvoucherbyid()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$VoucherNo  = $this->input->post('VoucherNo');
			$total_amout = $this->ModelPaymentvoucher->getTotalAmountById($VoucherNo)->Debit_total;
			$check = $this->ModelPaymentvoucher->getPYCashbank(" WHERE fin_voucher.VoucherNo = '" . $VoucherNo . "' ");
			if ($check != null) {
				$response['data'] = $check;
				$response['total'] = number_format($total_amout);
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Item tidak ditemukan";
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
	public function caridetailPaymentvoucher()
	{
		$VoucherNo  = $this->input->post('VoucherNo');

		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$datas = $this->ModelPaymentvoucher->getPaymentvoucherdetail(" where VoucherNo = '$VoucherNo'");
		$no = 1;

		foreach ($datas as $d) {
			$idRow = '"' . $d['id'] . '"';
			$option = "<a href='#' class='edit_record btn btn-info btn-sm' onclick='return editItem(" . $idRow . ")'>+ Edit</a>
             <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapusItem(" . $idRow . ")'>+ Hapus</a>";
			$data[] = array(
				"no" => $no,
				"DetailNo" => $d['DetailNo'],
				"Description" => $d['Description'],
				"AccountNo" => $d['AccountNo'],
				"Debit" => number_format($d['Debit'], 0),
				"option" => $option,

			);
			$no++;
		}
		if (count($datas) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function cariVoucherNo()
	{
		$ThnActive   = $this->ModelPaymentvoucher->getPeriode();
		$thn = $ThnActive[0]['ThnBln'];

		$BankCode  = $this->input->post('BankCode');

		$VoucherNo = $BankCode . "/K/" . $thn;
		$cek       = $this->ModelPaymentvoucher->getPaymentvoucher($VoucherNo);

		if ($cek[0]['VoucherNo'] == "") {
			$data['VoucherNo'] = "001";
		} else {
			$nomor = intval($cek[0]['VoucherNo']) + 1;
			$data['VoucherNo'] = str_pad($nomor, 3, "0", STR_PAD_LEFT);;
		}
		echo json_encode($data);
	}

	public function addPayment()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil menyimpan Payment Voucher";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$BankCode = $this->input->post('BankCode');
			$VoucherNo = $this->input->post('VoucherNo');
			$VoucherDate = $this->input->post('VoucherDate');
			$ChequeNo = $this->input->post('ChequeNo');
			$Rate = $this->input->post('Rate');
			$Description = $this->input->post('Description');
			$StatusPY = $this->input->post('StatusPY');

			$post = true;

			if ($post) {
				$dataInsert = array(
					'VoucherNo'      => $VoucherNo,
					'BankCode' => $BankCode,
					'VoucherType' => "2",
					'VoucherDate' => $VoucherDate,
					'Rate' => $Rate,
					'ChequeNo' => $ChequeNo,
					'Description' => $Description,
					'Posting' => "0",
				);
				if ($StatusPY == 'New') {
					$cekNoRef = $this->ModelPaymentvoucher->getPaymentvoucherdetail(" where VoucherNo = '$VoucherNo'");
					if (count($cekNoRef) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Payment No. sudah ada!";
						$this->db->trans_rollback();
					} else {

						$this->ModelGeneral->InsertData('fin_voucher', $dataInsert);
						$this->ModelGeneral->LogActivity('Process Insert New Payment NO : ' . $VoucherNo);
					}
				} else {
					$this->ModelGeneral->UpdateData('fin_voucher', $dataInsert, array('VoucherNo'      => $VoucherNo));
					$this->ModelGeneral->LogActivity('Process Edit Payment NO : ' . $VoucherNo);
				}
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

	function getItemvoucher()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$idrow  = $this->input->post('idrow');

			$check = $this->ModelPaymentvoucher->getItemVoucherbyid(" WHERE fin_voucher_detail.id = '$idrow' ");
			if ($check != null) {
				$response['data'] = $check;
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Item tidak ditemukan";
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	public function addItem()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		// header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil menyimpan Item Payment Voucher";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$input = $this->input;
			$VoucherNo = $input->post('VoucherNo');
			$itemDescription = $input->post('itemDescription');
			$itemDebit = str_replace('.', '', $input->post('itemDebit'));
			$itemAccountNo = $input->post('itemAccountNo');
			$status = $input->post('status');
			$itemidRow = $input->post('itemidRow');
			$post = true;
			if ($post) {

				if ($status == 'Tambah') {
					$cekItem = $this->ModelPaymentvoucher->getPaymentvoucherdetail(" where VoucherNo = '$VoucherNo' order by DetailNo desc limit 1");
					if (count($cekItem) > 0) {
						$DetailNo = (intval(substr($cekItem[0]['DetailNo'], -1)) + 1);
						$DetailNo = str_pad($DetailNo, 3, "0", STR_PAD_LEFT);
					} else {
						$DetailNo = str_pad("1", 3, "0", STR_PAD_LEFT);
					}
					$dataInsert = array(
						'VoucherNo'      => $VoucherNo,
						'DetailNo' => $DetailNo,
						'Description' => $itemDescription,
						'Debit' => $itemDebit,
						'AccountNo' => $itemAccountNo,
					);
					$this->ModelGeneral->InsertData('fin_voucher_detail', $dataInsert);
					$this->ModelGeneral->LogActivity('Process Insert New Item Payment Voucher : ' . $itemDescription);
				} else {
					$dataInsert = array(
						'Description' => $itemDescription,
						'Debit' => $itemDebit,
						'AccountNo' => $itemAccountNo,
					);
					$this->ModelGeneral->UpdateData('fin_voucher_detail', $dataInsert, array('id' => $itemidRow));
					$this->ModelGeneral->LogActivity('Process Update Item Payment Voucher : ' . $itemDescription);
				}
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

	public function hapusItemvoucher()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil menghapus Item Voucher ";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$itemidRow_hapus = $this->input->post('itemidRow_hapus');

			$post = true;
			if ($post) {

				$this->ModelGeneral->DeleteData('fin_voucher_detail', array('id' => $itemidRow_hapus));
				$this->ModelGeneral->LogActivity('Process Delete Item Voucher : ' . $itemidRow_hapus);
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

	public function hapusPayment()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil menghapus Voucher ";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$VoucherNo = $this->input->post('VoucherNo');

			$post = true;
			if ($post) {

				$this->ModelGeneral->DeleteData('fin_voucher', array('VoucherNo' => $VoucherNo));
				$this->ModelGeneral->LogActivity('Process Delete Voucher : ' . $VoucherNo);
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

	public function cetak()
	{
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Payment Voucher');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Payment Voucher';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetAutoPageBreak(true, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$printVoucherNo  = $this->input->post('printVoucherNo');
		$tAmount = $this->ModelPaymentvoucher->getTotalAmountById($printVoucherNo)->Debit_total;
		$print = $this->ModelPaymentvoucher->getPaymentvoucherForPrint($printVoucherNo);
		$datax = [
			'date'          => $this->_spasi(13) . ': ' . $print->VoucherDate,
			'ledger'        => $this->_spasi(10) . ': -',
			'voucher'       => $this->_spasi(2) . ': ' . $print->VoucherNo,
			'account'       => $this->_spasi(8) . ': ' . $print->BankCode,
			'payTo'        => $this->_spasi(10) . ': ' . $print->Description,
			'totalAmount'   => $this->_spasi(13) . ': ' . number_format($tAmount, 0, ',', '.'),
			'items'         => $this->ModelPaymentvoucher->getPaymentvoucherdetailForPrint($printVoucherNo)
		];
		$pdf->AddPage('L', 'A4');
		$content = $this->load->view('finance/voucher/print_voucher', $datax, true);
		$pdf->writeHTML($content, true, true, true, true, '');
		$pdf->Output('Payment Voucher.pdf', 'I');
	}
	private function _spasi($jumlah)
	{
		$spasi = '';
		for ($i = 1; $i <= $jumlah; $i++) {
			$spasi .= '&nbsp;';
		}
		return $spasi;
	}
}
