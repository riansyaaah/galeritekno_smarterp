<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Closingproject extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/project/ModelProject');
        $this->load->model('usermanagement/ModelUsers');
    }

    var $idMenu = "e3729320-5223-46dd-8b34-4228779715d7";

    
    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Closing Project',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/project/v_closingproject', $data);
    }

    public function getAccount()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelProject->getAccount();
        $no = 1;
        foreach ($datas as $d) {
            $accountno = '"'.$d['AccountNo'].'"';
            $option = "
                <a href='#' class='edit_record btn btn-primary btn-sm'><i class='fa fa-pencil'> Edit</i></a>";
            $data[] = array(
                "no" => $no,
                "AccountNo" => $d['AccountNo'],
                "AccountName" => $d['AccountName'],
                "SaldoDebet" => $d['SaldoDebet'],
                "SaldoKredit" => $d['SaldoKredit'],
                "option" => $option,

            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
}