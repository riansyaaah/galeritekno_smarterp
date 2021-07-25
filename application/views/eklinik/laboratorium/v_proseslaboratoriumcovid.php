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
							<div class="panel-body row">
								<div class="col-12 col-md-6 col-lg-6">
									<div class="card">
					                  <div class="card-header">
					                    <h4>Input Profil</h4>
					                  </div>
					                  <div class="card-body">
					                    <div class="form-group row">
					                      <label for="tanggalregistrasi" class="col-sm-5 col-form-label">Tanggal Registrasi</label>
					                      <div class="col-sm-7">
					                        <input type="date" class="form-control" id="tanggalregistrasi" readonly="">
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-5 col-form-label">Nomor Registrasi</label>
					                      <div class="col-sm-7">
					                        <input type="text" class="form-control" id="noregistrasi" readonly="">
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="nik" class="col-sm-5 col-form-label">NIK</label>
					                      <div class="col-sm-7">
					                        <input type="text" class="form-control" id="nik" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="nationality" class="col-sm-5 col-form-label">Nationality</label>
					                      <div class="col-sm-7">
					                        <input type="text" class="form-control" id="nationality" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="nama" class="col-sm-5 col-form-label">Nama Lengkap</label>
					                      <div class="col-sm-7">
					                        <input type="text" class="form-control" id="nama" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="jeniskelamin" class="col-sm-5 col-form-label">Jenis Kelamin</label>
					                      <div class="col-sm-7">
					                        <input type="text" class="form-control" id="jeniskelamin" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="tempatlahir" class="col-sm-5 col-form-label">Tempat Lahir</label>
					                      <div class="col-sm-7">
					                        <input type="text" class="form-control" id="tempatlahir" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="tanggallahir" class="col-sm-5 col-form-label">Tanggal Lahir</label>
					                      <div class="col-sm-7">
					                        <input type="date" class="form-control" id="tanggallahir" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="nomorhp" class="col-sm-5 col-form-label">Nomor HP</label>
					                      <div class="col-sm-7">
					                        <input type="text" class="form-control" id="nomorhp" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="email" class="col-sm-5 col-form-label">Email</label>
					                      <div class="col-sm-7">
					                        <input type="text" class="form-control" id="email" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-5 col-form-label">Alamat</label>
					                      <div class="col-sm-7">
					                        <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="2"></textarea>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="instansi" class="col-sm-5 col-form-label">Instansi</label>
					                      <div class="col-sm-7">
					                        <select class="custom-select custom-select-sm" name="instansi" id="instansi"></select>
					                      </div>
					                    </div> 
					                    <div class="form-group row">
					                      <label for="instansi" class="col-sm-5 col-form-label">Faskes Asal</label>
					                      <div class="col-sm-7">
					                        <select class="custom-select custom-select-sm" name="faskesasal" id="faskesasal"></select>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-5 col-form-label">Catatan</label>
					                      <div class="col-sm-7">
					                        <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="2"></textarea>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="cabang" class="col-sm-5 col-form-label">Cabang</label>
					                      <div class="col-sm-7">
					                        <select class="custom-select custom-select-sm" name="cabang" id="cabang"></select>
					                      </div>
					                    </div>
					                  </div>
					                </div>
								</div>
								<div class="col-12 col-md-6 col-lg-6">
									<div class="card">
					                  <div class="card-header">
					                    <h4>Input Pemeriksaaan</h4>
					                  </div>
					                  <div class="card-body">
					                    <div class="form-group row">
					                      <label for="tanggalkunjungan" class="col-sm-5 col-form-label">Waktu Kunjungan</label>
					                      <div class="col-sm-7">
					                        <input type="date" class=".form-control-sm" id="tanggalkunjungan" name="tanggalkunjungan">
					                        <input type="time" class=".form-control-sm" id="jamkunjungan" name="jamkunjungan" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-5 col-form-label">Jenis Pemeriksaan</label>
					                      <div class="col-sm-7">
					                        <select name="paketpemeriksaan" id="paketpemeriksaan" class="custom-select custom-select-sm"></select>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="tanggalsampling" class="col-sm-5 col-form-label">Waktu Ambil Sampling</label>
					                      <div class="col-sm-7">
					                        <input type="date" class=".form-control-sm" id="tanggalsampling" name="tanggalsampling">
					                        <input type="time" class=".form-control-sm" id="jamsampling" name="jamsampling" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="tanggalperiksa" class="col-sm-5 col-form-label">Waktu Periksa Sampling</label>
					                      <div class="col-sm-7">
					                        <input type="date" class=".form-control-sm" id="tanggalperiksa" name="tanggalperiksa">
					                        <input type="time" class=".form-control-sm" id="jamperiksa" name="jamperiksa" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="tanggalselesai" class="col-sm-5 col-form-label">Waktu Selesai Sampling</label>
					                      <div class="col-sm-7">
					                        <input type="date" class=".form-control-sm" id="tanggalselesai" name="tanggalselesai">
					                        <input type="time" class=".form-control-sm" id="jamselesai" name="jamselesai" >
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-5 col-form-label">Jenis Sample</label>
					                      <div class="col-sm-7">
					                        <select name="jenissample" id="jenissample" class="custom-select custom-select-sm">
					                        </select>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-5 col-form-label">2019-nCov</label>
					                      <div class="col-sm-7">
					                        <select name="ncov" id="ncov" class="custom-select custom-select-sm">
					                        </select>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-5 col-form-label">N Gene</label>
					                      <div class="col-sm-7">
					                        <select name="gene" id="gene" class="custom-select custom-select-sm">
					                        </select>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-5 col-form-label">ORF1ab</label>
					                      <div class="col-sm-7">
					                        <select name="orf1ab" id="orf1ab" class="form-control">
					                        	<option value="Undetection">Undetection</option>
					                        	<option value="Detection">Detection</option>
					                        </select>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="ic" class="col-sm-5 col-form-label">IC</label>
					                      <div class="col-sm-7">
					                      	<input type="text" class="form-control" id="ic"  name="ic">
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-5 col-form-label">Dokter Pemeriksa</label>
					                      <div class="col-sm-7">
					                        <select name="dokter" id="dokter" class="custom-select custom-select-sm">
					                        </select>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-5 col-form-label">Petugas Pemeriksa</label>
					                      <div class="col-sm-7">
					                        <select name="petugas" id="petugas" class="custom-select custom-select-sm">
					                        </select>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-5 col-form-label">Status Pemeriksaan</label>
					                      <div class="col-sm-7">
					                        <select name="statuspemeriksaan" id="statuspemeriksaan" class="form-control">
					                        	<option value="Pemeriksaan Sample">Pemeriksaan Sample</option>
					                        	<option value="Selesai">Selesai</option>
					                        </select>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="statuskirimhasil" class="col-sm-5 col-form-label">Status Kirim Hasil</label>
					                      <div class="col-sm-7">
					                        <select name="statuskirimhasil" id="statuskirimhasil" class="form-control">
					                        	<option value="Belum Di kirim">Belum Di kirim</option>
					                        	<option value="Sudah Di kirim">Sudah Di kirim</option>
					                        </select>
					                      </div>
					                    </div>
					                    <div class="form-group row">
					                      <label for="noregistrasi" class="col-sm-2 col-form-label">*Noted</label>
					                      <div class="col-sm-10">
					                       	<p style="color: red;">Info mohon di perhatikan,,.. 
											Khusus sample dari Darya Klinik, pilihan faskesnya dipilih Darya Klinik,.</p>
					                      </div>
					                    </div>
					                    <button type="submit" class="btn btn-success">Simpan</button>
					                    <a href="" class="btn btn-info">Cetak Hasil</a>
					                    <a href="" class="btn btn-primary">Cetak Hasil Inggris</a>
					                    <a href="" class="btn btn-danger">Kirim Hasil</a>
					                    <a href="" class="btn btn-warning">Kirim Email</a>
					                  </div>
					                </div>
								</div><!-- END COL 12- MD-6 -->
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

		<script src="<?= base_url('assets/template/js/app.min.js'); ?>"></script>
		<script src="<?= base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
		<script src="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
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
						var baseUrl='<?= base_url('eklinik/laboratorium/labcovid/');?>';
						$(document).ready(function() {
                            
                            fetch(`${baseUrl}getregperiksasingle?id=<?= $id; ?>`)
                            	.then(res => res.json())
								.then(res => {
									document.querySelector('#tanggalregistrasi').value=res.data.tanggalregistrasi;
									document.querySelector('#noregistrasi').value=res.data.nomorregistrasi;
									document.querySelector('#nik').value=res.data.nik;
									document.querySelector('#nationality').value=res.data.nationality;
									document.querySelector('#nama').value=res.data.nama;
									document.querySelector('#jeniskelamin').value=res.data.jeniskelamin;
									document.querySelector('#tempatlahir').value=res.data.tempatlahir;
									document.querySelector('#tanggallahir').value=res.data.tanggallahir;
									document.querySelector('#nomorhp').value=res.data.nomorhp;
									document.querySelector('#email').value=res.data.email;
									document.querySelector('#alamat').value=res.data.alamat;
									renderInstansi(res.data.idcabang, res.data);
									renderFaskes(res.data.idcabang, res.data);
									document.querySelector('#catatan').value=res.data.catatan;
									renderCabang(res.data.idcabang, res.data);
									document.querySelector('#tanggalkunjungan').value=res.data.tanggalkunjungan;
									document.querySelector('#jamkunjungan').value=res.data.jamkunjungan;
									renderPaketPemeriksaan(res.data.idcabang, res.data);
									document.querySelector('#tanggalsampling').value=res.data.tanggalsampling;
									document.querySelector('#jamsampling').value=res.data.jamsampling;
									document.querySelector('#tanggalperiksa').value=res.data.tanggalperiksa;
									document.querySelector('#jamperiksa').value=res.data.jamperiksa;
									document.querySelector('#tanggalselesai').value=res.data.tanggalselesai;
									document.querySelector('#jamselesai').value=res.data.jamselesai;
									renderJenisSample(res.data.idcabang, res.data);
									renderNcov(res.data.idcabang, res.data);
									renderGene(res.data.idcabang, res.data);
									renderOrf(res.data.idcabang, res.data);
									document.querySelector('#ic').value=res.data.ic;
									renderDokter(res.data.idcabang, res.data);
									renderPetugas(res.data.idcabang, res.data);
									renderStatusPemeriksaan(res.data.idcabang, res.data);
									renderStatusKirimHasil(res.data.idcabang, res.data);
								})
								.catch(e => console.log(e));
                            
							var csfrData = {};
							csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
							$.ajaxSetup({
								data: csfrData
							});
                        });

                        function renderInstansi(idcabang, data='') {
						    fetch(`${baseUrl}getallinstansi?idcabang=${idcabang}`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(instansi => {
						                html += `<option value="${instansi.id}" ${(instansi.id==data.idinstansi)? 'selected':''}>${instansi.instansi}</option>`;
						            });
						            const instansi = document.querySelector('#instansi');
						            instansi.innerHTML = html;
						            instansi.disabled = false;
						        })
						        .catch(e => console.log(e));
						}


						function renderFaskes(idcabang, data='') {
						    fetch(`${baseUrl}getallfaskes?idcabang=${idcabang}`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(faskes => {
						                html += `<option value="${faskes.id}" ${(faskes.id==data.idfaskes)? 'selected':''}>${faskes.namafaskes}</option>`;
						            });
						            const faskesasal = document.querySelector('#faskesasal');
						            faskesasal.innerHTML = html;
						            faskesasal.disabled = false;
						        })
						        .catch(e => console.log(e));
						}

                        function renderCabang(idcabang, data='') {
						    fetch(`${baseUrl}getallcabang?idcabang=${idcabang}`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(cabang => {
						                html += `<option value="${cabang.id}" ${(cabang.id==data.idcabang)? 'selected':''}>${cabang.nama}</option>`;
						            });
						            const cabang = document.querySelector('#cabang');
						            cabang.innerHTML = html;
						            cabang.disabled = false;
						        })
						        .catch(e => console.log(e));
						}

						function renderPaketPemeriksaan(idcabang, data='') {
						    fetch(`${baseUrl}getallpaketpemeriksaan?idcabang=${idcabang}`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(paket => {
						                html += `<option value="${paket.id}" ${(paket.id==data.idjenispemeriksaandetail)? 'selected':''}>${paket.detailketerangan}</option>`;
						            });
						            const paketpemeriksaan = document.querySelector('#paketpemeriksaan');
						            paketpemeriksaan.innerHTML = html;
						            paketpemeriksaan.disabled = false;
						        })
						        .catch(e => console.log(e));
						}


						function renderJenisSample(idcabang, data='') {
						    fetch(`${baseUrl}getjenissample`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(jenissample => {
						                html += `<option value="${jenissample}" ${jenissample? 'selected':''}>${jenissample}</option>`;
						            });
						            const jenissample = document.querySelector('#jenissample');
						            jenissample.innerHTML = html;
						            jenissample.disabled = false;
						        })
						        .catch(e => console.log(e));
						}
						function renderNcov(idcabang, data='') {
						    fetch(`${baseUrl}getncov`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(ncov => {
						                html += `<option value="${ncov}" ${ncov? 'selected':''}>${ncov}</option>`;
						            });
						            const ncov = document.querySelector('#ncov');
						            ncov.innerHTML = html;
						            ncov.disabled = false;
						        })
						        .catch(e => console.log(e));
						}
						function renderGene(idcabang, data='') {
						    fetch(`${baseUrl}getgene`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(gene => {
						                html += `<option value="${gene}" ${gene? 'selected':''}>${gene}</option>`;
						            });
						            const gene = document.querySelector('#gene');
						            gene.innerHTML = html;
						            gene.disabled = false;
						        })
						        .catch(e => console.log(e));
						}
						function renderOrf(idcabang, data='') {
						    fetch(`${baseUrl}getorf`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(orf => {
						                html += `<option value="${orf}" ${orf? 'selected':''}>${orf}</option>`;
						            });
						            const orf = document.querySelector('#orf');
						            orf.innerHTML = html;
						            orf.disabled = false;
						        })
						        .catch(e => console.log(e));
						}

						 function renderDokter(idcabang, data='') {
						    fetch(`${baseUrl}getalldokter?idcabang=${idcabang}`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(dokter => {
						                html += `<option value="${dokter.id}" ${(dokter.id==data.iddokter)? 'selected':''}>${dokter.namadokter}</option>`;
						            });
						            const dokter = document.querySelector('#dokter');
						            dokter.innerHTML = html;
						            dokter.disabled = false;
						        })
						        .catch(e => console.log(e));
						}

						function renderPetugas(idcabang, data='') {
						    fetch(`${baseUrl}getallpetugas?idcabang=${idcabang}`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(petugas => {
						                html += `<option value="${petugas.id}" ${(petugas.id==data.idpetugas)? 'selected':''}>${petugas.namapetugas}</option>`;
						            });
						            const petugas = document.querySelector('#petugas');
						            petugas.innerHTML = html;
						            petugas.disabled = false;
						        })
						        .catch(e => console.log(e));
						}

						function renderStatusPemeriksaan(idcabang, data='') {
						    fetch(`${baseUrl}getstatuspemeriksaan`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(statuspemeriksaan => {
						                html += `<option value="${statuspemeriksaan}" ${statuspemeriksaan? 'selected':''}>${statuspemeriksaan}</option>`;
						            });
						            const statuspemeriksaan = document.querySelector('#statuspemeriksaan');
						            statuspemeriksaan.innerHTML = html;
						            statuspemeriksaan.disabled = false;
						        })
						        .catch(e => console.log(e));
						}

						function renderStatusKirimHasil(idcabang, data='') {
						    fetch(`${baseUrl}getstatuskirimhasil`)
						        .then(res => res.json())
						        .then(res => {
						            let html = '<option value="">Pilih salah satu</option>';
						            res.data.forEach(statuskirimhasil => {
						                html += `<option value="${statuskirimhasil}" ${statuskirimhasil? 'selected':''}>${statuskirimhasil}</option>`;
						            });
						            const statuskirimhasil = document.querySelector('#statuskirimhasil');
						            statuskirimhasil.innerHTML = html;
						            statuskirimhasil.disabled = false;
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