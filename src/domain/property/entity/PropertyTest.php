<?php

declare(strict_types=1);

use App\Domain\Notification\Notification;
use App\Domain\Notification\NotificationError;
use App\Domain\Notification\NotificationException;
use PHPUnit\Framework\TestCase;
use App\Domain\Property\Entity\Property;
use App\Domain\Property\Entity\PropertyType;
use App\Domain\Property\ValueObject\Address;
use App\Utils\Uuid;
use PhpParser\Node\Expr\Cast\Object_;

function makePropertyParams(): array
{
    return [
        'id' => Uuid::v4(),
        'type' => PropertyType::Hotel,
        'name' => 'John Doe',
        'email' => 'johndoe@gmail.com',
        'phone' => '1234567890',
        'website' => 'https://example.com',
        'description' => 'This is a test property',
        'address' => new Address(
            street: '123 Main St.',
            city: 'Springfield',
            state: 'IL',
            zipCode: '62701',
            country: 'US'
        ),
    ];
}
final class PropertyTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $propertyParams = makePropertyParams();
        $property = new Property(...$propertyParams);
        $this->assertInstanceOf(Property::class, $property);
        $this->assertEquals($propertyParams['id'], $property->id);
        $this->assertEquals($propertyParams['type'], $property->getType());
        $this->assertEquals($propertyParams['name'], $property->getName());
        $this->assertEquals($propertyParams['email'], $property->getEmail());
        $this->assertEquals($propertyParams['phone'], $property->getPhone());
        $this->assertEquals($propertyParams['website'], $property->getWebsite());
        $this->assertEquals($propertyParams['description'], $property->getDescription());
        $this->assertEquals($propertyParams['address'], $property->getAddress());
        $this->assertInstanceOf(Notification::class, $property->notification);
    }

    public function throwsAnErrorWhenThereIsAnInvalidParam(): void
    {
        $this->expectException(NotificationException::class);
        $propertyParams = makePropertyParams();
        $propertyParams['id'] = 'invalid-uuid';
        new Property(...$propertyParams);
    }
}
