<?php

    if(!isset($compact)) {
        $compact = false;
    }

    $thumbnails = $compact ? array_slice($fotos, 0, 6) : $fotos;
    $thumbnailsCount = count($thumbnails);
    $remainingCount = count($fotos) - $thumbnailsCount;

    if(!isset($prefixPath)) {
        $prefixPath = '/uploads/fotos/';
    }

    if(!isset($thumbnailPrefix)) {
        $thumbnailPrefix = 'list_';
    }

    $fotos = \Utility\Hash::map($fotos, '{n}', function ($foto) use($prefixPath) {
        $foto['foto'] = $prefixPath . $foto['foto'];
        return $foto;
    });
?>
<article class="gallery-grid">
    <input type="hidden" class="gallery-thumbnail-data" value='<?= json_encode($fotos, JSON_HEX_QUOT | JSON_HEX_TAG); ?>' />

    <aside class="row">
        <?php foreach ($thumbnails as $i => $foto) : ?>
            <figure class="gallery-thumbnail col-6 col-sm-4 my-2">
                <?php
                    $showMore = $compact && $remainingCount > 0 && $i === ($thumbnailsCount - 1);
                ?>
                <a href="<?= $this->url($prefixPath . $foto['foto']) ?>" class="showThumb" data-index="<?= $i ?>">
                    <?php
                    if ($showMore) {
                        echo '<span class="more-counter"><span class="number">+' . $remainingCount . '</span></span>';
                    }
                    ?>
                    <img class="border" src="<?= $this->url($prefixPath . $thumbnailPrefix . $foto['foto']) ?>" alt=""/>
                </a>
            </figure>
        <?php endforeach; ?>
    </aside>
</article>
