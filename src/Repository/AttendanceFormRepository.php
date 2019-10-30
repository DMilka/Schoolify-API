<?php

namespace App\Repository;

use App\Entity\AttendanceForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AttendanceForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttendanceForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttendanceForm[]    findAll()
 * @method AttendanceForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttendanceFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttendanceForm::class);
    }

    // /**
    //  * @return AttendanceForm[] Returns an array of AttendanceForm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AttendanceForm
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
