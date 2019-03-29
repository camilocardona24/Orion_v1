
<link rel="stylesheet" href="css/master.css?n=1">
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css"    />
<link href="../../assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
<link href="../../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
<link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>

<?php
$lvlroot = "../../";
// Including Head.
include_once($lvlroot . "Body/Head.php");
// Including Begin Header.
include_once($lvlroot . "Body/BeginPage.php");
//include("fusioncharts.php");
// Including Side bar.
include_once($lvlroot . "Body/SideBar.php");
// Including Php database.
include_once($lvlroot . "assets/php/dbq.php");
//require_once "conn.php";
//var_dump($_SESSION['usuario']);
//if ($_SESSION['usuario'] != NULL) {
    ?>
<!--<script>
        window.location = "../Home/exit.php";
    </script><?ph
}
?>-->

<ol class="breadcrumb pull-right">
    <li><a <!--href="javascript:;"-->Inicio</a></li>
    <li class="active">Reportes</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Reportes</h1>

<div class="row">
    <!-- begin main column -->
    <div class="col-md-12">
        <!-- begin panel Client info -->

        <div class="panel panel-inverse ">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">
                    <i class="fa fa-line-chart"></i>
                    Conteo Vehicular                </h4>
            </div>
            <div class="panel-body panel-form">
                <div class="panel-body panel-form form-horizontal form-bordered">
                    <form data-parsley-validate="true" id="form-fechas" name="form-fechas-info" class="form-horizontal form-bordered" method="post" action="" >
                        <div class="form-group" style="margin-left: 160px;">
                            <div class="col-md-4 col-sm-4">
                                    <select name="selectid" Id="selectcamara">
                                        <option value="" disabled selected>Selecciona una camara </option>
                                        <?php  
                                        require_once "querycombo.php";
                                        while($row = pg_fetch_assoc($resultado)){
                                            ?>
                                            <option value=<?php echo $row['id']; ?>>
                                                <?php if ($row['id'] <= 63){echo $row['camara']." - ".$row['dir'];} else{break;}?> 
                                            </option>
                                            <?php                                    
                                        }
                                        ?>
                                    </select>
                                </div>
                            <div class="input-group input-daterange" data-date-format="yyyy-mm-dd">
                                
                                <div class="col-md-4 col-sm-4">
                                    <input type="text" class="form-control" name="start" placeholder="Fecha Inicial" id="fecha1"  />
                                </div>
                                <div class="col-md-2 col-sm-2"> 
                                    <span class="input-group-addon">Entre</span>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <input type="text" class="form-control"  name="end" placeholder="Fecha Final" id="fecha2" onchange="Load();"/>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>                
                <div id="label0" class="form-group" style="display:none">
                    <div class="col-md-7 col-sm-7 text-right" >
                          <h5 id="label1">Nota: rango de datos  <span id="span0" class="badge pink"></span> entre <span id="span1" class="badge pink"></span> </h5>
                    </div>
                    <div class="col-md-5 col-sm-5 text-right" >
                        <button id="consultar" class="btn btn-success btn-sm" style="margin-right: 305px; margin-top: 7px;" >
                            <i class="fa fa-floppy-o">
                                Consultar
                            </i>
                        </button>    
                    </div>
                    
                </div>
            </div>    
        </div>        
            <div class="panel panel-inverse " id ="reporte0" style="display:none">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <i class="fa fa-line-chart"></i>
                        Reporte por tipo                </h4>
                </div>    
                <div class="panel-body panel-form">
                    <div class="panel-body panel-form form-horizontal form-bordered">
                        <form data-parsley-validate="true" id="form-stock" name="demo-form-ware-info" class="form-horizontal form-bordered" method="post" action="" >
                            <div class="form-group">
                                <br>
                                <div id="container" style="height: 400px; min-width: 600px"></div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>    
            <div class="panel panel-inverse " id ="reporte1" style="display:none">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">
                        <i class="fa fa-line-chart"></i>
                        Reporte por Headway                </h4>
                </div>      
                <div class="panel-body panel-form">
                    <div class="panel-body panel-form form-horizontal form-bordered">
                        <form data-parsley-validate="true" id="form-stock" name="demo-form-ware-info" class="form-horizontal form-bordered" method="post" action="" >
                            <div class="form-group">
                                <br>
                                <div id="container1" style="height: 400px; min-width: 600px"></div>
                                
                            </div>
                        </form>
                    </div>
                </div> 
            </div> 
            <div class="col-md-6 col-sm-12">
                <div class="panel panel-inverse " id ="reporte2" style="display:none">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">
                            <i class="fa fa-line-chart"></i>
                            Reporte por Carril               </h4>
                    </div> 
                    <div class="panel-body panel-form">
                        <div class="panel-body panel-form form-horizontal form-bordered">
                            <form data-parsley-validate="true" id="form-stock" name="demo-form-ware-info" class="form-horizontal form-bordered" method="post" action="" >
                                <div class="form-group">
                                    <br>
                                    <div id="container2" style="height: 400px; min-width: 600px"></div>

                                </div>
                            </form>
                        </div>
                    </div>        
                </div>
            </div>    
            <div class="col-md-6 col-sm-12">    
                <div class="panel panel-inverse " id ="reporte3" style="display:none">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">
                            <i class="fa fa-line-chart"></i>
                            Reporte por Carril               </h4>
                    </div> 
                    <div class="panel-body panel-form">
                        <div class="panel-body panel-form form-horizontal form-bordered">
                            <form data-parsley-validate="true" id="form-stock" name="demo-form-ware-info" class="form-horizontal form-bordered" method="post" action="" >
                                <div class="form-group">
                                    <br>
                                    <div id="container3" style="height: 400px; min-width: 600px"></div>

                                </div>
                            </form>
                        </div>
                    </div>        
                </div>
            </div>
            <div class="col-md-12 col-sm-12"> 
                <div class="panel panel-inverse " id ="reporte4" style="display:none">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">
                            <i class="fa fa-line-chart"></i>
                            Reporte Velocidad                </h4>
                    </div>    
                    <div class="panel-body panel-form">
                        <div class="panel-body panel-form form-horizontal form-bordered">
                            <form data-parsley-validate="true" id="form-stock" name="demo-form-ware-info" class="form-horizontal form-bordered" method="post" action="" >
                                <div class="form-group">
                                    <br>
                                    <div id="container4" style="height: 400px; min-width: 600px"></div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-md-12 col-sm-12">
                <div class="panel panel-inverse " id ="reporte5" style="display:none" >
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">
                            <i class="fa fa-map-marker"></i>
                            Ubicacion  y conteo general       </h4>
                    </div>    
                    <div class="panel-body panel-form">
                        <div class="panel-body panel-form form-horizontal form-bordered">
                            <form data-parsley-validate="true" id="form-stock" name="demo-form-ware-info" class="form-horizontal form-bordered" method="post" action="" >
                                <div class="form-group">
                                    <br>
                                    <div id="map" style="height: 400px; min-width: 600px"></div>
                                    <script
                                        src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js">
                                    </script>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>    
