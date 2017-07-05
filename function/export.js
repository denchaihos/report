/**
 * Created by User on 11/1/2560.
 */
function exportCSV(){
    var startDate = $('#date_start').val();
    var endDate = $('#date_end').val();
    var reportId = $("#reportId").val();

    $.ajax({
        type: "GET",
        url: "exportToCSV.php" ,
        data:{reportId:reportId,startdate:startDate,enddate:endDate},
        success : function(data) {
            download_csv(data);
        }
        ,
        error: function (data) {
            var r = jQuery.parseJSON(data.responseText);
            alert("Message: " + r.Message);
            alert("StackTrace: " + r.StackTrace);
            alert("ExceptionType: " + r.ExceptionType);
        }
    });
}

function exportXLS(){
    var startDate = $('#date_start').val();
    var endDate = $('#date_end').val();
    var reportId = $("#reportId").val();

    location.href = "exportToXLS.php?reportId="+reportId+"&&startdate="+startDate+"&&enddate="+endDate;

}
function exportPDF(){
    var startDate = $('#date_start').val();
    var endDate = $('#date_end').val();
    var reportId = $("#reportId").val();
    location.href = "exportToPDF.php?reportId="+reportId+"&&startdate="+startDate+"&&enddate="+endDate;

}

function download_csv(filename) {
    var hiddenElement = document.createElement('a');
    hiddenElement.href = filename;
    hiddenElement.target = '_blank';
    hiddenElement.download = filename;
    hiddenElement.click();
}
