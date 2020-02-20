<?php

namespace App\Repository;

use App\Entity\UbicacionAccidente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UbicacionAccidente|null find($id, $lockMode = null, $lockVersion = null)
 * @method UbicacionAccidente|null findOneBy(array $criteria, array $orderBy = null)
 * @method UbicacionAccidente[]    findAll()
 * @method UbicacionAccidente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UbicacionAccidenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UbicacionAccidente::class);
    }

    // /**
    //  * @return UbicacionAccidente[] Returns an array of UbicacionAccidente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UbicacionAccidente
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
