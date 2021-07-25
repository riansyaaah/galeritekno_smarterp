function tablePOHTML() {
	return 	`<div class="table-responsive">
		<table id="tablePO" class="table table-hover table-striped table-bordered fullWidth">
			<thead>
				<tr class="text-center">
					<th>No Internal PO</th>
					<th>Tanggal</th>
					<th>Nama Staff</th>
					<th>Email</th>
					<th>Department</th>
					<th>Status</th>
					<th style="width: 10%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function headerDetailHTML(noPO) {
	return `<div class="row mb-3">
		<div class="col-md">
			<button id="btnBack" class="btn btn-warning btn-sm">
				<i class="fa fa-backward"></i> Back
			</button>
		</div>
		<div class="col-md">
			<div class="row">
				<div class="col-md-3">
					<label for="noPO">No Internal PO</label>
				</div>
				<div class="col-md">
					<input value="${noPO}" type="text" disabled class="form-control form-control-sm" id="noPO">
				</div>
			</div>
		</div>
	</div>
	<div className="row">
		<div className="col-md">
			<button class="btn btn-primary btn-sm float-right mb-2" id="btnKonfirmasi" disabled>
				<i class="fa fa-check-circle"></i> Konfirmasi
			</button>
		</div>
	</div>`;
}
function tablePODetailHTML() {
	return 	`<div class="table-responsive">
		<table id="tablePODetail" class="table table-hover table-striped table-bordered fullWidth">
			<thead>
				<tr class="text-center">
					<th style="width: 43%;">Nama Item</th>
					<th style="width: 15%;">Unit</th>
					<th style="width: 15%;">Jumlah</th>
					<th style="width: 17%;">Jumlah yang Dikonfirmasi</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tablePODetailManagerMenunggulHTML() {
	return 	`<div class="table-responsive">
		<table id="tablePODetail" class="table table-hover table-striped table-bordered fullWidth">
			<thead>
				<tr class="text-center">
					<th style="width: 60%;">Nama Item</th>
					<th style="width: 20%;">Unit</th>
					<th style="width: 20%;">Jumlah</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function modalHTML(idModal, judul, body) {
	return `<div class="modal" id="${idModal}" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">${judul}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">${body}</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>`;
}