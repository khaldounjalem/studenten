<?php

namespace App\Repository;

use App\Entity\Course;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Course|null find($id, $lockMode = null, $lockVersion = null)
 * @method Course|null findOneBy(array $criteria, array $orderBy = null)
 * @method Course[]    findAll()
 * @method Course[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Course::class);
    }
    public function searchCourseindex($mots = null){
        $query = $this->createQueryBuilder('a');
        if($mots != null and $mots !='*' and $mots !='+' and $mots !='-' and $mots !='(' and $mots !=')'){
           $query->Where('MATCH_AGAINST(a.numcourse, a.namecourse ) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);

        return $query->getQuery()->getResult();
        }
    }
    public function searchCourse($mots = null){
        $query = $this->createQueryBuilder('a');
        if($mots != null and $mots !='*' and $mots !='+' and $mots !='-' and $mots !='(' and $mots !=')'){
           $query->Where('MATCH_AGAINST(a.numcourse) AGAINST (:mots boolean)>0')
                ->setParameter('mots', $mots);

        return $query->getQuery()->getResult();
        }
        else return false;    
    }

    public function findAllsearchCourse(): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        SELECT course.id, student.fullname, student.numstudent, student.telephone 
        FROM ((student LEFT JOIN studentdetaill ON student.id = studentdetaill.student_id) LEFT JOIN course_studentdetaill ON studentdetaill.id = course_studentdetaill.studentdetaill_id) LEFT JOIN course ON course_studentdetaill.course_id = course.id
                 ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAllAssociative();
    }
    
    public function findAllsearchCoursedata(int $id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
        SELECT course.id, course.namecourse, course.numcourse, course.numdetaillcourse, course.startdate, course.day, course.time, course.teacher, course.price, course.enddate, course.numlessons
        FROM course
        WHERE (((course.id)=:id))
                 ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAllAssociative();
    }    

    // /**
    //  * @return Course[] Returns an array of Course objects
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
    public function findOneBySomeField($value): ?Course
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
