<?php
require_once '../vehiculominuto/conn.php';
$camara = $_GET['camara'];
$fecha1 = $_GET['fecha1'].' 00:00:00';
$fecha2 = $_GET['fecha2'].' 23:59:59';
$consulta = "   select date_trunc('H', rh.fecha) + 
                (floor(extract('minute' from rh.fecha)/15)*15) * '1 minute'::interval as time from or_registros_headway as rh
                inner join or_registros_vehiculos as rv on rv.id = rh.id_vehiculos
                inner join or_carriles as ci on rh.id_carril = ci.id
                inner join or_camaras as c on rh.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id                
                where c.id = $camara and rh.fecha between '$fecha1' and '$fecha2'
                group by time               
                order by time                                                                                                      
               ";
$resultado  = pg_query($conexion, $consulta) or die ( "Error en la consulta ". pg_last_error());
while ($row = pg_fetch_assoc($resultado)){
    $data[] = $row['time'];
}
print json_encode($data);
pg_close($conexion);
