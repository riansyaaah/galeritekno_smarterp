<div class="form-group row">
	<div class="col-md-6">
		<label for="exampleInputPassword1"><?= $ket; ?></label>
		<input type="hidden" id="idItem<?= $ket; ?>">
		<div class="input-group">
			<input type="text" id="namaItem<?= $ket; ?>" name="example-input2-group2<?= $ket; ?>" class="form-control form-control-sm" readonly>
			<span class="input-group-append">
				<button type="button" id="btnCariItem<?= $ket; ?>" class="edit_record btn btn-primary btn-sm">
					<i class="fas fa-list-ul"></i>
				</button>
			</span>
		</div>
	</div>
</div>
<div class="form-group" style="margin-top: -20px;">
	<textarea class="form-control" name="stockItem<?= $ket; ?>" id="stockItem<?= $ket; ?>" cols="30" rows="10" readonly></textarea>
</div>