<?php

namespace App\Command;

use App\Repository\TShirtRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:tshirt-detail',
    description: 'Display t-shirt detail',
)]
class TshirtDetailCommand extends Command
{
    public function __construct(
        private readonly TShirtRepository $repository,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $q = new Question('Quel est le nom du t-shirt');
        $q->setAutocompleterCallback($this->repository->findNamesStartingWith(...));

        $tShirtName = $io->askQuestion($q);

        $tShirt = $this->repository->findOneBy(['name' => $tShirtName]);

        $io->info($tShirt->getName());
        $io->writeln($tShirt->getReferenceNumber());

        return Command::SUCCESS;
    }
}
