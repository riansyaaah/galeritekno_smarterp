<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fixedassets extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/inventaris/ModelInventaris');
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
            'title'         => 'Fixed Assets',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/inventaris/v_fixedassets', $data);
    }

    public function getFixedassets()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelInventaris->getFixedassets('order by AccountNo');
        $no = 1;
        foreach ($datas as $d) {
            $accountno = '"'.$d['AccountNo'].'"';
            $option = "";
            $data[] = array(
                "no" => $no,
                "AccountNo" => $d['AccountNo'],
                "AccountName" => $d['AccountName'],
                "Tgl_Assets" => $d['Tgl_Assets'],
                "option" => $option,
            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
}
 