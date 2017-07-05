/**
 * Created by User on 27/12/2559.
 */
function createPage(num) {
    var row_per_page =10;


    if (typeof num === 'undefined' || num === null){
        var limit = 0;
        var num = 1;
    }else{
        var limit = (num - 1) * row_per_page;
    }
                $.get("page_pagination.php", {limit:limit,row_per_page:row_per_page}, function (data, status) {
                    //$("div.records_content").html(data);
                    var row_count =  data.match(/<span id="num_row" style="display: inline">(.*?)<\/span>/)[1];
                    $("input#hidden_count").val(row_count);
                    $(".show_page").html("หน้าที่ " +num+" / "+ Math.ceil(row_count / row_per_page));
                    $('.dem2').bootpag({
                        total: Math.ceil(row_count / row_per_page),
                        page: num,
                        maxVisible: 5//Math.ceil(numrow/row_per_page)
                    })
                });

}
$(document).ready(function () {
    createPage(); // calling function

});
$('.dem2').on('page', function (event, num) {
    readRecords(num);
});
