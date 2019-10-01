<?php
// override the default page view to customize

$this->ui->setPageTitle(__('Sobre'));

echo \View::factory('pages/show', compact('page', 'currentUri', 'ui'));
