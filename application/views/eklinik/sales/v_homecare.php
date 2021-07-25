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
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/jquery-selectric/selectric.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css'); ?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
	<style>
		.input:focus {
			outline: none !important;
			border: 1px solid red;
			box-shadow: 0 0 10px #719ECE;
		}

		.red-border {
			border: 1px solid red !important;
		}

		input:required:focus {
			border: 1px solid red;
			outline: none;
		}
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
								<div class="card-body row">
									<div class="col-sm-2">
										<button class="btn btn-primary" onclick="addHomecare()"><i class="fa fa-plus"></i> Add Homecare</button>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<div class="loader" style="display:block"></div>
										<table class="table table-bordered table-hover" id="table-home-care" style="width: 100%;">
											<thead>
												<tr>
													<th width="150px">#</th>
													<th>No</th>
													<th>Tanggal Reservasi</th>
													<th>Waktu Kunjungan </th>
													<th>Homecare/Corporate</th>
													<th>Nama</th>
													<th>No HP</th>
													<th>Email</th>
													<th>Alamat</th>
													<th>Jumlah Peserta PCR</th>
													<th>Jumlah Peserta Rapid</th>
													<th>Jumlah Peserta Antigen</th>
													<th>Total Harga</th>
													<th>Status Proses</th>
													<th>Status Transaksi</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>


							<?php $this->load->view('eklinik/sales/v_homecare_detail'); ?>
						</div>
					</div>
				</section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>

		<!-- Add / Edit Homecare -->
		<div class="modal fade" id="editModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="headermodaltambah"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body row">
						<input type="hidden" id="edit_id" class="form-control">
						<div class="col-12">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead class="table-active">
										<tr>
											<th width="30%"></th>
											<th class="text-center" colspan="2">VALUE</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-right table-active" scope="col">Umum/Corporate</td>
											<td colspan="2">
												<div class="form-group"><label for=""></label>
													<select class="form-control" id="edit_tipe">
														<option value="">--PILIH--</option>
														<option value="UMUM">UMUM</option>
														<option value="CORPORATE">CORPORATE</option>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-right table-active" scope="col">Instansi</td>
											<td colspan="2">
												<div class="form-group"><label for=""></label>
													<select class="form-control" id="edit_instansi">
														<option value="">--PILIH--</option>
														<?php foreach ($instansi as $k) { ?>
															<option value="<?= $k['id']; ?>"><?= $k['instansi']; ?></option>
														<?php } ?>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-right table-active" scope="col">Waktu Kunjungan</td>
											<td>
												<div class="form-group"><label for=""></label>
													<input type="date" id="edit_tanggalkunjungan" class="form-control">
												</div>
											</td>
											<td>
												<div class="form-group"><label for=""></label>
													<select class="form-control" id="edit_jamkunjungan">
														<option value="">--Pilih--</option>
														<option value="6">06:00</option>
														<option value="7">07:00</option>
														<option value="8">08:00</option>
														<option value="9">09:00</option>
														<option value="10">10:00</option>
														<option value="11">11:00</option>
														<option value="12">12:00</option>
														<option value="13">13:00</option>
														<option value="14">14:00</option>
														<option value="15">15:00</option>
														<option value="16">16:00</option>
														<option value="17">17:00</option>
														<option value="18">18:00</option>
														<option value="19">19:00</option>
														<option value="20">20:00</option>
														<option value="21">21:00</option>
														<option value="22">22:00</option>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-right table-active" scope="col">Nama Lengkap *</td>
											<td colspan="2">
												<div class="form-group"><label for=""></label>
													<input type="text" id="edit_nama" class="form-control">
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-right table-active" scope="col">Nomor HP</td>
											<td colspan="2">
												<div class="form-group"><label for=""></label>
													<input type="text" maxlength="16" id="edit_nomorhp" class="form-control">
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-right table-active" scope="col">Email</td>
											<td colspan="2">
												<div class="form-group"><label for=""></label>
													<input type="email" id="edit_email" class="form-control">
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-right table-active" scope="col">Alamat</td>
											<td colspan="2">
												<div class="form-group"><label for=""></label>
													<textarea class="form-control" id="edit_alamat" cols="5" rows="2"></textarea>
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-right table-active" scope="col">Jumlah Peserta PCR</td>
											<td colspan="2">
												<div class="form-group"><label for=""></label>
													<input type="number" min="0" id="edit_pcr" class="form-control">
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-right table-active" scope="col">Jumlah Peserta Rapid</td>
											<td colspan="2">
												<div class="form-group"><label for=""></label>
													<input type="number" min="0" id="edit_rapid" class="form-control">
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-right table-active" scope="col">Jumlah Peserta Antigen</td>
											<td colspan="2">
												<div class="form-group"><label for=""></label>
													<input type="number" min="0" id="edit_antigen" class="form-control">
												</div>
											</td>
										</tr>
										<tr>
											<td class="text-right table-active" scope="col">Status Konfirmasi</td>
											<td colspan="2">
												<div class="form-group"><label for=""></label>
													<select class="form-control" id="edit_statuskonfirmasi">
														<option value="">--PILIH--</option>
														<option value="0">Belum Konfirmasi</option>
														<option value="1">Konfirmasi OK</option>
													</select>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-primary" onclick="save()" id="btnSave"><i class="fa fa-check"></i> Save</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Add / Edit Peserta Homecare -->
		<div class="modal fade" id="AddHomecareModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="AddHomecareHeaderModal"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="status_homecare" class="form-control">
						<input type="hidden" id="code_homecare" class="form-control">
						<div class="section-title" id="title_code"></div>

						<table class="table table-bordered table-hover">
							<thead class="table-active">
								<tr>
									<th width="30%"></th>
									<th class="text-center" colspan="2">VALUE</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="text-right table-active" scope="col">Tanggal Registrasi </td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<input type="date" readonly id="tanggal_registrasi" class="form-control" value="<?= date('d-m-Y'); ?>">
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">Nomor Registrasi</td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<input type="text" class="form-control" readonly id="nomor_registrasi" value="">
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">Paket Pemeriksaan</td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<select class="form-control" id="paket_pemeriksaan">
												<option value="">--PILIH--</option>
												<?php foreach ($pemerisaan_data as $pemeriksaan) : ?>
													<option value="<?= $pemeriksaan['id']; ?>"><?= $pemeriksaan['keterangan']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">NIK</td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<input type="text" maxlength="16" id="nik" class="form-control">
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">Nomor Pegawai</td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<input type="text" id="nomor_pegawai" class="form-control">
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">Nama Lengkap *</td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<input type="text" id="nama_lengkap" class="form-control">
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">Jenis Kelamin</td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<select class="form-control" id="jenis_kelamin">
												<option value="">--PILIH--</option>
												<option value="Pria">Pria</option>
												<option value="Wanita">Wanita</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">Email</td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<input type="email" id="email" class="form-control">
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">Alamat</td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<textarea class="form-control" id="alamat" cols="5" rows="2"></textarea>
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">Faskes Asal</td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<select class="form-control" id="fakses_asal">
												<option value="">--PILIH FASKES--</option>
												<?php foreach ($faskes_data as $faskes) : ?>
													<option value="<?= $faskes['id']; ?>"><?= $faskes['namafaskes']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">Instansi</td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<select class="form-control" id="instansi">
												<option value="">--PILIH INSTANSI--</option>
												<?php foreach ($instansi_data as $instansi) : ?>
													<option value="<?= $instansi['id']; ?>"><?= $instansi['instansi']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">PIC Marketing </td>
									<td>
										<div class="form-group"><label for=""></label>
											<select class="form-control" id="pic_marketing">
												<option value="">--PILIH PIC MARKETING--</option>
												<?php foreach ($marketer_data as $marketer) : ?>
													<option value="<?= $marketer['id']; ?>"><?= $marketer['nama']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">Cara Pembayaran</td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<select class="form-control" id="cara_bayar">
												<option value="">--PILIH CARA PEMBAYARAN--</option>
												<option value="Invoice">Invoice</option>
												<option value="Belum Lunas">Belum Lunas</option>
												<option value="Lunas">Lunas</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td class="text-right table-active" scope="col">Catatan </td>
									<td colspan="2">
										<div class="form-group"><label for=""></label>
											<textarea class="form-control" id="catatan" cols="5" rows="2"></textarea>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="addPesertaHomecareBtn" onclick="return savePesertaHomecare()">
							<i class="fa fa-check"></i> SAVE
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					</div>
				</div>
			</div>
		</div>




		<script src="<?php echo base_url('assets/template/js/app.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/datatables.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/jquery-selectric/jquery.selectric.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/scripts.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/custom.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/toastr.js'); ?>"></script>

		<script>
			$(document).ready(function() {
				$("#nama_lengkap").change(function() {
					$("#nama_lengkap").removeClass('red-border');
				});
				$("#table-home-care").dataTable({
					destroy: true,
					ajax: {
						url: '<?php echo base_url("eklinik/sales/Homecare/getHomecare") ?>',
						dataSrc: 'data'
					},
					columns: [{
							"data": 'option'
						},
						{
							"data": 'no',
						},
						{
							"data": 'created_date',
						},
						{
							"data": 'tanggal',
						},
						{
							"data": 'tipe',
						},
						{
							"data": 'nama',
						},
						{
							"data": 'nomorhp',
						},
						{
							"data": 'email',
						},
						{
							"data": 'alamat',
						},
						{
							"data": 'jumlahpasienpcr',
						},
						{
							"data": 'jumlahpasienrapid',
						},
						{
							"data": 'jumlahpasienantigen',
						},
						{
							"data": 'totalharga',
						},
						{
							"data": 'isproses',
						},
						{
							"data": 'statustransaksi',
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [0, 14]
					}]
				});
				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});

			});


			function editHomecare(id) {
				dataPost = {
					id: id
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("eklinik/sales/Homecare/getSingleHomecare") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#edit_id').val(data.id);
							$('#edit_tipe').val(data.tipe);
							$('#edit_instansi').val(data.idperusahaan);
							$('#edit_tanggalkunjungan').val(data.tanggalkunjungan);
							$('#edit_jamkunjungan').val(data.jamkunjungan);
							$('#edit_pcr').val(data.jumlahpasienpcr);
							$('#edit_rapid').val(data.jumlahpasienrapid);
							$('#edit_antigen').val(data.jumlahpasienantigen);
							$('#edit_nama').val(data.nama);
							$('#edit_nomorhp').val(data.nomorhp);
							$('#edit_email').val(data.email);
							$('#edit_alamat').val(data.alamat);
							$('#edit_statuskonfirmasi').val(data.isproses);
							dismisLoading();
							document.getElementById("headermodaltambah").innerHTML = 'EDIT RESERVASI HOMECARE';
							$("#editModal").modal();
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

			function addHomecare() {
				document.getElementById('edit_id').value = ""
				document.getElementById('edit_tipe').value = ""
				document.getElementById('edit_instansi').value = ""
				document.getElementById('edit_tanggalkunjungan').value = ""
				document.getElementById('edit_jamkunjungan').value = ""
				document.getElementById('edit_nama').value = ""
				document.getElementById('edit_nomorhp').value = ""
				document.getElementById('edit_email').value = ""
				document.getElementById('edit_alamat').value = ""
				document.getElementById('edit_pcr').value = ""
				document.getElementById('edit_rapid').value = ""
				document.getElementById('edit_antigen').value = ""
				document.getElementById('edit_statuskonfirmasi').value = ""
				document.getElementById("headermodaltambah").innerHTML = 'ADD RESERVASI HOMECARE';
				$("#editModal").modal();
			}

			function save() {
				var id = $('#edit_id').val();
				var tipe = $('#edit_tipe').val();
				var idperusahaan = $('#edit_instansi').val();
				var tanggalkunjungan = $('#edit_tanggalkunjungan').val();
				var jamkunjungan = $('#edit_jamkunjungan').val();
				var nama = $('#edit_nama').val();
				var nomorhp = $('#edit_nomorhp').val();
				var email = $('#edit_email').val();
				var alamat = $('#edit_alamat').val();
				var jumlahpasienpcr = $('#edit_pcr').val();
				var jumlahpasienantigen = $('#edit_rapid').val();
				var jumlahpasienrapid = $('#edit_antigen').val();
				var isproses = $('#edit_statuskonfirmasi').val();

				if (nama == "" || nama == null) {
					showSnackError("Harap isi nama");
				} else {
					showLoading();
					var btn = document.getElementById("btnSave");
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						id: id,
						tipe: tipe,
						idperusahaan: idperusahaan,
						tanggalkunjungan: tanggalkunjungan,
						jamkunjungan: jamkunjungan,
						nama: nama,
						nomorhp: nomorhp,
						email: email,
						alamat: alamat,
						jumlahpasienpcr: jumlahpasienpcr,
						jumlahpasienantigen: jumlahpasienantigen,
						jumlahpasienrapid: jumlahpasienrapid,
						isproses: isproses,
					}

					$.ajax({
						url: '<?php echo base_url("eklinik/sales/Homecare/saveHomecare") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								success(res.remarks);
							} else {
								btn.value = 'Save';
								btn.innerHTML = 'Save';
								btn.disabled = false;
								showSnackError(res.remarks);
								dismisLoading();
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							dismisLoading();
							btn.value = 'Gagal, Coba lagi';
							btn.innerHTML = 'Gagal, Coba lagi';
							btn.disabled = false;
						},
						timeout: 60000
					});
				}
			}

			function detail(id) {

				showLoading();
				$("#divTable").css("display", "none");
				$("#divTableDetail").css("display", "block");

				dataPost = {
					id: id
				}
				$.ajax({
					url: '<?php echo base_url("eklinik/sales/Homecare/getSingleHomecare") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#detail-homecare').val(data.id);
							$('#detail_tipe').html(data.tipe);
							$('#detail_tanggal_kunjungan').html(data.tanggalkunjungan);
							$('#edit_jamkunjungan').html(data.jamkunjungan);
							$('#detail_nama').html(data.nama);
							$('#detail_no_hp').html(data.nomorhp);
							$('#detail_total_harga').html(data.totalharga);
							loadDetailData();
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

			function back() {
				$("#divTable").css("display", "block");
				$("#divTableDetail").css("display", "none");

				$('#detail_tipe').html('');
				$('#detail_tanggal_kunjungan').html('');
				$('#detail_nama').html('');
				$('#detail_no_hp').html('');
				$('#detail_total_harga').html('');
				$('#table-home-care-detail').DataTable().clear();
				$('#table-home-care-detail').DataTable().destroy();
			}

			function addPerson() {
				Date.prototype.toDateInputValue = (function() {
					var local = new Date(this);
					local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
					return local.toJSON().slice(0, 10);
				});
				document.getElementById('tanggal_registrasi').value = new Date().toDateInputValue();

				$('#status_homecare').val('tambah');
				document.getElementById("addPesertaHomecareBtn").innerHTML = '<i class="fa fa-check"></i> SAVE';
				document.getElementById("addPesertaHomecareBtn").disabled = false;
				// document.getElementById('tanggal_registrasi').value = ""
				document.getElementById('nomor_registrasi').value = ""
				document.getElementById('paket_pemeriksaan').value = ""
				document.getElementById('nik').value = ""
				document.getElementById('nomor_pegawai').value = ""
				document.getElementById('nama_lengkap').value = ""
				document.getElementById('jenis_kelamin').value = ""
				document.getElementById('email').value = ""
				document.getElementById('fakses_asal').value = ""

				$("#staff_name").removeClass("is-invalid");

				document.getElementById("AddHomecareHeaderModal").innerHTML = "Registrasi Peserta Homecare Baru";

				$("#AddHomecareModal").modal();
			}

			function savePesertaHomecare() {
				var id = $('#code_homecare').val();
				var tanggal_registrasi = $('#tanggal_registrasi').val();
				var nomor_registrasi = $('#nomor_registrasi').val();
				var paket_pemeriksaan = $('#paket_pemeriksaan').val();
				var nik = $('#nik').val();
				var nomor_pegawai = $('#nomor_pegawai').val();
				var nama_lengkap = $('#nama_lengkap').val();
				var jenis_kelamin = $('#jenis_kelamin').val();
				var email = $('#email').val();
				var fakses_asal = $('#fakses_asal').val();
				var instansi = $('#instansi').val();
				var pic_marketing = $('#pic_marketing').val();
				var cara_bayar = $('#cara_bayar').val();
				var status_homecare = $('#status_homecare').val();

				if (nama_lengkap == "" || nama_lengkap == null) {
					$("#nama_lengkap").focus();
					// $("#nama_lengkap").addClass("is-invalid");
					$("#nama_lengkap").addClass('red-border');
					showSnackError("Nama lengkap harap diisi");
				} else {
					showLoading();
					var btn = document.getElementById("addPesertaHomecareBtn");
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						id: id,
						tanggal_registrasi: tanggal_registrasi,
						nomor_registrasi: nomor_registrasi,
						paket_pemeriksaan: paket_pemeriksaan,
						nik: nik,
						nomor_pegawai: nomor_pegawai,
						nama_lengkap: nama_lengkap,
						jenis_kelamin: jenis_kelamin,
						email: email,
						fakses_asal: fakses_asal,
						instansi: instansi,
						pic_marketing: pic_marketing,
						cara_bayar: cara_bayar,
						status_homecare: status_homecare,
					}

					$.ajax({
						url: '<?php echo base_url("eklinik/sales/Homecare/saveHomecarePerson") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								success(res.remarks);
							} else {
								btn.value = 'Save';
								btn.innerHTML = 'Save';
								btn.disabled = false;
								showSnackError(res.remarks);
								dismisLoading();
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							dismisLoading();
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
