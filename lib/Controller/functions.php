<?php

function ChangePage($param) {

    if(session_id() == "")
    {
        session_start();
    }

    $_SESSION['_PAGE_ID'] = $param['page_id'];
    $_SESSION['_PAGE_NAME'] = $param['page_name'];

    $_RESULT = array(
        "success" => 'true'
    );
    return $_RESULT;

}
