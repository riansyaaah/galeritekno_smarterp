<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ledger extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->library('Pdf');
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
        $this->load->model('finance/reports/ModelLedger');
    }

    var $idMenu = "E83F0968-27B3-45D8-8B65-1D2755725084";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $ThnActive   = $this->ModelLedger->getPeriode();
        $bln = substr($ThnActive[0]['ThnBln'], 4, 2);
        $thn = substr($ThnActive[0]['ThnBln'], 0, 4);

        $data = [
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Ledger Reports',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'from_date'     => date('Y-m-d'),
            'to_date'       => date('Y-m-d'),
            'current_app'   => $sessionCurrentApp,
            'tahun'         => $this->ModelLedger->daftarTahun(),
            'bulan'         => $this->ModelLedger->daftarBulan()
        ];

        $this->load->view('finance/reports/v_ledger', $data);
    }

    public function getCashbank() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelLedger->getCashbank('GROUP BY BankCode ORDER BY BankCode');
        foreach ($datas as $d) {
            $data[] = [
                'BankCode'      => $d['BankCode'],
                'BankName'      => $d['BankName'],
                'BankAccount'   => $d['BankAccount'],
                'AccountNo'     => $d['AccountNo'],
                'Valuta'        => $d['Valuta'],
                'Saldo'         => number_format($d['AvailableSaldo'], 0, ',', '.'),
                'option'        => '<button type="button" class="edit_record btn btn-info btn-sm"><i class="fas fa-check"></i></button>'

            ];
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    }

    public function getData()
    {
        $inputan = $this->input;
        $input = [
            'from_month'    => $inputan->post('from'),
            'to_month'      => $inputan->post('to'),
            'year'          => $inputan->post('year'),
            'from_account'  => $inputan->post('from_account'),
            'to_account'    => $inputan->post('to_account')
        ];
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $dataAccount = $this->ModelLedger->getKepalaAccount1(($input['from_account'] == 'all')? '' : "WHERE fin_cashbank.BankCode BETWEEN '".$input['from_account']."' AND 'CASH".$input['to_account']."'");
        $oke = [];
        foreach ($dataAccount as $c) {
            $jumlahdebit = 0;
            $jumlahcredit = 0;
            $balance = 0;
            $AccountNo = $c['AccountNo'];
            $AccountName = $c['AccountName'];
            $datas = $this->ModelLedger->getDataReportall($AccountNo);
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
            // $data[] = [
            //     'date'          => 'Total',
            //     'reffno'        => '',
            //     'description'   => '',
            //     'source'        => '',
            //     'debit'         => $jumlahdebit,
            //     'credit'        => $jumlahcredit,
            //     'balance'       => '',
            // ];
            // $data[] = [
            //     'date'          => 'Close Balance',
            //     'reffno'        => '',
            //     'description'   => '',
            //     'source'        => '',
            //     'debit'         => '',
            //     'credit'        => '',
            //     'balance'       => $balance,
            // ];
            array_push($oke, $data);
        }
        $ready = [];
        foreach($oke as $ok) {
            foreach($ok as $o) {
                array_push($ready, $o);
            }
        }
        $response['data'] = $ready;
        echo json_encode($response);
    }


    public function print() {
        $inputan = $this->input;
        $input = [
            'from_month'    => $inputan->get('from'),
            'to_month'      => $inputan->get('to'),
            'year'          => $inputan->get('year'),
            'from_account'  => $inputan->get('from_account'),
            'to_account'    => $inputan->get('to_account')
        ];
        $pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Ledger Report');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
        $pdf->JudulReprot = 'Ledger Report';
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont('dejavusans');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins('7', '30', '8');
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->SetHeaderMargin(12);
        $dataAccount = $this->ModelLedger->getKepalaAccount1(($input['from_account'] == 'all')? '' : "WHERE fin_cashbank.BankCode BETWEEN '".$input['from_account']."' AND 'CASH".$input['to_account']."'");
        foreach ($dataAccount as $c) {
            $jumlahdebit = 0;
            $jumlahcredit = 0;
            $balance = 0;
            $AccountNo = $c['AccountNo'];
            $AccountName = $c['AccountName'];
            $datas = $this->ModelLedger->getDataReportall($AccountNo);
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
            $data[] = [
                'date'          => 'Total',
                'reffno'        => '',
                'description'   => '',
                'source'        => '',
                'debit'         => $jumlahdebit,
                'credit'        => $jumlahcredit,
                'balance'       => '',
            ];
            $data[] = [
                'date'          => 'Close Balance',
                'reffno'        => '',
                'description'   => '',
                'source'        => '',
                'debit'         => '',
                'credit'        => '',
                'balance'       => $balance,
            ];
            $datax = [
                'datenow'       => date('d-m-Y'),
                'title'         => 'Ledger Reports',
                'AccountNo'     => $AccountNo,
                'AccountName'   => $AccountName,
                'list_ledger'   => $data
            ];
            $content = $this->load->view('finance/reports/print/print_ledger', $datax, true);
            $pdf->AddPage('P', 'A4');
            $pdf->writeHTML($content);
        }
        $pdf->Output('Laporan Ledger.pdf', 'I');
    }
}
