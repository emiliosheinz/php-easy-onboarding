<?php

declare(strict_types=1);

namespace App\Domain\Notification;

class NotificationError
{
    public function __construct(
        public string $context,
        public string $message,
    ) {
    }

    public function __toString(): string
    {
        return $this->context . ': ' . $this->message;
    }
}
