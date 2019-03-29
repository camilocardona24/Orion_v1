

<?php

class Conexion {

    function conectar() {
        $conn = pg_connect("user=tiemposdeviaje password=tiemposdeviaje.2017 host=192.168.50.248 port=5432 dbname=tiemposdeviaje");

        if (!$conn) {
            echo "Error, Problemas al conectar con el servidor";
            exit;
        } else {
            return $conn;
        }
    }

    function consulta($sql = null) {
        $resultado = pg_query(Conexion::conectar(), $sql);
        $fila = array();

        #Para obtener todos los datos debemos iterar en un ciclo, ya que contiene un puntero interno.
        while ($row = pg_fetch_row($resultado)) {
            $fila[] = $row;
        }
        return $fila;
    }
    

}
    
$nombre = "'".$_GET['nombre']."'";
$latitud = $_GET['latitud'];
$longitud = $_GET['longitud'];
$descripcion = "'".$_GET['descripcion']."'";
$vble = $nombre.",".$latitud.",".$longitud.",".$descripcion ;
 $querya = 'select * from dispositivos where ip ='.$nombre.';';
 $resultquerya = Conexion::consulta($querya);

if($resultquerya ==1){
    
print json_encode($resultquerya);
    
}else {
    
    $query ="insert into dispositivos(ip,latitud,longitud,descripcion) values($vble);";
    $result = Conexion::consulta($query);

print json_encode($result);

    
}


