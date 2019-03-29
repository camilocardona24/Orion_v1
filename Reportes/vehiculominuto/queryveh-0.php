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
                where c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
                group by time
                order by time                                                                                                      
                ";
$consulta1 = "  select date_trunc('H', rv.fecha) + 
                (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time1,
                count(rv.id) as cont from or_registros_vehiculos as rv
                inner join or_camaras as c on rv.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                where v.id = 1 and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
                group by time1
                order by time1                                                                                                      
                ";
//$consulta1 = "   select date_trunc('H', rv.fecha) + 
//                (round(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time1,
//                count(rv.id) as cont from or_registros_vehiculos as rv
//                inner join or_camaras as c on rv.id_camaras = c.id
//                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
//                where v.id = 1 and c.id = $camara and rv.fecha between '$fecha1' and '$fecha2'
//                group by time1
//                order by time1                                                                                                     
//                ";
//"select date_trunc('H', rv.fecha_registro) + 
//                (round(extract('minute' from rv.fecha_registro)/15)*15) * '1 minute'::interval as time
//                from or_registros_vehiculos as rv
//                inner join or_aforo_cam_user as acu on rv.id_camaras = acu.id_cam
//                inner join or_aforos as a on acu.id_aforo = a.id
//                inner join or_vehiculos_tipo v on rv.id_vehiculos = v.id 
//                inner join or_users u on rv.id_user = u.id
//                inner join or_camaras c on rv.id_camaras =c.id               
//                group by time
//                order by time";
$resultado  = pg_query($conexion, $consulta) or die ( "Error en la consulta ". pg_last_error());
$resultado1 = pg_query($conexion, $consulta1) or die ( "Error en la consulta 2". pg_last_error());
//while ($row = pg_fetch_assoc($resultado)){   
////    $data[] = $row['time'];
//    $data[] = $row['cont'] * 1;  
//}
While ($row1 = pg_fetch_assoc($resultado1)){
    $fecha1 = $row1['time1'];
    $conteo = $row1['cont'] * 1;
    while ($row = pg_fetch_assoc($resultado)){  
        $fecha =  $row['time'];      
        if ($fecha1 == $fecha){
//            $data[] = $fecha;
            $data[] = $conteo;
            break;
        }
        else if ($fecha1 != $fecha){
//        $data[] = $fecha;
        $data[] = 0;
        }
    }
}
//print json_encode(array_chunk($data, 2));
print json_encode($data);
pg_close($conexion);


