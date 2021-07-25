function formDeleteItemModal(data) {
	return `<input type="hidden" id="status" value="3">
	<input type="hidden" id="idDetail" value="${data.id}">
	<p>Do you really want to delete ${data.namaItem}?</p>`;
}
function tableCariItemHTML() {
	return `<div class="table-responsive">
		<table id="tableCariItem" class="fullWidth table table-striped table-bordered table-hover">
			<thead>
				<tr class="text-center">
					<th>Nama Item</th>
					<th>Unit Terbesar</th>
					<th>Stok Terbesar</th>
					<th>Unit Terkecil</th>
					<th>Stok Terkecil</th>
					<th></th>
					<th class="hidetd">id</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function formInputItemModal(status, data = '') {
	return `<div class="form-group">
		<input type="hidden" id="status" value="${status}">
		<input type="hidden" id="idDetail" value="${(!data.id)? '' : data.id}">
		<div class="row mb-2">
			<div class="col-md">
				<label for="namaItem">Nama Item</label>
				<select id="namaItem" class="form-control input-sm select2" style="width: 100%;"></select>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="stock">Stock</label>
				<input type="text" value="${(!data.stock)? '' : data.stock}" class="form-control form-control-sm" id="stock" disabled>
			</div>
			<div class="col-md">
				<label for="jumlah">Jumlah</label>
				<input type="text" value="${(!data.jumlah)? '' : data.jumlah}" class="form-control form-control-sm" id="jumlah">
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="ket">Keterangan</label>
				<textarea class="form-control" id="ket" rows="3">${(!data.note)? '' : data.note}</textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="spek">Spesifikasi</label>
				<textarea class="form-control" id="spek" rows="3">${(!data.spek)? '' : data.spek}</textarea>
			</div>
		</div>
	</div>`;
}
function formHTML() {
	return `<div class="row mb-4">
		<div class="col-md-6">
			<label for="noReq">No Request</label>
			<input type="text" class="form-control form-control-sm" id="noReq" readonly>
		</div>
	</div>
	<div class="row">
		<div class="col-md">
			<button class="btn btn-primary btn-sm" id="btnSave"><i class="fa fa-save"></i> Simpan Request</button>
			<button disabled class="btn btn-primary btn-sm" id="btnAddItem"><i class="fa fa-plus"></i> Tambah Item</button>
			<button disabled class="btn btn-primary btn-sm" id="btnSelesai"><i class="fa fa-check"></i> Selesai</button>
		</div>
	</div>`;
}
function tableItemHTML() {
	return `<div class="table-responsive mt-3">
		<table id="tableItem" class="fullWidth table table-striped table-bordered table-hover">
			<thead>
				<tr class="text-center">
					<th style="width: 65%;">Nama Item</th>
					<th style="width: 15%;">Jumlah</th>
					<th style="width: 20%;"></th>
					<th class="hidetd">id</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tableCariReq() {
	return `<div class="table-responsive">
		<table class="fullWidth table table-striped table-hover table-bordered" id="tableCariReq">
			<thead>
				<tr class="text-center">
					<th style="width: 75%;">No Request</th>
					<th style="width: 15%;">Tanggal</th>
					<th style="width: 10%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
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