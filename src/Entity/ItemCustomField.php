<?php

namespace App\Entity;

use App\Repository\ItemCustomFieldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemCustomFieldRepository::class)
 */
class ItemCustomField
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
    private $title;

    /**
     * @ORM\Column(type="string", length=191, nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="itemCustomFields")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $item;



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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

public function __toString(): string
{
    return $this->field . $this->value;
}
}
