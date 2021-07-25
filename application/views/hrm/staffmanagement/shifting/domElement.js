function formDelete(data) {
	return `<input type="hidden" value="${data.id}" id="idDelete">
	<p>Do you really want to delete ${data.id_personel} at Shift ${data.shift} (${data.date})?</p>`;
}
function tableCariStaff() {
	return `<div class="table-responsive">
		<table id="tableCariStaff" class="table  table-hover table-bordered" style="width: 100%">
			<thead>
				<tr class="text-center">
					<th>Personel ID</th>
					<th>Name</th>
					<th>Department</th>
					<th>Position</th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function modalElement(idModal, idBtn, judul, form, ukuran = '') {
	return `<div class="modal fade" id="${idModal}" role="dialog" aria-hidden="true">
	    <div class="modal-dialog modal-dialog-centered ${ukuran}" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">${judul}</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">${form}</div>
	            <div class="modal-footer bg-whitesmoke br">
	                ${(idBtn != '')? `<button class="btn btn-primary" type="button" id="${idBtn}"><i class="fa fa-check"></i> ${(judul.includes('Delete'))? 'Confirm' : 'Save'}</button>` : ''}
	                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
	            </div>
	        </div>
	    </div>
	</div>`;
}
function formAdd() {
	return `<div class="table-responsive">
		<table id="tableAdd" class="table table-hover table-bordered" style="width: 100%">
			<thead>
				<tr class="text-center">
					<th>Personel ID</th>
					<th>Name</th>
					<th>Department</th>
					<th>Position</th>
					<th>Select</th>
					<th class="hidetd">id</th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function tableHTML() {
	return `<div class="table-responsive">
		<button class="btn btn-primary btn-sm mb-2" id="btnAdd">
			<i class="fa fa-plus"></i> Add Staff
		</button>
		<table id="tableShift" class="table table-hover table-bordered" style="width: 100%">
			<thead>
				<tr class="text-center">
					<th>No</th>
					<th>Date</th>
					<th>Personel ID</th>
					<th>Name</th>
					<th>Department</th>
					<th>Position</th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function workHourHTML() {
	return `<div class="card-header">
		<h4>Work Hour</h4><hr>
	</div>
	<div class="card-body" id="demo">
		<div class="table-responsive">
			<table id="tableWorkHour" class="table table-hover table-bordered" style="width: 100%">
				<thead>
					<tr class="text-center">
						<th style="width: 15%;">ID Personel</th>
						<th style="width: 35%;">Name</th>
						<th style="width: 20%;">Department</th>
						<th style="width: 20%;">Position</th>
						<th style="width: 10%;">Work Hour</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>`;
}
function formCariPeriode() {
	return `<div class="table-responsive">
		<table id="tableCariPeriode" class="table  table-bordered table-hover">
			<thead>
				<tr class="text-center">
					<th style="width: 10%;">No</th>
					<th>Bulan</th>
					<th>Tahun</th>
					<th>Periode</th>
					<th style="width: 10%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function formHTML() {
	return `<div class="form-group row">
		<div class="col-md">
			<label for="period" class="font-weight-bold">Period</label>
			<div class="input-group">
				<input type="text" value="" id="period" class="form-control form-control-sm" readonly>
				<span class="input-group-append">
					<button class="btn btn-primary btn-sm" id="btnCariPeriode">
						<i class="fa fa-list-ul" id="btnCariPeriode"></i>
					</button>
				</span>
			</div>
		</div>
		<div class="col-md">
			<label for="start_date" class="font-weight-bold">Start Date</label>
			<input type="date" id="start_date" class="form-control form-control-sm">
		</div>
		<div class=" col-md">
			<label for="end_date" class="font-weight-bold">End Date</label>
			<input type="date" id="end_date" class="form-control form-control-sm" readonly>
		</div>
		<div class="col-md">
			<label for="shift_id" class="font-weight-bold">Shift</label>
			<select name="shift_id" id="shift_id" class="custom-select custom-select-sm" disabled>
				<option value="">Please Select</option>
			</select>
		</div>
	</div>`;
}
function formSwap(data) {
	return `<div class="form-group">
		<input type="hidden" id="idSwap" value="${data.id}">
		<div class="row">
			<div class="col-md">
				<label for="idPersonel">Personel ID</label>
				<div class="input-group">
					<input value="${data.id_personel}" type="text" class="form-control form-control-sm" id="idPersonel" readonly>
					<span class="input-group-append">
						<button class="btn btn-primary btn-sm" id="btnCariStaff">
							<i class="fa fa fa-list-ul"></i>
						</button>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="nama">Name</label>
				<input value="${`${data.first_name} ${data.last_name}`}" type="text" class="form-control form-control-sm" id="nama" readonly>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="tanggal">Date</label>
				<input type="date" value="${data.date}" class="form-control form-control-sm" id="tanggal" readonly>
			</div>
			<div class="col-md">
				<label for="shift">Shift</label>
				<input type="text" value="Shift ${data.shift}" class="form-control form-control-sm" id="shift" readonly>
			</div>
		</div>
	</div>`;
}
function formEdit(data) {
	return `<div class="form-group">
		<input type="hidden" id="idEdit" value="${data.id}">
		<div class="row">
			<div class="col-md">
				<label for="idPersonel">Personel ID</label>
				<input value="${data.id_personel}" type="text" class="form-control form-control-sm" id="idPersonel" readonly>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="nama">Name</label>
				<input value="${`${data.first_name} ${data.last_name}`}" type="text" class="form-control form-control-sm" id="nama" readonly>
			</div>
		</div>
		<div class="row">
			<div class="col-md">
				<label for="tanggal">Date</label>
				<input type="date" value="${data.date}" class="form-control form-control-sm" id="tanggal" readonly>
			</div>
			<div class="col-md">
				<label for="shift">Shift</label>
				<select class="custom-select custom-select-sm" id="shift"></select>
			</div>
		</div>
	</div>`;
}