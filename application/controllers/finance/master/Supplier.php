<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
        $this->load->model('finance/master/ModelSupplier', 'spl');
    }

    var $idMenu = "7AE504F0-0962-4874-87C7-23DB0A955870";

    public function index()
    { 
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");

        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Master Data Supplier',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
        );

        $this->load->view('finance/master/v_supplier', $data);
    }
    public function getSupplier()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->spl->getSupplier("order by Kode_Spl");
        foreach ($datas as $d) {
            $data[] = [
                'code'      => $d['Kode_Spl'],
                'namaspl'   => $d['Nama_Spl'],
                'address'   => $d['Address'],
                'phone'     => $d['Phone'],
                'inisial'   => $d['Inisial'],
                'edit'      => '<button type="button" class="edit_record btn btn-info btn-sm" onclick="return edit(\''.$d['Kode_Spl'].'\')"></button>',
                'delete'    => '<button type="button" class="edit_record btn btn-info btn-sm" onclick="return hapus(\''.$d['Kode_Spl'].'\')"></button>' 
            ];
        }
        $response['data'] = (count($datas)>0)? $data : [];
        echo json_encode($response);
    } 

    function getSupplierbyid(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data"; 
        try { 
            $code = $this->input->post('code');
            $status = $this->input->post('status');
            $check = $this->spl->getSupplier(" WHERE Kode_Spl = '".$code."' ");
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
    
    public function saveSupplier(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try { 
            $datennow = date('Y-m-d H:i:s');
            $code = $this->input->post('code');
            $Nama_Spl = $this->input->post('Nama_Spl');
            $Address = $this->input->post('Address');
            $Phone = $this->input->post('Phone');
            $Fax = $this->input->post('Fax');
            $EMail = $this->input->post('EMail');
            $Contact = $this->input->post('Contact');
            $HP = $this->input->post('HP');
            $NPWP = $this->input->post('NPWP');
            $Tgl_NPWP = $this->input->post('Tgl_NPWP');
            $AccountNo = $this->input->post('AccountNo');
            $Inisial = $this->input->post('Inisial');
            $Company_Id = $this->input->post('Company_Id');
            $status = $this->input->post('status');
            
            $post = true;

            
            if($post){
                if($status=='tambah'){
                    $check = $this->spl->getSupplier(" where Kode_Spl = '$code' order by Kode_Spl limit 1");
                    if(count($check) > 0){
                        $response['status_json'] = false;
                        $response['remarks'] = "Kode sudah ada!"; 
                        $this->db->trans_rollback();
                    }else{
                        $dataInsert = array(
                            'Kode_Spl'      => $code,
                            'Nama_Spl'      => $Nama_Spl,
                            'Address'      => $Address,
                            'Phone'      => $Phone,
                            'Fax'      => $Fax,
                            'EMail'      => $EMail,
                            'Contact'      => $Contact,
                            'HP'      => $HP,
                            'NPWP'      => $NPWP,
                            'Tgl_NPWP'      => $Tgl_NPWP,
                            'AccountNo'      => $AccountNo,
                            'Inisial'      => $Inisial,
                            'Company_Id'      => $session['instansi_id'],
                        );
                        $this->ModelGeneral->InsertData('tbl_spl', $dataInsert);
                        $this->ModelGeneral->LogActivity('Process Insert New Supplier : '.$Nama_Spl);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully saved new data"; 
                    }
                }else{
                    $check = $this->spl->getSupplier(" where Kode_Spl = '$code' order by Kode_Spl limit 1");
                    if(count($check) > 0){
                        $dataInsert = array(
                            'Kode_Spl'      => $code,
                            'Nama_Spl'      => $Nama_Spl,
                            'Address'      => $Address,
                            'Phone'      => $Phone,
                            'Fax'      => $Fax,
                            'EMail'      => $EMail,
                            'Contact'      => $Contact,
                            'HP'      => $HP,
                            'NPWP'      => $NPWP,
                            'Tgl_NPWP'      => $Tgl_NPWP,
                            'AccountNo'      => $AccountNo,
                            'Inisial'      => $Inisial,
                            'Company_Id'      => $session['instansi_id'],
                        );
                        $this->ModelGeneral->UpdateData('tbl_spl', $dataInsert,array('Kode_Spl'=>$code));
                        $this->ModelGeneral->LogActivity('Process Update New Supplier : '.$Nama_Spl);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = "Successfully changed data"; 
                    }else{
                        $response['status_json'] = false;
                        $response['remarks'] = "Kode sudah ada!"; 
                        $this->db->trans_rollback();
                    }
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
    
    public function deleteSupplier(){
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
            $code = $this->input->post('code_hapus');
            
            $post = true;

            if($post){
                
                $this->ModelGeneral->DeleteData('tbl_spl', array('Kode_Spl'=>$code));
                $this->ModelGeneral->LogActivity('Process Delete Supplier : '.$code);
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
}