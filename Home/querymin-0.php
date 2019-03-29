<?php
require_once '../Reportes/vehiculominuto/conn.php';
$fechac = date("Y-m-d", time()).' 23:59:59';
$fechap_0 = date("Y-m-d", strtotime("this week")).' 00:00:00';
$fechap_1 = date("Y-m-d", strtotime("last week")).' 00:00:00';
$fechap_2 = date("Y-m-d", strtotime("first day of this month")).' 00:00:00';
$fechap_3 = date("Y-m-d", strtotime("last month")).' 00:00:00';
$fechap_4 = date("Y-m-d", strtotime("first day of previous month")).' 00:00:00';
$veh = "1";
$camara = $_GET['camara'];
$consulta = "   select date_trunc('H', rv.fecha) + 
                (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time
                from or_registros_vehiculos as rv
                inner join or_camaras as c on rv.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id               
                where c.id = $camara and rv.fecha between '$fechap_0' and '$fechac'
                group by time
                order by time                                                                                                      
                ";
$consulta1 = "   select date_trunc('H', rv.fecha) + 
                (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time1,
                count(rv.id) as cont from or_registros_vehiculos as rv
                inner join or_camaras as c on rv.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id               
                where v.id = $veh and c.id = $camara and rv.fecha between '$fechap_0' and '$fechac'
                group by time1
                order by time1                                                                                                      
                ";
$resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
$resultado1 = pg_query($conexion, $consulta1) or die ( "ERROR". pg_last_error());
While ($row1 = pg_fetch_assoc($resultado1)){
    $fecha1 = $row1['time1'];
    $conteo = $row1['cont'] * 1;
    while ($row = pg_fetch_assoc($resultado)){  
        $fecha =  $row['time'];      
        if ($fecha1 == $fecha){
            $data[] = $conteo;
            break;
        }
        else if ($fecha1 != $fecha){
        $data[] = 0;
        }
    }
}
if ($data == null){
    $consulta = "   select date_trunc('H', rv.fecha) + 
                (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time
                from or_registros_vehiculos as rv
                inner join or_camaras as c on rv.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id               
                where c.id = $camara and rv.fecha between '$fechap_1' and '$fechac'
                group by time
                order by time                                                                                                      
                ";
    $consulta1 = "   select date_trunc('H', rv.fecha) + 
                    (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time1,
                    count(rv.id) as cont from or_registros_vehiculos as rv
                    inner join or_camaras as c on rv.id_camaras = c.id
                    inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id               
                    where v.id = $veh and c.id = $camara and rv.fecha between '$fechap_1' and '$fechac'
                    group by time1
                    order by time1                                                                                                      
                    ";
    $resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
    $resultado1 = pg_query($conexion, $consulta1) or die ( "ERROR". pg_last_error());
    While ($row1 = pg_fetch_assoc($resultado1)){
        $fecha1 = $row1['time1'];
        $conteo = $row1['cont'] * 1;
        while ($row = pg_fetch_assoc($resultado)){  
            $fecha =  $row['time'];      
            if ($fecha1 == $fecha){
                $data[] = $conteo;
                break;
            }
            else if ($fecha1 != $fecha){
            $data[] = 0;
            }
        }
    }
    if ($data == null){
        $consulta = "   select date_trunc('H', rv.fecha) + 
                    (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time
                    from or_registros_vehiculos as rv
                    inner join or_camaras as c on rv.id_camaras = c.id
                    inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id               
                    where c.id = $camara and rv.fecha between '$fechap_2' and '$fechac'
                    group by time
                    order by time                                                                                                      
                    ";
        $consulta1 = "   select date_trunc('H', rv.fecha) + 
                        (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time1,
                        count(rv.id) as cont from or_registros_vehiculos as rv
                        inner join or_camaras as c on rv.id_camaras = c.id
                        inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id               
                        where v.id = $veh and c.id = $camara and rv.fecha between '$fechap_2' and '$fechac'
                        group by time1
                        order by time1                                                                                                      
                        ";
        $resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
        $resultado1 = pg_query($conexion, $consulta1) or die ( "ERROR". pg_last_error());
        While ($row1 = pg_fetch_assoc($resultado1)){
            $fecha1 = $row1['time1'];
            $conteo = $row1['cont'] * 1;
            while ($row = pg_fetch_assoc($resultado)){  
                $fecha =  $row['time'];      
                if ($fecha1 == $fecha){
                    $data[] = $conteo;
                    break;
                }
                else if ($fecha1 != $fecha){
                $data[] = 0;
                }
            }
        }
        if ($data == null){
            $consulta = "   select date_trunc('H', rv.fecha) + 
                        (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time
                        from or_registros_vehiculos as rv
                        inner join or_camaras as c on rv.id_camaras = c.id
                        inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id               
                        where c.id = $camara and rv.fecha between '$fechap_3' and '$fechac'
                        group by time
                        order by time                                                                                                      
                        ";
            $consulta1 = "   select date_trunc('H', rv.fecha) + 
                            (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time1,
                            count(rv.id) as cont from or_registros_vehiculos as rv
                            inner join or_camaras as c on rv.id_camaras = c.id
                            inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id               
                            where v.id = $veh and c.id = $camara and rv.fecha between '$fechap_3' and '$fechac'
                            group by time1
                            order by time1                                                                                                      
                            ";
            $resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
            $resultado1 = pg_query($conexion, $consulta1) or die ( "ERROR". pg_last_error());
            While ($row1 = pg_fetch_assoc($resultado1)){
                $fecha1 = $row1['time1'];
                $conteo = $row1['cont'] * 1;
                while ($row = pg_fetch_assoc($resultado)){  
                    $fecha =  $row['time'];      
                    if ($fecha1 == $fecha){
                        $data[] = $conteo;
                        break;
                    }
                    else if ($fecha1 != $fecha){
                    $data[] = 0;
                    }
                }
            }
            if ($data == null){
                $consulta = "   select date_trunc('H', rv.fecha) + 
                            (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time
                            from or_registros_vehiculos as rv
                            inner join or_camaras as c on rv.id_camaras = c.id
                            inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id               
                            where c.id = $camara and rv.fecha between '$fechap_4' and '$fechac'
                            group by time
                            order by time                                                                                                      
                            ";
                $consulta1 = "   select date_trunc('H', rv.fecha) + 
                                (floor(extract('minute' from rv.fecha)/15)*15) * '1 minute'::interval as time1,
                                count(rv.id) as cont from or_registros_vehiculos as rv
                                inner join or_camaras as c on rv.id_camaras = c.id
                                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id               
                                where v.id = $veh and c.id = $camara and rv.fecha between '$fechap_4' and '$fechac'
                                group by time1
                                order by time1                                                                                                      
                                ";
                $resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
                $resultado1 = pg_query($conexion, $consulta1) or die ( "ERROR". pg_last_error());
                While ($row1 = pg_fetch_assoc($resultado1)){
                    $fecha1 = $row1['time1'];
                    $conteo = $row1['cont'] * 1;
                    while ($row = pg_fetch_assoc($resultado)){  
                        $fecha =  $row['time'];      
                        if ($fecha1 == $fecha){
                            $data[] = $conteo;
                            break;
                        }
                        else if ($fecha1 != $fecha){
                        $data[] = 0;
                        }
                    }
                }
            }
        }
    }
}
print json_encode($data);
pg_close($conexion);

