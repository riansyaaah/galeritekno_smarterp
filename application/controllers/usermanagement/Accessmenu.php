<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accessmenu extends CI_Controller {
    function __Construct()
    {
        parent ::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelMenu');
    }

    var $idMenu = "BDA5507A-FBAC-4F0C-9137-69166BA4CB63";

	public function index()
	{
        cek_session($this->idMenu);

        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $ip = $this->input->ip_address();
        $moduleDetails = $this->ModelMenu->getAllModuleDetail();
        $modules = $this->ModelMenu->getAllModule(" WHERE m.is_active = 1 ");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Access Menu',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,

            'moduleDetails'   => $moduleDetails,
            'modules'         => $modules
        );
		$this->load->view('usermanagement/v_akses_menu', $data);
    }

    function getUsers()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $search = $this->input->get('search');
        $orderby = " ud.nama_lengkap ";
        $where = " WHERE (u.username LIKE '%".$search."%' OR ud.nama_lengkap LIKE '%".$search."%' OR u.email LIKE '%".$search."%') AND u.is_active = 1 ";
        $data = $this->ModelMenu->getAllUsers($where, $orderby);
        $response['data'] = $data; 
        echo json_encode($response);
    }

    function getUserAccess()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $user_id = $this->input->get('user_id');
        $data = $this->ModelMenu->getAllModuleDetailUser($user_id);
        $dataActive = $this->ModelMenu->getAllModuleDetailUserActive($user_id);
        $response['data'] = $data; 
        $response['countActive'] = (int)$dataActive->total; 
        $response['countAll'] = COUNT($data); 
        echo json_encode($response);
    }

    function saveMenu()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Menu"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try { 
            $datenow = date('Y-m-d H:i:s');
            $modul_detail_id = $this->input->post('modul_detail_id');
            $user_id = $this->input->post('user_id');
            $post = true;

            $check = $this->ModelMenu->getSingleRoleMenu(" WHERE modul_detail_id = '".$modul_detail_id."' AND user_id = '".$user_id."' ");
            if($check != null){
                $this->ModelGeneral->LogActivity('Process Delete Access Menu '.$modul_detail_id);
                $dataDelete = array(
                    'user_id' => $user_id,
                    'modul_detail_id' => $modul_detail_id,
                );
                $this->ModelGeneral->DeleteData('role_menu', $dataDelete);
                $response['remarks'] = "Berhasil delete Menu"; 
            }else{
                $this->ModelGeneral->LogActivity('Process Insert Access Menu '.$modul_detail_id);
                $role_menu_id = strtoupper(genUuid());
                $dataInsert = array(
                    'role_menu_id'      => $role_menu_id,
                    'modul_detail_id'   => $modul_detail_id,
                    'user_id'           => $user_id,
                    'created_by'        => $session['user_id']
                );
                $this->ModelGeneral->InsertData('role_menu', $dataInsert);
                $response['remarks'] = "Berhasil simpan Menu"; 
            }
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }

    function saveRead()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Menu"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try { 
            $datenow = date('Y-m-d H:i:s');
            $modul_detail_id = $this->input->post('modul_detail_id');
            $user_id = $this->input->post('user_id');
            $post = true;

            $check = $this->ModelMenu->getSingleRoleMenu(" WHERE modul_detail_id = '".$modul_detail_id."' AND user_id = '".$user_id."' ");
            if($check->r == 0){
                $this->ModelGeneral->LogActivity('Process Grant Acces Read to '.$modul_detail_id);
                $dataUpdate = array(
                    'r' => 1,
                    'update_by' => $session['user_id'],
                    'update_date' => $datenow,
                );
                $whereUpdate = array(
                    'user_id' => $user_id,
                    'modul_detail_id' => $modul_detail_id,
                );
                $this->ModelGeneral->UpdateData('role_menu', $dataUpdate, $whereUpdate);
                $response['remarks'] = "Berhasil Memberikan akses Read"; 
            }else{
                $this->ModelGeneral->LogActivity('Process Delete Acces Read to '.$modul_detail_id);
                $dataUpdate = array(
                    'r' => 0,
                    'update_by' => $session['user_id'],
                    'update_date' => $datenow,
                );
                $whereUpdate = array(
                    'user_id' => $user_id,
                    'modul_detail_id' => $modul_detail_id,
                );
                $this->ModelGeneral->UpdateData('role_menu', $dataUpdate, $whereUpdate);
                $response['remarks'] = "Berhasil menghapus akses Read"; 
            }
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }

    function saveWrite()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Menu"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try { 
            $datenow = date('Y-m-d H:i:s');
            $modul_detail_id = $this->input->post('modul_detail_id');
            $user_id = $this->input->post('user_id');
            $post = true;

            $check = $this->ModelMenu->getSingleRoleMenu(" WHERE modul_detail_id = '".$modul_detail_id."' AND user_id = '".$user_id."' ");
            if($check->w == 0){
                $this->ModelGeneral->LogActivity('Process Grant Acces Write to  '.$modul_detail_id);
                $dataUpdate = array(
                    'w' => 1,
                    'update_by' => $session['user_id'],
                    'update_date' => $datenow,
                );
                $whereUpdate = array(
                    'user_id' => $user_id,
                    'modul_detail_id' => $modul_detail_id,
                );
                $this->ModelGeneral->UpdateData('role_menu', $dataUpdate, $whereUpdate);
                $response['remarks'] = "Berhasil Memberikan akses Write"; 
            }else{
                $this->ModelGeneral->LogActivity('Process Delete Acces Write to '.$modul_detail_id);
                $dataUpdate = array(
                    'w' => 0,
                    'update_by' => $session['user_id'],
                    'update_date' => $datenow,
                );
                $whereUpdate = array(
                    'user_id' => $user_id,
                    'modul_detail_id' => $modul_detail_id,
                );
                $this->ModelGeneral->UpdateData('role_menu', $dataUpdate, $whereUpdate);
                $response['remarks'] = "Berhasil menghapus akses Write"; 
            }
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }

    public function saveDeleteMenu()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Menu"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try { 
            $datenow = date('Y-m-d H:i:s');
            $search = $this->input->post('search');
            $check = $this->input->post('check');
            $user_id = $this->input->post('user_id');
            $post = true;

            $getMenu = $this->ModelMenu->getAllModuleDetailUserSearch($user_id, $search);
            
            foreach($getMenu as $row){
                $modul_detail_id = $row['modul_detail_id'];
                if($check == "true"){
                    $role_menu_id = genUuid();
                    $dataInsert = array(
                        'role_menu_id'      => $role_menu_id,
                        'modul_detail_id'   => $modul_detail_id,
                        'user_id'           => $user_id,
                        'created_by'        => $session['user_id']
                    );
                    $this->ModelGeneral->InsertData('role_menu', $dataInsert);
                }else{
                    $dataDelete = array(
                        'user_id' => $user_id,
                        'modul_detail_id' => $modul_detail_id,
                    );
                    $this->ModelGeneral->DeleteData('role_menu', $dataDelete);
                }   
            }
            if($check == "true"){
                $this->ModelGeneral->LogActivity('Process Insert All Access Menu '.$search);
                $response['remarks'] = "Berhasil simpan Menu" ; 
            }else{
                $this->ModelGeneral->LogActivity('Process Delete All Access Menu '.$search);
                $response['remarks'] = "Berhasil delete Menu"; 
            }
            
            
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }

}