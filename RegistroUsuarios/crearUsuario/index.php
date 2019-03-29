<?php
session_start();

$lvlroot = "../../";

// Including Head.
include_once($lvlroot . "Body/Head.php");
// Including Begin Header.
include_once($lvlroot . "Body/BeginPage.php");

//
// Including Side bar.
include_once($lvlroot . "Body/SideBar.php");

class Conexion {

    function conectar() {
        $conn = pg_connect("user=postgres password=Orion2017* host=181.129.51.43 port=5432 dbname=orion");

        if (!$conn) {
            echo "Error, Problemas al conectar con el servidor";
            exit;
        } else {
            return $conn;
        }
    }

    function consulta($sql = null) {
        $resultado = pg_query(Conexion::conectar(), $sql);
        $fila = array();

        #Para obtener todos los datos debemos iterar en un ciclo, ya que contiene un puntero interno.
        while ($row = pg_fetch_row($resultado)) {
            $fila[] = $row;
        }
        return $fila;
    }

}

if (isset($_POST['nombre_completo'])) {
    $nombre = $_POST['nombre_completo'];
    $usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];
    $password = $_POST['password'];
    $passwordAgain = $_POST['passwordAgain'];
    $perfil = $_POST['perfil'];
    $query = "insert into or_usuarios(id,nombre_completo,nombre_usuario,contrasena,perfil) values($cedula,'$nombre','$usuario','$clave',1);";
    $result = Conexion::consulta($query);
    if ($result) {
        ?>
        <div class="alert m-b-o alert-success" id="modal-Note">Usuario creado con éxito.</div>

    <?php } else {
        ?>
        <div class="alert m-b-o alert-danger" id="modal-Note"> Error al ingresar el usuario </div>
        <?php
    }
}
?> 
<script>
    var lvlrootjs = <?php print json_encode($lvlroot); ?>;
</script>


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
                </div>
                <h4 class="panel-title">
                    <i class="icon-user-follow fa-2x"></i>
                    Crear Usuario 
                </h4>
            </div>
            <div class="panel-body panel-form" id="panel-output-form">
                <form method="post" class="form-horizontal form-bordered" data-parsley-validate="true" name="FormCrearUsuario" id = "FormCrearUsuario">
                    <div class="form-group">
                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Nombre (*)</label>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <input class="form-control" type="text" id="nombre_completo" name="nombre" placeholder="Nombre del nuevo usuario" data-parsley-required="true" value ="<?php echo $campos['nombre'] ?>" />
                        </div>

                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Nombre de Usuario (*)</label>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <input class="form-control" type="text" id="nombre_usuario" name="usuario" placeholder="Nombre de usuario" data-parsley-required="true" data-parsley-length="[3, 15]" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Cédula (*)</label>
                        </div>

                        <div class="col-md-4 col-sm-4">
                            <input class="form-control" type="number" id="cedula" name="cedula" placeholder="Cédula" data-parsley-required="true" />

                        </div>
                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Perfil(*)</label>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <select id="perfil" class="form-control" >
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
                            <input name="password" type="password" id="password" placeholder="Contraseña del nuevo usuario" data-parsley-required="true" data-parsley-length="[4, 15]" class="form-control m-b-5" />
                            <!--<div id="passwordStrengthDiv" class="is0 m-t-5"></div><br>-->
                            <input type="checkbox" name="optionHidePassword" value='-1' onchange="changeTypeTxtPassword()" data-render="switchery" data-theme="blue" data-change="check-switchery-state-text"  />
                            <!--<a href="#" class="btn btn-xs btn-primary m-l-5" data-id="">Ocultar/Mostrar Contraseña</a>-->
                        </div>
                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Repite la Contraseña(*)</label>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <input name="passwordAgain" data-parsley-equalto="#password" type="password" id="passwordAgain" class="form-control" placeholder="Repita la contraseña del nuevo usuario" data-parsley-required="true" data-parsley-length="[4, 15]" /><br>
                            <input type="checkbox" name="optionHidePasswordAgain" value='-1' onchange="changeTypeTxtPasswordAgain()" data-render="switchery" data-theme="blue" data-change="check-switchery-state-text"  />
                            <!--<a href="#" class="btn btn-xs btn-primary m-l-5" data-id="">Ocultar/Mostrar Contraseña</a>-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 text-left"><b>Los campos con (*) son obligatorios</b></label>
                        <div class="col-md-4 col-sm-4">
                            <!--  <button type="submit" class="btn btn-primary" style="padding: 2px 2px;font-size: 18px;"  name="AceptRegUser">Crear Usuario</button>-->
                            <input type ="button" class="btn btn-success" id="crearusuario" value="Crear"/>

                        </div>
                    </div>


                </form>

            </div>
        </div>


        <div class="panel panel-inverse" data-sortable-id="form-plugins-1" >
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

