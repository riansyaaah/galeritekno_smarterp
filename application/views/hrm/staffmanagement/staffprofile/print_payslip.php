<!DOCTYPE html>
	<style>
		.profil {
			font-size: 10pt;
		}
		.font-weight-bold {
			font-weight: bold;
		}
		.text-center {
			text-align: center;
		}
		.text-right {
			text-align: right;
		}
		.gaji td, .gaji th {
			border: 1pt solid black;
		}
	</style>
	<table class="profil">
		<tr>
			<td style="width: 15%;">Tanggal</td>
			<td style="width: 2%;">:</td>
			<td><?= $dataPrint['periode']; ?></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td>:</td>
			<td><?= $dataPrint['nama']; ?></td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td>:</td>
			<td><?= $dataPrint['position']; ?></td>
		</tr>
		<tr>
			<td>Departmen</td>
			<td>:</td>
			<td><?= $dataPrint['department']; ?></td>
		</tr>
	</table>
	<br><br><br>
	<table class="gaji" cellpadding="4">
		<tr class="font-weight-bold text-center">
			<th style="width: 5%;">No</th>
			<th style="width: 70%;">Description</th>
			<th style="width: 25%;">Amount</th>
		</tr>
		<tr>
			<td class="text-center">1</td>
			<td>Basic Sallary</td>
			<td class="text-right">Rp <?= $dataPrint['gapok']; ?></td>
		</tr>
		<tr>
			<td class="text-center">2</td>
			<td>Incentive</td>
			<td class="text-right">Rp <?= $dataPrint['insentif']; ?></td>
		</tr>
		<tr>
			<td class="text-center">3</td>
			<td>Allowance</td>
			<td class="text-right">Rp <?= $dataPrint['tunjangan']; ?></td>
		</tr>
		<tr class="tot" style="border-top: 2px solid black;">
			<td colspan="2" class="text-center font-weight-bold">Total</td>
			<td class="text-right font-weight-bold">Rp <?= $dataPrint['total']; ?></td>
		</tr>
	</table>
</html>