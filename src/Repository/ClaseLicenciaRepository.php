<?php

namespace App\Repository;

use App\Entity\ClaseLicencia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ClaseLicencia|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClaseLicencia|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClaseLicencia[]    findAll()
 * @method ClaseLicencia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClaseLicenciaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClaseLicencia::class);
    }

    // /**
    //  * @return ClaseLicencia[] Returns an array of ClaseLicencia objects
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
    public function findOneBySomeField($value): ?ClaseLicencia
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
