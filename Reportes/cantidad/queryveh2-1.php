<?php
require_once '../vehiculominuto/conn.php';
$camara = $_GET['camara'];
$fecha1 = $_GET['fecha1'].' 00:00:00';
$fecha2 = $_GET['fecha2'].' 23:59:59';
$consulta = "   select count(rv.id) as cont from or_registros_vehiculos as rv
                inner join or_registros_carriles as rc on rv.id = rc.id_vehiculos
                inner join or_camaras as c on rv.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                where v.id = 3 and rc.id_carril = 2 and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
                group by v.vehiculo
                order by v.vehiculo                                                                                                  
               ";
$resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
while ($row = pg_fetch_assoc($resultado)){  
    $data[] = $row['cont'] * 1;
}
print json_encode($data);
pg_close($conexion);

