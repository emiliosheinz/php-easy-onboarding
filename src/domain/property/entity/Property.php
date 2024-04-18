<?php

declare(strict_types=1);

namespace App\Domain\Property\Entity;

use App\Domain\Entity\Entity;
use App\Domain\Property\Factory\PropertyValidatorFactory;
use App\Domain\Property\Types\PropertyType;
use App\Domain\Property\ValueObject\Address;

class Property extends Entity
{
    public function __construct(
        string $id,
        private PropertyType $type,
        private string $name,
        private string $email,
        private string $website,
        private string $phone,
        private string $description,
        private array $images,
        private Address $address,
    ) {
        parent::__construct($id);
        $this->validate();
    }

    public function validate(): void
    {
        PropertyValidatorFactory::create()->validate($this);
        $this->notification->throwIfHasErrors('Invalid property entity state.');
    }

    public function getType(): PropertyType
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function getImages(): array
    {
        return $this->images;
    }
}
