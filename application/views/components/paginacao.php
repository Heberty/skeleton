<?php
if ($totalPages <= 1) {
    return;
}
$currentPage = intval($params['page']);
$routeParams = $params;
$inicio = $currentPage-$margin >= 1 ? $currentPage-$margin : 1;
$final = $currentPage+$margin <= $totalPages ? $currentPage+$margin : $totalPages;
?>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php if ($currentPage > 1) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $this->routeUrl($routeName, $params) . '?page=' . ($currentPage-1) ?>" title="<?= __('página anterior') ?>">
                <i class="fas fa-chevron-left"></i>
                <span class="sr-only"><?= __('página anterior') ?></span>
            </a>
        </li>
        <?php endif; ?>

        <?php for ($page=$inicio; $page <=$final; $page++) : ?>
        <?php if ($page==$currentPage) : ?>
        <li class="page-item active">
            <span class="page-link"><?= $page ?></span>
        </li>
        <?php else : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $this->routeUrl($routeName, $params) . '?page=' . $page ?>" title="ir para a página <?= $page ?>"><?= $page ?></a>
        </li>
        <?php endif; ?>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $this->routeUrl($routeName, $params) . '?page=' . ($currentPage+1) ?>" title="<?= __('próxima página') ?>">
                <i class="fas fa-chevron-right"></i>
                <span class="sr-only"><?= __('próxima página') ?></span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</nav>
