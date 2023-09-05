<?php
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'Users' . DS . 'ioghiban' 
    . DS .'Documents' . DS . 'job' . DS .'bunq' . DS . 'website');
    defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
    defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');

    //echo INC_PATH;

    //load config file first
    require_once(INC_PATH.DS."config.php");
    //core classes
    require_once(CORE_PATH.DS."message.php");
?>