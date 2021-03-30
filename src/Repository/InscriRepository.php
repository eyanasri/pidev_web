<?php

namespace App\Repository;

use App\Entity\Inscri;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Inscri|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inscri|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inscri[]    findAll()
 * @method Inscri[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Inscri::class);
    }

    // /**
    //  * @return Inscri[] Returns an array of Inscri objects
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
    public function findOneBySomeField($value): ?Inscri
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
