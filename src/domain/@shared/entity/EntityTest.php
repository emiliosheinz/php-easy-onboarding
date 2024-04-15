<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Entity\Entity;
use App\Domain\Notification\Notification;
use PHPUnit\Framework\TestCase;

class MyTestEntity extends Entity
{
    public function __construct(string $id)
    {
        parent::__construct($id);
    }
}

final class EntityTest extends TestCase
{
    public function testCanBeExtended(): void
    {
        $entity = new MyTestEntity('test-id');

        $this->assertInstanceOf(MyTestEntity::class, $entity);
        $this->assertEquals('test-id', $entity->id);
        $this->assertInstanceOf(Notification::class, $entity->notification);
    }
}
