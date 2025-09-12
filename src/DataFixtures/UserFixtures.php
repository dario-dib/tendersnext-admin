<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
    ) {}

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('dario@tendersnext.com');
        $user->setFirstName('Dario');
        $user->setLastName('Di Bella');
        $user->setPassword(
            $this->hasher->hashPassword($user, 'SunnyDubai')
        );
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('nicolas@tendersnext.com');
        $user->setFirstName('Nicolas');
        $user->setLastName('Balashenko');
        $user->setPassword(
            $this->hasher->hashPassword($user, 'SunnyDubai')
        );
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('niels@tendersnext.com');
        $user->setFirstName('Niels');
        $user->setLastName('Groen');
        $user->setPassword(
            $this->hasher->hashPassword($user, 'SunnyDubai')
        );
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('joppe@tendersnext.com');
        $user->setFirstName('Joppe');
        $user->setLastName('Hattink');
        $user->setPassword(
            $this->hasher->hashPassword($user, 'SunnyDubai')
        );
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();
    }
}
