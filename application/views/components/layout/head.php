<?php
    if(!isset($includeAssets)) {
        $includeAssets = true;
    }
?>
<meta charset="UTF-8">
<title><?= strip_tags(\Mix\Helper\Text::getPageTitle($ui)) ?></title>

<!-- Metas -->
<?php
    use Configuracoes\Model\Configuracao as C;
    use \Helper\MetaHelper;

    MetaHelper::addDefault('description', C::get('site_description'));
    MetaHelper::addDefault('keywords', C::get('site_keywords'));

    echo MetaHelper::render();
?>
<?php if($includeAssets) : ?>

<!-- Css -->
<link rel="stylesheet" href="<?= $this->url('assets/css/style.css') ?>">

<!-- Favicon -->
<link rel="shortcut icon" href="<?= $this->url('assets/img/icon/favicon.ico') ?>">

<?php endif; ?>

<!-- Viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Web Fonts -->
<script>
    WebFontConfig = {
      	google: {
	      	families: ['Montserrat:300,400,700,800']
	    }
    };

    (function(d) {
      	var wf = d.createElement('script'), s = d.scripts[0];
      	wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
      	wf.async = true;
      	s.parentNode.insertBefore(wf, s);
    })(document);
</script>

<?= $this->section('head') ?>

<script>
    var App = App || {};
    var WEBROOT = '<?= $this->routeUrl('home') ?>';
    App.config = {};
    App.isInternal = '<?= \Helper\LayoutHelper::isInterna() ?>' === '1';

    <?php
      $googleMapKey = C::get('google_maps_key');
      if(!empty($googleMapKey)):
        echo "App.googleMapKey = '". (!empty($googleMapKey) ? $googleMapKey : null) ."';";
      endif;
    ?>
</script>
