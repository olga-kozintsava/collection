<?php

namespace App\Entity;

use App\Repository\CustomFieldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category;

/**
 * @ORM\Entity(repositoryClass=CustomFieldRepository::class)
 */
class CustomField
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191, nullable=true)
     */
    private ?string $title;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, mappedBy="customField")
     * @ORM\JoinTable(name="categories_")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
//        if (!$this->categories->contains($category)) {
//            $this->categories->add($category);
//        }
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addCustomField($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeCustomField($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
