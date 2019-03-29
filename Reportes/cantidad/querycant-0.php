<?php

require_once '../vehiculominuto/conn.php';
$camara = $_GET['camara'];
$fecha1 = $_GET['fecha1'].' 00:00:00';
$fecha2 = $_GET['fecha2'].' 23:59:59';
$consulta = "   select count(rv.id) as cont from or_registros_vehiculos as rv
                 inner join or_camaras as c on rv.id_camaras = c.id
                 inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                 where v.id = 1 and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
                 group by v.vehiculo
                 order by v.vehiculo                                                                                                  
               ";
$consulta1 = "   select count(rv.id) as cont from or_registros_vehiculos as rv
                 inner join or_camaras as c on rv.id_camaras = c.id
                 inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                 where v.id = 2 and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
                 group by v.vehiculo
                 order by v.vehiculo                                                                                                  
               ";
$consulta2 = "   select count(rv.id) as cont from or_registros_vehiculos as rv
                 inner join or_camaras as c on rv.id_camaras = c.id
                 inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                 where v.id = 3 and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
                 group by v.vehiculo
                 order by v.vehiculo                                                                                                  
               ";

$resultado  = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
$resultado1 = pg_query($conexion, $consulta1) or die ( "ERROR". pg_last_error());
$resultado2 = pg_query($conexion, $consulta2) or die ( "ERROR". pg_last_error());
//$row  = pg_fetch_assoc($resultado);
//$row1 = pg_fetch_assoc($resultado1);
//$row2 = pg_fetch_assoc($resultado2);
//$data = $row['cont'];
//$data1 = $row1['cont'];
//$data2 = $row2['cont'];
while ($row = pg_fetch_assoc($resultado)){   
    $data = $row['cont'] * 1;
//    echo $data;
}
//echo join($data, ',');
//echo $data;
while ($row1 = pg_fetch_assoc($resultado1)){   
    $data1 = $row1['cont'] * 1;
//    echo $data1;
}
while ($row2 = pg_fetch_assoc($resultado2)){   
    $data2 = $row2['cont'] * 1;
//    echo $data2;
}
//echo $data2;
//print json_encode($data);
pg_close($conexion);
