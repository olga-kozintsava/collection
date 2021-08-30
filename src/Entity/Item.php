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
     * @Assert\Type("string")
     */
    private ?string $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreate;


    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Assert\Valid
     */
    private ?Category $category;


    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="item")
     */
    private  $comments;

    /**
     * @ORM\OneToMany(targetEntity=Like::class, mappedBy="item")
     */
    private  $likes;

    /**
     * @ORM\OneToMany(targetEntity=ItemCustomField::class, mappedBy="item")
     */
    private  $itemCustomFields;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="items", cascade={"persist"})
     */
    private $tag;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->itemCustomFields = new ArrayCollection();
    }
    public function __toString(): string
    {
         return $this->title;
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


    public function getDate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDate(): self
    {
        $this->dateCreate = new \DateTime();

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

    /**
     * @return Collection
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setItem($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            if ($comment->getItem() === $this) {
                $comment->setItem(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setItem($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            if ($like->getItem() === $this) {
                $like->setItem(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getItemCustomFields(): Collection
    {
        return $this->itemCustomFields;
    }

    public function addItemCustomField(ItemCustomField $itemCustomField): self
    {
        if (!$this->itemCustomFields->contains($itemCustomField)) {
            $this->itemCustomFields[] = $itemCustomField;
            $itemCustomField->setItem($this);
        }
        return $this;
    }

    public function removeItemCustomField(ItemCustomField $itemCustomField): self
    {
        if ($this->itemCustomFields->removeElement($itemCustomField)) {
            if ($itemCustomField->getItem() === $this) {
                $itemCustomField->setItem(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }
        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tag->removeElement($tag);
        return $this;
    }
}
