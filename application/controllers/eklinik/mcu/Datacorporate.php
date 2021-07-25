<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datacorporate extends CI_Controller 
{
    function __Construct()
    {
        parent ::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('eklinik/mcu/ModelMcu');
    }
	var $idMenu = "069dbef3-1a26-478c-a6c4-e3d10a7f8ce9";

    public function index()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Corporate',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/mcu/v_datacorporate', $data);
    }

    public function getCorporate()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelMcu->getCorporate();
        $no = 1;
        foreach($datas as $d){
            $Id = '"'.$d['ClientID'].'"';
            $option = "<a href='#' class='btn btn-primary' onclick='return detail(".$Id.")'>Detail</a>
            ";
            $data[] = array(
                "no" => $no,
                "client_name" => $d['ClientName'],
                "address" => $d['Address'],
                "phone" => $d['Phone'],
                "fax" => $d['Fax'],
                "email" => $d['EMail'],
                "cp" => $d['CP'],
                "hp" => $d['HP'],
                "npwp" => $d['NPWP'],
                "tgl_npwp" => $d['Tgl_NPWP'],
                "address_npwp" => $d['Address_NPWP'],
                "account_no" => $d['AccountNo'],
                "inisial" => $d['Inisial'],
                "kode_bis" => $d['Kode_Bis'],
                "option" => $option,
            );
            $no ++;
        }
        if (count($datas) > 0) {
            $response['data'] = $data;
        } else {
            $response['data'] = array();
        }
        echo json_encode($response);
    }

    function getCorporatebyid()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $client_id = $this->input->post('client_id');
            $check = $this->ModelMcu->getCorporate(" WHERE ClientID = '".$client_id."' ");
            if($check != null){
                $response['data'] = $check;
            }else{
                $response['status_json'] = false;
                $response['remarks'] = "Item tidak ditemukan"; 
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }
}    

