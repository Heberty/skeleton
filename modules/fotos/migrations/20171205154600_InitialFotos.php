<?php

use Phinx\Migration\AbstractMigration;

/**
 * Creates the default application schema
 */
class InitialFotos extends AbstractMigration
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
        $this->createFotos();
    }

    /**
     * @return void
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    private function createFotos()
    {
        $this
            ->table('fotos', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', ['signed' => false, 'identity' => true])
            ->addColumn('foto', 'text', ['null' => false ])
            ->addColumn('objeto_id', 'integer', ['signed' => false, 'default' => null, 'null' => true ])
            ->addColumn('objeto_tipo', 'string', ['limit' => 50, 'default' => null, 'null' => true ])
            ->addColumn('capa', 'boolean', [ 'default' => false, 'null' => false])
            ->addColumn('ordem', 'integer', ['signed' => false, 'default' => '0'])
            ->addColumn('visivel_site', 'boolean', [ 'default' => true, 'null' => false])
            ->addColumn('data_cadastro', 'timestamp', ['default' => null,'null' => false])
            ->addColumn('titulo', 'string', [ 'limit' => 255, 'null' => true, 'default' => null ])
            ->addColumn('descricao', 'text', [ 'null' => true, 'default' => null ])
            // Indexes
            ->addIndex(['id'], ['unique' => true])
            ->addIndex(['objeto_tipo', 'objeto_id'])
            ->create();
    }
}
