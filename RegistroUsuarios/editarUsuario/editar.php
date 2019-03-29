<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
<script src="js/sweet-alert.min.js"></script>
<?php
if($_SESSION['IDPERFIL']==2)
{
	?>
<script>
$( "#Activecheck" ).hide();

</script><?php
}
$lvlroot = "../../";
// Including Head.
include_once($lvlroot . "Body/Head.php");
// Including Begin Header.
include_once($lvlroot . "Body/BeginPage.php");
if($_SESSION['NOMBREUSUARIO'] == NULL)
   {
	?><script>
		window.location = "../../Home/exit.php"
	  </script><?php
   }
 
if($_SESSION['IDPERFIL'] == 1)
	{
		?><script>
		$( "#Activecheck" ).show();
		</script><?php
	}
// Including Side bar.
include_once($lvlroot . "Body/SideBar.php");
include("assets/php/start_session.php"); //Para hacer el LogIn en el App
session_start();
?>
<script>
// The lvlroot variable indicates the levels of direcctories (required to auth)
// the file loaded has to up, to be on the root directory
    var lvlroot = "../../";

</script>

<?php

include_once($lvlroot . "assets/php/PhpMySQL.php");

if(($_GET['id']) != ($_SESSION['IDUSUARIO']) && (($_SESSION['IDPERFIL'])!=1))
{
	echo '<script> setTimeout(function() {
			swal({	
				title: "Alerta",
					text: "No esta autorizado para realizar esta acción",
				showConfirmButton: false, 	
				imageUrl: "../../assets/img/logoplg.jpg",
				timer: 1000,
			
				type: "warning"	

				}, function() {
					window.location = "index.php";
			});
  				  }, 1000);	</script>';
}


$Client = new Database();
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $passwordAgain = $_POST['passwordAgain'];
    $perfil = $_POST['perfil'];
    $estado = $_POST['estado'];
    $id = $_GET['id'];


    $query = "update MR_USUARIOS set ID_PERFIL = $perfil,NOMBRE='$nombre',USUARIO='$usuario',CLAVE=sha1('$password'),CORREO='$correo',ESTADO = '$estado' where ID_USUARIO = $id";
    $queryResult = $Client->query($query);
    
    	if ($queryResult) {

		    echo '<script> setTimeout(function() {
			swal({	
				title: "",
					text: "Usuario actualizado con éxito",
				showConfirmButton: false, 	
				imageUrl: "../../assets/img/logoplg.jpg",
				timer: 2000,
			
				type: "success"	

				}, function() {
					window.location = "index.php";
			});
  				  }, 1000);	</script>';
?>
				<!--	<div class="alert m-b-o alert-success" id="modal-Note">Usuario actualizado con éxito.</div>-->
				<?php } 
								else {
					?>
					<div class="alert m-b-o alert-danger" id="modal-Note"> Error al actualizar el usuario </div>
					<?php
					}

				$query = "select *  from MR_USUARIOS where ID_USUARIO = $id";
				$queryResult = $Client->query($query);

				while ($clientData = $Client->fetch_array_assoc($queryResult)) {

					$campos['nombre'] = $clientData['NOMBRE'];
					$campos['usuario'] = $clientData['USUARIO'];
					$campos['correo'] = $clientData['CORREO'];
					$campos['password'] = $clientData['CLAVE'];
					//$campos['passwordAgain'] = $clientData['CLAVE'];
					$campos['clave'] = $clientData['CLAVE'];
					$campos['perfil'] = $clientData['ID_PERFIL'];
					$campos['estado'] = $clientData['ID_ESTADO_USUARIOS'];
			
   			 }
} else {
    $id = $_GET['id'];

    $query = "SELECT *  FROM MR_USUARIOS WHERE ID_USUARIO = $id";
    $queryResult = $Client->query($query);
  
    while ($clientData = $Client->fetch_array_assoc($queryResult)) {

        $campos['nombre'] = $clientData['NOMBRE'];
        $campos['usuario'] = $clientData['USUARIO'];
        $campos['correo'] = $clientData['CORREO'];
        $campos['password'] = $clientData['CLAVE'];
        //$campos['clave'] = $clientData['CLAVE'];
        $campos['clave'] = $clientData['CLAVE'];
        $campos['perfil'] = $clientData['ID_PERFIL'];
	  $campos['estado'] = $clientData['ID_ESTADO_USUARIOS'];
	  
    }
    
}

