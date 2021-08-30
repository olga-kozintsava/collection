<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private EntityManagerInterface $entityManager;
    private PasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, PasswordHasherFactoryInterface $hasherFactory)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $hasherFactory->getPasswordHasher(User::class);
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['addUser'],
            BeforeEntityUpdatedEvent::class => ['updateUser'],
        ];
    }

    public function updateUser(BeforeEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if (!($entity instanceof User)) {
            return;
        }
        $this->setPassword($entity);
    }

    public function addUser(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();
        if (!($entity instanceof User)) {
            return;
        }
        $this->setPassword($entity);
    }

    /**
     * @param User $entity
     */
    public function setPassword(User $entity): void
    {
        $pass = $entity->getPassword();
        $entity->setPassword(
            $this->passwordHasher->hash($pass)
        );
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

}
