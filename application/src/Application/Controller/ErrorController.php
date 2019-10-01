<?php

namespace Application\Controller;

class ErrorController extends BaseController
{
    public function pageNotFoundAction()
    {
        return $this
            ->renderResponse('error/404')
            ->setStatusCode(404);
    }
}
