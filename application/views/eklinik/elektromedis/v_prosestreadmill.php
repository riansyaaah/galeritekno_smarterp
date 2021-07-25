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
                                            
                                            <tr><td><a href="<?php echo base_url();?>eklinik/elektromedis/treadmill/cetakhasil/<?php echo $id;?>"><button id="cetak"  type="button" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Preview Hasil</button></a></td></tr>
											
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
												<a href="#TREADMILL" data-toggle="tab">HASIL PEMERIKSAAN TREADMILL</a>
								</li>
                            </ul>
						</div>
						<div class="panel-body p20 pb10">
							<div class="tab-content  pn br-n admin-form">
                                <div id="TREADMILL" class="tab-pane active">
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
					<label for="inputStandard" class="col-lg-3 control-label">File Treadmill </label>
					<div class="col-lg-6">
						<input type="file">
						
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
                                                    <div class="col-md-12">
                                                    
											<h4><U>Pre-Exercise Test </U></h4><br>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Indication</label>
												<div class="col-lg-6">
													<input id="indication" name="indication" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Respiration</label>
												<div class="col-lg-6">
													<input id="respiration" name="respiration" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Pre-Exercise BP</label>
												<div class="col-lg-3">
													<input id="preexercisebp_a" name="preexercisebp_a" class="form-control">
												/
													<input id="preexercisebp_b" name="preexercisebp_b" class="form-control" >
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Resting ECG</label>
												<div class="col-lg-6">
													<input id="restingecg" name="restingecg" class="form-control" >
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Heart Rate</label>
												<div class="col-lg-6">
													<input id="heartrate" name="heartrate" class="form-control">
												</div>
											</div>
											<h4><U>Exercise Test Summary </U></h4><br>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Exercise Time</label>
												<div class="col-lg-3">
													<input id="exercisetime_a" name="exercisetime_a" class="form-control">
												/
													<input id="exercisetime_b" name="exercisetime_b" class="form-control" >
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Aerobic Capacity</label>
												<div class="col-lg-6">
													<input id="aerobiccapacity" name="aerobiccapacity" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Max Heart-rate</label>
												<div class="col-lg-6">
													<input id="maxheartrate" name="maxheartrate" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">End Stage</label>
												<div class="col-lg-6">
													<input id="endstage" name="endstage" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Max Blood Pressure</label>
												<div class="col-lg-3">
													<input id="maxbloodpressure_a" name="maxbloodpressure_a" class="form-control">
												/
													<input id="maxbloodpressure_b" name="maxbloodpressure_b" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Target Heart Rate</label>
												<div class="col-lg-6">
													<input id="targetheartrate" name="targetheartrate" class="form-control" >
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Max Heart Rate %</label>
												<div class="col-lg-6">
													<input id="maxheartrate_persen" name="maxheartrate_persen" class="form-control">
												</div>
											</div>
                                                        <div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Premature Beat</label>
												<div class="col-lg-6">
													<input id="prematurebeat" name="prematurebeat" class="form-control" >
												</div>
											</div>
											
											<h4><U>Reason Of End</U></h4><br>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Reason Of End</label>
												<div class="col-lg-6">
													<select id="reasonofend" name="reasonofend"  class="form-control ">
														<option value="">- Pilih -</option>
														<option value="1" >Fatigue</option>
														<option value="2">Segment Changes</option>
														<option value="3">Dyspnoe</option>
														<option value="4">Angina</option>
														<option value="5">Maximum HR Reach</option>
														<option value="6">Dizzines</option>
													</select>
												</div>
											</div>
											<h4><U>ST-T Segment Changes</U></h4><br>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">ST-T Segment Changes</label>
												<div class="col-lg-6">
													<select id="sttsegmentchanges" name="sttsegmentchanges"  class="form-control ">
														<option value="">- Pilih -</option>
														<option value="1">No Changes</option>
														<option value="2">Upsloping</option>
														<option value="3">ST-Segment Depression 0,5-1 mm</option>
														<option value="4">Significant Changes (ST-Segment Depression > 1mm)</option>
													</select>
												</div>
											</div>
											<h4><U>Abnormal Lead : </U></h4><br>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Classification of Physical Fitness</label>
												<div class="col-lg-6">
													<select id="classificationofphysicalfitness" name="classificationofphysicalfitness"  class="form-control ">
														<option value="">- Pilih -</option>
														<option value="1">Low</option>
														<option value="2">Fair</option>
														<option value="3">Average</option>
														<option value="4">Good</option>
														<option value="5">High</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Blood Pressure response</label>
												<div class="col-lg-6">
													<select id="bloodpressureresponse" name="bloodpressureresponse"  class="form-control ">
														<option value="">- Pilih -</option>
														<option value="1">Normal Response</option>
														<option value="2">Hypertensive Response</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Functional Classification</label>
												<div class="col-lg-6">
													<select id="functionalclassification" name="functionalclassification"  class="form-control">
														<option value="">- Pilih -</option>
														<option value="1">Class I</option>
														<option value="2">Class II</option>
														<option value="3">Class III</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-2 control-label">Conclution/Medical</label>
												<div class="col-lg-6">
                                                    <select multiple="multiple" class="form-control select2" id="conclution" name="conclution[]"  class="form-control ">
														<option value="">- Pilih -</option>
														<option value="1" >Response Ischemic Positive</option>
														<option value="2" >Response Ischemic Negative</option>
														<option value="3" >Boderline Stress Line</option>
														<option value="4" >Indeterminate</option>
														<option value="5" >Fit To Work (Remote Area)</option>
														<option value="6" >Unfit To Work (Remote Area)</option>
													</select>
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
									url: '<?php echo base_url("eklinik/elektromedis/treadmill/getDokter") ?>',
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
									url: '<?php echo base_url("eklinik/elektromedis/treadmill/getPetugas") ?>',
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
								url: '<?php echo base_url("eklinik/elektromedis/treadmill/getData") ?>',
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
										$('#indication').val(data.indication);
										$('#respiration').val(data.respiration);
										$('#preexercisebp_a').val(data.preexercisebp_a);
										$('#preexercisebp_b').val(data.preexercisebp_b);
										$('#restingecg').val(data.restingecg);
										$('#heartrate').val(data.heartrate);
										$('#exercisetime_a').val(data.exercisetime_a);
										$('#exercisetime_b').val(data.exercisetime_b);
										$('#aerobiccapacity').val(data.aerobiccapacity);
										$('#maxheartrate').val(data.maxheartrate);
										$('#endstage').val(data.endstage);
										$('#maxbloodpressure_a').val(data.maxbloodpressure_a);
										$('#maxbloodpressure_b').val(data.maxbloodpressure_b);
										$('#maxheartrate_persen').val(data.maxheartrate_persen);
										$('#reasonofend').val(data.reasonofend);
										$('#sttsegmentchanges').val(data.sttsegmentchanges);
										$('#classificationofphysicalfitness').val(data.classificationofphysicalfitness);
										$('#bloodpressureresponse').val(data.bloodpressureresponse);
										$('#functionalclassification').val(data.functionalclassification);
										$('#conclution').val(data.conclution);
										$('#targetheartrate').val(data.targetheartrate);
										$('#prematurebeat').val(data.prematurebeat);
                                        
                                        
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
            var indication = $('#indication').val();
            var respiration = $('#respiration').val();
            var preexercisebp_a = $('#preexercisebp_a').val();
            var preexercisebp_b = $('#preexercisebp_b').val();
            var restingecg = $('#restingecg').val();
            var heartrate = $('#heartrate').val();
            var exercisetime_a = $('#exercisetime_a').val();
            var exercisetime_b = $('#exercisetime_b').val();
            var aerobiccapacity = $('#aerobiccapacity').val();
            var maxheartrate = $('#maxheartrate').val();
            var endstage = $('#endstage').val();
            var maxbloodpressure_a = $('#maxbloodpressure_a').val();
            var maxbloodpressure_b = $('#maxbloodpressure_b').val();
            var maxheartrate_persen = $('#maxheartrate_persen').val();
            var reasonofend = $('#reasonofend').val();
            var sttsegmentchanges = $('#sttsegmentchanges').val();
            var classificationofphysicalfitness = $('#classificationofphysicalfitness').val();
            var bloodpressureresponse = $('#bloodpressureresponse').val();
            var functionalclassification = $('#functionalclassification').val();
            var conclution = $('#conclution').val();
            var targetheartrate = $('#targetheartrate').val();
            var prematurebeat = $('#prematurebeat').val();

                
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
					indication: indication,
					respiration: respiration,
					preexercisebp_a: preexercisebp_a,
					preexercisebp_b: preexercisebp_b,
					restingecg: restingecg,
					heartrate: heartrate,
					exercisetime_a: exercisetime_a,
					exercisetime_b: exercisetime_b,
					aerobiccapacity: aerobiccapacity,
					maxheartrate: maxheartrate,
					endstage: endstage,
					maxbloodpressure_a: maxbloodpressure_a,
					maxbloodpressure_b: maxbloodpressure_b,
					maxheartrate_persen: maxheartrate_persen,
					reasonofend: reasonofend,
					sttsegmentchanges: sttsegmentchanges,
					classificationofphysicalfitness: classificationofphysicalfitness,
					bloodpressureresponse: bloodpressureresponse,
					functionalclassification: functionalclassification,
					conclution: conclution,
					targetheartrate: targetheartrate,
					prematurebeat: prematurebeat,
				

				}
				$.ajax({
					url: '<?php echo base_url("eklinik/elektromedis/treadmill/proses_act") ?>',
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