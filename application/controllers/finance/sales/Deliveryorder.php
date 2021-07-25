<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deliveryorder extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
        $this->load->model('finance/sales/ModelDeliveryorder');
    }

    var $idMenu = "99F0D9D2-941C-47EA-B4D7-5077BA730B68";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $ThnActive   = $this->ModelDeliveryorder->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Delivery Order',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'tahunaktif' =>  $thn,
        );
        $this->load->view('finance/sales/v_deliveryorder', $data);
    }
    
    public function getClient()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelDeliveryorder->getClient("order by ClientID");
        $no = 1;
        foreach ($datas as $d) {
            $option = "<a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
            $data[] = array(
                "no" => $no,
                "ClientID" => $d['ClientID'],
                "ClientName" => $d['ClientName'],
                "option" => $option,

            );
            $no++;
        }
        if(count($datas)>0){
        $response['data'] = $data;
        }else{
            $response['data'] = array();
        }
        echo json_encode($response);
    }
    public function getDOClient()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelDeliveryorder->getDOClient("order by DeliveryOrderDate desc");
        $no = 1;
        foreach ($datas as $d) {
            $option = "<a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
            $data[] = array(
                "no" => $no,
                "DeliveryOrderNo" => $d['DeliveryOrderNo'],
                "DeliveryOrderDate" => $d['DeliveryOrderDate'],
                "client_id" => $d['ClientID'],
                "client_name" => $d['ClientName'],
                "ShipTo" => $d['ShipTo'],
                "DeliveredBy" => $d['DeliveredBy'],
                "option" => $option,

            );
            $no++;
        }
        if(count($datas)>0){
        $response['data'] = $data;
        }else{
            $response['data'] = array();
        }
        echo json_encode($response);
    }
    public function addDO(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Delivery Order"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $DeliveryOrderNo = $this->input->post('DeliveryOrderNo');
            $DeliveryOrderDate = $this->input->post('DeliveryOrderDate');
            $ContractNo = $this->input->post('ContractNo');
            $ShipTo = $this->input->post('ShipTo');
            $DeliveredBy = $this->input->post('DeliveredBy');
            $client_id = $this->input->post('client_id');
            $StatusDO = $this->input->post('StatusDO');
            $post = true;

            if($post){
                $dataInsert = array(
                        'DeliveryOrderNo' => $DeliveryOrderNo,
                        'DeliveryOrderDate' => $DeliveryOrderDate,
                        'ContractNo' => $ContractNo,
                        'ShipTo' => $ShipTo,
                        'DeliveredBy' => $DeliveredBy,
                        'client_id' => $client_id,
                );
            if($StatusDO == 'New'){    
            $cekNoRef = $this->ModelDeliveryorder->getDeliveryorder(" where DeliveryOrderNo = '$DeliveryOrderNo'");
            if(count($cekNoRef) > 0){
               $response['status_json'] = false;
                $response['remarks'] = "Delivery Order No. sudah ada!"; 
                $this->db->trans_rollback();
            }else{
                $this->ModelGeneral->InsertData('fin_deliveryorder', $dataInsert);
                $this->ModelGeneral->LogActivity('Process Insert New Delivery Order NO : '.$DeliveryOrderNo);
            }
            }else{
                $this->ModelGeneral->UpdateData('fin_deliveryorder', $dataInsert,array('DeliveryOrderNo' => $DeliveryOrderNo));
                $this->ModelGeneral->LogActivity('Process Edit Delivery Order NO : '.$DeliveryOrderNo);
            }
                $this->db->trans_complete();
                $this->db->trans_commit();
            }else{
                $response['status_json'] = false;
                $response['remarks'] = "Nomor urut atau nama modul sudah ada!"; 
                $this->db->trans_rollback();
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }
    
    function getDeliveryorderbyid(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
        $DeliveryOrderNo  = $this->input->post('DeliveryOrderNo');
        
            $check = $this->ModelDeliveryorder->getDeliveryorder(" WHERE DeliveryOrderNo = '".$DeliveryOrderNo."' ");
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
    public function getDeliveryorderdetail()
    {
        $DeliveryOrderNo  = $this->input->post('DeliveryOrderNo');
        
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelDeliveryorder->getDeliveryorderdetail(" where DeliveryOrderNo = '$DeliveryOrderNo'");
        $no = 1;
        
        foreach ($datas as $d) {
            $Id = '"'.$d['id'].'"';
            $option = "<a href='#' class='edit_record btn btn-info btn-sm' onclick='return editItem(".$Id.")'>+ Edit</a>
             <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapusItem(".$Id.")'>+ Hapus</a>";
            $data[] = array(
                "no" => $no,
                "Description" => $d['Description'],
                "Qty" => $d['Qty'],
                "Unit" => $d['Unit'],
                "PN" => $d['PN'],
                "SN" => $d['SN'],
                "option" => $option,

            );
            $no++;
        }
        if(count($datas)>0){
        $response['data'] = $data;
        }else{
            $response['data'] = array();
        }
        echo json_encode($response);
    }
    
    public function addItem(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Item Invoice baru"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $DeliveryOrderNo = $this->input->post('DeliveryOrderNo');
            $itemDescription = $this->input->post('itemDescription');
            $itemUnit = $this->input->post('itemUnit');
            $itemQty = $this->input->post('itemQty');
            $itemPN = $this->input->post('itemPN');
            $itemSN = $this->input->post('itemSN');
            
            $post = true;

            if($post){
                $dataInsert = array(
                    'DeliveryOrderNo'      => $DeliveryOrderNo,
                    'Description'=> $itemDescription,
                    'Unit'=> $itemUnit,
                    'Qty'=> $itemQty,
                    'PN'=> $itemPN,
                    'SN'=> $itemSN,
                );
                $this->ModelGeneral->InsertData('fin_deliveryorder_detail', $dataInsert);
                $this->ModelGeneral->LogActivity('Process Insert New Detail Delivery Order : '.$DeliveryOrderNo);
                $this->db->trans_complete();
                $this->db->trans_commit();
                
                
            }else{
                $response['status_json'] = false;
                $response['remarks'] = "Nomor urut atau nama modul sudah ada!"; 
                $this->db->trans_rollback();
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
