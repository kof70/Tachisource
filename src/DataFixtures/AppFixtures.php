<?php

namespace App\DataFixtures;

use App\Entity\Langue;
use App\Entity\TypeExtension;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new Utilisateur();

        $user->setUsername('admin');
        $user->setPassword('$2y$13$peRq/KiopZfPtGrAc8LsP.0tSCiz7Qhbu8.Q4iyE2wsgwayePboKC');
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);

        $user1 = new Utilisateur();
        $user1->setUsername('user');
        $user1->setPassword('$2y$13$bhZoyHUotN2hyxfzLlsN1eq5sBw21dbya.FYdmLoFOQeTRiv/8l4K');
        $user1->setRoles(['ROLE_USER']);

        $manager->persist($user1);

        $langue = new Langue();

        $langue->setLangue('fr');

        $manager->persist($langue);

        $langue1 = new Langue();

        $langue1->setLangue('en');

        $manager->persist($langue1);

        $type = new TypeExtension();
        $type->setTitre('Hentai');

        $manager->persist($type);

        $type1 = new TypeExtension();
        $type1->setTitre('Ecchi');

        $manager->persist($type1);

        $type2 = new TypeExtension();
        $type2->setTitre('Yaoi');

        $manager->persist($type2);

        $manager->flush();
    }
}
