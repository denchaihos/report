/**
 * Created by User on 21/12/2559.
 */
function readRecords(num) {
    var row_per_page =10;

    if (typeof num === 'undefined' || num === null){
        var limit = 0;
        var num = 1;
    }else{
        var limit = (num - 1) * row_per_page;
    }

    $.get("ajax/readRecords.php", {limit:limit,row_per_page:row_per_page,num:num}, function (data, status) {
        $(".records_content").html(data);
        var row_count =  data.match(/<span id="num_row" style="display: inline">(.*?)<\/span>/)[1];
        var row_count1 = $("input#hidden_count").val();

       // $(".show_page").html("หน้าที่ " +num+" / "+ Math.ceil(row_count1 / row_per_page));
       // $(".total").html("จำนวนอุบัติการ   ครั้ง");
       // $('.dem2').bootpag({
       //     total: Math.ceil(row_count / row_per_page),
        //   page: num,
          //  maxVisible: 5//Math.ceil(numrow/row_per_page)
       // })
    });

}

