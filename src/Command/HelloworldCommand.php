<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:helloworld',
    description: 'First command to show config / inputs',
)]
class HelloworldCommand extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('your-name', InputArgument::OPTIONAL, 'Tell us your name, so we can say hello to you.', 'World')
            ->addOption('case', 'c', InputOption::VALUE_REQUIRED, 'Define case transformation')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('your-name');
        $c = $input->getOption('case');
        if (!$c) {
            $c = $io->askQuestion(
                new ChoiceQuestion('Souhaitez-vous un changement de casse ?', [
                    'u' => 'Casse haute',
                    'l' => 'Casse basse',
                    'n' => 'pas de changement',
                ])
            );
        }

        $name = match ($c) {
            'u' => strtoupper($name),
            'l' => strtolower($name),
            default => $name,
        };

        $io->success(sprintf('Hello %s', $name));

        return Command::SUCCESS;
    }
}
