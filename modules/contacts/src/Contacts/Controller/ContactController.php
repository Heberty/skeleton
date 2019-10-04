<?php

namespace Contacts\Controller;

use Mix\Model\Form;
use Contacts\Model\Contact;
use Application\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContactController extends BaseController
{
    public function formAction()
    {
        $this->getUiManager()->setPageTitle('Fale Conosco');

        return $this->renderView('contacts/form');
    }

    public function submitAction()
    { 

        $model = new Contact;

        $form = $this->getRequest()->isMethod('post');
        $content = $this->getRequest()->request->all();
        $errors = [];

        if($form) {
            $model->populateFromArray($content);
            if ($model->validate()) {
                $model->save();

                $this->getUiManager()->setPageTitle(__('Contato enviado'));
                $this->addSuccessFlash('Contato enviado com sucesso.');
                return $this->routeRedirect('home');
            }  

            $this->getUiManager()->setPageTitle(__('Erro no envio'));
            $this->addErrorFlash('Verifique os erros do formulário');
            $errors = $model->getErrors();

        }

        return $this->renderResponse('home', ['errors' => $errors]);

    }
}
