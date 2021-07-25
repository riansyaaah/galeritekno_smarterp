<div class="modal fade" id="cariAccount<?= $ket; ?>" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Cash Bank</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-hover" id="table-menu<?= $ket; ?>" style="width:100%;">
					<thead>
						<tr>
							<th class="text-center">CODE</th>
							<th class="text-center">BANK/CASH</th>
							<th class="text-center">BANK ACCOUNT</th>
							<th class="text-center">ACCOUNT NO</th>
							<th class="text-center">CURRENCY</th>
							<th class="text-center">SALDO</th>
							<th class="text-center">#</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="modal-footer bg-whitesmoke br">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>