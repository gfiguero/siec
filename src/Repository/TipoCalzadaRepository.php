<?php

namespace App\Repository;

use App\Entity\TipoCalzada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoCalzada|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoCalzada|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoCalzada[]    findAll()
 * @method TipoCalzada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoCalzadaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoCalzada::class);
    }

    // /**
    //  * @return TipoCalzada[] Returns an array of TipoCalzada objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoCalzada
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
