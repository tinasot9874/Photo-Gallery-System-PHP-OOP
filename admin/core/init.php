<?php
// define root_dir path
$root_path = substr(__DIR__, 0, -11);

define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', $root_path);

define('PATH_CLASS', SITE_ROOT.DS.'admin'.DS.'class');
define('PATH_CORE', SITE_ROOT.DS.'admin'.DS.'core');

require_once (PATH_CORE.DS."config.php");
require_once(PATH_CLASS.DS."Database.php");
require_once(PATH_CLASS.DS."Session.php");
require_once(PATH_CORE.DS."autoload.php");
require_once(PATH_CORE.DS."helper.php");

