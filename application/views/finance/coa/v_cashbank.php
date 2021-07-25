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
		.btn {
			display: block ruby !important;
		}
		.dataTables_wrapper .dataTables_filter {
			float: right;
			text-align: right;
			visibility: hidden;
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

								<div class="card-body row">
									<div class="col-sm-4 col-lg-2">
										<a href="#" class="edit_record btn btn-warning btn-sm" onclick="editCashbank()">
											<i class="fa fa-plus"></i> Add Cash / Bank</a>
									</div>
								</div>

								<div class="card-body">
									<div class="table-responsive">
										<div class="loader" style="display:block"></div>
										<table class="table table-striped" id="table-menu" style="width: 100%;">
											<thead>
												<tr>
													<th>No</th>
													<th>TYPE</th>
													<th>CODE</th>
													<th>DESCRIPTION</th>
													<th>BANK ACCOUNT</th>
													<th>CURRENCY</th>
													<th>ACCOUNT NO</th>
													<th>SALDO</th>
													<th></th>
													<th></th>
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


			<div class="modal fade" id="editCashbank" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modal-title"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<input type="hidden" class="form-control form-control-sm" id="BankCode" required="">
							<div class="form-group">
								<label for="useremail">TYPE</label>
								<select class="form-control form-control-sm" id="TypeCashbank">
									<option value="CASH">CASH</option>
									<option value="BANK">BANK</option>
								</select>
							</div>
							<div class="form-group">
								<label for="useremail">DESCRIPTION</label>
								<input type="text" class="form-control form-control-sm" id="BankName" required="">
							</div>
							<div class="form-group">
								<label for="useremail">BANK ACCOUNT</label>
								<input type="text" class="form-control form-control-sm" id="BankAccount" required="">
							</div>
							<div class="form-group">
								<label for="useremail">CURRENCY</label>
								<select class="form-control form-control-sm" id="Valuta">
									<?php foreach ($currencies as $currency) : ?>
										<option value="<?= $currency['Valuta']; ?>"><?= $currency['Valuta']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>

							<input type="hidden" id="Rate">

							<div class="form-group row">
								<div class="col-md-6">
									<label for="exampleInputPassword1">ACCOUNT</label>
									<div class="input-group">
										<input type="text" id="AccountNo" name="example-input2-group2" class="form-control form-control-sm" readonly>
										<span class="input-group-append">
											<a href="#" class="edit_record btn btn-primary btn-sm" onclick="cariAccountNo()">...</a>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<textarea class="form-control form-control-sm" id="AccountName" readonly></textarea>
							</div>
							<div class="form-group row">
								<div class="col-md-6">
									<label for="Debit">Available Saldo</label>
									<input type="text" id="Debit" name="example-input2-group2" class="form-control form-control-sm" readonly>
								</div>
							</div>

						</div>
						<div class="modal-footer bg-whitesmoke br">
							<button class="btn btn-primary" type="button" id="btnItemSave" onclick="return cashbankSave()">
								Simpan
							</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="hapusCashbank" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id='headermodalhapuscashbank'></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<input type="hidden" id="code_hapus" class="form-control">
							<div class="section-title" id='infohapuscashbank'></div>
						</div>
						<div class="modal-footer bg-whitesmoke br">
							<button class="btn btn-primary" type="button" id="btnDeleteCashbank" onclick="return cashbankHapus()"> Hapus </button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="cariAccountNo" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Cash Bank</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<table class="table table-bordered table-hover" id="table-account" style="width:100%;">
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Account</th>
										<th class="text-center">Account Name</th>
										<th class="text-center">Saldo</th>
										<th class="text-center">#</th>
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

			<div class="modal fade" id="OpeningBalance" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Saldo Awal Cash and Bank</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<input type="hidden" class="form-control form-control-sm" id="status" required="">
							<div class="form-group">
								<label for="useremail">PERIODE</label>
								<input type="text" class="form-control form-control-sm" id="sa_periode" required="" readonly>

							</div>
							<div class="form-group">
								<label for="useremail">CODE</label>
								<input type="text" class="form-control form-control-sm" id="sa_code" required="" readonly>

							</div>
							<div class="form-group">
								<label for="useremail">DESCRIPTION</label>
								<input type="text" class="form-control form-control-sm" id="sa_description" required="" readonly>
							</div>
							<div class="form-group">
								<label for="useremail">A/C</label>
								<input type="text" class="form-control form-control-sm" id="sa_ac" required="" readonly>
							</div>
							<div class="form-group">
								<label for="useremail">CURRENCY</label>
								<input type="text" class="form-control form-control-sm" id="sa_currency" required="" readonly>
							</div>
							<div class="form-group">
								<label for="useremail">AMOUNT</label>
								<input type="text" class="form-control form-control-sm" id="sa_amount" required="">
							</div>

						</div>
						<div class="modal-footer bg-whitesmoke br">
							<button class="btn btn-primary" type="button" id="btnItemEdit" onclick="return saOpeningBalance()">
								Simpan
							</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
				$(document).ready(function() {
					$("#table-menu").dataTable({
						"ordering": false,
						destroy: true,
						ajax: {
							url: '<?php echo base_url("finance/coa/cashbank/getCashbank") ?>',
							dataSrc: 'data'
						},
						columns: [{
								"data": 'no',
							},
							{
								"data": 'type',
							},
							{
								"data": 'code',
							},
							{
								"data": 'description'
							},
							{
								"data": 'bankaccount'
							},
							{
								"data": 'valuta'
							},
							{
								"data": 'accountno'
							},
							{
								"data": 'saldo'
							},
							{
								"data": 'edit'
							},
							{
								"data": 'hapus'
							}
						],
						"columnDefs": [
							{
								"sortable": false,
								"targets": [8]
							},
							{
								 "sClass": 'text-right',
								 "targets": [7]
							}
						]
					});
					$('#table-menu thead tr').clone(true).appendTo( '#table-menu thead');
				    $('#table-menu thead tr:eq(1) th').each(function(i) {
				        let title = $(this).text();
				        if(i == 1) {
				        	$(this).html(`<select class="form-control-sm select2">
	                            <option value=""></option>
	                            <?php foreach($columnSelect['type'] as $type) : ?>
	                                <option value="<?= $type; ?>"><?= $type; ?></option>
	                            <?php endforeach; ?>
	                        </select>`);
	                        $('select', this).on('change', function() {
					            if (table.column(i).search() !== this.value) {
					                table
					                    .column(i)
					                    .search( this.value )
					                    .draw();
					            }
					        });
				        } else if(i == 5) {
				        	$(this).html(`<select class="form-control-sm select2">
	                            <option value=""></option>
	                            <?php foreach($columnSelect['currency'] as $currency) : ?>
	                                <option value="<?= $currency; ?>"><?= $currency; ?></option>
	                            <?php endforeach; ?>
	                        </select>`);
	                        $('select', this).on('change', function() {
					            if (table.column(i).search() !== this.value) {
					                table
					                    .column(i)
					                    .search( this.value )
					                    .draw();
					            }
					        });
				        } else if(i == 0 || i == 7 || i == 8 || i == 9) {
				        	$(this).html('');
				        } else {
				        	$(this).html(`<input type="text" placeholder="Search ${title}" />`);
				        	$('input', this).on('keyup change', function() {
					            if (table.column(i).search() !== this.value) {
					                table
					                    .column(i)
					                    .search( this.value )
					                    .draw();
					            }
					        });
				        }
				    });
				    let table = $('#table-menu').DataTable();
					var csfrData = {};
					csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
					$.ajaxSetup({
						data: csfrData
					});
				});
				function cariAccountNo() {
					showLoading();
					$("#table-account").dataTable({
						destroy: true,
						ajax: {
							url: '<?= base_url("finance/coa/cashbank/getAccountNo") ?>',
							dataSrc: 'data'
						},
						columns: [
							{
								"data": 'no',
							},
							{
								"data": 'AccountNo',
							},
							{
								"data": 'AccountName'
							},
							{
								"data": 'Debit'
							},
							{
								"data": 'option'
							}
						],
						"columnDefs": [{
							"sortable": false,
							"targets": [2, 3]
						}]
					});

					dismisLoading();
					$("#cariAccountNo").modal();

					$('#table-account tbody').on('click', 'tr', function() {
						event.preventDefault();
						var $td = $(this).closest('tr').children('td');
						var AccountNo = $td.eq(1).text();
						var AccountName = $td.eq(2).text();
						var Debit = formatRupiah($td.eq(3).text()); 
						document.getElementById("AccountNo").value = AccountNo;
						document.getElementById("AccountName").value = AccountName;
						document.getElementById("Debit").value = Debit;
						$('#cariAccountNo').modal('hide');
					});

				}
				function formatRupiah(angka, prefix){
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
					return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
				}
				function editCashbank(code) {
					dataPost = {
						code: code
					}
					showLoading();
					$.ajax({
						url: '<?= base_url("finance/coa/cashbank/getCashbankbyid") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								data = res.data;
								console.log(data[0]['AvailableSaldo'])
								$('#BankCode').val(data[0]['BankCode']);
								$('#BankName').val(data[0]['BankName']);
								$('#BankAccount').val(data[0]['BankAccount']);
								$('#Valuta').val(data[0]['Valuta']);
								$('#Rate').val(data[0]['Rate']);
								$('#AccountNo').val(data[0]['AccountNo']);
								$('#AccountName').val(data[0]['AccountName']);
								$('#Debit').val(data[0]['AvailableSaldo']);
								document.querySelector('#modal-title').innerHTML = `${(!code)? 'Tambah' : 'Edit'} Data Cash and Bank`;
								dismisLoading();
								$("#editCashbank").modal();
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

				function cashbankSave() {
					var btn = document.getElementById("btnItemSave");
					var TypeCashbank = $('#TypeCashbank').val();
					var BankCode = $('#BankCode').val();
					var BankName = $('#BankName').val();
					var BankAccount = $('#BankAccount').val();
					var Valuta = $('#Valuta').val();
					var Rate = $('#Rate').val();
					var AccountNo = $('#AccountNo').val();
					var Debit = $('#Debit').val();
					if (BankName == "" || BankName == null || AccountNo == "" || AccountNo == null) {
						showSnackError("Harap isi");
					} else {
						btn.value = 'Loading...';
						btn.innerHTML = 'Loading...';
						btn.disabled = true;
						dataPost = {
							TypeCashbank: TypeCashbank,
							BankCode: BankCode,
							BankName: BankName,
							BankAccount: BankAccount,
							Valuta: Valuta,
							Rate: Rate,
							AccountNo: AccountNo,
							Debit: Debit,
						}
						$.ajax({
							url: '<?php echo base_url("finance/coa/cashbank/cashbankSave") ?>',
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

				function hapusCashbank(code) {
					dataPost = {
						code: code
					}
					showLoading();
					$.ajax({
						url: '<?php echo base_url("finance/coa/cashbank/getCashbankbyid") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								data = res.data;
								$('#code_hapus').val(data[0]['BankCode']);

								document.getElementById("headermodalhapuscashbank").innerHTML = "Delete Cash Bank : " + data[0]['BankCode'];
								document.getElementById("infohapuscashbank").innerHTML = "Are you sure to delete this data : " + data[0]['BankName'] + " ?";

								dismisLoading();
								$("#hapusCashbank").modal();
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

				function cashbankHapus() {
					var btn = document.getElementById("btnDeleteCashbank");
					var code_hapus = $('#code_hapus').val();
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						code: code_hapus,
					}
					$.ajax({
						url: '<?php echo base_url("finance/coa/cashbank/cashbankDelete") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								success(res.remarks)
							} else {
								btn.value = 'Gagal, Coba lagi';
								btn.innerHTML = 'Gagal, Coba lagi';
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

				function OpeningBalance(code) {

					dataPost = {
						code: code
					}
					showLoading();
					$.ajax({
						url: '<?php echo base_url("finance/coa/cashbank/getCashbankSaldo") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								data = res.data;
								$('#sa_code').val(data[0]['BankCode']);
								$('#sa_description').val(data[0]['BankName']);
								$('#sa_ac').val(data[0]['BankAccount']);
								$('#sa_currency').val(data[0]['Valuta']);
								$('#sa_periode').val(data[0]['ActivePeriode']);
								$('#sa_amount').val(data[0]['Saldo']);

								dismisLoading();
								$("#OpeningBalance").modal();
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

				function saOpeningBalance() {
					var btn = document.getElementById("btnItemEdit");
					var sa_code = $('#sa_code').val();
					var sa_periode = $('#sa_periode').val();
					var sa_amount = $('#sa_amount').val();

					if (sa_amount == "" || sa_amount == null) {
						showSnackError("Harap isi");
					} else {
						btn.value = 'Loading...';
						btn.innerHTML = 'Loading...';
						btn.disabled = true;
						dataPost = {
							sa_code: sa_code,
							sa_periode: sa_periode,
							sa_amount: sa_amount,
						}
						$.ajax({
							url: '<?php echo base_url("finance/coa/cashbank/saOpeningBalance") ?>',
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

				$(document).on('click', '#btn-detail', function() {
					const id = $(this).data('id');
					alert(id)
				})
			</script>
</body>

</html>