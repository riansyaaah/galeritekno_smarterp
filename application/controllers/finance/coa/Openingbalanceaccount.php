<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Openingbalanceaccount extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
        $this->load->model('finance/coa/ModelOpeningbalanceaccount');
    }
    var $idMenu = "49139c22-1460-43f9-bccf-a3e484026f49";
    public function index()
    {
        $ThnActive   = $this->ModelOpeningbalanceaccount->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date('Y-m-d');
        $sumofdebit = $this->ModelOpeningbalanceaccount->getSumofdebit($thn);
        $sumofkredit = $this->ModelOpeningbalanceaccount->getSumofkredit($thn);
        $data = [
            'datenow'       => date('d-m-Y', strtotime($date)),
            'title'         => 'Opening Balance Account',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'PeriodeActive' => $thn,
            'sumofdebit'    => $sumofdebit[0]['jumlah'],
            'sumofkredit'   => $sumofkredit[0]['jumlah'],
        ];
        $this->load->view('finance/coa/v_openingbalanceaccount', $data);
    }
    public function getOpeningbalanceaccount() {
        $ThnActive   = $this->ModelOpeningbalanceaccount->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelOpeningbalanceaccount->getOpeningbalanceaccount("WHERE ActivePeriode = '$thn' ORDER BY CAST(AccountNo AS UNSIGNED), AccountNo ASC");
        foreach ($datas as $d) {
            $data[] = [
                'AccountNo'     => $d['AccountNo'],
                'AccountName'   => $d['AccountName'],
                'Debit'         => number_format($d['Debit'], 0, ',','.'),
                'Credit'        => number_format($d['Credit'], 0, ',','.'),
                'option'        => '<button class="btn btn-primary btn-sm btn_edit" onclick="return editOpeningbalanceaccount('.$d['id'].')"><i class="fa fa-edit"></i> Edit</button>'
            ];
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    }
    function getOpeningbalanceaccountbyid() {
        $ThnActive   = $this->ModelOpeningbalanceaccount->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data";
        try {
            $AccountNo = $this->input->post('code');
            $check = $this->ModelOpeningbalanceaccount->getOpeningbalanceaccount("WHERE id = '$AccountNo' AND ActivePeriode = '$thn' LIMIT 1");
            if ($check != null) {
                $response['data'] = $check;
            } else {
                $data[] = [
                    'AccountNo'     => '',
                    'AccountName'   => '',
                    'Debit'         => '',
                    'Credit'        => ''
                ];
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

    public function OpeningbalanceaccountEdit()
    {

        $ThnActive   = $this->ModelOpeningbalanceaccount->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil mengupdate Opening Balance Account ";
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
            $AccountNo = $this->input->post('AccountNo');
            $Amount = $this->input->post('Amount');
            $Amount = str_replace('Rp. ', '', $Amount);
            $Amount = str_replace('.', '', $Amount);
            $DebitCredit = $this->input->post('DebitCredit');
            $post = true;
            if($post) {
                $dataInsert = [
                    'Debit'     => ($DebitCredit == 'Credit')? 0 : $Amount,
                    'Credit'    => ($DebitCredit == 'Credit')? $Amount : 0
                ];
                $this->ModelGeneral->UpdateData('fin_accountbalance', $dataInsert, ['AccountNo' => $AccountNo, 'ActivePeriode' => $thn]);
                $this->ModelGeneral->LogActivity('Process Update Opening Balance Account : ' . $AccountNo);
                $this->db->trans_complete();
                $this->db->trans_commit();
            } else {
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
