<?php

namespace App\Repository;

use App\Entity\RegistroEtapa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RegistroEtapa|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegistroEtapa|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegistroEtapa[]    findAll()
 * @method RegistroEtapa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistroEtapaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegistroEtapa::class);
    }

    // /**
    //  * @return RegistroEtapa[] Returns an array of RegistroEtapa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RegistroEtapa
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
