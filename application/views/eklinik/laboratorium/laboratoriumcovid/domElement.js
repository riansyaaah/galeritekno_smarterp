function headerHTML() {
	return `<div class="row mb-2">
		<div class="col-md">
			<button type="button" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#filter">
				<i class="fas fa-filter"></i> Filter
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
function headerProsesHTML() {
	return `<button class="btn btn-warning btn-sm mb-2 btnKembali">
		<i class="fa fa-backward btnKembali"></i> Kembali
	</button>`;
}
function kontenProsesHTML(data, dataPemeriksaanHTML) {
	return `<div class="form-group">
		<input type="hidden" id="idProses" value="${data.id}" data-barcode="${data.barcode}">
		<div class="row">
			<div class="col-md">
				<h6>Data Registrasi</h6><hr>
				<div class="row mb-1">
					<div class="col-md">
						<label for="tanggalRegistrasi">Tanggal Registrasi</label>
					</div>
					<div class="col-md-8">
						<input class="form-control form-control-sm" id="tanggalRegistrasi" disabled type="date" value="${data.tanggalregistrasi}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="nomorRegistrasi">Nomor Registrasi</label>
					</div>
					<div class="col-md-8">
						<input class="form-control form-control-sm" id="nomorRegistrasi" disabled type="text" value="${data.nomorregistrasi}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="nik">NIK</label>
					</div>
					<div class="col-md-8">
						<input class="form-control form-control-sm" id="nik" type="text" value="${data.nik}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="noPassport">No Passport</label>
					</div>
					<div class="col-md-8">
						<input class="form-control form-control-sm" id="noPassport" type="text" value="${data.nopassport}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="nationality">Nationality</label>
					</div>
					<div class="col-md-8">
						<input class="form-control form-control-sm" id="nationality" type="text" value="${data.nationality}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="namaLengkap">Nama Lengkap</label>
					</div>
					<div class="col-md-8">
						<input class="form-control form-control-sm" id="namaLengkap" type="text" value="${data.nama}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="jenisKelamin">Jenis Kelamin</label>
					</div>
					<div class="col-md-8">
						<input class="form-control form-control-sm" id="jenisKelamin" type="text" value="${data.jeniskelamin}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="tempatLahir">Tempat Lahir</label>
					</div>
					<div class="col-md-8">
						<input class="form-control form-control-sm" id="tempatLahir" type="text" value="${data.tempatlahir}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="tanggalLahir">Tanggal Lahir</label>
					</div>
					<div class="col-md-8">
						<input class="form-control form-control-sm" id="tanggalLahir" type="date" value="${data.tanggallahir}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="nomorHP">Nomor HP</label>
					</div>
					<div class="col-md-8">
						<input class="form-control form-control-sm" id="nomorHP" type="text" value="${data.nomorhp}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="email">Email</label>
					</div>
					<div class="col-md-8">
						<input class="form-control form-control-sm" id="email" type="text" value="${data.email}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="alamat">Alamat</label>
					</div>
					<div class="col-md-8">
						<textarea class="form-control" rows="3" id="alamat">${data.alamat}</textarea>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="cabang">Cabang</label>
					</div>
					<div class="col-md-8">
						<select class="custom-select custom-select-sm" id="cabang"></select>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="instansi">Instansi</label>
					</div>
					<div class="col-md-8">
						<select class="custom-select custom-select-sm" id="instansi"></select>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="faskesAsal">Faskes Asal</label>
					</div>
					<div class="col-md-8">
						<select class="custom-select custom-select-sm" id="faskesAsal"></select>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="catatan">Catatan</label>
					</div>
					<div class="col-md-8">
						<textarea class="form-control" rows="3" id="catatan">${data.catatan}</textarea>
					</div>
				</div>
			</div>
			<div class="col-md">
				<h6>Data Pemeriksaan</h6><hr>
				<div class="row mb-1">
					<div class="col-md-4">
						<label for="tanggalKunjungan">Waktu Kunjungan</label>
					</div>
					<div class="col-md-5 col-8">
						<input disabled class="form-control form-control-sm" id="tanggalKunjungan" type="date" value="${data.tanggalkunjungan}">
					</div>
					<div class="col-md-3 col-4">
						<input disabled class="form-control form-control-sm" id="jamKunjungan" type="time" value="${data.jamkunjungan}">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="jenisPemeriksaan">Jenis Pemeriksaan</label>
					</div>
					<div class="col-md-8">
						<select class="custom-select custom-select-sm" id="jenisPemeriksaan" disabled></select>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md-4">
						<label for="tanggalAmbilSampling">Waktu Ambil Sampling</label>
					</div>
					<div class="col-md-5 col-8">
						<input class="form-control form-control-sm" id="tanggalAmbilSampling" type="date">
					</div>
					<div class="col-md-3 col-4">
						<input class="form-control form-control-sm" id="jamAmbilSampling" type="time">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md-4">
						<label for="tanggalPeriksaSampling">Waktu Periksa Sampling</label>
					</div>
					<div class="col-md-5 col-8">
						<input class="form-control form-control-sm" id="tanggalPeriksaSampling" type="date">
					</div>
					<div class="col-md-3 col-4">
						<input class="form-control form-control-sm" id="jamPeriksaSampling" type="time">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md-4">
						<label for="tanggalSelesaiSampling">Waktu Selesai Sampling</label>
					</div>
					<div class="col-md-5 col-8">
						<input class="form-control form-control-sm" id="tanggalSelesaiSampling" type="date">
					</div>
					<div class="col-md-3 col-4">
						<input class="form-control form-control-sm" id="jamSelesaiSampling" type="time">
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="jenisSample">Jenis Sample</label>
					</div>
					<div class="col-md-8">
						<select class="custom-select custom-select-sm" id="jenisSample"></select>
					</div>
				</div>
				${dataPemeriksaanHTML}
				<div class="row mb-1">
					<div class="col-md">
						<label for="dokterPemeriksa">Dokter Pemeriksa</label>
					</div>
					<div class="col-md-8">
						<select class="custom-select custom-select-sm" id="dokterPemeriksa"></select>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="petugasPemeriksa">Petugas Pemeriksa</label>
					</div>
					<div class="col-md-8">
						<select class="custom-select custom-select-sm" id="petugasPemeriksa"></select>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<label for="statusPemeriksaan">Status Pemeriksaan</label>
					</div>
					<div class="col-md-8">
						<select class="custom-select custom-select-sm" id="statusPemeriksaan"></select>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md">
						<label for="statusKirimHasil">Status Kirim Hasil</label>
					</div>
					<div class="col-md-8">
						<select class="custom-select custom-select-sm" id="statusKirimHasil"></select>
					</div>
				</div>
				<div class="row">
					<div class="col-md">
						<button class="btn btn-success btn-sm mb-1" id="btnSimpan">Simpan</button>
						<button class="btn btn-info btn-sm mb-1 ${(data.statuskirimhasil == 1)? '' : 'hide'}">Cetak Hasil (IDN)</button>
						<button class="btn btn-primary btn-sm mb-1 ${(data.statuskirimhasil == 1)? '' : 'hide'}">Cetak Hasil (EN)</button>
						<button class="btn btn-danger btn-sm mb-1 ${(data.statuskirimhasil == 1)? '' : 'hide'}">Kirm Hasil</button>
						<button class="btn btn-warning btn-sm mb-1 ${(data.statuskirimhasil == 1)? '' : 'hide'}">Kirim Email</button>
					</div>
				</div>
				<div class="row mb-1">
					<div class="col-md">
						<p class="text-danger">Mohon diperhatikan! Khusus sample dari Darya Klinik, pilihan faskesnya dipilih Darya Klinik.</p>
					</div>
				</div>
			</div>
		</div>
	</div>`;
}
function dataPemeriksaanHTML(data) {
	return `<div class="row mb-1">
			<div class="col-md">
				<label for="nCov">2019-nCov</label>
			</div>
			<div class="col-md-8">
				<select class="custom-select custom-select-sm" id="nCov"></select>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-md">
				<label for="nGene">N Gene</label>
			</div>
			<div class="col-md-8">
				<select class="custom-select custom-select-sm" id="nGene"></select>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-md">
				<label for="orf1ab">ORF1ab</label>
			</div>
			<div class="col-md-8">
				<select class="custom-select custom-select-sm" id="orf1ab"></select>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-md">
				<label for="ic">IC</label>
			</div>
			<div class="col-md-8">
				<input class="form-control form-control-sm" id="ic" type="text" value="${data.vic}">
			</div>
		</div>`;
}
function dataPemeriksaanRAHTML(data) {
	return `<div class="row mb-1">
			<div class="col-md">
				<label for="IgM">Anti SARS-CoV-2 IgM</label>
			</div>
			<div class="col-md-8">
				<select class="custom-select custom-select-sm" id="IgM"></select>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-md">
				<label for="IgG">Anti SARS-CoV-2 IgG</label>
			</div>
			<div class="col-md-8">
				<select class="custom-select custom-select-sm" id="IgG"></select>
			</div>
		</div>`;
}
function dataPemeriksaanSAHTML(data) {
	return `<div class="row mb-1">
			<div class="col-md">
				<label for="antigen">Antigen</label>
			</div>
			<div class="col-md-8">
				<select class="custom-select custom-select-sm" id="antigen"></select>
			</div>
		</div>`;
}
function dataPemeriksaanSMHTML(data) {
	return `<div class="row mb-1">
			<div class="col-md">
				<label for="swabMolecular">Swab Molecular</label>
			</div>
			<div class="col-md-8">
				<select class="custom-select custom-select-sm" id="swabMolecular"></select>
			</div>
		</div>`;
}