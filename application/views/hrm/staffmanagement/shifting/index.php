<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('hrm/staffmanagement/shifting/css'); ?>
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
					<div class="card-body" id="demo">
						<div id="form"></div>
						<div id="konten"></div>
					</div>
				</div>
				<div class="card" id="workHour"></div>
			</div>
		</div>
		<div id="modal"></div>
		<div id="modalStaff"></div>
		<?php $this->load->view('layout/v_footer'); ?>
	</div>
	<?php $this->load->view('hrm/staffmanagement/shifting/js'); ?>
	<script>
		const baseUrl = '<?= base_url('hrm/staffmanagement/shifting/'); ?>';
		const periode = <?= $periode; ?>;
		window.addEventListener('DOMContentLoaded', e => {
			const csfrData = {};
			csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
			document.querySelector('#form').innerHTML = formHTML();
		});
	</script>
</body>
</html>
