<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelSupplier extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function getSupplier($where = '')
    {
        return $this->db->query("SELECT * FROM tbl_spl  $where ")->result_array();
    }

     function getBusinessLineSelect2($where, $orderby){
        return $this->db->query("SELECT Kode_Bis, Nama_Bis
                                    FROM tbl_bis 
                                    $where ORDER BY $orderby")->result_array();
    }
 
   
}