<?php
include_once($lvlroot . "Body/AlertsWindows.php");
?>
<!--</div>-->
     
<script type="text/javascript">

    $(document).ready(function(){ 
        
        var camara = $("#selectcamara").val();
        var url = '../camara/querycam-1.php?camara='+camara;
        $.getJSON(url, function(data){
            for (var i = 0; i < data.length; i++) {                   
                $("#span0").empty().append([data[i][0]]);
                $("#span1").empty().append([data[i][1]]);
            }
            if (!data){               
            }
            else{
                $("#label0").css('display', 'flow-root');
            }
        });  
        
    });
    
//    $("#selectvehiculo").prop('disabled', true);   
    $('#selectcamara').change(function(){
//       var valor = $(this).find("option:selected").attr('value') ;
        var camara = $("#selectcamara").val();       
        var url = '../camara/querycam-1.php?camara='+camara;
        $("#label0").css('display', 'flow-root');
        $.getJSON(url, function(data){
            if (camara === 54){
                 $("#span0").empty().append(["nada"]);
                 $("#span1").empty().append("ninguno");
            }
            else {
                for (var i = 0; i < data.length; i++) {                   
                    $("#span0").empty().append([data[i][0]]);
                    $("#span1").empty().append([data[i][1]]);
                } 
            }    
        });       
        
    });
    num = 0;
    var map1;
