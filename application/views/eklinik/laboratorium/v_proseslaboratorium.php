<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css'); ?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
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
							<div class="card" id="divTable">
								<div class="card-header">
									<h4><?= $title; ?></h4>
									<hr>
								</div>

								<div class="card-body">
									<div class="table-responsive">
										<div class="loader" style="display:block"></div>
				<div class="panel">
					<div class="panel-heading">
						<span class="panel-title">Data Peserta</span>
					</div>
					<div class="panel-body row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-lg-12">
									<table width="100%" class="table table-striped table-hover">
												<tr>
													<td>No Registrasi</td>
													<td>:</td>
													<td><input id="noregistrasi" class="form-control" readonly>
                                                    <input id="id" type="hidden" class="form-control" readonly></td>
												</tr>
												<tr>
													<td>NIK</td>
													<td>:</td>
													<td><div class="input-group">
														<input type="text" class="form-control" id="nik" readonly>

													</div>
												</td>
											</tr>
											<tr>
												<td>Nama</td>
												<td>:</td>
												<td><input id="nama" class="form-control" readonly></td>
											</tr>
											<tr>
												<td>Tanggal Lahir</td>
												<td>:</td>
												<td><input id="tanggallahir" name="tanggallahir"  class="form-control" readonly></td>
											</tr>
                                        <tr>
												<td>Umur</td>
												<td>:</td>
												<td><input id="umur" name="umur"  class="form-control" readonly></td>
											</tr>

											<tr>
												<td>Jenis Kelamin</td>
												<td>:</td>
												<td><input id="jeniskelamin" name="jeniskelamin" class="form-control" readonly></td>
											</tr>
                                        </table>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="col-lg-12">
										<table width="100%" class="table table-striped table-hover">
											<tr>
													<td>No Laboratorium</td>
													<td>:</td>
													<td>
														<input type="text" class="form-control" name="nolab"  id="nolab" readonly>
													</td>
												</tr>

											<tr>
												<td>Waktu Pengambilan Sampel</td>
												<td>:</td>
												<td><input type="date" id="tanggalsampling" class="form-control" name="tanggalsampling"  ><input type="time" class="form-control" id="jamsampling" name="jamsampling" >
												</td>
											</tr>
                                            <tr>
												<td>Waktu Periksa Sampel</td>
												<td>:</td>
												<td><input type="date" id="tanggalperiksa" class="form-control" name="tanggalperiksa"  ><input type="time" class="form-control" id="jamperiksa" name="jamperiksa" >
												</td>
											</tr>
                                             <tr>
												<td>Pengambilan Urine</td>
												<td>:</td>
												<td><select class="form-control"  name="pengambilanurine" id="pengambilanurine" >
																	<option value="Ya">Ya</option>
																	<option value="Tidak">Tidak</option>
																</select></td>
											</tr>
                                            <tr>
												<td>Pengambilan Darah</td>
												<td>:</td>
												<td><select class="form-control"  name="pengambilandarah" id="pengambilandarah" >
																	<option value="Ya" >Ya</option>
																	<option value="Tidak" >Tidak</option>
																</select></td>
											</tr>
                                                                                        
                                            <tr>
												<td>Dokter Pemeriksa</td>
												<td>:</td>
												<td>
                                                    <select id="dokterpemeriksa"   class="form-control" name="dokterpemeriksa" required></select>
												</td>
										</tr>
										<tr>
											<td>Petugas</td>
											<td>:</td>
											<td><select id="petugas"   class="form-control" name="petugas" required></select>
												</td>
									</tr>
                                        <tr>
											<td>Diagnosa</td>
											<td>:</td>
											<td><textarea class="form-control input-lg m-b" rows="10" cols="50" name="diagnosa" id="diagnosa" style="font-size: 10px;" readonly></textarea>
												</td>
									</tr>
                                            <tr>
											<td>Catatan Dokter</td>
											<td>:</td>
											<td><textarea class="form-control" name="catatandokter" id="catatandokter" ></textarea>
												</td>
									</tr>
                                            <tr><td><a href="<?php echo base_url();?>eklinik/laboratorium/hasil/cetakhasil/<?php echo $id;?>"><button id="cetak"  type="button" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Preview Hasil</button></a></td></tr>
											
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="row">
				<div class="col-md-12">

					<div class="panel">
						<div class="tab-block mb25">
							<ul class="nav nav-tabs tabs-border nav-justified">
                                <li class="active">
												<a href="#LABORATORIUM" data-toggle="tab">HASIL PEMERIKSAAN LABORATORIUM</a>
								</li>
                            </ul>
						</div>
						<div class="panel-body p20 pb10">
							<div class="tab-content  pn br-n admin-form">
                                <div id="LABORATORIUM" class="tab-pane active">
			<div class="section row">
                <table class="table table-striped" id="table-menu">
											<thead>
        <tr>
          <th>Nama Item</th>
          <th>Satuan</th>
          <th>Hasil Pemeriksaan</th>
          <th>Keterangan </th>
        </tr>
      </thead>
                    
										</table>
                
                
            </div>
		</div>
                           </div>
	                       <div class="col-md-12">
												<hr>
													<button type="reset" class="btn btn-danger pull-left" onclick="self.history.back()"><i class="fa fa-reply"></i > Cancel</button>
													<button type="button" id="simpan" class="btn btn-success pull-right" onclick="return Simpan()"><i class="fa fa-check"></i> Simpan</button>
				            </div>
                        </div>
                        </div>
                </div>
                </div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>

		<script src="<?php echo base_url('assets/template/js/app.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/datatables.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/scripts.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/custom.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/toastr.js'); ?>"></script>
