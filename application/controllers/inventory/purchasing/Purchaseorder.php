<?php defined('BASEPATH') or exit('No direct script access allowed');
class Purchaseorder extends CI_Controller {
	public function __Construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(array('form', 'url'));
		$this->load->library('pdf');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('inventory/purchasing/ModelPurchaseOrder', 'model');
	}
	protected $idMenu = '0337f320-ed75-4934-8cb4-3611db0bc61b';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'Purchase Order',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'periode'		=> $this->ModelGeneral->getWhere('periode', ['Active' => 1])->row_array()['ThnBln']
		];
		$this->load->view('inventory/purchasing/purchaseorder/index', $data);
	}
	private function _json($data, $statusJson = true, $remarks = '') {
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> $statusJson,
			'data'			=> $data,
			'remarks'		=> $remarks
		]);
	}
	private function _penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
        $temp = '';
        if ($nilai < 12) {
            $temp = ' '. $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = $this->_penyebut($nilai - 10). ' Belas';
        } else if ($nilai < 100) {
            $temp = $this->_penyebut($nilai/10).' Puluh'. $this->_penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = ' Seratus' . $this->_penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->_penyebut($nilai/100) . ' Ratus' . $this->_penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = ' Seribu' . $this->_penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->_penyebut($nilai/1000) . ' Ribu' . $this->_penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->_penyebut($nilai/1000000) . ' Juta' . $this->_penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->_penyebut($nilai/1000000000) . ' Milyar' . $this->_penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->_penyebut($nilai/1000000000000) . ' Trilyun' . $this->_penyebut(fmod($nilai,1000000000000));
        }     
        return $temp;
    }
    private function _terbilang($nilai) {
        return ($nilai < 0)? 'minus '.trim($this->_penyebut($nilai)) : trim($this->_penyebut($nilai));
    }
	public function generateNoPO() {
		$tanggal = $this->input->get('tanggal');
		$bulan = date('m', strtotime($tanggal));
		$tahun = date('Y', strtotime($tanggal));
		$noPO = '/SPLH/PO/';
		$daftarBulanRomawi = $this->model->bulanRomawi();
		foreach($daftarBulanRomawi as $dbr) {
			if($bulan == $dbr[0]) {
				$noPO .= $dbr[1].'/'.$tahun;
			}
		}
		$cek = $this->model->getPurchaseOrder($noPO);
		if ($cek[0]['noPO'] == '') {
			$data['noPO'] = '001';
		} else {
			$nomor = intval($cek[0]['noPO']) + 1;
			$data['noPO'] = str_pad($nomor, 3, '0', STR_PAD_LEFT);;
		}
		$this->_json($data['noPO'].$noPO);
	}
	public function getAllSupplier() {
		cek_session($this->idMenu);	
		$data = $this->model->getAllSupplier();
		$this->_json($data);
	}
	public function getAllPODetail() {
		cek_session($this->idMenu);
		$noPO = $this->input->post('noPO');
		$data = $this->model->getAllPODetail($noPO);
		$this->_json($data);
	}
	public function getDetail() {
		cek_session($this->idMenu);
		$id = $this->input->get('id');
		$data = $this->model->getDetail($id);
		$this->_json($data);
	}
	public function getAllItemMaster() {
		cek_session($this->idMenu);
		$data = $this->model->getAllItemMaster();
		$this->_json($data);
	}
	public function saveAddItem() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$status = $input->get('status');
			$noPO = $input->get('noPO');
			$po = $this->mg->getWhere('inv_purchaseorder', ['noPO' => $noPO])->row_array();
			$form = [
				'idPO'			=> $po['id'],
				'idItemMaster'	=> $input->get('idItemMaster'),
				'jumlah'		=> $input->get('jumlah'),
				'hargaSatuan'	=> $input->get('hargaSatuan')
			];
			$detail = $this->mg->getWhere('inv_purchaseorder_detail', [
				'idPO'			=> $form['idPO'],
				'idItemMaster'	=> $form['idItemMaster']
			])->row_array();
			if($status == 1) {
				if($detail) {
					$statusJson = false;
					$remarks = 'Item Internal PO telah terdaftar';
					$this->db->trans_rollback();
				} else {
					$this->mg->InsertData('inv_purchaseorder_detail', $form);
					$this->mg->LogActivity('Process Insert Detail Item PO : '.$noPO);
					$statusJson = true;
					$remarks = 'Berhasil menyimpan data';
				}
			} else {
				if(!$detail) {
					$statusJson = false;
					$remarks = 'Item Internal PO belum terdaftar';
					$this->db->trans_rollback();
				} else {
					$this->mg->UpdateData('inv_purchaseorder_detail', $form, ['id' => $detail['id']]);
					$this->mg->LogActivity('Process Insert Detail Update PO : '.$noPO);
					$statusJson = true;
					$remarks = 'Berhasil mengubah data';
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
		$this->_json('', $statusJson, $remarks);
	}
	public function savePO() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$session = $this->session->userdata('login');
			$user = $this->model->getUser($session['user_id']);
			$input = $this->input;
			$tipeSupplier = $input->get('tipeSupplier');
			$kodeSupplier = $input->get('kodeSupplier');
			$table = ($tipeSupplier == 'ec')? 'inv_toko_ecommerce' : 'inv_supplier';
			$index = ($tipeSupplier == 'ec')? 'kode_toko' : 'kode';
			$supplier = $this->mg->getWhere($table, [$index => $kodeSupplier])->row_array();
			$index = ($tipeSupplier == 'ec')? 'idEcommerce' : 'idSupplier';
			$form = [
				$index		=> $supplier['id'],
				'noPO'		=> $input->get('noPO'),
				'tglPO'		=> strtotime($input->get('tanggal')),
				'rev'		=> 0,
				'createdBy'	=> $user['id']
			];
			$cek = $this->mg->getWhere('inv_purchaseorder', ['noPO' => $form['noPO']])->row_array();
			if($cek) {
				$statusJson = false;
				$remarks = 'Purchase order telah terdafar';
				$this->db->trans_rollback();
			} else {
				$this->mg->InsertData('inv_purchaseorder', $form);
				$this->mg->LogActivity('Process Insert New PO : '.$form['noPO']);
				$statusJson = true;
				$remarks = 'Berhasil menyimpan data';
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
	public function hapusDetail() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$id = $this->input->get('id');
			$cek = $this->mg->getWhere('inv_purchaseorder_detail', ['id' => $id])->row_array();
			if(!$cek) {
				$statusJson = false;
				$remarks = 'Purchase order tidak terdafar';
				$this->db->trans_rollback();
			} else {
				$this->mg->DeleteData('inv_purchaseorder_detail', ['id' => $cek['id']]);
				$this->mg->LogActivity('Process Delete Detail PO : '.$cek['id']);
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
		$this->_json('', $statusJson, $remarks);
	}
	public function print() {
		cek_session($this->idMenu);
        $pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Purchase Order');
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        $pdf->SetDefaultMonospacedFont('dejavusans');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins('7', '30', '8');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(true);
        $input = $this->input;
        $noPO = $input->get('noPO');
        $tipeSupplier = $input->get('tipeSupplier');
        $po = $this->mg->getWhere('inv_purchaseorder', ['noPO' => $noPO])->row_array();
        $po['details'] = $this->model->getAllPODetail($noPO);
        $po['total'] = 0;
        for($i=0; $i<count($po['details']); $i++) {
        	$po['details'][$i]['totalHarga'] = $po['details'][$i]['hargaSatuan']*$po['details'][$i]['jumlah'];
			$po['total'] += $po['details'][$i]['hargaSatuan'];
			$po['details'][$i]['hargaSatuan'] = number_format($po['details'][$i]['hargaSatuan'], 0, ',', '.');
        }
        $po['terbilang'] = $this->_terbilang($po['total']);
        $po['total'] = number_format($po['total'], 0, ',', '.');
        $idSupplier = ($tipeSupplier == 'ec')? $po['idEcommerce'] : $po['idSupplier'];
        $supplier = ($tipeSupplier == 'ec')? $this->model->getTokoEcommerce($idSupplier) : $this->model->getSupplier($idSupplier);
        $po['namaVendor'] = $supplier['namaVendor'];
        $po['alamatVendor'] = $supplier['alamatVendor'];
        $po['tlpVendor'] = $supplier['tlpVendor'];
        $po['cpVendor'] = $supplier['cpVendor'];
        $data = ['data'	=> $po];
        $pdf->AddPage('P', 'A4');
        $content = $this->load->view('inventory/purchasing/purchaseorder/print', $data, true);
        $pdf->writeHTML($content, true, true, true, true, '');
        $pdf->Output('Purchase Order.pdf', 'I');
    }
}