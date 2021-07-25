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
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/jquery.treegrid.css');?>">
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
													<td><input id="noregistrasi" class="form-control" readonly>
                                                        <input id="id" type="hidden" class="form-control" readonly></td>
												</tr>
												<tr>
													<td>NIK</td>
													<td>:</td>
													<td><div class="input-group">
														<input type="text" class="form-control" id="nik" readonly>

													</div>
												</td>
											</tr>
											<tr>
												<td>Nama</td>
												<td>:</td>
												<td><input id="nama" class="form-control" readonly ></td>
											</tr>
											<tr>
												<td>Tanggal Lahir</td>
												<td>:</td>
												<td><input id="tanggallahir" class="form-control" readonly></td>
											</tr>
                                        <tr>
												<td>Umur</td>
												<td>:</td>
												<td><input id="umur" class="form-control" readonly></td>
											</tr>

											<tr>
												<td>Jenis Kelamin</td>
												<td>:</td>
												<td><input id="jeniskelamin" class="form-control" readonly></td>
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
												<td>Poliklinik</td>
												<td>:</td>
												<td><select id="poliklinik" class="form-control"></select></td>
											</tr>
                                            <tr>
												<td>Dokter</td>
												<td>:</td>
												<td><select id="dokter" class="form-control"></select></td>
											</tr>
                                            <tr>
												<td>Petugas</td>
												<td>:</td>
												<td><select id="petugas" class="form-control" ></select></td>
											</tr>
                                            <tr>
												<td>Kondisi Masuk</td>
												<td>:</td>
												<td><select id="kondisimasuk"   class="form-control" name="kondisimasuk">
                                                    <option value="">- Pilih Kondisi-</option>
                                                    <option value="Tampak Normal">Tampak Normal</option>
                                                    <option value="Tidak sadar">Tidak sadar</option>
                                                    <option value="Tidak normal">Tidak normal</option>
                                                    <option value="Perlu bantuan">Perlu bantuan</option>
                                                    </select>
                                                </td>
											</tr>
                                            <tr>
												<td>Selesai</td>
												<td>:</td>
												<td><select id="selesai"   class="form-control" name="selesai">
                        <option value="Tidak">Tidak</option>
                        <option value="Ya">Ya</option>
                    </select></td>
											</tr>
                                            <tr>
												<td>Cara Keluar</td>
												<td>:</td>
												<td><select id="carakeluar"   class="form-control js-source-states" name="carakeluar">
                        <option value="">- Pilih -</option>
                        <option value="Dipulangkan">Dipulangkan</option>
                        <option value="Lari">Lari / Menolak Perawatan</option>
                        <option value="Meninggal">Meninggal</option>
                        <option value="Rawat inap">Rawat inap</option>
                    </select></td>
											</tr>
                                            <tr>
												<td>Kondisi Keluar</td>
												<td>:</td>
												<td><select id="kondisikeluar"   class="form-control js-source-states" name="kondisikeluar">
                        <option value="">- Pilih -</option>
                        <option value="Sembuh">Sembuh</option>
                        <option value="Sehat">Sehat</option>
                        <option value="Belum sembuh">Belum sembuh</option>
                        <option value="Meninggal">Meninggal</option>
                        <option value="Sembuh">Sembuh</option>
                        <option value="Dirujuk">Dirujuk</option>
                        <option value="Mulai sembuh">Mulai sembuh</option>
                    </select></td>
											</tr>
                                            <tr>
												<td>Tanggal Keluar</td>
												<td>:</td>
												<td><input type="date" id="tanggalkeluar" class="form-control" name="tanggalkeluar"></td>
											</tr>
                                            <tr>
												<td>Waktu Keluar</td>
												<td>:</td>
												<td><input type="time" id="jamkeluar" class="form-control" name="jamkeluar"></td>
											</tr>
											
								</table>
                                         <div class="col-sm-4">
        <button class="btn btn-success btn-block" id="btnSimpanRawatjalan" onclick="SimpanRawatjalan()">Simpan</button> 
    </div>
							</div>
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
                    <h4>Pemeriksaan dan Tindakan Dokter Poli</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="fisik-tab3" data-toggle="tab" href="#fisik" role="tab"
                          aria-controls="fisik" aria-selected="true">Fisik</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="diagnosaiicdx-tab3" data-toggle="tab" href="#diagnosaiicdx" role="tab"
                          aria-controls="diagnosaiicdx" aria-selected="false">Diagnosa ICD-X</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="tindakan-tab3" data-toggle="tab" href="#tindakan" role="tab"
                          aria-controls="tindakan" aria-selected="false">Tindakan</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" id="bhp-tab3" data-toggle="tab" href="#bhp" role="tab"
                          aria-controls="bhp" aria-selected="false">BHP</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" id="resep-tab3" data-toggle="tab" href="#resep" role="tab"
                          aria-controls="resep" aria-selected="false">Resep</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" id="pemeriksaanlab-tab3" data-toggle="tab" href="#pemeriksaanlab" role="tab"
                          aria-controls="pemeriksaanlab" aria-selected="false">Pemeriksaan Lab</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" id="pemeriksaanpenunjang-tab3" data-toggle="tab" href="#pemeriksaanpenunjang" role="tab"
                          aria-controls="pemeriksaanpenunjang" aria-selected="false">Pemeriksaan Penunjang</a>
                      </li>
                        <li class="nav-item">
                        <a class="nav-link" id="soap-tab3" data-toggle="tab" href="#soap" role="tab"
                          aria-controls="soap" aria-selected="false">SOAP</a>
                      </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                      <div class="tab-pane fade show active" id="fisik" role="tabpanel" aria-labelledby="fisik-tab3">
                       <div class="row">
    <div class="col-sm-8 text-center">
        <h5>Pemeriksaan Fisik</h5>
    </div>
    <div class="col-sm-6 row">
        <div class="col-sm-6">
            <div class="section-title">Tinggi Badan</div>
            <div class="form-group">
                <input type="text" id="f_tinggibadan" class="form-control numberOnly">
            </div>
            <div class="section-title">Detak Jantung</div>
            <div class="form-group">
                <input type="text" id="f_detakjantung" class="form-control">
            </div>
            <div class="section-title">Keluhan</div>
            <div class="form-group">
                <textarea id="f_keluhan" class="form-control "></textarea>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="section-title">Berat Badan</div>
            <div class="form-group">
                <input type="text" id="f_beratbadan" class="form-control">
            </div>
            <div class="section-title">Tekanan Darah</div>
            <div class="form-group">
                <input type="text" id="f_tekanandarah" class="form-control">
            </div>
            <div class="section-title">Riwayat Penyakit</div>
            <div class="form-group">
                <textarea id="f_riwayatpenyakit" class="form-control "></textarea>
            </div>
            
        </div>
    </div>
    <div class="col-sm-4 row">
        <div class="col-sm-8">
            <div class="section-title">Suhu Badan</div>
            <div class="form-group">
                <input type="text" id="f_suhubadan" class="form-control">
            </div>
            <div class="section-title">Nafas</div>
            <div class="form-group">
                <input type="text" id="f_nafas" class="form-control">
            </div>
            
            
            <div class="section-title">Riwayat Penyakit Keluarga</div>
            <div class="form-group">
                <textarea id="f_riwayatpenyakitkeluarga" class="form-control "></textarea>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <button class="btn btn-success btn-block" id="btnFisik" onclick="saveFisik()">Simpan</button> 
    </div>
