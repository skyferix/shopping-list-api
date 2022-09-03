<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ListCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListCategoryRepository::class)]
class ListCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: ProductList::class)]
    private Collection $productLists;

    public function __construct()
    {
        $this->productLists = new ArrayCollection();
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

    public function getProductLists(): Collection
    {
        return $this->productLists;
    }

    public function addProductList(ProductList $productList): self
    {
        if (!$this->productLists->contains($productList)) {
            $this->productLists[] = $productList;
            $productList->setCategory($this);
        }

        return $this;
    }

    public function removeProductList(ProductList $productList): self
    {
        if ($this->productLists->removeElement($productList)) {
            if ($productList->getCategory() === $this) {
                $productList->setCategory(null);
            }
        }

        return $this;
    }
}
