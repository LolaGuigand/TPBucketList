<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Wish::class, mappedBy="category")
     */
    private $whishes;

    public function __construct()
    {
        $this->whishes = new ArrayCollection();
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

    /**
     * @return Collection|Wish[]
     */
    public function getWhishes(): Collection
    {
        return $this->whishes;
    }

    public function addWhish(Wish $whish): self
    {
        if (!$this->whishes->contains($whish)) {
            $this->whishes[] = $whish;
            $whish->setCategory($this);
        }

        return $this;
    }

    public function removeWhish(Wish $whish): self
    {
        if ($this->whishes->removeElement($whish)) {
            // set the owning side to null (unless already changed)
            if ($whish->getCategory() === $this) {
                $whish->setCategory(null);
            }
        }

        return $this;
    }
}
