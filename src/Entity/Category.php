<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=191)
     */
    public string $title;

    /**
     * @ORM\Column(type="string", length=191, nullable=true)
     *
     * @var ?string
     */
    public ?string $description;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=191)
     *
     * @var string
     */
    private string $subject;

    /**
     * @ORM\Column(type="string", length=191, nullable=true)
     *
     * @var ?string
     */
    private ?string $image;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private ?\DateTimeInterface $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="categories")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private ?User $user;

    /**
     * @ORM\OneToMany(targetEntity=Item::class, mappedBy="category", orphanRemoval=true)
     */
    private  $items;

    /**
     * @ORM\ManyToMany(targetEntity=CustomField::class, inversedBy="categories", cascade={"persist"})
     */
    private  $customField;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->customField = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(): self
    {
        $this->date = new \DateTime();

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setCategory($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getCategory() === $this) {
                $item->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCustomField(): Collection
    {
        return $this->customField;
    }

    public function addCustomField(CustomField $customField): self
    {
        if (!$this->customField->contains($customField)) {
            $this->customField[] = $customField;
        }

        return $this;
    }

    public function removeCustomField(CustomField $customField): self
    {
        $this->customField->removeElement($customField);

        return $this;
    }
}
