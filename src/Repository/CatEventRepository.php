<?php

namespace App\Repository;

use App\Entity\CatEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CatEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatEvent[]    findAll()
 * @method CatEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatEvent::class);
    }

    // /**
    //  * @return CatEvent[] Returns an array of CatEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CatEvent
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
