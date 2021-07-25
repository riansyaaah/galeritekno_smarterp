<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title><?=$title;?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/datatables.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css');?>">
        <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico');?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css');?>">
    </head>
    <body>
        <div class="loader"></div>
        <div id="snackbar_custom"></div>
        <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?php $this->load->view('layout/v_header'); ?>
            <?php $this->load->view('layout/v_menu'); ?>
            <div class="main-content">
            <section class="section">
              <div class="section-body">
                <div class="invoice">
                  <div class="invoice-print">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="invoice-title">
                          <h5 style="text-align:center;">PT CIPTA LOKA KAMAYANGAN </h5>
                          <h2 style="text-align:center;">JOURNAL REPORT</h2>
                          <h5 style="text-align:center;">CASH</h5>
                          <!-- <div class="invoice-number">Order #12345</div> -->
                        </div>
                      </div>
                    </div>
                    <div class="buttons">
                      <a href="#" class="btn btn-danger">Print</a>
                    </div>
                    <div class="row mt-4">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6">
                            <address>
                              Page 1 of 1
                            </address>
                          </div>
                          <div class="col-md-6 text-md-right">
                            <address>
                              June 26, 2021<br><br>
                            </address>
                          </div>
                        </div>
                        <div class="table-responsive">
                          <table class="table table-striped table-hover table-md">
                            <tr>
                              <th data-width="">Date</th>
                              <th>Ref. No</th>
                              <th class="text-center">Account</th>
                              <th class="text-center">Description </th>
                              <th class="text-center">Debet</th>
                              <th class="text-right">Credit</th>
                            </tr>
                            <tr>
                              <td>01-01-17</td>
                              <td>001/3-KK01/D/0117</td>
                              <td class="text-center">1111.3.00.00000.0000</td>
                              <td class="text-left">Penerimaan dari PT A</td>
                              <td class="text-center">100.000</td>
                              <td class="text-right"></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td>001/3-KK01/D/0117</td>
                              <td class="text-center">2122.3.00.00000.0000</td>
                              <td class="text-left">Pembayaran Hutang A</td>
                              <td class="text-center"></td>
                              <td class="text-right">100.000</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td class="text-center"></td>
                              <td class="text-left"><b>Sub Total</b></td>
                              <td class="text-center">100.000</td>
                              <td class="text-right">100.000</td>
                            </tr>
                            <tr>
                              <td>02-01-17</td>
                              <td>001/3-KK01/D/0117</td>
                              <td class="text-center">7171.3.00.00000.0000</td>
                              <td class="text-left">Perjalanan Dinas</td>
                              <td class="text-center">50.000</td>
                              <td class="text-right"></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td>001/3-KK01/D/0117</td>
                              <td class="text-center">1111.3.00.00000.0000</td>
                              <td class="text-left">Taksi</td>
                              <td class="text-center"></td>
                              <td class="text-right">50.000</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td class="text-center"></td>
                              <td class="text-left"><b>Sub Total</b> </td>
                              <td class="text-center">50.000</td>
                              <td class="text-right">50.000</td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td class="text-center"></td>
                              <td class="text-left"><b>Grand Total</b></td>
                              <td class="text-center">150.000</td>
                              <td class="text-right">150.000</td>
                            </tr>
                            
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            </div>
            <?php $this->load->view('layout/v_footer');?>
        </div>

                    
        <script src="<?php echo base_url('assets/template/js/app.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/datatables.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/scripts.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/custom.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/toastr.js');?>"></script>

        
    </body>
</html>