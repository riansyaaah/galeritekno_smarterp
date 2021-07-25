<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datapasien extends CI_Controller
{
  function __Construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');
    $this->load->model('eklinik/rawatjalan/ModelRawatJalan');
  }

  var $idMenu = "7b419abf-3735-4d94-a671-36ecfb7b6f0d";
  var $jenisRegistrasi = "4";

  public function index()
  {
    cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Data Rawat Jalan',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,

    );
    $this->load->view('eklinik/rawatjalan/v_rawatjalan', $data);
  }

  public function getRawatjalan()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->ModelRawatJalan->getRawatjalan();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/rawatjalan/datapasien/proses/".$d['id']."' class='btn btn-warning' target='_blank'>PROSES</a>";
      $data[] = array(
        "no" => $no,
        "poliklinik" => $d['namapoliklinik'],
        "dokter" => $d['namadokter'],
        "nomorregistrasi" => $d['nomorregistrasi'],
        "nama" => $d['nama'],
        "tempatlahir" => $d['tempatlahir'],
        "tanggallahir" => $d['tanggallahir'],
        "jeniskelamin" => $d['jeniskelamin'],
        "alamat" => $d['alamat'],
        "option" => $option,
      );
      $no++;
    }
      $response['data'] = (count($datas) > 0)? $data : [];
    echo json_encode($response);
  }
    
  public function proses($id)
    {
    cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

           
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Proses Tindakan Rawat Jalan',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'id'	=> $id,
        'getitem'         => $this->ModelRawatJalan->getItemperiksa(" where id_paren like '1%' order by id asc"),
    );
    $this->load->view('eklinik/rawatjalan/v_prosesrawatjalan', $data);
  }
    
    function getData()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		$response['remarks'] = "Berhasil get data";
		try {
            $id  = $this->input->post('id');
			$check = $this->ModelRawatJalan->get_by_id($id);
			if ($check != null) {
               $response['data'] = $check;
			} else {
				$response['status_json'] = false;
				$response['remarks'] = "No Registrasi ".$id." tidak ditemukan";
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
    }
    
    public function getDataDiagnosaICDX()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
        $noregistrasi		= $this->input->post('noregistrasi');
    $datas = $this->db->query("select ekl_pasienrawatjalan_diagnosaicdx.id, ekl_pasienrawatjalan_diagnosaicdx.jenisdiagnosa, ekl_pasienrawatjalan_diagnosaicdx.kasus, ekl_pasienrawatjalan_diagnosaicdx.keterangan,ekl_masterdiagnosaicdx.kodeicd, ekl_masterdiagnosaicdx.namaindonesia from ekl_pasienrawatjalan_diagnosaicdx left join ekl_masterdiagnosaicdx on ekl_pasienrawatjalan_diagnosaicdx.iddiagnosa = ekl_masterdiagnosaicdx.id where noregistrasi = '$noregistrasi'")->result_array();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/rawatjalan/datapasien/hapusicdx/".$d['id']."' class='btn btn-danger' target='_blank'><i class='fas fa-trash-alt'></i></a>";
      $data[] = array(
        "no" => $no,
        "kodeicd" => $d['kodeicd'],
        "namaindonesia" => $d['namaindonesia'],
        "jenisdiagnosa" => $d['jenisdiagnosa'],
        "kasus" => $d['kasus'],
        "keterangan" => $d['keterangan'],
        "option" => $option,
      );
      $no++;
    }
      $response['data'] = (count($datas) > 0)? $data : [];
    echo json_encode($response);
  }
    public function getDataTindakan()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
        $noregistrasi		= $this->input->post('noregistrasi');
    $datas = $this->db->query("select ekl_pasienrawatjalan_tindakan.id, ekl_pasienrawatjalan_tindakan.jumlah, ekl_mastertindakan.nama as namatindakan, ekl_perawat.nama as namapelaksana from ekl_pasienrawatjalan_tindakan 
    left join ekl_mastertindakan on ekl_pasienrawatjalan_tindakan.idtindakan = ekl_mastertindakan.id 
    left join ekl_perawat on ekl_pasienrawatjalan_tindakan.idpelaksana = ekl_perawat.id 
    where noregistrasi = '$noregistrasi'")->result_array();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/rawatjalan/datapasien/hapustindakan/".$d['id']."' class='btn btn-danger' target='_blank'>X</a>";
      $data[] = array(
        "no" => $no,
        "namatindakan" => $d['namatindakan'],
        "namapelaksana" => $d['namapelaksana'],
        "jumlah" => $d['jumlah'],
        "option" => $option,
      );
      $no++;
    }
      $response['data'] = (count($datas) > 0)? $data : [];
    echo json_encode($response);
  }
    public function getDataBHP()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
        $noregistrasi		= $this->input->post('noregistrasi');
    $datas = $this->db->query("select ekl_pasienrawatjalan_bhp.id, ekl_pasienrawatjalan_bhp.jumlah, ekl_pasienrawatjalan_bhp.keterangan,ekl_masterbhp.nama as namabhp, ekl_masterbhp.satuan from ekl_pasienrawatjalan_bhp 
    left join ekl_masterbhp on ekl_pasienrawatjalan_bhp.idbhp = ekl_masterbhp.id 
    where noregistrasi = '$noregistrasi'")->result_array();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/rawatjalan/datapasien/hapusbhp/".$d['id']."' class='btn btn-danger' target='_blank'><i class='fas fa-trash-alt'></i></a>";
      $data[] = array(
        "no" => $no,
        "namabhp" => $d['namabhp'],
        "satuan" => $d['satuan'],
        "keterangan" => $d['keterangan'],
        "jumlah" => $d['jumlah'],
        "option" => $option,
      );
      $no++;
    }
      $response['data'] = (count($datas) > 0)? $data : [];
    echo json_encode($response);
  }
    public function getDataResep()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
        $noregistrasi		= $this->input->post('noregistrasi');
    $datas = $this->db->query("select ekl_pasienrawatjalan_resep.*,ekl_masterobat.nama as namaobat, ekl_masterobat.satuan from ekl_pasienrawatjalan_resep 
    left join ekl_masterobat on ekl_pasienrawatjalan_resep.idobat = ekl_masterobat.id where noregistrasi = '$noregistrasi'")->result_array();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/rawatjalan/datapasien/hapusresep/".$d['id']."' class='btn btn-danger' target='_blank'><i class='fas fa-trash-alt'></i></a>";
      $data[] = array(
        "no" => $no,
        "namaobat" => $d['namaobat'],
        "satuan" => $d['satuan'],
        "jumlah" => $d['jumlah'],
        "aturanpakai" => $d['aturanpakai'],
        "waktupenggunaan" => $d['waktupenggunaan'],
        "carapenggunaan" => $d['carapenggunaan'],
        "option" => $option,
      );
      $no++;
    }
      $response['data'] = (count($datas) > 0)? $data : [];
    echo json_encode($response);
  }
    public function getDataLab()
    {
        
        
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $noregistrasi		= $this->input->post('noregistrasi');
        
        $datas = $this->db->query("select ekl_pasienlaboratorium_detail.id as iddetail, ekl_pasienlaboratorium_detail.id_pasienlab, ekl_pasienlaboratorium_detail.id_item, ekl_pasienlaboratorium_detail.hasil, ekl_pasienlaboratorium_detail.keterangan,ekl_itemperiksa.satuan, ekl_itemperiksa.input,ekl_itemperiksa.uraian, ekl_itemperiksa.level, ekl_itemperiksa.nama_item as namaitem 
        from ekl_pasienlaboratorium_detail 
        left join ekl_itemperiksa on ekl_pasienlaboratorium_detail.id_item = ekl_itemperiksa.id
        left join ekl_pasienlaboratorium on ekl_pasienlaboratorium_detail.id_pasienlab = ekl_pasienlaboratorium.id
        where ekl_pasienlaboratorium.noregistrasi = '$noregistrasi' order by ekl_pasienlaboratorium_detail.id_item asc")->result_array();
        foreach ($datas as $d) {
            if($d['keterangan'] != NULL and $d['keterangan'] != 'Normal'){
               $keterangan = "<font color='red'>".$d['keterangan']."</font>";
            }else{
                $keterangan = "<font>".$d['keterangan']."</font>";
            }
            

            $data[] = array(
                "namaitem" => $d['namaitem'],
                "satuan" => $d['satuan'],
                "hasil" => $d['hasil'],
                "keterangan" => $keterangan,

            );
        }
        if (count($datas) > 0) {
            $response['data'] = $data;
        } else {
            $response['data'] = array();
        }
        echo json_encode($response);
    }
    public function getDataPenunjang()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
        $noregistrasi		= $this->input->post('noregistrasi');
    $datas = $this->db->query("
    select id, tanggalkunjungan, diagnosa, catatandokter,hasil, 'audiometri' as jenis from ekl_pasienaudiometri where noregistrasi = '$noregistrasi'
    UNION ALL
    select id, tanggalkunjungan, diagnosa, catatandokter,hasil, 'ekg' as jenis from ekl_pasienekg where noregistrasi = '$noregistrasi'
    UNION ALL
    select id, tanggalkunjungan, diagnosa, catatandokter,hasil, 'spirometri' as jenis from ekl_pasienspirometri where noregistrasi = '$noregistrasi'
    UNION ALL
    select id, tanggalkunjungan, diagnosa, catatandokter,hasil, 'treadmill' as jenis from ekl_pasientreadmill where noregistrasi = '$noregistrasi'
    UNION ALL
    select id, tanggalkunjungan, diagnosa, catatandokter,hasil, 'thorax' as jenis from ekl_pasienthorax where noregistrasi = '$noregistrasi'
    UNION ALL
    select id, tanggalkunjungan, diagnosa, catatandokter,hasil, 'usgabdomen' as jenis from ekl_pasienusgabdomen where noregistrasi = '$noregistrasi'
    ")->result_array();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/rawatjalan/datapasien/hapuspenunjang/".$d['id']."/".$d['jenis']."' class='btn btn-danger' target='_blank'><i class='fas fa-trash-alt'></i></a>
      <a href='".base_url()."eklinik/rawatjalan/datapasien/cetakhasil/".$d['id']."/".$d['jenis']."' class='btn btn-success' target='_blank'>Download Hasil</a>";
      $data[] = array(
        "no" => $no,
        "jenis" => $d['jenis'],
        "tanggalkunjungan" => $d['tanggalkunjungan'],
        "diagnosa" => $d['diagnosa'],
        "catatandokter" => $d['catatandokter'],
        "hasil" => $d['hasil'],
        "option" => $option,
      );
      $no++;
    }
      $response['data'] = (count($datas) > 0)? $data : [];
    echo json_encode($response);
  }
    public function rawatjalan_act()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $response['remarks'] = "Berhasil menyimpan Data Pasien";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);


		try {
			$datennow = date('Y-m-d H:i:s');
			$id 		= $this->input->post('id');
			
    $petugas 		= $this->input->post('petugas');
    $selesai 		= $this->input->post('selesai');
    $kondisimasuk 		= $this->input->post('kondisimasuk');
    $carakeluar 		= $this->input->post('carakeluar');
    $kondisikeluar 		= $this->input->post('kondisikeluar');
    $tanggalkeluar 		= $this->input->post('tanggalkeluar');
    $jamkeluar 		= $this->input->post('jamkeluar');
            
            
			$post = true;
			if ($post) {
                   
					$data = array(
           'petugas'		=> $petugas,
           'selesai'		=> $selesai,
           'kondisimasuk'		=> $kondisimasuk,
           'carakeluar'		=> $carakeluar,
           'kondisikeluar'		=> $kondisikeluar,
           'tanggalkeluar'		=> $tanggalkeluar,
           'jamkeluar'		=> $jamkeluar,
						);
                    $this->ModelRawatJalan->update($id, $data);
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien');
                    
				$this->db->trans_complete();
				$this->db->trans_commit();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
    public function fisik_act()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $response['remarks'] = "Berhasil menyimpan Data Pasien";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);


		try {
			$datennow = date('Y-m-d H:i:s');
			$noregistrasi		= $this->input->post('noregistrasi');
			
    $tinggibadan 		= $this->input->post('tinggibadan');
    $beratbadan 		= $this->input->post('beratbadan');
    $detakjantung 		= $this->input->post('detakjantung');
    $tekanandarah 		= $this->input->post('tekanandarah');
    $suhubadan 		= $this->input->post('suhubadan');
    $nafas 		= $this->input->post('nafas');
    $keluhan 		= $this->input->post('keluhan');
    $riwayatpenyakit 		= $this->input->post('riwayatpenyakit');
    $riwayatpenyakitkeluarga 		= $this->input->post('riwayatpenyakitkeluarga');
                
			$post = true;
			if ($post) {
                   
					$data = array(
           'noregistrasi'		=> $noregistrasi,
           'tinggibadan'		=> $tinggibadan,
           'beratbadan'		=> $beratbadan,
           'detakjantung'		=> $detakjantung,
           'tekanandarah'		=> $tekanandarah,
           'suhubadan'		=> $suhubadan,
           'nafas'		=> $nafas,
           'keluhan'		=> $keluhan,
           'riwayatpenyakit'		=> $riwayatpenyakit,
           'riwayatpenyakitkeluarga'		=> $riwayatpenyakitkeluarga,
						);
                $cek = $this->db->query("select * from ekl_pasienrawatjalan_fisik where noregistrasi = '$noregistrasi' limit 1")->result_array();
                if(count($cek)>0){
                    $this->ModelRawatJalan->UpdateData("ekl_pasienrawatjalan_fisik",$data,array('noregistrasi'=>$noregistrasi));
                }else{
                    $this->ModelRawatJalan->InsertData("ekl_pasienrawatjalan_fisik",$data);
                }
                    
                    
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien');
                    
				$this->db->trans_complete();
				$this->db->trans_commit();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
    public function soap_act()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $response['remarks'] = "Berhasil menyimpan Data Pasien";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);


		try {
			$datennow = date('Y-m-d H:i:s');
			$noregistrasi		= $this->input->post('noregistrasi');
			
    $soap_tanggal 		= $this->input->post('soap_tanggal');
    $soap_keluhan 		= $this->input->post('soap_keluhan');
    $soap_pemeriksaan 		= $this->input->post('soap_pemeriksaan');
    $soap_kesimpulan 		= $this->input->post('soap_kesimpulan');
    $soap_rencana 		= $this->input->post('soap_rencana');
                
			$post = true;
			if ($post) {
                   
					$data = array(
           'noregistrasi'		=> $noregistrasi,
           'tanggal'		=> $soap_tanggal,
           'subject'		=> $soap_keluhan,
           'object'		=> $soap_pemeriksaan,
           'assesment'		=> $soap_kesimpulan,
           'plan'		=> $soap_rencana,
						);
                $cek = $this->db->query("select * from ekl_pasienrawatjalan_soap where noregistrasi = '$noregistrasi' limit 1")->result_array();
                if(count($cek)>0){
                    $this->ModelRawatJalan->UpdateData("ekl_pasienrawatjalan_soap",$data,array('noregistrasi'=>$noregistrasi));
                }else{
                    $this->ModelRawatJalan->InsertData("ekl_pasienrawatjalan_soap",$data);
                }
                    
                    
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien');
                    
				$this->db->trans_complete();
				$this->db->trans_commit();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
    public function penunjang_act()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $response['remarks'] = "Berhasil menyimpan Data Pasien";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);


		try {
			$datennow = date('Y-m-d H:i:s');
			$noregistrasi		= $this->input->post('noregistrasi');
			
    $penunjang_tanggalkunjungan 		= $this->input->post('penunjang_tanggalkunjungan');
    $penunjang_pemeriksaan 		= $this->input->post('penunjang_pemeriksaan');
                
			$post = true;
			if ($post) {
                   
					$data = array(
           'noregistrasi'		=> $noregistrasi,
           'tanggalkunjungan'		=> $penunjang_tanggalkunjungan,
						);
                
                if($penunjang_pemeriksaan == '2.1'){
                                $this->ModelRawatJalan->InsertData('ekl_pasienekg', $data);
                            }
                            if($penunjang_pemeriksaan == '2.2'){
                                $this->ModelRawatJalan->InsertData('ekl_pasientreadmill', $data);
                            }
                            if($penunjang_pemeriksaan == '2.3'){
                                $this->ModelRawatJalan->InsertData('ekl_pasienspirometri', $data);
                            }
                            if($penunjang_pemeriksaan == '2.4'){
                                $this->ModelRawatJalan->InsertData('ekl_pasienaudiometri', $data);
                            }
                            if($penunjang_pemeriksaan == '3.1'){
                                $this->ModelRawatJalan->InsertData('ekl_pasienthorax', $data);
                            }
                            if($penunjang_pemeriksaan == '3.2'){
                                $this->ModelRawatJalan->InsertData('ekl_pasienusgabdomen', $data);
                            }
                    
                
                    
                    
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien');
                    
				$this->db->trans_complete();
				$this->db->trans_commit();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
    
    public function diagnosaidcx_act()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $response['remarks'] = "Berhasil menyimpan Data Pasien";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);


		try {
			$datennow = date('Y-m-d H:i:s');
			$noregistrasi		= $this->input->post('noregistrasi');
			
    $iddiagnosa 		= $this->input->post('iddiagnosa');
    $jenisdiagnosa 		= $this->input->post('jenisdiagnosa');
    $kasus 		= $this->input->post('kasus');
    $keterangan 		= $this->input->post('keterangan');
                
			$post = true;
			if ($post) {
                   
					$data = array(
           'noregistrasi'		=> $noregistrasi,
           'iddiagnosa'		=> $iddiagnosa,
           'jenisdiagnosa'		=> $jenisdiagnosa,
           'kasus'		=> $kasus,
           'keterangan'		=> $keterangan,
						);
                
                    $this->ModelRawatJalan->InsertData("ekl_pasienrawatjalan_diagnosaicdx",$data);
                    
                    
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien');
                    
				$this->db->trans_complete();
				$this->db->trans_commit();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
    
    public function tindakan_act()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $response['remarks'] = "Berhasil menyimpan Data Pasien";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);


		try {
			$datennow = date('Y-m-d H:i:s');
			$noregistrasi		= $this->input->post('noregistrasi');
			
    $idtindakan 		= $this->input->post('idtindakan');
    $idpelaksana 		= $this->input->post('idpelaksana');
    $jumlah 		= $this->input->post('jumlah');
                
			$post = true;
			if ($post) {
                   
					$data = array(
           'noregistrasi'		=> $noregistrasi,
           'idtindakan'		=> $idtindakan,
           'idpelaksana'		=> $idpelaksana,
           'jumlah'		=> $jumlah,
						);
                
                    $this->ModelRawatJalan->InsertData("ekl_pasienrawatjalan_tindakan",$data);
                    
                    
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien');
                    
				$this->db->trans_complete();
				$this->db->trans_commit();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
    
    public function bhp_act()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $response['remarks'] = "Berhasil menyimpan Data Pasien";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);


		try {
			$datennow = date('Y-m-d H:i:s');
			$noregistrasi		= $this->input->post('noregistrasi');
			
    $idbhp 		= $this->input->post('idbhp');
    $jumlah 		= $this->input->post('jumlah');
    $keterangan 		= $this->input->post('keterangan');
                
			$post = true;
			if ($post) {
                   
					$data = array(
           'noregistrasi'		=> $noregistrasi,
           'idbhp'		=> $idbhp,
           'jumlah'		=> $jumlah,
           'keterangan'		=> $keterangan,
						);
                
                    $this->ModelRawatJalan->InsertData("ekl_pasienrawatjalan_bhp",$data);
                    
                    
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien');
                    
				$this->db->trans_complete();
				$this->db->trans_commit();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
    public function resep_act()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $response['remarks'] = "Berhasil menyimpan Data Pasien";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);


		try {
			$datennow = date('Y-m-d H:i:s');
			$noregistrasi		= $this->input->post('noregistrasi');
			
    $idobat 		= $this->input->post('idobat');
    $jumlah 		= $this->input->post('jumlah');
    $aturanpakai 		= $this->input->post('aturanpakai');
    $waktupenggunaan 		= $this->input->post('waktupenggunaan');
    $carapenggunaan 		= $this->input->post('carapenggunaan');
                
			$post = true;
			if ($post) {
                   
					$data = array(
           'noregistrasi'		=> $noregistrasi,
           'idobat'		=> $idobat,
           'jumlah'		=> $jumlah,
           'aturanpakai'		=> $aturanpakai,
           'waktupenggunaan'		=> $waktupenggunaan,
           'carapenggunaan'		=> $carapenggunaan,
						);
                
                    $this->ModelRawatJalan->InsertData("ekl_pasienrawatjalan_resep",$data);
                    
                    
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien');
                    
				$this->db->trans_complete();
				$this->db->trans_commit();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
    
    public function lab_act()
	{
		cek_session($this->idMenu);
		$session = $this->session->userdata('login');
		header("Content-Type: application/json");
		$response = [];
		$response['status_json'] = true;
		// $response['remarks'] = "Berhasil menyimpan Data Pasien";
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);


		try {
			$datennow = date('Y-m-d H:i:s');
			$noregistrasi		= $this->input->post('noregistrasi');
			
            $dataiddetail = $this->input->post('datalab');
                
			$post = true;
			if ($post) {
                   
					$data = array(
           'noregistrasi'		=> $noregistrasi,
						);
                $cek = $this->db->query("select * from ekl_pasienlaboratorium where noregistrasi = '$noregistrasi' limit 1")->result_array();
                if(count($cek)>0){
                    $id_pasienlab = $cek[0]['id'];
                    foreach($dataiddetail as $idlapab){

                                $check = $this->ModelRawatJalan->getLabdetail("where id_item = '$idlapab' and id_pasienlab = '$id_pasienlab' limit 1");
                                if(count($check) > 0 ){

                                }else{

                                    $dataInsert = array(
                                       'id_pasienlab'      => $id_pasienlab,
                                       'id_item'      => $idlapab,
                                    );
                                    $this->ModelRawatJalan->InsertData('ekl_pasienlaboratorium_detail', $dataInsert);

                                }
                              
                                }
                }else{
                    $this->ModelRawatJalan->InsertData("ekl_pasienlaboratorium",$data);
                    $id_pasienlab = $this->db->insert_id();
                                foreach($dataiddetail as $idlapab){

                                $check = $this->ModelRawatJalan->getLabdetail("where id_item = '$idlapab' and id_pasienlab = '$id_pasienlab' limit 1");
                                if(count($check) > 0 ){

                                }else{

                                    $dataInsert = array(
                                       'id_pasienlab'      => $id_pasienlab,
                                       'id_item'      => $idlapab,
                                    );
                                    $this->ModelRawatJalan->InsertData('ekl_pasienlaboratorium_detail', $dataInsert);

                                }
                              
                                }
                }
                    
                    
					$response['remarks'] = "Berhasil Memperbarui Data Pasien";
					$this->ModelGeneral->LogActivity('Process Edit Pasien');
                    
				$this->db->trans_complete();
				$this->db->trans_commit();
			}
		} catch (\Throwable $e) {
			$response['status_json'] = false;
			$response['remarks'] = $e->getMessage();
			$this->db->trans_rollback();
			$this->ModelGeneral->LogError(current_url(),  $e->getMessage());
		}
		echo json_encode($response);
	}
     function getDokter()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->db->query("select * from ekl_dokter")->result_array(); 
        $response['data'] = $data; 
        echo json_encode($response);
    }
    
    function getPetugas()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->db->query("select * from ekl_perawat")->result_array(); 
        $response['data'] = $data; 
        echo json_encode($response);
    }
    function getPoliklinik()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->db->query("select * from ekl_poliklinik")->result_array(); 
        $response['data'] = $data; 
        echo json_encode($response);
    }
    function getDiagnosaicdx()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->db->query("select * from ekl_masterdiagnosaicdx")->result_array(); 
        $response['data'] = $data; 
        echo json_encode($response);
    }
    function getTindakan()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->db->query("select * from ekl_mastertindakan")->result_array(); 
        $response['data'] = $data; 
        echo json_encode($response);
    }
    function getPenunjang()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->db->query("select * from ekl_itemperiksa where id NOT LIKE '1%' and level = 'KELOMPOK'")->result_array(); 
        $response['data'] = $data; 
        echo json_encode($response);
    }
    function getObat()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->db->query("select * from ekl_masterobat")->result_array(); 
        $response['data'] = $data; 
        echo json_encode($response);
    }
    function getBHP()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $data = $this->db->query("select * from ekl_masterbhp")->result_array(); 
        $response['data'] = $data; 
        echo json_encode($response);
    }
    
}
