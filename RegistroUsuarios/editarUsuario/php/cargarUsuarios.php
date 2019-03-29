<?php
	/*<!--
	* Este archivo retorna los documentos de transporte
	* existentes.
	-->*/
	include_once('../../../assets/php/PhpMySQL.php');
	$usuarios = new Database();

	$userselected = $_GET['userselected'];//no debe tener id pag

	$queryUsuarios = "SELECT NOMBRE, USUARIO, USUARIO AS USERHIDDEN, AES_DECRYPT(CLAVE,MD5(USUARIO)) AS PASSWD, AES_DECRYPT(CLAVE,MD5(USUARIO)) AS CLAVE, PERFIL FROM `usuarios_wms` " //Datos Clave cifrada
		."WHERE USUARIO = '$userselected'"; 
	//echo($queryUsuarios);
	$queryUsuariosResult = $usuarios->query($queryUsuarios);

	while($usuariosData = $usuarios->fetch_array_assoc($queryUsuariosResult))
	{
		$dataArray[] = $usuariosData;
	}
	$usuarios->close();
	print json_encode($dataArray);
?>