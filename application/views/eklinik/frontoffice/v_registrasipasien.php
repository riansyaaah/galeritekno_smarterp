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
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/jquery.treegrid.css');?>">
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
									<h4><?= $title; ?></h4>
									<hr>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="useremail">No.RM</label>
												<div class="input-group">
													<input type="hidden" class="form-control" name="statusdata" readonly>
													<input type="text" class="form-control" name="norekammedik" readonly>
													<span class="input-group-append">
														<button onclick="cariPasien()" class="btn btn-primary" type="button"><i class="fa fa-search"></i> Cari</button>
													</span>
												</div>
											</div>
										</div>
										<div class="col-md-2" style="margin-top:2px" id="btn_new_Pasien">
											<label for="useremail"> &nbsp; &nbsp; &nbsp; </label>
											<span>
												<a onclick="return newPasien()">
													<button class="btn btn-block btn-success" type="button"><i class="fa fa-plus"></i> Buat Baru</button>
												</a>
											</span>
										</div>
									</div>
									<hr>

									<!-- Start Form -->
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label for="norm">No RM</label>
												<input type="text" id="norm" class="form-control" name="norm">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="tanggal_rm">Tanggal RM </label>
												<div class="input-group date">
													<input type="date" class="form-control" id="tanggal_rm" name="tanggal_rm" required>
												</div>
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label for="nik">NIK / ID</label>
												<input type="text" class="form-control" name="nik" id="nik" required>
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label for="jeniskelamin">Jenis Kelamin </label>
												<select id="jeniskelamin" class="custom-select" name="jeniskelamin" required>
													<option>- Pilih Jenis Kelamin -</option>
													<option value="1">Laki - laki</option>
													<option value="2">Perempuan</option>
													<option value="3">Anak-Anak (Laki - Laki)</option>
													<option value="4">Anak-Anak (Perempuan)</option>
												</select>
											</div>
										</div>

										<div class="col-md-2">
											<div class="form-group">
												<label for="tempatlahir">Sebutan </label>
												<div class="row">
													<div class="col-md-12">
														<select id="nama_sebutan" class="custom-select" name="nama_sebutan" required>
															<option <?php if (isset($nama_sebutan) and $nama_sebutan == 'TN') {
																				echo "selected";
																			} ?> value="TN">TN</option>
															<option <?php if (isset($nama_sebutan) and $nama_sebutan == 'NY') {
																				echo "selected";
																			} ?> value="NY">NY</option>
															<option <?php if (isset($nama_sebutan) and $nama_sebutan == 'NN') {
																				echo "selected";
																			} ?> value="NN">NN</option>
															<option <?php if (isset($nama_sebutan) and $nama_sebutan == 'AN') {
																				echo "selected";
																			} ?> value="AN">AN</option>
															<option <?php if (isset($nama_sebutan) and $nama_sebutan == 'BY') {
																				echo "selected";
																			} ?> value="BY">BY</option>
															<option <?php if (isset($nama_sebutan) and $nama_sebutan == 'SDR') {
																				echo "selected";
																			} ?> value="SDR">SDR</option>
															<option <?php if (isset($nama_sebutan) and $nama_sebutan == 'SDRi') {
																				echo "selected";
																			} ?> value="SDRi">SDRi</option>
															<option <?php if (isset($nama_sebutan) and $nama_sebutan == 'H') {
																				echo "selected";
																			} ?> value="H">H</option>
															<option <?php if (isset($nama_sebutan) and $nama_sebutan == 'Hj') {
																				echo "selected";
																			} ?> value="Hj">Hj</option>
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="tempatlahir">Nama Lengkap </label>
												<div class="row">
													<div class="col-md-12">
														<input type="text" id="nama" class="form-control" name="nama" required>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="tempatlahir">Tempat, Tanggal Lahir </label>
												<div class="row">
													<div class="col-md-6">
														<input type="text" id="tempatlahir" class="form-control" name="tempatlahir">
													</div>
													<div class="col-md-6">
														<input type="date" class="form-control" id="tanggallahir" name="tanggallahir" required>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label for="umur">Umur</label>
												<input type="number" class="form-control" name="umur" min="0" id="umur" required>
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label for="golongan_darah">Golongan Darah </label>
												<select id="golongan_darah" class="custom-select" name="golongan_darah">
													<option value="">- Pilih Golongan Darah -</option>
													<option value="A">A</option>
													<option value="B">B</option>
													<option value="AB">AB</option>
													<option value="O">O</option>
												</select>
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label for="email">Email</label>
												<input type="email" id="email" class="form-control" name="email">
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label for="nomorhp">No Handphone</label>
												<input type="text" id="nomorhp" class="form-control" maxlength="15" name="nomorhp">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="alamat">Alamat</label>
												<textarea class="form-control" id="alamat" rows="4" name="alamat"></textarea>
											</div>
										</div>
									</div>
                                    <hr>

									<div class="row">
										<div class="col-md-12 mt-3 mb-2">
											<h4>Data Pendaftaran</h4>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="no_registrasi">No Registrasi</label>
												<input type="text" id="nomorregistrasi" class="form-control" readonly>
											</div>
                                            <div class="form-group">
												<label for="jenis_layanan">Jenis Layanan</label>
												<select id="jenis_layanan" class="form-control select2"  required>
                                                    <option value="WalkIn">WalkIn</option>
												</select>
											</div>
											
											
                                            
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label for="tanggal_registrasi">Tanggal Registrasi</label>
												<input type="date" id="tanggalregistrasi" class="form-control">
											</div>
											<div class="form-group">
												<label for="jenis_registrasi">Jenis Registrasi</label>
												<select id="jenis_registrasi" class="form-control select2" onchange="onChangeJenisRegistrasi()" required>
												</select>
											</div>
										</div>

										<div class="col-md-3">
											 <div class="form-group">
												<label for="tanggalkunjungan">Tanggal Kunjungan</label>
												<input type="date" id="tanggalkunjungan" class="form-control">
											</div>
											<div id="rawatjalan" style='display:none;'>
											<div class="form-group">
												<label for="poliklinik_select">Poliklinik</label>
												<select id="poliklinik_select" class="form-control select2" onchange="onChangeJenisPoliklinik()" required>
												</select>
											</div>
											 <div class="form-group">
												<label for="dokter_select">Dokter</label>
												<select id="dokter_select" class="form-control select2" required>
												</select>
											</div>
                                            </div>
                                            <div id="laboratorium" style='display:none;'>
                                            <div class="form-group">
												<label for="laboratorium_select">Laboratorium</label>
												<table class="table table-striped tree">
													<tbody>
														<?php foreach($getitem as $g){?>
															<tr class="<?php echo 'treegrid-'.str_replace('.','_',$g['id']); if($g['level']!='KELOMPOK'){echo ' treegrid-parent-'.str_replace('.','_',$g['id_paren']);}?>">
																<td>
																	<input name="iddetail[]" type="checkbox" value="<?php echo $g['id'];?>">&nbsp;&nbsp;&nbsp;<font size="2"><?php echo $g['nama_item'];?></font>
																</td>
															</tr>
														<?php } ?>
													</tbody>
	                                            </table>
											</div>
                                            </div>
                                            <div id="elektromedis" style='display:none;'>
                                            <div class="form-group">
												<label for="elektromedis_select">Elektromedis</label>
												<select id="elektromedis_select" class="form-control select2" required>
													
												</select>
											</div>
                                            </div>
                                            <div id="radiologi" style='display:none;'>
                                            <div class="form-group">
												<label for="radiologi_select">Radiologi</label>
												<select id="radiologi_select" class="form-control select2" required>
													
												</select>
											</div>
                                            </div>
                                            <div id="mcu" style='display:none;'>
											<div class="form-group">
												<label for="mcu_select">Paket MCU</label>
												<select id="mcu_select" class="form-control select2" required>
													
												</select>
											</div>
                                            </div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label for="jamkunjungan">Jam Kunjungan</label>
												<input type="time" id="jamkunjungan" class="form-control">
											</div>
                                            
                                            
										</div>
									</div>

									<hr>
									<h4>Data Jenis Pembiayaan</h4>
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label for="biaya_administrasi">Biaya Administrasi</label>
												<input type="text" id="biaya_administrasi" class="form-control" name="biaya_administrasi">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="jenis_pelayanan">Metode Bayar</label>
												<select class="custom-select" id="metodebayar">
													<option value="">Pilih salah satu</option>
													<option value="Cash">Cash</option>
													<option value="Cash">Jaminan</option>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="nama_penjamin">Perusahaan Penjamin</label>
												<select class="custom-select" id="idpenjamin">
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="no_kartu_asuransi">No Kartu Asuransi</label>
												<input type="text" id="nokartu_jaminan" class="form-control" name="nokartu_jaminan">
											</div>
										</div>
									</div>
									<input type="hidden" id="StatusPasien">
									<div class="row text-right">
										<div class="col-md-12">
											<button type="button" class="btn btn-lg btn-primary" id="btn_save_pasien" onclick="return PasienBaru()"><i class="fa fa-check"></i> Save Pasien</button>
										</div>
									</div>
									<!-- End Form -->
								</div>
							</div>
						</div>
					</div>
                    
                </section>
		</div>
		<?php $this->load->view('layout/v_footer'); ?>
	</div>


	<!-- Modal Registers Table -->
	<div class="modal fade" id="cariPasien" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Data Pasien</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-hover" id="table-pasien" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">No Rm</th>
								<th class="text-center">Tanggal Rm</th>
								<th class="text-center">NIK</th>
								<th class="text-center">nama</th>
								<th class="text-center">jeniskelamin</th>
								<th class="text-center">#</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal Registers Table -->

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
            <script src="<?php echo base_url('assets/template/js/jquery.treegrid.js');?>"></script>

	<script>
		$(document).ready(function() {
			document.getElementById("StatusPasien").value = 'New';
			document.getElementById("btn_new_Pasien").style.display = "none";
			var csfrData = {};
			csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
            $('.tree').treegrid({
                'initialState': 'collapsed',
                    expanderExpandedClass: 'fa fa-minus',
                    expanderCollapsedClass: 'fa fa-plus'
        });
            $("#jenis_registrasi").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("eklinik/frontoffice/registrasipasien/getJenisRegistrasi") ?>',
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
                                return {id: item.id, text: item.jenis };
                            });
                            return {
                                results: result
                            };
                        }
                    },
                });
            $("#idpenjamin").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("eklinik/frontoffice/registrasipasien/getPenjamin") ?>',
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
        
        function onChangeJenisRegistrasi(){
            jenis_registrasi = $('#jenis_registrasi').val();
            if(jenis_registrasi == '1'){
                $('#rawatjalan').show();
				$('#mcu').hide();
				$('#laboratorium').hide();
				$('#elektromedis').hide();
				$('#radiologi').hide();
                
            $("#poliklinik_select").empty().trigger('change');
            $("#poliklinik_select").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("eklinik/frontoffice/registrasipasien/getJenisPoliklinik") ?>',
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
            }
            if(jenis_registrasi == '2'){
                $('#rawatjalan').hide();
				$('#mcu').show();
				$('#laboratorium').hide();
				$('#elektromedis').hide();
				$('#radiologi').hide();
                
            $("#mcu_select").empty().trigger('change');
            $("#mcu_select").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("eklinik/frontoffice/registrasipasien/getPaketMcu") ?>',
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
                                return {id: item.id, text: item.namapaket };
                            });
                            return {
                                results: result
                            };
                        }
                    },
                });
            }
            if(jenis_registrasi == '3'){
                $('#rawatjalan').hide();
				$('#mcu').hide();
				$('#laboratorium').show();
				$('#elektromedis').hide();
				$('#radiologi').hide();
                
            $("#laboratorium_select").empty().trigger('change');
            $("#laboratorium_select").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("eklinik/frontoffice/registrasipasien/getItemPeriksa") ?>',
                        dataType: 'json',
                        type: "GET",
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                iditem : '1'
                            };
                        },
                        processResults: function (res, params) {
                            var result = res.data.map(function (item) {
                                return {id: item.id, text: item.nama_item };
                            });
                            return {
                                results: result
                            };
                        }
                    },
                });
            }
            if(jenis_registrasi == '4'){
                $('#rawatjalan').hide();
				$('#mcu').hide();
				$('#laboratorium').hide();
				$('#elektromedis').show();
				$('#radiologi').hide();
                
            $("#elektromedis_select").empty().trigger('change');
            $("#elektromedis_select").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("eklinik/frontoffice/registrasipasien/getItemPeriksa") ?>',
                        dataType: 'json',
                        type: "GET",
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                iditem : '2'
                            };
                        },
                        processResults: function (res, params) {
                            var result = res.data.map(function (item) {
                                return {id: item.id, text: item.nama_item };
                            });
                            return {
                                results: result
                            };
                        }
                    },
                });
            }
            if(jenis_registrasi == '5'){
                $('#rawatjalan').hide();
				$('#mcu').hide();
				$('#laboratorium').hide();
				$('#elektromedis').hide();
				$('#radiologi').show();
                
            $("#radiologi_select").empty().trigger('change');
            $("#radiologi_select").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("eklinik/frontoffice/registrasipasien/getItemPeriksa") ?>',
                        dataType: 'json',
                        type: "GET",
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                iditem : '3'
                            };
                        },
                        processResults: function (res, params) {
                            var result = res.data.map(function (item) {
                                return {id: item.id, text: item.nama_item };
                            });
                            return {
                                results: result
                            };
                        }
                    },
                });
            }
        }
        function onChangeJenisPoliklinik(){
                $("#dokter_select").empty().trigger('change');
            $("#dokter_select").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("eklinik/frontoffice/registrasipasien/getDokterPoli") ?>',
                        dataType: 'json',
                        type: "GET",
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                idpoli : $('#poliklinik_select').val()
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
        }
        
        
		// Cari pasien terdaftar
		function cariPasien() {
			showLoading();
			$("#table-pasien").dataTable({
				destroy: true,
				ajax: {
					url: '<?php echo base_url("eklinik/frontoffice/Registrasipasien/getPasien") ?>',
					dataSrc: 'data'
				},
				columns: [{
						"data": 'norm',
					}, {
						"data": 'tanggal_rm',
					},
					{
						"data": 'nik'
					},
					{
						"data": 'nama'
					},
					{
						"data": 'jeniskelamin'
					},
					{
						"data": 'option'
					}
				],
				"columnDefs": [{
					"sortable": false,
					"targets": [5]
				}]
			});

			dismisLoading();
			$("#cariPasien").modal();

			$('#table-pasien tbody').on('click', 'tr', function() {

				document.getElementById("StatusPasien").value = 'Edit';
				event.preventDefault();
				var $td = $(this).closest('tr').children('td');

				var norm = $td.eq(0).text();
				var tanggal_rm = $td.eq(2).text();
				var nama = $td.eq(3).text();
				var jeniskelamin = $td.eq(4).text();

				document.getElementById("norm").value = norm;
				document.getElementById("tanggal_rm").value = nik;
				document.getElementById("nama").value = nama;
				document.getElementById("jeniskelamin").value = jeniskelamin;
				PasienCari();

				$('#cariPasien').modal('hide');

				document.getElementById("btn_new_Pasien").style.display = "block";
			});
		}


		function PasienCari() {
			showLoading();
			norm = document.getElementById("norm").value;
			dataPost = {
				norm: norm,
			}
			$.ajax({
				url: '<?php echo base_url("eklinik/frontoffice/Registrasipasien/getPasienbyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#norm').val(data[0]['norm']);
						$('#tanggal_rm').val(data[0]['tanggal_rm']);
						$('#nik').val(data[0]['nik']);
						$('#nama_sebutan').val(data[0]['nama_sebutan']);
						$('#nama').val(data[0]['nama']);
						$('#jeniskelamin').val(data[0]['jeniskelamin']);
						$('#tanggallahir').val(data[0]['tanggallahir']);
						$('#tempatlahir').val(data[0]['tempatlahir']);
						$('#umur').val(data[0]['umur']);
						$('#golongan_darah').val(data[0]['golongan_darah']);
						$('#nomorhp').val(data[0]['nomorhp']);
						$('#email').val(data[0]['email']);
						$('#alamat').val(data[0]['alamat']);

						dismisLoading();
						document.getElementById("norm").readOnly = true;
						// document.getElementById("btn_new_pasien").disabled = false;
					} else {
						showSnackError(res.remarks);
						dismisLoading();
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					showSnackError(XMLHttpRequest);
					dismisLoading();
				},
				timeout: 60000
			});
		}

		// Button newPasien
		function newPasien() {
			document.getElementById("StatusPasien").value = 'New';
			document.getElementById("norm").value = "";
			document.getElementById("norm").readOnly = false;
			document.getElementById("tanggal_rm").value = "";
			document.getElementById("nik").value = "";
			document.getElementById("nama_sebutan").value = "";
			document.getElementById("nama").value = "";
			document.getElementById("jeniskelamin").value = "";
			document.getElementById("tanggallahir").value = "";
			document.getElementById("tempatlahir").value = "";
			document.getElementById("umur").value = "";
			document.getElementById("golongan_darah").value = "";
			document.getElementById("nomorhp").value = "";
			document.getElementById("email").value = "";
			document.getElementById("alamat").value = "";

			document.getElementById("btn_new_Pasien").style.display = "none";
		}


		// Add new Pasien
		function PasienBaru() {
			var btn = document.getElementById("btn_save_pasien");
			var StatusPasien = $('#StatusPasien').val();

			var norm = $('#norm').val();
			var tanggal_rm = $('#tanggal_rm').val();
			var nik = $('#nik').val();
			var nama_sebutan = $('#nama_sebutan').val();
			var nama = $('#nama').val();
			var jeniskelamin = $('#jeniskelamin').val();
			var tanggallahir = $('#tanggallahir').val();
			var tempatlahir = $('#tempatlahir').val();
			var umur = $('#umur').val();
			var golongan_darah = $('#golongan_darah').val();
			var nomorhp = $('#nomorhp').val();
			var email = $('#email').val();
			var alamat = $('#alamat').val();
			var nomorregistrasi = $('#nomorregistrasi').val();
			var tanggalregistrasi = $('#tanggalregistrasi').val();
			var jenis_registrasi = $('#jenis_registrasi').val();
			var jenis_layanan = $('#jenis_layanan').val();
			var tanggalkunjungan = $('#tanggalkunjungan').val();
			var jamkunjungan = $('#jamkunjungan').val();
			var poliklinik_select = $('#poliklinik_select').val();
			var dokter_select = $('#dokter_select').val();
            
			var mcu_select = $('#mcu_select').val();
			var elektromedis_select = $('#elektromedis_select').val();
			var radiologi_select = $('#radiologi_select').val();
			var idpenjamin = $('#idpenjamin').val();
			var biaya_administrasi = $('#biaya_administrasi').val();
			var metodebayar = $('#metodebayar').val();
			var nokartu_jaminan = $('#nokartu_jaminan').val();

            var data = new Array();
                    $("input:checked").each(function() {
                      data.push($(this).val());
                    });
            
			if (norm == "" || norm == null || nik == "" || nik == null || tanggalkunjungan == "" || tanggalkunjungan == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					StatusPasien: StatusPasien,

					norm: norm,
					tanggal_rm: tanggal_rm,
					nik: nik,
					nama_sebutan: nama_sebutan,
					nama: nama,
					jeniskelamin: jeniskelamin,
					tanggallahir: tanggallahir,
					tempatlahir: tempatlahir,
					umur: umur,
					golongan_darah: golongan_darah,
					nomorhp: nomorhp,
					email: email,
					alamat: alamat,
					nomorregistrasi: nomorregistrasi,
					tanggalregistrasi: tanggalregistrasi,
					jenis_registrasi: jenis_registrasi,
					jenis_layanan: jenis_layanan,
					tanggalkunjungan: tanggalkunjungan,
					jamkunjungan: jamkunjungan,
					poliklinik_select: poliklinik_select,
					dokter_select: dokter_select,
                    
					mcu_select: mcu_select,
					elektromedis_select: elektromedis_select,
					radiologi_select: radiologi_select,
					idpenjamin: idpenjamin,
					biaya_administrasi: biaya_administrasi,
					metodebayar: metodebayar,
					nokartu_jaminan: nokartu_jaminan,
                    
					data: data,

				}
				$.ajax({
					url: '<?php echo base_url("eklinik/frontoffice/Registrasipasien/addPasien") ?>',
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
</body>

</html>