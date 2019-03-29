<?php
require_once '../vehiculominuto/conn.php';
$camara = $_GET['camara'];
$consulta  = "  select fecha_min_data as min from or_camaras
                where id = $camara
                ";
$consulta1 = "  select max(rv.fecha) as max from or_registros_vehiculos as rv
                inner join or_camaras as c on rv.id_camaras = c.id
                where c.id = $camara ";
$resultado  = pg_query($conexion, $consulta) or die ("error en la consulta".pg_last_error());
$resultado1 = pg_query($conexion, $consulta1) or die ("error en la consulta 1".pg_last_error());
while ($row = pg_fetch_assoc($resultado)){
    $row1 = pg_fetch_assoc($resultado1);
    $data[] = $row['min'];
    $data[] = $row1['max'];
}
//    $data[] = $row['cam'];
//    $data[] = $row['min'];
//    $data[] = $row['max'];
print json_encode(array_chunk($data,2));
//print json_encode($data);
pg_close($conexion);