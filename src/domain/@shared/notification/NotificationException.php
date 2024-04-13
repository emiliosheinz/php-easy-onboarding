<?php

declare(strict_types=1);

namespace App\Domain\Notification;

class NotificationException extends \Exception
{
  public function __construct(array $errors)
  {
    $message = join(', ', $errors);
    parent::__construct($message);
  }
}
