

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



$vble = "select ip,latitud,longitud from dispositivos;";

$result = Conexion::consulta($vble);


//$result["DATA"] = $result;

print json_encode($result);

