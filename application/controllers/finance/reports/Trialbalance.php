<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trialbalance extends CI_Controller
{
    function __Construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->library('Pdf');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
        $this->load->model('finance/reports/ModelTrialbalance');
    }
    var $idMenu = 'E83F0968-27B3-45D8-8B65-1D2755725084';
    public function index() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $ThnActive   = $this->ModelTrialbalance->getPeriode();
        $bln = substr($ThnActive[0]['ThnBln'], 4, 2);
        $thn = substr($ThnActive[0]['ThnBln'], 0, 4);
        $data = [
            'datenow'       => date('d-m-Y', strtotime($date)),
            'title'         => 'Trial Balance Reports',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'from_date'     => date('Y-m-d'),
            'to_date'       => date('Y-m-d'),
            'current_app'   => $sessionCurrentApp,
            'tahun'         => $this->ModelTrialbalance->tahun(),
            'bulan'         => $this->ModelTrialbalance->bulan()
        ];
        $this->load->view('finance/reports/v_trialbalance', $data);
    }
    public function getData() {
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response['status_json'] = true;
        $datas = $this->ModelTrialbalance->getDataCash('ORDER BY fin_mastercoa.AccountNo ASC');
        $no = 1;
        foreach ($datas as $d) {
            if($d['level'] == 'TYPE') {
                $dorong = '';
            } elseif($d['level'] == 'GROUP') {
                $dorong = $this->_spasi(5);
            } elseif($d['level'] == 'SGROUP') {
                $dorong = $this->_spasi(10);
            } elseif($d['level'] == 'CODE') {
                $dorong = $this->_spasi(20);
            } else {
                $dorong = $this->_spasi(30);
            }
            $data[] = [
                'description'   => $dorong.$d['AccountName'],
                'Odebet'        => $d['opendebit'],
                'Ocredit'       => $d['opencredit'],
                'Mdebet'        => $d['mutasidebit'],
                'Mcredit'       => $d['mutasicredit'],
                'Cdebet'        => '',
                'Ccredit'       => ''
            ];
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    }

    private function _namaBulan($month) {
        foreach($this->ModelTrialbalance->bulan() as $b) {
            if($b[0] == $month) {
                return strtoupper($b[1]);
            }
        }
    }
    public function cetak() {
        $year = $this->input->get('year');
        $month = $this->input->get('month');
        $namaBulan = $this->_namaBulan($month);
        $pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Trial Balance Report');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
        $pdf->JudulReprot = 'Trial Balance Report';
        $pdf->Periode = $namaBulan.' '.$year;
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        $pdf->SetDefaultMonospacedFont('dejavusans');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $datas = $this->ModelTrialbalance->getDataCash($year.'-'.$month, 'ORDER BY fin_mastercoa.AccountNo ASC');
        $limitData = 28;
        foreach(array_chunk($this->_dataCetak($datas), $limitData) as $dp) {
            $datax = [
                'datenow'           => date("d-m-Y"),
                'title'             => 'Trial Balance Reports',
                'list_trialbalance' => $dp
            ];
            $pdf->AddPage('L', 'A4');
            $content = $this->load->view('finance/reports/print/print_trialbalance', $datax, true);
            $pdf->writeHTML($content, true, false, false, false, '');
        }
        $pdf->Output('Trial Balance.pdf', 'I');
    }
    private function _dataCetak($datas) {
        foreach ($datas as $d) {
            if($d['level'] == 'TYPE') {
                $isTotal = $this->_isTotal($d, 10, 0);
            } elseif($d['level'] == 'GROUP') {
                $isTotal = $this->_isTotal($d, 20, 10);
            } elseif($d['level'] == 'SGROUP') {
                $isTotal = $this->_isTotal($d, 28, 20);
            } elseif($d['level'] == 'CODE') {
                $isTotal = $this->_isTotal($d, 35, 27);
            } else {
                $isTotal = $this->_isTotal($d, 0, 30);
            }
            $close = $this->_close($d);
            $data[] = [
                'description'   => $isTotal['desc'],
                'opendebit'     => $this->_digit($d['opendebit']),
                'opencredit'    => $this->_digit($d['opencredit']),
                'mutasidebit'   => $this->_digit($d['mutasidebit']),
                'mutasicredit'  => $this->_digit($d['mutasicredit']),
                'closedebit'    => $this->_digit($close['debit']),
                'closecredit'   => $this->_digit($close['credit']),
                'level'         => $d['level'],
                'total'         => $isTotal['total']
            ];
        }
        return $data;
    }
    private function _isTotal($d, $spasiTotal, $spasiBukanTotal) {
        $adaTotal = (explode(' ', $d['AccountName'])[0] == 'TOTAL')? 1 : 0;
        return [
            'desc'  => ($adaTotal == 1)? $this->_spasi($spasiTotal).$d['AccountName'] : $this->_spasi($spasiBukanTotal).$d['AccountNo'].$this->_spasi(6).$d['AccountName'],
            'total' => $adaTotal
        ];
    }
    private function _digit($angka) {
        return number_format(intval($angka), 2, ',', '.');
    }
    private function _close($d) {
        if(substr($d['nourut'],'0','1') or substr($d['nourut'],'0','5')) {
            $balance = (intval($d['opendebit'])+intval($d['mutasidebit']))-(intval($d['opencredit'])+intval($d['mutasicredit']));
        } else {
            $balance = (intval($d['opencredit'])+intval($d['mutasicredit']))-(intval($d['opendebit'])+intval($d['mutasidebit']));
        }
        return [
            'debit'     => ($balance > 0 )? $balance : 0,
            'credit'    => ($balance > 0 )? 0 : $balance*-1
        ];
    }
    private function _spasi($jumlah) {
        $spasi = '';
        for($i = 1; $i <= $jumlah; $i++) {
            $spasi .= '&nbsp;';
        }
        return $spasi;
    }
}
