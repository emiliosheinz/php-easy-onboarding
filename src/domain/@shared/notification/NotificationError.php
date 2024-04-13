<?php

declare(strict_types=1);

namespace App\Domain\Notification;

class NotificationError
{
  function __construct(
    public string $message,
    public string $context,
  ) {
  }

  public function __toString(): string
  {
    return $this->context . ': ' . $this->message;
  }
}
