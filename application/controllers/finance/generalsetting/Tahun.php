<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/generalsetting/ModelTahun','thn');
        $this->load->model('usermanagement/ModelUsers');
    }

    var $idMenu = "2321e13d-eccd-4f69-8b19-0412a86826cb";

    
    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Tahun',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/generalsetting/v_tahun', $data);
    }

    public function getTahun()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->thn->getTahun("order by Thn");
        $no = 1;
        foreach ($datas as $d) {
            $tahun = '"'.$d['Thn'].'"';
            $option = "
              <a href='#' class='hapus_record btn btn-danger btn-sm'>+ Delete</i></a>";
            $data[] = array(
                "no" => $no,
                "Thn" => $d['Thn'],
                "option" => $option
            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function saveTahun()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $tahun = $this->input->post('Thn');
            $status = $this->input->post('status');            
            $post = true;

            if($post){
                if($status=='tambah')
                {
                    $check = $this->thn->getTahun(" where Thn = '$tahun' order by Thn limit 1");
                    if(count($check) > 0){
                        $response['status_json'] = false;
                        $response['remarks'] = "Tahun sudah ada!"; 
                        $this->db->trans_rollback();
                    }else{
                        $dataInsert = array(
                            'Thn'      => $tahun,
                        );
                        $this->ModelGeneral->InsertData('tbl_thn', $dataInsert);
                        $this->ModelGeneral->LogActivity('Process Insert New Tahun : '.$tahun);
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
}    
   