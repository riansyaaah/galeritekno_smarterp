<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelKwitansiapsDataTable extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    var $table = 'regperiksa as r'; 
    var $column_order = array(
        'r.tanggalkunjungan', 
        'r.nomorregistrasi', 
        'r.tipekunjungan', 
        'r.detailharga', 
        'r.nik', 
        'r.nama', 
        'r.jeniskelamin', 
        'r.tanggallahir', 
        'r.nomorhp', 
        'j.detailketerangan'
    ); 
    var $column_search = array(
        'r.tanggalkunjungan', 
        'r.nomorregistrasi', 
        'r.tipekunjungan', 
        'r.detailharga', 
        'r.nik', 
        'r.nama', 
        'r.jeniskelamin', 
        'r.tanggallahir', 
        'r.nomorhp', 
        'j.detailketerangan'
    ); 
    var $order = array('r.tanggalkunjungan' => 'DESC'); 
 
    private function _get_datatables_query()
    {
        $this->db->where('r.trash !=', '1')->where('r.carabayar', 'Lunas')->where('r.statustransaksi',  'Selesai');
        $this->db->select('r.tanggalkunjungan, r.nomorregistrasi, r.tipekunjungan, r.detailharga, r.nik, r.nama, r.jeniskelamin, r.tanggallahir, r.nomorhp, j.detailketerangan'); 
        $this->db->from($this->table);
        $this->db->join('jenispemeriksaandetail j', 'r.idjenispemeriksaandetail = j.id', 'left');
        $i = 0;
        foreach ($this->column_search as $item) 
        {
            if($_POST['search']['value']) 
            {
                 
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->where('r.trash !=', '1')->where('r.carabayar', 'Lunas')->where('r.statustransaksi',  'Selesai');
        $this->db->from($this->table);
        $this->db->join('jenispemeriksaandetail j', 'r.idjenispemeriksaandetail = j.id', 'left');
        return $this->db->count_all_results();
    }
}