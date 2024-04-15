<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Notification\Notification;

class ValueObject
{
    public readonly Notification $notification;

    public function __construct()
    {
        $this->notification = new Notification();
    }
}
