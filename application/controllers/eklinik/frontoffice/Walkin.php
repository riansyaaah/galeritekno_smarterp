<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Walkin extends CI_Controller {

    function __Construct()
    {
        parent ::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
    }

    var $idMenu = "D4EC0A07-AF5F-4D78-ABD4-98C5D04D632D";

    public function index()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Registrasi Walkin',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/v_walkin', $data);
    }

    public function getPasien(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getPasien();
        $no = 1;
        foreach($datas as $d){
             $Id = '"'.$d['id'].'"';
          $option = "<a href='#' class='btn btn-primary' onclick='return detailPasien(".$Id.")'>Detail</a>";
            $data[] = array(
                "no" => $no,
                "registrasi" => $d['tanggalregistrasi']."-".$d['nomorregistrasi'],
                "waktukunjungan" => $d['tanggalkunjungan'].", ".$d['jamkunjungan'],
                "instansi" => $d['client_id'],
                "nama" => $d['nama'],
                "tanggallahir" => $d['tanggallahir'],
                "nik" => $d['nik'],
                "paket" => $d['paket_id'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
}
