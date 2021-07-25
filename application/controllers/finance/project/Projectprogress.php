<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Projectprogress extends CI_Controller
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

    var $idMenu = "04ea3305-30ff-4b19-9acf-fcadd769a153";

    
    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Project Progress',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/project/v_projectprogress', $data);
    }

    public function getCustomer()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelProject->getCustomer('order by ClientID');
        $no = 1;
        foreach ($datas as $d) {
            $clientid = '"'.$d['ClientID'].'"';
            $option = "
             <a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
            $data[] = array(
                "no" => $no,
                "ClientID" => $d['ClientID'],
                "ClientName" => $d['ClientName'],
                "Inisial" => $d['Inisial'],
                "option" => $option,
            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
}
  