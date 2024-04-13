<?php

declare(strict_types=1);

namespace App\Domain\Notification;

class NotificationException extends \Exception
{
  public function __construct(string $message, public readonly array $errors)
  {
    parent::__construct($message);
  }
}
