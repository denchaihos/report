<?php
$reportId = !isset($_GET['reportId']) ? $_GET['reportId'] : $_GET['reportId'];
$reportName = isset($_GET['reportName']) ? $_GET['reportName'] : $_GET['reportName'];
$eq = isset($_GET['eq']) ? $_GET['eq'] : "";
$fex = isset($_GET['fex']) ? $_GET['fex'] : "";
$mysqli = isset($_GET['mysqli']) ? $_GET['mysqli'] : "";
$startDate = !empty($_GET['startDate']) ? $_GET['startDate'] : "";
$endDate = !empty($_GET['endDate']) ? $_GET['endDate'] : "";
?>
<script>


</script>
<div class="container">
    <div class="panel-body" id="panel">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <span class="panel-title"><?php echo $reportName ?></span>
                <div id="export" style="text-align: right;float: right;margin-top: -5px">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Export
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="background-color:rgba(0, 0, 0, 0);margin-right: 8px;text-align: center;">
                            <li><h5>File Type</h5>
                            <li role="separator" class="divider"></li>
                            <button  class="btn btn-success btn-xs"  onclick="exportXLS()" >EXECEL <i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i></button></li>

                            <button  class="btn btn-danger btn-xs" onclick="openPdf()">PDF <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></button>
                            <!--<button  class="btn btn-danger btn-xs" onclick="exportCSV()">PDF <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></button>-->

                            <button  class="btn btn-primary btn-xs" onclick="exportCSV()">CSV <i class="fa fa-file-o fa-2x" aria-hidden="true"></i></button></li>
                            <button  class="btn btn-warning btn-xs" onclick="exportCSV()">Printer <i class="fa fa-print fa-2x" aria-hidden="true"></i></button></li>


                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel-body" id="panel">
                <form name="myform" id="myform" class="form-inline" role="form" action=""  method="get" >
                    <input type="hidden" name="reportId" id="reportId" value="<? echo $reportId ?>">
                    <input type="hidden" name="reportName" value="<? echo $reportName ?>">
                    <input type="hidden" name="fex" id="fex" value="<? echo $fex ?>">
                    <input type="hidden" name="eq" id="eq" value="<? echo $eq ?>">
                    <input type="hidden" name="mysqli" id="mysqli" value="<? echo $mysqli ?>">
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker_start'>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default strick_subject">วันที่เริ่มต้น</button>
                            </span>
                            <input type='text' class="form-control" id='date_start'name="startDate" value="<? echo $startDate ?>">
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
                            <input type='text' class="form-control" id='date_end' name="endDate" value="<? echo $endDate ?>" >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>


                    <input type="button" name="show"  id="show_data" class="btn btn-success" value="Show" onclick="readRecords(1)" >
                    <input type="button" name="show"  id="show_data" class="btn btn-success" value="Show" onclick="pdf()" >
                    <input type="button" name="InsertDX" id="excute_data" class="btn btn-danger" value="ExcuteScript" onclick="excuteForm('excute_report.php')" >

                    <script type="text/javascript">
                        var oldDate = $('#date_start').val();
                        var d = new Date();
                        var month = d.getMonth()+1;
                        var day = d.getDate();
                        var curentdate = d.getFullYear() + '-' +
                            (month<10 ? '0' : '') + month + '-' +
                            (day<10 ? '0' : '') + day;
                        var previous_year = (d.getFullYear() -1) + '/' +
                            (month<10 ? '0' : '') + month + '/' +
                            (day<10 ? '0' : '') + day;
                        // alert(setDate);

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

                    </script>

                </form>

                <div class="row">
                    <div class="col-md-12">
                        <div class="records_content" id="pdf">


                        </div>

                        <div class="col-lg-12">
                            <center>
                                <div class="show_page"></div>
                            </center>
                            <center>
                                <div class="total"></div>
                            </center>
                            <center>
                                <div class="dem2"></div>
                            </center>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<script>




</script>
<script src="function/reportPreview.js"></script>
<script src="function/export.js"></script>