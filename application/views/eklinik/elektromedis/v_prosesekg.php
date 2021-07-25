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
												<td><input id="nama" class="form-control" readonly ></td>
											</tr>
											<tr>
												<td>Tanggal Lahir</td>
												<td>:</td>
												<td><input id="tanggallahir" class="form-control" readonly></td>
											</tr>
                                        <tr>
												<td>Umur</td>
												<td>:</td>
												<td><input id="umur" class="form-control" readonly></td>
											</tr>

											<tr>
												<td>Jenis Kelamin</td>
												<td>:</td>
												<td><input id="jeniskelamin" class="form-control" readonly></td>
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
												<td>Dokter Pemeriksa</td>
												<td>:</td>
												<td><select id="dokterpemeriksa" class="form-control"></select></td>
											</tr>
                                            <tr>
												<td>Petugas</td>
												<td>:</td>
												<td><select id="petugas" class="form-control" ></select></td>
											</tr>
                                            
                                            <tr><td><a href="<?php echo base_url();?>eklinik/elektromedis/ekg/cetakhasil/<?php echo $id;?>"><button id="cetak"  type="button" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Preview Hasil</button></a></td></tr>
											
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
												<a href="#EKG" data-toggle="tab">HASIL PEMERIKSAAN EKG</a>
								</li>
                            </ul>
						</div>
						<div class="panel-body p20 pb10">
							<div class="tab-content  pn br-n admin-form">
                                <div id="EKG" class="tab-pane active">
												<div class="section row">
													<div class="col-md-6">
                                                     
                                                    <div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label">Hasil Pemeriksaan </label>
					<div class="col-lg-6">
						<select id="hasil"   class="form-control">
                        <option value="Normal" >Normal</option>
                        <option value="Abnormal" >Abnormal</option>
                            <option value="Tidak Periksa" >Tidak Periksa</option>
				    </select>
						
					</div>
				</div>
                                                        <div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label">File EKG </label>
					<div class="col-lg-6">
						<input type="file" name="uploadfile" id="file" class="form-control"/>
						
					</div>
				</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label">Diagnosa </label>
					<div class="col-lg-9">
						<textarea class="form-control input-lg m-b" rows="5" cols="50" id="diagnosa"></textarea>
						
					</div>
				</div>
                                                    <div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label">Catatan Dokter </label>
					<div class="col-lg-9">
						<textarea class="form-control input-lg m-b" id="catatandokter"></textarea>
						
					</div>
				</div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label">*QRS RATE </label>
					<div class="col-lg-6">
						<input id="qrsrate" class="form-control">
					</div>
				</div>
                                                        <div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label">QRS Duration </label>
					<div class="col-lg-6">
						<input id="qrsduration" class="form-control">
					</div>
				</div>
                                                        <div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label">*Axis </label>
					<div class="col-lg-6">
						<input id="axis" class="form-control" >
					</div>
				</div>
                                                        <div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label">*P Wave </label>
					<div class="col-lg-6">
						<input id="pwave" class="form-control">
					</div>
				</div>
                                                        <div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label">*P.R Interval </label>
					<div class="col-lg-6">
						<input id="printerval" class="form-control" >
					</div>
				</div>
                                                        <div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label">Q.Wave </label>
					<div class="col-lg-6">
						<input id="qwave" class="form-control">
					</div>
				</div>
                                                        <div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label">*T.Wave</label>
					<div class="col-lg-6">
						<input id="twave" class="form-control" >
					</div>
				</div>
                                                        <div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label">*ST-T Changes</label>
					<div class="col-lg-6">
						<input id="sttchanges" class="form-control">
					</div>
				</div>
                                                        <div class="form-group">
					<label for="inputStandard" class="col-lg-2 control-label">Remarks</label>
					<div class="col-lg-6">
						<input id="remarks" class="form-control">
					</div>
				</div>
										</div>
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
									url: '<?php echo base_url("eklinik/elektromedis/ekg/getDokter") ?>',
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
									url: '<?php echo base_url("eklinik/elektromedis/ekg/getPetugas") ?>',
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
								url: '<?php echo base_url("eklinik/elektromedis/ekg/getData") ?>',
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
										$('#diagnosa').val(data.diagnosa);
										$('#catatandokter').val(data.catatandokter);
										$('#hasil').val(data.hasil);
										$('#qrsrate').val(data.qrsrate);
										$('#qrsduration').val(data.qrsduration);
										$('#axis').val(data.axis);
										$('#pwave').val(data.pwave);
										$('#printerval').val(data.printerval);
										$('#qwave').val(data.qwave);
										$('#twave').val(data.twave);
										$('#sttchanges').val(data.sttchanges);
										$('#remarks').val(data.remarks);
                                        
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
			var diagnosa = $('#diagnosa').val();
            var catatandokter = $('#catatandokter').val();
            var hasil = $('#hasil').val();
            var qrsrate = $('#qrsrate').val();
            var qrsduration = $('#qrsduration').val();
            var axis = $('#axis').val();
            var pwave = $('#pwave').val();
            var printerval = $('#printerval').val();
            var qwave = $('#qwave').val();
            var twave = $('#twave').val();
            var sttchanges = $('#sttchanges').val();
            var remarks = $('#remarks').val();
            var dokterpemeriksa = $('#dokterpemeriksa').val();
            var petugas = $('#petugas').val();
            var file = document.getElementById("file").files[0];

			if (dokterpemeriksa == "" || dokterpemeriksa == null || petugas == "" || petugas == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
                var formData = new FormData();
                    formData.append('file', file);
                    formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
                

					formData.append('id', id);
					formData.append('diagnosa', diagnosa);
					formData.append('catatandokter', catatandokter);
					formData.append('hasil', hasil);
					formData.append('qrsrate', qrsrate);
					formData.append('qrsduration', qrsduration);
					formData.append('axis', axis);
					formData.append('pwave', pwave);
					formData.append('printerval', printerval);
					formData.append('qwave', qwave);
					formData.append('twave', twave);
					formData.append('sttchanges', sttchanges);
					formData.append('remarks', remarks);
					formData.append('dokterpemeriksa', dokterpemeriksa);
					formData.append('petugas', petugas);
				
				
				$.ajax({
					url: '<?php echo base_url("eklinik/elektromedis/ekg/proses_act") ?>',
					type: 'POST',
					dataType: 'json',
					data: formData,
                    processData: false,
                        contentType: false,
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
    </div>
</body>

</html>