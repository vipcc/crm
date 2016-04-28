
<?php
include_once '../config/config.php';            // initialise settings

// Database connection
$host = $ini['mysql']['host'];
$db = $ini['mysql']['db'];
$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO($dsn, $ini['mysql']['user'], $ini['mysql']['pass'], $opt);

//  Smarty initialise
require_once '../lib/smarty/libs/Smarty.class.php';
$smarty = new Smarty();

$smarty->setTemplateDir(TplPrefix);
$smarty->setCompileDir('../tmp/smarty/templates_c');
$smarty->setCacheDir('../tmp/smarty/cache');
$smarty->setConfigDir('../lib/smarty/configs');
$smarty->assign("TplPrefix",TplPrefix);



