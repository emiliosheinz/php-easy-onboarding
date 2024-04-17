<?php

declare(strict_types=1);

namespace App\Domain\Property\Factory;

use App\Domain\Property\Validator\ImageSymfonyValidator;
use App\Domain\Property\Validator\ImageValidatorInterface;

class ImageValidatorFactory
{
    public static function create(): ImageValidatorInterface
    {
        return new ImageSymfonyValidator();
    }
}
