<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {
    function __Construct()
    {
        parent ::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/master/ModelPerson');
    }

    var $idMenu = "cd7f0bbf-9fef-4e6b-8500-8e7d2aea1917";

    public function index()
    {
        cek_session($this->idMenu);

        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $ip = $this->input->ip_address();
        $moduleDetails = $this->ModelPerson->getDetailPerson();
        $modules = $this->ModelPerson->getDepartement();
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Department - Person',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,

            'moduleDetails'   => $moduleDetails,
            'modules'         => $modules
        );
        $this->load->view('finance/master/v_person', $data);
    }

    function getDepartement()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $search = $this->input->get('search');
        $orderby = "Nama_Dep";
        $where = " WHERE (Kode_Dep LIKE '%".$search."%' OR Nama_Dep LIKE '%".$search."%') ";
        $data = $this->ModelPerson->getDepartement($where, $orderby);
        $response['data'] = $data; 
        echo json_encode($response);
    }

    function getPersonAccess()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $Kode_Dep = $this->input->get('Kode_Dep');
        $data = $this->ModelPerson->getPerson("where Kode_Dep= '$Kode_Dep'");
        $response['data'] = $data; 
        echo json_encode($response);
    }
}