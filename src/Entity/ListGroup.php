<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ListGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListGroupRepository::class)]
class ListGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\OneToMany(mappedBy: 'listGroup', targetEntity: ProductList::class)]
    private Collection $lists;

    public function __construct()
    {
        $this->lists = new ArrayCollection();
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

    public function getLists(): Collection
    {
        return $this->lists;
    }

    public function addList(ProductList $list): self
    {
        if (!$this->lists->contains($list)) {
            $this->lists[] = $list;
            $list->setListGroup($this);
        }

        return $this;
    }

    public function removeList(ProductList $list): self
    {
        if ($this->lists->removeElement($list)) {
            if ($list->getListGroup() === $this) {
                $list->setListGroup(null);
            }
        }

        return $this;
    }
}
