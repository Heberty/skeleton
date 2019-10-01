<?php
if (!isset($prefixPath)) {
    $prefixPath = '/uploads/fotos/';
}

if (!isset($thumbnailPrefix)) {
    $thumbnailPrefix = 'small_';
}
?>
<aside class="gallery-cards showLightGallery">
    <?= !empty($title) ? '<strong class="d-block text-center">' . $title . '</strong>' : '' ?>

    <div class="gallery-cards--items">
        <?php foreach ($fotos as $i => $foto) : ?>
            <figure class="gallery-cards--item my-2">
                <a href="<?= $this->url($prefixPath . $foto) ?>" class="gallery-cards--link showThumb"
                   data-index="<?= $i ?>">
                    <img class="gallery-cards--photo"
                         src="<?= $this->url($prefixPath . $thumbnailPrefix . $foto) ?>" alt=""/>
                </a>
            </figure>
        <?php endforeach; ?>
    </div>
    <div class="gallery-cards--arrows"></div>
</aside>
