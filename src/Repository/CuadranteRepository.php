<?php

namespace App\Repository;

use App\Entity\Cuadrante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cuadrante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cuadrante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cuadrante[]    findAll()
 * @method Cuadrante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CuadranteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cuadrante::class);
    }

    // /**
    //  * @return Cuadrante[] Returns an array of Cuadrante objects
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
    public function findOneBySomeField($value): ?Cuadrante
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
