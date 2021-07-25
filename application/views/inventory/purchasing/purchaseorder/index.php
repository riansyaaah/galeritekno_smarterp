<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('inventory/purchasing/purchaseorder/css'); ?>
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
						<div id="header"></div>
						<div id="konten"></div>
					</div>
				</div>
			</div>
		</div>
		<div id="modal"></div>
		<div id="modal2"></div>
		<?php $this->load->view('layout/v_footer'); ?>
	</div>
	<?php $this->load->view('inventory/purchasing/purchaseorder/js'); ?>
	<script>
		const baseUrl = '<?= base_url('inventory/purchasing/purchaseorder/'); ?>';
		const sekarang = '<?= date('Y-m-d'); ?>';
		window.addEventListener('DOMContentLoaded', e => {
			const csfrData = {};
			const token = '<?= $this->security->get_csrf_token_name(); ?>';
			const hash = '<?= $this->security->get_csrf_hash(); ?>';
			csfrData[token] = hash;
			$.ajaxSetup({data: csfrData});
			renderUtama();
		});
	</script>
</body>
</html>