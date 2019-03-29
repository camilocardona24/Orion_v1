<?php
session_start();

// The lvlroot variable indicates the levels of direcctories
// the file loaded has to up, to be on the root directory
$lvlroot = "../../";
// Including Head.
include_once($lvlroot . "Body/Head.php");
// Including Begin Header.
include_once($lvlroot . "Body/BeginPage.php");
//
// Including Side bar.
include_once($lvlroot . "Body/SideBar.php");

// Including Php database.
// function defined in js/autocomplete.js


if ($_GET['cedula']) {
    $cedulavalue = $_GET['cedula'];
    $query2 = "select nombre_completo,nombre_usuario, cedula, perfil,clave from usuarios_sps where cedula ='$cedulavalue';";
    $result = Conexion::consulta($query2);
    $nombre = $result[0][0];
    $usuario = $result[0][1];
    $cedula = $result[0][2];
    $perfil = $result[0][3];
    $clave = $result[0][4];
}
?>


<script>
    var lvlrootjs = <?php print json_encode($lvlroot); ?>;
</script>
<!-- begin breadcrumb -->
<!--<ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Inicio</a></li>
    <li><a href="javascript:;">Proceso Bodega</a></li>
    <li class="active">Selección de Unidades</li>

</ol>-->
<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1" >
            <div class="panel-heading" style="background: #023141;">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div><br>
                <h4 class="panel-title">
                    <i class="icon-user-follow fa-2x"></i>
                    Crear Usuario</h4>
            </div>
            <div class="panel-body panel-form">
                <form method="post" class="form-horizontal form-bordered" data-parsley-validate="true" name="FormCrearUsuario" id = "FormCrearUsuario">
                    <div class="form-group">
                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Nombre (*)</label>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <input class="form-control" type="text" id="nombre_completo" name="nombre" placeholder="Nombre del nuevo usuario" data-parsley-required="true" value ="<?php echo $nombre; ?>" />
                        </div>

                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Nombre de Usuario (*)</label>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <input class="form-control" type="text" id="nombre_usuario" name="usuario" placeholder="Nombre de usuario" data-parsley-required="true" data-parsley-length="[3, 15]" value ="<?php echo $usuario; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Cédula (*)</label>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <input class="form-control" type="number" id="cedula" name="cedula" placeholder="Cédula" data-parsley-required="true" value ="<?php echo $cedula; ?>"/>

                        </div>
                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Perfil(*)</label>
                        </div>
                               <div class="col-md-4 col-sm-4">
                            <select id="perfil" class="form-control" selected="dd" >
                                <option>Administrador</option>
                                <option>Operador</option>
                                <option>Visitante</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Contraseña(*)</label>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <input name="password" type="password" id="password" placeholder="Contraseña del nuevo usuario" data-parsley-required="true" data-parsley-length="[4, 15]" class="form-control m-b-5" value ="<?php echo $clave; ?>" />
                            <!--<div id="passwordStrengthDiv" class="is0 m-t-5"></div><br>-->
                            <input type="checkbox" name="optionHidePassword" value='-1' onchange="changeTypeTxtPassword()" data-render="switchery" data-theme="blue" data-change="check-switchery-state-text"  />
                            <!--<a href="#" class="btn btn-xs btn-primary m-l-5" data-id="">Ocultar/Mostrar Contraseña</a>-->
                        </div>
                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Repite la Contraseña(*)</label>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <input name="passwordAgain" data-parsley-equalto="#password" type="password" id="passwordAgain" class="form-control" placeholder="Repita la contraseña del nuevo usuario" data-parsley-required="true" data-parsley-length="[4, 15]" value ="<?php echo $clave; ?>" /><br>
                            <input type="checkbox" name="optionHidePasswordAgain" value='-1' onchange="changeTypeTxtPasswordAgain()" data-render="switchery" data-theme="blue" data-change="check-switchery-state-text"  />
                            <!--<a href="#" class="btn btn-xs btn-primary m-l-5" data-id="">Ocultar/Mostrar Contraseña</a>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 text-left"><b>Los campos con (*) son obligatorios</b></label>
                        <div class="col-md-4 col-sm-4">
                            <!--                            <button type="submit" class="btn btn-primary" style="padding: 2px 2px;font-size: 18px;"  name="AceptRegUser">Crear Usuario</button>-->
                            <input type ="button" class="btn btn-success" id="actualizarusuario" value="Actualizar"/>

                        </div>
                    </div>


                </form>

            </div>
        </div>


        <div class="panel panel-inverse" >
            <div class="panel-heading" style="background: #023141;">
                <div class="panel-heading-btn" >
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <!--<a href="javascript:;" onclick="noSubmit();" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>-->
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">
                    <i class="icon-user-following fa-2x"></i>
                    Editar Usuario
                </h4>
            </div>
            <div class="panel-body panel-form">
                <!-- Start campo Nombre input desplegable  -->
                <div class="form-group">
                    <script type="text/javascript">

                        $(document).ready(function () {

                            queryusuarioslist();
                        });

                        function queryusuarioslist() {

                            var url = 'listausuarios.php';

                            $.getJSON(url, function (result) {
                                if (result) {
                                    tablausuarios(result);
                                }
                            });
                        }

                        function tablausuarios(result) {
                            $(document).ready(function () {
                                $('#usuarios').DataTable({
                                    data: result,

                                    "language": {
                                        "sProcessing": "Procesando...",
                                        "sLengthMenu": "Mostrar _MENU_ registros",
                                        "sZeroRecords": "No se encontraron resultados",
                                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                                        "sInfoPostFix": "",
                                        "sSearch": "Buscar:",
                                        "sUrl": "",
                                        "sInfoThousands": ",",
                                        "sLoadingRecords": "Cargando...",
                                        "oPaginate": {
                                            "sFirst": "Primero",
                                            "sLast": "Último",
                                            "sNext": "Siguiente",
                                            "sPrevious": "Anterior"
                                        },
                                        "oAria": {
                                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                        }

                                    },
                                    columns: [
                                        {title: "Cedula"},
                                        {title: "Nombre"},
                                        {title: "Usuario"},
                                        {title: "Perfil"},
                                        {title: "Editar"}





                                    ]
                                });
                            });
                        }
                    </script>
                    <table class="table table-bordered table-striped nowrap" id="usuarios" class="display"width="100%;"></table>

                </div>
            </div>
        </div>


    </div>

