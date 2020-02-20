<?php

namespace App\Repository;

use App\Entity\TipoLuminosidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoLuminosidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoLuminosidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoLuminosidad[]    findAll()
 * @method TipoLuminosidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoLuminosidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoLuminosidad::class);
    }

    // /**
    //  * @return TipoLuminosidad[] Returns an array of TipoLuminosidad objects
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
    public function findOneBySomeField($value): ?TipoLuminosidad
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
