<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payout extends CI_Controller
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
        $this->load->model('finance/master/ModelDepartement');
        $this->load->model('finance/payout/ModelPayout', 'model');
        $this->load->model('finance/voucher/ModelPaymentvoucher');
    }

    var $idMenu = "B40E5AEF-08A8-4AE0-8285-31A584C81BDF";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Payout',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/payout/v_payout', $data);
    }
 
    public function getPayout()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->model->getPayout("");
        $no = 1;
        foreach ($datas as $d) {
            $payout_id = $d['payout_id'];
            $option = "
             <a href='payout/detail/".$payout_id."'>".$payout_id."</a>
             ";
            $data[] = array(
                "no" => $no,
                "payout_id" => $option,
                "paid_at" => $d['paid_at'],
                "gross_amount" => $d['gross_amount'],
                "net_amount" => $d['net_amount'],
                "jumlahm" => $d['jumlahm'],
                "jumlahs" => $d['jumlahs'],

            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function detail($payout_id)
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Payout Detail',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'payout_id'     => $payout_id,
            'payout'        => $this->model->getPyDetail($payout_id)
           
        );
        $this->load->view('finance/payout/v_payout_detail', $data);
    }

    public function getPayoutdetail($payout_id)
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->model->getPayoutDetail("where payout_detail.payout_id ='$payout_id' order by SettlementTime asc");
        $no = 1;
        $data = [];
        foreach ($datas as $d) {
            $payout_id = $d['payout_id'];
            $option = "
             <a href='payout/".$payout_id."'>".$payout_id."</a>
             ";
            $data[] = array(
                "no" => $no,
                // "payout_id" => $option,
                "PaymentType" => $d['PaymentType'],
                "TransactionTime" => $d['TransactionTime'],
                "SettlementTime" => $d['SettlementTime'],
                "Order" => $d['Order'],
                "CustomerEmail" => $d['CustomerEmail'],
                "Amount" => $d['Amount'],
                "TransactionFee" => $d['TransactionFee'],
                "MerchantHas" => $d['MerchantHas'],
               

            );
            $no++;
        }
        $response['data'] = ($data)? $data : [];
        echo json_encode($response);
    }

        public function addPayout(){
        $ThnActive   = $this->ModelPaymentvoucher->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];

        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Payout baru"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $date = date('Y-m-d');
            $payout_id = $this->input->post('payout_id');
            $paid_at = $this->input->post('paid_at');
            $gross_amount = $this->input->post('gross_amount');
            $mdr = $this->input->post('mdr');
            $net_amount = $this->input->post('net_amount');

            
            
            $post = true;

            
            
            if($post){
                $cek = $this->model->getPayoutById(" where payout_id = '$payout_id' order by payout_id limit 1");
            if(count($cek) > 0){
               $response['status_json'] = false;
                $response['remarks'] = "Payout ID sudah ada!"; 
                $this->db->trans_rollback();
            }else{
                $dataInsert = array(
                    'payout_id'      => $payout_id,
                    'paid_at'=> $paid_at,
                    'gross_amount'=> $gross_amount,
                    'mdr'=> $mdr,
                    'net_amount'=> $net_amount,
                );

                $dataReceipt = array(
                    'VoucherNo'      => $payout_id.'/PAYOUTID/BANK-00001/MID/'.$thn,
                    'BankCode'=> 'BANK-00001',
                    'VoucherType'=> '3',
                    'VoucherDate'=> $date,
                    'Description'=> 'Transfer dari  Midtrans Payout ID '.$payout_id,
                    'Valuta'=> '',
                    'Rate'=> '1',
                    'ChequeNo'=> '-',
                    'Posting'=> '1',
                    'branch_id'=> '0',
                    'instansi_id'=> '0',
                );

                $dataReceiptdetail = array(
                    'VoucherNo'      => $payout_id.'/PAYOUTID/BANK-00001/MID/'.$thn,
                    'Description'      => 'Penerimaan dari  Midtrans Payout ID '.$payout_id,
                    'Debit'      => '',
                    'Credit'      => $net_amount,
                    'No_PP'      => '',
                    'InvoiceNo'      => '',
                    'AccountNo'      => '41003110000000000000001',
                    'PayCode'      => '',
                    'Remarks'      => '',
                    'Valuta'      => '',
                    'Rate'      => '',
                    'DetailNo'      => '',
                    'branch_id'      => '',
                    'instansi_id'      => '',
                );
                $this->ModelGeneral->InsertData('payout', $dataInsert);
                $this->ModelGeneral->InsertData('fin_voucher', $dataReceipt);
                $this->ModelGeneral->InsertData('fin_voucher_detail', $dataReceiptdetail);
                $this->ModelGeneral->LogActivity('Process Insert New Payout : '.$payout_id);
                $this->db->trans_complete();
                $this->db->trans_commit();
            }
                
                
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