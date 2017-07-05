// Add Record
function addRecord() {
    // get values
    var namereport = $("#namereport").val();
    var department = $("#department").val();
    var request_by = $("#request_by").val();
    var note = $("#note").val();
    var r_query = $("#r_query").val();
    var e_query = $("#e_query").val();
    var file_data = $('#file_ex').prop('files')[0];
    var form_data = new FormData($("#modal_form"));
    form_data.append('file', file_data);
    form_data.append('namereport', namereport);
    form_data.append('department', department);
    form_data.append('request_by', request_by);
    form_data.append('r_query', r_query);
    form_data.append('e_query', e_query);
    form_data.append('note', note);

    $.ajax({
        type: 'post',
        url: 'ajax/addRecord.php', // point to server-side PHP script
        //dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function(php_script_response){
            alert(php_script_response); // display response from the PHP script, if any
            clearData();
            readRecords();
            $("#update_modal").modal("hide");
        }
    });
}
function clearData(){
    $("#namereport").val("");
    $("#request_by").val("");
    $("#note").val("");
    $("#r_query").val("");
    $("#e_query").val("");
    $("#file_name").text("");
    $("#file_ex").replaceWith($("#file_ex").clone());

}

// READ records
function readRecordsOld() {
    $.get("ajax/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function DeleteReport(id) {
    var conf = confirm("Are you sure, do you really want to delete Report?");
    if (conf == true) {
        $.post("ajax/deleteReport.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
}

function GetReportDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("button#add_btn").hide();
    $("button#update_btn").show();
    $("#advance_config").hide();
    $("#hidden_report_id").val(id);

    $.post("ajax/readReportDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var data = JSON.parse(data);


            // Assing existing values to the modal popup fields
            $("#namereport").val(data.namereport);
            $("#department").val(data.dep);
            $("#request_by").val(data.request_by);
            $("#note").val(data.note);
            $("#r_query").val(data.r_query);
            $("#e_query").val(data.e_query);
            $("#file_name").text(data.file_ex);

        }
    );
    // Open modal popup
    $("#update_modal").modal("show");
}

function UpdateReportDetails() {
    // get values
    var namereport = $("#namereport").val();
    var department = $("#department").val();
    var request_by = $("#request_by").val();
    var note = $("#note").val();
    var r_query = $("#r_query").val();
    var e_query = $("#e_query").val();
    var file_data = $('#file_ex').prop('files')[0];
    var form_data = new FormData($("#modal_form"));
    // get hidden field value
    var id = $("#hidden_report_id").val();

    //create form data
    form_data.append('id', id);
    form_data.append('file', file_data);
    form_data.append('namereport', namereport);
    form_data.append('department', department);
    form_data.append('request_by', request_by);
    form_data.append('r_query', r_query);
    form_data.append('e_query', e_query);
    form_data.append('note', note);

    // Update the details by requesting to the server using ajax
    $.ajax({
        type: 'post',
        url: 'ajax/updateReportDetails.php', // poinept to server-side PHP script
        //dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function(php_script_response){
            //alert(php_script_response); // display response from the PHP script, if any
            alert(php_script_response);
            clearData();
            readRecords();
            $("#update_modal").modal("hide");
        }
    });

}
function fileinfo(val){
    var myfile= val;
    var ext = myfile.split('.').pop();
    if(ext!="txt"){
        alert(ext + "  !format type file not correc  plasea select agian");
        $("#file_ex").replaceWith($("#file_ex").clone());
    }
}
function me(){
    alert('me');
}


$(document).ready(function () {
    // READ recods on page load

    readRecords(1); // calling function
    //$("#basic").hide();
    $("#advance_config").hide();
    $("div#file_query").hide();

    $("button#add").click(function(){
        $("button#update_btn").hide();
        $("button#add_btn").show();
    })

    $("#advance,#advance_symbol").click(function(){
        $("#advance_config").slideToggle("slow");
        $("button#advance_symbol").toggle();
    });
    $("#basic,#basic_symbol").click(function(){
        $("#basic_config").slideToggle("slow");
        $("button#basic_symbol").toggle();
    });
    $( "input[name='radio_query']").on('change', function() {
        //alert($('input[name=radio_query]:checked').val());
        var option = ($('input[name=radio_query]:checked').val());
        if(option == '1'){
            $("#file_ex").replaceWith($("#file_ex").clone());
            $( "div#ex_query" ).show();
            $( "div#file_query" ).hide();
        }else{
            $("#e_query").val("");
            $( "div#ex_query" ).hide();
            $( "div#file_query" ).show();

        }
    });




});