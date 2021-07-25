<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modelmasterdata extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    function getTarifPenunjang($idpenunjang){
        return $this->db->query("SELECT ekl_detailtarifpenunjang.*,ekl_masterpenjamin.namapenjamin FROM ekl_detailtarifpenunjang left join ekl_masterpenjamin on ekl_detailtarifpenunjang.idpenjamin = ekl_masterpenjamin.id where idpenunjang = '$idpenunjang' ")->result_array();
    }
    function getTarifLab($idlab){
        return $this->db->query("SELECT ekl_detailtariflab.*,ekl_masterpenjamin.namapenjamin FROM ekl_detailtariflab left join ekl_masterpenjamin on ekl_detailtariflab.idpenjamin = ekl_masterpenjamin.id where iditemlab = '$idlab' ")->result_array();
    }
    function getTarifBHP($idbhp){
        return $this->db->query("SELECT ekl_detailtarifbhp.*,ekl_masterpenjamin.namapenjamin FROM ekl_detailtarifbhp left join ekl_masterpenjamin on ekl_detailtarifbhp.idpenjamin = ekl_masterpenjamin.id where idbhp = '$idbhp' ")->result_array();
    }
    function getTarifObat($idobat){
        return $this->db->query("SELECT ekl_detailtarifobat.*,ekl_masterpenjamin.namapenjamin FROM ekl_detailtarifobat left join ekl_masterpenjamin on ekl_detailtarifobat.idpenjamin = ekl_masterpenjamin.id where idobat = '$idobat' ")->result_array();
    }
    function getTarifTindakan($idtindakan){
        return $this->db->query("SELECT ekl_detailtariftindakan.*,ekl_masterpenjamin.namapenjamin FROM ekl_detailtariftindakan left join ekl_masterpenjamin on ekl_detailtariftindakan.idpenjamin = ekl_masterpenjamin.id where idtindakan = '$idtindakan' ")->result_array();
    }
    
    function getItemlab($where = ""){
        return $this->db->query("SELECT * FROM ekl_itemlab $where ")->result_array();
    }
    
    function getHomecare($where = ""){
        return $this->db->query("SELECT * FROM ekl_homecare $where ")->result_array();
    }
    
    function getHomecareDetail($where = ""){
        return $this->db->query(" SELECT ehd.homecare_id, ep.namapaket, ehd.jumlah, ep.hargacorporate, ep.hargaumum FROM ekl_homecare_detail ehd 
        INNER JOIN ekl_paketmcu ep ON ehd.paket_id = ep.id $where ")->result_array();
    }
    function getPasien($where = ""){
        return $this->db->query("SELECT * FROM ekl_regpasien $where ")->result_array();
    }
    function getPaketperiksa($where = ""){
        return $this->db->query("SELECT * FROM ekl_paketmcu $where ")->result_array();
    }
    
    function getPerawat($where = ""){
        return $this->db->query("SELECT * FROM ekl_perawat $where ")->result_array();
    }
    
    function getDokter($where = ""){
        return $this->db->query("SELECT * FROM ekl_dokter $where ")->result_array();
    }
    function getAfiliasi($where = ""){
        return $this->db->query("SELECT * FROM ekl_afiliasi $where ")->result_array();
    }
    
    function getDiagnosaicdx($where = ""){
        return $this->db->query("SELECT * FROM ekl_masterdiagnosaicdx $where ")->result_array();
    }
    
    function getPenjamin($where = ""){
        return $this->db->query("SELECT * FROM ekl_masterpenjamin $where ")->result_array();
    }
    
    function getBhp($where = ""){
        return $this->db->query("SELECT * FROM ekl_masterbhp $where ")->result_array();
    }
    
    function getObat($where = ""){
        return $this->db->query("SELECT * FROM ekl_masterobat $where ")->result_array();
    }
    
    function getTindakan($where = ""){
        return $this->db->query("SELECT * FROM ekl_mastertindakan $where ")->result_array();
    }
    function getPenunjang($where = ""){
        return $this->db->query("SELECT * FROM ekl_masterpenunjang $where ")->result_array();
    }

    function getRekammedis($where = ""){
        return $this->db->query("SELECT ekl_rekammedis.id,ekl_rekammedis.norm,ekl_rekammedis.tanggal_rm,ekl_rekammedis.nama_sebutan,ekl_rekammedis.nama,ekl_rekammedis.jeniskelamin,ekl_rekammedis.tanggallahir,ekl_rekammedis.tempatlahir,ekl_rekammedis.nomorhp,ekl_rekammedis.email,ekl_rekammedis.umur,ekl_rekammedis.provinsi_id,ekl_rekammedis.kabupaten_id,ekl_rekammedis.kecamatan_id,ekl_rekammedis.desa_id,ekl_rekammedis.golongan_darah,ekl_rekammedis.alamat,ekl_rekammedis.nik,ekl_masterjeniskelamin.keterangan as jeniskelamin FROM ekl_rekammedis left join ekl_masterjeniskelamin on ekl_rekammedis.jeniskelamin=ekl_masterjeniskelamin.id $where ")->result_array();
    }
    
    function getPoliklinik($where = ""){
        return $this->db->query("SELECT ekl_poliklinik.id,ekl_poliklinik.nama,ekl_poliklinik.dokter_id,ekl_poliklinik.keterangan,ekl_dokter.nama as namadokter FROM ekl_poliklinik left join ekl_dokter on ekl_poliklinik.dokter_id = ekl_dokter.id $where ")->result_array();
    }

    function getJeniskelamin($where = "")
    {
        return $this->db->query("SELECT * FROM ekl_masterjeniskelamin $where;")->result_array();
    }

    function getProvince($where = "")
    {
        return $this->db->query("SELECT * FROM provinces $where;")->result_array();
    }
}
