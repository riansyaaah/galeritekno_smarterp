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
function tableUtama() {
	return `<div class="table-responsive">
		<table class="table table-bordered table-hover fullWidth" id="tableUtama" >
			<thead>
				<tr class="text-center">
					<th style="width: 12%;">Tanggal</th>
					<th>Nama Item</th>
					<th style="width: 15%;">Jumlah Lama</th>
					<th style="width: 15%;">Jumlah Baru</th>
				</tr>
			</thead>
		</table>
	</div>`;
}