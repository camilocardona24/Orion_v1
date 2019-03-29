<?php

require_once "conn.php";
$consul_veh = 'select id, vehiculo from or_vehiculo_tipos';
$resul_veh = pg_query($conexion, $consul_veh) or die ("error consulta".  pg_last_error());

pg_close($conexion);