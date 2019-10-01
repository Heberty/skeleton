<?php

require 'index-base.php';

$application = new \Application();

if (PHP_SAPI == 'cli') {
    $app = new \ApplicationRobo();
    $status_code = $app->run();
    exit($status_code);
}
else {
    $application->run();
}
