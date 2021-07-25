<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periodeaktif extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/generalsetting/ModelPeriodeaktif');
        $this->load->model('usermanagement/ModelUsers');
    }

    var $idMenu = "546839dd-7b5f-4ee1-8e2e-1f4586b9e7cb";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Periode Aktif',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/generalsetting/v_periodeaktif', $data);
    }

    public function getPeriodeaktif()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelPeriodeaktif->getPeriodeaktif("order by ThnBln");
        $no = 1;
        foreach ($datas as $d) {
            $ThnBln = '"'.$d['ThnBln'].'"';
            $option = "
             <a href='#' class='edit_record btn btn-primary btn-sm'><i class='fa fa-pencil'> Edit</i></a> <a href='#' class='hapus_record btn btn-danger btn-sm'><i class='fa fa-trash'> Hapus</i></a>";
            $data[] = array(
                'no'      => $no,  
                "ThnBln" => $d['ThnBln'],
                "active" => $d['active'],
                "option" => $option

            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
}
