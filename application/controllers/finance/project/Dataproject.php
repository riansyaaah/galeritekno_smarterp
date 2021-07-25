<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dataproject extends CI_Controller
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

    var $idMenu = "ce1243af-31b7-453c-a62d-4451bbe693bf";

    
    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $list_project = $this->ModelProject->getDataproject();
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Project',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'list_project'  => $list_project
        );
        $this->load->view('finance/project/v_dataproject', $data);
    }

    public function getDataproject()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelProject->getDataproject('order by ClientId');
        $no = 1;
        foreach ($datas as $d) {
            $clientid = '"'.$d['ClientId'].'"';
            $option = "
             <a href='#' class='edit_record btn btn-primary btn-sm'><i clas='fa fa-pencil'> Edit</i></a> <a href='#' class='hapus_record btn btn-danger btn-sm'> <i class='fa fa-trash'> Hapus</i></a>";
            $data[] = array(
                "no" => $no,
                "Nama_Project" => $d['Nama_Project'],
                "Inisial_Project" => $d['Inisial_Project'],
                "option" => $option,
            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
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
    