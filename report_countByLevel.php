<html>
<head>

    <style>
        .nav-tabs>li.active>a:after {
            border-color: transparent transparent transparent #FAFAFA;
        }

    </style>

    <script>
        $( function() {
            $( "#tabs" ).tabs();
        } );
    </script
</head>
<body>

<div class="container">
    <div class="row">
        <div class='col-xs-12 col-sm-6 col-lg-5'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker_start'>
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-default strick_subject">วันที่เริ่มต้น</button>
                    </span>
                    <input type='text' class="form-control" id='date_start'/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-xs-12 col-sm-6 col-lg-5'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker_end'>
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-default strick_subject">วันที่สิ้นสุด</button>
                    </span>
                    <input type='text' class="form-control" id='date_end'/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <div class='col-xs-12 col-sm-6 col-lg-2'>
            <div class="form-group">
                <div class='input-group date' id='show_data'>
                    <button class="btn btn-success" type="button" style="text-align: right;float: right" onclick="show_chart()"><i class="fa fa-check"></i> ตกลง</button>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var curentdate = d.getFullYear() + '/' +
                (month<10 ? '0' : '') + month + '/' +
                (day<10 ? '0' : '') + day;
            var previous_year = (d.getFullYear() -1) + '/' +
                (month<10 ? '0' : '') + month + '/' +
                (day<10 ? '0' : '') + day;
            $(function () {
                $('#datetimepicker_start').datetimepicker({
                    format: 'DD/MM/YYYY',
                    defaultDate:previous_year
                });
                $('#datetimepicker_end').datetimepicker({
                    format: 'DD/MM/YYYY',
                    defaultDate:curentdate
                });
            });

        </script>
    </div>
</div>
<div id="info2">

</div>
<div id="tabs" style="height: 500px">
    <ul>
        <li><a href="#tabs-1">chart</a></li>
        <li><a href="#tabs-2">data</a></li>
    </ul>
    <div id="tabs-1">
        <div id="chart1"></div>
    </div>
    <div id="tabs-2">
        <table class="table table-striped">
            <thead>
            <th>รายการความรุนแรง</th>
            <th>จำนวน</th>
            </thead>
            <tbody id="data">

            </tbody>
        </table>
    </div>

</div>

<script>
    $(document).ready(function(){
            //*********************
       show_chart();

    })
    function show_chart(){
        var start_date = $('input#date_start').val() ;
        var end_date = $('input#date_end').val() ;
        var containerHeight = $("#tabs").height();
        var containerWidth = $("#tabs").width();
        $('div#chart1').empty();


        $.getJSON('json_reportCountByLevel.php',{start_date:start_date,end_date:end_date}, function (data) {
            var s1 =  new Array();
            var labels1 = new Array();
            var s2 = new Array();
            $("tbody#data tr").remove();
            $.each(data, function (key, val) {
                labels1.push([val.name]);
                s1.push([val.name,val.count_total]);
                s2.push([val.count_total]);

                $("tbody#data").append("<tr>" +
                    "<td>" + val.name + "</td>" +
                    "<td>" + val.count_total + "</td>" +
                    "</tr>");
            })

            var plot1 = $.jqplot('chart1', [s1], {
                height: containerHeight,
                width: containerWidth,
                title:'ความเสี่ยงแยกตามระดับความรุนแรง',
                seriesDefaults:{
                    renderer:$.jqplot.BarRenderer,
                    rendererOptions: {
                        // Set the varyBarColor option to true to use different colors for each bar.
                        // The default series colors are used.
                        varyBarColor: true,
                        smooth: true,
                        animation: {
                            show: true
                        },
                        showMarker: true,
                        pointLabels: {
                            show:true,
                            labels:s2
                        }
                    }
                },
                axesDefaults: {
                    tickRenderer: $.jqplot.CanvasAxisTickRenderer

                },
                axes:{
                    xaxis:{
                        renderer: $.jqplot.CategoryAxisRenderer,
                        label:'ความรุนแรง',
                        tickOptions: {
                            angle: -10
                        }

                    },
                    yaxis: {
                        pad: 100,
                        label:'จำนวน',
                        tickInterval: 200,
                        // tickOptions: {formatString: '$%d'},
                        min: 0,
                        max: 2000
                    }
                },
                series:[
                    {pointLabels:{
                        show: true,
                        labels:s2
                    }}]
            });
        });


    }
    $('#tabs').bind('tabsactivate', function(event, ui) {
        if (ui.newTab.index() === 0 ) {
            show_chart();
        }
    });

</script>
</body>
</html>