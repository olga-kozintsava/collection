<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Service\User\UserCreator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

//    public function createEntity(string $entityFqcn)
//    {
////        $this->userCreator->create();
//    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('email'),
//            TextField::new('getRoles')
//        'name',
//            'email',
//            'password',
//            'role'

        ];
    }

}
