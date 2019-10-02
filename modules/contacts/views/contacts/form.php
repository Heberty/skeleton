<?php
    $this->ui->setPageTitle(__('Contato'));

    \Helper\LayoutHelper::addBreadcrumb([
        'title' => __('Contato'),
    ]);
?>
<div class="page-container">
    <?= $this->renderFlashes() ?>

    <div
        id="AppContact"
        v-cloak
    ></div>
</div>