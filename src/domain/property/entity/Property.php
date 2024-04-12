<?php 
namespace Domain\Entity;

class Property {
  public function __construct(
    readonly string $id,
    private string $name,
    private string $email,
    private string $phone,
  ){}

  public function getName(): string {
    return $this->name;
  }

  public function getEmail(): string {
    return $this->email;
  }

  public function getPhone(): string {
    return $this->phone;
  }

  private validate(): void {
    // TODO: Implement validation
  }
};