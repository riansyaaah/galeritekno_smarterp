<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class DashboardData extends CI_Controller
{
    function __construct($config = 'rest') {
        parent::__construct($config);
		date_default_timezone_set('Asia/Jakarta');
		$now=date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('eklinik/Dashboard', 'model');
    }

    public function getData(){
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil"; 
        $start = $this->input->post("start");
        $from = $this->input->post("from");
        $res = $this->model->getData($start, $from);
        $data = array();
        foreach($res as $r){
            $data[] = array(
                "detailketerangan"  => $r['detailketerangan'],
                "namacabang"   => $r['namacabang'],
                "value"  => $r['jumlah']
            );
        }

        //CONVERT ROW TO COLUMN
        $grouped = [];
        $columns = [];
        foreach ($data as $row) {
            $grouped[$row['detailketerangan']][$row['namacabang']] = $row['value'];
            $columns[$row['namacabang']] = $row['namacabang'];
        }

        sort($columns);
        $defaults = array_fill_keys($columns, '-');
        array_unshift($columns, 'detailketerangan');

        $table  = "";
        $table .= "<table class='table table-bordered'>\n";
        $table .= sprintf(
                "<tr><th class='text-center' style='width:20px;'>%s</th></tr>\n",
                implode('</th><th class="text-center" style="width:100px;">', $columns)
            );
            foreach ($grouped as $name => $records) {
                $table .= sprintf(
                    "<tr><td class='text-center'>%s</td><td class='text-center'>%s</td></tr>\n",
                    $name,
                    implode('</td><td class="text-center">', array_replace($defaults, $records))
                );
            }
        $table .= "</table>";
        echo $table;
    }
}