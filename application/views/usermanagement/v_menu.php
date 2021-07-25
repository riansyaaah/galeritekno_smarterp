<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title><?=$title;?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/datatables.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css');?>">
        <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico');?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>">
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
                                    <h4><?=$title;?></h4>  <button type="button" onclick="collapse()" class="btn btn-info pull-right" data-toggle="collapse" data-target="#demo"><i class="fa fa-angle-down" id="angle"></i></button>
                                    <hr>
                                </div>
                                <div class="card-body collapse" id="demo" >
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="section-title">Tambah Applikasi</div>
                                            <div class="form-group">
                                                <div class="input-group mb-3 row">
                                                    <div class="col-sm-6">
                                                        <input type="text" id="nama_aplikasi" class="form-control" placeholder="Nama Aplikasi">
                                                    </div>
                                                    <input type="file" name="uploadfile" id="icon" class="form-control"/>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" id="btnAppBaru" onclick="return appBaru()">
                                                            SIMPAN
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="section-title">Tambah Modul Baru</div>
                                            <div class="form-group">
                                                <div class="input-group mb-3 row">
                                                    <div class="col-sm-4">
                                                        <select id="select_app" class="form-control select2" style="width:100%">
                                                            <?php foreach($applications as $app){?>
                                                            <option value="<?=$app['application_id'];?>"><?=$app['nama_aplikasi'];?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="number" id="no_urut" class="form-control" placeholder="URUT">
                                                    </div>
                                                    <input type="text" id="nama_modul" class="form-control" placeholder="NAMA MODUL">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" id="btnModulBaru" onclick="return modulBaru()">
                                                            SIMPAN
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="section-title">Tambah Menu Baru</div>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <select id="select_modul" class="form-control select2" style="width:75%">
                                                        <?php foreach($modules as $module){?>
                                                        <option value="<?=$module['modul_id'];?>">[<?=$module['nama_aplikasi'];?>] <?=$module['nama_modul'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-info" type="button" id="btnMenuBaru" onclick="menuBaru()">
                                                            PILIH
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-menu">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Appl - Modul</th>
                                                    <th>Menu</th>
                                                    <th>URL</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($moduleDetails as $moduleDetail){?>
                                                <tr>
                                                    <td> <?=$moduleDetail['modul_detail_id'];?> </td>
                                                    <td> 
                                                            
                                                            <?php if($moduleDetail['a_active'] == 1){?>
                                                                <a href="#" onclick="editApp('<?=$moduleDetail['application_id'];?>')">
                                                                    <div style="margin-bottom:2px;" class="badge badge-info badge-shadow">
                                                                        <img src="<?php echo base_url('assets/images/iconapps/'.$moduleDetail['a_icon']); ?>" 
                                                                            class="img-responsive" width="20" height="20"/>
                                                                        <?=$moduleDetail['nama_aplikasi'];?>
                                                                    </div>
                                                                </a>
                                                            <?php }else{?>
                                                                <a href="#" onclick="editApp('<?=$moduleDetail['application_id'];?>')">
                                                                    <div style="margin-bottom:2px;" class="badge badge-danger badge-shadow">
                                                                        <img src="<?php echo base_url('assets/images/iconapps/'.$moduleDetail['a_icon']); ?>" 
                                                                            class="img-responsive" width="20" height="20"/>
                                                                        <?=$moduleDetail['nama_aplikasi'];?>
                                                                    </div>
                                                                </a>
                                                            <?php } ?>
                                                            <br>

                                                            <?php if($moduleDetail['a_active'] == 0){?>
                                                                <a href="#" onclick="editModule('<?=$moduleDetail['modul_id'];?>')">
                                                                    <div class="badge badge-danger badge-shadow"><?=$moduleDetail['nama_modul'];?></div>
                                                                </a>
                                                                <?php }else{if($moduleDetail['m_active'] == 1){?>
                                                                <a href="#" onclick="editModule('<?=$moduleDetail['modul_id'];?>')">
                                                                    <div class="badge badge-info badge-shadow"><?=$moduleDetail['nama_modul'];?></div>
                                                                </a>
                                                                <?php }else{?>
                                                                <a href="#" onclick="editModule('<?=$moduleDetail['modul_id'];?>')">
                                                                    <div class="badge badge-danger badge-shadow"><?=$moduleDetail['nama_modul'];?></div>
                                                                </a>
                                                            <?php }} ?>
                                                      
                                                    </td>
                                                    <td> <?=$moduleDetail['nama_modul_detail'];?> </td>
                                                    <td> <?=$moduleDetail['url'];?></td>
                                                    <td class="text-center">
                                                        <?php if($moduleDetail['a_active'] == 0 OR $moduleDetail['m_active'] == 0){?>
                                                            <div class="badge badge-danger badge-shadow">Tidak Aktif</div>
                                                        <?php }else{if($moduleDetail['md_active'] == 1){?>
                                                                <div class="badge badge-success badge-shadow">Aktif</div>
                                                            <?php }else{?>
                                                                <div class="badge badge-danger badge-shadow">Tidak Aktif</div>
                                                        <?php }} ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="btn btn-primary" onclick="editMenu('<?=$moduleDetail['modul_detail_id'];?>')">Detail</a>
                                                    </td>
                                                </tr>
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

        <div class="modal fade" id="modalMenuBaru" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="menu_baru_modul_id" class="form-control">
                        <div class="section-title">Nama Menu</div>
                        <div class="form-group">
                            <input type="text" id="menu_baru_nama_menu" class="form-control">
                        </div>
                        <div class="section-title">URL</div>
                        <div class="form-group">
                            <input type="text" id="menu_baru_url" class="form-control">
                        </div>
                     </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-primary" onclick="saveMenuBaru()" id="btnSaveMenuBaru">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModule" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Modul</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_modul_id" class="form-control">
                        <div class="section-title">Aplikasi</div>
                        <div class="form-group">
                            <select id="select_app_modul_edit" class="form-control select2" style="width:100%">
                                <?php foreach($applications as $app){?>
                                <option value="<?=$app['application_id'];?>"><?=$app['nama_aplikasi'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="section-title">Nama Modul</div>
                        <div class="form-group">
                            <input type="text" id="edit_nama_modul" class="form-control">
                        </div>

                        <div class="section-title">No Urut</div>
                        <div class="form-group">
                            <input type="number" id="edit_no_urut" style="width:50%" class="form-control">
                        </div>

                        <div class="section-title">Icon</div>
                        <div class="form-group">
                            <input type="text" id="edit_icon" class="form-control">
                        </div>

                        <div class="section-title">Set Aktif</div>
                        <div class="form-group">
                            <label class="custom-switch">
                                <input type="checkbox" onclick="changeAktifModule()" onchange="changeAktifModule()" name="custom-switch-checkbox" id="edit_m_is_active" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description" id="label_m_is_active"></span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-primary" onclick="saveEditModule()" id="btnEditModule">Edit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editMenu" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_modul_detail_id" class="form-control">
                        <div class="section-title">Modul</div>
                        <div class="form-group">
                            <select id="edit_nama_modul_menu" class="form-control select2" style="width:75%">
                                <?php foreach($modules as $module){?>
                                <option value="<?=$module['modul_id'];?>">[<?=$module['nama_aplikasi'];?>] <?=$module['nama_modul'];?></option>
                                <?php } ?>
                            </select>
                            <!-- <input type="text" id="edit_nama_modul_menu" class="form-control" readonly> -->
                        </div>
                        <div class="section-title">Nama Menu</div>
                        <div class="form-group">
                            <input type="text" id="edit_nama_modul_detail" class="form-control">
                        </div>

                        <div class="section-title">URL</div>
                        <div class="form-group">
                            <input type="text" id="edit_url" class="form-control">
                        </div>

                        <div class="section-title">Set Aktif</div>
                        <div class="form-group">
                            <label class="custom-switch">
                                <input type="checkbox" onclick="changeAktifMenu()" onchange="changeAktifMenu()" name="custom-switch-checkbox" id="edit_md_is_active" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description" id="label_md_is_active"></span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <div class="pull-left">
                            <button type="button" class="btn btn-danger pull-left" onclick="saveDeleteMenu()" id="btnDeleteMenu">Hapus</button>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" onclick="saveEditMenu()" id="btnEditMenu">Edit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editApp" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Applikasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_application_id" class="form-control">
                        <div class="section-title">Nama Aplikasi</div>
                        <div class="form-group">
                            <input type="text" id="edit_nama_aplikasi" class="form-control">
                        </div>

                        <div class="section-title">Icon</div>
                        <div class="form-group">
                            <input type="file" id="edit_a_icon" class="form-control"><br>
                            <img id="show_a_icon" src="#" class="img-responsive" width="300">
                        </div>

                        <div class="section-title">Set Aktif</div>
                        <div class="form-group">
                            <label class="custom-switch">
                                <input type="checkbox" onclick="changeAktifApp()" onchange="changeAktifApp()" name="custom-switch-checkbox" id="edit_a_is_active" class="custom-switch-input">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description" id="label_a_is_active"></span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-primary" onclick="saveEditApp()" id="btnEditApp">Edit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
                    
        <script src="<?php echo base_url('assets/template/js/app.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/datatables.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/scripts.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/custom.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/toastr.js');?>"></script>

        <script>
            $(document).ready(function() {
                $("#table-menu").dataTable({
                });
                var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                $.ajaxSetup({
                    data: csfrData
                });
            });

            var angle = 1;

            function collapse(){
                if(angle == 0){
                    document.getElementById("angle").className = "fa fa-angle-down";
                    angle = 1;
                }else{
                    document.getElementById("angle").className = "fa fa-angle-up";
                    angle = 0;
                }
            }

            function modulBaru(){
                var btn = document.getElementById("btnModulBaru");
                var application_id = $('#select_app').val();
                var no_urut = $('#no_urut').val();
                var nama_modul = $('#nama_modul').val();
                if(no_urut == "" || no_urut == null){
                    showSnackError("Harap isi nomor urut");
                }else if(nama_modul == "" || nama_modul == null){
                    showSnackError("Harap isi nama modul");
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        application_id : application_id,
                        no_urut : no_urut,
                        nama_modul : nama_modul
                    }
                    
                    $.ajax({
                        url: '<?php echo base_url("usermanagement/menu/addModul") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks)
                            }else{
                                btn.value = 'SIMPAN';
                                btn.innerHTML = 'SIMPAN';
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

            function appBaru(){
                var icon = document.getElementById("icon").files[0];
                var nama_aplikasi = $('#nama_aplikasi').val();
                if(nama_aplikasi == "" || nama_aplikasi == null){
                    showSnackError("Harap isi nama aplikasi");
                }else if(icon == undefined || icon == null){
                    showSnackError("Harap upload icon aplikasi");
                }else{
                    var btn = document.getElementById("btnAppBaru");
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    var formData = new FormData();
                    formData.append('icon', icon);
                    formData.append('nama_aplikasi', nama_aplikasi);
                    formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
                    
                    $.ajax({
                        url: '<?php echo base_url("usermanagement/menu/addAplikasi") ?>',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks)
                            }else{
                                btn.value = 'SIMPAN';
                                btn.innerHTML = 'SIMPAN';
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

            function menuBaru(){
                $("#modalMenuBaru").modal();
                var modul_id = $('#select_modul option:selected').val();
                var nama_modul = $('#select_modul option:selected').text();
                var title = document.getElementById("exampleModalCenterTitle");
                title.innerHTML = nama_modul;
                $('#menu_baru_modul_id').val(modul_id);
            }

            function saveMenuBaru(){
                var btn = document.getElementById("btnSaveMenuBaru");
                btn.value = 'Loading...';
                btn.innerHTML = 'Loading...';
                btn.disabled = true;
                var nama_modul_detail = $('#menu_baru_nama_menu').val();
                var url = $('#menu_baru_url').val();
                var modul_id = $('#menu_baru_modul_id').val();
                
                if(nama_modul_detail == "" || nama_modul_detail == null){
                    showSnackError("Harap isi nama menu");
                    btn.value = 'Simpan';
                    btn.innerHTML = 'Simpan';
                    btn.disabled = false;
                }else if(nama_modul == "" || nama_modul == null){
                    showSnackError("Harap isi URL");
                    btn.value = 'Simpan';
                    btn.innerHTML = 'Simpan';
                    btn.disabled = false;
                }else{
                    dataPost = {
                        modul_id : modul_id,
                        nama_modul_detail : nama_modul_detail,
                        url : url
                    }
                    
                    $.ajax({
                        url: '<?php echo base_url("usermanagement/menu/addMenu") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks)
                            }else{
                                btn.value = 'Simpan';
                                btn.innerHTML = 'Simpan';
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

            function editApp(application_id){
                dataPost = {
                    application_id : application_id
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("usermanagement/menu/getSingleApp") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#edit_application_id').val(data.application_id);
                            $('#edit_nama_aplikasi').val(data.nama_aplikasi);
                            var baseUrl = "<?php echo base_url("assets/images/iconapps");?>"
                            $("#show_a_icon").attr("src", baseUrl+"/"+data.icon);
                            if(data.is_active == 1){
                                document.getElementById("edit_a_is_active").checked = true;
                                document.getElementById("label_a_is_active").innerHTML = "Aktif";
                            }else{
                                document.getElementById("edit_a_is_active").checked = false;
                                document.getElementById("label_a_is_active").innerHTML = "Tidak Aktif";
                            }
                            
                            dismisLoading();
                            $("#editApp").modal();
                        }else{
                            showSnackError(res.remarks);
                            dismisLoading();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        showSnackError(XMLHttpRequest);
                        dismisLoading();
                    },
                    timeout: 60000 
                });
            }

            function editModule(modul_id){
                dataPost = {
                    modul_id : modul_id
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("usermanagement/menu/getSingleModule") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#edit_modul_id').val(data.modul_id);
                            $('#edit_nama_modul').val(data.nama_modul);
                            $('#edit_no_urut').val(data.no_urut);
                            $('#edit_icon').val(data.icon);
                            $("#select_app_modul_edit").select2().val(data.application_id).trigger('change.select2');
                            if(data.is_active == 1){
                                document.getElementById("edit_m_is_active").checked = true;
                                document.getElementById("label_m_is_active").innerHTML = "Aktif";
                            }else{
                                document.getElementById("edit_m_is_active").checked = false;
                                document.getElementById("label_m_is_active").innerHTML = "Tidak Aktif";
                            }
                            
                            dismisLoading();
                            $("#editModule").modal();
                        }else{
                            showSnackError(res.remarks);
                            dismisLoading();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        showSnackError(XMLHttpRequest);
                        dismisLoading();
                    },
                    timeout: 60000 
                });
            }

            function editMenu(modul_detail_id){
                dataPost = {
                    modul_detail_id : modul_detail_id
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("usermanagement/menu/getSingleMenu") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#edit_modul_detail_id').val(data.modul_detail_id);
                            // $('#edit_nama_modul_menu').val(data.nama_modul + " " + data.nama_aplikasi);
                            // $('#edit_nama_modul_menu').select2('data', {id: data.modul_id, text: data.nama_modul + " " + data.nama_aplikasi});
                            $("#edit_nama_modul_menu").val(data.modul_id).trigger('change');
                            $('#edit_nama_modul_detail').val(data.nama_modul_detail);
                            $('#edit_url').val(data.url);
                            if(data.is_active == 1){
                                document.getElementById("edit_md_is_active").checked = true;
                                document.getElementById("label_md_is_active").innerHTML = "Aktif";
                            }else{
                                document.getElementById("edit_md_is_active").checked = false;
                                document.getElementById("label_md_is_active").innerHTML = "Tidak Aktif";
                            }
                            
                            dismisLoading();
                            $("#editMenu").modal();
                        }else{
                            showSnackError(res.remarks);
                            dismisLoading();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        showSnackError(XMLHttpRequest);
                        dismisLoading();
                    },
                    timeout: 60000 
                });
            }

            function changeAktifModule(){
                if (document.getElementById('edit_m_is_active').checked) {
                    document.getElementById("label_m_is_active").innerHTML = "Aktif";
                } else {
                    document.getElementById("label_m_is_active").innerHTML = "Tidak Aktif";
                }
            }

            function changeAktifMenu(){
                if (document.getElementById('edit_md_is_active').checked) {
                    document.getElementById("label_md_is_active").innerHTML = "Aktif";
                } else {
                    document.getElementById("label_md_is_active").innerHTML = "Tidak Aktif";
                }
            }

            function changeAktifApp(){
                if (document.getElementById('edit_a_is_active').checked) {
                    document.getElementById("label_a_is_active").innerHTML = "Aktif";
                } else {
                    document.getElementById("label_a_is_active").innerHTML = "Tidak Aktif";
                }
            }

            function saveEditApp(){
                var icon = document.getElementById("edit_a_icon").files[0];
                var application_id = $('#edit_application_id').val();
                var nama_aplikasi = $('#edit_nama_aplikasi').val();
                if (document.getElementById('edit_a_is_active').checked) {
                    var is_active = 1;
                } else {
                    var is_active = 0;
                }
                if(nama_aplikasi == "" || nama_aplikasi == null){
                    showSnackError("Harap isi nama aplikasi");
                }else{
                    var btn = document.getElementById("btnAppBaru");
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    var formData = new FormData();
                    formData.append('application_id', application_id);
                    if(icon == undefined || icon == null){
                        formData.append('is_upload', 0);
                    }else{
                        formData.append('is_upload', 1);
                        formData.append('icon', icon);
                    }
                    formData.append('is_active', is_active);
                    formData.append('nama_aplikasi', nama_aplikasi);
                    formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
                    
                    $.ajax({
                        url: '<?php echo base_url("usermanagement/menu/editAplikasi") ?>',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks)
                            }else{
                                btn.value = 'Edit';
                                btn.innerHTML = 'Edit';
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

            function saveEditModule(){
                var application_id = $('#select_app_modul_edit').val();
                var modul_id = $('#edit_modul_id').val();
                var no_urut = $('#edit_no_urut').val();
                var nama_modul = $('#edit_nama_modul').val();
                var icon = $('#edit_icon').val();
                if (document.getElementById('edit_m_is_active').checked) {
                    var is_active = 1;
                } else {
                    var is_active = 0;
                }
                
                if(modul_id == "" || modul_id == null){
                    showSnackError("Harap isi Modul ID");
                }else if(no_urut == "" || no_urut == null){
                    showSnackError("Harap isi no urut");
                }else if(nama_modul == "" || nama_modul == null){
                    showSnackError("Harap isi nama modul");
                }else if(icon == "" || icon == null){
                    showSnackError("Harap isi icon");
                }else{
                    showLoading();
                    var btn = document.getElementById("btnEditModule");
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        modul_id : modul_id,
                        application_id : application_id,
                        no_urut : no_urut,
                        nama_modul : nama_modul,
                        icon : icon,
                        is_active : is_active
                    }
                    
                    $.ajax({
                        url: '<?php echo base_url("usermanagement/menu/editModul") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks);
                            }else{
                                btn.value = 'Edit';
                                btn.innerHTML = 'Edit';
                                btn.disabled = false;
                                showSnackError(res.remarks);
                                dismisLoading();
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                            dismisLoading();
                            btn.value = 'Gagal, Coba lagi';
                            btn.innerHTML = 'Gagal, Coba lagi';
                            btn.disabled = false;
                        },
                        timeout: 60000 
                    });
                }
            }

            function saveEditMenu(){
                var modul_id = $('#edit_nama_modul_menu').val();
                var modul_detail_id = $('#edit_modul_detail_id').val();
                var nama_modul_detail = $('#edit_nama_modul_detail').val();
                var url = $('#edit_url').val();
                if (document.getElementById('edit_md_is_active').checked) {
                    var is_active = 1;
                } else {
                    var is_active = 0;
                }
                
                if(modul_detail_id == "" || modul_detail_id == null){
                    showSnackError("Harap isi Menu ID");
                }else if(nama_modul_detail == "" || nama_modul_detail == null){
                    showSnackError("Harap isi Nama Menu");
                }else if(url == "" || url == null){
                    showSnackError("Harap isi URL");
                }else{
                    showLoading();
                    var btn = document.getElementById("btnEditMenu");
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        modul_id : modul_id,
                        modul_detail_id : modul_detail_id,
                        nama_modul_detail : nama_modul_detail,
                        url : url,
                        is_active : is_active
                    }
                    
                    $.ajax({
                        url: '<?php echo base_url("usermanagement/menu/editMenu") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks);
                            }else{
                                btn.value = 'Delete';
                                btn.innerHTML = 'Delete';
                                btn.disabled = false;
                                showSnackError(res.remarks);
                                dismisLoading();
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                            dismisLoading();
                            btn.value = 'Gagal, Coba lagi';
                            btn.innerHTML = 'Gagal, Coba lagi';
                            btn.disabled = false;
                        },
                        timeout: 60000 
                    });
                }
            }

            function saveDeleteMenu(){
                var modul_detail_id = $('#edit_modul_detail_id').val();
                if(modul_detail_id == "" || modul_detail_id == null){
                    showSnackError("Harap isi Menu ID");
                }else{
                    showLoading();
                    var btn = document.getElementById("btnDeleteMenu");
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        modul_detail_id : modul_detail_id
                    }
                    
                    $.ajax({
                        url: '<?php echo base_url("usermanagement/menu/deleteMenu") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks);
                            }else{
                                btn.value = 'Edit';
                                btn.innerHTML = 'Edit';
                                btn.disabled = false;
                                showSnackError(res.remarks);
                                dismisLoading();
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                            dismisLoading();
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