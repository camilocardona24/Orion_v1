<?php
//$user = 'orionpguser';
//$pass = 'ASDqwe123?';
//$db = 'orionpg';
//$port = 5432;
//$host = 'localhost';
//$conexion = "host=$host port=$port dbname=$db user=$user password=$pass";
$conexion = pg_connect( "host=181.129.51.43 port=5432 dbname=orion user=postgres password=Orion2017*"  );
if (!$conexion){
    echo "Error, Problemas al conectar con el servidor".pg_last_error();
}
else
{
//    echo "conexion exitosa" ;
}    
//$consulta = 'select "CAMARA" from "OR_CAMARAS"' ;
//$re = pg_query($conexion, $consulta) or die ("error consulta".  pg_last_error());
//
//while ($row = pg_fetch_array($re)){
//    $data[] = $row['CAMARA'];
//}
//print json_encode($data);

