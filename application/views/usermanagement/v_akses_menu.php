<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?=$title;?></title>
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
                                    <div class="col-sm-6">
                                        <div class="section-title">Lihat Akses Menu</div>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <select id="user_id_select" class="form-control select2"
                                                    style="width:75%"></select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" type="button" id="btnShowAkses"
                                                        onclick="showAkses()">
                                                        PILIH
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="loader" style="display:block"></div>
                                        <input type="hidden" id="searchTable">
                                        <table class="table table-striped" id="table-menu">
                                            <thead>
                                                <tr>
                                                    <th style="width:70px; text-align:center;">
                                                        <input type="checkbox" id="checkAkses"
                                                            onclick="saveDeleteAll()">
                                                        CHECK
                                                    </th>
                                                    <th style="width:250px; text-align:center;">ID</th>
                                                    <th>Menu</th>
                                                    <th>Modul</th>
                                                    <th>URL</th>
                                                    <th>Read</th>
                                                    <th>Write</th>
                                                    <th style="width:100px; text-align:center;">Status Menu</th>
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


        <script src="<?php echo base_url('assets/template/js/app.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js');?>"></script>
        <script
            src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js');?>">
        </script>
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
            $("#table-menu").dataTable({});
            var csfrData = {};
            csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] =
                '<?php echo $this->security->get_csrf_hash(); ?>';
            $.ajaxSetup({
                data: csfrData
            });

            $('#table-menu').on('search.dt', function() {
                var value = $('.dataTables_filter input').val();
                $('#searchTable').val(value);

            });

            $("#user_id_select").select2({
                language: {
                    searching: function() {
                        return "Mohon tunggu ...";
                    }
                },
                ajax: {
                    url: '<?php echo base_url("usermanagement/accessmenu/getUsers") ?>',
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
                                id: item.user_id,
                                text: item.email + " - " + item.nama_lengkap
                            };
                        });
                        return {
                            results: result
                        };
                    }
                },
            });
        });
        var table;

        function showAkses() {
            var user_id = $('#user_id_select').val();
            var check = document.getElementById("checkAkses");
            if (user_id == "" || user_id == null) {
                showSnackError("Harap Pilih User");
            } else {
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("usermanagement/accessmenu/getUserAccess?user_id=") ?>' + user_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        table = $('#table-menu').DataTable();
                        if (res.status_json) {
                            if (res.countActive == res.countAll) {
                                check.checked = true;
                            } else {
                                check.checked = false;
                            }
                            table.clear();
                            data = res.data;
                            counts = res.data.length;
                            for (var i = 0; i < counts; i++) {
                                if (data[i].user_id == null) {
                                    var checkBox = '<div class="pretty p-default text-center">' +
                                        '<input type="checkbox" id="user_id_checkbox" value="' + data[i]
                                        .modul_detail_id + '" onclick="return saveMenu(\'' + data[i]
                                        .modul_detail_id + '\',\'' + user_id + '\')"/>' +
                                        '<div class="state p-success">' +
                                        '<label></label>' +
                                        '</div>' +
                                        '</div>';
                                    var read = "";
                                    var write = "";
                                } else {
                                    var checkBox = '<div class="pretty p-default text-center">' +
                                        '<input type="checkbox" id="user_id_checkbox" value="' + data[i]
                                        .modul_detail_id + '" onclick="return saveMenu(\'' + data[i]
                                        .modul_detail_id + '\',\'' + user_id + '\')" checked />' +
                                        '<div class="state p-success">' +
                                        '<label></label>' +
                                        '</div>' +
                                        '</div>';
                                    if (data[i].r == 0 || data[i].r == null) {
                                        var read = '<div class="pretty p-default text-center">' +
                                            '<input type="checkbox" id="read_checkbox" value="' + data[i]
                                            .modul_detail_id + '" onclick="return saveRead(\'' + data[i]
                                            .modul_detail_id + '\',\'' + user_id + '\')"/>' +
                                            '<div class="state p-success">' +
                                            '<label></label>' +
                                            '</div>' +
                                            '</div>';
                                    } else {
                                        var read = '<div class="pretty p-default text-center">' +
                                            '<input type="checkbox" id="read_checkbox" value="' + data[i]
                                            .modul_detail_id + '" onclick="return saveRead(\'' + data[i]
                                            .modul_detail_id + '\',\'' + user_id + '\')" checked />' +
                                            '<div class="state p-success">' +
                                            '<label></label>' +
                                            '</div>' +
                                            '</div>';
                                    }

                                    if (data[i].w == 0 || data[i].w == null) {
                                        var write = '<div class="pretty p-default text-center">' +
                                            '<input type="checkbox" id="write_checkbox" value="' + data[i]
                                            .modul_detail_id + '" onclick="return saveWrite(\'' + data[i]
                                            .modul_detail_id + '\',\'' + user_id + '\')"/>' +
                                            '<div class="state p-success">' +
                                            '<label></label>' +
                                            '</div>' +
                                            '</div>';
                                    } else {
                                        var write = '<div class="pretty p-default text-center">' +
                                            '<input type="checkbox" id="write_checkbox" value="' + data[i]
                                            .modul_detail_id + '" onclick="return saveWrite(\'' + data[i]
                                            .modul_detail_id + '\',\'' + user_id + '\')" checked />' +
                                            '<div class="state p-success">' +
                                            '<label></label>' +
                                            '</div>' +
                                            '</div>';
                                    }
                                }

                                if (data[i].md_active) {
                                    md_active = '<div class="badge badge-success badge-shadow">Aktif</div>'
                                } else {
                                    md_active =
                                        '<div class="badge badge-success badge-shadow">Tidak Aktif</div>'
                                }

                                table.row.add([
                                    checkBox,
                                    data[i].modul_detail_id,
                                    data[i].nama_modul_detail,
                                    data[i].nama_modul,
                                    data[i].url,
                                    read,
                                    write,
                                    md_active
                                ]);
                            }
                            table.draw();
                            dismisLoading();
                        } else {
                            showSnackError(res.remarks);
                            dismisLoading();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        showSnackError("Error Sistem");
                        dismisLoading();
                    },
                    timeout: 60000
                });
            }
        }

        function saveDeleteAll() {
            var user_id = $('#user_id_select').val();
            var check = document.getElementById("checkAkses").checked;
            var search = $('#searchTable').val();
            if (user_id == null) {
                showSnackError("Mohon pilih user terlebih dahulu!");
            } else {
                dataPost = {
                    search: search,
                    check: check,
                    user_id: user_id
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("usermanagement/accessmenu/saveDeleteMenu") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res) {
                        console.log(res)
                        showAkses();
                        $('input[type=search]').val('').change();
                        document.getElementById('searchTable').value = '';
                        if (res.status_json) {
                            showSnackSuccess(res.remarks)
                            dismisLoading();
                        } else {
                            showSnackError(res.remarks);
                            dismisLoading();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        showSnackError("Error sistem");
                        dismisLoading();
                    },
                    timeout: 60000
                });
            }
        }

        function saveMenu(modul_detail_id, user_id) {
            dataPost = {
                modul_detail_id: modul_detail_id,
                user_id: user_id
            }
            showLoading();
            $.ajax({
                url: '<?php echo base_url("usermanagement/accessmenu/saveMenu") ?>',
                type: 'POST',
                dataType: 'json',
                data: dataPost,
                success: function(res) {
                    console.log(res)
                    if (res.status_json) {
                        showSnackSuccess(res.remarks)
                        dismisLoading();
                        showAkses();
                    } else {
                        showSnackError(res.remarks);
                        dismisLoading();
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    showSnackError("Error sistem");
                    dismisLoading();
                },
                timeout: 60000
            });
        }

        function saveRead(modul_detail_id, user_id) {
            dataPost = {
                modul_detail_id: modul_detail_id,
                user_id: user_id
            }
            showLoading();
            $.ajax({
                url: '<?php echo base_url("usermanagement/accessmenu/saveRead") ?>',
                type: 'POST',
                dataType: 'json',
                data: dataPost,
                success: function(res) {
                    console.log(res)
                    if (res.status_json) {
                        showSnackSuccess(res.remarks)
                        dismisLoading();
                    } else {
                        showSnackError(res.remarks);
                        dismisLoading();
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    showSnackError("Error sistem");
                    dismisLoading();
                },
                timeout: 60000
            });
        }

        function saveWrite(modul_detail_id, user_id) {
            dataPost = {
                modul_detail_id: modul_detail_id,
                user_id: user_id
            }
            showLoading();
            $.ajax({
                url: '<?php echo base_url("usermanagement/accessmenu/saveWrite") ?>',
                type: 'POST',
                dataType: 'json',
                data: dataPost,
                success: function(res) {
                    console.log(res)
                    if (res.status_json) {
                        showSnackSuccess(res.remarks)
                        dismisLoading();
                    } else {
                        showSnackError(res.remarks);
                        dismisLoading();
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    showSnackError("Error sistem");
                    dismisLoading();
                },
                timeout: 60000
            });
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
</body>

</html>