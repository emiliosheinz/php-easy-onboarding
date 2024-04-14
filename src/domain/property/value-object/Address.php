<?php

declare(strict_types=1);

namespace App\Domain\Property\ValueObject;

use App\Domain\Property\Factory\AddressValidatorFactory;
use App\Domain\ValueObject\ValueObject;

class Address extends ValueObject
{
    public function __construct(
        private string $country,
        private string $street,
        private string $city,
        private string $state,
        private string $zipCode,
        private ?string $complement = null,
    ) {
        parent::__construct();
        $this->validate();
    }

    public function validate(): void
    {
        AddressValidatorFactory::create()->validate($this);
        $this->notification->throwIfHasErrors('Invalid address data.');
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }
}
