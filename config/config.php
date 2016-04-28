<?php

// path to library
define ('LibPrefix', '../lib/');
require_once  LibPrefix . 'functions.php';

// path to log
define ('LogPrefix', "../tmp/log/");
// set exception function
require_once LibPrefix . 'exception.php';
set_exception_handler('special_handler');

// path to files *.tpl
define ('TplPrefix', "../view/");
define ('TplPostfix', '.tpl');



// read config.ini
define ('ConfigPrefix', "../config/");
$ini = file_exists (ConfigPrefix . "config.ini") ? parse_ini_file(ConfigPrefix . "config.ini", true) : 0;
if($ini == 0)
    throw new Exception('config.ini  not found', 1);