<script>
						$(document).ready(function() {
                            
                            $("#table-menu").dataTable({
                                
					ajax: {
						url: '<?php echo base_url("eklinik/laboratorium/hasil/getHasillab/".$id) ?>',
						dataSrc: 'data',
					},
					columns: [{
							"data": 'namaitem'
						}, {
							"data": 'satuan',
						},
						{
							"data": 'hasil'
						},
						{
							"data": 'keterangan'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [1]
					}]
				});
                            
							var csfrData = {};
							csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
							$.ajaxSetup({
								data: csfrData
							});
                            $("#dokterpemeriksa").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/laboratorium/hasil/getDokter") ?>',
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
                                        return {id: item.id, text: item.nama };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
                            $("#petugas").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/laboratorium/hasil/getPetugas") ?>',
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
                                        return {id: item.id, text: item.nama };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
                            getData();
                        });
                        function getData() {
							showLoading();
							dataPost = {
								id: '<?php echo $id;?>',
							}
							$.ajax({
								url: '<?php echo base_url("eklinik/laboratorium/hasil/getData") ?>',
								type: 'POST',
								dataType: 'json',
								data: dataPost,
								success: function(res) {
									console.log(res)
									dismisLoading();
									if (res.status_json) {
										data = res.data;
										$('#id').val(data.id);
										$('#noregistrasi').val(data.noregistrasi);
										$('#nama').val(data.nama);
										$('#nik').val(data.nik);
										$('#tanggallahir').val(data.tanggallahir);
										$('#umur').val(data.umur);
										$('#jeniskelamin').val(data.jeniskelamin);
										$('#tanggalperiksa').val(data.tanggalperiksa);
										$('#jamperiksa').val(data.jamperiksa);
										$('#tanggalsampling').val(data.tanggalsampling);
										$('#jamsampling').val(data.jamsampling);
										$('#pengambilanurine').val(data.pengambilanurine);
										$('#pengambilandarah').val(data.pengambilandarah);
										$('#diagnosa').val(data.diagnosa);
										$('#catatandokter').val(data.catatandokter);
                                       $('#catatandokter').val(data.catatandokter);
                                        
                                        
                                        var $dokterpemeriksa = $("<option selected></option>").val(data.dokterpemeriksa).text(data.namadokterpemeriksa);
										$('#dokterpemeriksa').append($dokterpemeriksa).trigger('change');
                                        var $petugas = $("<option selected></option>").val(data.petugas).text(data.namapetugas);
										$('#petugas').append($petugas).trigger('change');
                                        
									} else {
										showSnackError(res.remarks);
									}
								},
								error: function(XMLHttpRequest, textStatus, errorThrown) {
									showSnackError(XMLHttpRequest);
									dismisLoading();
								},
								timeout: 60000
							});
						}
    
             function Simpan() {
			var btn = document.getElementById("simpan");

			var id = $('#id').val();
            var catatandokter = $('#catatandokter').val();
            var dokterpemeriksa = $('#dokterpemeriksa').val();
            var petugas = $('#petugas').val();
            var tanggalperiksa = $('#tanggalperiksa').val();
            var jamperiksa = $('#jamperiksa').val();
            var tanggalsampling = $('#tanggalsampling').val();
            var jamsampling = $('#jamsampling').val();
            var pengambilanurine = $('#pengambilanurine').val();
            var pengambilandarah = $('#pengambilandarah').val();
            var jeniskelamin = $('#jeniskelamin').val();
                 
             <?php $no = 1; foreach($listitem as $a){ ?>
                 var iddetail<?php echo $a['id'];?>  = $('#iddetail<?php echo $a['id'];?>').val();
            <?php } ?>

			if (dokterpemeriksa == "" || dokterpemeriksa == null || petugas == "" || petugas == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {

					id: id,
					catatandokter: catatandokter,
					dokterpemeriksa: dokterpemeriksa,
					petugas: petugas,
					tanggalperiksa: tanggalperiksa,
					jamperiksa: jamperiksa,
					tanggalsampling: tanggalsampling,
					jamsampling: jamsampling,
					pengambilanurine: pengambilanurine,
					pengambilandarah: pengambilandarah,
					jeniskelamin: jeniskelamin,

                    <?php $no = 1; foreach($listitem as $a){ ?>
                 iddetail<?php echo $a['id'];?>  : iddetail<?php echo $a['id'];?>,
            <?php } ?>
				}
				$.ajax({
					url: '<?php echo base_url("eklinik/laboratorium/hasil/proses_act") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save PO';
							btn.innerHTML = 'Save PO';
							btn.disabled = false;
							success(res.remarks)
						} else {
							btn.value = 'Save PO';
							btn.innerHTML = 'Save PO';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Gagal, Coba lagi';
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					},
					timeout: 60000
				});
			}
		}
                        function showSnackError(text) {
							iziToast.error({
								title: 'Info',
								message: text,
								position: 'topRight'
							});
						}
						function showSnackSuccess(text) {
							iziToast.success({
								title: 'Info',
								message: text,
								position: 'topRight'
							});
						}
						function success(text) {
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
        
        <script type="text/javascript">
        $("#1311").change(function(){
        var k_kolesteroltotal = $("#1311").val();
        var k_trigliserida = $("#1312").val();
        var k_hdl = $("#1313").val();
        var tglima = k_trigliserida / 5;
        var k_ldl = k_kolesteroltotal - tglima - k_hdl;
        $("#1314").val(k_ldl.toFixed(0));
    });
    $("#1312").change(function(){
        var k_kolesteroltotal = $("#1311").val();
        var k_trigliserida = $("#1312").val();
        var k_hdl = $("#1313").val();
        var tglima = k_trigliserida / 5;
        var k_ldl = k_kolesteroltotal - tglima - k_hdl;
        $("#1314").val(k_ldl.toFixed(0));
    });
    $("#1313").change(function(){
        var k_kolesteroltotal = $("#1311").val();
        var k_trigliserida = $("#1312").val();
        var k_hdl = $("#1313").val();
        var tglima = k_trigliserida / 5;
        var k_ldl = k_kolesteroltotal - tglima - k_hdl;
        $("#1314").val(k_ldl.toFixed(0));
    });
                                    </script>
    </div>
</body>

</html>