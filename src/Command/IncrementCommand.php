<?php

namespace App\Command;

use App\Entity\CounterUpdateLogEntity;
use App\Service\CounterManagerService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:increment',
    description: 'Increments counter desired amount of times',
)]
class IncrementCommand extends Command
{
    private CounterManagerService $counterManagerService;
    private EntityManagerInterface $entityManager;

    public function __construct(CounterManagerService $counterManagerService, EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->counterManagerService = $counterManagerService;
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this->addArgument('amountOfIncrements', InputArgument::REQUIRED, 'How many times?');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('amountOfIncrements');
        for ($i = 0; $i < $arg1; $i++) {
            $this->counterManagerService->incrementCounter();
            $log = (new CounterUpdateLogEntity())
                ->setCounter($this->counterManagerService->counter)
                ->setTimestamp((new DateTime())->format('Y-m-d H:i:s'));
            $this->entityManager->persist($log);
        }
        $this->entityManager->flush();

        $io->success("You have incremented counter {$arg1} times.");

        return Command::SUCCESS;
    }
}
