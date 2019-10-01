<?php

use Phinx\Migration\AbstractMigration;

/**
 * Creates the default application schema
 */
class RemoveUniqueConstraintFromObjetoIdInTableFotos extends AbstractMigration
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
    public function up()
    {
        $this
            ->table('fotos')
            ->changeColumn('objeto_id', 'integer', ['signed' => false, 'null' => true, 'default' => null])
            ->update();
    }
}