</div>

<div class="form-group" id="cancel-save" style="display:none;">
    <div class="col-md-12 col-sm-12 text-right">
        <button id="cancelData" name="cancelData" class="btn btn-warning btn-sm">
            <i class="fa fa-ban">Cancelar</i>
        </button>
        <button id="save" name="save" class="btn btn-primary btn-sm">
            <i class="fa fa-floEndppy-o">
                Guardar
            </i>
        </button>
    </div>
</div>


<?php
include_once($lvlroot . "Body/AlertsWindows.php");
?>
</div>
<!-- end row -->
<?php
// Including Js actions, put in the end.
include_once($lvlroot . "Body/JsFoot.php");
// Including End Header.
include_once($lvlroot . "Body/EndPage.php");
// Writing on database.
//include_once("php/Insert2db.php");
?>

<script>
    var lvlrootjs = <?php print json_encode($lvlroot); ?>;
</script>

<script>

    $(document).on('click', '#actualizarusuario', function () {


             

            var nombre = $('#nombre_completo').val();
            var usuario = $('#nombre_usuario').val();
            var cedula = $('#cedula').val();
            var perfil = $('#perfil').val();
            var clave = $('#password').val();
            var url = 'actualizarusuario.php?nombre=' + nombre + '&usuario=' + usuario + '&cedula=' + cedula + '&perfil=' + perfil + '&clave=' + clave;
            $.getJSON(url, function (result) {
                if(result){
                    window.location.href=window.location.href;

                }
            }
            );

        

    });



    //Script to change type text to password 
    function changeTypeTxtPassword()
    {
        document.FormCrearUsuario.password.type = (document.FormCrearUsuario.optionHidePassword.value = (document.FormCrearUsuario.optionHidePassword.value == 1) ? '-1' : '1') == '1' ? 'text' : 'password';
    }

    //Script to change type text to password 
    function changeTypeTxtPasswordAgain()
    {
        document.FormCrearUsuario.passwordAgain.type = (document.FormCrearUsuario.optionHidePasswordAgain.value = (document.FormCrearUsuario.optionHidePasswordAgain.value == 1) ? '-1' : '1') == '1' ? 'text' : 'password';
    }
</script>





<!-- end Configuration of accepted files -->



<script>
    App.restartGlobalFunction();

    $.getScript('../assets/plugins/chart-js/chart.js').done(function () {
        $.getScript('../assets/js/chart-js.demo.min.js').done(function () {
            ChartJs.init();
        });
    });
</script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->

<!-- ================== END PAGE LEVEL JS ================== -->
