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
/*function exportPDF(){
    var startDate = $('#date_start').val();
    var endDate = $('#date_end').val();
    var reportId = $("#reportId").val();
    location.href = "exportToPDF.php?reportId="+reportId+"&&startdate="+startDate+"&&enddate="+endDate;

}*/
function exportPDF(){
    var w = window.open();
    var html = $("#pdf").html();

    $(w.document.body).html(html);

}
function pdf(){
    //alert('me');
    var doc = new jsPDF({
        orientation: 'landscape',
        unit: 'in',
        format: [11.5, 4.2]
    })
    var specialElementHandlers = {
        '#me': function(element, renderer){
            return true;
        },
        '.controls': function(element, renderer){
            return true;
        }
    };
    var content = document.getElementById('pdf').innerText;
    // var html = $("#pdf").innerText;

    doc.text(20, 20, 'Hello landscape world!')
    //window.open(doc.output('bloburl'));
}
function openPdf(){
    var reportId = $('#reportId').val();
    var startDate = $('#date_start').val();
    var endtDate = $('#date_end').val();
   // window.open('templates/nk1.php?reportId='+reportId+'&startDate='+startDate+'&endDate='+endtDate, '_blank');
    window.open('specialReport/nk11.php');
}

function download_csv(filename) {
    var hiddenElement = document.createElement('a');
    hiddenElement.href = filename;
    hiddenElement.target = '_blank';
    hiddenElement.download = filename;
    hiddenElement.click();
}
