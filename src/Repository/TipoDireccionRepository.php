<?php

namespace App\Repository;

use App\Entity\TipoDireccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoDireccion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoDireccion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoDireccion[]    findAll()
 * @method TipoDireccion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoDireccionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoDireccion::class);
    }

    // /**
    //  * @return TipoDireccion[] Returns an array of TipoDireccion objects
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
    public function findOneBySomeField($value): ?TipoDireccion
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
