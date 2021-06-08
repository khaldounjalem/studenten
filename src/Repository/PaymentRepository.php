<?php

namespace App\Repository;

use App\Entity\Payment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Payment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Payment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Payment[]    findAll()
 * @method Payment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }

    public function findAllStudent(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT student.id, student.fullname, student.father, student.mother
        FROM student
                 ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAllAssociative();
    }

    public function findAllfromto(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT student.fullname, student.father, payment.id, payment.amount, payment.numpayment, payment.notes, payment.type, payment.created_at, payment.updated_at, payment.artcours, payment.status
        FROM student INNER JOIN payment ON student.id = payment.student_id
                 ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAllAssociative();
    }    




    /**
     * Returns Payment between 2 dates
     */
    public function getByDate($from= null, $to = null, $mots = null){

        // $query = $this->createQueryBuilder('a')
        //     ->where('a.createdAt >= :from')
        //     ->andWhere('a.createdAt <= :to')
        //     ->setParameter(':from', $from)
        //     ->setParameter(':to', $to);
        //      $query->getQuery()->getResult();
        // return $query->getQuery()->getResult();



        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT student.fullname, student.father, payment.id, payment.amount, payment.numpayment, payment.notes, payment.type, payment.created_at, payment.updated_at, payment.artcours, payment.status
        FROM student LEFT JOIN payment ON student.id = payment.student_id
            WHERE ((payment.created_at) >= :from And (payment.created_at) <= :to ) And ((student.fullname) LIKE :mots or (payment.numpayment) LIKE :mots or (payment.amount) LIKE :mots)
            ';
        $stmt = $conn->prepare($sql);
            
        $stmt->execute(
               [
                    'from' => $from->format('Y-m-d H:i:s'),
                    'to' => $to->format('Y-m-d H:i:s'),
                    'mots' => '%'.$mots.'%'
               ]
            );        

        $sql1 = 'DELETE FROM paymentstock';
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
            
        $sql2 = '
        INSERT INTO paymentstock ( fullname,amount, numpayment, notes, type, created_at, updated_at, artcours, status, student_id )
        SELECT student.fullname, payment.amount, payment.numpayment, payment.notes, payment.type, payment.created_at, payment.updated_at, payment.artcours, payment.status, payment.student_id
        FROM student LEFT JOIN payment ON student.id = payment.student_id
        WHERE ((payment.created_at) >= :from And (payment.created_at) <= :to ) And ((student.fullname) LIKE :mots or (payment.numpayment) LIKE :mots or (payment.amount) LIKE :mots)
            ';
        $stmt2 = $conn->prepare($sql2);
            
        $stmt2->execute(
               [
                    'from' => $from->format('Y-m-d H:i:s'),
                    'to' => $to->format('Y-m-d H:i:s'),
                    'mots' => '%'.$mots.'%'                    
               ]
            );
            
            return $stmt->fetchAllAssociative();        
    }

 

  

    // /**
    //  * @return Payment[] Returns an array of Payment objects
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
    public function findOneBySomeField($value): ?Payment
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
