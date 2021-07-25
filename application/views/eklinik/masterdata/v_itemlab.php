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

                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <table class="table table-striped tree">
                                                <thead>
                <tr>
                    <th class="text-center">Nama Item</th>
                    <th class="text-center">Sat.</th>
                    <th class="text-center">Nilai Rujukan</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">#</th>
                </tr>
                </thead>
        <tbody>
        <?php foreach($getitem as $g){?>
            <?php if($g['level'] == 'KATEGORI'){?>
            <tr class="treegrid-<?php echo $g['id'];?>">
            <td><font size="2"><?php echo $g['nama_item'];?></font></td>
            <td></td>
            <td></td>
            <td></td>
            <td><a href="#" class="edit_record btn btn-warning btn-sm" onclick="tambahItem('<?=$g['id'];?>','KELOMPOK')">+ Kelompok</a></td>
            </tr> 
            <?php }else{ ?>
            <tr class="treegrid-<?php echo $g['id'];?> treegrid-parent-<?php echo $g['id_paren'];?>">
            <td><font size="2"><?php echo $g['nama_item'];?></font></td>
            <td><font size="2"><?php echo $g['satuan'];?></font></td>
            <td>
                <?php if($g['uraian'] != '' or $g['level'] == 'KELOMPOK' or $g['level'] == 'SUBKELOMPOK'){echo $g['uraian'];}else{?>                
                <font size="2">
                Pria : <?php echo $g['daripria'].'-'.$g['sampaipria'];?><br>
                Wanita : <?php echo $g['dariwanita'].'-'.$g['sampaiwanita'];?><br>
                Anak-anak : <?php echo $g['darianak'].'-'.$g['sampaianak'];?><br>
                </font>
                <?php } ?>
                </td>
            <td><?php echo $g['harga'];?></td>
            <td>
                <?php if($g['level'] == 'KELOMPOK'){?>
                <a href="#" class="edit_record btn btn-warning btn-sm" onclick="tambahItem('<?=$g['id'];?>','SUBKELOMPOK')">+ Sub Kelompok</a>
                <a href="#" class="edit_record btn btn-info btn-sm" onclick="editItem('<?=$g['id'];?>','KELOMPOK')">+ Edit</a>
                <a href="#" class="edit_record btn btn-danger btn-sm" onclick="deleteItem('<?=$g['id'];?>')">- Delete</a>
                       <?php } ?>
                    <?php if($g['level'] == 'SUBKELOMPOK'){?>
                    <a href="#" class="edit_record btn btn-warning btn-sm" onclick="tambahItem('<?=$g['id'];?>','ITEM')">+ Item</a>
                    <a href="#" class="edit_record btn btn-info btn-sm" onclick="editItem('<?=$g['id'];?>','SUBKELOMPOK')">+ Edit</a>
                <a href="#" class="edit_record btn btn-danger btn-sm" onclick="deleteItem('<?=$g['id'];?>')">- Delete</a>
                       <?php } ?>
                    <?php if($g['level'] == 'ITEM'){?>
                    <a href="#" class="edit_record btn btn-warning btn-sm" onclick="tambahItem('<?=$g['id'];?>','SUBITEM')">+ Sub Item</a>
                    <a href="#" class="edit_record btn btn-info btn-sm" onclick="editItem('<?=$g['id'];?>','ITEM')">+ Edit</a>
                <a href="#" class="edit_record btn btn-danger btn-sm" onclick="deleteItem('<?=$g['id'];?>')">- Delete</a>
                       <?php } ?>
                    <?php if($g['level'] == 'SUBITEM'){?>
                    <a href="#" class="edit_record btn btn-info btn-sm" onclick="editItem('<?=$g['id'];?>','SUBITEM')">+ Edit</a>
                <a href="#" class="edit_record btn btn-danger btn-sm" onclick="deleteItem('<?=$g['id'];?>')">- Delete</a>
                       <?php } ?>
                </td>
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
        <div class="modal fade" id="tambahItem" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="headermodalitem"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_paren" class="form-control">
                        <input type="hidden" id="level" class="form-control">
                        <div class="section-title" id="title_paren"></div>
                        <div class="form-group">
                            <input type="text" id="nama_paren" class="form-control" readonly>
                        </div>

                        <div class="section-title" id='title_child'></div>
                        <div class="form-group">
                            <input type="text" id="nama_item" class="form-control">
                        </div>
                        <div style="display:none;" id="itemcount">
                        <div class="section-title">Satuan</div>
                        <div class="form-group">
                            <input type="text" id="satuan" class="form-control">
                        </div>
                            <div class="section-title">Harga Satuan</div>
                        <div class="form-group">
                            <input type="text" id="harga" class="form-control">
                        </div>
                            <hr>
                        <div class="section-title">Nilai Rujukan Pria</div>
                        <div class="form-group row">

                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="daripria" value="">
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label m-b">S/D</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="sampaipria" value="">
                        </div>
                        </div>
                        <div class="section-title">Nilai Rujukan Wanita</div>
                        <div class="form-group row">

                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="dariwanita" value="">
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label m-b">S/D</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="sampaiwanita" value="">
                        </div>
                        </div>
                        <div class="section-title">Nilai Rujukan Anak-anak</div>
                        <div class="form-group row">

                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="darianak" value="">
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label m-b">S/D</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="sampaianak" value="">
                        </div>
                        </div>
                        
                        <div class="section-title">Uraian</div>
                        <div class="form-group">
                            <input type="text" id="uraian" class="form-control">
                        </div>
                        <div class="section-title">Jenis Input Hasil</div>
                        <div class="form-group">
                            <input type="text" id="input" class="form-control">
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-primary" type="button" id="btnItemBaru" onclick="return itemBaru()">
                                                            SIMPAN
                                                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
                    
        <div class="modal fade" id="editItem" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="headermodaledititem"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_item_edit" class="form-control">
                        <input type="hidden" id="level" class="form-control">
                        <div class="section-title" id="title_item"></div>
                        <div class="form-group">
                            <input type="text" id="nama_item_edit" class="form-control">
                        </div>
                        <div style="display:none;" id="itemcountedit">
                        <div class="section-title">Satuan</div>
                        <div class="form-group">
                            <input type="text" id="satuan_edit" class="form-control">
                        </div>
                            <div class="section-title">Harga Satuan</div>
                        <div class="form-group">
                            <input type="text" id="harga_edit" class="form-control">
                        </div>
                            <hr>
                        <div class="section-title">Nilai Rujukan Pria</div>
                        <div class="form-group row">

                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="daripria_edit" value="">
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label m-b">S/D</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="sampaipria_edit" value="">
                        </div>
                        </div>
                        <div class="section-title">Nilai Rujukan Wanita</div>
                        <div class="form-group row">

                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="dariwanita_edit" value="">
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label m-b">S/D</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="sampaiwanita_edit" value="">
                        </div>
                        </div>
                        <div class="section-title">Nilai Rujukan Anak-anak</div>
                        <div class="form-group row">

                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="darianak_edit" value="">
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label m-b">S/D</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control m-b" id="sampaianak_edit" value="">
                        </div>
                        </div>
                        
                        <div class="section-title">Uraian</div>
                        <div class="form-group">
                            <input type="text" id="uraian_edit" class="form-control">
                        </div>
                        <div class="section-title">Jenis Input Hasil</div>
                        <div class="form-group">
                            <input type="text" id="input_edit" class="form-control">
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-primary" type="button" id="btnItemEdit" onclick="return itemEdit()">
                                                            Update
                                                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>            
                    
        <div class="modal fade" id="deleteItem" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="headermodaldeleteitem"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_item" class="form-control">
                        <div class="section-title" id='infodeleteitem'></div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-primary" type="button" id="btnDeleteItem" onclick="return itemhapus()"> Hapus </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
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
             
             function tambahItem(id_paren,level){
                dataPost = {
                    id_paren : id_paren
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("eklinik/masterdata/getItem") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#id_paren').val(data[0]['id']);
                            $('#nama_paren').val(data[0]['nama_item']);
                            $('#level').val(level);
                            if(level == 'KELOMPOK'){
                               document.getElementById("headermodalitem").innerHTML = "TAMBAH KELOMPOK";
                               document.getElementById("title_paren").innerHTML = "NAMA KATEGORI";
                               document.getElementById("title_child").innerHTML = "NAMA KELOMPOK";
                                $('#itemcount').hide();
                            }
                            if(level == 'SUBKELOMPOK'){
                               document.getElementById("headermodalitem").innerHTML = "TAMBAH SUB KELOMPOK";
                               document.getElementById("title_paren").innerHTML = "NAMA KELOMPOK";
                               document.getElementById("title_child").innerHTML = "NAMA SUB KELOMPOK";
                                $('#itemcount').hide();
                            }
                            if(level == 'ITEM'){
                               document.getElementById("headermodalitem").innerHTML = "TAMBAH ITEM";
                               document.getElementById("title_paren").innerHTML = "NAMA SUB KELOMPOK";
                               document.getElementById("title_child").innerHTML = "NAMA ITEM";
                                $('#itemcount').show();
                            }
                            if(level == 'SUBITEM'){
                               document.getElementById("headermodalitem").innerHTML = "TAMBAH SUB ITEM";
                               document.getElementById("title_paren").innerHTML = "NAMA ITEM";
                               document.getElementById("title_child").innerHTML = "NAMA SUB ITEM";
                                $('#itemcount').show();
                            }
                            dismisLoading();
                            $("#tambahItem").modal();
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
             function editItem(id_item,level){
                 document.getElementById("headermodaledititem").innerHTML = "";
                dataPost = {
                    id_paren : id_item
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("eklinik/masterdata/getItem") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#id_item_edit').val(data[0]['id']);
                            $('#nama_item_edit').val(data[0]['nama_item']);
                            $('#satuan_edit').val(data[0]['satuan']);
                            $('#harga_edit').val(data[0]['harga']);
                            $('#daripria_edit').val(data[0]['daripria']);
                            $('#sampaipria_edit').val(data[0]['sampaipria']);
                            $('#dariwanita_edit').val(data[0]['dariwanita']);
                            $('#sampaiwanita_edit').val(data[0]['sampaiwanita']);
                            $('#darianak_edit').val(data[0]['darianak']);
                            $('#sampaianak_edit').val(data[0]['sampaianak']);
                            $('#uraian_edit').val(data[0]['uraian']);
                            $('#input_edit').val(data[0]['input']);
                            $('#level').val(level);
                            if(level == 'KELOMPOK'){
                               document.getElementById("headermodaledititem").innerHTML = "EDIT " + data[0]['nama_item'];
                               document.getElementById("title_child").innerHTML = "NAMA KELOMPOK";
                                $('#itemcountedit').hide();
                            }
                            if(level == 'SUBKELOMPOK'){
                               document.getElementById("headermodaledititem").innerHTML = "EDIT " + data[0]['nama_item'];
                               document.getElementById("title_child").innerHTML = "NAMA SUB KELOMPOK";
                                $('#itemcountedit').hide();
                            }
                            if(level == 'ITEM'){
                               document.getElementById("headermodaledititem").innerHTML = "EDIT " + data[0]['nama_item'];
                               document.getElementById("title_child").innerHTML = "NAMA ITEM";
                                $('#itemcountedit').show();
                            }
                            if(level == 'SUBITEM'){
                               document.getElementById("headermodaledititem").innerHTML = "EDIT " + data[0]['nama_item'];
                               document.getElementById("title_child").innerHTML = "NAMA SUB ITEM";
                                $('#itemcountedit').show();
                            }
                            
                            dismisLoading();
                            $("#editItem").modal();
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
             function deleteItem(id_item){
                dataPost = {
                    id_paren : id_item
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("eklinik/masterdata/getItem") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#id_item').val(data[0]['id']);
                            $('#nama_paren').val(data[0]['nama_item']);
                            
                            document.getElementById("headermodaldeleteitem").innerHTML = "Hapus Item " + data[0]['nama_item'];
                            document.getElementById("infodeleteitem").innerHTML = "Anda Yakin Untuk Menghapus Data Ini : " + data[0]['nama_item'] + " ?";
                          
                            dismisLoading();
                            $("#deleteItem").modal();
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
             
             function itemBaru(){
                var btn = document.getElementById("btnItemBaru");
                var id_paren = $('#id_paren').val();
                var nama_item = $('#nama_item').val();
                var level = $('#level').val();
                var satuan = $('#satuan').val();
                var harga = $('#harga').val();
                var uraian = $('#uraian').val();
                var input = $('#input').val();
                var daripria = $('#daripria').val();
                var sampaipria = $('#sampaipria').val();
                 var dariwanita = $('#dariwanita').val();
                var sampaiwanita = $('#sampaiwanita').val();
                 var darianak = $('#darianak').val();
                var sampaianak = $('#sampaianak').val();
                 
                if(nama_item == "" || nama_item == null){
                    showSnackError("Harap isi");
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        id_paren : id_paren,
                        nama_item : nama_item,
                        level : level,
                        satuan : satuan,
                        harga : harga,
                        uraian : uraian,
                        input : input,
                        daripria : daripria,
                        sampaipria : sampaipria,
                        dariwanita : dariwanita,
                        sampaiwanita : sampaiwanita,
                        darianak : darianak,
                        sampaianak : sampaianak,
                    }
                    $.ajax({
                        url: '<?php echo base_url("eklinik/masterdata/addItem") ?>',
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
             function itemEdit(){
                var btn = document.getElementById("btnItemEdit");
                var id_item = $('#id_item_edit').val();
                var nama_item = $('#nama_item_edit').val();
                var satuan = $('#satuan_edit').val();
                var harga = $('#harga_edit').val();
                var uraian = $('#uraian_edit').val();
                var input = $('#input_edit').val();
                var daripria = $('#daripria_edit').val();
                var sampaipria = $('#sampaipria_edit').val();
                 var dariwanita = $('#dariwanita_edit').val();
                var sampaiwanita = $('#sampaiwanita_edit').val();
                 var darianak = $('#darianak_edit').val();
                var sampaianak = $('#sampaianak_edit').val();
                 
                if(nama_item == "" || nama_item == null){
                    showSnackError("Harap isi");
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        id_item : id_item,
                        nama_item : nama_item,
                        satuan : satuan,
                        harga : harga,
                        uraian : uraian,
                        input : input,
                        daripria : daripria,
                        sampaipria : sampaipria,
                        dariwanita : dariwanita,
                        sampaiwanita : sampaiwanita,
                        darianak : darianak,
                        sampaianak : sampaianak,
                    }
                    $.ajax({
                        url: '<?php echo base_url("eklinik/masterdata/editItem") ?>',
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
             function itemhapus(){
                var btn = document.getElementById("btnDeleteItem");
                var id_item = $('#id_item').val();
                 
                
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        id_item : id_item,
                    }
                    $.ajax({
                        url: '<?php echo base_url("eklinik/masterdata/deleteItem") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks)
                            }else{
                                btn.value = 'Gagal, Coba lagi';
                            btn.innerHTML = 'Gagal, Coba lagi';
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
            