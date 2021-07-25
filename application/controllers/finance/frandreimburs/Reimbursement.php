<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reimbursement extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/frandreimburs/ModelReimbursement');
        $this->load->model('usermanagement/ModelUsers');
    }

    var $idMenu = "b885a43c-2932-417c-a308-9ec180c2d8c0";

    
    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Reimbursement',
            'subtitle'      => 'Reimbursement Form',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/frandreimburs/reimbursement/v_reimbursement', $data);
    }
}    