
<link href="../../assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
<link href="../../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
<link href="../../assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
<?php

$lvlroot = "../";
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
                        <div class="form-group" style="margin-left: 250px;">
                            <div class="input-group input-daterange" data-date-format="yyyy-mm-dd">
                                <div class="col-md-5 col-sm-5">
                                    <input type="text" class="form-control" name="start" placeholder="Fecha Inicial" id="fecha1"  />
                                </div>
                                <div class="col-md-2 col-sm-2"> 
                                    <span class="input-group-addon">Entre</span>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <input type="text" class="form-control"  name="end" placeholder="Fecha Final" id="fecha2" onchange="Load();"/>
                                </div>                                
                            </div>
                        </div>
                    </form>
                </div> 
                <form data-parsley-validate="true" id="formclient" name="formclient" class="form-horizontal form-bordered" method="post" action="">
                    <div class="form-group">
                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Vehiculos (*)</label>
                        </div>                       
                            <div class="col-md-4 col-sm-4">
                                <select name="selectid" Id="selectvehiculo">
                                    <option value="" disabled selected>Selecciona un tipo de vehiculo</option>
                                    <?php  
                                    require_once "querycombo.php";
                                    while ($row_veh = pg_fetch_array($resul_veh) ){
                                    ?>    
                                    <option value="<?php echo $row_veh['id'] ?>"> 
                                    <?php echo $row_veh['vehiculo']  ?> </option>
                                    <?php } ?>                                          
                                </select>
                            </div>
                        <div class="control-label col-md-2 col-sm-2 text-left">
                            <label>Camaras (*)</label>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <select name="selectid" Id="selectcamara">
                                <option value="" disabled selected>Selecciona una camara </option>
                                <?php  
                                require_once "querycombo1.php";
                               while($row_cam = pg_fetch_assoc($resul_cam)){
                                    ?>
                                    <option value=<?php echo $row_cam['id']; ?>>
                                        <?php echo $row_cam['camara']." - ".$row_cam['dir']; ?> 
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div> 
                </form>    
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 text-right">
                        <button id="consultar" class="btn btn-success btn-sm">
                            <i class="fa fa-floppy-o">
                                Consultar
                            </i>
                        </button>    
                </div>
            </div>
            <div class="panel-body panel-form">
                <div class="panel-body panel-form form-horizontal form-bordered">
                    <form data-parsley-validate="true" id="form-stock" name="demo-form-ware-info" class="form-horizontal form-bordered" method="post" action="" >
                        <div class="form-group">
<!--                            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
                            <script language="javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.22/jquery-ui.min.js"></script>-->
                            <br>
                            <div id="container" style="height: 400px; min-width: 600px"></div>
<!--                            <script src="http://code.highcharts.com/stock/highstock.js"></script>
                            <script src="http://code.highcharts.com/stock/modules/exporting.js"></script>
                            <script type="text/javascript">  
                                // espacio de la grafica
                                
                            </script>-->
                            <script src="https://code.highcharts.com/highcharts.js"></script>
                            <script src="https://code.highcharts.com/modules/series-label.js"></script>
                            <script src="https://code.highcharts.com/modules/exporting.js"></script>
                            <script src="https://code.highcharts.com/modules/export-data.js"></script>
                            <script type="text/javascript">    
                                            
                            </script>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </div>    
<?php
include_once($lvlroot . "Body/AlertsWindows.php");
?>
</div>
<script type="text/javascript">
    $("#selectvehiculo").prop('disabled', true);
    $("#consultar").click(function(){
//        var vehiculo =$("#selectvehiculo").val();
        var camara =$("#selectcamara").val();
        var fecha1 =$("#fecha1").val();
        var fecha2 =$("#fecha2").val();
//        var url = 'querystock.php?vehiculo='+vehiculo+'&camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
        var url = 'queryveh-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
        var url1 = 'queryveh-1.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
        var url2 = 'queryveh-2.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
        var urlnom = 'querynombre.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;;
//        var url = 'querystock.php';
        $.getJSON(url, function (data) {
            $.getJSON(urlnom, function (datanom) {
                $.getJSON(url1, function (data1) {
                    $.getJSON(url2, function (data2) {
//                                      
                        Highcharts.chart('container', {

                            chart: {
                                type: 'column'
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
                                   categories: ['camara 63']
                            },

                            yAxis: {
                                title: {
                                    text: 'Cantidad'
                                }
//                                ,                     
//                                   categories: datanom

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
                                    data: data1,
                                    drilldown: 'veh'
                            },
                            {
                                    name: 'Pesados',
                                    data: data2
                            },
                            drilldown: {
                                            series: 
//                                                    [data2]
                                                    [{
                                                id: 'veh',
                                                name: 'Animals',
                                                data: data2
                                            }]
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
//            var url = 'querystock.php?camara='+camara+'&vehiculo='+vehiculo+'&fecha1='+fecha1+'&fecha2='+fecha2;
//               var url = 'queryveh-0.php?camara='+camara+'&fecha1='+fecha1+'&fecha2='+fecha2;
//                alert(url);
        });
             
             
</script>
<?php
    // Including Js actions, put in the end.
    include_once($lvlroot . "Body/JsFoot.php");
    // Including End Header.
    include_once($lvlroot . "Body/EndPage.php");
?>