<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelPayout extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function getPayout($where = '')
	{
        return $this->db->query("SELECT payout.*,payout_detail.jumlah as jumlahm,regperiksa.jumlah as jumlahs 
        	FROM payout
        	left join (select sum(Amount) as jumlah, payout_id from payout_detail group by payout_id) as payout_detail on payout.payout_id = payout_detail.payout_id
            left join (select sum(detailharga) as jumlah, idpayout from regperiksa group by idpayout) as regperiksa on payout.payout_id = regperiksa.idpayout
            order by paid_at   $where ")->result_array();
    }

    public function getPayoutDetail($where = '')
	{
        return $this->db->query("SELECT payout_detail.*, payout.gross_amount,payout.net_amount,payout.mdr,payout.paid_at FROM payout_detail left join payout on payout_detail.payout_id=payout.payout_id  $where ")->result_array();
    }
    public function getPyDetail($payout_id) {
    	return $this->db->select('payout_detail.*, payout.gross_amount,payout.net_amount,payout.mdr,payout.paid_at')
    		->join('payout', 'payout_detail.payout_id=payout.payout_id')
    		->where('payout.payout_id', $payout_id)
    		->get('payout_detail')
    		->row_array();
    }

     public function getPayoutById($where = '')
	{
        return $this->db->query("SELECT * from payout  $where ")->result_array();
    }

    public function getPayoutDetailJoin($where = '')
	{
        return $this->db->query("SELECT payout.*, payout_detail.id.payout_detail.PaymentType, payout_detail.TransactionTime, payout_detail.TransactionTime, payout_detail.SettlementTime. payout_detail.Order, payout_detail.CustomerEmail, payout_detail.Amount,payout_detail.TransactionFee, payout_detail.MerchantHas FROM payout left join payout_detail on payout.payout_id=payout_detail.payout_id $where ")->result_array();
    }

}

