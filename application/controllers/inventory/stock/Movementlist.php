<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Movementlist extends CI_Controller {
    public function __Construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->library('Pdf');
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('inventory/stock/ModelMovementList');
    }
    protected $idMenu = '98099f8f-244c-4f7f-b4a8-5ece5ccc5275';
    public function index() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $data = [
            'datenow'       => date('d-m-Y', strtotime(date('Y-m-d'))),
            'title'         => 'Movement List',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $this->session->userdata('applications'),
            'from_date'     => date('Y-m-d'),
            'to_date'       => date('Y-m-d'),
            'current_app'   => $this->session->userdata('current_app'),
            'tahun'         => $this->ModelMovementList->daftarTahun(),
            'bulan'         => $this->ModelMovementList->daftarBulan()
        ];
        $this->load->view('inventory/stock/v_movementlist', $data);
    }

    public function getAllItem() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $datas = $this->ModelMovementList->getAllItem();
        $response = [
            'status_json'   => true,
            'data'          => $datas
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getItem() {
        cek_session($this->idMenu);
        $input = $this->input;
        $form = [
            'fromDate' => strtotime($input->post('fromDate')),
            'toDate' => strtotime($input->post('toDate')),
            'fromItem' => $input->post('fromItem'),
            'toItem' => $input->post('toItem'),
        ];
        $session = $this->session->userdata('login');
        $datas = $this->ModelMovementList->getItem($form);
        for($i=0; $i<count($datas); $i++) {
            $datas[$i]['no'] = $i+1;
        }
        $response = [
            'status_json'   => true,
            'data'          => $datas
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function getData()
    {
        cek_session($this->idMenu);
        $inputan = $this->input;
        $input = [
            'from_month'    => strtotime($inputan->post('from')),
            'to_month'      => strtotime($inputan->post('to')),
            'year'          => $inputan->post('year'),
            'from_account'  => $inputan->post('from_account'),
            'to_account'    => $inputan->post('to_account')
        ];
        $session = $this->session->userdata('login');
        $response = [];
        $response['status_json'] = true;
        $dataAccount = $this->ModelMovementList->getKepalaAccount1(($input['from_account'] == 'all')? '' : "WHERE fin_cashbank.BankCode BETWEEN '".$input['from_account']."' AND 'CASH".$input['to_account']."'");
        $oke = [];
        foreach ($dataAccount as $c) {
            $jumlahdebit = 0;
            $jumlahcredit = 0;
            $balance = 0;
            $AccountNo = $c['AccountNo'];
            $AccountName = $c['AccountName'];
            $datas = $this->ModelMovementList->getDataReportall($AccountNo);
            $data = [];
            foreach ($datas as $d) {
                $jumlahdebit = $jumlahdebit + intval($d['Debit']);
                $jumlahcredit = $jumlahcredit + intval($d['Credit']);
                $detekAccountNo = substr($AccountNo, '0', '1');
                $tengah = intval(($detekAccountNo == 1 || $detekAccountNo == 5)? $d['Debit'] : $d['Credit']);
                $kanan = intval(($detekAccountNo == 1 || $detekAccountNo == 5)? $d['Credit'] : $d['Debit']);
                $balance = $balance+$tengah-$kanan;
                $data[] = [
                    'date'          => $d['Date'],
                    'reffno'        => $d['ReffNo'],
                    'description'   => $d['Description'],
                    'source'        => $d['source'],
                    'debit'         => $d['Debit'],
                    'credit'        => $d['Credit'],
                    'balance'       => $balance,
                ];
            }
            array_push($oke, $data);
        }
        $ready = [];
        foreach($oke as $ok) {
            foreach($ok as $o) {
                array_push($ready, $o);
            }
        }
        $response['data'] = $ready;
        header("Content-Type: application/json");
        echo json_encode($response);
    }


    public function print() {
        $input = $this->input;
        $form = [
            'fromDate'  => strtotime($input->get('fromDate')),
            'toDate'    => strtotime($input->get('toDate')),
            'fromItem'  => $input->get('fromItem'),
            'toItem'    => $input->get('toItem')
        ];
        $pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Movement List');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
        $pdf->JudulReprot = 'Movement List';
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        $pdf->SetDefaultMonospacedFont('dejavusans');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins('7', '30', '8');
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->SetHeaderMargin(12);
        $datax = [
            'i'         => 1,
            'datas' => $this->ModelMovementList->getItem($form)
        ];
        $pdf->AddPage('P', 'A4');
        $content = $this->load->view('inventory/stock/print_movementlist', $datax, true);
        $pdf->writeHTML($content, true, true, true, true, '');
        $pdf->Output('Movement List.pdf', 'I');
    }
}
