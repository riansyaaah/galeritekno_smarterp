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
					<tr><td style="text-align:center;"><b><font size="5">HASIL PEMERIKSAAN AUDIOMETRI</font></b></td></tr>
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
			<table class="bredak-before special nilai2" >
                    <thead>
                    <tr>
                    <th rowspan="2" width="30%"></th>
                    <th rowspan="2"></th>
                    <th colspan="9" style="align:center;">FREKUENSI</th>
                    </tr>
                    <tr>
                    <th>250</th>
                    <th>500</th>
                    <th>1000</th>
                    <th>1500</th>
                    <th>2000</th>
                    <th>3000</th>
                    <th>4000</th>
                    <th>6000</th>
                    <th>8000</th>
                    </tr>
                    </thead>  
                    <tbody>
                    <tr>
                    <td>AC, masked if necessary</td>
                    <td>Right Ear</td>
                    <td style="align:center;"><?php echo (isset($acmr250)) ? $acmr250 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acmr500)) ? $acmr500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acmr1000)) ? $acmr1000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acmr1500)) ? $acmr1500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acmr2000)) ? $acmr2000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acmr3000)) ? $acmr3000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acmr4000)) ? $acmr4000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acmr6000)) ? $acmr6000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acmr8000)) ? $acmr8000 : ""; ?></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Left Ear</td>
                    <td style="align:center;"><?php echo (isset($acml250)) ? $acml250 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acml500)) ? $acml500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acml1000)) ? $acml1000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acml1500)) ? $acml1500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acml2000)) ? $acml2000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acml3000)) ? $acml3000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acml4000)) ? $acml4000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acml6000)) ? $acml6000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acml8000)) ? $acml8000 : ""; ?></td>
                    </tr>
                        <tr>
                    <td>AC,  not masked (shadow)</td>
                    <td>Right Ear</td>
                    <td style="align:center;"><?php echo (isset($acnr250)) ? $acnr250 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnr500)) ? $acnr500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnr1000)) ? $acnr1000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnr1500)) ? $acnr1500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnr2000)) ? $acnr2000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnr3000)) ? $acnr3000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnr4000)) ? $acnr4000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnr6000)) ? $acnr6000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnr8000)) ? $acnr8000 : ""; ?></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Left Ear</td>
                    <td style="align:center;"><?php echo (isset($acnl250)) ? $acnl250 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnl500)) ? $acnl500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnl1000)) ? $acnl1000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnl1500)) ? $acnl1500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnl2000)) ? $acnl2000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnl3000)) ? $acnl3000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnl4000)) ? $acnl4000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnl6000)) ? $acnl6000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($acnl8000)) ? $acnl8000 : ""; ?></td>
                    </tr>
                        <tr>
                    <td>BC, not masked</td>
                    <td>Right Ear</td>
                    <td style="align:center;"><?php echo (isset($bcnr250)) ? $bcnr250 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnr500)) ? $bcnr500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnr1000)) ? $bcnr1000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnr1500)) ? $bcnr1500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnr2000)) ? $bcnr2000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnr3000)) ? $bcnr3000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnr4000)) ? $bcnr4000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnr6000)) ? $bcnr6000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnr8000)) ? $bcnr8000 : ""; ?></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Left Ear</td>
                    <td style="align:center;"><?php echo (isset($bcnl250)) ? $bcnl250 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnl500)) ? $bcnl500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnl1000)) ? $bcnl1000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnl1500)) ? $bcnl1500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnl2000)) ? $bcnl2000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnl3000)) ? $bcnl3000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnl4000)) ? $bcnl4000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnl6000)) ? $bcnl6000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcnl8000)) ? $bcnl8000 : ""; ?></td>
                    </tr>
                        <tr>
                    <td>BC, masked</td>
                    <td>Right Ear</td>
                    <td style="align:center;"><?php echo (isset($bcmr250)) ? $bcmr250 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcmr500)) ? $bcmr500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcmr1000)) ? $bcmr1000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcmr1500)) ? $bcmr1500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcmr2000)) ? $bcmr2000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcmr3000)) ? $bcmr3000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcmr4000)) ? $bcmr4000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcmr6000)) ? $bcmr6000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcmr8000)) ? $bcmr8000 : ""; ?></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Left Ear</td>
                    <td style="align:center;"><?php echo (isset($bcml250)) ? $bcml250 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcml500)) ? $bcml500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcml1000)) ? $bcml1000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcml1500)) ? $bcml1500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcml2000)) ? $bcml2000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcml3000)) ? $bcml3000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcml4000)) ? $bcml4000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcml6000)) ? $bcml6000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($bcml8000)) ? $bcml8000 : ""; ?></td>
                    </tr>
                        <tr>
                    <td>ULL</td>
                    <td>Right Ear</td>
                    <td style="align:center;"><?php echo (isset($ullr250)) ? $ullr250 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ullr500)) ? $ullr500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ullr1000)) ? $ullr1000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ullr1500)) ? $ullr1500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ullr2000)) ? $ullr2000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ullr3000)) ? $ullr3000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ullr4000)) ? $ullr4000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ullr6000)) ? $ullr6000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ullr8000)) ? $ullr8000 : ""; ?></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Left Ear</td>
                    <td style="align:center;"><?php echo (isset($ulll250)) ? $ulll250 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ulll500)) ? $ulll500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ulll1000)) ? $ulll1000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ulll1500)) ? $ulll1500 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ulll2000)) ? $ulll2000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ulll3000)) ? $ulll3000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ulll4000)) ? $ulll4000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ulll6000)) ? $ulll6000 : ""; ?></td>
                    <td style="align:center;"><?php echo (isset($ulll8000)) ? $ulll8000 : ""; ?></td>
                    </tr>
                        
                    </tbody>
                    </table>
		</div>
		<br>
        <div style="width:100%; float:left;">
        <div style="width:50%; float:left;">
        <img src="http://mcu.lenterahealthcare.id/pdf/audiometri_r.png" alt="Smiley face" height="242" width="442">
        </div>
            <div style="width:50%; float:left;">
        <img src="http://mcu.lenterahealthcare.id/pdf/audiometri_l.png" alt="Smiley face" height="242" width="442">
        </div>
        </div>
        <br>
		<div style="width:100%; float:left;">
			<table class="nilai1" style="border: 0;"> 

				<tr>
					<td width="30%" ><b>Diagnosa dan Catatan Dokter : </b></td>
					<td width="2%">: </td>
				</tr>
			</table>
            <table class="bredak-before special nilai2" >
                    <tbody>
                    <tr>
                    <td>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    </td>
                        </tr>
                </tbody>
            </table>
		</div>
        <br>
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
						<td style="text-align:center;"><?php echo $dokterpemeriksaaudiometri;?></td>
					</tr>
				</table>
			</div>

	</div><!-- END BODY -->




</div>
</body>
</html>