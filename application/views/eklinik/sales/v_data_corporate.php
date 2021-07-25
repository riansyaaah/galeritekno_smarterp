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
		.custom-select-sm {
			height: calc(1.5em + 0.5rem + 2px);
			padding-top: 0.25rem;
			padding-bottom: 0.25rem;
			padding-left: 0.5rem;
			font-size: 0.875rem;
		}
		.hidetd {
			display: none;
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
					<div class="card" id="divTable">
						<div class="card-header">
							<h4><?= $title; ?></h4><hr>
						</div>
						<div class="card-body">
							<div id="header"></div>
							<div id="konten" class="mt-2"></div>
						</div>
					</div>
                </section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
		<div id="modal"></div>
		<div id="modal2"></div>
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
		const baseUrl = '<?= base_url('eklinik/sales/datacorporate/') ?>';
		window.addEventListener('DOMContentLoaded', () => {
			let csfrData = {};
			const token = '<?= $this->security->get_csrf_token_name(); ?>';
			const hash = '<?= $this->security->get_csrf_hash(); ?>'
			csfrData[token] = hash;
			$.ajaxSetup({data: csfrData});
			renderUtama();
		});
		document.querySelector('#header').addEventListener('click', e => {
			if(e.target.classList.contains('tambah')) {
				renderTambahModal();
			}
		});
		function renderTambahModal() {
			body = formTambahHTML();
			const html = modalHTML('modalTambah', 'Tambah', 'btnSave', body, 'modal-lg');
			document.querySelector('#modal').innerHTML = html;
			renderPICMarketing();
			renderKota();
			$('#modalTambah').modal();
		}
		function renderEditModal(id) {
			fetch(`${baseUrl}getcorporate?id=${id}`)
				.then(res => res.json())
				.then(res => {
					body = formTambahHTML(res.data);
					const html = modalHTML('modalTambah', 'Edit', 'btnSave', body, 'modal-lg');
					document.querySelector('#modal').innerHTML = html;
					document.querySelector('#btnSave').disabled = false;
					renderPICMarketing(res.data.pic_m);
					renderKota(res.data.kota);
					$('#modalTambah').modal();
				})
				.catch(e => console.log(e));
		}
		function renderPICMarketing(id = '') {
			fetch(`${baseUrl}getallmarketing`)
				.then(res => res.json())
				.then(res => {
					html = '<option value="">Pilih salah satu</option>';
					res.data.forEach(marketing => {
						html += `<option value="${marketing.id}" ${(marketing.id == id)? 'selected' : ''}>${marketing.first_name} ${marketing.last_name}</option>`;
					});
					document.querySelector('#picMarketing').innerHTML = html;
				})
				.catch(e => console.log());
		}
		function renderKota(namaKota = '') {
			fetch(`${baseUrl}getallkota`)
				.then(res => res.json())
				.then(res => {
					html = '<option value="">Pilih salah satu</option>';
					res.data.forEach(kota => {
						html += `<option value="${kota}" ${(kota == namaKota)? 'selected' : ''}>${kota}</option>`;
					});
					document.querySelector('#kota').innerHTML = html;
				})
				.catch(e => console.log());
		}
		function formTambahHTML(data = '') {
			return `<div class="form-group">
				<input type="hidden" id="id" value="${(!data)? '' : data.id}">
				<div class="row">
					<div class="col-md">
						<label for="namaInstansi">Nama Instansi</label>
						<input class="form-control form-control-sm" id="namaInstansi" value="${(!data)? '' : data.instansi}">
					</div>
					<div class="col-md">
						<label for="nomorTelepon">Nomor Telepon</label>
						<input class="form-control form-control-sm" id="nomorTelepon" value="${(!data)? '' : data.no_telp}">
					</div>
					<div class="col-md">
						<label for="namaPIC">Nama PIC</label>
						<input class="form-control form-control-sm" id="namaPIC" value="${(!data)? '' : data.pic_nama}">
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<label for="nomorHP">Nomor HP</label>
						<input class="form-control form-control-sm" id="nomorHP" value="${(!data)? '' : data.pic_nomorhp}">
					</div>
					<div class="col-md">
						<label for="email">Email</label>
						<input class="form-control form-control-sm" id="email" value="${(!data)? '' : data.pic_email}">
					</div>
					<div class="col-md">
						<label for="picMarketing">PIC Marketing</label>
						<select class="custom-select custom-select-sm" id="picMarketing"></select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="kota">Kota</label>
						<select class="custom-select custom-select-sm" id="kota"></select>
					</div>
					<div class="col-md">
						<label for="alamat">Alamat</label>
						<textarea class="form-control" id="alamat" rows="3">${(!data)? '' : data.alamat}</textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<label for="hargaSwabMolekular">Harga Swab Molekular</label>
						<input class="form-control form-control-sm" id="hargaSwabMolekular" value="${(!data)? '' : data.hargasm}">
					</div>
					<div class="col-md">
						<label for="hargaSwabSameday">Harga Swab Sameday</label>
						<input class="form-control form-control-sm" id="hargaSwabSameday" value="${(!data)? '' : data.hargass}">
					</div>
					<div class="col-md">
						<label for="hargaSwabBasic">Harga Swab Basic</label>
						<input class="form-control form-control-sm" id="hargaSwabBasic" value="${(!data)? '' : data.hargasb}">
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="hargaRapidTest">Harga Rapid Test</label>
						<input class="form-control form-control-sm" id="hargaRapidTest" value="${(!data)? '' : data.hargara}">
					</div>
					<div class="col-md-4">
						<label for="limitPembayaran">Limit Pembayaran</label>
						<input class="form-control form-control-sm" id="limitPembayaran" value="${(!data)? '' : data.limitbiaya}">
					</div>
				</div>
			</div>`;
		}
		function renderUtama() {
			document.querySelector('#header').innerHTML = headerHTML();
			document.querySelector('#konten').innerHTML = tableUtamaHTML();
			document.querySelector('#modal').innerHTML = '';
			document.querySelector('#modal2').innerHTML = '';
			dataTableUtama();
		}
		function dataTableUtama() {
			$('#tableUtama').dataTable({
				destroy: true,
				ajax: {
					url: `${baseUrl}getcorporate`,
					dataSrc: 'data'
				},
				columns: [
					{"data": 'no'},
					{"data": 'btn'},
					{"data": 'instansi'},
					{"data": 'no_telp'},
					{"data": 'kota'},
					{"data": 'alamat'},
					{"data": 'pic_nama'},
					{"data": 'pic_nomorhp'},
					{"data": 'pic_email'},
					{"data": 'hargasm'},
					{"data": 'hargass'},
					{"data": 'hargasb'},
					{"data": 'hargasa'},
					{"data": 'hargara'},
					{"data": 'limitbiaya'},
					{"data": 'namaPIC'},
					{"data": 'id'}
				],
				"columnDefs": [{
					"sortable": false,
					"targets": [1, 9, 10, 11, 12, 13, 14]
				}],
		        "createdRow": (row, data, index) => {
		        	$('td', row).eq(1).addClass('text-center');
		        	$('td', row).eq(9).addClass('text-center');
		        	$('td', row).eq(10).addClass('text-center');
		        	$('td', row).eq(11).addClass('text-center');
		        	$('td', row).eq(12).addClass('text-center');
		        	$('td', row).eq(13).addClass('text-center');
		        	$('td', row).eq(14).addClass('text-center');
		        	$('td', row).eq(15).addClass('text-center');
		        	$('td', row).eq(16).addClass('hidetd');
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
		function modalHTML(idModal, judul, idBtn, body, ukuran = '') {
			return `<div class="modal fade" id="${idModal}" role="dialog">
				<div class="modal-dialog modal-dialog-centered ${ukuran}" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">${judul}</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">${body}</div>
						<div class="modal-footer">
							<button id="${idBtn}" type="button" class="btn btn-success" disabled>Simpan</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>`;
		}
		function headerHTML() {
			return `<button class="btn btn-primary btn-sm tambah" id="btnTambahCorporate">
				<i class="fa fa-plus tambah"></i> Tambah Corporate
			</button>`;
		}
		function tableUtamaHTML() {
			return `<div class="table-responsive">
				<table class="table table-bordered table-hover" id="tableUtama">
					<thead>
						<tr class="text-center">
							<th>No</th>
							<th>Edit</th>
							<th>Instansi</th>
							<th>No Telp</th>
							<th>Kota</th>
							<th>Alamat</th>
							<th>Nama PIC</th>
							<th>No HP</th>
							<th>Email</th>
							<th>Harga Swab Molekular</th>
							<th>Harga Swab Sameday</th>
							<th>Harga Swab Basic</th>
							<th>Harga Swab Antigen</th>
							<th>Harga Rapid Test</th>
							<th>Limit Pembayaran</th>
							<th>PIC Marketing</th>
							<th class="hidetd">id</th>
						</tr>
					</thead>
				</table>
			</div>`;
		}
		document.querySelector('#modal').addEventListener('change', e => {
			if(e.target.id == 'picMarketing') {
				renderBtnSave();
			} else if(e.target.id == 'kota') {
				renderBtnSave();
			}
		});
		document.querySelector('#modal').addEventListener('keyup', e => {
			if(e.target.id == 'namaInstansi') {
				renderBtnSave();
			} else if(e.target.id == 'nomorTelepon') {
				renderBtnSave();
			} else if(e.target.id == 'namaPIC') {
				renderBtnSave();
			} else if(e.target.id == 'nomorHP') {
				renderBtnSave();
			} else if(e.target.id == 'email') {
				renderBtnSave();
			} else if(e.target.id == 'alamat') {
				renderBtnSave();
			} else if(e.target.id == 'hargaSwabMolekular') {
				renderBtnSave();
			} else if(e.target.id == 'hargaSwabSameday') {
				renderBtnSave();
			} else if(e.target.id == 'hargaSwabBasic') {
				renderBtnSave();
			} else if(e.target.id == 'hargaRapidTest') {
				renderBtnSave();
			} else if(e.target.id == 'limitPembayaran') {
				renderBtnSave();
			}
		});
		document.querySelector('#modal').addEventListener('click', e => {
			if(e.target.id == 'btnSave') {
				inputSimpanDataCorporate(e.target);
			}
		});
		function renderBtnSave() {
			const picMarketing = document.querySelector('#picMarketing').value;
			const kota = document.querySelector('#kota').value;
			const namaInstansi = document.querySelector('#namaInstansi').value;
			const nomorTelepon = document.querySelector('#nomorTelepon').value;
			const namaPIC = document.querySelector('#namaPIC').value;
			const nomorHP = document.querySelector('#nomorHP').value;
			const email = document.querySelector('#email').value;
			const alamat = document.querySelector('#alamat').value;
			const hargaSwabMolekular = document.querySelector('#hargaSwabMolekular').value;
			const hargaSwabSameday = document.querySelector('#hargaSwabSameday').value;
			const hargaSwabBasic = document.querySelector('#hargaSwabBasic').value;
			const hargaRapidTest = document.querySelector('#hargaRapidTest').value;
			const limitPembayaran = document.querySelector('#limitPembayaran').value;
			const btn = document.querySelector('#btnSave');
			btn.disabled = (picMarketing && kota && namaInstansi && nomorTelepon && namaPIC && nomorHP && email && alamat && hargaSwabMolekular && hargaSwabBasic && hargaSwabSameday && hargaRapidTest && limitPembayaran)? false : true;
		}
		function getParam(data) {
			return new URLSearchParams(data).toString();
		}
		function aksiSimpan() {
			dataTableUtama();
			$('#modalTambah').modal('hide');
		}
		function inputSimpanDataCorporate(btn) {
			btn.innerHTML = 'Loading...';
			btn.disabled = true;
			let form = {
				id: document.querySelector('#id').value,
				picMarketing: document.querySelector('#picMarketing').value,
				kota: document.querySelector('#kota').value,
				namaInstansi: document.querySelector('#namaInstansi').value,
				nomorTelepon: document.querySelector('#nomorTelepon').value,
				namaPIC: document.querySelector('#namaPIC').value,
				nomorHP: document.querySelector('#nomorHP').value,
				email: document.querySelector('#email').value,
				alamat: document.querySelector('#alamat').value,
				hargaSwabMolekular: document.querySelector('#hargaSwabMolekular').value,
				hargaSwabSameday: document.querySelector('#hargaSwabSameday').value,
				hargaSwabBasic: document.querySelector('#hargaSwabBasic').value,
				hargaRapidTest: document.querySelector('#hargaRapidTest').value,
				limitPembayaran: document.querySelector('#limitPembayaran').value
			}
			form = getParam(form);
			console.log(`${baseUrl}simpandatacorporate?${form}`);
			fetch(`${baseUrl}simpandatacorporate?${form}`)
				.then(res => res.json())
				.then(res => {
					if(res.status_json) {
						success(res.remarks, aksiSimpan);
					} else {
						showSnackError(res.remarks);
						btn.innerHTML = 'Coba Lagi';
						btn.disabled = false;
					}
				})
				.catch(e => {
					showSnackError(e);
					btn.innerHTML = 'Coba Lagi';
					btn.disabled = false;
				});
		}
	</script>
</body>
</html>