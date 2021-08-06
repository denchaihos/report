<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../jquery/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../jquery/jquery-ui/jquery-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="../jquery/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css"/>
    <link type="text/css" rel="stylesheet" href="../css/font-awesome-4.6.3/css/font-awesome.min.css"/>
    <script type="text/javascript" src="../jquery/jquery/jquery-1.11.3.min.js"></script>

    <script type="text/javascript" src="../jquery/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../jquery/jquery-ui/jquery-ui.min.js"></script>
    <script src="../jquery/moment.js" type="text/javascript"></script>
    <script src="../jquery/transition.js" type="text/javascript"></script>
    <script src="../jquery/collapse.js" type="text/javascript"></script>

    <script src="../jquery/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

    <style>
        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            color: white;
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #153449;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        .display{
            display: block;
        }

        .stopDisplay{
            display: none;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
<?php
$reportId = !isset($_GET['reportId']) ? $_GET['reportId'] : $_GET['reportId'];
$reportName = !isset($_GET['reportName']) ? $_GET['reportName'] : $_GET['reportName'];
$startDate = !empty($_GET['startDate']) ? $_GET['startDate'] : "";
$endDate = !empty($_GET['endDate']) ? $_GET['endDate'] : "";

include "connect_pdo.php";

$report_query = "SELECT * FROM tsureport WHERE id=$reportId";
$sql = $db->prepare($report_query);
$sql->execute();
$sql = $sql->fetch();
$reportTemplate = $sql['template'];


?>


<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

    <div class="panel-body" id="panel">
        <form name="myform" id="myform" class="form-inline" role="form" method="get">
            <input type="hidden" name="reportId" id="reportId" value="<? echo $reportId ?>">
            <input type="hidden" name="reportName" value="<? echo iconv('UTF-8', 'cp874', $reportName) ?>">
            <input type="text" name="reportTemplate" id="reportTemplate" value="<? echo  $reportTemplate ?>">

            <div class="form-group">
                <div class='input-group date' id='datetimepicker_start'>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default strick_subject">วันที่เริ่มต้น</button>
                            </span>
                    <input type='text' class="form-control" id='date_start' name="startDate"
                           value="<? echo $startDate ?>">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                </div>
            </div>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker_end'>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default strick_subject">วันที่สิ้นสุด</button>
                            </span>
                    <input type='text' class="form-control" id='date_end' name="endDate" value="<? echo $endDate ?>">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                </div>
            </div>
            <div class="form-group">
                <label for="sel1">สิทธิ์การรักษา:</label>
                <select class="form-control" id="sel1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
            <br>
            <input type="button" name="show" id="show_data" class="btn btn-success" value="Show" onclick="submitF()">
            <br>
            <hr>

            <h2><i class="fa fa-cog" aria-hidden="true"></i><span>แก้ไข Template</span></h2>
            <ul class="list-group">
                <li class="list-group-item" onclick="register()"><a href="#?editTemplate"> ใบปะหน้า นค1.</a></li>
                <li class="list-group-item"><a href="editTemplate.php"> ใบปะหน้า แบบสรุป นค1. </a></li>
                <li class="list-group-item">Third item</li>
            </ul>

            <script type="text/javascript">
                var oldDate = $('#date_start').val();
                var d = new Date();
                var month = d.getMonth() + 1;
                var day = d.getDate();
                var curentdate = d.getFullYear() + '-' +
                    (month < 10 ? '0' : '') + month + '-' +
                    (day < 10 ? '0' : '') + day;
                var previous_year = (d.getFullYear() - 1) + '/' +
                    (month < 10 ? '0' : '') + month + '/' +
                    (day < 10 ? '0' : '') + day;
                // alert(curentdate);

                $(function () {

                    $('#datetimepicker_start').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                    $('#datetimepicker_end').datetimepicker({
                        useCurrent: false, //Important! See issue #1075
                        format: 'YYYY-MM-DD'
                    });
                    $("#datetimepicker_start").on("dp.change", function (e) {
                        $('#datetimepicker_end').data("DateTimePicker").minDate(e.date);
                    });
                    $("#datetimepicker_end").on("dp.change", function (e) {
                        $('#datetimepicker_start').data("DateTimePicker").maxDate(e.date);
                    });
                });
                function submitF() {
                    $.blockUI({ message: '<h1><img src="images/busy.gif" /> Just a moment...</h1>' });
                    var startDate = $('#date_start').val();
                    var endDate = $('#date_end').val();

                    var reportId = $("#reportId").val();
                    var reportTemplate = $("#reportTemplate").val();
                    var w = window,
                        d = document,
                        e = d.documentElement,
                        g = d.getElementsByTagName('body')[0],
                        screenWidth = (w.innerWidth || e.clientWidth || g.clientWidth),
                        screenHeight = (w.innerHeight || e.clientHeight || g.clientHeight) - 90;
                    $('div#pdf').empty();
                    $.ajax({
                        type: "GET",
                        url: "specialReport/"+reportTemplate,
                        data: {startDate: startDate, endDate: endDate, reportId: reportId},
                        success: function () {
                            // alert('success');
                            // $("div#pdf").css("width", screenWidth-80);
                            $("div#pdf").css("height", screenHeight);
                            $('div#pdf').append(
                                /*"<object data='specialReport/MyPDF/MyPDF.pdf' type='application/pdf' width='95%' height='95%'></object>");
                                 document.getElementById("mySidenav").style.width = "0";*/
                                //PDFObject.embed("specialReport/MyPDF/MyPDF.pdf", "#example1");
                                "<iframe src = 'viewerjs/ViewerJS/#../../specialReport/MyPDF/MyPDF.pdf' width='1100' height='" + screenHeight + "' allowfullscreen webkitallowfullscreen></iframe>");
                            document.getElementById("mySidenav").style.width = "0";
                        },
                        error: function (data) {
                            var r = jQuery.parseJSON(data.responseText);
                            alert("Message: " + r.Message);
                            alert("StackTrace: " + r.StackTrace);
                            alert("ExceptionType: " + r.ExceptionType);
                        }
                    });
                }

            </script>

        </form>


    </div>
</div>





<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; <?php
    echo "$reportName";
    ?></span>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "350px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>
<div style="height: 100%;width: 100%" id="pdf"></div>

<div class="modal-content stopDisplay" id="add_pt">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"> แกไข Template </h4>
    </div>
    <div class="modal-body">
        <form method='post' action='save.php'>
            <textarea name='myTextArea'></textarea>
            <button type='submit'>Go</button>
        </form>
    </div>
</div>

</body>
</html> 
