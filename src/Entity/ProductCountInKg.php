<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class ProductCountInKg extends ProductCount
{
    #[ORM\Column(type: 'float')]
    private ?float $kg;

    public function getKg(): ?float
    {
        return $this->kg;
    }

    public function setKg(?float $kg): void
    {
        $this->kg = $kg;
    }
}