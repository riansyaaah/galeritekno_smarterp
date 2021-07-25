function formHapusHTML(data) {
	return `<input type="hidden" value="${data.id}" id="idHapus">
	<p>Anda yakin ingin menghapus item ${data.itemmaster}?</p>`;
}
function tablePOHTML() {
	return `<div class="table-responsive">
		<table id="tablePO" class="fullWidth table table-striped table-hover table-bordered">
			<thead>
				<tr class="text-center">
					<th style="width: 15%;">Tanggal</th>
					<th style="width: 20%;">No Purchase Order</th>
					<th style="width: 45%;">Supplier</th>
					<th style="width: 10%;">Status</th>
					<th style="width: 10%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function headerHTML(data, tipe) {
	return `<div class="form-group">
		<div class="row mb-4">
			<div class="col-md">
				<button class="btn btn-warning btn-sm" id="btnBack">
					<i class="fa fa-backward"></i> Kembali
				</button>
			</div>
		</div>
		<input type="hidden" id="rev" value="${parseInt(data.rev)+1}">
		<div class="row">
			<div class="col-md-6">
				<div class="row mb-1">
					<div class="col-md-4">
						<label for="noPO">No Purchase Order</label>
					</div>
					<div class="col-md">
						<input value="${data.noPO}" class="form-control form-control-sm" id="noPO" disabled>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="supplier">Supplier</label>
					</div>
					<div class="col-md">
						<input value="${data.nama}" class="form-control form-control-sm" id="supplier" data-tipe="${tipe}" disabled>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-md">
				<button class="btn btn-primary btn-sm" id="btnAdd">
					<i class="fa fa-plus"></i> Tambah Item
				</button>
				<button class="btn btn-primary btn-sm" id="btnPrint">
					<i class="fa fa-print"></i> Cetak
				</button>
			</div>
		</div>
	</div>`;
}
function tablePODetailHTML() {
	return `<div class="table-responsive">
		<table id="tablePODetail" class="table table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th style="width: 40%;">Nama Item</th>
					<th style="width: 15%;">Unit</th>
					<th style="width: 10%;">Jumlah</th>
					<th style="width: 15%;">Harga Satuan</th>
					<th style="width: 20%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tablePODetailSelesaiHTML() {
	return `<div class="table-responsive">
		<table id="tablePODetail" class="table table-striped table-hover table-bordered">
			<thead>
				<tr>
					<th style="width: 45%;">Nama Item</th>
					<th style="width: 20%;">Unit</th>
					<th style="width: 15%;">Jumlah</th>
					<th style="width: 20%;">Harga Satuan</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function modalHTML(idModal, judul, idBtn, body, ukuran = '', saveBtn = 1) {
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
					${(saveBtn == 0)? '' : `<button id="${idBtn}" type="button" class="btn btn-primary">Konfirmasi</button>`}
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>`;
}
function formAddItemHTML(data = '') {
	return `<div class="form-group">
		<input type="hidden" id="status" value="${(data == '')? 1 : 2}">
		<div class="row">
			<div class="col-md">
				<label for="namaItem">Nama Item</label>
				<div class="input-group">
					<input type="text" value="${(!data.itemmaster)? '' : data.itemmaster}" disabled class="form-control form-control-sm" id="namaItem" data-id="${(!data.idItemMaster)? '' : data.idItemMaster}">
					<span class="input-group-append">
						<button class="btn btn-primary btn-sm" id="btnCariItem">
							<i class="fa fa-list-ul"></i>
						</button>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="unit">Unit</label>
				<input value="${(!data.unit)? '' : data.unit}" type="text" class="form-control form-control-sm" id="unit" disabled>
			</div>
			<div class="col-md">
				<label for="jumlah">Jumlah</label>
				<input type="text" value="${(!data.jumlah)? '' : data.jumlah}" class="form-control form-control-sm" id="jumlah">
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="hargaSatuan">Harga Satuan</label>
				<input type="text" value="${(!data.hargaSatuan)? '' : data.hargaSatuan}" class="form-control form-control-sm" id="hargaSatuan">
			</div>
		</div>
	</div>`;
}
function tableCariItemHTML() {
	return `<div class="table-responsive">
		<table id="tableCariItem" class="table table-striped table-hover table-bordered fullWidth">
			<thead>
				<tr class="text-center">
					<th>Nama Item</th>
					<th style="width: 20%;">Unit</th>
					<th style="width: 10%;"></th>
					<th class="hidetd">id</th>
				</tr>
			</thead>
		</table>
	</div>`;
}