<?php

declare(strict_types=1);

namespace App\Domain\Property\Validator;

use App\Domain\Property\Entity\Property;

interface PropertyValidatorInterface
{
  public function validate(Property $entity): void;
}
