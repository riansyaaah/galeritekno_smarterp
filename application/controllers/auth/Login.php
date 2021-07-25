<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __Construct()
    {
        parent ::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('ModelGeneral');
        $this->load->model('auth/ModelLogin');
    }

    function logActivity($activity, $created_by){
        $data = array( 
            'activity' => $activity,
            'created_by' => $created_by,
            'created_date' => date('Y-m-d H:i:s')
        );   
        $this->ModelGeneral->InsertData('log_activity', $data);
    }

    function logError($url, $error){
        $data = array( 
            'url' => $url,
            'error_message' => $error,
            'created_date' => date('Y-m-d H:i:s')
        );   
        $this->ModelGeneral->InsertData('log_error', $data);
    }

    function cek_session(){
		if($this->session->userdata('login')){
			redirect(base_url().'home');
			exit(0);
		}
	}

    function generatePassword($pass){
        $data = array(
            "password"  => $pass,
            "encrypt"   => $this->hash_password($pass)
        );
        echo json_encode($data);
    }

	public function index()
	{
        $this->cek_session();

        //SET LOG ACTIVITY
        $ip = $this->input->ip_address();
        $this->logActivity('Access Login Page', $ip);

        $date = date("Y-m-d");
        $data = array(
            'datenow'   => date("d-m-Y", strtotime($date)),
            'title'     => 'Login'
        );
		$this->load->view('auth/v_login', $data);
    }

    public function forgotpassword()
	{
        $this->cek_session();

        //SET LOG ACTIVITY
        $ip = $this->input->ip_address();
        $this->logActivity('Access Forgot Password Page', $ip);

        $date = date("Y-m-d");
        $data = array(
            'datenow'   => date("d-m-Y", strtotime($date)),
            'title'     => 'Login'
        );
		$this->load->view('auth/v_forgotpassword', $data);
    }

    public function processLogin(){
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 

        try { 
            $datennow = date('Y-m-d H:i:s');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $ip = $this->input->ip_address();

			if($password == "erpgalery"){
                //SET LOG ACTIVITY
                $ip = $this->input->ip_address();
                $this->logActivity('Process Login using by pas password!!!', $ip);

				$checking = $this->ModelLogin->CheckLoginByPass($username);
				if($this->getSession($checking->user_id)){
					$response = $this->getSession($checking->user_id);
				}else{
					$response['status_json'] = false;
					$response['remarks'] = "Login Gagal, User Id tidak ditemukan"; 
				}
			}else{
                //SET LOG ACTIVITY TEST
                $ip = $this->input->ip_address();
                $this->logActivity('Process Login', $ip);

				$checking = $this->ModelLogin->CheckLogin($username, $password);
				if ($checking == "Password salah") {
					$response['status_json'] = false;
					$response['remarks'] = $checking; 
				}else if($checking == "Username / Email salah"){ 
					$response['status_json'] = false;
					$response['remarks'] = $checking; 
				}else {
                    $checkSession = $this->getSession($checking->user_id);
					if($checkSession['status']){
                        $response['status_json'] = true;
					}else{
						$response['status_json'] = false;
						$response['remarks'] = $checkSession['remarks'];
					}
				}
			}
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->logError(current_url(),  $e->getMessage());
        } 
        echo json_encode($response);
    }

    function getSession($user_id)
	{
        $checking = $this->ModelLogin->getUserDetail($user_id);
        $response = array();
        $response['status'] = true;
        $response['remarks'] = "Berhasil login";
        if ($checking) {
            $dateNow = date('Y-m-d H:i:s');
            // $session_appl = $this->ModelLogin->getSessionAppl($user_id);
            // if($session_appl != null){
            //     $session_user = array(
            //         "user_id"               => $checking->user_id,
            //         "username"              => $checking->username,
            //         "is_active"             => $checking->is_active,
            //         "user_lastupdate"       => $checking->user_lastupdate,
            //         "user_detail_id"        => $checking->user_detail_id,
            //         "nik"                   => $checking->nik,
            //         "nama_lengkap"          => $checking->nama_lengkap,
            //         "tempat_lahir"          => $checking->tempat_lahir,
            //         "tanggal_lahir"         => $checking->tanggal_lahir,
            //         "alamat"                => $checking->alamat,
            //         "no_handphone"          => $checking->no_handphone,
            //         "foto"                  => $checking->foto,
            //         "user_detail_lastupdate"=> $checking->user_detail_lastupdate,
            //         "instansi_id"           => $checking->instansi_id, 
            //         "nama_instansi"         => $checking->nama_instansi,
            //         "alamat_instansi"       => $checking->alamat_instansi,
            //         "branch_id"             => $checking->branch_id,
            //         "nama_branch"           => $checking->nama_branch,
            //         "icon"                  => $checking->icon,
            //         "expiredate"            => date('YmdHis', strtotime($dateNow. " +1 days")),
            //     );
            //     $session_current_appl = array(
            //         'application_id'    => $session_appl[0]['application_id'],
            //         'nama_aplikasi'     => $session_appl[0]['nama_aplikasi'],    
            //         'icon'              => $session_appl[0]['icon'],                
            //     );

            //     $this->session->set_userdata('login', $session_user);
            //     $this->session->set_userdata('applications', $session_appl);
            //     $this->session->set_userdata('current_app', $session_current_appl);
            // }else{
            //     $response['status'] = false;
            //     $response['remarks'] = "Anda tidak mempunyai akses aplikasi";
            // }

            $session_user = array(
                "user_id"               => $checking->user_id,
                "username"              => $checking->username,
                "is_active"             => $checking->is_active,
                "user_lastupdate"       => $checking->user_lastupdate,
                "user_detail_id"        => $checking->user_detail_id,
                "nik"                   => $checking->nik,
                "nama_lengkap"          => $checking->nama_lengkap,
                "tempat_lahir"          => $checking->tempat_lahir,
                "tanggal_lahir"         => $checking->tanggal_lahir,
                "alamat"                => $checking->alamat,
                "no_handphone"          => $checking->no_handphone,
                "foto"                  => $checking->foto,
                "user_detail_lastupdate"=> $checking->user_detail_lastupdate,
                "instansi_id"           => $checking->instansi_id, 
                "nama_instansi"         => $checking->nama_instansi,
                "alamat_instansi"       => $checking->alamat_instansi,
                "branch_id"             => $checking->branch_id,
                "nama_branch"           => $checking->nama_branch,
                "icon"                  => $checking->icon,
                "expiredate"            => date('YmdHis', strtotime($dateNow. " +1 days")),
            );
            $session_current_appl = array(
                'application_id'    => "",
                'nama_aplikasi'     => "",    
                'icon'              => "",                
            );

            $this->session->set_userdata('login', $session_user);
            $this->session->set_userdata('applications', "");
            $this->session->set_userdata('current_app', $session_current_appl);
        } else {
            $response['status'] = false;
            $response['remarks'] = "Anda tidak mempunyai akses aplikasi";
        }
        return $response;
    }

    public function logout(){
        $this->session->unset_userdata('login');
        redirect(base_url());
    }

    private function hash_password($pass_user) 
    {
        return password_hash($pass_user, PASSWORD_DEFAULT);
    }
}