//                    num++;
                     
    $("#consultar").click(function(){
        
//        <?ph header( "Expires: Mon, 20 Dec 1998 01:00:00 GMT" );
//    header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
//    header( "Cache-Control: no-cache, must-revalidate" );
//    header( "Pragma: no-cache" );?>
//        var vehiculo =$("#selectvehiculo").val();
        $("#reporte0").css('display', 'flow-root');
        $("#reporte1").css('display', 'flow-root');
        $("#reporte2").css('display', 'flow-root');
        $("#reporte3").css('display', 'flow-root');
        $("#reporte4").css('display', 'flow-root');
        $("#reporte5").css('display', 'flow-root');
        $("#consultar").prop('disabled', true); 
        var camara =$("#selectcamara").val();
        var fecha1 =$("#fecha1").val();
        var fecha2 =$("#fecha2").val();            
        if (fecha1 === "" || fecha2 === ""){
            $("#consultar").prop('disabled', false); 
        }  
        
        if (num < 1){
            var map = L.map('map', {
                        center: [6.2443382, -75.573553],
                        zoom: 12
                    });
                    num++;
                    mapLink =
                        '<a href="http://openstreetmap.org">OpenStreetMap</a>';
                    L.tileLayer(
                        'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//                                    attribution: '&copy; ' + mapLink + ' Contribución',
                        maxZoom: 19
                    }).addTo(map);
                    map1 = map;
                    
        } 
        var firefoxIcon = L.icon({
//                            iconUrl: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRX4LtDoFVb8QEWdhJyXCj0AlJtBohzqtZGMt3bXlgh-BOlHoDK',
                            iconUrl: '../../assets/img/cam.png',
                            iconSize: [33, 38] // size of the icon
                        });
      
//        var map 1 = map;
        
//        var url  = '../camara/querycam-0.php?camara='+camara;
        var url  = '../camara/querycam-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
//                var url1 = '../camara/querycam-2.php?camara='+camara;
                $.getJSON(url, function (result) {
//                    $.getJSON(url1, function (result1) {
                        
//                    showmap(result);
//                    result = null;
//                    markers.clearLayers();
//                        marker = new L.marker(result)
//                                .bindPopup('<strong>Cámara:</strong>' + '' + result1)
                    for (var i = 0; i < result.length; i++) {
                        alert(result);
                        marker = new L.marker([result[i][1], result[i][2]], {icon: firefoxIcon})
                                .bindPopup('<strong>Cámara:</strong>' + '' + result[i][0] +
                                '<br> <strong>Ubicacion:</strong>' + '' + result[i][3] +
                                '<br> <strong>Carros:</strong>' + '' + result[i][4] +
                                '<br> <strong>Motos:</strong>' + '' + result[i][5] +
                                '<br> <strong>Pesados:</strong>' + '' + result[i][6])

                                .addTo(map1);
                    }
                    
//                    

                    // zoom the map to the polyline
//                    });
                });
        $(function () {    
            var url  = 'queryveh-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url1 = 'queryveh-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url2 = 'queryveh-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var urlnom = 'queryfecha.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
    //        var url = 'querystock.php';
            $.getJSON(url, function (data) {
//                alert(url);
    //              alert(data);
                $.getJSON(urlnom, function (datanom) {
                    $.getJSON(url1, function (data1) {
                        $.getJSON(url2, function (data2) {
    //                                      
                            Highcharts.chart('container', {

                                chart: {
                                    type: 'area',
                                    zoomType: 'x',
                                    panning: true,
                                    panKey: 'shift',
                                    scrollablePlotArea: {
                                        minWidth: 600,
                                        scrollPositionX: 1
                                    }
                                }, 
                                title: {
                                    text: 'Conteo de vehiculos por tipo'
                                },

    //                            subtitle: {
    //                                text: 'Source: thesolarfoundation.com'
    //                            },

                                xAxis: {

                                    title: {
                                        text: 'Tipo de vehiculo'
                                    } 
                                    ,                     
                                    categories: datanom,
                                },       

                                yAxis: {
                                    title: {
                                        text: 'Cantidad'
                                    }
    //                                ,                     
    //                                   categories: datanom

                                },
                                tooltip: {
                                    split: true,
                                    backgroundColor: 'rgba(0, 0, 0, 0.85)',
                                    style: {
                                        color: '#F0F0F0'
                                    }
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'middle'
                                },


                                series: [{
                                        name: 'Carros',
                                        data: data
                                },
                                {
                                        name: 'Motos',
                                        data: data1
                                },
                                {
                                        name: 'Pesados',
                                        data: data2
                                }
                                ],

                                responsive: {
                                    rules: [{
                                        condition: {
                                            maxWidth: 500
                                        },
                                        chartOptions: {
                                            legend: {
                                                layout: 'horizontal',
                                                align: 'center',
                                                verticalAlign: 'bottom'
                                            }
                                        }
                                    }]
                                }

                                });                   
                            }); 
                        }); 
                    });           
                });
            });
            $(function () {    
            var urlc  = '../headway/querycarril-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;           
            var urlc1 = '../headway/querycarril-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var urlc2 = '../headway/querycarril-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var urlcfecha = '../headway/querycfecha.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            $.getJSON(urlc, function (datac) {
                $.getJSON(urlcfecha, function (datacfecha) {
                    $.getJSON(urlc1, function (datac1) {
                        $.getJSON(urlc2, function (datac2) {                                     
                            Highcharts.chart('container1', {

                                chart: {
                                    type: 'column',
                                    zoomType: 'x',
                                    panning: true,
                                    panKey: 'shift',
                                    scrollablePlotArea: {
                                        minWidth: 600,
                                        scrollPositionX: 1
                    }
                                }, 
                                title: {
                                    text: 'Headway promedio'
                                },

    //                            subtitle: {
    //                                text: 'Source: thesolarfoundation.com'
    //                            },

                                xAxis: {

                                    title: {
                                        text: 'por carril'
                                    },                                                         
                                    categories: datacfecha
                                },       

                                yAxis: {
                                    title: {
                                        text: 'Segundos'
                                    }
    //                                ,                     
    //                                   categories: datanom

                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.85)',
                                    style: {
                                        color: '#F0F0F0'
                                    }
                                },    
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'middle'
                                },


                                series: [{
                                        name: 'Carril 1',
                                        data: datac
                                },
                                {
                                        name: 'Carril 2',
                                        data: datac1
                                },
                                {
                                        name: 'Carril 3',
                                        data: datac2
                                }
                                ],

                                responsive: {
                                    rules: [{
                                        condition: {
                                            maxWidth: 500
                                        },
                                        chartOptions: {
                                            legend: {
                                                layout: 'horizontal',
                                                align: 'center',
                                                verticalAlign: 'bottom'
                                            }
                                        }
                                    }]
                                }

                                });
                                $("#consultar").prop('disabled', false);
                            }); 
                        }); 
                    });           
                });
            }); 
            
            $(function () {              
            var url  = '../conteo/querycar-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url1 = '../conteo/querycar-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url2 = '../conteo/querycar-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url3 = '../conteo/queryveh-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url4 = '../conteo/queryveh-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url5 = '../conteo/queryveh-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url6 = '../conteo/queryveh1-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url7 = '../conteo/queryveh1-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url8 = '../conteo/queryveh1-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;           
            var url9 = '../conteo/queryveh2-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url10 = '../conteo/queryveh2-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url11 = '../conteo/queryveh2-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
                $.getJSON(url, function (data) {
                    $.getJSON(url1, function (data1) {
                        $.getJSON(url2, function (data2) {
                            $.getJSON(url3, function (data3) {
                                $.getJSON(url4, function (data4) {
                                    $.getJSON(url5, function (data5) { 
                                        $.getJSON(url6, function (data6) { 
                                            $.getJSON(url7, function (data7) { 
                                                $.getJSON(url8, function (data8) { 
                                                    $.getJSON(url9, function (data9) {
                                                        $.getJSON(url10, function (data10) { 
                                                            $.getJSON(url11, function (data11) { 
                                                                
                                                                Highcharts.chart('container2', {
                                                                    chart: {
                                                                        type: 'column'                                                                        
                                                                    },  
                                                                    title: {
                                                                        text: 'Conteo Carriles'
                                                                    },
                                                                    xAxis: {
                                                                         title: {
                                                                            text: 'Carriles'
                                                                        },    
                                                                        type: 'category'
                                                                       
                                                                    },
                                                                  
                                                                    legend: {
                                                                        enabled: false
                                                                    },
                                    //                                plotOptions: {
                                    //                                    series: {
                                    //                                        borderWidth: 0,
                                    //                                        dataLabels: {
                                    //                                            enabled: true,
                                    //                                            format: '{point.y}'
                                    //                                        }
                                    //                                    }
                                    //                                },

                                                                    tooltip: {
                                                                        backgroundColor: 'rgba(0, 0, 0, 0.85)',
                                                                        style: {
                                                                            color: '#F0F0F0'
                                                                        },
                                                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}'
                                                                    },
                                                                            
                                                                    series: [
                                                                        {
                                                                            name: "conteo",
                                                                            colorByPoint: true,
                                                                            data: [
                                                                                {
                                                                                    name: "Carril 1",
                                                                                    y: data,
                                                                                    drilldown: "C1"
                                                                                },
                                                                                {
                                                                                    name: "Carril 2",
                                                                                    y: data1,
                                                                                    drilldown: "C2"
                                                                                },
                                                                                {
                                                                                    name: "Carril 3",
                                                                                    y: data2,
                                                                                    drilldown: "C3"
                                                                                }                                          
                                                                            ]
                                                                        }
                                                                    ]
                                                                    ,
                                                                    drilldown: {
                                                                        series: [
                                                                            {
                                                                                name: "Carril 1",
                                                                                id: "C1",
                                                                                data: [
                                                                                    [
                                                                                        "Carros",
                                                                                        data3
                                                                                    ],
                                                                                    [
                                                                                       "Motos",
                                                                                        data4
                                                                                    ],
                                                                                    [
                                                                                       "Pesados",
                                                                                        data5
                                                                                    ]
                                                                                ]
                                                                            },
                                                                            {
                                                                                name: "Carril 2",
                                                                                id: "C2",
                                                                                data: [
                                                                                    [
                                                                                        "Carros",
                                                                                        data6
                                                                                    ],
                                                                                    [
                                                                                        "Motos",
                                                                                        data7
                                                                                    ],
                                                                                    [
                                                                                       "Pesados",
                                                                                        data8
                                                                                    ]
                                                                                ]
                                                                            },                                                                           
                                                                            {
                                                                                name: "Carril 3",
                                                                                id: "C3",
                                                                                data: [
                                                                                    [
                                                                                        "Carros",
                                                                                        data9
                                                                                    ],
                                                                                    [
                                                                                        "Motos",
                                                                                        data10
                                                                                    ],
                                                                                    [
                                                                                       "Pesados",
                                                                                        data11
                                                                                    ]
                                                                                ]
                                                                            }

                                                                        ]
                                                                    },
                                                                    responsive: {
                                                                    rules: [{
                                                                        condition: {
                                                                            maxWidth: 500
                                                                        },
                                                                        chartOptions: {
                                                                            legend: {
                                                                                layout: 'horizontal',
                                                                                align: 'center',
                                                                                verticalAlign: 'bottom'
                                                                            }
                                                                        }
                                                                    }]
                                                                }        
                                                                });
                                                            });    
                                                        });        
                                                    });            
                                                });
                                            });    
                                        });        
                                    });            
                                });                
                            });                    
                        });    
                    });        
                            
                });           
//            });
//            var url = 'querystock.php?camara='+camara+'&vehiculo='+vehiculo+'&fecha1='+fecha1+'&fecha2='+fecha2;
//               var url = 'queryveh-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
//                alert(url);
            });
            $(function () {    
            var url  = '../velocidad/queryvel-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url1 = '../velocidad/queryvel-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url2 = '../velocidad/queryvel-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var urlnom = '../velocidad/queryvfecha.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
    //        var url = 'querystock.php';
            $.getJSON(url, function (data) {
//                alert(url);
    //              alert(data);
                $.getJSON(urlnom, function (datanom) {
                    $.getJSON(url1, function (data1) {
                        $.getJSON(url2, function (data2) {
    //                                      
                            Highcharts.chart('container4', {

                                chart: {
                                    type: 'line',
                                    zoomType: 'x',
                                    panning: true,
                                    panKey: 'shift',
                                    scrollablePlotArea: {
                                        minWidth: 600,
                                        scrollPositionX: 1
                                    }
                                }, 
                                title: {
                                    text: 'velocidad promedio'
                                },

    //                            subtitle: {
    //                                text: 'Source: thesolarfoundation.com'
    //                            },

                                xAxis: {

                                    title: {
                                        text: 'por carril'
                                    },                                                         
                                    categories: datanom
                                },       

                                yAxis: {
                                    title: {
                                        text: 'km/h'
                                    }
    //                                ,                     
    //                                   categories: datanom

                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.85)',
                                    valueSuffix: ' km/h',
                                    style: {
                                        color: '#F0F0F0'
                                    }
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'middle'
                                },


                                series: [{
                                        name: 'Carros',
                                        data: data
                                },
                                {
                                        name: 'Motos',
                                        data: data1
                                },
                                {
                                        name: 'Pesados',
                                        data: data2
                                }
                                ],

                                responsive: {
                                    rules: [{
                                        condition: {
                                            maxWidth: 500
                                        },
                                        chartOptions: {
                                            legend: {
                                                layout: 'horizontal',
                                                align: 'center',
                                                verticalAlign: 'bottom'
                                            }
                                        }
                                    }]
                                }

                                });                   
                            }); 
                        }); 
                    });           
                });
            });
            $(function () {
            var url  = '../conteo/querycar-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url1 = '../conteo/querycar-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url2 = '../conteo/querycar-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url3 = '../conteo/queryveh-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url4 = '../conteo/queryveh-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url5 = '../conteo/queryveh-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url6 = '../conteo/queryveh1-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url7 = '../conteo/queryveh1-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url8 = '../conteo/queryveh1-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;           
            var url9 = '../conteo/queryveh2-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url10 = '../conteo/queryveh2-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
            var url11 = '../conteo/queryveh2-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
                $.getJSON(url, function (data) {
                    $.getJSON(url1, function (data1) {
                        $.getJSON(url2, function (data2) {
                            $.getJSON(url3, function (data3) {
                                $.getJSON(url4, function (data4) {
                                    $.getJSON(url5, function (data5) { 
                                        $.getJSON(url6, function (data6) { 
                                            $.getJSON(url7, function (data7) { 
                                                $.getJSON(url8, function (data8) { 
                                                    $.getJSON(url9, function (data9) {
                                                        $.getJSON(url10, function (data10) { 
                                                            $.getJSON(url11, function (data11) {
                                                                Highcharts.chart('container3', {
                                                                    chart: {
                                                                        type: 'pie'
                                                                    }, 
                                                                    title: {
                                                                        text: 'Porcentaje por tipo'
                                                                    },
                                                                    tooltip: {
                                                                         backgroundColor: 'rgba(0, 0, 0, 0.85)',
                                                                        style: {
                                                                            color: '#F0F0F0'
                                                                        },
                                                                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                                                    },
                                                                    legend: {
                                                                        layout: 'vertical',
                                                                        align: 'right',
                                                                        verticalAlign: 'middle'
                                                                    },
                                                                    series: [
                                                                        {
                                                                            name: "conteo",
                                                                            colorByPoint: true,
                                                                            data: [
                                                                                {
                                                                                    name: "Carril 1",
                                                                                    y: data,
                                                                                    drilldown: "C1"
                                                                                },
                                                                                {
                                                                                    name: "Carril 2",
                                                                                    y: data1,
                                                                                    drilldown: "C2"
                                                                                },
                                                                                {
                                                                                    name: "Carril 3",
                                                                                    y: data2,
                                                                                    drilldown: "C3"
                                                                                }                                          
                                                                            ]
                                                                        }
                                                                    ]
                                                                    ,
                                                                    drilldown: {
                                                                        series: [
                                                                            {
                                                                                name: "Carril 1",
                                                                                id: "C1",
                                                                                data: [
                                                                                    [
                                                                                        "Carros",
                                                                                        data3
                                                                                    ],
                                                                                    [
                                                                                       "Motos",
                                                                                        data4
                                                                                    ],
                                                                                    [
                                                                                       "Pesados",
                                                                                        data5
                                                                                    ]
                                                                                ]
                                                                            },
                                                                            {
                                                                                name: "Carril 2",
                                                                                id: "C2",
                                                                                data: [
                                                                                    [
                                                                                        "Carros",
                                                                                        data6
                                                                                    ],
                                                                                    [
                                                                                        "Motos",
                                                                                        data7
                                                                                    ],
                                                                                    [
                                                                                       "Pesados",
                                                                                        data8
                                                                                    ]
                                                                                ]
                                                                            },                                                                           
                                                                            {
                                                                                name: "Carril 3",
                                                                                id: "C3",
                                                                                data: [
                                                                                    [
                                                                                        "Carros",
                                                                                        data9
                                                                                    ],
                                                                                    [
                                                                                        "Motos",
                                                                                        data10
                                                                                    ],
                                                                                    [
                                                                                       "Pesados",
                                                                                        data11
                                                                                    ]
                                                                                ]
                                                                            }

                                                                        ]
                                                                    },
                                                                    responsive: {
                                                                        rules: [{
                                                                            condition: {
                                                                                maxWidth: 500
                                                                            },
                                                                            chartOptions: {
                                                                                legend: {
                                                                                    layout: 'horizontal',
                                                                                    align: 'center',
                                                                                    verticalAlign: 'bottom'
                                                                                }
                                                                            }
                                                                        }]
                                                                    }

                                                                });
                                                            });    
                                                        });        
                                                    });            
                                                });                
                                            });                    
                                        });                        
                                    });                            
                                });   
                            });    
                        });        
                    });
                });    
            });
