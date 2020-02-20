<?php

namespace App\Repository;

use App\Entity\DemarcacionPrioridadCalzada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DemarcacionPrioridadCalzada|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemarcacionPrioridadCalzada|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemarcacionPrioridadCalzada[]    findAll()
 * @method DemarcacionPrioridadCalzada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemarcacionPrioridadCalzadaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemarcacionPrioridadCalzada::class);
    }

    // /**
    //  * @return DemarcacionPrioridadCalzada[] Returns an array of DemarcacionPrioridadCalzada objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DemarcacionPrioridadCalzada
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