</div>
                      </div>
                      <div class="tab-pane fade" id="diagnosaiicdx" role="tabpanel" aria-labelledby="diagnosaiicdx-tab3">
                        <div class="row">
    <div class="col-sm-12 text-center">
        <h5>Diagnosa ICD-X</h5>
    </div>
    <div class="col-sm-6">
        <div class="section-title">Diagnosa</div>
        <div class="form-group">
            <select id="icdx_diagnosa" class="form-control" style="width:100%"></select>
        </div>
        <div class="section-title">Jenis Diagnosa</div>
        <div class="form-group">
            <select id="icdx_jenis_diagnosa" class="form-control">
                <option value="">Pilih Jenis Diagnosa</option>
                <option value="UTAMA">UTAMA</option>
                <option value="SEKUNDER">SEKUNDER</option>
                <option value="KOMPLIKASI">KOMPLIKASI</option>
                <option value="PATOLOGI">PATOLOGI</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
       
        <div class="section-title">Kasus</div>
        <div class="form-group">
            <select id="icdx_kasus" class="form-control">
                <option value="">Pilih Kasus</option>
                <option value="BARU">BARU</option>
                <option value="LAMA">LAMA</option>
            </select>
        </div>
        <div class="section-title">Keterangan</div>
        <div class="form-group">
            <textarea id="icdx_keterangan" class="form-control "></textarea>
        </div>
    </div>
    <div class="col-sm-4">
        <button class="btn btn-success btn-block" id="btnDiagnosaicdx" onclick="saveDiagnosaicdx()">Input</button> 
    </div>

    <div class="col-sm-12">
        <br>
        <div class="table-responsive">
        <table id="tableIcdx" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-left">Kode ICD-X</th>
                    <th class="text-left">Nama Diagnosa</th>
                    <th class="text-left">Jenis Diagnosa</th>
                    <th class="text-left">Kasus</th>
                    <th class="text-left">Keterangan</th>
                    <th class="text-center">#</th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
