<!DOCTYPE html>
<html>
<head>
    <title></title>

    <link rel="stylesheet" href="jquery/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="jquery/jquery-ui/jquery-ui.min.css"/>
    <!-- CSS -->
    <link rel="stylesheet" href="jquery/alertifyjs/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="jquery/alertifyjs/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="jquery/alertifyjs/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="jquery/alertifyjs/css/themes/bootstrap.min.css"/>
    <!--
        RTL version
    -->
    <link rel="stylesheet" href="jquery/alertifyjs/css/alertify.rtl.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="jquery/alertifyjs/css/themes/default.rtl.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="jquery/alertifyjs/css/themes/semantic.rtl.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="jquery/alertifyjs/css/themes/bootstrap.rtl.min.css"/>

    <link rel="stylesheet" type="text/css" href="jquery/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jquery-ui/jquery-ui.theme.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jquery-ui/jquery-ui.structure.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/font-awesome-4.6.3/css/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jqplot/dist/jquery.jqplot.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jqplot/dist/examples/syntaxhighlighter/styles/shCoreDefault.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jqplot/dist/examples/syntaxhighlighter/styles/shThemeDefault.min.css"/>
    <link type="text/css" rel="stylesheet" href="jquery/jqplot/dist/examples/jquery-ui/css/smoothness/jquery-ui.min.css"/>



    <link rel="stylesheet" href="css/override_css.css"/>

    <script type="text/javascript" src="jquery/jquery/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="jquery/jquery-migrate-1.0.0.js" ></script>
    <script type="text/javascript" src="jquery/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jquery/jquery.bootpag.min.js"></script>
    <script type="text/javascript" src="jquery/alertifyjs/alertify.min.js"></script>
    <script type="text/javascript" src="jquery/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="jquery/blockUI/jquery-blockUI.js"></script>
    <script src="jquery/moment.js" type="text/javascript"></script>
    <script src="jquery/transition.js" type="text/javascript"></script>
    <script src="jquery/collapse.js" type="text/javascript"></script>
    <script src="jquery/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

    <style>
        /*.total1 {
            background-color: #000;
            color: #fff;
            font-weight: bold;
        }*/

    </style>


</head>
<body>
<?php
/*define('ROOT',str_replace("\\",'/',dirname(__FILE__)));
define('PATH', ROOT == $_SERVER['DOCUMENT_ROOT']
    ?'' :substr(ROOT,strlen($_SERVER['DOCUMENT_ROOT']))
);

echo "root=".ROOT,'<br />';
echo "path=".PATH,'<br />';*/
include 'connect_pdo.php';
include "main_menu.php";
$data = array();

?>
<div class="container">
<div id="tab_include">
    <?
    if(isset($_GET['reportId']) && $_GET['custom_report']=='N'){
        include "reportPreview.php";
    }elseif(isset($_GET['reportId']) && $_GET['custom_report']=='Y'){
        include "custom_report/custom_report1.php";
    }elseif(isset($_GET['report'])){
        include "report.php";
    }elseif(isset($_GET['createReport'])){
        include "createReportForm.php";
    }else{
        include "main_page.html";
    }

    ?>
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
