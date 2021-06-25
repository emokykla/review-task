<?php

namespace App\Repository;

use App\Entity\CounterUpdateLogEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CounterUpdateLogEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CounterUpdateLogEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CounterUpdateLogEntity[]    findAll()
 * @method CounterUpdateLogEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CounterUpdateLogEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CounterUpdateLogEntity::class);
    }
}
