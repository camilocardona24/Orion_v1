<?php
require_once '../vehiculominuto/conn.php';
$camara = $_GET['camara'];
$consulta = "select camara as cam, dir from or_camaras where id = $camara";
$resultado = pg_query($conexion, $consulta) or die ("error en la consulta".  pg_last_error());
while ($row = pg_fetch_assoc($resultado)){
    $data[] = $row['cam'];
    $data[] = $row['dir'];   
}
print json_encode($data);
//print json_encode(array_chunk($data, 7));
pg_close($conexion);