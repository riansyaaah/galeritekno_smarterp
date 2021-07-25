<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchaseorder extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
        $this->load->model('finance/purchase/ModelPurchaseorder');
    }

    var $idMenu = "CC45E8E2-91CA-4545-A897-CFB0A5C2D3B7";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $ThnActive   = $this->ModelPurchaseorder->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Purchase Order',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'tahunaktif' =>  $thn,
        );
        $this->load->view('finance/purchase/v_purchaseorder', $data);
    }

    public function getSupplier()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelPurchaseorder->getSupplier("order by Kode_Spl");
        $no = 1;
        foreach ($datas as $d) {
            $option = "<a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
            $data[] = array(
                "no" => $no,
                "Kode_Spl" => $d['Kode_Spl'],
                "Nama_Spl" => $d['Nama_Spl'],
                "option" => $option,

            );
            $no++;
        }
        if (count($datas) > 0) {
            $response['data'] = $data;
        } else {
            $response['data'] = array();
        }
        echo json_encode($response);
    }
    public function getPOSupplier()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelPurchaseorder->getPOSupplier("order by PurchaseOrderDate desc");
        $no = 1;
        foreach ($datas as $d) {
            $option = "<a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
            $data[] = array(
                "no" => $no,
                "PurchaseOrderNo" => $d['PurchaseOrderNo'],
                "PurchaseOrderDate" => $d['PurchaseOrderDate'],
                "supplier_id" => $d['Kode_Spl'],
                "supplier_name" => $d['Nama_Spl'],
                "PurchaseOrderTMP" => $d['PurchaseOrderTMP'],
                "ShipTo" => $d['DeliverTo'],
                "DeliverDate" => $d['DeliverDate'],
                "option" => $option,

            );
            $no++;
        }
        if (count($datas) > 0) {
            $response['data'] = $data;
        } else {
            $response['data'] = array();
        }
        echo json_encode($response);
    }
    public function addPO()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Purchase Order";
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try {
            $datennow = date('Y-m-d H:i:s');
            $PurchaseOrderNo = $this->input->post('PurchaseOrderNo');
            $PurchaseOrderDate = $this->input->post('PurchaseOrderDate');
            $DeliverDate = $this->input->post('DeliverDate');
            $DeliverTo = $this->input->post('DeliverTo');
            $PurchaseOrderTMP = $this->input->post('PurchaseOrderTMP');
            $Valuta = $this->input->post('Valuta');
            $Remarks = $this->input->post('Remarks');
            $Discount = $this->input->post('Discount');
            $PPn = $this->input->post('PPn');
            $OtherCost = $this->input->post('OtherCost');
            $SubTotal = $this->input->post('SubTotal');
            $GrandTotal = $this->input->post('GrandTotal');
            $supplier_id = $this->input->post('supplier_id');
            $project_id = $this->input->post('project_id');
            $StatusPO = $this->input->post('StatusPO');


            $post = true;

            if ($post) {
                $dataInsert = array(
                    'PurchaseOrderNo' => $PurchaseOrderNo,
                    'PurchaseOrderDate' => $PurchaseOrderDate,
                    'DeliverDate' => $DeliverDate,
                    'DeliverTo' => $DeliverTo,
                    'PurchaseOrderTMP' => $PurchaseOrderTMP,
                    'Valuta' => $Valuta,
                    'Remarks' => $Remarks,
                    'Discount' => $Discount,
                    'PPn' => $PPn,
                    'OtherCost' => $OtherCost,
                    'SubTotal' => $SubTotal,
                    'GrandTotal' => $GrandTotal,
                    'supplier_id' => $supplier_id,
                    'project_id' => $project_id,
                );

                if ($StatusPO == 'New') {
                    $cekNoRef = $this->ModelPurchaseorder->getPurchaseOrder(" where PurchaseOrderNo = '$PurchaseOrderNo'");
                    if (count($cekNoRef) > 0) {
                        $response['status_json'] = false;
                        $response['remarks'] = "Purchase No. sudah ada!";
                        $this->db->trans_rollback();
                    } else {
                        $this->ModelGeneral->InsertData('fin_purchaseorder', $dataInsert);
                        $this->ModelGeneral->LogActivity('Process Insert New PO NO : ' . $PurchaseOrderNo);
                    }
                } else {
                    $this->ModelGeneral->UpdateData('fin_purchaseorder', $dataInsert, array('PurchaseOrderNo' => $PurchaseOrderNo));
                    $this->ModelGeneral->LogActivity('Process Edit PO NO : ' . $PurchaseOrderNo);
                }

                $this->db->trans_complete();
                $this->db->trans_commit();
            } else {
                $response['status_json'] = false;
                $response['remarks'] = "Nomor urut atau nama modul sudah ada!";
                $this->db->trans_rollback();
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        }
        echo json_encode($response);
    }

    function getPurchaseorderbyid()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data";
        try {
            $PurchaseOrderNo  = $this->input->post('PurchaseOrderNo');

            $check = $this->ModelPurchaseorder->getPurchaseOrder(" WHERE PurchaseOrderNo = '" . $PurchaseOrderNo . "' ");
            if ($check != null) {
                $response['data'] = $check;
            } else {
                $response['status_json'] = false;
                $response['remarks'] = "Item tidak ditemukan";
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        }
        echo json_encode($response);
    }
    public function getPurchaseorderdetail()
    {
        $PurchaseOrderNo  = $this->input->post('PurchaseOrderNo');

        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelPurchaseorder->getPurchaseorderdetail(" where PurchaseOrderNo = '$PurchaseOrderNo'");
        $no = 1;

        foreach ($datas as $d) {
            $Id = '"' . $d['id'] . '"';
            $option = "<a href='#' class='edit_record btn btn-info btn-sm' onclick='return editItem(" . $Id . ")'>+ Edit</a>
             <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapusItem(" . $Id . ")'>+ Hapus</a>";
            $data[] = array(
                "no" => $no,
                "Description" => $d['Description'],
                "Qty" => $d['Qty'],
                "Unit" => $d['Unit'],
                "Price" => $d['Price'],
                "Amount" => $d['Amount'],
                "option" => $option,

            );
            $no++;
        }
        if (count($datas) > 0) {
            $response['data'] = $data;
        } else {
            $response['data'] = array();
        }
        echo json_encode($response);
    }

    public function addItem()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Item PO baru";
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try {
            $datennow = date('Y-m-d H:i:s');
            $PurchaseOrderNo = $this->input->post('PurchaseOrderNo');
            $itemDescription = $this->input->post('itemDescription');
            $itemUnit = $this->input->post('itemUnit');
            $itemQty = $this->input->post('itemQty');
            $itemPrice = $this->input->post('itemPrice');

            $post = true;

            if ($post) {
                $dataInsert = array(
                    'PurchaseOrderNo'      => $PurchaseOrderNo,
                    'Description' => $itemDescription,
                    'Unit' => $itemUnit,
                    'Qty' => $itemQty,
                    'Price' => $itemPrice,
                    'Amount' => intval($itemQty) * intval($itemPrice),
                );
                $this->ModelGeneral->InsertData('fin_purchaseorder_detail', $dataInsert);
                $this->ModelGeneral->LogActivity('Process Insert New Detail PO : ' . $PurchaseOrderNo);
                $this->db->trans_complete();
                $this->db->trans_commit();
            } else {
                $response['status_json'] = false;
                $response['remarks'] = "Nomor urut atau nama modul sudah ada!";
                $this->db->trans_rollback();
            }
        } catch (\Throwable $e) {
            $response['status_json'] = false;
            $response['remarks'] = $e->getMessage();
            $this->db->trans_rollback();
            $this->ModelGeneral->LogError(current_url(),  $e->getMessage());
        }
        echo json_encode($response);
    }
}
