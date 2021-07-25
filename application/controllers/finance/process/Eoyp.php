<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eoyp extends CI_Controller
{
    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/process/End_of_year_model');
    }

    var $idMenu = "A9F17E54-B271-4F58-898C-6CB7464FC254";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data End Of Year Process',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );

        $this->load->view('finance/process/end_of_year_view', $data);
    }

    public function get_data()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $eoyps = $this->End_of_year_model->get_all();
        $no = 1;
        foreach ($eoyps as $eoyp) {
            $NoRef = '"' . $eoyp['NoRef'] . '"';
            $option = "
            <div class='text-center'>
			    <a href='#' class='edit_record btn btn-success btn-sm' onclick='return details(" . $NoRef . ")'>
                    <i class='fa fa-search'></i> Details
                </a>
                <a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $NoRef . ")'>
                    <i class='fa fa-pencil'></i> Edit
                </a>
                <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return delete(" . $NoRef . ")'>
                    <i class='fa fa-trash'></i> Delete
                </a>
            </div>";

            $data[] = array(
                "no"            => $no,
                "Company_Id"    => $eoyp['Company_Id'],
                "NoRef"         => $eoyp['NoRef'],
                "Tgl"           => $eoyp['Tgl'],
                "Uraian"        => $eoyp['Uraian'],
                "KdTrans"       => $eoyp['KdTrans'],
                "AccountNo"     => $eoyp['AccountNo'],
                "option"        => $option,
            );
            $no++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
}
