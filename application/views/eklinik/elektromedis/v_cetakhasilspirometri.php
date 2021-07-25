<?php error_reporting(0);?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
	hr {color: #ddd;}
	h1 {text-align:center; font-size:10px;}
	h2 {font-size:10px;}
	.tengah {text-align:center;	}
	.kiri {padding-left:5px;}
	.teks{
		font-size : 10px;font-family: arial;  text-align: justify;
	}
	table.bredak-before
	table.nilai {border-collapse: collapse; width:100%;}
	table.nilai td, tr{font-size: 10px; padding: 2px 2px 2px 2px; border-bottom: 1px solid #ddd;}
	table.nilai tr:nth-child(even){background-color: #f2f2f2}

	table.nilai1 {font-family: arial;border-collapse: collapse; width:100%;}
	table.nilai1 td {font-size: 10px}
	table.nilai2 { font-family: arial;
		border-collapse: collapse;
		width: 100%;}
		table.nilai2 td, th {
			border: 1px solid #ddd;
			text-align: left;
		}
		table.nilai2 tr, th {
			border: 1px solid #ddd;
			text-align: center; font-size:10px;
		}
		table.nilai2 tr:{
			background-color: #ddd;

		}
		table.nilai2 td, tr{font-size: 10px; padding: 2px 2px 2px 2px; border-bottom: 1px solid #ddd;}

		.borderheader {
			border-bottom: 1px solid #ddd;
			border-top: 1px solid #ddd;
		}


		table.nilai4 {font-family: arial;border-collapse: collapse; width:100%;text-indent: 50px;}
		table.nilai4 td {font-size: 10px;text-indent: 50px;}
		table.nilai5 {font-family: arial;border-collapse: collapse; width:100%; text-align: right; text-indent: 50px;}
		table.nilai5 td {font-size: 10px;text-indent: 50px;}
		


	</style>
</head>
<body style="background-image: url('http://mcu.lenterahealthcare.id/assets/KopSuratLentera.png');
background-image-resize:6">
<div>
	<div style="width:100%;" >
		<table class="nilai1" >
					<tr><td style="text-align:center;"><b><font size="5">HASIL PEMERIKSAAN SPIROMETRI</font></b></td></tr>
				</table>
        <br>
				<div style="width:100%;">
			<div style="width:50%;float:left; ">
				<table class="nilai1" >
                    <tr>
                  <td>No. Reg.</td>
                  <td>:</td>
                  <td><?php echo $noregistrasi;?></td>
              </tr>
                    <tr>
                  <td>Tanggal MCU</td>
                  <td>:</td>
                  <td><?php echo $tanggalperiksa;?></td>  
              </tr>
					<tr>
						<td>Nama</td>
						<td width="5%">:</td>
						<td><?php echo $nama;?>
                  </td>
              </tr>
              
              <tr>
                  <td>Umur/Jenis Kelamin</td>
                  <td>:</td>
                  <td><?php echo $umur.'/'.$jeniskelamin;?></td>
              </tr>
              
          </table>
      </div>
      <div style="width:50%;float:left;">
        <table class="nilai1">
            <tr>
						<td >Instansi</td>
						<td width="5%">:</td>
						<td><?php echo $asalrujukan;?></td>  
					</tr>
           <tr>
              <td>NIP/NIK</td>
              <td width="5%">:</td>
              <td><?php echo $nik;?></td>  
          </tr>
            <tr>
              <td>Departemen</td>
              <td>:</td>
              <td><?php echo $departemen;?></td>
          </tr>
            <tr>
              <td>Jabatan</td>
              <td>:</td>
              <td><?php echo $jabatan;?></td>
          </tr>
            
      </table>
  </div>
</div>
		
		<hr>
		<div style="width:100%; float:left;">
			<div style="width:50%; float:left;">
			<table class="nilai1" style="border: 0;"> 

				<tr>
					<td colspan="4"><b>Data Peserta</b> </td>
				</tr>
				<br>
				<br>
				<tr>
                    <td width="5%"></td>
					<td width="25%">Tinggi Badan</td>
					<td width="5%">:</td>
					<td ><?php echo $tinggibadan;?> Cm</td>
				</tr>
				<br>
				<tr>
                    <td></td>
					<td >Berat Badan</td>
					<td >:</td>
					<td ><?php echo $beratbadan;?> Kg</td>
				</tr>
				<br>
				<tr>
                    <td></td>
					<td >Kebiasaan Merokok</td>
					<td >:</td>
					<td ><?php echo $kebiasaan_merokok;?></td>
				</tr>
                <br>
				<tr>
                    <td></td>
					<td >Asma</td>
					<td >:</td>
					<td ><?php echo $riwayatkesehatan_asma;?></td>
				</tr>
				<br>
				<tr>
                    <td></td>
					<td >Gigi Palsu</td>
					<td >:</td>
					<td ><?php echo $gigipalsu;?></td>
				</tr><br>
			</table>
		</div>
            <div style="width:50%; float:left;">
			<table class="nilai1" style="border: 0;"> 

				<tr>
					<td colspan="4"><b>Hasil Pemeriksaan</b></td>
				</tr>
				<br>
				<br>
				<tr>
					<td  width="5%"></td>
					<td  width="25%">FVC</td>
					<td  width="5%">:</td>
					<td ><?php echo $fvc;?></td>
				</tr>
				<br>
				<tr>
					<td ></td>
					<td >FEV1</td>
					<td >:</td>
					<td ><?php echo $fev1;?></td>
				</tr>
				<br>
				<tr>
					<td ></td>
					<td >FEV1/FVC</td>
					<td >:</td>
					<td ><?php echo $fev1_fvc;?></td>
				</tr>
				<br>
				<tr>
					<td ></td>
					<td >PEF</td>
					<td >:</td>
					<td ><?php echo $pef;?></td>
				</tr><br>
				
			</table>
		</div>
		</div>
        <br>
        <br>
		<div style="width:100%; float:left;">
			<table class="nilai1" style="border: 0;"> 

				<tr>
                    <td  width="15%"><b>Diagnosa</b></td>
					<td width="5%">:</td>
					<td ><?php echo $diagnosaspirometri;?></td>
				</tr>
				<br>
				<tr>
                    <td  width="15%"><b>Catatan Dokter</b></td>
					<td width="5%">:</td>
					<td ><?php echo $catatandokterspirometri;?></td>
				</tr>
			</table>
		</div>
		<div style="width:70%; float:left;">		
				<table class="nilai4">
				</table>
			</div>
			<div style="width:30%; float:right;">
				<table class="nilai5">
					<tr>
						<td></td>
						<td></td>
						<td style="text-align:center;"><?php echo $titimangsa.', '.$tanggalperiksacover;?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td style="text-align:center;">Dokter Pemeriksa</td>
					</tr>
					<br><br><br>
					<br><br><br>
					<tr>
						<td></td>
						<td></td>
						<td style="text-align:center;"><?php echo $dokterpemeriksaspirometri;?></td>
					</tr>
				</table>
			</div>

	</div><!-- END BODY -->




</div>
</body>
</html>