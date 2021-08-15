<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

///**
// * @ORM\Entity()
// *
// */
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 *
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
//    /**
//     * @param string $name
//     * @param string $email
//     * @param string $password
//     */
//    public function __construct(string $name, string $email, string $password){
//
//        $this->name = $name;
//        $this->email = $email;
//        $this->password = $password;
//    }

    private const ROLE_USER = 'ROLE_USER';
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=191, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $password;



    /**
     * @ORM\Column(type="json")
     */
    private $role = [];

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

    public function getRole(): array
    {
        return [self::ROLE_USER];
    }

    public function setRole(array $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getRoles()
    {
        $roles = $this->role;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
//        return [self::ROLE_USER];
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        return $this->email;
    }

//    public function __call(string $name, array $arguments)
//    {
//        // TODO: Implement @method string getUserIdentifier()
//    }
    public function getUserIdentifier(): string
    {
        return $this->id;
    }

    /**
     * @var string|null
     *
     * @ORM\Column(name="github_id", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $githubId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="github_access_token", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $githubAccessToken;
}
