function anchorPrint(noPO) {
	return `<a href="${baseUrl}print?noPO=${noPO}" target="_blank" id="btnCetak"></a>`;
}
function formDeleteItem(data) {
	return `<input type="hidden" id="idDelete" value="${data.id}">
		<p>Do you really want to delete ${data.namaItem}?</p>
	`;
}
function formAddItem(status, data = '') {
	return `<div class="form-group" id="formItem" data-status="${status}" data-iddetail="${(!data.id)? '' : data.id}">
		<input type="hidden" id="idItem">
		<div class="row">
			<div class="col-md">
				<label for="namaItem">Item</label>
				<input type="text" value="${(!data.namaItem)? '' : data.namaItem}" class="form-control form-control-sm" id="namaItem">
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="jumlah">Jumlah</label>
				<input value="${(!data.jumlah)? '' : data.jumlah}" type="text" id="jumlah" class="form-control form-control-sm">
			</div>
			<div class="col-md">
				<label for="unit">Unit</label>
				<select class="custom-select custom-select-sm" id="unit"></select>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="ket">Keterangan</label>
				<textarea class="form-control" id="ket" rows="3">${(!data.note)? '' : data.note}</textarea>
			</div>
		</div>
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
					${(saveBtn == 0)? '' : `<button id="${idBtn}" type="button" class="btn btn-primary">${(judul.includes('Delete'))? 'Confirm' : 'Save'}</button>`}
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>`;
}
function tableCariPOHTML() {
	return `<div class="table-responsive">
		<table id="tableCariPO" class="fullWidth table table-striped table-bordered table-hover">
			<thead>
				<tr class="text-center">
					<th>No</th>
					<th>Tanggal</th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tableUtamaHTML() {
	return `<button class="btn btn-primary btn-sm" id="btnSavePO">
		<i class="fa fa-save"></i> Simpan PO
	</button>
	<button class="btn btn-primary btn-sm" id="btnAddItem" disabled>
		<i class="fa fa-plus"></i> Tambah Item
	</button>
	<button class="btn btn-primary btn-sm" id="btnPrint" disabled>
		<i class="fa fa-print"></i> Print PO
	</button>
	<button class="btn btn-primary btn-sm" id="btnSelesai" disabled>
		<i class="fa fa-check"></i> Selesai
	</button>
	<div id="print"></div>
	<div class="table-responsive mt-2">
		<table class="table fullWidth table-striped table-hover table-bordered" id="tableItem">
			<thead>
				<tr class="text-center">
					<th style="width: 50%">Item</th>
					<th style="width: 15%">Jumlah</th>
					<th style="width: 15%">Unit</th>
					<th style="width: 20%"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function formHTML() {
	return `<div class="row">
		<div class="col-md-6">
			<label for="noPO">No Internal Purchase Order</label>
			<input type="text" id="noPO" class="form-control form-control-sm" disabled>
		</div>
	</div>`;
}
function tableCariItem() {
	return `<div class="table-responsive">
		<table id="tableCariItem" class="table table-striped table-hover table-bordered fullWidth">
			<thead>
				<tr class="text-center">
					<th>Nama Item</th>
					<th>Stok</th>
					<th>Unit</th>
					<th></th>
					<th class="hidetd">id</th>
				</tr>
			</thead>
		</table>
	</div>`;
}