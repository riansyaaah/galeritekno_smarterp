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
	<div style="width:100%;padding-top:20px;" >
        <table class="nilai1" >
					<tr><td style="text-align:center;"><b><font size="5">HASIL PEMERIKSAAN RADIOLOGI</font></b></td></tr>
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
			<table class="nilai1" style="border: 0;"> 

				<tr>
					<td valign="top">Hati</td>
                    <td valign="top" width="5%">:</td>
					<td valign="top" ><?php echo $hati;?></td>
				</tr>
				<br>
				<br>
				<tr>
					<td valign="top" >KGB</td>
					<td valign="top" >:</td>
					<td valign="top" ><?php echo $kgb;?></td>
				</tr>
				<br>
				<br>
				<tr>
					<td valign="top" >Limpa</td>
					<td valign="top" >:</td>
					<td valign="top" ><?php echo $limpa;?></td>
				</tr>
				<br>
				<br>
				<tr>
					<td valign="top" >Ginjal</td>
					<td valign="top" >:</td>
					<td valign="top" ><?php echo $ginjal;?></td>
				</tr>
                <br>
                <br>
				<tr>
					<td valign="top" >Empedu</td>
					<td valign="top" >:</td>
					<td valign="top" ><?php echo $empedu;?></td>
				</tr>
                <br>
                <br>
				<tr>
					<td valign="top" >Pankreas</td>
					<td valign="top" >:</td>
					<td valign="top" ><?php echo $pankreas;?></td>
				</tr>
                <br>
                <br>
				<tr>
					<td valign="top" >Kandung Kemih</td>
					<td valign="top" >:</td>
					<td valign="top" ><?php echo $kandungkemih;?></td>
				</tr>
                <br>
                <br>
                <tr>
					<td valign="top" >Lain-Lain</td>
					<td valign="top" >:</td>
					<td valign="top" ><?php echo $lainlain;?></td>
				</tr>
                <br>
                <br>
				<tr>
					<td valign="top" >Diagnosa</td>
					<td valign="top" >:</td>
					<td valign="top" ><?php echo $diagnosausg;?></td>
				</tr>
                <br><br>
				<tr>
					<td valign="top">Catatan </td>
                    <td valign="top" >:</td>
					<td valign="top"><?php echo $catatandokterusg;?></td>
				</tr>
			</table>
		</div>
<br><br><br><br><br>
	<!-- TTD DOKTER -->
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
						<td style="text-align:center;"><?php echo $dokterpemeriksausg;?></td>
					</tr>
				</table>
			</div>

</div><!-- END BODY -->



	</div>
</body>
</html>