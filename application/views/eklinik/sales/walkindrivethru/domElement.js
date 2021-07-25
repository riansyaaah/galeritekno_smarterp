function headerUtamaHTML() {
	return `<div class="row mb-2">
		<div class="col-md">
			<button type="button" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#filter">
				<i class="fas fa-filter"></i> Filter
			</button>
			<button class="btn btn-primary btn-sm addPeserta">
				<i class="fa fa-plus addPeserta"></i> Tambah Peserta
			</button>
		</div>
	</div>
	<div class="form-group collapse" id="filter" >
		<div class="row">
			<div class="col-md-6">
				<div class="row mb-1">
					<div class="col-md-4">
						<label>Tanggal Kunjungan</label>
					</div>
					<div class="col-md col-6">
						<input type="date" id="filterTanggalKunjunganFrom" class="form-control form-control-sm" value="${sekarang}">
					</div>
					<div class="col-md col-6">
						<input type="date" id="filterTanggalKunjunganTo" class="form-control form-control-sm" value="${sekarang}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md-4">
						<label>Instansi</label>
					</div>
					<div class="col-md">
						<select class="custom-select custom-select-sm" id="filterInstansi"></select>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md-4">
						<label>PIC Marketing</label>
					</div>
					<div class="col-md">
						<select class="custom-select custom-select-sm" id="filterPICMarketing"></select>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md-4">
						<label>Paket Pemeriksaan</label>
					</div>
					<div class="col-md">
						<select class="custom-select custom-select-sm" id="filterPaketPemeriksaan"></select>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md-4">
						<label>Cabang/Afiliasi</label>
					</div>
					<div class="col-md">
						<select class="custom-select custom-select-sm" id="filterCabang"></select>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-md-4">
						<label>Status Hasil</label>
					</div>
					<div class="col-md">
						<select class="custom-select custom-select-sm" id="filterStatusHasil"></select>
					</div>
				</div>
				<div class="row">
					<div class="col-md d-flex justify-content-end">
						<button class="btn btn-primary btn-sm mr-1" id="btnFilter">Filter</button>
						<button class="btn btn-success btn-sm" id="btnCetakExcel">Cetak Excel</button>
					</div>
				</div>
			</div>
		</div>
    </div>`;
}
function formRescheduleModalHTML(data) {
	return `<div class="form-group">
		<input id="idReschedule" type="hidden" value="${data.id}">
		<div class="row">
			<div class="col-md">
				<label for="tglKunjungan">Tanggal Kunjungan</label>
				<input type="date" id="tglKunjungan" class="form-control form-control-sm" value="${data.tanggalkunjungan}">
			</div>
			<div class="col-md">
				<label for="jmKunjungan">Jam Kunjungan</label>
				<select id="jmKunjungan" class="custom-select custom-select-sm"></select>
			</div>
		</div>
	</div>`;
}
function tableDetailHTML() {
	return `<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-2">
					<h5 class="text-dark">Data Peserta</h5>
				</div>
				<div class="col-md">
					<button class="btn btn-warning btn-sm addPesertaDetail float-md-right">
						<i class="fa fa-plus addPesertaDetail"></i> Tambah Peserta
					</button>
				</div>
			</div>
			<div id="konten" class="mt-2">
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="tableDataPeserta">
						<thead>
							<tr class="text-center">
								<th>No</th>
								<th>Registrasi</th>
								<th>Waktu Kunjungan</th>
								<th>No Antrian</th>
								<th>Jenis Layanan</th>
								<th>Paket Pemeriksaan</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Tanggal Lahir</th>
								<th>No HP</th>
								<th>Status Bayar</th>
								<th>Status Hadir</th>
								<th></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>`;
}
function kontenDetailHTML(data) {
	return `<div class="row">
		<input type="hidden" id="idpayment" value="${data.idpayment}">
		<div class="col-md-6">
			<table class="table table-striped table-sm">
				<tr>
					<th>No Invoice</th>
					<td>: ${(data.noinvoice)? data.noinvoice : data.idpayment}</td>
				</tr>
				<tr>
					<th>Total</th>
					<td>: ${data.harga}</td>
				</tr>
				<tr>
					<th>Virtual Account Number</th>
					<td>: ${data.va_number}</td>
				</tr>
				<tr>
					<th>Cara Bayar</th>
					<td>: ${data.carabayar}</td>
				</tr>
				<tr>
					<th>Status Pembayaran</th>
					<td>: ${data.remarks}</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md">
			<button class="btn btn-success btn-sm btnCetakKwitansi">
				<i class="fa fa-download btnCetakKwitansi"></i> Cetak Kwitansi
			</button>
			<button class="btn btn-warning btn-sm btnHadirSemua">
				<i class="fa fa-check btnHadirSemua"></i> Hadir Semua
			</button>
		</div>
	</div>`;
}
function formHadirSemuaHTML(idpayment) {
	return `<p>Apakah benar peserta dengan No Invoice ${idpayment} telah hadir semua?</p>`;
}
function formHadirSingleHTML(data) {
	return `<input type="hidden" id="idHadirSingle" value="${data.id}">
		<p>Apakah benar peserta dengan No Registrasi ${data.nomorregistrasi} telah hadir?</p>`;
}
function headerDetailHTML(id = '') {
	return `<div class="row">
		<div class="col-md">
			<input type="hidden" id="idDetail" value="${id}">
			<button class="btn btn-warning btn-sm mb-2 tombolDetailKembali">
				<i class="fa fa-backward tombolDetailKembali"></i> Kembali
			</button>
		</div>
	</div>`;
}
function tableUtamaHTML() {
	return `<div class="table-responsive">
		<table class="table table-bordered table-hover" id="tableUtama" style="width: 100%;"">
			<thead>
				<tr class="text-center">
					<th>No</th>
					<th>Jenis Pemeriksaan</th>
					<th>Waktu Kunjungan</th>
					<th>Instansi</th>
					<th>No Registrasi</th>
					<th>NIK</th>
					<th>Nama</th>
					<th>TTL/JK</th>
					<th>PIC Marketing</th>
					<th>Status Bayar</th>
					<th>Status Hadir</th>
					<th>Cabang</th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>`;
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
					<button id="${idBtn}" type="button" class="btn btn-primary" disabled>Konfirmasi</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>`;
}
function formHapusPersertaHTML(data) {
	return `<input id="idHapus" value="${data.id}" type="hidden">
	<p>Anda yakin ingin menghapus peserta dengan nomor registrasi ${data.nomorregistrasi}?</p>`;
}
function formAddPesertaHTML(status, idpayment = '', data = '') {
	return `<div class="row">
		<input type="hidden" id="status" value="${(!status)? '' : status}">
		<input type="hidden" id="idpayment" value="${(!idpayment)? '' : idpayment}">
		<input type="hidden" id="idEdit" value="${(!data.id)? '' : data.id}">
		<div class="col-md">
			<h6>Data Profil</h6><hr>
			<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="nik">NIK</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="nik" value="${(!data.nik)? '' : data.nik}">
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="nomorPegawai">Nomor Pegawai</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="nomorPegawai" value="${(!data.nomorpegawai)? '' : data.nomorpegawai}">
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="namaLengkap">Nama Lengkap</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="namaLengkap" value="${(!data.nama)? '' : data.nama}">
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="jenisKelamin">Jenis Kelamin</label>
        		</div>
        		<div class="col-md-8">
					<div class="form-check">
						<div class="custom-control custom-radio">
							<input ${(!data.jeniskelamin)? '' : ((data.jeniskelamin == 'Pria')? 'checked' : '')} type="radio" id="customRadio3" name="customRadio" class="custom-control-input" value="Pria">
							<label class="custom-control-label" for="customRadio3">Pria</label>
						</div>
						<div class="custom-control custom-radio">
							<input ${(!data.jeniskelamin)? '' : ((data.jeniskelamin == 'Wanita')? 'checked' : '')} type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="Wanita">
							<label class="custom-control-label" for="customRadio2">Wanita</label>
						</div>
					</div>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="tempatLahir">Tempat Lahir</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="tempatLahir" value="${(!data.tempatlahir)? '' : data.tempatlahir}">
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="tanggalLahir">Tanggal Lahir</label>
        		</div>
        		<div class="col-md-8">
					<input type="date" class="form-control form-control-sm" id="tanggalLahir" value="${(!data.tanggallahir)? '' : data.tanggallahir}">
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="nomorHP">Nomor HP</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="nomorHP" value="${(!data.nomorhp)? '' : data.nomorhp}">
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="email">Email</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="email" value="${(!data.email)? '' : data.email}">
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="alamat">Alamat</label>
        		</div>
        		<div class="col-md-8">
					<textarea class="form-control" id="alamat" rows="3">${(!data.alamat)? '' : data.alamat}</textarea>
				</div>
        	</div>
        	<div class="row">
        		<div class="col-md-4">
        			<label for="picMarketing">PIC Marketing</label>
        		</div>
        		<div class="col-md-8">
					<select class="custom-select custom-select-sm" id="picMarketing"></select>
				</div>
        	</div>
		</div>
		<div class="col-md">
			<h6>Data Pemeriksaan</h6><hr>
			<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="tanggalRegistrasi">Tanggal Registrasi</label>
        		</div>
        		<div class="col-md-8">
					<input type="date" class="form-control form-control-sm" id="tanggalRegistrasi" value="${(!data.tanggalregistrasi)? sekarang : data.tanggalregistrasi}" disabled>
				</div>
        	</div>
        	<div class="row mb-2">
        		<div class="col-md-4">
        			<label for="nomoRegistrasi">Nomor Registrasi</label>
        		</div>
        		<div class="col-md-8">
					<input type="text" class="form-control form-control-sm" id="nomoRegistrasi" disabled value="${(!data.nomorregistrasi)? '' : data.nomorregistrasi}">
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
	        				<input type="date" class="form-control form-control-sm" id="tanggalKunjungan" value="${(!data.tanggalkunjungan)? '' : data.tanggalkunjungan}">
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
					<textarea class="form-control" id="catatan" rows="3">${(!data.catatan)? '' : data.catatan}</textarea>
				</div>
        	</div>
		</div>
	</div>`;
}
function tableLogElement() {
	return `<div class="table-responsive">
		<table class="table table-hover table-bordered" id="tableLog">
			<thead>
				<tr class="text-center">
					<th style="width: 10%">No</th>
					<th>Waktu</th>
					<th>Aktivitas</th>
				</tr>
			</thead>
		</table>
	</div>`;
}