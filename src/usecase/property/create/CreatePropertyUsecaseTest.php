<?php

declare(strict_types=1);

namespace App\Usecase\Property\Create;

use App\Domain\Property\Repository\PropertyRepositoryInterface;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;

final class CreatePropertyUsecaseTest extends TestCase
{
    private function makeCreatePropertyUsecaseParams(): InputCreatePropertyDto
    {
        return new InputCreatePropertyDto(
            type: 'hotel',
            name: 'Property Name',
            email: 'property@email.com',
            website: 'https://property.com',
            phone: '51999999999',
            description: 'Thats the property description',
            images: [],
            address: new InputCreatePropertyAddressDto(
                country: 'US',
                street: 'Main Street',
                city: 'New York',
                state: 'New York',
                zipCode: '95450001',
                complement: '7th floor',
            )
        );
    }

    public function testCreateProperty()
    {
        $mockRepository = $this->createMock(PropertyRepositoryInterface::class);
        $mockRepository->expects($this->once())->method('create');
        $createPropertyUsecase = new CreatePropertyUsecase(repository: $mockRepository);
        $createPropertyUsecase->execute($this->makeCreatePropertyUsecaseParams());
    }
}
