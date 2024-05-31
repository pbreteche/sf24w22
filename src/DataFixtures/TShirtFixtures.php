<?php

namespace App\DataFixtures;

use App\Entity\Enum\ClothSize;
use App\Entity\TShirt;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TShirtFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $factory = Factory::create('fr');

        $t = new TShirt();
        $t->setSize(ClothSize::Medium)
            ->setPrice($factory->numberBetween(990, 1990))
            ->setDescription($factory->text(120))
            ->setReferenceNumber($factory->regexify('[A-Z]{5}\d{3}'))
            ->setName($factory->company())
        ;

        $manager->persist($t);
        $manager->flush();
    }
}
