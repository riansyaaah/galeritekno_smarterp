<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Journal extends CI_Controller
{

	function __Construct()
	{
		parent::__Construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$this->load->helper(array('form', 'url'));
		$this->load->library('Pdf');
		$this->load->model('auth/ModelLogin');
		$this->load->model('ModelGeneral');
		$this->load->model('usermanagement/ModelUsers');
		$this->load->model('finance/reports/ModelJournal');
	}

	var $idMenu = "ee9f609c-28fe-4e7a-8181-be42430547a5";

	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$ThnActive   = $this->ModelGeneral->getWhere('periode', ['Active' => 1])->result_array();
		$bln = substr($ThnActive[0]['ThnBln'], 4, 2);
		$thn = substr($ThnActive[0]['ThnBln'], 0, 4);

		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Journal Reports',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'from_date'          => date('Y-m-d'),
			'to_date'          => date('Y-m-d'),
			'current_app'   => $sessionCurrentApp,
		);

		$this->load->view('finance/reports/v_journal', $data);
	}

	public function getData()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$idtable = $this->input->post('idtable');
		$where = "and fin_voucher.VoucherDate BETWEEN " . date('Y-m-d', strtotime($from_date)) . ' "AND"' . date('Y-m-d', strtotime($to_date));
		if ($idtable == '1') {
			$where = $where . "and fin_voucher.BankCode like '%CASH%'";
		} else if ($idtable == '2') {
			$where = $where . "and fin_voucher.BankCode like '%BANK%'";
		}

		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$datas = $this->ModelJournal->getDataCash($where);
		$no = 1;
		foreach ($datas as $d) {
			$data[] = array(
				"no" => $no,
				"Date" => $d['Date'],
				"ReffNo" => $d['ReffNo'],
				"Account" => $d['Account'],
				"Description" => $d['Description'],
				"Debit" => $d['Debit'],
				"Credit" => $d['Credit'],

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

	public function getDataPreview()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$idtable = $this->input->post('idtable');

		if ($idtable == 'CASH')
			$typeJournal = 'CASH';
		elseif ($idtable == 'BANK')
			$typeJournal = 'BANK';
		else
			$typeJournal = '';

		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$datas = $this->ModelJournal->getDataPreview1($from_date, $to_date, $typeJournal);
		$data2 = $this->ModelJournal->getDataPreview2($from_date, $to_date, $typeJournal);
		$total_debit = $this->ModelJournal->getDataPreview3($from_date, $to_date, $typeJournal);
		$grand_total = $total_debit;
		$no = 1;
		foreach ($datas as $d) {
			$x = 0;
			$status = substr($d['VoucherNo'], 15, 1);
			$data[] = array(
				"no" => $no,
				"Date" => date('d-M-Y', strtotime($d['VoucherDate'])),
				"ReffNo" => $d['VoucherNo'],
				"Account" => $d['AccountNoCB'] . ' - ' . $d['BankName'],
				"Description" => $d['DescriptionV'],
				"Debit" => '',
				"Credit" => '',
			);
			$no++;
			foreach ($data2 as $b) {
				if ($b['VoucherNo'] == $d['VoucherNo']) {
					$data[] = array(
						"no" => $no,
						"Date" => '',
						"ReffNo" => $b['VoucherNo'],
						"Account" => $b['AccountNoAB'],
						"Description" => $b['DescriptionVD'],
						"Debit" => number_format($b['Debit']),
						"Credit" => number_format($b['Credit']),
					);
					// Kebalik wkwkwkw
					if ($status == 'D') {
						$x += $b['Credit'];
					} else {
						$x += $b['Debit'];
					}
					$no++;
				}
			}

			// SUB TOTAL
			if ($status == 'D') {
				$data[] = array(
					"no" => $no,
					"Date" => '',
					"ReffNo" => '',
					"Account" => '',
					"Description" => 'SUB TOTAL',
					"Debit" => number_format($x),
					"Credit" => '',
				);
			} else {
				$data[] = array(
					"no" => $no,
					"Date" => '',
					"ReffNo" => '',
					"Account" => '',
					"Description" => 'SUB TOTAL',
					"Debit" => '',
					"Credit" => number_format($x)
				);
			}

		}
		$data[] = array(
			"no" => '',
			"Date" => '',
			"ReffNo" => '',
			"Account" => '',
			"Description" => '<b>GRAND TOTAL</b>',
			"Debit" => '',
			"Credit" => number_format($grand_total),
		);
		if (count($datas) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	// NOT USED
	public function preview()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");

		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Journal Reports',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);

		$this->load->view('finance/reports/v_journal_preview', $data);
	}

	public function cetak()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$idtable = $this->input->post('idtable');

		$where = "and fin_voucher.VoucherDate between '$from_date' and '$to_date'";
		if ($idtable == '1') {
			$where = $where . "and fin_voucher.BankCode like 'CASH%'";
		}
		if ($idtable == '2') {
			$where = $where . "and fin_voucher.BankCode like 'BANK%'";
		}
		$data_jurnal = $this->ModelJournal->getDataCash();
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Journal Reports',
			"list_jurnal"    => $data_jurnal

		);
		$this->load->view('finance/reports/v_journal_cetak', $data);
	}


	public function print() {
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle("Jurnal Report");
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = "PT. SPEEDLAB INDONESIA";
		$pdf->JudulReprot = "Jurnal Report";
		$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins('7', '33', PDF_MARGIN_RIGHT);
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(true);
		$pdf->SetAutoPageBreak(TRUE, 10);
		$pdf->SetHeaderMargin(12);
		$input = $this->input;
		$form = [
			'from_date'		=> $input->get('from_date'),
			'to_date'		=> $input->get('to_date'),
			'typeJournal'	=> $input->get('typeJournal')
		];
		$form['typeJournal'] = $this->_typeJournal($form['typeJournal']);
		$dataPrint = $this->_dataPrint($form);
		$data = [
			'datenow'		=> date('d-m-Y'),
			'title'			=> 'Journal Reports',
			'lists'			=> $dataPrint['lists'],
			'totalCredit'	=> $dataPrint['totalCredit'],
			'totalDebit'	=> $dataPrint['totalDebit']
		];
		$content = $this->load->view('finance/reports/print/print_journal', $data, true);
		$pdf->AddPage('P', 'A4');
		$pdf->writeHTML($content);
		$pdf->Output('Laporan Journal.pdf', 'I');
	}
	private function _dataPrint($form) {
		$model = $this->ModelJournal;
		$lists = $model->getDataPreview1($form);
		$details = $model->getDataPreview2($form);
		$totalDebit = 0;
		$totalCredit = 0;
		for($i=0; $i < count($lists); $i++) {
			$lists[$i]['details'] = [];
			$sumDebit = $lists[$i]['Debit'];
			$sumCredit = $lists[$i]['Credit'];
			foreach($details as $detail) {
				if($lists[$i]['VoucherNo'] == $detail['VoucherNo']) {
					$sumDebit += $detail['Credit'];
					$sumCredit += $detail['Debit'];
					array_push($lists[$i]['details'], $detail);
				}
			}
			$lists[$i]['sumDebit'] = $sumDebit;
			$lists[$i]['sumCredit'] = $sumCredit;
			$totalCredit += $sumCredit;
			$totalDebit += $sumDebit;
		}
		return [
			'lists'			=> $lists,
			'totalDebit'	=> $totalCredit,
			'totalCredit'	=> $totalCredit
		];
	}
	private function _typeJournal($type) {
		if($type == 'CASH') {
			$hasil = 'CASH';
		} elseif($type == 'BANK') {
			$hasil = 'BANK';
		} else {
			$hasil = '';
		}
		return $hasil;
	}
}
