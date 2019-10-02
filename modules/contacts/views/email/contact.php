<?php
    $rows = [
        'Nome' => $name,
        'E-mail' => $email,
    ];

    if (!empty($cellphone)) {
        $rows['Telefone'] = $cellphone;
    }

    $rows['Cidade/UF'] = implode('/', [$city, $uf]);
?>

<table>
    <?php foreach ($rows as $key => $value) : ?>
    <tr>
        <td>
            <h3 style="color: #161C2B; margin-top: 0; margin-bottom: 0.75rem;">
                <?= $key ?>:
            </h3>
        </td>
        <td>
            <p style="margin-top: 0; margin-bottom: 0.75rem;">
                <?= $value ?>
            </p>
        </td>
    </tr>
    <?php endforeach; ?>

    <tr>
        <td colspan="2">
            <div style="padding-top: 3rem; border-top: 1px solid #f0f0f0;">
                <?= nl2br($content) ?>
            </div>
        </td>
    </tr>
</table>