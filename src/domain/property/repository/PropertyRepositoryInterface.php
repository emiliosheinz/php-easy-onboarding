<?php

declare(strict_types=1);

namespace App\Domain\Property\Repository;

use App\Domain\Property\Entity\Property;

interface PropertyRepositoryInterface
{
    public function create(Property $data): void;
}
