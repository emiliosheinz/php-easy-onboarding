<?php

declare(strict_types=1);

namespace App\Domain\Property\Validator;

use App\Domain\Property\ValueObject\Image;

interface ImageValidatorInterface
{
    public function validate(Image $entity): void;
}
