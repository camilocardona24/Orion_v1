<?php
require_once '../Reportes/vehiculominuto/conn.php';
$fechac = date("Y-m-d", time()).' 23:59:59';
$fechap_0 = date("Y-m-d", strtotime("this week")).' 00:00:00';
$fechap_1 = date("Y-m-d", strtotime("last week")).' 00:00:00';
$fechap_2 = date("Y-m-d", strtotime("first day of this month")).' 00:00:00';
$fechap_3 = date("Y-m-d", strtotime("last month")).' 00:00:00';
$fechap_4 = date("Y-m-d", strtotime("first day of previous month")).' 00:00:00';
$camara = $_GET['camara'];
$car = "2";
$consulta = "   select count(rv.id) as cont from or_registros_vehiculos as rv
                inner join or_camaras as c on rv.id_camaras = c.id
                inner join or_registros_carriles as rc on rv.id = rc.id_vehiculos               
                where rc.id_carril = $car and c.id = $camara and rv.fecha between '$fechap_0' and '$fechac'
                group by rc.id_carril
                order by rc.id_carril                                                                                                      
                ";
$resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
while ($row = pg_fetch_assoc($resultado)){  
    $data = $row['cont'] * 1;
}
if ($data == null){           
    $consulta = "   select count(rv.id) as cont from or_registros_vehiculos as rv
                    inner join or_camaras as c on rv.id_camaras = c.id
                    inner join or_registros_carriles as rc on rv.id = rc.id_vehiculos               
                    where rc.id_carril = $car and c.id = $camara and rv.fecha between '$fechap_1' and '$fechac'
                    group by rc.id_carril
                    order by rc.id_carril                                                                                                      
                    "; 
    $resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
    while ($row = pg_fetch_assoc($resultado)){  
        $data[] = $row['cont'] * 1;
    }
    if ($data == null){
        $consulta = "   select count(rv.id) as cont from or_registros_vehiculos as rv
                        inner join or_camaras as c on rv.id_camaras = c.id
                        inner join or_registros_carriles as rc on rv.id = rc.id_vehiculos               
                        where rc.id_carril = $car and c.id = $camara and rv.fecha between '$fechap_2' and '$fechac'
                        group by rc.id_carril
                        order by rc.id_carril                                                                                                      
                        "; 
        $resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
        while ($row = pg_fetch_assoc($resultado)){  
            $data[] = $row['cont'] * 1;
        }
        if ($data == null){            
            $consulta = "   select count(rv.id) as cont from or_registros_vehiculos as rv
                            inner join or_camaras as c on rv.id_camaras = c.id
                            inner join or_registros_carriles as rc on rv.id = rc.id_vehiculos               
                            where rc.id_carril = $car and c.id = $camara and rv.fecha between '$fechap_3' and '$fechac'
                            group by rc.id_carril
                            order by rc.id_carril                                                                                                      
                            "; 
            $resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
            while ($row = pg_fetch_assoc($resultado)){  
                $data[] = $row['cont'] * 1;
            }
            if ($data == null){
                $consulta = "   select count(rv.id) as cont from or_registros_vehiculos as rv
                                inner join or_camaras as c on rv.id_camaras = c.id
                                inner join or_registros_carriles as rc on rv.id = rc.id_vehiculos               
                                where rc.id_carril = $car and c.id = $camara and rv.fecha between '$fechap_4' and '$fechac'
                                group by rc.id_carril
                                order by rc.id_carril                                                                                                      
                                ";
                $resultado = pg_query($conexion, $consulta) or die ( "ERROR". pg_last_error());
                while ($row = pg_fetch_assoc($resultado)){  
                    $data[] = $row['cont'] * 1;
                }
            }    
            
        }
    }
}
print json_encode($data);
pg_close($conexion);

