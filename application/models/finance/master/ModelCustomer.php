<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelCustomer extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    } 

    public function getCustomer($where = '')
    {
        return $this->db->query("SELECT tbl_client.*, tbl_bis.Nama_Bis FROM tbl_client LEFT JOIN tbl_bis ON tbl_client.Kode_Bis=tbl_bis.Kode_Bis  $where ")->result_array();
    }
 
    function getBusinessLineSelect2($where, $orderby)
    {
        return $this->db->query("SELECT Kode_Bis, Nama_Bis
                                    FROM tbl_bis 
                                     $where ORDER BY $orderby")->result_array();
}
}
