<?php

namespace App\Repository;

use App\Entity\Offre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offre[]    findAll()
 * @method Offre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offre::class);
    }
    public function tridesc(){
        $em=$this->getEntityManager();
        $query=$em->createQuery('select s from App\Entity\Offre s order by s.NomEntreprise DESC');
        return $query->getResult();
    }
    public function triasc(){
        $em=$this->getEntityManager();
        $query=$em->createQuery('select s from App\Entity\Offre s order by s.NomEntreprise ASC');
        return $query->getResult();
    }
    public function trisaldesc(){
        $em=$this->getEntityManager();
        $query=$em->createQuery('select s from App\Entity\Offre s order by s.Salaire DESC');
        return $query->getResult();
    }
    public function trisalasc(){
        $em=$this->getEntityManager();
        $query=$em->createQuery('select s from App\Entity\Offre s order by s.Salaire ASC');
        return $query->getResult();
    }
    // /**
    //  * @return Offre[] Returns an array of Offre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Offre
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
