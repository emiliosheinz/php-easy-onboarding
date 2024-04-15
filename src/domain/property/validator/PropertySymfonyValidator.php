<?php

declare(strict_types=1);

namespace App\Domain\Property\Validator;

use App\Domain\Notification\NotificationError;
use App\Domain\Property\Entity\Property;
use App\Domain\Property\Types\PropertyType;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySymfonyValidator implements PropertyValidatorInterface
{
  public function validate(Property $entity): void
  {
    $violations = Validation::createValidator()->startContext()
      ->atPath('id')->validate(
        $entity->id,
        new Assert\Uuid(message: 'The id must be a valid UUID.')
      )
      ->atPath('type')->validate(
        $entity->getType(),
        new Assert\Choice(choices: PropertyType::cases(), message: 'The type must be one of: {{ choices }}.'),
      )
      ->atPath('name')->validate(
        $entity->getName(),
        new Assert\NotBlank(message: 'The name cannot be blank.')
      )
      ->atPath('email')->validate(
        $entity->getEmail(),
        new Assert\Email(message: 'The email must be a valid email address.')
      )
      ->atPath('website')->validate(
        $entity->getWebsite(),
        new Assert\Url(message: 'The website must be a valid URL.')
      )
      ->atPath('phone')->validate(
        $entity->getPhone(),
        new Assert\Regex(pattern: '/^\+?[0-9]+$/', message: 'The phone number must be a valid phone number.')
      )
      ->atPath('description')->validate(
        $entity->getDescription(),
        new Assert\Length(
          min: 10,
          max: 10_000,
          minMessage: 'The description must be at least {{ limit }} characters long.',
          maxMessage: 'The description cannot be longer than {{ limit }} characters.'
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
