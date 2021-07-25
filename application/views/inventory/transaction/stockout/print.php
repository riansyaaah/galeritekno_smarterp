<html>
	<style>
		* {
			font-size: 10pt;
		}
		.font-weight-bold {
			font-weight: bold;
		}
		.border {
			border: 1px solid black;
		}
		.text-center {
			text-align: center;
		}
	</style>
	<p>
		No Transaksi : <?= $data['noTransaction'];?><br>
		Tanggal : <?= $data['tglTransaction'];?><br>
		No Surat Jalan : <?= $data['suratJalan'];?><br>
		Department : <?= $data['department'];?><br>
	</p>
	<table cellpadding="4" style="width: 100%;">
		<tr>
			<th class="border text-center font-weight-bold" style="width: 10%;">No</th>
			<th class="border text-center font-weight-bold" style="width: 80%;">Nama Item</th>
			<th class="border text-center font-weight-bold" style="width: 10%;">Jumlah</th>
		</tr>
		<?php foreach($data['detail'] as $detail) : ?>
			<tr>
				<td class="border text-center"><?= $detail['no']; ?></td>
				<td class="border"><?= $detail['itemmaster']; ?></td>
				<td class="border text-center"><?= $detail['jumlah_act']; ?></td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td class="border text-center font-weight-bold" colspan="2">Total</td>
			<td class="border text-center font-weight-bold"><?= $data['total']; ?></td>
		</tr>
	</table>
</html>