<nav class="navigation-primary navbar navbar-expand-lg <?= !empty($class) ? $class : '' ?>">
    <div class="container">
        <a class="navbar-brand mr-auto" href="<?= $this->routeUrl('home') ?>" title="<?= $this->config('app', 'name') ?>">
            <img class="navigation-primary__logo" src="<?= $this->url('/assets/img/logo-mix-dark.svg') ?>" alt="<?= $this->config('app', 'name') ?>">
        </a>

        <?= \View::factory('components/layout/header/navigation') ?>
    </div>
</nav>
