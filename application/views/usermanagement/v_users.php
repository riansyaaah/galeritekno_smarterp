<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?=$title;?>
    </title>
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/datatables.min.css');?>">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css');?>">
    <link rel="stylesheet"
        href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css');?>">
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
                                    <h4><?=$title;?>
                                    </h4>
                                    <hr>
                                </div>

                                <div class="card-body row">
                                    <div class="col-sm-2">
                                        <button class="btn btn-primary" onclick="addUser()"><i class="fa fa-plus"></i>
                                            Tambah User</button>
                                    </div>
                                    <!--
                                    <div class="col-sm-2">
                                        <button class="btn btn-primary" onclick="printPdf()" id="btnPrint"><i
                                                class="fa fa-print"></i> Print PDF</button>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-primary" onclick="sendMail()" id="btnMail"><i
                                                class="fa fa-envelope-open"></i> Send Mail</button>
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-primary" onclick="genQRCode()" id="btnQRCode"><i
                                                class="fa fa-qrcode"></i> QR Code</button>
                                    </div>-->
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="loader" style="display:block"></div>
                                        <table class="table table-striped" id="table-menu">
                                            <thead>
                                                <tr>
                                                    <th>USERNAME</th>
                                                    <th>EMAIL</th>
                                                    <th>NIK</th>
                                                    <th>NAMA LENGKAP</th>
                                                    <th>TTL</th>
                                                    <th>ALAMAT</th>
                                                    <th>JABATAN</th>
                                                    <th>POSISI</th>
                                                    <th>STATUS</th>
                                                    <th>OPTION</th>
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

        <div class="modal fade" id="editModalUser" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <input type="hidden" id="edit_user_id" class="form-control">
                        <div class="col-sm-6">
                            <div class="section-title">Staff</div>
                            <div class="form-group">
                                <select id="staff_id_select" class="form-control select2" style="width:100%"></select>
                            </div>
                            <div class="section-title">Username</div>
                            <div class="form-group">
                                <input type="text" id="edit_username" class="form-control">
                            </div>

                            <div class="section-title">Email</div>
                            <div class="form-group">
                                <input type="text" id="edit_email" class="form-control">
                            </div>

                            <div class="section-title">NIK</div>
                            <div class="form-group">
                                <input type="text" id="edit_nik" class="form-control">
                            </div>

                            <div class="section-title">Nama Lengkap</div>
                            <div class="form-group">
                                <input type="text" id="edit_nama_lengkap" class="form-control">
                            </div>

                            <div class="section-title">Jenis Kelamin</div>
                            <div class="form-group">
                                <div class="pretty p-icon p-curve p-rotate">
                                    <input type="radio" name="edit_jenis_kelamin" id="edit_jenis_kelamin_l" value="L"
                                        checked>
                                    <div class="state p-success-o">
                                        <i class="icon material-icons">done</i>
                                        <label> Laki-laki</label>
                                    </div>
                                </div>
                                <div class="pretty p-icon p-curve p-rotate">
                                    <input type="radio" name="edit_jenis_kelamin" id="edit_jenis_kelamin_p" value="P">
                                    <div class="state p-success-o">
                                        <i class="icon material-icons">done</i>
                                        <label> Perempuan</label>
                                    </div>
                                </div>
                            </div>

                            <div class="section-title">Instansi/Corporate</div>
                            <div class="form-group">
                                <select id="instansi_id_select" onchange="onChangeInstansi()"
                                    class="form-control select2" style="width:100%"></select>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="section-title">Tempat Lahir</div>
                            <div class="form-group">
                                <input type="text" id="edit_tempat_lahir" class="form-control">
                            </div>

                            <div class="section-title">Tanggal Lahir</div>
                            <div class="form-group">
                                <input type="date" id="edit_tanggal_lahir" class="form-control">
                            </div>

                            <div class="section-title">Alamat</div>
                            <div class="form-group">
                                <input type="text" id="edit_alamat" class="form-control">
                            </div>

                            <div class="section-title">No Handphone</div>
                            <div class="form-group">
                                <input type="text" id="edit_no_handphone" class="form-control">
                            </div>

                            <div class="section-title">Set Aktif</div>
                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="checkbox" onclick="changeAktif()" checked onchange="changeAktif()"
                                        name="custom-switch-checkbox" id="edit_is_active" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description" id="label_is_active"></span>
                                </label>
                            </div>

                            <div class="section-title">Cabang/Branch</div>
                            <div class="form-group">
                                <select id="branch_id_select" class="form-control select2" style="width:100%"></select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-primary" onclick="save()" id="btnSave">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo base_url('assets/template/js/app.min.js');?>">
        </script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js');?>">
        </script>
        <script
            src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js');?>">
        </script>
        <script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js');?>">
        </script>
        <script src="<?php echo base_url('assets/template/js/page/datatables.js');?>">
        </script>
        <script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js');?>">
        </script>
        <script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js');?>">
        </script>
        <script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js');?>">
        </script>
        <script src="<?php echo base_url('assets/template/js/scripts.js');?>">
        </script>
        <script src="<?php echo base_url('assets/template/js/custom.js');?>">
        </script>
        <script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js');?>">
        </script>
        <script src="<?php echo base_url('assets/template/js/page/toastr.js');?>">
        </script>

        <script>
        $(document).ready(function() {
            $("#table-menu").dataTable({
                ajax: {
                    url: '<?php echo base_url("usermanagement/users/getUsers") ?>',
                    dataSrc: 'data'
                },
                columns: [{
                        "data": 'username',
                    },
                    {
                        "data": 'email'
                    },
                    {
                        "data": 'nik'
                    },
                    {
                        "data": 'nama_lengkap'
                    },
                    {
                        "data": 'ttl'
                    },
                    {
                        "data": 'alamat'
                    },
                    {
                        "data": 'jabatan'
                    },
                    {
                        "data": 'posisi'
                    },
                    {
                        "data": 'is_active'
                    },
                    {
                        "data": 'option'
                    }
                ],
                "columnDefs": [{
                    "sortable": false,
                    "targets": [2, 3]
                }]
            });
            var csfrData = {};
            csfrData[
                    '<?php echo $this->security->get_csrf_token_name(); ?>'
                ] =
                '<?php echo $this->security->get_csrf_hash(); ?>';
            $.ajaxSetup({
                data: csfrData
            });


            $("#instansi_id_select").select2({
                language: {
                    searching: function() {
                        return "Mohon tunggu ...";
                    }
                },
                ajax: {
                    url: '<?php echo base_url("usermanagement/users/getInstansi") ?>',
                    dataType: 'json',
                    type: "GET",
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(res, params) {
                        var result = res.data.map(function(item) {
                            return {
                                id: item.instansi_id,
                                text: item.nama_instansi
                            };
                        });
                        return {
                            results: result
                        };
                    }
                },
            });
            $("#staff_id_select").select2({
                language: {
                    searching: function() {
                        return "Mohon tunggu ...";
                    }
                },
                ajax: {
                    url: '<?php echo base_url("usermanagement/users/getStaff") ?>',
                    dataType: 'json',
                    type: "GET",
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(res, params) {
                        var result = res.data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            };
                        });
                        return {
                            results: result
                        };
                    }
                },
            });
            $("#branch_id_select").select2({
                language: {
                    searching: function() {
                        return "Mohon tunggu ...";
                    }
                },
                ajax: {
                    url: '<?php echo base_url("usermanagement/users/getBranch") ?>',
                    dataType: 'json',
                    type: "GET",
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            instansi_id: $('#instansi_id_select').val()
                        };
                    },
                    processResults: function(res, params) {
                        var result = res.data.map(function(item) {
                            return {
                                id: item.branch_id,
                                text: item.nama_branch
                            };
                        });
                        return {
                            results: result
                        };
                    }
                },
            });

        });

        function onChangeInstansi() {
            $("#branch_id_select").empty().trigger('change')
        }

        function editUser(user_id) {
            dataPost = {
                user_id: user_id
            }
            showLoading();
            $.ajax({
                url: '<?php echo base_url("usermanagement/users/getSingleUser") ?>',
                type: 'POST',
                dataType: 'json',
                data: dataPost,
                success: function(res) {
                    console.log(res)
                    if (res.status_json) {
                        data = res.data;
                        $('#edit_user_id').val(data.user_id);
                        $('#edit_username').val(data.username);
                        $('#edit_email').val(data.email);
                        if (data.is_active == 1) {
                            document.getElementById("edit_is_active").checked = true;
                            document.getElementById("label_is_active").innerHTML = "Aktif";
                        } else {
                            document.getElementById("edit_is_active").checked = false;
                            document.getElementById("label_is_active").innerHTML = "Tidak Aktif";
                        }
                        var $instansi_id_select = $("<option selected></option>").val(data.instansi_id)
                            .text(data.nama_instansi);
                        $('#instansi_id_select').append($instansi_id_select).trigger('change');

                        var $staff_id_select = $("<option selected></option>").val(data.staff_id).text(
                            data
                            .name);
                        $('#staff_id_select').append($staff_id_select).trigger('change');

                        var $branch_id_select = $("<option selected></option>").val(data.branch_id)
                            .text(
                                data.nama_branch);
                        $('#branch_id_select').append($branch_id_select).trigger('change');

                        $('#edit_nik').val(data.nik);
                        $('#edit_nama_lengkap').val(data.nama_lengkap);
                        $('#edit_tempat_lahir').val(data.tempat_lahir);
                        $('#edit_tanggal_lahir').val(data.tanggal_lahir);
                        $('#edit_jenis_kelamin').val(data.jenis_kelamin);
                        $('#edit_alamat').val(data.alamat);
                        $('#edit_no_handphone').val(data.no_handphone);
                        if (data.jenis_kelamin == "P") {
                            document.getElementById("edit_jenis_kelamin_p").checked = true;
                            document.getElementById("edit_jenis_kelamin_l").checked = false;
                        } else {
                            document.getElementById("edit_jenis_kelamin_p").checked = false;
                            document.getElementById("edit_jenis_kelamin_l").checked = true;
                        }

                        dismisLoading();
                        document.getElementById("exampleModalCenterTitle").innerHTML = 'Edit User';
                        $("#editModalUser").modal();
                    } else {
                        showSnackError(res.remarks);
                        dismisLoading();
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    showSnackError(XMLHttpRequest);
                    dismisLoading();
                },
                timeout: 60000
            });
        }

        function addUser() {
            document.getElementById('edit_user_id').value = ""
            document.getElementById('edit_username').value = ""
            document.getElementById('edit_email').value = ""
            document.getElementById('edit_nik').value = ""
            document.getElementById('edit_nama_lengkap').value = ""
            document.getElementById('edit_tempat_lahir').value = ""
            document.getElementById('edit_tanggal_lahir').value = ""
            document.getElementById('edit_alamat').value = ""
            document.getElementById('edit_no_handphone').value = ""
            document.getElementById('edit_jenis_kelamin_l').checked = true;
            document.getElementById("exampleModalCenterTitle").innerHTML = 'Tambah User';
            $("#instansi_id_select").empty().trigger('change')
            $("#branch_id_select").empty().trigger('change')
            $("#staff_id_select").empty().trigger('change')
            $("#editModalUser").modal();
        }

        function changeAktif() {
            if (document.getElementById('edit_is_active').checked) {
                document.getElementById("label_is_active").innerHTML = "Aktif";
            } else {
                document.getElementById("label_is_active").innerHTML = "Tidak Aktif";
            }
        }

        function save() {
            var user_id = $('#edit_user_id').val();
            var username = $('#edit_username').val();
            var email = $('#edit_email').val();
            if (document.getElementById('edit_is_active').checked) {
                var is_active = 1;
            } else {
                var is_active = 0;
            }
            var nik = $('#edit_nik').val();
            var nama_lengkap = $('#edit_nama_lengkap').val();
            var tempat_lahir = $('#edit_tempat_lahir').val();
            var tanggal_lahir = $('#edit_tanggal_lahir').val();
            if (document.getElementById('edit_jenis_kelamin_l').checked) {
                var jenis_kelamin = "L";
            } else {
                var jenis_kelamin = "P";
            }
            var alamat = $('#edit_alamat').val();
            var no_handphone = $('#edit_no_handphone').val();
            var instansi_id = $('#instansi_id_select').val();
            var branch_id = $('#branch_id_select').val();
            var staff_id = $('#staff_id_select').val();

            if (username == "" || username == null) {
                showSnackError("Harap isi Username");
            } else if (email == "" || email == null) {
                showSnackError("Harap isi Email");
            } else if (nik == "" || nik == null) {
                showSnackError("Harap isi NIK");
            } else if (nama_lengkap == "" || nama_lengkap == null) {
                showSnackError("Harap isi Nama Lengkap");
            } else if (tempat_lahir == "" || tempat_lahir == null) {
                showSnackError("Harap isi Tempat Lahir");
            } else if (tanggal_lahir == "" || tanggal_lahir == null) {
                showSnackError("Harap isi Tanggal Lahir");
            } else if (alamat == "" || alamat == null) {
                showSnackError("Harap isi Alamat");
            } else if (no_handphone == "" || no_handphone == null) {
                showSnackError("Harap isi No Handphone");
            } else if (instansi_id == "" || instansi_id == null) {
                showSnackError("Harap Pilih Instansi/Corporate");
            } else if (branch_id == "" || branch_id == null) {
                showSnackError("Harap Pilih Branch");
            } else if (staff_id == "" || staff_id == null) {
                showSnackError("Harap Pilih Staff");
            } else {
                showLoading();
                var btn = document.getElementById("btnSave");
                btn.value = 'Loading...';
                btn.innerHTML = 'Loading...';
                btn.disabled = true;
                dataPost = {
                    user_id: user_id,
                    username: username,
                    email: email,
                    is_active: is_active,
                    nik: nik,
                    nama_lengkap: nama_lengkap,
                    tempat_lahir: tempat_lahir,
                    tanggal_lahir: tanggal_lahir,
                    jenis_kelamin: jenis_kelamin,
                    alamat: alamat,
                    no_handphone: no_handphone,
                    instansi_id: instansi_id,
                    branch_id: branch_id,
                    staff_id: staff_id
                }

                $.ajax({
                    url: '<?php echo base_url("usermanagement/users/saveUser") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res) {
                        console.log(res)
                        if (res.status_json) {
                            success(res.remarks);
                        } else {
                            btn.value = 'Save';
                            btn.innerHTML = 'Save';
                            btn.disabled = false;
                            showSnackError(res.remarks);
                            dismisLoading();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        dismisLoading();
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

        function printPdf() {
            showLoading();
            var btn = document.getElementById("btnPrint");
            btn.value = 'Loading...';
            btn.innerHTML = 'Loading...';
            btn.disabled = true;
            dataPost = {
                text: 'TEST'
            }
            $.ajax({
                url: '<?php echo base_url("usermanagement/users/printPDF") ?>',
                type: 'POST',
                dataType: 'json',
                data: dataPost,
                success: function(res) {
                    console.log(res)
                    if (res.status_json) {
                        pdfShow(res.pathPdf);
                    } else {
                        showSnackError(res.remarks);
                    }
                    btn.value = 'Print PDF';
                    btn.innerHTML = 'Print PDF';
                    btn.disabled = false;
                    dismisLoading();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    dismisLoading();
                    btn.value = 'Gagal, Coba lagi';
                    btn.innerHTML = 'Gagal, Coba lagi';
                    btn.disabled = false;
                },
                timeout: 60000
            });
        }

        function sendMail() {
            showLoading();
            var btn = document.getElementById("btnMail");
            btn.value = 'Loading...';
            btn.innerHTML = 'Loading...';
            btn.disabled = true;
            dataPost = {
                text: 'TEST'
            }
            $.ajax({
                url: '<?php echo base_url("usermanagement/users/sendMail") ?>',
                type: 'POST',
                dataType: 'json',
                data: dataPost,
                success: function(res) {
                    console.log(res)
                    if (res.status_json) {
                        success(res.pathPdf);
                    } else {
                        showSnackError(res.remarks);
                    }
                    btn.value = 'Send Mail';
                    btn.innerHTML = 'Send Mail';
                    btn.disabled = false;
                    dismisLoading();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    dismisLoading();
                    btn.value = 'Gagal, Coba lagi';
                    btn.innerHTML = 'Gagal, Coba lagi';
                    btn.disabled = false;
                },
                timeout: 60000
            });
        }

        function pdfShow(pathPdf) {
            Swal.fire({
                title: 'Do you want to view this file?',
                showCancelButton: true,
                confirmButtonText: `Yes`,
            }).then((result) => {
                console.log(result)
                if (result.value) {
                    var url = "<?php echo base_url();?>" + pathPdf;
                    console.log(url)
                    window.open(url, '_blank');
                } else {
                    Swal.fire('Successfully generate pdf', '', 'info')
                }
            })
        }


        function genQRCode() {
            showLoading();
            var btn = document.getElementById("btnQRCode");
            btn.value = 'Loading...';
            btn.innerHTML = 'Loading...';
            btn.disabled = true;
            dataPost = {
                text: "1234;Namanya Saja Beda;Nomor Registrasinya Panjang;2021-03-03;07:00;No Antrian;SS-22-009"
            }
            $.ajax({
                url: '<?php echo base_url("usermanagement/users/genQRCode") ?>',
                type: 'POST',
                dataType: 'json',
                data: dataPost,
                success: function(res) {
                    console.log(res)
                    if (res.status_json) {
                        showSnackSuccess(res.path);
                    } else {
                        showSnackError(res.remarks);
                    }
                    btn.value = 'QR Code';
                    btn.innerHTML = 'QR Code';
                    btn.disabled = false;
                    dismisLoading();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    dismisLoading();
                    btn.value = 'Gagal, Coba lagi';
                    btn.innerHTML = 'Gagal, Coba lagi';
                    btn.disabled = false;
                },
                timeout: 60000
            });
        }
        </script>
</body>

</html>