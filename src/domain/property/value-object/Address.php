<?php

declare(strict_types=1);

namespace App\Domain\Property\ValueObject;

class Address
{
    public function __construct(
        private string $country,
        private string $street,
        private string $city,
        private string $state,
        private string $zipCode,
        private ?string $complement = null,
    ) {
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

    public function getComplement(): string
    {
        return $this->complement;
    }
}
