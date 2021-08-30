<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 *
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     *
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=191, nullable=true)
     */
    private ?string $password = null;

    /**
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $googleClientId;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=Category::class, mappedBy="user")
     */
    private  $categories;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user")
     */
    private  $comments;

    /**
     * @ORM\OneToMany(targetEntity=Like::class, mappedBy="user")
     */
    private $likes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $githubClientId;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->userLikes = new ArrayCollection();
        $this->likes = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function getGoogleClientId(): ?string
    {
        return $this->googleClientId;
    }

    public function setGoogleClientId(string $googleClientId): self
    {
        $this->googleClientId = $googleClientId;

        return $this;
    }


    public function setRoles(string $role): self
    {
     //   $this->roles = $role;
        $this->roles[] =$role;

        return $this;
    }

    public function getRoles(): array
    {
//        return [self::ROLE_USER];
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return $roles;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername(): string
    {
        return $this->email;
    }

//    public function __call(string $name, array $arguments)
//    {
//        // TODO: Implement @method string getUserIdentifier()
//    }
    public function getUserIdentifier(): string
    {
        return $this->email;
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
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setUser($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getUser() === $this) {
                $category->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Like[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setUser($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getUser() === $this) {
                $like->setUser(null);
            }
        }

        return $this;
    }

    public function getGithubClientId(): ?int
    {
        return $this->githubClientId;
    }

    public function setGithubClientId(?int $githubClientId): self
    {
        $this->githubClientId = $githubClientId;

        return $this;
    }




}



