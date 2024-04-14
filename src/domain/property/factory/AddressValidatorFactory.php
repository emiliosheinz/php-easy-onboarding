<?php

declare(strict_types=1);

namespace App\Domain\Property\Factory;

use App\Domain\Property\Validator\AddressSymfonyValidator;
use App\Domain\Property\Validator\AddressValidatorInterface;

class AddressValidatorFactory
{
  public static function create(): AddressValidatorInterface
  {
    return new AddressSymfonyValidator();
  }
}
