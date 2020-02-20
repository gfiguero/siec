<?php

namespace App\Repository;

use App\Entity\SituacionPersona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SituacionPersona|null find($id, $lockMode = null, $lockVersion = null)
 * @method SituacionPersona|null findOneBy(array $criteria, array $orderBy = null)
 * @method SituacionPersona[]    findAll()
 * @method SituacionPersona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SituacionPersonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SituacionPersona::class);
    }

    // /**
    //  * @return SituacionPersona[] Returns an array of SituacionPersona objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SituacionPersona
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
