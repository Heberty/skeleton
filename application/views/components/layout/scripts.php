<?php
    use Configuracoes\Model\Configuracao as C;

    if(!isset($includeAssets)) {
        $includeAssets = true;
    }
?>

<?php if($includeAssets) : ?>
    <script defer src="<?= $this->url('assets/js/site/vendors~main.bundle.js') ?>"></script>
    <script defer src="<?= $this->url('assets/js/site/bundle.js') ?>"></script>

    <?php
    $addThisKey = C::get('addthis_key');
    if(!empty($addThisKey)):
    ?>
    <script
        defer
        type="text/javascript"
        src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?= $addThisKey ?>"></script>
    <?php endif; ?>
<?php endif; ?>

<script
    src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"
    integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9"
    crossorigin="anonymous"></script>

<?= $this->section('scripts') ?>
