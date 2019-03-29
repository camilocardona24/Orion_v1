
<?php

//AQUI CONECTAMOS A LA BASE DE DATOS DE POSTGRES
$conex = "host=181.129.51.43 port=5432 dbname=orion user=postgres password=Orion2017*";
$cnx = pg_connect($conex) or die ("<h1>Error de conexion.</h1> ". pg_last_error());
session_start();

function quitar($mensaje)
{
 $nopermitidos = array("'",'\\','<','>',"\"");
 $mensaje = str_replace($nopermitidos, "", $mensaje);
 return $mensaje;
}
if(trim($_POST["usuario"]) != "" && trim($_POST["password"]) != "")
{
 // Puedes utilizar la funcion para eliminar algun caracter en especifico
 //$usuario = strtolower(quitar($HTTP_POST_VARS["usuario"]));
 //$password = $HTTP_POST_VARS["password"];
 // o puedes convertir los a su entidad HTML aplicable con htmlentities
 $usuario = strtolower(htmlentities($_POST["usuario"], ENT_QUOTES));
 $password = $_POST["password"];
 $result = pg_query('SELECT contrasena, nombre_usuario FROM or_usuarios WHERE nombre_usuario=\''.$usuario.'\'');
 if($row = pg_fetch_array($result)){
  if($row["contrasena"] == $password){
				Header("Location:Home/");
?>   <SCRIPT LANGUAGE="javascript">
   location.href = "Camaras/index.php";
   </SCRIPT><?php
  }else{
   echo 'Password incorrecto';echo $usuario.    $password;
  }
 }else{
  echo 'Usuario no existente en la base de datos';
 }
 pg_free_result($result);
}else{
    
 echo 'Debe especificar un usuario y password';
}
pg_close();
?>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

