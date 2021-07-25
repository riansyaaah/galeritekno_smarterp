<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    function getData($start, $from){
        return $this->db->query("SELECT count(regperiksa.id) as jumlah, 
                                        jenispemeriksaandetail.detailketerangan,
                                        tbl_cabang.nama as namacabang 
        FROM `regperiksa` 
        left join tbl_cabang on regperiksa.idcabang = tbl_cabang.id
        left join jenispemeriksaandetail on regperiksa.idjenispemeriksaandetail = jenispemeriksaandetail.id 
        where tanggalkunjungan BETWEEN '$start' AND '$from' and regperiksa.trash = '0' and carabayar = 'Lunas' and idinstansi = '4'
        AND regperiksa.idcabang = 1
        group by concat(idjenispemeriksaandetail,idcabang)  
        ORDER BY `namacabang` ASC ")->result_array();
    }
}