<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    function __Construct()
    {
        parent ::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
    }

	public function index()
	{
        $date = date("Y-m-d");
        $data = array(
            'datenow'   => date("d-m-Y", strtotime($date)),
            'title'     => 'Register'
        );
		$this->load->view('auth/v_register', $data);
    }
}
