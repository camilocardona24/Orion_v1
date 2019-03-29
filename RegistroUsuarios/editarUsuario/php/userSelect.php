<?php
// Cargando Archivo para BD
require_once("../../assets/php/PhpMySQL.php");
$DB = new Database();
$query = "SELECT * FROM usuarios_wms ORDER BY ID_USUARIO";
$queryResult = $DB->query($query);

$datos = array();
while ($temp = $DB->fetch_array($queryResult))
{
    $datos[] = $temp; 
}

?>
<script>//alert(' <?php //echo $datos[0]["USUARIO"]."  "."Alert userSelect.php"; ?> ');</script>
<?php

 foreach ($datos as $Name)
    {
        ?>
        <!-- value Pasa el dato seleccionado por medio del $_POST-->
        <option
            id="<?php echo ($Name[2]);?>"
            value= "<?php echo ($Name[2]);?>"
         >
        <!-- Mostrando Dispositivos existentes en base de datos -->
            <?php echo ($Name[1]);?>
        </option>
    <?php
    }// Cerrando foreach
    ?>

<?php
$DB->close();
?>


