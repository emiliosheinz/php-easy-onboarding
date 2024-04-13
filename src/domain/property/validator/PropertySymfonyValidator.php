<?php

declare(strict_types=1);

namespace App\Domain\Property\Validator;

use App\Domain\Notification\NotificationError;
use App\Domain\Property\Entity\Property;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class PropertySymfonyValidator implements PropertyValidatorInterface
{
  public function validate(Property $entity): void
  {
    $validator = Validation::createValidator();
    $violations = $validator->validate(
      $entity,
      new Assert\Collection(
        fields: [
          'id' => new Assert\Uuid(message: 'The id must be a valid UUID.'),
          'name' => new Assert\Length(min: 3, max: 255, minMessage: 'The name must be at least {{ limit }} characters long.', maxMessage: 'The name cannot be longer than {{ limit }} characters.'),
          'email' => new Assert\Email(message: 'The email must be a valid email address.'),
          'website' => new Assert\Url(message: 'The website must be a valid URL.'),
          'phone' => new Assert\Regex(pattern: '/^\+?[0-9]+$/', message: 'The phone number must be a valid phone number.'),
          'description' => new Assert\Length(min: 3, max: 1000, minMessage: 'The description must be at least {{ limit }} characters long.', maxMessage: 'The description cannot be longer than {{ limit }} characters.'),
        ]
      )
    );
    foreach ($violations as $violation) {
      print(">>>>>" . $violation->getMessage() . "\n");
      $error = new NotificationError(
        message: $violation->getMessage(),
        context: $violation->getPropertyPath(),
      );
      $entity->notification->addError($error);
    }
  }
}
