<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private  $tag ;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $integer1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $integer2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $integer3;

    /**
     * @ORM\Column(type="string", length=191, nullable=true)
     */
    private $string1;

    /**
     * @ORM\Column(type="string", length=191, nullable=true)
     */
    private $string2;

    /**
     * @ORM\Column(type="string", length=191, nullable=true)
     */
    private $string3;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text3;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid
     */
    private $category;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date1;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date2;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date3;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $bool1;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $bool2;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $bool3;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function setTag(?array $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDate(): self
    {
        $this->dateCreate = new \DateTime();

        return $this;
    }

    public function getInteger1(): ?int
    {
        return $this->integer1;
    }

    public function setInteger1(?int $integer1): self
    {
        $this->integer1 = $integer1;

        return $this;
    }

    public function getInteger2(): ?int
    {
        return $this->integer2;
    }

    public function setInteger2(?int $integer2): self
    {
        $this->integer2 = $integer2;

        return $this;
    }

    public function getInteger3(): ?int
    {
        return $this->integer3;
    }

    public function setInteger3(?int $integer3): self
    {
        $this->integer3 = $integer3;

        return $this;
    }

    public function getString1(): ?string
    {
        return $this->string1;
    }

    public function setString1(?string $string1): self
    {
        $this->string1 = $string1;

        return $this;
    }

    public function getString2(): ?string
    {
        return $this->string2;
    }

    public function setString2(?string $string2): self
    {
        $this->string2 = $string2;

        return $this;
    }

    public function getString3(): ?string
    {
        return $this->string3;
    }

    public function setString3(?string $string3): self
    {
        $this->string3 = $string3;

        return $this;
    }

    public function getText1(): ?string
    {
        return $this->text1;
    }

    public function setText1(?string $text1): self
    {
        $this->text1 = $text1;

        return $this;
    }

    public function getText2(): ?string
    {
        return $this->text2;
    }

    public function setText2(?string $text2): self
    {
        $this->text2 = $text2;

        return $this;
    }

    public function getText3(): ?string
    {
        return $this->text3;
    }

    public function setText3(?string $text3): self
    {
        $this->text3 = $text3;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDate1(): ?\DateTimeInterface
    {
        return $this->date1;
    }

    public function setDate1(?\DateTimeInterface $date1): self
    {
        $this->date1 = $date1;

        return $this;
    }

    public function getDate2(): ?\DateTimeInterface
    {
        return $this->date2;
    }

    public function setDate2(?\DateTimeInterface $date2): self
    {
        $this->date2 = $date2;

        return $this;
    }

    public function getDate3(): ?\DateTimeInterface
    {
        return $this->date3;
    }

    public function setDate3(?\DateTimeInterface $date3): self
    {
        $this->date3 = $date3;

        return $this;
    }

    public function getBool1(): ?bool
    {
        return $this->bool1;
    }

    public function setBool1(?bool $bool1): self
    {
        $this->bool1 = $bool1;

        return $this;
    }

    public function getBool2(): ?bool
    {
        return $this->bool2;
    }

    public function setBool2(?bool $bool2): self
    {
        $this->bool2 = $bool2;

        return $this;
    }

    public function getBool3(): ?bool
    {
        return $this->bool3;
    }

    public function setBool3(?bool $bool3): self
    {
        $this->bool3 = $bool3;

        return $this;
    }
}
