<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataclient extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/invoicing/ModelDataclient', 'cli');
        $this->load->model('usermanagement/ModelUsers');
    }

    var $idMenu = "c64e6783-66cb-4cf2-8609-69bdf0e4610c";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Kwitansi APS',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/invoicing/v_dataclient', $data);
    }
    
    public function getDataclient()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $response = [];
        $response['status_json'] = true;
        $datas = $this->cli->getDataclient("");
        $no = 1;
        foreach ($datas as $d) {
            $data[] = array(
                "no" => $no,
                "instansi" => $d['instansi'],
                "alamat" => $d['alamat'],
                "pic_nama" => $d['pic_nama'],
                "pic_nomorhp" => $d['pic_nomorhp'],
                "pic_email" => $d['pic_email'],
                "hargasm" => $d['hargasm'],
                "hargass" => $d['hargass'],
                "hargasb" => $d['hargasb'],
                "hargasa" => $d['hargasa'],
                "hargara" => $d['hargara'],
                "limitbiaya" => $d['limitbiaya'],
                "jumlahpeserta" => $d['jumlahpeserta'],
                "tanggalkunjungan" => $d['tanggalkunjungan'],

            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    } 
}
