<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelUsers extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	function getAllUserJoin(){
        return $this->db->query("SELECT u.user_id, u.username, u.email, u.is_active, 
                                        ud.user_detail_id, ud.nik, ud.nama_lengkap, ud.tempat_lahir, ud.tanggal_lahir, 
                                        ud.jenis_kelamin, ud.alamat, ud.no_handphone, ud.foto,pos.position 
                                        FROM `users_smarterp` u
                                    INNER JOIN user_detail ud ON ud.user_id = u.user_id
                                    INNER JOIN hrm_staffprofile staff ON staff.id = u.staff_id
                                    INNER JOIN hrm_positions pos ON pos.id = staff.position_id
                                    INNER JOIN instansi i ON i.instansi_id = ud.instansi_id 
                                    INNER JOIN tbl_cabang b ON b.id = ud.branch_id 
        ")->result_array();
    }

    function getSingleUserJoin($where){
        return $this->db->query("SELECT u.user_id, u.username, u.email, u.is_active,
                                        ud.instansi_id, i.nama_instansi, ud.branch_id, b.nama as nama_branch,
                                        ud.user_detail_id, ud.nik, ud.nama_lengkap, ud.tempat_lahir, ud.tanggal_lahir, 
                                        ud.jenis_kelamin, ud.alamat, ud.no_handphone, ud.foto,concat(first_name,' ',last_name) as name,
                                        staff.id as staff_id, staff.first_name as staff_name
                                        FROM `users_smarterp` u
                                    INNER JOIN user_detail ud ON ud.user_id = u.user_id 
                                    INNER JOIN hrm_staffprofile staff ON staff.id = u.staff_id
                                    INNER JOIN instansi i ON i.instansi_id = ud.instansi_id 
                                    INNER JOIN tbl_cabang b ON b.id = ud.branch_id 
                                    $where 
        ")->row();
    } 

    function getSingleUser($where){
        return $this->db->query("SELECT user_id, username, email FROM `users_smarterp` $where ")->row();
    }

    function getInstansiSelect2($where, $orderby){
        return $this->db->query("SELECT instansi_id, nama_instansi
                                    FROM `instansi` 
                                    $where ORDER BY $orderby")->result_array();
    }

    function getBranchSelect2($where, $orderby){
        return $this->db->query("SELECT id as branch_id, nama as nama_branch
                                    FROM `tbl_cabang` 
                                    $where ORDER BY $orderby")->result_array();
    }
}