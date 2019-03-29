

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
    
$result = Conexion::consulta("select fecha_hora,evento,id_usuario from log_eventos;");

//$result["DATA"] = $result;

print json_encode($result);


//$respuesta = Conexion::consulta("select row_to_json(f) FROM (SELECT ST_AsGeoJSON('0101000020E6100000810F2CEFC4E552C0C537565A2DED1840')::json As geometry,'Feature' As type,1 As properties ) As f;");
//$respuesta = Conexion::consulta("select row_to_json(t) from (select ip,id_bus,prioridad,prioridad_aceptada,fecha_hora from apps order by fecha_hora desc limit 10) t;");
//$respuesta = Conexion::consulta("select nombre_completo,nombre_usuario,cedula from usuarios_sps;");
//$respuesta = Conexion::consulta("SELECT to_json(c.*) FROM controladores limit 10");
# También se puede crear una instancia de la clase y llamar a los métodos : 
# $conexion = new Conexion();
#Mostrando la respuesta de nuestra consulta
//$respuesta = json_encode($respuesta);


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

