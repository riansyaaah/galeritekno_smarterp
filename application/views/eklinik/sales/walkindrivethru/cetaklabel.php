<?php error_reporting(0);?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title.' |  '.$namapolda ; ?></title>
	<meta name="keywords" content="<?php echo ' '.$namapolda ; ?>" />
	<meta name="description" content="<?php echo ' '.$namapolda ; ?>">
	<meta name="author" content="<?php echo ' '.$namapolda ; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
	hr {color: black;}
	h1 {text-align:center; font-size:18px;}
	h2 {font-size:13px;}
	.tengah {text-align:center;	}
	.kiri {padding-left:5px;}
	.teks{
		font-size : 12px;font-family: arial;  text-align: justify;
	}
	table.bredak-before
	table.nilai {border-collapse: collapse; width:100%;}
	table.nilai td, tr{font-size: 13; padding: 2px 2px 2px 2px; border-bottom: 1px solid #ddd;}
	table.nilai tr:nth-child(even){background-color: #f2f2f2}

	table.nilai1 {font-family: arial;border-collapse: collapse; width:100%;}
	table.nilai1 td {font-size: 14px}
	table.nilai2 { font-family: arial;
		border-collapse: collapse;
		width: 100%;}
		table.nilai2 td, th {
			border: 1px solid black;
			text-align: left;
		}
		table.nilai2 tr, th {
			border: 1px solid black;
			text-align: center; font-size:12px;
		}
		table.nilai2 tr:{
			background-color: black;

		}
		table.nilai2 td, tr{font-size: 12px; padding: 2px 2px 2px 2px; border-bottom: 1px solid black;}

		.borderheader {
			border-bottom: 1px solid #ddd;
			border-top: 1px solid #ddd;
		}


		table.nilai4 {font-family: arial;border-collapse: collapse; width:100%;text-indent: 50px;}
		table.nilai4 td {font-size: 12px;text-indent: 50px;}
		table.nilai5 {font-family: arial;border-collapse: collapse; width:100%; text-align: right; text-indent: 50px;}
		table.nilai5 td {font-size: 12px;text-indent: 50px;}
		


	</style>
</head>
<body>
	<!-- HEADER -->

	<!-- END HEADER -->

	<!-- BODY -->
	
	<!-- <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="logokiri"></div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="logokanan"></div>
			</div>

		</div>
	</div> -->

	<div style="width:100%;padding-top:10px;" >
		<div style="width:100%;">
		</div>
			<font size="1"><?php echo substr($nama,0,18);?></font><br>
                        <font size="1"><?php echo $jeniskelamin.'/'.$tanggallahir;?></font><br>
                        <font size="1"><?php echo substr($instansi,0,15);?></font><br>
                        <font size="3"><?php echo $antrian.' / '.date("d-m-Y", strtotime($tanggalkunjungan));?></font><br>
                        <img width="200" height="95" src="assets/foto/barcode/<?php echo $barcode;?>">
								
		</div>
		<!-- END BODY -->

</body>
</html>