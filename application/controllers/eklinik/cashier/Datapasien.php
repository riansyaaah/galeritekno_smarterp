<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datapasien extends CI_Controller
{
  function __Construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');
      $this->load->library('m_pdf');
      $this->load->helper('tgl_indo');
    $this->load->model('eklinik/ModelGeneral');
    $this->load->model('eklinik/cashier/ModelCashier');
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
      'title'         => 'Data Pembayaran Pasien',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,

    );
    $this->load->view('eklinik/cashier/v_datapasien', $data);
  }

  public function getData()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->ModelCashier->getData();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/cashier/datapasien/proses/".$d['nomorregistrasi']."' class='btn btn-primary' target='_blank'>Proses</a>";
      $data[] = array(
        "no" => $no,
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
    
    public function refreshrincian($noregistrasi,$idpenjamin){
        
        
        $editpeserta 	= $this->db->query("select * from ekl_regpasien where nomorregistrasi = '$noregistrasi' ")->result_array();
        
        $countbhp = $this->db->query("select * from ekl_pasienrawatjalan_bhp where noregistrasi = '$noregistrasi'")->result_array();
        $counttindakan = $this->db->query("select * from ekl_pasienrawatjalan_tindakan where noregistrasi = '$noregistrasi'")->result_array();
        $countobat = $this->db->query("select * from ekl_pasienrawatjalan_resep where noregistrasi = '$noregistrasi'")->result_array();
        
        $this->db->query("delete from ekl_rincianpembayaran where noregistrasi = '$noregistrasi'");
        
        $this->db->query("insert into ekl_rincianpembayaran(noregistrasi, jenisitem, iditem, level, keterangan, jumlah, biaya, subtotal, idpenjamin) select nomorregistrasi as noregistrasi, 'Administrasi' as jenisitem, '1' as iditem, '2' as level, 'Biaya Administrasi' as keterangan, '1' as jumlah, biaya_administrasi as biaya, biaya_administrasi as subtotal, idpenjamin from ekl_regpasien where nomorregistrasi = '$noregistrasi'");
        
        if(count($counttindakan) > 0){
        $this->db->query("insert into ekl_rincianpembayaran(noregistrasi, jenisitem, iditem, level, keterangan, jumlah, biaya, subtotal, idpenjamin) select nomorregistrasi as noregistrasi, 'Tindakan' as jenisitem, '1' as iditem, '1' as level, 'Tindakan' as keterangan, '' as jumlah, '' as biaya, '' as subtotal, idpenjamin from ekl_regpasien where nomorregistrasi = '$noregistrasi'");
        
        
        $this->db->query("insert into ekl_rincianpembayaran(noregistrasi, jenisitem, iditem, level, keterangan, jumlah, biaya, subtotal, idpenjamin) select ekl_pasienrawatjalan_tindakan.noregistrasi, 'Tindakan' as jenisitem, ekl_pasienrawatjalan_tindakan.idtindakan as iditem, '2' as level, ekl_mastertindakan.nama as keterangan, ekl_pasienrawatjalan_tindakan.jumlah, ekl_detailtariftindakan.tarifpelayanan as biaya, (ekl_pasienrawatjalan_tindakan.jumlah * ekl_detailtariftindakan.tarifpelayanan) as subtotal, ekl_detailtariftindakan.idpenjamin FROM ekl_pasienrawatjalan_tindakan 
        left join ekl_mastertindakan on ekl_pasienrawatjalan_tindakan.idtindakan = ekl_mastertindakan.id 
        left join ekl_perawat on ekl_pasienrawatjalan_tindakan.idpelaksana = ekl_perawat.id 
        left join (select * from ekl_detailtariftindakan where idpenjamin = '$idpenjamin') ekl_detailtariftindakan on ekl_pasienrawatjalan_tindakan.idtindakan = ekl_detailtariftindakan.idtindakan where noregistrasi = '$noregistrasi'
        ");
        }
        if(count($countbhp) > 0){
        $this->db->query("insert into ekl_rincianpembayaran(noregistrasi, jenisitem, iditem, level, keterangan, jumlah, biaya, subtotal, idpenjamin) select nomorregistrasi as noregistrasi, 'BHP' as jenisitem, '1' as iditem, '1' as level, 'BHP' as keterangan, '' as jumlah, '' as biaya, '' as subtotal, idpenjamin from ekl_regpasien where nomorregistrasi = '$noregistrasi'");
        $this->db->query("
        insert into ekl_rincianpembayaran(noregistrasi, jenisitem, iditem, level, keterangan, jumlah, biaya, subtotal, idpenjamin) 
        select ekl_pasienrawatjalan_bhp.noregistrasi, 'BHP' as jenisitem, ekl_pasienrawatjalan_bhp.idbhp as iditem, '2' as level, ekl_masterbhp.nama as keterangan, ekl_pasienrawatjalan_bhp.jumlah, ekl_detailtarifbhp.tarifpelayanan as biaya, (ekl_pasienrawatjalan_bhp.jumlah * ekl_detailtarifbhp.tarifpelayanan) as subtotal, ekl_detailtarifbhp.idpenjamin FROM ekl_pasienrawatjalan_bhp 
        left join ekl_masterbhp on ekl_pasienrawatjalan_bhp.idbhp = ekl_masterbhp.id 
        left join (select * from ekl_detailtarifbhp where idpenjamin = '$idpenjamin') ekl_detailtarifbhp on ekl_pasienrawatjalan_bhp.idbhp = ekl_detailtarifbhp.idbhp  where noregistrasi = '$noregistrasi'
        ");
            
        }
        if(count($countobat) > 0){
        $this->db->query("insert into ekl_rincianpembayaran(noregistrasi, jenisitem, iditem, level, keterangan, jumlah, biaya, subtotal, idpenjamin) select nomorregistrasi as noregistrasi, 'Obat' as jenisitem, '1' as iditem, '1' as level, 'Obat' as keterangan, '' as jumlah, '' as biaya, '' as subtotal, idpenjamin from ekl_regpasien where nomorregistrasi = '$noregistrasi'");
            
            $this->db->query("
        insert into ekl_rincianpembayaran(noregistrasi, jenisitem, iditem, level, keterangan, jumlah, biaya, subtotal, idpenjamin) 
        select ekl_pasienrawatjalan_resep.noregistrasi, 'Obat' as jenisitem, ekl_pasienrawatjalan_resep.idobat as iditem, '2' as level, ekl_masterobat.nama as keterangan, ekl_pasienrawatjalan_resep.jumlah, ekl_detailtarifobat.tarifpelayanan as biaya, (ekl_pasienrawatjalan_resep.jumlah * ekl_detailtarifobat.tarifpelayanan) as subtotal, ekl_detailtarifobat.idpenjamin FROM ekl_pasienrawatjalan_resep 
        left join ekl_masterobat on ekl_pasienrawatjalan_resep.idobat = ekl_masterobat.id
        left join (select * from ekl_detailtarifobat where idpenjamin = '$idpenjamin') ekl_detailtarifobat on ekl_pasienrawatjalan_resep.idobat = ekl_detailtarifobat.idobat  where noregistrasi = '$noregistrasi'
        ");
        }
        
        header('location:'.base_url().'eklinik/cashier/datapasien/proses/'.$noregistrasi);
    }
    public function proses($noregistrasi){
        
       cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

      $editpeserta 	= $this->db->query("select * from ekl_regpasien where nomorregistrasi = '$noregistrasi' ")->result_array();
            $datakwitansi 	= $this->db->query("select * from ekl_kwitansi where noregistrasi = '$noregistrasi' ")->result_array();
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Proses Pembayaran',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
        
        
         'nokwitansi'		=> "KW-".$noregistrasi,
         'totalbiaya'		=> $datakwitansi[0]['totalbiaya'],
         'totalbayar'		=> $datakwitansi[0]['totaldibayar'],
         'diskon'		=> $datakwitansi[0]['diskon'],
         'kembalian'		=> $datakwitansi[0]['kembalian'],
         'harusdibayar'		=> $datakwitansi[0]['harusdibayar'],
         'statustagihan'		=> $editpeserta[0]['statustagihan'],
         'namaperusahaan'		=> $editpeserta[0]['perusahaan'],
         'noregistrasi' 	=> $noregistrasi,
         'tanggalregistrasi' 	=> $editpeserta[0]['tanggalregistrasi'],
         'norekammedik'		=> $editpeserta[0]['norekammedik'],
         'tanggalkepesertaan'		=> $editpeserta[0]['tanggal_kepesertaan'],
         'panggilan'		=> $editpeserta[0]['panggilan'],
                'statuskawin'	=> $editpeserta[0]['status_kawin'],
                'jumlahanak'	=> $editpeserta[0]['jumlah_anak'],
				'pendidikan'	=> $editpeserta[0]['pendidikan'],
				'jabatan'		=> $editpeserta[0]['jabatan'],
				'nama' 	=> $editpeserta[0]['nama'],
				'nik' 	=> $editpeserta[0]['nik'],
				'tanggallahir' 		=> $editpeserta[0]['tanggallahir'],
				'tempatlahir' 		=> $editpeserta[0]['tempatlahir'],
				'umur' => $editpeserta[0]['usia'], 
				'goldarah' 		=> $editpeserta[0]['golongan_darah'],
				'nomorhp' 		=> $editpeserta[0]['no_telp'],
				'jeniskelamin' 		=> $editpeserta[0]['jeniskelamin'],
				'alamat'	=> $editpeserta[0]['alamat'],
				'agama'	=> $editpeserta[0]['agama'],
				'email'	=> $editpeserta[0]['email'],
				'fotocari'	=> $editpeserta[0]['foto'],
				'registercabang'	=> $editpeserta[0]['registercabang'],
				'idpoliklinik'	=> $editpeserta[0]['idpoliklinik'],
				'namadokter'	=> $editpeserta[0]['namadokter'],
				'noantri'	=> $editpeserta[0]['noantri'],
				'idpelayanan'	=> $editpeserta[0]['idpelayanan'],
				'idpenjamin'	=> $editpeserta[0]['idpenjamin'],
				'nokartuasuransi'	=> $editpeserta[0]['nokartuasuransi'],
            'getmasterpenjamin' => $this->db->query("select * from ekl_masterpenjamin")->result_array(),
            'getdatadetailbayar' => $this->db->query("select * from ekl_detailbayar where noregistrasi = '$noregistrasi' group by carabayar")->result_array(),
        'getrincianpembayaran' => $this->db->query("select * from ekl_rincianpembayaran where noregistrasi = '$noregistrasi' order by id asc")->result_array(),
        
			);
		$this->load->view('eklinik/cashier/v_prosespembayaran', $data);
    }
    
    public function updaterincian_act($noregistrasi){
    
    $rincianpembayaran = $this->db->query("select * from ekl_rincianpembayaran where noregistrasi = '$noregistrasi' order by id asc")->result_array();
        
    foreach($rincianpembayaran as $g){
          
            $jumlah = $this->input->post("jumlah".$g['id']);
            $biaya = $this->input->post("biaya".$g['id']);
            $idpenjamin = $this->input->post("idpenjamin".$g['id']);
        $data=array(
           'jumlah'		=> $jumlah,
           'biaya'		=> $biaya,
           'idpenjamin'		=> $idpenjamin,
         );   
            $this->ModelGeneral->UpdateData('ekl_rincianpembayaran', $data,array('id' => $g['id']));
    }
        $countkwitansi = $this->db->query("select * from ekl_kwitansi where noregistrasi = '$noregistrasi'")->result_array();
        $totalbayar = $this->db->query("select sum(subtotal) as jumlah from ekl_rincianpembayaran where noregistrasi = '$noregistrasi'")->result_array();
    $data=array(
           'noregistrasi'		=> $noregistrasi,
           'totalbiaya'		=>  $totalbayar[0]['jumlah'],
         );   
        if(count($countkwitansi) > 0 ){ 
            $this->ModelGeneral->UpdateData('ekl_kwitansi', $data,array('noregistrasi' => $noregistrasi));
        }else{
            $this->ModelGeneral->InsertData('ekl_kwitansi', $data);
        }
        
    header('location:'.base_url().'pembayaran/proses/'.$noregistrasi);

}
    
    public function simpankwitanis_act($noregistrasi){
    
    $carabayar = $this->input->post('carabayar');
    $totalbayarpasien = $this->input->post('totalbayarpasien');
        if($totalbayarpasien != ''){
        $data=array(
           'noregistrasi'		=> $noregistrasi,
           'carabayar'		=> $carabayar,
           'totalbayar'		=>  $totalbayarpasien,
         );   
        $this->ModelGeneral->InsertData('ekl_detailbayar', $data);
        }
        $dataupdate=array(
           'statustagihan'		=>  $this->input->post('statustagihan'),
         );   
        $this->ModelGeneral->UpdateData('ekl_regpasien', $dataupdate,array('nomorregistrasi'=>$noregistrasi));
        
    $countkwitansi = $this->db->query("select * from ekl_kwitansi where noregistrasi = '$noregistrasi'")->result_array();
        
        $totalbayar = $this->db->query("select sum(totalbayar) as jumlah from ekl_detailbayar where noregistrasi = '$noregistrasi'")->result_array();
        $harusdibayar = $this->input->post('harusdibayar');
        $kembali = intval($totalbayar[0]['jumlah']) - intval($harusdibayar);
    $data=array(
           'noregistrasi'		=> $noregistrasi,
           'nokwitansi'		=>  $this->input->post('nokwitansi'),
           'totalbiaya'		=>  $this->input->post('totaltagihan'),
           'diskon'		=>  $this->input->post('diskon'),
           'totaldibayar'		=>  $totalbayar[0]['jumlah'],
           'kembalian'		=>  $kembali,
           'harusdibayar'		=>  $this->input->post('harusdibayar'),
         );   
        if(count($countkwitansi) > 0 ){ 
            $this->ModelGeneral->UpdateData('ekl_kwitansi', $data,array('noregistrasi' => $noregistrasi));
        }else{
            $this->ModelGeneral->InsertData('ekl_kwitansi', $data);
        }
    header('location:'.base_url().'pembayaran/proses/'.$noregistrasi);

}
    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " Belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." Puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " Seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " Ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " Seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " Ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " Juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " Milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " Trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return $hasil;
	}
}
