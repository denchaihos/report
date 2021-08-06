/**
 * Created by User on 22/11/2560.
 */


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