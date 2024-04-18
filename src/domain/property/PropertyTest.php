<?php

declare(strict_types=1);

namespace App\Domain\Property;

use App\Domain\Notification\Notification;
use App\Domain\Notification\NotificationException;
use PHPUnit\Framework\TestCase;
use App\Domain\Property\Entity\Property;
use App\Domain\Property\Types\PropertyType;
use App\Domain\Property\ValueObject\Address;
use App\Domain\Property\ValueObject\Image;
use App\Utils\Uuid;

final class PropertyTest extends TestCase
{
    private function makePropertyParams(): array
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
            'images' => [
                new Image(url: 'https://example.com/image1.jpg', isDefault: true),
                new Image(url: 'https://example.com/image2.jpg', isDefault: false),
                new Image(url: 'https://example.com/image3.jpg', isDefault: false),
            ]
        ];
    }

    public function testCanBeCreated(): void
    {
        $propertyParams = $this->makePropertyParams();
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
        $this->assertEquals($propertyParams['images'], $property->getImages());
    }

    public function testThrowsExceptionWhenIdIsInvalid(): void
    {
        try {
            $propertyParams = $this->makePropertyParams();
            $propertyParams['id'] = 'invalid-uuid';
            new Property(...$propertyParams);
        } catch (NotificationException $e) {
            $this->assertCount(1, $e->errors);
            $this->assertEquals('Invalid property entity state.', $e->getMessage());
            $this->assertEquals('id', $e->errors[0]->context);
            $this->assertEquals('The id must be a valid UUID.', $e->errors[0]->message);
        }
    }

    public function testThrowsExceptionWhenNameIsInvalid(): void
    {
        try {
            $propertyParams = $this->makePropertyParams();
            $propertyParams['name'] = '';
            new Property(...$propertyParams);
        } catch (NotificationException $e) {
            $this->assertCount(1, $e->errors);
            $this->assertEquals('Invalid property entity state.', $e->getMessage());
            $this->assertEquals('name', $e->errors[0]->context);
            $this->assertEquals('The name cannot be blank.', $e->errors[0]->message);
        }
    }

    public function testThrowsExceptionWhenEmailIsInvalid(): void
    {
        try {
            $propertyParams = $this->makePropertyParams();
            $propertyParams['email'] = 'invalid-email';
            new Property(...$propertyParams);
        } catch (NotificationException $e) {
            $this->assertCount(1, $e->errors);
            $this->assertEquals('Invalid property entity state.', $e->getMessage());
            $this->assertEquals('email', $e->errors[0]->context);
            $this->assertEquals('The email must be a valid email address.', $e->errors[0]->message);
        }
    }

    public function testThrowsExceptionWhenPhoneIsInvalid(): void
    {
        try {
            $propertyParams = $this->makePropertyParams();
            $propertyParams['phone'] = 'invalid-phone';
            new Property(...$propertyParams);
        } catch (NotificationException $e) {
            $this->assertCount(1, $e->errors);
            $this->assertEquals('Invalid property entity state.', $e->getMessage());
            $this->assertEquals('phone', $e->errors[0]->context);
            $this->assertEquals('The phone number must be a valid phone number.', $e->errors[0]->message);
        }
    }

    public function testThrowsExceptionWhenWebsiteIsInvalid(): void
    {
        try {
            $propertyParams = $this->makePropertyParams();
            $propertyParams['website'] = 'invalid-website';
            new Property(...$propertyParams);
        } catch (NotificationException $e) {
            $this->assertCount(1, $e->errors);
            $this->assertEquals('Invalid property entity state.', $e->getMessage());
            $this->assertEquals('website', $e->errors[0]->context);
            $this->assertEquals('The website must be a valid URL.', $e->errors[0]->message);
        }
    }

    public function testThrowsExceptionWhenDescriptionIsInvalid(): void
    {
        try {
            $propertyParams = $this->makePropertyParams();
            $propertyParams['description'] = 'short';
            new Property(...$propertyParams);
        } catch (NotificationException $e) {
            $this->assertCount(1, $e->errors);
            $this->assertEquals('Invalid property entity state.', $e->getMessage());
            $this->assertEquals('description', $e->errors[0]->context);
            $this->assertEquals('The description must be at least 10 characters long.', $e->errors[0]->message);
        }
    }

    public function testThrowsExceptionWithMultipleErrors(): void
    {
        try {
            $propertyParams = $this->makePropertyParams();
            $propertyParams['id'] = 'invalid-uuid';
            $propertyParams['name'] = '';
            $propertyParams['email'] = 'invalid-email';
            $propertyParams['phone'] = 'invalid-phone';
            $propertyParams['website'] = 'invalid-website';
            $propertyParams['description'] = 'short';
            new Property(...$propertyParams);
        } catch (NotificationException $e) {
            $this->assertCount(6, $e->errors);
            $this->assertEquals('Invalid property entity state.', $e->getMessage());
        }
    }
}
