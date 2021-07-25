<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/bootstrap-social/bootstrap-social.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css');?>">
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url('assets/template/img/favicon.ico');?>' />
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .bg {
            background-image: url("<?php echo base_url('assets/images/bg-login.jpg');?>");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            filter: blur(8px);
            -webkit-filter: blur(8px);
        }
        .vertical-center {
            min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
            min-height: 100vh; /* These two lines are counted as one :-)       */

            display: flex;
            align-items: center;
        }
        .content_login{
            position: fixed;
            width: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }
    </style>
</head>
<body>
    <div class="loader"></div>
    <div id="snackbar_custom"></div>
    <div class="bg"></div>
    <div class="content_login">
        <div id="app">
            <section class="section vertical-center">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h4>Login</h4>
                                </div>
                            <div class="card-body">
                                <form method="POST" action="#" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Email / Username</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="<?php echo base_url('auth/login/forgotpassword');?>" class="text-small">
                                                    Forgot Password?
                                                </a>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <button type="button" onclick="prosesLogin()" id="btnLogin" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Don't have an account? <a href="<?php echo base_url('auth/register');?>">Create One</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="<?php echo base_url('assets/template/js/app.min.js');?>"></script>
    <script src="<?php echo base_url('assets/template/js/scripts.js');?>"></script>
    <script src="<?php echo base_url('assets/template/js/custom.js');?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var csfrData = {};
            csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
            $.ajaxSetup({
                data: csfrData
            });
        });

        function prosesLogin(){
            var btn = document.getElementById("btnLogin");
			btn.value = 'Loading...';
			btn.innerHTML = 'Loading...';
			btn.disabled = true;
            var username = $('#email').val();
            var password = $('#password').val();
            dataPost = {
                username : username,
                password : password
            }
            $.ajax({
                url: '<?php echo base_url("auth/login/processLogin") ?>',
                type: 'POST',
                dataType: 'json',
                data: dataPost,
                success: function(res){
                    console.log(res)
                    if(res.status_json){
                        successLogin();
                    }else{
                        btn.value = 'Login';
                        btn.innerHTML = 'Login';
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
            console.log(text)
            var x = document.getElementById("snackbar_custom");
            x.innerHTML = text;
            x.className = "show";
            setTimeout(function(){ 
                x.className = x.className.replace("show", ""); 
            }, 3000);
        }

        function successLogin(){
            window.location.replace("<?php echo base_url('home');?>");
        }

    </script>
</body>
</html>