

<?php

class Conexion {

    function conectar() {
        $conn = pg_connect("user=postgres password=Orion2017* host=181.129.51.43 port=5432 dbname=orion");

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

$vble = "SELECT camara,split_part(locate,',',1) AS latitud, split_part(locate,' ',2) AS longitud,dir from or_camaras ;";

$result = Conexion::consulta($vble);


//$result["DATA"] = $result;

print json_encode($result);

