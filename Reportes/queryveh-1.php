<?php

require_once 'conn.php';

$vehiculo = $_GET['vehiculo'];
$camara = $_GET['camara'];
$fecha1 = $_GET['fecha1'].' 00:00:00';
$fecha2 = $_GET['fecha2'].' 23:59:59';

//$consul_area = " select distinct extract(epoch from rv.fecha) as fecha from or_registros_vehiculos as rv
//                 inner join or_camaras as c on rv.id_camaras = c.id
//                 inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
//                 where v.id = $vehiculo and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
//                 order by fecha
//                "; 
$consul_cont = " select count(rv.id) as cont from or_registros_vehiculos as rv
                 inner join or_camaras as c on rv.id_camaras = c.id
                 inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                 where v.id = 2 and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
                 group by v.vehiculo
                 order by v.vehiculo
                "; 
//$resul_area = pg_query($conexion, $consul_area) or die ( "error en la consulta". pg_last_error());
$resul_cont = pg_query($conexion, $consul_cont) or die ( "ERROR". pg_last_error());
while ($row_cont = pg_fetch_assoc($resul_cont)){  
    $data[] = $row_cont['cont'] * 1;
}
//while ($row_area = pg_fetch_assoc($resul_area) and $row_cont = pg_fetch_assoc($resul_cont)){
//    $data[] = $row_area['fecha']  * 1;
//    $data[] = $row_cont['cont'] * 1;
//}

//print json_encode(array_chunk($data,2));
print json_encode($data);

pg_close($conexion);

