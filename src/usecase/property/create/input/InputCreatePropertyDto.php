<?php

declare(strict_types=1);

namespace App\Usecase\Property\Create;

class InputCreatePropertyDto
{
    public function __construct(
        public string $type,
        public string $name,
        public string $email,
        public string $website,
        public string $phone,
        public string $description,
        public array $images,
        public InputCreatePropertyAddressDto $address,
    ) {
    }
}
