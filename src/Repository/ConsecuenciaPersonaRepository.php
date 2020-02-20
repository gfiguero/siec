<?php

namespace App\Repository;

use App\Entity\ConsecuenciaPersona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ConsecuenciaPersona|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsecuenciaPersona|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConsecuenciaPersona[]    findAll()
 * @method ConsecuenciaPersona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsecuenciaPersonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsecuenciaPersona::class);
    }

    // /**
    //  * @return ConsecuenciaPersona[] Returns an array of ConsecuenciaPersona objects
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
    public function findOneBySomeField($value): ?ConsecuenciaPersona
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
