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
									<h4><?= $title;?></h4>
								</div>
								<div class="card-body row">
									<div class="col-lg-3">
                                        
										<div class="form-group row">
                                            <div class="col-md-12">
												<label for="exampleInputPassword1">Supplier</label>
												<div class="input-group mb-1">
													<input type="text" id="supplier_id" name="example-input2-group2"
														class="form-control form-control-sm col-md-6" readonly>
													<span class="input-group-append">
														<a href="#" class="edit_record btn btn-primary btn-sm"
															onclick="cariSupplier()">...</a>
													</span>
												</div>
                                                <input type="text" class="form-control form-control-sm" id="supplier_name" readonly>
                                                </div>
										</div>
                                        <div class="form-group row">
											<button type="button" class="btn mr-1 mb-1 btn-primary btn-sm" id="btn_new_inv" onclick="newInv()" disabled>New Inv</button>
											<button type="button" class="btn mr-1 mb-1 btn-primary btn-sm" id="btn_edit_inv" onclick="editInv()" disabled>Edit Inv</button>
											<button type="button" class="btn mb-1 btn-primary btn-sm" id="btn_delete_inv" disabled>Delete Inv</button>
											<button type="button" class="btn mr-1 btn-primary btn-sm" id="btn_save_inv" onclick="return InvBaru()" disabled>Save Inv</button>
                                            <button type="button" class="btn  btn-primary btn-sm" id="btn_print_inv" disabled>Print Inv</button>
										</div>
									</div>
									<!--end col-->
									<div class="col-lg-5">

										<div class="form-group row">
											<label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Invoice No:</label>
											<div class="col-sm-9 mb-1">
                                                <div class="input-group">
													<input class="form-control form-control-sm" id="PurchaseInvoiceNo" type="text" readonly>
                                                    <input class="form-control form-control-sm" id="StatusInv" type="hidden" readonly>
													<span class="input-group-append">
														<button type="button" class="btn  btn-primary btn-sm"id="btncariInvSupplier"
															onclick="cariInvSupplier()" disabled>...</button>
													</span>
												</div>
												
											</div>
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Invoice Date:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="PurchaseInvoiceDate" type="date" readonly>
											</div>
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Invoice Due Date:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="PurchaseInvoiceDuedate" type="date" readonly>
											</div>

											<label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Currency:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm mb-1" id="Valuta" type="text" readonly>
											</div>

											<label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Rate:</label>
											<div class="col-sm-9">
												<input class="form-control mb-1 form-control-sm" id="Rate" readonly type="text">
											</div>
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Tax No:</label>
											<div class="col-sm-9 mb-1">
												<input class="form-control form-control-sm" id="TaxNo" readonly type="text">
											</div>
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Description:</label>
											<div class="col-sm-9">
												<textarea class="form-control form-control-sm" id="Description" readonly></textarea>
											</div>
										</div>

									</div>
                                    <div class="col-lg-4">

										<div class="form-group row">
											
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Sub Total:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="SubTotal" type="text" readonly>
											</div>
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Discount:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="Discount" type="text" readonly>
											</div>
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">PPn 10%:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="PPn" type="text" readonly>
											</div>
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">PPh:</label>
											<div class="col-sm-9 mb-3">
												<input class="form-control form-control-sm" id="PPh" type="text" readonly>
											</div>
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Other Cost:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="OtherCost" type="text" readonly>
											</div>
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Grand Total:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="GrandTotal" type="text" readonly>
											</div>
											
										</div>
                                        
									</div>
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<button type="button" class="btn  btn-primary btn-sm" id="btn_add_item" onclick="addItem()" disabled>Add Items</button>
										<button type="button" class="btn  btn-primary btn-sm" disabled>Get Purchase Order</button>
                                                
                                        <table class="table table-striped" id="table-detail">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>DESCRIPTION</th>
                                                    <th>UNIT</th>
                                                    <th>QTY</th>
                                                    <th>UNIT PRICE</th>
                                                    <th>AMOUNT</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                            
                                        </table>
									</div>
                                    </div>
								</div>
							</div>
						</div>
					
                </section>
                        
			</div>
			<!-- basic modal -->
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
		</div>
		<div class="modal fade" id="cariSupplier" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Supplier</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered table-hover" id="table-menu" style="width:100%;">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Supplier ID</th>
									<th class="text-center">Supplier Name</th>
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
        <div class="modal fade" id="addItem" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Input Item Inv</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<div class="form-group">
							<label for="useremail">Description</label>
							<input type="text" class="form-control form-control-sm" id="itemDescription" required="">
						</div>
						<div class="form-group">
							<label for="useremail">Unit</label>
							<input type="text" class="form-control form-control-sm" id="itemUnit" required="">
						</div>
                        <div class="form-group">
							<label for="useremail">Qty</label>
							<input type="text" class="form-control form-control-sm" id="itemQty" required="">
						</div>
                        <div class="form-group">
							<label for="useremail">Price</label>
							<input type="text" class="form-control form-control-sm" id="itemPrice" required="">
						</div>
						
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnItemBaru" onclick="return itemBaru()">
							SIMPAN
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
    
        <div class="modal fade" id="cariInvSupplier" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Supplier</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered table-hover" id="table-invsupplier" style="width:100%;">
							<thead>
								<tr>
									<th class="text-center">Inv NO</th>
									<th class="text-center">Inv Date</th>
									<th class="text-center">Inv Due Date</th>
									<th class="text-center">Supplier ID</th>
									<th class="text-center">Supplier Name</th>
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
            function cariInvSupplier() {

				showLoading();
				$("#table-invsupplier").dataTable({
					ajax: {
						url: '<?php echo base_url("finance/purchase/purchaseinvoice/getInvSupplier") ?>',
						dataSrc: 'data'
					},
					columns: [
                        {
							"data": 'PurchaseInvoiceNo',
						},
                        {
							"data": 'PurchaseInvoiceDate',
						},
                        {
							"data": 'PurchaseInvoiceDuedate',
						},
						{
							"data": 'supplier_id'
						},
						{
							"data": 'supplier_name'
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
				$("#cariInvSupplier").modal();

				$('#table-invsupplier tbody').on('click', 'tr', function () {
					event.preventDefault();
					var $td = $(this).closest('tr').children('td');

					var PurchaseInvoiceNo = $td.eq(0).text();
					var supplier_id = $td.eq(3).text();
					var supplier_name = $td.eq(4).text();

					document.getElementById("PurchaseInvoiceNo").value = PurchaseInvoiceNo;
					document.getElementById("supplier_id").value = supplier_id;
					document.getElementById("supplier_name").value = supplier_name;
                    PurchaseInvoiceCari();
                    
                    
					$('#cariInvSupplier').modal('hide');
				});

			}
            function PurchaseInvoiceCari() {
                showLoading();
				PurchaseInvoiceNo = document.getElementById("PurchaseInvoiceNo").value;
				dataPost = {
                        PurchaseInvoiceNo : PurchaseInvoiceNo,
                    }
                $.ajax({
                    url: '<?php echo base_url("finance/purchase/purchaseinvoice/getPurchaseInvoicebyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#PurchaseInvoiceNo').val(data[0]['PurchaseInvoiceNo']);
                            $('#PurchaseInvoiceDate').val(data[0]['PurchaseInvoiceDate']);
                            $('#PurchaseInvoiceDuedate').val(data[0]['PurchaseInvoiceDuedate']);
                            $('#Valuta').val(data[0]['Valuta']);
                            $('#Rate').val(data[0]['Rate']);
                            $('#Description').val(data[0]['Description']);
                            $('#PPn').val(data[0]['PPn']);
                            $('#PPh').val(data[0]['PPh']);
                            $('#Discount').val(data[0]['Discount']);
                            $('#OtherCost').val(data[0]['OtherCost']);
                            $('#TaxNo').val(data[0]['TaxNo']);
                            $('#SubTotal').val(data[0]['SubTotal']);
                            $('#GrandTotal').val(data[0]['GrandTotal']);
                            
                            $("#table-detail").dataTable({
                    destroy: true,
                    ajax: {
                        url: '<?php echo base_url("finance/purchase/purchaseinvoice/getPurchaseInvoicedetail") ?>',
                        dataSrc: 'data',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                    },
                    columns: [{
                            "data": 'no',
                        },
                        {
                            "data": 'Description'
                        },
                        {
                            "data": 'Unit'
                        },
                        {
                            "data": 'Qty'
                        },
                        {
                            "data": 'Price'
                        },
                        {
                            "data": 'Amount'
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
                            document.getElementById("btn_add_item").disabled = false;
                            document.getElementById("btn_save_inv").disabled = true;
                            document.getElementById("btn_edit_inv").disabled = false;
                            document.getElementById("btn_delete_inv").disabled = false;
				document.getElementById("PurchaseInvoiceNo").readOnly = true;
				document.getElementById("PurchaseInvoiceDate").readOnly = true;
				document.getElementById("PurchaseInvoiceDuedate").readOnly = true;
				document.getElementById("Valuta").readOnly = true;
				document.getElementById("Rate").readOnly = true;
				document.getElementById("Description").readOnly = true;
				document.getElementById("PPn").readOnly = true;
				document.getElementById("PPh").readOnly = true;
				document.getElementById("Discount").readOnly = true;
				document.getElementById("OtherCost").readOnly = true;
				document.getElementById("TaxNo").readOnly = true;
                        }else{
                            showSnackError(res.remarks);
                            dismisLoading();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        showSnackError(XMLHttpRequest);
                        dismisLoading();
                    },
                    timeout: 60000 
                });
                
				
			}
            
            function cariSupplier() {

				showLoading();
				$("#table-menu").dataTable({
					ajax: {
						url: '<?php echo base_url("finance/purchase/purchaseinvoice/getSupplier") ?>',
						dataSrc: 'data'
					},
					columns: [{
							"data": 'no',
						},{
							"data": 'Kode_Spl',
						},
						{
							"data": 'Nama_Spl'
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
				$("#cariSupplier").modal();

				$('#table-menu tbody').on('click', 'tr', function () {
					event.preventDefault();
					var $td = $(this).closest('tr').children('td');

					var Kode_Spl = $td.eq(1).text();
					var Nama_Spl = $td.eq(2).text();

					document.getElementById("supplier_id").value = Kode_Spl;
					document.getElementById("supplier_name").value = Nama_Spl;
                    document.getElementById("btn_new_inv").disabled = false;
                    document.getElementById("btncariInvSupplier").disabled = false;
					$('#cariSupplier').modal('hide');
				});

			}
            function newInv() {
                document.getElementById("StatusInv").value = 'New';
				document.getElementById("btn_save_inv").disabled = false;
				document.getElementById("PurchaseInvoiceNo").readOnly = false;
				document.getElementById("PurchaseInvoiceDate").readOnly = false;
				document.getElementById("PurchaseInvoiceDuedate").readOnly = false;
				document.getElementById("Valuta").readOnly = false;
				document.getElementById("Rate").readOnly = false;
				document.getElementById("Description").readOnly = false;
				document.getElementById("PPn").readOnly = false;
				document.getElementById("PPh").readOnly = false;
				document.getElementById("Discount").readOnly = false;
				document.getElementById("OtherCost").readOnly = false;
				document.getElementById("TaxNo").readOnly = false;
                document.getElementById("PurchaseInvoiceNo").value = '';
				document.getElementById("PurchaseInvoiceDate").value = '';
				document.getElementById("PurchaseInvoiceDuedate").value = '';
				document.getElementById("Valuta").value = '';
				document.getElementById("Rate").value = '';
				document.getElementById("Description").value = '';
				document.getElementById("PPn").value = '';
				document.getElementById("PPh").value = '';
				document.getElementById("Discount").value = '';
				document.getElementById("OtherCost").value = '';
				document.getElementById("TaxNo").value = '';
				
			}
            function editInv() {
                document.getElementById("StatusInv").value = 'Edit';
				document.getElementById("btn_save_inv").disabled = false;
				document.getElementById("PurchaseInvoiceNo").readOnly = true;
				document.getElementById("PurchaseInvoiceDate").readOnly = false;
				document.getElementById("PurchaseInvoiceDuedate").readOnly = false;
				document.getElementById("Valuta").readOnly = false;
				document.getElementById("Rate").readOnly = false;
				document.getElementById("Description").readOnly = false;
				document.getElementById("PPn").readOnly = false;
				document.getElementById("PPh").readOnly = false;
				document.getElementById("Discount").readOnly = false;
				document.getElementById("OtherCost").readOnly = false;
				document.getElementById("TaxNo").readOnly = false;
				
			}
            function InvBaru(){
                var StatusInv = $('#StatusInv').val();
                var btn = document.getElementById("btn_save_inv");
                var PurchaseInvoiceNo = $('#PurchaseInvoiceNo').val();
                var PurchaseInvoiceDate = $('#PurchaseInvoiceDate').val();
                var PurchaseInvoiceDuedate = $('#PurchaseInvoiceDuedate').val();
                var Valuta = $('#Valuta').val();
                var Rate = $('#Rate').val();
                var Description = $('#Description').val();
                var PPn = $('#PPn').val();
                var PPh = $('#PPh').val();
                var Discount = $('#Discount').val();
                var OtherCost = $('#OtherCost').val();
                var TaxNo = $('#TaxNo').val();
                var SubTotal = $('#SubTotal').val();
                var GrandTotal = $('#GrandTotal').val();
                var supplier_id = $('#supplier_id').val();
                 
                if(PurchaseInvoiceNo == "" || PurchaseInvoiceNo == null){
                    showSnackError("Harap isi");
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        StatusInv : StatusInv,
                        PurchaseInvoiceNo : PurchaseInvoiceNo,
                        PurchaseInvoiceDate : PurchaseInvoiceDate,
                        PurchaseInvoiceDuedate : PurchaseInvoiceDuedate,
                        Valuta : Valuta,
                        Rate : Rate,
                        Description : Description,
                        PPn : PPn,
                        PPh : PPh,
                        Discount : Discount,
                        OtherCost : OtherCost,
                        TaxNo : TaxNo,
                        SubTotal : SubTotal,
                        GrandTotal : GrandTotal,
                        supplier_id : supplier_id,
                    }
                    $.ajax({
                        url: '<?php echo base_url("finance/purchase/purchaseinvoice/addInv") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            if(res.status_json){
                                btn.value = 'Save Inv';
							btn.innerHTML = 'Save Inv';
							btn.disabled = false;
                                successinv(res.remarks)
                            }else{
                                btn.value = 'Save Inv';
							btn.innerHTML = 'Save Invs';
							btn.disabled = false;
                                showSnackError(res.remarks);
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                            btn.value = 'Gagal, Coba lagi';
                            btn.innerHTML = 'Gagal, Coba lagi';
                            btn.disabled = false;
                        },
                        timeout: 60000 
                    });
                }
            }
            
            function addItem() {

				showLoading();
				dismisLoading();
				$("#addItem").modal();
			}

			function itemBaru() {
				var btn = document.getElementById("btnItemBaru");
				var PurchaseInvoiceNo = $('#PurchaseInvoiceNo').val();
				var itemDescription = $('#itemDescription').val();
				var itemUnit = $('#itemUnit').val();
				var itemQty = $('#itemQty').val();
				var itemPrice = $('#itemPrice').val();

				if (itemDescription == "" || itemDescription == null) {
					showSnackError("Harap isi");
				} else {
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						PurchaseInvoiceNo: PurchaseInvoiceNo,
						itemDescription: itemDescription,
						itemUnit: itemUnit,
						itemQty: itemQty,
						itemPrice: itemPrice,
					}
					$.ajax({
						url: '<?php echo base_url("finance/purchase/purchaseinvoice/addItem") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function (res) {
							console.log(res)
							if (res.status_json) {
                            
							document.getElementById("itemDescription").value = "";
							document.getElementById("itemUnit").value = "";
							document.getElementById("itemQty").value = "";
							document.getElementById("itemPrice").value = "";
                            
                            
							var btn = document.getElementById("btnItemBaru");
							btn.value = 'SIMPAN';
							btn.innerHTML = 'SIMPAN';
							btn.disabled = false;
							$('#addItem').modal('hide');
								successitem(res.remarks)
							} else {
								btn.value = 'SIMPAN';
								btn.innerHTML = 'SIMPAN';
								btn.disabled = false;
								showSnackError(res.remarks);
							}
						},
						error: function (XMLHttpRequest, textStatus, errorThrown) {
							btn.value = 'Gagal, Coba lagi';
							btn.innerHTML = 'Gagal, Coba lagi';
							btn.disabled = false;
						},
						timeout: 60000
					});
				}
			}
            
            function successitem(text) {
				Swal.fire({
					title: 'Info',
					html: text,
					type: "success",
					confirmButtonText: 'Ok',
					confirmButtonColor: "#46b654",
				}).then((result) => {
                    PurchaseInvoiceCari();
				})
			}
            
            function successinv(text) {
				Swal.fire({
					title: 'Info',
					html: text,
					type: "success",
					confirmButtonText: 'Ok',
					confirmButtonColor: "#46b654",
				}).then((result) => {
					PurchaseInvoiceCari();
				})
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
