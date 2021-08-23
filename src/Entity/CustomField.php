<?php

namespace App\Entity;

use App\Repository\CustomFieldRepository;
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
    *@ORM\Column(type="integer")
     *
     */
    private int $category;


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



    public function getCategory(): int
    {
        return $this->category;
    }

    public function setCategory(int $category):void
    {
        $this->category = $category;
    }
}
