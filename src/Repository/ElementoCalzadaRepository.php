<?php

namespace App\Repository;

use App\Entity\ElementoCalzada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ElementoCalzada|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElementoCalzada|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElementoCalzada[]    findAll()
 * @method ElementoCalzada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElementoCalzadaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElementoCalzada::class);
    }

    // /**
    //  * @return ElementoCalzada[] Returns an array of ElementoCalzada objects
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
    public function findOneBySomeField($value): ?ElementoCalzada
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
