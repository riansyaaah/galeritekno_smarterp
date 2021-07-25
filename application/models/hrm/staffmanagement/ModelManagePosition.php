<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ModelManagePosition extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getManagePosition($where = '')
    {
        return $this->db->query("SELECT * FROM hrm_positions
          $where ")->result_array();
    }
}
