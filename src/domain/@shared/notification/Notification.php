<?php

declare(strict_types=1);

namespace App\Domain\Notification;

class Notification
{
    private array $errors = [];

    public function addError(NotificationError $error): void
    {
        $this->errors[] = $error;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function throwIfHasErrors(string $message): void
    {
        if ($this->hasErrors()) {
            throw new NotificationException(message: $message, errors: $this->errors);
        }
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }
}
