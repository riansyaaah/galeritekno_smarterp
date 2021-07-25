<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('eklinik/sales/walkindrivethru/css'); ?>
</head>
<body>
	<div class="loader"></div>
	<div id="snackbar_custom"></div>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('layout/v_header'); ?>
			<?php $this->load->view('layout/v_menu'); ?>
			<div class="main-content">
				<section class="section">
					<div class="card" id="divTable">
						<div class="card-body">
							<h5 class="text-dark"><?= $title; ?></h5><hr>
							<div id="header"></div>
							<div id="konten"></div>
						</div>
					</div>
					<div id="card2"></div>
                </section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
		<div id="modal"></div>
		<div id="modal2"></div>
	</div>
	<?php $this->load->view('eklinik/sales/walkindrivethru/js'); ?>
	<script>
		const baseUrl = '<?= base_url('eklinik/sales/walkindrivethru/') ?>';
		const sekarang = '<?= $sekarang; ?>';
		window.addEventListener('DOMContentLoaded', () => {
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