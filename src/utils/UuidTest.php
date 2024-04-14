<?php

declare(strict_types=1);

use App\Utils\Uuid;
use PHPUnit\Framework\TestCase;

final class UuidTest extends TestCase
{
  public function testCanBeCreated(): void
  {
    $uuid = Uuid::v4();
    $this->assertIsString($uuid);
    $this->assertMatchesRegularExpression('/[a-f0-9]{8}-[a-f0-9]{4}-4[a-f0-9]{3}-[89ab][a-f0-9]{3}-[a-f0-9]{12}/', $uuid);
  }
}
