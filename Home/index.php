<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<?php

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
    <select name="selectid" Id="selectcamara">
        <option value="" disabled selected>Selecciona una camara </option>
        <?php  
        require_once "../Reportes/vehiculominuto/querycombo.php";
//                                    $i = 0;
        while($row = pg_fetch_assoc($resultado)){
            ?>
            <option value=<?php echo $row['id']; ?>>
                <?php if ($row['id'] <= 63){echo $row['camara']." - ".$row['dir'];} else{break;}?> 
            </option>
            <?php                                    
        }
        ?>
    </select>
    <div class="panel panel-inverse ">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title"> <i class="fa fa-line-chart"></i>Ultimo Reporte</h4>        
        </div>                  
        <!-- begin col-3 -->
        <div class="panel-body panel-form">
            <div class="panel-body panel-form form-horizontal form-bordered">                   
                <div class="form-group" >
                    <div class="col-md-4 col-sm-6">
                        <div class="widget widget-stats bg-blue-darker">
                            <div class="stats-icon stats-icon-lg "><i class="fa fa-car"></i></div>
                            <div class="stats-title ">Conteo automovil</div>
                            <div id ="idbt" class="stats-number "></div>
                        </div>
                        </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="widget widget-stats bg-green-darker">
                            <div class="stats-icon stats-icon-lg "><i class="fa fa-motorcycle" ></i></div>
                            <div class="stats-title ">Conteo Motos</div>
                            <div id ="idgt" class="stats-number "></div>                               
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="widget widget-stats bg-red-darker">
                            <div class="stats-icon stats-icon-lg "><i class="fa fa-truck"></i></div>
                            <div class="stats-title ">Conteo Pesados</div>
                            <div id ="idrt" class="stats-number "></div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>    
    </div>
    <div class="panel panel-inverse ">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title"> <i class="fa fa-bar-chart"></i>Reporte por Tipo</h4>        
        </div>
        <div id="container"></div>
    </div>
    <div class="panel panel-inverse col-md-6 col-sm-12">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title"> <i class="fa fa-bar-chart"></i>Reporte por Carril</h4>        
        </div>
        <div id="container1"></div>
    </div>
    <div class="panel panel-inverse col-md-6 col-sm-12">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
            <h4 class="panel-title"> <i class="fa fa-bar-chart"></i>Porcentaje</h4>            
        </div>
        <div id="container2"></div>
    </div>

