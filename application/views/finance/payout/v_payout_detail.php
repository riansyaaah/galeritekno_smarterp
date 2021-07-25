<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css'); ?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
	<style>

	</style>
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
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h4>PAYOUT ID : <?php echo $payout_id;?> </h4>
									<hr>
								</div>

								<div class="card-body row">
									<div class="col-lg-6 col-md-6 colsm-12 col-xs-12">
				<div class="card card-primary">
					<br>
					<table class="table table-sm" id="" style="width: 100%;">
						<thead>
							<tr>
								<td scope="col" class="text-right" width="150px">GROSS AMOUNT </td>
								<td width="1px"> : </td>
								<td>
									<span class="text-left" ><?php echo  number_format($payout['gross_amount']);?></span>
								</td>
							<tr>
								<td scope="col" class="text-right" width="150px">NET AMOUNT</td>
								<td> : </td>
								<td>
									<span class="text-left" ><?php echo  number_format($payout['net_amount']);?></span>
								</td>
							</tr>
							<tr>
								<td scope="col" class="text-right" width="150px">MDR</td>
								<td> : </td>
								<td>
									<span class="text-left" ><?php echo  number_format($payout['mdr']);?></span>
								</td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
								</div>

								<div class="card-body">
									<div class="table-responsive">
										<div class="loader" style="display:block"></div>
										<table class="table table-striped" id="table-menu">
											<thead>
												<tr>
													<th>No.</th>
													<th>Payment Type</th>
													<th>Transaction Time </th>
													<th>Settlement Time</th>
													<th>Order</th>
													<th>Customer Email</th>
													<th>Amount</th>
													<th>Transaction Fee</th>
													<th>Merchant Has</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
		
		<script src="<?php echo base_url('assets/template/js/app.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/datatables.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/scripts.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/custom.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/toastr.js'); ?>"></script>

		<script>
			const payout_id = '<?= $payout_id; ?>';
			$(document).ready(function() {
				$("#table-menu").dataTable({
					ajax: {
						url: '<?php echo base_url("finance/payout/payout/getPayoutdetail/") ?>'+payout_id,
						dataSrc: 'data'
					},
					columns: [{
							"data": 'no',
						}, {
							"data": 'PaymentType',
						},
						{
							"data": 'TransactionTime',
						},
						{
							"data": 'SettlementTime',
							render: $.fn.dataTable.render.number('.', ',', 0, '')
						},
						{
							"data": 'Order',
							render: $.fn.dataTable.render.number('.', ',', 0, '')
						},
						{
							"data": 'CustomerEmail',
							
						},
						{
							"data": 'Amount',
							render: $.fn.dataTable.render.number('.', ',', 0, '')
						},
						{
							"data": 'TransactionFee',
							render: $.fn.dataTable.render.number('.', ',', 0, '')
						},
						{
							"data": 'MerchantHas',
							render: $.fn.dataTable.render.number('.', ',', 0, '')
						}
						
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [2, 3]
					}]
				});
				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});
			});



			function showSnackError(text) {
				iziToast.error({
					title: 'Info',
					message: text,
					position: 'topRight'
				});
			}

			function showSnackSuccess(text) {
				iziToast.success({
					title: 'Info',
					message: text,
					position: 'topRight'
				});
			}

			function success(text) {
				Swal.fire({
					title: 'Info',
					html: text,
					type: "success",
					confirmButtonText: 'Ok',
					confirmButtonColor: "#46b654",
				}).then((result) => {
					location.reload(true);
				})
			}

			$(document).on('click', '#btn-detail', function() {
				const id = $(this).data('id');
				alert(id)
			})
		</script>
</body>

</html>