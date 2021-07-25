<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staffprofile extends CI_Controller
{

	function __Construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$this->load->helper(['form', 'url', 'date']);
		$this->load->model('auth/ModelLogin');
		$this->load->library('pdf');
		$this->load->model('ModelGeneral');
		$this->load->model('usermanagement/ModelUsers');
		$this->load->model('hrm/staffmanagement/ModelStaffProfile', 'model');
	}

	protected $idMenu = 'cd2d41f9-399c-48fa-aa30-520fffbf8fe5';

	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'datenow'       => date('d-m-Y'),
			'title'         => 'Staff Profile',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'   => $this->session->userdata('current_app'),
			'tipeFile'		=> $this->model->tipeFile(),
			'pendidikan'	=> $this->model->pendidikan()
		];

		$this->load->view('hrm/staffmanagement/staffprofile/index', $data);
	}

	public function getTipeFile()
	{
		$res = [
			'status_json'	=> true,
			'data'			=> $this->model->tipeFile()
		];
		cek_session($this->idMenu);
		header('Content-Type: application/json');
		echo json_encode($res);
	}

	public function getPendidikan()
	{
		$res = [
			'status_json'	=> true,
			'data'			=> $this->model->pendidikan()
		];
		cek_session($this->idMenu);
		header('Content-Type: application/json');
		echo json_encode($res);
	}

	public function getKontrak()
	{
		$res = [
			'status_json'	=> true,
			'data'			=> $this->ModelGeneral->getWhere('hrm_contracts', ['deleted_at' => null])->result_array()
		];
		cek_session($this->idMenu);
		header('Content-Type: application/json');
		echo json_encode($res);
	}

	public function getEmployee()
	{
		$id = $this->input->get('id');
		$res = [
			'status_json'	=> true,
			'data'			=> $this->model->getEmployee($id)
		];
		cek_session($this->idMenu);
		header('Content-Type: application/json');
		echo json_encode($res);
	}

	public function getPayroll()
	{
		$id = $this->input->get('id');
		$gapok = $this->model->getGapok($id);
		$tunjangan = $this->model->getTunjangan($id);
		for ($i = 0; $i < count($gapok); $i++) {
			$gapok[$i]['no'] = $i + 1;
			$gapok[$i]['insentif'] = $tunjangan['insentif'];
			$gapok[$i]['tunjangan'] = $tunjangan['tunjangan'];
			$gapok[$i]['total'] = $tunjangan['insentif'] + $tunjangan['tunjangan'] + $gapok[$i]['gapok'];
		}
		$res = [
			'status_json'	=> true,
			'data'			=> $gapok
		];
		header('Content-Type: application/json');
		echo json_encode($res);
	}

	public function getPayslip()
	{
		$id = $this->input->get('id');
		$gapok = $this->model->getGapok($id);
		for ($i = 0; $i < count($gapok); $i++) {
			$gapok[$i]['no'] = $i + 1;
			$gapok[$i]['btn'] = '<button class="btn btn-info btn-sm" onclick="download(' . $gapok[$i]['staff_id'] . ', ' . $gapok[$i]['year'] . ', ' . $gapok[$i]['month'] . ')"><i class="fas fa-download"></i> Download</button>';
			$gapok[$i]['month'] = date('F', mktime(0, 0, 0, $gapok[$i]['month']));
		}
		$res = [
			'status_json'	=> true,
			'data'			=> $gapok
		];
		header('Content-Type: application/json');
		echo json_encode($res);
	}

	public function cetakPayslip()
	{
		$input = $this->input;
		$form = [
			'staff_id'	=> $input->get('idStaff'),
			'tahun'		=> $input->get('tahun'),
			'bulan'		=> $input->get('bulan')
		];
		$paySlip = [];
		$gapok = $this->model->getGapokSlip($form['staff_id'], $form['tahun'] . $form['bulan']);
		$tunjangan = $this->model->getTunjanganSlip($form['staff_id']);
		$gapok['insentif'] = number_format($tunjangan['insentif'], 0, ',', '.');
		$gapok['tunjangan'] = number_format($tunjangan['tunjangan'], 0, ',', '.');
		$gapok['total'] = number_format($tunjangan['insentif'] + $tunjangan['tunjangan'] + $gapok['gapok'], 0, ',', '.');
		$gapok['gapok'] = number_format($gapok['gapok'], 0, ',', '.');
		$gapok['position'] = $tunjangan['position'];
		$gapok['department'] = $tunjangan['department'];
		$gapok['nama'] = $tunjangan['first_name'] . ' ' . $tunjangan['last_name'];
		$gapok['periode'] = date('F', mktime(0, 0, 0, $form['bulan'])) . ' ' . $form['tahun'];
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Payslip');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'PAYSLIP';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetAutoPageBreak(true, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$datax = [
			'i'			=> 1,
			'dataPrint'	=> $gapok
		];
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('/hrm/staffmanagement/staffprofile/print_payslip', $datax, true);
		$pdf->writeHTML($content, true, true, true, true, '');
		$pdf->Output('Payslip.pdf', 'I');
	}

	public function detailprofile()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Staff Profile',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);
		$this->load->view('hrm/staffmanagement/v_detailprofile', $data);
	}

	public function getStaffProfile()
	{
		cek_session($this->idMenu);
		$response = [];
		$response['status_json'] = true;
		$datas = $this->model->getStaffProfile("order by id");
		$no = 1;
		foreach ($datas as $d) {
			$data[] = [
				'no'			=> $no,
				'id'			=> $d['id_personel'],
				'photo'			=> '<img src="https://www.jing.fm/clipimg/full/190-1907810_rocket-raccoon-clipart-baby-groot-cute-chibi-marvel.png" width="75px" alt="">',
				'first_name'	=> $d['first_name'],
				'phone'			=> $d['phone'],
				'address'		=> $d['address'],
				'position_id'	=> $d['position'],
				'option'		=> '<button class="btn btn-warning btn-sm" onclick="detailPersonal(' . $d['id'] . ')"><i class="fa fa-user"></i> Personal</button> <button class="edit_record btn btn-danger btn-sm" onclick="detailEmployee(' . $d['id'] . ')"><i class="fas fa-user-tie"></i> Employment</button>'
			];
			$no++;
		}
		$response['data'] = (count($datas) > 0) ? $data : [];
		header("Content-Type: application/json");
		echo json_encode($response);
	}

	public function selectStaffProfile()
	{
		cek_session($this->idMenu);
		$response = [];
		$response['status_json'] = true;
		$datas = $this->model->selectStaffProfile();
		$no = 1;
		foreach ($datas as $d) {
			$data[] = [
				'no'			=> $no,
				'id'			=> $d['id_personel'],
				'photo'			=> '<img src="https://www.jing.fm/clipimg/full/190-1907810_rocket-raccoon-clipart-baby-groot-cute-chibi-marvel.png" width="75px" alt="">',
				'first_name'	=> $d['first_name'],
				'phone'			=> $d['phone'],
				'address'		=> $d['address'],
				'position_id'	=> $d['position'],
				'option'		=> '<button class="btn btn-warning btn-sm" onclick="detailPersonal(' . $d['id'] . ')"><i class="fa fa-user"></i> Personal</button> <button class="edit_record btn btn-danger btn-sm" onclick="detailEmployee(' . $d['id'] . ')"><i class="fas fa-user-tie"></i> Employment</button>'
			];
			$no++;
		}
		$response['data'] = (count($datas) > 0) ? $data : [];
		header("Content-Type: application/json");
		echo json_encode($response);
	}


	public function saveStaffProfile()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		// header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$datennow = date('Y-m-d H:i:s');
			$id = $input->get('code');
			$status = $input->get('status');
			$form = [
				'id_personel'		=> $input->get('id_personel'),
				'first_name'		=> $input->get('first_name'),
				'last_name'			=> $input->get('last_name'),
				'email'				=> $input->get('email'),
				'phone'				=> $input->get('phone'),
				'address'			=> $input->get('address'),
				'prov_id'			=> $input->get('prov_id'),
				'kab_id'			=> $input->get('kab_id'),
				'kec_id'			=> $input->get('kec_id'),
				'desa_id'			=> $input->get('desa_id'),
				'postal_code'		=> $input->get('postal_code'),
				'gender'			=> $input->get('gender'),
				'birth_place'		=> $input->get('birth_place'),
				'birth_day'			=> date('Y-m-d', strtotime($input->get('birth_day'))),
				'marital_status'	=> $input->get('marital_status'),
				'status'			=> $input->get('is_active'),
				'shift_id'			=> $input->get('shift_id'),
				'position_id'		=> $input->get('position_id'),
				'departement_id'	=> $input->get('departement_id'),
				'date_of_joining'	=> date('Y-m-d', strtotime($input->get('date_of_joining'))),
				'contract_id'		=> $input->get('contract_id'),
				'instansi_id'		=> $input->get('instansi_id'),
				'branch_id'			=> $input->get('branch_id')
			];
			$kontrak = $this->ModelGeneral->getWhere('hrm_contracts', ['id' => $form['contract_id']])->row_array();
			$gabung = strtotime($form['date_of_joining']);
			$akhir = ((60 * 60) * 24) * $kontrak['days'];
			$form['date_of_leaving'] = date('Y-m-d', $gabung + $akhir);
			$post = true;
			if ($post) {
				if ($status == 'add') {
					$check = $this->ModelGeneral->getWhere('hrm_staffprofile', ['id_personel' => $form['id_personel']])->num_rows();
					if ($check > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					} else {
						$this->ModelGeneral->InsertData('hrm_staffprofile', $form);
						$this->ModelGeneral->LogActivity('Process Insert Staff Profile : ' . $form['first_name']);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully saved new data";
					}
				} else {
					$check = $this->ModelGeneral->getWhere('hrm_staffprofile', ['id' => $id])->num_rows();;
					if ($check > 0) {
						$this->ModelGeneral->UpdateData('hrm_staffprofile', $form, ['id' => $id]);
						$this->ModelGeneral->LogActivity('Process Update Staff Profile : ' . $form['first_name']);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully changed data";
					} else {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					}
				}
			} else {
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

	function getStaffProfilebyid()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$id = $this->input->get('id');
			$check = $this->model->getDetailStaffProfileById($id);
			if ($check != null) {
				$response['data'] = $check;
			} else {
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

	// ===============================
	// Management Contacts
	// 
	public function getContactsByStaffId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$staff_id  = $this->input->post('staff_id');
		$contacts_data = $this->model->getStaffContacts($staff_id);
		$no = 1;
		foreach ($contacts_data as $contact) {
			$data[] = array(
				'no'		=> $no,
				'id'		=> $contact['id'],
				'name'		=> $contact['name'],
				'relation'	=> $contact['relation'],
				'email'		=> $contact['email'],
				'phone'		=> $contact['phone'],
				'option'	=> '<button class="btn btn-info btn-sm" onclick="editEmergencyContact(' . $contact['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="deleteEmergencyContact(' . $contact['id'] . ')"><i class="fa fa-trash"></i> Delete</button>'
			);
			$no++;
		}
		$response['data'] = (count($contacts_data) > 0) ? $data : [];
		echo json_encode($response);
	}

	public function getContactId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$id = $this->input->get('id');
			$check = $this->model->getContactById($id);
			if ($check != null) {
				$response['data'] = $check;
			} else {
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

	public function saveStaffEmergencyContact()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;

		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$input = $this->input;
			$id = $input->get('id');
			$staff_id = $input->get('staffEC');
			$status = $input->get('statusEC');
			$form = [
				'staff_id'  => $input->get('staffEC'),
				'name'   	=> htmlspecialchars($input->get('nameEC')),
				'relation'  => htmlspecialchars($input->get('relationEC')),
				'phone'     => htmlspecialchars($input->get('phoneEC')),
				'email'     => htmlspecialchars($input->get('emailEC')),
			];
			$post = true;
			if ($post) {
				if ($status == 'add') {
					$this->ModelGeneral->InsertData('hrm_staff_emergencycontacts', $form);
					$this->ModelGeneral->LogActivity('Process Insert Staff Emergecy Contact of : ' . $form['staff_id']);
					$this->db->trans_complete();
					$this->db->trans_commit();
					$response['remarks'] = 'Successfully saved new data';
				} else {
					$check = $this->model->getContactById($id);
					if (count($check) > 0) {
						$this->ModelGeneral->UpdateData('hrm_staff_emergencycontacts', $form, array('id' => $id));
						$this->ModelGeneral->LogActivity('Process Update StaffProfile : ' . $form['staff_id']);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully changed data";
					} else {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					}
				}
			} else {
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

	public function deleteItemContact()
	{
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
			$code = $this->input->get('id');
			$post = true;
			if ($post) {
				$this->ModelGeneral->DeleteData('hrm_staff_emergencycontacts', array('id' => $code));
				$this->ModelGeneral->LogActivity('Process Delete Position : ' . $code);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
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
	// 
	// End of Management Contacts
	// ===============================

	// ===============================
	// Management Documents
	// 
	public function getDocumentsByStaffId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$staff_id  = $this->input->post('staff_id');

		$documents_data = $this->model->getStaffDocuments($staff_id);

		$no = 1;
		foreach ($documents_data as $document) {
			$download = "<a target='_blank' href='" . base_url('uploads/staff_documents/') . $document['document_name'] . '.getDocumentId' . "' class='edit_record btn btn-info btn-sm' ><i class='fa fa-file'></i></a>";
			$data[] = array(
				"no" 			=> $no,
				"id" 			=> $document['id'],
				"type"			=> $document['document_type'],
				"name"			=> $document['document_name'],
				"description"	=> $document['description'],
				"url"			=> $download,
				"expired"		=> $document['expired_date'],
				"option" 		=> '<button class="btn btn-info btn-sm" onclick="editDocument(' . $document['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="deleteDocument(' . $document['id'] . ')"><i class="fa fa-trash"></i> Delete</button>'
			);
			$no++;
		}


		if (count($documents_data) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	public function getDocumentId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$id = $this->input->get('id');
			$check = $this->model->getDocumentById($id);
			if ($check != null) {
				$response['data'] = $check;
			} else {
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

	function upload()
	{
		$config['upload_path']          = FCPATH  . 'uploads\staff_documents';
		$config['allowed_types']        = 'gif|jpg|png|pdf|docx|txt';
		$config['max_size']             = 8000;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);

		$berkas = $this->upload->data("file_name");
		// $data['keterangan_berkas'] = $this->input->post('keterangan_berkas');
		// $data['tipe_berkas'] = $this->upload->data('file_ext');
		// $data['ukuran_berkas'] = $this->upload->data('file_size');
		return $this->upload->data("full_path" . $berkas);
		// $this->db->insert('tb_berkas', $data);
	}

	public function saveStaffDocument()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$input = $this->input;
			$id = $input->get('id');
			$status = $input->get('statusD');
			$form = [
				'staff_id'  		=> $input->get('staffD'),
				'document_type'   	=> htmlspecialchars($input->get('typeD')),
				'document_name'   	=> $this->upload(),
				'description'   	=> htmlspecialchars($input->get('descriptionD')),
				'document_url'   	=> $this->upload(),
				'expired_date'   	=> date("Y-m-d H:i:s", time() + (155520000 * 3))
			];
			$post = true;
			if ($post) {
				if ($status == 'add') {
					$form['uploaded_at'] = date("Y-m-d H:i:s");
					$this->ModelGeneral->InsertData('hrm_staff_documents', $form);
					$this->ModelGeneral->LogActivity('Process Insert Staff Document of : ' . $form['staff_id']);
					$this->db->trans_complete();
					$this->db->trans_commit();
					$response['remarks'] = "Successfully saved new data";
				} else {
					$check = $this->model->getDocumentById($id);
					if (count($check) > 0) {
						$form['updated_at'] = date("Y-m-d H:i:s");
						$this->ModelGeneral->UpdateData('hrm_staff_documents', $form, array('id' => $id));
						$this->ModelGeneral->LogActivity('Process Update Staff Document of : ' . $form['staff_id']);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully changed data";
					} else {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					}
				}
			} else {
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

	public function deleteItemDocument()
	{
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
			$code = $this->input->get('id');
			$post = true;
			if ($post) {

				$this->ModelGeneral->DeleteData('hrm_staff_documents', array('id' => $code));
				$this->ModelGeneral->LogActivity('Process Delete Document : ' . $code);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
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
	// 
	// End of Management Documents
	// ===============================


	// ===============================
	// Management Qualification
	// 
	public function getQualificationByStaffId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$staff_id  = $this->input->post('staff_id');
		$qualifications = $this->model->getStaffQualifications($staff_id);
		$no = 1;
		foreach ($qualifications as $qualification) {
			$data[] = array(
				'no'				=> $no,
				'id'				=> $qualification['id'],
				'school'			=> $qualification['school'],
				'education_level'	=> $qualification['education_level'],
				'major'				=> $qualification['major'],
				'periode'			=> $qualification['first_month'] . ' ' . $qualification['first_year'] . ' - ' . $qualification['last_month'] . ' ' . $qualification['last_year'],
				'option'			=> '<button class="btn btn-info btn-sm" onclick="editQualification(' . $qualification['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="deleteQualification(' . $qualification['id'] . ')"><i class="fa fa-trash"></i> Delete</button>'
			);
			$no++;
		}


		if (count($qualifications) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	public function saveStaffQualification()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		// header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$input = $this->input;
			$id = $input->get('id');
			$status = $input->get('statusQ');
			$form = [
				'staff_id'			=> $input->get('staffQ'),
				'school'			=> htmlspecialchars($input->get('schoolQ')),
				'education_level'	=> htmlspecialchars($input->get('educationLevelQ')),
				'first_month'		=> htmlspecialchars($input->get('firstMonthQ')),
				'first_year'		=> htmlspecialchars($input->get('firstYearQ')),
				'last_month'		=> htmlspecialchars($input->get('lastMonthQ')),
				'last_year'			=> htmlspecialchars($input->get('lastYearQ'))
			];
			$post = true;
			if ($post) {
				if ($status == 'add') {
					$this->ModelGeneral->InsertData('hrm_staff_qualifications', $form);
					$this->ModelGeneral->LogActivity('Process Insert Staff Qualification of : ' . $form['staff_id']);
					$this->db->trans_complete();
					$this->db->trans_commit();
					$response['remarks'] = "Successfully saved new data";
				} else {
					$check = $this->model->getQualificationById($id);
					if (count($check) > 0) {
						$this->ModelGeneral->UpdateData('hrm_staff_qualifications', $form, ['id' => $id]);
						$this->ModelGeneral->LogActivity('Process Update StaffProfile : ' . $form['staff_id']);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully changed data";
					} else {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					}
				}
			} else {
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

	public function getQualificationId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$id = $this->input->get('id');
			$check = $this->model->getQualificationById($id);
			if ($check != null) {
				$response['data'] = $check;
			} else {
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

	public function deleteItemQualification()
	{
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
			$code = $this->input->get('id');
			$post = true;
			if ($post) {
				$this->ModelGeneral->DeleteData('hrm_staff_qualifications', array('id' => $code));
				$this->ModelGeneral->LogActivity('Process Delete Qualification : ' . $code);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
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
	// 
	// End of Management Qualification
	// ===============================


	// ===============================
	// Management Experience
	// 
	public function getExperienceByStaffId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$staff_id  = $this->input->post('staff_id');

		$experiences = $this->model->getStaffExperiences($staff_id);

		$no = 1;
		foreach ($experiences as $experience) {
			$awal =  strtotime($experience['start_date']);
			$akhir =  strtotime($experience['finish_date']);
			$data[] = array(
				'no'			=> $no,
				'id'			=> $experience['id'],
				'company'		=> $experience['company'],
				'position'		=> $experience['position'],
				'periode'		=> $experience['start_date'] . ' - ' . $experience['finish_date'],
				'description'	=>  timespan($awal, $akhir, 2),
				'option'		=> '<button class="btn btn-info btn-sm" onclick="editExperience(' . $experience['id'] . ')"><i class="fa fa-edit"></i> Edit</buton> <button class="btn btn-danger btn-sm" onclick="deleteExperience(' . $experience['id'] . ')"><i class="fa fa-trash"></i> Delete</buton>'
			);
			$no++;
		}
		$response['data'] = (count($experiences) > 0) ? $data : [];
		echo json_encode($response);
	}

	public function saveStaffExperience()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$input = $this->input;
			$id = $input->get('id');
			$status = $input->get('statusE');
			$form = [
				'staff_id'		=> $input->get('staffE'),
				'company'		=> htmlspecialchars($input->get('companyE')),
				'start_date'	=> htmlspecialchars($input->get('startDateE')),
				'finish_date'	=> htmlspecialchars($input->get('finishDateE')),
				'position'		=> htmlspecialchars($input->get('positionE')),
				'description'	=> htmlspecialchars($input->get('descriptionE')),
			];
			$post = true;
			if ($post) {
				if ($status == 'add') {
					$this->ModelGeneral->InsertData('hrm_staffworkexperiences', $form);
					$this->ModelGeneral->LogActivity('Process Insert Staff Working Experience of : ' . $form['staff_id']);
					$this->db->trans_complete();
					$this->db->trans_commit();
					$response['remarks'] = "Successfully saved new data";
				} else {
					$check = $this->model->getExperienceById($id);
					if (count($check) > 0) {
						$this->ModelGeneral->UpdateData('hrm_staffworkexperiences', $form, ['id' => $id]);
						$this->ModelGeneral->LogActivity('Process Update StaffProfile : ' . $form['staff_id']);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = 'Successfully changed data';
					} else {
						$response['status_json'] = false;
						$response['remarks'] = 'Kode sudah ada!';
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
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	public function getExperienceId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$id = $this->input->get('id');
			$check = $this->model->getExperienceById($id);
			if ($check) {
				$response['data'] = $check;
			} else {
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

	public function deleteItemExperience()
	{
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
			$code = $this->input->get('id');
			$post = true;
			if ($post) {

				$this->ModelGeneral->DeleteData('hrm_staffworkexperiences', array('id' => $code));
				$this->ModelGeneral->LogActivity('Process Delete Experience : ' . $code);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
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
	// 
	// End of Management Experience
	// ===============================

	// ===============================
	// Management Bank Account
	// 
	public function getBankAccountByStaffId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$staff_id  = $this->input->post('staff_id');
		$BankAccounts = $this->model->getStaffBankAccounts($staff_id);
		$no = 1;
		foreach ($BankAccounts as $bankAccount) {
			$data[] = array(
				'no'			=> $no,
				'id'			=> $bankAccount['id'],
				'account_no' 	=> $bankAccount['account_no'],
				'bank_name' 	=> $bankAccount['bank_name'],
				'bank_code' 	=> $bankAccount['bank_code'],
				'bank_branch'	=> $bankAccount['bank_branch'],
				'option'		=> '<button class="btn btn-info btn-sm" onclick="editBankAccount(' . $bankAccount['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="deleteBankAccount(' . $bankAccount['id'] . ')"><i class="fa fa-trash"></i> Delete</button>'
			);
			$no++;
		}


		if (count($BankAccounts) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	public function getBankAccountId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$id = $this->input->get('id');
			$check = $this->model->getBankAccountById($id);
			if ($check != null) {
				$response['data'] = $check;
			} else {
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

	public function saveStaffBankAccount()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$input = $this->input;
			$id = $input->get('id');
			$status = $input->get('statusBA');
			$form = [
				'staff_id'		=> $input->get('staffBA'),
				'bank_name'		=> htmlspecialchars($input->get('nameBA')),
				'bank_code'		=> htmlspecialchars($input->get('codeBA')),
				'account_no'	=> htmlspecialchars($input->get('accountNoBA')),
				'bank_branch'	=> htmlspecialchars($input->get('branchBA'))
			];
			$post = true;
			if ($post) {
				if ($status == 'add') {
					$this->ModelGeneral->InsertData('hrm_staffbankaccount', $form);
					$this->ModelGeneral->LogActivity('Process Insert Staff Bank Account of : ' . $form['staff_id']);
					$this->db->trans_complete();
					$this->db->trans_commit();
					$response['remarks'] = "Successfully saved new data";
				} else {
					$check = $this->model->getBankAccountById($id);
					if (count($check) > 0) {
						$this->ModelGeneral->UpdateData('hrm_staffbankaccount', $form, ['id' => $id]);
						$this->ModelGeneral->LogActivity('Process Update Bank Account of : ' . $form['staff_id']);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully changed data";
					} else {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					}
				}
			} else {
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

	public function deleteItemBankAccount()
	{
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
			$code = $this->input->get('id');
			$post = true;
			if ($post) {

				$this->ModelGeneral->DeleteData('hrm_staffbankaccount', array('id' => $code));
				$this->ModelGeneral->LogActivity('Process Delete Bank Account : ' . $code);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
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
	// 
	// End of Bank Account
	// ===============================


	// ===============================
	// Management Family Member
	// 
	public function getFamilyMembersByStaffId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$staff_id  = $this->input->post('staff_id');
		$FamilyMembers = $this->model->getFamilyMembers($staff_id);
		$no = 1;
		foreach ($FamilyMembers as $familyMember) {
			$data[] = array(
				'no' 				=> $no,
				'id' 				=> $familyMember['id'],
				'name' 				=> $familyMember['name'],
				'status' 			=> $familyMember['family_status'],
				'birth_place_date'	=> $familyMember['birth_place'] . ', ' . $familyMember['birth_date'],
				'education_level'	=> $familyMember['education_level'],
				'profession' 		=> $familyMember['profession'],
				'option' 			=> '<button class="btn btn-info btn-sm" onclick="editFamilyMember(' . $familyMember['id'] . ')"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm" onclick="deleteFamilyMember(' . $familyMember['id'] . ')"><i class="fa fa-trash"></i> Delete</button>',
			);
			$no++;
		}
		$response['data'] = (count($FamilyMembers) > 0) ? $data : [];
		echo json_encode($response);
	}

	public function getFamilyMemberId()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$id = $this->input->get('id');
			$check = $this->model->getFamilyMembersById($id);
			if ($check != null) {
				$response['data'] = $check;
			} else {
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

	public function saveFamilyMember()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$input = $this->input;
			$id = $input->get('id');
			$status = $input->get('statusFM');
			$form = [
				'staff_id'			=> $input->get('staffFM'),
				'name'				=> htmlspecialchars($input->get('nameFM')),
				'family_status'		=> htmlspecialchars($input->get('familyStatusFM')),
				'birth_place'		=> htmlspecialchars($input->get('birthPlaceFM')),
				'birth_date'		=> htmlspecialchars($input->get('birthDateFM')),
				'profession'		=> htmlspecialchars($input->get('professionFM')),
				'education_level'	=> htmlspecialchars($input->get('educationLevelFM')),
				'created_at'		=> date('Y-m-d H:i:s'),
			];
			$post = true;
			if ($post) {
				if ($status == 'add') {
					$this->ModelGeneral->InsertData('hrm_staff_families', $form);
					$this->ModelGeneral->LogActivity('Process Insert Staff Family Member of : ' . $form['staff_id']);
					$this->db->trans_complete();
					$this->db->trans_commit();
					$response['remarks'] = "Successfully saved new data";
				} else {
					$check = $this->model->getBankAccountById($id);
					if (count($check) > 0) {
						$this->ModelGeneral->UpdateData('hrm_staff_families', $form, ['id' => $id]);
						$this->ModelGeneral->LogActivity('Process Update Family Member of : ' . $form['staff_id']);
						$this->db->trans_complete();
						$this->db->trans_commit();
						$response['remarks'] = "Successfully changed data";
					} else {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					}
				}
			} else {
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

	public function deleteItemFamilyMember()
	{
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
			$code = $this->input->get('id');
			$post = true;
			if ($post) {
				$this->ModelGeneral->DeleteData('hrm_staff_families', array('id' => $code));
				$this->ModelGeneral->LogActivity('Process Delete Family Member : ' . $code);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
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
	// 
	// End of Family Member
	// ===============================


	function getProvinces()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil";
		$search = $this->input->get('search');
		$orderby = "name";
		$where = " WHERE (id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%') ";
		$data = $this->model->getProvincesSelect2($where, $orderby);
		$response['data'] = $data;
		echo json_encode($response);
	}

	function getRegencies()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil";
		$search = $this->input->get('search');
		$prov_id = $this->input->get('prov_id');
		$orderby = "name";
		$where = " WHERE (name LIKE '%" . $search . "%' AND province_id = '" . $prov_id . "' ) ";
		$data = $this->model->getRegenciesSelect2($where, $orderby);
		$response['data'] = $data;
		echo json_encode($response);
	}

	function getDistricts()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil";
		$search = $this->input->get('search');
		$kab_id = $this->input->get('kab_id');
		$orderby = "name";
		$where = " WHERE (name LIKE '%" . $search . "%' AND regency_id = '" . $kab_id . "' ) ";
		$data = $this->model->getDistrictsSelect2($where, $orderby);
		$response['data'] = $data;
		echo json_encode($response);
	}

	function getVillages()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil";
		$search = $this->input->get('search');
		$kec_id = $this->input->get('kec_id');
		$orderby = "name";
		$where = " WHERE (name LIKE '%" . $search . "%' AND district_id = '" . $kec_id . "' ) ";
		$data = $this->model->getVillagesSelect2($where, $orderby);
		$response['data'] = $data;
		echo json_encode($response);
	}

	function getShift()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil";
		$search = $this->input->get('search');
		$orderby = " shift ASC";
		$where = " WHERE shift LIKE '%" . $search . "%' ";
		$data = $this->model->getShiftSelect2($where, $orderby);
		$response['data'] = $data;
		echo json_encode($response);
	}

	function getDesignation()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil";
		$search = $this->input->get('search');
		$orderby = " designation ASC";
		$where = " WHERE designation LIKE '%" . $search . "%' ";
		$data = $this->model->getDesignationSelect2($where, $orderby);
		$response['data'] = $data;
		echo json_encode($response);
	}

	function getPosition()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil";
		$search = $this->input->get('search');
		$orderby = " position ASC";
		$where = " WHERE position LIKE '%" . $search . "%' ";
		$data = $this->model->getPositionSelect2($where, $orderby);
		$response['data'] = $data;
		echo json_encode($response);
	}

	function getDepartement()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil";
		$search = $this->input->get('search');
		$orderby = " department ASC";
		$where = " WHERE department LIKE '%" . $search . "%' ";
		$data = $this->model->getDepartementSelect2($where, $orderby);
		$response['data'] = $data;
		echo json_encode($response);
	}


	function getInstansi()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil";
		$search = $this->input->get('search');
		$orderby = " nama_instansi ASC";
		$where = " WHERE nama_instansi LIKE '%" . $search . "%' ";
		$data = $this->model->getInstansiSelect2($where, $orderby);
		$response['data'] = $data;
		echo json_encode($response);
	}

	function getBranch()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil";
		$search = $this->input->get('search');
		$instansi_id = $this->input->get('instansi_id');
		// $orderby = " nama_branch ASC";
		// $where = " WHERE nama_branch LIKE '%" . $search . "%' AND instansi_id = '" . $instansi_id . "' ";
		// $data = $this->model->getBranchSelect2($where, $orderby);
		$data = $this->model->getBranchSelect2();
		$response['data'] = $data;
		echo json_encode($response);
	}


	public function detailSallary()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");

		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Detail Sallary',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);

		$this->load->view('hrm/staffmanagement/v_detailsallary', $data);
	}
}
