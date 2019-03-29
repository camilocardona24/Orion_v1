<?php

require_once "conn.php";
$consul_veh = 'select id, vehiculo from or_vehiculo_tipos';
$consulta = 'select id, camara, dir from or_camaras order by id';
//$resul_veh = pg_query($conexion, $consul_veh) or die ("error consulta".  pg_last_error());
$resultado = pg_query($conexion, $consulta) or die ("error en la consulta ". pg_last_error());
//while ($row_veh = pg_fetch_array($resul_veh) ){
//    $data[] = $row_veh['vehiculo'];
//}
//print json_encode($data);
//if ($i > 63){ } else if ($i <= 53 ){echo $row['id'];} else if ($i >= 60 ){echo $row['id'];
//if ($i > 63){ } else if ($i <= 53 ){echo $row['cam']." - ".$row['dir'];} else if ($i >= 60 ){echo $row['cam']." - ".$row['dir'];}  $i++ ;
pg_close($conexion);

