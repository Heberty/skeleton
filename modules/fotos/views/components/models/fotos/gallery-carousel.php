<?php
    if(!isset($prefixPath)) {
        $prefixPath = 'uploads/fotos/';
    }

    if(!isset($thumbnailPrefix)) {
        $thumbnailPrefix = '270x180_';
    }

    $fotos = \Utility\Hash::map($fotos, '{n}', function ($foto) use($prefixPath) {
        $foto['foto'] = $prefixPath . $foto['foto'];
        return $foto;
    });
?>
<article class="gallery-carousel">
    <input type="hidden" class="gallery-thumbnail-data" value='<?= json_encode($fotos, JSON_HEX_QUOT | JSON_HEX_TAG); ?>' />

    <aside class="owl-slide owl-carousel owl-theme">
        <?php foreach ($fotos as $i => $foto) : ?>
            <a href="<?= $this->url($foto['foto']) ?>" class="showThumb" data-index="<?= $i ?>">
                <img class="img-fluid" src="<?= $this->url($foto['foto']) ?>" alt=""/>
            </a>
        <?php endforeach; ?>
    </aside>
</article>
