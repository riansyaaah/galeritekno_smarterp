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
											
										</table>
									</div>
                                <div class="panel-body">    
            <a href="<?php echo base_url();?>eklinik/mcu/datapasienumum/cetaksemua/<?php echo $noregistrasi;?>" target="_blank"><button id="cetaksemua" type="button" class="btn btn-success pull-left"><i class="fa fa-check"></i> Cetak Semua</button></a>
            <a href="<?php echo base_url();?>eklinik/mcu/datapasienumum/cetakcover/<?php echo $noregistrasi;?>" target="_blank"><button id="cetakcover"  type="button" class="btn btn-warning pull-left"><i class="fa fa-check"></i> Cetak Cover</button></a>
            <a href="<?php echo base_url();?>eklinik/mcu/datapasienumum/cetakpengantar/<?php echo $noregistrasi;?>" target="_blank"><button id="cetakpengantar"  type="button" class="btn btn-warning pull-left"><i class="fa fa-check"></i> Cetak Pengantar</button></a>
            <a href="<?php echo base_url();?>eklinik/mcu/datapasienumum/cetaksertifikat/<?php echo $noregistrasi;?>" target="_blank"><button id="cetaksertifikat"  type="button" class="btn btn-danger pull-left"><i class="fa fa-check"></i> Cetak Sertifikat</button></a>
            <a href="<?php echo base_url();?>eklinik/mcu/datapasienumum/cetakresume/<?php echo $noregistrasi;?>" target="_blank"><button id="cetakresume"  type="button" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Cetak Resume</button></a>
            </div>
								</div>
							</div>
							<div class="col-md-6">
                                <div style="width:100%;">
                    <form class="form-horizontal" role="form" action="<?php echo base_url();?>eklinik/mcu/datapasienumum/updateresumehasil/<?php echo $noregistrasi;?>" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <div class="hpanel hgreen">
            <div class="panel-body">
                <h4><b>Diagnosa</b></h4>
                <table class="table">	
											<tr>
												<td >
													<select multiple name="diagnosa[]" id="diagnosa" multiple="multiple" class="form-control js-source-states-2" >
														<option value="">- Pilih Diagnosa -</option>
														<?php foreach($listdiagnosa as $p){ ?>
														<option value="<?php echo $p['id'].";".$p['saranmedis']; ?>"
															<?php foreach($getrekapdiagnosa as $zp){
																if($zp['kodediagnosa'] == $p['id']){ echo "selected"; }
															 } ?> > 
															<?php echo $p['namaindonesia']; ?>
														</option>
														<?php } ?>
													</select>
												</td>
                                                
											</tr>
										</table>
                <h4><b>Saran Medis</b></h4>
                <table class="table">	
											<tr>
												<td >
                                                    <textarea class="form-control" style="height:100px;" name="saranmedis" id="saranmedis">
                                                        <?php foreach($getrekapdiagnosa as $zp){
																echo "- ".$zp['saranmedis']."<br>";
															 } ?> 
                                                    </textarea>
												</td>
											</tr>
										</table>
                <h4><b><font size = '6'>Kesimpulan</font></b></h4>
                <table class="table">	
											<tr>
												<td style="background-color:blue">
                                                    <select id="statuskesimpulan"   class="form-control js-source-states" name="statuskesimpulan">
                        <option >-Pilih Status Kesimpulan-</option>
                        <option value="Fit To Work" <?php if($statuskesimpulan == 'Fit To Work'){echo "selected";}?> >Fit To Work</option>
                        <option value="Temporary Unfit" <?php if($statuskesimpulan == 'Temporary Unfit'){echo "selected";}?>>Temporary Unfit</option>
                        <option value="Unfit" <?php if($statuskesimpulan == 'Unfit'){echo "selected";}?>>Unfit</option>
                        <option value="Fit With Restriction" <?php if($statuskesimpulan == 'Fit With Restriction'){echo "selected";}?>>Fit With Restriction</option>
                        <option value="Fit With Note" <?php if($statuskesimpulan == 'Fit With Note'){echo "selected";}?>>Fit With Note</option>
				    </select>
												</td>
											</tr>
                </table>
                
                <h4><b>Status Kesehatan</b></h4>
                 <table id="mytablegigi" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr><th colspan="2" style="width:20%; ">KATEGORI</th>
                                                                <th style="width:80%; ">CATATAN</th></tr>
                                                        </thead>
                                                        <tbody>
                                                         
                                                            <tr <?php if($statuskesehatan == '1A'){echo 'bgcolor="#0AD7D0"';}?> >
                                                                <td width="5%">
                                                                    <input type="checkbox" id="c1a" name="c1a" value="1A" <?php if($statuskesehatan == '1A'){echo "checked";}?>>
                                                                </td>
                                                                <td width="5%">1A</td>
                                                                <td width="85%">Tidak Ditemukan Problem Kesehatan</td>
                                                            </tr>
                                                            <tr <?php if($statuskesehatan == '1B'){echo 'bgcolor="#0AD7D0"';}?> >
                                                                <td width="5%">
                                                                    <input type="checkbox" id="c1b" name="c1b" value="1B" <?php if($statuskesehatan == '1B'){echo "checked";}?>>
                                                                </td>
                                                                <td width="10%">1B</td>
                                                                <td width="85%">Ditemukan problem kesehatan yang tidak serius</td>
                                                            </tr>
                                                            <tr <?php if($statuskesehatan == '2'){echo 'bgcolor="#0AD7D0"';}?> >
                                                                <td width="5%">
                                                                    <input type="checkbox" id="c2" name="c2" value="2" <?php if($statuskesehatan == '2'){echo "checked";}?>>
                                                                </td>
                                                                <td width="10%">2</td>
                                                                <td width="85%">Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko rendah</td>
                                                            </tr>
                                                            <tr <?php if($statuskesehatan == '3A'){echo 'bgcolor="#0AD7D0"';}?> >
                                                                <td width="5%">
                                                                    <input type="checkbox" id="c3a" name="c3a" value="3A" <?php if($statuskesehatan == '3A'){echo "checked";}?>>
                                                                </td>
                                                                <td width="10%">3A</td>
                                                                <td width="85%">Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko sedang</td>
                                                            </tr>
                                                            <tr <?php if($statuskesehatan == '3B'){echo 'bgcolor="#0AD7D0"';}?> >
                                                                <td width="5%">
                                                                    <input type="checkbox" id="c3b" name="c3b" value="3B" <?php if($statuskesehatan == '3B'){echo "checked";}?>>
                                                                </td>
                                                                <td width="10%">3B</td>
                                                                <td width="85%">Ditemukan problem kesehatan yang dapat menjadi serius - Kelompok resiko tinggi</td>
                                                            </tr>
                                                            <tr <?php if($statuskesehatan == '4'){echo 'bgcolor="#0AD7D0"';}?> >
                                                                <td width="5%">
                                                                    <input type="checkbox" id="c4" name="c4" value="4" <?php if($statuskesehatan == '4'){echo "checked";}?>>
                                                                </td>
                                                                <td width="10%">4</td>
                                                                <td width="85%">Ditemukan keterbatasan fisik untuk melakukan perkerjaan secara normal, hanya cocok untuk pekerjaan ringan</td>
                                                            </tr>
                                                            <tr <?php if($statuskesehatan == '5'){echo 'bgcolor="#0AD7D0"';}?> >
                                                                <td width="5%">
                                                                    <input type="checkbox" id="c5" name="c5" value="5" <?php if($statuskesehatan == '5'){echo "checked";}?>>
                                                                </td>
                                                                <td width="10%">5</td>
                                                                <td width="85%">Dalam perawatan di rumah sakit atau dalam kondisi yang tidak memungkinkan untuk melakukan pekerjaan (status ijin sakit)</td>
                                                            </tr>
                                                            
                                                        </tbody>

                                                        </table>
                <table>
                    
                                        <tr>
												<td>Pengiriman Hasil</td>
												<td>:</td>
												<td><select multiple="multiple" class="form-control js-source-states-2"  id="pengirimanhasil" name="pengirimanhasil[]" required>
                                        <option 
                                                <?php 
																if($pengirimanhasil != ""){		
																$arr = explode(";", $pengirimanhasil);
																	for($i=0; $i<=1; $i++){
																		if("Di Antar" == $arr[$i]){echo "selected";}
																	}
																}
															?> 
                                                
                                                value="Di Antar">Di Antar</option>
                                                    <option 
                                                <?php 
																if($pengirimanhasil != ""){		
																$arr = explode(";", $pengirimanhasil);
																	for($i=0; $i<=1; $i++){
																		if("Email" == $arr[$i]){echo "selected";}
																	}
																}
															?> 
                                                
                                                value="Email">Email</option>
                                               
								</select></td>
											</tr>
                                            <tr>
												<td>Tanggal Kembali</td>
												<td>:</td>
												<td>
                                                    <select class="form-control"  id="tanggalkembali" name="tanggalkembali" onchange="changeFunc('tanggalkembali');" required>
                                                    <option value="-" <?php if($tanggalkembali == '-'){ echo "selected"; }?>>-</option>
                                                    <option value="6 Bulan" <?php if($tanggalkembali == '-'){ echo "selected"; }?>>6 Bulan</option>
                                                    <option value="1 Tahun" <?php if($tanggalkembali == '1 Tahun'){ echo "selected"; }?>>1 Tahun</option>
                                                    <option value="Custom" <?php if($tanggalkembali == 'Custom'){ echo "selected"; }?>>Pilih Tanggal</option>
                                                    </select>
                                                </td>
											</tr>
                                            
                                            <tr <?php if($tanggalkembali != 'Custom'){ echo "style='display:none;'"; } ?> id="uraiantanggalkembali">
												<td></td>
												<td></td>
												<td>
                                                    <input type="hidden" name="tanggalperiksa" value="<?php echo date('Y-m-d'); ?>" class="form-control" >
                                                    <input type="date" name="uraiantanggalkembali" value="<?php echo $uraiantanggalkembali; ?>" class="form-control" >
                                                </td>
											</tr>
                    <tr>
												<td>
                                                    <button id="button"  type="submit" class="btn btn-primary pull-left"><i class="fa fa-check"></i> Update Hasil</button>
												</td>
											</tr>
										</table>
            </div>
                    </div>
                    </form>
                </div>
					</div>
				</div>

			</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="row">
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Resume Hasil Pemeriksaan MCU</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="resumehasil-tab3" data-toggle="tab" href="#resumehasil" role="tab"
                          aria-controls="resumehasil" aria-selected="true">Resume Hasil</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="hasilfisik-tab3" data-toggle="tab" href="#hasilfisik" role="tab"
                          aria-controls="hasilfisik" aria-selected="false">Hasil Fisik</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="hasillaboratorium-tab3" data-toggle="tab" href="#hasillaboratorium" role="tab"
                          aria-controls="hasillaboratorium" aria-selected="false">Hasil Laboratorium</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" id="hasilelektromedis-tab3" data-toggle="tab" href="#hasilelektromedis" role="tab"
                          aria-controls="hasilelektromedis" aria-selected="false">Hasil Elektromedis</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" id="hasilradiologi-tab3" data-toggle="tab" href="#hasilradiologi" role="tab"
                          aria-controls="hasilradiologi" aria-selected="false">Hasil Radiologi</a>
                      </li>
                        
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                      <div class="tab-pane fade show active" id="resumehasil" role="tabpanel" aria-labelledby="resumehasil-tab3">
                       <div style="width:100%;">
                <div style="width:100%; text-align:center;">
                    <b><u>RESUME HASIL PEMERIKSAAN</u></b><br>
                </div>
                
                <div style="width:100%;">
                    <div class="hpanel hgreen">
            <div class="panel-body">
                
                <h4><b>Pemeriksaan Fisik</b></h4>
                <div style="width:100%;">
                    <b>Tanda Vital</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Nadi</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $nadi;?> x/Menit</td>
                                <td valign="top"><?php echo $uraiannadi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Pernafasan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $pernafasan;?> x/Menit</td>
                                <td valign="top"><?php echo $uraianpernafasan;?> </td>
                            </tr>
                            <tr>
                                <td valign="top">Tekanan Darah</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $sistole.'/'.$diastole;?></td>
                                <td valign="top"><?php echo $uraiantekanandarah;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Suhu Badan</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $suhubadan;?> °C</td>
                                <td valign="top"><?php echo $uraiansuhubadan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">IMT</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $imt;?></td>
                                <td valign="top"><?php echo $uraianimt;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lingkar Perut</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $lingkarperut;?> Cm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width:25%;" valign="top">Tinggi Badan</td>
                                <td style="width:2%;" valign="top">:</td>
                                <td valign="top"><?php echo $tinggibadan;?> Cm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Berat Badan</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $beratbadan;?> Kg</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Bentuk Badan</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $bentukbadan;?></td>
                                <td></td>
                            </tr>
                            
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>TINGKAT KESADARAN (METODE GCS)</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">MATA</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $tingkatkesadaran_mata;?></td>
                            </tr>
                            <tr>
                                <td valign="top">VERBAL</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $tingkatkesadaran_verbal;?></td>
                            </tr>
                            <tr>
                                <td valign="top">MOTORIK</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $tingkatkesadaran_motorik;?></td>
                            </tr>
                            <tr>
                                <td valign="top">HASIL</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $uraiantingkatkesadaran;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php if($kulitdankuku_kulit != 'Normal' or $kulitdankuku_selaputlendir != 'Normal' or $kulitdankuku_kuku != 'Normal' or $kulitdankuku_kontraktur != 'Baik' or $kulitdankuku_bekasoperasi != 'Tidak Ada' or $kulitdankuku_lainlain != 'Normal') {?>
                <div style="width:100%;">
                    <b>KULIT DAN KUKU</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <?php if($kulitdankuku_kulit != 'Normal'){?>
                            <tr>
                                <td style="width:25%;" valign="top">Kulit</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $kulitdankuku_kulit;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_kulit;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kulitdankuku_selaputlendir != 'Normal'){?>
                            <tr>
                                <td valign="top">Selaput Lendir</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kulitdankuku_selaputlendir;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_selaputlendir;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kulitdankuku_kuku != 'Normal'){?>
                            <tr>
                                <td valign="top">Kuku</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kulitdankuku_kuku;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_kuku;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kulitdankuku_kontraktur != 'Baik'){?>
                            <tr>
                                <td valign="top">Kontraktur</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $kulitdankuku_kontraktur;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_kontraktur;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kulitdankuku_bekasoperasi != 'Tidak Ada'){?>
                            <tr>
                                <td valign="top">Bekas Operasi</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $kulitdankuku_bekasoperasi;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($kulitdankuku_lainlain != 'Normal'){?>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $kulitdankuku_lainlain;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_lainlain;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($kepala_tulang != 'Normal' or $kepala_kulitkepala != 'Normal' or $kepala_rambut != 'Normal' or $kepala_lainlain != 'Normal') {?>
                <div style="width:100%;">
                    <b>KEPALA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           <?php if($kepala_tulang != 'Normal') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Tulang</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $kepala_tulang;?></td>
                                <td valign="top"><?php echo $uraiankepala_tulang;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kepala_kulitkepala != 'Normal') { ?>
                            <tr>
                                <td valign="top">Kulit Kepala</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kepala_kulitkepala;?></td>
                                <td valign="top"><?php echo $uraiankepala_kulitkepala;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kepala_rambut != 'Normal') { ?>
                            <tr>
                                <td valign="top">Rambut</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kepala_rambut;?></td>
                                <td valign="top"><?php echo $uraiankepala_rambut;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kepala_lainlain != 'Normal') { ?>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $kepala_lainlain;?></td>
                                <td valign="top"><?php echo $uraiankepala_lainlain;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($mata_pemeriksaandilakukan != '' or $penggunaankacamata != '' or $mata_od != '' or $mata_os != '' or $mata_ods != '' or $mata_oss != '' or $mata_visus != 'Normal' or $mata_butawarna != 'Tidak' or $mata_kelainanmatalainnya != 'Tidak' or $mata_lapangpandang != 'Normal') {?>
                <div style="width:100%;">
                    <b>MATA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($mata_pemeriksaandilakukan != '') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Pemeriksaan Dilakukan</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $mata_pemeriksaandilakukan;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($penggunaankacamata != '') { ?>
                            <tr>
                                <td valign="top">Penggunaan Kacamata</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $penggunaankacamata;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($mata_od != '' or $mata_ods != '') { ?>
                            <tr>
                                <td valign="top">OD</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $mata_od.'/'.$mata_ods;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($mata_os != '' or $mata_oss != '') { ?>
                            <tr>
                                <td valign="top">OS</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $mata_os.'/'.$mata_oss;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($mata_visus != 'Normal') { ?>
                            <tr>
                                <td valign="top">Visus</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $mata_visus;?></td>
                                <td valign="top"><?php echo $uraianmata_visus;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($mata_butawarna != 'Tidak') { ?>
                            <tr>
                                <td valign="top">Buta Warna</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $mata_butawarna;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($mata_kelainanmatalainnya != 'Tidak') { ?>
                            <tr>
                                <td valign="top">Kelainan Mata Lainnya</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $mata_kelainanmatalainnya;?></td>
                                <td valign="top"><?php echo $uraianmata_kelainanmatalainnya;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($mata_lapangpandang != 'Normal') { ?>
                            <tr>
                                <td valign="top">Lapang Pandang</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $mata_lapangpandang;?></td>
                                <td valign="top"><?php echo $uraianmata_lapangpandang;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($telinga_dauntelingkanan != 'Normal' or $telinga_dauntelingkiri != 'Normal' or $telinga_liangtelingakanan != 'Normal' or $telinga_liangtelingakiri != 'Normal' or $telinga_serumenkanan != 'Tidak Ada' or $telinga_membranatimfanikanan != 'Intak' or $telinga_membranatimfanikiri != 'Intak' or $telinga_kesanpendengaran != 'Normal' or $telinga_lainlain != '') {?>
                <div style="width:100%;">
                    <b>TELINGA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($telinga_dauntelingkanan != 'Normal') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Daun Telinga Kanan</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $telinga_dauntelingkanan;?></td>
                                <td valign="top"><?php echo $uraiantelinga_dauntelingkanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($telinga_dauntelingkiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Daun Telinga Kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $telinga_dauntelingkiri;?></td>
                                <td valign="top"><?php echo $uraiantelinga_dauntelingkiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($telinga_liangtelingakanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Liang Telinga Kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $telinga_liangtelingakanan;?></td>
                                <td valign="top"><?php echo $uraiantelinga_liangtelingakanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($telinga_liangtelingakiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Liang Telinga Kiri</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_liangtelingakiri;?></td>
                                <td valign="top"><?php echo $uraiantelinga_liangtelingakiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($telinga_serumenkanan != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Serumen</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_serumenkanan;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($telinga_membranatimfanikanan != 'Intak') { ?>
                            <tr>
                                <td valign="top">Membrana Timfani Kanan</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_membranatimfanikanan;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($telinga_membranatimfanikiri != 'Intak') { ?>
                            <tr>
                                <td valign="top">Membrana Tifani Kiri</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_membranatimfanikiri;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($telinga_kesanpendengaran != 'Normal') { ?>
                            <tr>
                                <td valign="top">Kesan Pendengaran</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_kesanpendengaran;?></td>
                                <td valign="top"><?php echo $uraiantelinga_kesanpendengaran;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($telinga_lainlain != '') { ?>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_lainlain;?></td>
                                <td valign="top"><?php echo $uraiantelinga_lainlain;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($hidung_meatusnasi != 'Normal' or $hidung_septumnasi != 'Normal' or $hidung_konkanasal != 'Normal' or $hidung_nyeriketoksinusmaksilaris != 'Normal' or $hidung_lainlain != 'Normal') {?>
                <div style="width:100%;">
                    <b>HIDUNG</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($hidung_meatusnasi != 'Normal') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Meatus Nasi</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $hidung_meatusnasi;?></td>
                                <td valign="top"><?php echo $uraianhidung_meatusnasi;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($hidung_septumnasi != 'Normal') { ?>
                            <tr>
                                <td valign="top">Septum Nasi</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $hidung_septumnasi;?></td>
                                <td valign="top"><?php echo $uraianhidung_septumnasi;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($hidung_konkanasal != 'Normal') { ?>
                            <tr>
                                <td valign="top">Konka Nasal</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $hidung_konkanasal;?></td>
                                <td valign="top"><?php echo $uraianhidung_konkanasal;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($hidung_nyeriketoksinusmaksilaris != 'Normal') { ?>
                            <tr>
                                <td valign="top">Nyeri ketok sinus maksilaris</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $hidung_nyeriketoksinusmaksilaris;?></td>
                                <td valign="top"><?php echo $uraianhidung_nyeriketoksinusmaksilaris;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($hidung_lainlain != 'Normal') { ?>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $hidung_lainlain;?></td>
                                <td valign="top"><?php echo $uraianhidung_lainlain;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($tenggorokan_pharynx != 'Normal' or $tenggorokan_tonsil != 'Normal' or  $tenggorokan_palatum != 'Normal' or $kepala_kulitkepala != 'Normal') {?>
                <div style="width:100%;">
                    <b>TENGGOROKAN</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($tenggorokan_pharynx != 'Normal') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Pharynx</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $tenggorokan_pharynx;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_pharynx;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($tenggorokan_tonsil != 'Normal') { ?>
                            <tr>
                                <td valign="top">Tonsil</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $tenggorokan_tonsil;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_tonsil;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($tenggorokan_tonsil != 'Normal') { ?>
                            <tr>
                                <td valign="top">Ukuran Kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $tenggorokan_ukurankanan;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($tenggorokan_tonsil != 'Normal') { ?>
                            <tr>
                                <td valign="top">Ukuran Kiri</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $tenggorokan_ukurankiri;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($tenggorokan_palatum != 'Normal') { ?>
                            <tr>
                                <td valign="top">Palatum</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $tenggorokan_palatum;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_palatum;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kepala_kulitkepala != 'Normal') { ?>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $tenggorokan_lainlain;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_lainlain;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($mulut_oralhygiene != 'Baik' or $mulut_gusi != 'Baik') {?>
                <div style="width:100%;">
                    <b>MULUT</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($mulut_oralhygiene != 'Baik') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Oral Hygiene</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $mulut_oralhygiene;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($mulut_gusi != 'Baik') { ?>
                            <tr>
                                <td valign="top">Gusi</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $mulut_gusi;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($gigi != 'Normal') {?>
                <div style="width:100%;">
                    <b>GIGI</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($gigi != 'Normal') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Hasil</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $gigi;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($gigi != 'Normal') { ?>
                            <tr>
                                <td valign="top">Temuan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php foreach($temuangigi as $g){echo $g['temuan'].'('.$g['kanankiri'].' '.$g['atasbawah'].' '.$g['urutan'].')',', ';}?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($leher_gerakanleher != 'Normal' or $leher_kelenjarthyroid != 'Normal' or $leher_pulsasi != 'Normal' or $leher_tekananvenajugularis != 'Normal' or $leher_trachea != 'Normal' or $leher_lainlain != 'Normal') {?>
                <div style="width:100%;">
                    <b>LEHER</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($leher_gerakanleher != 'Normal') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Gerakan leher</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $leher_gerakanleher;?></td>
                                <td valign="top"><?php echo $uraianleher_gerakanleher;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($leher_kelenjarthyroid != 'Normal') { ?>
                            <tr>
                                <td valign="top">Kelenjar thyroid</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $leher_kelenjarthyroid;?></td>
                                <td valign="top"><?php echo $uraianleher_kelenjarthyroid;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($leher_pulsasi != 'Normal') { ?>
                            <tr>
                                <td valign="top">Pulsasi carotis</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $leher_pulsasi;?></td>
                                <td valign="top"><?php echo $uraianleher_pulsasi;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($leher_tekananvenajugularis != 'Normal') { ?>
                            <tr>
                                <td valign="top">Tekanan vena jugularis</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $leher_tekananvenajugularis;?></td>
                                <td valign="top"><?php echo $uraianleher_tekananvenajugularis;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($leher_trachea != 'Normal') { ?>
                            <tr>
                                <td valign="top">Trachea</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $leher_trachea;?></td>
                                <td valign="top"><?php echo $uraianleher_trachea;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($leher_lainlain != 'Normal') { ?>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $leher_lainlain;?></td>
                                <td valign="top"><?php echo $uraianleher_lainlain;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($dada_bentuk != 'Normal Chest' or $dada_mammae != 'Normal' or $dada_lainlain != 'Normal') {?>
                <div style="width:100%;">
                    <b>DADA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($dada_bentuk != 'Normal Chest') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Bentuk</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $dada_bentuk;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($dada_mammae != 'Normal') { ?>
                            <tr>
                                <td valign="top">Mammae</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $dada_mammae;?></td>
                                <td valign="top"><?php echo $uraiandada_mammae;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($dada_lainlain != 'Normal') { ?>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $dada_lainlain;?></td>
                                <td valign="top"><?php echo $uraiandada_lainlain;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($paruparudanjatung_palpasi != 'Normal' or $paruparudanjatung_perkusikanan != 'Normal' or $paruparudanjatung_perkusikiri != 'Normal' or $paruparudanjatung_iktuskordis != 'Normal' or $paruparudanjatung_batasjantung != 'Normal' or $paruparudanjatung_bunyinapas != 'Normal' or $paruparudanjatung_tambahan != 'Tidak Ada' or $paruparudanjatung_bunyijantung != 'Normal') {?>
                <div style="width:100%;">
                    <b>PARU2 DAN JANTUNG</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($paruparudanjatung_palpasi != 'Normal') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Palpasi</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_palpasi;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_palpasi;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($paruparudanjatung_perkusikanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Perkusi kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_perkusikanan;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_perkusikanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($paruparudanjatung_perkusikiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Perkusi kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_perkusikiri;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_perkusikiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($paruparudanjatung_iktuskordis != 'Normal') { ?>
                            <tr>
                                <td valign="top">Iktus kordis</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_iktuskordis;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_iktuskordis;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($paruparudanjatung_batasjantung != 'Normal') { ?>
                            <tr>
                                <td valign="top">Batas jantung</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_batasjantung;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_batasjantung;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($paruparudanjatung_bunyinapas != 'Normal') { ?>
                            <tr>
                                <td valign="top">Bunyi napas</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_bunyinapas;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_bunyinapas;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($paruparudanjatung_tambahan != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Bunyi napas tambahan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_tambahan;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($paruparudanjatung_bunyijantung != 'Normal') { ?>
                            <tr>
                                <td valign="top">Bunyi jantung</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_bunyijantung;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_bunyijantung;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($abdomen_inspeksi != 'Normal' or $abdomen_perkusi != 'Normal' or $abdomen_auskultasibisingusus != 'Normal' or $abdomen_hati != 'Normal' or $abdomen_limpa != 'Normal' or $abdomen_nyeritekan != 'Tidak' or $abdomen_nyeriketokkanan != 'Normal' or $abdomen_nyeriketokkiri != 'Normal' or $abdomen_ballotementkanan != 'Normal' or $abdomen_ballotementkiri != 'Normal' or $abdomen_kandungkemih != 'Tidak Ada' or $abdomen_anus != 'Normal' or $abdomen_genitaliaeks != 'Normal' or $abdomen_prostat != 'Normal' or $abdomen_lainlain != 'Normal') {?>
                <div style="width:100%;">
                    <b>ABDOMEN</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($abdomen_inspeksi != 'Normal') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Inspeksi</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_inspeksi;?></td>
                                <td valign="top"><?php echo $uraianabdomen_inspeksi;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_perkusi != 'Normal') { ?>
                            <tr>
                                <td valign="top">Perkusi</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_perkusi;?></td>
                                <td valign="top"><?php echo $uraianabdomen_perkusi;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_auskultasibisingusus != 'Normal') { ?>
                            <tr>
                                <td valign="top">Auskultasi bising usus</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_auskultasibisingusus;?></td>
                                <td valign="top"><?php echo $uraianabdomen_auskultasibisingusus;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_hati != 'Normal') { ?>
                            <tr>
                                <td valign="top">Hati</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_hati;?></td>
                                <td valign="top"><?php echo $uraianabdomen_hati;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_limpa != 'Normal') { ?>
                            <tr>
                                <td valign="top">Limpa</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_limpa;?></td>
                                <td valign="top"><?php echo $uraianabdomen_limpa;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_nyeritekan != 'Tidak') { ?>
                            <tr>
                                <td valign="top">Nyeri tekan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_nyeritekan;?></td>
                                <td valign="top"><?php echo $uraianabdomen_nyeritekan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_nyeriketokkanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Nyeri ketok kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_nyeriketokkanan;?></td>
                                <td valign="top"><?php echo $uraianabdomen_nyeriketokkanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_nyeriketokkiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Nyeri ketok Kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_nyeriketokkiri;?></td>
                                <td valign="top"><?php echo $uraianabdomen_nyeriketokkiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_ballotementkanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Ballotement kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_ballotementkanan;?></td>
                                <td valign="top"><?php echo $uraianabdomen_ballotementkanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_ballotementkiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Ballotement kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_ballotementkiri;?></td>
                                <td valign="top"><?php echo $uraianabdomen_ballotementkiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_kandungkemih != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Kandung kemih</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_kandungkemih;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_anus != 'Normal') { ?>
                            <tr>
                                <td valign="top">Anus/rektum/perianal</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_anus;?>
                                </td>
                                <td valign="top"><?php echo $uraianabdomen_anus;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_genitaliaeks != 'Normal') { ?>
                            <tr>
                                <td valign="top">Genitalia eks</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_genitaliaeks;?></td>
                                <td valign="top"><?php echo $uraianabdomen_genitaliaeks;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_prostat != 'Normal') { ?>
                            <tr>
                                <td valign="top">Prostat</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_prostat;?></td>
                                <td valign="top"><?php echo $uraianabdomen_prostat;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($abdomen_lainlain != 'Normal') { ?>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_lainlain;?></td>
                                <td valign="top"><?php echo $uraianabdomen_lainlain;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($vertebra != 'Normal') {?>
                <div style="width:100%;">
                    <b>VERTEBRA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($vertebra != 'Normal') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Hasil</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $vertebra;?></td>
                                <td valign="top"><?php echo $uraianvertebra;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($extremitasatas_simetris != 'Ya' or $extremitasatas_gerakankanan != 'Normal' or $extremitasatas_gerakankiri != 'Normal' or $extremitasatas_kekuatankanan != 'Normal' or $extremitasatas_kekuatankiri != 'Normal' or $extremitasatas_tulangkanan != 'Normal' or $extremitasatas_tulangkiri != 'Normal' or $extremitasatas_sensibilitaskanan != 'Baik' or $extremitasatas_sensibilitaskiri != 'Baik' or $extremitasatas_oedemakanan != 'Tidak Ada' or $extremitasatas_oedemakiri != 'Tidak Ada' or $extremitasatas_tremorkanan != 'Tidak Ada' or $extremitasatas_tremorkiri != 'Tidak Ada' or $extremitasatas_lainlain != 'Baik') {?>
                <div style="width:100%;">
                    <b>EXTREMITAS ATAS</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($extremitasatas_simetris != 'Ya') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Simetris</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_simetris;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_simetris;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_gerakankanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Gerakan kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_gerakankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_gerakankanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_gerakankiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Gerakan kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_gerakankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_gerakankiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_kekuatankanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Kekuatan kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_kekuatankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_kekuatankanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_kekuatankiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Kekuatan kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_kekuatankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_kekuatankiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_tulangkanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Tulang kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_tulangkanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_tulangkanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_tulangkiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Tulang kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_tulangkiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_tulangkiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_sensibilitaskanan != 'Baik') { ?>
                            <tr>
                                <td valign="top">Sensibilitas kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_sensibilitaskanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_sensibilitaskanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_sensibilitaskiri != 'Baik') { ?>
                            <tr>
                                <td valign="top">Sensibilitas kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_sensibilitaskiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_sensibilitaskiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_oedemakanan != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Oedema kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_oedemakanan;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_oedemakiri != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Oedema kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_oedemakiri;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_tremorkanan != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Tremor kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_tremorkanan;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_tremorkiri != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Tremor kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_tremorkiri;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasatas_lainlain != 'Baik') { ?>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_lainlain;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_lainlain;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($extremitasbawah_simetris != 'Ya' or $extremitasbawah_gerakankanan != 'Normal' or $extremitasbawah_gerakankiri != 'Normal' or $extremitasbawah_kekuatankanan != 'Normal' or $extremitasbawah_kekuatankiri != 'Normal' or $extremitasbawah_tulangkanan != 'Normal' or $extremitasbawah_tulangkiri != 'Normal' or $extremitasbawah_sensibilitaskanan != 'Baik' or $extremitasbawah_sensibilitaskiri != 'Baik' or $extremitasbawah_oedemakanan != 'Tidak Ada' or $extremitasbawah_oedemakiri != 'Tidak Ada' or $extremitasbawah_tremorkanan != 'Tidak Ada' or $extremitasbawah_tremorkiri != 'Tidak Ada' or $extremitasbawah_variseskanan != 'Tidak Ada' or $extremitasbawah_variseskiri != 'Tidak Ada' or $extremitasbawah_lainlain != 'Baik') {?>
                <div style="width:100%;">
                    <b>EXTREMITAS BAWAH</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($extremitasbawah_simetris != 'Ya') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Simetris</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_simetris;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_simetris;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_gerakankanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Gerakan kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_gerakankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_gerakankanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_gerakankiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Gerakan kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_gerakankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_gerakankiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_kekuatankanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Kekuatan kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_kekuatankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_kekuatankanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_kekuatankiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Kekuatan kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_kekuatankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_kekuatankiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_tulangkanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Tulang kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_tulangkanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_tulangkanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_tulangkiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Tulang kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_tulangkiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_tulangkiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_sensibilitaskanan != 'Baik') { ?>
                            <tr>
                                <td valign="top">Sensibilitas kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_sensibilitaskanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_sensibilitaskanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_sensibilitaskiri != 'Baik') { ?>
                            <tr>
                                <td valign="top">Sensibilitas kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_sensibilitaskiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_sensibilitaskiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_oedemakanan != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Oedema kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_oedemakanan;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_oedemakiri != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Oedema kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_oedemakiri;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_tremorkanan != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Tremor kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_tremorkanan;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_tremorkiri != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Tremor kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_tremorkiri;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_variseskanan != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Varises kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_variseskanan;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_variseskiri != 'Tidak Ada') { ?>
                            <tr>
                                <td valign="top">Varises kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_variseskiri;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($extremitasbawah_lainlain != 'Baik') { ?>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_lainlain;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_lainlain;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($saraffungsiluhur_dayaingat != 'Baik' or $saraffungsiluhur_orientasiwaktu != 'Baik' or $saraffungsiluhur_orientasiorang != 'Baik' or $saraffungsiluhur_orientasitempat != 'Baik' or $saraffungsiluhur_sikap != 'Normal' or $saraffungsiluhur_kesansarafotak != 'Baik') {?>
                <div style="width:100%;">
                    <b>SARAF/FUNGSI LUHUR</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($saraffungsiluhur_dayaingat != 'Baik') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Daya ingat</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_dayaingat;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($saraffungsiluhur_orientasiwaktu != 'Baik') { ?>
                            <tr>
                                <td valign="top">Orientasi : waktu</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_orientasiwaktu;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_orientasiwaktu;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($saraffungsiluhur_orientasiorang != 'Baik') { ?>
                            <tr>
                                <td valign="top">Orientasi : orang</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_orientasiorang;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_orientasiorang;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($saraffungsiluhur_orientasitempat != 'Baik') { ?>
                            <tr>
                                <td valign="top">Orientasi : tempat</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_orientasitempat;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_orientasitempat;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($saraffungsiluhur_sikap != 'Normal') { ?>
                            <tr>
                                <td valign="top">Sikap</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_sikap;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($saraffungsiluhur_kesansarafotak != 'Baik') { ?>
                            <tr>
                                <td valign="top">Kesan saraf otak</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_kesansarafotak;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_kesansarafotak;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($kesansarafotak_fungsisensorikkanan != 'Normal' or $kesansarafotak_fungsisensorikkiri != 'Normal' or $kesansarafotak_fungsiotonomkanan != 'Normal' or $kesansarafotak_fungsiotonomkiri != 'Normal' or $kesansarafotak_fungsivaskularkanan != 'Normal' or $kesansarafotak_fungsivaskularkiri != 'Normal' or $kesansarafotak_gerakanabnormalkanan != 'Tidak' or $kesansarafotak_gerakanabnormalkiri != 'Tidak' or $kesansarafotak_reflfisiologispatelakanan != 'Normal' or $kesansarafotak_reflpatologisbabinskykanan != 'Normal' or $kesansarafotak_reflpatologisbabinskykiri != 'Normal') {?>
                <div style="width:100%;">
                    <b>KESAN SARAF OTAK</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($kesansarafotak_fungsisensorikkanan != 'Normal') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Fungsi sensorik kanan</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsisensorikkanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsisensorikkanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kesansarafotak_fungsisensorikkiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Fungsi sensorik kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsisensorikkiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsisensorikkiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kesansarafotak_fungsiotonomkanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Fungsi otonom kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsiotonomkanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsiotonomkanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kesansarafotak_fungsiotonomkiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Fungsi otonom kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsiotonomkiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsiotonomkiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kesansarafotak_fungsivaskularkanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Fungsi vaskular kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsivaskularkanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsivaskularkanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kesansarafotak_fungsivaskularkiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Fungsi vaskular kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsivaskularkiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsivaskularkiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kesansarafotak_gerakanabnormalkanan != 'Tidak') { ?>
                            <tr>
                                <td valign="top">Gerakan abnormal kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_gerakanabnormalkanan;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($kesansarafotak_gerakanabnormalkiri != 'Tidak') { ?>
                            <tr>
                                <td valign="top">Gerakan abnormal kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_gerakanabnormalkiri;?></td>
                                <td></td>
                            </tr>
                            <?php } ?>
                            <?php if($kesansarafotak_reflfisiologispatelakanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Refl fisiologis patela kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_reflfisiologispatelakanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflfisiologispatelakanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kepala_kulitkepala != 'Normal') { ?>
                            <tr>
                                <td valign="top">Refl fisiologis patela kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_reflfisiologispatelakiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflfisiologispatelakiri;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kesansarafotak_reflpatologisbabinskykanan != 'Normal') { ?>
                            <tr>
                                <td valign="top">Refl patologis babinsky kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_reflpatologisbabinskykanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflpatologisbabinskykanan;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kesansarafotak_reflpatologisbabinskykiri != 'Normal') { ?>
                            <tr>
                                <td valign="top">Refl patologis babinsky kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_reflpatologisbabinskykiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflpatologisbabinskykiri;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
                <?php if($kelenjargetahbening_leher != 'Normal' or $kelenjargetahbening_submandibula != 'Normal' or $kelenjargetahbening_ketiak != 'Normal' or $kelenjargetahbening_inguinal != 'Normal' ) {?>
                <div style="width:100%;">
                    <b>KELENJAR GETAH BENING</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <?php if($kelenjargetahbening_leher != 'Normal') { ?>
                            <tr>
                                <td style="width:25%;" valign="top">Leher</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $kelenjargetahbening_leher;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_leher;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kelenjargetahbening_submandibula != 'Normal') { ?>
                            <tr>
                                <td valign="top">Submandibula</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kelenjargetahbening_submandibula;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_submandibula;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kelenjargetahbening_ketiak != 'Normal') { ?>
                            <tr>
                                <td valign="top">Ketiak</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kelenjargetahbening_ketiak;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_ketiak;?></td>
                            </tr>
                            <?php } ?>
                            <?php if($kelenjargetahbening_inguinal != 'Normal') { ?>
                            <tr>
                                <td valign="top">Inguinal</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kelenjargetahbening_inguinal;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_inguinal;?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
                    </div>
                    
                </div>
                <br>
                <div style="width:100%;">
                    <div class="hpanel hgreen">
            <div class="panel-body">
                <h4><b>Pemeriksaan Lab</b></h4>
                <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                    <?php $no = 1; foreach($getlababnormal as $g){?>
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
                       }    ?>
                    <?php if($g['keterangan'] != NULL and $g['keterangan'] != 'Normal'){?>
                            <tr>
                                <td style="width:25%;" valign="top"><?php echo $g['nama_item'];?></td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php if (is_numeric($g['hasil']))
                        { echo number_format($g['hasil'],2);}else{echo trim($g['hasil']);}?></td>
                                <td valign="top">Nilai Rujukan : <?php echo $uraian ;?></td>
                                <td valign="top"><?php echo $g['keterangan'];?></td>
                            </tr>
                    <?php } ?>
                            <?php $no++ ;}?> 
                        </table>
                
            </div>
                    </div>
                    
                </div>
                <br>
                <div style="width:100%;">
                    <div class="hpanel hgreen">
            <div class="panel-body">
                <h4><b>Pemeriksaan Elektromedis</b></h4>
                
                                            <?php if($ekg == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>EKG</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasilekg;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosaekg;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                                            <?php if($treadmill == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>TREADMILL</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasiltreadmill;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosatreadmill;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                                            <?php if($spirometri == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>SPIROMETRI</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasilspirometri;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosaspirometri;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                                            <?php if($audiometri == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>AUDIOMETRI</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasilaudiometri;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosaaudiometri;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                
                
                
            </div>
                    </div>
                    
                </div>
                <br>
                <div style="width:100%;">
                    <div class="hpanel hgreen">
            <div class="panel-body">
                <h4><b>Pemeriksaan Radiologi</b></h4>
                <?php if($radiologi == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>THORAX PA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasilradiologi;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosaradiologi;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                <?php if($usg == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>USG ABDOMEN</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasilusg;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosausg;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                
                
            </div>
                    </div>
                    
                </div>
               
            </div>
                      </div>
                      <div class="tab-pane fade" id="hasilfisik" role="tabpanel" aria-labelledby="hasilfisik-tab3">
                        <div style="width:100%;">
                    <div class="hpanel hgreen">
                        <div class="panel-body">
                
                <h4><b>Hasil Pemeriksaan Fisik</b></h4>
                <div style="width:100%;">
                    <b>Tanda Vital</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Nadi</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $nadi;?> x/Menit</td>
                                <td valign="top"><?php echo $uraiannadi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Pernafasan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $pernafasan;?> x/Menit</td>
                                <td valign="top"><?php echo $uraianpernafasan;?> </td>
                            </tr>
                            <tr>
                                <td valign="top">Tekanan Darah</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $sistole.'/'.$diastole;?></td>
                                <td valign="top"><?php echo $uraiantekanandarah;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Suhu Badan</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $suhubadan;?> C</td>
                                <td valign="top"><?php echo $uraiansuhubadan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">IMT</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $imt;?></td>
                                <td valign="top"><?php echo $uraianimt;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lingkar Perut</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $lingkarperut;?> Cm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width:25%;" valign="top">Tinggi Badan</td>
                                <td style="width:2%;" valign="top">:</td>
                                <td valign="top"><?php echo $tinggibadan;?> Cm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Berat Badan</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $beratbadan;?> Kg</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Bentuk Badan</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $bentukbadan;?></td>
                                <td></td>
                            </tr>
                            
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>TINGKAT KESADARAN (METODE GCS)</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">MATA</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $tingkatkesadaran_mata;?></td>
                            </tr>
                            <tr>
                                <td valign="top">VERBAL</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $tingkatkesadaran_verbal;?></td>
                            </tr>
                            <tr>
                                <td valign="top">MOTORIK</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $tingkatkesadaran_motorik;?></td>
                            </tr>
                            <tr>
                                <td valign="top">HASIL</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $uraiantingkatkesadaran;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>KULIT DAN KUKU</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Kulit</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $kulitdankuku_kulit;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_kulit;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Selaput Lendir</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kulitdankuku_selaputlendir;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_selaputlendir;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kuku</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kulitdankuku_kuku;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_kuku;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kontraktur</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $kulitdankuku_kontraktur;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_kontraktur;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Bekas Operasi</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $kulitdankuku_bekasoperasi;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $kulitdankuku_lainlain;?></td>
                                <td valign="top"><?php echo $uraiankulitdankuku_lainlain;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>KEPALA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Tulang</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $kepala_tulang;?></td>
                                <td valign="top"><?php echo $uraiankepala_tulang;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kulit Kepala</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kepala_kulitkepala;?></td>
                                <td valign="top"><?php echo $uraiankepala_kulitkepala;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Rambut</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kepala_rambut;?></td>
                                <td valign="top"><?php echo $uraiankepala_rambut;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Bentuk Wajah</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $kepala_bentukwajah;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $kepala_lainlain;?></td>
                                <td valign="top"><?php echo $uraiankepala_lainlain;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>MATA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Pemeriksaan Dilakukan</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $mata_pemeriksaandilakukan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Penggunaan Kacamata</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $penggunaankacamata;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">OD</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $mata_od.'/'.$mata_os;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">OS</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $mata_ods.'/'.$mata_oss;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Visus</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $mata_visus;?></td>
                                <td valign="top"><?php echo $uraianmata_visus;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Buta Warna</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $mata_butawarna;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Kelainan Mata Lainnya</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $mata_kelainanmatalainnya;?></td>
                                <td valign="top"><?php echo $uraianmata_kelainanmatalainnya;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lapang Pandang</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $mata_lapangpandang;?></td>
                                <td valign="top"><?php echo $uraianmata_lapangpandang;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>TELINGA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Daun Telinga Kanan</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $telinga_dauntelingkanan;?></td>
                                <td valign="top"><?php echo $uraiantelinga_dauntelingkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Daun Telinga Kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $telinga_dauntelingkiri;?></td>
                                <td valign="top"><?php echo $uraiantelinga_dauntelingkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Liang Telinga Kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $telinga_liangtelingakanan;?></td>
                                <td valign="top"><?php echo $uraiantelinga_liangtelingakanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Liang Telinga Kiri</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_liangtelingakiri;?></td>
                                <td valign="top"><?php echo $uraiantelinga_liangtelingakiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Serumen Kanan</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_serumenkanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Serumen Kiri</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_serumenkiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Membrana Timfani Kanan</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_membranatimfanikanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Membrana Tifani Kiri</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_membranatimfanikiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Kesan Pendengaran</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_kesanpendengaran;?></td>
                                <td valign="top"><?php echo $uraiantelinga_kesanpendengaran;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $telinga_lainlain;?></td>
                                <td valign="top"><?php echo $uraiantelinga_lainlain;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>HIDUNG</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Meatus Nasi</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $hidung_meatusnasi;?></td>
                                <td valign="top"><?php echo $uraianhidung_meatusnasi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Septum Nasi</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $hidung_septumnasi;?></td>
                                <td valign="top"><?php echo $uraianhidung_septumnasi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Konka Nasal</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $hidung_konkanasal;?></td>
                                <td valign="top"><?php echo $uraianhidung_konkanasal;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Nyeri ketok sinus maksilaris</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $hidung_nyeriketoksinusmaksilaris;?></td>
                                <td valign="top"><?php echo $uraianhidung_nyeriketoksinusmaksilaris;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $hidung_lainlain;?></td>
                                <td valign="top"><?php echo $uraianhidung_lainlain;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>TENGGOROKAN</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Pharynx</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $tenggorokan_pharynx;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_pharynx;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Tonsil</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $tenggorokan_tonsil;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_tonsil;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Ukuran Kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $tenggorokan_ukurankanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Ukuran Kiri</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $tenggorokan_ukurankiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Palatum</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $tenggorokan_palatum;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_palatum;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">:</td>
                                <td valign="top"><?php echo $tenggorokan_lainlain;?></td>
                                <td valign="top"><?php echo $uraiantenggorokan_lainlain;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>MULUT</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Oral Hygiene</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $mulut_oralhygiene;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Gusi</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $mulut_gusi;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>GIGI</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Hasil</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $gigi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Temuan</td>
                                <td valign="top">: </td>
                                <td valign="top"></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>LEHER</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Gerakan leher</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $leher_gerakanleher;?></td>
                                <td valign="top"><?php echo $uraianleher_gerakanleher;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kelenjar thyroid</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $leher_kelenjarthyroid;?></td>
                                <td valign="top"><?php echo $uraianleher_kelenjarthyroid;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Pulsasi carotis</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $leher_pulsasi;?></td>
                                <td valign="top"><?php echo $uraianleher_pulsasi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Tekanan vena jugularis</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $leher_tekananvenajugularis;?></td>
                                <td valign="top"><?php echo $uraianleher_tekananvenajugularis;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Trachea</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $leher_trachea;?></td>
                                <td valign="top"><?php echo $uraianleher_trachea;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $leher_lainlain;?></td>
                                <td valign="top"><?php echo $uraianleher_lainlain;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>DADA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Bentuk</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $dada_bentuk;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Mammae</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $dada_mammae;?></td>
                                <td valign="top"><?php echo $uraiandada_mammae;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $dada_lainlain;?></td>
                                <td valign="top"><?php echo $uraiandada_lainlain;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>PARU2 DAN JANTUNG</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Palpasi</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_palpasi;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_palpasi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Perkusi kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_perkusikanan;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_perkusikanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Perkusi kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_perkusikiri;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_perkusikiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Iktus kordis</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_iktuskordis;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_iktuskordis;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Batas jantung</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_batasjantung;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_batasjantung;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Bunyi napas</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_bunyinapas;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_bunyinapas;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Bunyi napas tambahan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_tambahan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Bunyi jantung</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $paruparudanjatung_bunyijantung;?></td>
                                <td valign="top"><?php echo $uraianparuparudanjatung_bunyijantung;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>ABDOMEN</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Inspeksi</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_inspeksi;?></td>
                                <td valign="top"><?php echo $uraianabdomen_inspeksi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Perkusi</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_perkusi;?></td>
                                <td valign="top"><?php echo $uraianabdomen_perkusi;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Auskultasi bising usus</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_auskultasibisingusus;?></td>
                                <td valign="top"><?php echo $uraianabdomen_auskultasibisingusus;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Hati</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_hati;?></td>
                                <td valign="top"><?php echo $uraianabdomen_hati;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Limpa</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_limpa;?></td>
                                <td valign="top"><?php echo $uraianabdomen_limpa;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Nyeri tekan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_nyeritekan;?></td>
                                <td valign="top"><?php echo $uraianabdomen_nyeritekan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Nyeri ketok kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_nyeriketokkanan;?></td>
                                <td valign="top"><?php echo $uraianabdomen_nyeriketokkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Nyeri ketok Kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_nyeriketokkiri;?></td>
                                <td valign="top"><?php echo $uraianabdomen_nyeriketokkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Ballotement kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_ballotementkanan;?></td>
                                <td valign="top"><?php echo $uraianabdomen_ballotementkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Ballotement kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_ballotementkiri;?></td>
                                <td valign="top"><?php echo $uraianabdomen_ballotementkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kandung kemih</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_kandungkemih;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Anus/rektum/perianal</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_anus;?>
                                </td>
                                <td valign="top"><?php echo $uraianabdomen_anus;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Genitalia eks</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_genitaliaeks;?></td>
                                <td valign="top"><?php echo $uraianabdomen_genitaliaeks;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Prostat</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_prostat;?></td>
                                <td valign="top"><?php echo $uraianabdomen_prostat;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $abdomen_lainlain;?></td>
                                <td valign="top"><?php echo $uraianabdomen_lainlain;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>VERTEBRA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Hasil</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $vertebra;?></td>
                                <td valign="top"><?php echo $uraianvertebra;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>EXTREMITAS ATAS</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Simetris</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_simetris;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_simetris;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_gerakankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_gerakankanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_gerakankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_gerakankiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kekuatan kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_kekuatankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_kekuatankanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kekuatan kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_kekuatankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_kekuatankiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Tulang kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_tulangkanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_tulangkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Tulang kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_tulangkiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_tulangkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Sensibilitas kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_sensibilitaskanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_sensibilitaskanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Sensibilitas kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_sensibilitaskiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_sensibilitaskiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Oedema kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_oedemakanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Oedema kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_oedemakiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Tremor kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_tremorkanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Tremor kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_tremorkiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasatas_lainlain;?></td>
                                <td valign="top"><?php echo $uraianextremitasatas_lainlain;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>EXTREMITAS BAWAH</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Simetris</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_simetris;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_simetris;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_gerakankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_gerakankanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_gerakankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_gerakankiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kekuatan kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_kekuatankanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_kekuatankanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Kekuatan kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_kekuatankiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_kekuatankiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Tulang kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_tulangkanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_tulangkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Tulang kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_tulangkiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_tulangkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Sensibilitas kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_sensibilitaskanan;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_sensibilitaskanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Sensibilitas kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_sensibilitaskiri;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_sensibilitaskiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Oedema kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_oedemakanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Oedema kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_oedemakiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Tremor kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_tremorkanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Tremor kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_tremorkiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Varises kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_variseskanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Varises kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_variseskiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Lain-Lain</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $extremitasbawah_lainlain;?></td>
                                <td valign="top"><?php echo $uraianextremitasbawah_lainlain;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>SARAF/FUNGSI LUHUR</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Daya ingat</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_dayaingat;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Orientasi : waktu</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_orientasiwaktu;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_orientasiwaktu;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Orientasi : orang</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_orientasiorang;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_orientasiorang;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Orientasi : tempat</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_orientasitempat;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_orientasitempat;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Sikap</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_sikap;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Kesan saraf otak</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $saraffungsiluhur_kesansarafotak;?></td>
                                <td valign="top"><?php echo $uraiansaraffungsiluhur_kesansarafotak;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>KESAN SARAF OTAK</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Fungsi sensorik kanan</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsisensorikkanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsisensorikkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Fungsi sensorik kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsisensorikkiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsisensorikkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Fungsi otonom kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsiotonomkanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsiotonomkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Fungsi otonom kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsiotonomkiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsiotonomkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Fungsi vaskular kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsivaskularkanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsivaskularkanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Fungsi vaskular kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_fungsivaskularkiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_fungsivaskularkiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan abnormal kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_gerakanabnormalkanan;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Gerakan abnormal kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_gerakanabnormalkiri;?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td valign="top">Refl fisiologis patela kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_reflfisiologispatelakanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflfisiologispatelakanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Refl fisiologis patela kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_reflfisiologispatelakiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflfisiologispatelakiri;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Refl patologis babinsky kanan</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_reflpatologisbabinskykanan;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflpatologisbabinskykanan;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Refl patologis babinsky kiri</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kesansarafotak_reflpatologisbabinskykiri;?></td>
                                <td valign="top"><?php echo $uraiankesansarafotak_reflpatologisbabinskykiri;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style="width:100%;">
                    <b>KELENJAR GETAH BENING</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                           
                            <tr>
                                <td style="width:25%;" valign="top">Leher</td>
                                <td style="width:2%;" valign="top">: </td>
                                <td valign="top"><?php echo $kelenjargetahbening_leher;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_leher;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Submandibula</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kelenjargetahbening_submandibula;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_submandibula;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Ketiak</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kelenjargetahbening_ketiak;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_ketiak;?></td>
                            </tr>
                            <tr>
                                <td valign="top">Inguinal</td>
                                <td valign="top">: </td>
                                <td valign="top"><?php echo $kelenjargetahbening_inguinal;?></td>
                                <td valign="top"><?php echo $uraiankelenjargetahbening_inguinal;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
                    </div>
                    </div>

                      </div>
                        <div class="tab-pane fade" id="hasillaboratorium" role="tabpanel" aria-labelledby="hasillaboratorium-tab3">
                        <div style="width:100%;">
                    <div class="hpanel hgreen">
            <div class="panel-body">
                <h4><b>Hasil Pemeriksaan Lab</b></h4>
                <table id="mytablegigi" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
                    <th style="width:35%;text-align:center;"><font size="1">PEMERIKSAAN</font></th>    
                    <th style="width:20%;text-align:center;"><font size="1">DALAM KISARAN <br>NILAI RUJUKAN</font></th>    
					<th style="width:20%;text-align:center;"><font  size="1" color="red">DILUAR KISARAN <br>NILAI RUJUKAN</font></th>    
                    <th style="width:10%;text-align:center;"><font size="1">NILAI RUJUKAN</font></th>    
                    <th style="width:10%;text-align:center;"><font size="1">SATUAN</font></th>    
                    <th style="width:15%;text-align:center;"><font size="1">KESIMPULAN</font></th>    
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; foreach($getlababnormal as $g){?>
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
						<td style="text-align:left;"><font size="1"><?php echo $jarak.$g['nama_item'];?></font></td>
						<?php if($g['keterangan'] != NULL and $g['keterangan'] != 'Normal'){?>
							<td></td>
							<td style="text-align:center;"><font size="1" color="red"><?php echo $g['hasil'];?></font></td>
                        <td style="text-align:center;"><font size="1"><?php echo $uraian ;?></font></td>
								<td style="text-align:center;"><font size="1"><?php echo $g['satuan'];?></font></td>
								<td style="text-align:center;"><font size="1" color="red"><?php echo $g['keterangan'];?></font></td>
							<?php }else{ ?>
								<td style="text-align:center;"><font size="1"><?php echo $g['hasil'];?></font></td>
								<td></td>
                        <td style="text-align:center;"><font size="1"><?php echo $uraian ;?></font></td>
								<td style="text-align:center;"><font size="1"><?php echo $g['satuan'];?></font></td>
								<td style="text-align:center;"><font size="1"><?php echo $g['keterangan'];?></font></td>
								<?php } ?>
								
								
							</tr> 
							
							<?php $no++ ;}?> 
						</tbody>						
					</table>
            </div>
                    </div>
                   </div>

                      </div>
                        <div class="tab-pane fade" id="hasilelektromedis" role="tabpanel" aria-labelledby="hasilelektromedis-tab3">
                        <div class="hpanel hgreen">
            <div class="panel-body">
                <h4><b>Pemeriksaan Elektromedis</b></h4>
                <?php if($ekg == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>EKG</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasilekg;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosaekg;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Lampiran File</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $nadi;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                <?php if($treadmill == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>TREADMILL</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasiltreadmill;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosatreadmill;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Lampiran File</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $nadi;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                <?php if($spirometri == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>SPIROMETRI</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasilspirometri;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosaspirometri;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Lampiran File</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $nadi;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                <?php if($audiometri == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>AUDIOMETRI</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasilaudiometri;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosaaudiometri;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Lampiran File</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $nadi;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                
                
                
                
                
            </div>
                    </div>

                      </div>
                        <div class="tab-pane fade" id="hasilradiologi" role="tabpanel" aria-labelledby="hasilradiologi-tab3">
                         <div class="hpanel hgreen">
            <div class="panel-body">
                <h4><b>Pemeriksaan Radiologi</b></h4>
                <?php if($radiologi == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>THORAX PA</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasilradiologi;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosaradiologi;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Lampiran File</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $nadi;?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                <?php if($usg == 'Ada'){?>
                                        <div style="width:100%;">
                    <b>USG ABDOMEN</b>
                    <br>
                
                    <div style="width:100%; float:left;">
                        
                        <table id="mytablegigi" class="table table-striped table-bordered table-hover">
                            <tr>
                                <td style="width:18%;" valign="top">Hasil</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $hasilusg;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Keterangan</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $diagnosausg;?></td>
                            </tr>
                            <tr>
                                <td style="width:18%;" valign="top">Lampiran File</td>
                                <td style="width:1%;" valign="top">:</td>
                                <td valign="top"><?php echo $nadi;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                                            <?php } ?>
                
                
            </div>
                    </div>

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
<script>tinymce.init({ selector:'textarea' });</script> 
<script>

        $(function(){

            $(".js-source-states").select2();
            $(".js-source-states-2").select2();

            //turn to inline mode
            

        });

    </script>
<script>
function myFunction(sel) {
    var opts = [],
    opt;
  var len = sel.options.length;
  for (var i = 0; i < len; i++) {
    opt = sel.options[i];
    if (opt.selected) {
        var res = opt.value.split(";");
      //opts.push(opt);
        if(res[1]!= ''){
        var $body = $(tinymce.activeEditor.getBody());
        $body.find('p:last').append($('<p>- '+res[1]+'</p>'));
        }
    }
      
  }

  return opts;
}
</script>
<script type="application/javascript">
$(document).ready(function() {
  $('#c1a').on('change', function() {
    if (this.checked) {
      $('#c1a').prop('checked', true);
      $('#c1b').prop('checked', false);
      $('#c2').prop('checked', false);
      $('#c3a').prop('checked', false);
      $('#c3b').prop('checked', false);
      $('#c4').prop('checked', false);
      $('#c5').prop('checked', false);
    }
  });
    $('#c1b').on('change', function() {
    if (this.checked) {
      $('#c1a').prop('checked', false);
      $('#c1b').prop('checked', true);
      $('#c2').prop('checked', false);
      $('#c3a').prop('checked', false);
      $('#c3b').prop('checked', false);
      $('#c4').prop('checked', false);
      $('#c5').prop('checked', false);
    }
  });
    $('#c2').on('change', function() {
    if (this.checked) {
      $('#c1a').prop('checked', false);
      $('#c1b').prop('checked', false);
      $('#c2').prop('checked', true);
      $('#c3a').prop('checked', false);
      $('#c3b').prop('checked', false);
      $('#c4').prop('checked', false);
      $('#c5').prop('checked', false);
    }
  });
    $('#c3a').on('change', function() {
    if (this.checked) {
      $('#c1a').prop('checked', false);
      $('#c1b').prop('checked', false);
      $('#c2').prop('checked', false);
      $('#c3a').prop('checked', true);
      $('#c3b').prop('checked', false);
      $('#c4').prop('checked', false);
      $('#c5').prop('checked', false);
    }
  });
    $('#c3b').on('change', function() {
    if (this.checked) {
      $('#c1a').prop('checked', false);
      $('#c1b').prop('checked', false);
      $('#c2').prop('checked', false);
      $('#c3a').prop('checked', false);
      $('#c3b').prop('checked', true);
      $('#c4').prop('checked', false);
      $('#c5').prop('checked', false);
    }
  });
    $('#c4').on('change', function() {
    if (this.checked) {
      $('#c1a').prop('checked', false);
      $('#c1b').prop('checked', false);
      $('#c2').prop('checked', false);
      $('#c3a').prop('checked', false);
      $('#c3b').prop('checked', false);
      $('#c4').prop('checked', true);
      $('#c5').prop('checked', false);
    }
  });
    $('#c5').on('change', function() {
    if (this.checked) {
      $('#c1a').prop('checked', false);
      $('#c1b').prop('checked', false);
      $('#c2').prop('checked', false);
      $('#c3a').prop('checked', false);
      $('#c3b').prop('checked', false);
      $('#c4').prop('checked', false);
      $('#c5').prop('checked', true);
    }
  });
    

  });
</script>
<script type="text/javascript">

	  
    function changeFunc(id) {
			var x = document.getElementById(id).value;
			if (x == 'Custom'){
				$('#uraian'+id).show();
			}else{
				$('#uraian'+id).hide();
			}
		}
    
	</script>
    </div>
</body>

</html>