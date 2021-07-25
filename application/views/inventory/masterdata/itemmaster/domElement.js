function headerHTML() {
	return `<div class="row mb-2">
		<div class="col-md">
			<button class="btn btn-primary btn-sm" id="btnAdd">
				<i class="fa fa-plus"></i> Tambah Item
			</button>
		</div>
	</div>`;
}
function tableUtamaHTML() {
	return `<div class="table-responsive">
		<table class="table table-hover table-bordered" id="tableUtama" style="width: 100%;">
			<thead>
				<tr class="text-center">
					<th>Kategori</th>
					<th>Sifat</th>
					<th>Jenis</th>
					<th>Nama Item</th>
					<th>Stok Terbesar</th>
					<th>Stok Terkecil</th>
					<th style="width: 16%;"></th>
					<th class="hidetd">id</th>
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
function formAddHTML(status, data = '') {
	return `<div class="form-group">
		<input id="status" value="${status}" type="hidden">
		<div class="row">
			<div class="col-md">
				<label for="fixed">Kategori</label>
				<select class="custom-select custom-select-sm" id="fixed"></select>
			</div>
			<div class="col-md">
				<label for="bhp">Sifat</label>
				<select class="custom-select custom-select-sm" id="bhp" disabled></select>
			</div>
			<div class="col-md">
				<label for="kategori">Jenis Barang</label>
				<select class="custom-select custom-select-sm" id="kategori"></select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<label for="accountNo">Account No</label>
				<div class="input-group">
					<input type="text" class="form-control form-control-sm" id="accountNo" disabled value="${(!data)? '' : data.accountNo}">
					<span class="input-group-append">
						<button class="btn btn-primary btn-sm" id="btnCariAccountNo">
							<i class="fa fa-list-ul"></i>
						</button>
					</span>
				</div>
			</div>
			<div class="col-md">
				<label for="namaItem">Nama Item</label>
				<input value="${(!data)? '' : data.itemmaster}" class="form-control form-control-sm" id="namaItem" type="text">
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="unitTerbesar">Unit Terbesar</label>
				<select class="custom-select custom-select-sm" id="unitTerbesar"></select>
			</div>
			<div class="col-md">
				<label for="unitTerkecil">Unit Terkecil</label>
				<select class="custom-select custom-select-sm" id="unitTerkecil"></select>
			</div>
			<div class="col-md">
				<label for="jmlTerkecil">Jumlah Terkecil</label>
				<input class="form-control form-control-sm" id="jmlTerkecil" value="${(!data)? '' : data.jumlahTerkecil}">
			</div>
		</div>
	</div>`;
}
function formDeleteHTML(data) {
	return `<input type="hidden" id="idHapus" value="${data.id}">
	<p>Anda yakin ingin menghapus item dengan nama ${data.itemmaster}?</p>`;
}
function tableAccountHTML() {
	return `<div class="table-responsive">
		<table class="table table-bordered table-hover table-striped" id="tableCariAccount" style="width: 100%;">
			<thead>
				<tr>
					<th style="width: 15%;">Account No</th>
					<th style="width: 70%;">Account Name</th>
					<th style="width: 15%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}