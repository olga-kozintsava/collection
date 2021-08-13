<?php

namespace App\Service\User;

use App\DTO\User\UserRegistrationData;
use App\Entity\User;

class UserCreator
{
public function create(UserRegistrationData $data): User
{
   return new User($data->name, $data->email, $data->password);
}
}