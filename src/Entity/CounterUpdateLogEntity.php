<?php

namespace App\Entity;

use App\Repository\CounterUpdateLogEntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CounterUpdateLogEntityRepository::class)
 */
class CounterUpdateLogEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CounterEntity::class, inversedBy="counterUpdateLogs")
     */
    private $counter;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $timestamp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCounter(): ?CounterEntity
    {
        return $this->counter;
    }

    public function setCounter(?CounterEntity $counter): self
    {
        $this->counter = $counter;

        return $this;
    }

    public function getTimestamp(): ?string
    {
        return $this->timestamp;
    }

    public function setTimestamp(string $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }
}
