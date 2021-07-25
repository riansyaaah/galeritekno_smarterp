<?php error_reporting(0);?>
<!doctype html>
<html lang="en">
<<head>
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
					<tr><td style="text-align:center;"><b><font size="5">HASIL PEMERIKSAAN FISIK</font></b></td></tr>
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
</div><br>
        <div style="width:100%; float:right;">
            <div style="width:49%; float:left;">
		<table class="bredak-before special nilai2" >
			<thead>
				<tr>
					<th style="width:30%;text-align:center; background-color:#99ffb9;">PEMERIKSAAN</th>    
					<th style="width:30%;text-align:center;background-color:#99ffb9;">HASIL</th>    
					<th style="text-align:center;background-color:#99ffb9;">KETERANGAN</th>    

				</tr>
			</thead>
			<tbody>
                           <tr><td colspan="3"><b>Tanda Vital</b></td></tr>
                            <tr>
                                <td valign="top">Nadi</td>
                                <td valign="top"><?php echo $nadi;?> x/Menit</td>
                                <td valign="top"><?php echo $uraiannadi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Pernafasan</td>
                                
                                <td valign="top"><?php echo $pernafasan;?> x/Menit</td>
                                <td valign="top"><?php echo $uraianpernafasan;?> </td>
                            </tr>
                            <tr>
                                <td valign="top">Tekanan Darah</td>
                                
                                <td valign="top"><?php echo $sistole.'/'.$diastole;?></td>
                                <td valign="top"><?php echo $uraiantekanandarah;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Suhu Badan</td>
                                
                                <td valign="top"><?php echo $suhubadan;?> °C</td>
                                <td valign="top"><?php echo $uraiansuhubadan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">IMT</td>
                                
                                <td valign="top"><?php echo $imt;?></td>
                                <td valign="top"><?php echo $uraianimt;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lingkar Perut</td>
                                
                                <td valign="top"><?php echo $lingkarperut;?> Cm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Tinggi Badan</td>
                                <td valign="top"><?php echo $tinggibadan;?> Cm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Berat Badan</td>
                                
                                <td valign="top"><?php echo $beratbadan;?> Kg</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Bentuk Badan</td>
                                
                                <td valign="top"><?php echo $bentukbadan;?></td>
                                <td></td>
                            </tr>
                           <tr><td colspan="3"><b>Tingkat Kesadaran (Metode GCS)</b></td></tr>
                            <tr>
            <td style="width:25%;" valign="top">MATA</td>
            
            <td valign="top" colspan="2"><?php switch ($tingkatkesadaran_mata) {
    case "1":
        echo "(1) Tidak ada respon meskipun sudah dirangsang";
        break;
    case "2":
        echo "(2) Dengan rangsang nyeri (memberikan rangsangan nyeri, misalnya menekan kuku jari)";
        break;
    case "3":
        echo "(3) Dengan rangsang suara (dilakukan dengan menyuruh pasien untuk membuka mata)";
        break;
    default:
        echo "(4) Spontan atau membuka mata dengan sendirinya tanpa dirangsang";}?></td>
        </tr>
        <tr>
            <td valign="top">VERBAL</td>
            
            <td valign="top" colspan="2"><?php switch ($tingkatkesadaran_verbal) {
    case "1":
        echo "(1) Tidak ada respon";
        break;
    case "2":
        echo "(2) Suara tanpa arti (mengerang)";
        break;
    case "3":
        echo "(3) Mengucapkan kata-kata yang tidak jelas";
        break;
    case "4":
        echo "(4) Bingung, berbicara mengacau (berulang-ulang), Disorientasi tempat dan waktu";
        break;
    default:
        echo "(5) Orientasi baik, bicaranya jelas";} ?></td>
        </tr>
        <tr>
            <td valign="top">MOTORIK</td>
            
            <td valign="top" colspan="2"><?php switch ($tingkatkesadaran_motorik) {
    case "1":
        echo "(1) Tidak ada respon";
        break;
    case "2":
        echo "(2) Extensi abnormal, salah satu tangan atau keduanya bergerak lurus (ekstensi) di sisi tubuh saat diberi rangsang nyeri";
        break;
    case "3":
        echo "(3) Flexi abnormal, salah satu tangan atau keduanya menekuk saat diberi rangsang nyeri";
        break;
    case "4":
        echo "(4) Withdraws, menghindar atau menarik tubuh untuk menjauhi stimulus saat diberi rangsang nyeri";
        break;
    case "5":
        echo "(5) Melokalisir nyeri, menjangkau dan menjauhkan stimulus saat diberi rangsang nyeri";
        break;
    default:
        echo "(6) Mengikuti perintah pemeriksa";} ?></td>
        </tr>
                            <tr>
                                <td valign="top">HASIL</td>
                                
                                <td valign="top" colspan="2"><?php echo $uraiantingkatkesadaran;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Kulit Dan Kuku</b></td></tr>
                            <tr>
                                <td valign="top">Kulit</td>
                                
                                <td valign="top"><?php echo $kulitdankuku_kulit;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_kulit;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Selaput Lendir</td>
                                
                                <td valign="top"><?php echo $kulitdankuku_selaputlendir;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_selaputlendir;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kuku</td>
                                
                                <td valign="top"><?php echo $kulitdankuku_kuku;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_kuku;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kontraktur</td>
                                
                                <td valign="top"><?php echo $kulitdankuku_kontraktur;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_kontraktur;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Bekas Operasi</td>
                                
                                <td valign="top"><?php echo $kulitdankuku_bekasoperasi;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                
                                <td valign="top"><?php echo $kulitdankuku_lainlain;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_lainlain;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Kepala</b></td></tr>
                            <tr>
                                <td valign="top">Tulang</td>
                                
                                <td valign="top"><?php echo $kepala_tulang;?></td>
                                <td valign="top"><?php echo $uraiankepala_tulang;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kulit Kepala</td>
                                
                                <td valign="top"><?php echo $kepala_kulitkepala;?></td>
                                <td valign="top"><?php echo $uraiankepala_kulitkepala;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Rambut</td>
                                
                                <td valign="top"><?php echo $kepala_rambut;?></td>
                                <td valign="top"><?php echo $uraiankepala_rambut;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                
                                <td valign="top"><?php echo $kepala_lainlain;?></td>
                                <td valign="top"><?php echo $uraiankepala_lainlain;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Mata</b></td></tr>
                            <tr>
                                <td valign="top">Pemeriksaan Dilakukan</td>
                                
                                <td valign="top"><?php echo $mata_pemeriksaandilakukan;?></td>
                                <td></td>
                            </tr>
                <?php if($penggunaankacamata == 'Ya'){?>
                            <tr>
                                <td valign="top">Penggunaan Kacamata</td>
                                
                                <td valign="top"><?php echo $penggunaankacamata;?></td>
                                <td></td>
                            </tr>
                <?php } ?>
                            <tr>
                                <td valign="top">OD</td>
                                
                                <td valign="top"><?php echo $mata_od.'/'.$mata_ods;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">OS</td>
                                
                                <td valign="top"><?php echo $mata_os.'/'.$mata_oss;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Visus</td>
                                
                                <td valign="top"><?php echo $mata_visus;?></td>
                                <td valign="top"><?php echo $uraianmata_visus;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Buta Warna</td>
                                
                                <td valign="top"><?php echo $mata_butawarna;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Kelainan Mata Lainnya</td>
                                
                                <td valign="top"><?php echo $mata_kelainanmatalainnya;?></td>
                                <td valign="top"><?php echo $uraianmata_kelainanmatalainnya;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lapang Pandang</td>
                                
                                <td valign="top"><?php echo $mata_lapangpandang;?></td>
                                <td valign="top"><?php echo $uraianmata_lapangpandang;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Telinga</b></td></tr>
                            <tr>
                                <td valign="top">Daun Telinga Kanan</td>
                                
                                <td valign="top"><?php echo $telinga_dauntelingkanan;?></td>
                                <td valign="top"><?php echo $uraiantelinga_dauntelingkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Daun Telinga Kiri</td>
                                
                                <td valign="top"><?php echo $telinga_dauntelingkiri;?></td>
                                <td valign="top"><?php echo $uraiantelinga_dauntelingkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Liang Telinga Kanan</td>
                                
                                <td valign="top"><?php echo $telinga_liangtelingakanan;?></td>
                                <td valign="top"><?php echo $uraiantelinga_liangtelingakanan;?></td>
                            </tr>
                            
			</tbody>
		</table>
            </div>
            <div style="width:49%; float:right;">
		<table class="bredak-before special nilai2" >
			<thead>
				<tr>
					<th style="width:30%;text-align:center; background-color:#99ffb9;">PEMERIKSAAN</th>    
					<th style="width:30%;text-align:center;background-color:#99ffb9;">HASIL</th>    
					<th style="text-align:center;background-color:#99ffb9;">KETERANGAN</th>    

				</tr>
			</thead>
			<tbody>
                
                            
                            <tr>
                                <td valign="top">Liang Telinga Kiri</td>
                                
                                <td valign="top"><?php echo $telinga_liangtelingakiri;?></td>
                                <td valign="top"><?php echo $uraiantelinga_liangtelingakiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Serumen</td>
                                
                                <td valign="top"><?php echo $telinga_serumenkanan;?></td>
                                <td><?php echo $uraiantelinga_serumenkanan;?></td>
                            </tr>
                            
                            <tr>
                                <td valign="top">Membrana Timfani Kanan</td>
                                
                                <td valign="top"><?php echo $telinga_membranatimfanikanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Membrana Tifani Kiri</td>
                                
                                <td valign="top"><?php echo $telinga_membranatimfanikiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Kesan Pendengaran</td>
                                
                                <td valign="top"><?php echo $telinga_kesanpendengaran;?></td>
                                <td valign="top"><?php echo $uraiantelinga_kesanpendengaran;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                
                                <td valign="top"><?php echo $telinga_lainlain;?></td>
                                <td valign="top"><?php echo $uraiantelinga_lainlain;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Hidung</b></td></tr>
                            <tr>
                                <td valign="top">Meatus Nasi</td>
                                
                                <td valign="top"><?php echo $hidung_meatusnasi;?></td>
                                <td valign="top"><?php echo $uraianhidung_meatusnasi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Septum Nasi</td>
                                
                                <td valign="top"><?php echo $hidung_septumnasi;?></td>
                                <td valign="top"><?php echo $uraianhidung_septumnasi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Konka Nasal</td>
                                
                                <td valign="top"><?php echo $hidung_konkanasal;?></td>
                                <td valign="top"><?php echo $uraianhidung_konkanasal;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Nyeri ketok sinus maksilaris</td>
                                
                                <td valign="top"><?php echo $hidung_nyeriketoksinusmaksilaris;?></td>
                                <td valign="top"><?php echo $uraianhidung_nyeriketoksinusmaksilaris;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                
                                <td valign="top"><?php echo $hidung_lainlain;?></td>
                                <td valign="top"><?php echo $uraianhidung_lainlain;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Tenggorokan</b></td></tr>
                            <tr>
                                <td valign="top">Pharynx</td>
                                
                                <td valign="top"><?php echo $tenggorokan_pharynx;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_pharynx;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Tonsil</td>
                                
                                <td valign="top"><?php echo $tenggorokan_tonsil;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_tonsil;?></td>
                            </tr>
                            <?php if($tenggorokan_tonsil =='Abnormal'){?>
                            <tr>
                                <td valign="top">Ukuran Kanan</td>
                                
                                <td valign="top"><?php echo $tenggorokan_ukurankanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Ukuran Kiri</td>
                                
                                <td valign="top"><?php echo $tenggorokan_ukurankiri;?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                            <tr>
                                <td valign="top">Palatum</td>
                                
                                <td valign="top"><?php echo $tenggorokan_palatum;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_palatum;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                
                                <td valign="top"><?php echo $tenggorokan_lainlain;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_lainlain;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Mulut</b></td></tr>
                            <tr>
                                <td valign="top">Oral Hygiene</td>
                                
                                <td valign="top"><?php echo $mulut_oralhygiene;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Gusi</td>
                                
                                <td valign="top"><?php echo $mulut_gusi;?></td>
                                <td></td>
                            </tr>
                           <tr><td colspan="3"><b>Gigi</b></td></tr>
                            <tr>
                                <td valign="top">Hasil</td>
                                
                                <td valign="top"><?php echo $gigi;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Temuan</td>
                                
                                <td valign="top" colspan="2"><?php foreach($temuangigi as $g){echo $g['temuan'].'('.$g['kanankiri'].' '.$g['atasbawah'].' '.$g['urutan'].')',', ';}?></td>
                                <td valign="top"><?php echo $keterangan_gigi;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Leher</b></td></tr>
                            <tr>
                                <td valign="top">Gerakan leher</td>
                                
                                <td valign="top"><?php echo $leher_gerakanleher;?></td>
                                <td valign="top"><?php echo $uraianleher_gerakanleher;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kelenjar thyroid</td>
                                
                                <td valign="top"><?php echo $leher_kelenjarthyroid;?></td>
                                <td valign="top"><?php echo $uraianleher_kelenjarthyroid;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Pulsasi carotis</td>
                                
                                <td valign="top"><?php echo $leher_pulsasi;?></td>
                                <td valign="top"><?php echo $uraianleher_pulsasi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Tekanan vena jugularis</td>
                                
                                <td valign="top"><?php echo $leher_tekananvenajugularis;?></td>
                                <td valign="top"><?php echo $uraianleher_tekananvenajugularis;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Trachea</td>
                                
                                <td valign="top"><?php echo $leher_trachea;?></td>
                                <td valign="top"><?php echo $uraianleher_trachea;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                
                                <td valign="top"><?php echo $leher_lainlain;?></td>
                                <td valign="top"><?php echo $uraianleher_lainlain;?></td>
                            </tr>
                           
                           <tr><td colspan="3"><b>Paru2 Dan Jantung</b></td></tr>
                            <tr>
                                <td valign="top">Palpasi</td>
                                
                                <td valign="top"><?php echo $paruparudanjatung_palpasi;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_palpasi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Perkusi kanan</td>
                                
                                <td valign="top"><?php echo $paruparudanjatung_perkusikanan;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_perkusikanan;?></td>
                            </tr>
                           <tr>
                                <td valign="top">Perkusi kiri</td>
                                
                                <td valign="top"><?php echo $paruparudanjatung_perkusikiri;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_perkusikiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Iktus kordis</td>
                                
                                <td valign="top"><?php echo $paruparudanjatung_iktuskordis;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_iktuskordis;?></td>
                            </tr>
			</tbody>
		</table>
            </div>
        </div>
        <br>
        <div style="width:100%; float:right;">
            <div style="width:49%; float:left;">
		<table class="bredak-before special nilai2" >
			<thead>
				<tr>
					<th style="width:30%;text-align:center; background-color:#99ffb9;">PEMERIKSAAN</th>    
					<th style="width:30%;text-align:center;background-color:#99ffb9;">HASIL</th>    
					<th style="text-align:center;background-color:#99ffb9;">KETERANGAN</th>    

				</tr>
			</thead>
			<tbody>
                          <tr>
                                <td valign="top">Batas jantung</td>
                                
                                <td valign="top"><?php echo $paruparudanjatung_batasjantung;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_batasjantung;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Bunyi napas</td>
                                
                                <td valign="top"><?php echo $paruparudanjatung_bunyinapas;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_bunyinapas;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Bunyi napas tambahan</td>
                                
                                <td valign="top"><?php echo $paruparudanjatung_tambahan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Bunyi jantung</td>
                                
                                <td valign="top"><?php echo $paruparudanjatung_bunyijantung;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_bunyijantung;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Abdomen</b></td></tr>
                            <tr>
                                <td valign="top">Inspeksi</td>
                                
                                <td valign="top"><?php echo $abdomen_inspeksi;?></td>
                                <td valign="top"><?php echo $uraianabdomen_inspeksi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Perkusi</td>
                                
                                <td valign="top"><?php echo $abdomen_perkusi;?></td>
                                <td valign="top"><?php echo $uraianabdomen_perkusi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Auskultasi bising usus</td>
                                
                                <td valign="top"><?php echo $abdomen_auskultasibisingusus;?></td>
                                <td valign="top"><?php echo $uraianabdomen_auskultasibisingusus;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Hati</td>
                                
                                <td valign="top"><?php echo $abdomen_hati;?></td>
                                <td valign="top"><?php echo $uraianabdomen_hati;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Limpa</td>
                                
                                <td valign="top"><?php echo $abdomen_limpa;?></td>
                                <td valign="top"><?php echo $uraianabdomen_limpa;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Nyeri tekan</td>
                                
                                <td valign="top"><?php echo $abdomen_nyeritekan;?></td>
                                <td valign="top"><?php echo $uraianabdomen_nyeritekan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Nyeri ketok kanan</td>
                                
                                <td valign="top"><?php echo $abdomen_nyeriketokkanan;?></td>
                                <td valign="top"><?php echo $uraianabdomen_nyeriketokkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Nyeri ketok Kiri</td>
                                
                                <td valign="top"><?php echo $abdomen_nyeriketokkiri;?></td>
                                <td valign="top"><?php echo $uraianabdomen_nyeriketokkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Ballotement kanan</td>
                                
                                <td valign="top"><?php echo $abdomen_ballotementkanan;?></td>
                                <td valign="top"><?php echo $uraianabdomen_ballotementkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Ballotement kiri</td>
                                
                                <td valign="top"><?php echo $abdomen_ballotementkiri;?></td>
                                <td valign="top"><?php echo $uraianabdomen_ballotementkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kandung kemih</td>
                                
                                <td valign="top"><?php echo $abdomen_kandungkemih;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Anus/rektum/perianal</td>
                                
                                <td valign="top"><?php echo $abdomen_anus;?>
                                </td>
                                <td valign="top"><?php echo $uraianabdomen_anus;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Genitalia eks</td>
                                
                                <td valign="top"><?php echo $abdomen_genitaliaeks;?></td>
                                <td valign="top"><?php echo $uraianabdomen_genitaliaeks;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Prostat</td>
                                
                                <td valign="top"><?php echo $abdomen_prostat;?></td>
                                <td valign="top"><?php echo $uraianabdomen_prostat;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                
                                <td valign="top"><?php echo $abdomen_lainlain;?></td>
                                <td valign="top"><?php echo $uraianabdomen_lainlain;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Verterbra</b></td></tr>
                            <tr>
                                <td valign="top">Hasil</td>
                                
                                <td valign="top"><?php echo $vertebra;?></td>
                                <td valign="top"><?php echo $uraianvertebra;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Extremitas Atas</b></td></tr>
                            <tr>
                                <td valign="top">Simetris</td>
                                
                                <td valign="top"><?php echo $extremitasatas_simetris;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_simetris;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_gerakankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_gerakankanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_gerakankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_gerakankiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kekuatan Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_kekuatankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_kekuatankanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kekuatan Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_kekuatankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_kekuatankiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Tulang Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_tulangkanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_tulangkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Tulang Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_tulangkiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_tulangkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Sensibilitas Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_sensibilitaskanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_sensibilitaskanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Sensibilitas Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_sensibilitaskiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_sensibilitaskiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Oedema Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_oedemakanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Oedema Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_oedemakiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Tremor Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_tremorkanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Tremor Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasatas_tremorkiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                
                                <td valign="top"><?php echo $extremitasatas_lainlain;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_lainlain;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Extremitas Bawah</b></td></tr>
                            <tr>
                                <td valign="top">Simetris</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_simetris;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_simetris;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_gerakankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_gerakankanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_gerakankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_gerakankiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kekuatan Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_kekuatankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_kekuatankanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kekuatan Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_kekuatankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_kekuatankiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Tulang Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_tulangkanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_tulangkanan;?></td>
                            </tr>
                            
                            
                            
			</tbody>
		</table>
            </div>
            <div style="width:49%; float:right;">
		<table class="bredak-before special nilai2" >
			<thead>
				<tr>
					<th style="width:30%;text-align:center; background-color:#99ffb9;">PEMERIKSAAN</th>    
					<th style="width:30%;text-align:center;background-color:#99ffb9;">HASIL</th>    
					<th style="text-align:center;background-color:#99ffb9;">KETERANGAN</th>    

				</tr>
			</thead>
			<tbody>
                <tr>
                                <td valign="top">Tulang Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_tulangkiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_tulangkiri;?></td>
                            </tr>
                <tr>
                                <td valign="top">Sensibilitas Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_sensibilitaskanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_sensibilitaskanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Sensibilitas Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_sensibilitaskiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_sensibilitaskiri;?></td>
                            </tr>
                            
                            <tr>
                                <td valign="top">Oedema Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_oedemakanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Oedema Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_oedemakiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Tremor Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_tremorkanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Tremor Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_tremorkiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Varises Sinistra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_variseskanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Varises Dextra</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_variseskiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                
                                <td valign="top"><?php echo $extremitasbawah_lainlain;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_lainlain;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Saraf / Fungsi Luhur</b></td></tr>
                            <tr>
                                <td valign="top">Daya ingat</td>
                                
                                <td valign="top"><?php echo $saraffungsiluhur_dayaingat;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Orientasi : waktu</td>
                                
                                <td valign="top"><?php echo $saraffungsiluhur_orientasiwaktu;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_orientasiwaktu;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Orientasi : orang</td>
                                
                                <td valign="top"><?php echo $saraffungsiluhur_orientasiorang;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_orientasiorang;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Orientasi : tempat</td>
                                
                                <td valign="top"><?php echo $saraffungsiluhur_orientasitempat;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_orientasitempat;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Sikap</td>
                                
                                <td valign="top"><?php echo $saraffungsiluhur_sikap;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Kesan saraf otak</td>
                                
                                <td valign="top"><?php echo $saraffungsiluhur_kesansarafotak;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_kesansarafotak;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Kesan Saraf Otak</b></td></tr>
                            <tr>
                                <td valign="top">Fungsi sensorik kanan</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_fungsisensorikkanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsisensorikkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Fungsi sensorik kiri</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_fungsisensorikkiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsisensorikkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Fungsi otonom kanan</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_fungsiotonomkanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsiotonomkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Fungsi otonom kiri</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_fungsiotonomkiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsiotonomkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Fungsi vaskular kanan</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_fungsivaskularkanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsivaskularkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Fungsi vaskular kiri</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_fungsivaskularkiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsivaskularkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan abnormal kanan</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_gerakanabnormalkanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan abnormal kiri</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_gerakanabnormalkiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Refl fisiologis patela kanan</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_reflfisiologispatelakanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflfisiologispatelakanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Refl fisiologis patela kiri</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_reflfisiologispatelakiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflfisiologispatelakiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Refl patologis babinsky kanan</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_reflpatologisbabinskykanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflpatologisbabinskykanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Refl patologis babinsky kiri</td>
                                
                                <td valign="top"><?php echo $kesansarafotak_reflpatologisbabinskykiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflpatologisbabinskykiri;?></td>
                            </tr>
                           <tr><td colspan="3"><b>Kelenjar Getah Bening</b></td></tr>
                            <tr>
                                <td valign="top">Leher</td>
                                
                                <td valign="top"><?php echo $kelenjargetahbening_leher;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_leher;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Submandibula</td>
                                
                                <td valign="top"><?php echo $kelenjargetahbening_submandibula;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_submandibula;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Ketiak</td>
                                
                                <td valign="top"><?php echo $kelenjargetahbening_ketiak;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_ketiak;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Inguinal</td>
                                
                                <td valign="top"><?php echo $kelenjargetahbening_inguinal;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_inguinal;?></td>
                            </tr>
                <tr><td colspan="3"><b>Dada</b></td></tr>
                            <tr>
                                <td valign="top">Bentuk</td>
                                
                                <td valign="top"><?php echo $dada_bentuk;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Mammae</td>
                                
                                <td valign="top"><?php echo $dada_mammae;?></td>
                                <td valign="top"><?php echo $uraiandada_mammae;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                
                                <td valign="top"><?php echo $dada_lainlain;?></td>
                                <td valign="top"><?php echo $uraiandada_lainlain;?></td>
                            </tr>
			</tbody>
		</table>
            </div>
        </div>
	</div><!-- END BODY -->
    <div style="width:100%; float:left;">
				<table class="nilai">
					<tr>
						<td><b>Temuan : </b><p><?php echo trim($diagnosafisik);?></p></td>
					</tr>
					
				</table>
			</div>
    <br>
<div style="width:100%;">
            <div style="width:50%;float:left;">
                
				<table border="0" style="width:100%; font-size:11px;">
					<tr>
						<td>Dokter Pemeriksa</td>
						<td>:</td>
						<td><?php echo $dokterpemeriksafisik; ?></td>
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
</body>
</html>