<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tokoecommerce extends CI_Controller {
	public function __construct() {
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(['form', 'url']);
        $this->load->model('ModelGeneral', 'mg');
        $this->load->model('inventory/masterdata/ModelTokoEcommerce', 'mte');
	}
	protected $idMenu = 'ae24b056-025d-4f2b-9b7c-a0de047f0b46';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
        $data = [
            'datenow'       => date('d-m-Y', strtotime(date('Y-m-d'))),
            'title'         => 'Daftar Toko E-Commerce',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $this->session->userdata('applications'),
            'current_app'   => $this->session->userdata('current_app'),
            'ecommerce'     => $this->mg->getAll('inv_ecommerce')->result_array()
        ];
        $this->load->view('inventory/masterdata/v_tokoecommerce', $data);
	}
    public function getToko() {
        $id = $this->input->get('id');
        if($id) {
            $res['data'] = $this->mte->getToko($id);
        } else {
            $res['data'] = $this->mte->getAllToko();
            for($i=0; $i<count($res['data']); $i++) {
                $res['data'][$i]['ecommerce'] = $res['data'][$i]['nama_ecommerce'].' {'.$res['data'][$i]['inisial'].')';
                $res['data'][$i]['no'] = $i+1;
                $res['data'][$i]['btn'] = '<a target="_blank" href="'.$res['data'][$i]['url'].'" class="btn btn-success btn-sm"><i class="fa fa-external-link"></i> Open</a> <button type="button" class="btn btn-info btn-sm" onclick="edit('.$res['data'][$i]['id'].')"><i class="fa fa-edit"></i> Edit</button> <button type="button" class="btn btn-danger btn-sm" onclick="hapus('.$res['data'][$i]['id'].')"><i class="fa fa-trash"></i> Hapus</button>';
            }
        }
        $res['status_json'] = true;
        cek_session($this->idMenu);
        header('Content-Type: application/json');
        echo json_encode($res);
    }
    private function _cariKodeToko($inisial) {
        $cek = $this->mte->getKodeToko($inisial);
        if ($cek[0]['kode_toko'] == '') {
            $kodeToko = '001';
        } else {
            $nomor = intval($cek[0]['kode_toko'])+1;
            $kodeToko = str_pad($nomor, 3, '0', STR_PAD_LEFT);;
        }
        $kodeToko = $inisial.$kodeToko;
        return $kodeToko;
    }
    public function simpan(){
        cek_session($this->idMenu);
        header('Content-Type: application/json');
        $response = [];
        $response['status_json'] = true;
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
            $input = $this->input;
            $type = $input->get('type');
            $form = [
                'id_ecommerce'  => $input->get('idEcommerce'),
                'nama_toko'     => htmlspecialchars($input->get('namaToko')),
                'url'           => htmlspecialchars($input->get('url'))
            ];
            $ecommerce = $this->mg->getWhere('inv_ecommerce', ['id' => $form['id_ecommerce']])->row_array();
            $post = true;
            if($post){
                if($type == 1) {
                    $check = $this->mg->getWhere('inv_toko_ecommerce', $form)->row_array();
                    if($check) {
                        $response['status_json'] = false;
                        $response['remarks'] = 'Toko E-Commerce telah terdaftar';
                        $this->db->trans_rollback();
                    } else {
                        $form['kode_toko'] = $this->_cariKodeToko($ecommerce['inisial']);
                        $this->mg->InsertData('inv_toko_ecommerce', $form);
                        $this->mg->LogActivity('Process Insert New E-Commerce Seller : '.$form['nama_toko']);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = 'Successfully saved new data'; 
                    }
                } else {
                    $id = $this->input->get('id');
                    $check = $this->mg->getWhere('inv_toko_ecommerce', ['id' => $id])->row_array();
                    if($check) {
                        $form['kode_toko'] = ($form['id_ecommerce'] != $check['id_ecommerce'])? $this->_cariKodeToko($ecommerce['inisial']) : $check['kode_toko'];
                        $this->mg->UpdateData('inv_toko_ecommerce', $form, ['id' => $id]);
                        $this->mg->LogActivity('Process Update New E-Commerce : '.$form['nama_toko']);
                        $this->db->trans_complete();
                        $this->db->trans_commit();
                        $response['remarks'] = 'Successfully changed data'; 
                    } else {
                        $response['status_json'] = false;
                        $response['remarks'] = 'E-Commerce tidak ditemukan!'; 
                        $this->db->trans_rollback();
                    }
                }
            } else {
                $response['status_json'] = false;
                $response['remarks'] = 'Unable to save new data'; 
                $this->db->trans_rollback();
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->mg->LogError(current_url(),  $e->getMessage());
        }
        echo json_encode($response);
    }
    public function hapus() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header('Content-Type: application/json');
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = 'Successfully deleted data'; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try { 
            $datennow = date('Y-m-d H:i:s');
            $id = $this->input->get('id');
            $post = true;
            if($post) {
                $this->ModelGeneral->DeleteData('inv_toko_ecommerce', ['id' => $id]);
                $this->ModelGeneral->LogActivity('Process Delete Toko E-Commerce : '.$id);
                $this->db->trans_complete();
                $this->db->trans_commit();  
            }else{
                $response['status_json'] = false;
                $response['remarks'] = 'number or name is already exists'; 
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