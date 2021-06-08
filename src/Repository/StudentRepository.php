<?php

namespace App\Repository;

use App\Entity\Course;
use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    // /**
    //  * Recherche les students en fonction du formulaire
    //  * @return void 
    //  */

    public function findAllresult(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT student.id, student.fullname, student.father, course.namecourse, studentdetaill.degree, studentdetaill.result, student.status, student.telephone, student.dateofbirth, student.numstudent 
        FROM ((student LEFT JOIN studentdetaill ON student.id = studentdetaill.student_id) INNER JOIN course_studentdetaill ON studentdetaill.id = course_studentdetaill.studentdetaill_id) INNER JOIN course ON course_studentdetaill.course_id = course.id
                 ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAllAssociative();
    } 
   


    public function search($mots = null){
        $query = $this->createQueryBuilder('a');
        $query->where('a.status = 1');
        if(($mots != null) and $mots !='*' and $mots !='+' and $mots !='-' and $mots !='(' and $mots !=')'){
            $query->andWhere('MATCH_AGAINST(a.fullname, a.dateofbirth, a.telephone, a.numstudent  ) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);
        }
        return $query->getQuery()->getResult();
    }

    public function searchResult($mots = null){
        $query = $this->createQueryBuilder('a');
        $query->where('a.status = 1');
        if(($mots != null) and $mots !='*' and $mots !='+' and $mots !='-' and $mots !='(' and $mots !=')'){
            $query->andWhere('MATCH_AGAINST(a.fullname, a.dateofbirth, a.telephone, a.numstudent  ) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);

        return $query->getQuery()->getResult();
        }
        else return false;    
    }





    // public function findBySearch(string $value, Course $course)

    // {
    // return $this->createQueryBuilder('a')
    //     ->where('a.course = :course')
    //     ->andWhere('a.id LIKE :value')
    //  //   ->orWhere('a.description LIKE :value')
    //     ->setParameters([
    //         'value' => $value,
    //         'course' => $course
    //     ])
    //     ->getQuery()
    //     ->getResult();

    //     }

    public function findAllCourse(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT student.id, studentdetaill.id AS idstudentdetaill, course.id AS idcourse, studentdetaill.numpage, studentdetaill.degree, studentdetaill.result, studentdetaill.numgeneral, studentdetaill.student_id, course.namecourse, course.numcourse, course.numdetaillcourse, course.startdate, course.day, course.time, course.teacher, course.price, course.enddate, course.numlessons, student.numstudent
        FROM ((student LEFT JOIN studentdetaill ON student.id = studentdetaill.student_id) INNER JOIN course_studentdetaill ON studentdetaill.id = course_studentdetaill.studentdetaill_id) INNER JOIN course ON course_studentdetaill.course_id = course.id
        WHERE (((student.id)=:id))
                 ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAllAssociative();
    }


    public function findAllTotalPreis(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT student.id, Sum(course.price) AS SumOfprice
        FROM ((student LEFT JOIN studentdetaill ON student.id = studentdetaill.student_id) INNER JOIN course_studentdetaill ON studentdetaill.id = course_studentdetaill.studentdetaill_id) INNER JOIN course ON course_studentdetaill.course_id = course.id
        GROUP BY student.id   
        HAVING (((student.id)=:id));
                 ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAllAssociative();
    }

    public function findAllTotalPayment(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT student.id, Sum(payment.amount) AS SumOfamount
        FROM student LEFT JOIN payment ON student.id = payment.student_id
        GROUP BY student.id
        HAVING (((student.id)=:id));
                 ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAllAssociative();
    }

    public function findAllPayment(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT student.id, student.fullname, student.father, payment.amount, payment.numpayment, payment.created_at, student.numstudent
        FROM student LEFT JOIN payment ON student.id = payment.student_id
        WHERE (((student.id)=:id))
                 ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAllAssociative();
    }

   

    // /**
    //  * @return Student[] Returns an array of Student objects
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
    public function findOneBySomeField($value): ?Student
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
