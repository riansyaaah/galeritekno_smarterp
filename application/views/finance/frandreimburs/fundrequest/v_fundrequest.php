<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?=$title;?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
	<link rel="stylesheet"
		href="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css'); ?>">
	<link rel="stylesheet"
		href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css'); ?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
</head>

<body>
	<div class="loader"></div>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('layout/v_header'); ?>
			<?php $this->load->view('layout/v_menu'); ?>
			<div class="main-content">
				<section class="section">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4><?= $subtitle;?></h4>
								</div>
								<div class="card-body row">
									<div class="col-lg-4">

										<div class="form-group row">
											<div class="col-md-8">
												<label>Nomor</label>
												<input type="text" name="nomor" class="form-control">
											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-8">
												<label>Date</label>
												<input type="date" name="date" class="form-control">
											</div>
										</div>

									</div>
									<!--end col-->
									<div class="col-lg-6">
										<div class="form-group row">
											<div class="col-md-10">
												<label>Paid To</label>
												<input type="text" name="paid_to" class="form-control">
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<label">Sudah dianggarkan</label>
												<input type="text" name="sudah_dianggarkan" class="form-control">
											</div>
                                            <div class="col-md-4">
                                                <input type="radio" name="under">
												<label>Under</label>
                                                <input type="radio" name="over">
												<label>Over</label>
											</div>
                                            <div class="col-md-4">
												<label>User Id</label>
												<input type="text" name="user_id" class="form-control">
											</div>
										</div>
									</div>
									<!--end col-->
									<div class="col-lg-2">
										<div class="form-group">
											<button type="button" class="btn  btn-primary btn-sm">New Trans</button>
											<button type="button" class="btn  btn-primary btn-sm">Edit Trans</button>
											<button type="button" class="btn  btn-primary btn-sm">Delete Trans</button>
											<button type="button" class="btn  btn-primary btn-sm">Save Trans</button>
											<button type="button" class="btn  btn-primary btn-sm">Print Trans</button>
										</div>

									</div>
									<!--end col-->
								</div>
								<div class="card-body">
									<div class="table-responsive">
                                        <button type="button" class="btn btn-primary btn-sm" disabled>Get Previous Reimbursment</button>
										<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Searching">Searching</button>
                                        <table class="table table-striped" id="table-detail-payment">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>DESCRIPTION</th>
                                                    <th>AMOUNT</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                        </table>
										<div class="total">
											<div class="col-md-4">
												<input type="text" name="total" class="form-control">
											</div>	
										</div>
										<br>
										<button type="button" class="btn btn-primary btn-sm">Add Items</button>
										<button type="button" class="btn btn-primary btn-sm">Insert Items</button>
										<button type="button" class="btn btn-primary btn-sm">Edit Items</button>
										<button type="button" class="btn btn-primary btn-sm">Delete Items</button>
									</div>
								</div>
							</div>
						</div>
                </section>
			</div>
			<!-- basic modal -->
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
        <div class="modal fade" id="Searching" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Searching Fund Request Number</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-md-4">Masukkan No Fund Request</label>
                                <div class="col-md-4">
                                    <input type="number" name="no_fund_request" class="form-control">
                                </div>
                            </div>    
                        </div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
		<script src="<?php echo base_url('assets/template/js/app.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
		<script
			src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>">
		</script>
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
                var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                $.ajaxSetup({
                    data: csfrData
                });
            });
		</script>
        
</body>

</html>

