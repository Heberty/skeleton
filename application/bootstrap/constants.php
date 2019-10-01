<?php
defined('SYSPATH') or die('No direct script access.');

/**
 * Use the DS to separate the directories in other defines
 */
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('RELATIVE_PATH')) {
    define('RELATIVE_PATH', str_replace('\\', '/', isset($_SERVER['BASE']) ? $_SERVER['BASE'] : NULL));
}

/**
 * The full path to the directory which holds "application", WITHOUT a trailing DS.
 */
define('ROOT', dirname(dirname(__DIR__)));

/**
 * Path to the config directory.
 */
define('CONFIG', APPPATH . 'config' . DS);

/**
 * File path to the www directory.
 */
define('WWW_ROOT', ROOT . DS . 'www' . DS);

/**
 * Path to the logs directory.
 */
define('LOGS', APPPATH . 'logs' . DS);

/**
 * Path to the cache files directory. It can be shared between hosts in a multi-server setup.
 */
define('CACHE', APPPATH . 'cache' . DS);
