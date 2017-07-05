/**
 * Created by User on 15/12/2559.
 */
$(document).ready(function(){
    get_department();
})
function get_department(){
    $.getJSON('get_data_department.php', {}, function (data) {
        $.each(data, function (key, value) {
            $('#department').append(
                "<option  value='"+value.dep_id+"'>"+value.dep_name+"</option> "
            );
        });
     });
 }
