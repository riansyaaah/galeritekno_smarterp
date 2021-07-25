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
                                            
                                            <tr><td><a href="<?php echo base_url();?>eklinik/elektromedis/audiometri/cetakhasil/<?php echo $id;?>"><button id="cetak"  type="button" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Preview Hasil</button></a></td></tr>
											
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
												<a href="#AUDIOMETRI" data-toggle="tab">HASIL PEMERIKSAAN AUDIOMETRI</a>
								</li>
                            </ul>
						</div>
						<div class="panel-body p20 pb10">
							<div class="tab-content  pn br-n admin-form">
                                <div id="AUDIOMETRI" class="tab-pane active">
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
					<label for="inputStandard" class="col-lg-3 control-label">File Audiometri </label>
					<div class="col-lg-6">
						<input type="file" name="uploadfile" id="icon" class="form-control"/>
					</div>
				</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label">Diagnosa </label>
					<div class="col-lg-9">
						<textarea class="form-control input-lg m-b" rows="5" cols="50" name="diagnosa" id="diagnosa"></textarea>
						
					</div>
				</div>
                                                    <div class="form-group">
					<label for="inputStandard" class="col-lg-3 control-label">Catatan Dokter </label>
					<div class="col-lg-9">
						<textarea class="form-control input-lg m-b" name="catatandokter" id="catatandokter"></textarea>
						
					</div>
				</div>
                                                    </div>
                                                    <div class="col-md-12" style="overflow-y: auto;">
                    <table id="mytablegigi" class="table table-striped table-bordered table-hover" >
                    <thead>
                    <tr>
                    <th rowspan="2"></th>
                    <th rowspan="2"></th>
                    <th colspan="11" style="align:center;">FREKUENSI</th>
                    </tr>
                    <tr>
                    <th>250</th>
                    <th>500</th>
                    <th>1000</th>
                    <th>1500</th>
                    <th>2000</th>
                    <th>3000</th>
                    <th>4000</th>
                    <th>6000</th>
                    <th>8000</th>
                    </tr>
                    </thead>  
                    <tbody>
                    <tr>
                    <td>AC, masked if necessary</td>
                    <td>Right Ear</td>
                    <td ><input id="acmr250" class="form-control"></td>
                    <td ><input id="acmr500" class="form-control"></td>
                    <td ><input id="acmr1000" class="form-control" ></td>
                    <td ><input id="acmr1500" class="form-control"></td>
                    <td ><input id="acmr2000" class="form-control"></td>
                    <td ><input id="acmr3000" class="form-control"></td>
                    <td ><input id="acmr4000" class="form-control"></td>
                    <td ><input id="acmr6000" class="form-control"></td>
                    <td ><input id="acmr8000" class="form-control"></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Left Ear</td>
                        <td ><input id="acml250" class="form-control"></td>
                    <td ><input id="acml500" class="form-control"></td>
                    <td ><input id="acml1000" class="form-control" ></td>
                    <td ><input id="acml1500" class="form-control"></td>
                    <td ><input id="acml2000" class="form-control"></td>
                    <td ><input id="acml3000" class="form-control"></td>
                    <td ><input id="acml4000" class="form-control"></td>
                    <td ><input id="acml6000" class="form-control"></td>
                    <td ><input id="acml8000" class="form-control"></td>
                    </tr>
                        <tr>
                    <td>AC,  not masked (shadow)</td>
                    <td>Right Ear</td>
                            <td ><input id="acnr250" class="form-control"></td>
                    <td ><input id="acnr500" class="form-control"></td>
                    <td ><input id="acnr1000" class="form-control" ></td>
                    <td ><input id="acnr1500" class="form-control"></td>
                    <td ><input id="acnr2000" class="form-control"></td>
                    <td ><input id="acnr3000" class="form-control"></td>
                    <td ><input id="acnr4000" class="form-control"></td>
                    <td ><input id="acnr6000" class="form-control"></td>
                    <td ><input id="acnr8000" class="form-control"></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Left Ear</td>
                        <td ><input id="acnl250" class="form-control"></td>
                    <td ><input id="acnl500" class="form-control"></td>
                    <td ><input id="acnl1000" class="form-control" ></td>
                    <td ><input id="acnl1500" class="form-control"></td>
                    <td ><input id="acnl2000" class="form-control"></td>
                    <td ><input id="acnl3000" class="form-control"></td>
                    <td ><input id="acnl4000" class="form-control"></td>
                    <td ><input id="acnl6000" class="form-control"></td>
                    <td ><input id="acnl8000" class="form-control"></td>
                    </tr>
                        <tr>
                    <td>BC, not masked</td>
                    <td>Right Ear</td>
                            <td ><input id="bcnr250" class="form-control"></td>
                    <td ><input id="bcnr500" class="form-control"></td>
                    <td ><input id="bcnr1000" class="form-control" ></td>
                    <td ><input id="bcnr1500" class="form-control"></td>
                    <td ><input id="bcnr2000" class="form-control"></td>
                    <td ><input id="bcnr3000" class="form-control"></td>
                    <td ><input id="bcnr4000" class="form-control"></td>
                    <td ><input id="bcnr6000" class="form-control"></td>
                    <td ><input id="bcnr8000" class="form-control"></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Left Ear</td>
                        <td ><input id="bcnl250" class="form-control"></td>
                    <td ><input id="bcnl500" class="form-control"></td>
                    <td ><input id="bcnl1000" class="form-control" ></td>
                    <td ><input id="bcnl1500" class="form-control"></td>
                    <td ><input id="bcnl2000" class="form-control"></td>
                    <td ><input id="bcnl3000" class="form-control"></td>
                    <td ><input id="bcnl4000" class="form-control"></td>
                    <td ><input id="bcnl6000" class="form-control"></td>
                    <td ><input id="bcnl8000" class="form-control"></td>
                    </tr>
                        <tr>
                    <td>BC, masked</td>
                    <td>Right Ear</td>
                            <td ><input id="bcmr250" class="form-control"></td>
                    <td ><input id="bcmr500" class="form-control"></td>
                    <td ><input id="bcmr1000" class="form-control" ></td>
                    <td ><input id="bcmr1500" class="form-control"></td>
                    <td ><input id="bcmr2000" class="form-control"></td>
                    <td ><input id="bcmr3000" class="form-control"></td>
                    <td ><input id="bcmr4000" class="form-control"></td>
                    <td ><input id="bcmr6000" class="form-control"></td>
                    <td ><input id="bcmr8000" class="form-control"></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Left Ear</td>
                        <td ><input id="bcml250" class="form-control"></td>
                    <td ><input id="bcml500" class="form-control"></td>
                    <td ><input id="bcml1000" class="form-control" ></td>
                    <td ><input id="bcml1500" class="form-control"></td>
                    <td ><input id="bcml2000" class="form-control"></td>
                    <td ><input id="bcml3000" class="form-control"></td>
                    <td ><input id="bcml4000" class="form-control"></td>
                    <td ><input id="bcml6000" class="form-control"></td>
                    <td ><input id="bcml8000" class="form-control"></td>
                    </tr>
                        <tr>
                    <td>ULL</td>
                    <td>Right Ear</td>
                            <td ><input id="ullr250" class="form-control"></td>
                    <td ><input id="ullr500" class="form-control"></td>
                    <td ><input id="ullr1000" class="form-control" ></td>
                    <td ><input id="ullr1500" class="form-control"></td>
                    <td ><input id="ullr2000" class="form-control"></td>
                    <td ><input id="ullr3000" class="form-control"></td>
                    <td ><input id="ullr4000" class="form-control"></td>
                    <td ><input id="ullr6000" class="form-control"></td>
                    <td ><input id="ullr8000" class="form-control"></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Left Ear</td>
                        <td ><input id="ulll250" class="form-control"></td>
                    <td ><input id="ulll500" class="form-control"></td>
                    <td ><input id="ulll1000" class="form-control" ></td>
                    <td ><input id="ulll1500" class="form-control"></td>
                    <td ><input id="ulll2000" class="form-control"></td>
                    <td ><input id="ulll3000" class="form-control"></td>
                    <td ><input id="ulll4000" class="form-control"></td>
                    <td ><input id="ulll6000" class="form-control"></td>
                    <td ><input id="ulll8000" class="form-control"></td>
                    </tr>
                        
                    </tbody>
                    </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="containera" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div id="containerb"></div>
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
									url: '<?php echo base_url("eklinik/elektromedis/audiometri/getDokter") ?>',
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
									url: '<?php echo base_url("eklinik/elektromedis/audiometri/getPetugas") ?>',
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
								url: '<?php echo base_url("eklinik/elektromedis/audiometri/getData") ?>',
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
										
                                        $('#acmr125').val(data.acmr125);
