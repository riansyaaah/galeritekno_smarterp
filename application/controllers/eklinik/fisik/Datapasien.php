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
    $this->load->model('eklinik/fisik/ModelFisik');
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
      'title'         => 'Data Fisik',
      'count_ms'      => 99,
      'sess'          => $session,
      'menus'         => getMenu($session['user_id']),
      'apps'          => $sessionApplications,
      'current_app'   => $sessionCurrentApp,

    );
    $this->load->view('eklinik/fisik/v_datapasien', $data);
  }

  public function getFisik()
  {
    cek_session($this->idMenu);
    $session = $this->session->userdata('login');
    header("Content-Type: application/json");
    $response = [];
    $response['status_json'] = true;
    $datas = $this->ModelFisik->getFisik();
    $no = 1;
    foreach ($datas as $d) {
      $option = "<a href='".base_url()."eklinik/fisik/datapasien/proses/".$d['nomorregistrasi']."' class='btn btn-primary' target='_blank'>Proses</a>";
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
            $editfisik 	= $this->db->query("select * from ekl_pasienfisik where noregistrasi = '$noregistrasi' ")->result_array();
            $editfisikuraian 	= $this->db->query("select * from ekl_pasienfisikuraian where noregistrasi = '$noregistrasi' ")->result_array();
    $data = array(
      'datenow'       => date("d-m-Y", strtotime($date)),
      'title'         => 'Hasil Periksa Fisik',
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
        
				'dokterpemeriksa'	=> $editfisik[0]['dokterpemeriksa'],
				'petugas'	=> $editfisik[0]['petugas'],
				'diagnosa'	=> $editfisik[0]['diagnosa'],
				'catatandokter'	=> $editfisik[0]['catatandokter'],
				 'standarsatuan'		=> $editfisik[0]['standar_satuan'],
                'penggunaankacamata' => $editfisik[0]['penggunaankacamata' ],
                'nadi' => $editfisik[0]['nadi' ],
'gigi' => $editfisik[0]['gigi' ],
'keterangan_gigi' => $editfisik[0]['keterangan_gigi' ],
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
'saraffungsiluhur_lainlain' => $editfisik[0]['saraffungsiluhur_lainlain' ],
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
'kesansarafotak_lainlain' => $editfisik[0]['kesansarafotak_lainlain' ],
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
'uraiantelinga_liangtelingakanan' => $editfisikuraian[0]['uraiantelinga_liangtelingakanan' ],
'uraiantelinga_liangtelingakiri' => $editfisikuraian[0]['uraiantelinga_liangtelingakiri' ],
'uraiantelinga_kesanpendengaran' => $editfisikuraian[0]['uraiantelinga_kesanpendengaran' ],
'uraiantelinga_lainlain' => $editfisikuraian[0]['uraiantelinga_lainlain' ],
'uraiantelinga_serumenkanan' => $editfisikuraian[0]['uraiantelinga_serumenkanan' ],
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
'uraiansaraffungsiluhur_lainlain' => $editfisikuraian[0]['uraiansaraffungsiluhur_lainlain' ],
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
'uraiankesansarafotak_lainlain' => $editfisikuraian[0]['uraiankesansarafotak_lainlain' ],
'uraiankelenjargetahbening_leher' => $editfisikuraian[0]['uraiankelenjargetahbening_leher' ],
'uraiankelenjargetahbening_submandibula' => $editfisikuraian[0]['uraiankelenjargetahbening_submandibula' ],
'uraiankelenjargetahbening_ketiak' => $editfisikuraian[0]['uraiankelenjargetahbening_ketiak' ],
'uraiankelenjargetahbening_inguinal' => $editfisikuraian[0]['uraiankelenjargetahbening_inguinal' ],
                
                'getdokter' => $this->db->query("select * from ekl_dokter")->result_array(),
				'getpetugas' => $this->db->query("select * from ekl_perawat")->result_array(),
				'temuangigi' => $this->db->query(" select * from ekl_temuangigi where noregistrasi = '$noregistrasi' ")->result_array(),
    );
    $this->load->view('eklinik/fisik/v_prosesdatapasien', $data);
  }
    
    public function proses_act($noregistrasi=''){
    
    
           
        $kanankiri 		= $this->input->post('kanankiri');
        $atasbawah 		= $this->input->post('atasbawah');
        $urutan 		= $this->input->post('urutan');
        $temuan 		= $this->input->post('temuan');
    
        $item = count($kanankiri);
        
    $dokterpemeriksa 		= $this->input->post('dokterpemeriksa');
    $petugas 		= $this->input->post('petugas');
    $catatandokter 		= $this->input->post('catatandokter');
        
$penggunaankacamata = $this->input->post('penggunaankacamata');
$standarsatuan = $this->input->post('standarsatuan');
$nadi = $this->input->post('nadi');
$gigi = $this->input->post('gigi');
$keterangan_gigi = $this->input->post('keterangan_gigi');
$pernafasan = $this->input->post('pernafasan');
$sistole = $this->input->post('sistole');
$diastole = $this->input->post('diastole');
$suhubadan = $this->input->post('suhubadan');
$tinggibadan = $this->input->post('tinggibadan');
$beratbadan = $this->input->post('beratbadan');
$imt = $this->input->post('imt');
$lingkarperut = $this->input->post('lingkarperut');
$bentukbadan = $this->input->post('bentukbadan');
$tingkatkesadaran_mata = $this->input->post('tingkatkesadaran_mata');
$tingkatkesadaran_verbal = $this->input->post('tingkatkesadaran_verbal');
$tingkatkesadaran_motorik = $this->input->post('tingkatkesadaran_motorik');
$kulitdankuku_kulit = $this->input->post('kulitdankuku_kulit');
$kulitdankuku_selaputlendir = $this->input->post('kulitdankuku_selaputlendir');
$kulitdankuku_kuku = $this->input->post('kulitdankuku_kuku');
$kulitdankuku_kontraktur = $this->input->post('kulitdankuku_kontraktur');
$kulitdankuku_bekasoperasi = $this->input->post('kulitdankuku_bekasoperasi');
$kulitdankuku_lainlain = $this->input->post('kulitdankuku_lainlain');
$kepala_tulang = $this->input->post('kepala_tulang');
$kepala_kulitkepala = $this->input->post('kepala_kulitkepala');
$kepala_rambut = $this->input->post('kepala_rambut');
$kepala_bentukwajah = $this->input->post('kepala_bentukwajah');
$kepala_lainlain = $this->input->post('kepala_lainlain');
$mata_pemeriksaandilakukan = $this->input->post('mata_pemeriksaandilakukan');
$mata_od = $this->input->post('mata_od');
$mata_os = $this->input->post('mata_os');
$mata_ods = $this->input->post('mata_ods');
$mata_oss = $this->input->post('mata_oss');
$mata_butawarna = $this->input->post('mata_butawarna');
$mata_kelainanmatalainnya = $this->input->post('mata_kelainanmatalainnya');
$mata_lapangpandang = $this->input->post('mata_lapangpandang');
$telinga_dauntelingkanan = $this->input->post('telinga_dauntelingkanan');
$telinga_dauntelingkiri = $this->input->post('telinga_dauntelingkiri');
$telinga_liangtelingakanan = $this->input->post('telinga_liangtelingakanan');
$telinga_liangtelingakiri = $this->input->post('telinga_liangtelingakiri');
$telinga_serumenkanan = $this->input->post('telinga_serumenkanan');
$telinga_serumenkiri = $this->input->post('telinga_serumenkiri');
$telinga_membranatimfanikanan = $this->input->post('telinga_membranatimfanikanan');
$telinga_membranatimfanikiri = $this->input->post('telinga_membranatimfanikiri');
$telinga_kesanpendengaran = $this->input->post('telinga_kesanpendengaran');
$hidung_meatusnasi = $this->input->post('hidung_meatusnasi');
$hidung_septumnasi = $this->input->post('hidung_septumnasi');
$hidung_konkanasal = $this->input->post('hidung_konkanasal');
$hidung_nyeriketoksinusmaksilaris = $this->input->post('hidung_nyeriketoksinusmaksilaris');
$hidung_lainlain = $this->input->post('hidung_lainlain');
$tenggorokan_pharynx = $this->input->post('tenggorokan_pharynx');
$tenggorokan_tonsil = $this->input->post('tenggorokan_tonsil');
$tenggorokan_ukurankanan = $this->input->post('tenggorokan_ukurankanan');
$tenggorokan_ukurankiri = $this->input->post('tenggorokan_ukurankiri');
$tenggorokan_palatum = $this->input->post('tenggorokan_palatum');
$tenggorokan_lainlain = $this->input->post('tenggorokan_lainlain');
$mulut_oralhygiene = $this->input->post('mulut_oralhygiene');
$mulut_gusi = $this->input->post('mulut_gusi');
$leher_gerakanleher = $this->input->post('leher_gerakanleher');
$leher_kelenjarthyroid = $this->input->post('leher_kelenjarthyroid');
$leher_pulsasi = $this->input->post('leher_pulsasi');
$leher_tekananvenajugularis = $this->input->post('leher_tekananvenajugularis');
$leher_trachea = $this->input->post('leher_trachea');
$leher_lainlain = $this->input->post('leher_lainlain');
$dada_bentuk = $this->input->post('dada_bentuk');
$dada_mammae = $this->input->post('dada_mammae');
$dada_lainlain = $this->input->post('dada_lainlain');
$paruparudanjatung_palpasi = $this->input->post('paruparudanjatung_palpasi');
$paruparudanjatung_perkusikanan = $this->input->post('paruparudanjatung_perkusikanan');
$paruparudanjatung_perkusikiri = $this->input->post('paruparudanjatung_perkusikiri');
$paruparudanjatung_iktuskordis = $this->input->post('paruparudanjatung_iktuskordis');
$paruparudanjatung_batasjantung = $this->input->post('paruparudanjatung_batasjantung');
$paruparudanjatung_bunyinapas = $this->input->post('paruparudanjatung_bunyinapas');
$paruparudanjatung_tambahan = $this->input->post('paruparudanjatung_tambahan');
$paruparudanjatung_bunyijantung = $this->input->post('paruparudanjatung_bunyijantung');
$abdomen_inspeksi = $this->input->post('abdomen_inspeksi');
$abdomen_perkusi = $this->input->post('abdomen_perkusi');
$abdomen_auskultasibisingusus = $this->input->post('abdomen_auskultasibisingusus');
$abdomen_hati = $this->input->post('abdomen_hati');
$abdomen_limpa = $this->input->post('abdomen_limpa');
$abdomen_nyeritekan = $this->input->post('abdomen_nyeritekan');
$abdomen_nyeriketokkanan = $this->input->post('abdomen_nyeriketokkanan');
$abdomen_nyeriketokkiri = $this->input->post('abdomen_nyeriketokkiri');
$abdomen_ballotementkanan = $this->input->post('abdomen_ballotementkanan');
$abdomen_ballotementkiri = $this->input->post('abdomen_ballotementkiri');
$abdomen_kandungkemih = $this->input->post('abdomen_kandungkemih');
$abdomen_anus = $this->input->post('abdomen_anus');
$abdomen_genitaliaeks = $this->input->post('abdomen_genitaliaeks');
$abdomen_prostat = $this->input->post('abdomen_prostat');
$abdomen_lainlain = $this->input->post('abdomen_lainlain');
$vertebra = $this->input->post('vertebra');
$extremitasatas_simetris = $this->input->post('extremitasatas_simetris');
$extremitasatas_gerakankanan = $this->input->post('extremitasatas_gerakankanan');
$extremitasatas_gerakankiri = $this->input->post('extremitasatas_gerakankiri');
$extremitasatas_kekuatankanan = $this->input->post('extremitasatas_kekuatankanan');
$extremitasatas_kekuatankiri = $this->input->post('extremitasatas_kekuatankiri');
$extremitasatas_tulangkanan = $this->input->post('extremitasatas_tulangkanan');
$extremitasatas_tulangkiri = $this->input->post('extremitasatas_tulangkiri');
$extremitasatas_sensibilitaskanan = $this->input->post('extremitasatas_sensibilitaskanan');
$extremitasatas_sensibilitaskiri = $this->input->post('extremitasatas_sensibilitaskiri');
$extremitasatas_oedemakanan = $this->input->post('extremitasatas_oedemakanan');
$extremitasatas_oedemakiri = $this->input->post('extremitasatas_oedemakiri');
$extremitasatas_tremorkanan = $this->input->post('extremitasatas_tremorkanan');
$extremitasatas_tremorkiri = $this->input->post('extremitasatas_tremorkiri');
$extremitasatas_lainlain = $this->input->post('extremitasatas_lainlain');
$extremitasbawah_simetris = $this->input->post('extremitasbawah_simetris');
$extremitasbawah_gerakankanan = $this->input->post('extremitasbawah_gerakankanan');
$extremitasbawah_gerakankiri = $this->input->post('extremitasbawah_gerakankiri');
$extremitasbawah_kekuatankanan = $this->input->post('extremitasbawah_kekuatankanan');
$extremitasbawah_kekuatankiri = $this->input->post('extremitasbawah_kekuatankiri');
$extremitasbawah_tulangkanan = $this->input->post('extremitasbawah_tulangkanan');
$extremitasbawah_tulangkiri = $this->input->post('extremitasbawah_tulangkiri');
$extremitasbawah_sensibilitaskanan = $this->input->post('extremitasbawah_sensibilitaskanan');
$extremitasbawah_sensibilitaskiri = $this->input->post('extremitasbawah_sensibilitaskiri');
$extremitasbawah_oedemakanan = $this->input->post('extremitasbawah_oedemakanan');
$extremitasbawah_oedemakiri = $this->input->post('extremitasbawah_oedemakiri');
$extremitasbawah_tremorkanan = $this->input->post('extremitasbawah_tremorkanan');
$extremitasbawah_tremorkiri = $this->input->post('extremitasbawah_tremorkiri');
$extremitasbawah_lainlain = $this->input->post('extremitasbawah_lainlain');
$extremitasbawah_variseskanan = $this->input->post('extremitasbawah_variseskanan');
$extremitasbawah_variseskiri = $this->input->post('extremitasbawah_variseskiri');
$saraffungsiluhur_dayaingat = $this->input->post('saraffungsiluhur_dayaingat');
$saraffungsiluhur_orientasiwaktu = $this->input->post('saraffungsiluhur_orientasiwaktu');
$saraffungsiluhur_orientasiorang = $this->input->post('saraffungsiluhur_orientasiorang');
$saraffungsiluhur_orientasitempat = $this->input->post('saraffungsiluhur_orientasitempat');
$saraffungsiluhur_sikap = $this->input->post('saraffungsiluhur_sikap');
$saraffungsiluhur_kesansarafotak = $this->input->post('saraffungsiluhur_kesansarafotak');
$saraffungsiluhur_lainlain = $this->input->post('saraffungsiluhur_lainlain');
$kesansarafotak_fungsisensorikkanan = $this->input->post('kesansarafotak_fungsisensorikkanan');
$kesansarafotak_fungsisensorikkiri = $this->input->post('kesansarafotak_fungsisensorikkiri');
$kesansarafotak_fungsiotonomkanan = $this->input->post('kesansarafotak_fungsiotonomkanan');
$kesansarafotak_fungsiotonomkiri = $this->input->post('kesansarafotak_fungsiotonomkiri');
$kesansarafotak_fungsivaskularkanan = $this->input->post('kesansarafotak_fungsivaskularkanan');
$kesansarafotak_fungsivaskularkiri = $this->input->post('kesansarafotak_fungsivaskularkiri');
$kesansarafotak_gerakanabnormalkanan = $this->input->post('kesansarafotak_gerakanabnormalkanan');
$kesansarafotak_gerakanabnormalkiri = $this->input->post('kesansarafotak_gerakanabnormalkiri');
$kesansarafotak_reflfisiologispatelakanan = $this->input->post('kesansarafotak_reflfisiologispatelakanan');
$kesansarafotak_reflfisiologispatelakiri = $this->input->post('kesansarafotak_reflfisiologispatelakiri');
$kesansarafotak_reflpatologisbabinskykanan = $this->input->post('kesansarafotak_reflpatologisbabinskykanan');
$kesansarafotak_reflpatologisbabinskykiri = $this->input->post('kesansarafotak_reflpatologisbabinskykiri');
$kesansarafotak_lainlain = $this->input->post('kesansarafotak_lainlain');
$kelenjargetahbening_leher = $this->input->post('kelenjargetahbening_leher');
$kelenjargetahbening_submandibula = $this->input->post('kelenjargetahbening_submandibula');
$kelenjargetahbening_ketiak = $this->input->post('kelenjargetahbening_ketiak');
$kelenjargetahbening_inguinal = $this->input->post('kelenjargetahbening_inguinal');
$diagnosafisik = '';        

        if($gigi == 'Abnormal'){
        $diagnosafisik = $diagnosafisik."Gigi(Abnormal);" ;
        }
        
        if($tenggorokan_tonsil == 'Abnormal'){
        $diagnosafisik = $diagnosafisik."Tonsil(".$tenggorokan_ukurankanan."/".$tenggorokan_ukurankiri.");" ;
        }
        $uraiantelinga_serumenkanan = $this->input->post('uraiantelinga_serumenkanan');
        if($telinga_serumenkanan == 'Ada'){
        $diagnosafisik = $diagnosafisik."Serumen(".$uraiantelinga_serumenkanan.");" ;
        }
        
        $uraiankulitdankuku_kulit = $this->input->post('uraiankulitdankuku_kulit');
        if($uraiankulitdankuku_kulit != ''){
        $diagnosafisik = $diagnosafisik."Kulit(".$uraiankulitdankuku_kulit.");" ;
        }
$uraiankulitdankuku_selaputlendir = $this->input->post('uraiankulitdankuku_selaputlendir');
        if($uraiankulitdankuku_selaputlendir != ''){
        $diagnosafisik = $diagnosafisik."Selaput Lendir(".$uraiankulitdankuku_selaputlendir.");" ;
        }
$uraiankulitdankuku_kuku = $this->input->post('uraiankulitdankuku_kuku');
        if($uraiankulitdankuku_kuku != ''){
        $diagnosafisik = $diagnosafisik."Kuku(".$uraiankulitdankuku_kuku.");" ;
        }
$uraiankulitdankuku_kontraktur = $this->input->post('uraiankulitdankuku_kontraktur');
        if($uraiankulitdankuku_kontraktur != ''){
        $diagnosafisik = $diagnosafisik."Kontraktur(".$uraiankulitdankuku_kontraktur.");" ;
        }
$uraiankulitdankuku_lainlain = $this->input->post('uraiankulitdankuku_lainlain');
        if($uraiankulitdankuku_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain-Lain(Kuku dan Kulit)(".$uraiankulitdankuku_lainlain.");" ;
        }
$uraiankepala_tulang = $this->input->post('uraiankepala_tulang');
        if($uraiankepala_tulang != ''){
        $diagnosafisik = $diagnosafisik."Tulang(".$uraiankepala_tulang.");" ;
        }
$uraiankepala_kulitkepala = $this->input->post('uraiankepala_kulitkepala');
        if($uraiankepala_kulitkepala != ''){
        $diagnosafisik = $diagnosafisik."Kulit Kepala(".$uraiankepala_kulitkepala.");" ;
        }
$uraiankepala_rambut = $this->input->post('uraiankepala_rambut');
        if($uraiankepala_rambut != ''){
        $diagnosafisik = $diagnosafisik."Rambut(".$uraiankepala_rambut.");" ;
        }
$uraiankepala_lainlain = $this->input->post('uraiankepala_lainlain');
        if($uraiankepala_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain-Lain(Kepala)(".$uraiankepala_lainlain.");" ;
        }
$uraianmata_kelainanmatalainnya = $this->input->post('uraianmata_kelainanmatalainnya');
        if($uraianmata_kelainanmatalainnya != ''){
        $diagnosafisik = $diagnosafisik."Kelainan Mata Lainnya(".$uraianmata_kelainanmatalainnya.");" ;
        }
$uraianmata_lapangpandang = $this->input->post('uraianmata_lapangpandang');
        if($uraianmata_lapangpandang != ''){
        $diagnosafisik = $diagnosafisik."Lapang Pandang(".$uraianmata_lapangpandang.");" ;
        }
$uraiantelinga_dauntelingkanan = $this->input->post('uraiantelinga_dauntelingkanan');
        if($uraiantelinga_dauntelingkanan != ''){
        $diagnosafisik = $diagnosafisik."Daun Telinga(".$uraiantelinga_dauntelingkanan.");" ;
        }
$uraiantelinga_liangtelingakanan = $this->input->post('uraiantelinga_liangtelingakanan');
        if($uraiantelinga_liangtelingakanan != ''){
        $diagnosafisik = $diagnosafisik."Liang Telinga Kanan(".$uraiantelinga_liangtelingakanan.");" ;
        }
$uraiantelinga_liangtelingakiri = $this->input->post('uraiantelinga_liangtelingakiri');
        if($uraiantelinga_liangtelingakiri != ''){
        $diagnosafisik = $diagnosafisik."Liang Telinga Kiri(".$uraiantelinga_liangtelingakiri.");" ;
        }
$uraiantelinga_kesanpendengaran = $this->input->post('uraiantelinga_kesanpendengaran');
        if($uraiantelinga_kesanpendengaran != ''){
        $diagnosafisik = $diagnosafisik."Kesan Pendengaran(".$uraiantelinga_kesanpendengaran.");" ;
        }
$uraiantelinga_lainlain = $this->input->post('uraiantelinga_lainlain');
        if($uraiantelinga_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain-lain(Telinga)(".$uraiantelinga_lainlain.");" ;
        }
$uraianhidung_meatusnasi = $this->input->post('uraianhidung_meatusnasi');
        if($uraianhidung_meatusnasi != ''){
        $diagnosafisik = $diagnosafisik."Meatus Nasi(".$uraianhidung_meatusnasi.");" ;
        }
$uraianhidung_septumnasi = $this->input->post('uraianhidung_septumnasi');
        if($uraianhidung_septumnasi != ''){
        $diagnosafisik = $diagnosafisik."Septum Nasi(".$uraianhidung_septumnasi.");" ;
        }
$uraianhidung_konkanasal = $this->input->post('uraianhidung_konkanasal');
        if($uraianhidung_konkanasal != ''){
        $diagnosafisik = $diagnosafisik."Konka Nasal(".$uraianhidung_konkanasal.");" ;
        }
$uraianhidung_nyeriketoksinusmaksilaris = $this->input->post('uraianhidung_nyeriketoksinusmaksilaris');
        if($uraianhidung_nyeriketoksinusmaksilaris != ''){
        $diagnosafisik = $diagnosafisik."Nyeri Ketok Sinus Maksilaris(".$uraianhidung_nyeriketoksinusmaksilaris.");" ;
        }
$uraianhidung_lainlain = $this->input->post('uraianhidung_lainlain');
        if($uraianhidung_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain-lain(Hidung)(".$uraianhidung_lainlain.");" ;
        }
$uraiantenggorokan_pharynx = $this->input->post('uraiantenggorokan_pharynx');
        if($uraiantenggorokan_pharynx != ''){
        $diagnosafisik = $diagnosafisik."Pharynx(".$uraiantenggorokan_pharynx.");" ;
        }
$uraiantenggorokan_tonsil = $this->input->post('uraiantenggorokan_tonsil');
        if($uraiantenggorokan_tonsil != ''){
        $diagnosafisik = $diagnosafisik."Tonsil(".$uraiantenggorokan_tonsil.");" ;
        }
$uraiantenggorokan_palatum = $this->input->post('uraiantenggorokan_palatum');
        if($uraiantenggorokan_palatum != ''){
        $diagnosafisik = $diagnosafisik."Palatum(".$uraiantenggorokan_palatum.");" ;
        }
$uraiantenggorokan_lainlain = $this->input->post('uraiantenggorokan_lainlain');
        if($uraiantenggorokan_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain-lain(Tenggorokan)(".$uraiantenggorokan_lainlain.");" ;
        }
$uraianleher_gerakanleher = $this->input->post('uraianleher_gerakanleher');
        if($uraianleher_gerakanleher != ''){
        $diagnosafisik = $diagnosafisik."Gerakan Leher(".$uraianleher_gerakanleher.");" ;
        }
$uraianleher_kelenjarthyroid = $this->input->post('uraianleher_kelenjarthyroid');
        if($uraianleher_kelenjarthyroid != ''){
        $diagnosafisik = $diagnosafisik."Kelenjar Thyroid(".$uraianleher_kelenjarthyroid.");" ;
        }
$uraianleher_pulsasi = $this->input->post('uraianleher_pulsasi');
        if($uraianleher_pulsasi != ''){
        $diagnosafisik = $diagnosafisik."Pulsasi(".$uraianleher_pulsasi.");" ;
        }
$uraianleher_tekananvenajugularis = $this->input->post('uraianleher_tekananvenajugularis');
        if($uraianleher_tekananvenajugularis != ''){
        $diagnosafisik = $diagnosafisik."Tekanan Vena Jugularis(".$uraianleher_tekananvenajugularis.");" ;
        }
$uraianleher_trachea = $this->input->post('uraianleher_trachea');
        if($uraianleher_trachea != ''){
        $diagnosafisik = $diagnosafisik."Trachea(".$uraianleher_trachea.");" ;
        }
$uraianleher_lainlain = $this->input->post('uraianleher_lainlain');
        if($uraianleher_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain-lain(Leher)(".$uraianleher_lainlain.");" ;
        }
$uraiandada_mammae = $this->input->post('uraiandada_mammae');
        if($uraiandada_mammae != ''){
        $diagnosafisik = $diagnosafisik."Mammae(".$uraiandada_mammae.");" ;
        }
$uraiandada_lainlain = $this->input->post('uraiandada_lainlain');
        if($uraiandada_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain-lain(Dada)(".$uraiandada_lainlain.");" ;
        }
$uraianparuparudanjatung_palpasi = $this->input->post('uraianparuparudanjatung_palpasi');
        if($uraianparuparudanjatung_palpasi != ''){
        $diagnosafisik = $diagnosafisik."Palpasi(".$uraianparuparudanjatung_palpasi.");" ;
        }
$uraianparuparudanjatung_perkusikanan = $this->input->post('uraianparuparudanjatung_perkusikanan');
        if($uraianparuparudanjatung_perkusikanan != ''){
        $diagnosafisik = $diagnosafisik."Perkusi Kanan(".$uraianparuparudanjatung_perkusikanan.");" ;
        }
$uraianparuparudanjatung_perkusikiri = $this->input->post('uraianparuparudanjatung_perkusikiri');
        if($uraianparuparudanjatung_perkusikiri != ''){
        $diagnosafisik = $diagnosafisik."Perkusi Kiri(".$uraianparuparudanjatung_perkusikiri.");" ;
        }
$uraianparuparudanjatung_iktuskordis = $this->input->post('uraianparuparudanjatung_iktuskordis');
        if($uraianparuparudanjatung_iktuskordis != ''){
        $diagnosafisik = $diagnosafisik."Iktus Kordis(".$uraianparuparudanjatung_iktuskordis.");" ;
        }
$uraianparuparudanjatung_batasjantung = $this->input->post('uraianparuparudanjatung_batasjantung');
        if($uraianparuparudanjatung_batasjantung != ''){
        $diagnosafisik = $diagnosafisik."Batas Jantung(".$uraianparuparudanjatung_batasjantung.");" ;
        }
$uraianparuparudanjatung_bunyinapas = $this->input->post('uraianparuparudanjatung_bunyinapas');
        if($uraianparuparudanjatung_bunyinapas != ''){
        $diagnosafisik = $diagnosafisik."Bunyi Napas(".$uraianparuparudanjatung_bunyinapas.");" ;
        }
$uraianparuparudanjatung_bunyijantung = $this->input->post('uraianparuparudanjatung_bunyijantung');
        if($uraianparuparudanjatung_bunyijantung != ''){
        $diagnosafisik = $diagnosafisik."Bunyi Jantung(".$uraianparuparudanjatung_bunyijantung.");" ;
        }
$uraianabdomen_inspeksi = $this->input->post('uraianabdomen_inspeksi');
        if($uraianabdomen_inspeksi != ''){
        $diagnosafisik = $diagnosafisik."Inspeksi(".$uraianabdomen_inspeksi.");" ;
        }
$uraianabdomen_perkusi = $this->input->post('uraianabdomen_perkusi');
        if($uraianabdomen_perkusi != ''){
        $diagnosafisik = $diagnosafisik."Perkusi(".$uraianabdomen_perkusi.");" ;
        }
$uraianabdomen_auskultasibisingusus = $this->input->post('uraianabdomen_auskultasibisingusus');
        if($uraianabdomen_auskultasibisingusus != ''){
        $diagnosafisik = $diagnosafisik."Auskultasi Bising Usus(".$uraianabdomen_auskultasibisingusus.");" ;
        }
$uraianabdomen_hati = $this->input->post('uraianabdomen_hati');
        if($uraianabdomen_hati != ''){
        $diagnosafisik = $diagnosafisik."hati(".$uraianabdomen_hati.");" ;
        }
$uraianabdomen_limpa = $this->input->post('uraianabdomen_limpa');
        if($uraianabdomen_limpa != ''){
        $diagnosafisik = $diagnosafisik."Limpa(".$uraianabdomen_limpa.");" ;
        }
$uraianabdomen_nyeritekan = $this->input->post('uraianabdomen_nyeritekan');
        if($uraianabdomen_nyeritekan != ''){
        $diagnosafisik = $diagnosafisik."Nyeri Tekan(".$uraianabdomen_nyeritekan.");" ;
        }
$uraianabdomen_nyeriketokkanan = $this->input->post('uraianabdomen_nyeriketokkanan');
        if($uraianabdomen_nyeriketokkanan != ''){
        $diagnosafisik = $diagnosafisik."Nyeri Ketok Tekan Kanan(".$uraianabdomen_nyeriketokkanan.");" ;
        }
$uraianabdomen_nyeriketokkiri = $this->input->post('uraianabdomen_nyeriketokkiri');
        if($uraianabdomen_nyeriketokkiri != ''){
        $diagnosafisik = $diagnosafisik."Nyeri Ketok Tekan Kiri(".$uraianabdomen_nyeriketokkiri.");" ;
        }
$uraianabdomen_ballotementkanan = $this->input->post('uraianabdomen_ballotementkanan');
        if($uraianabdomen_ballotementkanan != ''){
        $diagnosafisik = $diagnosafisik."Ballotement Kanan(".$uraianabdomen_ballotementkanan.");" ;
        }
$uraianabdomen_ballotementkiri = $this->input->post('uraianabdomen_ballotementkiri');
        if($uraianabdomen_ballotementkiri != ''){
        $diagnosafisik = $diagnosafisik."Ballotement Kiri(".$uraianabdomen_ballotementkiri.");" ;
        }
$uraianabdomen_anus = $this->input->post('uraianabdomen_anus');
        if($uraianabdomen_anus != ''){
        $diagnosafisik = $diagnosafisik."Anus(".$uraianabdomen_anus.");" ;
        }
$uraianabdomen_genitaliaeks = $this->input->post('uraianabdomen_genitaliaeks');
        if($uraianabdomen_genitaliaeks != ''){
        $diagnosafisik = $diagnosafisik."Genitali Eks(".$uraianabdomen_genitaliaeks.");" ;
        }
$uraianabdomen_prostat = $this->input->post('uraianabdomen_prostat');
        if($uraianabdomen_prostat != ''){
        $diagnosafisik = $diagnosafisik."Prostat(".$uraianabdomen_prostat.");" ;
        }
$uraianabdomen_lainlain = $this->input->post('uraianabdomen_lainlain');
        if($uraianabdomen_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain-lain(Abdomen)(".$uraianabdomen_lainlain.");" ;
        }
$uraianvertebra = $this->input->post('uraianvertebra');
        if($uraianvertebra != ''){
        $diagnosafisik = $diagnosafisik."Vertebra(".$uraianvertebra.");" ;
        }
$uraianextremitasatas_simetris = $this->input->post('uraianextremitasatas_simetris');
        if($uraianextremitasatas_simetris != ''){
        $diagnosafisik = $diagnosafisik."Simetris(".$uraianextremitasatas_simetris.");" ;
        }
$uraianextremitasatas_gerakankanan = $this->input->post('uraianextremitasatas_gerakankanan');
        if($uraianextremitasatas_gerakankanan != ''){
        $diagnosafisik = $diagnosafisik."Gerakan Kanan(".$uraianextremitasatas_gerakankanan.");" ;
        }
$uraianextremitasatas_gerakankiri = $this->input->post('uraianextremitasatas_gerakankiri');
        if($uraianextremitasatas_gerakankiri != ''){
        $diagnosafisik = $diagnosafisik."Gerakan Kiri(".$uraianextremitasatas_gerakankiri.");" ;
        }
$uraianextremitasatas_kekuatankanan = $this->input->post('uraianextremitasatas_kekuatankanan');
        if($uraianextremitasatas_kekuatankanan != ''){
        $diagnosafisik = $diagnosafisik."Kekuatan Kanan(".$uraianextremitasatas_kekuatankanan.");" ;
        }
$uraianextremitasatas_kekuatankiri = $this->input->post('uraianextremitasatas_kekuatankiri');
        if($uraianextremitasatas_kekuatankiri != ''){
        $diagnosafisik = $diagnosafisik."Kekuatan Kiri(".$uraianextremitasatas_kekuatankiri.");" ;
        }
$uraianextremitasatas_tulangkanan = $this->input->post('uraianextremitasatas_tulangkanan');
        if($uraianextremitasatas_tulangkanan != ''){
        $diagnosafisik = $diagnosafisik."Tulang Kanan(".$uraianextremitasatas_tulangkanan.");" ;
        }
$uraianextremitasatas_tulangkiri = $this->input->post('uraianextremitasatas_tulangkiri');
        if($uraianextremitasatas_tulangkiri != ''){
        $diagnosafisik = $diagnosafisik."Tulang Kiri(".$uraianextremitasatas_tulangkiri.");" ;
        }
$uraianextremitasatas_sensibilitaskanan = $this->input->post('uraianextremitasatas_sensibilitaskanan');
        if($uraianextremitasatas_sensibilitaskanan != ''){
        $diagnosafisik = $diagnosafisik."Sensibilitas Kanan(".$uraianextremitasatas_sensibilitaskanan.");" ;
        }
$uraianextremitasatas_sensibilitaskiri = $this->input->post('uraianextremitasatas_sensibilitaskiri');
        if($uraianextremitasatas_sensibilitaskiri != ''){
        $diagnosafisik = $diagnosafisik."Sensibilitas Kiri(".$uraianextremitasatas_sensibilitaskiri.");" ;
        }
$uraianextremitasatas_lainlain = $this->input->post('uraianextremitasatas_lainlain');
        if($uraianextremitasatas_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain-lain(".$uraianextremitasatas_lainlain.");" ;
        }
$uraianextremitasbawah_simetris = $this->input->post('uraianextremitasbawah_simetris');
        if($uraianextremitasbawah_simetris != ''){
        $diagnosafisik = $diagnosafisik."Simetris(".$uraianextremitasbawah_simetris.");" ;
        }
$uraianextremitasbawah_gerakankanan = $this->input->post('uraianextremitasbawah_gerakankanan');
        if($uraianextremitasbawah_gerakankanan != ''){
        $diagnosafisik = $diagnosafisik."Gearakan Kanan(".$uraianextremitasbawah_gerakankanan.");" ;
        }
$uraianextremitasbawah_gerakankiri = $this->input->post('uraianextremitasbawah_gerakankiri');
        if($uraianextremitasbawah_gerakankiri != ''){
        $diagnosafisik = $diagnosafisik."Gerakan Kiri(".$uraianextremitasbawah_gerakankiri.");" ;
        }
$uraianextremitasbawah_kekuatankanan = $this->input->post('uraianextremitasbawah_kekuatankanan');
        if($uraianextremitasbawah_kekuatankanan != ''){
        $diagnosafisik = $diagnosafisik."Kekuatan Kanan(".$uraianextremitasbawah_kekuatankanan.");" ;
        }
$uraianextremitasbawah_kekuatankiri = $this->input->post('uraianextremitasbawah_kekuatankiri');
        if($uraianextremitasbawah_kekuatankiri != ''){
        $diagnosafisik = $diagnosafisik."Kekuatan Kiri(".$uraianextremitasbawah_kekuatankiri.");" ;
        }
$uraianextremitasbawah_tulangkanan = $this->input->post('uraianextremitasbawah_tulangkanan');
        if($uraianextremitasbawah_tulangkanan != ''){
        $diagnosafisik = $diagnosafisik."Tulang Kanan(".$uraianextremitasbawah_tulangkanan.");" ;
        }
$uraianextremitasbawah_tulangkiri = $this->input->post('uraianextremitasbawah_tulangkiri');
        if($uraianextremitasbawah_tulangkiri != ''){
        $diagnosafisik = $diagnosafisik."Tulang Kiri(".$uraianextremitasbawah_tulangkiri.");" ;
        }
$uraianextremitasbawah_sensibilitaskanan = $this->input->post('uraianextremitasbawah_sensibilitaskanan');
        if($uraianextremitasbawah_sensibilitaskanan != ''){
        $diagnosafisik = $diagnosafisik."Sensibilitas Kanan(".$uraianextremitasbawah_sensibilitaskanan.");" ;
        }
$uraianextremitasbawah_sensibilitaskiri = $this->input->post('uraianextremitasbawah_sensibilitaskiri');
        if($uraianextremitasbawah_sensibilitaskiri != ''){
        $diagnosafisik = $diagnosafisik."Sensibilitas Kiri(".$uraianextremitasbawah_sensibilitaskiri.");" ;
        }
$uraianextremitasbawah_lainlain = $this->input->post('uraianextremitasbawah_lainlain');
        if($uraianextremitasbawah_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain-Lain(".$uraianextremitasbawah_lainlain.");" ;
        }
$uraiansaraffungsiluhur_orientasiwaktu = $this->input->post('uraiansaraffungsiluhur_orientasiwaktu');
        if($uraiansaraffungsiluhur_orientasiwaktu != ''){
        $diagnosafisik = $diagnosafisik."Orientasi Waktu(".$uraiansaraffungsiluhur_orientasiwaktu.");" ;
        }
$uraiansaraffungsiluhur_orientasiorang = $this->input->post('uraiansaraffungsiluhur_orientasiorang');
        if($uraiansaraffungsiluhur_orientasiorang != ''){
        $diagnosafisik = $diagnosafisik."Orientasi Orang(".$uraiansaraffungsiluhur_orientasiorang.");" ;
        }
$uraiansaraffungsiluhur_orientasitempat = $this->input->post('uraiansaraffungsiluhur_orientasitempat');
        if($uraiansaraffungsiluhur_orientasitempat != ''){
        $diagnosafisik = $diagnosafisik."Orientasi Tempat(".$uraiansaraffungsiluhur_orientasitempat.");" ;
        }
$uraiansaraffungsiluhur_kesansarafotak = $this->input->post('uraiansaraffungsiluhur_kesansarafotak');
        if($uraiansaraffungsiluhur_kesansarafotak != ''){
        $diagnosafisik = $diagnosafisik."Kesan Saraf Otak(".$uraiansaraffungsiluhur_kesansarafotak.");" ;
        }
$uraiansaraffungsiluhur_lainlain = $this->input->post('uraiansaraffungsiluhur_lainlain');
        if($uraiansaraffungsiluhur_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain Lain(Saraf Fungsi Luhur) (".$uraiansaraffungsiluhur_lainlain.");" ;
        }
$uraiankesansarafotak_fungsisensorikkanan = $this->input->post('uraiankesansarafotak_fungsisensorikkanan');
        if($uraiankesansarafotak_fungsisensorikkanan != ''){
        $diagnosafisik = $diagnosafisik."Fungsi Sensorik Kanan(".$uraiankesansarafotak_fungsisensorikkanan.");" ;
        }
$uraiankesansarafotak_fungsisensorikkiri = $this->input->post('uraiankesansarafotak_fungsisensorikkiri');
        if($uraiankesansarafotak_fungsisensorikkiri != ''){
        $diagnosafisik = $diagnosafisik."Fungsi Sensorik Kiri(".$uraiankesansarafotak_fungsisensorikkiri.");" ;
        }
$uraiankesansarafotak_fungsiotonomkanan = $this->input->post('uraiankesansarafotak_fungsiotonomkanan');
        if($uraiankesansarafotak_fungsiotonomkanan != ''){
        $diagnosafisik = $diagnosafisik."Fungsi Otonom Kanan(".$uraiankesansarafotak_fungsiotonomkanan.");" ;
        }
$uraiankesansarafotak_fungsiotonomkiri = $this->input->post('uraiankesansarafotak_fungsiotonomkiri');
        if($uraiankesansarafotak_fungsiotonomkiri != ''){
        $diagnosafisik = $diagnosafisik."Fungsi Otonom Kiri(".$uraiankesansarafotak_fungsiotonomkiri.");" ;
        }
$uraiankesansarafotak_fungsivaskularkanan = $this->input->post('uraiankesansarafotak_fungsivaskularkanan');
        if($uraiankesansarafotak_fungsivaskularkanan != ''){
        $diagnosafisik = $diagnosafisik."Vaskular Kanan(".$uraiankesansarafotak_fungsivaskularkanan.");" ;
        }
$uraiankesansarafotak_fungsivaskularkiri = $this->input->post('uraiankesansarafotak_fungsivaskularkiri');
        if($uraiankesansarafotak_fungsivaskularkiri != ''){
        $diagnosafisik = $diagnosafisik."Vaskular Kiri(".$uraiankesansarafotak_fungsivaskularkiri.");" ;
        }
$uraiankesansarafotak_reflfisiologispatelakanan = $this->input->post('uraiankesansarafotak_reflfisiologispatelakanan');
        if($uraiankesansarafotak_reflfisiologispatelakanan != ''){
        $diagnosafisik = $diagnosafisik."Refl Fisiologi Patela Kanan(".$uraiankesansarafotak_reflfisiologispatelakanan.");" ;
        }
$uraiankesansarafotak_reflfisiologispatelakiri = $this->input->post('uraiankesansarafotak_reflfisiologispatelakiri');
        if($uraiankesansarafotak_reflfisiologispatelakiri != ''){
        $diagnosafisik = $diagnosafisik."Refl Fisiologi Patela Kiri(".$uraiankesansarafotak_reflfisiologispatelakiri.");" ;
        }
$uraiankesansarafotak_reflpatologisbabinskykanan = $this->input->post('uraiankesansarafotak_reflpatologisbabinskykanan');
        if($uraiankesansarafotak_reflpatologisbabinskykanan != ''){
        $diagnosafisik = $diagnosafisik."Refl Patologi Babinsky Kanan(".$uraiankesansarafotak_reflpatologisbabinskykanan.");" ;
        }
$uraiankesansarafotak_reflpatologisbabinskykiri = $this->input->post('uraiankesansarafotak_reflpatologisbabinskykiri');
        if($uraiankesansarafotak_reflpatologisbabinskykiri != ''){
        $diagnosafisik = $diagnosafisik."Refl Patologi Babinsky Kiri(".$uraiankesansarafotak_reflpatologisbabinskykiri.");" ;
        }
$uraiankesansarafotak_lainlain = $this->input->post('uraiankesansarafotak_lainlain');
        if($uraiankesansarafotak_lainlain != ''){
        $diagnosafisik = $diagnosafisik."Lain Lain(Kesan Saraf Otak) (".$uraiankesansarafotak_lainlain.");" ;
        }
$uraiankelenjargetahbening_leher = $this->input->post('uraiankelenjargetahbening_leher');
        if($uraiankelenjargetahbening_leher != ''){
        $diagnosafisik = $diagnosafisik."leher(".$uraiankelenjargetahbening_leher.");" ;
        }
$uraiankelenjargetahbening_submandibula = $this->input->post('uraiankelenjargetahbening_submandibula');
        if($uraiankelenjargetahbening_submandibula != ''){
        $diagnosafisik = $diagnosafisik."Submandibula(".$uraiankelenjargetahbening_submandibula.");" ;
        }
$uraiankelenjargetahbening_ketiak = $this->input->post('uraiankelenjargetahbening_ketiak');
        if($uraiankelenjargetahbening_ketiak != ''){
        $diagnosafisik = $diagnosafisik."Ketiak(".$uraiankelenjargetahbening_ketiak.");" ;
        }
$uraiankelenjargetahbening_inguinal = $this->input->post('uraiankelenjargetahbening_inguinal');  
        if($uraiankelenjargetahbening_inguinal != ''){
        $diagnosafisik = $diagnosafisik."Inguinal(".$uraiankelenjargetahbening_inguinal.");" ;
        }
$hasiltingkatkesadaran = intval($tingkatkesadaran_mata) + intval($tingkatkesadaran_verbal) + intval($tingkatkesadaran_motorik);      
        if($hasiltingkatkesadaran >= 14 and $hasiltingkatkesadaran <= 15){
            $uraiantingkatkesadaran = "Composmentis (".$hasiltingkatkesadaran.") Penjelasan : kondisi seseorang yang sadar sepenuhnya, baik terhadap dirinya maupun terhadap lingkungannya dan dapat menjawab pertanyaan yang ditanyakan pemeriksa dengan baik";
            $diagnosafisik = $diagnosafisik."Composmentis (".$hasiltingkatkesadaran.");" ;
        }
        if($hasiltingkatkesadaran >= 12 and $hasiltingkatkesadaran <= 13){
            $uraiantingkatkesadaran = "Apatis (".$hasiltingkatkesadaran.") Penjelasan : Kondisi seseorang yang tampak segan dan acuh tak acuh terhadap lingkungannya";
            $diagnosafisik = $diagnosafisik."Apatis (".$hasiltingkatkesadaran.");" ;
        }
        if($hasiltingkatkesadaran >= 10 and $hasiltingkatkesadaran <= 11){
            $uraiantingkatkesadaran = "Delirium (".$hasiltingkatkesadaran.") Penjelasan : kondisi seseorang yang mengalami kekacauan gerakan, siklus tidur bangun yang terganggu dan tampak gaduh gelisah, kacau, disorientasi serta meronta-ronta";
            $diagnosafisik = $diagnosafisik."Delirium (".$hasiltingkatkesadaran.");" ;
        }
        if($hasiltingkatkesadaran >= 7 and $hasiltingkatkesadaran <= 9){
            $uraiantingkatkesadaran = "Somnolen (".$hasiltingkatkesadaran.") Penjelasan : kondisi seseorang yang mengalami penurunan kesadaran namun masih dapat sadar bila dirangsang, tetapi bila rangsang berhenti akan tertidur kembali";
            $diagnosafisik = $diagnosafisik."Somnolen (".$hasiltingkatkesadaran.");" ;
        }
        if($hasiltingkatkesadaran >= 5 and $hasiltingkatkesadaran <= 6){
            $uraiantingkatkesadaran = "Sopor (".$hasiltingkatkesadaran.") Penjelasan : kondisi seseorang yang mengalami penurunan kesadaran berat, namun masih dapat dibangunkan dengan rangsang yang kuat, misalnya rangsang nyeri, tetapi tidak terbangun sempurna dan tidak dapat menjawab pertanyaan dengan baik.";
            $diagnosafisik = $diagnosafisik."Sopor (".$hasiltingkatkesadaran.");" ;
        }
        if($hasiltingkatkesadaran > 3 and $hasiltingkatkesadaran <= 4){
            $uraiantingkatkesadaran = "semi-coma (".$hasiltingkatkesadaran.") Penjelasan : penurunan kesadaran yang tidak memberikan respons terhadap pertanyaan, tidak dapat dibangunkan sama sekali, respons terhadap rangsang nyeri hanya sedikit, tetapi refleks kornea dan pupil masih baik";
            $diagnosafisik = $diagnosafisik."semi-coma (".$hasiltingkatkesadaran.");" ;
        }
        if($hasiltingkatkesadaran >= 1 and $hasiltingkatkesadaran <= 3){
            $uraiantingkatkesadaran = "Coma (".$hasiltingkatkesadaran.") Penjelasan : penurunan kesadaran yang sangat dalam, memberikan respons terhadap pertanyaan, tidak ada gerakan, dan tidak ada respons terhadap rangsang nyeri.";
            $diagnosafisik = $diagnosafisik."Coma (".$hasiltingkatkesadaran.");" ;
        }
        if($hasiltingkatkesadaran == ''){
            $uraiantingkatkesadaran = "";
        }
        
        
        if($nadi < 60){
            $uraiannadi = "Bradikardi";
            $diagnosafisik = $diagnosafisik."Nadi (".$nadi.")(Bradikardi);" ;
        }
        if($nadi >= 60 and $nadi <= 100){
            $uraiannadi = "Normal";
        }
        if($nadi > 100){
            $uraiannadi = "Takikardi";
            $diagnosafisik = $diagnosafisik."Nadi (".$nadi.")(Takikardi);" ;
        }
        if($nadi == ''){
            $uraiannadi = "";
        }
        if($pernafasan < 12){
            $uraianpernafasan = "Bradipnea";
            $diagnosafisik = $diagnosafisik."Pernafasan (".$pernafasan.")(Bradipnea);" ;
        }
        if($pernafasan >= 12 and $pernafasan <= 20){
            $uraianpernafasan = "Normal";
            //$diagnosafisik = $diagnosafisik."Pernafasan (".$pernafasan.")(Normal);" ;
        }
        if($pernafasan > 20){
            $uraianpernafasan = "Takipnea (Nafas Cepat)";
            $diagnosafisik = $diagnosafisik."Pernafasan (".$pernafasan.")(Takipnea);" ;
        }
        if($pernafasan == ''){
            $uraianpernafasan = "";
        }
        if($suhubadan < 36.0){
            $uraiansuhubadan = "Hipotermia";
            $diagnosafisik = $diagnosafisik."Suhu Badan (".$suhubadan.")(Hipotermia);" ;
        }
        if($suhubadan >= 36.0 and $suhubadan <= 37.5){
            $uraiansuhubadan = "Normal";
        }
        if($suhubadan >= 37.6){
            $uraiansuhubadan = "Hipertermia";
            $diagnosafisik = $diagnosafisik."Suhu Badan (".$suhubadan.")(Hipertermia);" ;
        }
        if($suhubadan == ''){
            $uraiansuhubadan = "";
        }
        
        if(floatval($imt) < 18.5){
            $uraianimt = "Underweight";
            $diagnosafisik = $diagnosafisik."IMT (".$imt.")(Underweight);" ;
        }
        if(floatval($imt) >= 18.5 and floatval($imt) <= 25.0){
            $uraianimt = "Normal Range";
        }
        if(floatval($imt) > 25.0 and floatval($imt) < 30.0){
            $uraianimt = "overweight";
            $diagnosafisik = $diagnosafisik."IMT (".$imt.")(Overweight);" ;
        }
        if(floatval($imt) == 30){
            $uraianimt = "Obese";
            $diagnosafisik = $diagnosafisik."IMT (".$imt.")(Obese);" ;
        }
        if(floatval($imt) > 30.0 and floatval($imt) <= 35.0){
            $uraianimt = "Obese Class I";
            $diagnosafisik = $diagnosafisik."IMT (".$imt.")(Obese Class I);" ;
        }
        if(floatval($imt) > 35.0 and floatval($imt) <= 40.0){
            $uraianimt = "Obese Class II";
            $diagnosafisik = $diagnosafisik."IMT (".$imt.")(Obese Class II);" ;
        }
        if(floatval($imt) >= 40.0){
            $uraianimt = "Obese Class III";
            $diagnosafisik = $diagnosafisik."IMT (".$imt.")(Obese Class III);" ;
        }
        if(floatval($imt) == ''){
            $uraianimt = "";
        }
        
        if($standarsatuan == 'WHO'){
            if($sistole < 90 or $diastole < 60)    {
            $uraiantekanandarah = "Hipotensi";
                $diagnosafisik = $diagnosafisik."Tekanan Darah (".$sistole."/".$diastole.")(Hipotensi);" ;
            }elseif(($sistole >= 90 and $sistole <= 120) and ($diastole >= 60 and $diastole <= 79))    {
            $uraiantekanandarah = "Normal";
            }elseif(($sistole >= 121 and $sistole <= 139) or ($diastole >= 80 and $diastole <= 89))    {
            $uraiantekanandarah = "Prahipertensi";
                $diagnosafisik = $diagnosafisik."Tekanan Darah (".$sistole."/".$diastole.")(Prahipertensi);" ;
            }elseif(($sistole >= 140 and $sistole <= 159) or ($diastole >= 90 and $diastole <= 99))    {
            $uraiantekanandarah = "Hipertensi Tahap 1";
                $diagnosafisik = $diagnosafisik."Tekanan Darah (".$sistole."/".$diastole.")(Hipertensi Tahap 1);" ;
            }elseif(($sistole >= 160 and $sistole <= 179) or ($diastole >= 100 and $diastole <= 119))    {
            $uraiantekanandarah = "Hipertensi Tahap 2";
                $diagnosafisik = $diagnosafisik."Tekanan Darah (".$sistole."/".$diastole.")(Hipertensi Tahap 2);" ;
            }elseif($sistole >= 180  or $diastole >= 120)    {
            $uraiantekanandarah = "Krisis Hipertensif";
                $diagnosafisik = $diagnosafisik."Tekanan Darah (".$sistole."/".$diastole.")(Krisis Hipertensif);" ;
            }elseif($sistole == ''  or $diastole == '')    {
            $uraiantekanandarah = "";
            }
        }
        else{
            if($sistole >= 160  or $diastole >= 100)    {
            $uraiantekanandarah = "Hipertensi Grade 2";
                $diagnosafisik = $diagnosafisik."Tekanan Darah (".$sistole."/".$diastole.")(Hipertensi Grade 2);" ;
            }elseif(($sistole >= 140 and $sistole <= 159) or ($diastole >= 90 and $diastole <= 99))    {
            $uraiantekanandarah = "Hipertensi Grade 1";
                $diagnosafisik = $diagnosafisik."Tekanan Darah (".$sistole."/".$diastole.")(Hipertensi Grade 1);" ;
            }elseif(($sistole >= 120 and $sistole <= 139) or ($diastole >= 80 and $diastole <= 89))    {
            
                if($id_instansi == '104'){
                $uraiantekanandarah = "Normal";
                    $diagnosafisik = $diagnosafisik."Tekanan Darah (".$sistole."/".$diastole.")(Normal);" ;
                }else{
                    $uraiantekanandarah = "Prehipertensi";
                    $diagnosafisik = $diagnosafisik."Tekanan Darah (".$sistole."/".$diastole.")(Prehipertensi);" ;
                }
                
            }elseif($sistole < 120 and $diastole < 80)    {
            $uraiantekanandarah = "Normal";
            }elseif($sistole == ''  or $diastole == ''){
            $uraiantekanandarah = "";
            }
            
            
        }
        $vod = $mata_od."/".$mata_ods;
        $vos = $mata_os."/".$mata_oss;
        if($mata_pemeriksaandilakukan == 'Snellchart_5_M'){
            if($vod == '5/3' or $vos == '5/3'){
            $mata_visus = 'Normal';
            $uraianmata_visus = '';
            }
            if($vod == '5/4' or $vos == '5/4'){
            $mata_visus = 'Normal';
            $uraianmata_visus = '';
            }
            if($vod == '5/5' or $vos == '5/5'){
            $mata_visus = 'Normal';
            $uraianmata_visus = '';
            }
            if($vod == '5/6' or $vos == '5/6'){
            $mata_visus = 'Normal';
            $uraianmata_visus = '';
            }
            if($vos == '5/8'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN OS';
            }
            if($vos == '5/10'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN OS';
            }
            if($vos == '5/13'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN OS';
            }
            if($vos == '5/16'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN OS';
            }
            if($vos == '5/20'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG OS';
            }
            if($vos == '5/25'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG OS';
            }
            if($vos == '5/32'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG OS';
            }
            if($vos == '5/40'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG OS';
            }
            if($vos == '5/50'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS BERAT OS';
            }
            if($vod == '5/8'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS RINGAN OD';
            }
            if($vod == '5/10'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS RINGAN OD';
            }
            if($vod == '5/13'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS RINGAN OD';
            }
            if($vod == '5/16'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS RINGAN OD';
            }
            if($vod == '5/20'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS SEDANG OD';
            }
            if($vod == '5/25'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS SEDANG OD';
            }
            if($vod == '5/32'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS SEDANG OD';
            }
            if($vod == '5/40'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS SEDANG OD';
            }
            if($vod == '5/50'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS BERAT OD';
            }
            
            if($vod == '5/8' and $vos == '5/8'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN ODS';
            }
            if($vod == '5/10' and $vos == '5/10'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN ODS';
            }
            if($vod == '5/13' and $vos == '5/13'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN ODS';
            }
            if($vod == '5/16' and $vos == '5/16'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN ODS';
            }
            if($vod == '5/20' and $vos == '5/20'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG ODS';
            }
            if($vod == '5/25' and $vos == '5/25'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG ODS';
            }
            if($vod == '5/32' and $vos == '5/32'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG ODS';
            }
            if($vod == '5/40' and $vos == '5/40'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG ODS';
            }
            if($vod == '5/50' and $vos == '5/50'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS BERAT ODS';
            }
            
        }
        else{
            if($vod == '6/4' or $vos == '6/4'){
            $mata_visus = 'Normal';
            $uraianmata_visus = '';
            }
            if($vod == '6/5' or $vos == '6/5'){
            $mata_visus = 'Normal';
            $uraianmata_visus = '';
            }
            if($vod == '6/6' or $vos == '6/6'){
            $mata_visus = 'Normal';
            $uraianmata_visus = '';
            }
            if($vod == '6/7.5' or $vos == '6/7.5'){
            $mata_visus = 'Normal';
            $uraianmata_visus = '';
            }
            if($vos == '6/9'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN OS';
            }
            if($vos == '6/12'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN OS';
            }
            if($vos == '6/15'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN OS';
            }
            if($vos == '6/20'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN OS';
            }
            if($vos == '6/24'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG OS';
            }
            if($vos == '6/30'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG OS';
            }
            if($vos == '6/38'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG OS';
            }
            if($vos == '6/48'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG OS';
            }
            if($vos == '6/60'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS BERAT OS';
            }
            if($vod == '6/9'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS RINGAN OD';
            }
            if($vod == '6/12'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS RINGAN OD';
            }
            if($vod == '6/15'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS RINGAN OD';
            }
            if($vod == '6/20'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS RINGAN OD';
            }
            if($vod == '6/24'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS SEDANG OD';
            }
            if($vod == '6/30'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS SEDANG OD';
            }
            if($vod == '6/38'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS SEDANG OD';
            }
            if($vod == '6/48'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS SEDANG OD';
            }
            if($vod == '6/60'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = $uraianmata_visus.', PENURUNAN VISUS BERAT OD';
            }
            if($vod == '6/9' and $vos == '6/9'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN ODS';
            }
            if($vod == '6/12' and $vos == '6/12'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN ODS';
            }
            if($vod == '6/15' and $vos == '6/15'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN ODS';
            }
            if($vod == '6/20' and $vos == '6/20'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS RINGAN ODS';
            }
            if($vod == '6/24' and $vos == '6/24'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG ODS';
            }
            if($vod == '6/30' and $vos == '6/30'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG ODS';
            }
            if($vod == '6/38' and $vos == '6/38'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG ODS';
            }
            if($vod == '6/48' and $vos == '6/48'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS SEDANG ODS';
            }
            if($vod == '6/60' and $vos == '6/60'){
            $mata_visus = 'Abnormal';
            $uraianmata_visus = 'PENURUNAN VISUS BERAT ODS';
            }
            
            if($penggunaankacamata == 'Ya' and $mata_visus == 'Abnormal'){
                $uraianmata_visus = "Kacamata Tidak Terkoreksi" ;
            }
        }
        
        $datafisik=array( 
           'dokterpemeriksa' => $dokterpemeriksa,
           'petugas' => $petugas,
           'catatandokter' => $catatandokter,
           'diagnosa' => $diagnosafisik,
           'penggunaankacamata' => $penggunaankacamata,
           'noregistrasi' => $noregistrasi,
'nadi' => $nadi,
'gigi' => $gigi,
'keterangan_gigi' => $keterangan_gigi,
'pernafasan' => $pernafasan,
'sistole' => $sistole,
'diastole' => $diastole,
'suhubadan' => $suhubadan,
'tinggibadan' => $tinggibadan,
'beratbadan' => $beratbadan,
'imt' => $imt,
'lingkarperut' => $lingkarperut,
'bentukbadan' => $bentukbadan,
'tingkatkesadaran_mata' => $tingkatkesadaran_mata,
'tingkatkesadaran_verbal' => $tingkatkesadaran_verbal,
'tingkatkesadaran_motorik' => $tingkatkesadaran_motorik,
'kulitdankuku_kulit' => $kulitdankuku_kulit,
'kulitdankuku_selaputlendir' => $kulitdankuku_selaputlendir,
'kulitdankuku_kuku' => $kulitdankuku_kuku,
'kulitdankuku_kontraktur' => $kulitdankuku_kontraktur,
'kulitdankuku_bekasoperasi' => $kulitdankuku_bekasoperasi,
'kulitdankuku_lainlain' => $kulitdankuku_lainlain,
'kepala_tulang' => $kepala_tulang,
'kepala_kulitkepala' => $kepala_kulitkepala,
'kepala_rambut' => $kepala_rambut,
'kepala_bentukwajah' => $kepala_bentukwajah,
'kepala_lainlain' => $kepala_lainlain,
'mata_pemeriksaandilakukan' => $mata_pemeriksaandilakukan,
'mata_visus' => $mata_visus,
'mata_od' => $mata_od,
'mata_os' => $mata_os,
'mata_ods' => $mata_ods,
'mata_oss' => $mata_oss,
'mata_butawarna' => $mata_butawarna,
'mata_kelainanmatalainnya' => $mata_kelainanmatalainnya,
'mata_lapangpandang' => $mata_lapangpandang,
'telinga_dauntelingkanan' => $telinga_dauntelingkanan,
'telinga_dauntelingkiri' => $telinga_dauntelingkiri,
'telinga_liangtelingakanan' => $telinga_liangtelingakanan,
'telinga_liangtelingakiri' => $telinga_liangtelingakiri,
'telinga_serumenkanan' => $telinga_serumenkanan,
'telinga_serumenkiri' => $telinga_serumenkiri,
'telinga_membranatimfanikanan' => $telinga_membranatimfanikanan,
'telinga_membranatimfanikiri' => $telinga_membranatimfanikiri,
'telinga_kesanpendengaran' => $telinga_kesanpendengaran,
'hidung_meatusnasi' => $hidung_meatusnasi,
'hidung_septumnasi' => $hidung_septumnasi,
'hidung_konkanasal' => $hidung_konkanasal,
'hidung_nyeriketoksinusmaksilaris' => $hidung_nyeriketoksinusmaksilaris,
'hidung_lainlain' => $hidung_lainlain,
'tenggorokan_pharynx' => $tenggorokan_pharynx,
'tenggorokan_tonsil' => $tenggorokan_tonsil,
'tenggorokan_ukurankanan' => $tenggorokan_ukurankanan,
'tenggorokan_ukurankiri' => $tenggorokan_ukurankiri,
'tenggorokan_palatum' => $tenggorokan_palatum,
'tenggorokan_lainlain' => $tenggorokan_lainlain,
'mulut_oralhygiene' => $mulut_oralhygiene,
'mulut_gusi' => $mulut_gusi,
'leher_gerakanleher' => $leher_gerakanleher,
'leher_kelenjarthyroid' => $leher_kelenjarthyroid,
'leher_pulsasi' => $leher_pulsasi,
'leher_tekananvenajugularis' => $leher_tekananvenajugularis,
'leher_trachea' => $leher_trachea,
'leher_lainlain' => $leher_lainlain,
'dada_bentuk' => $dada_bentuk,
'dada_mammae' => $dada_mammae,
'dada_lainlain' => $dada_lainlain,
'paruparudanjatung_palpasi' => $paruparudanjatung_palpasi,
'paruparudanjatung_perkusikanan' => $paruparudanjatung_perkusikanan,
'paruparudanjatung_perkusikiri' => $paruparudanjatung_perkusikiri,
'paruparudanjatung_iktuskordis' => $paruparudanjatung_iktuskordis,
'paruparudanjatung_batasjantung' => $paruparudanjatung_batasjantung,
'paruparudanjatung_bunyinapas' => $paruparudanjatung_bunyinapas,
'paruparudanjatung_tambahan' => $paruparudanjatung_tambahan,
'paruparudanjatung_bunyijantung' => $paruparudanjatung_bunyijantung,
'abdomen_inspeksi' => $abdomen_inspeksi,
'abdomen_perkusi' => $abdomen_perkusi,
'abdomen_auskultasibisingusus' => $abdomen_auskultasibisingusus,
'abdomen_hati' => $abdomen_hati,
'abdomen_limpa' => $abdomen_limpa,
'abdomen_nyeritekan' => $abdomen_nyeritekan,
'abdomen_nyeriketokkanan' => $abdomen_nyeriketokkanan,
'abdomen_nyeriketokkiri' => $abdomen_nyeriketokkiri,
'abdomen_ballotementkanan' => $abdomen_ballotementkanan,
'abdomen_ballotementkiri' => $abdomen_ballotementkiri,
'abdomen_kandungkemih' => $abdomen_kandungkemih,
'abdomen_anus' => $abdomen_anus,
'abdomen_genitaliaeks' => $abdomen_genitaliaeks,
'abdomen_prostat' => $abdomen_prostat,
'abdomen_lainlain' => $abdomen_lainlain,
'vertebra' => $vertebra,
'extremitasatas_simetris' => $extremitasatas_simetris,
'extremitasatas_gerakankanan' => $extremitasatas_gerakankanan,
'extremitasatas_gerakankiri' => $extremitasatas_gerakankiri,
'extremitasatas_kekuatankanan' => $extremitasatas_kekuatankanan,
'extremitasatas_kekuatankiri' => $extremitasatas_kekuatankiri,
'extremitasatas_tulangkanan' => $extremitasatas_tulangkanan,
'extremitasatas_tulangkiri' => $extremitasatas_tulangkiri,
'extremitasatas_sensibilitaskanan' => $extremitasatas_sensibilitaskanan,
'extremitasatas_sensibilitaskiri' => $extremitasatas_sensibilitaskiri,
'extremitasatas_oedemakanan' => $extremitasatas_oedemakanan,
'extremitasatas_oedemakiri' => $extremitasatas_oedemakiri,
'extremitasatas_tremorkanan' => $extremitasatas_tremorkanan,
'extremitasatas_tremorkiri' => $extremitasatas_tremorkiri,
'extremitasatas_lainlain' => $extremitasatas_lainlain,
'extremitasbawah_simetris' => $extremitasbawah_simetris,
'extremitasbawah_gerakankanan' => $extremitasbawah_gerakankanan,
'extremitasbawah_gerakankiri' => $extremitasbawah_gerakankiri,
'extremitasbawah_kekuatankanan' => $extremitasbawah_kekuatankanan,
'extremitasbawah_kekuatankiri' => $extremitasbawah_kekuatankiri,
'extremitasbawah_tulangkanan' => $extremitasbawah_tulangkanan,
'extremitasbawah_tulangkiri' => $extremitasbawah_tulangkiri,
'extremitasbawah_sensibilitaskanan' => $extremitasbawah_sensibilitaskanan,
'extremitasbawah_sensibilitaskiri' => $extremitasbawah_sensibilitaskiri,
'extremitasbawah_oedemakanan' => $extremitasbawah_oedemakanan,
'extremitasbawah_oedemakiri' => $extremitasbawah_oedemakiri,
'extremitasbawah_tremorkanan' => $extremitasbawah_tremorkanan,
'extremitasbawah_tremorkiri' => $extremitasbawah_tremorkiri,
'extremitasbawah_lainlain' => $extremitasbawah_lainlain,
'extremitasbawah_variseskanan' => $extremitasbawah_variseskanan,
'extremitasbawah_variseskiri' => $extremitasbawah_variseskiri,
'saraffungsiluhur_dayaingat' => $saraffungsiluhur_dayaingat,
'saraffungsiluhur_orientasiwaktu' => $saraffungsiluhur_orientasiwaktu,
'saraffungsiluhur_orientasiorang' => $saraffungsiluhur_orientasiorang,
'saraffungsiluhur_orientasitempat' => $saraffungsiluhur_orientasitempat,
'saraffungsiluhur_sikap' => $saraffungsiluhur_sikap,
'saraffungsiluhur_kesansarafotak' => $saraffungsiluhur_kesansarafotak,
'saraffungsiluhur_lainlain' => $saraffungsiluhur_lainlain,
'kesansarafotak_fungsisensorikkanan' => $kesansarafotak_fungsisensorikkanan,
'kesansarafotak_fungsisensorikkiri' => $kesansarafotak_fungsisensorikkiri,
'kesansarafotak_fungsiotonomkanan' => $kesansarafotak_fungsiotonomkanan,
'kesansarafotak_fungsiotonomkiri' => $kesansarafotak_fungsiotonomkiri,
'kesansarafotak_fungsivaskularkanan' => $kesansarafotak_fungsivaskularkanan,
'kesansarafotak_fungsivaskularkiri' => $kesansarafotak_fungsivaskularkiri,
'kesansarafotak_gerakanabnormalkanan' => $kesansarafotak_gerakanabnormalkanan,
'kesansarafotak_gerakanabnormalkiri' => $kesansarafotak_gerakanabnormalkiri,
'kesansarafotak_reflfisiologispatelakanan' => $kesansarafotak_reflfisiologispatelakanan,
'kesansarafotak_reflfisiologispatelakiri' => $kesansarafotak_reflfisiologispatelakiri,
'kesansarafotak_reflpatologisbabinskykanan' => $kesansarafotak_reflpatologisbabinskykanan,
'kesansarafotak_reflpatologisbabinskykiri' => $kesansarafotak_reflpatologisbabinskykiri,
'kesansarafotak_lainlain' => $kesansarafotak_lainlain,
'kelenjargetahbening_leher' => $kelenjargetahbening_leher,
'kelenjargetahbening_submandibula' => $kelenjargetahbening_submandibula,
'kelenjargetahbening_ketiak' => $kelenjargetahbening_ketiak,
'kelenjargetahbening_inguinal' => $kelenjargetahbening_inguinal,

         ); 
       
        $this->ModelGeneral->UpdateData('ekl_pasienfisik', $datafisik,array('noregistrasi'	=> $noregistrasi));    
        $datafisikuraian=array( 
            'noregistrasi' => $noregistrasi,
           'uraiannadi' => $uraiannadi,
           'uraianpernafasan' => $uraianpernafasan,
           'uraiansuhubadan' => $uraiansuhubadan,
           'uraianimt' => $uraianimt,
           'uraiantekanandarah' => $uraiantekanandarah,
           'uraiantingkatkesadaran_composmetis' => $uraiantingkatkesadaran_composmetis,
'uraiantingkatkesadaran_kualitaskontak' => $uraiantingkatkesadaran_kualitaskontak,
'uraiankulitdankuku_kulit' => $uraiankulitdankuku_kulit,
'uraiankulitdankuku_selaputlendir' => $uraiankulitdankuku_selaputlendir,
'uraiankulitdankuku_kuku' => $uraiankulitdankuku_kuku,
'uraiankulitdankuku_kontraktur' => $uraiankulitdankuku_kontraktur,
'uraiankulitdankuku_lainlain' => $uraiankulitdankuku_lainlain,
'uraiankepala_tulang' => $uraiankepala_tulang,
'uraiankepala_kulitkepala' => $uraiankepala_kulitkepala,
'uraiankepala_rambut' => $uraiankepala_rambut,
'uraiankepala_lainlain' => $uraiankepala_lainlain,
'uraianmata_visus' => $uraianmata_visus,
'uraianmata_kelainanmatalainnya' => $uraianmata_kelainanmatalainnya,
'uraianmata_lapangpandang' => $uraianmata_lapangpandang,
'uraiantelinga_dauntelingkanan' => $uraiantelinga_dauntelingkanan,
'uraiantelinga_liangtelingakanan' => $uraiantelinga_liangtelingakanan,
'uraiantelinga_liangtelingakiri' => $uraiantelinga_liangtelingakiri,
'uraiantelinga_kesanpendengaran' => $uraiantelinga_kesanpendengaran,
'uraiantelinga_lainlain' => $uraiantelinga_lainlain,
'uraiantelinga_serumenkanan' => $uraiantelinga_serumenkanan,
'uraianhidung_meatusnasi' => $uraianhidung_meatusnasi,
'uraianhidung_septumnasi' => $uraianhidung_septumnasi,
'uraianhidung_konkanasal' => $uraianhidung_konkanasal,
'uraianhidung_nyeriketoksinusmaksilaris' => $uraianhidung_nyeriketoksinusmaksilaris,
'uraianhidung_lainlain' => $uraianhidung_lainlain,
'uraiantenggorokan_pharynx' => $uraiantenggorokan_pharynx,
'uraiantenggorokan_tonsil' => $uraiantenggorokan_tonsil,
'uraiantenggorokan_palatum' => $uraiantenggorokan_palatum,
'uraiantenggorokan_lainlain' => $uraiantenggorokan_lainlain,
'uraianleher_gerakanleher' => $uraianleher_gerakanleher,
'uraianleher_kelenjarthyroid' => $uraianleher_kelenjarthyroid,
'uraianleher_pulsasi' => $uraianleher_pulsasi,
'uraianleher_tekananvenajugularis' => $uraianleher_tekananvenajugularis,
'uraianleher_trachea' => $uraianleher_trachea,
'uraianleher_lainlain' => $uraianleher_lainlain,
'uraiandada_mammae' => $uraiandada_mammae,
'uraiandada_lainlain' => $uraiandada_lainlain,
'uraianparuparudanjatung_palpasi' => $uraianparuparudanjatung_palpasi,
'uraianparuparudanjatung_perkusikanan' => $uraianparuparudanjatung_perkusikanan,
'uraianparuparudanjatung_perkusikiri' => $uraianparuparudanjatung_perkusikiri,
'uraianparuparudanjatung_iktuskordis' => $uraianparuparudanjatung_iktuskordis,
'uraianparuparudanjatung_batasjantung' => $uraianparuparudanjatung_batasjantung,
'uraianparuparudanjatung_bunyinapas' => $uraianparuparudanjatung_bunyinapas,
'uraianparuparudanjatung_bunyijantung' => $uraianparuparudanjatung_bunyijantung,
'uraianabdomen_inspeksi' => $uraianabdomen_inspeksi,
'uraianabdomen_perkusi' => $uraianabdomen_perkusi,
'uraianabdomen_auskultasibisingusus' => $uraianabdomen_auskultasibisingusus,
'uraianabdomen_hati' => $uraianabdomen_hati,
'uraianabdomen_limpa' => $uraianabdomen_limpa,
'uraianabdomen_nyeritekan' => $uraianabdomen_nyeritekan,
'uraianabdomen_nyeriketokkanan' => $uraianabdomen_nyeriketokkanan,
'uraianabdomen_nyeriketokkiri' => $uraianabdomen_nyeriketokkiri,
'uraianabdomen_ballotementkanan' => $uraianabdomen_ballotementkanan,
'uraianabdomen_ballotementkiri' => $uraianabdomen_ballotementkiri,
'uraianabdomen_anus' => $uraianabdomen_anus,
'uraianabdomen_genitaliaeks' => $uraianabdomen_genitaliaeks,
'uraianabdomen_prostat' => $uraianabdomen_prostat,
'uraianabdomen_lainlain' => $uraianabdomen_lainlain,
'uraianvertebra' => $uraianvertebra,
'uraianextremitasatas_simetris' => $uraianextremitasatas_simetris,
'uraianextremitasatas_gerakankanan' => $uraianextremitasatas_gerakankanan,
'uraianextremitasatas_gerakankiri' => $uraianextremitasatas_gerakankiri,
'uraianextremitasatas_kekuatankanan' => $uraianextremitasatas_kekuatankanan,
'uraianextremitasatas_kekuatankiri' => $uraianextremitasatas_kekuatankiri,
'uraianextremitasatas_tulangkanan' => $uraianextremitasatas_tulangkanan,
'uraianextremitasatas_tulangkiri' => $uraianextremitasatas_tulangkiri,
'uraianextremitasatas_sensibilitaskanan' => $uraianextremitasatas_sensibilitaskanan,
'uraianextremitasatas_sensibilitaskiri' => $uraianextremitasatas_sensibilitaskiri,
'uraianextremitasatas_lainlain' => $uraianextremitasatas_lainlain,
'uraianextremitasbawah_simetris' => $uraianextremitasbawah_simetris,
'uraianextremitasbawah_gerakankanan' => $uraianextremitasbawah_gerakankanan,
'uraianextremitasbawah_gerakankiri' => $uraianextremitasbawah_gerakankiri,
'uraianextremitasbawah_kekuatankanan' => $uraianextremitasbawah_kekuatankanan,
'uraianextremitasbawah_kekuatankiri' => $uraianextremitasbawah_kekuatankiri,
'uraianextremitasbawah_tulangkanan' => $uraianextremitasbawah_tulangkanan,
'uraianextremitasbawah_tulangkiri' => $uraianextremitasbawah_tulangkiri,
'uraianextremitasbawah_sensibilitaskanan' => $uraianextremitasbawah_sensibilitaskanan,
'uraianextremitasbawah_sensibilitaskiri' => $uraianextremitasbawah_sensibilitaskiri,
'uraianextremitasbawah_lainlain' => $uraianextremitasbawah_lainlain,
'uraiansaraffungsiluhur_orientasiwaktu' => $uraiansaraffungsiluhur_orientasiwaktu,
'uraiansaraffungsiluhur_orientasiorang' => $uraiansaraffungsiluhur_orientasiorang,
'uraiansaraffungsiluhur_orientasitempat' => $uraiansaraffungsiluhur_orientasitempat,
'uraiansaraffungsiluhur_kesansarafotak' => $uraiansaraffungsiluhur_kesansarafotak,
'uraiansaraffungsiluhur_lainlain' => $uraiansaraffungsiluhur_lainlain,
'uraiankesansarafotak_fungsisensorikkanan' => $uraiankesansarafotak_fungsisensorikkanan,
'uraiankesansarafotak_fungsisensorikkiri' => $uraiankesansarafotak_fungsisensorikkiri,
'uraiankesansarafotak_fungsiotonomkanan' => $uraiankesansarafotak_fungsiotonomkanan,
'uraiankesansarafotak_fungsiotonomkiri' => $uraiankesansarafotak_fungsiotonomkiri,
'uraiankesansarafotak_fungsivaskularkanan' => $uraiankesansarafotak_fungsivaskularkanan,
'uraiankesansarafotak_fungsivaskularkiri' => $uraiankesansarafotak_fungsivaskularkiri,
'uraiankesansarafotak_reflfisiologispatelakanan' => $uraiankesansarafotak_reflfisiologispatelakanan,
'uraiankesansarafotak_reflfisiologispatelakiri' => $uraiankesansarafotak_reflfisiologispatelakiri,
'uraiankesansarafotak_reflpatologisbabinskykanan' => $uraiankesansarafotak_reflpatologisbabinskykanan,
'uraiankesansarafotak_reflpatologisbabinskykiri' => $uraiankesansarafotak_reflpatologisbabinskykiri,
'uraiankesansarafotak_lainlain' => $uraiankesansarafotak_lainlain,
'uraiankelenjargetahbening_leher' => $uraiankelenjargetahbening_leher,
'uraiankelenjargetahbening_submandibula' => $uraiankelenjargetahbening_submandibula,
'uraiankelenjargetahbening_ketiak' => $uraiankelenjargetahbening_ketiak,
'uraiankelenjargetahbening_inguinal' => $uraiankelenjargetahbening_inguinal,
'uraiantingkatkesadaran' => $uraiantingkatkesadaran,
           
         ); 
       
        $this->ModelGeneral->UpdateData('ekl_pasienfisikuraian', $datafisikuraian,array('noregistrasi'	=> $noregistrasi));    
        if($item != ''){
            for( $i = 0; $i < $item ; $i++ ) {
                    $data = array(
                    'noregistrasi'   => $noregistrasi,
                    'kanankiri'   => $kanankiri[$i],
                    'atasbawah'   => $atasbawah[$i],
                    'temuan'   => $temuan[$i],
                    'urutan'   => $urutan[$i],
                ); 
                $this->ModelGeneral->InsertData('ekl_temuangigi', $data);
            }
        }
            header('location:'.base_url().'eklinik/fisik/datapasien/proses/'.$noregistrasi);

}
    
    public function cetakhasil($noregistrasi){
        $editfisik 				= $this->db->query("select * from ekl_pasienfisik where noregistrasi = '$noregistrasi' ")->result_array();
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
           
                
                
                'penggunaankacamata' => $editfisik[0]['penggunaankacamata' ],
                'nadi' => $editfisik[0]['nadi' ],
'gigi' => $editfisik[0]['gigi' ],
'keterangan_gigi' => $editfisik[0]['keterangan_gigi' ],
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
'uraiantelinga_liangtelingakanan' => $editfisikuraian[0]['uraiantelinga_liangtelingakanan' ],
'uraiantelinga_liangtelingakiri' => $editfisikuraian[0]['uraiantelinga_liangtelingakiri' ],
'uraiantelinga_kesanpendengaran' => $editfisikuraian[0]['uraiantelinga_kesanpendengaran' ],
'uraiantelinga_lainlain' => $editfisikuraian[0]['uraiantelinga_lainlain' ],
'uraiantelinga_serumenkanan' => $editfisikuraian[0]['uraiantelinga_serumenkanan' ],
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
                
				'temuangigi' => $this->db->query("select * from ekl_temuangigi where noregistrasi = '$noregistrasi' ")->result_array(),
				);
    
    $html = $this->load->view('eklinik/fisik/v_cetakhasilfisik', $data, true);
        
        $this->mpdf = new mPDF();
	
        $this->mpdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
				10, // margin_left
				10, // margin right
				30, // margin top
				30, // margin bottom
				10, // margin header
				10); // margin footer
		$this->mpdf->WriteHTML($html);
        
		
        $this->mpdf->Output("cetakhasilfisik.pdf", 'I');
    }
}
