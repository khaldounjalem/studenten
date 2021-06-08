<?php

namespace App\Repository;

use App\Entity\Studentdetaill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Studentdetaill|null find($id, $lockMode = null, $lockVersion = null)
 * @method Studentdetaill|null findOneBy(array $criteria, array $orderBy = null)
 * @method Studentdetaill[]    findAll()
 * @method Studentdetaill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentdetaillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Studentdetaill::class);
    }

    // /**
    //  * @return Studentdetaill[] Returns an array of Studentdetaill objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Studentdetaill
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
