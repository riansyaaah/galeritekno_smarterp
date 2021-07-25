<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ModelWalkInDriveThruDataTable extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    var $table = 'regperiksa'; 
    var $column_order = array(
        'CONCAT(regperiksa.tanggalkunjungan, \'-\', regperiksa.jamkunjungan)', 
        'regperiksa.nomorregistrasi', 
        'regperiksa.nik', 
        'regperiksa.nama', 
        'CONCAT(regperiksa.tempatlahir, \', \', regperiksa.tanggallahir, \'/\', regperiksa.jeniskelamin)', 
        'regperiksa.statusbayar', 
        'regperiksa.statushadir', 
        'tbl_cabang.nama', 
        'jenispemeriksaandetail.detailketerangan', 
        'masterinstansi.instansi', 
        'CONCAT(hrm_staffprofile.first_name, \' \', hrm_staffprofile.last_name)'
    ); 
    var $column_search = array(
        'CONCAT(regperiksa.tanggalkunjungan, \'-\', regperiksa.jamkunjungan)', 
        'regperiksa.nomorregistrasi', 
        'regperiksa.nik', 
        'regperiksa.nama', 
        'CONCAT(regperiksa.tempatlahir, \', \', regperiksa.tanggallahir, \'/\', regperiksa.jeniskelamin)', 
        'regperiksa.statusbayar', 
        'regperiksa.statushadir', 
        'tbl_cabang.nama', 
        'jenispemeriksaandetail.detailketerangan', 
        'masterinstansi.instansi', 
        'CONCAT(hrm_staffprofile.first_name, \' \', hrm_staffprofile.last_name)'
    ); 
    var $order = array('regperiksa.tanggalkunjungan' => 'DESC'); 
 
    private function _get_datatables_query($now)
    {
        $btn = 'CONCAT(\'<button class="btn btn-success btn-sm" onclick="detail(\', regperiksa.id, \')">Detail</button> <button class="btn btn-warning btn-sm" onclick="log(\', regperiksa.id, \')">Log</button> <button class="btn btn-danger btn-sm" onclick="hapus(\', regperiksa.id,\')">Hapus</button>\') AS btn';

        $this->db->select('CONCAT(regperiksa.tanggalkunjungan, \'-\', regperiksa.jamkunjungan) AS waktuKunjungan, 
                           regperiksa.nomorregistrasi, 
                           regperiksa.nik, 
                           regperiksa.nama, 
                           CONCAT(regperiksa.tempatlahir, \', \', regperiksa.tanggallahir, \'/\', regperiksa.jeniskelamin) AS ttljk, 
                           regperiksa.statusbayar, 
                           regperiksa.statushadir, 
                           tbl_cabang.nama AS cabang, 
                           jenispemeriksaandetail.detailketerangan, 
                           masterinstansi.instansi, 
                           CONCAT(hrm_staffprofile.first_name, \' \', hrm_staffprofile.last_name) AS picMarketing, '.$btn)
            ->from($this->table)
            ->join('jenispemeriksaandetail', 'jenispemeriksaandetail.id = regperiksa.idjenispemeriksaandetail', 'inner')
            ->join('masterinstansi', 'masterinstansi.id = regperiksa.idinstansi', 'inner')
            ->join('hrm_staffprofile', 'hrm_staffprofile.id = regperiksa.pic_m', 'inner')
            ->join('tbl_cabang', 'tbl_cabang.id = regperiksa.idcabang', 'inner')
            ->where('idpayment !=', '')
            ->where('regperiksa.trash !=', '1')
            ->where('statustransaksi !=', 'Transakasi dibatalkan')
            ->where('carabayar', 'Free')
            ->or_where('carabayar', 'Lunas')
            ->or_where('carabayar', 'Invoice')
            ->where('regperiksa.tanggalkunjungan', $now)
            ->order_by('regperiksa.tanggalkunjungan', 'DESC');
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
 
    function get_datatables($now)
    {
        $this->_get_datatables_query($now);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($now)
    {
        $this->_get_datatables_query($now);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($now)
    {
        $this->db->from($this->table)
            ->join('jenispemeriksaandetail', 'jenispemeriksaandetail.id = regperiksa.idjenispemeriksaandetail', 'inner')
            ->join('masterinstansi', 'masterinstansi.id = regperiksa.idinstansi', 'inner')
            ->join('hrm_staffprofile', 'hrm_staffprofile.id = regperiksa.pic_m', 'inner')
            ->join('tbl_cabang', 'tbl_cabang.id = regperiksa.idcabang', 'inner')
            ->where('idpayment !=', '')
            ->where('regperiksa.trash !=', '1')
            ->where('statustransaksi !=', 'Transakasi dibatalkan')
            ->where('carabayar', 'Free')
            ->or_where('carabayar', 'Lunas')
            ->or_where('carabayar', 'Invoice')
            ->where('regperiksa.tanggalkunjungan', $now);
        return $this->db->count_all_results();
    }
}