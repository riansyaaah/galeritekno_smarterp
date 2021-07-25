<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __Construct()
    {
        parent ::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('ModelGeneral');
        $this->load->model('auth/ModelLogin');
    }

    function cek_session(){
		if(!$this->session->userdata('login')){
			redirect(base_url().'auth/login/logout');
			exit(0);
		}else{
            $sess = $this->session->userdata('login');
            $modules = getMenu($sess['user_id']);
            $dateNow = date("YmdHis");
            $expireDate = $sess['expiredate'];
            if((int)$dateNow > (int)$expireDate){
                echo '<script>alert("Session kamu telah habis, silakan login kembali "'.$sess['expiredate'].'); window.location.replace("'.base_url('auth/login/logout').'"); </script>';
            }
        }
    }

	public function index()
	{
        $this->cek_session();
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Dashboard',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp
        );
		$this->load->view('home', $data);
    }

    // public function getMenu(){
    //     $this->cek_session();
    //     $session = $this->session->userdata('login');
    //     return getMenu($session['user_id']);
    // }

    // public function changeApp(){
    //     $this->cek_session();
    //     $this->session->unset_userdata('current_app');
    //     $response = array();
    //     $response['status_json'] = true;
    //     $response['remarks'] = "Successfully change application";

    //     $application_id = $this->input->post('application_id');
    //     $data = $this->ModelLogin->getSingleApps($application_id);
    //     $session_current_appl = array(
    //         'application_id'    => $data->application_id,
    //         'nama_aplikasi'     => $data->nama_aplikasi,    
    //         'icon'              => $data->icon,                
    //     );
    //     $this->session->set_userdata('current_app', $session_current_appl);

    //     echo json_encode($response);
    // }

    // public function getPeriode(){
    //     header("Content-Type: application/json");
    //     $this->cek_session();
    //     $session = $this->session->userdata('login');
    //     $response = array();
    //     $response['status_json'] = true;
    //     $response['remarks'] = "Successfully Get Data";
    //     $userId = $session['user_id'];

    //     $data = $this->ModelGeneral->getPeriode($userId);
    //     $years = array();
    //     $startYears = 2015;
    //     $endyears = 10;
    //     for($i = $startYears; $i <= $startYears + $endyears; $i++){
    //         $years[] = array($i);
    //     }
        
    //     $response['years'] = $years;
    //     if($data == null){
    //         $response['year'] = date("Y");
    //         $response['month'] = date("m");
    //     }else{
    //         $response['year'] = substr($data->ThnBln,0,4);
    //         $response['month'] = substr($data->ThnBln,4,6);
    //     }
    //     echo json_encode($response);
    // }

    // public function changePeriode(){
    //     header("Content-Type: application/json");
    //     $this->cek_session();
    //     $session = $this->session->userdata('login');
    //     $response = array();
    //     $response['status_json'] = true;
    //     $response['remarks'] = "Successfully Change Period";
    //     $userId = $session['user_id'];
    //     $Company_Id = $session['instansi_id'];

    //     $year = $this->input->post('year');
    //     $month = $this->input->post('month');
    //     $ThnBulan = $year."".$month;
    //     $data = $this->ModelGeneral->getPeriodeThnBulan($userId, $ThnBulan);

    //     $this->db->trans_start();
    //     $this->db->trans_strict(FALSE);
    //     try { 
    //         if($data == null){
    //             $dataUpdateOld = array(
    //                 'Active'        => 0
    //             );
    //             $this->ModelGeneral->UpdateData('periode', $dataUpdateOld, array("User_Id" => $userId));

    //             $dataInsert = array(
    //                 'Company_Id'    => $Company_Id,
    //                 'User_Id'       => $userId,
    //                 'ThnBln'        => $ThnBulan,
    //                 'Active'        => 1
    //             );
    //             $this->ModelGeneral->InsertData('periode', $dataInsert);
    //             $this->ModelGeneral->LogActivity('Process Insert new period URL : '.current_url());
    //         }else{
    //             $dataUpdateOld = array(
    //                 'Active'        => 0
    //             );
    //             $this->ModelGeneral->UpdateData('periode', $dataUpdateOld, array("User_Id" => $userId));

    //             $dataUpdateNew = array(
    //                 'Active'        => 1
    //             );
    //             $this->ModelGeneral->UpdateData('periode', $dataUpdateNew, array("User_Id" => $userId, "ThnBln" => $ThnBulan));
    //             $this->ModelGeneral->LogActivity('Process Update Periode URL : '.current_url());
    //         }
    //         $this->db->trans_complete();
    //         $this->db->trans_commit();

    //     } catch (\Throwable $e) {
    //         $response['status_json'] = false;
    //         $response['remarks'] = $e->getMessage();
    //         $this->db->trans_rollback();
    //         $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
    //     } 
    //     echo json_encode($response);
    // }


}
