<?php

namespace App\Repository;

use App\Entity\CondicionPavimentoCalzada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CondicionPavimentoCalzada|null find($id, $lockMode = null, $lockVersion = null)
 * @method CondicionPavimentoCalzada|null findOneBy(array $criteria, array $orderBy = null)
 * @method CondicionPavimentoCalzada[]    findAll()
 * @method CondicionPavimentoCalzada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CondicionPavimentoCalzadaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CondicionPavimentoCalzada::class);
    }

    // /**
    //  * @return CondicionPavimentoCalzada[] Returns an array of CondicionPavimentoCalzada objects
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
    public function findOneBySomeField($value): ?CondicionPavimentoCalzada
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
