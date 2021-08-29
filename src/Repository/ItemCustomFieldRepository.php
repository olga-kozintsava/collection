<?php

namespace App\Repository;

use App\Entity\ItemCustomField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItemCustomField|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemCustomField|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemCustomField[]    findAll()
 * @method ItemCustomField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemCustomFieldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemCustomField::class);
    }

    // /**
    //  * @return ItemCustomField[] Returns an array of ItemCustomField objects
    //  */

    public function findByItemId($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.item = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?ItemCustomField
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
