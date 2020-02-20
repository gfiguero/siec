<?php

namespace App\Repository;

use App\Entity\EstadoPavimentoCalzada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EstadoPavimentoCalzada|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoPavimentoCalzada|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoPavimentoCalzada[]    findAll()
 * @method EstadoPavimentoCalzada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoPavimentoCalzadaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoPavimentoCalzada::class);
    }

    // /**
    //  * @return EstadoPavimentoCalzada[] Returns an array of EstadoPavimentoCalzada objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EstadoPavimentoCalzada
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
