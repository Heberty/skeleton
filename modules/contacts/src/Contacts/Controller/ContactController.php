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
        try {
            $request = $this->getRequest()->request->all();

            // $teste = $this->getRequest()->request->all();
            // var_dump($teste);
            
            if ()

            if (empty($request)) {
                throw new \Exception('Requisição inválida');
            }

            $model = new Contact;
            $model->populateFromArray($request);


            if ($model->validate()) {
                if (!$model->save()) {
                    throw new \Exception('Não foi possível salvar a mensagem');
                }

                return new JsonResponse(
                    [
                        'message' => 'Contato enviado com sucesso'
                    ],
                    200
                );
            }

            // TODO: retornar lista de erros de validação

            return new JsonResponse(
                [
                    'error' => 'Erro no preenchimento do formulário.'
                ],
                422
            );
        } catch (\Exception $exception) {
            return new JsonResponse(
                [
                    'error' => $exception->getMessage()
                ],
                400
            );
        }
    }
}
