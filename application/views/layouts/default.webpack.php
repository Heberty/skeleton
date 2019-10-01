<?php
    // This laytout will be used ONLY if the www/assets/default.php file does not exist
    // To generate the file, run the webpack task

    $includeAssets = false;
    $class = \Helper\LayoutHelper::isInterna() ? 'navbar-light' : 'navbar-dark';
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="pt-br" class="ie6" <% if(htmlWebpackPlugin.files.manifest) { %> manifest="<%= htmlWebpackPlugin.files.manifest %>"<% } %>> <![endif]-->
<!--[if IE 7 ]>    <html lang="pt-br" class="ie7" <% if(htmlWebpackPlugin.files.manifest) { %> manifest="<%= htmlWebpackPlugin.files.manifest %>"<% } %>> <![endif]-->
<!--[if IE 8 ]>    <html lang="pt-br" class="ie8" <% if(htmlWebpackPlugin.files.manifest) { %> manifest="<%= htmlWebpackPlugin.files.manifest %>"<% } %>> <![endif]-->
<!--[if IE 9 ]>    <html lang="pt-br" class="ie9" <% if(htmlWebpackPlugin.files.manifest) { %> manifest="<%= htmlWebpackPlugin.files.manifest %>"<% } %>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="pt-br" class="" <% if(htmlWebpackPlugin.files.manifest) { %> manifest="<%= htmlWebpackPlugin.files.manifest %>"<% } %>> <!--<![endif]-->
    <head>
        <?= \View::factory('components/layout/head', compact('ui', 'includeAssets')) ?>

        <?= $this->section('head') ?>
    </head>
    <body class="<?= \Helper\LayoutHelper::isInterna() ? 'internal-page' : 'home-page' ?> with-fixed-navbar">
        <% if (htmlWebpackPlugin.options.unsupportedBrowser) { %>
        <style>.unsupported-browser { display: none; }</style>
        <div class="unsupported-browser">
              Sorry, your browser is not supported.  Please upgrade to
              the latest version or switch your browser to use this site.
              See <a href="http://outdatedbrowser.com/">outdatedbrowser.com</a>
              for options.
        </div>
        <% } %>

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

        <% if (htmlWebpackPlugin.options.window) { %>
        <script>
          <% for (var varName in htmlWebpackPlugin.options.window) { %>
            window['<%=varName%>'] = <%= JSON.stringify(htmlWebpackPlugin.options.window[varName]) %>;
          <% } %>
        </script>
        <% } %>
    </body>
</html>
