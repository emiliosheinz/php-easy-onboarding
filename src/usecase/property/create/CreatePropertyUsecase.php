<?php

declare(strict_types=1);

namespace App\Usecase\Property\Create;

use App\Domain\Property\Entity\Property;
use App\Domain\Property\Repository\PropertyRepositoryInterface;
use App\Domain\Property\Types\PropertyType;
use App\Domain\Property\ValueObject\Address;
use App\Domain\Property\ValueObject\Image;
use App\Utils\Uuid;

class CreatePropertyUsecase
{
    public function __construct(
        private PropertyRepositoryInterface $repository
    ) {
    }

    public function execute(InputCreatePropertyDto $input): void
    {
        $address = new Address(
            country: $input->address->country,
            street: $input->address->street,
            city: $input->address->city,
            state: $input->address->state,
            zipCode: $input->address->zipCode,
            complement: $input->address->complement,
        );
        $images = array_map(
            fn ($image) => new Image($image->url, $image->isDefault),
            $input->images
        );
        $property = new Property(
            id: Uuid::v4(),
            type: PropertyType::tryFrom($input->type),
            name: $input->name,
            email: $input->email,
            website: $input->website,
            phone: $input->phone,
            description: $input->description,
            images: $images,
            address: $address,
        );
        $this->repository->create($property);
    }
}
