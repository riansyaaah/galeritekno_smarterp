<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datapasienumum extends CI_Controller
{
  function __Construct()
  {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
    $now = date('Y-m-d H:i:s');
    $this->load->model('eklinik/ModelGeneral');
    $this->load->model('eklinik/mcu/ModelMcu');
      $this->load->library('pdf');
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
      'title'         => 'Data MCU - Pasien Umum',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,

    );
    $this->load->view('eklinik/mcu/v_datapasienumum', $data);
  }

  public function getMcu()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->ModelMcu->getMcu();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/mcu/datapasienumum/proses/".$d['nomorregistrasi']."' class='btn btn-primary' target='_blank'>Resume Hasil</a>";
      $data[] = array(
        "no" => $no,
        "namapaket" => $d['namapaket'],
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
    
  public function proses($noregistrasi)
    {
    cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

        $edit 	= $this->db->query("select * from ekl_regpasien where nomorregistrasi = '$noregistrasi' ")->result_array();
        $editmcu 	= $this->db->query("select * from ekl_pasienmcu where noregistrasi = '$noregistrasi' ")->result_array();
			$editfisik 	= $this->db->query("select * from ekl_pasienfisik where noregistrasi = '$noregistrasi' ")->result_array();
			$editfisikuraian 	= $this->db->query("select * from ekl_pasienfisikuraian where noregistrasi = '$noregistrasi' ")->result_array();
			 
        $editusg 	= $this->db->query("select * from ekl_pasienusgabdomen where noregistrasi = '$noregistrasi' ")->result_array();
        $editradiologi 	= $this->db->query("select * from ekl_pasienthorax where noregistrasi = '$noregistrasi' ")->result_array();
        $editekg 	= $this->db->query("select * from ekl_pasienekg where noregistrasi = '$noregistrasi' ")->result_array();
        $edittreadmill 	= $this->db->query("select * from ekl_pasientreadmill where noregistrasi = '$noregistrasi' ")->result_array();
        $editaudiometri 	= $this->db->query("select * from ekl_pasienaudiometri where noregistrasi = '$noregistrasi' ")->result_array();
        $editspirometri 	= $this->db->query("select * from ekl_pasienspirometri where noregistrasi = '$noregistrasi' ")->result_array();
        
        
        if($editfisik == NULL){
            $fisik = 'Tidak';
        }else{
            $fisik = 'Ada';
        }
        if($editradiologi == NULL){
            $radiologi = 'Tidak';
        }else{
            $radiologi = 'Ada';
        }
        if($editekg == NULL){
        $ekg = 'Tidak';
        }else{
            $ekg = 'Ada';
        }
        if($edittreadmill == NULL){
        $treadmill = 'Tidak';
        }else{
            $treadmill = 'Ada';
        }
        if($editaudiometri == NULL){
        $audiometri = 'Tidak';
        }else{
            $audiometri = 'Ada';
        }
        if($editspirometri == NULL){
        $spirometri = 'Tidak';
        }else{
            $spirometri = 'Ada';
        }
        if($editusg == NULL){
        $usg = 'Tidak';
        }else{
            $usg = 'Ada';
        }
           
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Resume Hasil MCU',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
     'noregistrasi' => $noregistrasi,
     'fisik' => $fisik,
                'radiologi' => $radiologi,
                'ekg' => $ekg,
                'audiometri' => $audiometri,
                'treadmill' => $treadmill,
                'spirometri' => $spirometri,
                'usg' => $usg,
                'nama' 	=> $edit[0]['nama'],
				'nik' 	=> $edit[0]['nik'],
				'tanggallahir' 		=> $edit[0]['tanggallahir'],
				'umur' => $edit[0]['umur'], 
				'jeniskelamin' 		=> $edit[0]['jeniskelamin'],
				'carapengirimanberkas'	=> $editmcu[0]['carapengirimanberkas'],
				'pengirimanhasil'	=> $editmcu[0]['pengirimanhasil'],
				'saranmedis'	=> $editmcu[0]['saranmedis'],
				'statuskesehatan'	=> $editmcu[0]['statuskesehatan'],
				'statuskesimpulan'	=> $editmcu[0]['statuskesimpulan'],
				'tanggalkembali'	=> $editmcu[0]['tanggalkembali'],
				'uraiantanggalkembali'	=> $editmcu[0]['uraiantanggalkembali'],
				
                'dokterpemeriksaradiologi'	=> $editradiologi[0]['dokterpemeriksa'],
				'petugasradiologi'	=> $editradiologi[0]['petugas'],
				'diagnosaradiologi'	=> $editradiologi[0]['diagnosa'],
				'catatandokterradiologi'	=> $editradiologi[0]['catatandokter'],
				'hasilradiologi'	=> $editradiologi[0]['hasil'],
				'fileradiologi'	=> $editradiologi[0]['file'],
				'cor'	=> $editradiologi[0]['cor'],
				'pulmo'	=> $editradiologi[0]['pulmo'],
				'sinusdiafragma'	=> $editradiologi[0]['sinusdiafragma'],
				'tulangjaringanlunak'	=> $editradiologi[0]['tulangjaringanlunak'],
                
                'dokterpemeriksaekg'	=> $editekg[0]['dokterpemeriksa'],
				'petugasekg'	=> $editekg[0]['petugas'],
				'diagnosaekg'	=> $editekg[0]['diagnosa'],
				'catatandokterekg'	=> $editekg[0]['catatandokter'],
				'hasilekg'	=> $editekg[0]['hasil'],
				'fileekg'	=> $editekg[0]['file'],
                'qrsrate'		=> $editekg[0]['qrsrate'],
           'qrsduration'		=> $editekg[0]['qrsduration'],
           'axis'		=> $editekg[0]['axis'],
           'pwave'		=> $editekg[0]['pwave'],
           'printerval'		=> $editekg[0]['printerval'],
           'qwave'		=> $editekg[0]['qwave'],
           'twave'		=> $editekg[0]['twave'],
           'sttchanges'		=> $editekg[0]['sttchanges'],
           'remarks'		=> $editekg[0]['remarks'],
           
                'dokterpemeriksatreadmill'	=> $edittreadmill[0]['dokterpemeriksa'],
				'petugastreadmill'	=> $edittreadmill[0]['petugas'],
				'diagnosatreadmill'	=> $edittreadmill[0]['diagnosa'],
				'catatandoktertreadmill'	=> $edittreadmill[0]['catatandokter'],
				'hasiltreadmill'	=> $edittreadmill[0]['hasil'],
				'filetreadmill'	=> $edittreadmill[0]['file'],
                'indication' 		=> $edittreadmill[0]['indication'],
    'respiration' 		=> $edittreadmill[0]['respiration'],
    'preexercisebp_a' 		=> $edittreadmill[0]['preexercisebp_a'],
    'preexercisebp_b' 		=> $edittreadmill[0]['preexercisebp_b'],
    'restingecg' 		=> $edittreadmill[0]['restingecg'],
    'heartrate' 		=> $edittreadmill[0]['heartrate'],
    'exercisetime_a' 		=> $edittreadmill[0]['exercisetime_a'],
    'exercisetime_b' 		=> $edittreadmill[0]['exercisetime_b'],
    'aerobiccapacity' 		=> $edittreadmill[0]['aerobiccapacity'],
    'targetheartrate' 		=> $edittreadmill[0]['targetheartrate'],
    'maxheartrate' 		=> $edittreadmill[0]['maxheartrate'],
    'endstage' 		=> $edittreadmill[0]['endstage'],
    'maxbloodpressure_a' 		=> $edittreadmill[0]['maxbloodpressure_a'],
    'maxbloodpressure_b' 		=> $edittreadmill[0]['maxbloodpressure_b'],
    'maxheartrate_persen' 		=> $edittreadmill[0]['maxheartrate_persen'],
    'reasonofend' 		=> $edittreadmill[0]['reasonofend'],
    'sttsegmentchanges' 		=> $edittreadmill[0]['sttsegmentchanges'],
    'classificationofphysicalfitness' 		=> $edittreadmill[0]['classificationofphysicalfitness'],
    'bloodpressureresponse' 		=> $edittreadmill[0]['bloodpressureresponse'],
    'functionalclassification' 		=> $edittreadmill[0]['functionalclassification'],
    'conclution' 		=> $edittreadmill[0]['conclution'],
    'prematurebeat' 		=> $edittreadmill[0]['prematurebeat'],
                
                'dokterpemeriksaaudiometri'	=> $editaudiometri[0]['dokterpemeriksa'],
				'petugasaudiometri'	=> $editaudiometri[0]['petugas'],
				'diagnosaaudiometri'	=> $editaudiometri[0]['diagnosa'],
				'catatandokteraudiometri'	=> $editaudiometri[0]['catatandokter'],
				'hasilaudiometri'	=> $editaudiometri[0]['hasil'],
				'fileaudiometri'	=> $editaudiometri[0]['file'],
                'acmr125'		=> $editaudiometri[0]['acmr125'],
           'acmr250'		=> $editaudiometri[0]['acmr250'],
           'acmr500'		=> $editaudiometri[0]['acmr500'],
           'acmr750'		=> $editaudiometri[0]['acmr750'],
           'acmr1000'		=> $editaudiometri[0]['acmr1000'],
           'acmr1500'		=> $editaudiometri[0]['acmr1500'],
           'acmr2000'		=> $editaudiometri[0]['acmr2000'],
           'acmr3000'		=> $editaudiometri[0]['acmr3000'],
           'acmr4000'		=> $editaudiometri[0]['acmr4000'],
           'acmr6000'		=> $editaudiometri[0]['acmr6000'],
           'acmr8000'		=> $editaudiometri[0]['acmr8000'],
        'acml125'		=> $editaudiometri[0]['acml125'],
           'acml250'		=> $editaudiometri[0]['acml250'],
           'acml500'		=> $editaudiometri[0]['acml500'],
           'acml750'		=> $editaudiometri[0]['acml750'],
           'acml1000'		=> $editaudiometri[0]['acml1000'],
           'acml1500'		=> $editaudiometri[0]['acml1500'],
           'acml2000'		=> $editaudiometri[0]['acml2000'],
           'acml3000'		=> $editaudiometri[0]['acml3000'],
           'acml4000'		=> $editaudiometri[0]['acml4000'],
           'acml6000'		=> $editaudiometri[0]['acml6000'],
           'acml8000'		=> $editaudiometri[0]['acml8000'],
        'acnr125'		=> $editaudiometri[0]['acnr125'],
           'acnr250'		=> $editaudiometri[0]['acnr250'],
           'acnr500'		=> $editaudiometri[0]['acnr500'],
           'acnr750'		=> $editaudiometri[0]['acnr750'],
           'acnr1000'		=> $editaudiometri[0]['acnr1000'],
           'acnr1500'		=> $editaudiometri[0]['acnr1500'],
           'acnr2000'		=> $editaudiometri[0]['acnr2000'],
           'acnr3000'		=> $editaudiometri[0]['acnr3000'],
           'acnr4000'		=> $editaudiometri[0]['acnr4000'],
           'acnr6000'		=> $editaudiometri[0]['acnr6000'],
           'acnr8000'		=> $editaudiometri[0]['acnr8000'],
        'acnl125'		=> $editaudiometri[0]['acnl125'],
           'acnl250'		=> $editaudiometri[0]['acnl250'],
           'acnl500'		=> $editaudiometri[0]['acnl500'],
           'acnl750'		=> $editaudiometri[0]['acnl750'],
           'acnl1000'		=> $editaudiometri[0]['acnl1000'],
           'acnl1500'		=> $editaudiometri[0]['acnl1500'],
           'acnl2000'		=> $editaudiometri[0]['acnl2000'],
           'acnl3000'		=> $editaudiometri[0]['acnl3000'],
           'acnl4000'		=> $editaudiometri[0]['acnl4000'],
           'acnl6000'		=> $editaudiometri[0]['acnl6000'],
           'acnl8000'		=> $editaudiometri[0]['acnl8000'],
        'bcnr125'		=> $editaudiometri[0]['bcnr125'],
           'bcnr250'		=> $editaudiometri[0]['bcnr250'],
           'bcnr500'		=> $editaudiometri[0]['bcnr500'],
           'bcnr750'		=> $editaudiometri[0]['bcnr750'],
           'bcnr1000'		=> $editaudiometri[0]['bcnr1000'],
           'bcnr1500'		=> $editaudiometri[0]['bcnr1500'],
           'bcnr2000'		=> $editaudiometri[0]['bcnr2000'],
           'bcnr3000'		=> $editaudiometri[0]['bcnr3000'],
           'bcnr4000'		=> $editaudiometri[0]['bcnr4000'],
           'bcnr6000'		=> $editaudiometri[0]['bcnr6000'],
           'bcnr8000'		=> $editaudiometri[0]['bcnr8000'],
        'bcnl125'		=> $editaudiometri[0]['bcnl125'],
           'bcnl250'		=> $editaudiometri[0]['bcnl250'],
           'bcnl500'		=> $editaudiometri[0]['bcnl500'],
           'bcnl750'		=> $editaudiometri[0]['bcnl750'],
           'bcnl1000'		=> $editaudiometri[0]['bcnl1000'],
           'bcnl1500'		=> $editaudiometri[0]['bcnl1500'],
           'bcnl2000'		=> $editaudiometri[0]['bcnl2000'],
           'bcnl3000'		=> $editaudiometri[0]['bcnl3000'],
           'bcnl4000'		=> $editaudiometri[0]['bcnl4000'],
           'bcnl6000'		=> $editaudiometri[0]['bcnl6000'],
           'bcnl8000'		=> $editaudiometri[0]['bcnl8000'],
        'bcmr125'		=> $editaudiometri[0]['bcmr125'],
           'bcmr250'		=> $editaudiometri[0]['bcmr250'],
           'bcmr500'		=> $editaudiometri[0]['bcmr500'],
           'bcmr750'		=> $editaudiometri[0]['bcmr750'],
           'bcmr1000'		=> $editaudiometri[0]['bcmr1000'],
           'bcmr1500'		=> $editaudiometri[0]['bcmr1500'],
           'bcmr2000'		=> $editaudiometri[0]['bcmr2000'],
           'bcmr3000'		=> $editaudiometri[0]['bcmr3000'],
           'bcmr4000'		=> $editaudiometri[0]['bcmr4000'],
           'bcmr6000'		=> $editaudiometri[0]['bcmr6000'],
           'bcmr8000'		=> $editaudiometri[0]['bcmr8000'],
        'bcml125'		=> $editaudiometri[0]['bcml125'],
           'bcml250'		=> $editaudiometri[0]['bcml250'],
           'bcml500'		=> $editaudiometri[0]['bcml500'],
           'bcml750'		=> $editaudiometri[0]['bcml750'],
           'bcml1000'		=> $editaudiometri[0]['bcml1000'],
           'bcml1500'		=> $editaudiometri[0]['bcml1500'],
           'bcml2000'		=> $editaudiometri[0]['bcml2000'],
           'bcml3000'		=> $editaudiometri[0]['bcml3000'],
           'bcml4000'		=> $editaudiometri[0]['bcml4000'],
           'bcml6000'		=> $editaudiometri[0]['bcml6000'],
           'bcml8000'		=> $editaudiometri[0]['bcml8000'],
        'ullr125'		=> $editaudiometri[0]['ullr125'],
           'ullr250'		=> $editaudiometri[0]['ullr250'],
           'ullr500'		=> $editaudiometri[0]['ullr500'],
           'ullr750'		=> $editaudiometri[0]['ullr750'],
           'ullr1000'		=> $editaudiometri[0]['ullr1000'],
           'ullr1500'		=> $editaudiometri[0]['ullr1500'],
           'ullr2000'		=> $editaudiometri[0]['ullr2000'],
           'ullr3000'		=> $editaudiometri[0]['ullr3000'],
           'ullr4000'		=> $editaudiometri[0]['ullr4000'],
           'ullr6000'		=> $editaudiometri[0]['ullr6000'],
           'ullr8000'		=> $editaudiometri[0]['ullr8000'],
        'ulll125'		=> $editaudiometri[0]['ulll125'],
           'ulll250'		=> $editaudiometri[0]['ulll250'],
           'ulll500'		=> $editaudiometri[0]['ulll500'],
           'ulll750'		=> $editaudiometri[0]['ulll750'],
           'ulll1000'		=> $editaudiometri[0]['ulll1000'],
           'ulll1500'		=> $editaudiometri[0]['ulll1500'],
           'ulll2000'		=> $editaudiometri[0]['ulll2000'],
           'ulll3000'		=> $editaudiometri[0]['ulll3000'],
           'ulll4000'		=> $editaudiometri[0]['ulll4000'],
           'ulll6000'		=> $editaudiometri[0]['ulll6000'],
           'ulll8000'		=> $editaudiometri[0]['ulll8000'],
                
                'dokterpemeriksaspirometri'	=> $editspirometri[0]['dokterpemeriksa'],
				'petugasspirometri'	=> $editspirometri[0]['petugas'],
				'diagnosaspirometri'	=> $editspirometri[0]['diagnosa'],
				'catatandokterspirometri'	=> $editspirometri[0]['catatandokter'],
				'hasilspirometri'	=> $editspirometri[0]['hasil'],
				'filespirometri'	=> $editspirometri[0]['file'],
                'fvc'	=> $editspirometri[0]['fvc'],
				'fev1'	=> $editspirometri[0]['fev1'],
				'fev1_fvc'	=> $editspirometri[0]['fev1_fvc'],
				'pef'	=> $editspirometri[0]['pef'],
                
        'dokterpemeriksafisik'	=> $editfisik[0]['dokterpemeriksa'],
				'petugaspemeriksafisik'	=> $editfisik[0]['petugas'],
				'diagnosafisik'	=> $editfisik[0]['diagnosa'],
				'catatanfisik'	=> $editfisik[0]['catatandokter'],
				
                'penggunaankacamata' => $editfisik[0]['penggunaankacamata' ],
                'nadi' => $editfisik[0]['nadi' ],
'gigi' => $editfisik[0]['gigi' ],
'pernafasan' => $editfisik[0]['pernafasan' ],
'uraianpernafasan' => $editfisikuraian[0]['uraianpernafasan' ],
'uraiansuhubadan' => $editfisikuraian[0]['uraiansuhubadan' ],
'uraiannadi' => $editfisikuraian[0]['uraiannadi' ],
'uraianimt' => $editfisikuraian[0]['uraianimt' ],
'uraiantekanandarah' => $editfisikuraian[0]['uraiantekanandarah' ],
'sistole' => $editfisik[0]['sistole' ],
'diastole' => $editfisik[0]['diastole' ],
'suhubadan' => $editfisik[0]['suhubadan' ],
'tinggibadan' => $editfisik[0]['tinggibadan' ],
'beratbadan' => $editfisik[0]['beratbadan' ],
'imt' => $editfisik[0]['imt' ],
'lingkarperut' => $editfisik[0]['lingkarperut' ],
'bentukbadan' => $editfisik[0]['bentukbadan' ],
'tingkatkesadaran_mata' => $editfisik[0]['tingkatkesadaran_mata' ],
'tingkatkesadaran_verbal' => $editfisik[0]['tingkatkesadaran_verbal' ],
'tingkatkesadaran_motorik' => $editfisik[0]['tingkatkesadaran_motorik' ],
'uraiantingkatkesadaran' => $editfisikuraian[0]['uraiantingkatkesadaran' ],
'kulitdankuku_kulit' => $editfisik[0]['kulitdankuku_kulit' ],
'kulitdankuku_selaputlendir' => $editfisik[0]['kulitdankuku_selaputlendir' ],
'kulitdankuku_kuku' => $editfisik[0]['kulitdankuku_kuku' ],
'kulitdankuku_kontraktur' => $editfisik[0]['kulitdankuku_kontraktur' ],
'kulitdankuku_bekasoperasi' => $editfisik[0]['kulitdankuku_bekasoperasi' ],
'kulitdankuku_lainlain' => $editfisik[0]['kulitdankuku_lainlain' ],
'kepala_tulang' => $editfisik[0]['kepala_tulang' ],
'kepala_kulitkepala' => $editfisik[0]['kepala_kulitkepala' ],
'kepala_rambut' => $editfisik[0]['kepala_rambut' ],
'kepala_bentukwajah' => $editfisik[0]['kepala_bentukwajah' ],
'kepala_lainlain' => $editfisik[0]['kepala_lainlain' ],
'mata_pemeriksaandilakukan' => $editfisik[0]['mata_pemeriksaandilakukan' ],
'mata_visus' => $editfisik[0]['mata_visus' ],
'mata_od' => $editfisik[0]['mata_od' ],
'mata_os' => $editfisik[0]['mata_os' ],
'mata_ods' => $editfisik[0]['mata_ods' ],
'mata_oss' => $editfisik[0]['mata_oss' ],
'mata_butawarna' => $editfisik[0]['mata_butawarna' ],
'mata_kelainanmatalainnya' => $editfisik[0]['mata_kelainanmatalainnya' ],
'mata_lapangpandang' => $editfisik[0]['mata_lapangpandang' ],
'telinga_dauntelingkanan' => $editfisik[0]['telinga_dauntelingkanan' ],
'telinga_dauntelingkiri' => $editfisik[0]['telinga_dauntelingkiri' ],
'telinga_liangtelingakanan' => $editfisik[0]['telinga_liangtelingakanan' ],
'telinga_liangtelingakiri' => $editfisik[0]['telinga_liangtelingakiri' ],
'telinga_serumenkanan' => $editfisik[0]['telinga_serumenkanan' ],
'telinga_serumenkiri' => $editfisik[0]['telinga_serumenkiri' ],
'telinga_membranatimfanikanan' => $editfisik[0]['telinga_membranatimfanikanan' ],
'telinga_membranatimfanikiri' => $editfisik[0]['telinga_membranatimfanikiri' ],
'telinga_kesanpendengaran' => $editfisik[0]['telinga_kesanpendengaran' ],
'telinga_lainlain' => $editfisik[0]['telinga_lainlain' ],
'hidung_meatusnasi' => $editfisik[0]['hidung_meatusnasi' ],
'hidung_septumnasi' => $editfisik[0]['hidung_septumnasi' ],
'hidung_konkanasal' => $editfisik[0]['hidung_konkanasal' ],
'hidung_nyeriketoksinusmaksilaris' => $editfisik[0]['hidung_nyeriketoksinusmaksilaris' ],
'hidung_lainlain' => $editfisik[0]['hidung_lainlain' ],
'tenggorokan_pharynx' => $editfisik[0]['tenggorokan_pharynx' ],
'tenggorokan_tonsil' => $editfisik[0]['tenggorokan_tonsil' ],
'tenggorokan_ukurankanan' => $editfisik[0]['tenggorokan_ukurankanan' ],
'tenggorokan_ukurankiri' => $editfisik[0]['tenggorokan_ukurankiri' ],
'tenggorokan_palatum' => $editfisik[0]['tenggorokan_palatum' ],
'tenggorokan_lainlain' => $editfisik[0]['tenggorokan_lainlain' ],
'mulut_oralhygiene' => $editfisik[0]['mulut_oralhygiene' ],
'mulut_gusi' => $editfisik[0]['mulut_gusi' ],
'leher_gerakanleher' => $editfisik[0]['leher_gerakanleher' ],
'leher_kelenjarthyroid' => $editfisik[0]['leher_kelenjarthyroid' ],
'leher_pulsasi' => $editfisik[0]['leher_pulsasi' ],
'leher_tekananvenajugularis' => $editfisik[0]['leher_tekananvenajugularis' ],
'leher_trachea' => $editfisik[0]['leher_trachea' ],
'leher_lainlain' => $editfisik[0]['leher_lainlain' ],
'dada_bentuk' => $editfisik[0]['dada_bentuk' ],
'dada_mammae' => $editfisik[0]['dada_mammae' ],
'dada_lainlain' => $editfisik[0]['dada_lainlain' ],
'paruparudanjatung_palpasi' => $editfisik[0]['paruparudanjatung_palpasi' ],
'paruparudanjatung_perkusikanan' => $editfisik[0]['paruparudanjatung_perkusikanan' ],
'paruparudanjatung_perkusikiri' => $editfisik[0]['paruparudanjatung_perkusikiri' ],
'paruparudanjatung_iktuskordis' => $editfisik[0]['paruparudanjatung_iktuskordis' ],
'paruparudanjatung_batasjantung' => $editfisik[0]['paruparudanjatung_batasjantung' ],
'paruparudanjatung_bunyinapas' => $editfisik[0]['paruparudanjatung_bunyinapas' ],
'paruparudanjatung_tambahan' => $editfisik[0]['paruparudanjatung_tambahan' ],
'paruparudanjatung_bunyijantung' => $editfisik[0]['paruparudanjatung_bunyijantung' ],
'abdomen_inspeksi' => $editfisik[0]['abdomen_inspeksi' ],
'abdomen_perkusi' => $editfisik[0]['abdomen_perkusi' ],
'abdomen_auskultasibisingusus' => $editfisik[0]['abdomen_auskultasibisingusus' ],
'abdomen_hati' => $editfisik[0]['abdomen_hati' ],
'abdomen_limpa' => $editfisik[0]['abdomen_limpa' ],
'abdomen_nyeritekan' => $editfisik[0]['abdomen_nyeritekan' ],
'abdomen_nyeriketokkanan' => $editfisik[0]['abdomen_nyeriketokkanan' ],
'abdomen_nyeriketokkiri' => $editfisik[0]['abdomen_nyeriketokkiri' ],
'abdomen_ballotementkanan' => $editfisik[0]['abdomen_ballotementkanan' ],
'abdomen_ballotementkiri' => $editfisik[0]['abdomen_ballotementkiri' ],
'abdomen_kandungkemih' => $editfisik[0]['abdomen_kandungkemih' ],
'abdomen_anus' => $editfisik[0]['abdomen_anus' ],
'abdomen_genitaliaeks' => $editfisik[0]['abdomen_genitaliaeks' ],
'abdomen_prostat' => $editfisik[0]['abdomen_prostat' ],
'abdomen_lainlain' => $editfisik[0]['abdomen_lainlain' ],
'vertebra' => $editfisik[0]['vertebra' ],
'extremitasatas_simetris' => $editfisik[0]['extremitasatas_simetris' ],
'extremitasatas_gerakankanan' => $editfisik[0]['extremitasatas_gerakankanan' ],
'extremitasatas_gerakankiri' => $editfisik[0]['extremitasatas_gerakankiri' ],
'extremitasatas_kekuatankanan' => $editfisik[0]['extremitasatas_kekuatankanan' ],
'extremitasatas_kekuatankiri' => $editfisik[0]['extremitasatas_kekuatankiri' ],
'extremitasatas_tulangkanan' => $editfisik[0]['extremitasatas_tulangkanan' ],
'extremitasatas_tulangkiri' => $editfisik[0]['extremitasatas_tulangkiri' ],
'extremitasatas_sensibilitaskanan' => $editfisik[0]['extremitasatas_sensibilitaskanan' ],
'extremitasatas_sensibilitaskiri' => $editfisik[0]['extremitasatas_sensibilitaskiri' ],
'extremitasatas_oedemakanan' => $editfisik[0]['extremitasatas_oedemakanan' ],
'extremitasatas_oedemakiri' => $editfisik[0]['extremitasatas_oedemakiri' ],
'extremitasatas_tremorkanan' => $editfisik[0]['extremitasatas_tremorkanan' ],
'extremitasatas_tremorkiri' => $editfisik[0]['extremitasatas_tremorkiri' ],
'extremitasatas_lainlain' => $editfisik[0]['extremitasatas_lainlain' ],
'extremitasbawah_simetris' => $editfisik[0]['extremitasbawah_simetris' ],
'extremitasbawah_gerakankanan' => $editfisik[0]['extremitasbawah_gerakankanan' ],
'extremitasbawah_gerakankiri' => $editfisik[0]['extremitasbawah_gerakankiri' ],
'extremitasbawah_kekuatankanan' => $editfisik[0]['extremitasbawah_kekuatankanan' ],
'extremitasbawah_kekuatankiri' => $editfisik[0]['extremitasbawah_kekuatankiri' ],
'extremitasbawah_tulangkanan' => $editfisik[0]['extremitasbawah_tulangkanan' ],
'extremitasbawah_tulangkiri' => $editfisik[0]['extremitasbawah_tulangkiri' ],
'extremitasbawah_sensibilitaskanan' => $editfisik[0]['extremitasbawah_sensibilitaskanan' ],
'extremitasbawah_sensibilitaskiri' => $editfisik[0]['extremitasbawah_sensibilitaskiri' ],
'extremitasbawah_oedemakanan' => $editfisik[0]['extremitasbawah_oedemakanan' ],
'extremitasbawah_oedemakiri' => $editfisik[0]['extremitasbawah_oedemakiri' ],
'extremitasbawah_tremorkanan' => $editfisik[0]['extremitasbawah_tremorkanan' ],
'extremitasbawah_tremorkiri' => $editfisik[0]['extremitasbawah_tremorkiri' ],
'extremitasbawah_lainlain' => $editfisik[0]['extremitasbawah_lainlain' ],
                'extremitasbawah_variseskanan' => $editfisik[0]['extremitasbawah_variseskanan' ],
'extremitasbawah_variseskiri' => $editfisik[0]['extremitasbawah_variseskiri' ],
'saraffungsiluhur_dayaingat' => $editfisik[0]['saraffungsiluhur_dayaingat' ],
'saraffungsiluhur_orientasiwaktu' => $editfisik[0]['saraffungsiluhur_orientasiwaktu' ],
'saraffungsiluhur_orientasiorang' => $editfisik[0]['saraffungsiluhur_orientasiorang' ],
'saraffungsiluhur_orientasitempat' => $editfisik[0]['saraffungsiluhur_orientasitempat' ],
'saraffungsiluhur_sikap' => $editfisik[0]['saraffungsiluhur_sikap' ],
'saraffungsiluhur_kesansarafotak' => $editfisik[0]['saraffungsiluhur_kesansarafotak' ],
'kesansarafotak_fungsisensorikkanan' => $editfisik[0]['kesansarafotak_fungsisensorikkanan' ],
'kesansarafotak_fungsisensorikkiri' => $editfisik[0]['kesansarafotak_fungsisensorikkiri' ],
'kesansarafotak_fungsiotonomkanan' => $editfisik[0]['kesansarafotak_fungsiotonomkanan' ],
'kesansarafotak_fungsiotonomkiri' => $editfisik[0]['kesansarafotak_fungsiotonomkiri' ],
'kesansarafotak_fungsivaskularkanan' => $editfisik[0]['kesansarafotak_fungsivaskularkanan' ],
'kesansarafotak_fungsivaskularkiri' => $editfisik[0]['kesansarafotak_fungsivaskularkiri' ],
'kesansarafotak_gerakanabnormalkanan' => $editfisik[0]['kesansarafotak_gerakanabnormalkanan' ],
'kesansarafotak_gerakanabnormalkiri' => $editfisik[0]['kesansarafotak_gerakanabnormalkiri' ],
'kesansarafotak_reflfisiologispatelakanan' => $editfisik[0]['kesansarafotak_reflfisiologispatelakanan' ],
'kesansarafotak_reflfisiologispatelakiri' => $editfisik[0]['kesansarafotak_reflfisiologispatelakiri' ],
'kesansarafotak_reflpatologisbabinskykanan' => $editfisik[0]['kesansarafotak_reflpatologisbabinskykanan' ],
'kesansarafotak_reflpatologisbabinskykiri' => $editfisik[0]['kesansarafotak_reflpatologisbabinskykiri' ],
'kelenjargetahbening_leher' => $editfisik[0]['kelenjargetahbening_leher' ],
'kelenjargetahbening_submandibula' => $editfisik[0]['kelenjargetahbening_submandibula' ],
'kelenjargetahbening_ketiak' => $editfisik[0]['kelenjargetahbening_ketiak' ],
'kelenjargetahbening_inguinal' => $editfisik[0]['kelenjargetahbening_inguinal' ],
'uraiantingkatkesadaran_composmetis' => $editfisikuraian[0]['uraiantingkatkesadaran_composmetis' ],
'uraiantingkatkesadaran_kualitaskontak' => $editfisikuraian[0]['uraiantingkatkesadaran_kualitaskontak' ],
'uraiankulitdankuku_kulit' => $editfisikuraian[0]['uraiankulitdankuku_kulit' ],
'uraiankulitdankuku_selaputlendir' => $editfisikuraian[0]['uraiankulitdankuku_selaputlendir' ],
'uraiankulitdankuku_kuku' => $editfisikuraian[0]['uraiankulitdankuku_kuku' ],
'uraiankulitdankuku_kontraktur' => $editfisikuraian[0]['uraiankulitdankuku_kontraktur' ],
'uraiankulitdankuku_lainlain' => $editfisikuraian[0]['uraiankulitdankuku_lainlain' ],
'uraiankepala_tulang' => $editfisikuraian[0]['uraiankepala_tulang' ],
'uraiankepala_kulitkepala' => $editfisikuraian[0]['uraiankepala_kulitkepala' ],
'uraiankepala_rambut' => $editfisikuraian[0]['uraiankepala_rambut' ],
'uraiankepala_lainlain' => $editfisikuraian[0]['uraiankepala_lainlain' ],
'uraianmata_visus' => $editfisikuraian[0]['uraianmata_visus' ],
'uraianmata_kelainanmatalainnya' => $editfisikuraian[0]['uraianmata_kelainanmatalainnya' ],
'uraianmata_lapangpandang' => $editfisikuraian[0]['uraianmata_lapangpandang' ],
'uraiantelinga_dauntelingkanan' => $editfisikuraian[0]['uraiantelinga_dauntelingkanan' ],
'uraiantelinga_dauntelingkiri' => $editfisikuraian[0]['uraiantelinga_dauntelingkiri' ],
'uraiantelinga_liangtelingakanan' => $editfisikuraian[0]['uraiantelinga_liangtelingakanan' ],
'uraiantelinga_liangtelingakiri' => $editfisikuraian[0]['uraiantelinga_liangtelingakiri' ],
'uraiantelinga_kesanpendengaran' => $editfisikuraian[0]['uraiantelinga_kesanpendengaran' ],
'uraiantelinga_lainlain' => $editfisikuraian[0]['uraiantelinga_lainlain' ],
'uraianhidung_meatusnasi' => $editfisikuraian[0]['uraianhidung_meatusnasi' ],
'uraianhidung_septumnasi' => $editfisikuraian[0]['uraianhidung_septumnasi' ],
'uraianhidung_konkanasal' => $editfisikuraian[0]['uraianhidung_konkanasal' ],
'uraianhidung_nyeriketoksinusmaksilaris' => $editfisikuraian[0]['uraianhidung_nyeriketoksinusmaksilaris' ],
'uraianhidung_lainlain' => $editfisikuraian[0]['uraianhidung_lainlain' ],
'uraiantenggorokan_pharynx' => $editfisikuraian[0]['uraiantenggorokan_pharynx' ],
'uraiantenggorokan_tonsil' => $editfisikuraian[0]['uraiantenggorokan_tonsil' ],
'uraiantenggorokan_palatum' => $editfisikuraian[0]['uraiantenggorokan_palatum' ],
'uraiantenggorokan_lainlain' => $editfisikuraian[0]['uraiantenggorokan_lainlain' ],
'uraianleher_gerakanleher' => $editfisikuraian[0]['uraianleher_gerakanleher' ],
'uraianleher_kelenjarthyroid' => $editfisikuraian[0]['uraianleher_kelenjarthyroid' ],
'uraianleher_pulsasi' => $editfisikuraian[0]['uraianleher_pulsasi' ],
'uraianleher_tekananvenajugularis' => $editfisikuraian[0]['uraianleher_tekananvenajugularis' ],
'uraianleher_trachea' => $editfisikuraian[0]['uraianleher_trachea' ],
'uraianleher_lainlain' => $editfisikuraian[0]['uraianleher_lainlain' ],
'uraiandada_mammae' => $editfisikuraian[0]['uraiandada_mammae' ],
'uraiandada_lainlain' => $editfisikuraian[0]['uraiandada_lainlain' ],
'uraianparuparudanjatung_palpasi' => $editfisikuraian[0]['uraianparuparudanjatung_palpasi' ],
'uraianparuparudanjatung_perkusikanan' => $editfisikuraian[0]['uraianparuparudanjatung_perkusikanan' ],
'uraianparuparudanjatung_perkusikiri' => $editfisikuraian[0]['uraianparuparudanjatung_perkusikiri' ],
'uraianparuparudanjatung_iktuskordis' => $editfisikuraian[0]['uraianparuparudanjatung_iktuskordis' ],
'uraianparuparudanjatung_batasjantung' => $editfisikuraian[0]['uraianparuparudanjatung_batasjantung' ],
'uraianparuparudanjatung_bunyinapas' => $editfisikuraian[0]['uraianparuparudanjatung_bunyinapas' ],
'uraianparuparudanjatung_bunyijantung' => $editfisikuraian[0]['uraianparuparudanjatung_bunyijantung' ],
'uraianabdomen_inspeksi' => $editfisikuraian[0]['uraianabdomen_inspeksi' ],
'uraianabdomen_perkusi' => $editfisikuraian[0]['uraianabdomen_perkusi' ],
'uraianabdomen_auskultasibisingusus' => $editfisikuraian[0]['uraianabdomen_auskultasibisingusus' ],
'uraianabdomen_hati' => $editfisikuraian[0]['uraianabdomen_hati' ],
'uraianabdomen_limpa' => $editfisikuraian[0]['uraianabdomen_limpa' ],
'uraianabdomen_nyeritekan' => $editfisikuraian[0]['uraianabdomen_nyeritekan' ],
'uraianabdomen_nyeriketokkanan' => $editfisikuraian[0]['uraianabdomen_nyeriketokkanan' ],
'uraianabdomen_nyeriketokkiri' => $editfisikuraian[0]['uraianabdomen_nyeriketokkiri' ],
'uraianabdomen_ballotementkanan' => $editfisikuraian[0]['uraianabdomen_ballotementkanan' ],
'uraianabdomen_ballotementkiri' => $editfisikuraian[0]['uraianabdomen_ballotementkiri' ],
'uraianabdomen_anus' => $editfisikuraian[0]['uraianabdomen_anus' ],
'uraianabdomen_genitaliaeks' => $editfisikuraian[0]['uraianabdomen_genitaliaeks' ],
'uraianabdomen_prostat' => $editfisikuraian[0]['uraianabdomen_prostat' ],
'uraianabdomen_lainlain' => $editfisikuraian[0]['uraianabdomen_lainlain' ],
'uraianvertebra' => $editfisikuraian[0]['uraianvertebra' ],
'uraianextremitasatas_simetris' => $editfisikuraian[0]['uraianextremitasatas_simetris' ],
'uraianextremitasatas_gerakankanan' => $editfisikuraian[0]['uraianextremitasatas_gerakankanan' ],
'uraianextremitasatas_gerakankiri' => $editfisikuraian[0]['uraianextremitasatas_gerakankiri' ],
'uraianextremitasatas_kekuatankanan' => $editfisikuraian[0]['uraianextremitasatas_kekuatankanan' ],
'uraianextremitasatas_kekuatankiri' => $editfisikuraian[0]['uraianextremitasatas_kekuatankiri' ],
'uraianextremitasatas_tulangkanan' => $editfisikuraian[0]['uraianextremitasatas_tulangkanan' ],
'uraianextremitasatas_tulangkiri' => $editfisikuraian[0]['uraianextremitasatas_tulangkiri' ],
'uraianextremitasatas_sensibilitaskanan' => $editfisikuraian[0]['uraianextremitasatas_sensibilitaskanan' ],
'uraianextremitasatas_sensibilitaskiri' => $editfisikuraian[0]['uraianextremitasatas_sensibilitaskiri' ],
'uraianextremitasatas_lainlain' => $editfisikuraian[0]['uraianextremitasatas_lainlain' ],
'uraianextremitasbawah_simetris' => $editfisikuraian[0]['uraianextremitasbawah_simetris' ],
'uraianextremitasbawah_gerakankanan' => $editfisikuraian[0]['uraianextremitasbawah_gerakankanan' ],
'uraianextremitasbawah_gerakankiri' => $editfisikuraian[0]['uraianextremitasbawah_gerakankiri' ],
'uraianextremitasbawah_kekuatankanan' => $editfisikuraian[0]['uraianextremitasbawah_kekuatankanan' ],
'uraianextremitasbawah_kekuatankiri' => $editfisikuraian[0]['uraianextremitasbawah_kekuatankiri' ],
'uraianextremitasbawah_tulangkanan' => $editfisikuraian[0]['uraianextremitasbawah_tulangkanan' ],
'uraianextremitasbawah_tulangkiri' => $editfisikuraian[0]['uraianextremitasbawah_tulangkiri' ],
'uraianextremitasbawah_sensibilitaskanan' => $editfisikuraian[0]['uraianextremitasbawah_sensibilitaskanan' ],
'uraianextremitasbawah_sensibilitaskiri' => $editfisikuraian[0]['uraianextremitasbawah_sensibilitaskiri' ],
'uraianextremitasbawah_lainlain' => $editfisikuraian[0]['uraianextremitasbawah_lainlain' ],
'uraiansaraffungsiluhur_orientasiwaktu' => $editfisikuraian[0]['uraiansaraffungsiluhur_orientasiwaktu' ],
'uraiansaraffungsiluhur_orientasiorang' => $editfisikuraian[0]['uraiansaraffungsiluhur_orientasiorang' ],
'uraiansaraffungsiluhur_orientasitempat' => $editfisikuraian[0]['uraiansaraffungsiluhur_orientasitempat' ],
'uraiansaraffungsiluhur_kesansarafotak' => $editfisikuraian[0]['uraiansaraffungsiluhur_kesansarafotak' ],
'uraiankesansarafotak_fungsisensorikkanan' => $editfisikuraian[0]['uraiankesansarafotak_fungsisensorikkanan' ],
'uraiankesansarafotak_fungsisensorikkiri' => $editfisikuraian[0]['uraiankesansarafotak_fungsisensorikkiri' ],
'uraiankesansarafotak_fungsiotonomkanan' => $editfisikuraian[0]['uraiankesansarafotak_fungsiotonomkanan' ],
'uraiankesansarafotak_fungsiotonomkiri' => $editfisikuraian[0]['uraiankesansarafotak_fungsiotonomkiri' ],
'uraiankesansarafotak_fungsivaskularkanan' => $editfisikuraian[0]['uraiankesansarafotak_fungsivaskularkanan' ],
'uraiankesansarafotak_fungsivaskularkiri' => $editfisikuraian[0]['uraiankesansarafotak_fungsivaskularkiri' ],
'uraiankesansarafotak_reflfisiologispatelakanan' => $editfisikuraian[0]['uraiankesansarafotak_reflfisiologispatelakanan' ],
'uraiankesansarafotak_reflfisiologispatelakiri' => $editfisikuraian[0]['uraiankesansarafotak_reflfisiologispatelakiri' ],
'uraiankesansarafotak_reflpatologisbabinskykanan' => $editfisikuraian[0]['uraiankesansarafotak_reflpatologisbabinskykanan' ],
'uraiankesansarafotak_reflpatologisbabinskykiri' => $editfisikuraian[0]['uraiankesansarafotak_reflpatologisbabinskykiri' ],
'uraiankelenjargetahbening_leher' => $editfisikuraian[0]['uraiankelenjargetahbening_leher' ],
'uraiankelenjargetahbening_submandibula' => $editfisikuraian[0]['uraiankelenjargetahbening_submandibula' ],
'uraiankelenjargetahbening_ketiak' => $editfisikuraian[0]['uraiankelenjargetahbening_ketiak' ],
'uraiankelenjargetahbening_inguinal' => $editfisikuraian[0]['uraiankelenjargetahbening_inguinal' ],
                
        'dokterpemeriksausg'	=> $editusg[0]['dokterpemeriksa'],
				'petugasusg'	=> $editusg[0]['petugas'],
				'diagnosausg'	=> $editusg[0]['diagnosa'],
				'catatandokterusg'	=> $editusg[0]['catatandokter'],
				'hasilusg'	=> $editusg[0]['hasil'],
				'fileusg'	=> $editusg[0]['file'],
                'hati'		=> $editusg[0]['hati'],
           'kgb'		=> $editusg[0]['kgb'],
           'empedu'		=> $editusg[0]['empedu'],
           'limpa'		=> $editusg[0]['limpa'],
           'ginjal'		=> $editusg[0]['ginjal'],
           'pankreas'		=> $editusg[0]['pankreas'],
           'kandungkemih'		=> $editusg[0]['kandungkemih'],
           'lainlain'		=> $editusg[0]['lainlain'],
                'temuangigi' => $this->db->query(" select * from ekl_temuangigi where noregistrasi = '$noregistrasi' ")->result_array(),
                'getlababnormal' => $this->db->query(" SELECT * FROM `ekl_pasienlaboratorium_detail` left join ekl_pasienlaboratorium on ekl_pasienlaboratorium_detail.id_pasienlab = ekl_pasienlaboratorium.id left join ekl_itemperiksa on ekl_pasienlaboratorium_detail.id_item = ekl_itemperiksa.id where noregistrasi = '$noregistrasi' ")->result_array(),
				
                'listdiagnosa' 		=>$this->db->query("select * from ekl_masterdiagnosaicdx")->result_array(),
                'getrekapdiagnosa' 		=>$this->db->query("select * from ekl_pasienrekapdiagnosa where noregistrasi = '$noregistrasi' ")->result_array(),
    );
    $this->load->view('eklinik/mcu/v_prosesdatapasienumum', $data);
  }
    public function updateresumehasil($noregistrasi)
	{
		$saranmedis 		= $this->input->post('saranmedis');
		$statuskesimpulan 		= $this->input->post('statuskesimpulan');
		$diagnosa 			= $this->input->post('diagnosa');
		$tanggalperiksa 			= $this->input->post('tanggalperiksa');
		$tanggalkembali 			= $this->input->post('tanggalkembali');
		$uraiantanggalkembali 			= $this->input->post('uraiantanggalkembali');
		if($this->input->post('pengirimanhasil') != ''){
    $pengirimanhasil 			= implode(";",$this->input->post('pengirimanhasil'));
        }else{
           $pengirimanhasil = ''; 
        }
		$c1a 			= $this->input->post('c1a');
		$c1b 			= $this->input->post('c1b');
		$c2 			= $this->input->post('c2');
		$c3a 			= $this->input->post('c3a');
		$c3b 			= $this->input->post('c3b');
		$c4 			= $this->input->post('c4');
		$c5 			= $this->input->post('c5');
        
        if($c1a != ''){
            $statuskesehatan = $c1a;
        }
        if($c1b != ''){
            $statuskesehatan = $c1b;
        }
        if($c2 != ''){
            $statuskesehatan = $c2;
        }
        if($c3a != ''){
            $statuskesehatan = $c3a;
        }
        if($c3b != ''){
            $statuskesehatan = $c3b;
        }
        if($c4 != ''){
            $statuskesehatan = $c4;
        }
        if($c5 != ''){
            $statuskesehatan = $c5;
        }
        if($tanggalkembali == 'Custom'){
            $tanggal = $uraiantanggalkembali;
        }
        if($tanggalkembali == '1 Tahun'){
            $date=date_create($tanggalperiksa);
            $tanggal =  date('Y-m-d',strtotime("+1 year",strtotime($tanggalperiksa)));
        }
        if($tanggalkembali == '6 Bulan'){
            $date=date_create($tanggalperiksa);
            $tanggal =  date('Y-m-d',strtotime("+6 month",strtotime($tanggalperiksa)));
        }
			$data=array( 
				'saranmedis'	=> $saranmedis,
				'statuskesehatan'	=> $statuskesehatan,
                'statuskesimpulan' => $statuskesimpulan,
                'pengirimanhasil' => $pengirimanhasil,
                'tanggalkembali' => $tanggalkembali,
                'uraiantanggalkembali' => $tanggal,
			);   
			$this->ModelGeneral->UpdateData('ekl_pasienmcu', $data, array('noregistrasi' => $noregistrasi));
			$this->ModelGeneral->DeleteData('ekl_pasienrekapdiagnosa', array('noregistrasi' => $noregistrasi));
			if(count($diagnosa) > 0){
                
				for($i=0; $i<count($diagnosa); $i++){
                    $arr = explode(";", $diagnosa[$i]);
					$datadiagnosa = array(
						'noregistrasi'		=> $noregistrasi,
						'kodediagnosa' 	=> $arr[0]
					);
					$this->ModelGeneral->InsertData('ekl_pasienrekapdiagnosa', $datadiagnosa);
				}
			}
		header('location:'.base_url().'eklinik/mcu/datapasienumum/proses/'.$noregistrasi); 
		
	}
    
    public function cetakcover()
	{
		ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Hasil Cover');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Hasil Cover';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARG);
		$data = [
			'title'  => 'Cetak Cover',
		];
    	$pdf->AddPage('L', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetakcover', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Hasil Lab.pdf', 'I');
  	}

	public function hasilaudiometri()
	{
    	ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Hasil Audiometri');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Hasil Audiometri';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARG);
		$data = array(
		'title'                       => 'Cetak Hasil Audiometri',
		);
    	$pdf->AddPage('L', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetakhasilaudiometri', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Hasil Audiometri.pdf', 'I');
  	}

	public function hasilekg()
	{
		ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Hasil Ekg');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Hasil Ekg';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARG);

		$data = array(
			'title'  => 'Cetak Hasil Ekg',
		);
    	$pdf->AddPage('P', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetakhasilekg', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Hasil Ekg.pdf', 'I');
  	}

	public function hasilfisik()
	{
		ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Hasil Fisik');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Hasil Fisik';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARG);

		$data = array(
			'title'  => 'Cetak Hasil Fisik',
		);
    	$pdf->AddPage('P', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetakhasilfisik', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Hasil Fisik.pdf', 'I');
  	}

	public function hasillab() 
	{
		ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Hasil Lab');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Hasil Lab';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$data = [
      		'title'   => 'Cetak Hasil Lab', 
    	];
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetakhasillab', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Hasil Lab.pdf', 'I');
	}

	public function hasilspirometri()
	{
    	ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Hasil Spirometri');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Hasil Spirometri';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$data = [
			'title'  => 'Cetak Hasil Spirometri', 
		];
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetakhasilspirometri', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Hasil Spirometri.pdf', 'I');
	}

	public function hasilthorax()
	{
    	ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Hasil Thorax');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Hasil Thorax';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$data = [
			'title'  => 'Cetak Hasil Thorax', 
		];
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetakhasilthorax', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Hasil Thorax.pdf', 'I');
	}

  	public function hasiltreadmill()
  	{
    	ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Hasil Treadmill');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Hasil Treadmill';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$data = [
      		'title'  => 'Cetak Hasil Treadmill', 
    	];
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetakhasiltreadmill', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Hasil Treadmill.pdf', 'I');
	}

	public function hasilusg()
  	{
    	ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Hasil Usg');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Hasil Usg';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$data = [
      		'title'  => 'Cetak Hasil Usg', 
    	];
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetakhasilusg', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Hasil Usg.pdf', 'I');
	}

	public function cetakpengantar()
  	{
    	ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Kata Pengantar');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Kata Pengantar';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$data = [
      		'title'  => 'Cetak Kata Pengantar', 
    	];
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetakpengantar', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Kata Pengantar.pdf', 'I');
	}

	public function cetaksertifikat()
  	{
    	ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Sertifikat');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Sertifikat';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$data = [
      		'title'  => 'Cetak Sertifikat', 
    	];
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetaksertifikat', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Sertifikat.pdf', 'I');
	}

	public function cetakresume()
  	{
    	ob_start();
		$pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetTitle('Cetak Sumari Hasil');
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
		$pdf->JudulReprot = 'Cetak Sumari Hasil';
		$pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
		$pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
		$pdf->SetDefaultMonospacedFont('dejavusans');
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$data = [
      		'title'  => 'Cetak Sumari Hasil', 
    	];
		$pdf->AddPage('P', 'A4');
		$content = $this->load->view('eklinik/mcu/v_cetaksumarihasil', $data, true);
		$pdf->writeHTML($content, true);
    	ob_end_clean();
		$pdf->Output('Cetak Sumari Hasil.pdf', 'I');
	}
}
