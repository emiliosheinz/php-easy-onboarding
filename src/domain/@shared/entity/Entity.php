<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Notification\Notification;

class Entity
{
  public readonly string $id;
  public readonly Notification $notification;

  public function __construct(string $id)
  {
    $this->id = $id;
    $this->notification = new Notification();
  }
}