</div>

                      </div>
                      <div class="tab-pane fade" id="tindakan" role="tabpanel" aria-labelledby="tindakan-tab3">
                        <div class="row">
    <div class="col-sm-10 text-center">
        <h5>Tindakan Yang Di Lakukan</h5>
    </div>
    <div class="col-sm-3">
        <div class="section-title">Tindakan</div>
        <div class="form-group">
            <select id="tin_tindakan" class="form-control select2" style="width:100%"></select>
        </div>
    </div>
    <div class="col-sm-3">
    <div class="section-title">Pelaksana</div>
        <div class="form-group">
            <select id="tin_pelaksana" class="form-control select2" style="width:100%"></select>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="section-title">Jumlah</div>
        <div class="form-group">
            <input type="text" id="tin_jumlah" class="form-control">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="section-title" style="color: white;">Simpan</div>
        <div class="form-group">
            <button class="btn btn-success btn-block" id="btnTindakan" onclick="saveTindakan()">Simpan</button> 
        </div>
    </div>
    <div class="col-sm-10">
        <br>
        <table id="tableTindakan" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-left">Tindakan</th>
                    <th class="text-left">Pelaksana</th>
                    <th class="text-left">Jumlah</th>
                    <th class="text-center">#</th>
                </tr>
            </thead>
            <tbody id="tbodyTindakan">
            </tbody>
        </table>
    </div>
</div>
                      </div>
                        <div class="tab-pane fade" id="bhp" role="tabpanel" aria-labelledby="bhp-tab3">
                        <div class="row">
    <div class="col-sm-10 text-center">
        <h5>BHP Yang diberikan</h5>
    </div>
    <div class="col-sm-3">
        <div class="section-title">BHP</div>
        <div class="form-group">
            <select id="bhp_bhp" class="form-control select2" style="width:100%"></select>
        </div>
    </div>
    <div class="col-sm-2">
        <div class="section-title">Jumlah</div>
        <div class="form-group">
            <input type="text" id="bhp_jumlah" class="form-control">
        </div>
    </div>
    <div class="col-sm-3">
        <div class="section-title">Keterangan</div>
        <div class="form-group">
            <input type="text" id="bhp_keterangan" class="form-control">
        </div>
    </div>
    <div class="col-sm-2">
        <div class="section-title" style="color: white;">Simpan</div>
        <div class="form-group">
        <button class="btn btn-success btn-block" id="btnBHP" onclick="saveBHP()">Simpan</button> 
        </div>
    </div>

    <div class="col-sm-10">
        <br>
        <table id="tableBHP" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-left">BHP</th>
                    <th class="text-left">Satuan</th>
                    <th class="text-left">Jumlah</th>
                    <th class="text-left">Keterangan</th>
                    <th class="text-center">#</th>
                </tr>
            </thead>
             <tbody id="tbodyBHP">
            </tbody>
        </table>
    </div>
</div>

                      </div>
                        <div class="tab-pane fade" id="resep" role="tabpanel" aria-labelledby="resep-tab3">
                       
<div class="row">
    <div class="col-sm-12 text-center">
        <h5>Resep Obat Yang diberikan</h5>
    </div>
    <div class="col-sm-12 row">
        <div class="col-sm-3">
            <div class="section-title">Obat</div>
            <div class="form-group">
                <select id="obat_obat" class="form-control select2" style="width:100%"></select>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="section-title">Jumlah</div>
            <div class="form-group">
                <input type="text" id="obat_jumlah" class="form-control">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="section-title">Aturan Pakai</div>
            <div class="form-group">
                <input type="text" id="obat_aturan_pakai" class="form-control">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="section-title">Waktu Penggunaan</div>
            <div class="form-group">
                <input type="text" id="obat_waktupenggunaan" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-sm-12 row">
        
        <div class="col-sm-5">
            <div class="section-title">Cara Penggunaan</div>
            <div class="form-group">
                <textarea class="form-control" name="" id="obat_carapenggunaan" cols="30" rows="2"></textarea>
            </div>
        </div>

         <div class="col-sm-3">
            <div class="section-title" style="color: white;">Cara Penggunaan</div>
            <div class="form-group">
            <button class="btn btn-success btn-block" id="btnResep" onclick="saveResep()">Simpan</button> 
            <button class="btn btn-info btn-block" id="btnObatCetak" onclick="cetakResep()">Cetak Resep</button> 
            </div>
        </div>
    </div>
    <div class="col-sm-12 row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
        </div>
    </div>

    <div class="col-sm-12">
        <br>
        <table id="tableResep" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-left">Barang</th>
                    <th class="text-left">Satuan</th>
                    <th class="text-left">Jumlah</th>
                    <th class="text-left">Aturan Pakai</th>
                    <th class="text-left">Waktu Penggunaan</th>
                    <th class="text-left">Cara Penggunaan</th>
                    <th class="text-center">#</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

                      </div>
                        <div class="tab-pane fade" id="pemeriksaanlab" role="tabpanel" aria-labelledby="pemeriksaanlab-tab3">
                        
