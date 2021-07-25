<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemperiksa extends CI_Controller {
    function __Construct()
    {
        parent ::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelMenu');
        $this->load->model('eklinik/paketperiksa/ModelItemperiksa');
        $this->load->model('eklinik/Modelmasterdata');
    }

    var $idMenu = "d900157c-364c-463d-a42f-ac818960fbd5"; //Corporate Setting - Branch

    public function detailtarifpenunjang($id)
    {
    cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

           
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Detail Tarif Penjunjang',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'id'	=> $id,
    );
    $this->load->view('eklinik/paketperiksa/v_detailtarifpenunjang', $data);
  }
    public function getTarifPenunjang($id)
    {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->Modelmasterdata->getTarifPenunjang($id);
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/paketperiksa/itemperiksa/hapusdetailtarifpenunjang/".$d['id']."' class='btn btn-danger' target='_blank'>Hapus</a>
      <a href='".base_url()."eklinik/paketperiksa/itemperiksa/editdetailtarifpenunjang/".$d['id']."' class='btn btn-primary' target='_blank'>Edit</a>";
      $data[] = array(
        "no" => $no,
        "namapenjamin" => $d['namapenjamin'],
        "tarifpelayanan" => $d['tarifpelayanan'],
        "tarifkerjasama" => $d['tarifkerjasama'],
        "jasadokter" => $d['jasadokter'],
        "jasapetugas" => $d['jasapetugas'],
        "option" => $option,
      );
      $no++;
    }
   $response['data'] = (count($datas) > 0)? $data : [];
    echo json_encode($response);
  }
    public function saveDetailtarifPenunjang()
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
            $idpenjamin = $this->input->post('idpenjamin');
            $tarifpelayanan = $this->input->post('tarifpelayanan');
            $tarifkerjasama = $this->input->post('tarifkerjasama');
            $jasadokter = $this->input->post('jasadokter');
            $jasapetugas = $this->input->post('jasapetugas');
            
            $post = true;
            
            if($post){
                    $dataInsert = array(
                        'idpenunjang'      => $id,
                        'idpenjamin'      => $idpenjamin,
                        'tarifpelayanan'  => $tarifpelayanan,
                        'tarifkerjasama'  => $tarifkerjasama,
                        'jasadokter'  => $jasadokter,
                        'jasapetugas'  => $jasapetugas,
                    );
                    $this->ModelGeneral->InsertData('ekl_detailtarifpenunjang', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Tarif');
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully saved new data"; 				
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
    
    public function detailtariflab($id)
    {
    cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

           
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Detail Tarif Item Lab',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'id'	=> $id,
    );
    $this->load->view('eklinik/paketperiksa/v_detailtariflab', $data);
  }
    public function getTarifLab($id)
    {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->Modelmasterdata->getTarifLab($id);
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/paketperiksa/itemperiksa/hapusdetailtariflab/".$d['id']."' class='btn btn-danger' target='_blank'>Hapus</a>
      <a href='".base_url()."eklinik/paketperiksa/itemperiksa/editdetailtariflab/".$d['id']."' class='btn btn-primary' target='_blank'>Edit</a>";
      $data[] = array(
        "no" => $no,
        "namapenjamin" => $d['namapenjamin'],
        "tarifpelayanan" => $d['tarifpelayanan'],
        "tarifkerjasama" => $d['tarifkerjasama'],
        "jasadokter" => $d['jasadokter'],
        "jasapetugas" => $d['jasapetugas'],
        "option" => $option,
      );
      $no++;
    }
   $response['data'] = (count($datas) > 0)? $data : [];
    echo json_encode($response);
  }
    public function saveDetailtarifLab()
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
            $idpenjamin = $this->input->post('idpenjamin');
            $tarifpelayanan = $this->input->post('tarifpelayanan');
            $tarifkerjasama = $this->input->post('tarifkerjasama');
            $jasadokter = $this->input->post('jasadokter');
            $jasapetugas = $this->input->post('jasapetugas');
            
            $post = true;
            
            if($post){
                    $dataInsert = array(
                        'iditemlab'      => $id,
                        'idpenjamin'      => $idpenjamin,
                        'tarifpelayanan'  => $tarifpelayanan,
                        'tarifkerjasama'  => $tarifkerjasama,
                        'jasadokter'  => $jasadokter,
                        'jasapetugas'  => $jasapetugas,
                    );
                    $this->ModelGeneral->InsertData('ekl_detailtariflab', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Tarif');
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully saved new data"; 				
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
            'title'         => 'Data Item Pemeriksaan',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,

            'moduleDetails'   => $moduleDetails,
            'modules'         => $modules,
            'getitem'         => $this->ModelItemperiksa->getItemperiksa(" order by id asc"),
        );
		$this->load->view('eklinik/paketperiksa/v_itemperiksa', $data);
    }

    function getItem(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $id_paren = $this->input->post('id_paren');
            $check = $this->ModelItemperiksa->getItemperiksa(" WHERE id = '".$id_paren."' ");
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
    
    public function addItem(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Item Lab baru"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $id_paren = $this->input->post('id_paren');
            $nama_item = $this->input->post('nama_item');
            $level = $this->input->post('level');
            
            $daripria		= $this->input->post('daripria');
		$sampaipria		= $this->input->post('sampaipria');
        $dariwanita		= $this->input->post('dariwanita');
		$sampaiwanita		= $this->input->post('sampaiwanita');
        $darianak		= $this->input->post('darianak');
		$sampaianak		= $this->input->post('sampaianak');
		$uraian		= $this->input->post('uraian');
		$satuan		= $this->input->post('satuan');
		$harga		= $this->input->post('harga');
		$input		= $this->input->post('input');
            
            $post = true;

            $item = $this->ModelItemperiksa->getItemperiksa(" where id like '$id_paren%' and id_paren = '$id_paren' order by CAST(urut AS UNSIGNED) desc limit 1");
            if(isset($item[0]['urut']) == ''){
                $newid = $id_paren.".".intval(1);
            }else{
                $newid = $id_paren.".".(intval($item[0]['urut']) + 1);
            }
            
            if($post){
                $dataInsert = array(
                    'id'      => $newid,
                    'id_paren'=> $id_paren,
                    'nama_item'       => $nama_item,
                    'level'       => $level,
                    'daripria' => $daripria,
            'sampaipria' => $sampaipria,
           'dariwanita' => $dariwanita,
        'sampaiwanita' => $sampaiwanita,
           'darianak' => $darianak,
        'sampaianak' => $sampaianak,
                    'uraian' => $uraian,
                    'satuan' => $satuan,
                    'harga' => $harga,
                    'input' => $input,
                    'branch_id' => $session['branch_id'],
                    'instansi_id' => $session['instansi_id'],
                );
                $this->ModelGeneral->InsertData('ekl_itemperiksa', $dataInsert);
                $this->ModelGeneral->LogActivity('Process Insert New Item Lab : '.$nama_item);
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
    public function editItem(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil mengedit Item Lab"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $id_item = $this->input->post('id_item');
            $nama_item = $this->input->post('nama_item');
            
            $daripria		= $this->input->post('daripria');
		$sampaipria		= $this->input->post('sampaipria');
        $dariwanita		= $this->input->post('dariwanita');
		$sampaiwanita		= $this->input->post('sampaiwanita');
        $darianak		= $this->input->post('darianak');
		$sampaianak		= $this->input->post('sampaianak');
		$uraian		= $this->input->post('uraian');
		$satuan		= $this->input->post('satuan');
		$harga		= $this->input->post('harga');
		$input		= $this->input->post('input');
            
            $post = true;
            
            if($post){
                $dataInsert = array(
                    'nama_item'       => $nama_item,
                    'daripria' => $daripria,
            'sampaipria' => $sampaipria,
           'dariwanita' => $dariwanita,
        'sampaiwanita' => $sampaiwanita,
           'darianak' => $darianak,
        'sampaianak' => $sampaianak,
                    'uraian' => $uraian,
                    'satuan' => $satuan,
                    'harga' => $harga,
                    'input' => $input,
                    'branch_id' => $session['branch_id'],
                    'instansi_id' => $session['instansi_id'],
                );
                $this->ModelGeneral->UpdateData('ekl_itemperiksa', $dataInsert,array('id' => $id_item));
                $this->ModelGeneral->LogActivity('Process Update Item Lab : '.$nama_item);
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
    public function deleteItem(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menghapus Item Lab "; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $id_item = $this->input->post('id_item');
            
            $post = true;

            $item = $this->ModelItemperiksa->getItemperiksa(" where id like '$id_item%' and id_paren = '$id_item' order by CAST(id AS UNSIGNED) desc limit 1");
            
            
            if($post){
                if(count($item)>0){
                $response['status_json'] = false;
                $response['remarks'] = "Data Gagal di Hapus!"; 
                $this->db->trans_rollback();
                }else{
                $this->ModelGeneral->DeleteData('ekl_itemperiksa', array('id'=>$id_item));
                $this->ModelGeneral->LogActivity('Process Delete New Item Lab : '.$id_item);
                $this->db->trans_complete();
                $this->db->trans_commit();
                }
            }else{
                $response['status_json'] = false;
                $response['remarks'] = "Data Gagal di Hapus!"; 
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
