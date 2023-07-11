<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{
  public function load(ObjectManager $manager): void
  {
    $user = new User();
    $user->setName('Erling Haaland');
    $user->setAge(22);
    $manager->persist($user);

    $user2 = new User();
    $user2->setName('Christian Horner');
    $user2->setAge(49);
    $manager->persist($user2);

    $user3 = new User();
    $user3->setName('Bereznay Dani');
    $user3->setAge(23);
    $manager->persist($user3);

    $manager->flush();

    $this->addReference('user_1', $user);
  }

  public function getOrder(): int
  {
    return 1; // smaller means sooner
  }
}
