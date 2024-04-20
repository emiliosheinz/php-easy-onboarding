<?php

declare(strict_types=1);

namespace App\Usecase\Property\Create;

class InputCreatePropertyAddressDto
{
    public string $country;
    public string $street;
    public string $city;
    public string $state;
    public string $zipCode;
    public ?string $complement;
}
