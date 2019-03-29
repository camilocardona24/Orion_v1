<?php



$lvlroot = "../";
// Class for handling connection to database
//include_once($lvlroot . "common/DBConnection.php");

//$queryresult = Databaseconnection::consulta("SELECT perfil FROM usuarios_sps WHERE nombre_usuario='$usuario';");
//$profile = $queryresult[0][0];
//

$userAdministrationPermissions = array("Administrador");
$isAdmitted = false;
foreach ( $userAdministrationPermissions as $admittedProfile){
    if ( $admittedProfile == $profile ){
        $isAdmitted = true;
        break;
    }
}


// Local styles sheet CSS
$localStylesPath= $lvlroot . "RegistroUsuarios/styles.css";
// Common styles
$commonStylesPath= $lvlroot . "common/styles.css";
ob_start();
include_once($lvlroot . "Body/Head.php");
$contents = ob_get_contents();
ob_end_clean();
$finalStyles = str_replace('</head>', '<link rel="stylesheet" type="text/css" href="'.$localStylesPath.'"></head>', $contents);
$finalStyles = str_replace('</head>', '<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"></head>', $finalStyles);
$finalStyles = str_replace('</head>', '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css"></head>', $finalStyles);
$finalStyles = str_replace('</head>', '<link rel="stylesheet" href="'.$commonStylesPath.'"></head>', $finalStyles);
echo $finalStyles;

include_once($lvlroot . "Body/BeginPage.php");
?>
<div id="content" class="content">
<?php
include_once($lvlroot . "Body/SideBar.php");

$databaseInsertion = 0;

?>
<div id="detail-container">
<?php

// Local HTML file
$html = file_get_contents('index.html');
echo $html;
// Footer HTML file
$footer = file_get_contents($lvlroot."common/footer.html");
echo $footer;

?>
                </div> <!-- end detail-container -->
        </div> <!-- end content div -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
        <script src="https://code.highcharts.com/Iniciohighcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/drilldown.js"></script>
<?php
include_once($lvlroot . "Body/JsFoot.php");

?>
        <!-- Common js -->
        <script type="text/javascript" src="../common/script.js"></script>
        <!-- Local js -->Inicio
        <script type="text/javascript" src="script.js"></script>
<?php

if( $_POST ){
        if( $_POST["formtype"] == "remove" ){
                $cedula = $_POST["cedula"];

                Databaseconnection::consulta("DELETE FROM usuarios_sps WHERE cedula=$cedula;");

                $queryresult = Databaseconnection::consulta("SELECT nombre_completo FROM usuarios_sps WHERE cedula='" . $cedula . "';");
                
        }elseif( $_POST["formtype"] == "modify" ){
                $cedula = $_POST["modify-user-id"];
                $fullname = $_POST["modify-user-fullname"];
                $username = $_POST["modify-user-username"];
                $password = $_POST["modify-user-password"];
                $privilege = $_POST["modify-user-privilege-level"];
                $date = date("Y-m-d H:i:s");

                Databaseconnection::consulta("UPDATE usuarios_sps SET cedula=$cedula,nombre_completo='$fullname',nombre_usuario='$username',perfil='$privilege',clave='$password',fecha_hora='$date' WHERE cedula=$cedula;");

        }elseif( $_POST["formtype"] == "create" ){
                $cedula = $_POST["new-user-id"];
                $fullname = $_POST["new-user-fullname"];
                $username = $_POST["new-user-username"];
                $password = $_POST["new-user-password"];
                $privilege = $_POST["new-user-privilege-level"];
                $date = date("Y-m-d H:i:s");

                // Ya se hicieron todas las validaciones. Ya es tirar y listo.
                $newUserInsertionQuery = "insert into usuarios_sps(cedula,nombre_completo,nombre_usuario,clave,perfil,fecha_hora) values(".$cedula.",'".$fullname."','".$username."','".$password."','".$privilege."','".$date."') ;";
                
                Databaseconnection::consulta( $newUserInsertionQuery );
        }
}

include_once($lvlroot . "Body/EndPage.php");
?>

