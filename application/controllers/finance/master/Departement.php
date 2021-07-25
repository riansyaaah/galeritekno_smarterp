<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Departement extends CI_Controller
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
        $this->load->model('finance/master/ModelDepartement', 'dprt');
    }

    var $idMenu = "A9F17E54-B271-4F58-898C-6CB7464FC254";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Master Data Departement',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/master/v_departement', $data);
    }
 
    public function getDepartement()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->dprt->getDepartement("order by Kode_Dep");
        $no = 1;
        foreach ($datas as $d) {
            $kodedep = '"'.$d['Kode_Dep'].'"';
            $option = "
             <a href='#' class='edit_record btn btn-info btn-sm' onclick='return editDepartement(".$kodedep.")'>+ Edit</a>
             <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapusDepartement(".$kodedep.")'>+ Hapus</a>";
            $data[] = array(
                "no" => $no,
                "code" => $d['Kode_Dep'],
                "departement" => $d['Nama_Dep'],
                "option" => $option,

            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
    function getDepartementbyid(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $code = $this->input->post('code');
            $check = $this->dprt->getDepartement(" WHERE Kode_Dep = '".$code."' ");
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
    public function addDepartement(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Departement baru"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $code = $this->input->post('code');
            $description = $this->input->post('description');
            
            $post = true;

            
            
            if($post){
                $cekDep = $this->dprt->getDepartement(" where Kode_Dep = '$code' order by Kode_Dep limit 1");
            if(count($cekDep) > 0){
               $response['status_json'] = false;
                $response['remarks'] = "Kode sudah ada!"; 
                $this->db->trans_rollback();
            }else{
                $dataInsert = array(
                    'Kode_Dep'      => $code,
                    'Nama_Dep'=> $description,
                );
                $this->ModelGeneral->InsertData('tbl_dep', $dataInsert);
                $this->ModelGeneral->LogActivity('Process Insert New Departement : '.$description);
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
    public function editDepartement(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil mengupdate Departement "; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $code = $this->input->post('code');
            $description = $this->input->post('description');
            
            $post = true;

            if($post){
                $dataInsert = array(
                    'Nama_Dep'=> $description,
                );
                $this->ModelGeneral->UpdateData('tbl_dep', $dataInsert,array('Kode_Dep'=>$code));
                $this->ModelGeneral->LogActivity('Process Update Departement : '.$description);
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
    public function hapusDepartement(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menghapus Departement "; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $code = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('tbl_dep', array('Kode_Dep'=>$code));
                $this->ModelGeneral->LogActivity('Process Delete Departement : '.$code);
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