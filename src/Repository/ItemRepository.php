<?php

namespace App\Repository;

use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\This;

/**
 * @method Item|null find($id, $lockMode = null, $lockVersion = null)
 * @method Item|null findOneBy(array $criteria, array $orderBy = null)
 * @method Item[]    findAll()
 * @method Item[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);
    }

    // /**
    //  * @return Item[] Returns an array of Item objects
    //  */

    public function findByCategory($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.category = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    public function findOneById($value): ?Item
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findByLastAdded(): array
    {
        return $this->createQueryBuilder('i')
            ->orderBy('i.dateCreate')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
}
