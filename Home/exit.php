<?php
session_start();
unset($_SESSION["nombre_usario"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
unset($_SESSION["id_usuario"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**

header("Location:../index.php");


?>