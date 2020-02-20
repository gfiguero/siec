<?php

namespace App\Repository;

use App\Entity\EstadoAtmosferico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EstadoAtmosferico|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoAtmosferico|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoAtmosferico[]    findAll()
 * @method EstadoAtmosferico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoAtmosfericoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoAtmosferico::class);
    }

    // /**
    //  * @return EstadoAtmosferico[] Returns an array of EstadoAtmosferico objects
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
    public function findOneBySomeField($value): ?EstadoAtmosferico
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
