<?php

namespace App\Repository;

use App\Entity\CalidadPersona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CalidadPersona|null find($id, $lockMode = null, $lockVersion = null)
 * @method CalidadPersona|null findOneBy(array $criteria, array $orderBy = null)
 * @method CalidadPersona[]    findAll()
 * @method CalidadPersona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalidadPersonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CalidadPersona::class);
    }

    // /**
    //  * @return CalidadPersona[] Returns an array of CalidadPersona objects
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
    public function findOneBySomeField($value): ?CalidadPersona
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
