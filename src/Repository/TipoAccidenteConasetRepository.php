<?php

namespace App\Repository;

use App\Entity\TipoAccidenteConaset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoAccidenteConaset|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoAccidenteConaset|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoAccidenteConaset[]    findAll()
 * @method TipoAccidenteConaset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoAccidenteConasetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoAccidenteConaset::class);
    }

    // /**
    //  * @return TipoAccidenteConaset[] Returns an array of TipoAccidenteConaset objects
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
    public function findOneBySomeField($value): ?TipoAccidenteConaset
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
