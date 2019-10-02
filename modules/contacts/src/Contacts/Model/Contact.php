<?php

namespace Contacts\Model;

use Configuracoes\Model\ConfiguracaoBase as C;

use Application\Model\BaseModel;

class Contact extends BaseModel
{
    protected $table = 'contacts';

    public function init()
    {
        $this->text('name', 'Nome')->mandatory()->maxLength(150);
        $this->email('email', 'E-mail')->mandatory()->maxLength(150);
        $this->phone('phone', 'Telefone');
        $this->uf('uf', 'UF')->mandatory();
        $this->text('city', 'Cidade')->maxLength(255)->mandatory();
        $this->phone('sector', 'Setor');
        $this->longText('content', 'Mensagem')->mandatory();
        $this->timestamp('email_sent_at', false, false)->setLabel('Data de envio (email)');
        $this->timestamp('created_at')->setLabel('Data e hora de envio');
        $this->timestamp('updated_at', true, false);
    }

    protected function afterSave($success, $operation)
    {
        $emailSent = $this->getField('email_sent_at')->getValue();

        if ($operation!=self::OP_INSERT || !$success) {
            return;
        }

        $recipients = (array) Recipient::findForSendEmail();

        $defaultRecipient = C::get('email_contato');
        if (!empty($defaultRecipient)) {
            $recipients[] = $defaultRecipient;
        }

        if (empty($recipients)) {
            return;
        }

        $data = $this->toArray();

        $app = \Application::getDefault();
        $message = $app->createEmail(
            'Contato do site',
            [$data['email'] => $data['name']],
            $recipients,
            'email/contact',
            $data
        );

        try {
            if ($app->sendEmail($message)) {
                $this->email_sent_at = (new \DateTime())->format('Y-m-d H:i:s');

                if(!$this->save()) {
                    \Kohana::$log->add(
                        \Log::ERROR,
                        'A mensagem #:id não pôde ser atualizada.',
                        [
                            ':id' => $this->id()
                        ],
                        $this->getErrors()
                    );
                }
            } else {
                throw new \Exception("Falha no envio do email");
            }
        } catch (\Exception $exception) {
            \Kohana::$log->add(
                \Log::ERROR,
                'A mensagem #:id não pôde ser enviada.',
                [
                    ':id' => $this->id()
                ],
                [
                    'exception' => $exception
                ]
            );
        }
    }

}
