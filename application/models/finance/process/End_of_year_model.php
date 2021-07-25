<?php
defined('BASEPATH') or exit('No direct script access allowed');

class End_of_year_model extends CI_Model
{
    public $table = 'jurnal';
    public $id = 'NoRef';
    public $order = 'DESC';


    // get all data
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result_array();
    }

    // get data based on id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->result_array();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}

/**
 * ==============================================================================================
 * End Of "End_of_year_model.php"
 * Location: ./application/models/process/End_of_year_model.php 
 * Edited by: Adist Vieri Alamsyah
 * Last Edited : 4 Mar 2021 - 8:30
 */
