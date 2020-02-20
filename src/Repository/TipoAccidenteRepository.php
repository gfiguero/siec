<?php

namespace App\Repository;

use App\Entity\TipoAccidente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoAccidente|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoAccidente|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoAccidente[]    findAll()
 * @method TipoAccidente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoAccidenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoAccidente::class);
    }

//    public function findByClaseAccidente($claseAccidente)
//    {
//        return $this->createQueryBuilder('ta')
//            ->andWhere('ta.claseAccidente = :claseAccidente')
//            ->setParameter('claseAccidente', $claseAccidente)
//            ->orderBy('ta.codigo', 'ASC')
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    // /**
    //  * @return TipoAccidente[] Returns an array of TipoAccidente objects
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
    public function findOneBySomeField($value): ?TipoAccidente
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
