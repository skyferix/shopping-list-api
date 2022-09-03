<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductPackageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductPackageRepository::class)]
class ProductPackage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\OneToOne(targetEntity: ProductCount::class, cascade: ['persist', 'remove'])]
    private ?ProductCount $count;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productPackages')]
    private ?Product $product;

    #[ORM\ManyToOne(targetEntity: ProductList::class, inversedBy: 'productPackage')]
    private ?ProductList $productList;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCount(): ?ProductCount
    {
        return $this->count;
    }

    public function setCount(?ProductCount $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getProductList(): ?ProductList
    {
        return $this->productList;
    }

    public function setProductList(?ProductList $productList): self
    {
        $this->productList = $productList;

        return $this;
    }
}
