<?php

namespace App\Repository;

use App\Entity\EstadoAccidente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EstadoAccidente|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoAccidente|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoAccidente[]    findAll()
 * @method EstadoAccidente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoAccidenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoAccidente::class);
    }

    // /**
    //  * @return EstadoAccidente[] Returns an array of EstadoAccidente objects
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
    public function findOneBySomeField($value): ?EstadoAccidente
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
