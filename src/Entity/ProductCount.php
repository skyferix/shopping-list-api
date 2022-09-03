<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductCountRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductCountRepository::class)]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(["kg" => ProductCountInKg::class, "unit" => ProductCountInUnit::class])]
abstract class ProductCount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
