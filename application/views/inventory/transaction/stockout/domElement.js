function tableOutgoing() {
	return `<div class="table-responsive">
		<table id="tableOutgoing" class="table table-striped table-hover table-bordered fullWidth">
			<thead>
				<tr class="text-center">
					<th>Tanggal</th>
					<th>No Transaksi</th>
					<th>No Request</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Department</th>
					<th>Position</th>
					<th style="width: 10%;"></th>
				</tr>
			</thead>
		</table>
	</div>`;
}
function headerHTML() {
	return `<button class="btn btn-warning btn-sm mb-2" id="btnBack">
		<i class="fa fa-backward"></i> Back
	</button>`;
}
function tableDetailHTML() {
	return `<div class="table-responsive">
		<table id="tableDetail" class="table table-hover table-striped table-bordered">
			<thead>
				<tr class="text-center">
					<th style="width: 65%;">Nama Item</th>
					<th style="width: 15%;">Unit</th>
					<th style="width: 10%;">Jumlah</th>
					<th style="width: 10%;">Status</th>
				</tr>
			</thead>
		</table>
	</div>`;
}