<?php
require_once '../vehiculominuto/conn.php';
$camara = $_GET['camara'];
$fecha1 = $_GET['fecha1'].' 00:00:00';
$fecha2 = $_GET['fecha2'].' 23:59:59';
//$consulta = "select camara, split_part(locate,',',1), split_part(locate,',',2), dir from or_camaras order by id";
//$consulta = "select camara, split_part(locate,',',1), split_part(locate,',',2), dir from or_camaras where id = $camara";
//$consulta = "select split_part(locate,',',1) as lat, split_part(locate,',',2) as lon from or_camaras ";
//$consulta = "   select c.camara as cam, split_part(c.locate,',',1) as lat, split_part(c.locate,' ',2) as lon, c.dir as dir from or_registros_vehiculos as rv               
//                inner join or_camaras as c on rv.id_camaras = c.id
//                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
//                where c.id = $camara  and rv.fecha between '$fecha1' and '$fecha2'
//                group by cam, lat, lon, dir
//                order by cam, lat, lon, dir
//               ";
$consulta = "   select c.camara as cam, split_part(c.locate,',',1) as lat, split_part(c.locate,' ',2) as lon, c.dir as dir from or_registros_vehiculos as rv               
                inner join or_camaras as c on rv.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                where c.id = $camara  and rv.fecha between '$fecha1' and '$fecha2'
                group by cam, lat, lon, dir
                order by cam, lat, lon, dir
               ";
$consulta1 = "  select count(rv.id) as cont from or_registros_vehiculos as rv               
                inner join or_camaras as c on rv.id_camaras = c.id
                inner join or_vehiculo_tipos as v on rv.id_vehiculos = v.id
                where c.id = $camara  and rv.fecha between '$fecha1' and '$fecha2'
                group by c.camara, v.id 
                order by c.camara, v.id
              ";
//echo $consulta1;
$resultado = pg_query($conexion, $consulta) or die ("error en la consulta".  pg_last_error());
$resultado1 = pg_query($conexion, $consulta1) or die ("error en la consulta 1".  pg_last_error());
//while ($row = pg_fetch_row($resultado)){
//    $data[] = $row;
////    $data[] = $row['lat'];
////    $data[] = $row['lon'];
//    
//}
while ($row = pg_fetch_assoc($resultado)){    
    $data[] = $row['cam'];
    $data[] = $row['lat'];
    $data[] = $row['lon'];
    $data[] = $row['dir'];
    $i = 1;
    do {
        ($row1 = pg_fetch_assoc($resultado1));
        $data[] = $row1['cont'];
        $i++;
    } while ($i <= 3);
}
while ($row1 = pg_fetch_assoc($resultado1)){
    $data[] = $row1['cont'];
}
//print json_encode($data);
print json_encode(array_chunk($data, 7));
pg_close($conexion);


