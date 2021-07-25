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
                    <form class="form-horizontal" role="form" action="<?php echo base_url();?>eklinik/premedcheck/datapasien/proses_act/<?php echo $noregistrasi;?>" enctype="multipart/form-data" method="POST">
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
														<input type="text" class="form-control" name="nik" value="<?php echo (isset($nik)) ? $nik : ""; ?>" id="nrpnip" readonly>

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
                                       
											
										</table>
									</div>
								</div>
							</div>
                        <div class="col-md-6">
							<div class="form-group">
								<div class="col-lg-12">
									<table width="100%" class="table table-striped table-hover">
												
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
												<td>Asal Rujukan</td>
												<td>:</td>
												<td><input id="asalrujukan" nama="asalrujukan" value="<?php echo (isset($asalrujukan)) ? $asalrujukan : ""; ?>" class="form-control" disabled></td>
											</tr>
                                        <tr>
												<td>Jenis Pemeriksaan</td>
												<td>:</td>
												<td><input id="jenispemeriksaan" nama="jenispemeriksaan" value="<?php echo (isset($jenispemeriksaan)) ? $jenispemeriksaan : ""; ?>" class="form-control" readonly></td>
											</tr>
                                        <tr><td><a href="<?php echo base_url();?>eklinik/premedcheck/datapasien/cetakhasil/<?php echo $noregistrasi;?>"><button id="cetak"  type="button" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Preview Hasil</button></a></td></tr>
											
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
												<a href="#NONOKUPASI" data-toggle="tab">FORMULIR GENERAL CHECK UP <?php if($jenispemeriksaan == 'Annual'){echo "OKUPASI";}else{echo "NON OKUPASI";}?></a>
								</li>
                                
                            </ul>
						</div>
						<div class="panel-body p20 pb10">
							<div class="tab-content  pn br-n admin-form">
                              <div id="OKUPASI" class="tab-pane active">
			<div class="section row">
                <div class="col-md-12">
                <div class="alert alert-micro alert-border-left alert-info light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-info pr10"></i><strong>KELUHAN SAAT INI</strong> </div>
                </div>
                <?php if($jenispemeriksaan == 'Annual'){?>
                <div class="col-md-12 row">
                <div class="col-md-6">
                    <div class="col-md-12"><h5>FAKTOR FISIK</h5></div>
                    <input type="hidden" id="jenispemeriksaan" class="form-control" name="jenispemeriksaan" value="<?php echo (isset($jenispemeriksaan)) ? $jenispemeriksaan : ""; ?>">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Kebisingan  </label>
                    <div class="col-lg-6">
                    <select id="faktorfisik_kebisingan"   class="form-control js-source-states" name="faktorfisik_kebisingan" >
                        <option value="Tidak" <?php if($faktorfisik_kebisingan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorfisik_kebisingan == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Suhu panas </label>
                    <div class="col-lg-6">
                    <select id="faktorfisik_suhupanas"   class="form-control js-source-states" name="faktorfisik_suhupanas" >
                        <option value="Tidak" <?php if($faktorfisik_suhupanas == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorfisik_suhupanas == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Suhu dingin </label>
                    <div class="col-lg-6">
                    <select id="faktorfisik_suhudingin"   class="form-control js-source-states" name="faktorfisik_suhudingin" >
                        <option value="Tidak" <?php if($faktorfisik_suhudingin == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorfisik_suhudingin == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Radiasi bukan pengion (gel mikro, infrared,dll) </label>
                    <div class="col-lg-6">
                    <select id="faktorfisik_radiasibukanpengion"   class="form-control js-source-states" name="faktorfisik_radiasibukanpengion" >
                        <option value="Tidak" <?php if($faktorfisik_radiasibukanpengion == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorfisik_radiasibukanpengion == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Radiasi pengion (sinar X, Gamma, dll) </label>
                    <div class="col-lg-6">
                    <select id="faktorfisik_radiasipengion"   class="form-control js-source-states" name="faktorfisik_radiasipengion" >
                        <option value="Tidak" <?php if($faktorfisik_radiasipengion == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorfisik_radiasipengion == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Getaran seluruh tubuh</label>
                    <div class="col-lg-6">
                    <select id="faktorfisik_getaranseluruhtubuh"   class="form-control js-source-states" name="faktorfisik_getaranseluruhtubuh" >
                        <option value="Tidak" <?php if($faktorfisik_getaranseluruhtubuh == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorfisik_getaranseluruhtubuh == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Getaran lokal</label>
                    <div class="col-lg-6">
                    <select id="faktorfisik_getaranlokal"   class="form-control js-source-states" name="faktorfisik_getaranlokal" >
                        <option value="Tidak" <?php if($faktorfisik_getaranlokal == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorfisik_getaranlokal == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Ketinggian</label>
                    <div class="col-lg-6">
                    <select id="faktorfisik_ketinggian"   class="form-control js-source-states" name="faktorfisik_ketinggian" >
                        <option value="Tidak" <?php if($faktorfisik_ketinggian == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorfisik_ketinggian == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Lain-lain</label>
                    <div class="col-lg-6">
                    <select id="faktorfisik_lainlain"   class="form-control js-source-states" name="faktorfisik_lainlain" >
                        <option value="Tidak" <?php if($faktorfisik_lainlain == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorfisik_lainlain == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="col-md-12"><h5>FAKTOR KIMIA</h5></div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Debu anorganik (debu silika, batubara)</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_debuanorganik"   class="form-control js-source-states" name="faktorkimia_debuanorganik" >
                        <option value="Tidak" <?php if($faktorkimia_debuanorganik == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_debuanorganik == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Debu organik</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_debuorganik"   class="form-control js-source-states" name="faktorkimia_debuorganik" >
                        <option value="Tidak" <?php if($faktorkimia_debuorganik == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_debuorganik == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Asap</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_asap"   class="form-control js-source-states" name="faktorkimia_asap" >
                        <option value="Tidak" <?php if($faktorkimia_asap == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_asap == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Bahan kimia berbahaya</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_bahankimia"   class="form-control js-source-states" name="faktorkimia_bahankimia" >
                        <option value="Tidak" <?php if($faktorkimia_bahankimia == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_bahankimia == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Logam berat (Timah Hitam, Air Raksa, dll)</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_logamberat"   class="form-control js-source-states" name="faktorkimia_logamberat" >
                        <option value="Tidak" <?php if($faktorkimia_logamberat == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_logamberat == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Pelarut organik (Benzene, Alkil, Toluen,dll)</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_pelarutorganik"   class="form-control js-source-states" name="faktorkimia_pelarutorganik" >
                        <option value="Tidak" <?php if($faktorkimia_pelarutorganik == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_pelarutorganik == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Iritan asam (Air keras, Asam Sulfat)</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_iritanasam"   class="form-control js-source-states" name="faktorkimia_iritanasam" >
                        <option value="Tidak" <?php if($faktorkimia_iritanasam == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_iritanasam == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Iritan basa (Amoniak, Soda api)</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_iritanbasa"   class="form-control js-source-states" name="faktorkimia_iritanbasa" >
                        <option value="Tidak" <?php if($faktorkimia_iritanbasa == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_iritanbasa == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Cairan pembersih (Amonia, Klor, Kaporit)</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_cairanpembersih"   class="form-control js-source-states" name="faktorkimia_cairanpembersih" >
                        <option value="Tidak" <?php if($faktorkimia_cairanpembersih == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_cairanpembersih == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Pestisida</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_pestisida"   class="form-control js-source-states" name="faktorkimia_pestisida" >
                        <option value="Tidak" <?php if($faktorkimia_pestisida == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_pestisida == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Uap logam (Mangan, Seng)</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_uaplogam"   class="form-control js-source-states" name="faktorkimia_uaplogam" >
                        <option value="Tidak" <?php if($faktorkimia_uaplogam == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_uaplogam == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Lain-lain</label>
                    <div class="col-lg-6">
                    <select id="faktorkimia_lainlain"   class="form-control js-source-states" name="faktorkimia_lainlain" >
                        <option value="Tidak" <?php if($faktorkimia_lainlain == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($faktorkimia_lainlain == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    
                </div>
                </div>
                <div class="col-md-12 row">
                <div class="col-md-6">
                    <div class="col-md-12"><h5>FAKTOR PSIKOSOSIAL</h5></div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Beban Kerja tidak sesuai dengan waktu  </label>
                    <div class="col-lg-6">
                    <select id="fs_bebankerjatidaksesuaiwaktu"   class="form-control js-source-states" name="fs_bebankerjatidaksesuaiwaktu" >
                        <option value="Tidak" <?php if($fs_bebankerjatidaksesuaiwaktu == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fs_bebankerjatidaksesuaiwaktu == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Pekerjaan tidak sesuai dengan pengetahuan </label>
                    <div class="col-lg-6">
                    <select id="fs_pekerjaantidaksesuaipengetahuan"   class="form-control js-source-states" name="fs_pekerjaantidaksesuaipengetahuan" >
                        <option value="Tidak" <?php if($fs_pekerjaantidaksesuaipengetahuan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if(fs_pekerjaantidaksesuaipengetahuan == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Ketidak jelasan tugas </label>
                    <div class="col-lg-6">
                    <select id="fs_ketidakjelasantugas"   class="form-control js-source-states" name="fs_ketidakjelasantugas" >
                        <option value="Tidak" <?php if($fs_ketidakjelasantugas == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fs_ketidakjelasantugas == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Hambatan jenjang karir</label>
                    <div class="col-lg-6">
                    <select id="fs_hambatanjenjangkarir"   class="form-control js-source-states" name="fs_hambatanjenjangkarir" >
                        <option value="Tidak" <?php if($fs_hambatanjenjangkarir == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fs_hambatanjenjangkarir == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Bekerja giliran (shift) </label>
                    <div class="col-lg-6">
                    <select id="fs_bekerjagiliran"   class="form-control js-source-states" name="fs_bekerjagiliran" >
                        <option value="Tidak" <?php if($fs_bekerjagiliran == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fs_bekerjagiliran == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Konflik dengan teman sekerja</label>
                    <div class="col-lg-6">
                    <select id="fs_konflikdengantemansekerja"   class="form-control js-source-states" name="fs_konflikdengantemansekerja" >
                        <option value="Tidak" <?php if($fs_konflikdengantemansekerja == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fs_konflikdengantemansekerja == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Konflik dalam keluarga</label>
                    <div class="col-lg-6">
                    <select id="fs_konflikdalamkeluraga"   class="form-control js-source-states" name="fs_konflikdalamkeluraga" >
                        <option value="Tidak" <?php if($fs_konflikdalamkeluraga == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fs_konflikdalamkeluraga == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Lain-lain</label>
                    <div class="col-lg-6">
                    <select id="fs_lainlain"   class="form-control js-source-states" name="fs_lainlain" >
                        <option value="Tidak" <?php if($fs_lainlain == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fs_lainlain == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="col-md-12"><h5>FAKTOR ERGONOMI</h5></div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Gerakan berulang dengan tangan</label>
                    <div class="col-lg-6">
                    <select id="fe_gerakanberulangdengantangan"   class="form-control js-source-states" name="fe_gerakanberulangdengantangan" >
                        <option value="Tidak" <?php if($fe_gerakanberulangdengantangan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fe_gerakanberulangdengantangan == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Angkat/angkut berat</label>
                    <div class="col-lg-6">
                    <select id="fe_angkutberat"   class="form-control js-source-states" name="fe_angkutberat" >
                        <option value="Tidak" <?php if($fe_angkutberat == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fe_angkutberat == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Duduk lama</label>
                    <div class="col-lg-6">
                    <select id="fe_duduklama"   class="form-control js-source-states" name="fe_duduklama" >
                        <option value="Tidak" <?php if($fe_duduklama == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fe_duduklama == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Berdiri lama</label>
                    <div class="col-lg-6">
                    <select id="fe_berdirilama"   class="form-control js-source-states" name="fe_berdirilama" >
                        <option value="Tidak" <?php if($fe_berdirilama == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fe_berdirilama == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Posisi tubuh tidak ergonomis</label>
                    <div class="col-lg-6">
                    <select id="fe_posisitubuhtidakergonomis"   class="form-control js-source-states" name="fe_posisitubuhtidakergonomis" >
                        <option value="Tidak" <?php if($fe_posisitubuhtidakergonomis == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fe_posisitubuhtidakergonomis == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Pencahayaan tidak sesuai</label>
                    <div class="col-lg-6">
                    <select id="fe_pencahayaantidaksesuai"   class="form-control js-source-states" name="fe_pencahayaantidaksesuai" >
                        <option value="Tidak" <?php if($fe_pencahayaantidaksesuai == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fe_pencahayaantidaksesuai == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Bekerja dengan layar/monitor 4 jam/lebih</label>
                    <div class="col-lg-6">
                    <select id="fe_bekerjadenganlayar"   class="form-control js-source-states" name="fe_bekerjadenganlayar" >
                        <option value="Tidak" <?php if($fe_bekerjadenganlayar == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fe_bekerjadenganlayar == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Lain-lain</label>
                    <div class="col-lg-6">
                    <select id="fe_lainlain"   class="form-control js-source-states" name="fe_lainlain" >
                        <option value="Tidak" <?php if($fe_lainlain == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fe_lainlain == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    
                </div>
                </div>
                <div class="col-md-12 row">
                <div class="col-md-6">
                    <div class="col-md-12"><h5>FAKTOR BIOLOGI</h5></div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Bakteri/Virus/Jamur/Parasit </label>
                    <div class="col-lg-6">
                    <select id="fb_bakteri"   class="form-control js-source-states" name="fb_bakteri" >
                        <option value="Tidak" <?php if($fb_bakteri == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fb_bakteri == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Darah/cairan tubuh lain </label>
                    <div class="col-lg-6">
                    <select id="fb_darahcairan"   class="form-control js-source-states" name="fb_darahcairan" >
                        <option value="Tidak" <?php if($fb_darahcairan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fb_darahcairan == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Nyamuk/serangga/lain-lain </label>
                    <div class="col-lg-6">
                    <select id="fb_nyamukserangga"   class="form-control js-source-states" name="fb_nyamukserangga" >
                        <option value="Tidak" <?php if($fb_nyamukserangga == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fb_nyamukserangga == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Limbah (kotoran manusia/hewan)</label>
                    <div class="col-lg-6">
                    <select id="fb_limbah"   class="form-control js-source-states" name="fb_limbah" >
                        <option value="Tidak" <?php if($fb_limbah == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fb_limbah == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Lain-lain </label>
                    <div class="col-lg-6">
                    <select id="fb_lainlain"   class="form-control js-source-states" name="fb_lainlain" >
                        <option value="Tidak" <?php if($fb_lainlain == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($fb_lainlain == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="col-md-12"><h5>KECELAKAAN KERJA</h5></div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Pernah Mengalami Kecelakaan </label>
                    <div class="col-lg-6">
                    <select id="kecelakaankerja_mengalami_kecelakaan"   class="form-control js-source-states" name="kecelakaankerja_mengalami_kecelakaan" onchange="changeFuncYa('kecelakaankerja_mengalami_kecelakaan');">
                        <option value="Tidak" <?php if($kecelakaankerja_mengalami_kecelakaan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($kecelakaankerja_mengalami_kecelakaan == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div <?php if($kecelakaankerja_mengalami_kecelakaan != 'Ya'){ echo "style='display:none;'"; } ?> id="uraiankecelakaankerja_mengalami_kecelakaan">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Jenis Kecelakaan</label>
                    <div class="col-lg-6">
                    <input type="text" class="form-control" name="kecelakaankerja_jeniskecelakaan" value="<?php echo (isset($kecelakaankerja_jeniskecelakaan)) ? $kecelakaankerja_jeniskecelakaan : ""; ?>" id="kecelakaankerja_tanggalterjadi" >
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Tanggal terjadi</label>
                    <div class="col-lg-6">
                    <input type="date" class="form-control" name="kecelakaankerja_tanggalterjadi" value="<?php echo (isset($kecelakaankerja_tanggalterjadi)) ? $kecelakaankerja_tanggalterjadi : ""; ?>" id="kecelakaankerja_tanggalterjadi" >
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Penyebab</label>
                    <div class="col-lg-6">
                    <input type="text" class="form-control" name="kecelakaankerja_penyebab" value="<?php echo (isset($kecelakaankerja_penyebab)) ? $kecelakaankerja_penyebab : ""; ?>" id="kecelakaankerja_penyebab" >
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Gejala Sisa</label>
                    <div class="col-lg-6">
                    <input type="text" class="form-control" name="kecelakaankerja_gejalasisa" value="<?php echo (isset($kecelakaankerja_gejalasisa)) ? $kecelakaankerja_gejalasisa : ""; ?>" id="kecelakaankerja_gejalasisa" >
                    </div>
                </div>
                    </div>
                </div>
                </div>
                <?php }?>
                <div class="col-md-12 row">
                <div class="col-md-12"><h5>RIWAYAT PENYAKIT KELUARGA (ORANG TUA)</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Darah tinggi </label>
                    <div class="col-lg-6">
                    <select id="riwayatkeluarga_darahtinggi"   class="form-control js-source-states" name="riwayatkeluarga_darahtinggi" >
                        <option value="Tidak" <?php if($riwayatkeluarga_darahtinggi == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkeluarga_darahtinggi == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Kanker </label>
                    <div class="col-lg-6">
                    <select id="riwayatkeluarga_kanker"   class="form-control js-source-states" name="riwayatkeluarga_kanker" >
                        <option value="Tidak" <?php if($riwayatkeluarga_kanker == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkeluarga_kanker == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Ambeien </label>
                    <div class="col-lg-6">
                    <select id="riwayatkeluarga_ambeien"   class="form-control js-source-states" name="riwayatkeluarga_ambeien" >
                        <option value="Tidak" <?php if($riwayatkeluarga_ambeien == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkeluarga_ambeien == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Asma </label>
                    <div class="col-lg-6">
                    <select id="riwayatkeluarga_asma"   class="form-control js-source-states" name="riwayatkeluarga_asma" >
                        <option value="Tidak" <?php if($riwayatkeluarga_asma == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkeluarga_asma == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Jantung </label>
                    <div class="col-lg-6">
                    <select id="riwayatkeluarga_jantung"   class="form-control js-source-states" name="riwayatkeluarga_jantung" >
                        <option value="Tidak" <?php if($riwayatkeluarga_jantung == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkeluarga_jantung == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">TBC </label>
                    <div class="col-lg-6">
                    <select id="riwayatkeluarga_tbc"   class="form-control js-source-states" name="riwayatkeluarga_tbc" >
                        <option value="Tidak" <?php if($riwayatkeluarga_tbc == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkeluarga_tbc == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Stroke/lumpuh separuh badan</label>
                    <div class="col-lg-6">
                        <select id="riwayatkeluarga_stroke"   class="form-control js-source-states" name="riwayatkeluarga_stroke" >
                         <option value="Tidak" <?php if($riwayatkeluarga_stroke == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkeluarga_stroke == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Kencing manis</label>
                    <div class="col-lg-6">
                        <select id="riwayatkeluarga_kencingmanis"   class="form-control js-source-states" name="riwayatkeluarga_kencingmanis" >
                         <option value="Tidak" <?php if($riwayatkeluarga_kencingmanis == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkeluarga_kencingmanis == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Gangguan jiwa </label>
                    <div class="col-lg-6">
                        <select id="riwayatkeluarga_gangguanjiwa"   class="form-control js-source-states" name="riwayatkeluarga_gangguanjiwa" >
                         <option value="Tidak" <?php if($riwayatkeluarga_gangguanjiwa == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkeluarga_gangguanjiwa == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Penyakit kuning/hati </label>
                    <div class="col-lg-6">
                        <select id="riwayatkeluarga_hati"   class="form-control js-source-states" name="riwayatkeluarga_hati" >
                         <option value="Tidak" <?php if($riwayatkeluarga_hati == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkeluarga_hati == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Kelainan darah (Thallasemia dll) </label>
                    <div class="col-lg-6">
                        <select id="riwayatkeluarga_kelainandarah"   class="form-control js-source-states" name="riwayatkeluarga_kelainandarah" >
                         <option value="Tidak" <?php if($riwayatkeluarga_kelainandarah == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkeluarga_kelainandarah == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-12"><h5></h5></div>
                <div class="col-md-6">
                    <div class="col-md-12"><h5>KEBIASAAN</h5></div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Minuman Alkohol  </label>
                    <div class="col-lg-6">
                    <select id="kebiasaan_minumalkohol"   class="form-control js-source-states" name="kebiasaan_minumalkohol" >
                        <option value="Tidak" <?php if($kebiasaan_minumalkohol == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($kebiasaan_minumalkohol == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Merokok </label>
                    <div class="col-lg-6">
                    <select id="kebiasaan_merokok"   class="form-control js-source-states" name="kebiasaan_merokok" onchange="changeFuncYa('kebiasaan_merokok');">
                        <option value="Tidak" <?php if($kebiasaan_merokok == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($kebiasaan_merokok == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div <?php if($kebiasaan_merokok != 'Ya'){ echo "style='display:none;'"; } ?> id="uraiankebiasaan_merokok">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Mulai merokok pada usia  </label>
                    <div class="col-lg-6">
                    <input type="text" id=kebiasaan_mulaimerokokusia class="form-control" name="kebiasaan_mulaimerokokusia" value="<?php echo (isset($kebiasaan_mulaimerokokusia)) ? $kebiasaan_mulaimerokokusia : ""; ?>">
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Mulai berhenti merokok tahun </label>
                    <div class="col-lg-6">
                    <input type="text" id=kebiasaan_berhentimerokok class="form-control" name="kebiasaan_berhentimerokok" value="<?php echo (isset($kebiasaan_berhentimerokok)) ? $kebiasaan_berhentimerokok : ""; ?>">
                    </div>
                </div>
                        </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Olah raga </label>
                    <div class="col-lg-6">
                    <select id="kebiasaan_olahraga"   class="form-control js-source-states" name="kebiasaan_olahraga" onchange="changeFuncYa('kebiasaan_olahraga');">
                        <option value="Tidak" <?php if($kebiasaan_olahraga == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($kebiasaan_olahraga == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group" <?php if($kebiasaan_olahraga != 'Ya'){ echo "style='display:none;'"; } ?> id="uraiankebiasaan_olahraga">
                    <label for="inputStandard" class="col-lg-6 control-label">Olahraga yang dilakukan </label>
                    <div class="col-lg-6">
                    <input type="text" id=kebiasaan_uraianolahraga class="form-control" name="kebiasaan_uraianolahraga" value="<?php echo (isset($kebiasaan_uraianolahraga)) ? $kebiasaan_uraianolahraga : ""; ?>">
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Penggunaan Obat-obatan </label>
                    <div class="col-lg-6">
                    <select id="kebiasaan_penggunaan_obatobatan"   class="form-control js-source-states" name="kebiasaan_penggunaan_obatobatan" onchange="changeFuncAda('kebiasaan_penggunaan_obatobatan');">
                        <option value="Tidak Ada" <?php if($kebiasaan_penggunaan_obatobatan == 'Tidak Ada'){echo "selected";}?> >Tidak Ada</option>
                        <option value="Ada" <?php if($kebiasaan_penggunaan_obatobatan == 'Ada'){echo "selected";}?> >Ada </option>
				    </select>
                    </div>
                </div>
                    <div class="form-group" <?php if($kebiasaan_penggunaan_obatobatan != 'Ada'){ echo "style='display:none;'"; } ?> id="uraiankebiasaan_penggunaan_obatobatan">
                    <label for="inputStandard" class="col-lg-6 control-label">Obat-obatan yang digunakan </label>
                    <div class="col-lg-6">
                    <input type="text" id=kebiasaan_obatan class="form-control" name="kebiasaan_obatan" value="<?php echo (isset($kebiasaan_obatan)) ? $kebiasaan_obatan : ""; ?>">
                    </div>
                </div>
                </div>
                
                <div class="col-md-12"><h5>RIWAYAT KESEHATAN</h5></div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Diphteria </label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_diphteria"   class="form-control js-source-states" name="riwayatkesehatan_diphteria" >
                        <option value="Tidak" <?php if($riwayatkesehatan_diphteria == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_diphteria == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sinusitis </label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_sinusitis"   class="form-control js-source-states" name="riwayatkesehatan_sinusitis" >
                        <option value="Tidak" <?php if($riwayatkesehatan_sinusitis == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_sinusitis == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Bronchitis </label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_bronchitis"   class="form-control js-source-states" name="riwayatkesehatan_bronchitis" >
                        <option value="Tidak" <?php if($riwayatkesehatan_bronchitis == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_bronchitis == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Batuk darah </label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_batukdarah"   class="form-control js-source-states" name="riwayatkesehatan_batukdarah" >
                        <option value="Tidak" <?php if($riwayatkesehatan_batukdarah == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_batukdarah == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">TBC </label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_tbc"   class="form-control js-source-states" name="riwayatkesehatan_tbc" >
                        <option value="Tidak" <?php if($riwayatkesehatan_tbc == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_tbc == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Radang paru </label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_radangparu"   class="form-control js-source-states" name="riwayatkesehatan_radangparu" >
                        <option value="Tidak" <?php if($riwayatkesehatan_radangparu == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_radangparu == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Asma </label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_asma"   class="form-control js-source-states" name="riwayatkesehatan_asma" >
                        <option value="Tidak" <?php if($riwayatkesehatan_asma == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_asma == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sesak nafas</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_sesaknafas"   class="form-control js-source-states" name="riwayatkesehatan_sesaknafas" >
                        <option value="Tidak" <?php if($riwayatkesehatan_sesaknafas == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_sesaknafas == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sulit buang air kecil</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_sulitbak"   class="form-control js-source-states" name="riwayatkesehatan_sulitbak" >
                        <option value="Tidak" <?php if($riwayatkesehatan_sulitbak == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_sulitbak == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Radang Saluran Kemih</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_radangsalurankemih"   class="form-control js-source-states" name="riwayatkesehatan_radangsalurankemih" >
                        <option value="Tidak" <?php if($riwayatkesehatan_radangsalurankemih == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_radangsalurankemih == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Penyakit ginjal</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_penyakitginjal"   class="form-control js-source-states" name="riwayatkesehatan_penyakitginjal" >
                        <option value="Tidak" <?php if($riwayatkesehatan_penyakitginjal == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_penyakitginjal == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kencing batu</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_kencingbatu"   class="form-control js-source-states" name="riwayatkesehatan_kencingbatu" >
                        <option value="Tidak" <?php if($riwayatkesehatan_kencingbatu == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_kencingbatu == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tidak dapat menahan BAB</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_tidakdapatmenahanbab"   class="form-control js-source-states" name="riwayatkesehatan_tidakdapatmenahanbab" >
                        <option value="Tidak" <?php if($riwayatkesehatan_tidakdapatmenahanbab == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_tidakdapatmenahanbab == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tdk dapat menahan BAK</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_tidakdapatmenahanbak"   class="form-control js-source-states" name="riwayatkesehatan_tidakdapatmenahanbak" >
                        <option value="Tidak" <?php if($riwayatkesehatan_tidakdapatmenahanbak == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_tidakdapatmenahanbak == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Radang selaput otak</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_radangselaputotak"   class="form-control js-source-states" name="riwayatkesehatan_radangselaputotak" >
                        <option value="Tidak" <?php if($riwayatkesehatan_radangselaputotak == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_radangselaputotak == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gegar otak</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_gegarotak"   class="form-control js-source-states" name="riwayatkesehatan_gegarotak" >
                        <option value="Tidak" <?php if($riwayatkesehatan_gegarotak == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_gegarotak == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Polio</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_polio"   class="form-control js-source-states" name="riwayatkesehatan_polio" >
                        <option value="Tidak" <?php if($riwayatkesehatan_polio == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_polio == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Ayan/Epilepsi</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_ayan"   class="form-control js-source-states" name="riwayatkesehatan_ayan" >
                        <option value="Tidak" <?php if($riwayatkesehatan_ayan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_ayan == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Stroke/lumpuh</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_stroke"   class="form-control js-source-states" name="riwayatkesehatan_stroke" >
                        <option value="Tidak" <?php if($riwayatkesehatan_stroke == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_stroke == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sakit kepala</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_sakitkepala"   class="form-control js-source-states" name="riwayatkesehatan_sakitkepala" >
                        <option value="Tidak" <?php if($riwayatkesehatan_sakitkepala == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_sakitkepala == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Typhoid</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_typhoid"   class="form-control js-source-states" name="riwayatkesehatan_typhoid" >
                        <option value="Tidak" <?php if($riwayatkesehatan_typhoid == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_typhoid == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Muntah darah</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_muntahdarah"   class="form-control js-source-states" name="riwayatkesehatan_muntahdarah" >
                        <option value="Tidak" <?php if($riwayatkesehatan_muntahdarah == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_muntahdarah == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sulit buang air besar</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_sulitbab"   class="form-control js-source-states" name="riwayatkesehatan_sulitbab" >
                        <option value="Tidak" <?php if($riwayatkesehatan_sulitbab == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_sulitbab == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sakit lambung/maag</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_sakitlambung"   class="form-control js-source-states" name="riwayatkesehatan_sakitlambung" >
                        <option value="Tidak" <?php if($riwayatkesehatan_sakitlambung == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_sakitlambung == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Penyakit kuning</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_penyakitkuning"   class="form-control js-source-states" name="riwayatkesehatan_penyakitkuning" >
                        <option value="Tidak" <?php if($riwayatkesehatan_penyakitkuning == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_penyakitkuning == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Penyakit kandung empedu</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_penyakitkandungempedu"   class="form-control js-source-states" name="riwayatkesehatan_penyakitkandungempedu" >
                        <option value="Tidak" <?php if($riwayatkesehatan_penyakitkandungempedu == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_penyakitkandungempedu == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gangguan menelan</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_gangguanmenelan"   class="form-control js-source-states" name="riwayatkesehatan_gangguanmenelan" >
                        <option value="Tidak" <?php if($riwayatkesehatan_gangguanmenelan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_gangguanmenelan == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Cacar air</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_cacarair"   class="form-control js-source-states" name="riwayatkesehatan_cacarair" >
                        <option value="Tidak" <?php if($riwayatkesehatan_cacarair == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_cacarair == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Jamur kulit</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_jamurkulit"   class="form-control js-source-states" name="riwayatkesehatan_jamurkulit" >
                        <option value="Tidak" <?php if($riwayatkesehatan_jamurkulit == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_jamurkulit == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Penyakit kelamin</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_penyakitkelamin"   class="form-control js-source-states" name="riwayatkesehatan_penyakitkelamin" >
                        <option value="Tidak" <?php if($riwayatkesehatan_penyakitkelamin == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_penyakitkelamin == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Serangan jantung</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_seranganjantung"   class="form-control js-source-states" name="riwayatkesehatan_seranganjantung" >
                        <option value="Tidak" <?php if($riwayatkesehatan_seranganjantung == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_seranganjantung == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Nyeri dada</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_nyeridada"   class="form-control js-source-states" name="riwayatkesehatan_nyeridada" >
                        <option value="Tidak" <?php if($riwayatkesehatan_nyeridada == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_nyeridada == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Rasa berdebar</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_rasaberdebar"   class="form-control js-source-states" name="riwayatkesehatan_rasaberdebar" >
                        <option value="Tidak" <?php if($riwayatkesehatan_rasaberdebar == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_rasaberdebar == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tekanan darah tinggi</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_tekanandarahtinggi"   class="form-control js-source-states" name="riwayatkesehatan_tekanandarahtinggi" >
                        <option value="Tidak" <?php if($riwayatkesehatan_tekanandarahtinggi == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_tekanandarahtinggi == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Ambeien/Wasir</label>
                    <div class="col-lg-6">
                    <select id="riwayatkesehatan_ambeien"   class="form-control js-source-states" name="riwayatkesehatan_ambeien" >
                        <option value="Tidak" <?php if($riwayatkesehatan_ambeien == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_ambeien == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Varises</label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_varises"   class="form-control js-source-states" name="riwayatkesehatan_varises" >
                         <option value="Tidak" <?php if($riwayatkesehatan_varises == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_varises == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Penyakit Gondok/Thyroid</label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_gondok"   class="form-control js-source-states" name="riwayatkesehatan_gondok" >
                         <option value="Tidak" <?php if($riwayatkesehatan_gondok == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_gondok == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Radang Sendi/Rheumatik</label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_radangsendi"   class="form-control js-source-states" name="riwayatkesehatan_radangsendi" >
                         <option value="Tidak" <?php if($riwayatkesehatan_radangsendi == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_radangsendi == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Alergi Makanan</label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_alergimakanan"   class="form-control js-source-states" name="riwayatkesehatan_alergimakanan" onchange="changeFuncYa('riwayatkesehatan_alergimakanan');">
                         <option value="Tidak" <?php if($riwayatkesehatan_alergimakanan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_alergimakanan == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group" <?php if($riwayatkesehatan_alergimakanan != 'Ya'){ echo "style='display:none;'"; } ?> id="uraianriwayatkesehatan_alergimakanan" >
                    <label for="inputStandard" class="col-lg-4 control-label">Makanan (sebutkan) </label>
                    <div class="col-lg-6">
                        <input type="text" id=riwayatkesehatan_uraianalergimakanan class="form-control" name="riwayatkesehatan_uraianalergimakanan" value="<?php echo (isset($riwayatkesehatan_uraianalergimakanan)) ? $riwayatkesehatan_uraianalergimakanan : ""; ?>">
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Alergi Obat</label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_alergiobat"   class="form-control js-source-states" name="riwayatkesehatan_alergiobat" onchange="changeFuncYa('riwayatkesehatan_alergiobat');">
                         <option value="Tidak" <?php if($riwayatkesehatan_alergiobat == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_alergiobat == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group" <?php if($riwayatkesehatan_alergiobat != 'Ya'){ echo "style='display:none;'"; } ?> id="uraianriwayatkesehatan_alergiobat">
                    <label for="inputStandard" class="col-lg-4 control-label">Obat (sebutkan) </label>
                    <div class="col-lg-6">
                        <input type="text" id=riwayatkesehatan_uraianalergiobat class="form-control" name="riwayatkesehatan_uraianalergiobat" value="<?php echo (isset($riwayatkesehatan_uraianalergiobat)) ? $riwayatkesehatan_uraianalergiobat : ""; ?>">
                    </div>
                </div>
                    <div class="form-group" id="riwayatkesehatan_alergilainnya">
                    <label for="inputStandard" class="col-lg-4 control-label">Alergi Lainnya </label>
                    <div class="col-lg-6">
                        <input type="text" id=riwayatkesehatan_alergilainnya class="form-control" name="riwayatkesehatan_alergilainnya" value="<?php echo (isset($riwayatkesehatan_alergilainnya)) ? $riwayatkesehatan_alergilainnya : ""; ?>">
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Kencing manis</label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_kencingmanis"   class="form-control js-source-states" name="riwayatkesehatan_kencingmanis" >
                         <option value="Tidak" <?php if($riwayatkesehatan_kencingmanis == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_kencingmanis == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tetanus </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_tetanus"   class="form-control js-source-states" name="riwayatkesehatan_tetanus" >
                         <option value="Tidak" <?php if($riwayatkesehatan_tetanus == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_tetanus == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Pingsan </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_pingsan"   class="form-control js-source-states" name="riwayatkesehatan_pingsan" >
                         <option value="Tidak" <?php if($riwayatkesehatan_pingsan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_pingsan == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Pelupa </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_pelupa"   class="form-control js-source-states" name="riwayatkesehatan_pelupa" >
                         <option value="Tidak" <?php if($riwayatkesehatan_pelupa == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_pelupa == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sulit Konsentrasi </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_sulitkonsentrasi"   class="form-control js-source-states" name="riwayatkesehatan_sulitkonsentrasi" >
                         <option value="Tidak" <?php if($riwayatkesehatan_sulitkonsentrasi == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_sulitkonsentrasi == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gangguan Penglihatan </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_gangguanpenglihatan"   class="form-control js-source-states" name="riwayatkesehatan_gangguanpenglihatan" >
                         <option value="Tidak" <?php if($riwayatkesehatan_gangguanpenglihatan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_gangguanpenglihatan == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gangguan Pendengaran </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_gangguanpendengaran"   class="form-control js-source-states" name="riwayatkesehatan_gangguanpendengaran" >
                         <option value="Tidak" <?php if($riwayatkesehatan_gangguanpendengaran == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_gangguanpendengaran == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Sakit Pinggang </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_sakitpinggang"   class="form-control js-source-states" name="riwayatkesehatan_sakitpinggang" >
                         <option value="Tidak" <?php if($riwayatkesehatan_sakitpinggang == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_sakitpinggang == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Tumor Ganas/Kanker </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_tumorganas"   class="form-control js-source-states" name="riwayatkesehatan_tumorganas" >
                         <option value="Tidak" <?php if($riwayatkesehatan_tumorganas == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_tumorganas == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Penyakit Jiwa </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_penyakitjiwa"   class="form-control js-source-states" name="riwayatkesehatan_penyakitjiwa" >
                         <option value="Tidak" <?php if($riwayatkesehatan_penyakitjiwa == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_penyakitjiwa == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">TBC Kulit </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_tbckulit"   class="form-control js-source-states" name="riwayatkesehatan_tbckulit" >
                         <option value="Tidak" <?php if($riwayatkesehatan_tbckulit == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_tbckulit == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">TBC Tulang dan Lainnya </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_tbctulang"   class="form-control js-source-states" name="riwayatkesehatan_tbctulang" >
                         <option value="Tidak" <?php if($riwayatkesehatan_tbctulang == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_tbctulang == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Campak </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_campak"   class="form-control js-source-states" name="riwayatkesehatan_campak" >
                         <option value="Tidak" <?php if($riwayatkesehatan_campak == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_campak == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Malaria </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_malaria"   class="form-control js-source-states" name="riwayatkesehatan_malaria" >
                         <option value="Tidak" <?php if($riwayatkesehatan_malaria == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_malaria == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Diabetes </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_diabetes"   class="form-control js-source-states" name="riwayatkesehatan_diabetes" >
                         <option value="Tidak" <?php if($riwayatkesehatan_diabetes == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_diabetes == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Gangguan Tidur </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_gangguantidur"   class="form-control js-source-states" name="riwayatkesehatan_gangguantidur" >
                         <option value="Tidak" <?php if($riwayatkesehatan_gangguantidur == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_gangguantidur == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Pernah Dirawat di Rumah Sakit </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_pernahdirawat"   class="form-control js-source-states" name="riwayatkesehatan_pernahdirawat" >
                         <option value="Tidak" <?php if($riwayatkesehatan_pernahdirawat == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_pernahdirawat == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Pernah Mengalami Kecelakaan </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_pernahkecelakaan"   class="form-control js-source-states" name="riwayatkesehatan_pernahkecelakaan" >
                         <option value="Tidak" <?php if($riwayatkesehatan_pernahkecelakaan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_pernahkecelakaan == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">Pernah Dioperasi </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_pernahdioperasi"   class="form-control js-source-states" name="riwayatkesehatan_pernahdioperasi" >
                         <option value="Tidak" <?php if($riwayatkesehatan_pernahdioperasi == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_pernahdioperasi == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-4 control-label">LAIN-LAIN </label>
                    <div class="col-lg-6">
                        <select id="riwayatkesehatan_lainlain"   class="form-control js-source-states" name="riwayatkesehatan_lainlain" >
                         <option value="Tidak" <?php if($riwayatkesehatan_lainlain == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatkesehatan_lainlain == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                </div>
                  <?php if($jenispemeriksaan == 'Annual'){?>  
                <div class="col-md-6">
                    <div class="col-md-12"><h5>RIWAYAT IMUNISASI</h5></div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Hepatitis A </label>
                    <div class="col-lg-6">
                    <select id="riwayatimunisasi_hepatitisa"   class="form-control js-source-states" name="riwayatimunisasi_hepatitisa" >
                        <option value="Tidak" <?php if($riwayatimunisasi_hepatitisa == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatimunisasi_hepatitisa == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Hepatitis B </label>
                    <div class="col-lg-6">
                    <select id="riwayatimunisasi_hepatitisb"   class="form-control js-source-states" name="riwayatimunisasi_hepatitisb" >
                        <option value="Tidak" <?php if($riwayatimunisasi_hepatitisb == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatimunisasi_hepatitisb == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                </div>
                    <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Tetanus </label>
                    <div class="col-lg-6">
                    <select id="riwayatimunisasi_tetanus"   class="form-control js-source-states" name="riwayatimunisasi_tetanus" >
                        <option value="Tidak" <?php if($riwayatimunisasi_tetanus == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatimunisasi_tetanus == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Lain-Lain</label>
                    <div class="col-lg-6">
                    <select id="riwayatimunisasi_lainlain"   class="form-control js-source-states" name="riwayatimunisasi_lainlain" onchange="changeFuncYa('riwayatimunisasi_lainlain');">
                        <option value="Tidak" <?php if($riwayatimunisasi_lainlain == 'Tidak'){echo "selected";}?>>Tidak</option>
                        <option value="Ya" <?php if($riwayatimunisasi_lainlain == 'Ya'){echo "selected";}?>>Ya</option>
				    </select>
                        <textarea <?php if($riwayatimunisasi_lainlain != 'Ya'){ echo "style='display:none;'"; } ?> name="uraianriwayatimunisasi_lainlain" id="uraianriwayatimunisasi_lainlain" placeholder="Keterangan Jika Hasil Ya" class="form-control"><?php echo (isset($uraianriwayatimunisasi_lainlain)) ? $uraianriwayatimunisasi_lainlain : ""; ?></textarea>
                    </div>
                </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12"><h5>ALAT PELINDUNG DIRI</h5></div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Topi / Helm </label>
                    <div class="col-lg-6">
                    <select id="apd_topi"   class="form-control js-source-states" name="apd_topi" >
                        <option value="Tidak" <?php if($apd_topi == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($apd_topi == 'Ya'){echo "selected";}?> >Ya</option>
                        <option value="Kadang-Kadang" <?php if($apd_topi == 'Kadang-Kadang'){echo "selected";}?> >Kadang-Kadang</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Kacamata / Goggle </label>
                    <div class="col-lg-6">
                    <select id="apd_kacamata"   class="form-control js-source-states" name="apd_kacamata" >
                        <option value="Tidak" <?php if($apd_kacamata == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($apd_kacamata == 'Ya'){echo "selected";}?> >Ya</option>
                        <option value="Kadang-Kadang" <?php if($apd_kacamata == 'Kadang-Kadang'){echo "selected";}?> >Kadang-Kadang</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Masker </label>
                    <div class="col-lg-6">
                    <select id="apd_masker"   class="form-control js-source-states" name="apd_masker" >
                        <option value="Tidak" <?php if($apd_masker == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($apd_masker == 'Ya'){echo "selected";}?> >Ya</option>
                        <option value="Kadang-Kadang" <?php if($apd_masker == 'Kadang-Kadang'){echo "selected";}?> >Kadang-Kadang</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Ear Plug </label>
                    <div class="col-lg-6">
                    <select id="apd_earplug"   class="form-control js-source-states" name="apd_earplug" >
                        <option value="Tidak" <?php if($apd_earplug == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($apd_earplug == 'Ya'){echo "selected";}?> >Ya</option>
                        <option value="Kadang-Kadang" <?php if($apd_earplug == 'Kadang-Kadang'){echo "selected";}?> >Kadang-Kadang</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Sarung Tangan </label>
                    <div class="col-lg-6">
                    <select id="apd_sarungtangan"   class="form-control js-source-states" name="apd_sarungtangan" >
                        <option value="Tidak" <?php if($apd_sarungtangan == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($apd_sarungtangan == 'Ya'){echo "selected";}?> >Ya</option>
                        <option value="Kadang-Kadang" <?php if($apd_sarungtangan == 'Kadang-Kadang'){echo "selected";}?> >Kadang-Kadang</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Apron / Celemek </label>
                    <div class="col-lg-6">
                    <select id="apd_apron"   class="form-control js-source-states" name="apd_apron" >
                        <option value="Tidak" <?php if($apd_apron == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($apd_apron == 'Ya'){echo "selected";}?> >Ya</option>
                        <option value="Kadang-Kadang" <?php if($apd_apron == 'Kadang-Kadang'){echo "selected";}?> >Kadang-Kadang</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Sepatu safety </label>
                    <div class="col-lg-6">
                    <select id="apd_sepatu"   class="form-control js-source-states" name="apd_sepatu" >
                        <option value="Tidak" <?php if($apd_sepatu == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($apd_sepatu == 'Ya'){echo "selected";}?> >Ya</option>
                        <option value="Kadang-Kadang" <?php if($apd_sepatu == 'Kadang-Kadang'){echo "selected";}?> >Kadang-Kadang</option>
				    </select>
                    </div>
                </div>
                </div>
                     <?php if($jenis_kelamin != 1){?>
                <div class="col-md-12 row">
                <div class="col-md-6">
                    <div class="col-md-12"><h5>RIWAYAT MENSTRUASI</h5></div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Menarche pertama (usia)</label>
                    <div class="col-lg-6">
                    <input type="text" id=riwayatmens_menspertama class="form-control" name="riwayatmens_menspertama" value="<?php echo (isset($riwayatmens_menspertama)) ? $riwayatmens_menspertama : ""; ?>">
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Hari pertama haid terakhir (HPHT)</label>
                    <div class="col-lg-6">
                    <input type="text" id=riwayatmens_haripertama class="form-control" name="riwayatmens_haripertama" value="<?php echo (isset($riwayatmens_haripertama)) ? $riwayatmens_haripertama : ""; ?>">
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Lama Haid</label>
                    <div class="col-lg-6">
                    <input type="text" id=riwayatmens_lamahaid class="form-control" name="riwayatmens_lamahaid" value="<?php echo (isset($riwayatmens_lamahaid)) ? $riwayatmens_lamahaid : ""; ?>">
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Siklus Haid</label>
                    <div class="col-lg-6">
                    <input type="text" id=riwayatmens_siklushaid class="form-control" name="riwayatmens_siklushaid" value="<?php echo (isset($riwayatmens_siklushaid)) ? $riwayatmens_siklushaid : ""; ?>">
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Nyeri Haid (Ya/Tidak)</label>
                    <div class="col-lg-6">
                    <select id="riwayatmens_nyerihaid"   class="form-control js-source-states" name="riwayatmens_nyerihaid" >
                        <option value="Tidak" <?php if($riwayatmens_nyerihaid == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayatmens_nyerihaid == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Banyak Haid</label>
                    <div class="col-lg-6">
                    <input type="text" id=riwayatmens_banyakhaid class="form-control" name="riwayatmens_banyakhaid" value="<?php echo (isset($riwayatmens_banyakhaid)) ? $riwayatmens_banyakhaid : ""; ?>">
                    </div>
                </div>
                 
                </div>
                   
                <div class="col-md-6">
                    <div class="col-md-12"><h5>RIWAYAT HAMIL</h5></div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Sedang Hamil ? (Ya/Tidak)</label>
                    <div class="col-lg-6">
                    <select id="riwayathamil_sedanghamil"   class="form-control js-source-states" name="riwayathamil_sedanghamil" >
                        <option value="Tidak" <?php if($riwayathamil_sedanghamil == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($riwayathamil_sedanghamil == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Melahirkan (berapa kali)</label>
                    <div class="col-lg-6">
                    <input type="text" id=riwayathamil_melahirkanberapakali class="form-control" name="riwayathamil_melahirkanberapakali" value="<?php echo (isset($riwayathamil_melahirkanberapakali)) ? $riwayathamil_melahirkanberapakali : ""; ?>">
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Keguguran (berapa kali)
                    </label>
                    <div class="col-lg-6">
                    <input type="text" id=riwayathamil_gugurberapakali class="form-control" name="riwayathamil_gugurberapakali" value="<?php echo (isset($riwayathamil_gugurberapakali)) ? $riwayathamil_gugurberapakali : ""; ?>">
                    </div>
                </div>
                    
                 
                </div>
                    
                </div>
                    <?php } ?>
                        
                   <?php if($jenis_kelamin != 1){?>
                    <div class="col-md-6">
                        <div class="col-md-12"><h5>PROGRAM KB</h5></div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Program KB </label>
                    <div class="col-lg-6">
                    <select id="programkb"   class="form-control js-source-states" name="programkb" >
                        <option value="Tidak" <?php if($programkb == 'Tidak'){echo "selected";}?> >Tidak</option>
                        <option value="Ya" <?php if($programkb == 'Ya'){echo "selected";}?> >Ya</option>
				    </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-6 control-label">Jenis KB </label>
                    <div class="col-lg-6">
                    <select id="jeniskb"   class="form-control js-source-states" name="jeniskb" >
                        <option value="" ></option>
                        <option value="IUD" <?php if($jeniskb == 'IUD'){echo "selected";}?> >IUD/Spiral</option>
                        <option value="Steril" <?php if($jeniskb == 'Steril'){echo "selected";}?> >Steril</option>
                        <option value="Suntik" <?php if($jeniskb == 'Suntik'){echo "selected";}?> >Suntik</option>
                        <option value="Kondom" <?php if($jeniskb == 'Kondom'){echo "selected";}?> >Kondom</option>
                        <option value="Pil" <?php if($jeniskb == 'Pil'){echo "selected";}?> >Pil</option>
				    </select>
                    </div>
                </div>
                </div>
                    <?php } ?>
                    <?php } ?>
                    
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
    </div>
</body>

</html>