<!--                    <table  class="table" id="usuariostable" style="width: 100%;">
                        <thead>
                            <tr style="border:1px;">
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Perfil</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr><br>
                        </thead>
<?php
//                        $Client = new Database();
//                        $perfiles = "SELECT u.nombre,u.usuario,u.correo,p.perfil,u.estado FROM sps_usuarios u inner join sps_perfiles p on p.id_perfil=u.id_perfil";
//
//                        $queryResult = $Client->query($perfiles);
//                        while ($clientData = $Client->fetch_array_assoc($queryResult)) {
//                            
?>
                        <tr>

                            <td>//<?php echo $clientData['nombre'] ?></td>
                            <td>//<?php echo $clientData['usuario'] ?></td>
                            <td>//<?php echo $clientData['correo'] ?></td>
                            <td>//<?php echo $clientData['perfil'] ?></td>
                            <td>//<?php echo $clientData['estado'] ?></td>
                            <td><a class="fa fa-pencil-square-o" href="editar.php?id=//<?php echo $clientData['ID_USUARIO'] ?>"> Editar</a></td>
                        </tr>
                        //<?PHP
//                        }
//                        $Client->close();
?>
                    </table>-->
                </div>
            </div>
        </div>
        <div class="panel panel-inverse">
            <div class="panel-heading" style="background: #023141;">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                                    <!--<a href="javascript:;" onclick="noSubmit();" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>-->
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">
                    <i class="icon-user-following fa-2x"></i>
                    Logs Usuario
                </h4>
            </div>
            <div class="panel-body panel-form">
                <!-- Start campo Nombre input desplegable  -->
                <div class="form-group">
<!--                    <script type="text/javascript">

                        $(document).ready(function () {

                            queryusuarios();
                        });

                        function queryusuarios() {

                            var url = 'logusuarios.php';

                            $.getJSON(url, function (result) {
                                if (result) {
                                    tablepromedio(result);
                                }
                            });
                        }

                        function tablepromedio(result) {
                            $(document).ready(function () {
                                $('#logusuarios').DataTable({
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
                                        {title: "Fecha"},
                                        {title: "Evento"},
                                        {title: "Usuario"}





                                    ]
                                });
                            });
                        }
                    </script>-->
                    <table class="table table-bordered table-striped nowrap" id="logusuarios" class="display"width="100%;"></table>


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
    $(document).on('click', '#crearusuario', function () {
        var usuario = $('#nombre_usuario').val();
        var nombre = $('#nombre_completo').val();
        var clave = $('#password').val();
        var perfil = $('#perfil').val();
        var cedula = $('#cedula').val();

        var url = 'crearusuario.php?usuario=' + usuario + '&nombre=' + nombre + '&clave=' + clave + '&perfil=' + perfil + '&cedula=' + cedula;
        $.get(url, function (result) {
            if (result === 1)
            {
                alert('Usuario ya existe en el sistema');

            } else
            {
                $('#nombre_usuario').val("");
                $('#nombre_completo').val("");
                $('#password').val("");
                $('#passwordAgain').val("");

                $('#perfil').val("");
                $('#cedula').val("");
                location.reload(true);
            }
        });
    });
</script>



<!--
<script type="text/javascript">
    // Activating the side bar.
    var Change2Activejs = document.getElementById("sidebarProcesoBodega");
    Change2Activejs.className = "has-sub active";
    var Change2Activejs = document.getElementById("sidebarProcesoBodega-BatchPicking");
    Change2Activejs.className = "active";
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
</script>-->


<!-- end Configuration of accepted files -->


<!-- ================== BEGIN PAGE LEVEL JS ================== -->

<!-- ================== END PAGE LEVEL JS ================== -->
