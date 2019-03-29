

<?php

$usuario = $_GET['usuario'];
$nombre = $_GET['nombre'];
$clave = $_GET['clave'];
$perfil = $_GET['perfil'];
$cedula = $_GET['cedula'];

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

    function num_rows($sql = null) {

        $resultado = pg_num_rows(Conexion::conectar(), $sql);
        return $resultado;
    }

}

$vble2 = 'SELECT cedula FROM or_usuarios WHERE cedula=' . $cedula . ';';
$queryvalidaton = Conexion::consulta($vble2);
if (pg_num_rows($queryvalidaton) > 0) {
    echo 1;
} else {
    $query = "insert into or_usuarios(cedula,nombre_completo,nombre_usuario,contrasena,id_perfil) values($cedula,'$nombre','$usuario','$clave',1);";
    $result = Conexion::consulta($query);
    print_r($result);
}
if ($row = pg_fetch_array($queryvalidaton)) {
    if ($row["cedula"] == $cedula) {
        $result = 0;
        print_r($result);
    } else {
        
    }
}



//$result["DATA"] = $result;



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

