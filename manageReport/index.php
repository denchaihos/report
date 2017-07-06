<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report Management</title>

    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="../css/font-awesome-4.6.3/css/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="../css/radio.css"/>
</head>
<style>
    .modal .modal-dialog { width: 80%; }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }


</style>
<body>
<?php

?>
<!-- Content Section -->
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-left">
                <div class="span12">
                    <a href="../index.php" target="_self">
                        <button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home
                        </button>
                    </a>
                    <span><h3 style="display:inline;">Report Management</h3></span>
                </div>
            </div>
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" id="add" data-target="#update_modal" onclick="clearData()">Add New Report</button>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <input type="hidden" id="hidden_count" />
        <div class="col-md-12">
            <div class="records_content">

            </div >
                <!--      Pagepaginate-->

                <div class="col-lg-12 page_pagination">

                </div>
            <center><div class="show_page"></div>
                <div class="total"></div>
                <div class="dem2"></div></center>
            </div>
        </div>
    </div>
</div>
<!-- /Content Section -->


<!-- Bootstrap Modals -->


<!-- Modal - Update User details -->
<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <form id="modal_form" name="modal_form" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Report Manage</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="update_first_name">Report Name</label>
                        <input type="text" id="namereport" name="namereport" placeholder="" class="form-control" required/>
                    </div>
                    <div class="form-inline" style="border-bottom:2px solid green">
                        <span id="basic" class="label label-info">Basic</span>
                        <button type="button" class="btn btn-warning btn-circle" id="basic_symbol">
                            <i class="fa fa-angle-up"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-circle" id="basic_symbol" style="display: none">
                            <i class="fa fa-angle-down"></i>
                        </button>

                    </div>
                    <div id="basic_config">
                        <div class="form-group">
                            <label for="contain">Department Or Group Report</label>
                            <select class="form-control" id="department" name="department" required>
                                <option value="0">select</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="update_last_name">Request_by</label>
                            <input type="text" id="request_by" name="request_by" placeholder="Request_by" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="contain">Note</label>
                            <textarea class="form-control" type="textarea" id="note" name="note" placeholder="Message" maxlength="140" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="contain">SQL Query</label>
                            <textarea class="form-control" type="textarea" id="r_query" name="r_query" placeholder="SQL--" maxlength="700" rows="15"></textarea>
                            <!-- <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>-->
                        </div>
                    </div>

                    <div class="form-inline" style="border-bottom:2px solid green">
                        <span id="advance" class="label label-info">Advance</span>
                        <button type="button" class="btn btn-warning btn-circle" id="advance_symbol">
                            <i class="fa fa-angle-up"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-circle" id="advance_symbol" style="display: none">
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </div>


                    <div id="advance_config">
                        <div class="btn-toolbar" role="toolbar" aria-label="...">
                            <div class="funkyradio">
                                <div class="funkyradio-info">
                                    <input type="radio" name="radio_query" id="radio1" value="1" checked/>
                                    <label for="radio1">Excute Query</label>
                                </div>

                                <div class="funkyradio-info">
                                    <input type="radio" name="radio_query" id="radio2" value="2" />
                                    <label for="radio2">File Query</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="ex_query">
                            <label for="contain">Excute Query</label>
                            <textarea class="form-control" type="textarea" id="e_query" name="e_query" placeholder="SQL--Advance" maxlength="700" rows="15"></textarea>
                            <!-- <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>-->
                        </div>
                        <div class="form-group" id="file_query">
                            <label for="exampleInputFile">File Text Query (.txt file only)</label>
                            <input type="file" id="file_ex" name="file_ex" accept=".txt" onchange='fileinfo(this.value)'>
                            <p id="file_name"></p>
                            <p class="help-block">Example  myquery.txt</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="update_btn" onclick="UpdateReportDetails()" >Save Changes</button>
                    <input type="hidden" id="hidden_report_id" >
                    <button type="button" class="btn btn-primary" id="add_btn" onclick="addRecord()">Add Record</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- // Modal -->

<!-- Jquery JS file -->
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

<!-- Bootstrap JS file -->
<script type="text/javascript" src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.bootpag.min.js"></script>

<!-- Custom JS file -->
<script src="js/page_pagination.js"></script>
<script type="text/javascript" src="js/readRecords.js"></script>
<script type="text/javascript" src="js/script.js"></script>


<script src="../function/createReport.js"></script>



</body>
</html>
