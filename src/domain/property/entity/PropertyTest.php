<?php

declare(strict_types=1);

use App\Domain\Notification\Notification;
use PHPUnit\Framework\TestCase;
use App\Domain\Property\Entity\Property;
use App\Domain\Property\Entity\PropertyType;
use App\Domain\Property\ValueObject\Address;
use App\Utils\Uuid;

final class PropertyTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $propertyId = Uuid::v4();
        $address = new Address(
            street: '123 Main St.',
            city: 'Springfield',
            state: 'IL',
            zipCode: '62701',
            country: 'US'
        );
        $property = new Property(
            id: $propertyId,
            type: PropertyType::Hotel,
            name: 'John Doe',
            email: 'john@gmail.com',
            phone: '1234567890',
            website: 'https://example.com',
            description: 'This is a test property',
            address: $address,
        );
        $this->assertEquals($propertyId, $property->id);
        $this->assertEquals(PropertyType::Hotel, $property->getType());
        $this->assertEquals('John Doe', $property->getName());
        $this->assertEquals('john@gmail.com', $property->getEmail());
        $this->assertEquals('1234567890', $property->getPhone());
        $this->assertEquals('https://example.com', $property->getWebsite());
        $this->assertEquals('This is a test property', $property->getDescription());
        $this->assertEquals($address, $property->getAddress());
        $this->assertInstanceOf(Notification::class, $property->notification);
    }
}
