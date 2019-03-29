<?php

$conexion = pg_connect( "host=181.129.51.43 port=5432 dbname=orion user=postgres password=Orion2017*"  );
//$conexion = pg_connect( "host=localhost port=5432 dbname=orionpg user=orionuserpg password=ASDqwe123?"  );
if (!$conexion){
    echo "Error, Problemas al conectar con el servidor".pg_last_error();
}
else
{
//    echo "conexion exitosa" ;
}   