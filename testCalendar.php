<!DOCTYPE html>
<html>
<head>
    <title></title>




    <link type="text/css" rel="stylesheet" href="jquery/bootstrap-3.3.7-dist/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jquery-ui/jquery-ui.min.css"/>

    <!--        <link href="jquery/datepicker_buddhist_year/css/ui-lightness/jquery-ui-1.8.10.custom.css" rel="stylesheet"  type="text/css"/>-->
    <link type="text/css" rel="stylesheet" href="jquery/jquery-ui/jquery-ui.theme.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jquery-ui/jquery-ui.structure.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/font-awesome-4.6.3/css/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jqplot/dist/jquery.jqplot.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jqplot/dist/examples/syntaxhighlighter/styles/shCoreDefault.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jqplot/dist/examples/syntaxhighlighter/styles/shThemeDefault.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jqplot/dist/examples/jquery-ui/css/smoothness/jquery-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="jquery/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css"/>




    <script type="text/javascript" src="jquery/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="jquery/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jquery/jquery-ui/jquery-ui.min.js"></script>



    <script src="jquery/moment.js" type="text/javascript"></script>
    <script src="jquery/transition.js" type="text/javascript"></script>
    <script src="jquery/collapse.js" type="text/javascript"></script>
    <script src="jquery/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

    <style>

    </style>





</head>
<body>
<?php

$data = array();

?>
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

<script src="jquery/jquery-migrate-1.0.0.js"  type="text/javascript"></script>
<script class="include" type="text/javascript"  src="jquery/jqplot/dist/jquery.jqplot.min.js"></script>
<script class="include" type="text/javascript"  src="jquery/jqplot/dist/plugins/jqplot.canvasTextRenderer.min.js"></script>
<script class="include" type="text/javascript"  src="jquery/jqplot/dist/plugins/jqplot.barRenderer.min.js"></script>
<script class="include" type="text/javascript"  src="jquery/jqplot/dist/plugins/jqplot.dateAxisRenderer.min.js"></script>
<script class="include" type="text/javascript"  src="jquery/jqplot/dist/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script class="include" type="text/javascript"  src="jquery/jqplot/dist/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script class="include" type="text/javascript"  src="jquery/jqplot/dist/plugins/jqplot.pointLabels.min.js"></script>
<script class="include" type="text/javascript"  src="jquery/jqplot/dist/plugins/jqplot.categoryAxisRenderer.min.js"></script>

<script src="function/index.js"></script>

</body>
</html>
