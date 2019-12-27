<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Nelmio\Alice\Loader\NativeLoader;

class AliceBundleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {        
        $faker = Factory::create('fr_FR');
        $loader = new NativeLoader($faker);
        
        //importe le fichier de fixtures et récupère les entités générés
        $entities = $loader->loadFile(__DIR__.'/fixtures.yaml')->getObjects();
        
        //empile la liste d'objet à enregistrer en BDD
        foreach ($entities as $entity) {
            $manager->persist($entity);
        };
        
        //enregistre
        $manager->flush();
    }
}
