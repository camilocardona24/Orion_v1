
<?php
//include ("assets/php/start_session.php"); //Para hacer el LogIn en el App

$enable;
if (isset($_POST['username'])) {
    $user = $_POST['username'];
    $passwrd = $_POST['password'];
    $enable = userlogin($user, $passwrd);
}
?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Plataforma Orion - Análisis y Conteo vehícular</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="" name="description"/>
        <meta content="" name="author" />

        <!-- ================== BEGIN BASE CSS STYLE ================== -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="assets/css/animate.min.css" rel="stylesheet" />
        <link href="assets/css/style.min.css" rel="stylesheet" />
        <link href="assets/css/style-responsive.min.css" rel="stylesheet" />
        <link href="assets/css/theme/blue.css" rel="stylesheet" id="theme" />
        <!-- ================== END BASE CSS STYLE ================== -->

        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
        <script src="assets/plugins/parsley/src/parsley.css" rel="stylesheet"></script>
        <!-- ================== END PAGE LEVEL STYLE  ================== -->

        <!-- ================== BEGIN BASE JS ================== -->
        <script src="assets/plugins/pace/pace.min.js"></script>
        <!-- ================== END BASE JS ================== -->
    </head>
    <body class="pace-top bg-white">
        <!-- begin #page-loader -->
        <div id="page-loader" class="fade in"><span class="spinner"></span></div>
        <!-- end #page-loader -->

        <!-- begin #page-container -->
        <div id="page-container" class="fade">
            <!-- begin login -->
            <div class="login login-with-news-feed">
                <!-- begin news-feed -->
                <div class="news-feed">
                    <div class="news-image">
                        <img src="assets/img/orionbg.jpg" data-id="login-cover-image" alt="" />
                    </div>
                    <div class="news-caption">
                        <h4 class="caption-title"><i class="fa fa-diamond text-primary"></i> Plataforma Orion</h4>
                        <p>
                            Plataforma para el análisis y conteo vehicular desarrollado por <a href="http://www.inter-telco" target="_blank" class="text-primary"> Inter-Telco S.A.S  <i class="fa fa-wifi"></i>  </a>
                        </p>
                    </div>
                </div>
                <!-- end news-feed -->
                <!-- begin right-content --><br><br>
                <div class="right-content">
                    <!-- begin login-header -->
                    <div class="login-header">
                      
                    </div>
                    <!-- end login-header -->
                    <!-- begin login-content -->
                                            <img src="assets/img/camara.png"  style="height: 96px;width: 284px; margin-left:59px">
                    <div class="login-content">

                        <form data-parsley-validate="true" action="validarusuario.php" id="loginForm" action="" method="POST" class="margin-bottom-0">
                            <div class="form-group m-b-15">
                                <input type="text" name="usuario" id="usuario" data-parsley-type="alphanum" class="form-control input-lg" data-parsley-length="[3, 15]" placeholder="Nombre de usuario" required/>
                            </div>
                            <div class="form-group m-b-15">
                                <input type="password" name="password" id="password" class="form-control input-lg" data-parsley-length="[4, 15]" placeholder="Contraseña"  required />
                            </div>

                            <div class="login-buttons">
<input type="submit" class="btn-primary btn1" value="Ingresar" />                            </div>
                            <div class="m-t-20 m-b-40">
                                Olvidaste tú contraseña? Click <a href="#" class="text-primary"onclick="fillDriversData();">aquí</a> para recuperarla.
                            </div>
                            <div class="checkbox m-b-30">

                            </div>
                          

                            <?php
                            if ($enable == "false") {
                                ?>                    
                                <div class="alert alert-danger alert-dismissable " style="margin-top:25px;" >
                                    <i class="fa fa-ban"></i>
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <b>Alerta: </b> Usuario y/o contraseña incorrecta.
                                </div>
                                <?php
                            }
                            ?> 
                            <hr />
                            <p class="text-center text-inverse">

                            </p>
                        </form>
                    </div>
                    <!-- end login-content -->
                </div>
                <!-- end right-container -->
            </div>
            <!-- end login -->
        </div>
        <!-- end page container -->


        <!-- ================== BEGIN BASE JS ================== -->
        <script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
        <script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
        <script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/parsley/dist/parsley.js"></script>

        <!--[if lt IE 9]>
                <script src="assets/crossbrowserjs/html5shiv.js"></script>
                <script src="assets/crossbrowserjs/respond.min.js"></script>
                <script src="assets/crossbrowserjs/excanvas.min.js"></script>
        <![endif]-->
        <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script type="text/javascript" src="assets/js/validations.js"></script>

        <!-- ================== END BASE JS ================== -->

        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
        <script src="assets/js/apps.min.js"></script>
        <!-- ================== END PAGE LEVEL JS ================== -->

        <script>
                                $(document).ready(function () {
                                    App.init();
                                    $('[data-parsley-validate="true"]').parsley();
                                });
        </script>

        <script type="text/javascript">

            function fillDriversData()
            {
                var url = 'assets/php/driverData.php';
                var width = '610';
                var height = '470';
                var windowSize = 'width=' + width + ',height=' + height;
                window.open(url, 'Datos del conductor', windowSize);
            }
            ;

        </script>



        <script type="text/javascript">
            function showContent() {
                element = document.getElementById("content");
                check = document.getElementById("check");
                if (check.checked) {
                    element.style.display = 'block';
                } else {
                    element.style.display = 'none';
                }
            }
        </script>


    </body>
</html>
