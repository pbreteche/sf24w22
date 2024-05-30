<?php

namespace App\Repository;

use App\Entity\TShirt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TShirt>
 */
class TShirtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TShirt::class);
    }

    public function getStatsBySize(): array
    {
        return $this->createQueryBuilder('tshirt')
            ->select(['tshirt.size', 'COUNT(tshirt)', 'AVG(tshirt.price)'])
            ->groupBy('tshirt.size')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findNamesStartingWith(string $userInput): array
    {
        return $this->createQueryBuilder('tshirt')
            ->select('DISTINCT(tshirt.name)')
            ->andWhere('tshirt.name LIKE :pattern')
            ->setParameter('pattern', $userInput.'%')
            ->getQuery()
            ->getSingleColumnResult()
        ;
    }
}