//                
////                while(num < 1){    
////                     var map = L.map('map', {
////                        center: [6.2443382, -75.573553],
////                        zoom: 12
////                    });
////                    num++;
////                     mapLink =
////                        '<a href="http://openstreetmap.org">OpenStreetMap</a>';
////                    L.tileLayer(
////                        'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
//////                                    attribution: '&copy; ' + mapLink + ' Contribución',
////                        maxZoom: 19
////                    }).addTo(map);
////                    var firefoxIcon = L.icon({
////                            iconUrl: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRX4LtDoFVb8QEWdhJyXCj0AlJtBohzqtZGMt3bXlgh-BOlHoDK',
////                            iconSize: [33, 38], // size of the icon
////                        });
////                }    
////                 alert(num);                                             
//                       
//                        
////                var url = '../camara/querycam-0.php?fecha1='+fecha1+'&fecha2='+fecha2;
////                var markers;
//                    
//                    
////                    markers = new L.LayerGroup().addTo(map);
//                    
////                var url = '../camara/querycam-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
////                var url  = '../camara/querycam-0.php?camara='+camara;
//////                var url1 = '../camara/querycam-2.php?camara='+camara;
////                $.getJSON(url, function (result) {
//////                    $.getJSON(url1, function (result1) {
////                        
//////                    showmap(result);
//////                    result = null;
//////                    markers.clearLayers();
//////                        marker = new L.marker(result)
//////                                .bindPopup('<strong>Cámara:</strong>' + '' + result1)
//                    for (var i = 0; i < result.length; i++) {
//                        alert(result);
//                        marker = new L.marker([result[i][1], result[i][2]], {icon: firefoxIcon})
//                                .bindPopup('<strong>Cámara:</strong>' + '' + result[i][0] +
//                                '<br> <strong>Ubicacion:</strong>' + '' + result[i][3])
//                                '<br> <strong>Carros:</strong>' + '' + result[i][4] +
//                                '<br> <strong>Motos:</strong>' + '' + result[i][5] +
//                                '<br> <strong>Pesados:</strong>' + '' + result[i][6])
//
//                                .addTo(map);
//                    }
//                    
////                    
//
//                    // zoom the map to the polyline
////                    });
//                });
//                function showmap(result) {
//                    for (var i = 0; i < result.length; i++) {
//                        marker = new L.marker([result[i][1], result[i][2]], {icon: firefoxIcon})
//                                .bindPopup('<strong>Cámara:</strong>' + '' + result[i][0] +
//                                '<br> <strong>Ubicacion:</strong>' + '' + result[i][3] +
//                                '<br> <strong>Carros:</strong>' + '' + result[i][4] +
//                                '<br> <strong>Motos:</strong>' + '' + result[i][5] +
//                                '<br> <strong>Pesados:</strong>' + '' + result[i][6])
//
//                                .addTo(map);
//                    }
//
//                }        
//                        var result;
//                var url = 'camara/queryall.php';
//                $.getJSON(url, function (result) {
//
//                    showmap(result);
//
//                });
//                function showmap(result) {
//                    for (var i = 0; i < result.length; i++) {
//                        marker = new L.marker([result[i][1], result[i][2]])
//                                .bindPopup('<strong>Aforo: </strong>' + result[i][0] +
//                                '<br> <strong>Usuario: </strong>' + result[i][3])
////
////                                .addTo(map);
////                    }
////
////                } 
//               
        });
            
      
             
             
</script>
<?php
    // Including Js actions, put in the end.
    include_once($lvlroot . "Body/JsFoot.php");
    // Including End Header.
    include_once($lvlroot . "Body/EndPage.php");
?>


