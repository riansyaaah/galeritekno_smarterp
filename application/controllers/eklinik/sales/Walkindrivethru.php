<?php defined('BASEPATH') or exit('No direct script access allowed');
class Walkindrivethru extends CI_Controller {
	public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(['form', 'url']);
		$this->load->library('m_pdf');
		$this->load->helper('tgl_indo');
		$this->load->model('ModelGeneral', 'mg');
		$this->load->model('eklinik/sales/ModelWalkInDriveThru', 'model');
	}
	protected $idMenu = '84184A0C-65BD-4D2F-891F-5FA60656418B';
	public function index() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$data = [
			'title'			=> 'Walk In / Drive Thru',
			'count_ms'		=> 99,
			'sess'			=> $session,
			'menus'			=> getMenu($session['user_id']),
			'apps'			=> $this->session->userdata('applications'),
			'current_app'	=> $this->session->userdata('current_app'),
			'sekarang'		=> date('Y-m-d')
		];
		$this->mg->LogAktivitas('Membuka halaman Walk In / Drive Thru');
		$this->load->view('eklinik/sales/walkindrivethru/index', $data);
	}
	public function getAllLog() {
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		$input = $this->input;
		$id = ($input->get('id'))? $input->get('id') : $input->post('id');
		$regperiksa = $this->mg->getWhere('regperiksa', ['id' => $id])->row_array();
		$data = $this->model->getAllLog($regperiksa, $session['user_id']);
		json($data);
	}
	public function getRegperiksaSingle() {
		cek_session($this->idMenu);
		$id = $this->input->get('id');
		$data = $this->model->getRegperiksaSingle($id);
		json($data);
	}
	public function getRegperiksaIdpayment() {
		cek_session($this->idMenu);
		$input = $this->input;
		$idpayment = ($input->get('idpayment'))? $input->get('idpayment') : $input->post('idpayment');
		$data = $this->model->getRegperiksaIdpayment($idpayment);
		json($data);
	}
	public function getAllRegperiksa() {
		cek_session($this->idMenu);
		$now = date('Y-m-d');
		$data = $this->model->getRegperiksa($now);
		json($data);
	}
	public function getAllRegperiksaFilter() {
		cek_session($this->idMenu);
		$input = $this->input;
		$form = [
			'from'				=> $input->post('from'),
			'to'				=> $input->post('to'),
			'instansi'			=> $input->post('instansi'),
			'picMarketing'		=> $input->post('picMarketing'),
			'paketPemeriksaan'	=> $input->post('paketPemeriksaan'),
			'cabang'			=> $input->post('cabang'),
			'statusHasil'		=> $input->post('statusHasil')
		];
		$data = $this->model->getRegperiksaFilter($form);
		json($data);
	}
	public function getCaraPembayaran() {
		cek_session($this->idMenu);
		$data = ['Lunas', 'Belum Lunas', 'Invoice', 'Free'];
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
	public function getStatusHasil() {
		cek_session($this->idMenu);
		$data = [
			['id' => 0, 'status' => 'Belum Selesai'],
			['id' => 1, 'status' => 'Selesai']
		];
		json($data);
	}
	public function getPaketPemeriksaan() {
		cek_session($this->idMenu);
		$data = $this->model->getPaketPemeriksaan();
		json($data);
	}
	public function getCabang() {
		cek_session($this->idMenu);
		$data = $this->model->getCabang();
		json($data);
	}
	public function getInstansi() {
		cek_session($this->idMenu);
		$data = $this->mg->getAll('masterinstansi')->result_array();
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
			'kuota >'				=> 0,
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
			$status = $input->get('status');
			if($status == 1) {
				$idinvoice = $input->get('idpayment');
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
				$promo = $this->mg->getWhere('promo', [
		        	'idjenispemeriksaandetail'	=> $form['paketPemeriksaan'],
		        	'tanggal'					=> $form['tanggalKunjungan']
		        ])->row_array();
		        if($promo){
		            $dataJenisDetail['hargadetail'] = $promo['harga'];
		        }
		        $resAntrian = $this->_funcAntrian($form['tanggalKunjungan'], $form['jamKunjungan'], $form['paketPemeriksaan']);
		        $antrian_ke = $resAntrian['antrian_ke'];
		        $resAntrianReg = $this->model->checkAntrianReg($form['tanggalKunjungan'], $form['jamKunjungan'], $antrian_ke, $form['paketPemeriksaan']);
		        if($resAntrianReg == false) {
		            $remars = 'Antrian ke '.$antrian_ke.' tanggal ' .$form['tanggalKunjungan']. ' dan jam '.$form['jamKunjungan'].' sudah terisi. Harap coba kembali.';
		        }
		        $nomorReg = ($form['jenisLayanan'] == 'Drive Thru')? $this->_nomorRegistrasiDrive() : $this->_nomorRegistrasi($form['jamKunjungan']);
		        if($idinvoice == '') {
		            $noinvoice = $this->_nomorInvoice($form['jamKunjungan'], $form['cabang']);
					$checkNoInv = $this->model->checkNoInv($noinvoice);
		        } else {
		            $payment = $this->mg->getWhere('payment', ['transaction_id' => $idinvoice])->row_array();
		            $noinvoice = $payment['transaction_id'];
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
		            'carabayar'					=> $form['caraPembayaran'],
		            'catatan'					=> $form['catatan'],
		            'nomorpegawai'				=> $form['nomorPegawai']
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
		            $this->mg->UpdateData('payment', ['harga' => $gettotharga['totharga']], ['id'=>$idinvoice]);  
		        }
		        $this->mg->LogActivity('Insert new data : '.$data['nomorregistrasi']);
		        $this->mg->LogAktivitas('Insert new data : '.$data['nomorregistrasi']);
		        $statusJson = true;
		        $remarks = 'Berhasil menambahkan data';
			} elseif($status == 2) {
				$id = $input->get('idEdit');
				$idpayment = $input->get('idpayment');
				$regperiksa = $this->mg->getWhere('regperiksa', ['id' => $id])->row_array();
				if(!$regperiksa) {
					$statusJson = false;
					$remarks = 'Data tidak ditemukan';
					$this->db->trans_rollback();
				} else {
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
					$promo = $this->mg->getWhere('promo', [
						'idjenispemeriksaandetail'	=> $form['paketPemeriksaan'],
						'tanggal'					=> $form['tanggalKunjungan']
					])->row_array();
					if($promo){
		                $dataJenisDetail['hargadetail'] = $promo['harga'];
		            }
		            if($form['caraPembayaran'] == 'Belum Lunas'){
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
			            'idpemeriksaan'				=> $dataJenisDetail['idjenispemeriksaan'],
			            'idjenispemeriksaandetail'	=> $form['paketPemeriksaan'],
			            'pemeriksaandetail'			=> $dataJenisDetail['detailcode'],
			            'detailharga'				=> $dataJenisDetail['hargadetail'],
			            'tipekunjungan'				=> $form['jenisLayanan'],
			            'statustransaksi'			=> $statustransaksi,
			            'idcabang'					=> $form['cabang'],
			            'idinstansi'				=> $form['instansi'],
			            'idfaskes'					=> $form['faskesAsal'],
			            'carabayar'					=> $form['caraPembayaran'],
			            'nama'          			=> $form['namaLengkap'],
			            'nomorpegawai'  			=> $form['nomorPegawai'],
			            'jeniskelamin'  			=> $form['jenisKelamin'],
			            'tanggallahir'  			=> $form['tanggalLahir'],
			            'tempatlahir'   			=> $form['tempatLahir'],
			            'nomorhp'       			=> $form['nomorHP'],
			            'email'         			=> $form['email'],
			            'nik'           			=> $form['nik'],
			            'alamat'        			=> $form['alamat'],
			            'pic_m'         			=> $form['picMarketing']
			        ];
			        $this->mg->UpdateData('regperiksa', $data, ['id' => $id]);
			        $gettotharga = $this->model->getTotHarga($idpayment);
			        $datainvoice['harga'] = $gettotharga['totharga'];
			        $this->mg->UpdateData('payment', $datainvoice, ['transaction_id' => $idpayment]);
			        $this->mg->LogActivity('Insert new data : '.$regperiksa['nomorregistrasi']);
			        $this->mg->LogAktivitas('Menambahkan data baru '.$regperiksa['nomorregistrasi']);
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
    public function hapusPeserta() {
        cek_session($this->idMenu);
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
        	$id = $this->input->get('id');
        	$regperiksa = $this->mg->getWhere('regperiksa', ['id' => $id])->row_array();
        	if(!$regperiksa) {
        		$status = false;
                $remarks = 'Data telah terdaftar';
                $this->db->trans_rollback();
        	} else {
        		$this->mg->UpdateData('regperiksa', ['trash' => 1], ['id' => $regperiksa['id']]);
        		$this->mg->LogActivity('Process Delete Regperiksa : '.$regperiksa['nomorregistrasi']);
        		$this->mg->LogAktivitas('Proses menghapus '.$regperiksa['nomorregistrasi']);
        		$status = true;
        		$remarks = 'Berhasil menghapus data';
        	}
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $status = false;
            $remarks = $e->getMessage();
            $this->db->trans_rollback();
            $this->mg->LogError(current_url(),  $e->getMessage());
        }
        json('', $status, $remarks);
    }
    public function actionReschedule() {
        cek_session($this->idMenu);
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
            $input = $this->input;
	        $id = $input->get('id');
	        $form = [
	        	'tanggalkunjungan'	=> $input->get('tanggalkunjungan'),
	        	'jamkunjungan'		=> $input->get('jamkunjungan')
	        ];
	        $regperiksa = $this->mg->getWhere('regperiksa', ['id' => $id])->row_array();
	        if(!$regperiksa) {
	        	$status = false;
	        	$remarks = 'Data tidak ditemukan';
	        	$this->db->trans_rollback();
	        } else {
	        	if($regperiksa['tipekunjungan'] == 'Walk In' && $regperiksa['idinstansi'] == 4 && $regperiksa['carabayar'] == 'Lunas') {
	        		$getantrianakhir = $this->model->getAntrianAkhir($form['tanggalkunjungan'], $form['jamkunjungan'], $regperiksa['idjenispemeriksaandetail']);
	        		$getkuotajam = $this->model->getKuotaJam($form['jamkunjungan'], $form['idjenispemeriksaandetail']);
	        		if($getantrianakhir) {
	        			if($getantrianakhir['antrian_ke'] >= $getkuotajam['kuota']) {
	        				$status = false;
	        				$remarks = 'Kuota pada jam '.$form['jamkunjungan'].' sudah penuh, silahkan pilih jam lain';
	        				$this->db->trans_rollback();
	        			} else {
	        				$noantrian = $getantrianakhir['antrian_ke']+1;
	        				$dataregistrasi = [
	        					'tanggalkunjungan'	=> $form['tanggalkunjungan'],
	        					'jamkunjungan'		=> $form['jamkunjungan'],
	        					'antrian_ke'		=> $noantrian
	        				];
	        				$this->mg->UpdateData('regperiksa', $dataregistrasi, ['id' => $id]);
	        				$dataantrian = [
	        					'antrian_ke'			=> $noantrian,
	        					'kuota'					=> $getantrianakhir['antrian_ke']+1,
	        					'idpemeriksaandetail'	=> $regperiksa['idpemeriksaandetail']
	        				];
	        				$this->mg->UpdateData('regperiksa', $dataantrian, [
	        					'tanggal'				=> $form['tanggalkunjungan'],
	        					'jam'					=> $form['jamkunjungan'],
	        					'idpemeriksaandetail'	=> $regperiksa['idjenispemeriksaandetail']
	        				]);
	        				$this->mg->LogActivity('Process Reschedule : '.$regperiksa['nomorregistrasi']);
	        				$this->mg->LogAktivitas('Process Reschedule : '.$regperiksa['nomorregistrasi']);
	        				$status = true;
	        				$remarks = 'Berhasil mengubah data';
	        			}
	        		} else {
	        			$noantrian = 1;
	        			$dataregistrasi = [
	        				'tanggalkunjungan'	=> $form['tanggalkunjungan'],
	        				'jamkunjungan'		=> $form['jamkunjungan'],
	        				'antrian_ke'		=> $noantrian
	        			];
	        			$this->mg->UpdateData('regperiksa', $dataregistrasi, ['id' => $id]);
	        			$dataantrian = [
	        				'tanggal'				=> $form['tanggalkunjungan'],
	        				'jam'					=> $form['jamkunjungan'],
	        				'antrian_ke'			=> $noantrian,
	        				'kuota'					=> $getantrianakhir['antrian_ke']+1,
	        				'idpemeriksaandetail'	=> $regperiksa['idjenispemeriksaandetail']
	        			];
	        			$this->mg->InsertData('antrian', $dataantrian);
	        			$this->mg->LogActivity('Process Reschedule : '.$regperiksa['nomorregistrasi']);
	        			$this->mg->LogAktivitas('Process Reschedule : '.$regperiksa['nomorregistrasi']);
	        		}
	        	} else {
	        		$dataregistrasi = [
	        			'tanggalkunjungan'	=> $form['tanggalkunjungan'],
	        			'jamkunjungan'		=> $form['jamkunjungan']
	        		];
	        		$this->mg->UpdateData('regperiksa', $dataregistrasi, ['id' => $id]);
	        		$this->mg->LogActivity('Process Reschedule : '.$regperiksa['nomorregistrasi']);
	        		$this->mg->LogAktivitas('Proses reschedule '.$regperiksa['nomorregistrasi']);
	        	}
	        }
	        $status = true;
	        $remarks = 'Berhasil mengubah data';
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $status = false;
            $remarks = $e->getMessage();
            $this->db->trans_rollback();
            $this->mg->LogError(current_url(),  $e->getMessage());
        }
        json('', $status, $remarks);
    }
    public function actionHadirSemua() {
        cek_session($this->idMenu);
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
	        $idpayment = $this->input->get('idpayment');
	        $regperiksa = $this->mg->getWhere('regperiksa', [
	        	'idpayment' => $idpayment,
	        	'trash !='	=> 1
	        ])->result_array();
	        if(!$regperiksa) {
	        	$status = false;
	        	$remarks = 'Data tidak ditemukan';
	        	$this->db->trans_rollback();
	        } else {
	        	foreach($regperiksa as $regp) {
					$this->mg->UpdateData('regperiksa', [
			            'tanggalkunjungan'		=> date('Y-m-d'),
			            'actualjamkunjungan'	=> date('H:i'),
			            'statushadir'			=> 'Hadir'
			        ], ['id' => $regp['id']]);
					$this->mg->LogActivity('Process Present : '.$idpayment);
					$this->mg->LogAktivitas('Process Present : '.$idpayment);
	        	}
	        	$status = true;
		        $remarks = 'Berhasil mengubah data';
	        }
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $status = false;
            $remarks = $e->getMessage();
            $this->db->trans_rollback();
            $this->mg->LogError(current_url(),  $e->getMessage());
        }
        json('', $status, $remarks);
    }
    public function actionHadirSingle() {
        cek_session($this->idMenu);
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        try {
	        $id = $this->input->get('id');
	        $regperiksa = $this->mg->getWhere('regperiksa', ['id' => $id])->row_array();
	        if(!$regperiksa) {
	        	$status = false;
	        	$remarks = 'Data tidak ditemukan';
	        	$this->db->trans_rollback();
	        } else {
				$this->mg->UpdateData('regperiksa', [
		            'tanggalkunjungan'		=> date('Y-m-d'),
		            'actualjamkunjungan'	=> date('H:i'),
		            'statushadir'			=> 'Hadir'
		        ], ['id' => $regperiksa['id']]);
				$this->mg->LogActivity('Process Present : '.$regperiksa['nomorregistrasi']);
				$this->mg->LogAktivitas('Process Present : '.$regperiksa['nomorregistrasi']);
				$status = true;
		        $remarks = 'Berhasil mengubah data';
	        }
            $this->db->trans_complete();
            $this->db->trans_commit();
        } catch (\Throwable $e) {
            $status = false;
            $remarks = $e->getMessage();
            $this->db->trans_rollback();
            $this->mg->LogError(current_url(),  $e->getMessage());
        }
        json('', $status, $remarks);
    }
    public function cetakkwitansi() {
        cek_session($this->idMenu);
        $idDetail = $this->input->get('idDetail');
        $regperiksa = $this->mg->getWhere('regperiksa', ['id' => $idDetail])->row_array();
        $payment = $this->mg->getWhere('payment', ['transaction_id' => $regperiksa['idpayment']])->row_array();
        $noinvoice = $payment['noinvoice'];
        $idpayment = $payment['transaction_id'];
        $this->mg->LogAktivitas('Mencetak Lembar invoice Dengan NO. INV: '.$noinvoice);
        $pasien = $this->model->getPasien($idpayment);
        $billto = $this->mg->getWhere('regperiksa', ['idpayment' => $idpayment])->row_array();
        $idpemeriksaan = $billto['idpemeriksaan'];
        $hargapemeriksaan = $this->mg->getWhere('jenispemeriksaan', ['id' => $idpemeriksaan])->row_array();
        $k = $this->model->getK($idpayment);
        $data = [
	        'kop'				=> 'assets/file/kwitansispeedlabnew.jpg',
	        'ttdkwitansi'		=> 'loading.gif',
	        'noinvoice'			=> $noinvoice,
	        'billto'			=> $billto['nama'],
	        'tanggalinvoice'	=> $payment['created_date'],
	        'unitprice'			=> $hargapemeriksaan['harga'],
	        'keterangan'        => $hargapemeriksaan['keterangan'],
	        'qty'				=> $pasien['jumlah'],
	        'total'				=> $pasien['total'],
	        'titimangsa'    	=> $pasien['titimangsa'],
            'namafinance'   	=> $pasien['namafinance'],
            'ttdnonmaterai'   	=> $pasien['ttdnonmaterai'], 
            'ttdfinance'    	=> $pasien['ttdfinance'],
	        'tanggalkunjungan'	=> $billto['tanggalkunjungan'],
	        'pemeriksaandetail'	=> $k[0]['pemeriksaandetail'],
	        'listpemeriksaan'	=> $this->model->getListPemeriksaan($idpayment),
	        'total'				=> floor($pasien['total']),
	        'terbilang'			=> $this->terbilang(floor($pasien['total'])),
        ]; 
        $html = $this->load->view('eklinik/sales/walkindrivethru/cetakkwitansi', $data, true);
        $this->mpdf = new mPDF('utf-8');
        $this->mpdf->AddPage('L','', '', '', '',15,15,15,15,15,15); // margin footer
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output('Kwitansi'.$noinvoice.'.pdf', 'I');
    }
    public function cetakBarcode(){
        cek_session($this->idMenu);
        $idpasien = $this->input->get('id');
		$data = [
			'tanggalkunjungan'		=> date('Y-m-d'),
			'actualjamkunjungan'	=> date('H:i'),
			'statushadir'			=> 'Hadir'
		]; 
		$this->mg->UpdateData('regperiksa',$data, ['id' => $idpasien]);
		$cekantiran = $this->model->cekAntrian($idpasien);
        $pemohon = $this->mg->getWhere('regperiksa', ['id' => $idpasien])->row_array();
		$date1 = date_create($pemohon['tanggal_lahir']);
		$date2 = date_create(date("Y-m-d"));
		$diff = date_diff($date1,$date2);
		$y = $diff->format("%y Tahun");
		$noregistrasi = $pemohon['nomorregistrasi'];
		$nama = $pemohon['nama'];
		$isibarcode = substr($idpasien.";".$pemohon['nama'],0,17);
		$this->set_barcode($isibarcode,$idpasien);
		$this->mpdf = new mPDF('utf-8', [42,34]);
		$idinstansi = $pemohon['idinstansi'];
		$idjenispemeriksaandetail = $pemohon['idjenispemeriksaandetail'];
		$instansi = $this->mg->getWhere('masterinstansi', ['id' => $idinstansi])->result_array();
		$jenis = $this->mg->getWhere('jenispemeriksaandetail', ['id' => $idjenispemeriksaandetail])->result_array();
		$noantrian = str_pad($pemohon['antrian_ke'], 3, "0", STR_PAD_LEFT);
		$jamkunj = str_pad($pemohon['jamkunjungan'], 2, "0", STR_PAD_LEFT);
		$antriannya = $jenis[0]['barcode']."-".$jamkunj."-".$noantrian;
        $this->mg->LogAktivitas('Mencetak Barcode No. Antrian : '.$antriannya.' Atas Nama : '.$nama.' No. Registrasi : '.$noregistrasi);
		$filePath = FCPATH."assets/foto/barcode/".$idpasien.'.png';
		$newimage_name=$idpasien.'.jpg';
        $image = imagecreatefrompng($filePath);
		$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
		imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
		imagealphablending($bg, TRUE);
		imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
		imagedestroy($image);
		$quality = 50; // 0 = worst / smaller file, 100 = better / bigger file 
		imagejpeg($bg, $filePath . ".jpg", $quality);
		imagedestroy($bg);
        $data1 = [
            'nama'				=> $pemohon['nama'],
            'tanggalkunjungan'	=> $pemohon['tanggalkunjungan'],
            'jeniskelamin'		=> $pemohon['jeniskelamin'],
            'instansi'			=> $instansi[0]['instansi'],
            'antrian'			=> $antriannya,
            'usia'				=> $y,
            'tanggallahir'		=> tgl_indo($pemohon['tanggallahir']),
            'barcode'			=>$idpasien.'.png.jpg',
        ];
        $html1 = $this->load->view('eklinik/sales/walkindrivethru/cetaklabel', $data1, true);
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
				2, // margin_left
				1, // margin right
				0, // margin top
				1, // margin bottom
				1, // margin header
				1); // margin footer
        $this->mpdf->WriteHTML($html1);
        $this->mpdf->Output($idpasien.".pdf", 'I');
    }

    function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
        $temp = '';
        if ($nilai < 12) {
            $temp = ' '. $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = $this->penyebut($nilai - 10). ' Belas';
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai/10).' Puluh'. $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = ' Seratus' . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai/100) . ' Ratus' . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = ' Seribu' . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai/1000) . ' Ribu' . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai/1000000) . ' Juta' . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai/1000000000) . ' Milyar' . $this->penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai/1000000000000) . ' Trilyun' . $this->penyebut(fmod($nilai,1000000000000));
        }     
        return $temp;
    }
 
    function terbilang($nilai) {
        return ($nilai < 0)? 'minus '.trim($this->penyebut($nilai)) : trim($this->penyebut($nilai));
    }
	public function set_barcode($code, $idpasien){
		$this->load->library('Zend');
		$this->zend->load('Zend/Barcode');
		$file = Zend_Barcode::draw('code128', 'image', array('text' => $code), []);
		$store_image = imagepng($file,FCPATH."assets/foto/barcode/{$idpasien}.png");
	}
}