<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('eklinik/laboratorium/laboratoriumcovid/css'); ?>
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
					<div class="card-body">
						<h5 class="text-dark"><?= $title; ?></h5>
						<div id="header"></div>
						<div id="konten"></div>
					</div>
				</div>
			</div>
			<div id="modal"></div>
			<div id="modal2"></div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
    </div>
    <?php $this->load->view('eklinik/laboratorium/laboratoriumcovid/js'); ?>
	<script>
		const baseUrl = '<?= base_url('eklinik/laboratorium/labcovid/') ?>';
		const sekarang = '<?= $sekarang; ?>';
		window.addEventListener('DOMContentLoaded', e => {
			let csfrData = {};
			const token = '<?= $this->security->get_csrf_token_name(); ?>';
			const hash = '<?= $this->security->get_csrf_hash(); ?>';
			csfrData[token] = hash;
			$.ajaxSetup({data: csfrData});
			renderUtama();
		});
	</script>
</body>
</html>