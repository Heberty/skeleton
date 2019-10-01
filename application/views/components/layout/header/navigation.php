<button
        type="button"
        class="navbar-toggler"
        data-toggle="collapse"
        data-target="#navPrimary"
        aria-controls="navPrimary"
        aria-expanded="false"
        aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navPrimary">
    <?= \View::factory('components/layout/header/navigation-items', ['class' => 'navbar-nav ml-auto mt-2 mt-lg-0']) ?>
</div>
