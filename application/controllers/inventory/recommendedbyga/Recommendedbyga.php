<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Recommendedbyga extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['form', 'url']);
		$this->load->library('pdf');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('inventory/recommendedbyga/ModelRecommendedByGA', 'model');
	}
	protected $idMenu = '29c5dc88-26b1-4bda-ab1b-c7aa42e7c554';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'Recommended By GA',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'periode'		=> $this->mg->getWhere('periode', ['Active' => 1])->row_array()['ThnBln']
		];
		$this->load->view('inventory/recommendedbyga/recommendedbyga/index', $data);
	}
	private function _json($statusJson, $data, $remarks = '') {
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> $statusJson,
			'data'			=> $data,
			'remarks'		=> $remarks
		]);
	}
	public function generateNoRecommend() {
		cek_session($this->idMenu);
		$periode   = $this->mg->getWhere('periode', ['Active' => 1])->row_array()['ThnBln'];
		$noRecommend = '/RGA/'.$periode;
		$cek = $this->model->getRequest($noRecommend);
		if ($cek[0]['noRecommend'] == '') {
			$data['noPO'] = '001';
		} else {
			$nomor = intval($cek[0]['noRecommend']) + 1;
			$data['noPO'] = str_pad($nomor, 3, '0', STR_PAD_LEFT);;
		}
		json($data['noPO'].$noRecommend);
	}
	public function getRecommend() {
		cek_session($this->idMenu);
		$id = $this->input->get('id');
		$data = ($id)? $this->mg->getWhere('inv_recommend', ['id' => $id])->row_array() : $this->model->getAllRecommend();
		json($data);
	}
	public function getDetail() {
		cek_session($this->idMenu);
		$input = $this->input;
		$id = $input->get('id');
		$noRecommend = ($input->get('noRecommend'))? $input->get('noRecommend') : $input->post('noRecommend');
		$data = ($id)? $this->mg->getWhere('inv_recommend_detail', ['id' => $id])->row_array() : $this->model->getAllDetail($noRecommend);
		json($data);
	}
	public function saveRecommend() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$form = [
				'noRecommend'	=> $input->get('noRecommend'),
				'tglRecommend'	=> $input->get('tglRecommend'),
				'createdBy'		=> $this->session->userdata('login')['user_id']
			];
			$cek = $this->mg->getWhere('inv_recommend', ['noRecommend' => $form['noRecommend']])->num_rows();
			if($cek) {
				$statusJson = false;
				$remarks = 'Data telah terdaftar';
				$this->db->trans_rollback();
			} else {
				$this->mg->InsertData('inv_recommend', $form);
				$this->mg->LogActivity('Process Save Recommend : '.$form['noRecommend']);
				$statusJson = true;
				$remarks = 'Berhasil menambahkan data';
			}
			$this->db->trans_complete();
			$this->db->trans_commit();
		} catch (\Throwable $e) {
			$statusJson = false;
			$remarks = $e->getMessage();
			$this->db->trans_rollback();
			$this->mg->LogError(current_url(),  $e->getMessage());
		}
		json('', $statusJson, $remarks);
	}
	public function saveDetail() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$idDetail = $input->get('idDetail');
			$status = $input->get('status');
			$noRecommend = $input->get('noRecommend');
			$recommend = $this->mg->getWhere('inv_recommend', ['noRecommend' => $noRecommend])->row_array();
			$form = [
				'idRecommend'	=> $recommend['id'],
				'namaToko'		=> $input->get('namaToko'),
				'namaProduk'	=> $input->get('namaProduk'),
				'lokasi'		=> $input->get('lokasi'),
				'bonus'			=> $input->get('bonus'),
				'warna'			=> $input->get('warna'),
				'ukuran'		=> $input->get('ukuran'),
				'kelengkapan'	=> $input->get('kelengkapan'),
				'hargaSatuan'	=> $input->get('hargaSatuan'),
				'ongkir'		=> $input->get('ongkir'),
				'estimasi'		=> $input->get('estimasi')
			];
			$cek = $this->mg->getWhere('inv_recommend_detail', [
				'namaToko'		=> $form['namaToko'],
				'namaProduk'	=> $form['namaProduk']
			])->row_array();
			if($status == 1) {
				$cek = $this->mg->getWhere('inv_recommend_detail', [
					'namaToko'		=> $form['namaToko'],
					'namaProduk'	=> $form['namaProduk']
				])->row_array();
				if($cek) {
					$statusJson = false;
					$remarks = 'Data telah terdaftar';
					$this->db->trans_rollback();
				} else {
					$this->mg->InsertData('inv_recommend_detail', $form);
					$this->mg->LogActivity('Process Add Detail Recommend : '.$noRecommend);
					$statusJson = true;
					$remarks = 'Berhasil menambahkan data';
				}
			} else {
				$cek = $this->mg->getWhere('inv_recommend_detail', ['id' => $idDetail])->row_array();
				if(!$cek) {
					$statusJson = false;
					$remarks = 'Data belum terdaftar';
					$this->db->trans_rollback();
				} else {
					$this->mg->UpdateData('inv_recommend_detail', $form, ['id' => $idDetail]);
					$this->mg->LogActivity('Process Edit Detail Recommend : '.$noRecommend);
					$statusJson = true;
					$remarks = 'Berhasil menambahkan data';
				}
			}
			$this->db->trans_complete();
			$this->db->trans_commit();
		} catch (\Throwable $e) {
			$statusJson = false;
			$remarks = $e->getMessage();
			$this->db->trans_rollback();
			$this->mg->LogError(current_url(),  $e->getMessage());
		}
		json('', $statusJson, $remarks);
	}
	public function hapus() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$id = $this->input->get('id');
			$cek = $this->mg->getWhere('inv_recommend_detail', ['id' => $id])->row_array();
			if(!$cek) {
				$statusJson = false;
				$remarks = 'Data telah terdaftar';
				$this->db->trans_rollback();
			} else {
				$this->mg->DeleteData('inv_recommend_detail', ['id' => $cek['id']]);
				$this->mg->LogActivity('Process Delete Detail Recommend : '.$cek['id']);
				$statusJson = true;
				$remarks = 'Berhasil menghapus data';
			}
			$this->db->trans_complete();
			$this->db->trans_commit();
		} catch (\Throwable $e) {
			$statusJson = false;
			$remarks = $e->getMessage();
			$this->db->trans_rollback();
			$this->mg->LogError(current_url(),  $e->getMessage());
		}
		json('', $statusJson, $remarks);
	}
	public function addAplikasi(){
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = 'Berhasil menyimpan gambar'; 
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
        	$input = $this->input;
            $noRecommend = $input->post('noRecommend');
            $fileGambar = $_FILES['gambar']['name'];
            $file_ext = pathinfo($fileGambar, PATHINFO_EXTENSION);

			// $filefoto = $_FILES["icon"]['name'];
			// $file_ext = pathinfo($filefoto,PATHINFO_EXTENSION);

            $post = true;
            $cek = $this->mg->getWhere('inv_recommend', ['noRecommend' => $noRecommend])->row_array();
            if(!$cek) {
            	$post = false;
                $remarks = 'No rekomendasi tidak terdaftar';
            }
            if($file_ext != 'jpg' AND $file_ext != 'png' AND $file_ext != 'jpeg'){
                $post = false;
                $remarks = 'Gambar harus berformat jpg|png|jpeg';
            }
            if($post) {
                // $application_id = genUuid();
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
                    $this->mg->InsertData('applications', $dataInsert);
                    $this->mg->LogActivity('Process Insert New Application '.$application_id.' URL : '.current_url());
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
            $this->mg->LogError(current_url(),  $e->getMessage());
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function print() {
		cek_session($this->idMenu);
        $pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Berita Acara Hasil Perbandingan');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Berita Acara Hasil Perbandingan';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetAutoPageBreak(true, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$noRecommend  = $this->input->get('noRecommend');
		$recommend = $this->mg->getWhere('inv_recommend', ['noRecommend' => $noRecommend])->row_array();
		$recommend['detail'] = $this->mg->getWhere('inv_recommend_detail', ['idRecommend' => $recommend['id']])->result_array();
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('inventory/recommendedbyga/recommendedbyga/print', [
			'i'		=> 1,
			'data'	=> $recommend
		], true);
		$pdf->writeHTML($content, true, true, true, true, '');
		$pdf->Output('Berita Acara Hasil Perbandingan.pdf', 'I');
    }
}