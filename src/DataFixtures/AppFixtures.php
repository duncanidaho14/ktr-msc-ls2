<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Library;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();

        for ($us=0; $us < 10; $us++) { 
            $user = new User();
            $user->setName($faker->name())
                    ->setCompany($faker->company())
                    ->setTelephone($faker->phoneNumber())
                    ->setEmail($faker->email())
                    ->setPassword($this->encoder->hashPassword($user, 'password'))
            ;
            $manager->persist($user);
        }

        for ($lib=0; $lib < 20; $lib++) { 
            $library = new Library();
            $library->setName($faker->name())
                    ->setCompany($faker->company())
                    ->setTelephone($faker->phoneNumber())
                    ->setEmail($faker->email())
            ;
            $manager->persist($library);
        }
        $manager->flush();
    }
}
