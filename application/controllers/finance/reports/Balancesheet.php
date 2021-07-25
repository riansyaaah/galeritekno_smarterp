<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Balancesheet extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->library('Pdf');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
        $this->load->model('finance/reports/ModelBalancesheet');
    }

    var $idMenu = "ABCFD64F-0472-4277-965E-6AE618D9878C";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date('Y-m-d');
        $ThnActive   = $this->ModelBalancesheet->getPeriode();
        $bln = substr($ThnActive[0]['ThnBln'], 4, 2);
        $thn = substr($ThnActive[0]['ThnBln'], 0, 4);
        $data = [
            'datenow'       => date('d-m-Y', strtotime($date)),
            'title'         => 'Balance Sheet Reports',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'from_date'     => date('Y-m-d'),
            'to_date'       => date('Y-m-d'),
            'current_app'   => $sessionCurrentApp,
            'tahun'         => $this->ModelBalancesheet->tahun(),
            'bulan'         => $this->ModelBalancesheet->bulan()
        ];
        $this->load->view('finance/reports/v_balancesheet', $data);
    }

    /*public function getData1()
    {
        $month= $this->input->post('month');
        $year = $this->input->post('year');
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelBalancesheet->getDataCash(" where AccountNo like '1%' and (Level != 'MASTER' and Level != 'CODE')");
        $no = 1;
        foreach ($datas as $d) {
            $data[] = array(
                "description" => $d['AccountName'],
                "FIRST" => "0",
                "SECOND" => "0",
            );
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    }
    public function getData2()
    {
        $month= $this->input->post('month');
        $year = $this->input->post('year');
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelBalancesheet->getDataCash(" where AccountNo like '2%' and (Level != 'MASTER' and Level != 'CODE')");
        $no = 1;
        foreach ($datas as $d) {
            $data[] = array(
                "description" => $d['AccountName'],
                "FIRST" => "0",
                "SECOND" => "0",
            );
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    }*/
    public function cetak() {
        $year = $this->input->get('year');
        $month = $this->_cekBulan($this->input->get('month'));
        $pdf = new PDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Balance Sheet Report');
        $pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
        $pdf->JudulReprot = 'BALANCE SHEETS';
        $pdf->Periode = $month.' '.$year;
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont('dejavusans');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins('7', '33', PDF_MARGIN_RIGHT);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetHeaderMargin(12);
        $kiri = $this->ModelBalancesheet->getBalanceData("AND fin_mastercoa.AccountNo LIKE '1%'");
        $kanan = $this->ModelBalancesheet->getBalanceData("AND fin_mastercoa.AccountNo LIKE '2%'");
        $kanan2 = $this->ModelBalancesheet->getBalanceData("AND fin_mastercoa.AccountNo LIKE '3%'");
        $dataPrint = [
            'kiri'  => $this->_dataPrint($kiri),
            'kanan' => $this->_dataPrint($kanan),
            'kanan2' => $this->_dataPrint($kanan2)
        ];
        $datax = [
            'datenow'                   => date("d-m-Y"),
            'title'                     => 'Balance Sheet Reports',
            'tgl'                       => [],
            'list_balancesheetkiri'     => $this->_aturDataAkhir($dataPrint['kiri']),
            'list_balancesheetkanan'    => $this->_aturDataAkhir($dataPrint['kanan']),
            'list_balancesheetkanan2'    => $this->_aturDataAkhir($dataPrint['kanan2']),
        ];
        $content = $this->load->view('finance/reports/print/print_balancesheet', $datax, true);
        $pdf->AddPage('L', 'A4');
        $pdf->writeHTML($content);
        $pdf->Output('Balance Sheets.pdf', 'I');
    }
    private function _cekBulan($bulan) {
        $daftarBulan = $this->ModelBalancesheet->bulan();
        foreach($daftarBulan as $db) {
            if($db[0] == $bulan) {
                return strtoupper($db[1]);
            }
        }
    }
    private function _aturDataAkhir($data) {
        $hasil = [];
        foreach($data as $d) {
            if($d['level'] == 'TYPE') {
                $d['group'] = [];
                array_push($hasil, $d);
            }
        }
        foreach($data as $d) {
            for($i=0; $i<count($hasil); $i++) {
                if($d['AccountParrent'] == $hasil[$i]['nourut']) {
                    $d['sgroup'] = [];
                    array_push($hasil[$i]['group'], $d);
                }
            }
            for($i=0; $i<count($hasil); $i++) {
                for($j=0; $j<count($hasil[$i]['group']); $j++) {
                    if($d['AccountParrent'] == $hasil[$i]['group'][$j]['nourut']) {
                        array_push($hasil[$i]['group'][$j]['sgroup'], $d);
                    }
                }
            }
        }
        for($i=0; $i<count($hasil); $i++) {
            $opendebit = 0;
            $opencredit = 0;
            $mutasidebit = 0;
            $mutasicredit = 0;
            $level = 0;
            for($j=0; $j<count($hasil[$i]['group']); $j++) {
                $opendebit = 0+$hasil[$i]['group'][$j]['opendebit'];
                $opencredit = 0+$hasil[$i]['group'][$j]['opencredit'];
                $mutasidebit = 0+$hasil[$i]['group'][$j]['mutasidebit'];
                $mutasicredit = 0+$hasil[$i]['group'][$j]['mutasicredit'];
                array_push($hasil[$i]['group'][$j]['sgroup'], [
                    'nourut'            => $hasil[$i]['nourut'].'00',
                    'AccountParrent'    => $hasil[$i]['nourut'],
                    'AccountName'       => $this->_spasi(15).'TOTAL '.str_replace('&nbsp;', '', $hasil[$i]['group'][$j]['AccountName']),
                    'opendebit'         => $opendebit,
                    'opencredit'        => $opencredit,
                    'mutasidebit'       => $mutasidebit,
                    'mutasicredit'      => $mutasicredit,
                    'level'             => 'SGROUP'
                ]);
            }
        }
        return $hasil;
    }
    private function _dataPrint($data) {
        foreach($data as $d) {
            $hasil[] = [
                'nourut'            => $d['AccountNo'],
                'AccountParrent'    => $d['AccountParrent'],
                'AccountName'       => $this->_dorong($d),
                'opendebit'         => $d['opendebit'],
                'opencredit'        => $d['opencredit'],
                'mutasidebit'       => $d['mutasidebit'],
                'mutasicredit'      => $d['mutasicredit'],
                'level'             => $d['level']
            ];
        }
        return $hasil;
    }
    private function _dorong($d) {
        if($d['level'] == 'TYPE') {
            $dorong = $this->_spasi(5);
        } elseif($d['level'] == 'GROUP') {
            $dorong = $this->_spasi(10);
        } elseif($d['level'] == 'SGROUP') {
            $dorong = $this->_spasi(15);
        }
        return $dorong.$d['AccountName'];
    }
    private function _spasi($jumlah) {
        $spasi = '';
        for($i = 1; $i <= $jumlah; $i++) {
            $spasi .= '&nbsp;';
        }
        return $spasi;
    }
}
