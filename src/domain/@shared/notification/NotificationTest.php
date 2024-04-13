<?php

declare(strict_types=1);

namespace App\Domain\Notification;

use PHPUnit\Framework\TestCase;

final class NotificationTest extends TestCase
{
  public function testCreatesNotification(): void
  {
    $notification = new Notification();
    $this->assertInstanceOf(Notification::class, $notification);
    $this->assertEmpty($notification->getErrors());
    $this->assertFalse($notification->hasErrors());
  }

  public function testAddError(): void
  {
    $notification = new Notification();
    $addedError = new NotificationError('Error message', 'context');
    $notification->addError($addedError);
    $this->assertCount(1, $notification->getErrors());
    $this->assertTrue($notification->hasErrors());
    $this->assertEquals([$addedError], $notification->getErrors());
  }
}