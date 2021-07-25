<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoiceclient extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/invoicing/ModelInvoiceclient', 'inv');
        $this->load->model('usermanagement/ModelUsers');
    }

    var $idMenu = "1ACF26C0-13FE-4004-824F-33352379F6CB";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Invoice Client',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/invoicing/v_invoiceclient', $data);
    }
    
    public function getInvoiceclient()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $response = [];
        $response['status_json'] = true;
        $datas = $this->inv->getInvoiceclient("");
        $no = 1;
        foreach ($datas as $d) {
            $kode = '"'.$d['id'].'"';
            $data[] = array(
                "no" => $no,
                "tanggalinvoice" => $d['tanggalinvoice'],
                "nomorinvoice" => $d['nomorinvoice'],
                "instansi" => $d['instansi'],
                "attn" => $d['attn'],
                "totaltagihan" => number_format((intval($d['qtyss']) * intval($d['hargasatuanss'])) + (intval($d['qtysb']) * intval($d['hargasatuansb'])) + (intval($d['qtysa']) * intval($d['hargasatuansa'])) + (intval($d['qtyra']) * intval($d['hargasatuanra'])),0),
                "vatpph" => $d['vatpph'],
                "metodebayar" => $d['metodebayar'],
                "tanggalbayar" => $d['tanggalbayar'],
                "statusbayar" => $d['statusbayar'],
                "tanggaljatuhtempo" => $d['tanggaljatuhtempo'],
                "invoice" => "",


            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    } 
}
