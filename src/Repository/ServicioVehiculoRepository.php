<?php

namespace App\Repository;

use App\Entity\ServicioVehiculo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ServicioVehiculo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServicioVehiculo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServicioVehiculo[]    findAll()
 * @method ServicioVehiculo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicioVehiculoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServicioVehiculo::class);
    }

    // /**
    //  * @return ServicioVehiculo[] Returns an array of ServicioVehiculo objects
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
    public function findOneBySomeField($value): ?ServicioVehiculo
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
