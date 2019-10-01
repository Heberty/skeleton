<?php

use Mix\Application as App;

class Application extends App
{
    public function init()
    {
        $this['mailer'] = function () {
            $email = \Kohana::$config->load('email')->get('default');
            $transport = (
                    new Swift_SmtpTransport(
                        $email['host'],
                        $email['port'],
                        $email['security']
                    )
                )
                ->setUsername($email['username'])
                ->setPassword($email['password']);

            return new \Swift_Mailer($transport);
        };
    }

    public function createEmail($subject, array $from, array $to, $view, array $data=[])
    {
        $email = \Kohana::$config->load('email')->get('default');

        $content = \View::factory('layouts/email', [
            'view' => \View::factory($view, $data),
        ]);

        return \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setReplyTo($from)
            ->setFrom([$email['username'] => \Kohana::$config->load('app')->get('name')])
            ->setTo($to)
            ->setBody($content, 'text/html');
    }

    public function sendEmail(\Swift_Message $message)
    {
        $mailer = $this->getMailer();

        return $mailer->send($message);
    }
}
