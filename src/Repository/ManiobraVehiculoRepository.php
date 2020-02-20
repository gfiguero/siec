<?php

namespace App\Repository;

use App\Entity\ManiobraVehiculo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ManiobraVehiculo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ManiobraVehiculo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ManiobraVehiculo[]    findAll()
 * @method ManiobraVehiculo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ManiobraVehiculoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ManiobraVehiculo::class);
    }

    // /**
    //  * @return ManiobraVehiculo[] Returns an array of ManiobraVehiculo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ManiobraVehiculo
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
