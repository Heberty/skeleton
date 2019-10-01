<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends \Mix\Controller\Controller
{
    protected $layout = 'layouts/default';

    public function init()
    {
        $this->getUiManager()->setProjectName(\Kohana::$config->load('app')->get('name'));
    }
}
