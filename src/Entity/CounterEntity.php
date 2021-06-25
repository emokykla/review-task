<?php

namespace App\Entity;

use App\Repository\CounterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CounterRepository::class)
 */
class CounterEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $count = 0;

    /**
     * @ORM\OneToMany(targetEntity=CounterUpdateLogEntity::class, mappedBy="counter")
     */
    private $counterUpdateLogs;

    public function __construct()
    {
        $this->counterUpdateLogs = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return Collection|CounterUpdateLogEntity[]
     */
    public function getCounterUpdateLogs(): Collection
    {
        return $this->counterUpdateLogs;
    }

    public function addCounterUpdateLog(CounterUpdateLogEntity $counterUpdateLog): self
    {
        if (!$this->counterUpdateLogs->contains($counterUpdateLog)) {
            $this->counterUpdateLogs[] = $counterUpdateLog;
            $counterUpdateLog->setCounter($this);
        }

        return $this;
    }

    public function removeCounterUpdateLog(CounterUpdateLogEntity $counterUpdateLog): self
    {
        if ($this->counterUpdateLogs->removeElement($counterUpdateLog)) {
            // set the owning side to null (unless already changed)
            if ($counterUpdateLog->getCounter() === $this) {
                $counterUpdateLog->setCounter(null);
            }
        }

        return $this;
    }
}
