<?php

declare(strict_types=1);

namespace App\Infra\Property\Repository;

use App\Domain\Property\Entity\Property;
use App\Domain\Property\Repository\PropertyRepositoryInterface;
use PgSql\Connection;

class PropertyRepository implements PropertyRepositoryInterface
{
    public function __construct(private Connection $db_connection)
    {
    }

    public function create(Property $data): void
    {
    }
}
