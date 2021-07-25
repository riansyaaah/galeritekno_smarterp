<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Stockin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['form', 'url']);
		$this->load->library('pdf');
		$this->load->model('ModelGeneral');
		$this->load->model('inventory/transaction/ModelStockin');
	}
	protected $idMenu = '0337f320-ed75-4934-8cb4-3611db0bc61b';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'Barang Masuk',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'PeriodeActive'	=> $this->ModelGeneral->getWhere('periode', ['Active' => 1])->row_array()['ThnBln']
		];
		$this->load->view('inventory/transaction/v_stockin', $data);
	}
	public function generateNoTransaction() {
		$periode   = $this->ModelGeneral->getWhere('periode', ['Active' => 1])->row_array()['ThnBln'];
		$noTransaction = '/IN/'.$periode;
		$cek = $this->ModelStockin->getNoTransaction($noTransaction);
		if ($cek[0]['noTransaction'] == '') {
			$data['noTransaction'] = '001';
		} else {
			$nomor = intval($cek[0]['noTransaction']) + 1;
			$data['noTransaction'] = str_pad($nomor, 3, '0', STR_PAD_LEFT);;
		}
		header('Content-Type: application/json');
		echo json_encode([
			'status_json'	=> true,
			'data'			=> $data['noTransaction'].$noTransaction
		]);
	}
	public function getAllSupplier() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$datas = $this->ModelStockin->getAllSupplier();
		for($i=0; $i<count($datas); $i++) {
			$datas[$i]['option'] = '<button class="btn btn-info btn-sm"><i class="fas fa-check"></i></button>';
		}
		$response = [
            'status_json'   => true,
            'data'          => $datas
        ];
        json($datas);
	}
	public function getAllPO() {
		cek_session($this->idMenu);
		$input = $this->input;
		$idSupplier = $input->post('idSupplier');
		$typeSupplier = $input->post('typeSupplier');
		$index = ($typeSupplier == 'sp')? 'idSupplier' : 'idEcommerce';
		$datas = $this->ModelGeneral->getWhere('inv_purchaseorder', [
			'stockin'		=> null,
			'idDepartment'	=> null,
			$index			=> $idSupplier
		])->result_array();
		for($i=0; $i<count($datas); $i++) {
			$datas[$i]['option'] = '<button class="edit_record btn btn-info btn-sm"><i class="fas fa-check"></i></button>';
			$datas[$i]['tglPO'] = date('Y-m-d', $datas[$i]['tglPO']);
		}
        json($datas);
	}
	public function getPOByNo() {
		cek_session($this->idMenu);
		$noPO = $this->input->post('noPO');
		$datas = $this->ModelGeneral->getWhere('inv_purchaseorder', ['noPO' => $noPO])->row_array();
        $datas['details'] = $this->ModelStockin->getPODetailByIdPO($datas['id']);
        $datas['total'] = 0;
		foreach($datas['details'] as $detail) {
			$datas['total'] += $detail['jumlah'];
		}
		header('Content-Type: application/json');
		$response = [
            'status_json'   => true,
            'data'          => $datas
        ];
        echo json_encode($response);
	}
	private function _elementKondisi($id, $kondisiMasuk = '') {
		$kondisi = $this->ModelStockin->kondisiBarang();
		$option = '';
		foreach($kondisi as $k) {
			$option .= '<option value="'.$k.'" '.(($k == $kondisiMasuk)? 'selected' : '').'>'.$k.'</option>';
		}
		return '<select class="custom-select custom-select-sm" name="kondisi'.$id.'">
			<option value="">Pilih</option>'.$option.'
		</select>';
	}
	public function getPODetailByIdPO() {
		cek_session($this->idMenu);
		$input = $this->input;
		$id = ($input->post('idPO'))? $input->post('idPO') : $input->get('idPO');
		$noPO = $this->ModelGeneral->getWhere('inv_purchaseorder', ['id' => $id])->row_array()['noPO'];
		$tr = $this->ModelGeneral->getWhere('inv_transaction', ['noPo' => $noPO])->row_array();
		// var_dump($tr);die;
		$datas = ($tr)? $this->ModelStockin->getTrDetailByIdTrJoinRekapitulasi($tr['id']) : $this->ModelStockin->getPODetailByIdPO($id);
		for($i=0; $i < count($datas); $i++) {
			$datas[$i]['hargaSatuan'] = $datas[$i][($tr)? 'harga_satuan' : 'hargaSatuan'];
			$datas[$i]['formJumlahAktual'] = '<input type="text" class="form-control form-control-sm" name="jumlahAktual'.$datas[$i]['id'].'" value="'.$datas[$i][($tr)? 'jumlah_act' : 'jmlAktual'].'">';
			$datas[$i]['formKondisi'] = $this->_elementKondisi($datas[$i]['id'], $datas[$i][($tr)? 'kondisimasuk' : 'jmlAktual']);
			$datas[$i]['formJumlah'] = '<input type="hidden" name="inputJumlah'.$datas[$i]['id'].'" value="'.$datas[$i]['jumlah'].'">';
			$datas[$i]['formHargaSatuan'] = '<input type="hidden" name="inputHargaSatuan'.$datas[$i]['id'].'" value="'.$datas[$i][($tr)? 'harga_satuan' : 'hargaSatuan'].'">';
			$datas[$i]['formTglExpired'] = '<input type="date" class="form-control form-control-sm" name="expired'.$datas[$i]['id'].'" value="'.(($tr)? date('Y-m-d', $datas[$i]['tglExpired']) : '').'">';
		}
		json($datas);
	}
	public function getPODById() {
		$id = $this->input->post('id');
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header('Content-Type: application/json');
		$datas = $this->ModelPurchaseOrder->getPODById($id);
		$response = [
            'status_json'   => true,
            'data'          => $datas
        ];
        echo json_encode($response);
	}
	public function getAllItem() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$datas = $this->ModelPurchaseOrder->getAllitem();
		$response = [
            'status_json'   => true,
            'data'          => $datas
        ];
        json($response);
	}

	public function cariPONo() {
		$ThnActive   = $this->ModelGeneral->getWhere('periode', ['Active' => 1])->result_array();
		$thn = $ThnActive[0]['ThnBln'];
		$noPO = '/PO/'.$thn;
		$cek = $this->ModelPurchaseOrder->getPurchaseOrder($noPO);
		if ($cek[0]['noPO'] == "") {
			$data['noPO'] = "001";
		} else {
			$nomor = intval($cek[0]['noPO']) + 1;
			$data['noPO'] = str_pad($nomor, 3, "0", STR_PAD_LEFT);;
		}
		$data['noPO'] = $data['noPO'].'/PO/'.$thn;
		echo json_encode($data);
	}

	public function saveTransaction() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = 'Berhasil menyimpan barang masuk';
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$datennow = date('Y-m-d H:i:s');
			$post = true;
			if($post) {
				$input = $this->input;
				$mg = $this->ModelGeneral;
				$typeSupplier = $input->get('typeSupplier');
				$index = ($typeSupplier == 'sp')? 'idSupplier' : 'idEcommerce';
				$form = [
					'noTransaction'		=> $input->get('noTransaction'),
					'tglTransaction'	=> strtotime($input->get('tglTransaction')),
					'typeTransaction'	=> 2,
					$index				=> $input->get('idSupplier'),
					'noPO'				=> $input->get('noPO'),
					'suratJalan'		=> $input->get('suratJalan')
				];
				$cek = $mg->getWhere('inv_transaction', ['noTransaction' => $form['noTransaction']])->row_array();
				if($cek) {
					$response['status_json'] = false;
					$response['remarks'] = 'Transaksi sudah ada';
					$this->db->trans_rollback();
				} else {
					$mg->InsertData('inv_transaction', $form);
					$idTr = $mg->getWhere('inv_transaction', ['noPO' => $form['noPO']])->row_array()['id'];
					$po = $mg->getWhere('inv_purchaseorder', ['noPO' => $form['noPO']])->row_array();
					$poDetail = $mg->getWhere('inv_purchaseorder_detail', ['idPO' => $po['id']])->result_array();
					foreach($poDetail as $detail) {
						$stockInput = $input->get('jumlahAktual'.$detail['id']);
						$oke = [
							'idTransaction' => $idTr,
							'kondisimasuk'	=> $input->get('kondisi'.$detail['id']),
							'jumlah'		=> $detail['jumlah'],
							'harga_satuan'	=> $detail['hargaSatuan'],
							'idItemMaster'	=> $detail['idItemMaster'],
							'tglExpired'	=> strtotime($input->get('expired'.$detail['id']))
						];
						$item = $mg->getWhere('inv_itemmaster', ['id' => $oke['idItemMaster']])->row_array();
						$oke['jumlah_act'] = $stockInput*$item['jumlahTerkecil'];
						$sisaStockKecil = $item['stock']+$oke['jumlah_act'];
						$sisaStockBesar = $item['stokTerbesar']+$stockInput;
						$mg->InsertData('inv_transaction_detail', $oke);
						$trDetail = $mg->getWhere('inv_transaction_detail', [
							'idTransaction'	=> $oke['idTransaction'],
							'harga_satuan'	=> $oke['harga_satuan'],
							'idItemMaster'	=> $oke['idItemMaster']
						])->row_array();
						$mg->UpdateData('inv_itemmaster', [
							'stock'			=> $sisaStockKecil,
							'stokTerbesar'	=> $sisaStockBesar
						], ['id' => $item['id']]);
						$mg->InsertData('inv_rekapitulasi', [
							'idTransaksiDetail'	=> $trDetail['id'],
							'jmlAwal'			=> $item['stock'],
							'jmlAkhir'			=> $sisaStockKecil
						]);
					}
					$session = $this->session->userdata('login');
					$mg->UpdateData('inv_purchaseorder', [
						'stockin'		=> strtotime($form['tglTransaction']),
						'approvedBy'	=> $session['user_id']
					], ['noPO' => $form['noPO']]);
					$mg->LogActivity('Process Insert New Transaction : '.$form['noPO']);
				}
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
			$mg->LogError(current_url(),  $e->getMessage());
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function cetak() {
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetTitle('Transaksi Barang Masuk');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Transaksi Barang Masuk';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(false);
		$pdf->SetAutoPageBreak(true, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

		$noTransaction = $this->input->get('noTransaction');
		$tr = $this->ModelStockin->getTransactionByNo($noTransaction);
		if($tr['idSupplier']) {
			$supplier = $this->ModelGeneral->getWhere('inv_supplier', ['id' => $tr['idSupplier']])->row_array();
			$tr['nama'] = $supplier['nama'];
			$tr['email'] = $supplier['email'];
			$tr['telp'] = $supplier['telp'];
			$tr['cp'] = $supplier['cp'];
			$tr['alamat'] = $supplier['alamat'];
			$tr['kode'] = $supplier['kode'];
		} else {
			$supplier = $this->ModelGeneral->getWhere('inv_toko_ecommerce', ['id' => $tr['idEcommerce']])->row_array();
			$tr['nama'] = $supplier['nama_toko'];
			$tr['kode'] = $supplier['kode_toko'];
			$tr['email'] = '-';
			$tr['telp'] = '-';
			$tr['cp'] = '-';
			$tr['alamat'] = '-';
		}
		$tr['details'] = $this->ModelStockin->getTransactionDetail($tr['id']);
		for($i=0; $i<count($tr['details']); $i++) {
			$tr['details'][$i]['total'] = $tr['details'][$i]['jumlah_act']*$tr['details'][$i]['harga_satuan'];
		}
		$tr['totTotal'] = 0;
		foreach ($tr['details'] as $detail) {
			$tr['totTotal'] += $detail['total'];
		}
		$datax = [
			'i'			=> 1,
			'dataPrint'	=> $tr
		];
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('inventory/transaction/print_stockin', $datax, true);
		$pdf->writeHTML($content, true, true, true, true, '');
		$pdf->Output('Transaksi Barang Masuk.pdf', 'I');
	}
	private function _spasi($jumlah) {
		$spasi = '';
		for ($i = 1; $i <= $jumlah; $i++) {
			$spasi .= '&nbsp;';
		}
		return $spasi;
	}
}
