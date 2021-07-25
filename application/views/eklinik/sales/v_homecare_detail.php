<div class="card" id="divTableDetail" style="display: none; width:100%">
	<div class="card-header">
		<input type="hidden" id="detail-homecare">
		<button class="btn btn-warning mr-3" onclick="return back()"> <i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i> Back </button>
		<hr>
	</div>
	<div class="card-body row">
		<div class="col-md-6">
			<h4>Detail <?= $title; ?></h4>
		</div>
	</div>
	<div class="card-body" style="margin-top: -40px;">
		<div class="row">
			<div class="col-lg-6 col-md-6 colsm-12 col-xs-12">
				<div class="card card-primary">
					<br>
					<table class="table table-sm" id="" style="width: 100%;">
						<thead>
							<tr>
								<td scope="col" class="text-right" width="150px">Tipe </td>
								<td width="1px"> : </td>
								<td>
									<span class="text-left" id="detail_tipe"></span>
								</td>
							<tr>
								<td scope="col" class="text-right" width="150px">Nama</td>
								<td> : </td>
								<td>
									<span class="text-left" id="detail_nama"></span>
								</td>
							</tr>
							<tr>
								<td scope="col" class="text-right" width="150px">No HP</td>
								<td> : </td>
								<td>
									<span class="text-left" id="detail_no_hp"></span>
								</td>
							</tr>
							<tr>
								<td scope="col" class="text-right" width="150px">Total Harga</td>
								<td> : </td>
								<td>
									<span class="text-left" id="detail_total_harga"></span>
								</td>
							</tr>
							<tr>
								<td scope="col" class="text-right" width="150px">Tanggal Kunjungan</td>
								<td> : </td>
								<td>
									<span class="text-left" id="detail_tanggal_kunjungan"></span>
								</td>
							</tr>
							<tr>
								<td></td>
								<td> </td>
								<td>
									<span class="text-left" id="detail_tanggal_kunjungan">14:00 WIB</span>
								</td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<button class="btn btn-sm btn-primary my-3" onclick="return addPerson()"> <i class="fa fa-plus"></i> Add New </button>
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="table-home-care-detail" style="width: 100%;">
						<thead>
							<tr>
								<th>Tanggal Kunjungan</th>
								<th>Instansi</th>
								<th>Nama</th>
								<th>Tanggal Lahir</th>
								<th>NIK</th>
								<th>Paket Pemeriksaan</th>
								<th>PIC Marketing</th>
								<th>Status Bayar</th>
								<th>Catatan</th>
								<th width="150px">#</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>




<script>
	function loadDetailData() {
		var id = document.getElementById("detail-homecare").value;
		dataPost = {
			id: id,
		}
		$("#table-home-care-detail").dataTable({
			destroy: true,
			ajax: {
				url: '<?= base_url("eklinik/sales/Homecare/getDetailByHomecareId") ?>',
				dataSrc: 'data',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
			},
			columns: [{
					"data": 'tanggal_kunjungan'
				},
				{
					"data": 'instansi'
				},
				{
					"data": 'nama'
				},
				{
					"data": 'tanggal_lahir'
				},
				{
					"data": 'nik'
				},
				{
					"data": 'paket_pemeriksaan'
				},
				{
					"data": 'pic_marketing'
				},
				{
					"data": 'status_bayar'
				},
				{
					"data": 'catatan'
				},
				{
					"data": 'option'
				}
			],
			"columnDefs": [{
				"sortable": false,
				"targets": [9]
			}]
		});
		dismisLoading();

	}
</script>
