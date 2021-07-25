<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paketmcu extends CI_Controller
{
  function __Construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');
    $this->load->helper(array('form', 'url'));
    $this->load->model('auth/ModelLogin');
    $this->load->model('ModelGeneral');
    $this->load->model('eklinik/paketperiksa/ModelPaketmcu');
    $this->load->model('eklinik/paketperiksa/ModelItemperiksa');
  }

  var $idMenu = "c3f827f3-3cba-4e2c-a8c6-e391d5f569a2	";

  public function index()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Data Paket MCU',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
    );

    $this->load->view('eklinik/paketperiksa/v_paketmcu', $data);
  }
    public function paketmcu_detail($id)
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
        $datas = $this->ModelPaketmcu->getPaketmcu("where id = '$id'");
        
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Data Detail Paket MCU',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
      'paketmcu_id'   => $datas[0]['id'],
      'namapaket'   => $datas[0]['namapaket'],
      'keterangan'   => $datas[0]['keterangan'],
      'hargaumum'   => $datas[0]['hargaumum'],
      'hargacorporate'   => $datas[0]['hargacorporate'],
        'getitem'         => $this->ModelPaketmcu->getPaketmcudetail($id),
    );

    $this->load->view('eklinik/paketperiksa/v_paketmcu_detail', $data);
  }

  public function getPaketmcu()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelPaketmcu->getPaketmcu("order by id");
        $no = 1;
        
        foreach ($datas as $d) {
            $id = $d['id'];
            $option = "<a href='".base_url()."eklinik/paketperiksa/paketmcu/paketmcu_detail/".$id."'  target='_blank' class='edit_record btn btn-info btn-sm'>Detail</a>";
            $data[] = array(
                "no" => $no,
                "namapaket" => $d['namapaket'],
                "keterangan" => $d['keterangan'],
                "hargaumum" => $d['hargaumum'],
                "hargacorporate" => $d['hargacorporate'],
                "option" => $option,

            );
            $no++;
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    }
    
    public function savePaketmcu(){
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
            $namapaket = $this->input->post('namapaket');
            $keterangan = $this->input->post('keterangan');
            $hargaumum = $this->input->post('hargaumum');
            $hargacorporate = $this->input->post('hargacorporate');
            $status = $this->input->post('status');
            
            $post = true;

            
            if($post){
                if($status=='tambah'){
                        $dataInsert = array(
                            'namapaket'      => $namapaket,
                            'keterangan'      => $keterangan,
                            'hargaumum'      => $hargaumum,
                            'hargacorporate'      => $hargacorporate,
                        );
                        $this->ModelGeneral->InsertData('ekl_paketmcu', $dataInsert);
                        $this->ModelGeneral->LogActivity('Process Insert New Paket : '.$namapaket);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully saved new data"; 
                }else{
                    $check = $this->ModelPaketmcu->getPaketmcu(" where id = '$code' order by id limit 1");
                    if(count($check) > 0){
                        $dataInsert = array(
                           'namapaket'      => $namapaket,
                            'keterangan'      => $keterangan,
                            'hargaumum'      => $hargaumum,
                            'hargacorporate'      => $hargacorporate,
                        );
                        $this->ModelGeneral->UpdateData('ekl_paketmcu', $dataInsert,array('id'=>$code));
                        $this->ModelGeneral->LogActivity('Process Update New Paket : '.$namapaket);
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
    public function savePaketmcudetail(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $paketmcu_id = $this->input->post('paketmcu_id');
            $namapaket = $this->input->post('namapaket');
            $keterangan = $this->input->post('keterangan');
            $hargaumum = $this->input->post('hargaumum');
            $hargacorporate = $this->input->post('hargacorporate');
            $status = $this->input->post('status');
            $dataiddetail = $this->input->post('data');
            
            $post = true;

            
            if($post){
                foreach($dataiddetail as $idlapab){
                    
                    $check = $this->ModelPaketmcu->getdetail("where id = '$idlapab' and paketmcu_id = '$paketmcu_id' limit 1");
                    if(count($check) > 0 ){
                        
                    }else{
                        
                        $dataInsert = array(
                           'paketmcu_id'      => $paketmcu_id,
                           'id'      => $idlapab,
                        );
                        $this->ModelGeneral->InsertData('ekl_paketmcu_detail', $dataInsert);
                        $this->ModelGeneral->LogActivity('Process Update New Paket : '.$namapaket);
                        
                    }
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
}