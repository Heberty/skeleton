<?php
use Mix\Model\Field\Gallery;
use Mix\Model\Field\Image;
use Configuracoes\Model\Configuracao as C;


error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

Gallery::registerType('galerias', function() {

    $image = new Image('foto', 'Foto', function($width, $height) {
        return $width > 1024 ? 1024 : $width;
    }, null, 'R', 'uploads/fotos');

    $info = <<<INFO
<ul>
    <li>Adicione imagens nos formatos (jpg, jpeg ou png) com no máximo 1MB de tamanho.</li>
    <li>As Imagens deve ter no mínimo <strong>940</strong>x<strong>225</strong> pixels de dimensão.</li>
    <li>Imagens com tamanhos menores não serão publicadas para evitar perda de qualidade.</li>
    <li>Imagens maiores que o tamanho mínimo serão cortadas automaticamente obedecendo a proporcionalidade exigida.</li>
</ul>
INFO;

    $image->setInfo($info);

    $image
        ->addThumb('150x150_', 150, 150, 'RC', 'uploads/fotos')
        ->addThumb('380x225_', 380, 225, 'RC', 'uploads/fotos')
        ->addThumb('940x', null, null, 'R', 'uploads/fotos')
        //->imageMinWidth(700)
        ->imageMinHeight(225)
        ->fileMaxSize(1, \Mix\Model\Field\Validation\FileMaxSize::MB);

    return $image;
}, false, false);

Route::set('embed_photos', 'admix/fotos/embed/<type>(/<id>)', array('type' => '[a-z0-9_-]+', 'id' => '[0-9]+'))
    ->defaults(array(
        'controller' => '\\Fotos\\EmbedController',
        'auth'       => true,
        'action'     => 'embed'
    ));
Route::set(
    'update_photos_positions', 'admix/fotos/embed/<type>(/<id>)/update-positions',
    array('type' => '[a-z0-9_-]+', 'id' => '[0-9]+')
)->defaults(array(
        'controller' => '\\Fotos\\EmbedController',
        'auth'       => true,
        'action'     => 'updatePositions'
    ));

Route::set(
    'photo.update_info', 'admix/fotos/embed/<type>(/<id>)/update-info',
    array('type' => '[a-z0-9_-]+', 'id' => '[0-9]+')
)->defaults(array(
        'controller' => '\\Fotos\\EmbedController',
        'auth'       => true,
        'action'     => 'updateInfo'
    ));

Route::set(
    'photo.bulk_actions', 'admix/fotos/embed/<type>(/<type_id>)/bulk',
    array('type' => '[a-z0-9_-]+', 'type_id' => '[0-9]+')
)->defaults(array(
        'controller' => '\\Fotos\\EmbedController',
        'auth'       => true,
        'action'     => 'bulk'
    ));

Route::set(
    'embed_photos_cover', 'admix/fotos/embed/<type>/<id>/cover(/<type_id>)',
    array('type' => '[a-z0-9_-]+', 'type_id' => '[0-9]+', 'id' => '[0-9]+')
)->defaults(array(
        'controller' => '\\Fotos\\EmbedController',
        'auth'       => true,
        'action'     => 'cover'
    ));

Route::set(
    'embed_photos_delete', 'admix/fotos/embed/<type>/<id>/delete(/<type_id>)',
    array('type' => '[a-z0-9_-]+', 'type_id' => '[0-9]+', 'id' => '[0-9]+')
)->defaults(array(
        'controller' => '\\Fotos\\EmbedController',
        'auth'       => true,
        'action'     => 'delete'
    ));
