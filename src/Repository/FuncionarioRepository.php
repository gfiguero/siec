<?php

namespace App\Repository;

use App\Entity\Funcionario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Funcionario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Funcionario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Funcionario[]    findAll()
 * @method Funcionario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FuncionarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Funcionario::class);
    }

    public function findAll()
    {
        return $this->createQueryBuilder('f')
            ->select('f, u, g')
            ->leftJoin('f.unidad', 'u')
            ->leftJoin('f.gradoCarabinero', 'g')
            ->getQuery();
    }
}
