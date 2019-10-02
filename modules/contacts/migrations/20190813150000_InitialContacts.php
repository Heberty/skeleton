<?php

use Phinx\Migration\AbstractMigration;

/**
 * Creates the default application schema
 */
class InitialContacts extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * @return void
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function change()
    {
        $this
            ->table('contacts', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', ['signed' => false, 'identity' => true])
            ->addColumn('name', 'string', [
                'limit' => 150,
                'null' => false
            ])
            ->addColumn('email', 'string', [
                'limit' => 150,
                'null' => false
            ])
            ->addColumn('phone', 'string', [
                'limit' => 15,
                'null' => true
            ])
            ->addColumn('uf', 'string', [
                'limit' => 2,
                'null' => true
            ])
            ->addColumn('city', 'string', [
                'limit' => 255,
                'null' => true
            ])
            ->addColumn('sector', 'string', [
                'limit' => 15,
                'null' => true
            ])
            ->addColumn('content', 'text', [
                'default' => null,
                'null' => false
            ])
            ->addColumn(
                'email_sent_at',
                'timestamp',
                [
                    'null' => true
                ]
            )
            ->addColumn('created_at', 'timestamp', [
                'null' => true
            ])
            ->addColumn('updated_at', 'timestamp', [
                'null' => true
            ])
            // Indexes
            ->addIndex(['id'], ['unique' => true])
            ->addIndex(['email'])
            ->create();
    }
}
