<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil extends CI_Controller
{
  function __Construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');
      $this->load->library('m_pdf');
      $this->load->helper('tgl_indo');
    $this->load->model('eklinik/laboratorium/ModelLaboratorium');
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
      'title'         => 'Data Laboratorium',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,

    );
    $this->load->view('eklinik/laboratorium/v_laboratorium', $data);
  }

  public function getLaboratorium()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->ModelLaboratorium->getLaboratorium();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/laboratorium/hasil/proses/".$d['id']."' class='btn btn-primary' target='_blank'>PROSES</a>";
      $data[] = array(
        "no" => $no,
        "norm" => $d['norm'],
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
      'title'         => 'Proses Input Laboratorium',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
        'id'	=> $id,
        'listitem' => $this->db->query("select * from ekl_pasienlaboratorium_detail where id_pasienlab = '$id' ")->result_array(),
    );
    $this->load->view('eklinik/laboratorium/v_proseslaboratorium', $data);
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
			$check = $this->ModelLaboratorium->get_by_id($id);
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
    
    public function getHasillab($id)
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->db->query("select ekl_pasienlaboratorium_detail.id as iddetail, ekl_pasienlaboratorium_detail.id_pasienlab, ekl_pasienlaboratorium_detail.id_item, ekl_pasienlaboratorium_detail.hasil, ekl_pasienlaboratorium_detail.keterangan,ekl_itemperiksa.satuan, ekl_itemperiksa.input,ekl_itemperiksa.uraian, ekl_itemperiksa.level, ekl_itemperiksa.nama_item as namaitem from ekl_pasienlaboratorium_detail left join ekl_itemperiksa on ekl_pasienlaboratorium_detail.id_item = ekl_itemperiksa.id where ekl_pasienlaboratorium_detail.id_pasienlab = '$id'")->result_array();
        foreach ($datas as $d) {
            if($d['keterangan'] != NULL and $d['keterangan'] != 'Normal'){
               $keterangan = "<font color='red'>".$d['keterangan']."</font>";
            }else{
                $keterangan = "<font>".$d['keterangan']."</font>";
            }
            $hasil = '';
            if($d['input'] == ''){
                if($d['hasil'] == ''){
                  $hasil = "<input type='text' class='form-control' name=".$d['iddetail']." id=iddetail".$d['iddetail']."  value=".trim($d['uraian'])." >";
                     }else{
                        $hasil = "<input type='text' class='form-control' name=".$d['iddetail']." id=iddetail".$d['iddetail']." value=".trim($d['hasil'])." >";
                       }
                
             }else{
                $hasil = "<select class='form-control' id=iddetail".$d['iddetail']." name=".$d['iddetail']." >";
                 if($d['input'] != ""){ 
                        $arr = explode(";", $d['input']); 
                    for($i=0; $i<count($arr); $i++){ 
                         if ($arr[$i] == $d['hasil']){ $sel = "selected"; }else{$sel = "";}
                   $hasil = $hasil."<option ".$sel." value=".$arr[$i].">".$arr[$i]."</option>";
                    }
                 }
                $hasil = $hasil."</select>";
                
                 } 

            $data[] = array(
                "namaitem" => $d['namaitem'],
                "satuan" => $d['satuan'],
                "hasil" => $hasil,
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
    
    public function proses_act()
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
			$dokterpemeriksa 		= $this->input->post('dokterpemeriksa');
    $petugas 		= $this->input->post('petugas');
    $catatandokter 		= $this->input->post('catatandokter');
    $tanggalperiksa 		= $this->input->post('tanggalperiksa');
    $jamperiksa 		= $this->input->post('jamperiksa');
    $tanggalsampling 		= $this->input->post('tanggalsampling');
    $jamsampling 		= $this->input->post('jamsampling');
    $pengambilanurine 		= $this->input->post('pengambilanurine');
    $pengambilandarah 		= $this->input->post('pengambilandarah');
    $jeniskelamin 		= $this->input->post('jeniskelamin');
            $diagnosa = '';
      $listitem = $this->db->query("select * from ekl_pasienlaboratorium_detail where id_pasienlab = '$id' ")->result_array();    
        foreach($listitem as $g){
            $hasil = $this->input->post("iddetail".$g['id']);
            $this->proseshasil($hasil,$g['id'],$id,$g['id_item'],$jeniskelamin);
        }
            $listitem2 = $this->db->query("select ekl_pasienlaboratorium_detail.id as iddetail, ekl_pasienlaboratorium_detail.id_pasienlab, ekl_pasienlaboratorium_detail.id_item, ekl_pasienlaboratorium_detail.hasil, ekl_pasienlaboratorium_detail.keterangan,ekl_itemperiksa.satuan, ekl_itemperiksa.input,ekl_itemperiksa.uraian, ekl_itemperiksa.level, ekl_itemperiksa.nama_item as namaitem from ekl_pasienlaboratorium_detail left join ekl_itemperiksa on ekl_pasienlaboratorium_detail.id_item = ekl_itemperiksa.id where ekl_pasienlaboratorium_detail.id_pasienlab = '$id'")->result_array();    
    foreach($listitem2 as $g){
    if($g['keterangan'] != NULL and $g['keterangan'] != 'Normal'){
    $diagnosa = $diagnosa.$g['namaitem']."(".$g['keterangan'].");"; 
    }
    }; 
            
			$post = true;
			if ($post) {
                   
					$data = array(
           'dokterpemeriksa'		=> $dokterpemeriksa,
           'petugas'		=> $petugas,
           'diagnosa'		=> $diagnosa,
           'catatandokter'		=> $catatandokter,
           'tanggalperiksa'		=> $tanggalperiksa,
           'jamperiksa'		=> $jamperiksa,
           'tanggalsampling'		=> $tanggalsampling,
           'jamsampling'		=> $jamsampling,
           'pengambilanurine'		=> $pengambilanurine,
           'pengambilandarah'		=> $pengambilandarah,
						);
                    $this->ModelLaboratorium->update($id, $data);
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
    
    public function proseshasil($hasil,$iddetail,$id_pasienlab,$id_item,$jenis_kelamin)
	{
        $cek 	= $this->db->query("select count(id) as jumlah from ekl_pasienlaboratorium_detail where id = '$iddetail' and id_item = '$id_item' ")->result_array();
        
        $cekketerangan 	= $this->db->query("select * from ekl_itemperiksa where id = '$id_item' ")->result_array();
        $idasli = $cekketerangan[0]['id'];              
                if($cekketerangan[0]['uraian'] == ''){
                    if($jenis_kelamin == 1) {
                        $dari = $cekketerangan[0]['daripria']; 
                        $setengahdari = floatval($cekketerangan[0]['daripria']) - floatval(floatval($cekketerangan[0]['daripria'])/3 ); 
                        $sampai = $cekketerangan[0]['sampaipria'];
                        if($sampai == 2 or $sampai == 1){
                            $setengahsampai = 4;
                        }else{
                        $setengahsampai = floatval(floatval($cekketerangan[0]['sampaipria'])/3 ) + floatval($cekketerangan[0]['sampaipria']);
                            }
                        if(floatval($hasil) > floatval($setengahdari) and floatval($hasil) < floatval($dari)){
                            $keterangan = "Menurun Non Signifikan";
                        }elseif(floatval($hasil) < floatval($setengahdari)  ){
                            $keterangan = "Menurun Signifikan";
                        }elseif(floatval($hasil) > floatval($sampai) and floatval($hasil) < floatval($setengahsampai)){
                            $keterangan = "Meningkat Non Signifikan";
                        }elseif(floatval($hasil) > floatval($setengahsampai)  ){
                            $keterangan = "Meningkat Signifikan";
                        }elseif(floatval($hasil) >= floatval($dari) and floatval($hasil) <= floatval($sampai)){
                            $keterangan = "Normal";
                        }else{
                            $keterangan = "Abnormal";
                        }
                        } 
                     if($jenis_kelamin == 2) {
                        $dari = $cekketerangan[0]['dariwanita']; 
                        $setengahdari = floatval($cekketerangan[0]['dariwanita']) - floatval(floatval($cekketerangan[0]['dariwanita'])/3 ); 
                        $sampai = $cekketerangan[0]['sampaiwanita'];
                        if($sampai == 2 or $sampai == 1){
                            $setengahsampai = 4;
                        }else{
                        $setengahsampai = floatval(floatval($cekketerangan[0]['sampaiwanita'])/3 ) + floatval($cekketerangan[0]['sampaiwanita']);
                            }
                         
                        if(floatval($hasil) > floatval($setengahdari) and floatval($hasil) < floatval($dari)){
                            $keterangan = "Menurun Non Signifikan";
                        }elseif(floatval($hasil) < floatval($setengahdari)  ){
                            $keterangan = "Menurun Signifikan";
                        }elseif(floatval($hasil) > floatval($sampai) and floatval($hasil) < floatval($setengahsampai)){
                            $keterangan = "Meningkat Non Signifikan";
                        }elseif(floatval($hasil) > floatval($setengahsampai)  ){
                            $keterangan = "Meningkat Signifikan";
                        }elseif(floatval($hasil) >= floatval($dari) and floatval($hasil) <= floatval($sampai)){
                            $keterangan = "Normal";
                        }else{
                            $keterangan = "Abnormal";
                        } 
                        } 
                       if($jenis_kelamin == 3) {
                        $dari = $cekketerangan[0]['darianak']; 
                        $setengahdari = floatval($cekketerangan[0]['darianak']) - floatval(floatval($cekketerangan[0]['darianak'])/2 ); 
                        $sampai = $cekketerangan[0]['sampaianak'];
                        if($sampai == 2 or $sampai == 1){
                            $setengahsampai = 4;
                        }else{
                         $setengahsampai = floatval(floatval($cekketerangan[0]['sampaianak'])/2 ) + floatval($cekketerangan[0]['sampaianak']);
                            }
                          
                        if(floatval($hasil) > floatval($setengahdari) and floatval($hasil) < floatval($dari)){
                            $keterangan = "Menurun Non Signifikan";
                        }elseif(floatval($hasil) < floatval($setengahdari)  ){
                            $keterangan = "Menurun Signifikan";
                        }elseif(floatval($hasil) > floatval($sampai) and floatval($hasil) < floatval($setengahsampai)){
                            $keterangan = "Meningkat Non Signifikan";
                        }elseif(floatval($hasil) > floatval($setengahsampai)  ){
                            $keterangan = "Meningkat Signifikan";
                        }elseif(floatval($hasil) >= floatval($dari) and floatval($hasil) <= floatval($sampai)){
                            $keterangan = "Normal";
                        }else{
                            $keterangan = "Abnormal";
                        }
                        }
                }
        else
                {
                    if($jenis_kelamin == 1) {
                        $dari = $cekketerangan[0]['daripria']; 
                        $sampai = $cekketerangan[0]['sampaipria'];
                    }
                    if($jenis_kelamin == 2) {
                        $dari = $cekketerangan[0]['dariwanita']; 
                        $sampai = $cekketerangan[0]['sampaiwanita'];
                    }
                    if($jenis_kelamin == 3) {
                        $dari = $cekketerangan[0]['darianak']; 
                        $sampai = $cekketerangan[0]['sampaianak'];
                    }
                    $arr = explode(";", $cekketerangan[0]['uraian']); 
                    $jumlahuraian = count($arr);
                    if($jumlahuraian == 1){
                        
                        
                        if($cekketerangan[0]['uraian'] == $hasil){
                        $keterangan = 'Normal';
                        }else{
                           if(floatval($hasil) <= floatval($sampai) and floatval($sampai) > 0){
                        $keterangan = 'Normal';
                        }else{
                            $keterangan = 'Abnormal';
                        }
                        }
                        
                        
                    
                    }else{
                       if(strpos($cekketerangan[0]['uraian'],$hasil) !== false){
                        $keterangan = 'Normal';
                        }else{
                           if(floatval($hasil) <= floatval($sampai)  and floatval($sampai) > 0){
                        $keterangan = 'Normal';
                        }else{
                           
                            $keterangan = 'Abnormal';
                        }
                        }
                    }
                }
        
        if($cek[0]['jumlah'] == 0){
            if($idasli == '1.6.31.2'){
            $data=array( 
								"id_pasienlab"		=> $id,
								"id_item"		=> $iditem,
								"hasil"		=> $hasil,
								"keterangan"		=> $keterangan,
								);    
							$this->ModelLaboratorium->InsertData('ekl_pasienlaboratorium_detail', $data);
            }else{
             $data=array( 
								"id_pasienlab"		=> $id,
								"id_item"		=> $iditem,
								"hasil"		=> $hasil,
								"keterangan"		=> 'Normal',
								);    
							$this->ModelLaboratorium->InsertData('ekl_pasienlaboratorium_detail', $data);   
            }
        }else{
             if($idasli == '1.6.31.2'){
            if($hasil != ''){
            					$data=array( 
                                "hasil"		=> $hasil,
								"keterangan"		=> 'Normal',
								);    
            }else
            {
            $data=array( 
                                "hasil"		=> '',
								"keterangan"		=> '',
								);    
            }
             }else{
                 if($hasil != ''){
            					$data=array( 
                                "hasil"		=> $hasil,
								"keterangan"		=> $keterangan,
								);    
            }else
            {
            $data=array( 
                                "hasil"		=> '',
								"keterangan"		=> '',
								);    
            }
             }
							$this->ModelLaboratorium->UpdateData('ekl_pasienlaboratorium_detail', $data, array('id' => $iddetail,'id_item' => $id_item));
        }
        
	}
    
    public function cetakhasil($id){
    
        $edit 				= $this->db->query("select * from ekl_pasienlaboratorium where id = '$id' ")->result_array();
        $noregistrasi = $edit[0]['noregistrasi'];
        $profil 			= $this->db->query("select * from ekl_regpasien where nomorregistrasi = '$noregistrasi' ")->result_array();
   $data = array(
       'tanggalregistrasi'		=> tgl_indo($edit[0]['tanggalkunjungan']),
       'tanggalperiksa'		=> date('d/m/Y', strtotime($edit[0]['tanggalperiksa'])),
       'tanggalperiksacover'		=> tgl_indo($edit[0]['tanggalperiksa']),
       'now'		=> date('d/m/Y H:i'),
       'noregistrasi'		=> $noregistrasi,
       'nik'		=> $profil[0]['nik'],
       'nama'			=> $profil[0]['nama'],
       'jeniskelamin'		=> $profil[0]['jeniskelamin'],
       'goldarah'		=> $profil[0]['golongan_darah'],
       'noregistrasi'		=> $profil[0]['noregistrasi'],
       'tempatlahir' 	=> $profil[0]['tempatlahir'],
       'tanggallahir' 	=> $profil[0]['tanggallahir'],
       'umur' 	=> $profil[0]['umur'],
       'agama' 		=> $profil[0]['agama'],
       'alamat' 		=> $profil[0]['alamat'],
       'waktusampling' 		=> date('H:i', strtotime($edit[0]['jamsampling'])),
       'waktuperiksa' 		=> date('H:i', strtotime($edit[0]['jamperiksa'])),
       'pengambilanurine' 		=> $edit[0]['pengambilanurine'],
       'pengambilandarah' 		=> $edit[0]['pengambilandarah'],
       'dokterpemeriksalab' 		=> $edit[0]['dokterpemeriksa'],
       'petugaspemeriksalab' 		=> $edit[0]['petugas'],
       'catatanlab' 		=> $edit[0]['catatandokter'],
       'diagnosalab' 		=> $edit[0]['diagnosa'],
       'alamat' 		=> $edit[0]['alamat'],
       
       'gethasil' => $this->db->query("select ekl_pasienlaboratorium_detail.id as iddetail, ekl_pasienlaboratorium_detail.id_pasienlab, ekl_pasienlaboratorium_detail.id_item, ekl_pasienlaboratorium_detail.hasil, ekl_pasienlaboratorium_detail.keterangan,ekl_itemperiksa.* from ekl_pasienlaboratorium_detail left join ekl_itemperiksa on ekl_pasienlaboratorium_detail.id_item = ekl_itemperiksa.id where ekl_pasienlaboratorium_detail.id_pasienlab = '$id'")->result_array(),
       
       
   );
    
    $html = $this->load->view('eklinik/laboratorium/v_cetakhasillab', $data, true);
    
        $this->mpdf = new mPDF();
		$this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
				10, // margin_left
				10, // margin right
				30, // margin top
				50, // margin bottom
				10, // margin header
				10); // margin footer
		$this->mpdf->WriteHTML($html);
        $this->mpdf->Output("hasillab".$noregistrasi.".pdf", 'I');
    }
}
