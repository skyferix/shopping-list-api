<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ProductListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductListRepository::class)]
class ProductList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\OneToMany(mappedBy: 'productList', targetEntity: ProductPackage::class)]
    private Collection $productPackage;

    #[ORM\ManyToOne(targetEntity: ListGroup::class, inversedBy: 'lists')]
    private ?ListGroup $listGroup;

    #[ORM\ManyToOne(targetEntity: ListCategory::class, inversedBy: 'productLists')]
    private ?ListCategory $category;

    public function __construct()
    {
        $this->productPackage = new ArrayCollection();
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

    public function getProductPackage(): Collection
    {
        return $this->productPackage;
    }

    public function addProductPackage(ProductPackage $productPackage): self
    {
        if (!$this->productPackage->contains($productPackage)) {
            $this->productPackage[] = $productPackage;
            $productPackage->setProductList($this);
        }

        return $this;
    }

    public function removeProductPackage(ProductPackage $productPackage): self
    {
        if ($this->productPackage->removeElement($productPackage)) {
            if ($productPackage->getProductList() === $this) {
                $productPackage->setProductList(null);
            }
        }

        return $this;
    }

    public function getListGroup(): ?ListGroup
    {
        return $this->listGroup;
    }

    public function setListGroup(?ListGroup $listGroup): self
    {
        $this->listGroup = $listGroup;

        return $this;
    }

    public function getCategory(): ?ListCategory
    {
        return $this->category;
    }

    public function setCategory(?ListCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
}