<div class="row">
    <div class="col-sm-12 text-center">
        <h5>Pemeriksaan Laboratorium</h5>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
												<label for="laboratorium_select">Laboratorium</label>
												<table class="table table-striped tree">
													<tbody>
														<?php foreach($getitem as $g){?>
															<tr class="<?php echo 'treegrid-'.str_replace('.','_',$g['id']); if($g['level']!='KELOMPOK'){echo ' treegrid-parent-'.str_replace('.','_',$g['id_paren']);}?>">
																<td>
																	<input name="iddetail[]" type="checkbox" value="<?php echo $g['id'];?>">&nbsp;&nbsp;&nbsp;<font size="2"><?php echo $g['nama_item'];?></font>
																</td>
															</tr>
														<?php } ?>
													</tbody>
	                                            </table>
											</div>
        <div class="form-group">
            <button class="btn btn-success btn-block" id="btnLab" onclick="saveLab()">Daftarkan</button> 
        </div>
    </div>

    <div class="col-sm-8">
        <br>
        <table id="tableLab" class="table table-striped">
            <thead>
        <tr>
          <th>Nama Item</th>
          <th>Satuan</th>
          <th>Hasil Pemeriksaan</th>
          <th>Keterangan </th>
        </tr>
      </thead>
            <tbody id="tbodyLab">
            </tbody>
        </table>
    </div>
</div>

                      </div>
                        <div class="tab-pane fade" id="pemeriksaanpenunjang" role="tabpanel" aria-labelledby="pemeriksaanpenunjang-tab3">
                        
<div class="row">
    <div class="col-sm-12 text-center">
        <h5>Pemeriksaan Penunjang</h5>
    </div>
    <div class="col-sm-4">
        <div class="section-title">Tanggal Kunjungan</div>
        <div class="form-group">
            <input type="date" id="penunjang_tanggalkunjungan" class="form-control">
        </div>
       
    </div>
    <div class="col-sm-4">
        <div class="section-title">Pemeriksaan</div>
        <div class="form-group">
            <select id="penunjang_pemeriksaan" class="form-control select2" style="width:100%"></select>
             <button class="btn btn-success btn-block" id="btnPenunjang" onclick="savePenunjang()">Daftarkan</button>
        </div>
       
    </div>

    <div class="col-sm-12">
        <br>
        <table id="tablePenunjang" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-left">Tanggal Kunjungan</th>
                    <th class="text-left">Pemeriksaan</th>
                    <th class="text-left">Hasil</th>
                    <th class="text-left">Diagnosa</th>
                    <th class="text-left">Catatan Dokter</th>
                    <th class="text-center">#</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

                      </div>
                        <div class="tab-pane fade" id="soap" role="tabpanel" aria-labelledby="soap-tab3">
                        <div class="row">
    <div class="col-sm-12 text-center">
        <h5>SOAP ( Subject Assessment Plan)</h5>
    </div>
    <div class="col-sm-12 row">
        <div class="col-sm-4">
            <div class="section-title">Tanggal</div>
            <div class="form-group">
                <input type="date" id="soap_tanggal" class="form-control numberOnly">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="section-title">Subject (Keluhan)</div>
            <div class="form-group">
                <textarea id="soap_keluhan" class="form-control "></textarea>
            </div>
            <div class="section-title">Object (Pemeriksaan)</div>
            <div class="form-group">
                <textarea id="soap_pemeriksaan" class="form-control "></textarea>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="section-title">Assesment (Kesimpulan)</div>
            <div class="form-group">
                <textarea id="soap_kesimpulan" class="form-control "></textarea>
            </div>
            <div class="section-title">Plan (Rencana)</div>
            <div class="form-group">
                <textarea id="soap_rencana" class="form-control "></textarea>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <button class="btn btn-success btn-block" id="btnSoap" onclick="saveSoap()">Simpan</button> 
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
        <script src="<?php echo base_url('assets/template/js/jquery.treegrid.js');?>"></script>