$('#acmr250').val(data.acmr250);
$('#acmr500').val(data.acmr500);
$('#acmr750').val(data.acmr750);
$('#acmr1000').val(data.acmr1000);
$('#acmr1500').val(data.acmr1500);
$('#acmr2000').val(data.acmr2000);
$('#acmr3000').val(data.acmr3000);
$('#acmr4000').val(data.acmr4000);
$('#acmr6000').val(data.acmr6000);
$('#acmr8000').val(data.acmr8000);
$('#acml125').val(data.acml125);
$('#acml250').val(data.acml250);
$('#acml500').val(data.acml500);
$('#acml750').val(data.acml750);
$('#acml1000').val(data.acml1000);
$('#acml1500').val(data.acml1500);
$('#acml2000').val(data.acml2000);
$('#acml3000').val(data.acml3000);
$('#acml4000').val(data.acml4000);
$('#acml6000').val(data.acml6000);
$('#acml8000').val(data.acml8000);
$('#acnr125').val(data.acnr125);
$('#acnr250').val(data.acnr250);
$('#acnr500').val(data.acnr500);
$('#acnr750').val(data.acnr750);
$('#acnr1000').val(data.acnr1000);
$('#acnr1500').val(data.acnr1500);
$('#acnr2000').val(data.acnr2000);
$('#acnr3000').val(data.acnr3000);
$('#acnr4000').val(data.acnr4000);
$('#acnr6000').val(data.acnr6000);
$('#acnr8000').val(data.acnr8000);
$('#acnl125').val(data.acnl125);
$('#acnl250').val(data.acnl250);
$('#acnl500').val(data.acnl500);
$('#acnl750').val(data.acnl750);
$('#acnl1000').val(data.acnl1000);
$('#acnl1500').val(data.acnl1500);
$('#acnl2000').val(data.acnl2000);
$('#acnl3000').val(data.acnl3000);
$('#acnl4000').val(data.acnl4000);
$('#acnl6000').val(data.acnl6000);
$('#acnl8000').val(data.acnl8000);
$('#bcnr125').val(data.bcnr125);
$('#bcnr250').val(data.bcnr250);
$('#bcnr500').val(data.bcnr500);
$('#bcnr750').val(data.bcnr750);
$('#bcnr1000').val(data.bcnr1000);
$('#bcnr1500').val(data.bcnr1500);
$('#bcnr2000').val(data.bcnr2000);
$('#bcnr3000').val(data.bcnr3000);
$('#bcnr4000').val(data.bcnr4000);
$('#bcnr6000').val(data.bcnr6000);
$('#bcnr8000').val(data.bcnr8000);
$('#bcnl125').val(data.bcnl125);
$('#bcnl250').val(data.bcnl250);
$('#bcnl500').val(data.bcnl500);
$('#bcnl750').val(data.bcnl750);
$('#bcnl1000').val(data.bcnl1000);
$('#bcnl1500').val(data.bcnl1500);
$('#bcnl2000').val(data.bcnl2000);
$('#bcnl3000').val(data.bcnl3000);
$('#bcnl4000').val(data.bcnl4000);
$('#bcnl6000').val(data.bcnl6000);
$('#bcnl8000').val(data.bcnl8000);
$('#bcmr125').val(data.bcmr125);
$('#bcmr250').val(data.bcmr250);
$('#bcmr500').val(data.bcmr500);
$('#bcmr750').val(data.bcmr750);
$('#bcmr1000').val(data.bcmr1000);
$('#bcmr1500').val(data.bcmr1500);
$('#bcmr2000').val(data.bcmr2000);
$('#bcmr3000').val(data.bcmr3000);
$('#bcmr4000').val(data.bcmr4000);
$('#bcmr6000').val(data.bcmr6000);
$('#bcmr8000').val(data.bcmr8000);
$('#bcml125').val(data.bcml125);
$('#bcml250').val(data.bcml250);
$('#bcml500').val(data.bcml500);
$('#bcml750').val(data.bcml750);
$('#bcml1000').val(data.bcml1000);
$('#bcml1500').val(data.bcml1500);
$('#bcml2000').val(data.bcml2000);
$('#bcml3000').val(data.bcml3000);
$('#bcml4000').val(data.bcml4000);
$('#bcml6000').val(data.bcml6000);
$('#bcml8000').val(data.bcml8000);
$('#ullr125').val(data.ullr125);
$('#ullr250').val(data.ullr250);
$('#ullr500').val(data.ullr500);
$('#ullr750').val(data.ullr750);
$('#ullr1000').val(data.ullr1000);
$('#ullr1500').val(data.ullr1500);
$('#ullr2000').val(data.ullr2000);
$('#ullr3000').val(data.ullr3000);
$('#ullr4000').val(data.ullr4000);
$('#ullr6000').val(data.ullr6000);
$('#ullr8000').val(data.ullr8000);
$('#ulll125').val(data.ulll125);
$('#ulll250').val(data.ulll250);
$('#ulll500').val(data.ulll500);
$('#ulll750').val(data.ulll750);
$('#ulll1000').val(data.ulll1000);
$('#ulll1500').val(data.ulll1500);
$('#ulll2000').val(data.ulll2000);
$('#ulll3000').val(data.ulll3000);
$('#ulll4000').val(data.ulll4000);
$('#ulll6000').val(data.ulll6000);
$('#ulll8000').val(data.ulll8000);
                                        
                                        
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
            var dokterpemeriksa = $('#dokterpemeriksa').val();
            var petugas = $('#petugas').val();
            
            var acmr125 = $('#acmr125').val();
