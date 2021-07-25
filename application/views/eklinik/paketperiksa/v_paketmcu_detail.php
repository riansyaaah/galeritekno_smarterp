<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title><?=$title;?></title>
       <link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css');?>">
        <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico');?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/jquery.treegrid.css');?>">
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
                                <div class="card">
                                    <div class="card-header">
                                        <h4><?=$title;?></h4>
                                        <hr>
                                    </div>
                                    <div class="card-body row">
									<div class="col-lg-6">

										<div class="form-group row">
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Nama Paket:</label>
											<div class="col-sm-9">
												<div class="input-group">
													<input class="form-control form-control-sm" id="paketmcu_id" type="hidden" value="<?php echo $paketmcu_id;?>">
													<input class="form-control form-control-sm" id="namapaket" type="text" value="<?php echo $namapaket;?>">
												</div>

											</div>

											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Keterangan:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="keterangan" type="text" value="<?php echo $keterangan;?>">
											</div>

											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Harga Umum:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="hargaumum" type="text" value="<?php echo $hargaumum;?>">
											</div>

											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Harga Corprate:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="hargacorporate" type="text" value="<?php echo $hargacorporate;?>">
											</div>
										</div>

									</div>
									<!--end col-->
									
									<!--end col-->
								</div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <button class="btn btn-primary" type="button" id="btnItemBaru" onclick="return save()">SAVE</button>
                                        <table class="table table-striped tree">
                                                <thead>
                <tr>
                    <th class="text-center">Nama Item</th>
                </tr>
                </thead>
        <tbody>
        <?php foreach($getitem as $g){?>
            <?php if($g['level'] == 'KATEGORI'){?>
            <tr class="treegrid-<?php echo str_replace('.','_',$g['id']);?>">
            <td><input name="iddetail[]" type="checkbox" <?php if(intval($g['iddetail']) > 0){echo "checked";}?> value="<?php echo $g['id'];?>">&nbsp;&nbsp;&nbsp;<font size="2"><?php echo $g['nama_item'];?></font></td>
            </tr> 
            <?php }else{ ?>
            <tr class="treegrid-<?php echo str_replace('.','_',$g['id']);?> treegrid-parent-<?php echo str_replace('.','_',$g['id_paren']);?>">
            <td><input name="iddetail[]" type="checkbox" <?php if(intval($g['iddetail']) > 0){echo "checked";}?> value="<?php echo $g['id'];?>">&nbsp;&nbsp;&nbsp;<font size="2"><?php echo $g['nama_item'];?></font></td>
            
            </tr>
            <?php } ?>
            <?php } ?>
        </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <section>
                </div>
                <?php $this->load->view('layout/v_footer');?>
            </div>
                     
        <script src="<?php echo base_url('assets/template/js/app.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js');?>"></script>
         <script src="<?php echo base_url('assets/template/js/scripts.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/custom.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/toastr.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/jquery.treegrid.js');?>"></script>
        
         <script type="text/javascript">

            $(document).ready(function() {
                var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                $.ajaxSetup({
                    data: csfrData
                });
                
                $('.tree').treegrid({
                    expanderExpandedClass: 'fa fa-minus',
                    expanderCollapsedClass: 'fa fa-plus'
        });
               
                
            });
             function save(){
                var btn = document.getElementById("btnItemBaru");
                var data = new Array();
                    $("input:checked").each(function() {
                      data.push($(this).val());
                    });
                var paketmcu_id = $('#paketmcu_id').val();
                var namapaket = $('#namapaket').val();
                var keterangan = $('#keterangan').val();
                var hargaumum = $('#hargaumum').val();
                var hargacorporate = $('#hargacorporate').val();
                 
                if(data == "" || data == null){
                    showSnackError("Harap isi Code");
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        data : data,
                        paketmcu_id : paketmcu_id,
                        namapaket : namapaket,
                        keterangan : keterangan,
                        hargaumum : hargaumum,
                        hargacorporate : hargacorporate,
                    }
                    $.ajax({
                        url: '<?php echo base_url("eklinik/paketperiksa/paketmcu/savePaketmcudetail") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks)
                            }else{
                                btn.value = 'SAVE';
                                btn.innerHTML = 'SAVE';
                                btn.disabled = false;
                                showSnackError(res.remarks);
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                            btn.value = 'Gagal, Coba lagi';
                            btn.innerHTML = 'Gagal, Coba lagi';
                            btn.disabled = false;
                        },
                        timeout: 60000 
                    });
                }
            }
            function showSnackSuccess(text){
                iziToast.success({
                    title: 'Info',
                    message: text,
                    position: 'topRight'
                });
            }

            function showSnackError(text){
                iziToast.error({
                    title: 'Info',
                    message: text,
                    position: 'topRight'
                });
            }

            function success(text){
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
    </body>
</html>
            