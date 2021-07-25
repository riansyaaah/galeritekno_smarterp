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
    $this->load->model('eklinik/premedcheck/ModelPremedcheck');
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
      'title'         => 'Data Pre Medcheck',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,

    );
    $this->load->view('eklinik/premedcheck/v_datapasien', $data);
  }

  public function getPremedcheck()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->ModelPremedcheck->getPremedcheck();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/premedcheck/datapasien/proses/".$d['nomorregistrasi']."' class='btn btn-primary' target='_blank'>Proses</a>";
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
    
  public function proses($noregistrasi)
    {
    cek_session($this->idMenu);

    $session = $this->session->userdata('login');
    $sessionCurrentApp = $this->session->userdata('current_app');
    $sessionApplications = $this->session->userdata('applications');
    $date = date("Y-m-d");
    $ip = $this->input->ip_address();

            $edit 	= $this->db->query("select * from ekl_regpasien where nomorregistrasi = '$noregistrasi' ")->result_array();
            $editformulir 	= $this->db->query("select * from ekl_pasienpremedcheck where noregistrasi = '$noregistrasi' ")->result_array();
      
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Pre Medcheck',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,
    
            'noregistrasi'	=> $noregistrasi,
                'nama' 	=> $edit[0]['nama'],
				'nik' 	=> $edit[0]['nik'],
				'tanggallahir' 		=> $edit[0]['tanggallahir'],
				'umur' => $edit[0]['umur'], 
				'jeniskelamin' 		=> $edit[0]['jeniskelamin'],
				'jenispemeriksaan'	=> $editformulir[0]['jenispemeriksaan'],
				
                'faktorfisik_kebisingan' => $editformulir[0]['faktorfisik_kebisingan' ],
'faktorfisik_suhupanas' => $editformulir[0]['faktorfisik_suhupanas' ],
'faktorfisik_suhudingin' => $editformulir[0]['faktorfisik_suhudingin' ],
'faktorfisik_radiasibukanpengion' => $editformulir[0]['faktorfisik_radiasibukanpengion' ],
'faktorfisik_radiasipengion' => $editformulir[0]['faktorfisik_radiasipengion' ],
'faktorfisik_getaranseluruhtubuh' => $editformulir[0]['faktorfisik_getaranseluruhtubuh' ],
'faktorfisik_getaranlokal' => $editformulir[0]['faktorfisik_getaranlokal' ],
'faktorfisik_ketinggian' => $editformulir[0]['faktorfisik_ketinggian' ],
'faktorfisik_lainlain' => $editformulir[0]['faktorfisik_lainlain' ],
'faktorkimia_debuanorganik' => $editformulir[0]['faktorkimia_debuanorganik' ],
'faktorkimia_debuorganik' => $editformulir[0]['faktorkimia_debuorganik' ],
'faktorkimia_asap' => $editformulir[0]['faktorkimia_asap' ],
'faktorkimia_bahankimia' => $editformulir[0]['faktorkimia_bahankimia' ],
'faktorkimia_logamberat' => $editformulir[0]['faktorkimia_logamberat' ],
'faktorkimia_pelarutorganik' => $editformulir[0]['faktorkimia_pelarutorganik' ],
'faktorkimia_iritanasam' => $editformulir[0]['faktorkimia_iritanasam' ],
'faktorkimia_iritanbasa' => $editformulir[0]['faktorkimia_iritanbasa' ],
'faktorkimia_cairanpembersih' => $editformulir[0]['faktorkimia_cairanpembersih' ],
'faktorkimia_pestisida' => $editformulir[0]['faktorkimia_pestisida' ],
'faktorkimia_uaplogam' => $editformulir[0]['faktorkimia_uaplogam' ],
'faktorkimia_lainlain' => $editformulir[0]['faktorkimia_lainlain' ],
'fs_bebankerjatidaksesuaiwaktu' => $editformulir[0]['fs_bebankerjatidaksesuaiwaktu' ],
'fs_pekerjaantidaksesuaipengetahuan' => $editformulir[0]['fs_pekerjaantidaksesuaipengetahuan' ],
'fs_ketidakjelasantugas' => $editformulir[0]['fs_ketidakjelasantugas' ],
'fs_hambatanjenjangkarir' => $editformulir[0]['fs_hambatanjenjangkarir' ],
'fs_bekerjagiliran' => $editformulir[0]['fs_bekerjagiliran' ],
'fs_konflikdengantemansekerja' => $editformulir[0]['fs_konflikdengantemansekerja' ],
'fs_konflikdalamkeluraga' => $editformulir[0]['fs_konflikdalamkeluraga' ],
'fs_lainlain' => $editformulir[0]['fs_lainlain' ],
'fe_gerakanberulangdengantangan' => $editformulir[0]['fe_gerakanberulangdengantangan' ],
'fe_angkutberat' => $editformulir[0]['fe_angkutberat' ],
'fe_duduklama' => $editformulir[0]['fe_duduklama' ],
'fe_berdirilama' => $editformulir[0]['fe_berdirilama' ],
'fe_posisitubuhtidakergonomis' => $editformulir[0]['fe_posisitubuhtidakergonomis' ],
'fe_pencahayaantidaksesuai' => $editformulir[0]['fe_pencahayaantidaksesuai' ],
'fe_bekerjadenganlayar' => $editformulir[0]['fe_bekerjadenganlayar' ],
'fe_lainlain' => $editformulir[0]['fe_lainlain' ],
'fb_bakteri' => $editformulir[0]['fb_bakteri' ],
'fb_darahcairan' => $editformulir[0]['fb_darahcairan' ],
'fb_nyamukserangga' => $editformulir[0]['fb_nyamukserangga' ],
'fb_limbah' => $editformulir[0]['fb_limbah' ],
'fb_lainlain' => $editformulir[0]['fb_lainlain' ],
'kecelakaankerja_mengalami_kecelakaan' => $editformulir[0]['kecelakaankerja_mengalami_kecelakaan' ],
'kecelakaankerja_jeniskecelakaan' => $editformulir[0]['kecelakaankerja_jeniskecelakaan' ],
'kecelakaankerja_tanggalterjadi' => $editformulir[0]['kecelakaankerja_tanggalterjadi' ],
'kecelakaankerja_penyebab' => $editformulir[0]['kecelakaankerja_penyebab' ],
'kecelakaankerja_gejalasisa' => $editformulir[0]['kecelakaankerja_gejalasisa' ],
'riwayatkeluarga_darahtinggi' => $editformulir[0]['riwayatkeluarga_darahtinggi' ],
'riwayatkeluarga_kanker' => $editformulir[0]['riwayatkeluarga_kanker' ],
'riwayatkeluarga_ambeien' => $editformulir[0]['riwayatkeluarga_ambeien' ],
'riwayatkeluarga_asma' => $editformulir[0]['riwayatkeluarga_asma' ],
'riwayatkeluarga_jantung' => $editformulir[0]['riwayatkeluarga_jantung' ],
'riwayatkeluarga_tbc' => $editformulir[0]['riwayatkeluarga_tbc' ],
'riwayatkeluarga_stroke' => $editformulir[0]['riwayatkeluarga_stroke' ],
'riwayatkeluarga_kencingmanis' => $editformulir[0]['riwayatkeluarga_kencingmanis' ],
'riwayatkeluarga_gangguanjiwa' => $editformulir[0]['riwayatkeluarga_gangguanjiwa' ],
'riwayatkeluarga_hati' => $editformulir[0]['riwayatkeluarga_hati' ],
'riwayatkeluarga_kelainandarah' => $editformulir[0]['riwayatkeluarga_kelainandarah' ],
'riwayatkeluarga_keadaanortusaatini' => $editformulir[0]['riwayatkeluarga_keadaanortusaatini' ],
'kebiasaan_minumalkohol' => $editformulir[0]['kebiasaan_minumalkohol' ],
'kebiasaan_merokok' => $editformulir[0]['kebiasaan_merokok' ],
'kebiasaan_mulaimerokokusia' => $editformulir[0]['kebiasaan_mulaimerokokusia' ],
'kebiasaan_berhentimerokok' => $editformulir[0]['kebiasaan_berhentimerokok' ],
'kebiasaan_olahraga' => $editformulir[0]['kebiasaan_olahraga' ],
'kebiasaan_uraianolahraga' => $editformulir[0]['kebiasaan_uraianolahraga' ],
'kebiasaan_obatan' => $editformulir[0]['kebiasaan_obatan' ],
'kebiasaan_penggunaan_obatobatan' => $editformulir[0]['kebiasaan_penggunaan_obatobatan' ],
'riwayatkerjasatu' => $editformulir[0]['riwayatkerjasatu' ],
'riwayatkerjasatu_tahun' => $editformulir[0]['riwayatkerjasatu_tahun' ],
'riwayatkerjadua' => $editformulir[0]['riwayatkerjadua' ],
'riwayatkerjadua_tahun' => $editformulir[0]['riwayatkerjadua_tahun' ],
'riwayatkerjatiga' => $editformulir[0]['riwayatkerjatiga' ],
'riwayatkerjatiga_tahun' => $editformulir[0]['riwayatkerjatiga_tahun' ],
'riwayatkerjaempat' => $editformulir[0]['riwayatkerjaempat' ],
'riwayatkerjaempat_tahun' => $editformulir[0]['riwayatkerjaempat_tahun' ],
'riwayatkerjalima' => $editformulir[0]['riwayatkerjalima' ],
'riwayatkerjalima_tahun' => $editformulir[0]['riwayatkerjalima_tahun' ],
'riwayatkerjaenam' => $editformulir[0]['riwayatkerjaenam' ],
'riwayatkerjaenam_tahun' => $editformulir[0]['riwayatkerjaenam_tahun' ],
'riwayatkesehatan_diphteria' => $editformulir[0]['riwayatkesehatan_diphteria' ],
'riwayatkesehatan_sinusitis' => $editformulir[0]['riwayatkesehatan_sinusitis' ],
'riwayatkesehatan_bronchitis' => $editformulir[0]['riwayatkesehatan_bronchitis' ],
'riwayatkesehatan_batukdarah' => $editformulir[0]['riwayatkesehatan_batukdarah' ],
'riwayatkesehatan_tbc' => $editformulir[0]['riwayatkesehatan_tbc' ],
'riwayatkesehatan_radangparu' => $editformulir[0]['riwayatkesehatan_radangparu' ],
'riwayatkesehatan_asma' => $editformulir[0]['riwayatkesehatan_asma' ],
'riwayatkesehatan_sulitbak' => $editformulir[0]['riwayatkesehatan_sulitbak' ],
'riwayatkesehatan_radangsalurankemih' => $editformulir[0]['riwayatkesehatan_radangsalurankemih' ],
'riwayatkesehatan_penyakitginjal' => $editformulir[0]['riwayatkesehatan_penyakitginjal' ],
'riwayatkesehatan_kencingbatu' => $editformulir[0]['riwayatkesehatan_kencingbatu' ],
'riwayatkesehatan_tidakdapatmenahanbab' => $editformulir[0]['riwayatkesehatan_tidakdapatmenahanbab' ],
'riwayatkesehatan_tidakdapatmenahanbak' => $editformulir[0]['riwayatkesehatan_tidakdapatmenahanbak' ],
'riwayatkesehatan_radangselaputotak' => $editformulir[0]['riwayatkesehatan_radangselaputotak' ],
'riwayatkesehatan_gegarotak' => $editformulir[0]['riwayatkesehatan_gegarotak' ],
'riwayatkesehatan_polio' => $editformulir[0]['riwayatkesehatan_polio' ],
'riwayatkesehatan_ayan' => $editformulir[0]['riwayatkesehatan_ayan' ],
'riwayatkesehatan_stroke' => $editformulir[0]['riwayatkesehatan_stroke' ],
'riwayatkesehatan_sakitkepala' => $editformulir[0]['riwayatkesehatan_sakitkepala' ],
'riwayatkesehatan_typhoid' => $editformulir[0]['riwayatkesehatan_typhoid' ],
'riwayatkesehatan_muntahdarah' => $editformulir[0]['riwayatkesehatan_muntahdarah' ],
'riwayatkesehatan_sulitbab' => $editformulir[0]['riwayatkesehatan_sulitbab' ],
'riwayatkesehatan_sakitlambung' => $editformulir[0]['riwayatkesehatan_sakitlambung' ],
'riwayatkesehatan_penyakitkuning' => $editformulir[0]['riwayatkesehatan_penyakitkuning' ],
'riwayatkesehatan_penyakitkandungempedu' => $editformulir[0]['riwayatkesehatan_penyakitkandungempedu' ],
'riwayatkesehatan_gangguanmenelan' => $editformulir[0]['riwayatkesehatan_gangguanmenelan' ],
'riwayatkesehatan_cacarair' => $editformulir[0]['riwayatkesehatan_cacarair' ],
'riwayatkesehatan_jamurkulit' => $editformulir[0]['riwayatkesehatan_jamurkulit' ],
'riwayatkesehatan_penyakitkelamin' => $editformulir[0]['riwayatkesehatan_penyakitkelamin' ],
'riwayatkesehatan_seranganjantung' => $editformulir[0]['riwayatkesehatan_seranganjantung' ],
'riwayatkesehatan_nyeridada' => $editformulir[0]['riwayatkesehatan_nyeridada' ],
'riwayatkesehatan_rasaberdebar' => $editformulir[0]['riwayatkesehatan_rasaberdebar' ],
'riwayatkesehatan_tekanandarahtinggi' => $editformulir[0]['riwayatkesehatan_tekanandarahtinggi' ],
'riwayatkesehatan_ambeien' => $editformulir[0]['riwayatkesehatan_ambeien' ],
'riwayatkesehatan_varises' => $editformulir[0]['riwayatkesehatan_varises' ],
'riwayatkesehatan_gondok' => $editformulir[0]['riwayatkesehatan_gondok' ],
'riwayatkesehatan_radangsendi' => $editformulir[0]['riwayatkesehatan_radangsendi' ],
'riwayatkesehatan_alergimakanan' => $editformulir[0]['riwayatkesehatan_alergimakanan' ],
'riwayatkesehatan_uraianalergimakanan' => $editformulir[0]['riwayatkesehatan_uraianalergimakanan' ],
'riwayatkesehatan_alergiobat' => $editformulir[0]['riwayatkesehatan_alergiobat' ],
'riwayatkesehatan_alergilainnya' => $editformulir[0]['riwayatkesehatan_alergilainnya' ],
'riwayatkesehatan_uraianalergiobat' => $editformulir[0]['riwayatkesehatan_uraianalergiobat' ],
'riwayatkesehatan_kencingmanis' => $editformulir[0]['riwayatkesehatan_kencingmanis' ],
'riwayatkesehatan_tetanus' => $editformulir[0]['riwayatkesehatan_tetanus' ],
'riwayatkesehatan_pingsan' => $editformulir[0]['riwayatkesehatan_pingsan' ],
'riwayatkesehatan_pelupa' => $editformulir[0]['riwayatkesehatan_pelupa' ],
'riwayatkesehatan_sulitkonsentrasi' => $editformulir[0]['riwayatkesehatan_sulitkonsentrasi' ],
'riwayatkesehatan_gangguanpenglihatan' => $editformulir[0]['riwayatkesehatan_gangguanpenglihatan' ],
'riwayatkesehatan_gangguanpendengaran' => $editformulir[0]['riwayatkesehatan_gangguanpendengaran' ],
'riwayatkesehatan_sakitpinggang' => $editformulir[0]['riwayatkesehatan_sakitpinggang' ],
'riwayatkesehatan_tumorganas' => $editformulir[0]['riwayatkesehatan_tumorganas' ],
'riwayatkesehatan_penyakitjiwa' => $editformulir[0]['riwayatkesehatan_penyakitjiwa' ],
'riwayatkesehatan_tbckulit' => $editformulir[0]['riwayatkesehatan_tbckulit' ],
'riwayatkesehatan_tbctulang' => $editformulir[0]['riwayatkesehatan_tbctulang' ],
'riwayatkesehatan_campak' => $editformulir[0]['riwayatkesehatan_campak' ],
'riwayatkesehatan_malaria' => $editformulir[0]['riwayatkesehatan_malaria' ],
'riwayatkesehatan_diabetes' => $editformulir[0]['riwayatkesehatan_diabetes' ],
'riwayatkesehatan_gangguantidur' => $editformulir[0]['riwayatkesehatan_gangguantidur' ],
'riwayatkesehatan_pernahdirawat' => $editformulir[0]['riwayatkesehatan_pernahdirawat' ],
'riwayatkesehatan_pernahkecelakaan' => $editformulir[0]['riwayatkesehatan_pernahkecelakaan' ],
'riwayatkesehatan_pernahdioperasi' => $editformulir[0]['riwayatkesehatan_pernahdioperasi' ],
'riwayatkesehatan_lainlain' => $editformulir[0]['riwayatkesehatan_lainlain' ],
'riwayatkesehatan_sesaknafas' => $editformulir[0]['riwayatkesehatan_sesaknafas' ],
'riwayatimunisasi_hepatitisa' => $editformulir[0]['riwayatimunisasi_hepatitisa' ],
'riwayatimunisasi_hepatitisb' => $editformulir[0]['riwayatimunisasi_hepatitisb' ],
'riwayatimunisasi_bcg' => $editformulir[0]['riwayatimunisasi_bcg' ],
'riwayatimunisasi_polio' => $editformulir[0]['riwayatimunisasi_polio' ],
'riwayatimunisasi_dpt' => $editformulir[0]['riwayatimunisasi_dpt' ],
'riwayatimunisasi_tetanus' => $editformulir[0]['riwayatimunisasi_tetanus' ],
'riwayatmens_menspertama' => $editformulir[0]['riwayatmens_menspertama' ],
'riwayatmens_haripertama' => $editformulir[0]['riwayatmens_haripertama' ],
'riwayatmens_lamahaid' => $editformulir[0]['riwayatmens_lamahaid' ],
'riwayatmens_siklushaid' => $editformulir[0]['riwayatmens_siklushaid' ],
'riwayatmens_nyerihaid' => $editformulir[0]['riwayatmens_nyerihaid' ],
'riwayatmens_banyakhaid' => $editformulir[0]['riwayatmens_banyakhaid' ],
'riwayathamil_sedanghamil' => $editformulir[0]['riwayathamil_sedanghamil' ],
'riwayathamil_melahirkanberapakali' => $editformulir[0]['riwayathamil_melahirkanberapakali' ],
'riwayathamil_gugurberapakali' => $editformulir[0]['riwayathamil_gugurberapakali' ],
'apd_topi' => $editformulir[0]['apd_topi' ],
'apd_kacamata' => $editformulir[0]['apd_kacamata' ],
'apd_masker' => $editformulir[0]['apd_masker' ],
'apd_earplug' => $editformulir[0]['apd_earplug' ],
'apd_sarungtangan' => $editformulir[0]['apd_sarungtangan' ],
'apd_apron' => $editformulir[0]['apd_apron' ],
'apd_sepatu' => $editformulir[0]['apd_sepatu' ],
'programkb' => $editformulir[0]['programkb' ],
'jeniskb' => $editformulir[0]['jeniskb' ],
                
        
    );
    $this->load->view('eklinik/premedcheck/v_prosesdatapasien', $data);
  }
    public function proses_act($noregistrasi=''){
    
    
    $jenispemeriksaan= $this->input->post('jenispemeriksaan');
$faktorfisik_kebisingan= $this->input->post('faktorfisik_kebisingan');
$faktorfisik_suhupanas= $this->input->post('faktorfisik_suhupanas');
$faktorfisik_suhudingin= $this->input->post('faktorfisik_suhudingin');
$faktorfisik_radiasibukanpengion= $this->input->post('faktorfisik_radiasibukanpengion');
$faktorfisik_radiasipengion= $this->input->post('faktorfisik_radiasipengion');
$faktorfisik_getaranseluruhtubuh= $this->input->post('faktorfisik_getaranseluruhtubuh');
$faktorfisik_getaranlokal= $this->input->post('faktorfisik_getaranlokal');
$faktorfisik_ketinggian= $this->input->post('faktorfisik_ketinggian');
$faktorfisik_lainlain= $this->input->post('faktorfisik_lainlain');
$faktorkimia_debuanorganik= $this->input->post('faktorkimia_debuanorganik');
$faktorkimia_debuorganik= $this->input->post('faktorkimia_debuorganik');
$faktorkimia_asap= $this->input->post('faktorkimia_asap');
$faktorkimia_bahankimia= $this->input->post('faktorkimia_bahankimia');
$faktorkimia_logamberat= $this->input->post('faktorkimia_logamberat');
$faktorkimia_pelarutorganik= $this->input->post('faktorkimia_pelarutorganik');
$faktorkimia_iritanasam= $this->input->post('faktorkimia_iritanasam');
$faktorkimia_iritanbasa= $this->input->post('faktorkimia_iritanbasa');
$faktorkimia_cairanpembersih= $this->input->post('faktorkimia_cairanpembersih');
$faktorkimia_pestisida= $this->input->post('faktorkimia_pestisida');
$faktorkimia_uaplogam= $this->input->post('faktorkimia_uaplogam');
$faktorkimia_lainlain= $this->input->post('faktorkimia_lainlain');
$fs_bebankerjatidaksesuaiwaktu= $this->input->post('fs_bebankerjatidaksesuaiwaktu');
$fs_pekerjaantidaksesuaipengetahuan= $this->input->post('fs_pekerjaantidaksesuaipengetahuan');
$fs_ketidakjelasantugas= $this->input->post('fs_ketidakjelasantugas');
$fs_hambatanjenjangkarir= $this->input->post('fs_hambatanjenjangkarir');
$fs_bekerjagiliran= $this->input->post('fs_bekerjagiliran');
$fs_konflikdengantemansekerja= $this->input->post('fs_konflikdengantemansekerja');
$fs_konflikdalamkeluraga= $this->input->post('fs_konflikdalamkeluraga');
$fs_lainlain= $this->input->post('fs_lainlain');
$fe_gerakanberulangdengantangan= $this->input->post('fe_gerakanberulangdengantangan');
$fe_angkutberat= $this->input->post('fe_angkutberat');
$fe_duduklama= $this->input->post('fe_duduklama');
$fe_berdirilama= $this->input->post('fe_berdirilama');
$fe_posisitubuhtidakergonomis= $this->input->post('fe_posisitubuhtidakergonomis');
$fe_pencahayaantidaksesuai= $this->input->post('fe_pencahayaantidaksesuai');
$fe_bekerjadenganlayar= $this->input->post('fe_bekerjadenganlayar');
$fe_lainlain= $this->input->post('fe_lainlain');
$fb_bakteri= $this->input->post('fb_bakteri');
$fb_darahcairan= $this->input->post('fb_darahcairan');
$fb_nyamukserangga= $this->input->post('fb_nyamukserangga');
$fb_limbah= $this->input->post('fb_limbah');
$fb_lainlain= $this->input->post('fb_lainlain');
//$kecelakaankerja_mengalami_kecelakaan= $this->input->post('kecelakaankerja_mengalami_kecelakaan');
$kecelakaankerja_jeniskecelakaan= $this->input->post('kecelakaankerja_jeniskecelakaan');
$kecelakaankerja_tanggalterjadi= $this->input->post('kecelakaankerja_tanggalterjadi');
$kecelakaankerja_penyebab= $this->input->post('kecelakaankerja_penyebab');
$kecelakaankerja_gejalasisa= $this->input->post('kecelakaankerja_gejalasisa');
$riwayatkeluarga_darahtinggi= $this->input->post('riwayatkeluarga_darahtinggi');
$riwayatkeluarga_kanker= $this->input->post('riwayatkeluarga_kanker');
$riwayatkeluarga_ambeien= $this->input->post('riwayatkeluarga_ambeien');
$riwayatkeluarga_asma= $this->input->post('riwayatkeluarga_asma');
$riwayatkeluarga_jantung= $this->input->post('riwayatkeluarga_jantung');
$riwayatkeluarga_tbc= $this->input->post('riwayatkeluarga_tbc');
$riwayatkeluarga_stroke= $this->input->post('riwayatkeluarga_stroke');
$riwayatkeluarga_kencingmanis= $this->input->post('riwayatkeluarga_kencingmanis');
$riwayatkeluarga_gangguanjiwa= $this->input->post('riwayatkeluarga_gangguanjiwa');
$riwayatkeluarga_hati= $this->input->post('riwayatkeluarga_hati');
$riwayatkeluarga_kelainandarah= $this->input->post('riwayatkeluarga_kelainandarah');
$riwayatkeluarga_keadaanortusaatini= $this->input->post('riwayatkeluarga_keadaanortusaatini');
$kebiasaan_minumalkohol= $this->input->post('kebiasaan_minumalkohol');
$kebiasaan_merokok= $this->input->post('kebiasaan_merokok');
$kebiasaan_mulaimerokokusia= $this->input->post('kebiasaan_mulaimerokokusia');
$kebiasaan_berhentimerokok= $this->input->post('kebiasaan_berhentimerokok');
$kebiasaan_olahraga= $this->input->post('kebiasaan_olahraga');
$kebiasaan_uraianolahraga= $this->input->post('kebiasaan_uraianolahraga');
$kebiasaan_obatan= $this->input->post('kebiasaan_obatan');
$kebiasaan_penggunaan_obatobatan= $this->input->post('kebiasaan_penggunaan_obatobatan');
$riwayatkerjasatu= $this->input->post('riwayatkerjasatu');
$riwayatkerjasatu_tahun= $this->input->post('riwayatkerjasatu_tahun');
$riwayatkerjadua= $this->input->post('riwayatkerjadua');
$riwayatkerjadua_tahun= $this->input->post('riwayatkerjadua_tahun');
$riwayatkerjatiga= $this->input->post('riwayatkerjatiga');
$riwayatkerjatiga_tahun= $this->input->post('riwayatkerjatiga_tahun');
$riwayatkerjaempat= $this->input->post('riwayatkerjaempat');
$riwayatkerjaempat_tahun= $this->input->post('riwayatkerjaempat_tahun');
$riwayatkerjalima= $this->input->post('riwayatkerjalima');
$riwayatkerjalima_tahun= $this->input->post('riwayatkerjalima_tahun');
$riwayatkerjaenam= $this->input->post('riwayatkerjaenam');
$riwayatkerjaenam_tahun= $this->input->post('riwayatkerjaenam_tahun');
$riwayatkesehatan_diphteria= $this->input->post('riwayatkesehatan_diphteria');
$riwayatkesehatan_sinusitis= $this->input->post('riwayatkesehatan_sinusitis');
$riwayatkesehatan_bronchitis= $this->input->post('riwayatkesehatan_bronchitis');
$riwayatkesehatan_batukdarah= $this->input->post('riwayatkesehatan_batukdarah');
$riwayatkesehatan_tbc= $this->input->post('riwayatkesehatan_tbc');
$riwayatkesehatan_radangparu= $this->input->post('riwayatkesehatan_radangparu');
$riwayatkesehatan_asma= $this->input->post('riwayatkesehatan_asma');
$riwayatkesehatan_sulitbak= $this->input->post('riwayatkesehatan_sulitbak');
$riwayatkesehatan_radangsalurankemih= $this->input->post('riwayatkesehatan_radangsalurankemih');
$riwayatkesehatan_penyakitginjal= $this->input->post('riwayatkesehatan_penyakitginjal');
$riwayatkesehatan_kencingbatu= $this->input->post('riwayatkesehatan_kencingbatu');
$riwayatkesehatan_tidakdapatmenahanbab= $this->input->post('riwayatkesehatan_tidakdapatmenahanbab');
$riwayatkesehatan_tidakdapatmenahanbak= $this->input->post('riwayatkesehatan_tidakdapatmenahanbak');
$riwayatkesehatan_radangselaputotak= $this->input->post('riwayatkesehatan_radangselaputotak');
$riwayatkesehatan_gegarotak= $this->input->post('riwayatkesehatan_gegarotak');
$riwayatkesehatan_polio= $this->input->post('riwayatkesehatan_polio');
$riwayatkesehatan_ayan= $this->input->post('riwayatkesehatan_ayan');
$riwayatkesehatan_stroke= $this->input->post('riwayatkesehatan_stroke');
$riwayatkesehatan_sakitkepala= $this->input->post('riwayatkesehatan_sakitkepala');
$riwayatkesehatan_typhoid= $this->input->post('riwayatkesehatan_typhoid');
$riwayatkesehatan_muntahdarah= $this->input->post('riwayatkesehatan_muntahdarah');
$riwayatkesehatan_sulitbab= $this->input->post('riwayatkesehatan_sulitbab');
$riwayatkesehatan_sakitlambung= $this->input->post('riwayatkesehatan_sakitlambung');
$riwayatkesehatan_penyakitkuning= $this->input->post('riwayatkesehatan_penyakitkuning');
$riwayatkesehatan_penyakitkandungempedu= $this->input->post('riwayatkesehatan_penyakitkandungempedu');
$riwayatkesehatan_gangguanmenelan= $this->input->post('riwayatkesehatan_gangguanmenelan');
$riwayatkesehatan_cacarair= $this->input->post('riwayatkesehatan_cacarair');
$riwayatkesehatan_jamurkulit= $this->input->post('riwayatkesehatan_jamurkulit');
$riwayatkesehatan_penyakitkelamin= $this->input->post('riwayatkesehatan_penyakitkelamin');
$riwayatkesehatan_seranganjantung= $this->input->post('riwayatkesehatan_seranganjantung');
$riwayatkesehatan_nyeridada= $this->input->post('riwayatkesehatan_nyeridada');
$riwayatkesehatan_rasaberdebar= $this->input->post('riwayatkesehatan_rasaberdebar');
$riwayatkesehatan_tekanandarahtinggi= $this->input->post('riwayatkesehatan_tekanandarahtinggi');
$riwayatkesehatan_ambeien= $this->input->post('riwayatkesehatan_ambeien');
$riwayatkesehatan_varises= $this->input->post('riwayatkesehatan_varises');
$riwayatkesehatan_gondok= $this->input->post('riwayatkesehatan_gondok');
$riwayatkesehatan_radangsendi= $this->input->post('riwayatkesehatan_radangsendi');
$riwayatkesehatan_alergimakanan= $this->input->post('riwayatkesehatan_alergimakanan');
$riwayatkesehatan_uraianalergimakanan= $this->input->post('riwayatkesehatan_uraianalergimakanan');
$riwayatkesehatan_alergiobat= $this->input->post('riwayatkesehatan_alergiobat');
$riwayatkesehatan_alergilainnya= $this->input->post('riwayatkesehatan_alergilainnya');
$riwayatkesehatan_uraianalergiobat= $this->input->post('riwayatkesehatan_uraianalergiobat');
$riwayatkesehatan_kencingmanis= $this->input->post('riwayatkesehatan_kencingmanis');
$riwayatkesehatan_tetanus= $this->input->post('riwayatkesehatan_tetanus');
$riwayatkesehatan_pingsan= $this->input->post('riwayatkesehatan_pingsan');
$riwayatkesehatan_pelupa= $this->input->post('riwayatkesehatan_pelupa');
$riwayatkesehatan_sulitkonsentrasi= $this->input->post('riwayatkesehatan_sulitkonsentrasi');
$riwayatkesehatan_gangguanpenglihatan= $this->input->post('riwayatkesehatan_gangguanpenglihatan');
$riwayatkesehatan_gangguanpendengaran= $this->input->post('riwayatkesehatan_gangguanpendengaran');
$riwayatkesehatan_sakitpinggang= $this->input->post('riwayatkesehatan_sakitpinggang');
$riwayatkesehatan_tumorganas= $this->input->post('riwayatkesehatan_tumorganas');
$riwayatkesehatan_penyakitjiwa= $this->input->post('riwayatkesehatan_penyakitjiwa');
$riwayatkesehatan_tbckulit= $this->input->post('riwayatkesehatan_tbckulit');
$riwayatkesehatan_tbctulang= $this->input->post('riwayatkesehatan_tbctulang');
$riwayatkesehatan_campak= $this->input->post('riwayatkesehatan_campak');
$riwayatkesehatan_malaria= $this->input->post('riwayatkesehatan_malaria');
$riwayatkesehatan_diabetes= $this->input->post('riwayatkesehatan_diabetes');
$riwayatkesehatan_gangguantidur= $this->input->post('riwayatkesehatan_gangguantidur');
$riwayatkesehatan_pernahdirawat= $this->input->post('riwayatkesehatan_pernahdirawat');
$riwayatkesehatan_pernahkecelakaan= $this->input->post('riwayatkesehatan_pernahkecelakaan');
$riwayatkesehatan_pernahdioperasi= $this->input->post('riwayatkesehatan_pernahdioperasi');
$riwayatkesehatan_lainlain= $this->input->post('riwayatkesehatan_lainlain');
$riwayatkesehatan_sesaknafas= $this->input->post('riwayatkesehatan_sesaknafas');
$riwayatimunisasi_hepatitisa= $this->input->post('riwayatimunisasi_hepatitisa');
$riwayatimunisasi_hepatitisb= $this->input->post('riwayatimunisasi_hepatitisb');
$riwayatimunisasi_bcg= $this->input->post('riwayatimunisasi_bcg');
$riwayatimunisasi_polio= $this->input->post('riwayatimunisasi_polio');
$riwayatimunisasi_dpt= $this->input->post('riwayatimunisasi_dpt');
$riwayatimunisasi_tetanus= $this->input->post('riwayatimunisasi_tetanus');
$riwayatmens_menspertama= $this->input->post('riwayatmens_menspertama');
$riwayatmens_haripertama= $this->input->post('riwayatmens_haripertama');
$riwayatmens_lamahaid= $this->input->post('riwayatmens_lamahaid');
$riwayatmens_siklushaid= $this->input->post('riwayatmens_siklushaid');
$riwayatmens_nyerihaid= $this->input->post('riwayatmens_nyerihaid');
$riwayatmens_banyakhaid= $this->input->post('riwayatmens_banyakhaid');
$riwayathamil_sedanghamil= $this->input->post('riwayathamil_sedanghamil');
$riwayathamil_melahirkanberapakali= $this->input->post('riwayathamil_melahirkanberapakali');
$riwayathamil_gugurberapakali= $this->input->post('riwayathamil_gugurberapakali');
$apd_topi= $this->input->post('apd_topi');
$apd_kacamata= $this->input->post('apd_kacamata');
$apd_masker= $this->input->post('apd_masker');
$apd_earplug= $this->input->post('apd_earplug');
$apd_sarungtangan= $this->input->post('apd_sarungtangan');
$apd_apron= $this->input->post('apd_apron');
$apd_sepatu= $this->input->post('apd_sepatu');
$programkb= $this->input->post('programkb');
$jeniskb= $this->input->post('jeniskb');
    
        $dataformulir=array( 
           'noregistrasi' => $noregistrasi,
'jenispemeriksaan' => $jenispemeriksaan,
'faktorfisik_kebisingan' => $faktorfisik_kebisingan,
'faktorfisik_suhupanas' => $faktorfisik_suhupanas,
'faktorfisik_suhudingin' => $faktorfisik_suhudingin,
'faktorfisik_radiasibukanpengion' => $faktorfisik_radiasibukanpengion,
'faktorfisik_radiasipengion' => $faktorfisik_radiasipengion,
'faktorfisik_getaranseluruhtubuh' => $faktorfisik_getaranseluruhtubuh,
'faktorfisik_getaranlokal' => $faktorfisik_getaranlokal,
'faktorfisik_ketinggian' => $faktorfisik_ketinggian,
'faktorfisik_lainlain' => $faktorfisik_lainlain,
'faktorkimia_debuanorganik' => $faktorkimia_debuanorganik,
'faktorkimia_debuorganik' => $faktorkimia_debuorganik,
'faktorkimia_asap' => $faktorkimia_asap,
'faktorkimia_bahankimia' => $faktorkimia_bahankimia,
'faktorkimia_logamberat' => $faktorkimia_logamberat,
'faktorkimia_pelarutorganik' => $faktorkimia_pelarutorganik,
'faktorkimia_iritanasam' => $faktorkimia_iritanasam,
'faktorkimia_iritanbasa' => $faktorkimia_iritanbasa,
'faktorkimia_cairanpembersih' => $faktorkimia_cairanpembersih,
'faktorkimia_pestisida' => $faktorkimia_pestisida,
'faktorkimia_uaplogam' => $faktorkimia_uaplogam,
'faktorkimia_lainlain' => $faktorkimia_lainlain,
'fs_bebankerjatidaksesuaiwaktu' => $fs_bebankerjatidaksesuaiwaktu,
'fs_pekerjaantidaksesuaipengetahuan' => $fs_pekerjaantidaksesuaipengetahuan,
'fs_ketidakjelasantugas' => $fs_ketidakjelasantugas,
'fs_hambatanjenjangkarir' => $fs_hambatanjenjangkarir,
'fs_bekerjagiliran' => $fs_bekerjagiliran,
'fs_konflikdengantemansekerja' => $fs_konflikdengantemansekerja,
'fs_konflikdalamkeluraga' => $fs_konflikdalamkeluraga,
'fs_lainlain' => $fs_lainlain,
'fe_gerakanberulangdengantangan' => $fe_gerakanberulangdengantangan,
'fe_angkutberat' => $fe_angkutberat,
'fe_duduklama' => $fe_duduklama,
'fe_berdirilama' => $fe_berdirilama,
'fe_posisitubuhtidakergonomis' => $fe_posisitubuhtidakergonomis,
'fe_pencahayaantidaksesuai' => $fe_pencahayaantidaksesuai,
'fe_bekerjadenganlayar' => $fe_bekerjadenganlayar,
'fe_lainlain' => $fe_lainlain,
'fb_bakteri' => $fb_bakteri,
'fb_darahcairan' => $fb_darahcairan,
'fb_nyamukserangga' => $fb_nyamukserangga,
'fb_limbah' => $fb_limbah,
'fb_lainlain' => $fb_lainlain,
//'kecelakaankerja_mengalami_kecelakaan' => $kecelakaankerja_mengalami_kecelakaan, 
'kecelakaankerja_jeniskecelakaan' => $kecelakaankerja_jeniskecelakaan,
'kecelakaankerja_tanggalterjadi' => $kecelakaankerja_tanggalterjadi,
'kecelakaankerja_penyebab' => $kecelakaankerja_penyebab,
'kecelakaankerja_gejalasisa' => $kecelakaankerja_gejalasisa,
'riwayatkeluarga_darahtinggi' => $riwayatkeluarga_darahtinggi,
'riwayatkeluarga_kanker' => $riwayatkeluarga_kanker,
'riwayatkeluarga_ambeien' => $riwayatkeluarga_ambeien,
'riwayatkeluarga_asma' => $riwayatkeluarga_asma,
'riwayatkeluarga_jantung' => $riwayatkeluarga_jantung,
'riwayatkeluarga_tbc' => $riwayatkeluarga_tbc,
'riwayatkeluarga_stroke' => $riwayatkeluarga_stroke,
'riwayatkeluarga_kencingmanis' => $riwayatkeluarga_kencingmanis,
'riwayatkeluarga_gangguanjiwa' => $riwayatkeluarga_gangguanjiwa,
'riwayatkeluarga_hati' => $riwayatkeluarga_hati,
'riwayatkeluarga_kelainandarah' => $riwayatkeluarga_kelainandarah,
'riwayatkeluarga_keadaanortusaatini' => $riwayatkeluarga_keadaanortusaatini,
'kebiasaan_minumalkohol' => $kebiasaan_minumalkohol,
'kebiasaan_merokok' => $kebiasaan_merokok,
'kebiasaan_mulaimerokokusia' => $kebiasaan_mulaimerokokusia,
'kebiasaan_berhentimerokok' => $kebiasaan_berhentimerokok,
'kebiasaan_olahraga' => $kebiasaan_olahraga,
'kebiasaan_uraianolahraga' => $kebiasaan_uraianolahraga,
'kebiasaan_obatan' => $kebiasaan_obatan,
'kebiasaan_penggunaan_obatobatan' => $kebiasaan_penggunaan_obatobatan,
'riwayatkerjasatu' => $riwayatkerjasatu,
'riwayatkerjasatu_tahun' => $riwayatkerjasatu_tahun,
'riwayatkerjadua' => $riwayatkerjadua,
'riwayatkerjadua_tahun' => $riwayatkerjadua_tahun,
'riwayatkerjatiga' => $riwayatkerjatiga,
'riwayatkerjatiga_tahun' => $riwayatkerjatiga_tahun,
'riwayatkerjaempat' => $riwayatkerjaempat,
'riwayatkerjaempat_tahun' => $riwayatkerjaempat_tahun,
'riwayatkerjalima' => $riwayatkerjalima,
'riwayatkerjalima_tahun' => $riwayatkerjalima_tahun,
'riwayatkerjaenam' => $riwayatkerjaenam,
'riwayatkerjaenam_tahun' => $riwayatkerjaenam_tahun,
'riwayatkesehatan_diphteria' => $riwayatkesehatan_diphteria,
'riwayatkesehatan_sinusitis' => $riwayatkesehatan_sinusitis,
'riwayatkesehatan_bronchitis' => $riwayatkesehatan_bronchitis,
'riwayatkesehatan_batukdarah' => $riwayatkesehatan_batukdarah,
'riwayatkesehatan_tbc' => $riwayatkesehatan_tbc,
'riwayatkesehatan_radangparu' => $riwayatkesehatan_radangparu,
'riwayatkesehatan_asma' => $riwayatkesehatan_asma,
'riwayatkesehatan_sulitbak' => $riwayatkesehatan_sulitbak,
'riwayatkesehatan_radangsalurankemih' => $riwayatkesehatan_radangsalurankemih,
'riwayatkesehatan_penyakitginjal' => $riwayatkesehatan_penyakitginjal,
'riwayatkesehatan_kencingbatu' => $riwayatkesehatan_kencingbatu,
'riwayatkesehatan_tidakdapatmenahanbab' => $riwayatkesehatan_tidakdapatmenahanbab,
'riwayatkesehatan_tidakdapatmenahanbak' => $riwayatkesehatan_tidakdapatmenahanbak,
'riwayatkesehatan_radangselaputotak' => $riwayatkesehatan_radangselaputotak,
'riwayatkesehatan_gegarotak' => $riwayatkesehatan_gegarotak,
'riwayatkesehatan_polio' => $riwayatkesehatan_polio,
'riwayatkesehatan_ayan' => $riwayatkesehatan_ayan,
'riwayatkesehatan_stroke' => $riwayatkesehatan_stroke,
'riwayatkesehatan_sakitkepala' => $riwayatkesehatan_sakitkepala,
'riwayatkesehatan_typhoid' => $riwayatkesehatan_typhoid,
'riwayatkesehatan_muntahdarah' => $riwayatkesehatan_muntahdarah,
'riwayatkesehatan_sulitbab' => $riwayatkesehatan_sulitbab,
'riwayatkesehatan_sakitlambung' => $riwayatkesehatan_sakitlambung,
'riwayatkesehatan_penyakitkuning' => $riwayatkesehatan_penyakitkuning,
'riwayatkesehatan_penyakitkandungempedu' => $riwayatkesehatan_penyakitkandungempedu,
'riwayatkesehatan_gangguanmenelan' => $riwayatkesehatan_gangguanmenelan,
'riwayatkesehatan_cacarair' => $riwayatkesehatan_cacarair,
'riwayatkesehatan_jamurkulit' => $riwayatkesehatan_jamurkulit,
'riwayatkesehatan_penyakitkelamin' => $riwayatkesehatan_penyakitkelamin,
'riwayatkesehatan_seranganjantung' => $riwayatkesehatan_seranganjantung,
'riwayatkesehatan_nyeridada' => $riwayatkesehatan_nyeridada,
'riwayatkesehatan_rasaberdebar' => $riwayatkesehatan_rasaberdebar,
'riwayatkesehatan_tekanandarahtinggi' => $riwayatkesehatan_tekanandarahtinggi,
'riwayatkesehatan_ambeien' => $riwayatkesehatan_ambeien,
'riwayatkesehatan_varises' => $riwayatkesehatan_varises,
'riwayatkesehatan_gondok' => $riwayatkesehatan_gondok,
'riwayatkesehatan_radangsendi' => $riwayatkesehatan_radangsendi,
'riwayatkesehatan_alergimakanan' => $riwayatkesehatan_alergimakanan,
'riwayatkesehatan_uraianalergimakanan' => $riwayatkesehatan_uraianalergimakanan,
'riwayatkesehatan_alergiobat' => $riwayatkesehatan_alergiobat,
'riwayatkesehatan_alergilainnya' => $riwayatkesehatan_alergilainnya,
'riwayatkesehatan_uraianalergiobat' => $riwayatkesehatan_uraianalergiobat,
'riwayatkesehatan_kencingmanis' => $riwayatkesehatan_kencingmanis,
'riwayatkesehatan_tetanus' => $riwayatkesehatan_tetanus,
'riwayatkesehatan_pingsan' => $riwayatkesehatan_pingsan,
'riwayatkesehatan_pelupa' => $riwayatkesehatan_pelupa,
'riwayatkesehatan_sulitkonsentrasi' => $riwayatkesehatan_sulitkonsentrasi,
'riwayatkesehatan_gangguanpenglihatan' => $riwayatkesehatan_gangguanpenglihatan,
'riwayatkesehatan_gangguanpendengaran' => $riwayatkesehatan_gangguanpendengaran,
'riwayatkesehatan_sakitpinggang' => $riwayatkesehatan_sakitpinggang,
'riwayatkesehatan_tumorganas' => $riwayatkesehatan_tumorganas,
'riwayatkesehatan_penyakitjiwa' => $riwayatkesehatan_penyakitjiwa,
'riwayatkesehatan_tbckulit' => $riwayatkesehatan_tbckulit,
'riwayatkesehatan_tbctulang' => $riwayatkesehatan_tbctulang,
'riwayatkesehatan_campak' => $riwayatkesehatan_campak,
'riwayatkesehatan_malaria' => $riwayatkesehatan_malaria,
'riwayatkesehatan_diabetes' => $riwayatkesehatan_diabetes,
'riwayatkesehatan_gangguantidur' => $riwayatkesehatan_gangguantidur,
'riwayatkesehatan_pernahdirawat' => $riwayatkesehatan_pernahdirawat,
'riwayatkesehatan_pernahkecelakaan' => $riwayatkesehatan_pernahkecelakaan,
'riwayatkesehatan_pernahdioperasi' => $riwayatkesehatan_pernahdioperasi,
'riwayatkesehatan_lainlain' => $riwayatkesehatan_lainlain,
'riwayatkesehatan_sesaknafas' => $riwayatkesehatan_sesaknafas,
'riwayatimunisasi_hepatitisa' => $riwayatimunisasi_hepatitisa,
'riwayatimunisasi_hepatitisb' => $riwayatimunisasi_hepatitisb,
'riwayatimunisasi_bcg' => $riwayatimunisasi_bcg,
'riwayatimunisasi_polio' => $riwayatimunisasi_polio,
'riwayatimunisasi_dpt' => $riwayatimunisasi_dpt,
'riwayatimunisasi_tetanus' => $riwayatimunisasi_tetanus,
'riwayatmens_menspertama' => $riwayatmens_menspertama,
'riwayatmens_haripertama' => $riwayatmens_haripertama,
'riwayatmens_lamahaid' => $riwayatmens_lamahaid,
'riwayatmens_siklushaid' => $riwayatmens_siklushaid,
'riwayatmens_nyerihaid' => $riwayatmens_nyerihaid,
'riwayatmens_banyakhaid' => $riwayatmens_banyakhaid,
'riwayathamil_sedanghamil' => $riwayathamil_sedanghamil,
'riwayathamil_melahirkanberapakali' => $riwayathamil_melahirkanberapakali,
'riwayathamil_gugurberapakali' => $riwayathamil_gugurberapakali,
'apd_topi' => $apd_topi,
'apd_kacamata' => $apd_kacamata,
'apd_masker' => $apd_masker,
'apd_earplug' => $apd_earplug,
'apd_sarungtangan' => $apd_sarungtangan,
'apd_apron' => $apd_apron,
'apd_sepatu' => $apd_sepatu,
'programkb' => $programkb,
'jeniskb' => $jeniskb,
         );  
       
        $this->ModelGeneral->UpdateData('ekl_pasienpremedcheck', $dataformulir,array('noregistrasi'	=> $noregistrasi));    
        header('location:'.base_url().'eklinik/premedcheck/datapasien/proses/'.$noregistrasi);

}
    
    public function cetakhasil($noregistrasi){
        $editformulir 				= $this->db->query("select * from ekl_pasienpremedcheck where noregistrasi = '$noregistrasi' ")->result_array();
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
				
'faktorfisik_kebisingan' => $editformulir[0]['faktorfisik_kebisingan' ],
'faktorfisik_suhupanas' => $editformulir[0]['faktorfisik_suhupanas' ],
'faktorfisik_suhudingin' => $editformulir[0]['faktorfisik_suhudingin' ],
'faktorfisik_radiasibukanpengion' => $editformulir[0]['faktorfisik_radiasibukanpengion' ],
'faktorfisik_radiasipengion' => $editformulir[0]['faktorfisik_radiasipengion' ],
'faktorfisik_getaranseluruhtubuh' => $editformulir[0]['faktorfisik_getaranseluruhtubuh' ],
'faktorfisik_getaranlokal' => $editformulir[0]['faktorfisik_getaranlokal' ],
'faktorfisik_ketinggian' => $editformulir[0]['faktorfisik_ketinggian' ],
'faktorfisik_lainlain' => $editformulir[0]['faktorfisik_lainlain' ],
'faktorkimia_debuanorganik' => $editformulir[0]['faktorkimia_debuanorganik' ],
'faktorkimia_debuorganik' => $editformulir[0]['faktorkimia_debuorganik' ],
'faktorkimia_asap' => $editformulir[0]['faktorkimia_asap' ],
'faktorkimia_bahankimia' => $editformulir[0]['faktorkimia_bahankimia' ],
'faktorkimia_logamberat' => $editformulir[0]['faktorkimia_logamberat' ],
'faktorkimia_pelarutorganik' => $editformulir[0]['faktorkimia_pelarutorganik' ],
'faktorkimia_iritanasam' => $editformulir[0]['faktorkimia_iritanasam' ],
'faktorkimia_iritanbasa' => $editformulir[0]['faktorkimia_iritanbasa' ],
'faktorkimia_cairanpembersih' => $editformulir[0]['faktorkimia_cairanpembersih' ],
'faktorkimia_pestisida' => $editformulir[0]['faktorkimia_pestisida' ],
'faktorkimia_uaplogam' => $editformulir[0]['faktorkimia_uaplogam' ],
'faktorkimia_lainlain' => $editformulir[0]['faktorkimia_lainlain' ],
'fs_bebankerjatidaksesuaiwaktu' => $editformulir[0]['fs_bebankerjatidaksesuaiwaktu' ],
'fs_pekerjaantidaksesuaipengetahuan' => $editformulir[0]['fs_pekerjaantidaksesuaipengetahuan' ],
'fs_ketidakjelasantugas' => $editformulir[0]['fs_ketidakjelasantugas' ],
'fs_hambatanjenjangkarir' => $editformulir[0]['fs_hambatanjenjangkarir' ],
'fs_bekerjagiliran' => $editformulir[0]['fs_bekerjagiliran' ],
'fs_konflikdengantemansekerja' => $editformulir[0]['fs_konflikdengantemansekerja' ],
'fs_konflikdalamkeluraga' => $editformulir[0]['fs_konflikdalamkeluraga' ],
'fs_lainlain' => $editformulir[0]['fs_lainlain' ],
'fe_gerakanberulangdengantangan' => $editformulir[0]['fe_gerakanberulangdengantangan' ],
'fe_angkutberat' => $editformulir[0]['fe_angkutberat' ],
'fe_duduklama' => $editformulir[0]['fe_duduklama' ],
'fe_berdirilama' => $editformulir[0]['fe_berdirilama' ],
'fe_posisitubuhtidakergonomis' => $editformulir[0]['fe_posisitubuhtidakergonomis' ],
'fe_pencahayaantidaksesuai' => $editformulir[0]['fe_pencahayaantidaksesuai' ],
'fe_bekerjadenganlayar' => $editformulir[0]['fe_bekerjadenganlayar' ],
'fe_lainlain' => $editformulir[0]['fe_lainlain' ],
'fb_bakteri' => $editformulir[0]['fb_bakteri' ],
'fb_darahcairan' => $editformulir[0]['fb_darahcairan' ],
'fb_nyamukserangga' => $editformulir[0]['fb_nyamukserangga' ],
'fb_limbah' => $editformulir[0]['fb_limbah' ],
'fb_lainlain' => $editformulir[0]['fb_lainlain' ],
'kecelakaankerja_mengalami_kecelakaan' => $editformulir[0]['kecelakaankerja_mengalami_kecelakaan' ],
'kecelakaankerja_jeniskecelakaan' => $editformulir[0]['kecelakaankerja_jeniskecelakaan' ],
'kecelakaankerja_tanggalterjadi' => $editformulir[0]['kecelakaankerja_tanggalterjadi' ],
'kecelakaankerja_penyebab' => $editformulir[0]['kecelakaankerja_penyebab' ],
'kecelakaankerja_gejalasisa' => $editformulir[0]['kecelakaankerja_gejalasisa' ],
'riwayatkeluarga_darahtinggi' => $editformulir[0]['riwayatkeluarga_darahtinggi' ],
'riwayatkeluarga_kanker' => $editformulir[0]['riwayatkeluarga_kanker' ],
'riwayatkeluarga_ambeien' => $editformulir[0]['riwayatkeluarga_ambeien' ],
'riwayatkeluarga_asma' => $editformulir[0]['riwayatkeluarga_asma' ],
'riwayatkeluarga_jantung' => $editformulir[0]['riwayatkeluarga_jantung' ],
'riwayatkeluarga_tbc' => $editformulir[0]['riwayatkeluarga_tbc' ],
'riwayatkeluarga_stroke' => $editformulir[0]['riwayatkeluarga_stroke' ],
'riwayatkeluarga_kencingmanis' => $editformulir[0]['riwayatkeluarga_kencingmanis' ],
'riwayatkeluarga_gangguanjiwa' => $editformulir[0]['riwayatkeluarga_gangguanjiwa' ],
'riwayatkeluarga_hati' => $editformulir[0]['riwayatkeluarga_hati' ],
'riwayatkeluarga_kelainandarah' => $editformulir[0]['riwayatkeluarga_kelainandarah' ],
'riwayatkeluarga_keadaanortusaatini' => $editformulir[0]['riwayatkeluarga_keadaanortusaatini' ],
'kebiasaan_minumalkohol' => $editformulir[0]['kebiasaan_minumalkohol' ],
'kebiasaan_merokok' => $editformulir[0]['kebiasaan_merokok' ],
'kebiasaan_mulaimerokokusia' => $editformulir[0]['kebiasaan_mulaimerokokusia' ],
'kebiasaan_berhentimerokok' => $editformulir[0]['kebiasaan_berhentimerokok' ],
'kebiasaan_olahraga' => $editformulir[0]['kebiasaan_olahraga' ],
'kebiasaan_uraianolahraga' => $editformulir[0]['kebiasaan_uraianolahraga' ],
'kebiasaan_obatan' => $editformulir[0]['kebiasaan_obatan' ],
'kebiasaan_penggunaan_obatobatan' => $editformulir[0]['kebiasaan_penggunaan_obatobatan' ],
'riwayatkerjasatu' => $editformulir[0]['riwayatkerjasatu' ],
'riwayatkerjasatu_tahun' => $editformulir[0]['riwayatkerjasatu_tahun' ],
'riwayatkerjadua' => $editformulir[0]['riwayatkerjadua' ],
'riwayatkerjadua_tahun' => $editformulir[0]['riwayatkerjadua_tahun' ],
'riwayatkerjatiga' => $editformulir[0]['riwayatkerjatiga' ],
'riwayatkerjatiga_tahun' => $editformulir[0]['riwayatkerjatiga_tahun' ],
'riwayatkerjaempat' => $editformulir[0]['riwayatkerjaempat' ],
'riwayatkerjaempat_tahun' => $editformulir[0]['riwayatkerjaempat_tahun' ],
'riwayatkerjalima' => $editformulir[0]['riwayatkerjalima' ],
'riwayatkerjalima_tahun' => $editformulir[0]['riwayatkerjalima_tahun' ],
'riwayatkerjaenam' => $editformulir[0]['riwayatkerjaenam' ],
'riwayatkerjaenam_tahun' => $editformulir[0]['riwayatkerjaenam_tahun' ],
'riwayatkesehatan_diphteria' => $editformulir[0]['riwayatkesehatan_diphteria' ],
'riwayatkesehatan_sinusitis' => $editformulir[0]['riwayatkesehatan_sinusitis' ],
'riwayatkesehatan_bronchitis' => $editformulir[0]['riwayatkesehatan_bronchitis' ],
'riwayatkesehatan_batukdarah' => $editformulir[0]['riwayatkesehatan_batukdarah' ],
'riwayatkesehatan_tbc' => $editformulir[0]['riwayatkesehatan_tbc' ],
'riwayatkesehatan_radangparu' => $editformulir[0]['riwayatkesehatan_radangparu' ],
'riwayatkesehatan_asma' => $editformulir[0]['riwayatkesehatan_asma' ],
'riwayatkesehatan_sulitbak' => $editformulir[0]['riwayatkesehatan_sulitbak' ],
'riwayatkesehatan_radangsalurankemih' => $editformulir[0]['riwayatkesehatan_radangsalurankemih' ],
'riwayatkesehatan_penyakitginjal' => $editformulir[0]['riwayatkesehatan_penyakitginjal' ],
'riwayatkesehatan_kencingbatu' => $editformulir[0]['riwayatkesehatan_kencingbatu' ],
'riwayatkesehatan_tidakdapatmenahanbab' => $editformulir[0]['riwayatkesehatan_tidakdapatmenahanbab' ],
'riwayatkesehatan_tidakdapatmenahanbak' => $editformulir[0]['riwayatkesehatan_tidakdapatmenahanbak' ],
'riwayatkesehatan_radangselaputotak' => $editformulir[0]['riwayatkesehatan_radangselaputotak' ],
'riwayatkesehatan_gegarotak' => $editformulir[0]['riwayatkesehatan_gegarotak' ],
'riwayatkesehatan_polio' => $editformulir[0]['riwayatkesehatan_polio' ],
'riwayatkesehatan_ayan' => $editformulir[0]['riwayatkesehatan_ayan' ],
'riwayatkesehatan_stroke' => $editformulir[0]['riwayatkesehatan_stroke' ],
'riwayatkesehatan_sakitkepala' => $editformulir[0]['riwayatkesehatan_sakitkepala' ],
'riwayatkesehatan_typhoid' => $editformulir[0]['riwayatkesehatan_typhoid' ],
'riwayatkesehatan_muntahdarah' => $editformulir[0]['riwayatkesehatan_muntahdarah' ],
'riwayatkesehatan_sulitbab' => $editformulir[0]['riwayatkesehatan_sulitbab' ],
'riwayatkesehatan_sakitlambung' => $editformulir[0]['riwayatkesehatan_sakitlambung' ],
'riwayatkesehatan_penyakitkuning' => $editformulir[0]['riwayatkesehatan_penyakitkuning' ],
'riwayatkesehatan_penyakitkandungempedu' => $editformulir[0]['riwayatkesehatan_penyakitkandungempedu' ],
'riwayatkesehatan_gangguanmenelan' => $editformulir[0]['riwayatkesehatan_gangguanmenelan' ],
'riwayatkesehatan_cacarair' => $editformulir[0]['riwayatkesehatan_cacarair' ],
'riwayatkesehatan_jamurkulit' => $editformulir[0]['riwayatkesehatan_jamurkulit' ],
'riwayatkesehatan_penyakitkelamin' => $editformulir[0]['riwayatkesehatan_penyakitkelamin' ],
'riwayatkesehatan_seranganjantung' => $editformulir[0]['riwayatkesehatan_seranganjantung' ],
'riwayatkesehatan_nyeridada' => $editformulir[0]['riwayatkesehatan_nyeridada' ],
'riwayatkesehatan_rasaberdebar' => $editformulir[0]['riwayatkesehatan_rasaberdebar' ],
'riwayatkesehatan_tekanandarahtinggi' => $editformulir[0]['riwayatkesehatan_tekanandarahtinggi' ],
'riwayatkesehatan_ambeien' => $editformulir[0]['riwayatkesehatan_ambeien' ],
'riwayatkesehatan_varises' => $editformulir[0]['riwayatkesehatan_varises' ],
'riwayatkesehatan_gondok' => $editformulir[0]['riwayatkesehatan_gondok' ],
'riwayatkesehatan_radangsendi' => $editformulir[0]['riwayatkesehatan_radangsendi' ],
'riwayatkesehatan_alergimakanan' => $editformulir[0]['riwayatkesehatan_alergimakanan' ],
'riwayatkesehatan_uraianalergimakanan' => $editformulir[0]['riwayatkesehatan_uraianalergimakanan' ],
'riwayatkesehatan_alergiobat' => $editformulir[0]['riwayatkesehatan_alergiobat' ],
'riwayatkesehatan_uraianalergiobat' => $editformulir[0]['riwayatkesehatan_uraianalergiobat' ],
'riwayatkesehatan_kencingmanis' => $editformulir[0]['riwayatkesehatan_kencingmanis' ],
'riwayatkesehatan_tetanus' => $editformulir[0]['riwayatkesehatan_tetanus' ],
'riwayatkesehatan_pingsan' => $editformulir[0]['riwayatkesehatan_pingsan' ],
'riwayatkesehatan_pelupa' => $editformulir[0]['riwayatkesehatan_pelupa' ],
'riwayatkesehatan_sulitkonsentrasi' => $editformulir[0]['riwayatkesehatan_sulitkonsentrasi' ],
'riwayatkesehatan_gangguanpenglihatan' => $editformulir[0]['riwayatkesehatan_gangguanpenglihatan' ],
'riwayatkesehatan_gangguanpendengaran' => $editformulir[0]['riwayatkesehatan_gangguanpendengaran' ],
'riwayatkesehatan_sakitpinggang' => $editformulir[0]['riwayatkesehatan_sakitpinggang' ],
'riwayatkesehatan_tumorganas' => $editformulir[0]['riwayatkesehatan_tumorganas' ],
'riwayatkesehatan_penyakitjiwa' => $editformulir[0]['riwayatkesehatan_penyakitjiwa' ],
'riwayatkesehatan_tbckulit' => $editformulir[0]['riwayatkesehatan_tbckulit' ],
'riwayatkesehatan_tbctulang' => $editformulir[0]['riwayatkesehatan_tbctulang' ],
'riwayatkesehatan_campak' => $editformulir[0]['riwayatkesehatan_campak' ],
'riwayatkesehatan_malaria' => $editformulir[0]['riwayatkesehatan_malaria' ],
'riwayatkesehatan_diabetes' => $editformulir[0]['riwayatkesehatan_diabetes' ],
'riwayatkesehatan_gangguantidur' => $editformulir[0]['riwayatkesehatan_gangguantidur' ],
'riwayatkesehatan_pernahdirawat' => $editformulir[0]['riwayatkesehatan_pernahdirawat' ],
'riwayatkesehatan_pernahkecelakaan' => $editformulir[0]['riwayatkesehatan_pernahkecelakaan' ],
'riwayatkesehatan_pernahdioperasi' => $editformulir[0]['riwayatkesehatan_pernahdioperasi' ],
'riwayatkesehatan_lainlain' => $editformulir[0]['riwayatkesehatan_lainlain' ],
'riwayatkesehatan_sesaknafas' => $editformulir[0]['riwayatkesehatan_sesaknafas' ],
'riwayatimunisasi_hepatitisa' => $editformulir[0]['riwayatimunisasi_hepatitisa' ],
'riwayatimunisasi_hepatitisb' => $editformulir[0]['riwayatimunisasi_hepatitisb' ],
'riwayatimunisasi_bcg' => $editformulir[0]['riwayatimunisasi_bcg' ],
'riwayatimunisasi_polio' => $editformulir[0]['riwayatimunisasi_polio' ],
'riwayatimunisasi_dpt' => $editformulir[0]['riwayatimunisasi_dpt' ],
'riwayatimunisasi_tetanus' => $editformulir[0]['riwayatimunisasi_tetanus' ],
'riwayatmens_menspertama' => $editformulir[0]['riwayatmens_menspertama' ],
'riwayatmens_haripertama' => $editformulir[0]['riwayatmens_haripertama' ],
'riwayatmens_lamahaid' => $editformulir[0]['riwayatmens_lamahaid' ],
'riwayatmens_siklushaid' => $editformulir[0]['riwayatmens_siklushaid' ],
'riwayatmens_nyerihaid' => $editformulir[0]['riwayatmens_nyerihaid' ],
'riwayatmens_banyakhaid' => $editformulir[0]['riwayatmens_banyakhaid' ],
'riwayathamil_sedanghamil' => $editformulir[0]['riwayathamil_sedanghamil' ],
'riwayathamil_melahirkanberapakali' => $editformulir[0]['riwayathamil_melahirkanberapakali' ],
'riwayathamil_gugurberapakali' => $editformulir[0]['riwayathamil_gugurberapakali' ],
'apd_topi' => $editformulir[0]['apd_topi' ],
'apd_kacamata' => $editformulir[0]['apd_kacamata' ],
'apd_masker' => $editformulir[0]['apd_masker' ],
'apd_earplug' => $editformulir[0]['apd_earplug' ],
'apd_sarungtangan' => $editformulir[0]['apd_sarungtangan' ],
'apd_apron' => $editformulir[0]['apd_apron' ],
'apd_sepatu' => $editformulir[0]['apd_sepatu' ],
'programkb' => $editformulir[0]['programkb' ],
'jeniskb' => $editformulir[0]['jeniskb' ],
                );
    
    $html = $this->load->view('eklinik/premedcheck/v_cetakhasilanamnesa', $data, true);
        
        $this->mpdf = new mPDF();
		
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
				10, // margin_left
				10, // margin right
				25, // margin top
				30, // margin bottom
				18, // margin header
				10); // margin footer
		$this->mpdf->WriteHTML($html);
        
		
        $this->mpdf->Output("cetakhasilanamnesa.pdf", 'I');
    }
}
