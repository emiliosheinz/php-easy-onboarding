<?php

declare(strict_types=1);

namespace App\Domain\Property\ValueObject;

use App\Domain\Notification\NotificationException;
use PHPUnit\Framework\TestCase;

final class ImageTest extends TestCase
{
    public function testCreateImage(): void
    {
        $image = new Image('https://example.com/image.jpg', true);
        $this->assertEquals('https://example.com/image.jpg', $image->getUrl());
        $this->assertTrue($image->isDefault());
    }

    public function testCreateNotDefaultImage(): void
    {
        $image = new Image('https://example.com/image.jpg', false);
        $this->assertEquals('https://example.com/image.jpg', $image->getUrl());
        $this->assertFalse($image->isDefault());
    }

    public function testCreateImageWithInvalidUrl(): void
    {
        try {
            new Image('invalid-url', true);
            $this->fail('An exception should have been thrown.');
        } catch (NotificationException $e) {
            $this->assertEquals('Invalid image data.', $e->getMessage());
            $this->assertEquals('url', $e->errors[0]->context);
            $this->assertEquals('The image url must be a valid url.', $e->errors[0]->message);
        }
    }
}
