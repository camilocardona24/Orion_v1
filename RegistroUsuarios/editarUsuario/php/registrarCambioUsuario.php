<?php
// Cargando Archivo para BD
require_once("../../assets/php/PhpMySQL.php");
// Cargando función de autenticación
//require_once('../auth.php');

if (isset($_POST['AceptEditUser']))
{
    //$ID = $_POST['ID_USUARIO'];
    $NOMBRE = $_POST['nombre'];
    $USUARIO = $_POST['usuario'];
    $USUARIOHIDDEN = $_POST['usuarioHidden'];
    $CLAVE = $_POST['password'];
    $PERFIL = $_POST['perfil'];  

    $DB = New Database();
    $queryUser = "SELECT * FROM MR_USUARIOS WHERE USUARIO='$USUARIO'"; 
    $checkuser = $DB->query($queryUser); //return ID_USUARIO,NOMBRE,USUARIO,CLAVE,PERFIL
    $temp2 = array();
    while($temp = $DB->fetch_array($checkuser))
    {
        $temp2 =$temp;
    }
    
    if($USUARIOHIDDEN != $USUARIO)
    {
        $checkuser = mysql_query("SELECT USUARIO FROM MR_USUARIOS WHERE USUARIO = '$USUARIO'"); //return USUARIO
        $username_exist = mysql_num_rows($checkuser); //cuenta resultado query check user
    }
    else{
        $username_exist=0;
    }

 ?>    
    <script>//alert(' <?php //echo $username_exist; ?> ');</script>    
 <?php

    if($username_exist>0)
    {           
        ?>
        <script language='javascript'>
        window.onload = function reloadModal(){                
        document.getElementById('alert-Header').innerHTML = "No ha sido posible actualizar el usuario";
        document.getElementById('alert-comentary').innerHTML = "El usuario <?php echo "''".($USUARIO)."''";?> ya existe.";
        document.getElementById('alert-trigger').click();
        }
        </script>
        <?php
        //echo "<script language='javascript'>alert('El nombre de usuario $USUARIO ya está en uso');</script>";
    }
    else{
        //$edituser = mysql_query("UPDATE usuarios_wms SET NOMBRE='$NOMBRE',USUARIO='$USUARIO',CLAVE='$CLAVE',PERFIL='$PERFIL' WHERE USUARIO='$USUARIOHIDDEN'"); //SIN Cifrar clave    
        $edituser = mysql_query("UPDATE MR_USUARIOS SET NOMBRE='$NOMBRE',USUARIO='$USUARIO',CLAVE=AES_ENCRYPT('$CLAVE',MD5('$USUARIO')),PERFIL='$PERFIL' WHERE USUARIO='$USUARIOHIDDEN'"); //Cifrar clave
        ?>
        <script language='javascript'>
            window.onload = function reloadModal(){
            document.getElementById('modal-Header').innerHTML = "Usuario Actualizado";
            document.getElementById('modal-Note').innerHTML = "El usuario <?php echo "''".($USUARIOHIDDEN)."''";?> ha sido actualizado exitosamente.";
            document.getElementById('modal-trigger').click();
            }
        </script>
    <?php
    }
?>
 
<?php
    //mysql_close($conexion);
    $DB->close();
   }
?>


