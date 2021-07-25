function modalHTML(idModal, judul, body, idBtn = '', ukuran = '') {
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
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					${(idBtn)? `<button type="button" id="${idBtn}" class="btn btn-primary">Konfirmasi</button>` : ''}
				</div>
			</div>
		</div>
	</div>`;
}
function formHapusHTML(data) {
	return `<input type="hidden" id="idHapus" value="${data.id}">
	<p>Anda yakin ingin menghapus data dengan nama produk ${data.namaProduk} dan nama toko ${data.namaToko}?</p>`;
}
function formAddHTML(status, data = '') {
	return `<input type="hidden" id="status" value="${status}">
	<input type="hidden" id="idDetail" value="${(!data)? '' : data.id}">
	<div class="form-group">
		<h6>Produk & Toko</h6>
		<div class="row">
			<div class="col-md">
				<label for="namaToko">Nama Toko</label>
				<input type="text" class="form-control form-control-sm" id="namaToko" value="${(!data)? '' : data.namaToko}">
			</div>
			<div class="col-md">
				<label for="namaProduk">Nama Produk</label>
				<input type="text" class="form-control form-control-sm" id="namaProduk" value="${(!data)? '' : data.namaProduk}">
			</div>
			<div class="col-md">
				<label for="gambar">Gambar Produk</label>
				<input type="file" class="form-control form-control-sm" id="gambar" value="${(!data)? '' : data.gambarProduk}">
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<label for="lokasi">Lokasi</label>
				<input type="text" class="form-control form-control-sm" id="lokasi" value="${(!data)? '' : data.lokasi}">
			</div>
			<div class="col-md-4">
				<label for="bonus">Bonus</label>
				<input type="text" class="form-control form-control-sm" id="bonus" value="${(!data)? '' : data.bonus}">
			</div>
		</div><hr>
		<h6 class="mt-3">Spesifikasi</h6>
		<div class="row">
			<div class="col-md">
				<label for="warna">Warna</label>
				<input type="text" class="form-control form-control-sm" id="warna" value="${(!data)? '' : data.warna}">
			</div>
			<div class="col-md">
				<label for="ukuran">Ukuran</label>
				<input type="text" class="form-control form-control-sm" id="ukuran" value="${(!data)? '' : data.ukuran}">
			</div>
			<div class="col-md">
				<label for="kelengkapan">Kelengkapan</label>
				<input type="text" class="form-control form-control-sm" id="kelengkapan" value="${(!data)? '' : data.kelengkapan}">
			</div>
		</div><hr>
		<h6 class="mt-3">Biaya</h6>
		<div class="row">
			<div class="col-md">
				<label for="hargaSatuan">Harga Satuan</label>
				<input type="text" class="form-control form-control-sm" id="hargaSatuan" value="${(!data)? '' : data.hargaSatuan}">
			</div>
			<div class="col-md">
				<label for="ongkir">Ongkos Kirim</label>
				<input type="text" class="form-control form-control-sm" id="ongkir" value="${(!data)? '' : data.ongkir}">
			</div>
			<div class="col-md">
				<label for="estimasi">Estimasi</label>
				<input type="text" class="form-control form-control-sm" id="estimasi" value="${(!data)? '' : data.estimasi}">
			</div>
		</div>
	</div>`;
}
function recommendTableHTML() {
	return `<div class="row">
		<div class="col-md">
			<button class="btn btn-primary mb-2 btn-sm" id="btnNew">
				<i class="fa fa-plus"></i> Tambah Baru
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md">
			<div class="table-responsive">
				<table id="tableRequest" class="fullWidth table table-striped table-hover table-bordered">
					<thead>
						<tr class="text-center">
							<th style="width: 10%;">No</th>
							<th>No Berita Acara</th>
							<th>Tanggal</th>
							<th style="width: 10%;"></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>`;
}
function detailTableHTML() {
	return `<div class="table-responsive">
		<table id="tableDetail" class="fullWidth table table-striped table-hover table-bordered">
			<thead>
				<tr class="text-center">
					<th style="width: 16.5%;">Nama Toko</th>
					<th style="width: 16.5%;">Nama Produk</th>
					<th style="width: 13.5%;">Harga Satuan</th>
					<th style="width: 13.5%;">Ongkos Kirim</th>
					<th style="width: 12%;">Lokasi</th>
					<th style="width: 10%;">Estimasi</th>
					<th style="width: 18%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function formAddNewHTML(data = null) {
	return `<button class="btn btn-warning btn-sm mb-2" id="btnBack">
		<i class="fa fa-backward"></i> Kembali
	</button>
	<div class="form-group">
		<div class="row mb-3">
			<div class="col-md">
				<label for="noRecommend">No Berita Acara</label>
				<input type="text" class="form-control form-control-sm" id="noRecommend" ${(!data)? '' : `value="${data.noRecommend}" readonly`}>
			</div>
			<div class="col-md">
				<label for="tglRecommend">Tanggal</label>
				<input id="tglRecommend" class="form-control form-control-sm" type="date" ${(!data)? '' : `value="${data.tglRecommend}" readonly`}>
			</div>
		</div>
		<div class="row>
			<div class="col-md">
				<button class="btn btn-primary btn-sm" id="btnSave" disabled>
					<i class="fa fa-save"></i> Simpan Berita Acara
				</button>
				<button class="btn btn-success btn-sm" id="btnAdd" ${(!data)? 'disabled' : ''}>
					<i class="fa fa-plus"></i> Tambah Data
				</button>
				<button class="btn btn-sm" id="btnPrint" style="background-color: #964B00; color: white;" ${(!data)? 'disabled' : ''}>
					<i class="fa fa-print"></i> Cetak
				</button>
			</div>
		</div>
	</div>`;
}