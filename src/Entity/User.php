<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

///**
// * @ORM\Entity(repositoryClass=UserRepository::class)
// *
// */
/**
 * @ORM\Entity()
 *
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(string $name, string $email, string $password){

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    private const ROLE_USER = 'ROLE_USER';
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
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
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

//    public function setName(string $name): self
//    {
//        $this->name = $name;
//
//        return $this;
//    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

//    public function setEmail(string $email): self
//    {
//        $this->email = $email;
//
//        return $this;
//    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

//    public function setPassword(string $password): self
//    {
//        $this->password = $password;
//
//        return $this;
//    }

    public function getRole(): array
    {

    }

//    public function setRole(array $role): self
//    {
//        $this->role = $role;
//
//        return $this;
//    }

    public function getRoles()
    {
        return [self::ROLE_USER];
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
}
