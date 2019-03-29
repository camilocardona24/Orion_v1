

<?php

require_once 'conn.php';

$vehiculo = $_GET['vehiculo'];
$camara = $_GET['camara'];
$fecha1 = $_GET['fecha1'].' 00:00:00';
$fecha2 = $_GET['fecha2'].' 23:59:59';

$consul_area = " select distinct extract(epoch from rv.fecha) as fecha from or_registros_vehiculos as rv
                 inner join or_camaras as c on rv.id_camaras = c.id
                 inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                 where v.id = $vehiculo and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
                 order by fecha
                "; 
$consul_cont = " select count(rv.id) as cont from or_registros_vehiculos as rv
                 inner join or_camaras as c on rv.id_camaras = c.id
                 inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                 where v.id = $vehiculo and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
                 group by cast(rv.fecha as time)
                 order by cast(rv.fecha as time)
                "; 
$resul_area = pg_query($conexion, $consul_area) or die ( "error en la consulta". pg_last_error());
$resul_cont = pg_query($conexion, $consul_cont) or die ( "ERROR". pg_last_error());
while ($row_area = pg_fetch_assoc($resul_area) and $row_cont = pg_fetch_assoc($resul_cont)){
    $data[] = $row_area['fecha']  * 1;
    $data[] = $row_cont['cont'] * 1;
}

print json_encode(array_chunk($data,2));

pg_close($conexion);
//
//$consul_stock = 'select distinct extract(epoch from rv."FECHA") as fecha from "OR_REGISTROS_VEHICULOS" as rv 
//                 inner join "OR_CAMARAS" as c on rv."ID_CAMARAS" = c."ID"
//                 inner join or_vehiculo_tipos as v on rv."ID_VEHICULOS" = v."ID"
//                 where rv."ID_VEHICULOS" = '.$vehiculo.' and rv."ID_CAMARAS" = '.$camara.' and rv."FECHA" between \''. $fecha1.'\' and \''.$fecha2.'\'order by fecha';
//
//$consul_cont = 'select count(rv."ID") as cont from "OR_REGISTROS_VEHICULOS" as rv
//                inner join "OR_CAMARAS" as c on rv."ID_CAMARAS" = c."ID"
//                inner join or_vehiculo_tipos as v on rv."ID_VEHICULOS" = v."ID"
//                where rv."ID_VEHICULOS" = '.$vehiculo.' and rv."ID_CAMARAS" = '.$camara.' and rv."FECHA" between \''. $fecha1.'\' and \''.$fecha2.
//               '\'group by cast(rv."FECHA" as time)
//                order by cast(rv."FECHA" as time) ';
//$resul_stock = pg_query($conexion, $consul_stock) or die ( "error en la consulta". pg_last_error());
//$resul_cont = pg_query($conexion, $consul_cont) or die ( "ERROR". pg_last_error());
//
//while ( $row_stock = pg_fetch_assoc($resul_stock) and $row_cont = pg_fetch_assoc($resul_cont)){
//    $data[] = $row_stock['fecha'] * 1000;
//    $data[] = $row_cont['cont'] * 1;
//}
////while ($row_cont = pg_fetch_assoc($resul_cont)){
////    $data[] = $row_cont['cont'];
////}
//
//print json_encode(array_chunk($data,2));

