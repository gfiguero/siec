<?php

namespace App\Repository;

use App\Entity\DemarcacionLineaCalzada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DemarcacionLineaCalzada|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemarcacionLineaCalzada|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemarcacionLineaCalzada[]    findAll()
 * @method DemarcacionLineaCalzada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemarcacionLineaCalzadaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemarcacionLineaCalzada::class);
    }

    // /**
    //  * @return DemarcacionLineaCalzada[] Returns an array of DemarcacionLineaCalzada objects
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
    public function findOneBySomeField($value): ?DemarcacionLineaCalzada
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
