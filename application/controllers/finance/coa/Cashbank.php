<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cashbank extends CI_Controller {
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		$this->load->helper(array('form', 'url'));
		$this->load->model('auth/ModelLogin');
		$this->load->model('ModelGeneral');
		$this->load->model('usermanagement/ModelUsers');
		$this->load->model('finance/coa/ModelCashbank');
	}
	var $idMenu = 'b351c0f8-7c6e-4fb4-b04b-970e4da09c8d';
	public function index() {
		$ThnActive   = $this->ModelCashbank->getPeriode();
		$thn = $ThnActive[0]['ThnBln'];
		$currencies   = $this->ModelCashbank->getValuta();
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$sessionCurrentApp = $this->session->userdata('current_app');
		$sessionApplications = $this->session->userdata('applications');
		$date = date('Y-m-d');
		$data = [
			'datenow'       => date('d-m-Y', strtotime($date)),
			'title'         => 'Cash and Bank',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $sessionApplications,
			'current_app'   => $sessionCurrentApp,
			'currencies'    => $currencies,
			'PeriodeActive'	=> $thn,
			'columnSelect'	=> $this->ModelCashbank->columnSelect()
		];
		$this->load->view('finance/coa/v_cashbank', $data);
	}
	public function getAccountNo() {
		$ThnActive   = $this->ModelCashbank->getPeriode();
		$thn = $ThnActive[0]['ThnBln'];
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$datas = $this->ModelCashbank->getAccountNo("WHERE ActivePeriode = '$thn' AND AccountNo NOT IN (SELECT AccountNo FROM fin_cashbank) order by AccountNo");
        $no = 1;
		foreach ($datas as $d) {
			$option = '<button type="button" class="edit_record btn btn-info btn-sm"><i class="fas fa-check"></i></button>';
			$data[] = [
                'no'			=> $no++,
				'AccountNo'		=> $d['AccountNo'],
				'AccountName'	=> $d['AccountName'],
				'Debit'			=> number_format($d['Debit'], 0, '', '.'),
				'option'		=> $option,
			];
		}
		$response['data'] = $data;
		echo json_encode($response);
	}
	public function getCashBank() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header('Content-Type: application/json');
		$response = [];
		$response['status_json'] = true;
		$datas = $this->ModelCashbank->getCashBank('ORDER BY BankCode');
		$no = 1;
		foreach ($datas as $d) {
			$data[] = [
				'no'			=> $no++,
				'type'			=> $d['TypeCashbank'],
				'code'			=> $d['BankCode'],
				'description'	=> $d['BankName'],
				'bankaccount'	=> $d['BankAccount'],
				'accountno'		=> $d['AccountNo'],
				'valuta'		=> $d['Valuta'],
				'saldo'			=> number_format($d['AvailableSaldo'], 0, '', '.'),
				'edit'			=> '<button type="button" class="edit_record btn btn-info btn-sm" onclick="return editCashbank(\''.$d['BankCode'].'\')"><i class="fa fa-edit"></i>&nbsp;Edit</a></button>',
				'hapus'			=> '<button type="button" class="edit_record btn btn-danger btn-sm" onclick="return hapusCashbank(\''.$d['BankCode'].'\')"> <i class="fa fa-trash"></i>&nbsp;Hapus</a></button>'
			];
		}
		$response['data'] = (count($datas) > 0)? $data : [];
		echo json_encode($response);
	}

	function getCashbankSaldo() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = 'Berhasil get data';
		$ThnActive   = $this->ModelCashbank->getPeriode();
		$thn = $ThnActive[0]['ThnBln'];
		try {
			$code = $this->input->post('code');
			$check = $this->ModelCashbank->getCashbankSaldo(" WHERE BankCode = '" . $code . "' and ActivePeriode = '$thn' ");
			if (!$check) {
				$response['data'] = $check;
			} else {
				$data[] = [
					'TypeCashbank'	=> '',
					'BankCode'		=> '',
					'BankName'		=> '',
					'BankAccount'	=> '',
					'AccountNo'		=> '',
					'AccountName'	=> '',
					'Valuta'		=> '',
					'ActivePeriode'	=> '',
					'Saldo'			=> ''
				];
				$response['data'] = $data;
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}

	public function saOpeningBalance() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$sa_periode = $this->input->post('sa_periode');
			$sa_code = $this->input->post('sa_code');
			$sa_amount = $this->input->post('sa_amount');
			$post = true;
			if ($post) {
				if($sa_periode != '') {
					$dataInsert = [
						'BankCode'		=> $sa_code,
						'ActivePeriode'	=> $sa_periode,
						'Saldo'			=> $sa_amount,
					];
					$this->ModelGeneral->UpdateData('fin_cashbank_saldo', $dataInsert, array(
						'BankCode'		=> $sa_code,
						'ActivePeriode'	=> $sa_periode
					));
					$response['remarks'] = 'Berhasil mengupdate Bank ';
				} else {
					$ThnActive   = $this->ModelCashbank->getPeriode();
					$thn = $ThnActive[0]['ThnBln'];
					$dataInsert = [
						'BankCode'		=> $sa_code,
						'ActivePeriode'	=> $thn,
						'Saldo'			=> $sa_amount,
					];
					$this->ModelGeneral->InsertData('fin_cashbank_saldo', $dataInsert);
					$response['remarks'] = 'Berhasil Menyimpan Bank';
				}
				$this->ModelGeneral->LogActivity("Process Update Opening Balance : $sa_code - $sa_periode");
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = 'Nomor urut atau nama modul sudah ada!';
				$this->db->trans_rollback();
			}
		} catch(\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
	function getCashbankbyid() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = 'Berhasil get data';
		try {
			$code = $this->input->post('code');
			$check = $this->ModelCashbank->getCashBankbyId(" WHERE BankCode = '" . $code . "' ");
			if ($check != null) {
				$check[0]['AvailableSaldo'] = number_format($check[0]['AvailableSaldo'], 0, '', '.');
				$response['data'] = $check;
			} else {
				$data[] = [
					'TypeCashbank'	=> '',
					'BankCode'		=> '',
					'BankName'		=> '',
					'BankAccount'	=> '',
					'AccountNo'		=> '',
					'AccountName'	=> '',
					'Valuta'		=> '',
					'Saldo'			=> ''
				];
				$response['data'] = $data;
			}
		} catch(\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
	public function cashbankSave() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header('Content-Type: application/json');
		$response = [];
		$response['status_json'] = true;
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$datennow = date('Y-m-d H:i:s');
			$TypeCashbank = $input->post('TypeCashbank');
			$BankCode = $input->post('BankCode');
			$BankName = $input->post('BankName');
			$BankAccount = $input->post('BankAccount');
			$AccountNo = $input->post('AccountNo');
			$Valuta = $input->post('Valuta');
			$Debit = $input->post('Debit');
			$Debit = str_replace('.', '', $Debit);
			$Rate = $this->ModelCashbank->getRate("AND Valuta='$Valuta'");
			$post = true;
			if($post) {
				if($BankCode != '') {
					$dataInsert = [
						'TypeCashbank'		=> $TypeCashbank,
						'BankName'			=> $BankName,
						'BankAccount'		=> $BankAccount,
						'AccountNo'			=> $AccountNo,
						'Valuta'			=> $Valuta,
						'rate'				=> $Rate,
						'AvailableSaldo'	=> $Debit,
					];
					$this->ModelGeneral->UpdateData('fin_cashbank', $dataInsert, array("BankCode" => $BankCode));
					$response['remarks'] = 'Berhasil Mengupdate Bank';
				} else {
					$check = $this->ModelCashbank->getCashBank(" WHERE BankCode like '$TypeCashbank%' order by BankCode desc limit 1");

					if (isset($check[0]['BankCode'])) {
						$BankCode = substr($check[0]['BankCode'], -5);
						$No = str_replace('0', '', $BankCode);
						$No = intval($No) + 1;
						$BankCode = $TypeCashbank.'-'.str_pad($No, 5, "0", STR_PAD_LEFT);
					} else {
						$BankCode = $TypeCashbank.'-'.'00001';
					}

					$dataInsert = [
						'TypeCashbank'		=> $TypeCashbank,
						'BankCode'			=> $BankCode,
						'BankName'			=> $BankName,
						'BankAccount'		=> $BankAccount,
						'AccountNo'			=> $AccountNo,
						'Valuta'			=> $Valuta,
						'rate'				=> $Rate,
						'AvailableSaldo'	=> $Debit,
					];
					$this->ModelGeneral->InsertData('fin_cashbank', $dataInsert);
					$response['remarks'] = 'Berhasil Menyimpan Bank';
				}

				$this->ModelGeneral->LogActivity('Process Update Bank : '.$TypeCashbank.' - '.$BankName);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = 'Nomor urut atau nama modul sudah ada!';
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
	public function cashbankDelete() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header('Content-Type: application/json');
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = 'Berhasil menghapus Cash Bank';
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$BankCode = $this->input->post('code');
			$post = true;
			if ($post) {
				$this->ModelGeneral->DeleteData('fin_cashbank', array("BankCode" => $BankCode,));
				$this->ModelGeneral->LogActivity('Process Delete Cash Bank Item : ' . $BankCode);
				$this->db->trans_complete();
				$this->db->trans_commit();
			} else {
				$response['status_json'] = false;
				$response['remarks'] = 'Nomor urut atau nama modul sudah ada!';
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
