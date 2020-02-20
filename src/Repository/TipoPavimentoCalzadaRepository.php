<?php

namespace App\Repository;

use App\Entity\TipoPavimentoCalzada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoPavimentoCalzada|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoPavimentoCalzada|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoPavimentoCalzada[]    findAll()
 * @method TipoPavimentoCalzada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoPavimentoCalzadaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoPavimentoCalzada::class);
    }

    // /**
    //  * @return TipoPavimentoCalzada[] Returns an array of TipoPavimentoCalzada objects
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
    public function findOneBySomeField($value): ?TipoPavimentoCalzada
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
