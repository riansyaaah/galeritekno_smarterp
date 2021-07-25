<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="<?= base_url('assets/template/css/app.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/style.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/snackbar.css'); ?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
	<style>
		.hidetd {
            display: none !important;
        }
        .widthFull {
        	width: 100%;
        }
	</style>
</head>
<body>
	<div class="loader"></div>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('layout/v_header'); ?>
			<?php $this->load->view('layout/v_menu'); ?>
			<div class="main-content">
				<section class="section">
						<div class="card">
							<div class="card-header">
								<div id="judulHalaman">
									<h4><?= $title; ?></h4>
								</div><hr>
								<h4 id="PeriodeActive">Periode Active : <?= $PeriodeActive; ?></h4>
							</div>
							<div class="card-body" id="utama"></div>
							<div class="card-body" id="bodyDetail"></div>
						</div>
				</section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
	</div>
	<script src="<?= base_url('assets/template/js/app.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>">
	</script>
	<script src="<?= base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/datatables.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/scripts.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/custom.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/toastr.js'); ?>"></script>
	<script>
		const level = <?= $level; ?>;
		$(document).ready(function() {
			let csfrData = {};
			csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
			halamanUtama();
		});

		function halamanUtama() {
			showLoading();
			document.querySelector('#utama').innerHTML = tableUtamaHTML();
			(level == 1)? tableUtama() : tableUtamaTanpaSupplier();
			dismisLoading();
			document.querySelector('#bodyDetail').innerHTML = '';
		}

		document.querySelector('#judulHalaman').addEventListener('click', e => {
			if(e.target.id == 'backBtn') {
				document.querySelector('#judulHalaman').innerHTML = judulHalamanHTML();
				halamanUtama()
			}
		})

		document.querySelector('#utama').addEventListener('click', e => {
			e.preventDefault();
			const bodyDetail = document.querySelector('#bodyDetail');
			id = bodyDetail.dataset.id;
			ecommerce = bodyDetail.dataset.ecommerce;
			type = (document.querySelector('#bodyDetail').dataset.type == 'Keluar')? 1 : 2;
			fetch(`<?= base_url('inventory/transaction/history/gettransactionbyid'); ?>?id=${id}&type=${type}&ecommerce=${ecommerce}`)
				.then(res => res.json())
				.then(res => {
					routingPage(e, id, res.data);
				});
		});

		function routingPage(e, id, data) {
			console.log(data)
			if(e.target.id == 'navTransaksi') {
				changePage(e, transaksiHTML(data));
			} else if(e.target.id == 'navSupplier') {
				changePage(e, supplierHTML(data));
			} else if(e.target.id == 'navDepartment') {
				changePage(e, departmentHTML(data));
			} else if(e.target.id == 'navDetailTransaksi') {
				changePage(e, detailHTML(data));
				tableDetail(id);
			} else if(e.target.id == 'navEcommerce') {
				changePage(e, ecommerceHTML(data));
			}
		}

		function changePage(e, html) {
			resetActive();
			e.target.classList.add('active');
			document.querySelector('#bodyDetail').innerHTML = html;
		}

		function resetActive() {
			const navLink = document.querySelectorAll('.nav-link');
			navLink.forEach(nav => {
				if(nav.classList.contains('active')) {
					nav.classList.remove('active');
				}
			});
		}

		function detail(id, type, ecommerce) {
			fetch(`<?= base_url('inventory/transaction/history/gettransactionbyid'); ?>?id=${id}&type=${type}&ecommerce=${ecommerce}`)
				.then(res => res.json())
				.then(res => {
					document.querySelector('#judulHalaman').innerHTML = backButtonHTML();
					document.querySelector('#utama').innerHTML = navHTML(type, ecommerce);
					document.querySelector('#navTransaksi').classList.add('active');
					const bodyDetail = document.querySelector('#bodyDetail');
					bodyDetail.innerHTML = transaksiHTML(res.data);
					bodyDetail.dataset.id = res.data.id;
					bodyDetail.dataset.ecommerce = ecommerce;
					bodyDetail.dataset.type = res.data.typeTransaction;
				});
		}

		function tableUtama() {
			$("#tableUtama").dataTable({
				destroy: true,
				ajax: {
					url: '<?= base_url('inventory/transaction/history/getalltransaction') ?>',
					dataSrc: 'data'
				},
				columns: [
					{"data": 'no'},
					{"data": 'noTransaction'},
					{"data": 'namaLengkap'},
					{"data": 'nama'},
					{"data": 'department'},
					{"data": 'tglTransaction'},
					{"data": 'typeTransaction'},
					{"data": 'option'}
				],
				"columnDefs": [
					{
						"sortable": false,
						"targets": [7]
					}
				],
		        "createdRow": (row, data, index) => {
		        	$('td', row).eq(0).addClass('text-center');
		        	$('td', row).eq(1).addClass('text-center');
		        	$('td', row).eq(5).addClass('text-center');
		        	$('td', row).eq(6).addClass('text-center');
		        	$('td', row).eq(7).addClass('text-center');
		        }
			});
		}

		function tableUtamaTanpaSupplier() {
			$("#tableUtama").dataTable({
				destroy: true,
				ajax: {
					url: '<?= base_url('inventory/transaction/history/getalltransaction') ?>',
					dataSrc: 'data'
				},
				columns: [
					{"data": 'no'},
					{"data": 'noTransaction'},
					{"data": 'namaLengkap'},
					{"data": 'department'},
					{"data": 'tglTransaction'},
					{"data": 'typeTransaction'},
					{"data": 'option'}
				],
				"columnDefs": [
					{
						"sortable": false,
						"targets": [6]
					}
				],
		        "createdRow": (row, data, index) => {
		        	$('td', row).eq(0).addClass('text-center');
		        	$('td', row).eq(1).addClass('text-center');
		        	$('td', row).eq(4).addClass('text-center');
		        	$('td', row).eq(5).addClass('text-center');
		        	$('td', row).eq(6).addClass('text-center');
		        }
			});
		}

		function tableDetail(id) {
			$("#tableDetail").dataTable({
				destroy: true,
				ajax: {
					url: `<?= base_url('inventory/transaction/history/gettrdetailbytrid') ?>?idTransaction=${id}`,
					dataSrc: 'data'
				},
				columns: [
					{"data": 'no'},
					{"data": 'itemmaster'},
					{"data": 'unit'},
					{"data": 'jumlah'},
					{"data": 'jumlah_act'},
					{"data": 'kondisimasuk'},
					{"data": 'harga_satuan'},
					{"data": 'total'}
				],
				"columnDefs": [
					{
						"sortable": false,
						"targets": [3, 4, 6, 7]
					},
					{
				        "targets": [6, 7],
				        "className": 'text-right'
				    }
				]
			});
		}

		function tableUtamaHTML() {
			return `<div class="table-responsive">
					<table class="table widthFull table-hover table-bordered table-striped" id="tableUtama">
						<thead>
							<th>No</th>
							<th>No Transaksi</th>
							<th>Nama</th>
							${(level == 1)? '<th>Supplier</th>' : ''}
							<th>Department</th>
							<th>Tanggal</th>
							<th>Tipe</th>
							<th style="width: 10%;"></th>
						</thead>
					</table>
				</div>`;
		}
		function judulNav(type, ecommerce) {
			let judul
			if(ecommerce == 1) {
				judul = 'Ecommerce';
			} else if(type == 1) {
				judul = 'Department';
			} else {
				judul = 'Supplier';
			}
			return judul;
		}
		function navHTML(type, ecommerce) {
			const target = judulNav(type, ecommerce);
			return `<ul class="nav nav-tabs">
				<li class="nav-item">
					<a href="#" class="nav-link" id="navTransaksi">Transaksi</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link" id="nav${target}">${target}</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link" id="navDetailTransaksi">Detail Transaksi</a>
				</li>
			</ul>`;
		}
		function supplierHTML(data) {
			return `<table class="table table-hover widthFull">
				<tr>
					<th style="width: 13%">Kode Supplier</td>
					<td style="width: 5%">:</td>
					<td>${data.kode}</td>
				</tr>
				<tr>
					<th>Nama Supplier</td>
					<td>:</td>
					<td>${data.nama}</td>
				</tr>
				<tr>
					<th>Alamat</td>
					<td>:</td>
					<td>${data.alamat}</td>
				</tr>
				<tr>
					<th>Contact Person</td>
					<td>:</td>
					<td>${data.cp}</td>
				</tr>
				<tr>
					<th>Nomor Telepon</td>
					<td>:</td>
					<td>${data.telp}</td>
				</tr>
				<tr>
					<th>Email</td>
					<td>:</td>
					<td>${data.email}</td>
				</tr>
			</table>`;
		}
		function ecommerceHTML(data) {
			return `<table class="table table-hover widthFull">
				<tr>
					<th style="width: 13%">Kode Toko</td>
					<td style="width: 5%">:</td>
					<td>${data.kode_toko}</td>
				</tr>
				<tr>
					<th>Nama Toko</td>
					<td>:</td>
					<td>${data.nama_toko}</td>
				</tr>
				<tr>
					<th>E-Commerce</td>
					<td>:</td>
					<td>${data.nama_ecommerce}</td>
				</tr>
			</table>`;
		}
		function departmentHTML(data) {
			return `<table class="table table-hover widthFull">
				<tr>
					<th style="width: 13%">Inisial</td>
					<td style="width: 5%">:</td>
					<td>${data.initial}</td>
				</tr>
				<tr>
					<th>Nama Department</td>
					<td>:</td>
					<td>${data.department}</td>
				</tr>
				<tr>
					<th>Deskripsi</td>
					<td>:</td>
					<td>${data.description}</td>
				</tr>
			</table>`;
		}
		function transaksiHTML(data) {
			return `<table class="table table-hover widthFull">
				<tr>
					<th style="width: 17%">Nomor Transaksi</td>
					<td style="width: 5%">:</td>
					<td>${data.noTransaction}</td>
				</tr>
				<tr>
					<th>Tanggal Transaksi</td>
					<td>:</td>
					<td>${data.tglTransaction}</td>
				</tr>
				<tr>
					<th>Tipe Transaksi</td>
					<td>:</td>
					<td>${data.typeTransaction}</td>
				</tr>
				<tr>
					<th>Nomor Purchase Order</td>
					<td>:</td>
					<td>${data.noPo}</td>
				</tr>
				<tr>
					<th>Surat Jalan</td>
					<td>:</td>
					<td>${(!data.suratJalan)? '-' : data.suratJalan}</td>
				</tr>
			</table>`;
		}
		function detailHTML(data) {
			return `<div class="table-responsive">
				<table class="table widthFull" id="tableDetail">
					<thead>
						<th>No</th>
						<th>Nama Item</th>
						<th>Unit</th>
						<th>Jumlah</th>
						<th>Jumlah Aktual</th>
						<th>Kondisi Masuk</th>
						<th>Harga Satuan</th>
						<th>Total</th>
					</thead>
					<tfoot class="bg-secondary">
						<tr>
							<th colspan="7" class="text-center">Total</th>
							<th class="text-right">${data.total}</th>
						</tr>
					</tfoot>
				</table>
			</div>`;
		}
		function backButtonHTML() {
			return `<button id="backBtn" class="btn btn-warning">
				<i class="fas fa-backward"></i> Kembali
			</button>`;
		}
		function judulHalamanHTML() {
			return '<h4><?= $title; ?></h4>';
		}
	</script>
</body>
</html>
