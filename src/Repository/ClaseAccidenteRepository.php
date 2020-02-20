<?php

namespace App\Repository;

use App\Entity\ClaseAccidente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ClaseAccidente|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClaseAccidente|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClaseAccidente[]    findAll()
 * @method ClaseAccidente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClaseAccidenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClaseAccidente::class);
    }

    // /**
    //  * @return ClaseAccidente[] Returns an array of ClaseAccidente objects
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
    public function findOneBySomeField($value): ?ClaseAccidente
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
