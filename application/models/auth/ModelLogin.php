<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelLogin extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	function CheckLogin($username, $password){
        $this->db->where('username', $username)->or_where('email', $username);
        $query = $this->db->get('users_smarterp');
        if ($query->num_rows() == 1) {
            $hash = $query->row('password');
            if (password_verify($password, $hash)){
                return $query->row();
            } else {
                return "Password salah";
            }
        } else {
            return "Username / Email salah";
        }
    }

    function CheckLoginByPass($username)
	{
        $this->db->where('username', $username)->or_where('email', $username);
        $query = $this->db->get('users_smarterp');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return "Username / Email salah";
        }
    }

    function getUserDetail($user_id){
        return $this->db->query("
            SELECT u.user_id, u.username, u.email, u.is_active, u.update_date user_lastupdate,
                    ud.user_detail_id, ud.nik, ud.nama_lengkap, ud.tempat_lahir, ud.tanggal_lahir, 
                    ud.alamat, ud.no_handphone, ud.foto, ud.update_date user_detail_lastupdate,
                    i.instansi_id, i.nama_instansi, i.alamat as alamat_instansi, i.icon,
                    b.id as branch_id, b.nama as nama_branch
            FROM users_smarterp u
            INNER JOIN user_detail ud ON ud.user_id = u.user_id
            INNER JOIN instansi i ON i.instansi_id = ud.instansi_id
            INNER JOIN tbl_cabang b ON b.id = ud.branch_id
            WHERE u.user_id = '".$user_id."'
        ")->row();
    }

    // function getMenu($user_id){
    //     return $this->db->query("
    //         SELECT rm.role_menu_id, md.modul_detail_id, md.nama_modul_detail, md.is_active md_active, md.url,
    //                 m.modul_id, m.icon, m.nama_modul, m.is_active m_active 
    //         FROM `role_menu` rm 
    //         INNER JOIN modul_detail md ON md.modul_detail_id = rm.modul_detail_id AND md.is_active = 1 
    //         INNER JOIN modul m ON m.modul_id = md.modul_id AND m.is_active = 1 
    //         WHERE rm.user_id = '".$user_id."'
    //         ORDER BY m.no_urut ASC
    //     ")->result_array();
    // }

    function getMenuAppl($user_id){
        return $this->db->query("
            SELECT rm.role_menu_id, rm.r, rm.w, md.modul_detail_id, md.nama_modul_detail, md.is_active md_active, md.url,
                    m.modul_id, m.icon, m.nama_modul, m.is_active m_active 
            FROM `role_menu` rm 
            INNER JOIN (SELECT * FROM modul_detail ORDER BY created_date ASC) md ON md.modul_detail_id = rm.modul_detail_id AND md.is_active = 1 
            INNER JOIN modul m ON m.modul_id = md.modul_id AND m.is_active = 1 
            WHERE rm.user_id = '".$user_id."' 
            ORDER BY m.no_urut ASC, md.created_date ASC
        ")->result_array();
    }

    function getSessionAppl($user_id){
        return $this->db->query("
            SELECT DISTINCT a.application_id, a.nama_aplikasi, a.icon
                FROM `role_menu` rm 
                INNER JOIN modul_detail md ON md.modul_detail_id = rm.modul_detail_id AND md.is_active = 1 
                INNER JOIN modul m ON m.modul_id = md.modul_id AND m.is_active = 1 
                INNER JOIN applications a ON a.application_id = m.application_id
                WHERE rm.user_id = '".$user_id."' AND a.is_active = 1
                ORDER BY m.no_urut ASC
        ")->result_array();
    }

    function getSingleApps($application_id){
        return $this->db->query(" SELECT *FROM applications WHERE application_id = '".$application_id."'")->row();
    }

}