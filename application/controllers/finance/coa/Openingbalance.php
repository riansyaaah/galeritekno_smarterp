<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Openingbalanceaccount extends CI_Controller {

    function __Construct()
    {
        parent ::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
        $this->load->model('finance/ModelProject');
    }

    var $idMenu = "A9F17E54-B271-4F58-898C-6CB7464FC254";

    public function index()
	{
        $ThnActive   = $this->ModelProject->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $sumofdebit = $this->ModelProject->getSumofdebit($thn);
        $sumofkredit = $this->ModelProject->getSumofkredit($thn);
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Opening Balance',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'sumofdebit'   => $sumofdebit[0]['jumlah'],
            'sumofkredit'   => $sumofkredit[0]['jumlah'],
        );
		$this->load->view('finance/coa/v_openingbalance', $data);
    }
    
    
 public function getAccount(){
    
        $ThnActive   = $this->ModelProject->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
     
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelProject->getAccount($thn);
        $no = 1;
        foreach($datas as $d){
             $Id = '"'.$d['AccountNo'].'"';
          $option = "<a href='#' class='btn btn-primary btn-sm' onclick='return editOpeningbalance(".$Id.")'>Edit</a>";
            $data[] = array(
                "no" => $no,
                "account" => $d['AccountNoCol'],
                "description" => $d['AccountName'],
                "debit" => number_format($d['SaldoDebet'],0),
                "credit" => number_format($d['SaldoKredit'],0),
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
    
    function getOpeningbalancebyid(){
        $ThnActive   = $this->ModelProject->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $AccountNo = $this->input->post('code');
            $check = $this->ModelProject->getOpeningbalancebyid($AccountNo,$thn);
            if($check != null){
                $response['data'] = $check;
            }else{
                $data[] = array(
                "AccountNo" => "",
                "AccountName" => "",
                "SaldoDebet" => "",
                "SaldoKredit" => "",

            );
                $response['data'] = $data;
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
