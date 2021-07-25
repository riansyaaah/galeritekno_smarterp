<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $title; ?></title>
	<link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/template/css/app.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/style.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/jquery-selectric/selectric.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/snackbar.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
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
					<div class="card">
						<div class="card-header">
							<h4><?= $title; ?></h4><hr>
						</div>
						<div class="card-body">
							<div id="header"></div>
							<div id="konten"></div>
						</div>
					</div>
                </section>
			</div>
			<div id="modal"></div>
			<div id="modal2"></div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
    </div>
    <script src="<?= base_url('assets/template/js/app.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/datatables.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/jquery-selectric/jquery.selectric.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/scripts.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/custom.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/toastr.js'); ?>"></script>
	<script>
		const baseUrl = '<?= base_url('eklinik/laboratorium/labcovid/') ?>'
		window.addEventListener('DOMContentLoaded', e => {
			let csfrData = {};
			const token = '<?= $this->security->get_csrf_token_name(); ?>';
			const hash = '<?= $this->security->get_csrf_hash(); ?>';
			csfrData[token] = hash;
			$.ajaxSetup({data: csfrData});
			renderUtama();
		});
		function renderUtama() {
			document.querySelector('#header').innerHTML = '';
			document.querySelector('#konten').innerHTML = tableUtamaHTML();
			document.querySelector('#modal').innerHTML = '';
			document.querySelector('#modal2').innerHTML = '';
			dataTableUtama();
		}
		function dataTableUtama() {
			$('#tableUtama').dataTable({
				destroy: true,
				ajax: {
					url: `${baseUrl}getlaboratorium`,
					dataSrc: 'data'
				},
				columns: [
					{"data": 'no'},
					{"data": 'namacabang'},
					{"data": 'tanggalkunjungan'},
					{"data": 'nomorregistrasi'},
					{"data": 'jenis'},
					{"data": 'nik'},
					{"data": 'nama'},
					{"data": 'alamat'},
					{"data": 'tanggalsampling'},
					{"data": 'tanggalperiksa'},
					{"data": 'tanggalselesai'},
					{"data": 'jenissample'},
					{"data": 'ncov'},
					{"data": 'lgg'},
					{"data": 'antigen'},
					{"data": 'catatan'},
					{"data": 'btn'}
				],
				"columnDefs": [{
					"sortable": false,
					"targets": [0, 16]
				}],
		        "createdRow": (row, data, index) => {
		        	$('td', row).eq(0).addClass('text-center');
		        	$('td', row).eq(2).addClass('text-center');
		        	$('td', row).eq(3).addClass('text-center');
		        	$('td', row).eq(8).addClass('text-center');
		        	$('td', row).eq(9).addClass('text-center');
		        	$('td', row).eq(10).addClass('text-center');
		        	$('td', row).eq(12).addClass('text-center');
		        }
			});
		}
		function showSnackError(text) {
			iziToast.error({
				title: 'Info',
				message: text,
				position: 'topRight'
			});
		}
		function success(text, aksi) {
			Swal.fire({
				title: 'Info',
				html: text,
				type: "success",
				confirmButtonText: 'Ok',
				confirmButtonColor: "#46b654",
			}).then((result) => {
				aksi();
			})
		}
		function tableUtamaHTML() {
			return `<div class="table-responsive">
				<table class="table table-bordered table-hover" id="tableUtama">
					<thead>
						<tr class="text-center">
							<th>No</th>
							<th>Cabang/Afiliasi</th>
							<th>Tanggal Kunjungan </th>
							<th>Registrasi</th>
							<th>Paket Pemeriksaan</th>
							<th>NIK</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Waktu Sampling </th>
							<th>Waktu Periksa </th>
							<th>Waktu Selesai Periksa </th>
							<th>Jenis Sample </th>
							<th>Swab Test / PCR </th>
							<th>Rapid Antibody </th>
							<th>Rapid Antigen </th>
							<th>Catatan </th>
							<th></th>
						</tr>
					</thead>
				</table>
			</div>`;
		}
	</script>
</body>
</html>