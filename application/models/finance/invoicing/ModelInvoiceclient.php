<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelInvoiceclient extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

    public function getInvoiceclient($where ='')
	{
        return $this->db->query(" select invoicecorporate.*, masterinstansi.instansi from invoicecorporate left join masterinstansi on invoicecorporate.idinstansi  = masterinstansi.id 
            $where ")->result_array();
    }
}
?>    