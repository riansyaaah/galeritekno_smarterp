<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css'); ?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
	<style>

	</style>
</head>

<body>
	<div class="loader"></div>
	<div id="snackbar_custom"></div>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('layout/v_header'); ?>
			<?php $this->load->view('layout/v_menu'); ?>
			<div class="main-content">
				<section class="section">
					<div class="row">
						<div class="col-12">
							<div class="card" id="divTable">
								<div class="card-header">
									<h4><?= $title; ?></h4>
									<hr>
								</div>

								<div class="card-body">
									<div class="table-responsive">
										<div class="loader" style="display:block"></div>
				<div class="panel">
					<div class="panel-heading">
						<span class="panel-title">Data Peserta</span>
					</div>
                    <form class="form-horizontal" role="form" action="<?php echo base_url();?>eklinik/fisik/datapasien/proses_act/<?php echo $noregistrasi;?>" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<div class="panel-body row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-lg-12">
									<table width="100%" class="table table-striped table-hover">
												<tr>
													<td>No Registrasi</td>
													<td>:</td>
													<td><input id="noregistrasi" class="form-control" value="<?php echo (isset($noregistrasi)) ? $noregistrasi : ""; ?>" readonly></td>
												</tr>
												<tr>
													<td>NIK</td>
													<td>:</td>
													<td><div class="input-group">
														<input type="text" class="form-control" name="nik" value="<?php echo (isset($nik)) ? $nik : ""; ?>" id="nik" readonly>

													</div>
												</td>
											</tr>
											<tr>
												<td>Nama</td>
												<td>:</td>
												<td><input id="nama" class="form-control" value="<?php echo (isset($nama)) ? $nama : ""; ?>" disabled></td>
											</tr>
											<tr>
												<td>Tanggal Lahir</td>
												<td>:</td>
												<td><input id="tanggallahir" name="tanggallahir" value="<?php echo (isset($tanggallahir)) ? $tanggallahir : ""; ?> " class="form-control" readonly></td>
											</tr>
                                        <tr>
												<td>Umur</td>
												<td>:</td>
												<td><input id="umur" name="umur" value="<?php echo (isset($umur)) ? $umur : ""; ?> " class="form-control" readonly></td>
											</tr>

											<tr>
												<td>Jenis Kelamin</td>
												<td>:</td>
												<td><input id="jeniskelamin" name="jeniskelamin" value="<?php echo (isset($jeniskelamin)) ? $jeniskelamin : ""; ?>" class="form-control" readonly>
                                                    <input type="hidden" id="jenis_kelamin" name="jenis_kelamin" value="<?php echo (isset($jenis_kelamin)) ? $jenis_kelamin : ""; ?>" class="form-control" readonly></td>
											</tr>
											
                                            <tr>
												<td>Standar Pemeriksaan</td>
												<td>:</td>
												<td><input type="text" id="xstandarsatuan" nama="xstandarsatuan" value="<?php echo (isset($standarsatuan)) ? $standarsatuan : ""; ?>" class="form-control" readonly></td>
											</tr>
                                        
										</table>
									</div>
								</div>
							</div>
				<div class="col-md-6">
								<div class="form-group">
									<div class="col-lg-12">
										<table width="100%" class="table table-striped table-hover">
											

                                            
                                            <tr>
												<td>Dokter Pemeriksa</td>
												<td>:</td>
												<td>
                                                    <select id="dokterpemeriksa"   class="form-control js-source-states" name="dokterpemeriksa" >
                                                        <option value="">Pilih Dokter</option>
									                   <?php foreach($getdokter as $g){?>
                                                        <option <?php if($dokterpemeriksa == $g['nama']){ echo "selected"; }?> value="<?php echo $g['nama'] ;?>"><?php echo $g['nama'] ;?></option>
									                   <?php } ?>
								</select>
												</td>
										</tr>
										<tr>
											<td>Petugas</td>
											<td>:</td>
											<td><select id="petugas"   class="form-control js-source-states" name="petugas" >
                                                        <option value="">Pilih Petugas</option>
									                   <?php foreach($getpetugas as $g){?>
                                                        <option <?php if($petugas == $g['nama']){ echo "selected"; }?> value="<?php echo $g['nama'] ;?>"><?php echo $g['nama'] ;?></option>
									                   <?php } ?>
								</select>
												</td>
									</tr>
                                        <tr>
											<td>Diagnosa</td>
											<td>:</td>
											<td><textarea class="form-control input-lg m-b" rows="10" cols="50" name="diagnosa" id="diagnosa" style="font-size: 10px;" readonly><?php echo (isset($diagnosa)) ? $diagnosa : ""; ?></textarea>
												</td>
									</tr>
                                            <tr>
											<td>Catatan Dokter</td>
											<td>:</td>
											<td><textarea class="form-control input-lg m-b" name="catatandokter" id="catatandokter"><?php echo (isset($catatandokter)) ? $catatandokter : ""; ?></textarea>
												</td>
									</tr>
                                            <tr><td><a href="<?php echo base_url();?>eklinik/fisik/datapasien/cetakhasil/<?php echo $noregistrasi;?>"><button id="cetak"  type="button" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Preview Hasil</button></a></td></tr>
                                            
											
								</table>
							</div>
						</div>
					</div>
				</div>
                    <div class="row">
				<div class="col-md-12">

					<div class="panel">
						<div class="tab-block mb25">
							<ul class="nav nav-tabs tabs-border nav-justified">
                                <li class="active">
												<a href="#FISIK" data-toggle="tab">HASIL PEMERIKSAAN FISIK</a>
								</li>
                            </ul>
						</div>
						<div class="panel-body p20 pb10">
							<div class="tab-content  pn br-n admin-form">
                                <div id="FISIK" class="tab-pane active">
			<div class="section row">
                <div class="col-md-12">
                <div class="alert alert-micro alert-border-left alert-info light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info pr10"></i><strong>DI ISI OLEH PARAMEDIS</strong> </div>
                </div>
                <br>
                <div class="col-md-12"><h5>TANDA VITAL</h5></div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Nadi</label>
                    <div class="col-lg-6">
                        <input type="text" id="nadi" class="form-control" name="nadi" value="<?php echo (isset($nadi)) ? $nadi : ""; ?>">
                        <textarea name="uraiannadi" id="uraiannadi" class="form-control" readonly>Klasifikasi : <?php echo (isset($uraiannadi)) ? $uraiannadi : ""; ?></textarea>
                    </div>
                    <label for="inputStandard" class="col-lg-2 text-left control-label">x/Menit</label>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Pernafasan</label>
                    <div class="col-lg-6">
                        <input type="text" id="pernafasan" class="form-control" name="pernafasan" value="<?php echo (isset($pernafasan)) ? $pernafasan : ""; ?>">
                        <textarea name="uraianpernafasan" id="uraianpernafasan" class="form-control" readonly>Klasifikasi : <?php echo (isset($uraianpernafasan)) ? $uraianpernafasan : ""; ?></textarea>
                    </div>
                    <label for="inputStandard" class="col-lg-2 text-left control-label">x/Menit</label>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sistole</label>
                    <div class="col-lg-6">
                        <input type="text" id="sistole" class="form-control" name="sistole" value="<?php echo (isset($sistole)) ? $sistole : ""; ?>">
                        <input type="hidden" id="standarsatuan" class="form-control" name="standarsatuan" value="<?php echo (isset($standarsatuan)) ? $standarsatuan : ""; ?>">
                    </div>
                    <label for="inputStandard" class="col-lg-2 text-left control-label">mmHg</label>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Diastole</label>
                    <div class="col-lg-6">
                        <input type="text" id="diastole" class="form-control" name="diastole" value="<?php echo (isset($diastole)) ? $diastole : ""; ?>">
                        <textarea name="uraiantekanandarah" id="uraiantekanandarah" class="form-control" readonly>Klasifikasi : <?php echo (isset($uraiantekanandarah)) ? $uraiantekanandarah : ""; ?></textarea>
                    </div>
                    <label for="inputStandard" class="col-lg-2 text-left control-label">mmHg</label>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Suhu Badan</label>
                    <div class="col-lg-6">
                        <input type="text" id="suhubadan" class="form-control" name="suhubadan" value="<?php echo (isset($suhubadan)) ? $suhubadan : ""; ?>">
                        <textarea name="uraiansuhubadan" id="uraiansuhubadan" class="form-control" readonly>Kesan : <?php echo (isset($uraiansuhubadan)) ? $uraiansuhubadan : ""; ?></textarea>
                    </div>
                    <label for="inputStandard" class="col-lg-2 text-left control-label">^c</label>
                </div>
                </div>
                <div class="col-md-6">
                    
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tinggi Badan</label>
                    <div class="col-lg-6">
                        <input type="text" id="tinggibadan" class="form-control" name="tinggibadan" value="<?php echo (isset($tinggibadan)) ? $tinggibadan : ""; ?>" >
                    </div>
                    <label for="inputStandard" class="col-lg-2 text-left control-label">Cm</label>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Berat Badan</label>
                    <div class="col-lg-6">
                        <input type="text" id="beratbadan" class="form-control" name="beratbadan" value="<?php echo (isset($beratbadan)) ? $beratbadan : ""; ?>" >
                    </div>
                    <label for="inputStandard" class="col-lg-2 text-left control-label">Kg</label>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">IMT</label>
                    <div class="col-lg-6">
                        <input type="text" id="imt" class="form-control" name="imt" value="<?php echo (isset($imt)) ? $imt : ""; ?>">
                        <textarea name="uraianimt" id="uraianimt" class="form-control" readonly>Klasifikasi : <?php echo (isset($uraianimt)) ? $uraianimt : ""; ?></textarea>
                    </div>
                    <label for="inputStandard" class="col-lg-2 text-left control-label">Kg/m2</label>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lingkar Perut</label>
                    <div class="col-lg-6">
                        <input type="text" id="lingkarperut" class="form-control" name="lingkarperut" value="<?php echo (isset($lingkarperut)) ? $lingkarperut : ""; ?>">
                    </div>
                    <label for="inputStandard" class="col-lg-2 text-left control-label">Cm</label>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Bentuk Badan</label>
                    <div class="col-lg-6">
                        <select id="bentukbadan"   class="form-control js-source-states" name="bentukbadan" >
                        <option value="ecto" <?php if($bentukbadan == 'ecto'){echo "selected";}?> >ecto</option>
                        <option value="meso" <?php if($bentukbadan == 'meso'){echo "selected";}?>>meso</option>
                        <option value="endo" <?php if($bentukbadan == 'endo'){echo "selected";}?>>endo</option>
				    </select>
                    </div>
                </div>
                </div>
                <br>
                <div class="col-md-12">
                <div class="alert alert-micro alert-border-left alert-info light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info pr10"></i><strong>DI ISI OLEH DOKTER</strong> </div>
                </div>
                <br>
                <div class="col-md-12"><h5>TINGKAT KESADARAN (METODE GCS)</h5></div>
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-2 control-label">MATA</label>
                    <div class="col-lg-10">
                    <select id="tingkatkesadaran_mata"   class="form-control js-source-states" name="tingkatkesadaran_mata" >
                        <option value="4" <?php if($tingkatkesadaran_mata == '4'){echo "selected";}?>>(4) Spontan atau membuka mata dengan sendirinya tanpa dirangsang</option>
                        <option value="3" <?php if($tingkatkesadaran_mata == '3'){echo "selected";}?> >(3) Dengan rangsang suara (dilakukan dengan menyuruh pasien untuk membuka mata)</option>
                        <option value="2" <?php if($tingkatkesadaran_mata == '2'){echo "selected";}?> >(2) Dengan rangsang nyeri (memberikan rangsangan nyeri, misalnya menekan kuku jari)</option>
                        <option value="1" <?php if($tingkatkesadaran_mata == '1'){echo "selected";}?> >(1) Tidak ada respon meskipun sudah dirangsang.</option>
                    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-2 control-label">VERBAL</label>
                    <div class="col-lg-10">
                    <select id="tingkatkesadaran_verbal"   class="form-control js-source-states" name="tingkatkesadaran_verbal" >
                        <option value="5" <?php if($tingkatkesadaran_verbal == '5'){echo "selected";}?>>(5) Orientasi baik, bicaranya jelas</option>
                        <option value="4" <?php if($tingkatkesadaran_verbal == '4'){echo "selected";}?> >(4) Bingung, berbicara mengacau (berulang-ulang), Disorientasi tempat dan waktu</option>
                        <option value="3" <?php if($tingkatkesadaran_verbal == '3'){echo "selected";}?> >(3) Mengucapkan kata-kata yang tidak jelas</option>
                        <option value="2" <?php if($tingkatkesadaran_verbal == '2'){echo "selected";}?> >(2) Suara tanpa arti (mengerang)</option>
                        <option value="1" <?php if($tingkatkesadaran_verbal == '1'){echo "selected";}?> >(1) Tidak ada respon</option>
                    </select>
                        
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-2 control-label">MOTORIK</label>
                    <div class="col-lg-10">
                        <select id="tingkatkesadaran_motorik"   class="form-control js-source-states" name="tingkatkesadaran_motorik" >
                        <option value="6" <?php if($tingkatkesadaran_motorik == '6'){echo "selected";}?>>(6) Mengikuti perintah pemeriksa</option>
                        <option value="5" <?php if($tingkatkesadaran_motorik == '5'){echo "selected";}?>>(5) Melokalisir nyeri, menjangkau dan menjauhkan stimulus saat diberi rangsang nyeri</option>
                        <option value="4" <?php if($tingkatkesadaran_motorik == '4'){echo "selected";}?>>(4) Withdraws, menghindar atau menarik tubuh untuk menjauhi stimulus saat diberi rangsang nyeri. </option>
                        <option value="3" <?php if($tingkatkesadaran_motorik == '3'){echo "selected";}?>>(3) Flexi abnormal, salah satu tangan atau keduanya menekuk saat diberi rangsang nyeri. </option>
                        <option value="2" <?php if($tingkatkesadaran_motorik == '2'){echo "selected";}?>>(2) Extensi abnormal, salah satu tangan atau keduanya bergerak lurus (ekstensi) di sisi tubuh saat diberi rangsang nyeri</option>
                        <option value="1" <?php if($tingkatkesadaran_motorik == '1'){echo "selected";}?>>(1) Tidak ada respon</option>
				    </select>
                        
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-2 control-label">HASIL</label>
                    <div class="col-lg-10">
                        <textarea name="uraiantingkatkesadaran" id="uraiantingkatkesadaran" class="form-control" readonly><?php echo (isset($uraiantingkatkesadaran)) ? $uraiantingkatkesadaran : ""; ?></textarea>
                        
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>KULIT DAN KUKU</h5></div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kulit</label>
                    <div class="col-lg-6">
                    <select id="kulitdankuku_kulit"   class="form-control js-source-states" name="kulitdankuku_kulit" onchange="changeFuncAbnormal('kulitdankuku_kulit');">
                        <option value="Normal" <?php if($kulitdankuku_kulit == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kulitdankuku_kulit == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kulitdankuku_kulit != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankulitdankuku_kulit" id="uraiankulitdankuku_kulit" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankulitdankuku_kulit)) ? $uraiankulitdankuku_kulit : ""; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Selaput Lendir</label>
                    <div class="col-lg-6">
                    <select id="kulitdankuku_selaputlendir"   class="form-control js-source-states" name="kulitdankuku_selaputlendir" onchange="changeFuncAbnormal('kulitdankuku_selaputlendir');">
                        <option value="Normal" <?php if($kulitdankuku_selaputlendir == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kulitdankuku_selaputlendir == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kulitdankuku_selaputlendir != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankulitdankuku_selaputlendir" id="uraiankulitdankuku_selaputlendir" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankulitdankuku_selaputlendir)) ? $uraiankulitdankuku_selaputlendir : ""; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kuku</label>
                    <div class="col-lg-6">
                    <select id="kulitdankuku_kuku"   class="form-control js-source-states" name="kulitdankuku_kuku" onchange="changeFuncAbnormal('kulitdankuku_kuku');">
                        <option value="Normal" <?php if($kulitdankuku_kuku == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kulitdankuku_kuku == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kulitdankuku_kuku != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankulitdankuku_kuku" id="uraiankulitdankuku_kuku" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankulitdankuku_kuku)) ? $uraiankulitdankuku_kuku : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kontraktur</label>
                    <div class="col-lg-6">
                        <select id="kulitdankuku_kontraktur"   class="form-control js-source-states" name="kulitdankuku_kontraktur" onchange="changeFuncAbnormal('kulitdankuku_kontraktur');">
                        <option value="Baik" <?php if($kulitdankuku_kontraktur == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($kulitdankuku_kontraktur == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kulitdankuku_kontraktur != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankulitdankuku_kontraktur" id="uraiankulitdankuku_kontraktur" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankulitdankuku_kontraktur)) ? $uraiankulitdankuku_kontraktur : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Bekas Operasi</label>
                    <div class="col-lg-6">
                        <select id="kulitdankuku_bekasoperasi"   class="form-control js-source-states" name="kulitdankuku_bekasoperasi" >
                        <option value="Tidak Ada" <?php if($kulitdankuku_bekasoperasi == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($kulitdankuku_bekasoperasi == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain-Lain</label>
                    <div class="col-lg-6">
                        <select id="kulitdankuku_lainlain"   class="form-control js-source-states" name="kulitdankuku_lainlain" onchange="changeFuncAbnormal('kulitdankuku_lainlain');">
                        <option value="Normal" <?php if($kulitdankuku_lainlain == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kulitdankuku_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kulitdankuku_lainlain != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankulitdankuku_lainlain" id="uraiankulitdankuku_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankulitdankuku_lainlain)) ? $uraiankulitdankuku_lainlain : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>KEPALA</h5></div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tulang</label>
                    <div class="col-lg-6">
                    <select id="kepala_tulang"   class="form-control js-source-states" name="kepala_tulang" onchange="changeFuncAbnormal('kepala_tulang');">
                        <option value="Normal" <?php if($kepala_tulang == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kepala_tulang == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kepala_tulang != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankepala_tulang" id="uraiankepala_tulang" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankepala_tulang)) ? $uraiankepala_tulang : ""; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kulit Kepala</label>
                    <div class="col-lg-6">
                    <select id="kepala_kulitkepala"   class="form-control js-source-states" name="kepala_kulitkepala" onchange="changeFuncAbnormal('kepala_kulitkepala');">
                        <option value="Normal" <?php if($kepala_kulitkepala == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kepala_kulitkepala == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kepala_kulitkepala != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankepala_kulitkepala" id="uraiankepala_kulitkepala" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankepala_kulitkepala)) ? $uraiankepala_kulitkepala : ""; ?></textarea>
                    </div>
                </div>
                
                </div>
                <div class="col-md-6">
                    <div class="form-group" style="display:none">
                    <label for="inputStandard" class="col-lg-4 control-label">Bentuk Wajah</label>
                    <div class="col-lg-6">
                        <input type="text" id=kepala_bentukwajah class="form-control" name="kepala_bentukwajah" value="<?php echo (isset($kepala_bentukwajah)) ? $kepala_bentukwajah : ""; ?>">
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Rambut</label>
                    <div class="col-lg-6">
                    <select id="kepala_rambut"   class="form-control js-source-states" name="kepala_rambut" onchange="changeFuncAbnormal('kepala_rambut');">
                        <option value="Normal" <?php if($kepala_rambut == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kepala_rambut == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kepala_rambut != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankepala_rambut" id="uraiankepala_rambut" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankepala_rambut)) ? $uraiankepala_rambut : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain-Lain</label>
                    <div class="col-lg-6">
                        <select id="kepala_lainlain"   class="form-control js-source-states" name="kepala_lainlain" onchange="changeFuncAbnormal('kepala_lainlain');">
                        <option value="Normal" <?php if($kepala_lainlain == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kepala_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kepala_lainlain != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankepala_lainlain" id="uraiankepala_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankepala_lainlain)) ? $uraiankepala_lainlain : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>MATA</h5></div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Pemeriksaan Dilakukan</label>
                    <div class="col-lg-6">
                    <select id="mata_pemeriksaandilakukan"   class="form-control js-source-states" name="mata_pemeriksaandilakukan" >
                        <option value="Snellchart_5_M" <?php if($mata_pemeriksaandilakukan == 'Snellchart_5_M'){echo "selected";}?>>Dengan Snellchart 5 M</option>
                        <option value="Snellchart_6_M" <?php if($mata_pemeriksaandilakukan == 'Snellchart_6_M'){echo "selected";}?>>Dengan Snellchart 6 M</option>
                        <option value="Refraksi" <?php if($mata_pemeriksaandilakukan == 'Dengan Refraksi'){echo "selected";}?>>Dengan Refraksi</option>
				    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Penggunaan Kacamata</label>
                    <div class="col-lg-6">
                    <select id="penggunaankacamata"   class="form-control js-source-states" name="penggunaankacamata" >
                        <option value="Tidak" <?php if($penggunaankacamata == 'Tidak'){echo "selected";}?>>Tidak</option>
                        <option value="Ya" <?php if($penggunaankacamata == 'Ya'){echo "selected";}?>>Ya</option>
                    </select>
                    </div>
                </div>
                <div class="form-group" id="dengan" >
                    <label for="inputStandard" class="col-lg-4 control-label"></label>
                    <label for="inputStandard" class="col-lg-1 control-label"><font size="2">OD</font></label>
                    <div class="col-lg-2">
                    <input type="text" id=mata_od class="form-control" name="mata_od" value="<?php echo (isset($mata_od)) ? $mata_od : ""; ?>">/
                        <input type="text" id=mata_ods class="form-control" name="mata_ods" value="<?php echo (isset($mata_ods)) ? $mata_ods : ""; ?>">
                    </div>
                    <label for="inputStandard" class="col-lg-1 control-label"><font size="2">OS</font></label>
                    <div class="col-lg-2">
                    <input type="text" id=mata_os class="form-control" name="mata_os" value="<?php echo (isset($mata_os)) ? $mata_os : ""; ?>">/
                        <input type="text" id=mata_oss class="form-control" name="mata_oss" value="<?php echo (isset($mata_oss)) ? $mata_oss : ""; ?>">
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Visus</label>
                    <div class="col-lg-6">
                    <input type="text" id=mata_visus class="form-control" name="mata_visus" value="<?php echo (isset($mata_visus)) ? $mata_visus : ""; ?>" readonly>
                        <textarea name="uraianmata_visus" id="uraianmata_visus" placeholder="Keterangan Jika Hasil Abnormal" class="form-control" readonly><?php echo (isset($uraianmata_visus)) ? $uraianmata_visus : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Buta Warna</label>
                    <div class="col-lg-6">
                        <select id="mata_butawarna"   class="form-control js-source-states" name="mata_butawarna" >
                        <option value="Tidak" <?php if($mata_butawarna == 'Tidak'){echo "selected";}?>>Tidak</option>
                        <option value="Parsial Hijau - Merah" <?php if($mata_butawarna == 'Parsial Hijau - Merah'){echo "selected";}?>>Parsial Hijau - Merah</option>
                        <option value="Parsial Biru - Kuning" <?php if($mata_butawarna == 'Parsial Biru - Kuning'){echo "selected";}?>>Parsial Biru - Kuning</option>
                        <option value="Total" <?php if($mata_butawarna == 'Total'){echo "selected";}?>>Total</option>
                        <option value="Parsial" <?php if($mata_butawarna == 'Parsial'){echo "selected";}?>>Parsial</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kelainan Mata Lainnya</label>
                    <div class="col-lg-6">
                        <select id="mata_kelainanmatalainnya"   class="form-control js-source-states" name="mata_kelainanmatalainnya" onchange="changeFuncYa('mata_kelainanmatalainnya');">
                        <option value="Tidak" <?php if($mata_kelainanmatalainnya == 'Tidak'){echo "selected";}?>>Tidak</option>
                        <option value="Ya" <?php if($mata_kelainanmatalainnya == 'Ya'){echo "selected";}?>>Ya</option>
                        </select>
                        <textarea <?php if($mata_kelainanmatalainnya != 'Ya'){ echo "style='display:none;'"; } ?> name="uraianmata_kelainanmatalainnya" id="uraianmata_kelainanmatalainnya" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianmata_kelainanmatalainnya)) ? $uraianmata_kelainanmatalainnya : ""; ?></textarea>
                    </div>
                </div>
                    
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lapang Pandang</label>
                    <div class="col-lg-6">
                    <select id="mata_lapangpandang"   class="form-control js-source-states" name="mata_lapangpandang" onchange="changeFuncAbnormal('mata_lapangpandang');">
                        <option value="Normal" <?php if($mata_lapangpandang == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($mata_lapangpandang == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($mata_lapangpandang != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianmata_lapangpandang" id="uraianmata_lapangpandang" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianmata_lapangpandang)) ? $uraianmata_lapangpandang : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>TELINGA</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Daun Telinga Kanan</label>
                    <div class="col-lg-6">
                    <select id="telinga_dauntelingkanan"   class="form-control js-source-states" name="telinga_dauntelingkanan" onchange="changeFuncAbnormal('telinga_dauntelingkanan');">
                        <option value="Normal" <?php if($telinga_dauntelingkanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($telinga_dauntelingkanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($telinga_dauntelingkanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiantelinga_dauntelingkanan" id="uraiantelinga_dauntelingkanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiantelinga_dauntelingkanan)) ? $uraiantelinga_dauntelingkanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Daun Telinga Kiri</label>
                    <div class="col-lg-6">
                    <select id="telinga_dauntelingkiri"   class="form-control js-source-states" name="telinga_dauntelingkiri" onchange="changeFuncAbnormal('telinga_dauntelingkiri');">
                        <option value="Normal" <?php if($telinga_dauntelingkiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($telinga_dauntelingkiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($telinga_dauntelingkiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiantelinga_dauntelingkiri" id="uraiantelinga_dauntelingkiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiantelinga_dauntelingkiri)) ? $uraiantelinga_dauntelingkiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Liang Telinga Kanan</label>
                    <div class="col-lg-6">
                    <select id="telinga_liangtelingakanan"   class="form-control js-source-states" name="telinga_liangtelingakanan" onchange="changeFuncAbnormal('telinga_liangtelingakanan');">
                        <option value="Normal" <?php if($telinga_liangtelingakanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($telinga_liangtelingakanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($telinga_liangtelingakanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiantelinga_liangtelingakanan" id="uraiantelinga_liangtelingakanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiantelinga_liangtelingakanan)) ? $uraiantelinga_liangtelingakanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Liang Telinga Kiri</label>
                    <div class="col-lg-6">
                    <select id="telinga_liangtelingakiri"   class="form-control js-source-states" name="telinga_liangtelingakiri" onchange="changeFuncAbnormal('telinga_liangtelingakiri');">
                        <option value="Normal" <?php if($telinga_liangtelingakiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($telinga_liangtelingakiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($telinga_liangtelingakiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiantelinga_liangtelingakiri" id="uraiantelinga_liangtelingakiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiantelinga_liangtelingakiri)) ? $uraiantelinga_liangtelingakiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Serumen</label>
                    <div class="col-lg-6">
                    <select id="telinga_serumenkanan"   class="form-control js-source-states" name="telinga_serumenkanan" onchange="changeFuncAda('telinga_serumenkanan');">
                        <option value="Tidak Ada" <?php if($telinga_serumenkanan == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($telinga_serumenkanan == 'Ada'){echo "selected";}?>>Ada</option>
                    </select>
                        <textarea <?php if($telinga_serumenkanan != 'Ada'){ echo "style='display:none;'"; } ?> name="uraiantelinga_serumenkanan" id="uraiantelinga_serumenkanan" placeholder="Keterangan Jika Hasil Ada" class="form-control"><?php echo (isset($uraiantelinga_serumenkanan)) ? $uraiantelinga_serumenkanan : ""; ?></textarea>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Membrana Timfani Kanan</label>
                    <div class="col-lg-6">
                    <select id="telinga_membranatimfanikanan"   class="form-control js-source-states" name="telinga_membranatimfanikanan" >
                        <option value="Intak" <?php if($telinga_membranatimfanikanan == 'Intak'){echo "selected";}?>>Intak</option>
                        <option value="Perforasi" <?php if($telinga_membranatimfanikanan == 'Perforasi'){echo "selected";}?>>Perforasi</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Membrana Tifani Kiri</label>
                    <div class="col-lg-6">
                    <select id="telinga_membranatimfanikiri"   class="form-control js-source-states" name="telinga_membranatimfanikiri" >
                        <option value="Intak" <?php if($telinga_membranatimfanikiri == 'Intak'){echo "selected";}?>>Intak</option>
                        <option value="Perforasi" <?php if($telinga_membranatimfanikiri == 'Perforasi'){echo "selected";}?>>Perforasi</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kesan Pendengaran</label>
                    <div class="col-lg-6">
                    <select id="telinga_kesanpendengaran"   class="form-control js-source-states" name="telinga_kesanpendengaran" onchange="changeFuncAbnormal('telinga_kesanpendengaran');">
                        <option value="Normal" <?php if($telinga_kesanpendengaran == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($telinga_kesanpendengaran == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($telinga_kesanpendengaran != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiantelinga_kesanpendengaran" id="uraiantelinga_kesanpendengaran" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiantelinga_kesanpendengaran)) ? $uraiantelinga_kesanpendengaran : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain-Lain</label>
                    <div class="col-lg-6">
                    <select id="telinga_lainlain"   class="form-control js-source-states" name="telinga_lainlain" onchange="changeFuncAbnormal('telinga_lainlain');">
                        <option value="Normal" <?php if($telinga_lainlain == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($telinga_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($telinga_lainlain != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiantelinga_lainlain" id="uraiantelinga_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiantelinga_lainlain)) ? $uraiantelinga_lainlain : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>HIDUNG</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Meatus Nasi</label>
                    <div class="col-lg-6">
                    <select id="hidung_meatusnasi"   class="form-control js-source-states" name="hidung_meatusnasi" onchange="changeFuncAbnormal('hidung_meatusnasi');">
                        <option value="Normal" <?php if($hidung_meatusnasi == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($hidung_meatusnasi == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($hidung_meatusnasi != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianhidung_meatusnasi" id="uraianhidung_meatusnasi" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianhidung_meatusnasi)) ? $uraianhidung_meatusnasi : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Septum Nasi</label>
                    <div class="col-lg-6">
                    <select id="hidung_septumnasi"   class="form-control js-source-states" name="hidung_septumnasi" onchange="changeFuncAbnormal('hidung_septumnasi');">
                        <option value="Normal" <?php if($hidung_septumnasi == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($hidung_septumnasi == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($hidung_septumnasi != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianhidung_septumnasi" id="uraianhidung_septumnasi" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianhidung_septumnasi)) ? $uraianhidung_septumnasi : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Konka Nasal</label>
                    <div class="col-lg-6">
                    <select id="hidung_konkanasal"   class="form-control js-source-states" name="hidung_konkanasal" onchange="changeFuncAbnormal('hidung_konkanasal');">
                        <option value="Normal" <?php if($hidung_konkanasal == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($hidung_konkanasal == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($hidung_konkanasal != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianhidung_konkanasal" id="uraianhidung_konkanasal" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianhidung_konkanasal)) ? $uraianhidung_konkanasal : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Nyeri ketok sinus maksilaris</label>
                    <div class="col-lg-6">
                    <select id="hidung_nyeriketoksinusmaksilaris"   class="form-control js-source-states" name="hidung_nyeriketoksinusmaksilaris" onchange="changeFuncAbnormal('hidung_nyeriketoksinusmaksilaris');">
                        <option value="Normal" <?php if($hidung_nyeriketoksinusmaksilaris == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($hidung_nyeriketoksinusmaksilaris == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($hidung_nyeriketoksinusmaksilaris != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianhidung_nyeriketoksinusmaksilaris" id="uraianhidung_nyeriketoksinusmaksilaris" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianhidung_nyeriketoksinusmaksilaris)) ? $uraianhidung_nyeriketoksinusmaksilaris : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain-Lain</label>
                    <div class="col-lg-6">
                    <select id="hidung_lainlain"   class="form-control js-source-states" name="hidung_lainlain" onchange="changeFuncAbnormal('hidung_lainlain');">
                        <option value="Normal" <?php if($hidung_lainlain == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($hidung_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($hidung_lainlain != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianhidung_lainlain" id="uraianhidung_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianhidung_lainlain)) ? $uraianhidung_lainlain : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>TENGGOROKAN</h5></div>
                <div class="col-md-6">
                    
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tonsil</label>
                    <div class="col-lg-6">
                    <select id="tenggorokan_tonsil"   class="form-control js-source-states" name="tenggorokan_tonsil" onchange="changeFuncAbnormal('tenggorokan_tonsil');">
                        <option value="Normal" <?php if($tenggorokan_tonsil == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($tenggorokan_tonsil == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        
                    </div>
                </div>
                    <div <?php if($tenggorokan_tonsil != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiantenggorokan_tonsil" id="uraiantenggorokan_tonsil">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Ukuran Kanan</label>
                    <div class="col-lg-6">
                        <select id="tenggorokan_ukurankanan"   class="form-control js-source-states" name="tenggorokan_ukurankanan">
                        <option value="T0" <?php if($tenggorokan_ukurankanan == 'T0'){echo "selected";}?>>T0</option>
                        <option value="T1" <?php if($tenggorokan_ukurankanan == 'T1'){echo "selected";}?>>T1</option>
                        <option value="T2" <?php if($tenggorokan_ukurankanan == 'T2'){echo "selected";}?>>T2</option>
                        <option value="T3" <?php if($tenggorokan_ukurankanan == 'T3'){echo "selected";}?>>T3</option>
                        <option value="T4" <?php if($tenggorokan_ukurankanan == 'T4'){echo "selected";}?>>T4</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Ukuran Kiri</label>
                    <div class="col-lg-6">
                    <select id="tenggorokan_ukurankiri"   class="form-control js-source-states" name="tenggorokan_ukurankiri">
                        <option value="T0" <?php if($tenggorokan_ukurankiri == 'T0'){echo "selected";}?>>T0</option>
                        <option value="T1" <?php if($tenggorokan_ukurankiri == 'T1'){echo "selected";}?>>T1</option>
                        <option value="T2" <?php if($tenggorokan_ukurankiri == 'T2'){echo "selected";}?>>T2</option>
                        <option value="T3" <?php if($tenggorokan_ukurankiri == 'T3'){echo "selected";}?>>T3</option>
                        <option value="T4" <?php if($tenggorokan_ukurankiri == 'T4'){echo "selected";}?>>T4</option>
				    </select>
                    </div>
                </div>
                        </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Pharynx</label>
                    <div class="col-lg-6">
                    <select id="tenggorokan_pharynx"   class="form-control js-source-states" name="tenggorokan_pharynx" onchange="changeFuncAbnormal('tenggorokan_pharynx');">
                        <option value="Normal" <?php if($tenggorokan_pharynx == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($tenggorokan_pharynx == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($tenggorokan_pharynx != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiantenggorokan_pharynx" id="uraiantenggorokan_pharynx" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiantenggorokan_pharynx)) ? $uraiantenggorokan_pharynx : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Palatum</label>
                    <div class="col-lg-6">
                    <select id="tenggorokan_palatum"   class="form-control js-source-states" name="tenggorokan_palatum" onchange="changeFuncAbnormal('tenggorokan_palatum');">
                        <option value="Normal" <?php if($tenggorokan_palatum == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($tenggorokan_palatum == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($tenggorokan_palatum != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiantenggorokan_palatum" id="uraiantenggorokan_palatum" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiantenggorokan_palatum)) ? $uraiantenggorokan_palatum : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain-Lain</label>
                    <div class="col-lg-6">
                    <select id="tenggorokan_lainlain"   class="form-control js-source-states" name="tenggorokan_lainlain" onchange="changeFuncAbnormal('tenggorokan_lainlain');">
                        <option value="Normal" <?php if($tenggorokan_lainlain == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($tenggorokan_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($tenggorokan_lainlain != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiantenggorokan_lainlain" id="uraiantenggorokan_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiantenggorokan_lainlain)) ? $uraiantenggorokan_lainlain : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>MULUT</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Oral Hygiene</label>
                    <div class="col-lg-6">
                    <select id="mulut_oralhygiene"   class="form-control js-source-states" name="mulut_oralhygiene" >
                        <option value="Baik" <?php if($mulut_oralhygiene == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Tidak Baik" <?php if($mulut_oralhygiene == 'Tidak Baik'){echo "selected";}?>>Tidak Baik</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gusi</label>
                    <div class="col-lg-6">
                    <select id="mulut_gusi"   class="form-control js-source-states" name="mulut_gusi" >
                        <option value="Baik" <?php if($mulut_gusi == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Tidak Baik" <?php if($mulut_gusi == 'Tidak Baik'){echo "selected";}?>>Tidak Baik</option>
				    </select>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>GIGI</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-4 control-label"></label>
                    <div class="col-lg-6">
                    <select id="gigi"   class="form-control js-source-states" name="gigi" onchange="changeFuncAbnormal('gigi');">
                        <option value="Normal" <?php if($gigi == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($gigi == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                    </div>
                </div>
                </div>
                <div class="col-md-12" id="uraiangigi" <?php if($gigi != 'Abnormal'){ echo "style='display:none;'"; } ?>>
                <div class="col-lg-4">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">POSISI GIGI</label>
                    <div class="col-lg-6">
                    <select id="kanankiri" nama="kanankiri"   class="form-control js-source-states"  >
                        <option value=""></option>
                        <option value="Kanan">Kanan</option>
                        <option value="Kiri">Kiri</option>
				    </select>
                    <select id="atasbawah" nama="atasbawah"   class="form-control js-source-states"  >
                        <option value=""></option>
                        <option value="Atas">Atas</option>
                        <option value="Bawah">Bawah</option>
				    </select>
                        <select id="urutan" nama="urutan"  class="form-control js-source-states"  >
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Temuan</label>
                    <div class="col-lg-6">
                    <select id="temuan" nama="temuan"  class="form-control js-source-states"  >
                        <option value=""></option>
                        <option value="Filling">Filling</option>
                        <option value="Missing">Missing</option>
                        <option value="Caries">Caries</option>
                        <option value="Radix">Radix</option>
                        <option value="Kalkulus">Kalkulus</option>
                        <option value="Impaksi">Impaksi</option>
                        <option value="Prothesa">Prothesa</option>
                        <option value="Abrasi">Abrasi</option>
                        <option value="Fraktur">Fraktur</option>
                        <option value="Plak">Plak</option>
                        <option value="Ginggivitis">Ginggivitis</option>
				    </select>
                    </div>
                </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                    <button type="button" id="tombolgigi" class="btn btn-success pull-right"><i class="fa fa-check"></i> Tambah Temuan</button>
                </div>
                    <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                
      <thead>
        <tr>
          <th colspan="4" style="align:center;">POSISI GIGI</th>
          <th>TEMUAN</th>
        </tr>
      </thead>  
                    <tbody>
                        <?php foreach($temuangigi as $r){?>
                    <tr>
                    <td><a class="btn btn-primary btn-sm" onclick="deleteRow(this,<?php echo $r['id'];?>)"> <i class="fa fa-trash"></i></a></td>
                    <td><?php echo $r['kanankiri'];?></td>
                    <td><?php echo $r['atasbawah'];?></td>
                    <td><?php echo $r['urutan'];?></td>
                    <td><?php echo $r['temuan'];?></td>
                    </tr>
                        <?php } ?>
                    </tbody>
                    
                    </table>
                    
                </div>
                </div>
                <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Keterangan</label>
                    <div class="col-lg-6">
                        <textarea name="keterangan_gigi" id="keterangan_gigi" placeholder="Keterangan " class="form-control"><?php echo (isset($keterangan_gigi)) ? $keterangan_gigi : ""; ?></textarea>
                    </div>
                </div>
                <br>
                <div class="col-md-12"><h5>LEHER</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gerakan leher</label>
                    <div class="col-lg-6">
                    <select id="leher_gerakanleher"   class="form-control js-source-states" name="leher_gerakanleher" onchange="changeFuncAbnormal('leher_gerakanleher');">
                        <option value="Normal" <?php if($leher_gerakanleher == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($leher_gerakanleher == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($leher_gerakanleher != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianleher_gerakanleher" id="uraianleher_gerakanleher" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianleher_gerakanleher)) ? $uraianleher_gerakanleher : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kelenjar thyroid </label>
                    <div class="col-lg-6">
                    <select id="leher_kelenjarthyroid"   class="form-control js-source-states" name="leher_kelenjarthyroid" onchange="changeFuncAbnormal('leher_kelenjarthyroid');">
                        <option value="Normal" <?php if($leher_kelenjarthyroid == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($leher_kelenjarthyroid == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($leher_kelenjarthyroid != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianleher_kelenjarthyroid" id="uraianleher_kelenjarthyroid" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianleher_kelenjarthyroid)) ? $uraianleher_kelenjarthyroid : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Pulsasi carotis</label>
                    <div class="col-lg-6">
                    <select id="leher_pulsasi"   class="form-control js-source-states" name="leher_pulsasi" onchange="changeFuncAbnormal('leher_pulsasi');">
                        <option value="Normal" <?php if($leher_pulsasi == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($leher_pulsasi == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($leher_pulsasi != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianleher_pulsasi" id="uraianleher_pulsasi" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianleher_pulsasi)) ? $uraianleher_pulsasi : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tekanan vena jugularis</label>
                    <div class="col-lg-6">
                    <select id="leher_tekananvenajugularis"   class="form-control js-source-states" name="leher_tekananvenajugularis" onchange="changeFuncAbnormal('leher_tekananvenajugularis');">
                        <option value="Normal" <?php if($leher_tekananvenajugularis == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($leher_tekananvenajugularis == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($leher_tekananvenajugularis != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianleher_tekananvenajugularis" id="uraianleher_tekananvenajugularis" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianleher_tekananvenajugularis)) ? $uraianleher_tekananvenajugularis : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Trachea</label>
                    <div class="col-lg-6">
                    <select id="leher_trachea"   class="form-control js-source-states" name="leher_trachea" onchange="changeFuncAbnormal('leher_trachea');">
                        <option value="Normal" <?php if($leher_trachea == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($leher_trachea == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($leher_trachea != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianleher_trachea" id="uraianleher_trachea" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianleher_trachea)) ? $uraianleher_trachea : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain-Lain</label>
                    <div class="col-lg-6">
                    <select id="leher_lainlain"   class="form-control js-source-states" name="leher_lainlain" onchange="changeFuncAbnormal('leher_lainlain');">
                        <option value="Normal" <?php if($leher_lainlain == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($leher_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($leher_lainlain != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianleher_lainlain" id="uraianleher_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianleher_lainlain)) ? $uraianleher_lainlain : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>DADA</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Bentuk</label>
                    <div class="col-lg-6">
                        <select id="dada_bentuk"   class="form-control js-source-states" name="dada_bentuk">
                        <option value="Normal Chest" <?php if($dada_bentuk == 'Normal Chest'){echo "selected";}?>>Normal Chest</option>
                        <option value="Pigeont Chest" <?php if($dada_bentuk == 'Pigeont Chest'){echo "selected";}?>>Pigeont Chest</option>
                        <option value="Barrel Chest" <?php if($dada_bentuk == 'Barrel Chest'){echo "selected";}?>>Barrel Chest</option>
                        <option value="Funnel Chest" <?php if($dada_bentuk == 'Funnel Chest'){echo "selected";}?>>Funnel Chest</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Mammae</label>
                    <div class="col-lg-6">
                    <select id="dada_mammae"   class="form-control js-source-states" name="dada_mammae" onchange="changeFuncAbnormal('dada_mammae');">
                        <option value="Normal" <?php if($dada_mammae == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($dada_mammae == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($dada_mammae != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiandada_mammae" id="uraiandada_mammae" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiandada_mammae)) ? $uraiandada_mammae : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain-Lain</label>
                    <div class="col-lg-6">
                    <select id="dada_lainlain"   class="form-control js-source-states" name="dada_lainlain" onchange="changeFuncAbnormal('dada_lainlain');">
                        <option value="Normal" <?php if($dada_lainlain == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($dada_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($dada_lainlain != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiandada_lainlain" id="uraiandada_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiandada_lainlain)) ? $uraiandada_lainlain : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>PARU2 DAN JANTUNG</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Palpasi</label>
                    <div class="col-lg-6">
                    <select id="paruparudanjatung_palpasi"   class="form-control js-source-states" name="paruparudanjatung_palpasi" onchange="changeFuncAbnormal('paruparudanjatung_palpasi');">
                        <option value="Normal" <?php if($paruparudanjatung_palpasi == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($paruparudanjatung_palpasi == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($paruparudanjatung_palpasi != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianparuparudanjatung_palpasi" id="uraianparuparudanjatung_palpasi" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianparuparudanjatung_palpasi)) ? $uraianparuparudanjatung_palpasi : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Perkusi kanan</label>
                    <div class="col-lg-6">
                    <select id="paruparudanjatung_perkusikanan"   class="form-control js-source-states" name="paruparudanjatung_perkusikanan" onchange="changeFuncAbnormal('paruparudanjatung_perkusikanan');">
                        <option value="Normal" <?php if($paruparudanjatung_perkusikanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($paruparudanjatung_perkusikanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($paruparudanjatung_perkusikanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianparuparudanjatung_perkusikanan" id="uraianparuparudanjatung_perkusikanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianparuparudanjatung_perkusikanan)) ? $uraianparuparudanjatung_perkusikanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Perkusi kiri </label>
                    <div class="col-lg-6">
                    <select id="paruparudanjatung_perkusikiri"   class="form-control js-source-states" name="paruparudanjatung_perkusikiri" onchange="changeFuncAbnormal('paruparudanjatung_perkusikiri');">
                        <option value="Normal" <?php if($paruparudanjatung_perkusikiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($paruparudanjatung_perkusikiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($paruparudanjatung_perkusikiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianparuparudanjatung_perkusikiri" id="uraianparuparudanjatung_perkusikiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianparuparudanjatung_perkusikiri)) ? $uraianparuparudanjatung_perkusikiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Iktus kordis </label>
                    <div class="col-lg-6">
                    <select id="paruparudanjatung_iktuskordis"   class="form-control js-source-states" name="paruparudanjatung_iktuskordis" onchange="changeFuncAbnormal('paruparudanjatung_iktuskordis');">
                        <option value="Normal" <?php if($paruparudanjatung_iktuskordis == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($paruparudanjatung_iktuskordis == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($paruparudanjatung_iktuskordis != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianparuparudanjatung_iktuskordis" id="uraianparuparudanjatung_iktuskordis" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianparuparudanjatung_iktuskordis)) ? $uraianparuparudanjatung_iktuskordis : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Batas jantung</label>
                    <div class="col-lg-6">
                    <select id="paruparudanjatung_batasjantung"   class="form-control js-source-states" name="paruparudanjatung_batasjantung" onchange="changeFuncAbnormal('paruparudanjatung_batasjantung');">
                        <option value="Normal" <?php if($paruparudanjatung_batasjantung == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($paruparudanjatung_batasjantung == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($paruparudanjatung_batasjantung != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianparuparudanjatung_batasjantung" id="uraianparuparudanjatung_batasjantung" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianparuparudanjatung_batasjantung)) ? $uraianparuparudanjatung_batasjantung : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Bunyi napas</label>
                    <div class="col-lg-6">
                    <select id="paruparudanjatung_bunyinapas"   class="form-control js-source-states" name="paruparudanjatung_bunyinapas" onchange="changeFuncAbnormal('paruparudanjatung_bunyinapas');">
                        <option value="Normal" <?php if($paruparudanjatung_bunyinapas == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($paruparudanjatung_bunyinapas == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($paruparudanjatung_bunyinapas != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianparuparudanjatung_bunyinapas" id="uraianparuparudanjatung_bunyinapas" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianparuparudanjatung_bunyinapas)) ? $uraianparuparudanjatung_bunyinapas : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Bunyi napas tambahan </label>
                    <div class="col-lg-6">
                    <select id="paruparudanjatung_tambahan"   class="form-control js-source-states" name="paruparudanjatung_tambahan" >
                        <option value="Tidak Ada" <?php if($paruparudanjatung_tambahan == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($paruparudanjatung_tambahan == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Bunyi jantung </label>
                    <div class="col-lg-6">
                    <select id="paruparudanjatung_bunyijantung"   class="form-control js-source-states" name="paruparudanjatung_bunyijantung" onchange="changeFuncAbnormal('paruparudanjatung_bunyijantung');">
                        <option value="Normal" <?php if($paruparudanjatung_bunyijantung == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($paruparudanjatung_bunyijantung == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($paruparudanjatung_bunyijantung != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianparuparudanjatung_bunyijantung" id="uraianparuparudanjatung_bunyijantung" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianparuparudanjatung_bunyijantung)) ? $uraianparuparudanjatung_bunyijantung : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>ABDOMEN</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Inspeksi</label>
                    <div class="col-lg-6">
                    <select id="abdomen_inspeksi"   class="form-control js-source-states" name="abdomen_inspeksi" onchange="changeFuncAbnormal('abdomen_inspeksi');">
                        <option value="Normal" <?php if($abdomen_inspeksi == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_inspeksi == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_inspeksi != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianabdomen_inspeksi" id="uraianabdomen_inspeksi" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_inspeksi)) ? $uraianabdomen_inspeksi : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Perkusi</label>
                    <div class="col-lg-6">
                    <select id="abdomen_perkusi"   class="form-control js-source-states" name="abdomen_perkusi" onchange="changeFuncAbnormal('abdomen_perkusi');">
                        <option value="Normal" <?php if($abdomen_perkusi == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_perkusi == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_perkusi != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianabdomen_perkusi" id="uraianabdomen_perkusi" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_perkusi)) ? $uraianabdomen_perkusi : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Auskultasi bising usus </label>
                    <div class="col-lg-6">
                    <select id="abdomen_auskultasibisingusus"   class="form-control js-source-states" name="abdomen_auskultasibisingusus" onchange="changeFuncAbnormal('abdomen_auskultasibisingusus');">
                        <option value="Normal" <?php if($abdomen_auskultasibisingusus == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_auskultasibisingusus == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_auskultasibisingusus != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianabdomen_auskultasibisingusus" id="uraianabdomen_auskultasibisingusus" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_auskultasibisingusus)) ? $uraianabdomen_auskultasibisingusus : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Hati </label>
                    <div class="col-lg-6">
                    <select id="abdomen_hati"   class="form-control js-source-states" name="abdomen_hati" onchange="changeFuncAbnormal('abdomen_hati');">
                        <option value="Normal" <?php if($abdomen_hati == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_hati == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_hati != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianabdomen_hati" id="uraianabdomen_hati" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_hati)) ? $uraianabdomen_hati : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Limpa </label>
                    <div class="col-lg-6">
                    <select id="abdomen_limpa"   class="form-control js-source-states" name="abdomen_limpa" onchange="changeFuncAbnormal('abdomen_limpa');">
                        <option value="Normal" <?php if($abdomen_limpa == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_limpa == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_limpa != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianabdomen_limpa" id="uraianabdomen_limpa" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_limpa)) ? $uraianabdomen_limpa : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Nyeri tekan </label>
                    <div class="col-lg-6">
                    <select id="abdomen_nyeritekan"   class="form-control js-source-states" name="abdomen_nyeritekan" onchange="changeFuncYa('abdomen_nyeritekan');">
                        <option value="Tidak" <?php if($abdomen_nyeritekan == 'Tidak'){echo "selected";}?>>Tidak</option>
                        <option value="Ya" <?php if($abdomen_nyeritekan == 'Ya'){echo "selected";}?>>Ya</option>
				    </select>
                        <textarea <?php if($abdomen_nyeritekan != 'Ya'){ echo "style='display:none;'"; } ?> name="uraianabdomen_nyeritekan" id="uraianabdomen_nyeritekan" placeholder="Keterangan Jika Hasil Ya" class="form-control"><?php echo (isset($uraianabdomen_nyeritekan)) ? $uraianabdomen_nyeritekan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Nyeri ketok kanan </label>
                    <div class="col-lg-6">
                    <select id="abdomen_nyeriketokkanan"   class="form-control js-source-states" name="abdomen_nyeriketokkanan" onchange="changeFuncAbnormal('abdomen_nyeriketokkanan');">
                        <option value="Normal" <?php if($abdomen_nyeriketokkanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_nyeriketokkanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_nyeriketokkanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianabdomen_nyeriketokkanan" id="uraianabdomen_nyeriketokkanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_nyeriketokkanan)) ? $uraianabdomen_nyeriketokkanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Nyeri ketok Kiri </label>
                    <div class="col-lg-6">
                    <select id="abdomen_nyeriketokkiri"   class="form-control js-source-states" name="abdomen_nyeriketokkiri" onchange="changeFuncAbnormal('abdomen_nyeriketokkiri');">
                        <option value="Normal" <?php if($abdomen_nyeriketokkiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_nyeriketokkiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_nyeriketokkiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianabdomen_nyeriketokkiri" id="uraianabdomen_nyeriketokkiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_nyeriketokkiri)) ? $uraianabdomen_nyeriketokkiri : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Ballotement kanan</label>
                    <div class="col-lg-6">
                    <select id="abdomen_ballotementkanan"   class="form-control js-source-states" name="abdomen_ballotementkanan" onchange="changeFuncAbnormal('abdomen_ballotementkanan');">
                        <option value="Normal" <?php if($abdomen_ballotementkanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_ballotementkanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_ballotementkanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianabdomen_ballotementkanan" id="uraianabdomen_ballotementkanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_ballotementkanan)) ? $uraianabdomen_ballotementkanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Ballotement kiri</label>
                    <div class="col-lg-6">
                    <select id="abdomen_ballotementkiri"   class="form-control js-source-states" name="abdomen_ballotementkiri" onchange="changeFuncAbnormal('abdomen_ballotementkiri');">
                        <option value="Normal" <?php if($abdomen_ballotementkiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($tingkatkesadaran_kualitaskontak == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_ballotementkiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianabdomen_ballotementkiri" id="uraianabdomen_ballotementkiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_ballotementkiri)) ? $uraianabdomen_ballotementkiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kandung kemih </label>
                    <div class="col-lg-6">
                    <select id="abdomen_kandungkemih"   class="form-control js-source-states" name="abdomen_kandungkemih" >
                        <option value="Normal" <?php if($abdomen_kandungkemih == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Tidak Normal" <?php if($abdomen_kandungkemih == 'Tidak Normal'){echo "selected";}?>>Tidak Normal</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Anus/rektum/perianal </label>
                    <div class="col-lg-6">
                    <select id="abdomen_anus"   class="form-control js-source-states" name="abdomen_anus" onchange="changeFuncAbnormal('abdomen_anus');">
                        <option value="Normal" <?php if($abdomen_anus == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_anus == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_anus != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianabdomen_anus" id="uraianabdomen_anus" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_anus)) ? $uraianabdomen_anus : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Genitalia eks </label>
                    <div class="col-lg-6">
                    <select id="abdomen_genitaliaeks"   class="form-control js-source-states" name="abdomen_genitaliaeks" onchange="changeFuncAbnormal('abdomen_genitaliaeks');">
                        <option value="Normal" <?php if($abdomen_genitaliaeks == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_genitaliaeks == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_genitaliaeks != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianabdomen_genitaliaeks" id="uraianabdomen_genitaliaeks" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_genitaliaeks)) ? $uraianabdomen_genitaliaeks : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Prostat </label>
                    <div class="col-lg-6">
                    <select id="abdomen_prostat"   class="form-control js-source-states" name="abdomen_prostat" onchange="changeFuncAbnormal('abdomen_prostat');">
                        <option value="Normal" <?php if($abdomen_prostat == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_prostat == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_prostat != 'Ya'){ echo "style='display:none;'"; } ?> name="uraianabdomen_prostat" id="uraianabdomen_prostat" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_prostat)) ? $uraianabdomen_prostat : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain-Lain </label>
                    <div class="col-lg-6">
                    <select id="abdomen_lainlain"   class="form-control js-source-states" name="abdomen_lainlain" onchange="changeFuncAbnormal('abdomen_lainlain');">
                        <option value="Normal" <?php if($abdomen_lainlain == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($abdomen_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($abdomen_lainlain != 'Ya'){ echo "style='display:none;'"; } ?> name="uraianabdomen_lainlain" id="uraianabdomen_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianabdomen_lainlain)) ? $uraianabdomen_lainlain : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>VERTEBRA</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-4 control-label"></label>
                    <div class="col-lg-6">
                    <select id="vertebra"   class="form-control js-source-states" name="vertebra" onchange="changeFuncAbnormal('vertebra');">
                        <option value="Normal" <?php if($vertebra == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($vertebra == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($vertebra != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianvertebra" id="uraianvertebra" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianvertebra)) ? $uraianvertebra : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>EXTREMITAS ATAS</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Simetris</label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_simetris"   class="form-control js-source-states" name="extremitasatas_simetris" onchange="changeFuncTidak('extremitasatas_simetris');">
                        <option value="Ya" <?php if($extremitasatas_simetris == 'Ya'){echo "selected";}?>>Ya</option>
                        <option value="Tidak" <?php if($extremitasatas_simetris == 'Tidak'){echo "selected";}?>>Tidak</option>
                    </select>
                        <textarea <?php if($extremitasatas_simetris != 'Tidak'){ echo "style='display:none;'"; } ?> name="uraianextremitasatas_simetris" id="uraianextremitasatas_simetris" placeholder="Keterangan Jika Hasil Tidak" class="form-control"><?php echo (isset($uraianextremitasatas_simetris)) ? $uraianextremitasatas_simetris : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gerakan Sinistra</label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_gerakankanan"   class="form-control js-source-states" name="extremitasatas_gerakankanan" onchange="changeFuncAbnormal('extremitasatas_gerakankanan');">
                        <option value="Normal" <?php if($extremitasatas_gerakankanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasatas_gerakankanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasatas_gerakankanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasatas_gerakankanan" id="uraianextremitasatas_gerakankanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasatas_gerakankanan)) ? $uraianextremitasatas_gerakankanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gerakan Dextra  </label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_gerakankiri"   class="form-control js-source-states" name="extremitasatas_gerakankiri" onchange="changeFuncAbnormal('extremitasatas_gerakankiri');">
                        <option value="Normal" <?php if($extremitasatas_gerakankiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasatas_gerakankiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasatas_gerakankiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasatas_gerakankiri" id="uraianextremitasatas_gerakankiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasatas_gerakankiri)) ? $uraianextremitasatas_gerakankiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kekuatan Sinistra </label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_kekuatankanan"   class="form-control js-source-states" name="extremitasatas_kekuatankanan" onchange="changeFuncAbnormal('extremitasatas_kekuatankanan');">
                        <option value="Normal" <?php if($extremitasatas_kekuatankanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasatas_kekuatankanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasatas_kekuatankanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasatas_kekuatankanan" id="uraianextremitasatas_kekuatankanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasatas_kekuatankanan)) ? $uraianextremitasatas_kekuatankanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kekuatan Dextra </label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_kekuatankiri"   class="form-control js-source-states" name="extremitasatas_kekuatankiri" onchange="changeFuncAbnormal('extremitasatas_kekuatankiri');">
                        <option value="Normal" <?php if($extremitasatas_kekuatankiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasatas_kekuatankiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasatas_kekuatankiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasatas_kekuatankiri" id="uraianextremitasatas_kekuatankiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasatas_kekuatankiri)) ? $uraianextremitasatas_kekuatankiri : ""; ?></textarea>
                    </div>
                </div> 
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tulang Sinistra </label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_tulangkanan"   class="form-control js-source-states" name="extremitasatas_tulangkanan" onchange="changeFuncAbnormal('extremitasatas_tulangkanan');">
                        <option value="Normal" <?php if($extremitasatas_tulangkanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasatas_tulangkanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasatas_tulangkanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasatas_tulangkanan" id="uraianextremitasatas_tulangkanan" placeholder="Keterangan Jika Hasil Ya" class="form-control"><?php echo (isset($uraianextremitasatas_tulangkanan)) ? $uraianextremitasatas_tulangkanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tulang Dextra </label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_tulangkiri"   class="form-control js-source-states" name="extremitasatas_tulangkiri" onchange="changeFuncAbnormal('extremitasatas_tulangkiri');">
                        <option value="Normal" <?php if($extremitasatas_tulangkiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasatas_tulangkiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasatas_tulangkiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasatas_tulangkiri" id="uraianextremitasatas_tulangkiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasatas_tulangkiri)) ? $uraianextremitasatas_tulangkiri : ""; ?></textarea>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sensibilitas Sinistra</label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_sensibilitaskanan"   class="form-control js-source-states" name="extremitasatas_sensibilitaskanan" onchange="changeFuncAbnormal('extremitasatas_sensibilitaskanan');">
                        <option value="Baik" <?php if($extremitasatas_sensibilitaskanan == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($extremitasatas_sensibilitaskanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasatas_sensibilitaskanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasatas_sensibilitaskanan" id="uraianextremitasatas_sensibilitaskanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasatas_sensibilitaskanan)) ? $uraianextremitasatas_sensibilitaskanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sensibilitas Dextra</label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_sensibilitaskiri"   class="form-control js-source-states" name="extremitasatas_sensibilitaskiri" onchange="changeFuncAbnormal('extremitasatas_sensibilitaskiri');">
                        <option value="Baik" <?php if($extremitasatas_sensibilitaskiri == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($extremitasatas_sensibilitaskiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasatas_sensibilitaskiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasatas_sensibilitaskiri" id="uraianextremitasatas_sensibilitaskiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasatas_sensibilitaskiri)) ? $uraianextremitasatas_sensibilitaskiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Oedema Sinistra </label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_oedemakanan"   class="form-control js-source-states" name="extremitasatas_oedemakanan" >
                        <option value="Tidak Ada" <?php if($extremitasatas_oedemakanan == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($extremitasatas_oedemakanan == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Oedema Dextra  </label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_oedemakiri"   class="form-control js-source-states" name="extremitasatas_oedemakiri" >
                        <option value="Tidak Ada" <?php if($extremitasatas_oedemakiri == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($extremitasatas_oedemakiri == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tremor Sinistra  </label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_tremorkanan"   class="form-control js-source-states" name="extremitasatas_tremorkanan" >
                        <option value="Tidak Ada" <?php if($extremitasatas_tremorkanan == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($extremitasatas_tremorkanan == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tremor Dextra  </label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_tremorkiri"   class="form-control js-source-states" name="extremitasatas_tremorkiri" >
                        <option value="Tidak Ada" <?php if($extremitasatas_tremorkiri == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($extremitasatas_tremorkiri == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain-Lain  </label>
                    <div class="col-lg-6">
                    <select id="extremitasatas_lainlain"   class="form-control js-source-states" name="extremitasatas_lainlain" onchange="changeFuncAbnormal('extremitasatas_lainlain');">
                        <option value="Baik" <?php if($extremitasatas_lainlain == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($extremitasatas_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasatas_lainlain != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasatas_lainlain" id="uraianextremitasatas_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasatas_lainlain)) ? $uraianextremitasatas_lainlain : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-12"><h5>EXTREMITAS BAWAH</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Simetris</label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_simetris"   class="form-control js-source-states" name="extremitasbawah_simetris" onchange="changeFuncTidak('extremitasbawah_simetris');">
                        <option value="Ya" <?php if($extremitasbawah_simetris == 'Ya'){echo "selected";}?>>Ya</option>
                        <option value="Tidak" <?php if($extremitasbawah_simetris == 'Tidak'){echo "selected";}?>>Tidak</option>
                        
                    </select>
                        <textarea <?php if($extremitasbawah_simetris != 'Tidak'){ echo "style='display:none;'"; } ?> name="uraianextremitasbawah_simetris" id="uraianextremitasbawah_simetris" placeholder="Keterangan Jika Hasil Ya" class="form-control"><?php echo (isset($uraianextremitasbawah_simetris)) ? $uraianextremitasbawah_simetris : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gerakan Sinistra</label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_gerakankanan"   class="form-control js-source-states" name="extremitasbawah_gerakankanan" onchange="changeFuncAbnormal('extremitasbawah_gerakankanan');">
                        <option value="Normal" <?php if($extremitasbawah_gerakankanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasbawah_gerakankanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasbawah_gerakankanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasbawah_gerakankanan" id="uraianextremitasbawah_gerakankanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasbawah_gerakankanan)) ? $uraianextremitasbawah_gerakankanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gerakan Dextra  </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_gerakankiri"   class="form-control js-source-states" name="extremitasbawah_gerakankiri" onchange="changeFuncAbnormal('extremitasbawah_gerakankiri');">
                        <option value="Normal" <?php if($extremitasbawah_gerakankiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasbawah_gerakankiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasbawah_gerakankiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasbawah_gerakankiri" id="uraianextremitasbawah_gerakankiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasbawah_gerakankiri)) ? $uraianextremitasbawah_gerakankiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kekuatan Sinistra </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_kekuatankanan"   class="form-control js-source-states" name="extremitasbawah_kekuatankanan" onchange="changeFuncAbnormal('extremitasbawah_kekuatankanan');">
                        <option value="Normal" <?php if($extremitasbawah_kekuatankanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasbawah_kekuatankanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasbawah_kekuatankanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasbawah_kekuatankanan" id="uraianextremitasbawah_kekuatankanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasbawah_kekuatankanan)) ? $uraianextremitasbawah_kekuatankanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kekuatan Dextra </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_kekuatankiri"   class="form-control js-source-states" name="extremitasbawah_kekuatankiri" onchange="changeFuncAbnormal('extremitasbawah_kekuatankiri');">
                        <option value="Normal" <?php if($extremitasbawah_kekuatankiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasbawah_kekuatankiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasbawah_kekuatankiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasbawah_kekuatankiri" id="uraianextremitasbawah_kekuatankiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasbawah_kekuatankiri)) ? $uraianextremitasbawah_kekuatankiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tulang Sinistra </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_tulangkanan"   class="form-control js-source-states" name="extremitasbawah_tulangkanan" onchange="changeFuncAbnormal('extremitasbawah_tulangkanan');">
                        <option value="Normal" <?php if($extremitasbawah_tulangkanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasbawah_tulangkanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasbawah_tulangkanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasbawah_tulangkanan" id="uraianextremitasbawah_tulangkanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasbawah_tulangkanan)) ? $uraianextremitasbawah_tulangkanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tulang Dextra </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_tulangkiri"   class="form-control js-source-states" name="extremitasbawah_tulangkiri" onchange="changeFuncAbnormal('extremitasbawah_tulangkiri');">
                        <option value="Normal" <?php if($extremitasbawah_tulangkiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($extremitasbawah_tulangkiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasbawah_tulangkiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasbawah_tulangkiri" id="uraianextremitasbawah_tulangkiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasbawah_tulangkiri)) ? $uraianextremitasbawah_tulangkiri : ""; ?></textarea>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sensibilitas Sinistra</label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_sensibilitaskanan"   class="form-control js-source-states" name="extremitasbawah_sensibilitaskanan" onchange="changeFuncAbnormal('extremitasbawah_sensibilitaskanan');">
                        <option value="Baik" <?php if($extremitasbawah_sensibilitaskanan == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($extremitasbawah_sensibilitaskanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasbawah_sensibilitaskanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasbawah_sensibilitaskanan" id="uraianextremitasbawah_sensibilitaskanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasbawah_sensibilitaskanan)) ? $uraianextremitasbawah_sensibilitaskanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sensibilitas Dextra</label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_sensibilitaskiri"   class="form-control js-source-states" name="extremitasbawah_sensibilitaskiri" onchange="changeFuncAbnormal('extremitasbawah_sensibilitaskiri');">
                        <option value="Baik" <?php if($extremitasbawah_sensibilitaskiri == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($extremitasbawah_sensibilitaskiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasbawah_sensibilitaskiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasbawah_sensibilitaskiri" id="uraianextremitasbawah_sensibilitaskiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasbawah_sensibilitaskiri)) ? $uraianextremitasbawah_sensibilitaskiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Oedema Sinistra </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_oedemakanan"   class="form-control js-source-states" name="extremitasbawah_oedemakanan" >
                        <option value="Tidak Ada" <?php if($extremitasbawah_oedemakanan == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($extremitasbawah_oedemakanan == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Oedema Dextra  </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_oedemakiri"   class="form-control js-source-states" name="extremitasbawah_oedemakiri" >
                        <option value="Tidak Ada" <?php if($extremitasbawah_oedemakiri == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($extremitasbawah_oedemakiri == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tremor Sinistra  </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_tremorkanan"   class="form-control js-source-states" name="extremitasbawah_tremorkanan" >
                        <option value="Tidak Ada" <?php if($extremitasbawah_tremorkanan == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($extremitasbawah_tremorkanan == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tremor Dextra  </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_tremorkiri"   class="form-control js-source-states" name="extremitasbawah_tremorkiri" >
                        <option value="Tidak Ada" <?php if($extremitasbawah_tremorkiri == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($extremitasbawah_tremorkiri == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Varises Sinistra  </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_variseskanan"   class="form-control js-source-states" name="extremitasbawah_variseskanan" >
                        <option value="Tidak Ada" <?php if($extremitasbawah_variseskanan == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($extremitasbawah_variseskanan == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Varises Dextra  </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_variseskiri"   class="form-control js-source-states" name="extremitasbawah_variseskiri" >
                        <option value="Tidak Ada" <?php if($extremitasbawah_variseskiri == 'Tidak Ada'){echo "selected";}?>>Tidak Ada</option>
                        <option value="Ada" <?php if($extremitasbawah_variseskiri == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain-Lain  </label>
                    <div class="col-lg-6">
                    <select id="extremitasbawah_lainlain"   class="form-control js-source-states" name="extremitasbawah_lainlain" onchange="changeFuncAbnormal('extremitasbawah_lainlain');">
                        <option value="Baik" <?php if($extremitasbawah_lainlain == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($extremitasbawah_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($extremitasbawah_lainlain != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraianextremitasbawah_lainlain" id="uraianextremitasbawah_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraianextremitasbawah_lainlain)) ? $uraianextremitasbawah_lainlain : ""; ?></textarea>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-12"><h5>SARAF/FUNGSI LUHUR</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Daya ingat</label>
                    <div class="col-lg-6">
                    <select id="saraffungsiluhur_dayaingat"   class="form-control js-source-states" name="saraffungsiluhur_dayaingat" onchange="changeFuncAbnormal('saraffungsiluhur_dayaingat');">
                        <option value="Baik" <?php if($saraffungsiluhur_dayaingat == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($saraffungsiluhur_dayaingat == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($saraffungsiluhur_dayaingat != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiansaraffungsiluhur_dayaingat" id="uraiansaraffungsiluhur_dayaingat" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiansaraffungsiluhur_dayaingat)) ? $uraiansaraffungsiluhur_dayaingat : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Orientasi : waktu</label>
                    <div class="col-lg-6">
                    <select id="saraffungsiluhur_orientasiwaktu"   class="form-control js-source-states" name="saraffungsiluhur_orientasiwaktu" onchange="changeFuncAbnormal('saraffungsiluhur_orientasiwaktu');">
                        <option value="Baik" <?php if($saraffungsiluhur_orientasiwaktu == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($saraffungsiluhur_orientasiwaktu == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($saraffungsiluhur_orientasiwaktu != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiansaraffungsiluhur_orientasiwaktu" id="uraiansaraffungsiluhur_orientasiwaktu" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiansaraffungsiluhur_orientasiwaktu)) ? $uraiansaraffungsiluhur_orientasiwaktu : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Orientasi : orang  </label>
                    <div class="col-lg-6">
                    <select id="saraffungsiluhur_orientasiorang"   class="form-control js-source-states" name="saraffungsiluhur_orientasiorang" onchange="changeFuncAbnormal('saraffungsiluhur_orientasiorang');">
                        <option value="Baik" <?php if($saraffungsiluhur_orientasiorang == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($saraffungsiluhur_orientasiorang == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($saraffungsiluhur_orientasiorang != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiansaraffungsiluhur_orientasiorang" id="uraiansaraffungsiluhur_orientasiorang" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiansaraffungsiluhur_orientasiorang)) ? $uraiansaraffungsiluhur_orientasiorang : ""; ?></textarea>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Orientasi : tempat</label>
                    <div class="col-lg-6">
                    <select id="saraffungsiluhur_orientasitempat"   class="form-control js-source-states" name="saraffungsiluhur_orientasitempat" onchange="changeFuncAbnormal('saraffungsiluhur_orientasitempat');">
                        <option value="Baik" <?php if($saraffungsiluhur_orientasitempat == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($saraffungsiluhur_orientasitempat == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($saraffungsiluhur_orientasitempat != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiansaraffungsiluhur_orientasitempat" id="uraiansaraffungsiluhur_orientasitempat" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiansaraffungsiluhur_orientasitempat)) ? $uraiansaraffungsiluhur_orientasitempat : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sikap</label>
                    <div class="col-lg-6">
                        <select id="saraffungsiluhur_sikap"   class="form-control js-source-states" name="saraffungsiluhur_sikap" onchange="changeFuncAbnormal('saraffungsiluhur_sikap');">
                        <option value="Normal" <?php if($saraffungsiluhur_sikap == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($saraffungsiluhur_sikap == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($saraffungsiluhur_sikap != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiansaraffungsiluhur_sikap" id="uraiansaraffungsiluhur_sikap" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiansaraffungsiluhur_sikap)) ? $uraiansaraffungsiluhur_sikap : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kesan saraf otak </label>
                    <div class="col-lg-6">
                    <select id="saraffungsiluhur_kesansarafotak"   class="form-control js-source-states" name="saraffungsiluhur_kesansarafotak" onchange="changeFuncAbnormal('saraffungsiluhur_kesansarafotak');">
                        <option value="Baik" <?php if($saraffungsiluhur_kesansarafotak == 'Baik'){echo "selected";}?>>Baik</option>
                        <option value="Abnormal" <?php if($saraffungsiluhur_kesansarafotak == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($saraffungsiluhur_kesansarafotak != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiansaraffungsiluhur_kesansarafotak" id="uraiansaraffungsiluhur_kesansarafotak" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiansaraffungsiluhur_kesansarafotak)) ? $uraiansaraffungsiluhur_kesansarafotak : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain-Lain </label>
                    <div class="col-lg-6">
                    <select id="saraffungsiluhur_lainlain"   class="form-control js-source-states" name="saraffungsiluhur_lainlain" onchange="changeFuncAbnormal('saraffungsiluhur_lainlain');">
                        <option value="Normal" <?php if($saraffungsiluhur_lainlain == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($saraffungsiluhur_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($saraffungsiluhur_lainlain != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiansaraffungsiluhur_lainlain" id="uraiansaraffungsiluhur_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiansaraffungsiluhur_lainlain)) ? $uraiansaraffungsiluhur_lainlain : ""; ?></textarea>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-12"><h5>KESAN SARAF OTAK</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Fungsi sensorik kanan</label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_fungsisensorikkanan"   class="form-control js-source-states" name="kesansarafotak_fungsisensorikkanan" onchange="changeFuncAbnormal('kesansarafotak_fungsisensorikkanan');">
                        <option value="Normal" <?php if($kesansarafotak_fungsisensorikkanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kesansarafotak_fungsisensorikkanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kesansarafotak_fungsisensorikkanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankesansarafotak_fungsisensorikkanan" id="uraiankesansarafotak_fungsisensorikkanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankesansarafotak_fungsisensorikkanan)) ? $uraiankesansarafotak_fungsisensorikkanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Fungsi sensorik kiri </label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_fungsisensorikkiri"   class="form-control js-source-states" name="kesansarafotak_fungsisensorikkiri" onchange="changeFuncAbnormal('kesansarafotak_fungsisensorikkiri');">
                        <option value="Normal" <?php if($kesansarafotak_fungsisensorikkiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kesansarafotak_fungsisensorikkiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kesansarafotak_fungsisensorikkiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankesansarafotak_fungsisensorikkiri" id="uraiankesansarafotak_fungsisensorikkiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankesansarafotak_fungsisensorikkiri)) ? $uraiankesansarafotak_fungsisensorikkiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Fungsi otonom kanan </label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_fungsiotonomkanan"   class="form-control js-source-states" name="kesansarafotak_fungsiotonomkanan" onchange="changeFuncAbnormal('kesansarafotak_fungsiotonomkanan');">
                        <option value="Normal" <?php if($kesansarafotak_fungsiotonomkanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kesansarafotak_fungsiotonomkanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kesansarafotak_fungsiotonomkanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankesansarafotak_fungsiotonomkanan" id="uraiankesansarafotak_fungsiotonomkanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankesansarafotak_fungsiotonomkanan)) ? $uraiankesansarafotak_fungsiotonomkanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Fungsi otonom kiri  </label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_fungsiotonomkiri"   class="form-control js-source-states" name="kesansarafotak_fungsiotonomkiri" onchange="changeFuncAbnormal('kesansarafotak_fungsiotonomkiri');">
                        <option value="Normal" <?php if($kesansarafotak_fungsiotonomkiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kesansarafotak_fungsiotonomkiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kesansarafotak_fungsiotonomkiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankesansarafotak_fungsiotonomkiri" id="uraiankesansarafotak_fungsiotonomkiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankesansarafotak_fungsiotonomkiri)) ? $uraiankesansarafotak_fungsiotonomkiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Fungsi vaskular kanan </label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_fungsivaskularkanan"   class="form-control js-source-states" name="kesansarafotak_fungsivaskularkanan" onchange="changeFuncAbnormal('kesansarafotak_fungsivaskularkanan');">
                        <option value="Normal" <?php if($kesansarafotak_fungsivaskularkanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kesansarafotak_fungsivaskularkanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kesansarafotak_fungsivaskularkanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankesansarafotak_fungsivaskularkanan" id="uraiankesansarafotak_fungsivaskularkanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankesansarafotak_fungsivaskularkanan)) ? $uraiankesansarafotak_fungsivaskularkanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Fungsi vaskular kiri </label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_fungsivaskularkiri"   class="form-control js-source-states" name="kesansarafotak_fungsivaskularkiri" onchange="changeFuncAbnormal('kesansarafotak_fungsivaskularkiri');">
                        <option value="Normal" <?php if($kesansarafotak_fungsivaskularkiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kesansarafotak_fungsivaskularkiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kesansarafotak_fungsivaskularkiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankesansarafotak_fungsivaskularkiri" id="uraiankesansarafotak_fungsivaskularkiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankesansarafotak_fungsivaskularkiri)) ? $uraiankesansarafotak_fungsivaskularkiri : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gerakan abnormal kanan</label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_gerakanabnormalkanan"   class="form-control js-source-states" name="kesansarafotak_gerakanabnormalkanan" >
                        <option value="Tidak" <?php if($kesansarafotak_gerakanabnormalkanan == 'Tidak'){echo "selected";}?>>Tidak</option>
                        <option value="Ada" <?php if($kesansarafotak_gerakanabnormalkanan == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gerakan abnormal kiri</label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_gerakanabnormalkiri"   class="form-control js-source-states" name="kesansarafotak_gerakanabnormalkiri" >
                        <option value="Tidak" <?php if($kesansarafotak_gerakanabnormalkiri == 'Tidak'){echo "selected";}?>>Tidak</option>
                        <option value="Ada" <?php if($kesansarafotak_gerakanabnormalkiri == 'Ada'){echo "selected";}?>>Ada</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Refl fisiologis patela kanan  </label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_reflfisiologispatelakanan"   class="form-control js-source-states" name="kesansarafotak_reflfisiologispatelakanan" onchange="changeFuncAbnormal('kesansarafotak_reflfisiologispatelakanan');">
                        <option value="Normal" <?php if($kesansarafotak_reflfisiologispatelakanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kesansarafotak_reflfisiologispatelakanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kesansarafotak_reflfisiologispatelakanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankesansarafotak_reflfisiologispatelakanan" id="uraiankesansarafotak_reflfisiologispatelakanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankesansarafotak_reflfisiologispatelakanan)) ? $uraiankesansarafotak_reflfisiologispatelakanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Refl fisiologis patela kiri </label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_reflfisiologispatelakiri"   class="form-control js-source-states" name="kesansarafotak_reflfisiologispatelakiri" onchange="changeFuncAbnormal('kesansarafotak_reflfisiologispatelakiri');">
                        <option value="Normal" <?php if($kesansarafotak_reflfisiologispatelakiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kesansarafotak_reflfisiologispatelakiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kesansarafotak_reflfisiologispatelakiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankesansarafotak_reflfisiologispatelakiri" id="uraiankesansarafotak_reflfisiologispatelakiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankesansarafotak_reflfisiologispatelakiri)) ? $uraiankesansarafotak_reflfisiologispatelakiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Refl patologis babinsky kanan </label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_reflpatologisbabinskykanan"   class="form-control js-source-states" name="kesansarafotak_reflpatologisbabinskykanan" onchange="changeFuncAbnormal('kesansarafotak_reflpatologisbabinskykanan');">
                        <option value="Normal" <?php if($kesansarafotak_reflpatologisbabinskykanan == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kesansarafotak_reflpatologisbabinskykanan == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kesansarafotak_reflpatologisbabinskykanan != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankesansarafotak_reflpatologisbabinskykanan" id="uraiankesansarafotak_reflpatologisbabinskykanan" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankesansarafotak_reflpatologisbabinskykanan)) ? $uraiankesansarafotak_reflpatologisbabinskykanan : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Refl patologis babinsky kiri </label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_reflpatologisbabinskykiri"   class="form-control js-source-states" name="kesansarafotak_reflpatologisbabinskykiri" onchange="changeFuncAbnormal('kesansarafotak_reflpatologisbabinskykiri');" >
                        <option value="Normal" <?php if($kesansarafotak_reflpatologisbabinskykiri == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kesansarafotak_reflpatologisbabinskykiri == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kesansarafotak_reflpatologisbabinskykiri != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankesansarafotak_reflpatologisbabinskykiri" id="uraiankesansarafotak_reflpatologisbabinskykiri" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankesansarafotak_reflpatologisbabinskykiri)) ? $uraiankesansarafotak_reflpatologisbabinskykiri : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Lain Lain </label>
                    <div class="col-lg-6">
                    <select id="kesansarafotak_lainlain"   class="form-control js-source-states" name="kesansarafotak_lainlain" onchange="changeFuncAbnormal('kesansarafotak_lainlain');" >
                        <option value="Normal" <?php if($kesansarafotak_lainlain == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kesansarafotak_lainlain == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kesansarafotak_lainlain != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankesansarafotak_lainlain" id="uraiankesansarafotak_lainlain" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankesansarafotak_lainlain)) ? $uraiankesansarafotak_lainlain : ""; ?></textarea>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-12"><h5>KELENJAR GETAH BENING</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Leher</label>
                    <div class="col-lg-6">
                    <select id="kelenjargetahbening_leher"   class="form-control js-source-states" name="kelenjargetahbening_leher" onchange="changeFuncAbnormal('kelenjargetahbening_leher');" >
                        <option value="Normal" <?php if($kelenjargetahbening_leher == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kelenjargetahbening_leher == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kelenjargetahbening_leher != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankelenjargetahbening_leher" id="uraiankelenjargetahbening_leher" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankelenjargetahbening_leher)) ? $uraiankelenjargetahbening_leher : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Submandibula</label>
                    <div class="col-lg-6">
                    <select id="kelenjargetahbening_submandibula"   class="form-control js-source-states" name="kelenjargetahbening_submandibula" onchange="changeFuncAbnormal('kelenjargetahbening_submandibula');">
                        <option value="Normal" <?php if($kelenjargetahbening_submandibula == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kelenjargetahbening_submandibula == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kelenjargetahbening_submandibula != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankelenjargetahbening_submandibula" id="uraiankelenjargetahbening_submandibula" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankelenjargetahbening_submandibula)) ? $uraiankelenjargetahbening_submandibula : ""; ?></textarea>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Ketiak</label>
                    <div class="col-lg-6">
                    <select id="kelenjargetahbening_ketiak"   class="form-control js-source-states" name="kelenjargetahbening_ketiak" onchange="changeFuncAbnormal('kelenjargetahbening_ketiak');">
                        <option value="Normal" <?php if($kelenjargetahbening_ketiak == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kelenjargetahbening_ketiak == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kelenjargetahbening_ketiak != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankelenjargetahbening_ketiak" id="uraiankelenjargetahbening_ketiak" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankelenjargetahbening_ketiak)) ? $uraiankelenjargetahbening_ketiak : ""; ?></textarea>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Inguinal</label>
                    <div class="col-lg-6">
                    <select id="kelenjargetahbening_inguinal"   class="form-control js-source-states" name="kelenjargetahbening_inguinal" onchange="changeFuncAbnormal('kelenjargetahbening_inguinal');">
                        <option value="Normal" <?php if($kelenjargetahbening_inguinal == 'Normal'){echo "selected";}?>>Normal</option>
                        <option value="Abnormal" <?php if($kelenjargetahbening_inguinal == 'Abnormal'){echo "selected";}?>>Abnormal</option>
				    </select>
                        <textarea <?php if($kelenjargetahbening_inguinal != 'Abnormal'){ echo "style='display:none;'"; } ?> name="uraiankelenjargetahbening_inguinal" id="uraiankelenjargetahbening_inguinal" placeholder="Keterangan Jika Hasil Abnormal" class="form-control"><?php echo (isset($uraiankelenjargetahbening_inguinal)) ? $uraiankelenjargetahbening_inguinal : ""; ?></textarea>
                    </div>
                </div>
                </div>
            </div>
		</div>
                           </div>
	                       <div class="col-md-12">
												<hr>
													<button type="reset" class="btn btn-danger pull-left" onclick="self.history.back()"><i class="fa fa-reply"></i > Cancel</button>
													<button type="submit" id="submit" class="btn btn-success pull-right"><i class="fa fa-check"></i> Submit</button>
				            </div>
                        </div>
                        </div>
                </div>
                </div>
                    </form>
			</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>

		<script src="<?php echo base_url('assets/template/js/app.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/datatables.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/scripts.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/custom.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/toastr.js'); ?>"></script>
        <script>

        $(function(){

            $(".js-source-states").select2();
            $(".js-source-states-2").select2();

            //turn to inline mode
            

        });

    </script>
<script type="text/javascript">

	  
    function changeFuncYa(id) {
			var x = document.getElementById(id).value;
			if (x == 'Ya'){
				$('#uraian'+id).show();
			}else{
				$('#uraian'+id).hide();
			}
		}
    function changeFuncTidak(id) {
			var x = document.getElementById(id).value;
			if (x == 'Tidak'){
				$('#uraian'+id).show();
			}else{
				$('#uraian'+id).hide();
			}
		}
    function changeFuncAda(id) {
			var x = document.getElementById(id).value;
			if (x == 'Ada'){
				$('#uraian'+id).show();
			}else{
				$('#uraian'+id).hide();
			}
		}
    function changeFuncAbnormal(id) {
			var x = document.getElementById(id).value;
			if (x == 'Abnormal'){
				$('#uraian'+id).show();
			}else{
				$('#uraian'+id).hide();
			}
		}
    
    function changeFuncKacamata(id) {
			var x = document.getElementById(id).value;
			if (x == 'dengan'){
				$('#dengan').show();
			}else{
				$('#dengan').hide();
			}
        if (x == 'tanpa'){
				$('#tanpa').show();
			}else{
				$('#tanpa').hide();
			}
		}
   
	</script>
<script>
$(document).ready(function(){
    $("#tinggibadan").change(function(){
        var tinggibadan = $("#tinggibadan").val();
        var beratbadan = $("#beratbadan").val();
        var imt = parseFloat(beratbadan) / (parseFloat(parseFloat(tinggibadan)/100) * parseFloat(parseFloat(tinggibadan)/100));
        $("#imt").val(imt.toFixed(2));
    });
    
    $("#beratbadan").change(function(){
        var tinggibadan = $("#tinggibadan").val();
        var beratbadan = $("#beratbadan").val();
        var imt = parseFloat(beratbadan) / (parseFloat(parseFloat(tinggibadan)/100) * parseFloat(parseFloat(tinggibadan)/100));
        $("#imt").val(imt.toFixed(2));
    });
    
    $("#tombolgigi").click(function(){
                var kanankiri	= $("#kanankiri").val();  
				var atasbawah		= $("#atasbawah").val();  
				var urutan			= $("#urutan").val();   
				var temuan			= $("#temuan").val();   
                
                var table 	= document.getElementById("mytablegigi");
				var row		= table.insertRow(1);
				
				
				var cell1 	= row.insertCell(0);
				var cell2	= row.insertCell(1);
				var cell3 	= row.insertCell(2);
				var cell4 	= row.insertCell(3);
				var cell5 	= row.insertCell(4);
				 
				cell1.innerHTML 	= '<a class="btn btn-primary btn-sm" onclick="deleteRowa(this)"> <i class="fa fa-trash"></i></a>';
				cell2.innerHTML 	= kanankiri;
				cell3.innerHTML 	= atasbawah;
				cell4.innerHTML 	= urutan;
				cell5.innerHTML 	= temuan;
				
				var element2 	= document.createElement("input"); 			
				element2.type 	= "hidden"; 			
				element2.name 	= "kanankiri[]"; 
				element2.value 	= kanankiri; 			
				cell2.appendChild(element2);
                var element3 	= document.createElement("input"); 			
				element3.type 	= "hidden"; 			
				element3.name 	= "atasbawah[]"; 
				element3.value 	= atasbawah; 			
				cell3.appendChild(element3);
                var element4 	= document.createElement("input"); 			
				element4.type 	= "hidden"; 			
				element4.name 	= "urutan[]"; 
				element4.value 	= urutan; 			
				cell4.appendChild(element4);
                var element5 	= document.createElement("input"); 			
				element5.type 	= "hidden"; 			
				element5.name 	= "temuan[]"; 
				element5.value 	= temuan; 			
				cell5.appendChild(element5);
    });
    
    
    
});
</script>
<script>
   function myFunctionhasilfisik(noregistrasi) {
    $("#divmodal").load("<?php echo base_url(); ?>hasilpemeriksaancorporate/cetakhasilfisik/"+noregistrasi);
}           
          
</script>
<script>
function deleteRow(r,id) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("mytablegigi").deleteRow(i);
    $.ajax({
                    url: "<?php echo base_url(); ?>hasilpemeriksaancorporate/deletetemuangigi/"+id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        
                    }
                });
}
</script>
<script>
function deleteRowa(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("mytablegigi").deleteRow(i);
}
</script>
    </div>
</body>

</html>