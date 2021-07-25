<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/generalsetting/ModelUnit');
        $this->load->model('usermanagement/ModelUsers');
    }

    var $idMenu = "7D616296-96F4-44D6-88E2-B7D280DEC279";

    
    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Unit',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/generalsetting/v_unit', $data);
    }

    public function getUnit()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelUnit->getUnit("order by Unit");
        $no = 1;
        foreach ($datas as $d) {
            $unit = '"'.$d['Unit'].'"';
            $option = "
                <a href='#' class='hapus_record btn btn-danger btn-sm' onclick='return hapus(".$unit.")'>+ Delete</a>";
            $data[] = array(
                "no" => $no,
                "Unit" => $d['Unit'],
                "option" => $option

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

    public function saveUnit()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $unit = $this->input->post('Unit');
            $status = $this->input->post('status');            
            $post = true;

            if($post){
                if($status=='tambah')
                {
                    $check = $this->ModelUnit->getUnit(" where Unit = '$unit' order by Unit limit 1");
                    if(count($check) > 0){
                        $response['status_json'] = false;
                        $response['remarks'] = "Unit sudah ada!"; 
                        $this->db->trans_rollback();
                    }else{
                        $dataInsert = array(
                            'Unit'      => $unit,
                        );
                        $this->ModelGeneral->InsertData('tbl_unit', $dataInsert);
                        $this->ModelGeneral->LogActivity('Process Insert New Unit : '.$unit);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully saved new data"; 
                    }
                }        
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }

    function getUnitbyid(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $unit = $this->input->post('Unit');
            $status = $this->input->post('status');
            $check = $this->ModelUnit->getUnit(" WHERE Unit = '".$unit."' ");
            if($check != null)
            {
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

    public function deleteUnit()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Successfully deleted data"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $unit = $this->input->post('code_hapus');
            
            $post = true;

            if($post)
            {
                
                $this->ModelGeneral->DeleteData('tbl_unit', array('Unit'=>$unit));
                $this->ModelGeneral->LogActivity('Process Delete Unit : '.$unit);
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
  