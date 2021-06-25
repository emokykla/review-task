<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\CounterEntity;
use App\Repository\CounterRepository;
use Doctrine\ORM\EntityManagerInterface;

class CounterManagerService
{
    public CounterEntity $counter;
    private EntityManagerInterface $entityManager;

    public function __construct(CounterRepository $counterRepository, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        if (null !== $counter = $counterRepository->findOneBy([]))
        {
            $this->counter = $counter;
        } else
        {
            $this->counter = $this->createCounter();
        }
    }

    public function incrementCounter(): void
    {
        $this->counter->setCount($this->counter->getCount() + 1);
        $this->entityManager->flush();
    }

    private function createCounter(): CounterEntity
    {
        $counter = new CounterEntity();
        $this->entityManager->persist($counter);
        $this->entityManager->flush();

        return $counter;
    }
}
