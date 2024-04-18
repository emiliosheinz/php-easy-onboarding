<?php

declare(strict_types=1);

namespace App\Domain\Property\Validator;

use App\Domain\Notification\NotificationError;
use Symfony\Component\Validator\Constraints as Assert;
use App\Domain\Property\ValueObject\Image;
use Symfony\Component\Validator\Validation;

class ImageSymfonyValidator implements ImageValidatorInterface
{
    public function validate(Image $entity): void
    {
        $violations = Validation::createValidator()->startContext()
          ->atPath('url')->validate(
              $entity->url,
              new Assert\Url(message: 'The image url must be a valid url.')
          )
          ->atPath('isDefault')->validate(
              $entity->isDefault,
              new Assert\Type(type: 'bool', message: 'The isDefault must be a boolean.')
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
