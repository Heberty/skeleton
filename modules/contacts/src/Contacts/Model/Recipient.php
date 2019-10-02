<?php
namespace Contacts\Model;

use Mix\Model\Model;

class Recipient extends Model
{
    protected $table = 'contact_recipients';

    public function init()
    {
        $this->text('name', 'Nome')->mandatory()->maxLength(150);
        $this->email('email', 'E-mail')->mandatory()->maxLength(150);
        $this->boolean('activated', 'Ativo', 1);
        $this->timestamp('created_at')->setLabel('Data de cadastro');
        $this->timestamp('updated_at', true, false);
    }

    public static function findForSendEmail()
    {
        $destinatarios = [];

        $db = static::getConnection();
        $queryBuilder = $db
            ->createQueryBuilder()
            ->select('d.*')
            ->from(static::getTable(), 'd');

        $queryBuilder->where('d.activated=1');

        $result = $queryBuilder->execute()->fetchAll();

        if ($result) {
            foreach ($result as $value) {
                $destinatarios[$value['email']] = $value['name'];
            }
        }

        return $destinatarios;
    }
}
