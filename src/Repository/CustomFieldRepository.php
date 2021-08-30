<?php

namespace App\Repository;

use App\Entity\CustomField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CustomField|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomField|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomField[]    findAll()
 * @method CustomField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomField::class);
    }

    public function findByCategory($value)
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.categories', 'f')
            ->andWhere('f.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult();
    }
}
