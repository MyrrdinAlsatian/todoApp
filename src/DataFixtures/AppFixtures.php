<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct( private UserPasswordHasherInterface $hasher)
    {
        
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        
        $admin1= new User();
        $admin1->setUsername("Myrrdin")
        ->setPassword($this->hasher->hashPassword($admin1, 'password'))
        ->setRoles(['ROLE_ADMIN'])
        ->setEmail('Stephan.jeanba@gmail.com');
        $manager->persist($admin1);

        $user1 = new User();
        $user1->setUsername("Arthurius")
        ->setPassword($this->hasher->hashPassword($user1, 'password'))
        ->setEmail('john.doe@unchained.com');
        $manager->persist($user1);

        $manager->flush();


    }
}
