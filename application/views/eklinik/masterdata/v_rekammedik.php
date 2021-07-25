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
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css');?>">
        <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico');?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>">
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
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            <?=$title;?>
                                            <p></p>
                                            <button class="btn-sm btn-primary" onclick="add()"><i class="fa fa-plus"></i> Add</button>
                                        </h4>
                                        <hr>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <div class="loader" style="display:block"></div>
                                            <table class="table table-resposive table-striped" id="table-menu" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>No RM</th>
                                                        <th>Tanggal RM</th>
                                                        <th>NIK</th>
                                                        <th>Sebutan</th>
                                                        <th>Nama</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Tanggal Lahir</th>
                                                        <th>Tempat Lahir</th>  
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
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
            <div class="modal fade" id="tambahModal" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="headermodaltambah"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body row">
                            <input type="hidden" id="id" class="form-control"> 
                            <input type="hidden" id="status" class="form-control">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_norm"></div>
                                    <input type="text" class="form-control" id="norm" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_tanggalrm"></div>
                                    <input type="date" class="form-control" id="tanggalrm" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_nik"></div>
                                    <input type="text" class="form-control" id="nik" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_sebutan"></div>
                                    <select name="nama_sebutan" id="nama_sebutan" class="form-control">
                                        <option value="TN">TN</option>
                                        <option value="NY">NY</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_nama"></div>
                                    <input type="text" class="form-control" id="nama" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_nomorhp"></div>
                                    <input type="number" class="form-control" id="nomorhp" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_email"></div>
                                    <input type="text" class="form-control" id="email" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_jeniskelamin"></div>
                                    <select name="jeniskelamin" id="jeniskelamin" class="form-control">
                                        <?php foreach ($list_gender as $data) { ?>
                                            <option value="<?= $data['id'];?>"><?= $data['keterangan'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_tanggallahir"></div>
                                    <input type="date" class="form-control" id="tanggallahir" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_tempatlahir"></div>
                                    <input type="text" class="form-control" id="tempatlahir" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_umur"></div>
                                    <input type="number" class="form-control" id="umur" required="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_golongan_darah"></div>
                                    <input type="text" class="form-control" id="golongan_darah" required="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="section-title" id="title_province"></div>
                                    <select name="provinsi_id" id="provinces" class="custom-select">
                                        <option value="">Please Select</option>    
                                        <?php foreach ($list_province as $data) { ?>
                                            <option value="<?= $data['id'];?>"><?= $data['name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="section-title" id="title_city"></div>
                                    <select name="kabupaten_id" id="city" class="custom-select">
                                        <option value="">Please Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="section-title" id="title_district"></div>
                                    <select name="kecamatan_id" id="districts" class="custom-select">
                                        <option value="">Please Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="section-title" id="title_village"></div>
                                    <select name="desa_id" id="villages" class="custom-select">
                                        <option value="">Please Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="section-title" id="title_alamat"></div>
                                    <input type="text" class="form-control" id="alamat" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button class="btn btn-primary" type="button" id="btnItemSave" onclick="return saveitem()">
                                SAVE
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="hapusModal" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id='headermodalhapus'></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="code_hapus" class="form-control">
                            <div class="section-title" id='infohapus'></div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button class="btn btn-primary" type="button" id="btnDelete" onclick="return itemHapus()">
                                Delete </button>
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
        <script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/scripts.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/custom.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/toastr.js');?>"></script>

        <script>
            $(document).ready(function() {
                $("#table-menu").dataTable({
                    ajax: {
                        url: '<?php echo base_url("eklinik/masterdata/getRekamMedis") ?>',
                        dataSrc: 'data'
                    },
                    columns: [
                        { 
                            "data": 'no',
                        },
                        { 
                            "data": 'norm',
                        },
                        { 
                            "data": 'tanggal_rm',
                        },
                        { 
                            "data": 'nik',
                        },
                        { 
                            "data": 'nama_sebutan',
                        },
                        { 
                            "data": 'nama', 
                        },
                        { 
                            "data": 'jeniskelamin',
                        },
                        { 
                            "data": 'tanggallahir',
                        },
                        { 
                            "data": 'tempatlahir',
                        },
                        { 
                            "data": 'option' 
                        }
                    ],
                    "columnDefs": [
                        { "sortable": false, "targets": [2, 3] }
                    ]
                });

                var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                $.ajaxSetup({
                    data: csfrData
                });
            });

            function add(status)
            {
                dataPost = {
                    status : status
                }
                showLoading();
                $.ajax({
                    url: '<?= base_url("eklinik/masterdata/getRekamMedis") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                             $('#status').val('tambah');
                                document.getElementById("headermodaltambah").innerHTML = "ADD MASTER DATA REKAM MEDIS";
                                document.getElementById("title_norm").innerHTML = "No RM";
                                document.getElementById("title_tanggalrm").innerHTML = "Tanggal RM";
                                document.getElementById("title_nik").innerHTML = "NIK";
                                document.getElementById("title_sebutan").innerHTML = "Sebutan";
                                document.getElementById("title_nama").innerHTML = "Nama";
                                document.getElementById("title_nomorhp").innerHTML = "No Telepon";
                                document.getElementById("title_email").innerHTML = "Email";
                                document.getElementById("title_jeniskelamin").innerHTML = "Jenis Kelamin";
                                document.getElementById("title_tanggallahir").innerHTML = "Tanggal Lahir";
                                document.getElementById("title_tempatlahir").innerHTML = "Tempat Lahir";
                                document.getElementById("title_umur").innerHTML = "Umur";
                                document.getElementById("title_golongan_darah").innerHTML = "Golongan Darah";
                                document.getElementById("title_province").innerHTML = "Province";
                                document.getElementById("title_city").innerHTML = "City";
                                document.getElementById("title_district").innerHTML = "District";
                                document.getElementById("title_village").innerHTML = "Village";
                                document.getElementById("title_alamat").innerHTML = "Alamat";
                             dismisLoading();
                             $("#tambahModal").modal();
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
                })
            }

            function saveitem()
            {
                var btn = document.getElementById("btnItemSave");
                var id = $('#id').val();
                var norm = $('#norm').val();
                var tanggalrm = $('#tanggalrm').val();
                var nik = $('#nik').val();
                var nama_sebutan = $('#nama_sebutan').val();
                var nama = $('#nama').val();
                var jeniskelamin = $('#jeniskelamin').val();
                var tanggallahir = $('#tanggallahir').val();
                var tempatlahir = $('#tempatlahir').val();
                var nomorhp = $('#nomorhp').val();
                var email = $('#email').val();
                var umur = $('#umur').val();
                var provinsi_id = $('#provinces').val();
                var kabupaten_id = $('#city').val();
                var kecamatan_id = $('#districts').val();
                var desa_id = $('#villages').val();
                var golongan_darah = $('#golongan_darah').val();
                var alamat = $('#alamat').val();
                var status = $('#status').val();
                if(norm == "" || norm == null){
                    showSnackError("Harap isi No RM");
				}else if(nama == "" || nama == null){
                    showSnackError("Harap isi Tanggal RM"); 
                }else if(nik == "" || nik == null){
                    showSnackError("Harap isi NIK");    
                }else if(nama_sebutan == "" || nama_sebutan == null){
                    showSnackError("Harap isi Sebutan");
                }else if(jeniskelamin == "" || jeniskelamin == null){
                    showSnackError("Harap isi Jenis Kelamin");   
                }else if(tanggallahir == "" || tanggallahir == null){
                    showSnackError("Harap isi Tanggal Lahir");     
                }else if(tempatlahir == "" || tempatlahir == null){
                    showSnackError("Harap isi Tempat Lahir");    
                }else if(nomorhp == "" || nomorhp == null){
                    showSnackError("Harap isi Nomor HP");
                }else if(email == "" || email == null){
                    showSnackError("Harap isi Email"); 
                }else if(umur == "" || umur == null){
                    showSnackError("Harap isi Umur");  
                }else if(provinsi_id == "" || provinsi_id == null){
                    showSnackError("Harap isi Province");   
                }else if(kabupaten_id == "" || kabupaten_id == null){
                    showSnackError("Harap isi Regencies");    
                }else if(kecamatan_id == "" || kecamatan_id == null){
                    showSnackError("Harap isi Districts");   
                }else if(desa_id == "" || desa_id == null){
                    showSnackError("Harap isi Villages");              
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        id : id,
                        norm : norm,
                        tanggalrm : tanggalrm,
                        nik : nik,
                        nama_sebutan : nama_sebutan,
                        nama : nama,
                        jeniskelamin : jeniskelamin,
                        tanggallahir : tanggallahir,
                        tempatlahir : tempatlahir,
                        nomorhp : nomorhp,
                        email : email,
                        umur : umur,
                        provinsi_id : provinsi_id,
                        kabupaten_id : kabupaten_id,
                        kecamatan_id : kecamatan_id,
                        desa_id : desa_id,
                        golongan_darah : golongan_darah,
                        alamat : alamat,
                        status : status,
                    }
                    $.ajax({
                        url: '<?= base_url("eklinik/masterdata/saveRekamMedis") ?>',
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

            function edit(id,status)
            {
                document.getElementById("headermodaltambah").innerHTML = "";
                dataPost = {
                    id : id,
                    status : status
                }
                showLoading();
                $.ajax({
                    url: '<?= base_url("eklinik/masterdata/getRekamMedisbyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#id').val(data[0]['id']);
                            $('#norm').val(data[0]['norm']);
                            $('#tanggalrm').val(data[0]['tanggal_rm']);
                            $('#nik').val(data[0]['nik']);
                            $('#nama_sebutan').val(data[0]['nama_sebutan']);
                            $('#nama').val(data[0]['nama']);
                            $('#jeniskelamin').val(data[0]['jeniskelamin']);
                            $('#tanggallahir').val(data[0]['tanggallahir']);
                            $('#tempatlahir').val(data[0]['tempatlahir']);
                            $('#nomorhp').val(data[0]['nomorhp']);
                            $('#email').val(data[0]['email']);
                            $('#umur').val(data[0]['umur']);
                            $('#provinces').val(data[0]['provinsi_id']);
                            $('#city').val(data[0]['kabupaten_id']);
                            $('#districts').val(data[0]['kecamatan_id']);
                            $('#villages').val(data[0]['desa_id']);
                            $('#golongan_darah').val(data[0]['golongan_darah']);
                            $('#alamat').val(data[0]['alamat']);
                            $('#status').val('edit');
                                document.getElementById("headermodaltambah").innerHTML = "EDIT MASTER DATA REKAM MEDIS";
                                document.getElementById("title_norm").innerHTML = "No RM";
                                document.getElementById("title_tanggalrm").innerHTML = "Tanggal RM";
                                document.getElementById("title_nik").innerHTML = "NIK";
                                document.getElementById("title_sebutan").innerHTML = "Sebutan";
                                document.getElementById("title_nama").innerHTML = "Nama";
                                document.getElementById("title_nomorhp").innerHTML = "No Telepon";
                                document.getElementById("title_email").innerHTML = "Email";
                                document.getElementById("title_jeniskelamin").innerHTML = "Jenis Kelamin";
                                document.getElementById("title_tanggallahir").innerHTML = "Tanggal Lahir";
                                document.getElementById("title_tempatlahir").innerHTML = "Tempat Lahir";
                                document.getElementById("title_umur").innerHTML = "Umur";
                                document.getElementById("title_golongan_darah").innerHTML = "Golongan Darah";
                                document.getElementById("title_province").innerHTML = "Province";
                                document.getElementById("title_city").innerHTML = "City";
                                document.getElementById("title_district").innerHTML = "District";
                                document.getElementById("title_village").innerHTML = "Village";
                                document.getElementById("title_alamat").innerHTML = "Alamat";
                             dismisLoading();
                             $("#tambahModal").modal();
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
                })
            }

            function hapus(norm)
            {
                dataPost = {
                    norm : norm
                }
                showLoading();
                $.ajax({
                    url: '<?= base_url("eklinik/masterdata/getRekamMedisbyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#code_hapus').val(data[0]['norm']);
                            
                            document.getElementById("headermodalhapus").innerHTML = "Delete Rekam Medis  ";
                            document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : ";
                          
                            dismisLoading();
                            $("#hapusModal").modal();
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

            function itemHapus()
            {
                var btn = document.getElementById("btnDelete");
                var code_hapus = $('#code_hapus').val();
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        code_hapus : code_hapus,
                    }
                    $.ajax({
                        url: '<?= base_url("eklinik/masterdata/deleteRekamMedis") ?>',
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

            function showSnackError(text){
                iziToast.error({
                    title: 'Info',
                    message: text,
                    position: 'topRight'
                });
            }

            function showSnackSuccess(text){
                iziToast.success({
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

        <script>    
            document.getElementById("provinces").addEventListener("change", function(e){
                fetch("<?= base_url('eklinik/masterdata/search_city');?>/"+e.target.value)
                    .then(res => res.json())
                    .then(res => {
                        document.getElementById("city").innerHTML = res.data;
                    })
            });

            document.getElementById("city").addEventListener("change", function(e){
                fetch("<?= base_url('eklinik/masterdata/search_district');?>/"+e.target.value)
                    .then(res => res.json())
                    .then(res => {
                        document.getElementById("districts").innerHTML = res.data;
                    })
            });

            document.getElementById("districts").addEventListener("change", function(e){
                fetch("<?= base_url('eklinik/masterdata/search_village');?>/"+e.target.value)
                    .then(res => res.json())
                    .then(res => {
                        document.getElementById("villages").innerHTML = res.data;
                    })
            });
        </script>        
    </body>
</html>
