<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20/4/2560
 * Time: 9:15 น.
 */
?>
<style>
    .modal .modal-dialog { width: 30%; }
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    .sub_detail{
        font-size: 12px;

        color: #0000CC;
    }
    .floating-box {

        float: left;
        font-size: 14px;
        font-weight: bold;
        margin: 10px;

    }

    .after-box {
        clear: left;

    }
    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        padding: 5px;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    page[size="A4"] {
        width: 21cm;
        height: 29.7cm;
    }



</style>
<div class="container">
    <div class="panel-body" id="panel">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <form class="form-inline">
                    <div class="form-group">


                        <button type="button" class="btn btn-default strick_subject">HN:</button>
                    </div>
                    <div class="form-group mx-sm-3">

                        <input type='text' class="form-control" id='hn' name="hn" value="">
                    </div>
                    <input type="button" name="show" id="show_data" class="btn btn-success" data-toggle="modal" data-target="#update_modal" onclick="getVisitDate();" value="Show">
                    <input type="button" class="btn btn-success" onclick="printDiv('printableArea')" value="print">


                <div id="export" style="text-align: right;float: right;margin-top: -5px">
                    <div class="dropdown">
                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Export
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1"
                            style="background-color:rgba(0, 0, 0, 0);margin-right: 8px;text-align: center;">
                            <li><h5>File Type</h5>
                            <li role="separator" class="divider"></li>
                            <button class="btn btn-success btn-xs" onclick="exportXLS()">EXECEL <i
                                    class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i></button>
                            </li>

                            <button class="btn btn-danger btn-xs" onclick="exportCSV()">PDF <i
                                    class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></button>

                            <button class="btn btn-primary btn-xs" onclick="exportCSV()">CSV <i
                                    class="fa fa-file-o fa-2x" aria-hidden="true"></i></button>
                            </li>
                            <button class="btn btn-warning btn-xs" onclick="exportCSV()">Printer <i
                                    class="fa fa-print fa-2x" aria-hidden="true"></i></button>
                            </li>


                        </ul>
                    </div>
                </div>
                </form>
            </div>
            <div class="panel-body" id="panel">

                <page size="A4" id="printableArea">
                    <style>
                        table#detail{
                            border: solid 1px;
                            border-collapse: collapse;
                            padding: 0;
                            width:80%;
                            font-family: "cordia new";
                            font-size: 14px;
                            border-collapse: collapse;
                            border-spacing: 0px;
                            margin: auto;
                        }
                        table#detail  th{
                            background-color: #e3e3e3;
                        }


                        table#detail td ,table#detail th{
                            border-right: solid 1px;
                        }
                        td.hg > div {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            overflow:hidden;
                        }
                        td.hg {
                            position: relative;
                            height: 20px;

                        }
                        .records_contentMain{
                            border: 2px solid black;
                            border-radius: 5px;
                            width: 19cm;
                            height: 27cm;
                            margin: auto;
                            padding: 10px;
                        }
                        .records_content{
                            height: 24cm;
                        }
                        #line_buttom{

                            text-align: center;
                            height:1cm;

                            margin-bottom: 1cm;


                        }

                    </style>

                        <div class="records_contentMain">
                            <div class="records_content" >


                            </div>
                            <div id="line_buttom">บริการประทับใจ  อย่างมีมาตรฐานและปลอดภัย</div>
                        </div>




                </page>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form id="modal_form" name="modal_form" enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Visit Date</h4>
                </div>
                <div class="modal-body">

                    <div class="visit_records" >

                    </div>

                </div>
            </div>
        </div>
    </form>


</div>
<script>

function get_data_custom(vn){
    $.get("custom_report/custom_report1_data.php",{vn:vn},function(data){
        $(".records_content").html(data);

    });
}
function getVisitDate(){
    var hn = $('input#hn').val();

    $.get("custom_report/getVisitDateData.php",{hn:hn},function(data){
        $(".visit_records").html(data);

    });
}

function tee(id){
    //alert(id);
    var vn = id;
    get_data_custom(vn);


}
function printDiv(divName) {

    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
$(document).ready(function(){
   // get_data_custom();
})

</script>

