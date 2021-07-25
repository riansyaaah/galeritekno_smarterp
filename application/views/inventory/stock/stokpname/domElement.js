function tableUtamaHTML() {
    return `<table class="table-responsive">
        <table id="tableUtama" class="fullWidth table table-hover table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Nama Item</th>
                    <th style="width: 20%;">Stok Terbesar</th>
                    <th style="width: 20%;">Stok Terkecil</th>
                    <th class="hidetd">id</th>
                    <th style="width: 12%;"></th>
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
function modalOpnameHTML(data) {
	return `<div class="form-group">
		<input type="hidden" id="idItem" value="${data.id}">
		<div class="row">
			<div class="col-md">
				<label for="namaItem">Nama Item</label>
				<input type="text" class="form-control form-control-sm" disabled id="namaItem" value="${data.itemmaster}">
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="tanggal">Tanggal</label>
				<input type="date" class="form-control form-control-sm" id="tanggal" value="${sekarang}">
			</div>
			<div class="col-md">
				<label for="stockSekarang">Stok</label>
				<input type="text" class="form-control form-control-sm" disabled id="stockSekarang" value="${data.stock}">
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="realStock">Stok Terkecil</label>
				<input type="text" class="form-control form-control-sm" id="realStock">
			</div>
			<div class="col-md">
				<label for="stockBesar">Stok Terbesar</label>
				<input type="text" class="form-control form-control-sm" id="stockBesar" disabled>
			</div>
		</div>
	</div>`;
}