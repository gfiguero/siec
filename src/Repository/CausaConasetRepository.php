<?php

namespace App\Repository;

use App\Entity\CausaConaset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CausaConaset|null find($id, $lockMode = null, $lockVersion = null)
 * @method CausaConaset|null findOneBy(array $criteria, array $orderBy = null)
 * @method CausaConaset[]    findAll()
 * @method CausaConaset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CausaConasetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CausaConaset::class);
    }

    // /**
    //  * @return CausaConaset[] Returns an array of CausaConaset objects
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
    public function findOneBySomeField($value): ?CausaConaset
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
