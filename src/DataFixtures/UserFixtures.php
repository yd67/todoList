<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @codeCoverageIgnore
 */
class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->passwordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User() ;
        $user->setUsername('test98');
        $user->setEmail('test98@gmail.com');
        $user->setPassword($this->passwordHasher->hashPassword($user,'test'));

        $adminUser = new User();
        $adminUser->setUsername('admin98');
        $adminUser->setEmail('admin98@gmail.com');
        $adminUser->setPassword($this->passwordHasher->hashPassword($user,'test'));
        $adminUser->setRoles(['ROLE_ADMIN']);

        
        $manager->persist($user);
        $manager->persist($adminUser);

        $manager->flush();

    }
}