var acmr250 = $('#acmr250').val();
var acmr500 = $('#acmr500').val();
var acmr750 = $('#acmr750').val();
var acmr1000 = $('#acmr1000').val();
var acmr1500 = $('#acmr1500').val();
var acmr2000 = $('#acmr2000').val();
var acmr3000 = $('#acmr3000').val();
var acmr4000 = $('#acmr4000').val();
var acmr6000 = $('#acmr6000').val();
var acmr8000 = $('#acmr8000').val();
var acml125 = $('#acml125').val();
var acml250 = $('#acml250').val();
var acml500 = $('#acml500').val();
var acml750 = $('#acml750').val();
var acml1000 = $('#acml1000').val();
var acml1500 = $('#acml1500').val();
var acml2000 = $('#acml2000').val();
var acml3000 = $('#acml3000').val();
var acml4000 = $('#acml4000').val();
var acml6000 = $('#acml6000').val();
var acml8000 = $('#acml8000').val();
var acnr125 = $('#acnr125').val();
var acnr250 = $('#acnr250').val();
var acnr500 = $('#acnr500').val();
var acnr750 = $('#acnr750').val();
var acnr1000 = $('#acnr1000').val();
var acnr1500 = $('#acnr1500').val();
var acnr2000 = $('#acnr2000').val();
var acnr3000 = $('#acnr3000').val();
var acnr4000 = $('#acnr4000').val();
var acnr6000 = $('#acnr6000').val();
var acnr8000 = $('#acnr8000').val();
var acnl125 = $('#acnl125').val();
var acnl250 = $('#acnl250').val();
var acnl500 = $('#acnl500').val();
var acnl750 = $('#acnl750').val();
var acnl1000 = $('#acnl1000').val();
var acnl1500 = $('#acnl1500').val();
var acnl2000 = $('#acnl2000').val();
var acnl3000 = $('#acnl3000').val();
var acnl4000 = $('#acnl4000').val();
var acnl6000 = $('#acnl6000').val();
var acnl8000 = $('#acnl8000').val();
var bcnr125 = $('#bcnr125').val();
var bcnr250 = $('#bcnr250').val();
var bcnr500 = $('#bcnr500').val();
var bcnr750 = $('#bcnr750').val();
var bcnr1000 = $('#bcnr1000').val();
var bcnr1500 = $('#bcnr1500').val();
var bcnr2000 = $('#bcnr2000').val();
var bcnr3000 = $('#bcnr3000').val();
var bcnr4000 = $('#bcnr4000').val();
var bcnr6000 = $('#bcnr6000').val();
var bcnr8000 = $('#bcnr8000').val();
var bcnl125 = $('#bcnl125').val();
var bcnl250 = $('#bcnl250').val();
var bcnl500 = $('#bcnl500').val();
var bcnl750 = $('#bcnl750').val();
var bcnl1000 = $('#bcnl1000').val();
var bcnl1500 = $('#bcnl1500').val();
var bcnl2000 = $('#bcnl2000').val();
var bcnl3000 = $('#bcnl3000').val();
var bcnl4000 = $('#bcnl4000').val();
var bcnl6000 = $('#bcnl6000').val();
var bcnl8000 = $('#bcnl8000').val();
var bcmr125 = $('#bcmr125').val();
var bcmr250 = $('#bcmr250').val();
var bcmr500 = $('#bcmr500').val();
var bcmr750 = $('#bcmr750').val();
var bcmr1000 = $('#bcmr1000').val();
var bcmr1500 = $('#bcmr1500').val();
var bcmr2000 = $('#bcmr2000').val();
var bcmr3000 = $('#bcmr3000').val();
var bcmr4000 = $('#bcmr4000').val();
var bcmr6000 = $('#bcmr6000').val();
var bcmr8000 = $('#bcmr8000').val();
var bcml125 = $('#bcml125').val();
var bcml250 = $('#bcml250').val();
var bcml500 = $('#bcml500').val();
var bcml750 = $('#bcml750').val();
var bcml1000 = $('#bcml1000').val();
var bcml1500 = $('#bcml1500').val();
var bcml2000 = $('#bcml2000').val();
var bcml3000 = $('#bcml3000').val();
var bcml4000 = $('#bcml4000').val();
var bcml6000 = $('#bcml6000').val();
var bcml8000 = $('#bcml8000').val();
var ullr125 = $('#ullr125').val();
var ullr250 = $('#ullr250').val();
var ullr500 = $('#ullr500').val();
var ullr750 = $('#ullr750').val();
var ullr1000 = $('#ullr1000').val();
var ullr1500 = $('#ullr1500').val();
var ullr2000 = $('#ullr2000').val();
var ullr3000 = $('#ullr3000').val();
var ullr4000 = $('#ullr4000').val();
var ullr6000 = $('#ullr6000').val();
var ullr8000 = $('#ullr8000').val();
var ulll125 = $('#ulll125').val();
var ulll250 = $('#ulll250').val();
var ulll500 = $('#ulll500').val();
var ulll750 = $('#ulll750').val();
var ulll1000 = $('#ulll1000').val();
var ulll1500 = $('#ulll1500').val();
var ulll2000 = $('#ulll2000').val();
var ulll3000 = $('#ulll3000').val();
var ulll4000 = $('#ulll4000').val();
var ulll6000 = $('#ulll6000').val();
var ulll8000 = $('#ulll8000').val();
                
			if (dokterpemeriksa == "" || dokterpemeriksa == null || petugas == "" || petugas == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {

					id: id,
					diagnosa: diagnosa,
					catatandokter: catatandokter,
					hasil: hasil,
					dokterpemeriksa: dokterpemeriksa,
					petugas: petugas,
					acmr125:acmr125,
acmr250:acmr250,
acmr500:acmr500,
acmr750:acmr750,
acmr1000:acmr1000,
acmr1500:acmr1500,
acmr2000:acmr2000,
acmr3000:acmr3000,
acmr4000:acmr4000,
acmr6000:acmr6000,
acmr8000:acmr8000,
acml125:acml125,
acml250:acml250,
acml500:acml500,
acml750:acml750,
acml1000:acml1000,
acml1500:acml1500,
acml2000:acml2000,
acml3000:acml3000,
acml4000:acml4000,
acml6000:acml6000,
acml8000:acml8000,
acnr125:acnr125,
acnr250:acnr250,
acnr500:acnr500,
acnr750:acnr750,
acnr1000:acnr1000,
acnr1500:acnr1500,
acnr2000:acnr2000,
acnr3000:acnr3000,
acnr4000:acnr4000,
acnr6000:acnr6000,
acnr8000:acnr8000,
acnl125:acnl125,
acnl250:acnl250,
acnl500:acnl500,
acnl750:acnl750,
acnl1000:acnl1000,
acnl1500:acnl1500,
acnl2000:acnl2000,
acnl3000:acnl3000,
acnl4000:acnl4000,
acnl6000:acnl6000,
acnl8000:acnl8000,
bcnr125:bcnr125,
bcnr250:bcnr250,
bcnr500:bcnr500,
bcnr750:bcnr750,
bcnr1000:bcnr1000,
bcnr1500:bcnr1500,
bcnr2000:bcnr2000,
bcnr3000:bcnr3000,
bcnr4000:bcnr4000,
bcnr6000:bcnr6000,
bcnr8000:bcnr8000,
bcnl125:bcnl125,
bcnl250:bcnl250,
bcnl500:bcnl500,
bcnl750:bcnl750,
bcnl1000:bcnl1000,
bcnl1500:bcnl1500,
bcnl2000:bcnl2000,
bcnl3000:bcnl3000,
bcnl4000:bcnl4000,
bcnl6000:bcnl6000,
bcnl8000:bcnl8000,
bcmr125:bcmr125,
bcmr250:bcmr250,
bcmr500:bcmr500,
bcmr750:bcmr750,
bcmr1000:bcmr1000,
bcmr1500:bcmr1500,
bcmr2000:bcmr2000,
bcmr3000:bcmr3000,
bcmr4000:bcmr4000,
bcmr6000:bcmr6000,
bcmr8000:bcmr8000,
bcml125:bcml125,
bcml250:bcml250,
bcml500:bcml500,
bcml750:bcml750,
bcml1000:bcml1000,
bcml1500:bcml1500,
bcml2000:bcml2000,
bcml3000:bcml3000,
bcml4000:bcml4000,
bcml6000:bcml6000,
bcml8000:bcml8000,
ullr125:ullr125,
ullr250:ullr250,
ullr500:ullr500,
ullr750:ullr750,
ullr1000:ullr1000,
ullr1500:ullr1500,
ullr2000:ullr2000,
ullr3000:ullr3000,
ullr4000:ullr4000,
ullr6000:ullr6000,
ullr8000:ullr8000,
ulll125:ulll125,
ulll250:ulll250,
ulll500:ulll500,
ulll750:ulll750,
ulll1000:ulll1000,
ulll1500:ulll1500,
ulll2000:ulll2000,
ulll3000:ulll3000,
ulll4000:ulll4000,
ulll6000:ulll6000,
ulll8000:ulll8000,
                    

				}
				$.ajax({
					url: '<?php echo base_url("eklinik/elektromedis/audiometri/proses_act") ?>',
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
    </div>
</body>

</html>