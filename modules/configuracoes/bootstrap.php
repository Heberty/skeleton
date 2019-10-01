<?php
use Users\PermissionManager as PM;
use Users\Model\User;

$configuracoesAllowed  = User::isAllowed('configuracoes', 'index');

if (!$configuracoesAllowed) {
   return;
}

$ui = \Application::getDefault()->getUiManager();
\Route::set('configuracoes', 'admix/configuracoes')->defaults(array(
   'controller' => '\\Admin\\Controller',
   'action'     => 'insert',
   'config'     => 'configuracoes'
));
$ui->addMenu('configuracoes', 'Configurações', 'cogs', URL::site(Route::get('admin.crud')->uri(array('config' => 'configuracoes'))), null, 6);
PM::getInstance()->addResource('configuracoes', 'Configurações', false, array(
    'index' => 'Alterar Configurações'
));
