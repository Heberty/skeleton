<?php
/**
 * Tries to load the webpack generated template,
 * otherwise, loads the default php template
 */
$webpackTemplate = WWW_ROOT . 'assets' . DS . 'default.php';

if(file_exists($webpackTemplate)) {
    require $webpackTemplate;
} else {
    require 'default.tpl.php';
}