<?php
include_once($lvlroot . "Body/AlertsWindows.php");
?>
</div>
<script>
    $(document).ready(function() {               
        $("#selectcamara").val('62');        
        var camara = $("#selectcamara").val();
        datos();
        $(function () {
            
            var url  = 'querymin-0.php?camara='+camara;
            var url1 = 'querymin-1.php?camara='+camara;
            var url2 = 'querymin-2.php?camara='+camara;
            var url3 = 'queryfecha.php?camara='+camara;
            $.getJSON(url, function (data) {
                $.getJSON(url1, function (data1) {
                    $.getJSON(url2, function (data2) {
                        $.getJSON(url3, function (fecha) {
                        Highcharts.chart('container', {
                            chart: {
                                type: 'area'
                            },        
                            title: {
                                text: 'Conteo por tipo de vehiculo'
                            },
                            xAxis: {
                                categories: fecha                                
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
                                name: 'Automovil',
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
            var url  = 'querycar-0.php?camara='+camara;
            var url1 = 'querycar-1.php?camara='+camara;
            var url2 = 'querycar-2.php?camara='+camara;
            $.getJSON(url, function (data) {                
                $.getJSON(url1, function (data1) {
                    $.getJSON(url2, function (data2) {
                        Highcharts.chart('container1', {
                            chart: {
                                type: 'column'
                            }, 
                            title: {
                                text: 'Conteo por carril'
                            },
                            xAxix: {
                                
                                    categories: 'Carriles'
                                
                            },   
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.85)',
                                    style: {
                                    color: '#F0F0F0'
                                },
                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}'
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle'
                            },
                            series: [{
                                name: 'Carril 1',
                                data: data
                            },
                            {
                                name: 'Carril 2',
                                data: data1
                            },
                            {
                                name: 'Carril 3',
                                data: data2
                            }],
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
        $(function () {
            var url  = 'queryveh-0.php?camara='+camara;
            var url1 = 'queryveh-1.php?camara='+camara;
            var url2 = 'queryveh-2.php?camara='+camara;
            $.getJSON(url, function (data) {
                $.getJSON(url1, function (data1) {
                    $.getJSON(url2, function (data2) {
                        Highcharts.chart('container2', {
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
                            series: [{
                                name: 'vehiculos',
                                data: [{
                                        name: 'Automovil',
                                        y: data 
                                       },
                                       {
                                        name: 'Motos',
                                        y: data1
                                       },
                                       {
                                        name: 'Pesados',
                                        y: data2                                       
                                 
                                }]
                            }],
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
    setInterval(function(){  
        datos();       
    }, 500000);   
    function datos(){
        var camara = $("#selectcamara").val();
        var url  = 'queryveh-0.php?camara='+camara;
        var url1 = 'queryveh-1.php?camara='+camara;
        var url2 = 'queryveh-2.php?camara='+camara;
        $.getJSON(url, function (data) {
            $.getJSON(url1, function (data1) {
                $.getJSON(url2, function (data2) {
                    $("#idbt").empty().append(data);
                    $("#idgt").empty().append(data1);
                    $("#idrt").empty().append(data2);                    
                });           
            });
        }); 
    }
    $("#selectcamara").click(function(){
        var camara = $("#selectcamara").val();
        $(function () {
            
            var url  = 'querymin-0.php?camara='+camara;
            var url1 = 'querymin-1.php?camara='+camara;
            var url2 = 'querymin-2.php?camara='+camara;
            var url3 = 'queryfecha.php?camara='+camara;
            $.getJSON(url, function (data) {
                $.getJSON(url1, function (data1) {
                    $.getJSON(url2, function (data2) {
                        $.getJSON(url3, function (fecha) {
                        Highcharts.chart('container', {
                            chart: {
                                type: 'area'
                            },        
                            title: {
                                text: 'Conteo por tipo de vehiculo'
                            },
                            xAxis: {
                                categories: fecha                                
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle'
                            },                           
                            series: [{
                                name: 'Automovil',
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
            var url  = 'querycar-0.php?camara='+camara;
            var url1 = 'querycar-1.php?camara='+camara;
            var url2 = 'querycar-2.php?camara='+camara;
            $.getJSON(url, function (data) {                
                $.getJSON(url1, function (data1) {
                    $.getJSON(url2, function (data2) {
                        Highcharts.chart('container1', {
                            chart: {
                                type: 'column'
                            }, 
                            title: {
                                text: 'Conteo por carril'
                            },
                            xAxix: {
                               
                                    categories: ['Carriles']
                                
                            },    
//                            tooltip: {
//                                backgroundColor: 'rgba(0, 0, 0, 0.85)',
//                                    style: {                                       
//                                        color: '#F0F0F0'
//                                    },
//                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
//                                pointFormat: '<span style="color:{point.color}">'
//                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle'
                            },
                            series: [{
                                name: 'Carril 1',
                                data: data
                            },
                            {
                                name: 'Carril 2',
                                data: data1
                            },
                            {
                                name: 'Carril 3',
                                data: data2
                            }],
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
        $(function () {
            var url  = 'queryveh-0.php?camara='+camara;
            var url1 = 'queryveh-1.php?camara='+camara;
            var url2 = 'queryveh-2.php?camara='+camara;
            $.getJSON(url, function (data) {
                $.getJSON(url1, function (data1) {
                    $.getJSON(url2, function (data2) {
                        Highcharts.chart('container2', {
                            chart: {
                                type: 'pie'
                            }, 
                            title: {
                                text: 'Porcentaje por tipo'
                            },
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            legend: {
                                layout: 'vertical',
                                align: 'right',
                                verticalAlign: 'middle'
                            },
                            series: [{
                                name: 'vehiculos',
                                data: [{
                                        name: 'Automovil',
                                        y: data 
                                       },
                                       {
                                        name: 'Motos',
                                        y: data1
                                       },
                                       {
                                        name: 'Pesados',
                                        y: data2                                       
                                 
                                }]
                            }],
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
        var url  = 'queryveh-0.php?camara='+camara;
        var url1 = 'queryveh-1.php?camara='+camara;
        var url2 = 'queryveh-2.php?camara='+camara;
        $.getJSON(url, function (data) {
            $.getJSON(url1, function (data1) {
                $.getJSON(url2, function (data2) {
                    $("#idbt").empty().append(data);
                    $("#idgt").empty().append(data1);
                    $("#idrt").empty().append(data2);                    
                });           
            });
        }); 
    });
</script>
<!-- end row -->
<?php
    // Including Js actions, put in the end.
    include_once($lvlroot . "Body/JsFoot.php");
    // Including End Header.
    include_once($lvlroot . "Body/EndPage.php");
?>

