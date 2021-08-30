<?php

namespace App\Repository;

use App\Entity\Like;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Like|null find($id, $lockMode = null, $lockVersion = null)
 * @method Like|null findOneBy(array $criteria, array $orderBy = null)
 * @method Like[]    findAll()
 * @method Like[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Like::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByUserAndItem($user_, $item_)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.user = :user_')
            ->andWhere('l.item = :item_')
            ->setParameter('user_', $user_)
            ->setParameter('item_', $item_)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findLikeCount($item)
    {
        return $this->createQueryBuilder('l')
            ->select('count(l) as likeCount')
            ->andWhere('l.item = :item')
            ->andWhere('l.isLike = :val')
            ->setParameter(':item', $item)
            ->setParameter(':val', true)
            ->groupBy('l.item')
            ->getQuery()
            ->getResult();


    }
}
