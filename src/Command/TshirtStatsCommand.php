<?php

namespace App\Command;

use App\Repository\TShirtRepository;
use App\Service\TShirtStatsService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:tshirt-stats',
    description: 'Display stats table for t-shirt data',
)]
class TshirtStatsCommand extends Command
{
    public function __construct(
        private readonly TShirtStatsService $statsService,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $stats = $this->statsService->getStats();

        $io->title('Stats des t-shirt par taille');

        $table = new Table($output);
        $table->setHeaders(['Taille', 'Quantité', 'Tarif moyen']);
        array_map(fn ($stat) => $table->addRow([$stat['size']->value, $stat[1], $stat[2]]), $stats);
        $table->render();

        return Command::SUCCESS;
    }
}
