<?php

namespace App\Repository;

use App\Entity\DireccionVehiculo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DireccionVehiculo|null find($id, $lockMode = null, $lockVersion = null)
 * @method DireccionVehiculo|null findOneBy(array $criteria, array $orderBy = null)
 * @method DireccionVehiculo[]    findAll()
 * @method DireccionVehiculo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DireccionVehiculoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DireccionVehiculo::class);
    }

    // /**
    //  * @return DireccionVehiculo[] Returns an array of DireccionVehiculo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DireccionVehiculo
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
