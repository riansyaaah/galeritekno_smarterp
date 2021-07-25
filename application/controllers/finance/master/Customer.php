<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

    function __Construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
        $this->load->model('finance/master/ModelCustomer', 'cstm');
    }
    var $idMenu = '7AE504F0-0962-4874-87C7-23DB0A955870';
    public function index() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date('Y-m-d');
        $data = array(
            'datenow'       => date('d-m-Y', strtotime($date)),
            'title'         => 'Master Data Customer',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp
        );
        $this->load->view('finance/master/v_customer', $data);
    }
    function getBusinessLine()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $search = $this->input->get('search');
        $orderby = "Nama_Bis";
        $where = " WHERE (Kode_Bis LIKE '%".$search."%' OR Nama_Bis LIKE '%".$search."%') ";
        $data = $this->cstm->getBusinessLineSelect2($where, $orderby);
        $response['data'] = $data; 
        echo json_encode($response);
    }
    public function getCustomer()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [];
        $response['status_json'] = true;
        $datas = $this->cstm->getCustomer('ORDER BY ClientID');
        foreach ($datas as $d) {
            $data[] = [
                'code'          => $d['ClientID'],
                'clientname'    => $d['ClientName'],
                'inisial'       => $d['Inisial'],
                'address'       => $d['Address'],
                'phone'         => $d['Phone'],
                'edit'          => '<button class="edit_record btn btn-info btn-sm" onclick="return edit(\''.$d['ClientID'].'\')">+ Edit</button>',
                'delete'        => '<button class="edit_record btn btn-info btn-sm" onclick="return hapus(\''.$d['ClientID'].'\')">+ Delete</button>'
            ];
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    } 
 
    function getCustomerbyid(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $code = $this->input->post('code');
            $status = $this->input->post('status');
            $check = $this->cstm->getCustomer(" WHERE ClientID = '".$code."' ");
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
    public function saveCustomer(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $code = $this->input->post('code');
            $clientname = $this->input->post('clientname');
            $address = $this->input->post('address');
            $phone = $this->input->post('phone');
            $fax = $this->input->post('fax');
            $EMail = $this->input->post('EMail');
            $cp = $this->input->post('cp');
            $hp = $this->input->post('hp');
            $npwp = $this->input->post('npwp');
            $tgl_npwp = $this->input->post('tgl_npwp');
            $address_npwp = $this->input->post('address_npwp');
            $accountno = $this->input->post('accountno');
            $inisial = $this->input->post('inisial');
            $kode_bis = $this->input->post('kode_bis');
            $status = $this->input->post('status');
            
            $post = true;

             
             
            if($post){
                if($status=='tambah'){
                    $check = $this->cstm->getCustomer(" where ClientID = '$code' order by ClientID limit 1");
                    if(count($check) > 0){
                        $response['status_json'] = false;
                        $response['remarks'] = "Kode sudah ada!"; 
                        $this->db->trans_rollback();
                    }else{
                        $dataInsert = array(
                            'ClientID'      => $code,
                            'ClientName'      => $clientname,
                            'Address'      => $address,
                            'Phone'      => $phone,
                            'Fax'      => $fax,
                            'EMail'      => $EMail,
                            'CP'      => $cp,
                            'HP'      => $hp,
                            'NPWP'      => $npwp,
                            'Tgl_NPWP'      => $tgl_npwp,
                            'Address_NPWP'      => $address_npwp,
                            'AccountNo'      => $accountno,
                            'Inisial'      => $inisial,
                            'Kode_Bis'      => $kode_bis,
                        );
                        $this->ModelGeneral->InsertData('tbl_client', $dataInsert);
                        $this->ModelGeneral->LogActivity('Process Insert New Customer : '.$description);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully saved new data"; 
                    }
                }else{
                    $check = $this->cstm->getCustomer(" where ClientID = '$code' order by ClientID limit 1");
                    if(count($check) > 0){
                        $dataInsert = array(
                            'ClientID'      => $code,
                            'ClientName'      => $clientname,
                            'Address'      => $address,
                            'Phone'      => $phone,
                            'Fax'      => $fax,
                            'EMail'      => $email,
                            'CP'      => $cp,
                            'HP'      => $hp,
                            'NPWP'      => $npwp,
                            'Tgl_NPWP'      => $tgl_npwp,
                            'Address_NPWP'      => $address_npwp,
                            'AccountNo'      => $accountno,
                            'Inisial'      => $inisial,
                            'Kode_Bis'      => $kode_bis,
                        );
                        $this->ModelGeneral->UpdateData('tbl_client', $dataInsert,array('ClientID'=>$code));
                        $this->ModelGeneral->LogActivity('Process Update Customer : '.$description);
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
    
    public function deleteCustomer(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Successfully deleted data"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $code = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('tbl_client', array('ClientID'=>$code));
                $this->ModelGeneral->LogActivity('Process Delete Customer : '.$code);
                $this->db->trans_complete();
                $this->db->trans_commit();  
            }else{
                $response['status_json'] = false;
                $response['remarks'] = "number or name is already exists"; 
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