//require_once($lvlroot."assets/php/auth.php");
//include_once('../../assets/php/PhpMySQL.php');
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Inicio</a></li>
    <li><a href="javascript:;">Admin Usuarios</a></li>
    <li class="active">Crear Usuario</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Actualizar Usuario <small> Campos Obligatorios  (*) </small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <!-- begin panel -->
	  
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">
                    <i class="icon-user-follow fa-2x"></i> 
                    Actualizar información del Usuario <?php echo $usuario ?></h4>
            </div>
            <div class="panel-body panel-form">
                <form method="post" class="form-horizontal form-bordered" data-parsley-validate="true" name="FormCrearUsuario" id = "FormCrearUsuario">
                    <!-- Start campo nombre -->
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4" for="fullname">Nombre  (*):</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" id="fullname" name="nombre" placeholder="Nombre del nuevo usuario" data-parsley-required="true" value ="<?php echo $campos['nombre'] ?>" <?php echo $_SESSION['IDPERFIL']!=1 ? "readonly" : "" ?>/>
                        </div>
                    </div>
                    <!-- End campo nombre -->

                    <!-- Start campo nombre de usuario -->
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4" for="usuario">Nombre de usuario (*):</label>
			        <div class="col-md-6 col-sm-6">
					
                            <input class="form-control" type="text" id="usuario" name="usuario" placeholder="Nombre de usuario" data-parsley-required="true" data-parsley-length="[3, 15]" value ="<?php echo $campos['usuario'] ?>"<?php echo $_SESSION['IDPERFIL']!=1 ? "readonly" : "" ?> />

                        </div>
                    </div>
                    <!-- End campo nombre de usuario -->
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4" for="correo">Correo Electrónico (*):</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" id="correo" name="correo" placeholder="ejemplo@gmail.com" data-parsley-required="true" value ="<?php echo $campos['correo'] ?>"<?php echo $_SESSION['IDPERFIL']!=1 ? "readonly" : "" ?>/>

                        </div>
                    </div>

			  <!-- Password -->
			     <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4" for="correo">Contraseña(*):</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="password" id="password" name="password" placeholder="password" data-parsley-required="true" value ="<?php echo $campos['password'] ?>"  readonly="true"/>
				 <!--<input type="checkbox" name="optionHidePassword" value='-1' onchange="changeTypeTxtPassword()" data-render="switchery" data-theme="blue" data-change="check-switchery-state-text"  />-->
                             <input type="checkbox" name="Activecheck" id="Activecheck" data-theme="blue"data-render="switchery"onchange="activepassedition()"/> Activar Edición &nbsp;&nbsp;&nbsp;
		    		     <input type="checkbox" name="optionHidePassword" value='-1' onchange="changeTypeTxtPassword()" data-render="switchery" data-theme="blue" data-change="check-switchery-state-text"  /> Mostrar/Ocultar
                          </div>
                    </div>
		<script>
		function activepassedition()
		{				
			if(document.FormCrearUsuario.Activecheck.value)
			{
			document.getElementById("password").readOnly = false;
			}//need write the anothe way
			
		}
		</script>

                    <!-- Start campo perfil -->
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Perfil (*):</label>
                        <div class="col-md-6 col-sm-6">
                            <?php
                            ?>
                            <select class="form-control" id="select-required" name="perfil" data-parsley-required="true" <?php echo $_SESSION['IDPERFIL']!=1 ? "disabled" : "" ?>>

                                <option value="">Seleccione tipo de perfil para el nuevo usuario:</option>
                                <?php
                                $perfiles = "SELECT * FROM MR_PERFILES";
                                $queryResult = $Client->query($perfiles);
                                while ($clientData = $Client->fetch_array_assoc($queryResult)) {
                                    ?>
                                    <option value="<?php echo $clientData['ID_PERFIL'] ?>"  <?php echo $clientData['ID_PERFIL'] == $campos['perfil'] ? "selected" : "" ?>><?php echo $clientData['PERFIL'] ?></option>
                                    <?PHP
                                }
                                $Client->close();
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- End campo perfil -->
			         <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Estado (*):</label>
                        <div class="col-md-6 col-sm-6">
                            <?php
				    $Client = new Database();

                            ?>
                            <select class="form-control" id="select-required1" name="estado" data-parsley-required="true" <?php echo $_SESSION['IDPERFIL']!=1 ? "disabled" : "" ?>>

                                <option value="">Seleccione un estado para el usuario:</option>
                                <?php
                                $estados = "SELECT * FROM MR_ESTADO_USUARIOS";
                                $queryResult = $Client->query($estados);
                                while ($clientData = $Client->fetch_array_assoc($queryResult)) {
                                    ?>
                                    <option value="<?php echo $clientData['ID_ESTADO_USUARIOS'] ?>"  <?php echo $clientData['ID_ESTADO_USUARIOS'] == $campos['estado'] ? "selected" : "" ?>><?php echo $clientData['ESTADO'] ?></option>
                                    <?PHP
                                }
                                $Client->close();
                                ?>
                            </select>
                        </div>
                    </div>

			  

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4"><b>Los campos con (*) son obligatorios</b></label>									
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-primary"  name="AceptRegUser" >Actualizar Usuario</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
        <!-- end panel inverse -->
    </div>
    <!-- end col-12 -->

    <!-- #modal-alert -->
    <!-- modal-trigger -->
   	
</div>
<!-- end row -->

<?php
// Including Js actions, put in the end.
include_once($lvlroot . "Body/JsFoot.php");
// Including End Header.
include_once($lvlroot . "Body/EndPage.php");
?>


<script type="text/javascript">
    // Activating the side bar.
    var Change2Activejs = document.getElementById("sidebarAdminUsuarios");
    Change2Activejs.className = "has-sub active";
    var Changesub2Activejs = document.getElementById("sidebarAdminUsuarios-CrearUsuario");
    Changesub2Activejs.className = "active";

 
</script>

<script>
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




