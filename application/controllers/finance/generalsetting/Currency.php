<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Currency extends CI_Controller
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
        $this->load->model('finance/voucher/ModelPaymentvoucher');
        $this->load->model('finance/generalsetting/ModelCurrency', 'cur');
    }

    var $idMenu = "B1D59EEF-5D00-46AF-B52E-D30B09C54F99";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Currency',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );

        $this->load->view('finance/generalsetting/v_currency', $data);
    }
    public function getCurrency()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->cur->getCurrency("order by id");
        $no = 1;
        foreach ($datas as $d) {
            $kode = '"'.$d['id'].'"';
            $option = "
             <a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(".$kode.")'>+ Edit</a>";
            $data[] = array(
                "no" => $no,
                "code" => $d['id'],
                "valuta" => $d['Valuta'],
                "description" => $d['Desc'],
                "rate" => $d['Rate'],
                "activeperiode" => $d['ActivePeriode'],
                "instansi_id" => $d['nama_instansi'],
                "branch_id" => $d['nama_branch'],
                "option" => $option,

            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    } 

    function getCurrencybyid(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $code = $this->input->post('id');
            $check = $this->cur->getCurrency(" WHERE id = '".$code."' ");
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


    public function saveCurrency(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        $ThnActive   = $this->ModelPaymentvoucher->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        try { 
            
            $datennow = date('Y-m-d H:i:s');
            $code = $this->input->post('code');
            $valuta = $this->input->post('valuta');
            $description = $this->input->post('description');
            $rate = str_replace('.', '', $input->post('rate'));
            $instansi_id = $this->input->post('instansi_id');
            $branch_id = $this->input->post('branch_id');
            $status = $this->input->post('status');

            
            $post = true;

            
            if($post){
                if($status=='tambah'){
                    $check = $this->cur->getCurrency(" where Valuta = '$valuta' and ActivePeriode = '$thn' order by id limit 1 ");
                    if(count($check) > 0){
                        $dataInsert = array(
                            'Desc'      => $description,
                            'Valuta'      => $valuta,
                            'Rate'      => $rate,
                            'ActivePeriode'      => $thn,
                            'instansi_id'      => $instansi_id,
                            'branch_id'      => $branch_id,
                        );
                        $this->ModelGeneral->InsertData('tbl_valuta', $dataInsert);
                        $this->ModelGeneral->LogActivity('Process Insert New Valuta : '.$description);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully added data"; 
                    }else{
                        $response['status_json'] = false;
                        $response['remarks'] = "Kode sudah ada!"; 
                        $this->db->trans_rollback();
                    }
                }else{
                    $check = $this->cur->getCurrency(" where id = '$code' order by id limit 1");
                    if(count($check) > 0){
                        $dataInsert = array(
                            'Desc'      => $description,
                            'Valuta'      => $valuta,
                            'Rate'      => $rate,
                            'ActivePeriode'      => $thn,
                            'instansi_id'      => $instansi_id,
                            'branch_id'      => $branch_id,
                        );
                        $this->ModelGeneral->UpdateData('tbl_valuta', $dataInsert,array('id'=>$code));
                        $this->ModelGeneral->LogActivity('Process Update Valuta : '.$description);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully changed data"; 
                    }else{
                        $response['status_json'] = false;
                        $response['remarks'] = "Kode sudah ada!"; 
                        $this->db->trans_rollback();
                    }
                }
                
                
            }else{
                $response['status_json'] = false;
                $response['remarks'] = "Unable to save new data"; 
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
    
   
    function getInstansi()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $search = $this->input->get('search');
        $orderby = " nama_instansi ASC";
        $where = " WHERE nama_instansi LIKE '%".$search."%' ";
        $data = $this->cur->getInstansiSelect2($where, $orderby); 
        $response['data'] = $data; 
        echo json_encode($response);
    }

    function getBranch()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $search = $this->input->get('search');
        $instansi_id = $this->input->get('instansi_id');
        $orderby = " nama_branch ASC";
        $where = " WHERE nama_branch LIKE '%".$search."%' AND instansi_id = '".$instansi_id."' ";
        $data = $this->cur->getBranchSelect2($where, $orderby); 
        $response['data'] = $data; 
        echo json_encode($response);
    }

}    
  
