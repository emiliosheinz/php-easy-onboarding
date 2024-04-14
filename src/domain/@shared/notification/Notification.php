<?php

declare(strict_types=1);

namespace App\Domain\Notification;


class Notification
{
  private array $errors = [];

  function addError(NotificationError $error): void
  {
    $this->errors[] = $error;
  }

  function getErrors(): array
  {
    return $this->errors;
  }

  function throwIfHasErrors(string $message): void
  {
    if ($this->hasErrors()) {
      throw new NotificationException(message: $message, errors: $this->errors);
    }
  }

  function hasErrors(): bool
  {
    return count($this->errors) > 0;
  }
}
