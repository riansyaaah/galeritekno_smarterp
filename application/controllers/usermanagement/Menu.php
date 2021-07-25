<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

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

    var $idMenu = "BB675060-A1A1-4A77-A406-B1D837777CE6";

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
        $applications = $this->ModelMenu->getAllAplikasi(" WHERE is_active = 1 ");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Manajemen Menu',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,

            'moduleDetails'   => $moduleDetails,
            'applications'    => $applications,
            'modules'         => $modules,
        );
		$this->load->view('usermanagement/v_menu', $data);
    }

    public function addModul(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan modul baru"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $application_id = $this->input->post('application_id');
            $nama_modul = $this->input->post('nama_modul');
            $no_urut = $this->input->post('no_urut');
            $post = true;

            $checkNoUrut = $this->ModelMenu->getSingleModule(" WHERE no_urut = '".$no_urut."' AND application_id = '".$application_id."' ");
            $checkNama = $this->ModelMenu->getSingleModule(" WHERE nama_modul = '".$nama_modul."' AND application_id = '".$application_id."' ");

            if($checkNoUrut != null OR $checkNama != null){
                $post = false;
            }

            if($post){
                $modul_id = genUuid();
                $dataInsert = array(
                    'modul_id'      => $modul_id,
                    'application_id'=> $application_id,
                    'no_urut'       => $no_urut,
                    'nama_modul'    => $nama_modul,
                    'is_active'     => 1,
                    'icon'          => 'fa fa-list',
                    'created_by'    => $session['user_id']
                );
                $this->ModelGeneral->InsertData('modul', $dataInsert);
                $this->ModelGeneral->LogActivity('Process Insert New Modul '.$modul_id.' URL : '.current_url());
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

    public function addAplikasi(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan aplikasi baru"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $nama_aplikasi = $this->input->post('nama_aplikasi');
            $filefoto = $_FILES["icon"]['name'];
		    $file_ext = pathinfo($filefoto,PATHINFO_EXTENSION);
            $post = true;

            $checkNama = $this->ModelMenu->getSingleAplikasi(" WHERE nama_aplikasi = '".$nama_aplikasi."' ");

            if($checkNama != null){
                $post = false;
                $remarks = "Nama aplikasi sudah ada";
            }

            if($file_ext != "jpg" AND $file_ext != "png" AND $file_ext != "jpeg"){
                $post = false;
                $remarks = "Icon harus berformat jpg|png|jpeg";
            }

            if($post){
                $application_id = genUuid();
                $filename = $application_id.".".$file_ext;
                $config=array(  
                    'upload_path' 	=> 'assets/images/iconapps', 
                    'allowed_types' => 'jpg|png|jpeg', 
					'overwrite'		=> TRUE,
					'file_name' 	=> $filename
				);  
				$this->load->library('upload', $config); 
				$this->upload->initialize($config);
                $upload = $this->upload->do_upload('icon');
                if($upload){
                    $dataInsert = array(
                        'application_id'    => $application_id,
                        'nama_aplikasi'     => $nama_aplikasi,
                        'icon'              => $filename,
                        'is_active'         => 1,
                        'created_by'        => $session['user_id']
                    );
                    $this->ModelGeneral->InsertData('applications', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Application '.$application_id.' URL : '.current_url());
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                }else{
                    $response['status_json'] = false;
                    $response['remarks'] =  $this->upload->display_errors();
                }
            }else{
                $response['status_json'] = false;
                $response['remarks'] = $remarks; 
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

    public function editAplikasi(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $application_id = $this->input->post('application_id');
            $nama_aplikasi = $this->input->post('nama_aplikasi');
            $is_active = $this->input->post('is_active');
            $is_upload = $this->input->post('is_upload');
            
            $check = $this->ModelMenu->getSingleAplikasi(" WHERE application_id = '".$application_id."' ");
            if($check != null){
                $post = true;
                if($check->nama_aplikasi != $nama_aplikasi){
                    $checkNamaApp = $this->ModelMenu->getSingleAplikasi(" WHERE nama_aplikasi = '".$nama_aplikasi."' ");
                    if($checkNamaApp != null){
                        $post = false;
                        $remarks = "Nama Aplikasi Sudah ada";
                    }
                }
                if($post){
                    if($is_upload == 1){
                        $filefoto = $_FILES["icon"]['name'];
                        $file_ext = pathinfo($filefoto,PATHINFO_EXTENSION);
                        if($file_ext != "jpg" AND $file_ext != "png" AND $file_ext != "jpeg"){
                            $post = false;
                            $remarks = "Icon harus berformat jpg|png|jpeg";
                        }

                        $filename = strtoupper($application_id).".".$file_ext;
                        $config=array(  
                            'upload_path' 	=> 'assets/images/iconapps', 
                            'allowed_types' => 'jpg|png|jpeg', 
                            'overwrite'		=> TRUE,
                            'file_name' 	=> $filename
                        );  
                        $this->load->library('upload', $config); 
                        $this->upload->initialize($config);
                        $upload = $this->upload->do_upload('icon');
                        if($upload){
                            $dataUpdate = array(
                                'nama_aplikasi'     => $nama_aplikasi,
                                'icon'              => $filename,
                                'is_active'         => $is_active,
                                'update_by'         => $session['user_id'],
                                'update_date'       => date("Y-m-d H:i:s")
                            );
                            $this->ModelGeneral->UpdateData('applications', $dataUpdate, array("application_id" => $application_id));
                            $this->ModelGeneral->LogActivity('Process Update Application '.strtoupper($application_id).' URL : '.current_url());
                            $this->db->trans_complete();
                            $this->db->trans_commit();
                            $response['remarks'] = "Berhasil mengedit aplikasi dan upload icon baru"; 
                        }else{
                            $response['status_json'] = false;
                            $response['remarks'] =  $this->upload->display_errors();
                        }
                    }else{
                        $dataUpdate = array(
                            'nama_aplikasi'     => $nama_aplikasi,
                            'is_active'         => $is_active,
                            'update_by'         => $session['user_id'],
                            'update_date'       => date("Y-m-d H:i:s")
                        );
                        $this->ModelGeneral->UpdateData('applications', $dataUpdate, array("application_id" => $application_id));
                        $this->ModelGeneral->LogActivity('Process Update Application '.strtoupper($application_id).' URL : '.current_url());
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Berhasil mengedit aplikasi"; 
                    }
                }else{
                    $response['status_json'] = false;
                    $response['remarks'] = $checkNamaApp; 
                    $this->db->trans_rollback();
                }
            }else{
                $response['status_json'] = false;
                $response['remarks'] = 'Application ID tidak ditemukan'; 
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

    public function addMenu(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan menu baru"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $modul_id = $this->input->post('modul_id');
            $nama_modul_detail = $this->input->post('nama_modul_detail');
            $url = $this->input->post('url');
            $ip = $this->input->ip_address();
            $post = true;

            $checkUrl = $this->ModelMenu->getSingleMenu(" WHERE url = '".$url."' AND modul_id = '".$modul_id ."' ");
            $checkNama = $this->ModelMenu->getSingleMenu(" WHERE nama_modul_detail = '".$nama_modul_detail."' AND modul_id = '".$modul_id ."'");

            if($checkUrl != null OR $checkNama != null){
                $post = false;
            }

            if($post){
                $ip = $this->input->ip_address();
                $modul_detail_id = genUuid();
                $dataInsert = array(
                    'modul_detail_id'   => $modul_detail_id,
                    'modul_id'          => $modul_id,
                    'url'               => $url,
                    'nama_modul_detail' => $nama_modul_detail,
                    'is_active'         => 1,
                    'created_by'        => $session['user_id']
                );
                $this->ModelGeneral->InsertData('modul_detail', $dataInsert);
                $this->ModelGeneral->LogActivity('Process Insert New Menu '.strtoupper($modul_detail_id).' URL : '.current_url());
                $this->db->trans_complete();
                $this->db->trans_commit();
            }else{
                $response['status_json'] = false;
                $response['remarks'] = "URL atau nama menu sudah ada!"; 
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

    function getSingleApp(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $application_id = $this->input->post('application_id');
            $check = $this->ModelMenu->getSingleAplikasi(" WHERE application_id = '".$application_id."' ");
            if($check != null){
                $response['data'] = $check;
            }else{
                $response['status_json'] = false;
                $response['remarks'] = "Aplikasi tidak ditemukan"; 
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }

    function getSingleModule(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $modul_id = $this->input->post('modul_id');
            $check = $this->ModelMenu->getSingleModule(" WHERE modul_id = '".$modul_id."' ");
            if($check != null){
                $response['data'] = $check;
            }else{
                $response['status_json'] = false;
                $response['remarks'] = "Module tidak ditemukan"; 
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }

    function getSingleMenu(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $modul_detail_id = $this->input->post('modul_detail_id');
            $check = $this->ModelMenu->getSingleMenuJoinModul(" WHERE md.modul_detail_id = '".$modul_detail_id."' ");
            if($check != null){
                $response['data'] = $check;
            }else{
                $response['status_json'] = false;
                $response['remarks'] = "Menu tidak ditemukan"; 
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }

    public function editModul(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil mengedit modul"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $modul_id = $this->input->post('modul_id');
            $application_id = $this->input->post('application_id');
            $nama_modul = $this->input->post('nama_modul');
            $no_urut = $this->input->post('no_urut');
            $icon = $this->input->post('icon');
            $is_active = $this->input->post('is_active');

            $check = $this->ModelMenu->getSingleModule(" WHERE modul_id = '".$modul_id."' ");
            if($check != null){
                $post = true;
                if($check->no_urut != $no_urut AND $check->application_id != $application_id){
                    $checkNoUrut = $this->ModelMenu->getSingleModule(" WHERE no_urut = '".$no_urut."' AND application_id = '".$application_id."' ");
                    if($checkNoUrut != null){
                        $post = false;
                        $remarks = "No Urut Sudah ada";
                    }
                }

                if($check->nama_modul != $nama_modul AND $check->application_id != $application_id){
                    $checkNamaModul = $this->ModelMenu->getSingleModule(" WHERE nama_modul = '".$nama_modul."' AND application_id = '".$application_id."' ");
                    if($checkNamaModul != null){
                        $post = false;
                        $remarks = "Nama Modul Sudah ada";
                    }
                }

                if($post){
                    $dataEdit = array(
                        'application_id'    => $application_id,
                        'no_urut'           => $no_urut,
                        'nama_modul'        => $nama_modul,
                        'is_active'         => $is_active,
                        'icon'              => $icon,
                        'update_by'         => $session['user_id'],
                        'update_date'       => $datennow
                    );
                    $this->ModelGeneral->UpdateData('modul', $dataEdit, array('modul_id' => $modul_id));
                    $this->ModelGeneral->LogActivity('Process Edit Modul '.$modul_id.' URL : '.current_url());
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                }else{
                    $response['status_json'] = false;
                    $response['remarks'] = $remarks; 
                    $this->db->trans_rollback();
                }
            }else{
                $response['status_json'] = false;
                $response['remarks'] = 'Modul ID tidak ditemukan'; 
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

    public function editMenu(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil mengedit menu"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $modul_id = $this->input->post('modul_id');
            $modul_detail_id = $this->input->post('modul_detail_id');
            $nama_modul_detail = $this->input->post('nama_modul_detail');
            $url = $this->input->post('url');
            $is_active = $this->input->post('is_active');

            $check = $this->ModelMenu->getSingleMenu(" WHERE modul_detail_id = '".$modul_detail_id."' ");
            if($check != null){
                $post = true;

                if($check->url != $url){
                    $checkURL = $this->ModelMenu->getSingleMenu(" WHERE url = '".$url."' AND modul_id = '".$check->modul_id ."' ");
                    if($checkURL != null){
                        $post = false;
                        $remarks = "URL Sudah ada";
                    }
                }

                if($post){
                    $dataEdit = array(
                        'modul_id'          => $modul_id,
                        'nama_modul_detail' => $nama_modul_detail,
                        'url'               => $url,
                        'is_active'         => $is_active,
                        'update_by'         => $session['user_id'],
                        'update_date'       => $datennow
                    );
                    $this->ModelGeneral->UpdateData('modul_detail', $dataEdit, array('modul_detail_id' => $modul_detail_id));
                    $this->ModelGeneral->LogActivity('Process Edit Menu '.$modul_detail_id.' URL : '.current_url());
                    $this->db->trans_complete();
                    $this->db->trans_commit();
                }else{
                    $response['status_json'] = false;
                    $response['remarks'] = $remarks; 
                    $this->db->trans_rollback();
                }
            }else{
                $response['status_json'] = false;
                $response['remarks'] = 'Menu ID tidak ditemukan'; 
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

    public function deleteMenu(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil Delete menu"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $modul_detail_id = $this->input->post('modul_detail_id');
            $nama_modul_detail = $this->input->post('nama_modul_detail');
            $url = $this->input->post('url');
            $is_active = $this->input->post('is_active');

            $check = $this->ModelMenu->getSingleMenu(" WHERE modul_detail_id = '".$modul_detail_id."' ");
            if($check != null){
                $this->ModelGeneral->DeleteData('modul_detail', array('modul_detail_id' => $modul_detail_id));
                $this->ModelGeneral->LogActivity('Process Delete Menu '.$modul_detail_id.' URL : '.current_url());
                $this->db->trans_complete();
                $this->db->trans_commit();
            }else{
                $response['status_json'] = false;
                $response['remarks'] = 'Menu ID tidak ditemukan'; 
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
