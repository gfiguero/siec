<?php

namespace App\Repository;

use App\Entity\EtapaRegistro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EtapaRegistro|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtapaRegistro|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtapaRegistro[]    findAll()
 * @method EtapaRegistro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtapaRegistroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtapaRegistro::class);
    }

    // /**
    //  * @return EtapaRegistro[] Returns an array of EtapaRegistro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtapaRegistro
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
