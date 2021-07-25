<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterdata extends CI_Controller 
{
    function __Construct()
    {
        parent ::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelMenu');
        $this->load->model('eklinik/Modelmasterdata');
    }

	var $idMenu = "B3F3E011-992B-4D41-B658-ABE0A655C4EE";
    // var $idMenu = "73B6C810-5CAE-4ED2-83AD-4A93F54E6E9C"; //Corporate Setting - Branch

    function getSelectPenjamin()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->db->query("select * from ekl_masterpenjamin")->result_array(); 
        $response['data'] = $data; 
        echo json_encode($response);
    }
    
    
    
	public function itemlab()
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
            'title'         => 'Data Item Laboratorium',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,

            'moduleDetails'   => $moduleDetails,
            'modules'         => $modules,
            'getitem'         => $this->Modelmasterdata->getItemlab(" order by id asc"),
        );
		$this->load->view('eklinik/v_itemlab', $data);
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
            $check = $this->Modelmasterdata->getItemlab(" WHERE id = '".$id_paren."' ");
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

            $item = $this->Modelmasterdata->getItemlab(" where id like '$id_paren%' and id_paren = '$id_paren' order by CAST(id AS UNSIGNED) desc limit 1");
            if(isset($item[0]['id']) == ''){
                $newid = $id_paren.intval(1);
            }else{
                $newid = $id_paren.(intval(substr($item[0]['id'],-1)) + 1);
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
                $this->ModelGeneral->InsertData('ekl_itemlab', $dataInsert);
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
                $this->ModelGeneral->UpdateData('ekl_itemlab', $dataInsert,array('id' => $id_item));
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

            $item = $this->Modelmasterdata->getItemlab(" where id like '$id_item%' and id_paren = '$id_item' order by CAST(id AS UNSIGNED) desc limit 1");
            
            
            if($post){
                if(count($item)>0){
                $response['status_json'] = false;
                $response['remarks'] = "Data Gagal di Hapus!"; 
                $this->db->trans_rollback();
                }else{
                $this->ModelGeneral->DeleteData('ekl_itemlab', array('id'=>$id_item));
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
    
    public function bhp()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Master BHP',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/masterdata/v_bhp', $data);
    }

    public function getBhp(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getBhp();
        $no = 1;
        foreach($datas as $d){
            $Id = '"'.$d['id'].'"';
          	$option = "
			  <a href='#' class='btn-sm btn-primary' onclick='return edit(".$Id.")'>+ Edit</a>
			  <a href='#' class='btn-sm btn-danger' onclick='return hapus(".$Id.")'>+ Delete</a>
			  <a href='".base_url()."eklinik/masterdata/detailtarifbhp/".$d['id']."' class='btn-sm btn-primary' target='_blank'>Detail Tarif</a>
			";
            $data[] = array(
                "no" => $no,
                "kode" => $d['kode'],
				"nama" => $d['nama'],
                "satuan" => $d['satuan'],
                "option" => $option,
            );
            $no ++;
        }
        if (count($datas) > 0) {
            $response['data'] = $data;
        } else {
            $response['data'] = array();
        }
        echo json_encode($response);
    }

	public function saveBhp()
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
            $kode = $this->input->post('kode');
            $nama = $this->input->post('nama');
            $satuan = $this->input->post('satuan');
            $status = $this->input->post('status');
            
            $post = true;
            
            if($post){
                if($status=='tambah')
                {
                    $dataInsert = array(
                        'kode'      => $kode,
                        'nama'      => $nama,
                        'satuan'  => $satuan,
                    );
                    $this->ModelGeneral->InsertData('ekl_masterbhp', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Bhp ');
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully saved new data"; 
                }
				if($status=='edit')
                {
                    $dataInsert = array(
                        'kode'      => $kode,
                        'nama'      => $nama,
                        'satuan'  => $satuan,
                    );
                    $this->ModelGeneral->UpdateData('ekl_masterbhp', $dataInsert, array('id' => $id));
                    $this->ModelGeneral->LogActivity('Process Update New Bhp ');
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

	function getBhpbyid()
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
            $check = $this->Modelmasterdata->getBhp(" WHERE id = '".$id."' ");
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

	public function deleteBhp()
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
            $datennow = date('Y-m-d H:i:s');
            $id = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('ekl_masterbhp', array('id'=>$id));
                $this->ModelGeneral->LogActivity('Process Delete Bhp : ');
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

    public function detailtarifbhp($id)
    {
    cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

           
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Detail Tarif BHP',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'id'	=> $id,
    );
    $this->load->view('eklinik/masterdata/v_detailtarifbhp', $data);
  }
    
    public function getTarifBHP($id)
    {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->Modelmasterdata->getTarifBHP($id);
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/masterdata/hapusdetailtarifbhp/".$d['id']."' class='btn btn-danger' target='_blank'>Hapus</a>
      <a href='".base_url()."eklinik/masterdata/editdetailtarifbhp/".$d['id']."' class='btn btn-primary' target='_blank'>Edit</a>";
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
    public function saveDetailtarifBHP()
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
                        'idbhp'      => $id,
                        'idpenjamin'      => $idpenjamin,
                        'tarifpelayanan'  => $tarifpelayanan,
                        'tarifkerjasama'  => $tarifkerjasama,
                        'jasadokter'  => $jasadokter,
                        'jasapetugas'  => $jasapetugas,
                    );
                    $this->ModelGeneral->InsertData('ekl_detailtarifbhp', $dataInsert);
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
    
    public function obat()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Master Obat',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/masterdata/v_obat', $data);
    }

    public function getObat()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getObat();
        $no = 1;
        foreach($datas as $d){
            $Id = '"'.$d['id'].'"';
            $option = "<a href='#' class='btn-sm btn-primary' onclick='return edit(".$Id.")'>Edit</a>
                       <a href='#' class='btn-sm btn-danger' onclick='return hapus(".$Id.")'>Hapus</a>
                       <a href='".base_url()."eklinik/masterdata/detailtarifobat/".$d['id']."' class='btn-sm btn-primary' target='_blank'>Detail Tarif</a>
            ";
            $data[] = array(
                "no" => $no,
                "nama" => $d['nama'],
                "kode" => $d['kode'],
                "satuan" => $d['satuan'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function saveObat()
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
            $kode = $this->input->post('kode');
            $nama = $this->input->post('nama');
            $satuan = $this->input->post('satuan');
            $status = $this->input->post('status');
            
            $post = true;
            
            if($post){
                if($status=='tambah')
                {
                    $dataInsert = array(
                        'kode'  => $kode,
                        'nama' => $nama,
                        'satuan' => $satuan,
                    );
                    $this->ModelGeneral->InsertData('ekl_masterobat', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Obat ');
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully saved new data"; 
                }
				if($status=='edit')
                {
                    $dataUpdate = array(
                        'kode'  => $kode,
                        'nama' => $nama,
                        'satuan' => $satuan,
                    );
                    $this->ModelGeneral->UpdateData('ekl_masterobat', $dataUpdate, array('id' => $id));
                    $this->ModelGeneral->LogActivity('Process Update New Penjamin ');
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

    function getObatbyid()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $id = $this->input->post('id');
            $check = $this->Modelmasterdata->getObat(" WHERE id = '".$id."' ");
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

    public function deleteObat()
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
            $datennow = date('Y-m-d H:i:s');
            $id = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('ekl_masterobat', array('id'=>$id));
                $this->ModelGeneral->LogActivity('Process Delete Obat: ');
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
    public function detailtarifobat($id)
    {
    cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

           
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Detail Tarif Obat',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'id'	=> $id,
    );
    $this->load->view('eklinik/masterdata/v_detailtarifobat', $data);
  }
    public function getTarifObat($id)
    {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->Modelmasterdata->getTarifObat($id);
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/masterdata/hapusdetailtarifobat/".$d['id']."' class='btn btn-danger' target='_blank'>Hapus</a>
      <a href='".base_url()."eklinik/masterdata/editdetailtarifobat/".$d['id']."' class='btn btn-primary' target='_blank'>Edit</a>";
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
    public function saveDetailtarifObat()
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
                        'idobat'      => $id,
                        'idpenjamin'      => $idpenjamin,
                        'tarifpelayanan'  => $tarifpelayanan,
                        'tarifkerjasama'  => $tarifkerjasama,
                        'jasadokter'  => $jasadokter,
                        'jasapetugas'  => $jasapetugas,
                    );
                    $this->ModelGeneral->InsertData('ekl_detailtarifobat', $dataInsert);
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
    
    public function tindakan()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Master Tindakan',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/masterdata/v_tindakan', $data);
    }
    
    public function getTindakan()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getTindakan();
        $no = 1;
        foreach($datas as $d){
            $Id = '"'.$d['id'].'"';
            $option = "<a href='#' class='btn-sm btn-primary' onclick='return edit(".$Id.")'>Edit</a>
                       <a href='#' class='btn-sm btn-danger' onclick='return hapus(".$Id.")'>Hapus</a>
                       <a href='".base_url()."eklinik/masterdata/detailtariftindakan/".$d['id']."' class='btn-sm btn-primary' target='_blank'>Detail Tarif</a>
            ";
            $data[] = array(
                "no" => $no,
                "nama" => $d['nama'],
                "kode" => $d['kode'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function saveTindakan()
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
            $kode = $this->input->post('kode');
            $nama = $this->input->post('nama');
            $status = $this->input->post('status');
            
            $post = true;
            
            if($post){
                if($status=='tambah')
                {
                    $dataInsert = array(
                        'kode'  => $kode,
                        'nama' => $nama,
                    );
                    $this->ModelGeneral->InsertData('ekl_mastertindakan', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Tindakan ');
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully saved new data"; 
                }
				if($status=='edit')
                {
                    $dataUpdate = array(
                        'kode'  => $kode,
                        'nama' => $nama,
                    );
                    $this->ModelGeneral->UpdateData('ekl_mastertindakan', $dataUpdate, array('id' => $id));
                    $this->ModelGeneral->LogActivity('Process Update New TIndakan ');
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

    function getTindakanbyid()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $id = $this->input->post('id');
            $check = $this->Modelmasterdata->getTindakan(" WHERE id = '".$id."' ");
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

    public function deleteTindakan()
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
            $datennow = date('Y-m-d H:i:s');
            $id = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('ekl_mastertindakan', array('id'=>$id));
                $this->ModelGeneral->LogActivity('Process Delete Tindakan: ');
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
    public function detailtariftindakan($id)
    {
    cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

           
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Detail Tarif Tindakan',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'id'	=> $id,
    );
    $this->load->view('eklinik/masterdata/v_detailtariftindakan', $data);
  }
    public function getTarifTindakan($id)
    {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->Modelmasterdata->getTarifTindakan($id);
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/masterdata/hapusdetailtariftindakan/".$d['id']."' class='btn btn-danger' target='_blank'>Hapus</a>
      <a href='".base_url()."eklinik/masterdata/editdetailtariftindakan/".$d['id']."' class='btn btn-primary' target='_blank'>Edit</a>";
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
    public function saveDetailtarifTindakan()
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
                        'idtindakan'      => $id,
                        'idpenjamin'      => $idpenjamin,
                        'tarifpelayanan'  => $tarifpelayanan,
                        'tarifkerjasama'  => $tarifkerjasama,
                        'jasadokter'  => $jasadokter,
                        'jasapetugas'  => $jasapetugas,
                    );
                    $this->ModelGeneral->InsertData('ekl_detailtariftindakan', $dataInsert);
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
    public function perawat()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Master Perawat',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/masterdata/v_perawat', $data);
    }

    public function getPerawat()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getPerawat();
        $no = 1;
        foreach($datas as $d){
            $Id = '"'.$d['id'].'"';
            $option = "<a href='#' class='btn btn-primary' onclick='return edit(".$Id.")'>Edit</a>
                       <a href='#' class='btn btn-danger' onclick='return hapus(".$Id.")'>Hapus</a>
            ";
            $data[] = array(
                "no" => $no,
                "nama" => $d['nama'],
                "email" => $d['email'],
                "nohp" => $d['nohp'],
                "alamat" => $d['alamat'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function savePerawat()
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
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $nohp = $this->input->post('nohp');
            $alamat = $this->input->post('alamat');
            $status = $this->input->post('status');
            
            $post = true;
            
            if($post){
                if($status=='tambah')
                {
                    $dataInsert = array(
                        'nama'  => $nama,
                        'email' => $email,
                        'nohp'  => $nohp,
                        'alamat'  => $alamat,
                    );
                    $this->ModelGeneral->InsertData('ekl_perawat', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Perawat ');
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully saved new data"; 
                }
				if($status=='edit')
                {
                    $dataUpdate = array(
                        'nama'  => $nama,
                        'email' => $email,
                        'nohp'  => $nohp,
                        'alamat'  => $alamat,
                    );
                    $this->ModelGeneral->UpdateData('ekl_perawat', $dataUpdate, array('id' => $id));
                    $this->ModelGeneral->LogActivity('Process Update New Perawat ');
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

    function getPerawatbyid()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $id = $this->input->post('id');
            $check = $this->Modelmasterdata->getPerawat(" WHERE id = '".$id."' ");
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

    public function deletePerawat()
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
            $datennow = date('Y-m-d H:i:s');
            $id = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('ekl_perawat', array('id'=>$id));
                $this->ModelGeneral->LogActivity('Process Delete Perawat : ');
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

    public function poliklinik()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $dokter = $this->Modelmasterdata->getDokter();

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Master Poliklinik',
            'count_ms'      => 99,
            'sess'          => $session,
            'list_dokter'   => $dokter,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/masterdata/v_poliklinik', $data);
    }

    public function getPoliklinik()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getPoliklinik();
        $no = 1;
        foreach($datas as $d){
            $Id = '"'.$d['id'].'"';
            $option = "<a href='#' class='btn btn-primary' onclick='return edit(".$Id.")'>Edit</a>
                       <a href='#' class='btn btn-danger' onclick='return hapus(".$Id.")'>Hapus</a>  
            ";
            $data[] = array(
                "no" => $no,
                "nama" => $d['nama'],
                "dokter_id" => $d['namadokter'],
                "keterangan" => $d['keterangan'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function savePoliklinik()
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
            $nama = $this->input->post('nama');
            $dokter_id = $this->input->post('dokter_id');
            $keterangan = $this->input->post('keterangan');
            $status = $this->input->post('status');
            
            $post = true;
            
            if($post){
                if($status=='tambah')
                {
                    $dataInsert = array(
                        'nama'  => $nama,
                        'dokter_id' => $dokter_id,
                        'keterangan'  => $keterangan,
                    );
                    $this->ModelGeneral->InsertData('ekl_poliklinik', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Poliklinik ');
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully saved new data"; 
                }
				if($status=='edit')
                {
                    $dataUpdate = array(
                        'nama'  => $nama,
                        'dokter_id' => $dokter_id,
                        'keterangan'  => $keterangan,
                    );
                    $this->ModelGeneral->UpdateData('ekl_poliklinik', $dataUpdate, array('id' => $id));
                    $this->ModelGeneral->LogActivity('Process Update New Poliklinik ');
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

    function getPoliklinikbyid()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $id = $this->input->post('id');
            $check = $this->Modelmasterdata->getPoliklinik(" WHERE ekl_poliklinik.id = '".$id."' ");
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

    public function deletePoliklinik()
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
            $datennow = date('Y-m-d H:i:s');
            $id = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('ekl_poliklinik', array('id'=>$id));
                $this->ModelGeneral->LogActivity('Process Delete Poliklinik : ');
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
    
    public function dokter()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Master Dokter',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/masterdata/v_dokter', $data);
    }

    public function getDokter()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getDokter();
        $no = 1;
        foreach($datas as $d){
            $Id = '"'.$d['id'].'"';
            $option = "<a href='#' class='btn btn-primary' onclick='return edit(".$Id.")'>Edit</a>
                       <a href='#' class='btn btn-danger' onclick='return hapus(".$Id.")'>Hapus </a>
            ";
            $data[] = array(
                "no" => $no,
                "nama" => $d['nama'],
                "email" => $d['email'],
                "nohp" => $d['nohp'],
                "alamat" => $d['alamat'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function saveDokter()
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
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $nohp = $this->input->post('nohp');
            $alamat = $this->input->post('alamat');
            $status = $this->input->post('status');
            
            $post = true;
            
            if($post){
                if($status=='tambah')
                {
                    $dataInsert = array(
                        'nama'  => $nama,
                        'email' => $email,
                        'nohp'  => $nohp,
                        'alamat'  => $alamat,
                    );
                    $this->ModelGeneral->InsertData('ekl_dokter', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Dokter ');
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully saved new data"; 
                }
				if($status=='edit')
                {
                    $dataUpdate = array(
                        'nama'  => $nama,
                        'email' => $email,
                        'nohp'  => $nohp,
                        'alamat'  => $alamat,
                    );
                    $this->ModelGeneral->UpdateData('ekl_dokter', $dataUpdate, array('id' => $id));
                    $this->ModelGeneral->LogActivity('Process Update New Dokter ');
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

    function getDokterbyid()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $id = $this->input->post('id');
            $check = $this->Modelmasterdata->getDokter(" WHERE id = '".$id."' ");
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

    public function deleteDokter()
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
            $datennow = date('Y-m-d H:i:s');
            $id = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('ekl_dokter', array('id'=>$id));
                $this->ModelGeneral->LogActivity('Process Delete Dokter : ');
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
    
    public function diagnosaicdx()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Master Diagnosa ICDX',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/masterdata/v_diagnosaicdx', $data);
    }

    public function getDiagnosaicdx()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getDiagnosaicdx();
        $no = 1;
        foreach($datas as $d){
            $Id = '"'.$d['id'].'"';
            $option = "<a href='#' class='btn btn-primary mb-1' onclick='return edit(".$Id.")'>Edit</a>
                       <a href='#' class='btn btn-danger mb-1' onclick='return hapus(".$Id.")'>Hapus</a>
            ";
            $data[] = array(
                "no" => $no,
                "kodeicd" => $d['kodeicd'],
                "namaindonesia" => $d['namaindonesia'],
                "namainggris" => $d['namainggris'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function saveDiagnosaicdx()
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
            $kodeicd = $this->input->post('kodeicd');
            $namainggris = $this->input->post('namainggris');
            $namaindonesia = $this->input->post('namaindonesia');
            $status = $this->input->post('status');
            
            $post = true;
            
            if($post){
                if($status=='tambah')
                {
                    $dataInsert = array(
                        'kodeicd'  => $kodeicd,
                        'namainggris' => $namainggris,
                        'namaindonesia'  => $namaindonesia,
                    );
                    $this->ModelGeneral->InsertData('ekl_masterdiagnosaicdx', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Diagnosa ICDX ');
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully saved new data"; 
                }
				if($status=='edit')
                {
                    $dataUpdate = array(
                        'kodeicd'  => $kodeicd,
                        'namainggris' => $namainggris,
                        'namaindonesia'  => $namaindonesia,
                    );
                    $this->ModelGeneral->UpdateData('ekl_masterdiagnosaicdx', $dataUpdate, array('id' => $id));
                    $this->ModelGeneral->LogActivity('Process Update New Diagnosa ICDX ');
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

    function getDiagnosaicdxbyid()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $id = $this->input->post('id');
            $check = $this->Modelmasterdata->getDiagnosaicdx(" WHERE id = '".$id."' ");
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

    public function deleteDiagnosaicdx()
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
            $datennow = date('Y-m-d H:i:s');
            $id = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('ekl_masterdiagnosaicdx', array('id'=>$id));
                $this->ModelGeneral->LogActivity('Process Delete Diagnosa ICDX : ');
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
    
    public function penjamin()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Master Penjamin',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/masterdata/v_penjamin', $data);
    }

    public function getPenjamin()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getPenjamin();
        $no = 1;
        foreach($datas as $d){
            $Id = '"'.$d['id'].'"';
            $option = "<a href='#' class='btn btn-primary' onclick='return edit(".$Id.")'>Edit</a>
                       <a href='#' class='btn btn-danger' onclick='return hapus(".$Id.")'>Hapus</a>
            ";
            $data[] = array(
                "no" => $no,
                "nama" => $d['namapenjamin'],
                "keterangan" => $d['keterangan'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function savePenjamin()
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
            $namapenjamin = $this->input->post('namapenjamin');
            $keterangan = $this->input->post('keterangan');
            $status = $this->input->post('status');
            
            $post = true;
            
            if($post){
                if($status=='tambah')
                {
                    $dataInsert = array(
                        'namapenjamin'  => $namapenjamin,
                        'keterangan' => $keterangan,
                    );
                    $this->ModelGeneral->InsertData('ekl_masterpenjamin', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Penjamin ');
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully saved new data"; 
                }
				if($status=='edit')
                {
                    $dataUpdate = array(
                        'namapenjamin'  => $namapenjamin,   
                        'keterangan' => $keterangan,
                    );
                    $this->ModelGeneral->UpdateData('ekl_masterpenjamin', $dataUpdate, array('id' => $id));
                    $this->ModelGeneral->LogActivity('Process Update New Penjamin ');
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

    function getPenjaminbyid()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $id = $this->input->post('id');
            $check = $this->Modelmasterdata->getPenjamin(" WHERE id = '".$id."' ");
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

    public function deletePenjamin()
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
            $datennow = date('Y-m-d H:i:s');
            $id = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('ekl_masterpenjamin', array('id'=>$id));
                $this->ModelGeneral->LogActivity('Process Delete Penjamin: ');
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

    public function rekammedik()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $gender = $this->Modelmasterdata->getJeniskelamin();
        $province = $this->Modelmasterdata->getProvince();
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Rekam Medik',
            'count_ms'      => 99,
            'sess'          => $session,
            'list_gender'   => $gender,
            'list_province' => $province,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/masterdata/v_rekammedik', $data);
    }

    public function getRekamMedis()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getRekammedis();
        $no = 1;
        foreach($datas as $d){
            $Id = '"'.$d['id'].'"';
            $option = "<a href='#' class='btn btn-primary mb-2' onclick='return edit(".$Id.")'>Edit</a>
                       <a href='#' class='btn btn-danger mb-2' onclick='return hapus(".$Id.")'>Hapus</a>
            ";
            $data[] = array(
                "no" => $no,
                "norm" => $d['norm'],
                "tanggal_rm" => $d['tanggal_rm'],
                "nik" => $d['nik'],
                "nama_sebutan" => $d['nama_sebutan'],
                "nama" => $d['nama'],
                "jeniskelamin" => $d['jeniskelamin'],
                "tanggallahir" => $d['tanggallahir'],
                "tempatlahir" => $d['tempatlahir'],
                "nomorhp" => $d['nomorhp'],
                "email" => $d['email'],
                "umur" => $d['umur'],
                "provinsi_id" => $d['provinsi_id'],
                "kabupaten_id" => $d['kabupaten_id'],
                "kecamatan_id" => $d['kecamatan_id'],
                "desa_id" => $d['desa_id'],
                "golongan_darah" => $d['golongan_darah'],
                "alamat" => $d['alamat'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function saveRekamMedis()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $date = date("Y-m-d H:i:s");
            $id = $this->input->post('id');
            $norm = $this->input->post('norm');
            $tanggalrm = $this->input->post('tanggalrm');
            $nik = $this->input->post('nik');
            $nama_sebutan = $this->input->post('nama_sebutan');
            $nama = $this->input->post('nama');
            $jeniskelamin = $this->input->post('jeniskelamin');
            $tanggallahir = $this->input->post('tanggallahir');
            $tempatlahir = $this->input->post('tempatlahir');
            $nomorhp = $this->input->post('nomorhp');
            $email = $this->input->post('email');
            $umur = $this->input->post('umur');
            $provinsi_id = $this->input->post('provinsi_id');
            $kabupaten_id = $this->input->post('kabupaten_id');
            $kecamatan_id = $this->input->post('kecamatan_id');
            $desa_id = $this->input->post('desa_id');
            $golongan_darah = $this->input->post('golongan_darah');
            $alamat = $this->input->post('alamat');
            $status = $this->input->post('status');
            
            $post = true;
            
            if($post){
                if($status=='tambah')
                {
                    $dataInsert = array(
                        'norm'  => $norm,
                        'tanggal_rm' => $tanggalrm,
                        'nik' => $nik,
                        'nama_sebutan' => $nama_sebutan,
                        'nama' => $nama,
                        'jeniskelamin' => $jeniskelamin,
                        'tanggallahir' => $tanggallahir,
                        'tempatlahir' => $tempatlahir,
                        'nomorhp' => $nomorhp,
                        'email' => $email,
                        'umur' => $umur,
                        'provinsi_id' => $provinsi_id,
                        'kabupaten_id' => $kabupaten_id,
                        'kecamatan_id' => $kecamatan_id,
                        'desa_id' => $desa_id,
                        'golongan_darah' => $golongan_darah,
                        'alamat' => $alamat,
                        'created_date' => $date,
                    );
                    $this->ModelGeneral->InsertData('ekl_rekammedis', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Rekam Medis ');
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                    $response['remarks'] = "Successfully saved new data"; 
                }
				if($status=='edit')
                {
                    $dataUpdate = array(
                        'norm'  => $norm,
                        'tanggal_rm' => $tanggalrm,
                        'nik' => $nik,
                        'nama_sebutan' => $nama_sebutan,
                        'nama' => $nama,
                        'jeniskelamin' => $jeniskelamin,
                        'tanggallahir' => $tanggallahir,
                        'tempatlahir' => $tempatlahir,
                        'nomorhp' => $nomorhp,
                        'email' => $email,
                        'umur' => $umur,
                        'provinsi_id' => $provinsi_id,
                        'kabupaten_id' => $kabupaten_id,
                        'kecamatan_id' => $kecamatan_id,
                        'desa_id' => $desa_id,
                        'golongan_darah' => $golongan_darah,
                        'alamat' => $alamat,
                        'modified_date' => $date,
                    );
                    $this->ModelGeneral->UpdateData('ekl_rekammedis', $dataUpdate, array('id' => $id));
                    $this->ModelGeneral->LogActivity('Process Update New Rekam Medis ');
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

    function getRekamMedisbyid()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $id = $this->input->post('id');
            $check = $this->Modelmasterdata->getRekammedis(" WHERE ekl_rekammedis.id = '".$id."' ");
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

    public function deleteRekamMedis()
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
            $datennow = date('Y-m-d H:i:s');
            $norm = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('ekl_rekammedis', array('norm'=>$norm));
                $this->ModelGeneral->LogActivity('Process Delete Rekam Medis: ');
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

    
    public function afiliasi()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Master Afiliasi',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/v_afiliasi', $data);
    }

    public function getAfiliasi()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getAfiliasi();
        $no = 1;
        foreach($datas as $d){
             $Id = '"'.$d['id'].'"';
          $option = "<a href='#' class='btn btn-primary' onclick='return editAfiliasi(".$Id.")'>Edit</a>";
            $data[] = array(
                "no" => $no,
                "afiliasi" => $d['afiliasi'],
                "alamat" => $d['alamat'],
                "notelp" => $d['notelp'],
                "email" => $d['email'],
                "namaadmin" => $d['namaadmin'],
                "nohpadmin" => $d['nohpadmin'],
                "username" => $d['username'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
    
    public function penunjang()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Master Penunjang',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/v_penunjang', $data);
    }
    public function getPenunjang(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getPenunjang();
        $no = 1;
        foreach($datas as $d){
             $Id = '"'.$d['id'].'"';
          $option = "<a href='#' class='btn btn-primary' onclick='return editPenunjang(".$Id.")'>Edit</a>";
            $data[] = array(
                "no" => $no,
                "kode" => $d['kode'],
                "jenis" => $d['jenis'],
                "pemeriksaan" => $d['pemeriksaan'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
    
    public function paketperiksa()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Paket Pemeriksaan',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
		$this->load->view('eklinik/v_paketperiksa', $data);
    }
    public function getPaketperiksa(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getPaketperiksa();
        $no = 1;
        foreach($datas as $d){
             $Id = '"'.$d['id'].'"';
          $option = "<a href='#' class='btn btn-primary' onclick='return editPaketperiksa(".$Id.")'>Detail</a>";
            $data[] = array(
                "no" => $no,
                "namapaket" => $d['namapaket'],
                "keterangan" => $d['keterangan'],
                "hargaumum" => $d['hargaumum'],
                "hargacorporate" => $d['hargacorporate'],
                "option" => $option,
                
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
    public function addPaketperiksa(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Paket Pemeriksaan baru"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $namapaket = $this->input->post('namapaket');
            $keterangan = $this->input->post('keterangan');
            $hargaumum = $this->input->post('hargaumum');
            $hargacorporate = $this->input->post('hargacorporate');
            
            $post = true;
            if($post){
                $dataInsert = array(
                    'namapaket'       => $namapaket,
                    'keterangan'       => $keterangan,
                    'hargaumum' => $hargaumum,
                    'hargacorporate' => $hargacorporate,
                    'branch_id' => $session['branch_id'],
                    'instansi_id' => $session['instansi_id'],
                );
                $this->ModelGeneral->InsertData('ekl_paketperiksa', $dataInsert);
                $this->ModelGeneral->LogActivity('Process Insert New Paket : '.$namapaket);
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

    public function search_city($code_prov){
		$query = $this->db->get_where('regencies',array('province_id'=>$code_prov));
		$data = "<option value=''>Please Select</option>";
		foreach ($query->result() as $value)
		{
			$data .= "<option value='".$value->id."'>".$value->name."</option>";
		}
        $response['data'] = $data;
        echo json_encode($response);
	}

	public function search_district($code_city){
		$query = $this->db->get_where('districts',array('regency_id'=>$code_city));
		$data = "<option value=''>Please Select</option>";
		foreach ($query->result() as $value)
		{
			$data .= "<option value='".$value->id."'>".$value->name."</option>";
		}
		$response['data'] = $data;
        echo json_encode($response);
	}

	public function search_village($code_vill){
		$query = $this->db->get_where('villages',array('district_id'=>$code_vill));
		$data = "<option value=''>Please Select</option>";
		foreach ($query->result() as $value)
		{
			$data .= "<option value='".$value->id."'>".$value->name."</option>";
		}
		$response['data'] = $data;
        echo json_encode($response);
	}
}
