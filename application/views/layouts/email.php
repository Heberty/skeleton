<?php

$body = [
    'background-color: #EEEEEE;',
    'padding: 30px;',
    'font-family: \'Roboto\', sans-serif;'
];

$table = [
    'background-color: white;',
    'width: 700px;',
    'margin: 0 auto;',
    'padding: 30px;'
];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?= \Kohana::$config->load('app')->get('name') ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body style="<?= implode(' ', $body) ?>">
<table style="<?= implode(' ', $table) ?>">
    <thead>
    <tr>
        <th>
            <img src="<?= \Mix\Router\Router::getRouteUrl('home', [], 'http') ?>assets/img/favicon.jpg" width="125px">
        </th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td>
            <?= $view ?>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
