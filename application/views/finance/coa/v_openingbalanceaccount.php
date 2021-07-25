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
		.dataTables_wrapper .dataTables_filter {
			float: right;
			text-align: right;
			visibility: hidden;
		}

		#table-menu {
			width: 100% !important;
			margin-top: -39px !important;
		}
		.btn {
			display: block ruby;
		}
		td {
			padding-left: .3rem !important;
			padding-right: .3rem !important;
			padding-top: .75rem !important;
			padding-bottom: .75rem !important;
		}
		.btn_edit {
			width: 80% !important;
			margin: auto !important;
		}
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
									<h4><?= $title; ?></h4>
									<hr>
									<h4 id="PeriodeActive">Periode Active : <?php echo $PeriodeActive; ?></h4>
								</div>
								<div class="card-body">
									<div class="table-responsive" style="height: 550px;">
										<div class="loader" style="display:block"></div>
										<table class="table table-hover table-striped display" id="table-menu" style="font-size: 16px; width: 100%;">
											<thead>
												<tr>
													<th style="width: 20%">Account No</th>
													<th style="width: 50%">Account Name</th>
													<th style="width: 10%" class="text-right">Debit</th>
													<th style="width: 10%" class="text-right">Credit</th>
													<th style="width: 10%" class="text-center">#</th>
												</tr>
											</thead>
										</table>
									</div>
									<div style="margin-right: 20px;">
										<div class="table-responsive mt-3">
											<div class="loader" style="display:block"></div>
											<table class="table table-hover table-sm text-left">
												<thead style="font-size: 16px;">
													<tr>
														<th style="width: 20%">Sum Of Debit</th>
														<th style="width: 50%"></th>
														<th class="text-right" style="width: 10%"><?= number_format($sumofdebit, 0, '', '.'); ?></th>
														<th style="width: 10%"></th>
														<th style="width: 10%"></th>
													</tr>
													<tr>
														<th>Sum Of Credit</th>
														<th></th>
														<th></th>
														<th class="text-right"><?= number_format($sumofkredit, 0, '', '.'); ?></th>
														<th></th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
		<div class="modal fade" id="editOpeningbalanceaccount" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modal-title"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="useremail">ACCOUNT NO</label>
							<input type="text" class="form-control form-control-sm" id="AccountNo" required="" readonly>
						</div>
						<div class="form-group">
							<label for="useremail">ACCOUNT NAME</label>
							<input type="text" class="form-control form-control-sm" id="AccountName" required="" readonly>
						</div>
						<div class="form-group">
							<label for="useremail">AMOUNT</label>
							<input type="text" class="form-control form-control-sm" id="Amount" required="">
						</div>
						<div class="form-group">
							<div class="col-md-9">
								<div class="custom-control custom-radio">
									<input type="radio" id="Debit" name="customRadio" class="custom-control-input" value="Debit">
									<label class="custom-control-label" for="Debit">DEBIT</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" id="Credit" name="customRadio" class="custom-control-input" value="Credit">
									<label class="custom-control-label" for="Credit">CREDIT</label>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnItemEdit" onclick="return OpeningbalanceaccountEdit()">Update</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
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
		const rupiah = document.querySelector('#Amount');
		rupiah.addEventListener('keyup', function(e){
			rupiah.value = formatRupiah(this.value);
		});
		function formatRupiah(angka){
			let number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
			if(ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return rupiah;
		}
		$(document).ready(function() {
			$("#table-menu").dataTable({
				"paging": false,
				"ordering": false,
				"info": false,
				ajax: {
					url: '<?php echo base_url("finance/coa/openingbalanceaccount/getOpeningbalanceaccount") ?>',
					dataSrc: 'data'
				},

				columns: [{
						"data": 'AccountNo',
					}, {
						"data": 'AccountName',
					},
					{
						"data": 'Debit'
					},
					{
						"data": 'Credit'
					},
					{
						"data": 'option'
					}
				],
				"columnDefs": [
					{
						 "sClass": 'text-right',
						 "targets": [2, 3]
					}
				]
			});
			$('#table-menu thead tr').clone(true).appendTo( '#table-menu thead' );
		    $('#table-menu thead tr:eq(1) th').each( function (i) {
		    	var title = $(this).text();
		    	if(i == 0 || i == 1) {
			        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
			        $( 'input', this ).on( 'keyup change', function () {
			            if ( table.column(i).search() !== this.value ) {
			                table
			                    .column(i)
			                    .search( this.value )
			                    .draw();
			            }
			        } );
		    	} else {
		    		$(this).html( '' );
		    	}
		    } );
		 
		    var table = $('#table-menu').DataTable();
			var csfrData = {};
			csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
		});

		function editOpeningbalanceaccount(code) {
			dataPost = {
				code: code,
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/coa/openingbalanceaccount/getOpeningbalanceaccountbyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;

						$('#AccountNo').val(data[0]['AccountNo']);
						$('#AccountName').val(data[0]['AccountName']);
						if (parseInt(data[0]['Debit']) > parseInt(data[0]['Credit'])) {
							$('#Amount').val(data[0]['Debit']);
							radiobtn = document.getElementById("Debit");

						} else {
							$('#Amount').val(data[0]['Credit']);
							radiobtn = document.getElementById("Credit");
						}
						radiobtn.checked = true;

						dismisLoading();
						$("#editOpeningbalanceaccount").modal();
					} else {
						showSnackError(res.remarks);
						dismisLoading();
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					showSnackError(XMLHttpRequest);
					dismisLoading();
				},
				timeout: 60000
			});
		}

		function OpeningbalanceaccountEdit() {
			const btn = document.getElementById("btnItemEdit");
			const AccountNo = $('#AccountNo').val();
			const Amount = $('#Amount').val();
			if(document.getElementById('Debit').checked) DebitCredit = document.getElementById('Debit').value;
			if (document.getElementById('Credit').checked) DebitCredit = document.getElementById('Credit').value;
			if (Amount == "" || Amount == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					AccountNo: AccountNo,
					Amount: Amount,
					DebitCredit: DebitCredit,
				}
				console.log(dataPost);
				$.ajax({
					url: '<?= base_url("finance/coa/openingbalanceaccount/OpeningbalanceaccountEdit") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							success(res.remarks)
						} else {
							btn.value = 'SIMPAN';
							btn.innerHTML = 'SIMPAN';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Gagal, Coba lagi';
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					},
					timeout: 60000
				});
			}
		}

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
	</script>
</body>

</html>