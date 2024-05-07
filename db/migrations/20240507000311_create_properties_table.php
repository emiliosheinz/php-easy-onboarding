<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePropertiesTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('properties', ['id' => false, 'primary_key' => ['id']]);
        $table->addColumn('id', 'uuid', ['null' => false])
              ->addColumn('type', 'string', ['null' => false])
              ->addColumn('email', 'string', ['null' => false])
              ->addColumn('website', 'string', ['null' => false, 'limit' => 255])
              ->addColumn('phone', 'string', ['null' => false, 'limit' => 255])
              ->addColumn('description', 'string', ['null' => false, 'limit' => 10_000])
              ->addTimestampsWithTimezone()
              ->create();
    }
}
