<?php

use Helper\Format;
use Contacts\Model\Contact;

return [
    'singular'        => 'Contato',
    'plural'          => 'Contatos',
    'gender'          => 'm',
    'model'           => Contact::class,
    'active_menu'     => 'contacts',
    'active_submenu'  => 'contacts',
    'table'              => [
        'fields'     => [
            'id'      => false,
            'name' => 'Nome',
            'email' => 'E-mail',
            'phone' => 'Telefone',
            'cellphone' => 'Celular',
            'email_sent_at' => 'Data de envio (email)',
            'created_at' => 'Data de registro'
        ],
        'hidden' => [],
        'sort_fields' => ['name', 'email'],
        'labels' => [],
        'order_by' => ['created_at', 'DESC'],
        'before_execute' => function($builder) {
        },
        'after_setup' => function (Mix\Table $table) {
            $table->setColumnAttributes('phone', array('width' => '150px'));
            $table->setColumnAttributes('cellphone', array('width' => '150px'));
            $table->setColumnAttributes('created_at', array('width' => '100px'));
            $table->setColumnAttributes('email_sent_at', array('width' => '100px'));
        },
        'filters'  => [
            'phone' => function($value) {
                return Format::_empty($value);
            },
            'cellphone' => function($value) {
                return Format::_empty($value);
            },
            'email_sent_at' => function($value) {
                return Format::_timestamp($value, '%d/%m/%Y');
            },
            'created_at' => function($value) {
                return Format::_timestamp($value, '%d/%m/%Y');
            },
        ],
    ],
    'can_add' => false,
    'can_edit' => false,
    'can_view' => true,
    'can_delete' => true,

    'search' => [
        'termo' => [
            'label' => 'Buscar',
            'type'  => 'text',//date, options, db_options, text, boolean TODO: exibir mostrando 1:10 de 30
            'fields' => [
                'name'  => 'like',
                'email' => 'like'
            ]
        ]
    ],
    //'search_view' => 'imoveis/admin/search'
    // 'view' => 'contacts/admin/view',

    'view' => [
        'layout' => [
            ['name' => 6, 'email' => 6],
            ['cellphone' => 3, 'city' => 3, 'uf' => 6],
            ['content' => 12],
            ['created_at' => 3, 'email_sent_at' => 9]
        ],
        'filters' => [
            'content' => function($value) {
                return htmlspecialchars_decode(($value));
            },
        ],
    ],
];
