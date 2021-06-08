<?php

namespace App\Repository;

use App\Entity\Paymentstock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Paymentstock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paymentstock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paymentstock[]    findAll()
 * @method Paymentstock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentstockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paymentstock::class);
    }

 
    // /**
    //  * @return Paymentstock[] Returns an array of Paymentstock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Paymentstock
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
