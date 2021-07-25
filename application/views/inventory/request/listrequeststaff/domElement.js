function tableRequest() {
	return `<div class="table-responsive">
		<table id="tableReq" class="table table-striped table-hover table-bordered fullWidth">
			<thead>
				<tr class="text-center">
					<th>No Request</th>
					<th>Tanggal</th>
					<th>Nama Staff</th>
					<th>Email</th>
					<th>Status</th>
					<th>Department</th>
					<th>Posisi</th>
					<th style="width: 10%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tableSwaberHTML() {
	return `<button class="btn btn-primary btn-sm mb-2" disabled id="btnKonfirmasi">
		<i class="fa fa-check-circle"></i> Konfirmasi
	</button>
	<div class="table-responsive">
		<table class="table table-bordered table-hover table-striped fullWidth" id="tableSwaber">
			<thead>
				<tr class="text-center">
					<th>Nama Item</th>
					<th>Unit</th>
					<th>Stock</th>
					<th>Jumlah</th>
					<th style="width: 15%;">Sisa</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function headerHTML(noReq, keluar = 0) {
	return `<div class="row">
		<div class="col-md-2">
			<button class="btn btn-warning btn-sm" id="btnBack"><i class="fa fa-backward"></i> Back</button>
		</div>
	</div>
	<div class="row justify-content-end mb-2">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-3">
					<label for="noReq">No Request</label>
				</div>
				<div class="col-md">
					<input id="noReq" class="form-control form-control-sm" value="${noReq}" disabled>
				</div>
			</div>
		</div>
	</div>
	${(keluar == 1)? `<div class="row justify-content-end mb-2">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-3">
					<label for="noTransaksi">No Transaksi</label>
				</div>
				<div class="col-md">
					<input id="noTransaksi" class="form-control form-control-sm" disabled>
				</div>
			</div>
		</div>
	</div>
	<div class="row justify-content-end">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-3">
					<label for="tanggal">Tanggal</label>
				</div>
				<div class="col-md">
					<input id="tanggal" type="date" class="form-control form-control-sm">
				</div>
			</div>
		</div>
	</div>` : ''}`;
}
function tableDetailStaffHTML() {
	return `<table id="tableReqDetail" class="fullWidth table table-striped table-hover table-bordered">
			<thead>
				<tr class="text-center">
					<th style="width: 80%;">Nama Item</th>
					<th style="width: 20%;">Jumlah</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tableDetailHTML() {
	return `<button id="btnConfirm" class="btn btn-primary btn-sm mb-2"><i class="fa fa-check-circle"></i> Konfirmasi</button>
	<div class="table-responsive">
		<table id="tableReqDetail" class="fullWidth table table-striped table-hover table-bordered">
			<thead>
				<tr class="text-center">
					<th style="width: 65%;">Nama Item</th>
					<th style="width: 15%;">Jumlah</th>
					<th style="width: 20%;">Edit</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tableDetailDiprosesStaffHTML() {
	return `<table id="tableReqDetail" class="fullWidth table table-striped table-hover table-bordered">
			<thead>
				<tr class="text-center">
					<th style="width: 60%;">Nama Item</th>
					<th style="width: 20%;">Jumlah Request</th>
					<th style="width: 20%;">Jumlah yang Dikonfirmasi</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tableDetailDiprosesManagerHTML() {
	return `<button id="btnConfirm" class="btn btn-primary btn-sm mb-2"><i class="fa fa-check-circle"></i> Konfirmasi</button>
	<div class="table-responsive">
		<table id="tableReqDetail" class="fullWidth table table-striped table-hover table-bordered">
			<thead>
				<tr class="text-center">
					<th style="width: 80%;">Nama Item</th>
					<th style="width: 20%;">Jumlah</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tableDetailKeluarHTML() {
	return `<button id="btnConfirm" class="btn btn-primary btn-sm mb-2" disabled>
		<i class="fa fa-check-circle"></i> Konfirmasi
	</button>
	<button id="btnDelivery" class="btn btn-primary btn-sm mb-2" disabled>
		<i class="fas fa-clipboard-check"></i> Delivery
	</button>
	<div class="table-responsive">
		<table id="tableReqDetail" class="fullWidth table table-striped table-hover table-bordered">
			<thead>
				<tr class="text-center">
					<th style="width: 30%;">Nama Item</th>
					<th style="width: 20%;">Master</th>
					<th style="width: 10%;">Jumlah</th>
					<th style="width: 20%;">Jumlah yang Dikonfirmasi</th>
					<th style="width: 20%;">Jumlah yang Dikeluarkan</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tableDetailDiprosesHTML() {
	return `<button id="btnDelivery" class="btn btn-primary btn-sm mb-2">
		<i class="fas fa-clipboard-check"></i> Delivery
	</button>
	<div class="table-responsive">
		<table id="tableReqDetail" class="fullWidth table table-striped table-hover table-bordered">
			<thead>
				<tr class="text-center">
					<th style="width: 10%;">
						<div class="pretty p-default text-center">
						    <input type="checkbox" id="cekAll">
							<div class="state p-success">
								<label></label>
							</div>
						</div>
					</th>
					<th style="width: 50%;">Nama Item</th>
					<th style="width: 20%;">Master</th>
					<th style="width: 10%;">Jumlah</th>
					<th style="width: 10%;">Edit Jumlah</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tableCariItemHTML(id) {
	return `<div class="table-responsive">
		<input type="hidden" id="idItemDetail" value="${id}">
		<table class="table table-striped table-bordered table-hover" id="tableCariItem" style="width: 100%;">
			<thead>
				<tr class="text-center">
					<th>Nama Item</th>
					<th>Satuan Terbesar</th>
					<th>Satuan Terkecil</th>
					<th></th>
					<th class="hidetd">id</th>
				</tr>
			</thead>
		</table>
	</div`;
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
function formValidasiHTML(data) {
	return `<div class="form-group">
		<input type="hidden" id="idValidasi" value="${data.id}">
		<div class="row">
			<div class="col-md">
				<label for="namaItemValidasi">Nama Item</label>
				<input id="namaItemValidasi" class="form-control form-control-sm" value="${data.namaItem}" disabled>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="jumlahItemValidasi">Jumlah Request</label>
				<input id="jumlahItemValidasi" class="form-control form-control-sm" value="${data.jmlReview}">
			</div>
		</div>
	</div>`;
}
function ubahHTML(id) {
	return `<div class="form-group">
		<input type="hidden" id="idUbah" value="${id}">
		<label for="namaItemUbah">Nama Item</label>
		<select class="form-control form-control-sm input-sm select2" id="namaItemUbah" style="width: 100%;"></select>
		<label for="stockUbah">Stock</label>
		<input class="form-control form-control-sm" id="stockUbah" disabled type="text">
	</div>`;
}
function formAddHTML(id, data = '') {
	return `<div class="form-group">
		<input type="hidden" value="${id}" id="idDetail">
		<div class="row">
			<div class="col-md-4">
				<label for="kategori">Kategori</label>
				<select class="custom-select custom-select-sm" id="kategori"></select>
			</div>
			<div class="col-md">
				<label for="namaItem">Nama Item</label>
				<input value="${data.namaItem}" class="form-control form-control-sm" id="namaItem" type="text">
			</div>
		</div>
		<div class="row">
			<input class="form-control form-control-sm" id="jmlTerbesar" type="hidden" value="1">
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
				<input class="form-control form-control-sm" id="jmlTerkecil">
			</div>
		</div>
	</div>`;
}
function formEditJumlahHTML(data) {
	return `<div class="form-group">
		<input type="hidden" id="idEditJumlah" value="${data.id}">
		<div class="row">
			<div class="col-md">
				<label for="namaItemEditJumlah">Nama Item</label>
				<input id="namaItemEditJumlah" class="form-control form-control-sm" value="${data.namaItem}" disabled>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="jmlEditJumlah">Jumlah Request</label>
				<input id="jmlEditJumlah" class="form-control form-control-sm" value="${data.jmlAktual}">
			</div>
		</div>
	</div>`;
}