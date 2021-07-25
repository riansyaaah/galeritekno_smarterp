<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ratesetup extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/generalsetting/ModelRatesetup');
        $this->load->model('usermanagement/ModelUsers');
    }

    var $idMenu = "A9F17E54-B271-4F58-898C-6CB7464FC254";

    
    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Rate Setup',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/generalsetting/v_ratesetup', $data);
    }

    public function getRatesetup()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelRatesetup->getRatesetup("order by Thn");
        $no = 1;
        foreach ($datas as $d) {
            $tahun = '"'.$d['Thn'].'"';
            $option = "
             <a href='#' class='edit_record btn btn-primary btn-sm'><i class='fa fa-pencil'> Edit</i></a> <a href='#' class='hapus_record btn btn-danger btn-sm'><i class='fa fa-trash'> Hapus</i></a>";
            $data[] = array(
                "no" => $no,
                "Thn" => $d['Thn'],
                "K01" => $d['K01'],
                "K02" => $d['K02'],
                "K03" => $d['K03'],
                "K04" => $d['K04'],
                "K05" => $d['K05'],
                "K06" => $d['K06'],
                "K07" => $d['K07'],
                "K08" => $d['K08'],
                "K09" => $d['K09'],
                "K10" => $d['K10'],
                "K11" => $d['K11'],
                "K12" => $d['K12'],
                "option" => $option,

            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
}    
  