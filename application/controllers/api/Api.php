<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Api extends CI_Controller
{
    function __construct($config = 'rest') {
        parent::__construct($config);
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('ModelAuth');
    }

    public function index()
    {
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        echo json_encode($response);
    }
	
	public function registrasi()
    {
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        try { 
            $jenis = $this->input->post('jenis'); //SWAB/RAVID.....
            $tipe = "WALKIN"; //HOMESERVICE/WALKIN
            $tgl = date('Y-m-d H:i:s');
            $jamOrderId = date("His");
            $tanggalkunjungan = date("Y-m-d", strtotime($this->input->post('tanggalkunjungan')));
            $jamkunjungan = $this->input->post('jamkunjungan');
            $idpemeriksaan = $this->input->post('idpemeriksaan');
            $idpemeriksaandetail = $this->input->post('idpemeriksaandetail');
            $tipekunjungan = "Walk In";
            $pemeriksaandetail = $this->input->post('pemeriksaandetail');
            $pic_m = $this->input->post('pic_m');

            $nama = $this->input->post('nama');
            $nik = $this->input->post('nik');
            $nomorhp = $this->input->post('nomorhp');
            $email = $this->input->post('email');
            $jeniskelamin = $this->input->post('jeniskelamin');
            $tempatlahir = $this->input->post('tempatlahir');
            $tanggallahir =  date("Y-m-d", strtotime($this->input->post('tanggallahir'))); 
            $alamat = $this->input->post('alamat');
            
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);
            
            //FUNGSI ANTRIAN
            $dataSetting = $this->ModelAuth->getMasterJam($jamkunjungan);
            $antrian_per_jam = $dataSetting->kuota;
            $an = $this->ModelAuth->getAntrian($tanggalkunjungan, $jamkunjungan);
            if($an == null){
                $antrian_ke = 1;
                //INSERT DATA ANTRIAN 1
                $dataAntrian = array( 
                    "tanggal" => $tanggalkunjungan,
                    "jam" => $jamkunjungan,
                    "antrian_ke" => $antrian_ke
                );   
                $this->ModelAuth->InsertData('antrian', $dataAntrian);
            }else{
                if((int)$an->antrian_ke >= (int)$antrian_per_jam){
                    $remars = "Antrian pada tanggal " .$tanggalkunjungan. " dan jam ".$jamkunjungan." sudah penuh. Harap pilih tanggal atau jam lain";
                    throw new \Exception($remars, 200);
                }else{
                    $antrian_ke = (int)$an->antrian_ke + 1;
                    $dataAntrian = array( 
                        "antrian_ke" => $antrian_ke
                    );   
                    $this->ModelAuth->UpdateData('antrian', $dataAntrian, 
                        array(
                            "tanggal" => $tanggalkunjungan,								
                            "jam" => $jamkunjungan
                        )
                    );
                }
            }
            
            $nomorReg = $this->nomorRegistrasi($jamkunjungan);
            $noinvoice = $this->nomorInvoice($jamkunjungan);
			
			$checkNoReg = $this->ModelAuth->checkNoReg($nomorReg);
			$checkNoInv = $this->ModelAuth->checkNoInv($noinvoice);
			
			if($checkNoReg == null AND $checkNoInv == null){
				$dataHarga = $this->ModelAuth->getHarga($idpemeriksaandetail);
				$detailharga = $dataHarga->hargadetail;
				$payment['transaction_details']['order_id'] = $noinvoice. "-" .$jamOrderId;
				$payment['transaction_details']['gross_amount'] = (int)$detailharga;

				$payment['item_details'][0]['id'] = $idpemeriksaandetail;
				$payment['item_details'][0]['price'] = (int)$detailharga;
				$payment['item_details'][0]['quantity'] = 1;
				$payment['item_details'][0]['name'] = strtoupper($jenis)."-".strtoupper($tipe)."-".strtoupper($pemeriksaandetail);

				$payment['customer_details']['email'] = $email;
				$payment['customer_details']['first_name'] = strtoupper($nama);
				$payment['customer_details']['last_name'] = "";
				$payment['customer_details']['phone'] = $nomorhp;

				$payment['custom_expiry']['order_time'] = $tgl. " +0700";
				$payment['custom_expiry']['expiry_duration'] = EXPIRED;
				$payment['custom_expiry']['unit'] = "minute";

				$payResponse = $this->paymentMidtrans($payment);

				if($payResponse != null OR COUNT($payResponse["error_messages"]) == 0){
					$uuidRegPeriksa = strtoupper($this->gen_uuid());
					$data = array( 
						"idinstansi" => ID_INSTANSI,
						"tanggalregistrasi"  => date('Y-m-d'),
						"nomorregistrasi" => $nomorReg,
						"iduser" => "",
						"idpemeriksaan" => $idpemeriksaan,
						"idjenispemeriksaandetail" => $idpemeriksaandetail,
						"pemeriksaandetail" => $pemeriksaandetail,
						"detailharga" => $detailharga,
						"tipekunjungan" => $tipekunjungan,
						"tanggalkunjungan" => $tanggalkunjungan,
						"jamkunjungan" => $jamkunjungan,
						"actualjamkunjungan" => $jamkunjungan.":00",
						"nama" => strtoupper($nama),
						"jeniskelamin" => $jeniskelamin,
						"tanggallahir" => $tanggallahir,
						"tempatlahir" => $tempatlahir,
						"nomorhp" => $nomorhp,
						"statustransaksi" => "Registrasi",
						"email" => $email,
						"nik" => $nik,
						"alamat" => $alamat,
						"map_alamat" => "",
						"map_lat" => "",
						"map_long" => "",
						"harga" => null,
						"antrian_ke" => $antrian_ke,
						"noinvoice" => $noinvoice,
						"pic_m" => $pic_m,
						"created_by" => "WEB IP:".$this->input->ip_address(),
						'created_date' => date('Y-m-d H:i:s')
					);   
					$this->ModelAuth->InsertData('regperiksa', $data);
					$this->db->trans_complete();

					if ($this->db->trans_status() === FALSE) {
						$response['status_json'] = false;
						$response['remarks'] = "Registrasi gagal, silakan coba beberapa saat lagi";
						$this->db->trans_rollback();
					} 
					else {
						$response['idregistrasi'] = $uuidRegPeriksa;
						$response['nomorReg'] = $nomorReg;
						$response['noinvoice'] = $noinvoice;
						$response['tanggal_order'] = $tgl;
						$response['tanggal_kun'] = $tanggalkunjungan;
						$response['jam_kun'] = $jamkunjungan;
						$response['token'] = $payResponse["token"];
						$response['result_midtrans'] = $payResponse;
						$response['redirect_url'] = $payResponse["redirect_url"];
						$this->db->trans_commit();
					}
				}else{
					$response['status_json'] = false;
					$response['remarks'] = "Registrasi gagal, silakan coba beberapa saat lagi";
					$this->db->trans_rollback();
				}
			}else{
				$response['status_json'] = false;
				$response['remarks'] = "Registrasi gagal, silakan coba beberapa saat lagi";
				$this->db->trans_rollback();
			}
        } catch (\Exception $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
			$url = $this->router->fetch_class()."/".$this->router->fetch_method();
        }
        echo json_encode($response);
    }
	
	public function reschedule()
    {
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        try { 
            $nomorregistrasi = $this->input->post('nomorregistrasi'); 
            $tanggalkunjungan = date("Y-m-d", strtotime($this->input->post('tanggalkunjungan')));
            $jamkunjungan = $this->input->post('jamkunjungan');
			$tgl = date('Y-m-d H:i:s');
            
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);
            
            //FUNGSI ANTRIAN
            $dataSetting = $this->ModelAuth->getMasterJam($jamkunjungan);
            $antrian_per_jam = $dataSetting->kuota;
            $an = $this->ModelAuth->getAntrian($tanggalkunjungan, $jamkunjungan);
            if($an == null){
                $antrian_ke = 1;
                //INSERT DATA ANTRIAN 1
                $dataAntrian = array( 
                    "tanggal" => $tanggalkunjungan,
                    "jam" => $jamkunjungan,
                    "antrian_ke" => $antrian_ke
                );   
                $this->ModelAuth->InsertData('antrian', $dataAntrian);
            }else{
                if((int)$an->antrian_ke >= (int)$antrian_per_jam){
                    $remars = "Antrian pada tanggal " .$tanggalkunjungan. " dan jam ".$jamkunjungan." sudah penuh. Harap pilih tanggal atau jam lain";
                    throw new \Exception($remars, 200);
                }else{
                    $antrian_ke = (int)$an->antrian_ke + 1;
                    $dataAntrian = array( 
                        "antrian_ke" => $antrian_ke
                    );   
                    $this->ModelAuth->UpdateData('antrian', $dataAntrian, 
                        array(
                            "tanggal" => $tanggalkunjungan,								
                            "jam" => $jamkunjungan
                        )
                    );
                }
            }
			
			//START EDIT DATA TRANSAKSI
			$data = array( 
				"tanggalkunjungan" => date("Y-m-d", strtotime($tanggalkunjungan)),
				"jamkunjungan" => $jamkunjungan,
				"antrian_ke" => $antrian_ke,
				'modified_date' => $tgl
			);   
			$this->ModelAuth->UpdateData('regperiksa', $data, array("nomorregistrasi" => $nomorregistrasi));
			$this->db->trans_complete();
			
			//END DATA TRANSAKSI
			if ($this->db->trans_status() === FALSE) {
				$response['status_json'] = false;
				$response['remarks'] = "Gagal reschedule kunjungan, silakan coba beberapa saat lagi";
				$this->db->trans_rollback();
			} 
			else {
				$dataWA = $this->ModelAuth->getRegPeriksaByNoReg($nomorregistrasi);
				if($dataWA != null){
					if($dataWA->carabayar == "Lunas"){
						$this->successWA($dataWA->nomorhp, $dataWA);
					}
				}
				$this->cancelJam($tanggalkunjungan, $jamkunjungan);
				$this->db->trans_commit();
			}
        } catch (\Exception $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
			$url = $this->router->fetch_class()."/".$this->router->fetch_method();
        }
        echo json_encode($response);
    }
	
	public function checkreg()
	{
		header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        try { 
            $nomorregistrasi = $this->input->post('nomorregistrasi'); 
			$data = $this->ModelAuth->getRegPeriksaByNoReg($nomorregistrasi);
			if($data != null){
				//BIODATA
				$response['nama'] = $data->nama;
				$response['nik'] = $data->nik;
				$response['tanggallahir'] = $data->tanggallahir;
				$response['nomorhp'] = $data->nomorhp;
				
				//JENIS PEMERIKSAAN
				$response['idpemeriksaan'] = $data->idpemeriksaan;
				$response['idjenispemeriksaandetail'] = $data->idjenispemeriksaandetail;
				$response['namajenispemeriksaan'] = $data->namajenispemeriksaan;
				$response['pemeriksaandetail'] = $data->pemeriksaandetail;
				$response['detailharga'] = $data->detailharga;
				
				//WAKTU KUNJUNGAN
				$response['tanggalkunjungan'] = $data->tanggalkunjungan;
				$response['jamkunjungan'] = $data->jamkunjungan;
				$response['antrian_ke'] = $data->antrian_ke;
				
				//TRANSAKSI
				$response['statustransaksi'] = $data->statustransaksi;
				$response['carabayar'] = $data->carabayar;
				
			}else{
				$response['status_json'] = false;
				$response['remarks'] = "Nomor registrasi tidak ditemukan";
			}
			
		} catch (\Exception $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
			$url = $this->router->fetch_class()."/".$this->router->fetch_method();
        }
        echo json_encode($response);
	}

    public function cancel()
    {
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        try { 
            $nomorregistrasi = $this->input->post('nomorregistrasi');
            $tanggalkunjungan = date("Y-m-d", strtotime($this->input->post('tanggalkunjungan')));
            $jamkunjungan = $this->input->post('jamkunjungan');
			
			//$this->paymentMidtransCancel();
			
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $this->ModelAuth->DeleteData('regperiksa', array("nomorregistrasi" => $nomorregistrasi));
            
            $an = $this->ModelAuth->getAntrian($tanggalkunjungan, $jamkunjungan);
            $antrian_ke = (int)$an->antrian_ke - 1;
            $dataAntrian = array( 
                "antrian_ke" => $antrian_ke
            );   
            $this->ModelAuth->UpdateData('antrian', $dataAntrian, 
                array(
                    "tanggal" => $tanggalkunjungan,								
                    "jam" => $jamkunjungan
                )
            );
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $response['status_json'] = false;
                $response['remarks'] = "Cancel transaksi gagal";
                $this->db->trans_rollback();
            } 
            else {
                $this->db->trans_commit();
            }
        } catch (\Exception $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
			$url = $this->router->fetch_class()."/".$this->router->fetch_method();
        }
        echo json_encode($response);
    }

    public function update()
    {
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        try { 
            $tgl = date("Y-m-d", strtotime($this->input->post('tgl')));
            $transaction_id = $this->input->post('transaction_id');
            $gross_amount = $this->input->post('gross_amount');
            $noinvoice = $this->input->post('noinvoice');
            $nomorReg = $this->input->post('nomorReg');
            $transaction_status = $this->input->post('transaction_status');
            $Expired = date("Y-m-d H:i:s", strtotime(strval(EXPIRED).' minutes', strtotime($tgl)));

            if($transaction_status == "settlement"){
				$dataCetak = $this->generateInvoice($request->transaction_id);
                $status = "SUCCESS";
                $statusTr = "Dalam Proses";
                $remarks = "Pembayaran berhasil";
            }else if($transaction_status == "cancel"){
                $status = "CANCEL";
                $statusTr = "Transakasi dibatalkan";
                $remarks = "Pembayaran dibatalkan";
            } else if($transaction_status == "expire"){
                $status = "EXPIRE";
                $statusTr = "Transakasi dibatalkan";
                $remarks = "Pembayaran dibatalkan";
            } else if($transaction_status == "pending"){
                $status = "PENDING";
                $statusTr = "Menunggu Pembayaran";
                $remarks = "Menunggu Pembayaran";
            } else {
                $status = $transaction_status;
                $remarks = $transaction_status;
                $statusTr = $transaction_status;
            }

            $this->db->trans_start();
            $this->db->trans_strict(FALSE);
			
			$dataReg = $this->ModelAuth->getRegByNoInvoice($noinvoice);
			$dataPay = $this->ModelAuth->getPayByNoInvoice($noinvoice);
			$Expired = date("Y-m-d H:i:s", strtotime(strval(EXPIRED).' minutes', strtotime($dataReg->created_date)));
			if($dataPay == null){
				$dataPayment = array( 
					"transaction_id" => $transaction_id,
					"bank_cstore" => "Transfer",
					"idinstansi" => ID_INSTANSI,
					"va_number" => "",
					"harga" => $gross_amount,
					"jamorder" => null,
					"noinvoice" => $noinvoice,
					"status" => $status,
					"remarks" => $remarks,
					"expire_date" => $Expired,
					'created_date' => $dataReg->created_date
				);   
				$this->ModelAuth->InsertData('payment', $dataPayment);
			}	

            $updateReg = array( 
                "idpayment" => $transaction_id,
                "statustransaksi" => $statusTr,
                'modified_date' => date('Y-m-d H:i:s')
            );   
            $this->db->update('regperiksa', $updateReg, array("noinvoice" => $noinvoice));

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $response['status_json'] = false;
                $response['remarks'] = "Cancel transaksi gagal";
                $this->db->trans_rollback();
            } 
            else {
                $response['nomorReg'] = $nomorReg;
                $response['noinvoice'] = $noinvoice;
                $this->db->trans_commit();
            }
        } catch (\Exception $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
			$url = $this->router->fetch_class()."/".$this->router->fetch_method();
        }
        echo json_encode($response);
    }
    
	function cancelJam($tanggalkunjungan, $jamkunjungan)
	{
		$an = $this->ModelAuth->getAntrian($tanggalkunjungan, $jamkunjungan);
		$antrian_ke = (int)$an->antrian_ke - 1;
		$dataAntrian = array( 
			"antrian_ke" => $antrian_ke
		);   
		$this->ModelAuth->UpdateData('antrian', $dataAntrian, 
			array(
				"tanggal" => $tanggalkunjungan,								
				"jam" => $jamkunjungan
			)
		);
	}
	
    function nomorRegistrasi($jamkunjungan)
	{
        $nomorinv = "SP".date('dmY');
		$his = date('His');
		$nomorRegistrasi = $nomorinv."".$his."".$jamkunjungan;
        return $nomorRegistrasi;
    }
	
	public function successWA($phone, $data) 
	{ 
		$nama = $data->nama;
		$antrian_ke = $data->antrian_ke;
		$nomorregistrasi = $data->nomorregistrasi;
		$tanggal = date("d M Y", strtotime($data->tanggalkunjungan));
		$jam = $data->jamkunjungan.":00";
		$message = "Halo ".$nama.",\n\Reschedule dengan Nomor *".$nomorregistrasi."* telah berhasil.\nSilakan antre pada \nTanggal : *".$tanggal."*\nJam : *".$jam."*\nDengan Nomor Antrian *".$antrian_ke."*\n\nTerimakasih\n_Speedlab by Lentera_";
		$curl = curl_init();
		$token = "GgpddGb4HAMGYCstkajFOJB2Ifl5wDzI4cnp1BZm2ktsegjLklE93pc7Ae2drdvw";
		$data = [
			'phone' => $phone,
			'message' => $message,
		];

		curl_setopt($curl, CURLOPT_HTTPHEADER,
			array(
				"Authorization: $token",
			)
		);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_URL, "https://ampel.wablas.com/api/send-message");
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($curl);
		curl_close($curl);

	}
	
	function nomorInvoice($jamkunjungan)
	{
        $nomorinv = "INV".date('dmY');
		$his = date('His');
		$nomorInvoice = $nomorinv."".$his."".$jamkunjungan;
        return $nomorInvoice;
    }
	
	function gen_uuid()
	{
		return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
			mt_rand( 0, 0xffff ),
			mt_rand( 0, 0x0fff ) | 0x4000,
			mt_rand( 0, 0x3fff ) | 0x8000,
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}
    
    function paymentMidtrans($obj)
	{
        $data = json_encode($obj);
        $url = MIDTRANS_URL;
        $key = MIDTRANS_KEY;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type:application/json',
                    'Accept: application/json',
                    'Authorization: '.$key.'' 
                ));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT,30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, TRUE);
    }
	
	function paymentMidtransCancel($transaction_id)
	{
        $url = MIDTRANS_BASE_URL . "v2/".$transaction_id."/cancel";
        $key = MIDTRANS_KEY;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type:application/json',
                    'Accept: application/json',
                    'Authorization: '.$key.'' 
                ));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT,30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, TRUE);
    }
}