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
										<div class="col-md-12 row">
            <div class="col-md-6" style="padding-left: 60px;">
                <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Tgl. Registrasi </label>
                <div class="col-lg-8">
                    <input type="text" id="nama" class="form-control" name="nama" value="<?php echo (isset($tanggalregistrasi)) ? $tanggalregistrasi : ""; ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">No. Registrasi </label>
                <div class="col-lg-8">
                    <input type="text" id="nama" class="form-control" name="nama" value="<?php echo (isset($noregistrasi)) ? $noregistrasi : ""; ?>" readonly>
                </div>
            </div>
                <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Nama Dokter </label>
                <div class="col-lg-8">
                    <input type="text" id="nama" class="form-control" name="nama" value="<?php echo (isset($namadokter)) ? $namadokter : ""; ?>" readonly>
                </div>
            </div>
                <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">No. RM </label>
                <div class="col-lg-8">
                    <div class="input-group date" >
                        <input type="text" id="noregistrasi" class="form-control" name="noregistrasi" value="<?php echo (isset($norekammedik)) ? $norekammedik : ""; ?>" readonly >
                        <small id="pesan"></small>
                    </div>
                </div>
            </div>
                

        </div>
            <div class="col-md-6" style="padding-left: 60px;">
            <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Nama Pasien </label>
                <div class="col-lg-8">
                    <input type="text" id="nama" class="form-control" name="nama" value="<?php echo (isset($nama)) ? $nama : ""; ?>" readonly>
                </div>
            </div>
                <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Tgl. Lahir </label>
                <div class="col-lg-8">
                    <input type="text" id="nama" class="form-control" name="nama" value="<?php echo (isset($tanggallahir)) ? $tanggallahir : ""; ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Alamat</label>
                <div class="col-lg-8">
                    <input type="text" id="alamat" class="form-control" name="alamat" value="<?php echo (isset($alamat)) ? $alamat : ""; ?>" readonly>
                </div>
            </div>
                <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">No. Telp</label>
                <div class="col-lg-8">
                    <input type="text" id="alamat" class="form-control" name="alamat" value="<?php echo (isset($nomorhp)) ? $nomorhp : ""; ?>" readonly>
                </div>
            </div>
                <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Pembayaran</label>
                <div class="col-lg-8">
                    <input type="text" id="idpelayanan" class="form-control" name="idpelayanan" value="<?php echo (isset($idpelayanan)) ? $idpelayanan : ""; ?>" readonly>
                </div>
            </div>
        </div>
        </div>
        <br>
    
        <div class="col-md-12 row">
        <div class="col-md-8">
            <a href="<?php echo base_url(); ?>eklinik/cashier/datapasien/refreshrincian/<?php echo $noregistrasi;?>/<?php echo $idpenjamin;?>"><button type="button" id="submit" class="btn btn-warning pull-left"><i class="fa fa-check"></i> Reload Rincian</button></a>
        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Biaya</th>
                                    <th>Sub Total</th>
                                    <th>Jenis Bayar</th>
                                </tr>
                            </thead>
            <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>eklinik/cashier/datapasien/updaterincian_act/<?php echo $noregistrasi;?>" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <tbody>
                                <?php $totaltagihan = 0; $no = 1;foreach($getrincianpembayaran as $a){?>
                                <tr>
                                <?php if($a['level'] == '1'){?>
                                <td><?php echo $a['keterangan'];?></td>
                                     <td><?php echo $a['jumlah'];?></td>
                                <td><?php echo $a['biaya'];?></td>
                                <td></td>
                                <td></td>
                                <?php }else{?>
                                    
                        <td><?php echo "&nbsp&nbsp&nbsp - ".$a['keterangan'];?></td>
                        <td><input type="text" id="jumlah" class="form-control" name="jumlah<?php echo $a['id'];?>"  value="<?php echo $a['jumlah'];?>"></td>
                        <td><input type="text" id="biaya" class="form-control" name="biaya<?php echo $a['id'];?>"  value="<?php echo $a['biaya'];?>"></td>
                        <td><?php echo $a['jumlah'] * $a['biaya'];?></td>
                        <td><select id="idpenjamin"   class="form-control" name="idpenjamin<?php echo $a['id'];?>" >
                        <?php foreach ($getmasterpenjamin as $d) { ?>
                            <option value= "<?php echo $d['id'] ?>" <?php if($d['id']== $a['idpenjamin']){echo "selected";} ?> > <?php echo $d['namapenjamin']; ?> </option>
                        <?php } ?>
                        </select>
                        </td>
                                    
                                <?php } ?>
                                
                                </tr>
                                <?php $no++; $totaltagihan = $totaltagihan + ($a['jumlah'] * $a['biaya']);}?>
                                <tr><td colspan="5"><button type="submit" id="submit" class="btn btn-primary pull-left"><i class="fa fa-save"></i>Update Rincian</button></td></tr>
                            </tbody>
                </form>
                        </table>
        </div>
            
        <div class="col-md-4">
            <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>eklinik/cashier/datapasien/simpankwitanis_act/<?php echo $noregistrasi;?>" enctype="multipart/form-data" method="POST">	
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Kwitansi No. </label>
                <div class="col-lg-8">
                    <input type="text" id="nokwitansi" class="form-control" name="nokwitansi"  value="<?php echo (isset($nokwitansi)) ? $nokwitansi : ""; ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Total Tagihan </label>
                <div class="col-lg-8">
                    <input type="text" id="totaltagihan" class="form-control" name="totaltagihan"  value="<?php echo $totaltagihan; ?>" readonly>
                </div>
            </div>
            
                
                <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Diskon </label>
                <div class="col-lg-8">
                    <input type="text" id="diskon" class="form-control" name="diskon" oninput="myFunctiondiskon()"  value="<?php echo (isset($diskon)) ? $diskon : ""; ?>">                
                    </div>
            </div>
                <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Harus Dibayar </label>
                <div class="col-lg-8">
                    <input type="text" id="harusdibayar" class="form-control" name="harusdibayar" value="<?php echo $harusdibayar;?>">                
                    </div>
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Total Bayar </label>
                <div class="col-lg-8">
                    <input type="text" id="totalbayar" class="form-control" name="totalbayar" value="<?php echo $totalbayar; ?>" readonly>
                </div>
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Kembalian </label>
                <div class="col-lg-8">
                    <input type="text" id="kembalian" class="form-control" name="kembalian" value="<?php echo $kembalian; ?>">                  
                    </div>
            </div>
            <br>
            <br>
            <br>
                <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Cara Bayar </label>
                <div class="col-lg-8">
                    <select id="carabayar"   class="form-control js-source-states" name="carabayar" >
                        <option value="Cash">Cash</option>
                        <option value="Kartu Debit">Kartu Debit</option>
                        <option value="Kartu Kredit">Kartu Kredit</option>
                    </select>           
                    </div>
            </div>
                <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Pembayaran Pasien </label>
                <div class="col-lg-8">
                    <input type="text" id="totalbayarpasien" class="form-control" name="totalbayarpasien" oninput="myFunction()">                
                    </div>
            </div>
                
            <div class="form-group">
                <label style="text-align: left;" for="inputStandard" class="col-lg-4 control-label">Status Tagihan </label>
                <div class="col-lg-8">
                    <select id="statustagihan"   class="form-control js-source-states" name="statustagihan" >
                        <option value="Belum Bayar" <?php if($statustagihan == 'Belum Bayar'){echo "selected";}?> >Belum Bayar</option>
                        <option value="Belum Lunas" <?php if($statustagihan == 'Belum Lunas'){echo "selected";}?>>Belum Lunas</option>
                        <option value="Lunas" <?php if($statustagihan == 'Lunas'){echo "selected";}?>>Lunas</option>
                    </select>           
                    </div>
            </div>
            <div class="col-md-12">
            <hr>
            <button style="margin-right: 10px;" type="reset" class="btn btn-danger pull-left" onclick="self.history.back()"><i class="fa fa-reply"></i > Tutup</button>
            <button type="submit" id="submit" class="btn btn-success pull-left"><i class="fa fa-check"></i> Simpan</button>
            <a href="<?php echo base_url();?>pembayaran/cetakkwitansi/<?php echo $noregistrasi;?>" target="_blank"><button type="button" id="submit" class="btn btn-warning pull-left"><i class="fa fa-check"></i> Cetak Kwitansi</button></a>
        </div>
            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Cara Bayar</th>
                                    <th>Total Bayar</th>
                                </tr>
                            </thead>
                <tbody>
                    <?php foreach($getdatadetailbayar as $a){?>
                <tr>
                <td><?php echo $a['carabayar'];?></td>
                <td><?php echo $a['totalbayar'];?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </form>
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
<script>
    document.getElementById("harusdibayar").value = <?php echo $totaltagihan  - $diskon;?>;
    document.getElementById("kembalian").value = <?php echo $totalbayar  - $harusdibayar;?>;
function myFunctiondiskon() {
  var y = document.getElementById("totaltagihan").value;
  var z = document.getElementById("diskon").value;
   document.getElementById("harusdibayar").value = y - z;

}
  function myFunction() {
  var y = document.getElementById("totalbayar").value;
  var z = document.getElementById("harusdibayar").value;
   document.getElementById("kembalian").value = y - z;

}
</script>
    </div>
</body>

</html>