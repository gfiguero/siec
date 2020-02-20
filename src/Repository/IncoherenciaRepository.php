<?php

namespace App\Repository;

use App\Entity\Incoherencia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Incoherencia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Incoherencia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Incoherencia[]    findAll()
 * @method Incoherencia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IncoherenciaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Incoherencia::class);
    }

    // /**
    //  * @return Incoherencia[] Returns an array of Incoherencia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Incoherencia
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
