$(document).ready
(
    function()
    {
        jQuery.browser = {};
        jQuery.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
        if(jQuery.browser.msie)
        {
            alert("Microsoft Internet Explorer не поддерживается. Попробуйте другой web броузер.");
        }



        $('#login_dialog').on('click', '#btn_login', Auth);  // функция авторизации пользователя

        $('#login_dialog').on('keypress','#login', function(e) {
            if(e.keyCode==13) {
                Auth();
            }
        });

    }
);

//------------------------------------------------------------------------------------------------------------------

function Auth()
{
    var param = {"login":$('#login').val(), "pass":$('#password').val()};

    $.ajax({
        type: 'POST',
        async: false,
        url: "auth.php",
        data: {"method":'Auth', "param":param },     //      json data to send
        dataType: 'json',
        success: function(data){

            if(data['success'])
            {
                window.location.reload();
            }
            else
            {
                alert(data['msg']);
                window.location.reload();
            }
        }
    });

}
//--------------------------------------------------------------------------