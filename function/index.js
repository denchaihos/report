/**
 * Created by User on 13/1/2559.
 */

// unblock when ajax activity stops
$(document).ajaxStop($.unblockUI);

function showBlockUI() {
    $.ajax({ url: 'wait.php', cache: false });
}

/*********************dropdown menu  and submenu  on hover show effect***********************************/

$('ul.nav li.dropdown').hover(function() {
    $(this).find('ul.dropdown-menu:first').stop(true, true).delay(200).slideDown(500);

}, function() {
    $(this).find('ul.dropdown-menu:first').stop(true, true).delay(200).fadeOut(500);
});


$('ul.dropdown-menu li').hover(function() {
    var position_top = $(this).position().top;
    $(this).find('ul.sub-menu').css('top', position_top).stop(true, true).delay(200).fadeIn(900);
}, function() {
  $(this).find('ul.sub-menu').stop(true, true).delay(200).fadeOut(900);
});
/********************************/


function logout(){
    var e = window.event,
        btn = e.target || e.srcElement;

    alertify.confirm("คุณต้องการออกจากระบบ ?", function (e) {
        if (e) {
            $.ajax({
                type: 'post',
                url: "logout.php",
                data: {vaccation_id:1},
                success: function(data){
                    if (data == "erro") {
                        alert("erro")
                    } else {
                        alertify.alert(data);
                        location.reload();
                    }
                }
            });
        }else {
            alertify.error('ยกเลิกกระบวนการ');
        }
    });
}
/*
$(document).ajaxStop($.unblockUI);

function waitPage() {
    $.ajax({ url: 'wait.php', cache: false });
}
*/


//create alert  dialog  myAlert name global
alertify.myAlert || alertify.dialog('myAlert',function factory(){
    return {
        main:function(content){
            this.setContent(content);
        },
        setup:function(){
            return {
                options:{
                    modal:false,
                    basic:true,
                    maximizable:true,
                    resizable:false,
                    padding:false,
                    transition: 'fade',
                    autoReset: false

                }
            };
        }
    };
});
function showEMR(id){
    $.ajax({
        url: 'reportPreview.php?reportId='+id
    }).success(function(data){
        alertify.myAlert(data).set('resizable',true).resizeTo('90%','85%');

    }).error(function(){
        alert('Errro loading external file.');
    });

}
function setConfig(){
    $.ajax({
        url: 'edit_config.php'
    }).success(function(data){
        alertify.myAlert(data).set('resizable',true).resizeTo('50%','85%');
        $('td#vstdate:first').trigger('click');
    }).error(function(){
        alertify.error('Errro loading external file.');
    });
}




