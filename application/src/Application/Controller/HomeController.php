<?php
namespace Application\Controller;

class HomeController extends BaseController
{
    public function indexAction()
    {
        $variable = date('d M Y');
        
        return $this->renderView('home', compact('variable'));
    }
}
