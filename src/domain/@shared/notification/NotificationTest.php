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
        $addedError = new NotificationError(context: 'context', message: 'Error message');
        $notification->addError($addedError);
        $this->assertCount(1, $notification->getErrors());
        $this->assertTrue($notification->hasErrors());
        $this->assertEquals([$addedError], $notification->getErrors());
    }

    public function testThrowNotificationExceptionIfHasErrors(): void
    {
        $notification = new Notification();
        $addedError = new NotificationError(context: 'context', message: 'Error message');
        $notification->addError($addedError);
        try {
            $notification->throwIfHasErrors('Exception message');
        } catch (NotificationException $e) {
            $this->assertInstanceOf(NotificationException::class, $e);
            $this->assertEquals('Exception message', $e->getMessage());
            $this->assertEquals([$addedError], $e->errors);
        }
    }

    public function testDoesNotThrowNotificationExceptionIfHasNoErrors(): void
    {
        $notification = new Notification();
        $notification->throwIfHasErrors('Exception message');
        $this->assertTrue(true);
    }

    public function testNotificationErrorToStringYieldsContextAndMessage(): void
    {
        $error = new NotificationError(context: 'context', message: 'Error message');
        $this->assertEquals('context: Error message', strval($error));
    }
}
