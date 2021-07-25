<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ModelGeneral extends CI_Model {
	
	public function __construct() {
        parent::__construct();
	}

	public function InsertData($table_name,$data){
		return $this->db->insert($table_name, $data);
	}
	
	public function UpdateData($table, $data, $where){
		return $this->db->update($table, $data, $where);
	}
	
	public function DeleteData($table,$where){
		return $this->db->delete($table,$where);
	}
	
	public function getWhere($table, $where) {
		return $this->db->get_where($table, $where);
	}

	public function getAll($table) {
		return $this->db->get($table);
	}

	public function LogActivity($activity){
		$session = $this->session->userdata('login');
		$this->InsertData('log_activity', [
            'activity' 		=> $activity,
            'created_by' 	=> $session['user_id'],
            'created_date' 	=> date('Y-m-d H:i:s')
		]);
    }

    public function LogAktivitas($aktivitas){
		$session = $this->session->userdata('login');
		$this->InsertData('logaktivitas', [
            'aktivitas'	=> $aktivitas,
            'iduser'	=> $session['user_id'],
            'waktu'		=> date('Y-m-d H:i:s')
		]);
    }
	
	public function LogError($url, $error){
		$data = array( 
            'url' 			=> $url,
            'error_message' => $error,
            'created_date' 	=> date('Y-m-d H:i:s')
        );   
        $this->InsertData('log_error', $data);
	}
	
	function getPeriode($user_id){
        return $this->db->query("SELECT * FROM `periode` WHERE User_Id = '".$user_id."' AND Active = 1")->row();
	}
	
	function getPeriodeThnBulan($user_id, $ThnBln){
        return $this->db->query("SELECT * FROM `periode` WHERE User_Id = '".$user_id."' AND ThnBln = '".$ThnBln."' ")->row();
    }

    public function getUser($idUser) {
		return $this->db->select('hrm_staffprofile.*, users_smarterp.user_id, users_smarterp.email, users_smarterp.username, hrm_positions.position, hrm_departments.department')
			->join('hrm_staffprofile', 'hrm_staffprofile.id = users_smarterp.staff_id')
			->join('hrm_positions', 'hrm_positions.id = hrm_staffprofile.position_id')
			->join('hrm_departments', 'hrm_departments.id = hrm_staffprofile.departement_id')
			->where('users_smarterp.user_id', $idUser)
			->get('users_smarterp')
			->row_array();
	}
	public function getManager($id) {
		return $this->db->select('hrm_positions.*')
			->join('hrm_positions', 'hrm_positions.id = hrm_departments.idManager')
			->where('hrm_departments.id', $id)
			->get('hrm_departments')
			->row_array();
	}
}
?>