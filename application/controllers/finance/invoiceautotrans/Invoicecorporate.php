<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoicecorporate extends CI_Controller
{

    function __Construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->load->helper(array('form', 'url'));
        $this->load->model('auth/ModelLogin');
        $this->load->library('pdf');
        $this->load->model('ModelGeneral');
        $this->load->model('usermanagement/ModelUsers');
        $this->load->model('finance/invoiceautotrans/ModelInvoicecorporate');
    }

    var $idMenu = "2E5DEE60-F15F-4D6D-BC3C-E0624200178F";

    public function index()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        $sessionCurrentApp = $this->session->userdata('current_app');
        $sessionApplications = $this->session->userdata('applications');
        $date = date("Y-m-d");
        $ThnActive   = $this->ModelInvoicecorporate->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];
        $data = array(
            'datenow'       => date("d-m-Y", strtotime($date)),
            'title'         => 'Invoice Corporate',
            'count_ms'      => 99,
            'sess'          => $session,
            'menus'         => getMenu($session['user_id']),
            'apps'          => $sessionApplications,
            'current_app'   => $sessionCurrentApp,
            'tahunaktif' =>  $thn,
        );
        $this->load->view('finance/invoiceautotrans/v_invoicecorporate', $data);
    }
    
    public function getInvoiceCor()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        
        $datas = $this->ModelInvoicecorporate->getInvoiceCor();
        $no = 1;
        foreach ($datas as $d) {
            $option = "<a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
            $data[] = [
                "no" => $no,
                "InvoiceCorNo" => $d['InvoiceCorNo'],
                "InvoiceCorDate" => $d['InvoiceCorDate'],
                "Debit" => $d['Debit'],
                "Credit" => $d['Credit'],
                "option" => $option
            ];
            $no++;
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    }
    
    function cariInvoiceCorNo()
    {
        // SELECT max(SUBSTR(InvoiceCorNo, 1, 3)) as InvoiceCorNo FROM fin_invoicecorporate where InvoiceCorNo like '%/VM/202103'
        $ThnActive   = $this->ModelInvoicecorporate->getPeriode();
        $thn = $ThnActive[0]['ThnBln'];

        $InvoiceCorNo = "/IC/" . $thn;
        $cek = $this->ModelInvoicecorporate->getInvoiceCorNo($InvoiceCorNo);

        if ($cek[0]['InvoiceCorNo'] == "") {
            $data['InvoiceCorNo'] = "001";
        } else {
            $nomor = intval($cek[0]['InvoiceCorNo']) + 1;
            $data['InvoiceCorNo'] = str_pad($nomor, 3, "0", STR_PAD_LEFT);;
        }
        echo json_encode($data);
    }
    
    public function getAccountNo()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelInvoicecorporate->getAccountNo(" where Level = 'MASTER' order by AccountNo");
        $no = 1;
        foreach ($datas as $d) {
            $option = "
             <a href='#' class='edit_record btn btn-info btn-sm'><i class='fas fa-check'></i></a>";
            $data[] = [
                "no" => $no,
                "AccountNo" => $d['AccountNo'],
                "AccountName" => $d['AccountName'],
                "option" => $option,

            ];
            $no++;
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    }
    
    public function addItem()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menyimpan Item Invoice Corporate";
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try {
            $datennow = date('Y-m-d H:i:s');
            $input = $this->input;
            $InvoiceCorNo = $input->post('InvoiceCorNo');
            $InvoiceCorDate = $input->post('InvoiceCorDate');
            $itemDescription = $input->post('itemDescription');
            $itemAmount = str_replace('.', '', $input->post('itemAmount'));
            $itemAccountNo = $input->post('itemAccountNo');
            $status = $input->post('status');
            $itemidRow = $input->post('itemidRow');
            $DebitCredit = $input->post('DebitCredit');
            
            if ($DebitCredit == 'Credit') {
                        $Credit      = $itemAmount;
                        $Debit      = "0";
                } else {
                        $Credit      = "0";
                        $Debit      = $itemAmount;
                }
            
            $post = true;

            if ($post) {
                
                if ($status == 'Tambah') {
                    $cekItem = $this->ModelInvoicecorporate->getInvoiceCorNoDetail(" where InvoiceCorNo = '$InvoiceCorNo' order by NoUrut desc limit 1");
                    if (count($cekItem) > 0) {
                        $NoUrut = (intval(substr($cekItem[0]['NoUrut'], -1)) + 1);
                        $NoUrut = str_pad($NoUrut, 3, "0", STR_PAD_LEFT);
                    } else {
                        $NoUrut = str_pad("1", 3, "0", STR_PAD_LEFT);
                    }
                    $dataInsert = array(
                        'NoUrut'      => $NoUrut,
                        'InvoiceCorDate'      => $InvoiceCorDate,
                        'InvoiceCorNo' => $InvoiceCorNo,
                        'Description' => $itemDescription,
                        'AccountNo' => $itemAccountNo,
                        'Debit' => $Debit,
                        'Credit' => $Credit,
                        'Posting' => '0',
                    );
                    $this->ModelGeneral->InsertData('fin_invoicecorporate', $dataInsert);
                    $this->ModelGeneral->LogActivity('Process Insert New Item Invoice Corporate : ' . $itemDescription);
                } else {
                    $dataInsert = array(
                        'Description' => $itemDescription,
                        'AccountNo' => $itemAccountNo,
                        'Debit' => $Debit,
                        'Credit' => $Credit,
                    );
                    $this->ModelGeneral->UpdateData('fin_invoicecorporate', $dataInsert, array('id' => $itemidRow));
                    $this->ModelGeneral->LogActivity('Process Update Item Invoice Corporate : ' . $itemDescription);
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
    
    public function caridetailInvoiceCor()
    {
        $InvoiceCorNo  = $this->input->post('InvoiceCorNo');
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $datas = $this->ModelInvoicecorporate->getInvoiceCorNoDetail(" where InvoiceCorNo = '$InvoiceCorNo' order by NoUrut asc");
        $no = 1;
        foreach ($datas as $d) {
            $idRow = '"' . $d['id'] . '"';
            $option = "<a href='#' class='edit_record btn btn-info btn-sm' onclick='return editItem(" . $idRow . ")'>+ Edit</a>
             <a href='#' class='edit_record btn btn-danger btn-sm' onclick='return hapusItem(" . $idRow . ")'>+ Hapus</a>";
            $data[] = [
                "no" => $no,
                "NoUrut" => $d['NoUrut'],
                "Description" => $d['Description'],
                "AccountNo" => $d['AccountNo'],
                "Debit" => number_format($d['Debit'], 0),
                "Credit" => number_format($d['Credit'], 0),
                "option" => $option,
            ];
            $no++;
        }
        $response['data'] = (count($datas) > 0)? $data : [];
        echo json_encode($response);
    }
    
    function getItemInvoiceCor()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil get data";
        try {
            $idrow  = $this->input->post('idrow');

            $check = $this->ModelInvoicecorporate->getInvoiceCorNoDetail(" WHERE fin_invoicecorporate.id = '$idrow' ");
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
    public function hapusItemInvoiceCor()
    {
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $response['remarks'] = "Berhasil menghapus Item Trans ";
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);

        try {
            $datennow = date('Y-m-d H:i:s');
            $itemidRow_hapus = $this->input->post('itemidRow_hapus');

            $post = true;
            if ($post) {

                $this->ModelGeneral->DeleteData('fin_invoicecorporate', array('id' => $itemidRow_hapus));
                $this->ModelGeneral->LogActivity('Process Delete Item Trans : ' . $itemidRow_hapus);
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
    public function cekPrint() {
        $InvoiceCorNo  = $this->input->get('InvoiceCorNo');
        cek_session($this->idMenu);
        $session = $this->session->userdata('login');
        header("Content-Type: application/json");
        $response = [];
        $response['status_json'] = true;
        $data = $this->ModelInvoicecorporate->getCountICNoDetail($InvoiceCorNo);
        $response['response'] = $data['jumlah'];
        echo json_encode($response);
    }
    public function cetak() {
        $pdf = new PDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Invoice Corporate');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->NamaPerusahaan = 'PT. SPEEDLAB INDONESIA';
        $pdf->JudulReprot = 'Invoice Corporate';
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        $pdf->SetDefaultMonospacedFont('dejavusans');
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $InvoiceCorNo = $this->input->get('InvoiceCorNo');
        $datas = $this->ModelInvoicecorporate->getInvoiceCorNoDetail(" WHERE InvoiceCorNo = '$InvoiceCorNo' ORDER BY NoUrut ASC");
        $print = end($datas);
        $items = $this->_susunPrint($datas);
        $tAmount = $this->_tAmount($items);
        $datax = [
            'date'          => $this->_spasi(13).': '.$print['InvoiceCorDate'],
            'ledger'        => $this->_spasi(10).': -',
            'voucher'       => $this->_spasi(2).': '.$print['InvoiceCorNo'],
            'account'       => $this->_spasi(8).': -',
            'payTo'         => $this->_spasi(10).': '.$print['Description'],
            'totalAmount'   => $this->_spasi(13).': '.$tAmount,
            'items'         => $items
        ];
        $pdf->AddPage('L', 'A4');
        $content = $this->load->view('invoiceautotrans/print_InvoiceCor', $datax, true);
        $pdf->writeHTML($content, true, true, true, true, '');
        $pdf->Output('Invoice Corporate.pdf', 'I');
    }
    private function _susunPrint($datas) {
        $no = 1;
        foreach($datas as $data) {
            $amount = ($data['Debit'] == 0)? $data['Credit'] : $data['Debit'];
            $dataPrint[] = (object)[
                'no'            => $no++,
                'Description'   => $data['Description'],
                'AccountNo'     => $data['AccountNo'],
                'Debit'         => $amount
            ];
        }
        return $dataPrint;
    }
    private function _spasi($jumlah) {
        $spasi = '';
        for($i=1; $i<=$jumlah; $i++) {
            $spasi .= '&nbsp;';
        }
        return $spasi;
    }
    private function _tAmount($items) {
        $tot = 0;
        foreach($items as $item) {
            $tot += $item->Debit;
        }
        return number_format($tot, 0, ',', '.');
    }
}
