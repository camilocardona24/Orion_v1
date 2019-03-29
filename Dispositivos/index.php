<?php
// The lvlroot variable indicates the levels of direcctories
// the file loaded has to up, to be on the root directory
$lvlroot = "../../";
// Including Head.
include_once($lvlroot . "assets/php/dbq.php");

include_once($lvlroot . "Body/Head.php");
// Including Begin Header.
include_once($lvlroot . "Body/BeginPage.php");
//
// Including Side bar.
include_once($lvlroot . "Body/SideBar.php");
//
//include_once($lvlroot . "assets/php/dbq.php");

//
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

// Including Side bar.
include_once($lvlroot . "Body/SideBar.php");
//
//if ($_GET['ip']) {
//    $ipvalue = $_GET['ip'];
//    $query2 = "select ip,latitud,longitud,descripcion from dispositivos where ip ='$ipvalue';";
//    $result = Conexion::consulta($query2);
//    $ip = $result[0][0];
//    $latitud = $result[0][1];
//    $longitud = $result[0][2];
//    $descripcion = $result[0][3];
//}
?>
<script src="assets/plugins/pace/pace.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    var lvlrootjs = <?php print json_encode($lvlroot); ?>;
</script>
<script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>

<!-- begin breadcrumb -->
<!--<ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Inicio</a></li>
    <li><a href="javascript:;">Proceso Bodega</a></li>
    <li class="active">Selección de Unidades</li>
</ol>-->
<h2 class="page-header"><small> </small></h2>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse " data-sortable-id="form-plugins-1">
            <div class="panel-heading" style="background-color: #286f77;">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>

                <h3 class="panel-title" style="color:#286F76;margin-left: 50px;">
                    <i class="fa fa-upload fa-lg"></i>
                    Crear Nuevo                       </h3>

            </div>
            <!-- begin body panel -->
            <div class="panel-body panel-form" id="panel-output-form">
                <div class="form-group">
                    <div class="col-md-9">
                        <div id="map" style="width:1200px;height: 600px;margin-left:-15px;"></div>
                        <script>
                        var map = L.map('map', {
                            center: [6.2443382, -75.573553],
                            zoom: 14
                      
                        });

                        var firefoxIcon = L.icon({
                            iconUrl: 'https://image.flaticon.com/icons/png/128/149/149024.png',
                            iconSize: [28, 36], // size of the icon
                        });

                        var result;
                        var url = 'dispositivosmapa.php';
                        $.getJSON(url, function (result) {

                            showmap(result);
                        });
                        function showmap(result) {
                            for (var i = 0; i < result.length; i++) {
                                marker = new L.marker([result[i][1], result[i][2]], {icon: firefoxIcon})
                                        .bindPopup('<strong>IP:</strong>' + '' + result[i][0])

                                        .addTo(map);
                            }

                        }
//                        
//  var littleton = L.marker([39.61, -105.02]).bindPopup('This is Littleton, CO.'),
//    denver    = L.marker([39.74, -104.99]).bindPopup('This is Denver, CO.'),
//    aurora    = L.marker([39.73, -104.8]).bindPopup('This is Aurora, CO.'),
//    golden    = L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.');
//
//var cities = L.layerGroup([littleton, denver, aurora, golden]);
//
//
    var night = 'https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png';
    var layer1 = 'http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png';
    var layer2 = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
//    var baseMaps = {
//        "Night": night,
//        "Layer1": layer1,
//        "Layer2": layer2
//    };
//    
//    var overlayMaps = {
//    "Cities": cities
//};
//
//    L.control.layers(baseMaps,overlayMaps).addTo(map);




    L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
        maxZoom: 18
    }).addTo(map);

    L.control.scale().addTo(map);
    L.marker([41.66, -4.71], {draggable: true}).addTo(map);


    map.on('click', function (e) {
        var lat = e.latlng.lat;
        var long = e.latlng.lng;
        $('#latituddispositivo').val(lat);
        $('#longituddispositivo').val(long);

    });

                        </script>
                    </div>

                    <div class="col-md-3 pull-right">
                        <?php
                        if ($_GET[ip]) {
                            ?> 
                            <h3>Actualizar Dispositivo</h3>
                            <?php
                        } else {
                            ?>
                            <h3>Crear Dispositivo</h3>
                            <?php
                        }
                        ?>
                        <br>
                        <label>IP (*)</label>

                        <input type="text" class="form-control" id="ipdispositivo" value="<?php echo $ip; ?>"/><br>
                        <label>LATITUD (*)</label>

                        <input type="text" class="form-control" id="latituddispositivo" value="<?php echo $latitud; ?>" /><br>
                        <label>LONGITUD (*)</label>
                        <input type="text" class="form-control" id="longituddispositivo" value="<?php echo $longitud; ?>"  />
                        <br>
                        <label>INTERSECCIÓN (*)</label>

                        <input type="text" class="form-control input-lg" id="descripciondispositivo" value="<?php echo $descripcion; ?>" /><br>
                        <?php
                        if ($_GET['ip']) {
                            ?>
                            <input type ="button" class="btn btn-success" id="updatedevicesdata" value="Actualizar"/>

                            <?php
                        } else {
                            ?> 

                            <input type ="button" class="btn btn-success" id="toggleAutoPlayBtn" value="Crear"/>


                            <?php
                        }
                        ?>

                        <input type ="button" class="btn btn-success" id="Clean" value="Limpiar"/>


                    </div>

                </div>

     


                <br>
                <div class="form-group">

                    <div class="col-md-12"><br>
                        <h3> Dispositivos</h3><br>
                        <table class="table table-bordered table-striped nowrap" id="example" class="display" width="100%"></table>


                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

<div class="form-group" id="cancel-save" style="display:none;">
    <div class="col-md-12 col-sm-12 text-right">
        <button id="cancelData" name="cancelData" class="btn btn-warning btn-sm">
            <i class="fa fa-ban">Cancelar</i>
        </button>
        <button id="save" name="save" class="btn btn-primary btn-sm">
            <i class="fa fa-floEndppy-o">
                Guardar
            </i>
        </button>
    </div>
</div>


<?php
include_once($lvlroot . "Body/AlertsWindows.php");
?>
</div>
<!-- end row -->
<?php
// Including Js actions, put in the end.
include_once($lvlroot . "Body/JsFoot.php");
// Including End Header.
include_once($lvlroot . "Body/EndPage.php");
// Writing on database.
//include_once("php/Insert2db.php");
?>

<script>
    var lvlrootjs = <?php print json_encode($lvlroot); ?>;
</script>


