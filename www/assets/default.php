<?php
    // This laytout will be used ONLY if the www/assets/default.php file does not exist
    // To generate the file, run the webpack task

    $includeAssets = false;
    $class = \Helper\LayoutHelper::isInterna() ? 'navbar-light' : 'navbar-dark';
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="pt-br" class="ie6" > <![endif]-->
<!--[if IE 7 ]>    <html lang="pt-br" class="ie7" > <![endif]-->
<!--[if IE 8 ]>    <html lang="pt-br" class="ie8" > <![endif]-->
<!--[if IE 9 ]>    <html lang="pt-br" class="ie9" > <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="pt-br" class="" > <!--<![endif]-->
    <head>
        <?= \View::factory('components/layout/head', compact('ui', 'includeAssets')) ?>

        <?= $this->section('head') ?>
    <meta name="mobile-web-app-capable" content="yes"><meta name="theme-color" content="#fff"><meta name="application-name" content="mix-skeleton"><link rel="apple-touch-icon" sizes="57x57" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-icon-57x57.png"><link rel="apple-touch-icon" sizes="60x60" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-icon-60x60.png"><link rel="apple-touch-icon" sizes="72x72" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-icon-72x72.png"><link rel="apple-touch-icon" sizes="76x76" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-icon-76x76.png"><link rel="apple-touch-icon" sizes="114x114" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-icon-114x114.png"><link rel="apple-touch-icon" sizes="120x120" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-icon-120x120.png"><link rel="apple-touch-icon" sizes="144x144" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-icon-144x144.png"><link rel="apple-touch-icon" sizes="152x152" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-icon-152x152.png"><link rel="apple-touch-icon" sizes="180x180" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-icon-180x180.png"><meta name="apple-mobile-web-app-capable" content="yes"><meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"><meta name="apple-mobile-web-app-title" content="mix-skeleton"><link rel="icon" type="image/png" sizes="32x32" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/favicon-16x16.png"><link rel="shortcut icon" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/favicon.ico"><link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-startup-image-320x460.png"><link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-startup-image-640x920.png"><link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-startup-image-640x1096.png"><link rel="apple-touch-startup-image" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-startup-image-750x1294.png"><link rel="apple-touch-startup-image" media="(device-width: 414px) and (device-height: 736px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 3)" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-startup-image-1182x2208.png"><link rel="apple-touch-startup-image" media="(device-width: 414px) and (device-height: 736px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 3)" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-startup-image-1242x2148.png"><link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-startup-image-748x1024.png"><link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-startup-image-768x1004.png"><link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-startup-image-1496x2048.png"><link rel="apple-touch-startup-image" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" href="/assets/img/icons-6ae81f0c4d589d3c8e2577b1318fc198/apple-touch-startup-image-1536x2008.png"><link href="/assets/css/site/style.css" rel="stylesheet"></head>
    <body class="<?= \Helper\LayoutHelper::isInterna() ? 'internal-page' : 'home-page' ?> with-fixed-navbar">
        

        <div class="body__content">
            <?= \View::factory('components/layout/header', compact('ui', 'class')) ?>
            <?= \View::factory('components/layout/page-header', compact('ui')) ?>
            <main class="body__main">
                <?php
                    $alert = $this->renderFlashes();

                    if (!empty($alert)) {
                        echo '<div class="container pt-5">' . $alert . '</div>';
                    }
                ?>
                <?= $this->content ?>
            </main>
        </div>

        <?= \View::factory('components/layout/footer') ?>
        <?= \View::globalSection('modal', '') ?>
        <?= $this->section('footer') ?>

        <?= \View::factory('components/layout/scripts', compact('includeAssets')) ?>

        
    <script type="text/javascript" src="/assets/js/site/bundle.js"></script></body>
</html>
