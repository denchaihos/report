/**
 * Created by User on 21/12/2559.
 */
//hide update button


function submitForm(num) {
    var row_per_page =2;
    if (typeof num === 'undefined' || num === null){
        var limit = 0;
        var num = 1;
    }else{
        var limit = (num - 1) * row_per_page;
    }
    var startDate = $('#date_start').val();
    var endDate = $('#date_end').val();
    var fex = "<?php echo $fex; ?>";
    var reportId = $("#reportId").val();
    if(fex !=''){
        alert(num);
        $.ajax({
            type: "GET",
            url: "excuteTextfile.php" ,
            data:{startdate:startDate,enddate:endDate,file_ex:fex},
            success : function() {
                document.getElementById('myform').submit();
            }
            ,
            error: function (data) {
                var r = jQuery.parseJSON(data.responseText);
                alert("Message: " + r.Message);
                alert("StackTrace: " + r.StackTrace);
                alert("ExceptionType: " + r.ExceptionType);
            }
        });
    }else{
        //document.getElementById('myform').submit();
        $.get("reportPreviewData.php",{reportId:reportId,startdate:startDate,enddate:endDate,limit:limit,row_per_page:row_per_page},function(data){
            $(".records_content").html(data);
            var row_count =  data.match(/<span id="num_row" style="display: inline">(.*?)<\/span>/)[1];
            $(".show_page").html("หน้าที่ " +num+" / "+ row_count);
            // $(".total").html("จำนวนอุบัติการ   ครั้ง");
            $('.dem2').bootpag({
                total: Math.ceil(row_count / row_per_page),
                page: num,
                maxVisible: 5//Math.ceil(numrow/row_per_page)
            })
        });

    }

}
function excuteForm(url){
    $.blockUI({ message: '<h1><img src="images/busy.gif" /> Just a moment...</h1>' });
    var startdate = $('#date_start').val();
    var enddate = $('#date_end').val();
    var reportId = $("input#reportId").val();
    $.ajax({
        type: "GET",
        url: url ,
        data:{reportId:reportId,startdate:startdate,enddate:enddate},
        success : function() {
                 //   alert(data);
            showRecord();
        }
    });

}

function sumTotal(id){
    if ($('#totalrow').length > 0) {
        var row = document.getElementById('totalrow');
        row.parentNode.removeChild(row);
    }
    var numColunm = document.getElementById('workweek').rows[0].cells.length;
    var numRows = $('#workweek').find('tr').length - 2;
    $("#workweek tbody").prepend("<tr id='totalrow'><td>รวม  "+numRows+"  รายการ</td><td></td><td></td><td></td><td></td><td></td></tr>");

    var sum = 0;
    // iteration through all td's in the column
    $('#workweek>tbody>tr>td:nth-child(' + id + ')').each( function(){
        sum += parseInt($(this).text()) || 0;
    });
    // set total in last cell of the column
    $('#workweek>tbody>tr>td:nth-child(' + id + ')').first().html('ผลรวม..  '+sum);
    $('#workweek>tbody>tr>td:nth-child(' + id + ')').first().toggleClass('total');
    //}
}
function sumTotalByColumn(column){
    var reportId = $("#reportId").val();
    var startDate = $("#date_start").val();
    var endDate = $("#date_end").val();
    $.post("sumByColumn.php", {
            reportId: reportId,
            startDate: startDate,
            endDate: endDate,
            column: column
        },
        function (data, status) {
            // PARSE json data
            var data = JSON.parse(data);
            $("span#"+column).text("ผลรวม: "+data);


        }
    );

}
function readRecords(num) {
    $.blockUI({ message: '<h1><img src="images/busy.gif" /> Just a moment...</h1>' });
    var reportId = $("#reportId").val();
    var startDate = $("#date_start").val();
    var endDate = $("#date_end").val();
    var row_per_page =10;
    if (typeof num === 'undefined' || num === null){
        var limit = 0;
        var num = 1;
    }else{
        var limit = (num - 1) * row_per_page;
    }
    var fex = $("input#fex").val();
    if(fex!=''){
        //alert("file");
        $.ajax({
            type: "GET",
            url: "excuteTextfile.php" ,
            data:{startdate:startDate,enddate:endDate,file_ex:fex},
            success : function() {
                alert(data);
                $.get("reportPreviewData.php", {reportId:reportId,limit:limit,row_per_page:row_per_page,startDate:startDate,endDate:endDate}, function (data) {
                    $(".records_content").html(data);
                    var row_count =  data.match(/<span id="num_row" style="display: inline">(.*?)<\/span>/)[1];
                    $(".show_page").html("หน้าที่ " +num+" / "+ row_count);
                    // $(".total").html("จำนวนอุบัติการ   ครั้ง");
                    $('.dem2').bootpag({
                        total: Math.ceil(row_count / row_per_page),
                        page: num,
                        maxVisible: 5//Math.ceil(numrow/row_per_page)
                    })
                });
                $("#export").show();
            }
            ,
            error: function (data) {
                var r = jQuery.parseJSON(data.responseText);
                alert("Message: " + r.Message);
                alert("StackTrace: " + r.StackTrace);
                alert("ExceptionType: " + r.ExceptionType);
            }
        });
    }else{
        //alert("no file");
        $.get("reportPreviewData.php", {reportId:reportId,limit:limit,row_per_page:row_per_page,startDate:startDate,endDate:endDate}, function (data) {
            $(".records_content").html(data);
            var row_count =  data.match(/<span id="num_row" style="display: inline">(.*?)<\/span>/)[1];
            $(".show_page").html("หน้าที่ " +num+" / "+ row_count);
            // $(".total").html("จำนวนอุบัติการ   ครั้ง");
            $('.dem2').bootpag({
                total: Math.ceil(row_count / row_per_page),
                page: num,
                maxVisible: 5//Math.ceil(numrow/row_per_page)
            })
        });
        $("#export").show();
    }

}

function showRecord(){
    var reportId = $("#reportId").val();
    var startDate = $("#date_start").val();
    var endDate = $("#date_end").val();
    var row_per_page =10;
    if (typeof num === 'undefined' || num === null){
        var limit = 0;
        var num = 1;
    }else{
        var limit = (num - 1) * row_per_page;
    }
    var fex = $("input#fex").val();
    $.get("reportPreviewData.php", {reportId:reportId,limit:limit,row_per_page:row_per_page,startDate:startDate,endDate:endDate}, function (data) {
        $(".records_content").html(data);
        var row_count =  data.match(/<span id="num_row" style="display: inline">(.*?)<\/span>/)[1];
        $(".show_page").html("หน้าที่ " +num+" / "+ row_count);
        // $(".total").html("จำนวนอุบัติการ   ครั้ง");
        $('.dem2').bootpag({
            total: Math.ceil(row_count / row_per_page),
            page: num,
            maxVisible: 5//Math.ceil(numrow/row_per_page)
        })
    });
}

$(document).ready(function () {
    var eq = $("input#eq").val();
    if(eq=='N'){
        $("#excute_data").hide();
    }
    $("#export").hide();
});
$('.dem2').on('page', function (event, num) {
    readRecords(num);
});

