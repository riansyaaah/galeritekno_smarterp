<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bpjs extends CI_Controller
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
		$this->load->model('hrm/master/ModelBpjs', 'bpjs');
	}

	var $idMenu = "7b5e80a3-5a62-4e04-9fe0-a3407409c9aa";

	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");

		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Data Bpjs',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
		);

		$this->load->view('hrm/master/v_bpjs', $data);
	}
	public function getBpjs()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$bpjs_data = $this->bpjs->get_all();
		// $no = 1;
		foreach ($bpjs_data as $bpjs) {
			$kode = '"' . $bpjs['id'] . '"';
			$option = "
			<div class='text-center'>
             <a href='#' class='edit_record btn btn-info btn-sm' onclick='return edit(" . $kode . ")'><i class='fa fa-edit'></i> Edit</a></div>";
			$data[] = array(
				"bpjs_tk" => number_format($bpjs['bpjs_tk']),
				"bpjs_perusahaan" => number_format($bpjs['bpjs_perusahaan']),
				"bpjs_tk_percent" => $bpjs['bpjs_tk_percent'],
				"bpjs_kes_percent" => $bpjs['bpjs_kes_percent'],
				"updated_at" => $bpjs['updated_at'],
				"option" => $option,

			);
			// $no++;
		}
		if (count($bpjs_data) > 0) {
			$response['data'] = $data;
		} else {
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	function getBpjsById()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$code = $this->input->post('code');
			$status = $this->input->post('status');
			$check = $this->bpjs->get_by_id($code);
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

	public function saveBpjs()
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
			$code = $this->input->post('code');
			$bpjs_tk = $this->input->post('bpjs_tk');
			$bpjs_perusahaan = $this->input->post('bpjs_perusahaan');
			$bpjs_tk_percent = $this->input->post('bpjs_tk_percent');
			$bpjs_kes_percent = $this->input->post('bpjs_kes_percent');
			$status = $this->input->post('status');

			$post = true;


			if ($post) {
				if ($status == 'tambah') {
					$check = $this->bpjs->getBpjs(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$response['status_json'] = false;
						$response['remarks'] = "Kode sudah ada!";
						$this->db->trans_rollback();
					} else {
						$response['status_json'] = false;
						$response['remarks'] = "Error!";
						$this->db->trans_rollback();
					}
				} else {
					$check = $this->bpjs->getBpjs(" where id = '$code' order by id limit 1");
					if (count($check) > 0) {
						$dataUpdate = array(
							'id'				=> $code,
							'bpjs_tk'			=> $bpjs_tk,
							'bpjs_perusahaan'	=> $bpjs_perusahaan,
							'bpjs_tk_percent'	=> $bpjs_tk_percent,
							'bpjs_kes_percent'	=> $bpjs_kes_percent,
							'updated_at'    	=> date("Y-m-d H:i:s"),
						);
						$this->bpjs->update($code, $dataUpdate);
						$this->ModelGeneral->LogActivity('Process Update Data Bpjs');
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
}
