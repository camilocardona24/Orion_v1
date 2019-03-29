<?php


//$consulta1 = "   select date_trunc('H', rv.fecha) + 
//                (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time1,
//                count(rv.id) as cont from or_registros_vehiculos as rv
//                inner join or_camaras as c on rv.id_camaras = c.id
//                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
//                where v.id = 2 and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
//                group by time1
//                order by time1                                                                                                      
//                ";
//$consulta2 = "  select count(a.time2) as contar from (select  extract('epoch' from date_trunc('H', rv.fecha_registro) + 
//                (round(extract('minute' from rv.fecha_registro)/15)*15) * '1 minute'::interval) as time2 
//                from or_registros_vehiculos as rv
//                inner join or_aforo_cam_user as acu on rv.id_camaras = acu.id_cam
//                inner join or_aforos as a on acu.id_aforo = a.id
//                inner join or_vehiculos_tipo v on rv.id_vehiculos = v.id 
//                inner join or_users u on rv.id_user = u.id
//                inner join or_camaras c on rv.id_camaras =c.id
//                group by time2) as a                       
//               ";

require_once '../vehiculominuto/conn.php';
//queryveh-0.php?camara=63&fecha1=2018-09-03&fecha2=2018-09-06
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
$consulta1 = "  select date_trunc('H', rh.fecha) + 
                (floor(extract('minute' from rh.fecha)/15)*15) * '1 minute'::interval as time1,
                sum(rh.headway) as suma, count(rh.id_vehiculos) as cont 
                from or_registros_headway as rh               
                inner join or_registros_vehiculos as rv on rv.id = rh.id_vehiculos
                inner join or_carriles as ci on rh.id_carril = ci.id
                inner join or_camaras as c on rh.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id  
               
                where ci.id = 1 and c.id = $camara and rh.fecha between '$fecha1' and '$fecha2'
                group by time1
                
                order by time1                                                                                                      
               ";
//$consulta2 = "  select count(a.time2) as contar from (select date_trunc('H', rh.fecha) + 
//                (floor(extract('minute' from rh.fecha)/15)*15) * '1 minute'::interval as time2 from or_registros_headway as rh
//                inner join or_registros_vehiculos as rv on rv.id = rh.id_vehiculos
//                inner join or_carriles as ci on rh.id_carril = ci.id
//                inner join or_camaras as c on rh.id_camaras = c.id
//                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id                 
//                where c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
//                group by time2               
//                order by time2 ) as a                                                                                                     
//               ";
$resultado  = pg_query($conexion, $consulta) or die ( "Error en la consulta ". pg_last_error());
$resultado1 = pg_query($conexion, $consulta1) or die ( "Error en la consulta 2". pg_last_error());
//$resultado2 = pg_query($conexion, $consulta2) or die ( "Error en la consulta 2". pg_last_error());
//while ($row2 = pg_fetch_assoc($resultado2)){
//    $cant[] = $row2['contar'];
////    echo join($cant);
//}
While ($row1 = pg_fetch_assoc($resultado1)){
    $fecha1 = $row1['time1'];
    $conteo = $row1['cont'] * 1;
    $sumatoria = $row1['suma'] * 1;
    $total = 0;
    while ($row = pg_fetch_assoc($resultado)){  
        $fecha =  $row['time'];      
        if ($fecha1 == $fecha){
//            $data[] = $fecha;
//            $data[] = $conteo;
            $data[] = (round(($sumatoria / $conteo) * 100)) / 100;           
//            $data[] = $sumatoria;
            break;
        }
        else if ($fecha1 != $fecha){
//        $data[] = $fecha;
//        $data[] = 0;
        $data[] = 0;
        }
    }
}
//While ($row1 = pg_fetch_assoc($resultado1)){
//    $fecha1 = $row1['time1'];
//    $sumatoria = $row1['suma'] * 1;
//    while ($row = pg_fetch_assoc($resultado)){  
//        $fecha =  $row['time'];      
//        if ($fecha1 == $fecha){
//            $data[] = $fecha;
//            $data[] = $sumatoria;
//            break;
//        }
//        else if ($fecha1 != $fecha){
//        $data[] = $fecha;
//        $data[] = 0;
//        }
//    }
//}
//print json_encode(array_chunk($data, 2));
print json_encode($data);
pg_close($conexion);