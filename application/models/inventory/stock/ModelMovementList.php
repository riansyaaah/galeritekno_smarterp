<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ModelMovementList extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function daftarTahun() {
        return [2019, 2020, 2021];
    }
    public function daftarBulan() {
        return [
            ['01', 'Januari'],['02', 'Februari'], ['03', 'Maret'], ['04', 'April'], ['05', 'Mei'], ['06', 'Juni'], ['07', 'Juli'], ['08', 'Agustus'], ['09', 'September'], ['10', 'Oktober'], ['11', 'November'], ['12', 'Desember']
        ];
    }
    public function getAllItem() {
        $btn = '<button class="btn btn-info"><i class="fa fa-check"></i></button>';
        return $this->db->select('inv_itemmaster.id, inv_itemmaster.itemmaster, inv_itemmaster.stock, inv_unit.unit, \''.$btn.'\' AS btn')
            ->join('inv_unit', 'inv_unit.id = inv_itemmaster.unit')
            ->get('inv_itemmaster')
            ->result_array();
    }
    public function getItem($form) {
        $whereTgl = 'inv_transaction.tglTransaction BETWEEN \''.$form['fromDate'].'\' AND \''.$form['toDate'].'\'';
        $whereItem = 'inv_itemmaster.itemmaster BETWEEN \''.$form['fromItem'].'\' AND \''.$form['toItem'].'\'';
        $where = ($form['fromItem'] == 'all')? $whereTgl : $whereItem.' AND '.$whereTgl;
        return $this->db->select('inv_itemmaster.itemmaster, inv_transaction.noTransaction, inv_transaction.tglTransaction, IF(inv_transaction.typeTransaction=2, inv_transaction_detail.jumlah_act, 0) AS jumlahIn, IF(inv_transaction.typeTransaction=1, inv_transaction_detail.jumlah_act, 0) AS jumlahOut')
            ->join('inv_itemmaster', 'inv_itemmaster.id = inv_transaction_detail.idItemMaster')
            ->join('inv_transaction', 'inv_transaction.id = inv_transaction_detail.idTransaction')
            ->where($where)
            ->order_by('inv_transaction.tglTransaction', 'asc')
            ->get('inv_transaction_detail')
            ->result_array();
    }
}