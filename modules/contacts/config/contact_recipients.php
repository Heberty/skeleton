<?php

use Helper\Format;
use Contacts\Model\Recipient;

return [
    'singular'        => 'Destinatário',
    'plural'          => 'Destinatários',
    'gender'          => 'm',
    'model'           => Recipient::class,
    'active_menu'     => 'contacts',
    'active_submenu'  => 'contact_recipients',
    'table'              => [
        'fields'     => [
            'id'      => false,
            'name' => 'Nome',
            'email' => 'E-mail',
            'activated' => 'Ativo',
            'created_at' => 'Data de cadastro'
        ],
        'hidden' => [],
        'sort_fields' => ['name', 'email'],
        'labels' => [],
        'order_by' => ['created_at', 'DESC'],
        'before_execute' => function($builder) {
        },
        'after_setup' => function (Mix\Table $table) {
        },
        'filters'  => array(
            'activated' => function($value) {
                return Format::_boolean($value);
            },
            'created_at' => function($value) {
                return Format::_timestamp($value);
            }
        ),
    ],
    //'form_view' => 'imoveis/admin/form_apartamentos',
    'can_add' => true,
    'can_edit' => true,
    'can_view' => false,
    'can_delete' => true,
    'search' => [
        'termo' => [
            'label' => 'Buscar',
            'type'  => 'text',//date, options, db_options, text, boolean TODO: exibir mostrando 1:10 de 30
            'fields' => [
                'name'  => 'like',
                'email' => 'like'
            ]
        ],
        'activated' => [
            'label' => 'Ativo',
            'type' => 'options',
            'fields' => [
                'activated' => 'exact'
            ],
            'options' => [
                'options' => [
                    0 => 'Não',
                    1 => 'Sim'
                ]
            ]
        ],
    ],
    'form_layout' => [
        ['name' => 12],
        ['email' => 12],
        ['activated' => 4],
    ],

];