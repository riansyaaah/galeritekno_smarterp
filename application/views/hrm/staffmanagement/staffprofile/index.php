<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('hrm/staffmanagement/staffprofile/css'); ?>
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
					<div class="card">
						<div class="card-header" id="header"></div>
				        <div class="card-body">
				            <div id="nav"></div>
				            <div id="konten">
				            </div>
				            <div id="print"></div>
				        </div>
					</div>
				</section>
			</div>
			<div id="modal"></div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
	</div>
	<input type="hidden" id="baseUrl" value="<?= base_url('hrm/staffmanagement/staffprofile/'); ?>">
	<input type="hidden" id="title" value="<?= $title; ?>">
	<?php $this->load->view('hrm/staffmanagement/staffprofile/js'); ?>
	<script>
		const baseUrl = document.querySelector('#baseUrl').value;
		const modal = document.querySelector('#modal');
		window.addEventListener('DOMContentLoaded', e => {
			const csfrData = {};
	        csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
	        $.ajaxSetup({
	            data: csfrData
	        });
	        renderHalamanUtama();
		});
	</script>
</body>
</html>