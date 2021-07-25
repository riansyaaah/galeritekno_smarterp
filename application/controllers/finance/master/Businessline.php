<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Businessline extends CI_Controller
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
        $this->load->model('finance/master/ModelBusinessLine', 'mbl');
    }

    var $idMenu = "7AE504F0-0962-4874-87C7-23DB0A955870";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date('Y-m-d');
        $data = [
            'datenow'       => date('d-m-Y', strtotime($date)),
            'title'         => 'Master Data Business Line',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        ];
        $this->load->view('finance/master/v_businessLine', $data);
    }
    public function getBusinessLine()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->mbl->getBusinessLine("order by Kode_Bis");
        $no = 1;
        foreach ($datas as $d) {
            $data[] = [
                'no'            => $no++,
                'code'          => $d['Kode_Bis'],
                'description'   => $d['Nama_Bis'],
                'edit'          => '<button type="button" class="edit_record btn btn-info btn-sm" onclick="return edit(\''.$d['Kode_Bis'].'\')">+ Edit</button',
                'delete'        => '<button type="button" class="edit_record btn btn-info btn-sm" onclick="return hapus(\''.$d['Kode_Bis'].'\')">+ Delete</button'
            ];
        }
        $response['data'] = (count($datas)>0)? $data : [];
        echo json_encode($response);
    } 

    function getBusinessLinebyid(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $code = $this->input->post('code');
            $status = $this->input->post('status');
            $check = $this->mbl->getBusinessLine(" WHERE Kode_Bis = '".$code."' ");
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
    public function saveBusinessLine(){
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
                    $check = $this->mbl->getBusinessLine(" where Kode_Bis = '$code' order by Kode_Bis limit 1");
                    if(count($check) > 0)
                    {
                        $response['status_json'] = false;
                        $response['remarks'] = "Kode sudah ada!"; 
                        $this->db->trans_rollback();
                    }else{
                        $dataInsert = array(
                            'Kode_Bis'      => $code,
                            'Nama_Bis'      => $description,
                        );
                        $this->ModelGeneral->InsertData('tbl_bis', $dataInsert);
                        $this->ModelGeneral->LogActivity('Process Insert New Businessline : '.$description);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully saved new data"; 
                    }
                }else{
                    $check = $this->mbl->getBusinessLine(" where Kode_Bis = '$code' order by Kode_Bis limit 1");
                    if(count($check) > 0){
                        $dataInsert = array(
                            'Kode_Bis'      => $code,
                            'Nama_Bis'      => $description,
                        );
                        $this->ModelGeneral->UpdateData('tbl_bis', $dataInsert,array('Kode_Bis'=>$code));
                        $this->ModelGeneral->LogActivity('Process Update New Businessline : '.$description);
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
    
    public function deleteBusinessLine(){
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
                
                $this->ModelGeneral->DeleteData('tbl_bis', array('Kode_Bis'=>$code));
                $this->ModelGeneral->LogActivity('Process Delete Businessline : '.$code);
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
