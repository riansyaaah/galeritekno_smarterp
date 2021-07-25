function formHapus(data) {
	return `<input type="hidden" value="${data.id}" id="idHapus">
	<p>Anda yakin ingin menghapus item ${data.itemmaster}?</p>`;
}
function formUtamaHTML() {
	return `<div class="form-group">
		<div class="row">
			<div class="col-md-7">
				<div class="row mb-2">
					<div class="col-md-4">
						<label for="kodeSupplier">Kode Supplier</label>
					</div>
					<div class="col-md">
						<div class="input-group">
							<input type="text" class="form-control form-control-sm" id="kodeSupplier" disabled>
							<span class="input-group-append">
								<button class="btn btn-primary btn-sm" id="btnCariSupplier">
									<i class="fa fa-list-ul"></i>
								</button>
							</span>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-4">
						<label for="namaSupplier">Nama Supplier</label>
					</div>
					<div class="col-md">
						<input type="text" class="form-control form-control-sm" id="namaSupplier" disabled>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-md-4">
						<label for="tanggal">Tanggal</label>
					</div>
					<div class="col-md">
						<input type="date" class="form-control form-control-sm" id="tanggal" disabled>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="noPO">No Purchase Order</label>
					</div>
					<div class="col-md">
						<input type="text" class="form-control form-control-sm" id="noPO" disabled>
					</div>
				</div>
				<div class="row mt-3 mb-3">
					<div class="col-md">
						<button id="btnSavePO" class="btn btn-primary btn-sm" disabled>
							<i class="fa fa-plus"></i> Simpan PO
						</button>
						<button id="btnAdd" class="btn btn-primary btn-sm" disabled>
							<i class="fa fa-plus"></i> Tambah Item
						</button>
						<button id="btnPrint" class="btn btn-primary btn-sm" disabled>
							<i class="fa fa-save"></i> Cetak
						</button>
						<button id="btnSelesai" class="btn btn-primary btn-sm" disabled>
							<i class="fa fa-check"></i> Selesai
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>`;
}
function cariItemHTML() {
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
function tablePODetailHTML() {
	return `<div class="table-responsive">
		<table id="tablePODetail" class="table table-striped table-hover table-bordered fullWidth">
			<thead>
				<tr class="text-center">
					<th style="width: 35%;">Nama Item</th>
					<th style="width: 10%;">Unit</th>
					<th style="width: 10%;">Jumlah</th>
					<th style="width: 15%;">Harga Satuan</th>
					<th style="width: 25%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tableCariSupplierHTML() {
	return `<div class="table-responsive">
		<table id="tableCariSupplier" class="table table-striped table-hover table-bordered fullWidth">
			<thead>
				<tr class="text-center">
					<th style="width: 20%">Kode</th>
					<th style="width: 70%">Nama</th>
					<th style="width: 10%"></th>
					<th class="hidetd">tipe</th>
				</tr>
			</thead>
		</table>
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
					${(saveBtn == 0)? '' : `<button ${(judul.includes('Tambah'))? 'disabled' : ''} id="${idBtn}" type="button" class="btn btn-primary">Konfirmasi</button>`}
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>`;
}