<?php
// The lvlroot variable indicates the levels of direcctories
// the file loaded has to up, to be on the root directory
$lvlroot = "../../";
// Including Head.
include_once($lvlroot . "Body/Head.php");
// Including Begin Header.
include_once($lvlroot . "Body/BeginPage.php");
//
// Including Side bar.
include_once($lvlroot . "Body/SideBar.php");
// Including Php database.
// function defined in js/autocomplete.js
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
<h2 class="page-header">Tiempo de Viaje Estimado<small> </small></h2>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse " data-sortable-id="form-plugins-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">
                    <i class="fa fa-upload fa-lg"></i>
                    Dispositivos                      </h4>
            </div>
            <!-- begin body panel -->
            <div class="panel-body panel-form " id="panel-output-form">
                <div class="form-group">
                    <div class="col-md-9">
                        <div id="map" style="width:800px;height: 600px;"></div>
                        <script>

    var map = L.map('map').
            setView([6.2443382, -75.573553],
                    14);
                    var firefoxIcon = L.icon({
        iconUrl: 'https://cdn2.iconfinder.com/data/icons/circular-icon-set/256/Bluetooth.png',
        iconSize: [34,52    ], // size of the icon
        });

                           var result;
        var url = 'dispositivosmapa.php';
        $.getJSON(url, function (result) {
     
 alert(result);
        alert(result[0][1]);
        alert(result[0][2]);
            showmap(result);
        });
        function showmap(result) {
            for (var i = 0; i < result.length; i++) {
                marker = new L.marker([result[i][1], result[i][2]],{icon: firefoxIcon})
                        .bindPopup('<strong>IP:</strong>' + '' + result[i][0])

                        .addTo(map);
            }

        }   

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
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
                        <h3>Dispositivos</h3>
                        <br>
                        <label>NOMBRE (*)</label>

                        <input type="text" class="form-control" id="nombredispositivo" /><br>
                        <label>LATITUD (*)</label>

                        <input type="text" class="form-control" id="latituddispositivo"  /><br>
                        <label>LONGITUD (*)</label>

                        <input type="text" class="form-control" id="longituddispositivo"  />
                        <br>
                        <input type ="button" class="btn btn-success" id="toggleAutoPlayBtn" value="Crear"/>
                        <input type ="button" class="btn btn-success" id="Clean" value="Limpiar"/>


                    </div>

                </div>

                <script type="text/javascript">
                    $(document).on('click', '#toggleAutoPlayBtn', function () {

                        var nombre = $('#nombredispositivo').val();
                        var latitud = $('#latituddispositivo').val();
                        var longitud = $('#longituddispositivo').val();
                        insert(nombre, latitud, longitud);


                        function insert(nombre, latitud, longitud)
                        {
                            var url = 'insertdispositivo.php?nombre=' + nombre + '&latitud=' + latitud + '&longitud=' + longitud;
                            $.getJSON(url, function (result) {
                                $('#nombredispositivo').val('');
                                $('#latituddispositivo').val('');
                                $('#longituddispositivo').val('');

                                location.reload();

                            });
                        }


                    });

                    $(document).on('click', '#Clean', function () {

                        $('#nombredispositivo').val('');
                        $('#latituddispositivo').val('');
                        $('#longituddispositivo').val('');
                    });

                </script>


                <br>
                <div class="form-group">
                    <div class="col-md-12"><br>
                        <table class="table table-bordered table-striped nowrap" id="example" class="display" width="100%"></table>


                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        displaydevices();

        function displaydevices() {

            var url = 'dispositivoslista.php';

            $.getJSON(url, function (result) {
                if (result) {
                    tableUnits(result);
                }
            });
        }

        function tableUnits(result) {
            $(document).ready(function () {
                $('#example').DataTable({
                    data: result,

                    "language": {
                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }

                    },
                    columns: [
                        {title: "IP"},
                        {title: "LATITUD"},
                        {title: "LONGITUD"}




                    ]
                });
            });
        }
    });
</script>
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


