<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __Construct()
    {
        parent ::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
    }

    public $idMenu = "6D0D619E-EBB3-4A5D-B544-F4CECA44C4FF";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Manajemen Menu',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );
        $this->load->view('usermanagement/v_users', $data);
    }

    public function getUsers()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelUsers->getAllUserJoin();
        $no = 1;
        foreach ($datas as $d) {
            if ($d['is_active'] == 1) {
                $is_active = '<div class="badge badge-success badge-shadow">Aktif</div>';
            } else {
                $is_active = '<div class="badge badge-danger badge-shadow">Tidak Aktif</div>';
            }
            $userId = '"'.$d['user_id'].'"';
            $option = "<a href='#' class='btn btn-primary' onclick='return editUser(".$userId.")'>Detail</a>";

            $data[] = array(
                "no" => $no,
                "username" => $d['username'],
                "email" => $d['email'],
                "nik" => $d['nik'],
                "nama_lengkap" => $d['nama_lengkap'],
                "ttl" => $d['tempat_lahir'].', '.date('d-m-Y', strtotime($d['tanggal_lahir'])),
                "alamat" => $d['alamat'],
                "jabatan" => '',
                "posisi" => $d['position'],
                "is_active" => $is_active,
                "option" => $option,
            );
            $no ++;
        }
        $response['data'] = $data;
        echo json_encode($response);
    }
 
    public function getSingleUser()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data";
        try {
            $user_id = $this->input->post('user_id');
            $check = $this->ModelUsers->getSingleUserJoin(" WHERE u.user_id = '".$user_id."' ");
            if ($check != null) {
                $response['data'] = $check;
            } else {
                $response['status_json'] = false;
                $response['remarks'] = "User tidak ditemukan";
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(), $e->getMessage());
        }
        echo json_encode($response);
    }

    public function saveUser()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $this->db->trans_start();
        $this->db->trans_strict(false);

        try {
            $datennow = date('Y-m-d H:i:s');

            $user_id = $this->input->post('user_id');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $is_active = $this->input->post('is_active');
            $nik = $this->input->post('nik');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tanggal_lahir = date('Y-m-d', strtotime($this->input->post('tanggal_lahir')));
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $alamat = $this->input->post('alamat');
            $no_handphone = $this->input->post('no_handphone');
            $instansi_id = $this->input->post('instansi_id');
            $branch_id = $this->input->post('branch_id');
            $staff_id = $this->input->post('staff_id');
            $post = true;

            if ($user_id != "" or $user_id != null) {
                $check = $this->ModelUsers->getSingleUser(" WHERE user_id = '".$user_id."' ");
                if ($check->username !=  $username) {
                    $checkUsername = $this->ModelUsers->getSingleUser(" WHERE username = '".$username."' ");
                    if ($checkUsername != null) {
                        $post = false;
                        $remarks = "Username sudah ada, silakan gunakan Username lain";
                    }
                }

                if ($check->email !=  $email) {
                    $checkEmail = $this->ModelUsers->getSingleUser(" WHERE email = '".$email."' ");
                    if ($checkEmail != null) {
                        $post = false;
                        $remarks = "Email sudah ada, silakan gunakan email lain";
                    }
                }
            }

            if ($post) {
                if ($user_id == "" or $user_id == null) {
                    $user_id = genUuid();
                    $dataUser= array(
                        'user_id'       => strtoupper($user_id),
                        'username'      => $username,
                        'email'         => $email,
                        'staff_id'         => $staff_id,
                        'is_active'     => $is_active,
                        'password'      => $this->hash_password(DEFAULT_PASSWORD),
                        'password_default'=> $this->hash_password(DEFAULT_PASSWORD),
                        'created_by'    => $session['user_id']
                    );
                    $this->ModelGeneral->InsertData('users_smarterp', $dataUser);
                    
                    $user_detail_id = genUuid();
                    $dataUserDetail = array(
                        'user_detail_id'    => $user_detail_id,
                        'user_id'           => $user_id,
                        'nik'               => $nik,
                        'nama_lengkap'      => $nama_lengkap,
                        'tempat_lahir'      => $tempat_lahir,
                        'tanggal_lahir'     => $tanggal_lahir,
                        'jenis_kelamin'     => $jenis_kelamin,
                        'alamat'            => $alamat,
                        'no_handphone'      => $no_handphone,
                        'instansi_id'       => $instansi_id,
                        'branch_id'         => $branch_id,
                        'created_by'        => $session['user_id']
                    );
                    $this->ModelGeneral->InsertData('user_detail', $dataUserDetail);
                    $this->ModelGeneral->LogActivity('Process Insert User ID '.$user_id);
                    $response['remarks'] = "Berhasil menambahkan user baru";
                } else {
                    $dataUser= array(
                        'username'      => $username,
                        'email'         => $email,
                        'staff_id'         => $staff_id,
                        'is_active'     => $is_active,
                        'update_by'     => $session['user_id'],
                        'update_date'   => $datennow
                    );
                    $this->ModelGeneral->UpdateData('users_smarterp', $dataUser, array('user_id' => $user_id));
                    $dataUserDetail = array(
                        'nik'               => $nik,
                        'nama_lengkap'      => $nama_lengkap,
                        'tempat_lahir'      => $tempat_lahir,
                        'tanggal_lahir'     => $tanggal_lahir,
                        'jenis_kelamin'     => $jenis_kelamin,
                        'alamat'            => $alamat,
                        'no_handphone'      => $no_handphone,
                        'instansi_id'       => $instansi_id,
                        'branch_id'         => $branch_id,
                        'update_by'         => $session['user_id'],
                        'update_date'       => $datennow
                    );
                    $this->ModelGeneral->UpdateData('user_detail', $dataUserDetail, array('user_id' => $user_id));
                    $this->ModelGeneral->LogActivity('Process Edit User ID '.$user_id);
                    $response['remarks'] = "Berhasil mengedit data user";
                }
                $this->db->trans_complete();
                $this->db->trans_commit();
            } else {
                $response['status_json'] = false;
                $response['remarks'] = $remarks;
                $this->db->trans_rollback();
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(), $e->getMessage());
        }
        echo json_encode($response);
    }

    private function hash_password($pass_user)
    {
        return password_hash($pass_user, PASSWORD_DEFAULT);
    }

    public function getInstansi()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil";
        $search = $this->input->get('search');
        $orderby = " nama_instansi ASC";
        $where = " WHERE nama_instansi LIKE '%".$search."%' AND is_active = 1 ";
        $data = $this->ModelUsers->getInstansiSelect2($where, $orderby);
        $response['data'] = $data;
        echo json_encode($response);
    }
    
    public function getStaff()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil";
        $search = $this->input->get('search');
        $where = " WHERE first_name LIKE '%".$search."%' OR last_name LIKE '%".$search."%' ";
        $data = $this->db->query("select id, concat(first_name,' ',last_name) as name from hrm_staffprofile $where")->result_array();
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function getBranch()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil";
        $search = $this->input->get('search');
        $instansi_id = $this->input->get('instansi_id');
        $orderby = " nama ASC";
        $where = " WHERE nama LIKE '%".$search."%' AND idintansi = '".$instansi_id."' ";
        $data = $this->ModelUsers->getBranchSelect2($where, $orderby);
        $response['data'] = $data;
        echo json_encode($response);
    }

    public function printPDF()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $this->db->trans_start();
        $this->db->trans_strict(false);

        try {
            $datennow = date('Y-m-d H:i:s');
            $text   = $this->input->post('text');

            $url            = "https://stackoverflow.com/";
            $path           = "/test/";
            $fileName       = $text.".pdf";
            $res            = genPdf($url, $path, $fileName);

            if ($res['status']) {
                $response['pathPdf'] = $res['path'];
            } else {
                $response['status_json'] = false;
                $response['remarks'] = $res['error'];
            }
            $response['json'] = $res;
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(), $e->getMessage());
        }
        echo json_encode($response);
    }

    public function sendMail()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $this->db->trans_start();
        $this->db->trans_strict(false);

        try {
            $urlAttachments = array();
            $fromMail       = "admin@speedlab.id";
            $fromName       = "Speedlab By Lentera";
            $to             = "febriansyah032@gmail.com";
            $cc             = "";
            $urlAttachments = ["https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png"];
            $subjet         = "Ini Subject";
            $body           = "<b> Ini Body </b>";
            $res = sendMail($fromMail, $fromName, $to, $cc, $urlAttachments, $subjet, $body);
            if ($res['status']) {
                $response['remarks'] = $res['remarks'];
            } else {
                $response['status_json'] = false;
                $response['remarks'] = $res['error'];
            }
            $response['json'] = $res;
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(), $e->getMessage());
        }
        echo json_encode($response);
    }

    public function genQRCode()
    {
        $time_start = microtime(true);
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $this->db->trans_start();
        $this->db->trans_strict(false);

        try {
            $text   = "1234;Dimas Prabowo;SPDT01042021192930;03-03-2021;01-12-1998;Antigen;Drive Trhu;Pria";

            $data           = $text;
            $path           = "/testllagi/";
            $fileName       = date("YmdHisA");
            $res            = genQRCode($data, $path, $fileName);

            if ($res['status']) {
                $response['path'] = $res['path'];
            } else {
                $response['status_json'] = false;
                $response['remarks'] = $res;
            }
            $time_end = microtime(true);
            $execution_time = ($time_end - $time_start)/60;
            $response['time'] = $execution_time;
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(), $e->getMessage());
        }
        echo json_encode($response);
    }
}