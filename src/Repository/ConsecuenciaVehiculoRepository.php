<?php

namespace App\Repository;

use App\Entity\ConsecuenciaVehiculo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ConsecuenciaVehiculo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsecuenciaVehiculo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConsecuenciaVehiculo[]    findAll()
 * @method ConsecuenciaVehiculo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsecuenciaVehiculoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsecuenciaVehiculo::class);
    }

    // /**
    //  * @return ConsecuenciaVehiculo[] Returns an array of ConsecuenciaVehiculo objects
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
    public function findOneBySomeField($value): ?ConsecuenciaVehiculo
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
