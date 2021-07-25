<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $title; ?></title>
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
	<div class="containter">
		<div class="row mt-4">
			<div class="col-lg-12">
				<div class="invoice-title">
					<h5 style="text-align:center;">PT SPEEDLAB INDONESIA </h5>
					<h2 style="text-align:center;">JOURNAL REPORT</h2>
					<h5 style="text-align:center;">CASH</h5>
					<!-- <div class="invoice-number">Order #12345</div> -->
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<address>
						Page 1 of 1
					</address>
				</div>
				<div class="col-md-2 text-md-left">
					<address>
						Printed : <?= $datenow; ?><br><br>
					</address>
				</div>
				<div class="col-md-12">
					<table class="table table-bordered table-sm" width="100%">
						<tr>
							<th class="text-center">Date</th>
							<th class="text-center">Ref. No</th>
							<th class="text-center">Account</th>
							<th class="text-center">Description </th>
							<th class="text-center">Debet</th>
							<th class="text-center">Credit</th>
						</tr>
						<?php foreach ($list_jurnal as $data) { ?>
							<tr>
								<td><?= $data['Date']; ?></td>
								<td><?= $data['ReffNo']; ?></td>
								<td><?= $data['Account']; ?></td>
								<td><?= $data['Description']; ?></td>
								<td><?= $data['Debit']; ?></td>
								<td><?= $data['Credit']; ?></td>
							</tr>
						<?php } ?>
					</table>
				</div>

			</div>
		</div>
	</div>
</body>
<script>
	window.print();
</script>

</html>