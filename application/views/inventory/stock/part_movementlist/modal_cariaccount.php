<div class="modal fade" id="cariAccount<?= $ket; ?>" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Item Master</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-hover" id="table-menu<?= $ket; ?>" style="width:100%;">
					<thead>
						<tr class="text-center">
							<th>Item</th>
							<th>Unit</th>
							<th>Stock</th>
							<th></th>
							<th class=" hidetd">id</th>
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