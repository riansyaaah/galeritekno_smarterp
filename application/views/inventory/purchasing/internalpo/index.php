<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('inventory/purchasing/internalpo/css'); ?>
</head>
<body>
	<div class="loader"></div>
	<div id="snackbar_custom"></div>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('layout/v_header'); ?>
			<?php $this->load->view('layout/v_menu'); ?>
			<div class="main-content">
				<div class="card">
					<div class="card-header">
						<h4><?= $title; ?></h4><hr>
						<h4><?= $periode; ?></h4>
					</div>
					<div class="card-body">
						<div id="form" class="form-group"></div>
						<div id="konten"></div>
					</div>
				</div>
			</div>
		</div>
		<div id="modal"></div>
		<div id="modalItem"></div>
		<?php $this->load->view('layout/v_footer'); ?>
	</div>
	<?php $this->load->view('inventory/purchasing/internalpo/js'); ?>
	<script>
		const baseUrl = '<?= base_url('inventory/purchasing/internalpo/'); ?>';
		window.addEventListener('DOMContentLoaded', e => {
			const csfrData = {};
			csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
			renderAwal();
		});
	</script>
</body>
</html>