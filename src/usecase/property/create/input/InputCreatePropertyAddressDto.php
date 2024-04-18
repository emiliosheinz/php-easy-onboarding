<?php

declare(strict_types=1);

namespace App\Usecase\Property\Create;

class InputCreatePropertyAddressDto
{
    public string $city;
    public int $number;
    public string $state;
    public string $street;
    public string $zip;
}
