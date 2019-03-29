

<?php

class Conexion {

    function conectar() {
        $conn = pg_connect("user=prioridad password=prioridad.2017 host=192.168.50.187 port=5432 dbname=sps");

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
    $cedula = $_GET['cedula'];
$result = Conexion::consulta("delete from usuarios_sps where cedula = '$cedula'");


header('Location: index.php');

    

