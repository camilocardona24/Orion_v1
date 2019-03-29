

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


        while ($row = pg_fetch_row($resultado)) {
            $fila[] = $row;
        }
        return $fila;
    }
    

}
    
$result = Conexion::consulta("select cedula,nombre_completo,nombre_usuario,perfil,'<a href=http://192.168.50.187/spsa/RegistroUsuarios/editarUsuario/index.php?cedula=' || cedula || '>Editar&nbsp;&nbsp;&nbsp;</a><a href=http://192.168.50.187/spsa/RegistroUsuarios/crearUsuario/eliminarUsuario.php?cedula=' || cedula || '>Eliminar</a>' from usuarios_sps;");

print json_encode($result);




