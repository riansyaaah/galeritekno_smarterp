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
					<tr><td style="text-align:center;"><b><font size="5">HASIL PEMERIKSAAN TREADMILL</font></b></td></tr>
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
		
		<div style="width:100%; border:0;">
			<div style="width:30%; float:left; ">
				<table class="nilai1" >
					<tr>
						<td width="40%">Height (Cm)</td>
						<td width="2%">:</td>
						<td><?php echo $tinggibadan;?></td> 
					</tr>
					
					
				</table>
			</div>
			<div style="width:30%; float:left;">
				<table class="nilai1">
					<tr>
						<td width="40%">Weight (Kg)</td>
						<td width="2%">:</td>
						<td><?php echo $beratbadan;?></td> 
					</tr>
					
				</table>
			</div>
			<div style="width:30%; float:left;">
				<table class="nilai1">
					<tr>
						<td width="40%">BMI</td>
						<td width="2%">:</td>
						<td><?php echo $imt;?></td>
					</tr>
					
				</table>
			</div>
		</div>	
		<table class="nilai1" >
			<tr><td style="text-align:center;"><b><font size="4">Pre - Excercise Test <br>
			</font></b></td></tr>
		</table>

		<div style="width:100%; float:left;border:0; ">
			<table class="nilai1" >
				<tr>
					<td width="25%">Indication</td>
					<td width="15%"><?php echo $indication;?></td>
					<td width="60%"></td> 
				</tr>
				<tr>
					<td>Pre-Excercise BP</td>
					<td><?php echo $preexercisebp_a.'/'.$preexercisebp_b;?></td>
					<td>mmHg</td>
				</tr>
				<tr>
					<td>Heart Rate</td>
					<td><?php echo $heartrate;?></td>
					<td>bpm</td>
				</tr>
				<tr>
					<td>Resting ECG</td>
					<td><?php echo $restingecg;?></td>
					<td></td>
				</tr>
			</table>
		</div>
		<br>
		<table class="nilai1" >
			<tr><td style="text-align:center;"><b><font size="4">Excercise Test Summary <br>
			</font></b></td></tr>
		</table>
		<div style="width:100%; border:0;">
			<div style="width:50%; float:left; ">
				<table class="nilai1" >
					<tr>
						<td width="30">Excercise time</td>
						<td width="10%"><?php echo $exercisetime_a.':'.$exercisetime_b;?></td>
						<td width="10%">hh:mm</td>  
					</tr>
					<tr>
						<td>Max Heart Rate</td>
						<td><?php echo $maxheartrate;?></td>
						<td>bpm</td>
					</tr>
					<tr>
						<td>Max Blood Pressure</td>
						<td><?php echo $maxbloodpressure_a.'/'.$maxbloodpressure_b;?></td>
						<td>mmHg</td>
					</tr>
					<tr>
						<td>Aerobic Capacity</td>
						<td><?php echo $aerobiccapacity;?></td>
						<td>METs</td>
					</tr>
				</table>
			</div>
			<div style="width:50%; float:left;">
				<table class="nilai1">
					<tr>
						<td width="30%">End Stage</td>
						<td width="10%"><?php echo $endstage;?></td>
						<td width="10%">
						</td> 
					</tr>
					<tr>
						<td>Target Heart Rate</td>
						<td><?php echo $targetheartrate;?></td>
						<td>bpm</td>
					</tr>
					<tr>
						<td>Max Heart Rate</td>
						<td><?php echo $maxheartrate_persen;?></td>
						<td>%</td>
					</tr>
					<tr>
						<td>Premature Beat</td>
						<td><?php echo $prematurebeat;?></td>
						<td></td>
					</tr>
				</table>
			</div>
			
		</div> 
		<br>
		<table class="nilai1" >
			<tr><td style="text-align:left;"><b><font size="4">Reason of End <br>
			</font></b></td></tr>
		</table>
		
		<div style="width:100%; float:left; border:0;">
			<table class="nilai1">
				<tr>
					<td width="30%"><input type="checkbox" class="form-control1" <?php if($reasonofend == 1){ ?> checked="checked" <?php }?> >		Fatigue</td>
					<td width="30%"><input type="checkbox" class="form-control1" <?php if($reasonofend == 3){ ?> checked= "checked" <?php }?> >		Dysdnoe</td>
					<td width="30%"><input type="checkbox" class="form-control1" <?php if($reasonofend == 5){ ?> checked= "checked" <?php }?> >		Maximum HR Reach</td>
				</tr>
				<tr>
					<td><input type="checkbox" class="form-control1" <?php if($reasonofend == 2){?> checked="checked" <?php }?> >		ST-T Segment Changes</td>
					<td><input type="checkbox" class="form-control1" <?php if($reasonofend == 4){ ?> checked= "checked" <?php }?> >		Angina</td>
					<td><input type="checkbox" class="form-control1" <?php if($reasonofend == 6){ ?> checked= "checked" <?php }?> >		Dizziness</td>
				</tr>
			</table>
			<table class="nilai1" >
				<tr><td style="text-align:left;"><b><font size="4">ST-T Segment Changes <br>
				</font></b></td></tr>
			</table>
			<table class="nilai1">
				<tr>
					<td width="50%"><input type="checkbox" class="form-control1" <?php if($sttsegmentchanges == 1){ ?> checked= "checked" <?php }?> >		No Changes</td>
					<td width="50%"><input type="checkbox" class="form-control1" <?php if($sttsegmentchanges == 2){ ?> checked= "checked" <?php }?> >		Upsloping</td>

				</tr>
				<tr>
					<td><input type="checkbox" class="form-control1" <?php if($sttsegmentchanges == 3){ ?> checked= "checked" <?php }?> >		ST-T Segment Depression 0,5 - 1 mm</td>
					<td><input type="checkbox" class="form-control1" <?php if($sttsegmentchanges == 4){ ?> checked= "checked" <?php }?> >		Significant Changes (ST-Segment Depression > 1mm</td>

				</tr>
			</table>
			<table class="nilai1" >
				<tr><td style="text-align:left;"><b><font size="4">Abnormal Lead<br>Classification of Physical Fitness
				</font></b></td></tr>
			</table>
			<table class="nilai1">
				<tr>
					<td width="20%"><input type="checkbox" class="form-control1" <?php if($classificationofphysicalfitness == 1){ ?> checked= "checked" <?php }?> >		Low</td>
					<td width="20%"><input type="checkbox" class="form-control1" <?php if($classificationofphysicalfitness == 2){ ?> checked= "checked" <?php }?> >		Fair</td>
					<td width="20%"><input type="checkbox" class="form-control1" <?php if($classificationofphysicalfitness == 3){ ?> checked= "checked" <?php }?> >		Average</td>
					<td width="20%"><input type="checkbox" class="form-control1" <?php if($classificationofphysicalfitness == 4){ ?> checked= "checked" <?php }?> >		Good</td>
					<td width="20%"><input type="checkbox" class="form-control1" <?php if($classificationofphysicalfitness == 5){ ?> checked= "checked" <?php }?> >		High</td>

				</tr>

			</table>
			<table class="nilai1" >
				<tr><td style="text-align:left;"><b><font size="4">Blood Preassure Response<br>
				</font></b></td></tr>
			</table>
			<table class="nilai1">
				<tr>
					<td width="50%"><input type="checkbox" class="form-control1" <?php if($bloodpressureresponse == 1){ ?> checked= "checked" <?php }?> >		Normal Response</td>
					<td width="50%"><input type="checkbox" class="form-control1" <?php if($bloodpressureresponse == 2){ ?> checked= "checked" <?php }?> >		Hypertensive Response</td>


				</tr>

			</table>
			<table class="nilai1" >
				<tr><td style="text-align:left;"><b><font size="4">Functional Classification<br>
				</font></b></td></tr>
			</table>
			<table class="nilai1">
				<tr>
					<td width="30%"><input type="checkbox" class="form-control1" <?php if($functionalclassification == 1){ ?> checked= "checked" <?php }?> >		Class I</td>
					<td width="30%"><input type="checkbox" class="form-control1" <?php if($functionalclassification == 3){ ?> checked= "checked" <?php }?> >		Class II</td>
					<td width="30%"><input type="checkbox" class="form-control1" <?php if($functionalclassification == 4){ ?> checked= "checked" <?php }?> >		Class III</td>
				</tr>
			</table>
			<table class="nilai1" >
				<tr><td style="text-align:left;"><b><font size="4">Conclusion / Medical<br>
				</font></b></td></tr>
			</table>
			<table class="nilai1">
				<tr>
					<td width="50%"><input type="checkbox" class="form-control1"  
                                           <?php 
																if($conclution != ""){		
																$arr = explode(";", $conclution);
																	for($i=0; $i<=count($conclution); $i++){
																		if($arr[$i] == 1){ ?> checked="checked" <?php }
																	}
																}
															?>
                                           
                                           >Response Ischemic Positive</td>
					<td width="50%"><input type="checkbox" class="form-control1" 
                                           
                                           <?php 
																if($conclution != ""){		
																$arr = explode(";", $conclution);
																	for($i=0; $i<=count($conclution); $i++){
																		if($arr[$i] == 2){ ?> checked="checked" <?php }
																	}
																}
															?>
                                           >Response Ischemic Negative</td>
					


				</tr>
				<tr>
					<td ><input type="checkbox" class="form-control1" 
                                <?php 
																if($conclution != ""){		
																$arr = explode(";", $conclution);
																	for($i=0; $i<=count($conclution); $i++){
																		if($arr[$i] == 3){ ?> checked="checked" <?php }
																	}
																}
															?>
                                >Boderline Stress Line</td>
					<td><input type="checkbox" class="form-control1" 
                               <?php 
																if($conclution != ""){		
																$arr = explode(";", $conclution);
																	for($i=0; $i<=count($conclution); $i++){
																		if($arr[$i] == 4){ ?> checked="checked" <?php }
																	}
																}
															?>
                               >Indeterminate</td>
					
					

				</tr>
				<tr>
					<td><input type="checkbox" class="form-control1" 
                               <?php 
																if($conclution != ""){		
																$arr = explode(";", $conclution);
																	for($i=0; $i<=count($conclution); $i++){
																		if($arr[$i] == 5){ ?> checked="checked" <?php }
																	}
																}
															?>
                               >Fit To Work (Remote Area)</td>
					<td ><input type="checkbox" class="form-control1" 
                                <?php 
																if($conclution != ""){		
																$arr = explode(";", $conclution);
																	for($i=0; $i<=count($conclution); $i++){
																		if($arr[$i] == 6){ ?> checked="checked" <?php }
																	}
																}
															?>
                                >Unfit To Work (Remote Area)</td>
					


				</tr>
			</table><br>	<br>	
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
						<td style="text-align:center;"><?php echo $titimangsa.', '.$tanggalregistrasi;?></td>
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
						<td style="text-align:center;"><?php echo $dokterpemeriksatreadmill;?></td>
					</tr>
				</table>
			</div>
		</div>

		

	</div><!-- END BODY -->



</div>
</body>
</html>