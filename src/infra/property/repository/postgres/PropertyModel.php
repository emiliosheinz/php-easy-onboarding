<?php

namespace App\Infra\Property\Postgres;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'properties')]
class Property
{
    #[ORM\Id]
    #[ORM\Column(type: 'guid')]
    private int $id;
    #[ORM\Column(type: 'string')]
    private string $name;
}
