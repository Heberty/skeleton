<ul class="<?= isset($class) ? $class : 'navbar-nav' ?>">
<?php
    if(!isset($navItems)) {
        $navItems = \Kohana::$config->load('menu')->as_array();
    }

    $navItems = \Mix\Helper\Hash::sort($navItems, '{s}.weight', 'asc');

    foreach ($navItems as $item) {
        if (!empty($item['children'])) {
            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">' . __($item['title']) . '</a>';
            echo '<div class="dropdown-menu">';
            foreach ($item['children'] as $subitem) {
                echo '<a class="dropdown-item" href="' . $subitem['uri'] . '">' . __($subitem['title']) . '</a>';
            }
            echo '</div>';
            echo '</li>';
        }
        else {
            echo '<li class="nav-item"><a class="nav-link" href="' . $item['uri'] . '">' . __($item['title']) . '</a></li>';
        }
    }
    ?>
</ul>
