<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css');?>">
<style>
    #modalLoading {
        position:absolute;
        max-width: 100%;
        height: auto;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 5;
        display: none;
    }
</style>
<div id="modalLoading">
    <img src="<?php echo base_url('assets\template\img\loading.gif'); ?>" >
</div>
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> 
                    <i data-feather="align-justify"></i>
                </a>
            </li>
            <li>
                <form class="form-inline mr-auto">
                    <div class="search-element">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                        <button class="btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </li>
            <li>
                <div style="padding-left:20px; padding-top:8px">
                    <h3 style="color:black"> <?//$current_app['nama_aplikasi'];?></h3>
                </div>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown"  class="nav-link nav-link-lg message-toggle">
                <i data-feather="mail"></i>
                <span class="badge headerBadge1"> <?=$count_ms;?> </span> 
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                <div class="dropdown-header"> 
                    Messages
                </div>
                <div class="dropdown-list-content dropdown-list-message">
                    <a href="#" class="dropdown-item"> 
                        <span class="dropdown-item-avatar text-white">
                            <img alt="image" src="<?php echo base_url('assets/images/fotoprofil/'.$sess['foto']); ?>" 
                                onerror="this.onerror=null;this.src='<?php echo base_url('assets/template/img/user.png'); ?>';"
                                class="rounded-circle">
                        </span> 
                        <span class="dropdown-item-desc"> 
                            <span class="message-user">Sarah Smith</span> 
                        <span class="time messege-text">Request for leave application</span>
                        <span class="time">5 Min Ago</span>
                    </span>
                </div>
                <div class="dropdown-footer text-center">
                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
    
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> 
                <img alt="<?=$sess['foto'];?>" src="<?php echo base_url('assets/images/fotoprofil/'.$sess['foto']); ?>" 
                    onerror="this.onerror=null;this.src='<?php echo base_url('assets/template/img/user.png'); ?>';"
                    class="user-img-radious-style"> 
                    <span class="d-sm-none d-lg-inline-block">
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title"><?=$sess['nama_lengkap'];?></div>
                <a href="profile.html" class="dropdown-item has-icon"> 
                    <i class="far fa-user"></i> Profile
                </a> 
                <a href="#" class="dropdown-item has-icon"> 
                    <i class="fas fa-cog"></i> Settings
                </a>
                <a href="#" class="dropdown-item has-icon" onclick="showPeriod()"> 
                    <i class="fas fa-calendar"></i> Change Periode
                </a>
                <div class="dropdown-divider"></div>
                    <a href="<?php echo base_url('auth/login/logout'); ?>" class="dropdown-item has-icon text-danger"> 
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<div class="modal fade" id="modalChangePeriod" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Transaction Period</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-sm-12">
                    <p>Fill all the fields bellow and click 'Ok' change transaction period</p>
                </div>

                <div class="col-sm-6">
                    <div class="section-title">Month</div>
                    <div class="form-group">
                        <select class="form-control" id="cp_month">
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="section-title">Years</div>
                    <div class="form-group">
                        <select class="form-control" id="cp_year">
                            
                        </select>
                    </div>
                </div>  
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-primary" onclick="saveChangePeriod()" id="btnSaveChangePeriod">Ok</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function showLoading(){
        var modalLoading = document.getElementById("modalLoading");
        modalLoading.style.display = 'block'
    }

    function dismisLoading(){
        var modalLoading = document.getElementById("modalLoading");
        modalLoading.style.display = 'none'
    }

    function showPeriod(){
        showLoading();
        $.ajax({
            url: '<?php echo base_url("Home/getPeriode") ?>',
            type: 'POST',
            success: function(res){
                console.log(res.years.length)
                dismisLoading();
                if(res.status_json){
                    var cp_year = document.getElementById("cp_year");
                    sortYers = res.years.sort();
                    for(i = 0; i < sortYers.length; i++){
                        var opt = document.createElement("option");
                        opt.text = res.years[i];
                        cp_year.options.add(opt, res.years[i]);
                    }
                    document.getElementById('cp_year').value = res.year;
                    document.getElementById('cp_month').value = res.month;
                    $("#modalChangePeriod").modal();
                }else{
                    showSnackErrorHeader(res.remarks);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                dismisLoading();
                showSnackErrorHeader(XMLHttpRequest)
            },
            timeout: 60000 
        });
    }

    function saveChangePeriod(){
        var btn = document.getElementById("btnSaveChangePeriod");
        btn.value = 'Loading...';
        btn.innerHTML = 'Loading...';
        btn.disabled = true;
        
        var year = $('#cp_year').val();
        var month = $('#cp_month').val();
        dataPost = {
            year : year,
            month : month,
        }
        $.ajax({
            url: '<?php echo base_url("Home/changePeriode") ?>',
            type: 'POST',
            dataType: 'json',
            data: dataPost,
            success: function(res){
                console.log(res)
                if(res.status_json){
                    successHeader(res.remarks);
                }else{
                    showSnackErrorHeader(res.remarks);
                }
                btn.value = 'Ok';
                btn.innerHTML = 'Ok';
                btn.disabled = false;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                btn.value = 'Error, Try again';
                btn.innerHTML = 'Error, Try again';
                btn.disabled = false;
                showSnackErrorHeader(XMLHttpRequest);
            },
            timeout: 60000 
        });
    }

    function showSnackErrorHeader(text){
        iziToast.error({
            title: 'Info',
            message: text,
            position: 'topRight'
        });
    }

    function showSnackSuccessHeader(text){
        iziToast.success({
            title: 'Info',
            message: text,
            position: 'topRight'
        });
    }

    function successHeader(text){
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