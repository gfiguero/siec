<?php

namespace App\Repository;

use App\Entity\CondicionFisica;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CondicionFisica|null find($id, $lockMode = null, $lockVersion = null)
 * @method CondicionFisica|null findOneBy(array $criteria, array $orderBy = null)
 * @method CondicionFisica[]    findAll()
 * @method CondicionFisica[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CondicionFisicaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CondicionFisica::class);
    }

    // /**
    //  * @return CondicionFisica[] Returns an array of CondicionFisica objects
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
    public function findOneBySomeField($value): ?CondicionFisica
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
