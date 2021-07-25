<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Stockopname extends CI_Controller {
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper(['form', 'url']);
        $this->load->model('ModelGeneral', 'mg');
        $this->load->model('inventory/stock/ModelStockOpname', 'mso');
    }
    protected $idMenu = 'bdc65a68-b894-4719-ad24-9eaba421e41d';
    public function index() {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $data = [
            'title'         => 'Rekapitulasi Stok',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $this->session->userdata('applications'),
            'current_app'   => $this->session->userdata('current_app')
        ];
        $this->load->view('inventory/stock/stockopname/index', $data);
    }
    private function _json($data, $statusJson = true, $remarks = '') {
        header('Content-Type: application/json');
        echo json_encode([
            'status_json'   => $statusJson,
            'data'          => $data,
            'remarks'       => $remarks
        ]);
    }
    public function getItem() {
        cek_session($this->idMenu);
        $id = $this->input->post('id');
        if($id) {
            $data = $this->mso->getTransactionDetail($id);
        } else {
            $data = $this->mso->getAllTransaction();
            for($i=0; $i<count($data); $i++) {
                $data[$i]['tglTransaction'] = date('Y-m-d', $data[$i]['tglTransaction']);
            }
        }
        $this->_json($data);
    }
    public function getTransaction() {
        cek_session($this->idMenu);
        $id = $this->input->get('id');
        $data = $this->mg->getWhere('inv_transaction', ['id' => $id])->row_array();
        $this->_json($data);
    }
}