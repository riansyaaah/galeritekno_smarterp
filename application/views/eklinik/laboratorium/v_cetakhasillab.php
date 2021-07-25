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
					<tr><td style="text-align:center;"><b><font size="5">HASIL PEMERIKSAAN LABORATORIUM</font></b></td></tr>
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
        <br>
        <table class="nilai1" >
					<tr><td style="text-align:left;"><font size="2">Waktu Sampling : <?php echo $tanggalperiksa." ".$waktusampling;?></font></td>
                        <td style="text-align:left;"><font size="2">Waktu Periksa : <?php echo $tanggalperiksa." ".$waktuperiksa;?></font></td>
                        <td style="text-align:left;"><font size="2">Waktu Cetak : <?php echo $now;?></font></td></tr>
				</table>
        
		<table class="bredak-before special nilai2" style="border: 1;">
			<thead>
				<tr>
					<th style="width:35%;text-align:center;background-color:#99ffb9;">PEMERIKSAAN</th>    
					<th style="width:20%;text-align:center;background-color:#99ffb9;">DALAM KISARAN <br>NILAI RUJUKAN</th>    
					<th style="width:20%;text-align:center;background-color:#99ffb9;"><font color="red">DILUAR KISARAN <br>NILAI RUJUKAN</font></th>    
					<th style="width:10%;text-align:center;background-color:#99ffb9;">NILAI RUJUKAN</th>    
					<th style="width:10%;text-align:center;background-color:#99ffb9;">SATUAN</th>    
					<th style="width:15%;text-align:center;background-color:#99ffb9;">KESIMPULAN</th>    
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; $idtidakperiksaurine = '';
                        foreach($gethasil as $g){?>
                <?php if(($g['id'] == '1.3.3.3' or $g['id'] == '1.3.3.2' or $g['id'] == '1.3.3.1') and $g['hasil'] == '' ){}else{?>
                <?php if($pengambilanurine == 'Tidak'){$idtidakperiksaurine = '1.4';}?>
                <?php if($pengambilandarah == 'Tidak'){$idtidakperiksadarah1 = '1.2';}?>
                <?php if($pengambilandarah == 'Tidak'){$idtidakperiksadarah2 = '1.3';}?>
                <?php if($pengambilandarah == 'Tidak'){$idtidakperiksadarah3 = '1.6';}?>
                <?php if(substr($g['id'],0,3) == $idtidakperiksaurine or substr($g['id'],0,3) == $idtidakperiksadarah1 or substr($g['id'],0,3) == $idtidakperiksadarah2 or substr($g['id'],0,3) == $idtidakperiksadarah3){}else{?>
                    <?php if($jeniskelamin == 1) {
                        $dari = $g['daripria']; 
                        $sampai = $g['sampaipria'];
                        } ?>
                    <?php if($jeniskelamin == 2) {
                        $dari = $g['dariwanita']; 
                        $sampai = $g['sampaiwanita']; 
                        } ?>
                        <?php if($jeniskelamin == 3) {
                        $dari = $g['darianak']; 
                        $sampai = $g['sampaianak']; 
                        } ?>
                    <?php 
                       if($g['uraian'] != ''){
                           $uraian = $g['uraian'];
                       }elseif($dari != '' and $sampai != ''){
                           $uraian = $dari."-".$sampai;
                       }else{
                           $uraian = "";
                       }                                        
                        if($g['level'] == 'KATEGORI'){ $jarak = ""; }
                        if($g['level'] == 'KELOMPOK'){ $jarak = "&nbsp;&nbsp;&nbsp;"; }
                        if($g['level'] == 'SUBKELOMPOK'){ $jarak = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; }
                        if($g['level'] == 'ITEM'){ $jarak = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; }
                        if($g['level'] == 'SUBITEM'){ $jarak = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; }
                        ?>
					<tr>
						<td style="text-align:left;"><?php echo $jarak.$g['nama_item'];?></td>
						<?php if($g['keterangan'] != NULL and $g['keterangan'] != 'Normal'){?>
							<td></td>
							<td style="text-align:center;color: red;"><?php echo trim($g['hasil']);?></td>
                        <td style="text-align:center;"><?php echo $uraian ;?></td>
								<td style="text-align:center;"><?php echo $g['satuan'];?></td>
								<td style="text-align:center;color: red;"><?php echo $g['keterangan'];?></td>
							<?php }else{ ?>
								<td style="text-align:center;"><?php echo trim($g['hasil']);?></td>
								<td></td>
                        <td style="text-align:center;"><?php echo $uraian ;?></td>
								<td style="text-align:center;"><?php echo $g['satuan'];?></td>
								<td style="text-align:center;"><?php echo $g['keterangan'];?></td>
								<?php } ?>
								
								
							</tr> 
                <?php } ?>
                <?php } ?>
                
							<?php $no++ ;}?> 
                        </tbody>						
					</table>
                <div style="width:100%; float:left;">
				<table class="nilai">
					<tr>
						<td><b>Temuan : </b><p><?php echo trim($diagnosalab);?></p></td>
					</tr>
					
				</table>
			<br>
            <div style="width:50%;float:left;">
                
				<table border="0" style="width:100%; font-size:11px;">
					<tr>
						<td>Petugas Pemeriksa</td>
						<td>:</td>
						<td><?php echo $petugaspemeriksalab; ?></td>
					</tr>
                    <tr>
						<td>Dokter Pemeriksa</td>
						<td>:</td>
						<td><?php echo $dokterpemeriksalab; ?></td>
					</tr>
				</table> 
			</div>
                <div style="width:50%;float:right;">
                
				<table border="0" style="width:100%; font-size:11px;">
					<tr>
						<td style="text-align:right;"><?php echo $titimangsa; ?>, <?php echo $tanggalperiksacover; ?></td>
					</tr>
                    <tr>
						<td style="text-align:right;"><i>*disclaimer : hasil di cetak automatis oleh sistem</i></td>
					</tr>
				</table> 
			</div>
			</div>
				</div>
				<!-- END BODY -->



			</div>
		</body>
		</html>