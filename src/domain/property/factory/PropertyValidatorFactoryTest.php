<?php

declare(strict_types=1);

namespace App\Domain\Property\Factory;

use App\Domain\Property\Validator\PropertyValidatorInterface;
use PHPUnit\Framework\TestCase;

final class PropertyValidatorFactoryTest extends TestCase
{
  public function testCreatesPropertyValidator(): void
  {
    $validator = PropertyValidatorFactory::create();
    $this->assertInstanceOf(PropertyValidatorInterface::class, $validator);
  }
}
