<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Designation extends CI_Controller
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
        $this->load->model('hrm/staffmanagement/ModelDesignation', 'dsg');
    }

    var $idMenu = "ced8ed50-449f-441b-9d4d-f4bde36b455e";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Staff Management Designation',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );

        $this->load->view('hrm/staffmanagement/v_designation', $data);
    }
    public function getDesignation()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->dsg->getDesignation("order by id");
        $no = 1;
        foreach ($datas as $d) {
            $kode = '"'.$d['id'].'"';
            $option = "
             <a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(".$kode.")'>+ Edit</a>
             <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(".$kode.")'>+ Delete</a>";
            $data[] = array(
                "no" => $no,
                "code" => $d['id'],
                "description" => $d['designation'],
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

    function getDesignationbyid(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $code = $this->input->post('code');
            $status = $this->input->post('status');
            $check = $this->dsg->getDesignation(" WHERE id = '".$code."' ");
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
    public function saveDesignation(){
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
            $description = $this->input->post('description');
            $status = $this->input->post('status');
            
            $post = true;

            
            if($post){
                if($status=='tambah'){
                    $check = $this->dsg->getDesignation(" where id = '$code' order by id limit 1");
                    if(count($check) > 0){
                        $response['status_json'] = false;
                        $response['remarks'] = "Kode sudah ada!"; 
                        $this->db->trans_rollback();
                    }else{
                        $dataInsert = array(
                            'id'      => $code,
                            'designation'      => $description,
                        );
                        $this->ModelGeneral->InsertData('hrm_managedesignation', $dataInsert);
                        $this->ModelGeneral->LogActivity('Process Insert New Designation : '.$description);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully saved new data"; 
                    }
                }else{
                    $check = $this->dsg->getDesignation(" where id = '$code' order by id limit 1");
                    if(count($check) > 0){
                        $dataInsert = array(
                            'id'      => $code,
                            'designation'      => $description,
                        );
                        $this->ModelGeneral->UpdateData('hrm_managedesignation', $dataInsert,array('id'=>$code));
                        $this->ModelGeneral->LogActivity('Process Update New Designation : '.$description);
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
    
    public function deleteDesignation(){
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
                
                $this->ModelGeneral->DeleteData('hrm_managedesignation', array('id'=>$code));
                $this->ModelGeneral->LogActivity('Process Delete Designation : '.$code);
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
