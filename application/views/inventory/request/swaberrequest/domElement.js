function formUtamaHTML() {
	return `<div class="form-group">
		<div class="row">
			<div class="col-md">
				<label for="noReq">No Request</label>
				<input disabled class="form-control form-control-sm" id="noReq">
				<label for="tanggal">Tanggal Pengambilan</label>
				<input type="date" class="form-control form-control-sm" id="tanggal">
				<label for="jamAmbil">Jam Pengambilan</label>
				<input class="form-control form-control-sm" id="jamAmbil" type="time">
			</div>
			<div class="col-md">
				<label for="lokasi">Lokasi</label>
				<input class="form-control form-control-sm" id="lokasi">
				<label for="totalPasien">Total Pasien</label>
				<input class="form-control form-control-sm" id="totalPasien">
				<label for="keperluan">Keperluan</label>
				<select id="keperluan" class="custom-select custom-select-sm">
					<option value="">Pilih salah satu</option>
					<option value="Homecare">Homecare</option>
					<option value="Corporate">Corporate</option>
				</select>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-md">
				<button class="btn btn-primary btn-sm" id="btnBuatRequest" disabled>
					<i class="fas fa-file-alt"></i> Buat Request
				</button>
				<button class="btn btn-primary btn-sm" id="btnSaveRequest" disabled>
					<i class="fa fa-plus"></i> Simpan Request
				</button>
				<button class="btn btn-primary btn-sm" id="btnSelesai" disabled>
					<i class="fa fa-check"></i> Selesai
				</button>
			</div>
		</div>
	</div>`;
}
function tableDetail() {
	return `<div class="table-responsive">
		<table id="tableDetail" class="table table-striped table-hover table-bordered fullWidth">
			<thead>
				<tr class="text-center">
					<th style="width: 55%;">Nama Item</th>
					<th style="width: 15%;">Unit</th>
					<th style="width: 15%;">Stock</th>
					<th style="width: 15%;">Jumlah</th>
				</tr>
			</thead>
		</table>
	</div>`;
}