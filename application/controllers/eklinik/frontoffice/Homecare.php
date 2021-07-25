<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homecare extends CI_Controller {

    function __Construct()
    {
        parent ::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
        $this->load->model('eklinik/Modelmasterdata');
    }

    var $idMenu = "29BFA5B4-530F-4291-8D56-256AD054F587";

    public function index()
	{
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $paket = $this->Modelmasterdata->getPaketperiksa();
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Reservasi Homecare',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'list_paket'   => $paket,
        );
		$this->load->view('eklinik/frontoffice/v_homecare', $data);
    }
    
    public function getHomecare(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->Modelmasterdata->getHomecare();
        $no = 1;
        
        foreach($datas as $d){
            $Id = '"'.$d['id'].'"';
            $details = $this->Modelmasterdata->getHomecareDetail(" WHERE ehd.homecare_id = '".$d['id']."' ");
            $paket = "";
            $totalHarga = 0;
            foreach($details as $detail){
                $paket .= $detail['namapaket']." : ".$detail['jumlah']."<br>";
                if($d['tipe'] == "General"){
                    $totalHarga += (int)$detail['hargaumum'];
                }else{
                    $totalHarga += (int)$detail['hargacorporate'];
                }
            }

            if($d['isproses'] == "0"){
                $proses = '<div class="badge badge-danger badge-shadow">Belum di Proses</div>';
            }else{
                $proses = '<div class="badge badge-success badge-shadow">Sudah di Proses</div>';
            }

            $option = "<a href='#' class='btn btn-primary' onclick='return detailReservasi(".$Id.")'>Detail</a>";
            $data[] = array(
                "no" => $no,
                "noinvoice" => $d['id'],
                "waktukunjungan" => $d['tanggalkunjungan']."<br>Pukul ".$d['jamkunjungan'],
                "corporate" => $d['tipe'],
                "detailcustomer" => $d['nama']."<br>".$d['nomorhp']."<br>".$d['email']."<br>".$d['alamat'],
                "paket" => $paket,
                "totalharga" =>  "Rp. ". number_format($totalHarga),
                "statusproses" => $proses,
                "statustransaksi" => $d['statustransaksi'],
                "option" => $option,
                
            );
            $no ++;
        }
        if(count($datas)>0){
            $response['data'] = $data;
        }else{
            $response['data'] = array();
        }
        echo json_encode($response);
    }

    public function itemBaru()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil submit homecare"; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try { 
            $datenow = date('Y-m-d H:i:s');
            $tipe = $this->input->post('tipe');
            $nama = $this->input->post('nama');
            $nomorhp = $this->input->post('nomorhp');
            $email = $this->input->post('email');
            $alamat = $this->input->post('alamat');
            $tanggalkunjungan = $this->input->post('tanggalkunjungan');
            $jamkunjungan = $this->input->post('jamkunjungan');
            $paket = $this->input->post('paket');
            $jumlah = $this->input->post('jumlah');
            $post = true;

            $id = strtoupper(genUuid());
            $dataInsert = array(
                'id'               => $id,
                'tipe'             => $tipe,
                'nama'             => $nama,
                'nomorhp'          => $nomorhp,
                'email'            => $email,
                'alamat'           => $alamat,
                'tanggalkunjungan' => date("Y-m-d", strtotime($tanggalkunjungan)),
                'jamkunjungan'     => $jamkunjungan,
                'created_by'       => $session['user_id']
            );
            $resHomeCare = $this->ModelGeneral->InsertData('ekl_homecare', $dataInsert);
            if($resHomeCare){
                for($i = 0; $i < COUNT($paket); $i++){
                    $jumlahPasien = $jumlah[$i];
                    if($jumlah[$i] == "" OR $jumlah[$i] == 0){
                        $jumlahPasien = 1;
                    }
                    $dataInsertDetail = array(
                        'homecare_id' => $id,
                        'paket_id'    => $paket[$i],
                        'jumlah'      => $jumlahPasien,
                    );
                    $this->ModelGeneral->InsertData('ekl_homecare_detail', $dataInsertDetail);
                }
                $this->ModelGeneral->LogActivity('Process Insert Home Care by admin. ID HOME CARE: '.$id);
                
                $this->db->trans_complete();
                $this->db->trans_commit();
            }else{
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
}
