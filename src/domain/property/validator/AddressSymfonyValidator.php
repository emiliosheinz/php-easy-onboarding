<?php

declare(strict_types=1);

namespace App\Domain\Property\Validator;

use App\Domain\Notification\NotificationError;
use App\Domain\Property\ValueObject\Address;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class AddressSymfonyValidator implements AddressValidatorInterface
{
  function validate(Address $entity): void
  {
    $violations = Validation::createValidator()->startContext()
      ->atPath('country')->validate(
        $entity->getCountry(),
        new Assert\Country(message: 'The country must be a valid country code.')
      )
      ->atPath('street')->validate(
        $entity->getStreet(),
        new Assert\NotBlank(message: 'The street cannot be blank.')
      )
      ->atPath('city')->validate(
        $entity->getCity(),
        new Assert\NotBlank(message: 'The city cannot be blank.')
      )
      ->atPath('state')->validate(
        $entity->getState(),
        new Assert\NotBlank(message: 'The state cannot be blank.')
      )
      ->atPath('zipCode')->validate(
        $entity->getZipCode(),
        new Assert\Regex(pattern: '/^\d*$/', message: 'The zip code must be a valid zip code.')
      )
      ->atPath('complement')->validate(
        $entity->getComplement(),
        new Assert\NotBlank(
          allowNull: true,
          message: 'The complement cannot be blank.'
        )
      )
      ->getViolations();

    foreach ($violations as $violation) {
      $error = new NotificationError(
        message: $violation->getMessage(),
        context: $violation->getPropertyPath(),
      );
      $entity->notification->addError($error);
    }
  }
}