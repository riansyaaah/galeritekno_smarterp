<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelDataclient extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

    public function getDataclient($where ='')
	{
        return $this->db->query(" select masterinstansi.*,regperiksa.jumlahpeserta,regperiksa.tanggalkunjungan from masterinstansi left join (select idinstansi,count(id) as jumlahpeserta, GROUP_CONCAT(DISTINCT tanggalkunjungan) as tanggalkunjungan from regperiksa where idbillingcor is  null and trash != '1' and statustransaksi = 'Selesai' group by idinstansi) as regperiksa on masterinstansi.id = regperiksa.idinstansi ")->result_array();
    }
}
?>    