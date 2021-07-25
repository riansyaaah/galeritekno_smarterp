<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kwitansiaps extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('finance/invoicing/ModelKwitansiaps', 'kwi');
        $this->load->model('finance/invoicing/ModelKwitansiapsDataTable', 'kwiDataTable');
        $this->load->model('usermanagement/ModelUsers');
    }

    var $idMenu = "c64e6783-66cb-4cf2-8609-69bdf0e4610c";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Data Kwitansi APS',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('finance/invoicing/v_kwitansiaps', $data);
    }
    
    public function getKwitansiaps()
    {
        // cek_session($this->idMenu);
        // $session = $this->session->userdata('login');
        // $response = [];
        // $response['status_json'] = true;
        // $datas = $this->kwi->getKwitansiaps(" where trash != '1' and carabayar = 'Lunas' and statustransaksi = 'Selesai' order by tanggalkunjungan desc limit 100");
        // $no = 1;
        // foreach ($datas as $d) {
        //     $kode = '"'.$d['id'].'"';
        //     $data[] = array(
        //         "no" => $no,
        //         "tanggalkunjungan" => $d['tanggalkunjungan'],
        //         "nomorregistrasi" => $d['nomorregistrasi'],
        //         "tipekunjungan" => $d['tipekunjungan'],
        //         "jenispemeriksaan" => $d['detailketerangan'],
        //         "detailharga" => $d['detailharga'],
        //         "nik" => $d['nik'],
        //         "nama" => $d['nama'],
        //         "jeniskelamin" => $d['jeniskelamin'],
        //         "tanggallahir" => $d['tanggallahir'],
        //         "nomorhp" => $d['nomorhp'],
        //         "kwitansi" => ""
        //     );
        //     $no++;
        // }
        // $response['data'] = $data;
        // echo json_encode($response);
       
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $response = [];
        $response['status_json'] = true;

        $list = $this->kwiDataTable->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            //$kode = '"'.$field->id.'"
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date("d M Y H:i:s", strtotime($field->tanggalkunjungan));
            $row[] = $field->nomorregistrasi;
            $row[] = $field->tipekunjungan;
            $row[] = $field->detailketerangan;
            $row[] = $field->detailharga;
            $row[] = $field->nik;
            $row[] = $field->nama;
            $row[] = $field->jeniskelamin;
            $row[] = $field->tanggallahir;
            $row[] = $field->nomorhp;
            $row[] = "";
            $data[] = $row;
        }
        $response["draw"] = $_POST['draw'];
        $response["recordsTotal"] = $this->kwiDataTable->count_all();
        $response["recordsFiltered"] = $this->kwiDataTable->count_filtered();
        $response["data"] = $data;
        echo json_encode($response);
    } 
}