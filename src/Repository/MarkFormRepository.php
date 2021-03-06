<?php

namespace App\Repository;

use App\Entity\MarkForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MarkForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarkForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarkForm[]    findAll()
 * @method MarkForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarkFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarkForm::class);
    }

    // /**
    //  * @return MarkForm[] Returns an array of MarkForm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MarkForm
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
