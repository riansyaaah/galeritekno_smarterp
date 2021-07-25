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
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css');?>">
        <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico');?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>">
        <style>
            
        </style>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            <?=$title;?>
                                            <p></p>
                                            <button class="btn-sm btn-primary" onclick="add()"><i class="fa fa-plus"></i> Add</button>
                                        </h4>
                                        <hr>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <div class="loader" style="display:block"></div>
                                            <table class="table table-striped" id="table-menu">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Penjamin</th>
                                                        <th>Tarif Pelayanan</th>
                                                        <th>Tarif Kerjasama</th>
                                                        <th>Jasa Dokter</th>
                                                        <th>Jasa Petugas</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <section>
                </div>
                <?php $this->load->view('layout/v_footer');?>
            </div>
            <div class="modal fade" id="tambahModal" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="headermodaltambah">Tambah Detail Tarif</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body row">
                            <input type="hidden" id="id" class="form-control" value="<?php echo $id;?>">
							<table width="100%" class="table table-striped table-hover">
                                        <tr>
												<td>Penjamin</td>
												<td>:</td>
												<td><select id="idpenjamin" class="form-control" style="width:100%"></select></td>
											</tr>
												<tr>
													<td>Tarif Pelayanan</td>
													<td>:</td>
													<td><input type="number" id="tarifpelayanan" class="form-control">
												</tr>
												<tr>
													<td>Tarif Kerjasama</td>
													<td>:</td>
													<td><div class="input-group">
														<input type="number" class="form-control" id="tarifkerjasama">

													</div>
												</td>
											</tr>
											<tr>
												<td>Jasa Dokter</td>
												<td>:</td>
												<td><input type="number" id="jasadokter" class="form-control" ></td>
											</tr>
											<tr>
												<td>Jasa Petugas</td>
												<td>:</td>
												<td><input type="number" id="jasapetugas" class="form-control" ></td>
											</tr>
                                        
											
											
										</table>
							
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button class="btn btn-primary" type="button" id="btnSave" onclick="return save()">
                                SAVE
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

        <script src="<?php echo base_url('assets/template/js/app.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/datatables.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/scripts.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/custom.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/toastr.js');?>"></script>

        <script>
            $(document).ready(function() {
                
                $("#table-menu").dataTable({
                    ajax: {
                        url: '<?php echo base_url("eklinik/paketperiksa/itemperiksa/getTarifLab/".$id) ?>',
                        dataSrc: 'data'
                    },
                    columns: [
                        { 
                            "data": 'no',
                        },
                        { 
                            "data": 'namapenjamin' 
                        },
                        { 
                            "data": 'tarifpelayanan' 
                        },
                        { 
                            "data": 'tarifkerjasama' 
                        },
                        { 
                            "data": 'jasadokter' 
                        },
                        { 
                            "data": 'jasapetugas' 
                        },
                        { 
                            "data": 'option' 
                        }
                    ],
                    "columnDefs": [
                        { "sortable": false, "targets": [2, 3] }
                    ]
                });
                var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                $.ajaxSetup({
                    data: csfrData
                });
                $("#idpenjamin").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/masterdata/getSelectPenjamin") ?>',
									dataType: 'json',
									type: "GET",
									delay: 250,
									data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                                processResults: function (res, params) {
                                    var result = res.data.map(function (item) {
                                        return {id: item.id, text: item.namapenjamin };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
            });

            function add()
            {
                
                showLoading();
                             $("#tambahModal").modal();
                dismisLoading();
            }

            function save()
            {
                var btn = document.getElementById("btnSave");
                var id = $('#id').val();
                var idpenjamin = $('#idpenjamin').val();
                var tarifkerjasama = $('#tarifkerjasama').val();
                var tarifpelayanan = $('#tarifpelayanan').val();
                var jasadokter = $('#jasadokter').val();
                var jasapetugas = $('#jasapetugas').val();
                if(idpenjamin == "" || idpenjamin == null){
                    showSnackError("Harap Pilih Penjamin");
				}else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        id : id,
                        idpenjamin : idpenjamin,
                        tarifkerjasama : tarifkerjasama,
                        tarifpelayanan : tarifpelayanan,
                        jasadokter : jasadokter,
                        jasapetugas : jasapetugas,
                    }
                    $.ajax({
                        url: '<?= base_url("eklinik/paketperiksa/itemperiksa/saveDetailtarifLab") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks)
                            }else{
                                btn.value = 'SAVE';
                                btn.innerHTML = 'SAVE';
                                btn.disabled = false;
                                showSnackError(res.remarks);
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                            btn.value = 'Gagal, Coba lagi';
                            btn.innerHTML = 'Gagal, Coba lagi';
                            btn.disabled = false;
                        },
                        timeout: 60000 
                    });
                }
            }

            function showSnackError(text){
                iziToast.error({
                    title: 'Info',
                    message: text,
                    position: 'topRight'
                });
            }

            function showSnackSuccess(text){
                iziToast.success({
                    title: 'Info',
                    message: text,
                    position: 'topRight'
                });
            }

            function success(text){
                Swal.fire({
                    title: 'Info',
                    html: text,
                    type: "success",
                    confirmButtonText: 'Ok',
                    confirmButtonColor: "#46b654",
                }).then((result) => {
                    location.reload(true);
                })
            }

        </script>
    </body>
</html>