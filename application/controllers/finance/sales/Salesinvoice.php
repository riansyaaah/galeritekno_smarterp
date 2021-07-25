<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Salesinvoice extends CI_Controller
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
        $this->load->model('finance/sales/ModelSalesinvoice');
    }

    var $idMenu = "1ACF26C0-13FE-4004-824F-33352379F6CB";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $ThnActive   = $this->ModelSalesinvoice->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Sales Invoice',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'tahunaktif' =>  $thn,
        );
        $this->load->view('finance/sales/v_salesinvoice', $data);
    }
    public function getInvClient()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelSalesinvoice->getInvClient("order by SalesInvoiceDate desc");
        $no = 1;
        foreach ($datas as $d) {
            $option = "<a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
            $data[] = array(
                "no" => $no,
                "SalesInvoiceNo" => $d['SalesInvoiceNo'],
                "SalesInvoiceDate" => $d['SalesInvoiceDate'],
                "SalesInvoiceDuedate" => $d['SalesInvoiceDuedate'],
                "client_id" => $d['ClientID'],
                "client_name" => $d['ClientName'],
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
    public function getClient()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelSalesinvoice->getClient("order by ClientID");
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
    public function addInv(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Sales Invoice"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $SalesInvoiceNo = $this->input->post('SalesInvoiceNo');
            $SalesInvoiceDate = $this->input->post('SalesInvoiceDate');
            $SalesInvoiceDuedate = $this->input->post('SalesInvoiceDuedate');
            $Valuta = $this->input->post('Valuta');
            $Rate = $this->input->post('Rate');
            $PPn = $this->input->post('PPn');
            $Discount = $this->input->post('Discount');
            $OtherCost = $this->input->post('OtherCost');
            $TaxNo = $this->input->post('TaxNo');
            $SubTotal = $this->input->post('SubTotal');
            $GrandTotal = $this->input->post('GrandTotal');
            $client_id = $this->input->post('client_id');
            $StatusInv = $this->input->post('StatusInv');
            
            $post = true;

            if($post){
                $dataInsert = array(
                        'SalesInvoiceNo' => $SalesInvoiceNo,
                        'SalesInvoiceDate' => $SalesInvoiceDate,
                        'SalesInvoiceDuedate' => $SalesInvoiceDuedate,
                        'Valuta' => $Valuta,
                        'Rate' => $Rate,
                        'PPn' => $PPn,
                        'Discount' => $Discount,
                        'OtherCost' => $OtherCost,
                        'TaxNo' => $TaxNo,
                        'SubTotal' => $SubTotal,
                        'GrandTotal' => $GrandTotal,
                        'client_id' => $client_id,
                );
                if($StatusInv == 'New'){   
                $cekNoRef = $this->ModelSalesinvoice->getSalesinvoice(" where SalesInvoiceNo = '$SalesInvoiceNo'");
                if(count($cekNoRef) > 0){
                   $response['status_json'] = false;
                    $response['remarks'] = "Purchase Invoice No. sudah ada!"; 
                    $this->db->trans_rollback();
                }else{
                    $this->ModelGeneral->InsertData('fin_salesinvoice', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Sales Invoice NO : '.$SalesInvoiceNo);

                }
                }else{
                    $this->ModelGeneral->UpdateData('fin_salesinvoice', $dataInsert,array('SalesInvoiceNo' => $SalesInvoiceNo));
                    $this->ModelGeneral->LogActivity('Process Edit Sales Invoice NO : '.$SalesInvoiceNo);
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
    
    function getSalesinvoicebyid(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
        $SalesInvoiceNo  = $this->input->post('SalesInvoiceNo');
        
            $check = $this->ModelSalesinvoice->getSalesinvoice(" WHERE SalesInvoiceNo = '".$SalesInvoiceNo."' ");
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
    public function getSalesinvoicedetail()
    {
        $SalesInvoiceNo  = $this->input->post('SalesInvoiceNo');
        
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelSalesinvoice->getSalesinvoicedetail(" where SalesInvoiceNo = '$SalesInvoiceNo'");
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
                "Price" => $d['Price'],
                "Amount" => $d['Amount'],
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
            $SalesInvoiceNo = $this->input->post('SalesInvoiceNo');
            $itemDescription = $this->input->post('itemDescription');
            $itemUnit = $this->input->post('itemUnit');
            $itemQty = $this->input->post('itemQty');
            $itemPrice = $this->input->post('itemPrice');
            
            $post = true;

            if($post){
                $dataInsert = array(
                    'SalesinvoiceNo'      => $SalesInvoiceNo,
                    'Description'=> $itemDescription,
                    'Unit'=> $itemUnit,
                    'Qty'=> $itemQty,
                    'Price'=> $itemPrice,
                    'Amount'=> intval($itemQty)*intval($itemPrice),
                );
                $this->ModelGeneral->InsertData('fin_salesinvoice_detail', $dataInsert);
                $this->ModelGeneral->LogActivity('Process Insert New Detail Invoice : '.$SalesInvoiceNo);
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
