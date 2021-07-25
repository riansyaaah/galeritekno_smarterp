<?php defined('BASEPATH') or exit('No direct script access allowed');
class Registrasicorporate extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['form', 'url']);
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('eklinik/sales/ModelRegistrasiCorporate', 'model');
	}
	protected $idMenu = '675114F6-D1B1-4BE3-BAE3-91F1D5206FD2';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'         => 'Registrasi Baru',
			'count_ms'      => 99,
			'sess'          => $session,
			'menus'         => getMenu($session['user_id']),
			'apps'          => $this->session->userdata('applications'),
			'current_app'   => $this->session->userdata('current_app'),
			'sekarang'		=> date('Y-m-d')
		];
		$this->load->view('eklinik/sales/v_registrasi_corporate', $data);
	}
	public function getCaraPembayaran() {
		cek_session($this->idMenu);
		$data = ['Lunas', 'Belum Lunas', 'Invoice'];
		json($data);
	}
	public function getJenisLayanan() {
		cek_session($this->idMenu);
		$data = ['Drive Thru', 'Walk In', 'Home Service'];
		json($data);
	}
	public function getAllCabang() {
		cek_session($this->idMenu);
		$data = $this->mg->getAll('tbl_cabang')->result_array();
		json($data);
	}
	public function getAllInstansi() {
		cek_session($this->idMenu);
		$id = $this->input->get('idCabang');
		$data = $this->mg->getWhere('masterinstansi', ['idcabang' => $id])->result_array();
		json($data);
	}
	public function getAllFaskes() {
		cek_session($this->idMenu);
		$id = $this->input->get('idCabang');
		$data = $this->mg->getWhere('regfaskes', ['idcabang' => $id])->result_array();
		json($data);
	}
	public function getAllPaket() {
		cek_session($this->idMenu);
		$data = $this->mg->getAll('paket')->result_array();
		json($data);
	}
	public function getAllStaffMarketing() {
		cek_session($this->idMenu);
		$data = $this->mg->getWhere('hrm_staffprofile', ['departement_id' => 7])->result_array();
		json($data);
	}
	public function getAllJam() {
		cek_session($this->idMenu);
		$id = $this->input->get('idPemeriksaanDetail');
		$data = $this->mg->getWhere('masterjam', [
			'kuota !='				=> 0,
			'idpemeriksaandetail'	=> $id
		])->result_array();
		json($data);
	}
	public function getAllPaketPemeriksaan() {
		cek_session($this->idMenu);
		$id = $this->input->get('idCabang');
		$data = $this->model->getJenisPemeriksaan($id);
		json($data);
	}
	public function simpanRegistrasi() {
		cek_session($this->idMenu);
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		try {
			$input = $this->input;
			$session = $this->session->userdata('login');
			$idinvoice = '';
			$form = [
				'nik'				=> $input->get('nik'),
	        	'nomorPegawai'		=> $input->get('nomorPegawai'),
	        	'namaLengkap'		=> $input->get('namaLengkap'),
	        	'jenisKelamin'		=> $input->get('customRadio'),
	        	'tempatLahir'		=> $input->get('tempatLahir'),
	        	'tanggalLahir'		=> $input->get('tanggalLahir'),
	        	'nomorHP'			=> $input->get('nomorHP'),
	        	'email'				=> $input->get('email'),
	        	'alamat'			=> $input->get('alamat'),
	        	'picMarketing'		=> $input->get('picMarketing'),
	        	'cabang'			=> $input->get('cabang'),
	        	'jenisLayanan'		=> $input->get('jenisLayanan'),
	        	'paketPemeriksaan'	=> $input->get('paketPemeriksaan'),
	        	'tanggalKunjungan'	=> $input->get('tanggalKunjungan'),
	        	'jamKunjungan'		=> $input->get('jamKunjungan'),
	        	'faskesAsal'		=> $input->get('faskesAsal'),
	        	'instansi'			=> $input->get('instansi'),
	        	'caraPembayaran'	=> $input->get('caraPembayaran'),
	        	'catatan'			=> $input->get('catatan'),
	        	'tanggalRegistrasi'	=> $input->get('tanggalRegistrasi')
			];
			$dataJenisDetail = $this->model->getJenisPemeriksaanSingle($form['paketPemeriksaan']);
			// $pemeriksaandetail = $dataJenisDetail['detailcode'];
	  //       $detailharga = $dataJenisDetail['hargadetail'];
	  //       $jenis = $dataJenisDetail['jenis'];
	  //       $idjenispemeriksaan = $dataJenisDetail['idjenispemeriksaan'];
			$promo = $this->mg->getWhere('promo', [
	        	'idjenispemeriksaandetail'	=> $form['paketPemeriksaan'],
	        	'tanggal'					=> $form['tanggalKunjungan']
	        ])->row_array();
	        if($promo){
	            $dataJenisDetail['hargadetail'] = $promo['harga'];
	        }
	        $resAntrian = $this->_funcAntrian($form['tanggalKunjungan'], $form['jamKunjungan'], $form['paketPemeriksaan']);
	        $antrian_ke = $resAntrian['antrian_ke'];
	        // if($resAntrian['status'] == false) {
	        //     throw new \Exception($resAntrian['remarks'], 200);
	        // } else {
	        //     $antrian_ke = $resAntrian['antrian_ke'];
	        // }
	        $resAntrianReg = $this->model->checkAntrianReg($form['tanggalKunjungan'], $form['jamKunjungan'], $antrian_ke, $form['paketPemeriksaan']);
	        if($resAntrianReg == false) {
	            $remars = 'Antrian ke '.$antrian_ke.' tanggal ' .$form['tanggalKunjungan']. ' dan jam '.$form['jamKunjungan'].' sudah terisi. Harap coba kembali.';
	            // throw new \Exception($remars, 200);
	        }
	        $nomorReg = ($form['jenisLayanan'] == 'Drive Thru')? $this->_nomorRegistrasiDrive() : $this->_nomorRegistrasi($form['jamKunjungan']);
	        if($idinvoice == '') {
	            $noinvoice = $this->_nomorInvoice($form['jamKunjungan'], $form['cabang']);
				$checkNoInv = $this->model->checkNoInv($noinvoice);
	        } else {
	            $payment = $this->model->getPayment($idinvoice);
	            $noinvoice = $payment[0]['transaction_id'];
	        }
			$checkNoReg = $this->model->checkNoReg($nomorReg);
			if($form['caraPembayaran'] == 'Belum Lunas') {
	            $statustransaksi = 'Menunggu Pembayaran';
	            $remarks = 'Menunggu Pembayaran';
	            $statusbayarnya = 'PENDING';
	        } else {
	            $statustransaksi = 'Dalam Proses';
	            $remarks = 'Dalam Proses';
	            $statusbayarnya = 'SUCCESS';
	        }
	        $data = [
				'idinstansi'				=> $form['instansi'],
				'tanggalregistrasi'			=> $form['tanggalRegistrasi'],
				'nomorregistrasi'			=> $nomorReg,
				'iduser'					=> '',
				'idpemeriksaan'				=> $dataJenisDetail['idjenispemeriksaan'],
				'idjenispemeriksaandetail'	=> $form['paketPemeriksaan'],
				'pemeriksaandetail'			=> $dataJenisDetail['detailcode'],
				'detailharga'				=> $dataJenisDetail['hargadetail'],
				'tipekunjungan'				=> $form['jenisLayanan'],
				'tanggalkunjungan'			=> $form['tanggalKunjungan'],
				'jamkunjungan'				=> $form['jamKunjungan'],
				'actualjamkunjungan'		=> $form['jamKunjungan'].':00',
				'nama'						=> strtoupper($form['namaLengkap']),
				'jeniskelamin'				=> $form['jenisKelamin'],
				'tanggallahir'				=> $form['tanggalLahir'],
				'tempatlahir'				=> $form['tempatLahir'],
	            'nomorhp'					=> $form['nomorHP'],
				'statustransaksi'			=> $statustransaksi,
				'email'						=> $form['email'],
				'nik'						=> $form['nik'],
				'alamat'					=> $form['alamat'],
				'map_alamat'				=> '',
				'map_lat'					=> '',
				'map_long'					=> '',
				'harga'						=> null,
				'antrian_ke'				=> $antrian_ke,
				'noinvoice'					=> $noinvoice,
				'pic_m'						=> $form['picMarketing'],
				'created_by'				=> $session['user_id'],
				'created_date'				=> date('Y-m-d H:i:s'),
	            'idcabang'					=> $form['cabang'],
	            'idpayment'					=> $noinvoice,
	            'idinstansi'				=> $form['instansi'],
	            'idfaskes'					=> $form['faskesAsal'],
	            'carabayar'					=> $form['caraPembayaran']
			];
			$this->mg->InsertData('regperiksa', $data);
			if($idinvoice  == '') {
	            $dataPayment = [
	    			'transaction_id' 	=> $noinvoice,
	    			'bank_cstore' 		=> 'Transfer',
	    			'idinstansi' 		=> $form['instansi'],
	    			'va_number' 		=> '',
	    			'harga' 			=> $dataJenisDetail['hargadetail'],
	    			'jamorder' 			=> date('H'),
	    			'noinvoice' 		=> $noinvoice,
	    			'status' 			=> $statusbayarnya,
	    			'remarks' 			=> $remarks,
	    			'expire_date' 		=> date('Y-m-d H:i:s'),
	    			'created_date' 		=> date('Y-m-d H:i:s')
	    		];
	            $this->mg->InsertData('payment', $dataPayment);
	        } else {
	            $gettotharga = $this->model->getTotHarga($noinvoice);
	            $this->gm->UpdateData('payment', ['harga' => $gettotharga[0]['totharga']], ['id'=>$idinvoice]);  
	        }
	        $statusJson = true;
	        $remarks = 'Berhasil menambahkan data';
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
	private function _funcAntrian($tanggalkunjungan, $jamkunjungan, $idpemeriksaandetail){
        $result = [];
        $result['status'] = true;
        $result['remarks'] = "";
        $result['antrian_ke'] = "";
        $dataSetting = $this->model->getMasterJam($jamkunjungan, $idpemeriksaandetail);
        $antrian_per_jam = $dataSetting->kuota;
        $an = $this->model->getAntrian($tanggalkunjungan, $jamkunjungan, $idpemeriksaandetail);
        if($an == null) {
            $antrian_ke = 1;
            $kuota = 1;
            $dataAntrian = [
                'tanggal'				=> $tanggalkunjungan,
                'jam'					=> $jamkunjungan,
                'antrian_ke'			=> $antrian_ke,
                'kuota'					=> $kuota,
                'idpemeriksaandetail'	=> $idpemeriksaandetail
            ];   
            $this->mg->InsertData('antrian', $dataAntrian);
            $result['antrian_ke'] = $antrian_ke ;
        } else {
            if((int)$an->kuota >= (int)$antrian_per_jam) {
                $remarks = "Antrian pada tanggal $tanggalkunjungan dan jam $jamkunjungan sudah penuh. Harap pilih tanggal atau jam lain";
                $result['status'] = true;
                $result['remarks'] = $remarks;
            } else {
                $antrian_ke = (int)$an->antrian_ke + 1;
                $kuota = (int)$an->kuota + 1;
                $dataAntrian = [
                    'antrian_ke'	=> $antrian_ke,
                    'kuota'			=> $kuota
                ];
                $this->mg->UpdateData('antrian', $dataAntrian, [
                    'tanggal'				=> $tanggalkunjungan,								
                    'jam'					=> $jamkunjungan,
                    'idpemeriksaandetail'	=> $idpemeriksaandetail
                ]);
                $result['antrian_ke'] = $antrian_ke ;
            }
        }
        return $result; 
    }
    private function _nomorRegistrasi($jamkunjungan) {
        return 'SPA'.date('dmY').date('His').$jamkunjungan;;
    }
	
    private function _nomorRegistrasiDrive() {
        return 'SPDT'.date('dmY')."".date('His');
    }
	
	private function _nomorInvoice($jamkunjungan, $idcabang = "") {
        $idcabang = (strlen($idcabang) <= 1)? '0'.$idcabang : $idcabang;
        return 'INVA'.$idcabang.date('dmY').date('His').$jamkunjungan;
    }
}