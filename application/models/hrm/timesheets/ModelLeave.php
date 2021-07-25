<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelLeave extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLeave($where = '')
    {
        return $this->db->query("SELECT hrm_leaves.*,hrm_staffprofile.FirstName, hrm_staffprofile.LastName, hrm_staffprofile.Email, hrm_staffprofile.Phone FROM hrm_leaves LEFT JOIN hrm_staffprofile ON hrm_leaves.staff_id = hrm_staffprofile.StaffNo $where;")->result_array();
    }
}    