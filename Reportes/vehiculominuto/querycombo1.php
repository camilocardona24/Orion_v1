<?php

require_once "conn.php";
//$consulta = "   select c.camara as cam, c.id as id, c.dir as dir from or_registros_vehiculos as rv                                
//                inner join or_camaras as c on rv.id_camaras = c.id
//                group by cam, c.id
//                order by id               
//                
//                                                                                                                  
//               ";
$consulta = "select camara as cam, id, dir from or_camaras ";

$resultado = pg_query($conexion, $consulta) or die ("error consulta".  pg_last_error());
//$i = 1;
//$c = 0;
//while ($row = pg_fetch_assoc($resultado)){
//    if ($i > 63){ } else if ($i <= 53){echo $row['cam'].' - '.$row['dir'];} else if ($i >= 60){echo $row['cam'].' - '.$row['dir'];}
//   
//    $i ++;
//                             
//}
//echo $c;
pg_close($conexion);