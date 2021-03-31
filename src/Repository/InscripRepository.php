<?php

namespace App\Repository;

use App\Entity\Inscrip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Inscrip|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inscrip|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inscrip[]    findAll()
 * @method Inscrip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inscrip::class);
    }

    // /**
    //  * @return Inscrip[] Returns an array of Inscrip objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Inscrip
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
