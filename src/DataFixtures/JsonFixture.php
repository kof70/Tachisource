<?php

namespace App\DataFixtures;

use App\Entity\Extension;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class JsonFixture extends Fixture
{
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager): void
    {
        $jsonFilePath = $this->params->get('json_file_path');
        $jsonContent = file_get_contents($jsonFilePath);
        $data = json_decode($jsonContent, true);

        foreach ($data as $item) {
            $entity = new Extension(); // Remplacez YourEntity par votre entité correspondante
            $entity->setapkName($item['nom'].'.apk');
            $entity->setUpdatedAd(new \DateTimeImmutable('now'));


            $manager->persist($entity);
        }

        $manager->flush();
    }
}