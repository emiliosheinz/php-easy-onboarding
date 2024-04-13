<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Domain\Property\Entity\Property;
use App\Domain\Property\Entity\PropertyType;
use App\Domain\Property\ValueObject\Address;

final class PropertyTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $address = new Address(
            street: '123 Main St.',
            city: 'Springfield',
            state: 'IL',
            zipCode: '62701',
            country: 'US'
        );
        $property = new Property(
            id: '1234',
            type: PropertyType::Hotel,
            name: 'John Doe',
            email: 'john@gmail.com',
            phone: '1234567890',
            website: 'https://example.com',
            description: 'This is a test property',
            address: $address,
        );
        $this->assertEquals('1234', $property->id);
        $this->assertEquals(PropertyType::Hotel, $property->getType());
        $this->assertEquals('John Doe', $property->getName());
        $this->assertEquals('john@gmail.com', $property->getEmail());
        $this->assertEquals('1234567890', $property->getPhone());
        $this->assertEquals('https://example.com', $property->getWebsite());
        $this->assertEquals('This is a test property', $property->getDescription());
        $this->assertEquals($address, $property->getAddress());
    }
}
