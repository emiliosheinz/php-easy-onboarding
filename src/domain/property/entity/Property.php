<?php

declare(strict_types=1);

namespace App\Domain\Property\Entity;

use App\Domain\Property\ValueObject\Address;

enum PropertyType: string
{
  case Hotel = 'hotel';
  case Hostel = 'hostel';
  case Boutique = 'boutique';
  case Motel = 'motel';
  case VacationRental = 'vacationRental';
  case BedAndBreakfast = 'bedAndBreakfast';
  case Campground = 'campground';
  case OutdoorLodge = 'outdoorLodge';
}

class Property
{
  public function __construct(
    readonly string $id,
    private PropertyType $type,
    private string $name,
    private string $email,
    private string $website,
    private string $phone,
    private string $description,
    private Address $address,
    private array $images = [],
  ) {
  }

  public function getType(): PropertyType
  {
    return $this->type;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function getWebsite(): string
  {
    return $this->website;
  }

  public function getPhone(): string
  {
    return $this->phone;
  }

  public function getDescription(): string
  {
    return $this->description;
  }

  public function getAddress(): Address
  {
    return $this->address;
  }

  public function getImages(): array
  {
    return $this->images;
  }
};
