<?php

namespace App\Repository;

use App\Entity\AverageType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AverageType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AverageType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AverageType[]    findAll()
 * @method AverageType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AverageTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AverageType::class);
    }

    // /**
    //  * @return AverageType[] Returns an array of AverageType objects
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
    public function findOneBySomeField($value): ?AverageType
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