<script>
						$(document).ready(function() {
							var csfrData = {};
							csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
							$.ajaxSetup({
								data: csfrData
							});
                            $('.tree').treegrid({
                'initialState': 'collapsed',
                    expanderExpandedClass: 'fa fa-minus',
                    expanderCollapsedClass: 'fa fa-plus'
        });
                            $("#dokter").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getDokter") ?>',
									dataType: 'json',
									type: "GET",
									delay: 250,
									data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                                processResults: function (res, params) {
                                    var result = res.data.map(function (item) {
                                        return {id: item.id, text: item.nama };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
                            $("#petugas").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getPetugas") ?>',
									dataType: 'json',
									type: "GET",
									delay: 250,
									data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                                processResults: function (res, params) {
                                    var result = res.data.map(function (item) {
                                        return {id: item.id, text: item.nama };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
                            $("#poliklinik").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getPetugas") ?>',
									dataType: 'json',
									type: "GET",
									delay: 250,
									data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                                processResults: function (res, params) {
                                    var result = res.data.map(function (item) {
                                        return {id: item.id, text: item.nama };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
                            $("#icdx_diagnosa").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getDiagnosaicdx") ?>',
									dataType: 'json',
									type: "GET",
									delay: 250,
									data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                                processResults: function (res, params) {
                                    var result = res.data.map(function (item) {
                                        return {id: item.id, text: item.namaindonesia };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
                            $("#tin_tindakan").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getTindakan") ?>',
									dataType: 'json',
									type: "GET",
									delay: 250,
									data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                                processResults: function (res, params) {
                                    var result = res.data.map(function (item) {
                                        return {id: item.id, text: item.nama };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
                            $("#tin_pelaksana").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getPetugas") ?>',
									dataType: 'json',
									type: "GET",
									delay: 250,
									data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                                processResults: function (res, params) {
                                    var result = res.data.map(function (item) {
                                        return {id: item.id, text: item.nama };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
                            $("#penunjang_pemeriksaan").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getPenunjang") ?>',
									dataType: 'json',
									type: "GET",
									delay: 250,
									data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                                processResults: function (res, params) {
                                    var result = res.data.map(function (item) {
                                        return {id: item.id, text: item.nama_item };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
                            $("#obat_obat").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getObat") ?>',
									dataType: 'json',
									type: "GET",
									delay: 250,
									data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                                processResults: function (res, params) {
                                    var result = res.data.map(function (item) {
                                        return {id: item.id, text: item.nama };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
                            $("#bhp_bhp").select2({
								language: {
									searching: function() {
										return "Mohon tunggu ...";
									}
								},
								ajax: {
									url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getBHP") ?>',
									dataType: 'json',
									type: "GET",
									delay: 250,
									data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                                processResults: function (res, params) {
                                    var result = res.data.map(function (item) {
                                        return {id: item.id, text: item.nama };
                                    });
                                    return {
                                        results: result
                                    };
                                }
								},
							});
                            
                            getData();
                        });
                        function getData() {
							showLoading();
							dataPost = {
								id: '<?php echo $id;?>',
							}
							$.ajax({
								url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getData") ?>',
								type: 'POST',
								dataType: 'json',
								data: dataPost,
								success: function(res) {
									console.log(res)
									dismisLoading();
									if (res.status_json) {
										data = res.data;
										$('#id').val(data.id);
										$('#noregistrasi').val(data.noregistrasi);
										$('#nama').val(data.nama);
										$('#nik').val(data.nik);
										$('#tanggallahir').val(data.tanggallahir);
										$('#umur').val(data.umur);
										$('#jeniskelamin').val(data.jeniskelamin);
										$('#selesai').val(data.selesai);
										$('#kondisimasuk').val(data.kondisimasuk);
										$('#carakeluar').val(data.carakeluar);
										$('#tanggalkeluar').val(data.tanggalkeluar);
										$('#kondisikeluar').val(data.kondisikeluar);
										$('#jamkeluar').val(data.jamkeluar);
                                        
                                        var $dokter = $("<option selected></option>").val(data.dokter_id).text(data.namadokter);
										$('#dokter').append($dokter).trigger('change');
                                        var $petugas = $("<option selected></option>").val(data.petugas).text(data.namapetugas);
										$('#petugas').append($petugas).trigger('change');
                                        var $poliklinik = $("<option selected></option>").val(data.poliklinik_id).text(data.namapoliklinik);
										$('#poliklinik').append($poliklinik).trigger('change');
                                        
                                        $('#f_tinggibadan').val(data.f_tinggibadan);
										$('#f_beratbadan').val(data.f_beratbadan);
										$('#f_detakjantung').val(data.f_detakjantung);
										$('#f_tekanandarah').val(data.f_tekanandarah);
										$('#f_suhubadan').val(data.f_suhubadan);
										$('#f_nafas').val(data.f_nafas);
										$('#f_keluhan').val(data.f_keluhan);
										$('#f_riwayatpenyakit').val(data.f_riwayatpenyakit);
										$('#f_riwayatpenyakitkeluarga').val(data.f_riwayatpenyakitkeluarga);
                                        
										$('#soap_tanggal').val(data.soap_tanggal);
										$('#soap_keluhan').val(data.soap_subject);
										$('#soap_pemeriksaan').val(data.soap_object);
										$('#soap_kesimpulan').val(data.soap_assesment);
										$('#soap_rencana').val(data.soap_plan);
                                        
                                        getDataDiagnosaICDX(data.noregistrasi);
                                        getDataTindakan(data.noregistrasi);
                                        getDataBHP(data.noregistrasi);
                                        getDataResep(data.noregistrasi);
                                        getDataLab(data.noregistrasi);
                                        getDataPenunjang(data.noregistrasi);
									} else {
										showSnackError(res.remarks);
									}
								},
								error: function(XMLHttpRequest, textStatus, errorThrown) {
									showSnackError(XMLHttpRequest);
									dismisLoading();
								},
								timeout: 60000
							});
						}
                function getDataDiagnosaICDX(noregistrasi){
                    dataPost = {
								noregistrasi: noregistrasi,
							}
                    $("#tableIcdx").dataTable({
                    ajax: {
						url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getDataDiagnosaICDX") ?>',
						dataSrc: 'data',
                        type: 'POST',
					dataType: 'json',
					data: dataPost,
					},
					columns: [{
							"data": 'no'
						}, {
							"data": 'kodeicd',
						},
						{
							"data": 'namaindonesia'
						},
						{
							"data": 'jenisdiagnosa'
						},
						{
							"data": 'kasus'
						},
						{
							"data": 'keterangan'
						},
						{
							"data": 'option'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [3]
					}]
				});
                }
                function getDataTindakan(noregistrasi){
                    dataPost = {
								noregistrasi: noregistrasi,
							}
                    $("#tableTindakan").dataTable({
                    ajax: {
						url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getDataTindakan") ?>',
						dataSrc: 'data',
                        type: 'POST',
					dataType: 'json',
					data: dataPost,
					},
					columns: [{
							"data": 'no'
						}, {
							"data": 'namatindakan',
						},
						{
							"data": 'namapelaksana'
						},
						{
							"data": 'jumlah'
						},
                              {
							"data": 'option'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [3]
					}]
				});
                }
                function getDataBHP(noregistrasi){
                    dataPost = {
								noregistrasi: noregistrasi,
							}
                    $("#tableBHP").dataTable({
                    ajax: {
						url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getDataBHP") ?>',
						dataSrc: 'data',
                        type: 'POST',
					dataType: 'json',
					data: dataPost,
					},
					columns: [{
							"data": 'no'
						}, {
							"data": 'namabhp',
						}, 
						{
							"data": 'satuan'
						},
						{
							"data": 'jumlah'
						},
                        {
                            "data": 'keterangan'
                        },
                              {
							"data": 'option'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [3]
					}]
				});
                }
                function getDataResep(noregistrasi){
                    dataPost = {
								noregistrasi: noregistrasi,
							}
                    $("#tableResep").dataTable({
                    ajax: {
						url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getDataResep") ?>',
						dataSrc: 'data',
                        type: 'POST',
					dataType: 'json',
					data: dataPost,
					},
					columns: [{
							"data": 'no'
						}, {
							"data": 'namaobat',
						},
						{
							"data": 'satuan'
						},
						{
							"data": 'jumlah'
						},
                              {
							"data": 'aturanpakai'
						},
                              {
							"data": 'waktupenggunaan'
						},
                              {
							"data": 'carapenggunaan'
						},     {
							"data": 'option'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [3]
					}]
				});
                }
                function getDataLab(noregistrasi){
                    dataPost = {
								noregistrasi: noregistrasi,
							}
                    $("#tableLab").dataTable({
                                
					ajax: {
						url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getDataLab") ?>',
						dataSrc: 'data',
                        type: 'POST',
					dataType: 'json',
					data: dataPost,
					},
					columns: [{
							"data": 'namaitem'
						}, {
							"data": 'satuan',
						},
						{
							"data": 'hasil'
						},
						{
							"data": 'keterangan'
						}
					]
				});
                }
                function getDataPenunjang(noregistrasi){
                    dataPost = {
								noregistrasi: noregistrasi,
							}
                    $("#tablePenunjang").dataTable({
                    ajax: {
						url: '<?php echo base_url("eklinik/rawatjalan/datapasien/getDataPenunjang") ?>',
						dataSrc: 'data',
                        type: 'POST',
					dataType: 'json',
					data: dataPost,
					},
					columns: [{
							"data": 'no'
						}, {
							"data": 'tanggalkunjungan',
						},{
							"data": 'jenis',
						},
						{
							"data": 'hasil'
						},
						{
							"data": 'diagnosa'
						},
                              {
							"data": 'catatandokter'
						},
                                {
							"data": 'option'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [3]
					}]
				});
                }
                function SimpanRawatjalan() {
			var btn = document.getElementById("btnSimpanRawatjalan");

			var id = $('#id').val();
            var dokter = $('#dokter').val();
            var petugas = $('#petugas').val();
            var poliklinik = $('#poliklinik').val();
            var selesai = $('#selesai').val();
            var kondisimasuk = $('#kondisimasuk').val();
            var carakeluar = $('#carakeluar').val();
            var tanggalkeluar = $('#tanggalkeluar').val();
            var kondisikeluar = $('#kondisikeluar').val();
            var jamkeluar = $('#jamkeluar').val();

			if (poliklinik == "" || poliklinik == null || dokter == "" || dokter == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {

					id: id,
					dokter: dokter,
					petugas: petugas,
					poliklinik: poliklinik,
					selesai: selesai,
					kondisimasuk: kondisimasuk,
					carakeluar: carakeluar,
					tanggalkeluar: tanggalkeluar,
					kondisikeluar: kondisikeluar,
					jamkeluar: jamkeluar,
				}
				$.ajax({
					url: '<?php echo base_url("eklinik/rawatjalan/datapasien/rawatjalan_act") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							success(res.remarks)
						} else {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Gagal, Coba lagi';
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					},
					timeout: 60000
				});
			}
		}
                function saveFisik() {
			var btn = document.getElementById("btnFisik");

			var noregistrasi = $('#noregistrasi').val();
            var tinggibadan = $('#f_tinggibadan').val();
            var beratbadan = $('#f_beratbadan').val();
            var detakjantung = $('#f_detakjantung').val();
            var tekanandarah = $('#f_tekanandarah').val();
            var suhubadan = $('#f_suhubadan').val();
            var nafas = $('#f_nafas').val();
            var keluhan = $('#f_keluhan').val();
            var riwayatpenyakit = $('#f_riwayatpenyakit').val();
            var riwayatpenyakitkeluarga = $('#f_riwayatpenyakitkeluarga').val();
            
			if (tinggibadan == "" || tinggibadan == null || beratbadan == "" || beratbadan == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					noregistrasi: noregistrasi,
					tinggibadan: tinggibadan,
					beratbadan: beratbadan,
					detakjantung: detakjantung,
					tekanandarah: tekanandarah,
					suhubadan: suhubadan,
					nafas: nafas,
					keluhan: keluhan,
					riwayatpenyakit: riwayatpenyakit,
					riwayatpenyakitkeluarga: riwayatpenyakitkeluarga,
				}
				$.ajax({
					url: '<?php echo base_url("eklinik/rawatjalan/datapasien/fisik_act") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							success(res.remarks)
						} else {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Gagal, Coba lagi';
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					},
					timeout: 60000
				});
			}
		}
                function saveSoap() {
			var btn = document.getElementById("btnSoap");

			var noregistrasi = $('#noregistrasi').val();
            var soap_tanggal = $('#soap_tanggal').val();
            var soap_keluhan = $('#soap_keluhan').val();
            var soap_pemeriksaan = $('#soap_pemeriksaan').val();
            var soap_kesimpulan = $('#soap_kesimpulan').val();
            var soap_rencana = $('#soap_rencana').val();
            
			if (soap_tanggal == "" || soap_tanggal == null || soap_keluhan == "" || soap_keluhan == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					noregistrasi: noregistrasi,
					soap_tanggal: soap_tanggal,
					soap_keluhan: soap_keluhan,
					soap_pemeriksaan: soap_pemeriksaan,
					soap_kesimpulan: soap_kesimpulan,
					soap_rencana: soap_rencana,
				}
				$.ajax({
					url: '<?php echo base_url("eklinik/rawatjalan/datapasien/soap_act") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							success(res.remarks)
						} else {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Gagal, Coba lagi';
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					},
					timeout: 60000
				});
			}
		}
                function savePenunjang() {
			var btn = document.getElementById("btnPenunjang");

			var noregistrasi = $('#noregistrasi').val();
            var penunjang_tanggalkunjungan = $('#penunjang_tanggalkunjungan').val();
            var penunjang_pemeriksaan = $('#penunjang_pemeriksaan').val();
            
			if (penunjang_tanggalkunjungan == "" || penunjang_tanggalkunjungan == null || penunjang_pemeriksaan == "" || penunjang_pemeriksaan == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					noregistrasi: noregistrasi,
					penunjang_tanggalkunjungan: penunjang_tanggalkunjungan,
					penunjang_pemeriksaan: penunjang_pemeriksaan,
				}
				$.ajax({
					url: '<?php echo base_url("eklinik/rawatjalan/datapasien/penunjang_act") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							success(res.remarks)
						} else {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Gagal, Coba lagi';
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					},
					timeout: 60000
				});
			}
		}
                function saveDiagnosaicdx() {
			var btn = document.getElementById("btnDiagnosaicdx");

			var noregistrasi = $('#noregistrasi').val();
            var icdx_diagnosa = $('#icdx_diagnosa').val();
            var icdx_jenis_diagnosa = $('#icdx_jenis_diagnosa').val();
            var icdx_kasus = $('#icdx_kasus').val();
            var icdx_keterangan = $('#icdx_keterangan').val();
            
			if (icdx_diagnosa == "" || icdx_diagnosa == null || icdx_jenis_diagnosa == "" || icdx_jenis_diagnosa == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					noregistrasi: noregistrasi,
					iddiagnosa: icdx_diagnosa,
					jenisdiagnosa: icdx_jenis_diagnosa,
					kasus: icdx_kasus,
					keterangan: icdx_keterangan,
				}
				$.ajax({
					url: '<?php echo base_url("eklinik/rawatjalan/datapasien/diagnosaidcx_act") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							success(res.remarks)
						} else {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Gagal, Coba lagi';
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					},
					timeout: 60000
				});
			}
		}
                function saveTindakan() {
			var btn = document.getElementById("btnTindakan");

			var noregistrasi = $('#noregistrasi').val();
            var tin_tindakan = $('#tin_tindakan').val();
            var tin_pelaksana = $('#tin_pelaksana').val();
            var tin_jumlah = $('#tin_jumlah').val();
            
			if (tin_tindakan == "" || tin_tindakan == null || tin_pelaksana == "" || tin_pelaksana == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					noregistrasi: noregistrasi,
					idtindakan: tin_tindakan,
					idpelaksana: tin_pelaksana,
					jumlah: tin_jumlah,
				}
				$.ajax({
					url: '<?php echo base_url("eklinik/rawatjalan/datapasien/tindakan_act") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							success(res.remarks)
						} else {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Gagal, Coba lagi';
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					},
					timeout: 60000
				});
			}
		}
                function saveBHP() {
			var btn = document.getElementById("btnBHP");

			var noregistrasi = $('#noregistrasi').val();
            var bhp_bhp = $('#bhp_bhp').val();
            var bhp_jumlah = $('#bhp_jumlah').val();
            var bhp_keterangan = $('#bhp_keterangan').val();
            
			if (tin_tindakan == "" || tin_tindakan == null || tin_pelaksana == "" || tin_pelaksana == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					noregistrasi: noregistrasi,
					idbhp: bhp_bhp,
					jumlah: bhp_jumlah,
					keterangan: bhp_keterangan,
				}
				$.ajax({
					url: '<?php echo base_url("eklinik/rawatjalan/datapasien/bhp_act") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							success(res.remarks)
						} else {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Gagal, Coba lagi';
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					},
					timeout: 60000
				});
			}
		}
                function saveResep() {
			var btn = document.getElementById("btnResep");

			var noregistrasi = $('#noregistrasi').val();
            var obat_obat = $('#obat_obat').val();
            var obat_jumlah = $('#obat_jumlah').val();
            var obat_aturan_pakai = $('#obat_aturan_pakai').val();
            var obat_waktupenggunaan = $('#obat_waktupenggunaan').val();
            var obat_carapenggunaan = $('#obat_carapenggunaan').val();
            
			if (tin_tindakan == "" || tin_tindakan == null || tin_pelaksana == "" || tin_pelaksana == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					noregistrasi: noregistrasi,
					idobat: obat_obat,
					jumlah: obat_jumlah,
					aturanpakai: obat_aturan_pakai,
					waktupenggunaan: obat_waktupenggunaan,
					carapenggunaan: obat_carapenggunaan,
				}
				$.ajax({
					url: '<?php echo base_url("eklinik/rawatjalan/datapasien/resep_act") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							success(res.remarks)
						} else {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Gagal, Coba lagi';
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					},
					timeout: 60000
				});
			}
		}
                function saveLab() {
			var btn = document.getElementById("btnLab");

			var noregistrasi = $('#noregistrasi').val();
            var datalab = new Array();
                    $("input:checked").each(function() {
                      datalab.push($(this).val());
                    });
            
			if (data == "" || data == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					noregistrasi: noregistrasi,
					datalab: datalab,
				}
				$.ajax({
					url: '<?php echo base_url("eklinik/rawatjalan/datapasien/lab_act") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							success(res.remarks)
						} else {
							btn.value = 'Save';
							btn.innerHTML = 'Save';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Gagal, Coba lagi';
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					},
					timeout: 60000
				});
			}
		}
                        function showSnackError(text) {
							iziToast.error({
								title: 'Info',
								message: text,
								position: 'topRight'
							});
						}
						function showSnackSuccess(text) {
							iziToast.success({
								title: 'Info',
								message: text,
								position: 'topRight'
							});
						}
						function success(text) {
							Swal.fire({
								title: 'Info',
								html: text,
								type: "success",
								confirmButtonText: 'Ok',
								confirmButtonColor: "#46b654",
							}).then((result) => {
								location.reload(true);
							})
						}
        </script>
    </div>
</body>

</html>