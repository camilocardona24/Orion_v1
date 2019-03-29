<?php
//require_once '../vehiculominuto/conn.php';
//$camara = $_GET['camara'];
//$consulta = "select min(rv.fecha), max(rv.fecha) from or_registros_vehiculos as rv inner join or_camaras as c on rv.id_camaras = c.id where c.id = $camara";
//
//$resultado = pg_query($conexion, $consulta) or die ("error en la consulta".pg_last_error());
//while ($row = pg_fetch_row($resultado)){
//    $data[] = $row;
////    $data[] = $row['cam'];
////    $data[] = $row['min'];
////    $data[] = $row['max'];
//}
//print json_encode($data);

require_once '../vehiculominuto/conn.php';
$camara = $_GET['camara'];
$consulta = "select fecha_min_data as min, fecha_max_data as max from or_camaras
             where id = $camara
             order by id";
$resultado = pg_query($conexion, $consulta) or die ("error en la consulta".pg_last_error());
while ($row = pg_fetch_row($resultado)){
    $data[] = $row;
//    $data[] = $row['cam'];
//    $data[] = $row['min'];
//    $data[] = $row['max'];
}
print json_encode($data);