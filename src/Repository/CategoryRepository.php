<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findByUserId($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneById($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findByMaxItem()
    {
        return $this->createQueryBuilder('c')
            ->select('c.title, c.id, count(i.category) as ItemCount')
            ->leftJoin('c.items', 'i')
            ->groupBy('c.id')
            ->orderBy('ItemCount', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

}
