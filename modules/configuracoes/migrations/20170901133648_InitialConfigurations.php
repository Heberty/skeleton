<?php

use Phinx\Migration\AbstractMigration;

/**
 * Creates the default application schema
 */
class InitialConfigurations extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     *
     * @return void
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function change()
    {
        $this->createConfigurations();
    }

    /**
     * @return void
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    private function createConfigurations()
    {
        $this
            ->table('configuracoes', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'integer', ['signed' => false, 'identity' => true])
            ->addColumn('chave', 'string', [
                'limit' => 255,
                'null' => false
            ])
            ->addColumn('valor', 'text', [
                'default' => null,
                'null' => true
            ])
            // Indexes
            ->addIndex(['id'], ['unique' => true])
            ->create();
    }
}
