<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\ManyToOne(targetEntity: ProductCategory::class, inversedBy: 'products')]
    private ?ProductCategory $category;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductPackage::class)]
    private Collection $productPackages;

    public function __construct()
    {
        $this->productPackages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?ProductCategory
    {
        return $this->category;
    }

    public function setCategory(?ProductCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getProductPackages(): Collection
    {
        return $this->productPackages;
    }

    public function addProductPackage(ProductPackage $productPackage): self
    {
        if (!$this->productPackages->contains($productPackage)) {
            $this->productPackages[] = $productPackage;
            $productPackage->setProduct($this);
        }

        return $this;
    }

    public function removeProductPackage(ProductPackage $productPackage): self
    {
        if ($this->productPackages->removeElement($productPackage)) {
            if ($productPackage->getProduct() === $this) {
                $productPackage->setProduct(null);
            }
        }

        return $this;
    }
}
