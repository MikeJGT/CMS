<?php

namespace App\Repository;

use App\Entity\FullCalendar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FullCalendar>
 *
 * @method FullCalendar|null find($id, $lockMode = null, $lockVersion = null)
 * @method FullCalendar|null findOneBy(array $criteria, array $orderBy = null)
 * @method FullCalendar[]    findAll()
 * @method FullCalendar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FullCalendarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FullCalendar::class);
    }

    public function getAllEvents():array
    {
        return $this->createQueryBuilder('q')
            ->select('q.title, q.start, q.final_date as end')
            ->getQuery()
            ->getResult();

            //Literal con EntityManager y Entity FullCalendar 
            // return $em->createQuery('select q.title, q.start, q.final_date as end from App\Entity\FullCalendar q')
            // // ->select('q.title, q.start, q.final_date as end')
            // // ->getQuery()
            // ->getResult();
    }
//    /**
//     * @return FullCalendar[] Returns an array of FullCalendar objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FullCalendar
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
