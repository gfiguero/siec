<?php

namespace App\Repository;

use App\Entity\EstadoLuzArtificial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EstadoLuzArtificial|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadoLuzArtificial|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadoLuzArtificial[]    findAll()
 * @method EstadoLuzArtificial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadoLuzArtificialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadoLuzArtificial::class);
    }

    // /**
    //  * @return EstadoLuzArtificial[] Returns an array of EstadoLuzArtificial objects
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
    public function findOneBySomeField($value): ?EstadoLuzArtificial
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
