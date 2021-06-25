<?php

namespace App\Repository;

use App\Entity\CounterEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CounterEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CounterEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CounterEntity[]    findAll()
 * @method CounterEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CounterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CounterEntity::class);
    }
}
