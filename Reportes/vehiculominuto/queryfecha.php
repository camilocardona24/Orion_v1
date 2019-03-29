
<?php

require_once 'conn.php';
$camara = $_GET['camara'];
$fecha1 = $_GET['fecha1'].' 00:00:00';
$fecha2 = $_GET['fecha2'].' 23:59:59';
$consulta = "   select date_trunc('H', rv.fecha) + 
                (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time
                from or_registros_vehiculos as rv
                inner join or_camaras as c on rv.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                where v.id = 1 and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
                group by time
                order by time          
                ";
$resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
while ($row = pg_fetch_assoc($resultado)){
    $data[] = $row['time'];
}
print json_encode($data);
pg_close($conexion);
