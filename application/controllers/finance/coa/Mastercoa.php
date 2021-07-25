<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mastercoa extends CI_Controller
{

	function __Construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$this->load->helper(array('form', 'url'));
		$this->load->model('auth/ModelLogin');
		$this->load->model('ModelGeneral');
		$this->load->model('finance/coa/ModelMastercoa');
	}

	var $idMenu = "49139c22-1460-43f9-bccf-a3e484026f49";

	public function index()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date("Y-m-d");
		$data = array(
			'datenow'       => date("d-m-Y", strtotime($date)),
			'title'         => 'Master of COA',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
			'getcoa'        => $this->ModelMastercoa->getMasterCOA(" order by AccountNo asc "),
		);
		$this->load->view('finance/coa/v_mastercoa', $data);
	}

	function getMasterCoa()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$AccountNo = $this->input->post('AccountNo');
			$check = $this->ModelMastercoa->getMasterCOA(" WHERE AccountNo = '" . $AccountNo . "' ");
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
	function PreviewCOA()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
			$check = $this->ModelMastercoa->getMasterCOA("ORDER BY `AccountNo` ASC
");
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
	public function Additem()
	{
         $ThnActive   = $this->ModelMastercoa->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil menyimpan Account Baru";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$AccountParrent = $this->input->post('AccountParrent');
			$AccountName = $this->input->post('AccountName');
			$Level = $this->input->post('Level');
			$DrCr = $this->input->post('DrCr');
			$InBS = $this->input->post('InBS');

			$post = true;

			$item = $this->ModelMastercoa->getMasterCOA(" where AccountParrent = '$AccountParrent' order by AccountNo desc limit 1");
            if ($Level == 'TYPE') {
				if (isset($item[0]['AccountNo']) == '') {
					$newNo = "1000";
				} else {
					$newNo = str_replace("0", "", $item[0]['AccountNo']);
					$newNo = (intval($newNo) + 1);
					$newNo = str_pad($newNo, 4, "0", STR_PAD_RIGHT);
				}
			}
			if ($Level == 'GROUP') {
				$ParrentNo = str_replace("0", "", $AccountParrent);
				if (isset($item[0]['AccountNo']) == '') {
					$newNo = $ParrentNo . intval(1);
					$newNo = str_pad($newNo, 4, "0", STR_PAD_RIGHT);
				} else {
					$newNo = str_replace("0", "", $item[0]['AccountNo']);
					$newNo = (intval($newNo) + 1);
					$newNo = str_pad($newNo, 4, "0", STR_PAD_RIGHT);
				}
			}
			if ($Level == 'SGROUP') {
				if (isset($item[0]['AccountNo']) == '') {
					$newNo = $AccountParrent . intval(1);
				} else {
					$newNo = $AccountParrent . (intval(substr($item[0]['AccountNo'], -1)) + 1);
				}
			}
			if ($Level == 'CODE') {
				if (isset($item[0]['AccountNo']) == '') {
					$newNo = $AccountParrent . intval(1);
				} else {
					$newNo = $AccountParrent . (intval(substr($item[0]['AccountNo'], -1)) + 1);
				}
			}
			if ($Level == 'MASTER') {
				if (isset($item[0]['AccountNo']) == "") {
					$newNo = intval(1);
					$newNo = $AccountParrent . str_pad($newNo, 16, "0", STR_PAD_LEFT);
				} else {
					$newNo = (intval(substr($item[0]['AccountNo'], -5)) + 1);
					$newNo = $AccountParrent . str_pad($newNo, 16, "0", STR_PAD_LEFT);
				}
			}

			if ($post) {
				$dataInsert = array(
					'AccountNo'      => $newNo,
					'AccountParrent' => $AccountParrent,
					'AccountName'       => $AccountName,
					'Level'       => $Level,
					'DrCr'       => $DrCr,
					'InBS'       => $InBS,
					'branch_id' => $session['branch_id'],
					'instansi_id' => $session['instansi_id'],
				);
				$this->ModelGeneral->InsertData('fin_mastercoa', $dataInsert);
				if ($Level == 'MASTER') {
                    $dataInsertAB = array(
					'ActivePeriode'      => $thn,
					'AccountNo'      => $newNo,
					'AccountParrent' => $AccountParrent,
					'AccountName'       => $AccountName,
					'Level'       => $Level,
					'DrCr'       => $DrCr,
					'InBS'       => $InBS,
					'branch_id' => $session['branch_id'],
					'instansi_id' => $session['instansi_id'],
				);
					$this->ModelGeneral->InsertData('fin_accountbalance', $dataInsertAB);
				}
				$this->ModelGeneral->LogActivity('Process Insert New Account Item : ' . $AccountName);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Nomor urut atau nama modul sudah ada!";
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


	public function Edititem()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil merubah Account";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$AccountNo = $this->input->post('AccountNo');
			$AccountName = $this->input->post('AccountName');
			$Level = $this->input->post('Level');
			$DrCr = $this->input->post('DrCr');
			$InBS = $this->input->post('InBS');

			$post = true;
			if ($post) {
				$dataInsert = array(
					'AccountName'       => $AccountName,
					'DrCr'       => $DrCr,
					'InBS'       => $InBS,
					'branch_id' => $session['branch_id'],
					'instansi_id' => $session['instansi_id'],
				);
				$this->ModelGeneral->UpdateData('fin_mastercoa', $dataInsert, array('AccountNo' => $AccountNo));
				if ($Level == 'MASTER') {
					$this->ModelGeneral->UpdateData('fin_accountbalance', $dataInsert, array('AccountNo' => $AccountNo));
				}
				$this->ModelGeneral->LogActivity('Process Update Account Item : ' . $AccountName);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Nomor urut atau nama modul sudah ada!";
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
	public function Deleteitem()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil menghapus Account ";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$AccountNo = $this->input->post('AccountNo');

			$post = true;
			if ($post) {

				$this->ModelGeneral->DeleteData('fin_mastercoa', array('AccountNo' => $AccountNo));
				$this->ModelGeneral->DeleteData('fin_accountbalance', array('AccountNo' => $AccountNo));
				$this->ModelGeneral->LogActivity('Process Delete Account Item : ' . $AccountNo);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Nomor urut atau nama modul sudah ada!";
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

	/*public function GenerateAccountBalance()
	{
		$ThnActive   = $this->ModelMastercoa->getPeriode();
		$thn = $ThnActive[0]['ThnBln'];


		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Generate Opening Balance Account";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);

		try {
			$datennow = date('Y-m-d H:i:s');
			$AccountParrent = $this->input->post('AccountParrent');
			$AccountName = $this->input->post('AccountName');
			$Level = $this->input->post('Level');

			$post = true;

			$item = $this->ModelMastercoa->getActivePeriodeOB(" where ActivePeriode = '$thn' limit 1");

			if (isset($item[0]['ActivePeriode']) == "") {
				if ($post) {
					$this->ModelMastercoa->GenerateAccountBalance($thn);
					$this->ModelGeneral->LogActivity('Process Generate Opening Balance Account Periode : ' . $thn);
					$this->db->trans_complete();
					$this->db->trans_commit();
				} else {
					$response['status_json'] = false;
					$response['remarks'] = "Nomor urut atau nama modul sudah ada!";
					$this->db->trans_rollback();
				}
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "Periode Ini Sudah Pernah DI Generate!";
				$this->db->trans_rollback();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}*/

	public function print()
	{
		// cek_session($this->idMenu);
		// $session = $this->session->userdata('login');
		// $sessionCurrentApp = $this->session->userdata('current_app');
		// $sessionApplications = $this->session->userdata('applications');
		// $date = date("Y-m-d");
		// $test = $this->ModelMastercoa->getMasterCOA(" order by AccountNo asc ");
		// var_dump($test);
		// die;
		$data = array(
			'coa_data'        => $this->ModelMastercoa->getMasterCOA(" ORDER BY AccountNo ASC "),
		);
		$this->load->view('finance/coa/print/print_mastercoa', $data);
	}
}
