<?php

namespace App\Repository;

use App\Entity\TipoUbicacionRelativaAccidente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoUbicacionRelativaAccidente|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoUbicacionRelativaAccidente|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoUbicacionRelativaAccidente[]    findAll()
 * @method TipoUbicacionRelativaAccidente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoUbicacionRelativaAccidenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoUbicacionRelativaAccidente::class);
    }

    // /**
    //  * @return TipoUbicacionRelativaAccidente[] Returns an array of TipoUbicacionRelativaAccidente objects
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
    public function findOneBySomeField($value): ?TipoUbicacionRelativaAccidente
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
