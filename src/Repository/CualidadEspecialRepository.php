<?php

namespace App\Repository;

use App\Entity\CualidadEspecial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CualidadEspecial|null find($id, $lockMode = null, $lockVersion = null)
 * @method CualidadEspecial|null findOneBy(array $criteria, array $orderBy = null)
 * @method CualidadEspecial[]    findAll()
 * @method CualidadEspecial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CualidadEspecialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CualidadEspecial::class);
    }

    // /**
    //  * @return CualidadEspecial[] Returns an array of CualidadEspecial objects
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
    public function findOneBySomeField($value): ?CualidadEspecial
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
