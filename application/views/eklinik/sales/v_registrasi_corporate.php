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
    <link rel="stylesheet" href="<?= base_url('assets/template/css/jquery.treegrid.css');?>">
	<style>
		.custom-select-sm {
			height: calc(1.5em + 0.5rem + 2px);
			padding-top: 0.25rem;
			padding-bottom: 0.25rem;
			padding-left: 0.5rem;
			font-size: 0.875rem;
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
					<div class="section-body">
						<div class="row">
							<div class="col-12 col-md-6 col-lg-6">
								<div class="card">
									<div class="card-header">
										<h4>Data Profil</h4>
									</div>
									<div class="card-body form-group" id="dataProfil"></div>
								</div>
							</div>
							<div class="col-12 col-md-6 col-lg-6">
								<div class="card">
									<div class="card-header">
										<h4>Data Pemeriksaan</h4>
									</div>
									<div class="card-body form-group" id="dataPemeriksaan"></div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
	</div>
	<script src="<?= base_url('assets/template/js/app.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/datatables.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/jquery-selectric/jquery.selectric.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/scripts.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/custom.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/toastr.js'); ?>"></script>
    <script src="<?= base_url('assets/template/js/jquery.treegrid.js');?>"></script>
	<script>
		const baseUrl = '<?= base_url('eklinik/sales/registrasicorporate/') ?>';
		const sekarang = '<?= $sekarang; ?>';
		window.addEventListener('DOMContentLoaded', () => {
			let csfrData = {};
			const token = '<?= $this->security->get_csrf_token_name(); ?>';
			const hash = '<?= $this->security->get_csrf_hash(); ?>';
			csfrData[token] = hash;
			$.ajaxSetup({data: csfrData});
			renderUtama();
        });
        document.querySelector('#dataProfil').addEventListener('keyup', e => {
        	if(e.target.id == 'nik') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'nomorPegawai') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'namaLengkap') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'tempatLahir') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'nomorHP') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'email') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'alamat') {
        		renderBtnRegistrasi();
        	}
        });
        document.querySelector('#dataProfil').addEventListener('change', e => {
        	if(e.target.id == 'customRadio') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'picMarketing') {
        		renderBtnRegistrasi();
        	}
        });
        document.querySelector('#dataPemeriksaan').addEventListener('change', e => {
        	if(e.target.id == 'cabang') {
        		renderPaketPemeriksaan(e.target.value);
        		renderFaskes(e.target.value);
        		renderInstansi(e.target.value);
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'jenisLayanan') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'paketPemeriksaan') {
        		renderJamKunjungan(e.target.value);
				renderBtnRegistrasi();
        	} else if(e.target.id == 'tanggalKunjungan') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'jamKunjungan') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'faskesAsal') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'instansi') {
        		renderBtnRegistrasi();
        	} else if(e.target.id == 'caraPembayaran') {
        		renderBtnRegistrasi();
        	}
        });
        function renderByCabang() {

        }
        document.querySelector('#dataPemeriksaan').addEventListener('keyup', e => {
        	if(e.target.id == 'catatan') {
        		renderBtnRegistrasi();
        	}
        });
        document.querySelector('#dataPemeriksaan').addEventListener('click', e => {
        	if(e.target.classList.contains('registrasi')) {
        		inputRegistrasi(e.target);
        	}
        });
        function renderBtnRegistrasi() {
        	const nik = document.querySelector('#nik').value;
        	const nomorPegawai = document.querySelector('#nomorPegawai').value;
        	const namaLengkap = document.querySelector('#namaLengkap').value;
        	const customRadio = document.querySelector('input[name="customRadio"]').value;
        	const tempatLahir = document.querySelector('#tempatLahir').value;
        	const tanggalLahir = document.querySelector('#tanggalLahir').value;
        	const nomorHP = document.querySelector('#nomorHP').value;
        	const email = document.querySelector('#email').value;
        	const alamat = document.querySelector('#alamat').value;
        	const picMarketing = document.querySelector('#picMarketing').value;
        	const cabang = document.querySelector('#cabang').value;
        	const jenisLayanan = document.querySelector('#jenisLayanan').value;
        	const paketPemeriksaan = document.querySelector('#paketPemeriksaan').value;
        	const tanggalKunjungan = document.querySelector('#tanggalKunjungan').value;
        	const jamKunjungan = document.querySelector('#jamKunjungan').value;
        	const faskesAsal = document.querySelector('#faskesAsal').value;
        	const instansi = document.querySelector('#instansi').value;
        	const caraPembayaran = document.querySelector('#caraPembayaran').value;
        	const catatan = document.querySelector('#catatan').value;
        	const btn = document.querySelector('#btnRegistrasi');
        	btn.disabled = (nik && nomorPegawai && namaLengkap && customRadio && tempatLahir && nomorHP && email && alamat && picMarketing && cabang && jenisLayanan && paketPemeriksaan && tanggalKunjungan && jamKunjungan && faskesAsal && instansi && caraPembayaran && catatan)? false : true;
        }
        function renderUtama() {
        	document.querySelector('#dataProfil').innerHTML = dataProfilHTML();
        	document.querySelector('#dataPemeriksaan').innerHTML = dataPemeriksaanHTML();
        	renderPICMarketing();
        	renderCabang();
        	renderJenisLayanan();
        	renderCaraPembayaran();
        }
        function renderPICMarketing() {
        	fetch(`${baseUrl}getallstaffmarketing`)
        		.then(res => res.json())
        		.then(res => {
        			let html = '<option value="">Pilih salah satu</option>';
        			res.data.forEach(staff => {
        				html += `<option value="${staff.id}">${staff.first_name} ${staff.last_name}</option>`;
        			});
        			document.querySelector('#picMarketing').innerHTML = html;
        		})
        		.catch(e => console.log(e));
        }
        function renderCabang() {
        	fetch(`${baseUrl}getallcabang`)
        		.then(res => res.json())
        		.then(res => {
        			let html = '<option value="">Pilih salah satu</option>';
        			res.data.forEach(cabang => {
        				html += `<option value="${cabang.id}">${cabang.nama}</option>`;
        			});
        			document.querySelector('#cabang').innerHTML = html;
        		})
        		.catch(e => console.log(e));
        }
        function renderJenisLayanan() {
        	fetch(`${baseUrl}getjenislayanan`)
        		.then(res => res.json())
        		.then(res => {
        			let html = '<option value="">Pilih salah satu</option>';
        			res.data.forEach(layanan => {
        				html += `<option value="${layanan}">${layanan}</option>`;
        			});
        			document.querySelector('#jenisLayanan').innerHTML = html;
        		})
        		.catch(e => console.log(e));
        }
        function renderFaskes(idCabang) {
        	fetch(`${baseUrl}getallfaskes?idCabang=${idCabang}`)
        		.then(res => res.json())
        		.then(res => {
        			let html = '<option value="">Pilih salah satu</option>';
        			res.data.forEach(faskes => {
        				html += `<option value="${faskes.id}">${faskes.namafaskes}</option>`;
        			});
        			const faskesAsal = document.querySelector('#faskesAsal');
        			faskesAsal.innerHTML = html;
        			faskesAsal.disabled = false;
        		})
        		.catch(e => console.log(e));
        }
        function renderInstansi(idCabang) {
        	fetch(`${baseUrl}getallInstansi?idCabang=${idCabang}`)
        		.then(res => res.json())
        		.then(res => {
        			let html = '<option value="">Pilih salah satu</option>';
        			res.data.forEach(instansi => {
        				html += `<option value="${instansi.id}">${instansi.instansi}</option>`;
        			});
        			const instansi = document.querySelector('#instansi');
        			instansi.innerHTML = html;
        			instansi.disabled = false;
        		})
        		.catch(e => console.log(e));
        }
        function renderCaraPembayaran() {
        	fetch(`${baseUrl}getcarapembayaran`)
        		.then(res => res.json())
        		.then(res => {
        			let html = '<option value="">Pilih salah satu</option>';
        			res.data.forEach(cara => {
        				html += `<option value="${cara}">${cara}</option>`;
        			});
        			document.querySelector('#caraPembayaran').innerHTML = html;
        		})
        		.catch(e => console.log(e));
        }
        function renderJamKunjungan(idPemeriksaanDetail) {
        	fetch(`${baseUrl}getalljam?idPemeriksaanDetail=${idPemeriksaanDetail}`)
        		.then(res => res.json())
        		.then(res => {
        			let html = '<option value=""></option>';
        			res.data.forEach(jam => {
        				html += `<option value="${jam.jam}">${jam.jam}</option>`;
        			});
        			const jamKunjungan = document.querySelector('#jamKunjungan');
        			jamKunjungan.innerHTML = html;
        			jamKunjungan.disabled = false;
        		})
        		.catch(e => console.log(e));
        }
        function renderPaketPemeriksaan(cabang) {
        	fetch(`${baseUrl}getallpaketpemeriksaan?idCabang=${cabang}`)
        		.then(res => res.json())
        		.then(res => {
        			let html = '<option value="">Pilih salah satu</option>';
        			res.data.forEach(paket => {
        				html += `<option value="${paket.id}">${paket.detailketerangan}</option>`;
        			});
        			const paketPemeriksaan = document.querySelector('#paketPemeriksaan');
        			paketPemeriksaan.innerHTML = html;
        			paketPemeriksaan.disabled = false;
        		})
        		.catch(e => console.log(e));
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
		function inputRegistrasi(btn) {
			btn.innerHTML = 'Loading...';
			btn.disabled = true;
			let data = {
				nik: document.querySelector('#nik').value,
		    	nomorPegawai: document.querySelector('#nomorPegawai').value,
		    	namaLengkap: document.querySelector('#namaLengkap').value,
		    	customRadio: document.querySelector('input[name="customRadio"]').value,
		    	tempatLahir: document.querySelector('#tempatLahir').value,
		    	tanggalLahir: document.querySelector('#tanggalLahir').value,
		    	nomorHP: document.querySelector('#nomorHP').value,
		    	email: document.querySelector('#email').value,
		    	alamat: document.querySelector('#alamat').value,
		    	picMarketing: document.querySelector('#picMarketing').value,
		    	cabang: document.querySelector('#cabang').value,
		    	jenisLayanan: document.querySelector('#jenisLayanan').value,
		    	paketPemeriksaan: document.querySelector('#paketPemeriksaan').value,
		    	tanggalKunjungan: document.querySelector('#tanggalKunjungan').value,
		    	jamKunjungan: document.querySelector('#jamKunjungan').value,
		    	faskesAsal: document.querySelector('#faskesAsal').value,
		    	instansi: document.querySelector('#instansi').value,
		    	caraPembayaran: document.querySelector('#caraPembayaran').value,
		    	catatan: document.querySelector('#catatan').value,
		    	tanggalRegistrasi: document.querySelector('#tanggalRegistrasi').value
			}
			data = getParam(data);
			fetch(`${baseUrl}simpanregistrasi?${data}`)
				.then(res => res.json())
				.then(res => {
					if(res.status_json) {
						success(res.remarks, renderUtama);
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
		function getParam(data) {
			return new URLSearchParams(data).toString();
		}
        function dataProfilHTML() {
        	return `<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="nik">NIK</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="nik" >
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="nomorPegawai">Nomor Pegawai</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="nomorPegawai" >
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="namaLengkap">Nama Lengkap</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="namaLengkap" >
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="jenisKelamin">Jenis Kelamin</label>
        		</div>
        		<div class="col-md-8">
					<div class="form-check">
						<div class="custom-control custom-radio">
							<input type="radio" id="customRadio3" name="customRadio" class="custom-control-input" value="L">
							<label class="custom-control-label" for="customRadio3">Laki-laki</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="P">
							<label class="custom-control-label" for="customRadio2">Perempuan</label>
						</div>
					</div>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="tempatLahir">Tempat Lahir</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="tempatLahir" >
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="tanggalLahir">Tanggal Lahir</label>
        		</div>
        		<div class="col-md-8">
					<input type="date" class="form-control form-control-sm" id="tanggalLahir" >
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="nomorHP">Nomor HP</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="nomorHP" >
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="email">Email</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="email" >
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="alamat">Alamat</label>
        		</div>
        		<div class="col-md-8">
					<textarea class="form-control" id="alamat" rows="3"></textarea>
				</div>
        	</div>
        	<div class="row">
        		<div class="col-md-4">
        			<label for="picMarketing">PIC Marketing</label>
        		</div>
        		<div class="col-md-8">
					<select class="custom-select custom-select-sm" id="picMarketing"></select>
				</div>
        	</div>`;
        }
        function dataPemeriksaanHTML() {
        	return `<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="tanggalRegistrasi">Tanggal Registrasi</label>
        		</div>
        		<div class="col-md-8">
					<input type="date" class="form-control form-control-sm" id="tanggalRegistrasi" value="${sekarang}" disabled>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="nomoRegistrasi">Nomor Registrasi</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="nomoRegistrasi" disabled>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="cabang">Cabang</label>
        		</div>
        		<div class="col-md-8">
					<select class="custom-select custom-select-sm" id="cabang"></select>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="jenisLayanan">Jenis Layanan</label>
        		</div>
        		<div class="col-md-8">
					<select class="custom-select custom-select-sm" id="jenisLayanan"></select>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="paketPemeriksaan">Paket Pemeriksaan</label>
        		</div>
        		<div class="col-md-8">
					<select class="custom-select custom-select-sm" id="paketPemeriksaan" disabled></select>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="tanggalKunjungan">Waktu Kunjungan</label>
        		</div>
        		<div class="col-md-8">
        			<div class="row">
        				<div class="col-8">
	        				<input type="date" class="form-control form-control-sm" id="tanggalKunjungan">
	        			</div>
	        			<div class="col-4">
	        				<select class="custom-select custom-select-sm" id="jamKunjungan" disabled></select>
	        			</div>
        			</div>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="faskesAsal">Faskes Asal</label>
        		</div>
        		<div class="col-md-8">
					<select class="custom-select custom-select-sm" id="faskesAsal" disabled></select>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="instansi">Instansi</label>
        		</div>
        		<div class="col-md-8">
					<select class="custom-select custom-select-sm" id="instansi" disabled></select>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="caraPembayaran">Cara Pembayaran</label>
        		</div>
        		<div class="col-md-8">
					<select class="custom-select custom-select-sm" id="caraPembayaran"></select>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="catatan">Catatan</label>
        		</div>
        		<div class="col-md-8">
					<textarea class="form-control" id="catatan" rows="3"></textarea>
				</div>
        	</div>
        	<div class="row justify-content-end">
        		<div class="col-md-8">
        			<button type="button" class="btn btn-success btn-sm registrasi" style="padding: 0.3rem 5.0rem;" id="btnRegistrasi" disabled>
	    				<i class="fas fa-user-plus registrasi"></i> Registrasi
	    			</button>
        		</div>
        	</div>`;
        }
	</script>
</body>
</html>