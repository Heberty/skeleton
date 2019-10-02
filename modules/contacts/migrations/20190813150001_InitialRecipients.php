<?php

use Phinx\Migration\AbstractMigration;

class InitialRecipients extends AbstractMigration
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
            ->table('contact_recipients', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', ['signed' => false, 'identity' => true])
            ->addColumn('name', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('email', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('activated', 'boolean', [
                'default' => true,
                'null' => true
            ])
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
