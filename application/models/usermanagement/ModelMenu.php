<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelMenu extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	function getAllModuleDetail(){
        return $this->db->query("
        SELECT md.modul_detail_id, md.nama_modul_detail, md.is_active md_active, md.url,
                m.modul_id, m.icon, m.nama_modul, m.is_active m_active, m.no_urut,
                a.application_id, a.nama_aplikasi, a.is_active a_active, a.icon a_icon
            FROM  modul_detail md 
            INNER JOIN modul m ON m.modul_id = md.modul_id 
            INNER JOIN applications a ON a.application_id = m.application_id
            ORDER BY m.no_urut ASC
        ")->result_array();
    }

    function getAllModule($where){
        return $this->db->query(" SELECT m.*, a.nama_aplikasi FROM modul m 
        INNER JOIN applications a ON a.application_id = m.application_id $where ORDER BY m.no_urut ASC ")->result_array();
    }

    function getSingleModule($where){
        return $this->db->query(" SELECT * FROM modul $where ")->row();
    }

    function getSingleMenu($where){
        return $this->db->query(" SELECT * FROM modul_detail $where ")->row();
    }

    function getSingleMenuJoinModul($where){
        return $this->db->query(" SELECT md.*, m.modul_id, m.nama_modul, a.nama_aplikasi FROM modul_detail md 
                                    INNER JOIN modul m ON m.modul_id = md.modul_id 
                                    INNER JOIN applications a ON a.application_id = m.application_id 
                                    $where ")->row();
    }

    function getAllUsers($where, $orderby){
        return $this->db->query("SELECT u.user_id, u.username, u.email, 
                                        ud.nik, ud.nama_lengkap, ud.no_handphone 
                                    FROM `users_smarterp` u 
                                    INNER JOIN user_detail ud ON ud.user_id = u.user_id 
                                    $where ORDER BY $orderby ASC")->result_array();
    }

    function getAllModuleDetailUser($user_id){
        return $this->db->query("
        SELECT md.modul_detail_id, md.nama_modul_detail, md.is_active md_active, md.url,
                m.modul_id, m.icon, m.nama_modul, m.is_active m_active, m.no_urut, u.user_id,
                rm.r, rm.w
            FROM  modul_detail md 
            INNER JOIN modul m ON m.modul_id = md.modul_id 
            LEFT JOIN role_menu rm ON rm.modul_detail_id = md.modul_detail_id AND rm.user_id = '".$user_id."'
            LEFT JOIN users_smarterp u ON u.user_id = rm.user_id 
            ORDER BY u.user_id DESC
        ")->result_array();
    }

    function getAllModuleDetailUserActive($user_id){
        return $this->db->query("
        SELECT COUNT(*) total
            FROM  modul_detail md 
            INNER JOIN modul m ON m.modul_id = md.modul_id 
            INNER JOIN role_menu rm ON rm.modul_detail_id = md.modul_detail_id AND rm.user_id = '".$user_id."'
            INNER JOIN users_smarterp u ON u.user_id = rm.user_id 
            ORDER BY u.user_id DESC
        ")->row();
    }

    function getAllModuleDetailUserSearch($user_id, $search){
        $where = " WHERE md.modul_detail_id LIKE '%$search%' OR md.nama_modul_detail LIKE '%$search%' OR m.nama_modul LIKE '%$search%' OR md.url LIKE '%$search%' ";
        return $this->db->query("
        SELECT md.modul_detail_id, md.nama_modul_detail, md.is_active md_active, md.url,
                m.modul_id, m.icon, m.nama_modul, m.is_active m_active, m.no_urut, u.user_id,
                rm.r, rm.w
            FROM  modul_detail md 
            INNER JOIN modul m ON m.modul_id = md.modul_id 
            LEFT JOIN role_menu rm ON rm.modul_detail_id = md.modul_detail_id AND rm.user_id = '".$user_id."'
            LEFT JOIN users_smarterp u ON u.user_id = rm.user_id 
            $where
            ORDER BY u.user_id DESC
        ")->result_array();
    }

    function getSingleRoleMenu($where){
        return $this->db->query(" SELECT * FROM role_menu $where ")->row();
    }

    function getSingleAplikasi($where){
        return $this->db->query(" SELECT * FROM applications $where ")->row();
    }

    function getAllAplikasi($where){
        return $this->db->query(" SELECT * FROM applications $where ")->result_array();
    }
    
}