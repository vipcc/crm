<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="imagetoolbar" content="no" />
    <title>{$appTitle}</title>
    <link type="text/css" href="css/jquery-ui.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
</head>
<body>
<div id="login_dialog" class="dialog" title="Авторизация">
    <table width="100%" border=0>
        <tr>
            <td> <input type="text" id="login" value="" style="width:98%;"> </td>
        </tr>
        <tr>
            <td><input type="password" id="password" value="" style="width:98%;"></td>
        </tr>
        <tr>
            <td align="center"><input type="button" id="btn_login" value="войти" ></td>
        </tr>
    </table>
</div>
<script>
    $('#login_dialog').dialog
    ({
        close: function(event, ui)
        {
            $(this).dialog('destroy').remove()
        },
        autoOpen: false,
        width: 200,
        modal: true
    });
    $('#login_dialog').dialog('open');
</script>
</body>
</html>