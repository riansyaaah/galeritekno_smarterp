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
					<h2 style="text-align:center;">TRIAL BALANCE REPORT</h2>
					<h5 style="text-align:center;">Month : Mar-2021</h5>
					<!-- <div class="invoice-number">Order #12345</div> -->
				</div>
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
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead>
							<tr>
								<th colspan="5" rowspan="2" class="text-center" width="25">Description </th>
								<th colspan="2" class="text-center" width="25">Opening Balance </th>
								<th colspan="2" class="text-center" width="25">Mutation</th>
								<th colspan="2" class="text-center" width="25">Close Balance</th>
							</tr>
							<tr>
								<th width="25">Debit</th>
								<th width="25">Credit</th>
								<th width="25">Debit</th>
								<th width="25">Credit</th>
								<th width="25">Debit</th>
								<th width="25">Credit</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($list_trialbalance as $data) { ?>
								<tr>
									<?php if ($data['level'] == "TYPE") { ?>
										<td colspan="5">
											<font size="2"><?= $data['AccountNo'] . " " . $data['AccountName']; ?></font>
										</td>
										<td class="text-right"><?= $data['opendebit']; ?></td>
										<td class="text-right"><?= $data['opencredit']; ?></td>
										<td class="text-right"><?= $data['mutasidebit']; ?></td>
										<td class="text-right"><?= $data['mutasicredit']; ?></td>
										<td class="text-right"></td>
										<td class="text-right"></td>
									<?php } ?>
									<?php if ($data['level'] == "GROUP") { ?>
										<td></td>
										<td colspan="4">
											<font size="2"><?= $data['AccountNo'] . " " . $data['AccountName']; ?></font>
										</td>
										<td class="text-right"><?= $data['opendebit']; ?></td>
										<td class="text-right"><?= $data['opencredit']; ?></td>
										<td class="text-right"><?= $data['mutasidebit']; ?></td>
										<td class="text-right"><?= $data['mutasicredit']; ?></td>
										<td class="text-right"></td>
										<td class="text-right"></td>
									<?php } ?>
									<?php if ($data['level'] == "SGROUP") { ?>
										<td></td>
										<td></td>
										<td colspan="3">
											<font size="2"><?= $data['AccountNo'] . " " . $data['AccountName']; ?></font>
										</td>
										<td class="text-right"><?= $data['opendebit']; ?></td>
										<td class="text-right"><?= $data['opencredit']; ?></td>
										<td class="text-right"><?= $data['mutasidebit']; ?></td>
										<td class="text-right"><?= $data['mutasicredit']; ?></td>
										<td class="text-right"></td>
										<td class="text-right"></td>
									<?php } ?>
									<?php if ($data['level'] == "CODE") { ?>
										<td></td>
										<td></td>
										<td></td>
										<td colspan="2">
											<font size="2"><?= $data['AccountNo'] . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp " . $data['AccountName']; ?></font>
										</td>
										<td class="text-right"><?= $data['opendebit']; ?></td>
										<td class="text-right"><?= $data['opencredit']; ?></td>
										<td class="text-right"><?= $data['mutasidebit']; ?></td>
										<td class="text-right"><?= $data['mutasicredit']; ?></td>
										<td class="text-right"></td>
										<td class="text-right"></td>
									<?php } ?>
									<?php if ($data['level'] == "MASTER") { ?>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td colspan="1">
											<font size="2"><?= $data['AccountNo'] . " " . $data['AccountName']; ?></font>
										</td>
										<td class="text-right"><?= $data['opendebit']; ?></td>
										<td class="text-right"><?= $data['opencredit']; ?></td>
										<td class="text-right"><?= $data['mutasidebit']; ?></td>
										<td class="text-right"><?= $data['mutasicredit']; ?></td>
										<td class="text-right"></td>
										<td class="text-right"></td>
									<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
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