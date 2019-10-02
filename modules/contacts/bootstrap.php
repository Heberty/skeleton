<?php

use Users\PermissionManager as PM;
use Users\Model\User;
use Contacts\Model\Contact;
use Contacts\Controller\ContactController;

$permissoes = User::isAllowed('contacts', 'index');

if ($permissoes) {

    $ui->addMenu('contacts', 'Contatos', 'file-text-o');

    $ui->addSubmenu(
        'contacts',
        'contacts',
        'Contatos',
        null,
        \URL::site(Route::get('admin.crud')->uri(['config' => 'contacts'])),
        Contact::count()
        );

    $ui->addSubmenu(
        'contacts',
        'contact_recipients',
        'Destinatários',
        null,
        \URL::site(Route::get('admin.crud')->uri(['config' => 'contact_recipients']))
        );

    PM::getInstance()->addResource('contacts', 'Contacts');
}

Route::set('contato', 'contato')
    ->defaults([
        'controller' => ContactController::class,
        'action'     => 'form',
    ]);

Route::set('contato.submit', 'contato/submit')
    ->defaults([
        'controller' => ContactController::class,
        'action'     => 'submit',
    ]);