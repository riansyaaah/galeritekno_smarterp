<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Leave extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('hrm/timesheets/ModelLeave');
        $this->load->model('hrm/staffmanagement/ModelStaffProfile');
        $this->load->model('usermanagement/ModelUsers');
    }

    var $idMenu = "9389e2ab-0ad0-42c7-b27a-4da9e674479c";
    
    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Leave',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('hrm/timesheets/v_leave', $data);
    }

    public function getLeave()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelLeave->getLeave("order by id");
        $no = 1;
        foreach ($datas as $d) {
            $id = '"'.$d['id'].'"';
            $option = "
                <a href='#' class='edit_record btn btn-info btn-sm' onclick='return editLeave(".$id.")'>+ Edit</a>
                <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapus(".$id.")'>+ Delete</a>";
            $data[] = array(
                "no" => $no,
                "FirstName" => $d['FirstName'],
                "LastName" => $d['LastName'],
                "Email" => $d['Email'],
                "Phone" => $d['Phone'],
                "LeaveType" => $d['LeaveType'],
                "StartDate" => $d['StartDate'],
                "EndDate" => $d['EndDate'],
                "Description" => $d['Description'],
                "Remarks" => $d['Remarks'],
                "status" => $d['status'],
                "halfday" => $d['halfday'],
                "option" => $option,

            );
            $no++;
        }
        if (count($datas) > 0) {
            $response['data'] = $data;
        } else {
            $response['data'] = array();
        }
        echo json_encode($response);
    } 

    public function saveLeave()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $id = $this->input->post('id');
            $StaffNo = $this->input->post('StaffNo');
            $LeaveType = $this->input->post('LeaveType');
            $StartDate = $this->input->post('StartDate');
            $EndDate = $this->input->post('EndDate');
            $Description = $this->input->post('Description');
            $Remarks = $this->input->post('Remarks');
            $status = $this->input->post('status');
            $halfday = $this->input->post('halfday');
            $StatusLeave = $this->input->post('StatusLeave');
            $post = true;
            
            if($post)
            {
                if($StatusLeave == 'Tambah')
                {
                    $dataInsert = array(
                        'staff_id'  => $StaffNo,
                        'LeaveType'  => $LeaveType,
                        'StartDate' => $StartDate,
                        'EndDate'  => $EndDate,
                        'Description' => $Description,
                        'Remarks' => $Remarks,
                        'status' => $status,
                        'halfday'    => $halfday,
                    );
                    $this->ModelGeneral->InsertData('hrm_leaves', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Leave ');
                    $response['remarks'] = "Successfully saved new data"; 
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                }    
                if($StatusLeave == 'Edit')
                {
                    $dataInsert = array(
                        'id'  => $id,
                        'LeaveType'  => $LeaveType,
                        'StartDate' => $StartDate,
                        'EndDate'  => $EndDate,
                        'Description' => $Description,
                        'Remarks' => $Remarks,
                        'status' => $status,
                        'halfday'    => $halfday,
                    );
                    $this->ModelGeneral->UpdateData('hrm_leaves', $dataInsert, array('id' => $id));
                    $this->ModelGeneral->LogActivity('Process Update New Leave '); 
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully changed data";
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

    function getLeavebyid()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $check = $this->ModelLeave->getLeave(" WHERE id = '".$id."' ");
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

    public function deleteLeave(){
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
            $id = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('hrm_leaves', array('id'=>$id));
                $this->ModelGeneral->LogActivity('Process Delete Leave : ');
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

    public function getStaffProfile()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelStaffProfile->getStaffProfile('order by StaffNo');
        $no = 1;
        foreach ($datas as $d) {
            // $StaffNo = '"'.$d['StaffNo'].'"';
            $StaffNo = $d['StaffNo'];
            $option = "
             <a href='#' class='edit_record btn btn-info btn-sm'><i class='fa fa-check'></i></a>";
            $data[] = array(
                'StaffNo' => $StaffNo,
                "FirstName" => $d['FirstName'],
                "LastName" => $d['LastName'],
                "Email" => $d['Email'],
                "Phone" => $d['Phone'],
                "Address" => $d['Address'],
                "option" => $option,
            );
            $no++;
        }
        if (count($datas) > 0) {
            $response['data'] = $data;
        } else {
            $response['data'] = array();
        }
        echo json_encode($response);
    }
}    