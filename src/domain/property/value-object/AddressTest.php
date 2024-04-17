<?php

declare(strict_types=1);

namespace App\Domain\Property\ValueObject;

use App\Domain\Notification\Notification;
use App\Domain\Notification\NotificationException;
use PHPUnit\Framework\TestCase;

final class AddressTest extends TestCase
{
    private function makeAddressParams(): array
    {
        return [
        'country' => 'BR',
        'street' => 'Rua dos Bobos',
        'city' => 'São Paulo',
        'state' => 'SP',
        'zipCode' => '12345678',
        'complement' => 'Apto 123',
        ];
    }

    public function testCanBeCreated(): void
    {
        $addressParams = $this->makeAddressParams();
        $address = new Address(...$addressParams);
        $this->assertInstanceOf(Address::class, $address);
        $this->assertEquals($addressParams['country'], $address->getCountry());
        $this->assertEquals($addressParams['street'], $address->getStreet());
        $this->assertEquals($addressParams['city'], $address->getCity());
        $this->assertEquals($addressParams['state'], $address->getState());
        $this->assertEquals($addressParams['zipCode'], $address->getZipCode());
        $this->assertEquals($addressParams['complement'], $address->getComplement());
        $this->assertInstanceOf(Notification::class, $address->notification);
    }

    public function testCannotBeCreatedWithInvalidCountry(): void
    {
        try {
            $addressParams = $this->makeAddressParams();
            $addressParams['country'] = 'BRA';
            new Address(...$addressParams);
        } catch (NotificationException $e) {
            $this->assertEquals('Invalid address data.', $e->getMessage());
            $this->assertEquals('country', $e->errors[0]->context);
            $this->assertEquals('The country must be a valid country code.', $e->errors[0]->message);
        }
    }

    public function testCannotBeCreatedWithInvalidStreet(): void
    {
        try {
            $addressParams = $this->makeAddressParams();
            $addressParams['street'] = '';
            new Address(...$addressParams);
        } catch (NotificationException $e) {
            $this->assertEquals('Invalid address data.', $e->getMessage());
            $this->assertEquals('street', $e->errors[0]->context);
            $this->assertEquals('The street cannot be blank.', $e->errors[0]->message);
        }
    }

    public function testCannotBeCreatedWithInvalidCity(): void
    {
        try {
            $addressParams = $this->makeAddressParams();
            $addressParams['city'] = '';
            new Address(...$addressParams);
        } catch (NotificationException $e) {
            $this->assertEquals('Invalid address data.', $e->getMessage());
            $this->assertEquals('city', $e->errors[0]->context);
            $this->assertEquals('The city cannot be blank.', $e->errors[0]->message);
        }
    }

    public function testCannotBeCreatedWithInvalidState(): void
    {
        try {
            $addressParams = $this->makeAddressParams();
            $addressParams['state'] = '';
            new Address(...$addressParams);
        } catch (NotificationException $e) {
            $this->assertEquals('Invalid address data.', $e->getMessage());
            $this->assertEquals('state', $e->errors[0]->context);
            $this->assertEquals('The state cannot be blank.', $e->errors[0]->message);
        }
    }

    public function testCannotBeCreatedWithInvalidZipCode(): void
    {
        try {
            $addressParams = $this->makeAddressParams();
            $addressParams['zipCode'] = 'abc';
            new Address(...$addressParams);
        } catch (NotificationException $e) {
            $this->assertEquals('Invalid address data.', $e->getMessage());
            $this->assertEquals('zipCode', $e->errors[0]->context);
            $this->assertEquals('The zip code must be a valid zip code.', $e->errors[0]->message);
        }
    }

    public function testCannotBeCreatedWithABlankZipCode(): void
    {
        try {
            $addressParams = $this->makeAddressParams();
            $addressParams['zipCode'] = '';
            new Address(...$addressParams);
        } catch (NotificationException $e) {
            $this->assertEquals('Invalid address data.', $e->getMessage());
            $this->assertEquals('zipCode', $e->errors[0]->context);
            $this->assertEquals('The zip code cannot be blank.', $e->errors[0]->message);
        }
    }
}
