<?php

if(session_id() == "")
{
    session_start();
}

require_once '../config/config.php';            // initialise settings
require_once('../lib/classModel.php');            // include Model functions
include_once '../lib/functions.php';




$method = $_POST['method'];               // get action
$param = $_POST['param'];
$_RESULT = $method($ini, $param);

echo json_encode($_RESULT);

//#########################################################################
function Auth ($ini,$param) {

    $ldaphost = $ini['ldap']['host'];
    $ldapport = "389";
    $user_DN = $ini['ldap']['user_DN'];
    $domain = "@" . $ini['ldap']['domain'];
    $success = 0;   $autorized = 0;

    if (isset($param['login']) && isset($param['pass'])) {
        $username = $param['login'];
        $login = $username.$domain;
        $password = $param['pass'];
        //подсоединяемся к LDAP серверу
        $ldap = ldap_connect($ldaphost, $ldapport);
        if ($ldap) {
            //Включаем LDAP протокол версии 3
            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            if ($ldap) {
                Debug("ldap ok $login");
                // Пытаемся войти в LDAP при помощи введенных логина и пароля
                $bind = ldap_bind($ldap, $login, $password);
                if ($bind) //логин и пароль подошли!
                {
                    Debug('bind ok');

                    // Search AD
                    $results = ldap_search($ldap, $user_DN, "(samaccountname=" . $param['login'] . ")",array("memberof"));
                    $entries = ldap_get_entries($ldap, $results);
                    // No information found, bad user
                    if($entries['count'] == 0) {
                        $autorized = 0;
                        break;
                    };

                    // Get groups and primary group token
                    $ad_groups = $entries[0]['memberof'];

                    $model = new Model($ini);
                    $groups = $model->getGroupList();

                    foreach($ad_groups as $ad_group) {
                       // Debug('auth group-:', $ad_group);
                        foreach($groups as $group) {
                            if(strpos($ad_group, $group['name']) > 0 ) {

                                Debug('auth find group:', $ad_group . " - " . $group['name'] );
                                $autorized = 1;
                                break;
                            }
                        }
                    }

                } else {
                    $msg = "Вы ввели неправильный логин или пароль. попробуйте еще раз";
                }
            } else {
                $msg = "Невозможно подключитсья к серверу";
            }
        }


        if ($autorized > 0) {
            $user = $model->getUserByLogin($username);
            $_SESSION['_UID'] = $user['id'];
            $_SESSION['_NAME'] = $user['name'];

            if($_SESSION['_UID'] > 0 || $group['id'] == 100 || $group['id'] == 102) {
                $success = 1;
                $_SESSION['_GID'] = $group['id'];
                $_SESSION['_PAGE'] = 0;

            } else {
                $success = 0;
                $_SESSION['_GID'] = 0;
                $msg = 'К сожалению, вам доступ закрыт';
            }
        } else {
            $success = 0;
            $msg = 'У вас нет прав на использование CRM';
        }

    }

        $_RESULT = array(
        "success" => $success,
        "msg" => $msg
    );

    return $_RESULT;
}