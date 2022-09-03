<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class ProductCountInUnit extends ProductCount
{
    #[ORM\Column(type: 'integer')]
    private ?int $unit;

    public function getUnit(): ?int
    {
        return $this->unit;
    }

    public function setUnit(?int $unit): void
    {
        $this->unit = $unit;
    }
}