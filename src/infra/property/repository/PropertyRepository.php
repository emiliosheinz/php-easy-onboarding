<?php

declare(strict_types=1);

namespace App\Infra\Property\Repository;

use App\Domain\Property\Entity\Property;
use App\Domain\Property\Repository\PropertyRepositoryInterface;

class PropertyRepository implements PropertyRepositoryInterface
{
    public function create(Property $data): void
    {
      // TODO implement create function
    }
}
