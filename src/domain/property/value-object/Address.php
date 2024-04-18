<?php

declare(strict_types=1);

namespace App\Domain\Property\ValueObject;

use App\Domain\Property\Factory\AddressValidatorFactory;
use App\Domain\ValueObject\ValueObject;

class Address extends ValueObject
{
    public function __construct(
        public string $country,
        public string $street,
        public string $city,
        public string $state,
        public string $zipCode,
        public ?string $complement = null,
    ) {
        parent::__construct();
        $this->validate();
    }

    public function validate(): void
    {
        AddressValidatorFactory::create()->validate($this);
        $this->notification->throwIfHasErrors('Invalid address data.');
    }
}
