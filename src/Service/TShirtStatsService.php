<?php

namespace App\Service;

use App\Repository\TShirtRepository;

readonly class TShirtStatsService
{
    public function __construct(
        private TShirtRepository $repository,
    ) {
    }

    public function getStats(): array
    {
        return $this->repository->getStatsBySize();
    }
}