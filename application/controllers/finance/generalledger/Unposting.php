<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unposting extends CI_Controller
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
        $this->load->model('finance/generalledger/ModelUnposting');
    }

    var $idMenu = "558f8570-b290-469a-97a9-a5224d1c9ab3";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $ThnActive   = $this->ModelUnposting->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Unposting',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'tahunaktif' =>  $thn,
        );
        $this->load->view('finance/generalledger/v_unposting', $data);
    }
    public function getDataUnposting()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $mulai_tanggal  = $this->input->post('mulai_tanggal');
        $sampai_tanggal  = $this->input->post('sampai_tanggal');
        
        $datas = $this->ModelUnposting->getDataUnposting(" where Posting = '1' and fin_voucher.VoucherDate between '$mulai_tanggal' and '$sampai_tanggal' order by VoucherDate desc");
        $no = 1;
        foreach ($datas as $d) {
            $VoucherNo = '"'.$d['VoucherNo'].'"';
            $VoucherType = $d['VoucherType'];
            $option = "<a href='#' class='edit_record btn btn-info btn-sm' onclick='return UnpostingItem(".$VoucherNo.")'>Unposting</a>
             <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return HapusItem(".$VoucherNo.")'>Hapus</a>";
            if($VoucherType == '1'){
                $transactype = 'Payment';
            }else{
                $transactype = 'Receipt';
            }
            $data[] = array(
                "no" => $no,
                "VoucherNo" => $d['VoucherNo'],
                "VoucherDate" => $d['VoucherDate'],
                "transactype" => $transactype,
                "BankCode" => $d['BankCode'],
                "BankName" => $d['BankName'],
                "Description" => $d['Description'],
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
    function getDatavoucher(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
        $VoucherNo  = $this->input->post('VoucherNo');
        
            $check = $this->ModelUnposting->getDataUnposting(" WHERE fin_voucher.VoucherNo = '$VoucherNo' ");
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
    public function proses(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil Melakukan Unposting "; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        $ThnActive   = $this->ModelUnposting->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        try { 
            $datennow = date('Y-m-d H:i:s');
            $mulai_tanggal= $this->input->post('mulai_tanggal');
            $sampai_tanggal = $this->input->post('sampai_tanggal');
            $idtable = $this->input->post('idtable');
            
            if($idtable == '1'){
                $tabel = 'fin_cashbank_saldo';
                $where = "where ActivePeriode ='$thn'" ;
            }
            if($idtable == '2'){
                $tabel = 'fin_purchaseinvoice';
                $where = "where PurchaseInvoiceDate between $mulai_tanggal and $sampai_tanggal" ;
            }
            if($idtable == '3'){
                $tabel = 'fin_salesinvoice';
                $where = "where SalesInvoiceDate between $mulai_tanggal and $sampai_tanggal" ;
            }
            if($idtable == '4'){
                $tabel = 'fin_vouchermemo';
                $where = "where VoucherMemoDate between $mulai_tanggal and $sampai_tanggal" ;
            }
            $post = true;
            
            if($post){
                $this->db->query("update $tabel set Unposting = '1'");
                
                $this->ModelGeneral->LogActivity('Process Unposting ');
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
    
    public function UnpostingVoucher(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil Unposting Voucher "; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $VoucherNo = $this->input->post('VoucherNo');
            
            $post = true;
            if($post){
                $dataInsert = array(
                    'Posting'      => "0",
                );
                $this->ModelGeneral->UpdateData('fin_voucher', $dataInsert, array('VoucherNo'=>$VoucherNo));
                $this->ModelGeneral->LogActivity('Process Unposting Voucher : '.$VoucherNo);
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
