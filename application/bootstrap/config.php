<?php
defined('SYSPATH') or die('No direct script access.');

Cookie::$salt = env('SECURITY_SALT', 'm1X!nt3rn3T');

return [
    'base_url' => RELATIVE_PATH,
    'index_file' => false,
    'profiling' => false,
    'caching' => false,
    'errors' => true
];
