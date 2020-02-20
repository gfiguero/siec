<?php

namespace App\Repository;

use App\Entity\TipoTrayecto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoTrayecto|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoTrayecto|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoTrayecto[]    findAll()
 * @method TipoTrayecto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoTrayectoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoTrayecto::class);
    }

    // /**
    //  * @return TipoTrayecto[] Returns an array of TipoTrayecto objects
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
    public function findOneBySomeField($value): ?TipoTrayecto
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
