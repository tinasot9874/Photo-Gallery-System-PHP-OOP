<?php
// DATABASE CONNECTION CONSTANTS

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","");
define("DB_NAME","gallery_db");

//
$root_path = substr(__DIR__, 0, -11);
define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', $root_path);
define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'uploads');


?>
