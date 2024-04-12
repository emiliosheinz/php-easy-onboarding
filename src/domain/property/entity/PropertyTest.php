<?php
namespace Domain\Entity;

include 'Property.php';

use PHPUnit\Framework\TestCase;

class PropertyTest extends TestCase
{
    public function successfullyCreatesAProperty()
    {
        $property = new Property(id: '1234', name: 'John Doe', email: 'john@gmail.com', phone: '1234567890');
        $this->assertEquals('1234', $property->id);
        $this->assertEquals('John Doe', $property->getName());
        $this->assertEquals('john@gmail.com', $property->getEmail());
        $this->assertEquals('1234567890', $property->getPhone());
    }
}