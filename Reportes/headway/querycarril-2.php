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
$consulta1 = "  select date_trunc('H', rh.fecha) + 
                (floor(extract('minute' from rh.fecha)/15)*15) * '1 minute'::interval as time1,
                sum(rh.headway) as suma, count(rh.id_vehiculos) as cont 
                from or_registros_headway as rh               
                inner join or_registros_vehiculos as rv on rv.id = rh.id_vehiculos
                inner join or_carriles as ci on rh.id_carril = ci.id
                inner join or_camaras as c on rh.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id  
               
                where ci.id = 3 and c.id = $camara and rh.fecha between '$fecha1' and '$fecha2'
                group by time1
                
                order by time1                                                                                                      
               ";
$resultado  = pg_query($conexion, $consulta) or die ( "Error en la consulta ". pg_last_error());
$resultado1 = pg_query($conexion, $consulta1) or die ( "Error en la consulta 2". pg_last_error());
While ($row1 = pg_fetch_assoc($resultado1)){
    $fecha1 = $row1['time1'];
    $conteo = $row1['cont'] * 1;
    $sumatoria = $row1['suma'] * 1;
    $total = 0;
    while ($row = pg_fetch_assoc($resultado)){  
        $fecha =  $row['time'];      
        if ($fecha1 == $fecha){
//            $data[] = $fecha;
            $data[] = (round(($sumatoria / $conteo) * 100)) / 100;           
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

