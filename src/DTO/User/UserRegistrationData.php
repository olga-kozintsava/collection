<?php

declare(strict_types=1);

namespace App\DTO\User;

use App\Validator as AcmeAssert;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegistrationData
{
    /**
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     * @var string
     *
     */
    public string $name;

    /**
     * @Assert\NotBlank
     * @Assert\Email(mode="strict")
     * @Assert\Type("string")
     *
     * @var string
     */
    public string $email;

    /**
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(min=10)
     *
     * @var string
     *
     */
    public string $password;
}