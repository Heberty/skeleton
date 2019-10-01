<?php
    // This laytout will be used ONLY if the www/assets/default.php file does not exist
    // To generate the file, run the webpack task
    $class = \Helper\LayoutHelper::isInterna() ? 'navbar-light' : 'navbar-dark';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?= \View::factory('components/layout/head', compact('ui')) ?>

        <?= $this->section('head') ?>
    </head>
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

        <?= \View::factory('components/layout/scripts') ?>
    </body>
</html>
