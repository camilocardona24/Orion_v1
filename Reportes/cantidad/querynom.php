<?php
require_once '../vehiculominuto/conn.php';
$camara = $_GET['camara'];
$fecha1 = $_GET['fecha1'].' 00:00:00';
$fecha2 = $_GET['fecha2'].' 23:59:59';
$consulta = "   select v.vehiculo as veh from or_registros_vehiculos as rv
                
                inner join or_camaras as c on rv.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                where c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
                group by veh
                order by veh                                                                                                             
               ";
$resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
while ($row = pg_fetch_assoc($resultado)){  
    $data[] = $row['veh'];
}
print json_encode($data);
pg_close($conexion);

