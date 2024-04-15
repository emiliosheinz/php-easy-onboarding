<?php

declare(strict_types=1);

namespace App\Domain\Property\Factory;

use App\Domain\Property\Validator\PropertySymfonyValidator;
use App\Domain\Property\Validator\PropertyValidatorInterface;

class PropertyValidatorFactory
{
    public static function create(): PropertyValidatorInterface
    {
        return new PropertySymfonyValidator();
    }
}
