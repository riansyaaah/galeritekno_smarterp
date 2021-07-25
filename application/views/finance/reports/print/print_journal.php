<html>
<style>
	table.first {
		color: #003300;
		font-family: arial;
		font-size: 6pt;
	}

	td {
		border-top: 0.5px solid black;
		border-bottom: 0.5px solid black;
	}

	th {
		border-top: 0.5px solid black;
		border-bottom: 0.5px solid black;
	}
	.text-center {
		text-align: center;
	}
	.fwBold {
		font-weight: bold;
	}
</style><br><br>
<table class="first" cellpadding="4">
	<tr>
		<th width="50px" class="text-center fwBold">Date</th>
		<th width="100px" class="text-center fwBold">Ref No.</th>
		<th width="110px" class="text-center fwBold">Account</th>
		<th width="150px" class="text-center fwBold">Description</th>
		<th width="70px" class="text-center fwBold">Debit</th>
		<th width="70px" class="text-center fwBold">Credit</th>
	</tr>
	<?php foreach ($lists as $row) : ?>
		<tr>
			<td><?= $row['VoucherDate']; ?></td>
			<td><?= $row['VoucherNo']; ?></td>
			<td><?= $row['AccountNoCB'].' - '.$row['BankName']; ?></td>
			<td><?= $row['DescriptionV']; ?></td>
            <td align="right"><?= number_format($row['Credit'], 0, ',', ','); ?></td>
            <td align="right"><?= number_format($row['Debit'], 0, ',', ','); ?></td>
		</tr>
		<?php foreach ($row['details'] as $dv) : ?>
			<tr>
				<td></td>
				<td><?= $dv['VoucherNo']; ?></td>
				<td><?= $dv['AccountNoAB'] ?></td>
				<td><?= $dv['DescriptionVD']; ?></td>
				<td align="right"><?= number_format($dv['Debit'], 0, ',', ','); ?></td>
				<td align="right"><?= number_format($dv['Credit'], 0, ',', ','); ?></td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td>Sub Total</td>
			<td align="right"><?= number_format($row['sumDebit'], 0, ',', ','); ?></td>
			<td align="right"><?= number_format($row['sumCredit'], 0, ',', ','); ?></td>
		</tr>
	<?php endforeach; ?>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td>GRAND TOTAL</td>
		<td align="right"><?= number_format($totalDebit, 0, ',', ','); ?></td>
		<td align="right"><?= number_format($totalCredit, 0, ',', ','); ?></td>
	</tr>
</table>
</html>