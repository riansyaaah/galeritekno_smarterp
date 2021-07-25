<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchaseinvoice extends CI_Controller
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
        $this->load->model('finance/purchase/ModelPurchaseinvoice');
    }

    var $idMenu = "5375E7B2-BE4B-44AC-B88F-06D2AC319FF9";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $ThnActive   = $this->ModelPurchaseinvoice->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Purchase Invoice',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'tahunaktif' =>  $thn,
        );
        $this->load->view('finance/purchase/v_purchaseinvoice', $data);
    }
    public function getInvSupplier()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelPurchaseinvoice->getInvSupplier("order by PurchaseInvoiceDate desc");
        $no = 1;
        foreach ($datas as $d) {
            $option = "<a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
            $data[] = array(
                "no" => $no,
                "PurchaseInvoiceNo" => $d['PurchaseInvoiceNo'],
                "PurchaseInvoiceDate" => $d['PurchaseInvoiceDate'],
                "PurchaseInvoiceDuedate" => $d['PurchaseInvoiceDuedate'],
                "supplier_id" => $d['Kode_Spl'],
                "supplier_name" => $d['Nama_Spl'],
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
    public function getSupplier()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelPurchaseinvoice->getSupplier("order by Kode_Spl");
        $no = 1;
        foreach ($datas as $d) {
            $option = "<a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
            $data[] = array(
                "no" => $no,
                "Kode_Spl" => $d['Kode_Spl'],
                "Nama_Spl" => $d['Nama_Spl'],
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
        $response['remarks'] = "Berhasil menyimpan Purchase Invoice"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $PurchaseInvoiceNo = $this->input->post('PurchaseInvoiceNo');
            $PurchaseInvoiceDate = $this->input->post('PurchaseInvoiceDate');
            $PurchaseInvoiceDuedate = $this->input->post('PurchaseInvoiceDuedate');
            $Valuta = $this->input->post('Valuta');
            $Rate = $this->input->post('Rate');
            $Description = $this->input->post('Description');
            $PPn = $this->input->post('PPn');
            $PPh = $this->input->post('PPh');
            $Discount = $this->input->post('Discount');
            $OtherCost = $this->input->post('OtherCost');
            $TaxNo = $this->input->post('TaxNo');
            $SubTotal = $this->input->post('SubTotal');
            $GrandTotal = $this->input->post('GrandTotal');
            $supplier_id = $this->input->post('supplier_id');
            $StatusInv = $this->input->post('StatusInv');
            
            $post = true;

            if($post){
                $dataInsert = array(
                        'PurchaseInvoiceNo' => $PurchaseInvoiceNo,
                        'PurchaseInvoiceDate' => $PurchaseInvoiceDate,
                        'PurchaseInvoiceDuedate' => $PurchaseInvoiceDuedate,
                        'Valuta' => $Valuta,
                        'Rate' => $Rate,
                        'Description' => $Description,
                        'PPn' => $PPn,
                        'PPh' => $PPh,
                        'Discount' => $Discount,
                        'OtherCost' => $OtherCost,
                        'TaxNo' => $TaxNo,
                        'SubTotal' => $SubTotal,
                        'GrandTotal' => $GrandTotal,
                        'supplier_id' => $supplier_id,
                );
             if($StatusInv == 'New'){   
            $cekNoRef = $this->ModelPurchaseinvoice->getPurchaseinvoice(" where PurchaseInvoiceNo = '$PurchaseInvoiceNo'");
            if(count($cekNoRef) > 0){
               $response['status_json'] = false;
                $response['remarks'] = "Purchase Invoice No. sudah ada!"; 
                $this->db->trans_rollback();
            }else{
                $this->ModelGeneral->InsertData('fin_purchaseinvoice', $dataInsert);
                $this->ModelGeneral->LogActivity('Process Insert New Purchase Invoice NO : '.$PurchaseInvoiceNo);
                
            }
             }else{
                 $this->ModelGeneral->UpdateData('fin_purchaseinvoice', $dataInsert,array('PurchaseInvoiceNo' => $PurchaseInvoiceNo));
                $this->ModelGeneral->LogActivity('Process Edit Invoice NO : '.$PurchaseInvoiceNo);
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
    
    function getPurchaseInvoicebyid(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
        $PurchaseInvoiceNo  = $this->input->post('PurchaseInvoiceNo');
        
            $check = $this->ModelPurchaseinvoice->getPurchaseinvoice(" WHERE PurchaseInvoiceNo = '".$PurchaseInvoiceNo."' ");
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
    public function getPurchaseInvoicedetail()
    {
        $PurchaseInvoiceNo  = $this->input->post('PurchaseInvoiceNo');
        
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelPurchaseinvoice->getPurchaseinvoicedetail(" where PurchaseInvoiceNo = '$PurchaseInvoiceNo'");
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
            $PurchaseInvoiceNo = $this->input->post('PurchaseInvoiceNo');
            $itemDescription = $this->input->post('itemDescription');
            $itemUnit = $this->input->post('itemUnit');
            $itemQty = $this->input->post('itemQty');
            $itemPrice = $this->input->post('itemPrice');
            
            $post = true;

            if($post){
                $dataInsert = array(
                    'PurchaseInvoiceNo'      => $PurchaseInvoiceNo,
                    'Description'=> $itemDescription,
                    'Unit'=> $itemUnit,
                    'Qty'=> $itemQty,
                    'Price'=> $itemPrice,
                    'Amount'=> intval($itemQty)*intval($itemPrice),
                );
                $this->ModelGeneral->InsertData('fin_purchaseinvoice_detail', $dataInsert);
                $this->ModelGeneral->LogActivity('Process Insert New Detail Invoice : '.$PurchaseInvoiceNo);
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
