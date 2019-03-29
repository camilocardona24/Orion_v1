<?php
// The lvlroot variable indicates the levels of direcctories
// the file loaded has to up, to be on the root directory
$lvlroot = "../";
// Including Head.
include_once($lvlroot . "assets/php/dbq.php");

include_once($lvlroot . "Body/Head.php");
// Including Begin Header.
include_once($lvlroot . "Body/BeginPage.php");
//
// Including Side bar.
include_once($lvlroot . "Body/SideBar.php");
// Including Php database.
// function defined in js/autocomplete.js
?> 

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse " data-sortable-id="form-plugins-1">
            <div class="panel-heading" style="background-color: #0B2D2F">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                                
                <h4 class="panel-title">
                    <i class="fa fa-upload fa-lg"></i>
                    Cámaras                      </h4>
            </div>
            <!-- begin body panel -->
            <div class="panel-body panel-form " id="panel-output-form">
                <div class="form-group ">
                    <div id="map" style="width: 1251px; height: 600px"></div>
                    <script
                        src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js">
                    </script>

                    <script>
   var map = L.map('map', {
                            center: [6.2443382, -75.573553],
                            zoom: 14
                      
                        });

                        var firefoxIcon = L.icon({
                            iconUrl: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRX4LtDoFVb8QEWdhJyXCj0AlJtBohzqtZGMt3bXlgh-BOlHoDK',
                            iconSize: [33, 38], // size of the icon
                        });                        mapLink =
                                '<a href="http://openstreetmap.org">OpenStreetMap</a>';
                        L.tileLayer(
                                'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; ' + mapLink + ' Contribución',
                                    maxZoom: 18
                                }).addTo(map);
//                        var url = '../dev/Home/lineasmapa.php';
//                        $.getJSON(url, function (result) {
//                            alert(result);
//
//
//                            showmap(result);
//                        });
//                        function showmap(result) {
//                            alert(result);
//                            var polyline = L.polyline([result]
//                                    ).addTo(map);
//
//                        }

                        var result;
                        var url = 'camarasmapa.php';
                        $.getJSON(url, function (result) {

                            showmap(result);

                         

                            // zoom the map to the polyline
                        });
                        function showmap(result) {
                            for (var i = 0; i < result.length; i++) {
                                marker = new L.marker([result[i][1], result[i][2]], {icon: firefoxIcon})
                                        .bindPopup('<strong>Cámara:</strong><br>' + ''  + result[i][0] + '<br>'+'<strong>Dirección:</strong><br>'+ ' ' + result[i][3])

                                        .addTo(map);
                            }

                        }
                    </script>

                </div>


            </div>
        </div>



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
?>
