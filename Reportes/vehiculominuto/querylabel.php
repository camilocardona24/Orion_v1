<?php
require_once 'conn.php';
$camara = $_GET['camara'];
$consulta = 'select camara , fecha_min_data as fechami, fecha_max_data as fechama from or_camaras where camara = $camara';
          
$resultado = pg_query($conexion, $consulta) or die ("error en la consulta ". pg_last_error());
while($row = pg_fetch_assoc($resultado)){
    $data = $row['fechami']." entre ".$row['fechama'];        
}  
print json_encode($data);

