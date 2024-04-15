<?php

declare(strict_types=1);

namespace App\Domain\Property\Validator;

use App\Domain\Property\ValueObject\Address;

interface AddressValidatorInterface
{
    public function validate(Address $entity): void;
}
